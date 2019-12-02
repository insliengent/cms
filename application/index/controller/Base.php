<?php
namespace app\index\controller;
use think\Controller;
use think\facade\Cookie;
use think\Db;
use think\facade\Request;


class Base extends Controller
{
    public function initialize()
    {
       //TDK
       $title          ='';
       $webName        = Db::name('system')->where('sys_key','web_name')->value('sys_value');
       $kws            ='';
       $desc           ='';
       $id             = input('id');




       $viewData = [
        'tit'     => $title,
        'desc'    => $desc,
        'kws'     => $kws,
        'webName' => $webName
      ];
      $this->assign($viewData);

      $mobile = env('root_path') .'template'. DIRECTORY_SEPARATOR .'mobile'.DIRECTORY_SEPARATOR;
      $web = env('root_path') .'template'. DIRECTORY_SEPARATOR .'web'.DIRECTORY_SEPARATOR;

       if (isMobile()) {
        $this->view->config('view_base', $mobile);
       }else{
        $this->view->config('view_base', $mobile);
       }

    }//end

}
