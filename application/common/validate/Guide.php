<?php
namespace app\common\validate;
use think\Validate;
class Guide extends Validate
{
    protected $rule = [
        'title|标题' => 'require|unique:Guide',
        'seo_title|SEO标题' => 'require',
        'content|正文' => 'require',
        'id|id' => 'require',
    ];

    public function sceneAdd()
    {
        return $this->only(['title','seo_title','content']);
    }
    public function sceneEdit()
    {
       return $this->only(['title','seo_title','content']);
    }
    public function sceneSort()
    {
        return $this->only(['id']);
    }


}