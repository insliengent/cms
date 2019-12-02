<?php
namespace app\admin\controller;
use think\Controller;
class Comment extends Controller
{
    public function lst()
    {
      static $arr = array();
      $comments = model('comment')->order(['create_time' => 'desc'])->all();
      foreach ($comments as $k => $v) {
        $v['arttit'] = model($v['tablename'])->where('id',$v['artid'])->value('title');
        $arr[] = $v;
      }
      $com = $arr;
      $this->assign('comlst',$com);
      return view();
    }

    public function read()
    {
        $commentInfo = model('Comment')->find(input('id'));
        $viewData = [
            'commentInfo' => $commentInfo
        ];
        $this->assign($viewData);
        return view();
    }

    public function del()
    {
        $commentInfo = model('Comment')->find(input('id'));
        $result = $commentInfo->delete();
        if ($result) {
            $this->success('删除成功！', 'admin/comment/lst');
        }else {
            $this->error('删除失败！');
        }
    }

    public function approved()
    {
        $info = model('Comment')->find(input('id'));
        $info->approved = input('post.approved') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/comment/lst');
        }else {
            $this->error('操作失败！');
        }
    }
}
