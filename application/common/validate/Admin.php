<?php
namespace app\common\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username|用户名' => 'require',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'email|邮箱' => 'require|email|unique:admin',
        'status|状态' => 'require',
        'phone|手机' => 'require|regex:1[3-8]{1}[0-9]{9}',
        'super|权限' => 'require',
        'nickname|昵称' => 'require',
        'oldpass|原密码' => 'require',
        'newpass|新密码' => 'require'
    ];

    public function sceneLogin()
    {
        return $this->only(['phone', 'password']);
    }

    public function sceneRegister()
    {
        return $this->only(['username', 'password', 'conpass', 'email'])
            ->append('username', 'unique:admin');
    }

    public function sceneForget()
    {
        return $this->only(['email'])->remove('email', 'unique');
    }

    public function sceneAdd()
    {
        return $this->only(['username', 'password', 'status', 'super'])
            ->append('username', 'unique:admin');
    }

    public function sceneEdit()
    {
        return $this->only(['oldpass', 'newpass', 'nickname']);
    }
}