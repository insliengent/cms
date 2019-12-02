<?php
namespace app\index\controller;
use think\Db;
use think\facade\Cookie;
use think\Controller;

use app\common\model\Book as bookModel;

class Point extends Base
{

  public function home()
  {
    $books = model('book')->where('pid', 0)->select();
    $this->assign('books',$books);
    return view();
  }

  public function lst()
  {
    $id = input('id');
    $books = model('book')->where('pid', 0)->select();
    $category = model('book')->where('id', $id)->find();
    while($category['pid'] != 0){
      $category = model('book')->where('id', $category['pid'])->find();
    }
    $root_id = $category['id'];
    $bookName = model('book')->where('id', $root_id)->value('title');
    $allbooks = Db::name('book')->field('id,pid,title,sort')->order(['sort' => 'desc','update_time' => 'asc'])->where('delete_time','Null')->select();

    $tree = new bookModel();
    $booktree = $tree->getList($allbooks,$root_id);
    $chapterLst   =  model('point')->where('chapter_id', $id)->select();
    $sectionLst   =  model('point')->where('section_id', $id)->select();

    $viewData = [
    'books'    => $books,
    'booktree' => $booktree,
    'bookName' => $bookName,
    'chapterLst' => $chapterLst,
    'sectionLst' => $sectionLst,
    ];

    $this->assign($viewData);
    return view();
  }

  public function sectionlst()
  {
    $id = input('id');
    $books = model('book')->where('pid', 0)->select();
    $category = model('book')->where('id', $id)->find();
    while($category['pid'] != 0){
      $category = model('book')->where('id', $category['pid'])->find();
    }
    $root_id = $category['id'];
    $bookName = model('book')->where('id', $root_id)->value('title');
    $allbooks = Db::name('book')->field('id,pid,title,sort')->order(['sort' => 'desc','update_time' => 'asc'])->where('delete_time','Null')->select();

    $tree = new bookModel();
    $booktree = $tree->getList($allbooks,$root_id);
    $sectionLst   =  model('point')->where('section_id', $id)->select();

    $viewData = [
    'books'    => $books,
    'booktree' => $booktree,
    'bookName' => $bookName,
    //'chapterLst' => $chapterLst,
    'sectionLst' => $sectionLst,
    ];

    $this->assign($viewData);
    return view();
  }


  public function tree()
  {
    $books = model('book')->where('pid', 0)->select();
    $allbooks = Db::name('book')->field('id,pid,title,sort')->order(['sort' => 'desc','update_time' => 'asc'])->where('delete_time','Null')->select();
    $tree = new bookModel();
    $booktree = $tree->getList($allbooks,input('id'));
    foreach ($booktree as $k => $v) {
      $childs = $booktree[$k]['child'];
      foreach ($booktree[$k]['child'] as $key => $value) {
        $booktree[$k]['child'][$key]['art_id'] = model('point')->where('section_id',$booktree[$k]['child'][$key]['id'])->limit(1)->value('id');
      }


    }

    $viewData = [
    'books'    => $books,
    'booktree' => $booktree,
    ];

    $this->assign($viewData);
    return view();
  }

  public function art()
  {
    $id = input('id');
    $book_id  = model('point')->where('id', $id)->value('book_id');

    $chapter_id  = model('point')->where('id', $id)->value('chapter_id');
/*    $category = model('book')->where('id', $book_id)->find();
    while($category['pid'] != 0){
      $category = model('book')->where('id', $category['pid'])->find();
    }
    $root_id = $category['id'];*/
    $bookName = model('book')->where('id', $book_id)->value('title');

    $books = Db::name('book')->field('id,pid,title,sort')->order(['sort' => 'desc','update_time' => 'asc'])->where('delete_time','Null')->select();
    $tree = new bookModel();
    $booktree = $tree->getList($books,$book_id);

    $prv            = model('point')->where('id','<',$id)->limit('1')->find();
    $next           = model('point')->where('id','>',$id)->limit('1')->find();
    //$ParentCateId   = model('book')->where('id', $book_id)->value('pid');
    //$ParentCateName = model('book')->where('id', $ParentCateId)->value('title');
    //$sameCatePoint  =  model('book')->where('pid', $ParentCateId)->select();
    $info = model('point')->find($id);
    $logonStatus = '0';
    if (Cookie::has('uid')) {
      $data = [
          'uid'      => base64_decode(Cookie::get('uid')),
          'artid'    => $id,
          'modename' => 'point'
        ];
      $love = Db::name('love')->where($data)->find();
      if ($love) {
        $logonStatus = '1';
      }else{
        $logonStatus = '0';
      }

    }
    $comments = Db::name('comment')
      ->alias('c')
      ->join('user u','c.uid = u.id')
      ->field('c.id,c.content,c.parent,c.artid,c.approved,c.like,c.tablename,c.create_time,u.avatar,u.nickname')
      ->where(['c.artid'=>input('id'),'c.tablename'=> 'Point'])
      ->select();
    $viewData = [
      'info'           => $info,
      'prv'            => $prv,
      'next'           => $next,
      'logonStatus'    => $logonStatus,
      //'ParentCateName' => $ParentCateName,
      //'sameCatePoint'  => $sameCatePoint,
      //'cateRootId'     => $book_id,
      'booktree'       => $booktree,
      'bookName'       => $bookName,
      'comments'       => $comments,
      'chapterId'       => $chapter_id,
     ];
    $this->assign($viewData);
    return view();
  }

  public function miss()
    {
        return view();
  }
}
