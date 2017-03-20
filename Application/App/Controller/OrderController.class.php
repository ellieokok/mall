<?php
namespace App\Controller;

class OrderController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();

        $isLogin = $this->is_login();
        if (!$isLogin) {
            $this->ajaxReturn(array("info" => "error", "msg" => "未登陆", "status" => 0));
        }
    }

    public function getOrderList()
    {
        $order = D("Order")->getList(array("user_id" => session("userId")), true, "id desc");
        $this->ajaxReturn($order);
    }

    public function getOrder()
    {
        $order = D("Order")->get(array("id" => I("get.id"), "user_id" => session("userId")), true);
        $this->ajaxReturn($order);
    }

    private function updateUserMoney($userId, $money)
    {
        $user = D("User")->get(array("id" => $userId));
        $balance = floatval($user["money"]) + floatval($money);
        if ($balance >= 0) {
            D("User")->save(array("id" => $userId, "money" => $balance));
            return true;
        } else {
            return false;
        }
    }

    private function checkStore($cartdata)
    {
        $product = D("Product");
        foreach ($cartdata as $key => $value) {
            $result = $product->get(array("id" => $value["id"]));
            if ($result["status"] == 0 || $result["status"] == -1) {
                return false;
            }

            if ($result["store"] > 0) {
                if (floatval($result["store"]) < floatval($value["num"])) {
                    return false;
                }
            }
        }
        return true;
    }

    public function addOrder()
    {
        if (!$this->checkStore(I("post.cartData"))) {
            return false;
        }

        $payFlag = false;
        $order = I("post.order");
        if ($order["payment"] == "0") {
            $payFlag = $this->updateUserMoney(session("userId"), -$order["totalprice"]);
        }

        if (I("post.contact_id")) {
            $contact_id = I("post.contact_id");
        } else {
            $contact = I("post.contact");
            $contact["user_id"] = session("userId");
            $contact_id = D("Contact")->add($contact);
        }
        //add order
        $order ["user_id"] = session("userId");
        $order ["orderid"] = date("ymdhis") . mt_rand(1, 9);
        if ($payFlag) {
            $order ["pay_status"] = 1;
        } else {
            $order ["pay_status"] = 0;
        }
        $order ["status"] = 0;

        // $config = D("Config")->get();
        // $order ["freight"] = $config["freight"];
        $order ["time"] = date("Y-m-d H:i:s");
        $order_id = D("Order")->add($order);

        //add order_detail
        $cartdata = I("post.cartData");
        $detailAll = array();
        $product = D("Product");
        $scoreInc = 0;
        foreach ($cartdata as $key => $value) {
            $detail = array();
            $detail["order_id"] = $order_id;
            $detail["product_id"] = $value["id"];
            $detail["user_id"] = session("userId");
            $detail["name"] = $value["name"];
            $detail["sku_id"] = isset($value["sku_id"]) ? $value["sku_id"] : "";
            $detail["sku_name"] = isset($value["sku_name"]) ? $value["sku_name"] : "";
            $detail["num"] = $value["num"];
            $detail["price"] = $value["price"];

            $getProduct = $product->get(array("id" => $value["id"]));
            $detail["file_id"] = $getProduct["file_id"];
            $scoreInc += floatval($getProduct["score"]);

            array_push($detailAll, $detail);
        }
        M("OrderDetail")->addAll($detailAll);

        //update user
        $user = D("User");
        $user->where(array("id" => session("userId")))->setInc("buy_num");
        $user->where(array("id" => session("userId")))->setInc("score", $scoreInc);

        //统计
        $newBuyUser = 0;
        $buyUser = $this->get(array("user_id" => session("userId")));
        if ($buyUser) {
            $newBuyUser = 1;
        }
        D("Analysis")->add(1, floatval($order ["totalprice"]), 0, $newBuyUser);

        //同步contact order
        $contact = D("Contact")->get(array("id" => $contact_id));
        unset($contact["id"]);
        $contact["order_id"] = $order_id;
        D("OrderContact")->add($contact);

        $order = D("Order")->get(array("id" => $order_id), true);
        request_by_fsockopen($this->appUrl . U("Admin/Wechat/sendTplMsgOrder"), array("user_id" => session("userId"), "order_id" => $order_id));

        if ($order["payment"] == 1) {
            $wxConfig = D("WxConfig")->get();
            if ($wxConfig["switch"] == 0) {
                file_put_contents('1.txt',U("Pay/wxPay", array("id" => $order_id)));
                $order["payUrl"] = U("Pay/wxPay", array("id" => $order_id));
            } else {
                $order["payUrl"] = U("Pay/wxQrcodePay", array("id" => $order_id));
                $order["payUrlMent"] = 1;
            }
        } elseif ($order["payment"] == 2) {
            $order["payUrl"] = U("Pay/alipay", array("id" => $order_id,"shop_id" => $order["shop_id"]));
        }

        $this->ajaxReturn($order);
    }

    public function updateOrder()
    {
        D("Order")->save(I("get."));
    }

    public function commentOrder()
    {
        $orderDetail = D("OrderDetail")->getList(array("order_id" => I("post.id")));
        $user = D("User")->get(array("id" => session("userId")), true);

        $addAll = array();
        foreach ($orderDetail as $key => $value) {
            $data = array();
            $data ["shop_id"] = session("shop_id");
            $data ["product_id"] = $value["product_id"];
            $data ["user_id"] = session("userId");
            $data ["user_name"] = $user["username"];
            $data ["name"] = I("post.name");
            array_push($addAll, $data);
        }
        D("Comment")->addAll($addAll);
        $data["msg"] = "评论成功";
        $this->ajaxReturn($data);
    }










}