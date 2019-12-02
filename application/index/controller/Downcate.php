<?php
namespace app\index\controller;
use think\Controller;
use think\facade\Session;
class Down extends Base
{
  public function lst()
    {
      $lst = model('Down')->where('downcate',input('id'))->paginate(10);
      $this->assign('downlst',$lst);
      return view();
    }
  public function home()
    {
      $downcate = model('downcate')->all();
      $this->assign('downcate',$downcate);
      return view();
    }

  public function art()
    {
      $info = model('Down')->find(input('id'));
      $viewData = [
        'info' => $info
      ];
      $this->assign($viewData);
      return view();
    }
}
