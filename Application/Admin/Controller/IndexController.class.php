<?php
namespace Admin\Controller;


class IndexController extends BaseController
{
    public function index()
    {
        $newOrder = D("Order")->getMethod(array("status" => 0), "count");
        $this->assign("newOrder", $newOrder);

        $newMoney = D("Order")->getMethod(array("status" => 0), "sum", "totalprice");
        $this->assign("newMoney", round($newMoney, 2));

        $user = D("User")->getMethod(array(), "count");
        $this->assign("user", $user);

        $order = D("Order")->getMethod(array(), "count");
        $this->assign("order", $order);

        $this->display();
    }

    public function userChart()
    {
        $totalUser = D("User")->getMethod(array(), "count");
        $buyUser = D("User")->getMethod(array("buy_num" => array("gt", 0)), "count");
        $buyRate = ($buyUser / $totalUser) * 100;
        $this->assign("buyRate", $buyRate);

        $yesterday = D("Analysis")->get(array("time" => array("like", date("Y-m-d", strtotime("-1 day")) . "%")));
        $this->assign("yesterdayNewUser", $yesterday["registers"]);
        $today = D("Analysis")->get(array("time" => array("like", date("Y-m-d") . "%")));
        $this->assign("todayNewUser", $today["registers"]);

        $line_data = $this->getDateAnalysis();

        $newUserLine = array();
        foreach ($line_data as $key => $value) {
            $newUserLine[$key] = $value["registers"];
        }
        $this->assign("newUserLine", json_encode($newUserLine));

        $userBuyLine = array();
        foreach ($line_data as $key => $value) {
            $userBuyLine[$key] = $value["users"];
        }
        $this->assign("userBuyLine", json_encode($userBuyLine));

        $newUser = $today["registers"];
        $newUserBuy = D("User")->getMethod(array("ctime" => array("like", date("Y-m-d") . "%"), "buy_num" => array("gt", 0)), "count");
        $newUserBuyRate = ($newUserBuy / $newUser) * 100;
        $this->assign("newUserBuyRate", $newUserBuyRate);

        $this->display();
    }

    private function getDateAnalysis()
    {
        $where["time"] = array();
        for ($i = 0; $i <= 21; $i++) {
            array_push($where["time"], array("like", date("Y-m-d", strtotime("-$i day")) . "%"));
        }
        array_push($where["time"], "or");
        $analysis = D("Analysis")->getList($where, false, "id desc");

        $date = array();
        for ($i = 21; $i >= 0; $i--) {
            array_push($date, date("m-d", strtotime("-$i day")));
        }
        $this->assign("date", json_encode($date));

        $line_data = array();
        foreach ($date as $key => $value) {
            $line_data[$key] = array(
                "id" => "0",
                "orders" => "0",
                "trades" => "0",
                "registers" => "0",
                "users" => "0",
                "time" => "0",
            );
            foreach ($analysis as $k => $v) {
                if (strstr($v["time"], $value)) {
                    $line_data[$key] = $v;
                }
            }
        }

        return $line_data;
    }

    public function orderChart()
    {
        $yesterday = D("Analysis")->get(array("time" => array("like", date("Y-m-d", strtotime("-1 day")) . "%")));
        $this->assign("yesterdayNewOrder", $yesterday["orders"]);
        $this->assign("yesterdayNewTrade", $yesterday["trades"]);
        $today = D("Analysis")->get(array("time" => array("like", date("Y-m-d") . "%")));
        $this->assign("todayNewOrder", $today["orders"]);
        $this->assign("todayNewTrade", $today["trades"]);

        $line_data = $this->getDateAnalysis();

        $newOrderLine = array();
        foreach ($line_data as $key => $value) {
            $newOrderLine[$key] = $value["orders"];
        }
        $this->assign("newOrderLine", json_encode($newOrderLine));

        $userTradeLine = array();
        foreach ($line_data as $key => $value) {
            $userTradeLine[$key] = $value["trades"];
        }
        $this->assign("userTradeLine", json_encode($userTradeLine));

        $this->display();
    }

    public function productChart()
    {
        $productList = D("Product")->getList();
        $this->assign("productList", $productList);

        $this->display();
    }
    
    public function shopChart()
    {
        $yesterday = D("Analysis")->getAnalysis(array("time" => array("like", date("Y-m-d", strtotime("-1 day")) . "%")));
        $this->assign("yesterdayNewShop", $yesterday["shops"]);
        $today = D("Analysis")->getAnalysis(array("time" => array("like", date("Y-m-d") . "%")));
        $this->assign("todayNewShop", $today["shops"]);

        $shopsCount = D("Shop")->getShopListCount();
        $this->assign("shopsCount", $shopsCount);

        $line_data = $this->getDateAnalysis();

        $newShopLine = array();
        foreach ($line_data as $key => $value) {
            $newShopLine[$key] = $value["shops"];
        }
        $this->assign("newShopLine", json_encode($newShopLine));

        $this->display();
    }
}