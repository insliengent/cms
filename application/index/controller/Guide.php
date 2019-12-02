<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Book as BookModel;

class Guide extends Base
{
  public function lst()
    {
      $guides = model('guide')->order('sort', 'desc')->all();
      $treess = new BookModel();
      $guidelst = $treess -> getList($guides,'0');
      $this->assign('guidelst',$guidelst);
      return view();
    }

  public function art()
    {
      $guides = model('Guide')->order('sort', 'desc')->all();
      $trees = new BookModel();
      $tree = $trees ->getList($guides);
      $this->assign('tree',$tree);


      $Info = model('guide')->find(input('id'));
      $this->assign('info',$Info);
      return view();
    }

}