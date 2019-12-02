<?php

namespace app\admin\controller;
use think\Controller;

class Slider extends Base
{
  public function lst()
    {
      $sliderlst = model('slider')->order('sort', 'desc')->all();
      $this->assign('sliderlst',$sliderlst);
      return view();
    }

  public function add()
    {
      if (request()->isAjax()) {
        $data = [
          'title'       => input('post.title'),
          'link'   => input('post.link'),
          'img'         => input('post.uploadurl'),
          'desc'        => input('post.desc'),
        ];
        $result = model('slider')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/slider/lst');
        }else {
          $this->error($result);
        }
      }


      return view();
    }

  public function edit()
    {
      if (request()->isAjax()) {
        $data = [
          'id'        => input('post.id'),
          'img'       => input('post.uploadurl'),
          'title'     => input('post.title'),
          'link'      => input('post.link'),
          'desc'      => input('post.desc'),
        ];
        $result = model('slider')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/slider/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('slider')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }

  public function del()
    {
        $Info = model('slider')->find(input('id'));
        $result = $Info->delete();
        if ($result) {
            $this->success('删除成功！', 'admin/slider/lst');
        }else {
            $this->error('删除失败！');
        }
    }
  public function sort()
    {
        $data = [
          'id'   => input('post.id'),
          'sort' => input('post.sort')
        ];
        $result = model('slider')->sort($data);
        if ($result == 1) {
            $this->success('排序成功！');
        }else {
            $this->error($result);
        }
    }

}
