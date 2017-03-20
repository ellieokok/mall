<?php
namespace Ext\Controller;

class ShopController extends BaseController
{
    public function product()
    {
        $num = I("get.num") ? I("get.num") : 25;
        $p = I("get.page") ? I("get.page") : 1;

        $condition = array();
        $search = trim(I("get.search"));

        if ($search) {
            switch ($search) {
                case "上架":
                    $search = 1;
                    break;
                case "下架":
                    $search = -1;
                    break;
                case "售罄":
                    $search = 0;
                    break;
            }

            $condition["id"] = $search;
            $condition["status"] = $search;
            $condition["name"] = $search;
            $condition["_logic"] = "OR";
        }

        $productList = D("Product")->getList($condition, array("menu", "file"), "id desc", $p, $num);
        $count = D("Product")->getMethod($condition, "count");

        $this->ajaxReturn(array("total" => $count, "rows" => $productList));
    }

    public function update()
    {
        $data = I("get.");
        $data["id"] = array("in", $data["id"]);
        D("Product")->save($data);

        $this->ajaxReturn(array("info" => "success", "msg" => "操作成功", "status" => 1));
    }

    public function analysis()
    {
        $data = array();
        $data["newOrder"] = D("Order")->getMethod(array("status" => 0), "count");

        $newMoney = D("Order")->getMethod(array("status" => 0), "sum", "totalprice");
        $data["newMoney"] = round($newMoney, 2);
        $data["user"] = D("User")->getMethod(array(), "count");
        $data["order"] = D("Order")->getMethod(array(), "count");

        $this->ajaxReturn($data);
    }
}