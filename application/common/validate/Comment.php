<?php
namespace app\common\validate;
use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'content|评论内容' => 'require',
        'tablename|内部错误' => 'require'
    ];

    public function sceneAdd()
    {
        return $this->only(['content', 'tablename']);
    }
}