<?php
namespace Ext\Controller;

class ConfigController extends BaseController
{
    public function getConfig()
    {
        $config = D("Config")->get();
        $this->ajaxReturn($config);
    }

    public function addConfig()
    {
        $data = I("post.");
        $data["id"] = 1;
        D("Config")->add($data);
        $this->ajaxReturn(array("info" => "success", "msg" => "操作成功", "status" => 1));
    }

}