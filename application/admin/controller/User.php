<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Cookie;
use think\Db;

class User extends Base
{
  public function lst()
    {
      $userlst = Db::name('user')->paginate(20);
      $this->assign('userlst',$userlst);
      //$this->assign('catename',$catename);
      return view();
    }


  public function search()
    {
        $keyword = '%' . input('s') . '%';
        $where[] = ['title', 'like', $keyword];
        $searchs = model('User')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
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
          'desc'      => input('post.desc'),
          'content'     => htmlspecialchars_decode(input('post.content'))
        ];
        $result = model('User')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/User/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('User')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }


}
