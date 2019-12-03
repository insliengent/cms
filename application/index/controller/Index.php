<?php
namespace app\index\controller;
use app\common\model\Book as bookModel;
use think\captcha\Captcha;
use think\facade\Cookie;
use think\Db;




class Index extends Base
{
  public function index()
   {
    $newslst = model('News')->order(['atop' => 'asc', 'create_time' => 'desc'])->limit(8)->select();

    foreach ($newslst as $k => $v) {

      if (empty($newslst[$k]['img'])) {
        $newslst[$k]['img'] = '/static/img/rand/'.rand(1,10).'.gif';
      }

      if (empty($newslst[$k]['desc'])) {
        $content = strip_tags($newslst[$k]['content']);
        $newslst[$k]['desc'] = mb_substr($content,0,120);
      }
    }


    $input_post = input("post.");
    if(isset($input_post) && !empty($input_post)){
        $offect = $input_post['offect'];
        $show_list = Db::name("News")->order(['atop' => 'asc', 'create_time' => 'desc'])->limit($offect,8)->field('id,title,content,like,comment_count,create_time')->select();

        if(isset($show_list) && !empty($show_list)){
          foreach($show_list as $key=>$item){
            $show_list[$key]['create_time'] = date("Y-m-d",$item['create_time']);
            if (empty($show_list[$key]['img'])) {
              $show_list[$key]['img'] = '/static/img/rand/'.rand(1,10).'.gif';
            }
            if (empty($show_list[$key]['desc'])) {
              $content = strip_tags($show_list[$key]['content']);
              $show_list[$key]['desc'] = mb_substr($content,0,120);
            }
          }
          return json_encode($show_list);
        }else{
            return -1;
        }
    }else{
        $this->assign("newslst",$newslst);
    }


    $books = model('book')->where('pid', 0)->order(['sort' => 'desc'])->select();
    $sliderlst = model('slider')->select();

    $viewData = [
      'sliderlst' => $sliderlst,
      'books' => $books,
    ];
    $this->assign($viewData);
    return view();
   }

  public function subject()
   {
      $id = input('id');
      $books = model('book')->where('pid', 0)->order(['sort' => 'desc'])->select();
      $chapters = Db::name('Book')->order(['sort' => 'desc'])->select();
      $bookModela = new bookModel();
      $AllSonIds = $bookModela->Booktree($id);
      $subjectName = Db::name('book')->where('id', $id)->value('title');

      $points = Db::name('point')->where('book_id', $id)->limit(10)->select();
      $exams = Db::name('exam')->where('book_id', $id)->order(['sort' => 'desc','update_time' => 'desc'])->limit(10)->select();

      $videos = Db::name('video')->where('book_id', $id)->order(['atop' => 'desc','update_time' => 'desc'])->limit(15)->select();

    $getNavTree = new bookModel();
    $navTree = $getNavTree->getList($chapters,$id);
    $points = Db::name('point')->where('book_id', $id)->order(['sort' => 'desc','update_time' => 'desc'])->limit(15)->select();
      $viewData = [
            'points' => $points,
            'exams' => $exams,
            'videos' => $videos,
            'subjectName' => $subjectName,
            'navTree' => $navTree,
            'books' => $books,
        ];
        $this->assign($viewData);
    return view();
  }

  public function book()
  {
    $books = model('book')->where('pid', 0)->order(['sort' => 'desc'])->select();
    $this->assign('books', $books);
    return view('book');
  }

  public function chapter()
    {
      $id = input('id');
      $booktitle   = model('book')->where('id', $id)->value('title');
      $this->assign('booktitle',$booktitle);

      $books = model('book')->order('sort', 'desc')->paginate('100');
      $genbookTree = new bookModel();
      $genTree = $genbookTree->getList($books,$id);
      $this->assign('genTree',$genTree);

      return view('chapter');
    }


  public function login()
    {
      if (request()->isAjax()) {
        $data = [
          'phone' => input('post.phone'),
          'password' => md5(input('post.password'))
        ];
        $result = model('user')->login($data);
        if ($result == 1) {
          Db::name('user')->where('phone', input('post.phone'))->setField('lastlogin_time', time());
           $this->success('登录成功！', input('post.redirect_to'));
        }else {
          $this->error($result);
        }
      }
      if (Cookie::has('uid')) {
          $this->redirect('index/user/home');
      }
      return view();
    }



  public function register()
    {
      if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => md5(input('post.password')),
                'conpass'  => md5(input('post.conpass')),
                'email'    => input('post.email')
            ];
            $result = model('user')->add($data);
            if ($result == 1) {
                $this->success('注册成功！', 'index/index/index');
            }else {
                $this->error($result);
            }
        }
      return view();
    }

  public function forget()
    {
        if (request()->isAjax()) {
            $code = mt_rand(1000, 9999);
            session('code', $code);
            $data = [
                'email' => input('post.email')
            ];
            $result = model('users')->forget($data);
            if ($result == 1) {
                $this->success('验证码发送成功！');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

 public function forgetRe()
    {
        $data = [
            'email' => input('post.email'),
            'code' => input('post.code')
        ];
        if (session('code') != $data['code']) {
            $this->error('验证码不正确！');
        }else {
            $newpass = mt_rand(10000,99999);
            $adminInfo = model('users')->where('email', $data['email'])->find();
            $adminInfo->password = $newpass;
            $result = $adminInfo->save();
            $content = '您好，' . $adminInfo['nickname'] . '！<br>' . '您的密码已重置成功。<br>' .
                '用户名：' . $adminInfo['username'] . '<br>' . '新密码：' . $newpass;
            if ($result && email($adminInfo['email'], $adminInfo['nickname'], '密码重置成功', $content)) {
                $this->success('新密码已发往邮箱！', 'index/index/login');
            }else {
                $this->error('密码重置失败！');
            }
        }
    }

  public function loginout()
    {
        Cookie::clear('uid');
        if (Cookie::has('uid')) {
            $this->error('退出失败！');
        }else {
            $this->success('退出成功！', 'index/index/login');
        }
    }
    //全站搜索
  public function search($s)
    {
      $s      = '%' . input('s') . '%';
      $where[]      = ['title', 'like', $s];
      $bookSearchs  = model('book')->where($where)->limit(10)->select();
      $newsSearchs  = model('news')->where($where)->limit(10)->select();
      $pointSearchs = model('point')->where($where)->limit(10)->select();
      $videoSearchs = model('video')->where($where)->limit(10)->select();
      $viewData = [
              'bookSearchs' => $bookSearchs,
              'newsSearchs' => $newsSearchs,
              'pointSearchs' => $pointSearchs,
              'videoSearchs' => $videoSearchs,
              'title' => '"' . input('s') . '"' . '搜索结果',
              'keyword' => '"' . input('s') . '"'
          ];
      $this->assign($viewData);
      return view('index/search');
    }

  public function check()
  {
    return view();
  }

}
