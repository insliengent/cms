<?php

namespace app\admin\controller;
use think\Controller;
use app\common\model\Downcate as DownCateModel;

class Downcate extends Base
{
  public function add()
    {
      if (request()->isAjax()) {
        $data = [
          'title'     => input('post.title'),
          'seo_title' => input('post.seo_title'),
          'icon'       => input('post.icon'),
          'desc'      => input('post.desc'),
        ];
        $result = model('Downcate')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/Down/lst');
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
          'icon'       => input('post.icon'),
          'title'     => input('post.title'),
          'seo_title' => input('post.seo_title'),
          'desc'      => input('post.desc')
        ];
        $result = model('Downcate')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/Down/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('Downcate')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }

  public function lst()
    {
      $downcate = model('Downcate')->all();
      foreach ($downcate as $k => $v) {
        $downcate[$k]['count'] = model('down')->where('downcate',$v['id'])->count();
      }
      $this->assign('downcate',$downcate);
      return view();
    }



  public function Search()
    {
        $keyword = '%' . input('s') . '%';
        $where[] = ['title', 'like', $keyword];
        $searchs = model('Downcate')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view('DownSearch');
    }

  public function del()
    {
        $Info = model('Downcate')->find(input('id'));
        $result = $Info->delete();
        if ($result) {
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }

  public function Sort()
    {
        $data = [
          'id'   => input('post.id'),
          'sort' => input('post.sort')
        ];
        $result = model('Downcate')->sort($data);
        if ($result == 1) {
            $this->success('排序成功！');
        }else {
            $this->error($result);
        }
    }


}
