<?php
/**
 * Created by DreamPHP.
 * User: Leruge
 * Date: 2018/4/5 0005
 * Time: 19:49
 * Email: leruge@163.com
 * Url: http://www.dreamphp.com.cn/
 */

namespace app\common\validate;
use think\Validate;

class Love extends Validate
{
    protected $rule = [
        'uid' => 'require|max:25',
        'artid' => 'require|max:25',
        'modename' => 'require|max:25',
    ];

    protected $message = [
      'uid.require' => '请登录后收藏',
      'artid.require'   => '系统错误，请稍后再试',
      'modename.require'  => '系统错误，请稍后再试',
    ];

    public function sceneClick()
    {
        return $this->only(['uid', 'artid','modename']);
    }
}