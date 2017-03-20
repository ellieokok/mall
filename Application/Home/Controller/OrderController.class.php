<?php
namespace Home\Controller;

class OrderController extends BaseController
{
    public function order()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Home/Order/order/page/" . $p);

        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $data = I("get.");
        if ($data["status"] != "") {
            array_push($condition, array(
                "status" => $data["status"]
            ));
        }
        if ($data["pay_status"] != "") {
            array_push($condition, array(
                "pay_status" => $data["pay_status"]
            ));
        }
        if ($data["day"] != "") {
            array_push($condition, array(
                "time" => array("like", $data["day"] . "%")
            ));
        }

        $orderList = D("Order")->getOrderList($condition, true, "id desc", $p, $num);
        $this->assign("orderList", $orderList);

        $count = D("Order")->getOrderListCount($condition);// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出

        $productList = D("Product")->getProductList(array("shop_id" => session("homeShopId")), true);
        $this->assign('productList', $productList);// 赋值分页输出

        $this->display();
    }

    public function search()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        if (I("post.id")) {
            array_push($condition, array("id" => I("post.id")));
        }
        if (I("post.orderid")) {
            array_push($condition, array("orderid" => I("post.orderid")));
        }
        if (I("post.user_id")) {
            array_push($condition, array("user_id" => I("post.user_id")));
        }
        if (I("post.payment") != -10) {
            array_push($condition, array("payment" => I("post.payment")));
        }
        if (I("post.pay_status") != -10) {
            array_push($condition, array("pay_status" => I("post.pay_status")));
        }
        if (I("post.status") != -10) {
            array_push($condition, array("status" => I("post.status")));
        }

        if (I("post.timeRange")) {
            $timeRange = I("post.timeRange");
            $timeRange = explode(" --- ", $timeRange);
            array_push($condition, array("time" => array('between', array($timeRange[0], $timeRange[1]))));
        }

        $orderList = D("Order")->getOrderList($condition, true, "id desc");

        if (I("post.product_id") != -10) {
            foreach ($orderList as $key => $value) {
                $flag = true;
                foreach ($value["detail"] as $k => $v) {
                    if ($v["product_id"] == I("post.product_id")) {
                        $flag = false;
                        break;
                    }
                }

                if ($flag) {
                    unset($orderList[$key]);
                }
            }
        }

        $productList = D("Product")->getProductList(array(), true);
        $this->assign('productList', $productList);// 赋值分页输出

        $this->assign("orderPost", I("post."));
        $this->assign("orderList", $orderList);
        $this->display("order");
    }

    public function update()
    {
        $data = I("get.");
        $id = $data["id"];
        unset($data["id"]);
        D("Order")->updateAllOrder($id, $data);

        //发货通知
        if (I("get.status") == 1) {
            $ids = explode(",", I("get.id"));
            
            $orderModel = D("Order");
            foreach ($ids as $key => $value) {
                $order = $orderModel->getOrder(array("id" => $value));
                
                $getUrl = "http://" . I("server.HTTP_HOST") . U("Admin/Wechat/sendTplMsgDeliver", array("order_id" => $value, "shopId" => $order["shop_id"]));
                // 先暂时注销
                http_get($getUrl);
            }
        } elseif (I("get.status") == 2) {
            $orders = D("Order")->getOrderList(array("id" => array("in", $id)));
            foreach ($orders as $key => $value) {
                if ($value["payment"] == 3) {
                    D("Order")->where(array("id" => $value["id"]))->save(array("pay_status" => 1));
                }
            }
        }

        $this->success("操作成功", cookie("prevUrl"));
    }

    public function export()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $data = I("get.");
        if ($data["status"] != "") {
            array_push($condition, array(
                "status" => $data["status"]
            ));
        }
        if ($data["get.pay_status"] != "") {
            array_push($condition, array(
                "pay_status" => $data["pay_status"]
            ));
        }
        if ($data["day"] != "") {
            array_push($condition, array(
                "time" => array("like", $data["day"] . "%")
            ));
        }
        if ($data["id"] != "") {
            array_push($condition, array(
                "id" => array("in", $data["id"])
            ));
        }

        $order = D('Order')->getOrderList($condition, true, "id desc");
        foreach ($order as $key => $value) {
            unset($value["contact"]["id"]);
            unset($value["contact"]["user_id"]);
            unset($value["contact"]["time"]);

            foreach ($value["contact"] as $k => $v) {
                $order[$key][$k] = $v;
            }
            unset($order[$key]["contact"]);

            $detail = '';
            foreach ($value["detail"] as $k => $v) {
                $detail .= $v["name"] . "[属性:" . $v["attr"] . "]" . "[数量:" . $v["num"] . "]" . "[价格:" . $v["price"] . "],";
            }

            $order[$key]["detail"] = $detail;
        }

        Vendor("PHPExcel.Excel#class");
        \Excel::export($order, array('订单ID', '店铺ID', '用户ID', '联系人ID', '订单编号', '总价格', '支付方式', '支付状态', '配送时间', '运费', '折扣', '备注', '状态', '是否评论', '时间', '用户', '订单详情', '店铺', '订单人', '联系方式', '省份', '城市', '地域', '详细地址', '邮编'));
    }

    // public function test(){
    //     wxPrint(134);
    // }

    public function wxPrint()
    {
        $ids = explode(",", I("get.id"));
        foreach ($ids as $key => $value) {
            wxPrint($value);
        }

        $this->success("操作成功", cookie("prevUrl"));
    }
}