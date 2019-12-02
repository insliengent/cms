<?php

namespace app\admin\controller;
use think\Controller;
use think\File;

class down extends Base
{
  public function lst()
    {
      $lst = model('Down')->order(['update_time' => 'desc'])->paginate();
      $this->assign('downlst',$lst);
      return view();
    }

  public function add()
    {
      $lst = db('Downcate')->order(['update_time' => 'desc'])->all();
      $this->assign('downlst',$lst);
      if (request()->isAjax()) {
        $data = [
          'title'     => input('post.title'),
          'type'      => input('post.type'),
          'seo_title' => input('post.seo_title'),
          'downcate'     => input('post.downcate'),
          'down_link' => input('post.uploadurl'),
          'desc'      => input('post.desc')
        ];
        $result = model('down')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/down/lst');
        }else {
          $this->error($result);
        }
      }
      return view();
    }

  public function search()
    {
        $keyword = '%' . input('s') . '%';
        $where[] = ['title', 'like', $keyword];
        $searchs = model('down')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view();
    }

  public function edit()
    {
      $lst = db('Downcate')->order(['update_time' => 'desc'])->all();
      $this->assign('downlst',$lst);
      if (request()->isAjax()) {
        $data = [
          'id'        => input('post.id'),
          'title'     => input('post.title'),
          'downcate'     => input('post.downcate'),
          'type'      => input('post.type'),
          'seo_title' => input('post.seo_title'),
          'down_link' => input('post.uploadurl'),
          'desc'      => input('post.desc')
        ];
        $result = model('down')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/down/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('down')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }
  public function del()
    {
        $delInfo = model('down')->find(input('id'));
        $result = $delInfo->delete();
        if ($result) {
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }

  public function atop()
    {
        $info = model('Down')->find(input('id'));
        $info->atop = input('post.atop') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/down/lst');
        }else {
            $this->error('操作失败！');
        }
    }


}
