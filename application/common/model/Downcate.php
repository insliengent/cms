<?php
namespace app\common\model;
use think\Collection;
use think\Model;
use think\model\concern\SoftDelete;
class Downcate extends Model
{
  use SoftDelete;

    public function downToCate()
    {
        return $this->belongsTo('down', 'downcate', 'id');
    }

    public function add($data)
    {
        $validate = new \app\common\validate\Downcate();
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
        $validate = new \app\common\validate\Downcate();
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
        $info = model('Downcate')->find(input('id'));
        $info->atop = input('post.atop') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/Downcate/lst');
        }else {
            $this->error('操作失败！');
        }
    }



}
