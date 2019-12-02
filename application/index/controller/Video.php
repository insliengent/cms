<?php
namespace app\index\controller;
class Video extends Base
{
  public function lst()
  {
    $books = model('book')->where('pid', 0)->order(['sort' => 'desc'])->all();
        $where = [];
        $catename = null;
        if (input('?id')) {
            $where = [
                'book_id' => input('id')
            ];
        }
        $Videolst = model('Video')->where($where)->with('videoCate')->order(['atop' => 'asc', 'create_time' => 'desc'])->paginate(15, false, ['query' => $where]);
        $this->assign('Videolst',$Videolst);
        $this->assign('books',$books);
        return view();
  }

public function art()
  {
    $id =input('id');
    $info =model('Video')->find($id);
    $prv  =db('video')->where('id','<',$id)->limit('1')->find();
    $next =db('video')->where('id','>',$id)->limit('1')->find();
    $viewData = [
      'info' => $info,
      'prv'  => $prv,
      'next' => $next
    ];
    $this->assign($viewData);
    return view();
  }



}
