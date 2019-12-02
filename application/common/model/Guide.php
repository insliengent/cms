<?php
namespace app\common\model;
use think\Collection;
use think\Model;
use think\model\concern\SoftDelete;
class Guide extends Model
{
  use SoftDelete;

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
    Public function getList($data,$pid='0')
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
        $validate = new \app\common\validate\Guide();
        if (!$validate->scene('add')->check($data)) {
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
        $validate = new \app\common\validate\Guide();
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

    public function sort($data)
    {
        $validate = new \app\common\validate\Guide();
        if (!$validate->scene('sort')->check($data)) {
            return $validate->getError();
        }
        $Info = $this->find($data['id']);
        $Info->sort = $data['sort'];
        $result = $Info->save();
        if ($result) {
            return 1;
        }else {
            return '排序失败！';
        }
    }


}
