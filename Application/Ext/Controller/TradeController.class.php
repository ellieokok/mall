<?php
namespace Ext\Controller;

class TradeController extends BaseController
{
    public function trade()
    {
        $num = I("get.num") ? I("get.num") : 25;
        $p = I("get.page") ? I("get.page") : 1;

        $condition = array();
        $search = trim(I("get.search"));

        if ($search) {
            switch ($search) {
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
            $condition["tradeid"] = $search;
            $condition["user_id"] = $search;
            $condition["payment"] = $search;
            $condition["_logic"] = "OR";
        }

        $tradeList = D("Trade")->getList($condition, false, "id desc", $p, $num);
        $count = D("Trade")->getMethod($condition, "count");

        $this->ajaxReturn(array("total" => $count, "rows" => $tradeList));
    }
}