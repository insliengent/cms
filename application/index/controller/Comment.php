<?php
namespace app\index\controller;
use think\facade\Cookie;
use think\Db;

class Comment extends Base
{

    public function add()
    {
      if (request()->isAjax()) {
        if (!Cookie::has('uid')) {
          return ['code'=> -1,'msg'=>'请登录后评论'];
        }else{
          $data = [
            'artid'       => input('post.id'),
            'uid'         => base64_decode(Cookie::get('uid')),
            'tablename'   => input('post.controller'),
            'content'     => input('post.comment')
          ];
          $result = model('Comment')->add($data);
          if ($result == 1) {
            Db::name(input('post.controller'))
                ->where('id', input('post.id'))
                ->setInc('comment_count',1);
            echo  $this->success('已评论');
          }else {
            echo $this->error($result);
          }
        };
      }
    }

    public function like()
    {
      if (request()->isAjax()) {
        $result = Db::name('comment')->where('id', input('post.id'))->setInc('like',1);
        if ($result) {
          return ['code'=> 1,'msg'=>'已赞'];
        }
      }
    }


}
