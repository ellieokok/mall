<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 09:40
 */

namespace Addons\Vote\Controller;

class IndexController extends InitController
{
    public $appUrl = "";
    public function __construct()
    {
        parent::__construct();
        $this->appUrl = "http://" . I("server.HTTP_HOST");
    }

    public function init()
    {
        return R("App/Common/init");
    }

    public function oauthRegister($wxuser)
    {
        return R("App/Common/oauthRegister", array($wxuser));
    }

    public function index()
    {
        $user=R("App/Public/oauthLogin");

        // if (!session("userUid")) {
            // $weObj = $this->init();
            // $token = $weObj->getOauthAccessToken();
            // if (!$token) {
            //     $weObj = $this->init();
            //     $url = $weObj->getOauthRedirect($this->appUrl . u_addons('Vote://App/Index/index'));
            //     header("location: $url");
            //     return;
            // } else {
            //     $wxuser = $weObj->getOauthUserinfo($token["access_token"], $token["openid"]);
            //     session("userUid", $wxuser["openid"]);
            //     $this->oauthRegister($wxuser);
            // }
        // }

        // $user = M("User")->where(array("uid" => session("userUid")))->find();

        $config = M("AddonVoteConfig")->find();
        $this->assign("config", $config);
        $this->assign("user", $user);

        M("AddonVoteConfig")->where(array("id"=>$config["id"]))->setInc("visiter_num");
        $this->display();
    }

    public function vote()
    {
        $username=M('User')->where(array("id"=>session("userId")))->find();
       
        M("AddonVoteRecord")->add(array("user_id"=>session("userId"),"username"=>$username['username']));
        M("AddonVoteConfig")->where(array("id"=>I("get.id")))->setInc("vote_num");
    }
}
