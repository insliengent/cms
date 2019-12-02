<?php
namespace app\index\controller;
use think\Request;


class Love extends Base
{
  public function click()
    {
      if (empty(Cookie::has('uid'))){
        return ['code'=> -1,'msg'=>'请登录后收藏'];
       }
      if (request()->isAjax()) {
        $data = [
          'uid'      => base64_decode(Cookie::get('uid')),
          'artid'    => input('post.id'),
          'modename' => input('post.modename')
        ];
        $result = db('love')->where($data)->find();
        if (is_null($result)){
          $result = db('love')->insert($data);
          return ['code'=> 0,'msg'=>'已收藏'];
        }else {
          $result = db('love')->where($data)->delete();
          return ['code'=> 1, 'msg'=>'收藏'];
        }
      }
    }//end-add

}
