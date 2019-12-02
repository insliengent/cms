<?php
namespace app\index\controller;
class Search extends Base
{
  public function lst()
  {
    $keyword = '%' . input('s') . '%';
    $where[] = ['title', 'like', $keyword];
    $searchs = model('book')->where($where)->paginate(20, false, $where);
    $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
      return view('bookSearch');
    }

}
