<?php
namespace app\admin\controller;
use think\Controller;
use think\File;
use think\Db;
use think\Request;
use app\common\model\Book as bookModel;

class book extends Base
{
  public function lst()
  {
    $books = model('book')->where('pid', 0)->paginate();
    $this->assign('books',$books);
    return view();
  }

  public function Add()
  {

    if (request()->isAjax()) {
      $data = [
        'level'     => '1',
        'img'       => input('post.uploadurl'),
        'title'     => input('post.title'),
        'seo_title' => input('post.seo_title'),
        'sort'      => input('post.sort'),
        'desc'      => input('post.desc')
      ];
      $result = model('book')->add($data);
      if ($result == 1) {
        $this->success('栏目添加成功！', 'admin/book/lst');
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
        'seo_title' => input('post.seo_title'),
        'sort'      => input('post.sort'),
        'desc'      => input('post.desc')
      ];
      $result = model('book')->edit($data);
      if ($result == 1) {
         $this->success('栏目编辑成功！', 'admin/book/lst');
        }else {
          $this->error($result);
         }
     }

      $bookInfo = model('book')->find(input('id'));
      $viewData = [
            'bookInfo' => $bookInfo
        ];
      $this->assign($viewData);
    return view();
    }

  public function chapterlst()
    {
      $pid   = input('id');
      $books = Db::name('book')->field('id,pid,title,sort')->order(['sort' => 'desc','update_time' => 'asc'])->where('delete_time','Null')->select();
      $tree = new bookModel();
      $genTree = $tree->getList($books,$pid);
      $this->assign('genTree',$genTree);
      return view();
    }

  public function chapteredit()
    {
      $books = new BookModel();
      $booktree = $books->booktree();
      $this->assign('booktree',$booktree);
       if (request()->isAjax()) {
      $data = [
        'id'        => input('post.id'),
        'pid'       => input('post.pid'),
        'title'     => input('post.title'),
        'seo_title' => input('post.seo_title'),
        'sort'      => input('post.sort'),
        'desc'      => input('post.desc')
      ];
      $result = model('book')->edit($data);
      if ($result == 1) {
         $this->success('栏目编辑成功！', 'admin/book/lst');
        }else {
          $this->error($result);
         }
     }

      $bookInfo = model('book')->find(input('id'));
      $viewData = [
            'bookInfo' => $bookInfo
        ];
      $this->assign($viewData);

      return view();
    }

  public function chapteradd()
  {
      $books = new BookModel();
      $booktree = $books->booktree();
      $this->assign('booktree',$booktree);

    if (request()->isAjax()) {
      $pid = input('book_id');
      $Parent_level = model('book')->where('id',$pid)->value('level');
      $level = ++$Parent_level;
      $data = [
        'title'     => input('title'),
        'level'     => $level,
        'slug'      => input('slug'),
        'seo_title' => input('seo_title'),
        'pid'       => input('book_id'),
        'desc'      => input('desc')
      ];
      $result = model('book')->add($data);
      if ($result == 1) {
        $this->success('栏目添加成功！', 'admin/book/lst');
      }else {
        $this->error($result);
      }
    }
    return view();
  }



  public function bookSearch()
    {
        $keyword = '%' . input('s') . '%';
        $where[] = ['title', 'like', $keyword];
        $searchs = model('book')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view();
    }

  public function del()
    {
      dump(input('id'));
        $info = model('book')->where('id',input('id'))->find();
        $result = $info->delete();
        if ($result) {
            $this->success('删除成功！');
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
        $result = model('book')->sort($data);
        if ($result == 1) {
            $this->success('排序成功！');
        }else {
            $this->error($result);
        }
    }





}
