<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 16/1/27
 * Time: 11:00
 */

namespace Home\Controller;


class BuyController extends BaseController
{
    //002流水 后台用户充值
    public function pay()
    {
        if (IS_POST) {
            $level = I("post.pay_version");

            switch ($level) {
                case 0:
                    $level = "免费版";
                    break;
                case 1:
                    $level = "白金版";
                    break;
                case 2:
                    $level = "钻石版";
                    break;
            }

            $month = I("post.pay_num");
            $money = I("post.money");
            switch ($month) {
                case 1:
                    $period = "1个月";
                    $month = 1;
                    break;
                case 2:
                    $period = "3个月";
                    $month = 3;
                    break;
                case 3:
                    $period = "12个月";
                    $month = 12;
                    break;
            }

            $payment = I("post.charge_type");

            $payId = D("UserMemberPay")->add(array(
                "user_id" => session("homeId"),
                "payid" => "001" . date("ymdhis") . mt_rand(1, 9),
                "level" => $level,
                "period" => $period,
                "month" => $month,
                "money" => $money,
                "payment" => $payment,
                "status" => 0,
            ));

            if (I("post.pay_version") == 0) {
                $this->ajaxReturn(array("url" => U("Home/Buy/payFree", array("payId" => $payId))));
            } else {
                $this->ajaxReturn(array("url" => U("App/Pay/alipay", array("id" => $payId, "type" => 3))));
            }

        } else {
            $member = D("UserMember")->get(array("user_id" => session("homeId"), "status" => 1));
            if (I("get.type") == 1) {
                $this->assign("member", $member);
                $this->display();
            } else {
                if ($member) {
                    $this->redirect("Home/Buy/memberPayResult", array("id" => $member["id"]));
                } else {
                    $this->assign("member", $member);
                    $this->display();
                }
            }
        }
    }

    public function memberPayResult()
    {
        $id = I("get.id");

        $member = D("UserMember")->get(array("id" => $id));
        $this->assign("memberPay", $member);

        $this->display();
    }

    //免费版申请
    public function payFree()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["level"] = 0;
            $data["user_id"] = session("homeId");
            $data["shop_id"] = session("homeShopId");
            $data["status"] = 0;

            D("FreeApply")->add($data);

            $this->success("已提交审核", "Home/Buy/pay");
        } else {
            $this->display();
        }
    }
}