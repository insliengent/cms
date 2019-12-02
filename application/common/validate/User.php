<?php
namespace app\common\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username|用户名' => 'require|length:5,20|unique:user|chsDash',
        'email|邮箱'     => 'require|email|unique:user',
        'phone|手机' => 'require|regex:1[3-8]{1}[0-9]{9}',
        'password|密码'  => 'require|min:6',
        'conpass|确认密码' => 'require|confirm:password',
        'status|状态'    => 'require',
        'oldpass|原密码'  => 'require',
        'newpass|新密码'  => 'require|min:6',
        'nickname|昵称'  => 'chsDash|max:32|unique:user',
        'verify|验证码'   => 'require|captcha'
    ];

    public function sceneAdd()
    {
        return $this->only(['username', 'password','email','conpass']);
    }

    public function sceneEdit()
    {
        return $this->only(['oldpass', 'newpass', 'nickname']);
    }

    public function sceneLogin()
    {
        return $this->only(['phone', 'password'])
            ->remove('phone', 'unique');
    }

    public function sceneRegister()
    {
        return $this->only(['username', 'email', 'password', 'conpass']);
    }
}