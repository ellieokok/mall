<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 09:40
 */

namespace Addons\Wheel\Controller;

// class IndexController extends InitController
// {
//     public function index()
//     {
//         $this->show('SystemInfo Index index');
//     }


// }

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
        //     $weObj = $this->init();
        //     $token = $weObj->getOauthAccessToken();
        //     if (!$token) {
        //         $weObj = $this->init();
        //         $url = $weObj->getOauthRedirect($this->appUrl . u_addons('Wheel://App/Index/index'));
        //         header("location: $url");
        //         return;
        //     } else {
        //         $wxuser = $weObj->getOauthUserinfo($token["access_token"], $token["openid"]);
        //         session("userUid", $wxuser["openid"]);
        //         $this->oauthRegister($wxuser);
        //     }
        // }

        $user = M("User")->where(array("uid" => session("userUid")))->find();

        $config = M("AddonWheelConfig")->find();
        $this->assign("config", $config);
        $this->assign("user", $user);

        $record = M("AddonWheelRecord")->where(array("user_id" => session("userId")))->order("id desc")->find();
        $this->assign("record", $record);
        $this->display();
    }

    /**
     * 中奖机率计算
     */
    function lotteryJson()
    {
        $today = date("Y-m-d");
        $where["time"] = array("like", $today . "%");
        $where["user_id"] = session("userId");
        $record = D("Addons://Wheel/AddonWheelRecord")->where($where)->find();
        if ($record) {
            $this->ajaxReturn("-1");
            return;
        }

        $config = M("AddonWheelConfig")->find();
        //奖品概率
        $proArr = array(
            '1' => $config["level1_prob"], //'罗浮山门票'
            '2' => $config["level2_prob"], //'罗浮山嘉宝田温泉体验券'
            '3' => $config["level3_prob"], //'精美旅游书籍《山水酿惠州》'
            '4' => $config["level4_prob"], //'碧海湾漂流门票'
            '5' => $config["level5_prob"], //'南昆山门票'
            '6' => $config["level6_prob"], //'云顶温泉精美礼品'
            '7' => $config["level7_prob"]
        );
        //奖品库存
        $proCount = array(
            '1' => $config["level1_store"],
            '2' => $config["level2_store"],
            '3' => $config["level3_store"],
            '4' => $config["level4_store"],
            '5' => $config["level5_store"],
            '6' => $config["level6_store"],
            '7' => $config["level7_store"]
        );
        $file = './Data/wheel.txt';
        $data = array(
            '1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0
        );
        if (!file_exists($file)) {
            file_put_contents($file, serialize($data));
        } else {
            $str = file_get_contents($file);
            $data = unserialize($str);
        }
        $rid = $this->getRand($proArr, $proCount);

        if ($rid > 6) {
            $rid = 0;
        } else {
            $rid = $this->returnRid($rid, $file, $data, $proCount, $proArr);
        }

        M("AddonWheelRecord")->add(array("user_id" => session("userId"), "level" => $rid));
        echo $rid;
    }

    function returnRid($rid, $file, $data, $proCount, $proArr)
    {
        $data[$rid] = $data[$rid] + 1;
        $count = $proCount[$rid]; // 总库存
        if ($count < $data[$rid]) {
            // 如果抽取的数据大于总库存时库存清0
            $proCount[$rid] = 0;
            // 然后继续计算一直计算出某个值的库存不为0
            $rid = returnRid($rid, $file, $data, $proCount, $proArr);
        } else {
            // 写入缓存
            file_put_contents($file, serialize($data));
        }
        return $rid;
    }

    /**
     * 中奖概率计算, 能用
     * $proArr = array('1'=>'概率', '2'=>'概率');
     * $proCount = array('1'=>'库存', '2'=>'库存');
     */
    function getRand($proArr, $proCount)
    {
        $result = '';
        $proSum = 0;
        foreach ($proCount as $key => $val) {
            if ($val <= 0) {
                continue;
            } else {
                $proSum = $proSum + $proArr[$key];
            }
        }
        foreach ($proArr as $key => $proCur) {
            if ($proCount[$key] <= 0) {
                continue;
            } else {
                $randNum = mt_rand(1, $proSum);
                if ($randNum <= $proCur) {
                    $result = $key;
                    break;
                } else {
                    $proSum -= $proCur;
                }
            }
        }
        unset($proArr);
        return $result;
    }
}
