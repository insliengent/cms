<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Env;
use app\common\model\News as newsModel;


class Base extends Controller
{
  public function initialize()
  {
  /*  if (!session('?admin.id')){
      $this->redirect('admin/index/login');
    }*/
    $news = new newsModel();
    $newsTree = $news -> cateTree();
    $this->assign('newsCateTree',$newsTree);
  }
  public function loginout()
  {
      session(null);
      $this->success('退出成功！', 'index/index/index');
  }
  public function upload()
  {
    if (request()->isAjax()) {
      $file = request() -> file('file');
      $info = $file->rule('uniqid')->move(Env::get('root_path'). 'public'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'images');
      if($info){
        $result =array();
        $jsonInfo = $file->getInfo();
        $getSaveName=str_replace("\\","/",$info->getSaveName());
        $result['src'] = '/static/uploads/images/'.$getSaveName;
        $result['size'] = $jsonInfo['size'];
        return $result;
      }else{
        echo $file->getError();
      }
    }
  }


}
