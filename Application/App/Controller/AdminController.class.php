<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/8
 * Time: 12:01
 */

namespace App\Controller;

class AdminController extends BaseController
{

    public function order()
    {
        $user = R("App/Public/oauthLogin");

        $shop = D("Shop")->getShop(array("id" => I("get.shopId")));
        $employee = explode(',', $shop["employee"]);

        $flag = false;
        foreach ($employee as $key => $value) {
            if ($value == $user["id"]) {
                $flag = true;
            }
        }

        if ($user && $flag) {
            $this->assign("user", $user);

            $order = D('Order')->getOrderList(array("shop_id" => I("get.shopId"), "status" => array("egt", 0)), true);
            $this->assign("order", $order);// 赋值数据集

            $this->display();
        } else {
            $this->show("no access");
        }
    }

    public function orderCancel()
    {
        $data ["status"] = "-1";
        $data ["id"] = $_GET ["id"];
        M("Order")->save($data);
    }

    public function orderDel()
    {
        M("Order")->where(array("id" => $_GET["id"]))->delete();
    }

    public function orderPublish()
    {
        $data ["status"] = "1";
        $data ["id"] = $_GET ["id"];
        M("Order")->save($data);
        
        $order = D("Order")->getOrder(array("id" => $_GET ["id"]));
        $getUrl = "http://" . I("server.HTTP_HOST") . U("Admin/Wechat/sendTplMsgDeliver", array("order_id" => $_GET ["id"], "shopId" => $order["shop_id"]));
        http_get($getUrl);
    }

    public function orderPayComplete()
    {
        $data ["pay_status"] = "1";
        $data ["id"] = $_GET ["id"];
        M("Order")->save($data);

    }

    public function orderComplete()
    {
        $data ["status"] = "2";
        $data ["id"] = $_GET ["id"];
        M("Order")->save($data);
    }
}