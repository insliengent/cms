<?php
namespace app\common\validate;
use think\Validate;

class book extends Validate
{
    protected $rule = [
        'title|科目名称' => 'require|unique:book',
        'img|科目图片' => 'require',
        'desc|科目描述' => 'require',
    ];

    public function sceneAdd()
    {
        return $this->only(['title','desc']);
    }

    public function sceneEdit()
    {
        return $this->only(['title']);
    }
    public function sceneSort()
    {
        return $this->only(['sort']);
    }

}