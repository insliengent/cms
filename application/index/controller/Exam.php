<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use app\common\model\Book as bookModel;

class Exam extends Base
{
  public function home()
  {
    $books = model('book')->where('pid', 0)->field('id,pid,title,img')->select();
    $bookArr = array();
    foreach ($books as $k => $v) {
      $bookArr[$k]['id'] = $v['id'];
      $bookArr[$k]['img'] = $v['img'];
      $bookArr[$k]['title'] = $v['title'];
      $bookArr[$k]['exam_count'] = model('exam')->where('book_id', $v['id'])->count();
    }

    //$lst = model('exam')->paginate(25);
    $viewData = [
      //'lst'    => $lst,
      'bookArr'   => $bookArr,

      ];
    $this->assign($viewData);
    return view();
  }

  public function tree()
  {
    $id = input('id');
    $bookName = model('book')->where('id', $id)->value('title');
    $allBooks = Db::name('book')->field('id,pid,title,sort')->order(['sort' => 'desc','update_time' => 'asc'])->where('delete_time','Null')->select();
    $tree = new bookModel();
    $booktree = $tree->getList($allBooks,$id);

    $viewData = [
    'bookName' => $bookName,
    'booktree' => $booktree,
    ];

    $this->assign($viewData);
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
    $artLst   =  model('exam')->where('chapter_id', $id)->select();

    $chapters = model('book')->where('pid', $id)->field('id,title,seo_title')->select();
    $chaptersFistAart = array();
    foreach ($chapters as $k => $v) {
      $chaptersFistAart[$k]['id'] =$v['id'];
      $chaptersFistAart[$k]['title'] =$v['title'];
      $chaptersFistAart[$k]['seo_title'] =$v['seo_title'];
      $chaptersFistAart[$k]['art_id'] = model('exam')->where('chapter_id',$v['id'])->value('id');
    }

    $viewData = [
    'books'    => $books,
    'booktree' => $booktree,
    'bookName' => $bookName,
    'artLst' => $artLst,
    'chapters' => $chaptersFistAart,
    ];

    $this->assign($viewData);
    return view();
  }

  public function art()
  {
      $id     = input('id');
      $bookId     = Db::name('exam')->where('id', $id)->value('book_id');
      $chapterID     = Db::name('exam')->where('id', $id)->value('chapter_id');
      $bookName   = Db::name('book')->where('id', $bookId)->value('title');
/*      $category = model('book')->where('id', $bookId)->find();
      while($category['pid'] != 0){
        $category = model('book')->where('id', $category['pid'])->find();
      }
      $root_id = $category['id'];*/

      $examInfo    = Db::name('exam')->find(input('id'));
      $answer      = $examInfo['answer'];
      $answerArr   = str_split($answer,1);
      $answerCount = count($answerArr);

      $books = Db::name('book')->field('id,pid,title,sort')->order(['sort' => 'desc','update_time' => 'asc'])->where('delete_time','Null')->select();
      $tree = new bookModel();
      $booktree = $tree->getList($books,$bookId);

      $optState = 'checkbox';
      if ($answerCount == 1) {
        $optState = 'radio';
      }
      $opt    = $examInfo['opt'];
      $optArr = explode("|||",$opt);
      $optCount     = count($optArr);

      if(in_array("A",$answerArr)){
        $d['1'] = '1';
        }else{
        $d['1'] = '0';
      }
      if(in_array("B",$answerArr)){
        $d['2'] = '1';
        }else{
        $d['2'] = '0';
      }
      if(in_array("C",$answerArr)){
        $d['3'] = '1';
        }else{
        $d['3'] = '0';
      }
      if(in_array("D",$answerArr)){
        $d['4'] = '1';
        }else{
        $d['4'] = '0';
      }
      if(in_array("E",$answerArr)){
        $d['5'] = '1';
        }else{
        $d['5'] = '0';
      }
      if(in_array("F",$answerArr)){
        $d['6'] = '1';
        }else{
        $d['6'] = '0';
      }
       $d = array_slice($d,0,$optCount);
      foreach($d as $key=>$val){
        $artBody[$key]['opt']=$d[$key];
        $artBody[$key]['answer']=$optArr[$key];
       }

    shuffle($artBody);
    $abc =array('A','B','C','D','E','F');
    $abc = array_slice($abc,0,$optCount);
    foreach($abc as $k=>$v){
        $artBody[$k]['abc'] = $v;
    }

    $prv=Db::name('exam')->where('chapter_id',$chapterID)->where('id','>',$id)->order('id asc')->limit('1')->find();
    $next=Db::name('exam')->where('chapter_id',$chapterID)->where('id','<',$id)->order('id asc')->limit('1')->find();

    $viewData = [
      'artBody'    => $artBody,
      'bookName'  => $bookName,
      'examInfo'   => $examInfo,
      'cateRootId' => $bookId,
      'optState'   => $optState,
      'booktree'   => $booktree,
      'prv'        => $prv,
      'next'       => $next,
      ];
      $this->assign($viewData);

    return view();
  }

  public function count()
  {
    if (request()->isAjax()) {
      $id = input('id');
      $olderror_count = model('exam')->where('id', $id)->value('error_count');
      $newerror_count = $olderror_count+1;

       $result = Db('exam')->where('id', $id)->update(['error_count' => $newerror_count]);
       if ($result == 1) {
         $this->success('OK');
        }else {
          $this->error($result);
        };
    };
    return view();
  }
}
