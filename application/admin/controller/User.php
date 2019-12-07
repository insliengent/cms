<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\facade\Cookie;
use think\Db;
use PHPExcel;
use PHPExcel_IOFactory;

class User extends Base
{
  public function lst()
    {
      $userlst = Db::name('user')->paginate(20);
      $this->assign('userlst',$userlst);
      //$this->assign('catename',$catename);
      return view();
    }

  public function check()
    {
      $members = Db::name('check')
      ->whereTime('update_time', 'month')
      ->select();

      $echarts = array();
      $xAxis = array();
      $yAxis = array();
      foreach ($members as $k => $v) {
        $datetime = date('m-d',$v['update_time']);
        if(array_key_exists($datetime,$echarts)){
            $echarts[$datetime] +=1;
          }else{
            $echarts[$datetime] =1;
          }
      }
      foreach ($echarts as $k => $v) {
        $xAxis[] = $k;
        $yAxis[] = $v;
      }

      $xAxis_list = json_encode($xAxis);
      $yAxis_list = json_encode($yAxis);




      $lst = Db::name('check')->paginate(20);
      $this->assign('yAxis',$yAxis_list);
      $this->assign('lst',$lst);
      $this->assign('xAxis',$xAxis_list);


      return view();
    }
  public function excelout()
  {
      $data = Db::name('check')->all();
      $objExcel = new \PHPExcel();
      $PHPSheet = $objExcel->getActiveSheet();
      $PHPWriter = \PHPExcel_IOFactory::createWriter($objExcel, "Excel2007");
      $PHPSheet->setCellValue('A1', 'id')
        ->setCellValue('B1', '姓名')
        ->setCellValue('C1', '学历')
        ->setCellValue('D1', '专业')
        ->setCellValue('E1', '工作年限')
        ->setCellValue('F1', '手机')
        ->setCellValue('G1', '来源')
        ->setCellValue('H1', '时间');
      $num=2;
      foreach ($data as $k => $v) {
            $PHPSheet->setCellValue("A" . $num, $v['id']);
            $PHPSheet->setCellValue("B" . $num, $v['username']);
            $PHPSheet->setCellValue("C" . $num, $v['education']);
            $PHPSheet->setCellValue("D" . $num, $v['major']);
            $PHPSheet->setCellValue("E" . $num, $v['work_age']);
            $PHPSheet->setCellValue("F" . $num, $v['phone']);
            $PHPSheet->setCellValue("G" . $num, $v['source']);
            $PHPSheet->setCellValue("H" . $num, $v['create_time']);
            $num++;
        }

      $outfile=date('Y-m-d h:i:sa');
      ob_end_clean();
      header("Content-Type:application/force-download");
      header("content-Type:application/octet-stream");
      header("Content-Type:application/download");
      header('Content-Disposition:inline;filename="'.$outfile.'.xlsx"');
      header('Content-Transfer-Encoding:binary');
      header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
      header('Pragma:no-cache');
      $PHPWriter->save("php://output");

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
