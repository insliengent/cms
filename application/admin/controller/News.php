<?php

namespace app\admin\controller;
use think\Controller;

class news extends Base
{
  public function lst()
    {
      $where = [];
      $catename = null;
      if (input('?id')) {
            $where = [
                'newscate_id' => input('id')
            ];
       $catename = model('Newscate')->where('id', input('id'))->value('title');
      }
       $newslst = model('News')
       ->where($where)
       ->with('newscate')
       ->order(['atop' => 'asc','update_time' => 'desc'])
       ->paginate(20, false, ['query' => $where]);
      $this->assign('newslst',$newslst);
      $this->assign('catename',$catename);
      return view();
    }
  public function trash()
    {

      $newslst = model('News')->onlyTrashed()->paginate();
      $this->assign('newslst',$newslst);
      return view();
    }

  public function add()
    {
      if (request()->isAjax()) {
        $data = [
          'title'       => input('post.title'),
          'seo_title'   => input('post.seo_title'),
          'img'         => input('post.img'),
          'newscate_id' => input('post.cateid'),
          'desc'        => input('post.desc'),
          'content'     => htmlspecialchars_decode(input('post.content'))
        ];
        $result = model('news')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/news/lst');
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
        $searchs = model('news')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view();
    }

  public function edit()
    {
      if (request()->isAjax()) {
        $data = [
          'id'        => input('post.id'),
          'img'       => input('post.uploadurl'),
          'title'     => input('post.title'),
          'seo_title' => input('post.seo_title'),
          'sort'      => input('post.sort'),
          'desc'      => input('post.desc'),
          'content'     => htmlspecialchars_decode(input('post.content'))
        ];
        $result = model('news')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/news/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('news')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }


    public function atop()
    {
        $info = model('news')->find(input('id'));
        $info->atop = input('post.atop') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/news/lst');
        }else {
            $this->error('操作失败！');
        }
    }
    public function del()
    {
        $delInfo = model('news')->find(input('id'));
        $result = $delInfo->delete();
        if ($result) {
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }

}
