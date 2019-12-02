<?php
namespace app\common\model;
use think\Collection;
use think\Model;
use think\model\concern\SoftDelete;
class Newscate extends Model
{
  use SoftDelete;
  public function cateTree()
  {
    $arr = model('newscate')->select();
    return $this->tree($arr);
  }

  public function tree($data,$pid=0,$level=0){
        static $arr = array();
        foreach($data as $k=>$v){
            if($v['pid'] == $pid){
                $v['level'] = $level;
                $arr[] = $v;
                $this->tree($data,$v['id'],$level+1);
            }
        }
        return $arr;
  }


    Public function getList($data,$pid=0)
    {
      $tree=array();
      foreach($data as $k => $v){
        if($v['pid'] == $pid){
          $v['child']=self::getList($data,$v['id']);
          $tree[]=$v;
          unset($data[$k]);
        }
      }
      return $tree;
    }



    public function add($data)
    {
        $validate = new \app\common\validate\Newscate();
        if (!$validate->scene('catadd')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return '添加成功！';
        }else {
            return '添加失败！';
        }
    }


    public function edit($data)
    {
        $validate = new \app\common\validate\Newscate();
       if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $result = $this->isUpdate(true)->save($data);
        if ($result) {
            return '修改成功!';
        }else {
            return '修改失败！';
        }
    }

    public function atop()
    {
        $info = model('Newscate')->find(input('id'));
        $info->atop = input('post.atop') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/Newscate/lst');
        }else {
            $this->error('操作失败！');
        }
    }



}
