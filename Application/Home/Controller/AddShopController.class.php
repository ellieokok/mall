<?php
namespace Home\Controller;

use Think\Controller;

class AddShopController extends Controller
{
    public function shop()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Home/AddShop/shop/page/" . $p);

        $condition = array("user_id" => session("homeId"));
        $shopList = D("Shop")->getShopList($condition, true, "id desc", $p, $num);
        $this->assign('shopList', $shopList);// 赋值数据集

        $count = D("Shop")->getShopListCount($condition);// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->assign('url', "http://" . I("server.HTTP_HOST"));
        $this->display();
    }
    
    public function addShop()
    {
        if (IS_POST) {
            $data = I("post.");

// dump($data);

            // if( floatval($data["zhekou"]) > 1 || floatval($data["zhekou"]) <= 0){
            //     $this->error("账户支付折扣的值只能设置(  0 < x <= 1 )" , "Home/Shop/modifyShop");
            // }

            if (!$data["id"]) {
                $data["user_id"] = session("homeId");
            }

            unset($data["wd"]);

            D("Shop")->addShop($data);

            $this->success("保存成功", "Home/AddShop/shop");

        } else {
            $this->display();
        }
    }  
  
    
    
    
    
    
}