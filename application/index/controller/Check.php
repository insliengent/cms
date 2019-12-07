<?php
namespace app\index\controller;
use think\Controller;
use think\facade\Cookie;
use think\Db;
use think\facade\Request;


class Check extends Base
{
  if (request()->isAjax()) {
  $data = [
    'username'  => input('post.username'),
    'phone'     => input('post.phone'),
    'education' => input('post.education'),
    'work_age'  => input('post.work_age'),
    'major'     => input('post.major')
  ];
  $result = model('check')->add($data);
  if ($result == 1) {
    $this->success('数据添加成功');
  }else {
    $this->error($result);
  }
}
