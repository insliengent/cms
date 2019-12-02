<?php

namespace app\admin\controller;
use think\Controller;
use app\common\model\Newscate as newsCateModel;

class Newscate extends Base
{



  public function add()
    {
      if (request()->isAjax()) {
        $data = [
          'title'     => input('post.title'),
          'seo_title' => input('post.seo_title'),
          'img'       => input('post.img'),
          'desc'      => input('post.desc'),
          'pid'      => input('post.pid'),
          'content'   => input('post.content')
        ];
        $result = model('newscate')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/news/lst');
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
          'pid'       => input('post.pid'),
          'seo_title' => input('post.seo_title'),
          'desc'      => input('post.desc')
        ];
        $result = model('newscate')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/news/catlst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('newscate')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }

  public function lst()
    {
      $newscates = model('newscate')->order('sort', 'desc')->paginate('20');
      $newsTree = new newsCateModel();
      $genTree = $newsTree ->getList($newscates);
      $this->assign('genTree',$genTree);
      return view();
    }



  public function Search()
    {
        $keyword = '%' . input('s') . '%';
        $where[] = ['title', 'like', $keyword];
        $searchs = model('newscate')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view('newsSearch');
    }

  public function del()
    {
        $Info = model('newscate')->find(input('id'));
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
        $result = model('newscate')->sort($data);
        if ($result == 1) {
            $this->success('排序成功！');
        }else {
            $this->error($result);
        }
    }


}
