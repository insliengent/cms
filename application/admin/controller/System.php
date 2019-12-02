<?php
namespace app\admin\controller;
use think\Model;
use think\model\Collection;
use think\Db;
class System extends Base
{
    protected $autoWriteTimestamp = false;
    public function webset()
    {
        $sys = Db::name('system')->select();
        $sys = array_column($sys, 'sys_value', 'sys_key');
        $viewData = [
            'sys' => $sys
        ];
        $this->assign($viewData);
        return view();
    }

    public function set()
    {
        if (request()->isAjax()) {
            $arr = input('post.');
            $i=0;
            foreach ($arr as $key => $value){
                $i++;
                $data[$i]['sys_key'] = $key;
                $data[$i]['sys_value'] = $value;
            }
            $result = model('system')->edit($data);
            if ($result == 1) {
                $this->success('修改成功！', 'admin/system/webset');
            }else {
                $this->error($result);
            }
        }

        $sys = Db::name('system')->select();
        $sys = array_column($sys, 'sys_value', 'sys_key');
        $viewData = [
            'sys' => $sys
        ];
        $this->assign($viewData);
        return view();
    }
}
