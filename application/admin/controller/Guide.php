<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\guide as guideModel;
class Guide extends Base
{
  public function add()
    {
      $pid =  input('post.pid');
      if (!empty($pid)) {
        $pid = 0;
      }
      if (request()->isAjax()) {
        $data = [
          'title'     => input('post.title'),
          'pid'       => input('post.pid'),
          'seo_title' => input('post.seo_title'),
          'pid'       => $pid,
          'content'   => htmlspecialchars_decode(input('post.content'))
        ];
        $result = model('guide')->add($data);
        if ($result == 1) {
          $this->success('添加成功！', 'admin/guide/lst');
        }else {
          $this->error($result);
        }
      }

      $guides = model('guide')->order('sort', 'desc')->all();
      $trees = new guideModel();
      $navTree = $trees ->tree($guides);
      $this->assign('navTree',$navTree);

      return view();
    }

  public function edit()
    {
      if (request()->isAjax()) {
        $data = [
          'id'     => input('post.id'),
          'title'     => input('post.title'),
          'seo_title' => input('post.seo_title'),
          'pid'       => input('post.pid'),
          'content'   => htmlspecialchars_decode(input('post.content'))
        ];
        $result = model('guide')->edit($data);
        if ($result == 1) {
           $this->success('编辑成功！', 'admin/guide/lst');
          }else {
            $this->error($result);
           }
       }

      $guides = model('guide')->order('sort', 'desc')->all();
      $trees = new guideModel();
      $navTree = $trees ->tree($guides);
      $Info = model('guide')->find(input('id'));
      $viewData = [
            'Info' => $Info,
            'navTree' => $navTree
        ];
      $this->assign($viewData);
      return view();
    }
  public function lst()
    {
      $guides = model('Guide')->order('sort', 'desc')->all();
      $trees = new guideModel();
      $guidelst = $trees ->getList($guides);
      $this->assign('guidelst',$guidelst);
      return view();
    }
  public function del()
    {
        $delInfo = model('guide')->find(input('id'));
        $result = $delInfo->delete();
        if ($result) {
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }
  public function sort()
    {
        $data = [
          'id'   => input('post.id'),
          'sort' => input('post.sort')
        ];
        $result = model('guide')->sort($data);
        if ($result == 1) {
            $this->success('排序成功！');
        }else {
            $this->error($result);
        }
    }
}