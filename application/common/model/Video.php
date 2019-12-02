<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Video extends Model
{
    use SoftDelete;

    public function videolist()
    {
        $Videos = new Video;
        $arts = $Videos->select();
        return $arts;
        return view();
    }

    public function videoCate()
    {
        return $this->belongsTo('book', 'book_id', 'id');
    }

    public function edit($data)
    {
        $validate = new \app\common\validate\Video();
       if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $update = $this->allowField(true)->isUpdate(true)->save($data);
        if ($update) {
            return '修改成功!';
        }else {
            return '修改失败！';
        }
    }

    public function add($data)
    {
       $validate = new \app\common\validate\Video();
        if (!$validate->scene('Add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return '内容添加成功';
        }else {
            return '内容添加失败';
        }
    }

    public function count($data)
    {
       $validate = new \app\common\validate\Video();
        if (!$validate->scene('Count')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return '内容添加成功';
        }else {
            return '内容添加失败';
        }
    }
}
