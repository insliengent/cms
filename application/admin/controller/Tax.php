<?php
namespace app\admin\controller;
use think\Controller;

class Tax extends Base
{
  public function lst()
    {
      $lst = model('Tax')->order(['atop' => 'asc','update_time' => 'desc'])->paginate();
      $this->assign('taxlst',$lst);
      return view();
    }
  public function add()
    {
      if (request()->isAjax()) {
        $data = [
          'title'   => input('post.title'),
          'addr'    => input('post.addr'),
          'tel'     => input('post.tel'),
          'desc'    => input('post.img'),
          'cateid'  => input('post.cateid'),
          'website' => input('post.website'),
        ];
        $result = model('tax')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/tax/lst');
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
        $searchs = model('tax')->where($where)->paginate(20, false, $where);
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
          'title'   => input('post.title'),
          'addr'    => input('post.addr'),
          'tel'     => input('post.tel'),
          'desc'    => input('post.img'),
          'cateid'  => input('post.cateid'),
          'website' => input('post.website'),
        ];
        $result = model('tax')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/tax/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('tax')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }
  public function del()
    {
        $delInfo = model('tax')->find(input('id'));
        $result = $delInfo->delete();
        if ($result) {
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }
  public function atop()
    {
        $info = model('tax')->find(input('id'));
        $info->atop = input('post.atop') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/tax/lst');
        }else {
            $this->error('操作失败！');
        }
    }

}
