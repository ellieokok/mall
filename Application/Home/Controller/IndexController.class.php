<?php
namespace Home\Controller;


class IndexController extends BaseController
{
    public function index()
    {
        $condition = array(
            "shop_id" => session("homeShopId"),
            "status" => 0
        );

        $newOrder = D("Order")->getOrderListCount($condition);
        $this->assign("newOrder", $newOrder);

        $newMoney = D("Order")->getOrderListSum($condition);
        $this->assign("newMoney", round($newMoney, 2));

        $user = D("User")->getUserListCount();
        $this->assign("user", $user);

        $order = D("Order")->getOrderListCount();
        $this->assign("order", $order);

        $artical = D("Artical")->getArticalList(array("type" => 1), false, "id desc", 0, 0, 10);
        $this->assign("artical", $artical);
        $this->display();
    }

    public function productChart()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $productList = D("Product")->getProductList($condition, false, "sales desc");
        $this->assign("productList", $productList);

        $this->display();
    }
    

    
    
    
    
}