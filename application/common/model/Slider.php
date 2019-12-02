<?php
namespace app\common\model;
use think\Collection;
use think\Model;
use think\model\concern\SoftDelete;
class Slider extends Model
{
  use SoftDelete;
  public function add($data)
    {
        $validate = new \app\common\validate\Slider();
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
        $validate = new \app\common\validate\Slider();
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
        $validate = new \app\common\validate\Slider();
        if (!$validate->scene('sort')->check($data)) {
            return $validate->getError();
        }
        $BookInfo = $this->find($data['id']);
        $BookInfo->sort = $data['sort'];
        $result = $BookInfo->save();
        if ($result) {
            return 1;
        }else {
            return '排序失败！';
        }
    }

}
