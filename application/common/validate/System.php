<?php
namespace app\common\validate;
use think\Validate;

class System extends Validate
{
    protected $rule = [
      'sys_key|标签标示' => 'require|unique:System',
      'sys_value|标签内容' => 'require',
    ];

    public function sceneEdit()
    {
        return $this->only(['sys_key','sys_value']);
    }
}