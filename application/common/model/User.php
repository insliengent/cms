<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
use think\facade\Cookie;

class User extends Model
{
    use SoftDelete;

    protected $readonly = [
        'username',
        'email'
    ];

    public function exam()
    {
        return $this->hasMany('Exam', 'examid', 'id');
    }

    public function add($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $data['nickname'] = $data['username'];
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '添加失败！';
        }
    }

    public function edit($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $UserInfo = $this->find($data['id']);
        if ($UserInfo['password'] != $data['oldpass']) {
            return '原密码不正确！';
        }
        $UserInfo->password = $data['newpass'];
        $UserInfo->nickname = $data['nickname'];
        $result = $UserInfo->save();
        if ($result) {
            return 1;
        }else {
            return '操作失败！';
        }
    }

    public function login($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }
        unset($data['verify']);
        $result = $this->where($data)->find();
        if ($result) {
            if ($result['status'] != 1) {
                return '账号被禁用，无法登录！';
            }else {
                $phone = $result['phone'];
                $uid =$result['id'];
                Cookie::forever('uid', base64_encode($uid));
                return 1;
            }
        }else {
            return '用户名或者密码错误！';
        }
    }

    public function register($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }
        $data['nickname'] = $data['username'];
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '注册失败！';
        }
    }
}
