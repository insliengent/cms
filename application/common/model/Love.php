<?php
namespace app\common\model;
use think\Model;
class Love extends Model
{
  public function click($data)
    {
      $validate = new \app\common\validate\Love();
      if (!$validate->scene('click')->check($data)) {
        return $validate->getError();
      }
      $loveInfo = $this->where($data)->find();
      if ($loveInfo) {
        $loveInfo->delete();
      }else {
        $this->allowField(true)->save($data);
      }

    }//end-click
}
