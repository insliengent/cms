<?php
namespace app\index\controller;
use think\Controller;
use think\File;
use think\facade\Env;

class Tax extends Base
{
  public function lst()
    {
      $lst = model('Tax')->paginate();
      $this->assign('taxlst',$lst);
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

  public function art()
    {

      $Info = model('tax')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }

}
