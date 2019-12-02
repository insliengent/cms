<?php
namespace app\common\validate;
use think\Validate;

class Video extends Validate
{
  protected $rule = [
    'title|文章标题'      => 'require|unique:video',
    'book_id|分类'    => 'require',
    'video_link|视频链接' => 'require',
    'content|内容'      => 'require',
    'id|文章id'         => 'require',
  ];

    public function sceneAdd()
    {
      return $this->only(['title','book_id','video_link','content']);
    }

    public function sceneEdit()
    {
      return $this->only(['id','book_id','video_link','content']);
    }
    public function sceneDel()
    {
        return $this->only(['id']);
    }
}