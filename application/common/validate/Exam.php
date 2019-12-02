<?php
/**
 * 500与这个文件没有关系
 * User: Leruge
 * Date: 2018/4/5 0005
 * Time: 17:12
 */
namespace app\common\validate;
use think\Validate;

class Exam extends Validate
{
    protected $rule = [
        'title|文章标题'    => 'require',
        'book_id|所属科目'  => 'require',
        'answer|答案'     => 'require',
        'analysis|解析'   => 'require',
        'option|选项'     => 'require',
        'error_count|本题的错误次数' => 'require',
        'id|文章id'       => 'require',
    ];

    public function sceneAdd()
    {
        return $this->only(['title','answer','book_id','analysis']);
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