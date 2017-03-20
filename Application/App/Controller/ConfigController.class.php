<?php
namespace App\Controller;

class ConfigController extends BaseController
{
    public function getConfig()
    {
        $config = D("Config")->get();
        $this->ajaxReturn($config);
    }

}