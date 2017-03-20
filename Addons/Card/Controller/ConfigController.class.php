<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 09:40
 */

namespace Addons\Card\Controller;

class ConfigController extends InitController
{
    public function index()
    {
        $config = M("AddonCardConfig")->find();
        $this->assign("config", $config);
        $this->display();
    }

    public function add()
    {
        $data = I("post.");
        M("AddonCardConfig")->where(array("id" => 1))->save($data);
        $this->success("保存成功", "Admin/Config/index/addon/Card");
    }

}