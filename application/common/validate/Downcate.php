<?php
namespace app\common\validate;
use think\Validate;

class Downcate extends Validate
{
    protected $rule = [
        'title|标题' => 'require|unique:Down',
        //'img|科目图片' => 'require',
        //'desc|科目描述' => 'require',
    ];

    public function sceneAdd()
    {
        return $this->only(['title']);
    }
    public function sceneEdit()
    {
        return $this->only(['title']);
    }
    public function sceneTop()
    {
        return $this->only(['title']);
    }


}