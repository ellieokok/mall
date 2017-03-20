<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/9/1
 * Time: 09:17
 */

namespace App\Controller;


class ArticalController extends BaseController
{
    public function _initialize()
    {
        C("DEFAULT_THEME", "");
        C("VIEW_PATH", "");
    }

    public function index()
    {
        if (!I("get.id")) {
            return;
        }
        $artical = D("Artical")->get(array("id" => I("get.id")), true, true);
        $this->assign("artical", $artical);

        $config = D("Config")->get();
        $this->assign("qrCode", $config['qrcode']);
        $this->display();
    }
}