<?php
namespace Ext\Controller;

class OrderController extends BaseController
{
    public function order()
    {
        $num = I("get.num") ? I("get.num") : 25;
        $p = I("get.page") ? I("get.page") : 1;

        $condition = array();
        $search = trim(I("get.search"));

        if ($search) {
            switch ($search) {
                case "未支付":
                    $search = 0;
                    break;
                case "已支付":
                    $search = 1;
                    break;
                case "未发货":
                    $search = 0;
                    break;
                case "已发货":
                    $search = 1;
                    break;
                case "待评价":
                    $search = 3;
                    break;
                case "退货中":
                    $search = -2;
                    break;
                case "退货完成":
                    $search = -3;
                    break;
                case "交易完成":
                    $search = 2;
                    break;
                case "交易取消":
                    $search = -1;
                    break;
                case "支付宝":
                    $search = 2;
                    break;
                case "支付宝支付":
                    $search = 2;
                    break;
                case "微信":
                    $search = 1;
                    break;
                case "微信支付":
                    $search = 1;
                    break;
            }

            $condition["id"] = $search;
            $condition["user_id"] = $search;
            $condition["status"] = $search;
            $condition["orderid"] = $search;
            $condition["pay_status"] = $search;
            $condition["payment"] = $search;
            $condition["_logic"] = "OR";
        }

        $orderList = D("Order")->getList($condition, true, "id desc", $p, $num);
        $count = D("Order")->getMethod($condition, "count");

        $this->ajaxReturn(array("total" => $count, "rows" => $orderList));
    }

    public function update()
    {
        $data = I("get.");
        $data["id"] = array("in", $data["id"]);
        D("Order")->save($data);

        $this->ajaxReturn(array("info" => "success", "msg" => "操作成功", "status" => 1));
    }
}