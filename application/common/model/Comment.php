<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    use SoftDelete;

/*    public function exam()
    {
        return $this->belongsTo('Exam', 'examid', 'id');
    }

    public function member()
    {
        return $this->belongsTo('User', 'uid', 'id');
    }
*/
    public function add($data)
    {
        $validate = new \app\common\validate\Comment();
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '评论失败！';
        }
    }
}
