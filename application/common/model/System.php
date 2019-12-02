<?php
namespace app\common\model;
use think\Model;

class System extends Model
{
    public function edit($data)
    {
        $validate = new \app\common\validate\System();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->isUpdate(true)->saveAll($data);
        if ($result) {
            return 1;
        }else {
            return '更新失败！';
        }
    }
}
