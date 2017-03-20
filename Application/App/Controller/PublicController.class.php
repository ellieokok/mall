<?php
namespace App\Controller;

use Think\Controller;

class PublicController extends Controller
{
    public $appUrl = "";
    public function _initialize()
    {
        $this->appUrl = "http://" . I("server.HTTP_HOST");
    }

    public function login()
    {
        //登录
        $is_weixin = is_weixin();
        $config = D("Config")->get();
        if(!$is_weixin || !$config["oauth"]){
            $condition["phone"] = I("post.phone");
            $condition["password"] = md5(I("post.password"));
            $user = D("User")->get($condition);
            if ($user && $user["status"]) {
                session("userId", $user["id"]);
                //reset token
                // $user["token"] = getRandom(32);
                // D("User")->save($user);
    
                $this->ajaxReturn($user);
            }
        } 
    }

    public function register()
    {
        if(session("userId")){
            //微信绑定手机号，并加上密码
            $userb = D("User")->get(array("id"=>session("userId")));
            $userb["phone"] = I("post.phone");
            $userb["password"] = md5(I("post.password"));
            $user = D("User")->get(array("phone" => I("post.phone")));

            if(!session("smsVerify") == I("post.code")){
                $this->ajaxReturn(array("info" => "error", "msg" => "验证码错误", "status" => 0));
                return;
            }
            if ($user) {
                $this->ajaxReturn(array("info" => "error", "msg" => "该手机号已存在", "status" => 0));
                return;
            }

            $user_id = D("User")->save($userb);
            session("userId", $user_id);
            $this->ajaxReturn(array("info" => "success", "msg" => "绑定手机号成功", "status" => 1));
        }else{
            //网页端注册
            $data ["openid"] = "appOpenId_" . date("ymdhis") . mt_rand(100, 999);
            
            if(I("post.username")){
                $data ["username"] = I("post.username"); 
            }else{
                $data ["username"] = I("post.phone"); 
            }
            $data ["phone"] = I("post.phone");
            $data ["password"] = md5(I("post.password"));
            $data ["status"] = 1;
            $users = D("User")->get(array("phone" => I("post.phone")));

            if(!session("smsVerify") == I("post.code")){
                $this->ajaxReturn(array("info" => "error", "msg" => "验证码错误", "status" => 0));
                return;
            }

            //微信端
            $is_weixin = is_weixin();
            if($is_weixin){
                if ($users["sex"] > 0) {
                    $this->ajaxReturn(array("info" => "error", "msg" => "该手机号已绑定微信", "status" => 0));
                    return;
                }
                $user_id = $users["id"];
            }else{
                if ($users) {
                    $this->ajaxReturn(array("info" => "error", "msg" => "该手机号已存在", "status" => 0));
                    return;
                }
                $user_id = D("User")->add($data);
            }

            session("userId", $user_id);

            if($is_weixin){
                $config = D("Config")->get();
                if ($config["oauth"]) {
                    $weObj = D("WxConfig")->getWeObj();
                    $token = session("token");
                    if (!$token) {
                        $url = $weObj->getOauthRedirect($this->appUrl . __SELF__);
                        header("location: $url");
                        die();
                    } else {
                        $userInfo = $weObj->getOauthUserinfo($token["access_token"], $token["openid"]);
                        $user = D("User")->get(array("id" => $user_id));

                        $user["openid"] = $userInfo["openid"];
                        $user["username"] = $userInfo["nickname"];
                        $user["subscribe"] = 1;
                        $user["sex"] = $userInfo["sex"];
                        $user["language"] = $userInfo["language"];
                        $user["city"] = $userInfo["city"];
                        $user["province"] = $userInfo["province"];
                        $user["avater"]= $userInfo["headimgurl"];
                        $user["status"] = 1;
                        
                        D("User")->save($user);
                    }
                }
            }
            
            $this->ajaxReturn(array("info" => "success", "msg" => "注册成功", "status" => 1));

        }
    }

    public function oauthDebug()
    {
        $config = D("Config")->get();
        if ($config["oauth_debug"] && $config["oauth"]) {
            session("userId", 2);
        }
    }

    public function oauthLogin()
    {
        $this->oauthDebug();
        $is_weixin = is_weixin();
        if (!session("userId")) {
            if($is_weixin){
                $config = D("Config")->get();
                if ($config["oauth"]) {
                    $weObj = D("WxConfig")->getWeObj();
                    $token = $weObj->getOauthAccessToken();
                    if (!$token) {
                        $url = $weObj->getOauthRedirect($this->appUrl . __SELF__);
                        header("location: $url");
                        die();
                    } else {
                        $userInfo = $weObj->getOauthUserinfo($token["access_token"], $token["openid"]);
                        session("token",$token);
                        $usero = D("User")->get(array("openid" => $userInfo["openid"]));
                        if ($usero) {
                            if(!$usero["phone"]){
                                return;
                            }else{
                                $this->oauthRegister($userInfo);
                            }
                        } else {
                          return;
                        }    
                    }
                }else{
                    return;
                }
            }else{
                return;
            }    
        }

        $user = D("User")->get(array("id" => session("userId")), true);
        if ($user["status"] == 0) {
            $this->redirect("Empty/index");
            return;
        }

        return $user;                    

    }

    public function resetPassword()
    {    
        $data ["phone"] = I("post.phone");
        $data ["password"] = md5(I("post.password"));
        $user = D("User")->get(array("phone" => I("post.phone")));

        if(!session("smsVerify") == I("post.code")){
            $this->ajaxReturn(array("info" => "error", "msg" => "验证码错误", "status" => 0));
            return;
        }
        if (!$user) {
            $this->ajaxReturn(array("info" => "error", "msg" => "该手机号尚未注册", "status" => 0));
            return;
        }
        $user["password"] = $data ["password"];

        D("User")->save($user);
        $this->ajaxReturn(array("info" => "success", "msg" => "重置密码成功", "status" => 1));
    }
    
    public function sendSms(){
        $data = D("Sms")->get();
        sendSmsVerify($data["user"],$data["pass"],I("post.phone"));
        // $this->ajaxReturn(array("info" => "error", "msg" => "验证码错误", "status" => 0));
    }

    private function oauthRegister($userInfo)
    {
        $user = D("User")->get(array("openid" => $userInfo["openid"]));
        $data = array(
            "username" => $userInfo["nickname"],
            "subscribe" => 1,
            "sex" => $userInfo["sex"],
            "language" => $userInfo["language"],
            "city" => $userInfo["city"],
            "province" => $userInfo["province"],
            "avater" => $userInfo["headimgurl"],
            "status" => 1,
        );

        $userId = $user["id"]?$user["id"]:0;
        if ($user) {
            $data["id"] = $user["id"];
            D("User")->save($data);
        } else {
            $data["openid"] = $userInfo["openid"];
            $userId = D("User")->add($data);
        }

        session("userId", $userId);
    }

    public function logout()
    {
        D("User")->save(array("id" => session("userId"), "token" => ""));
        session(null);

        $this->ajaxReturn(array("info" => "success", "msg" => "注销成功", "status" => 1));
    }
}