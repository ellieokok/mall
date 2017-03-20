<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 09:40
 */

namespace Addons\Apply\Controller;

class IndexController extends InitController
{
    public $appUrl = "";
    public function __construct()
    {
        parent::__construct();
        $this->appUrl = "http://" . I("server.HTTP_HOST");
    }


    public function index()
    {
        $user = R("App/Public/oauthLogin");
        // $this->assign("user",$user);
        

        $config = M("AddonApplyConfig")->where(array("status" => 1))->find();
        // print_r(explode(',',$config["event"]));
        $this->assign("event", explode(',',$config["event"]));
        $this->assign("config", $config);

        $contact = M("Contact")->where(array("user_id" => $user["id"]))->find();
        if ($contact) {
            $this->assign("contact", $contact);
        }

        M("AddonApplyConfig")->where(array("id" => 1))->setInc("visiter");

        $this->assign('user', $user);// 赋值分页输出
        $this->display();
    }

    public function addConfig()
    {
        M("AddonApplyConfig")->where(array("id" => "1"))->save($_POST);
    }

    public function addOrder()
    {
   

        $userHas = M("AddonApplyContact")->where(array("user_id" => session("userId")))->find();

        if ($userHas) {
            $contact ["id"] = $userHas ["id"];
            $contact ["user_id"] = session("userId");
            $contact ["name"] = $_POST ["name"];
            $contact ["address"] = $_POST ["address"];
            M("AddonApplyContact")->save($contact);
        } else {
            $contact ["user_id"] = session("userId");
            $contact ["name"] = $_POST ["name"];
            $contact ["city"] = "";
            $contact ["area"] = "";
            $contact ["address"] = $_POST ["address"];
            M("AddonApplyContact")->add($contact);
        }
        $userHas = M("AddonApplyContact")->where(array("user_id" => session("userId")))->find();
        $contact_id = $userHas["id"];

        $config = M("AddonApplyConfig")->find();

        $data ["user_id"] = session("userId");
        $data ["contact_id"] = $contact_id;
        $data ["name"] = $_POST ["name"];
        $data ["phone"] = $_POST ["phone"];
        $data ["note"] = $_POST ["note"];
        $data ["event"] = $_POST["event"];
        $data ["time"] = date("Y-m-d H:i:s");
        $result = M("AddonApplyRecord")->add($data);

        M("AddonApplyConfig")->where(array("id" => 1))->setInc("apply");
        if ($result) {
            $this->ajaxReturn($result);
        }
    }


}