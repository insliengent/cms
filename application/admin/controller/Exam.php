<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Loader;
use think\Request;
use app\common\model\Book as bookModel;

class Exam extends Base
{

  public function lst()
  {
    //接收数据
    $book_id = input('id');
    if (empty($book_id)) {
        $exams = model('exam')->paginate(30);
        $this->assign('exams',$exams);
    }else{
        $exams = model('exam')->where('book_id', $book_id)->order('id', 'asc')->paginate(30);
        $this->assign('exams',$exams);
    }
    return view();
  }

  public function add()
  {
    $books = new BookModel();
    $booktree = $books->booktree();
    $this->assign('booktree',$booktree);
    if (request()->isAjax()) {
      $answerArr = array_filter(input('post.answer'));
      $data = [
        'id'       => input('post.id'),
        'title'    => input('post.title'),
        'question' => input('post.question'),
        'opt'   => implode('',input('post.check')),
        'book_id'  => input('post.book_id'),
        'answer'   => implode('|||',$answerArr),
        'analysis' => input('post.analysis')
      ];
      $result = model('exam')->add($data);
      if ($result == 1) {
        $this->success($result);
      }else {
         $this->error($result);
      }
    }
    return view();
  }

  public function edit()
  {

    $books = new BookModel();
    $booktree = $books->booktree();
    $this->assign('booktree',$booktree);
   if (request()->isAjax()) {
      $answerArr = array_filter(input('post.answer'));
      $data = [
        'id'       => input('post.id'),
        'title'    => input('post.title'),
        'question' => input('post.question'),
        'opt'   => implode('',input('post.check')),
        'book_id'  => input('post.book_id'),
        'answer'   => implode('|||',$answerArr),
        'analysis' => input('post.analysis')
      ];
      $result = model('Exam')->edit($data);
      if ($result == 1) {
         $this->success('栏目编辑成功！', 'admin/exam/examlist');
        }else {
          $this->error($result);
         }
     };
      $examInfo = model('Exam')->find(input('id'));
      $opt = $examInfo['opt'];
      $answer = $examInfo['answer'];
      $answerArr = explode("|||",$answer);
      $count  = count($answerArr);
      $abc = array_slice(array('A','B','C','D','E','F'),0,$count);
      $opts = str_split($opt,1);

      if(in_array("A",$opts)){
        $d['1'] = '1';
        }else{
        $d['1'] = '0';
      }
      if(in_array("B",$opts)){
        $d['2'] = '1';
        }else{
        $d['2'] = '0';
      }
      if(in_array("C",$opts)){
        $d['3'] = '1';
        }else{
        $d['3'] = '0';
      }
      if(in_array("D",$opts)){
        $d['4'] = '1';
        }else{
        $d['4'] = '0';
      }
      if(in_array("E",$opts)){
        $d['5'] = '1';
        }else{
        $d['5'] = '0';
      }
      if(in_array("F",$opts)){
        $d['6'] = '1';
        }else{
        $d['6'] = '0';
      }
       $d = array_slice($d,0,$count);
      foreach($d as $key=>$val){
        $e[$key]['opt']=$d[$key];
        $e[$key]['answer']=$answerArr[$key];
       }
      $viewData = [
          'examInfo' => $examInfo,
          'examArray' => $e,
      ];
      $this->assign($viewData);

    return view();
    }


  public function search()
    {
        $keyword = '%' . input('s') . '%';
        $where[] = ['title', 'like', $keyword];
        $searchs = model('exam')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view();
  }

  public function del()
    {
        $examInfo = model('Exam')->find(input('id'));
        $result = $examInfo->delete();
        if ($result) {
            $this->success('文章删除成功！', 'admin/exam/examlist');
        }else {
            $this->error('文章删除失败！');
        }
    }
  public function sort()
    {
        $data = [
          'id'   => input('post.id'),
          'sort' => input('post.sort')
        ];
        $result = model('Exam')->sort($data);
        if ($result == 1) {
            $this->success('排序成功！');
        }else {
            $this->error($result);
        }
    }
  public function import()
    {
      if (request()->isAjax()) {
        $excel = request()->file('file')->getInfo();
        $objPHPExcel = \PHPExcel_IOFactory::load($excel['tmp_name']);//读取上传的文件
        $sheet = $objPHPExcel->getSheet(0);//激活当前的表
        $highestRow = $sheet->getHighestRow() - 1 ;// 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $arrExcel = $objPHPExcel->getSheet(0)->toArray();//获取其中的数据
        $a=0;
        for($i=1;$i<=$highestRow;$i++)
        {
          $data[$a] = array_combine($arrExcel[0], $arrExcel[$i]);
          $a++;
        }
        $result = Db::name('Exam')->data($data)->limit(20)->insertAll();
        if($result){
          $this->success('操作成功！');
        }else{
          $this->error('操作失败！');
        }
      }
      return view();
    }

}
