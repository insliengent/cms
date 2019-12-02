<?php
namespace app\common\validate;
use think\Validate;

class Point extends Validate
{
    protected $rule = [
        'title|文章标题'    => 'require|unique:point',
        'book_id|所属科目'  => 'require',
        'content|答案'     => 'require',
        'id|文章id'       => 'require',
    ];

    public function sceneAdd()
    {
        return $this->only(['title','book_id']);
    }

    public function sceneEdit()
    {
        return $this->only(['id']);
    }
    public function sceneCount()
    {
        return $this->only(['error_count','id']);
    }
}