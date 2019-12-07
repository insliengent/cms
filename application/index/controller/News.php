<?php
namespace app\index\controller;
use think\Db;
use think\facade\Cookie;

class News extends Base
{
  public function lst()
  {
        $where = [];
        $catename = null;
        if (input('?id')) {
            $where = [
                'newscate_id' => input('id')
            ];
        }
        $newslst = model('News')->where($where)->with('newscate')->order(['atop' => 'asc', 'create_time' => 'desc'])->paginate(15, false, ['query' => $where]);
        $newsCate = model('newscate')->all();
         foreach ($newslst as $k => $v) {
          if (empty($newslst[$k]['img'])) {
            $newslst[$k]['img'] = '/static/img/rand/'.rand(1,10).'.gif';
          }
          if (empty($newslst[$k]['desc'])) {
            $content = strip_tags($newslst[$k]['content']);
            $newslst[$k]['desc'] = mb_substr($content,0,120);
          }
        }
        $this->assign('newslst',$newslst);
        $this->assign('newsCate',$newsCate);
        return view();
  }

  public function art()
  {
    $info = model('news')->find(input('id'));
    $prv=Db::name('news')->where('newscate_id',$info->newscate_id)->where('id','<',input('id'))->order('id asc')->limit('1')->find();
    $this->assign('prv',$prv);
    $next=Db::name('news')->where('newscate_id',$info->newscate_id)->where('id','>',input('id'))->order('id asc')->limit('1')->find();
    $relatedPost  = model('news')->where('title', 'like', $info->title)->limit(10)->select();
  /*  $comments = Db::name('comment')->where(['artid'=>input('id'),'tablename'=> 'News'])->select();*/

    $comments = Db::name('comment')
      ->alias('c')
      ->join('user u','c.uid = u.id')
      ->field('c.id,c.content,c.parent,c.artid,c.approved,c.like,c.tablename,c.create_time,u.avatar,u.nickname')
      ->where(['c.artid'=>input('id'),'c.tablename'=> 'News'])
      ->select();

    $viewData = [
      'info' => $info,
      'prv' => $prv,
      'next' => $next,
      'comments' => $comments,
      'relatedPost' => $relatedPost,
    ];
    $this->assign($viewData);
    return view();
  }

  public function like()
  {
    $id = input('id');
    $result =  Db::name('News')->where('id', $id)->setInc('like',1);
    if ($result) {
      echo  $this->success('已赞');
    }else{
      echo $this->error($result);
    }
  }

  public function love()
  {
    $id = input('id');
    $result = Db::name('News')->where('id',$id)->setInc('love',1);
    if (empty(Cookie::has('uid'))){
        return ['code'=> -1,'msg'=>'请登录后收藏'];
    }else{
      if (request()->isAjax()) {
        $data = [
          'uid'      => base64_decode(Cookie::get('uid')),
          'artid'    => input('post.id'),
          'modename' => input('News')
        ];
        $result = Db::name('love')->where($data)->find();
        if (is_null($result)){
          Db::name('love')->insert($data);
          return ['code'=> 0,'msg'=>'已收藏'];
        }else {
          Db::name('love')->where($data)->delete();
          return ['code'=> 1, 'msg'=>'收藏'];
        }
      }
    }




  }

}
