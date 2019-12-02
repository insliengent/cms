<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Exam extends Model
{
  use SoftDelete;
    public function cate()
    {
        return $this->belongsTo('Book', 'book_id', 'id');
    }
    public function lst()
    {
        $exams = new Exam;
        $arts = $exams->select();
        return $arts;
        return view();
    }

    public function edit($data)
    {
        $validate = new \app\common\validate\Exam();
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
       $validate = new \app\common\validate\Exam();
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
       $validate = new \app\common\validate\Exam();
        if (!$validate->scene('Count')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return '更新错误统计成功';
        }else {
            return '更新错误统计失败';
        }
    }
}
