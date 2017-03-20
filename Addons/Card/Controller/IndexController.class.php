<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 09:40
 */

namespace Addons\Card\Controller;

class IndexController extends InitController
{
     public function index()
    {
        $user = R("App/Public/oauthLogin");
        $this ->assign("user",$user);

        $config = M("AddonCardConfig")->find();
        $this->assign("config", $config);
        $this->display('', false);
    }

}