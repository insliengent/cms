<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Book as BookModel;

class Point extends Base
{
  public function lst()
    {
      $where = [];
      $catename = null;
      if (input('?id')) {
            $where = [
                'book_id' => input('id')
            ];
       $catename = model('Pointcate')->where('id', input('id'))->value('title');
      }
       $pointlst = model('point')
       ->where($where)
       ->with('Pointcate')
       ->order(['atop' => 'asc','update_time'=>'desc'])
       ->paginate(30, false, ['query' => $where]);
      $this->assign('pointlst',$pointlst);
      $this->assign('catename',$catename);
      return view();
    }

  public function add()
    {
      $books = new BookModel();
      $booktree = $books->booktree();
      $this->assign('booktree',$booktree);

      if (request()->isAjax()) {
        $data = [
          'title'       => input('post.title'),
          'seo_title'   => input('post.seo_title'),
          'img'         => input('post.img'),
          'book_id'     => input('post.book_id'),
          'desc'        => input('post.desc'),
          'content'     => htmlspecialchars_decode(input('post.content'))
        ];
        $result = model('point')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/point/lst');
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
        $searchs = model('point')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view();
    }

  public function edit()
    {
      $books = new BookModel();
      $booktree = $books->booktree();
      $this->assign('booktree',$booktree);
      if (request()->isAjax()) {
        $data = [
          'id'        => input('post.id'),
          'book_id'   => input('post.book_id'),
          'img'       => input('post.uploadurl'),
          'title'     => input('post.title'),
          'seo_title' => input('post.seo_title'),
          'sort'      => input('post.sort'),
          'desc'      => input('post.desc'),
          'content'   => htmlspecialchars_decode(input('post.content'))
        ];
        $result = model('point')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/point/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('point')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }

  public function atop()
    {
        $info = model('point')->find(input('id'));
        $info->atop = input('post.atop') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/point/lst');
        }else {
            $this->error('操作失败！');
        }
    }
  public function del()
    {
        $delInfo = model('point')->find(input('id'));
        $result = $delInfo->delete();
        if ($result) {
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }

}
