<?php
namespace app\common\validate;
use think\Validate;

class Slider extends Validate
{
    protected $rule = [
        'title|标题' => 'require|unique:News',
        'img|图片' => 'require',
        'id|ID' => 'require',
    ];

    public function sceneAdd()
    {
        return $this->only(['title','img']);
    }
    public function sceneEdit()
    {
       return $this->only(['title','img']);
    }
    public function sceneSort()
    {
       return $this->only(['id']);
    }

}