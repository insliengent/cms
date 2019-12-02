<?php
namespace app\common\model;
use think\Collection;
use think\Model;
use think\model\concern\SoftDelete;
class News extends Model
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

    public function newscate()
    {
        return $this->belongsTo('Newscate', 'newscate_id', 'id');
    }


  public function add($data)
    {
        $validate = new \app\common\validate\News();
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
        $validate = new \app\common\validate\Book();
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



}
