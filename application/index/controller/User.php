<?php
namespace app\index\controller;
use think\facade\Env;
use think\Db;
use think\facade\Request;
use think\facade\Cookie;


class User extends Base
{
  public function home()
    {
      $viewData =[];
      if (Cookie::has('uid')) {
        $uid =base64_decode(Cookie::get('uid'));
        $myExamCount = Db::name('love')->where(['uid' => $uid, 'modename' => 'exams'])->count();
        $myPointCount = Db::name('love')->where(['uid' => $uid, 'modename' => 'point'])->count();
        $myCommentCount = Db::name('comment')->where(['uid' => $uid])->count();
        $user = Db::name('user')->where(['id' => $uid])->find();
        $createtime = Db::name('user')->where(['id' => $uid])->find('create_time');
        $day = intval((time()-$createtime)/86400);
        $viewData = [
        'myExamCount'    => $myExamCount,
        'user'           => $user,
        'day'            => $day,
        'myPointCount'   => $myPointCount,
        'myCommentCount' => $myCommentCount
        ];
      }else{
         $this->redirect('index/index/login');
      }

    $this->assign($viewData);
    return view();
    }

  public function set()
    {
      $uid =base64_decode(Cookie::get('uid'));
      $info = Db::name('user')->where(['id' => $uid])->find();
      $viewData = [
      'info'             => $info,
      ];
      $this->assign($viewData);
      return view();
    }

  public function exam()
    {
      $uid =base64_decode(Cookie::get('uid'));
      $artIds = Db::name('love')->where(['uid' => $uid, 'modename' => 'exam'])->column('artid');
      $examlst = Db::name('exam')->where('id','in',$artIds)->limit(14)->select();

      $input_post = input("post.");
      if(isset($input_post) && !empty($input_post)){
          $offect = $input_post['offect'];
          $show_list = Db::name("exam")->where('id','in',$artIds)->limit($offect,8)->select();
          if(isset($show_list) && !empty($show_list)){
              return json_encode($show_list);
          }else{
              return -1;
          }
      }else{
          $this->assign("examlst",$examlst);
      }
      return view();
    }

  public function point()
    {
      $uid =base64_decode(Cookie::get('uid'));
      $artIds = Db::name('love')->where(['uid' => $uid, 'modename' => 'point'])->column('artid');
      $pointlst = Db::name('point')->where('id','in',$artIds)->limit(14)->select();

      $input_post = input("post.");
      if(isset($input_post) && !empty($input_post)){
          $offect = $input_post['offect'];
          $show_list = Db::name("point")->where('id','in',$artIds)->limit($offect,8)->select();
          if(isset($show_list) && !empty($show_list)){
              return json_encode($show_list);
          }else{
              return -1;
          }
      }else{
          $this->assign("pointlst",$pointlst);
      }
      return view();
    }

  public function comment()
    {
      $uid =base64_decode(Cookie::get('uid'));
      $artIds = Db::name('comment')->where(['uid' => $uid])->column('artid');
      $commentlst = Db::name('point')->where('id','in',$artIds)->limit(14)->select();

      $input_post = input("post.");
      if(isset($input_post) && !empty($input_post)){
          $offect = $input_post['offect'];
          $show_list = Db::name("point")->where('id','in',$artIds)->limit($offect,8)->select();
          if(isset($show_list) && !empty($show_list)){
              return json_encode($show_list);
          }else{
              return -1;
          }
      }else{
          $this->assign("commentlst",$commentlst);
      }
      return view();
    }

  public function upload()
  {

    if (request()->isAjax()) {
      $uid =base64_decode(Cookie::get('uid'));
      $file = request() -> file('file');
      $info = $file->rule('uniqid')->move(Env::get('root_path'). 'public'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'images');
      if($info){
        $result =array();
        $jsonInfo = $file->getInfo();
        $getSaveName=str_replace("\\","/",$info->getSaveName());
        $result['src'] = '/static/uploads/images/'.$getSaveName;
        $result['size'] = $jsonInfo['size'];
        $result['code'] = Db::name('user')->where('id', $uid)->setField('avatar', $result['src']);
        return $result;
      }else{
        echo $file->getError();
      }
    }
  }

}
