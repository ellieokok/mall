<?php
namespace Admin\Controller;

class OrderController extends BaseController
{
    public function order()
    {
//        每页显示的记录数
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Admin/Order/order/page/" . $p);

        $condition = array();
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
        $orderList = D("Order")->getList($condition, true, "id desc", $p, $num);
        $this->assign("orderList", $orderList);

        $count = D("Order")->getMethod($condition, "count");// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出

        $productList = D("Product")->getList(array(), true);
        $this->assign('productList', $productList);// 赋值分页输出

        $this->display();
    }

    public function search()
    {
        $condition = array();
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

        $orderList = D("Order")->getList($condition, true, "id desc");

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

        $productList = D("Product")->getList(array(), true);
        $this->assign('productList', $productList);// 赋值分页输出

        $this->assign("orderPost", I("post."));
        $this->assign("orderList", $orderList);
        $this->display("order");
    }

    public function update()
    {
        $data = I("get.");
        $data["id"] = array("in", $data["id"]);
        D("Order")->save($data);

        $this->success("操作成功", cookie("prevUrl"));
    }

    public function export()
    {
        $condition = array();
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

        $order = D('Order')->getList($condition, true, "id desc");
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
        \Excel::export($order);
    }
}