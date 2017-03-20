<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 09:40
 */

namespace Addons\Sign\Controller;

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

        $user = R("App/Public/oauthLogin");

        // $user = M("User")->where(array("uid" => session("userUid")))->find();
        $contact = M("Contact")->where(array("user_id" => $user["id"]))->find();
        if ($contact) {
            $this->assign("contact", $contact);
        }
        $config = M("Config")->find();
        $this->assign("config", $config);
        $this->assign("user", $user);

        $product = M("addonScore")->select();
        $this->assign("product", $product);
        $this->display();
    }

    public function addOrder()
    {
        // $user = M("User")->where(array("uid" => session("userUid")))->find();
        $user = M("User")->where(array("id" => session("userId")))->find();
        $score = floatval($user["score"]) - floatval($_POST["score"]);
        if ($score >= 0) {
            M("User")->where(array("id" => $user["id"]))->save(array("score" => $score));
        } else {
            return;
        }

        $userHas = M("Contact")->where(array("user_id" => session("userId")))->find();
        if ($userHas) {
            $contact ["id"] = $userHas ["id"];
            $contact ["user_id"] = session("userId");
            $contact ["name"] = $_POST ["name"];
            $contact ["phone"] = $_POST ["phone"];
            $contact ["address"] = $_POST ["address"];
            M("Contact")->save($contact);
        } else {
            $contact ["user_id"] = session("userId");
            $contact ["name"] = $_POST ["name"];
            $contact ["city"] = "";
            $contact ["area"] = "";
            $contact ["phone"] = $_POST ["phone"];
            $contact ["address"] = $_POST ["address"];
            M("Contact")->add($contact);
        }
        $userHas = M("Contact")->where(array("user_id" => session("userId")))->find();
        $contact_id = $userHas["id"];

        $data ["user_id"] = session("userId");
        $data ["contact_id"] = $contact_id;
        $data ["orderid"] = date("ymdhis") . mt_rand(1, 9);
        $data ["totalscore"] = $_POST["score"];
        $data ["status"] = 0;
        $data ["note"] = $_POST ["note"];
        $data ["time"] = date("Y-m-d H:i:s");
        $data ["score_id"] = $_POST ["id"];
        $result = M("AddonScoreOrder")->add($data);
        if ($result) {
            $this->ajaxReturn($result);
        }
    }
    public function sign(){
        $today = date("Y-m-d");
        $where["time"] = array("like", $today . "%");
        $where["user_id"] = session("userId");
        $record = D("Addons://Sign/AddonSignRecord")->where($where)->find();
        if ($record) {
            $this->ajaxReturn(array("status" => 0));
            return;
        }

        $user = M("User")->where(array("id" => session("userId")))->find();

        $count = 0;
        do{
            $count++;
            $yesterday = date("Y-m-d", strtotime("-$count day"));
            $where["time"] = array("like", $yesterday . "%");
            $record = D("AddonSignRecord")->where($where)->find();
        } while ($record);
        $continue_sign = $count-1;

        $config = M("AddonSignConfig")->find();
        if ($config) {
            $addScore = floatval($continue_sign) * floatval($config["continue_sign"]) + floatval($config["first_sign"]);
            M("AddonSignRecord")->add(array("user_id" => session("userId"), "score" => $addScore));

            $score = floatval($user["score"]) + $addScore;
            M("User")->where(array("id" => $user["id"]))->save(array("score" => $score));
            $this->ajaxReturn(array("status" => 1, "score" => $addScore));
        }
    }

}
