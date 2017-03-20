<?php
namespace Home\Controller;

class CouponController extends BaseController
{
    public function config()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["id"] = session("homeShopId");

            D("Shop")->addShop($data);
            $this->success("保存成功", cookie("prevUrl"));
        } else {
            $num = 25;
            $p = I("get.page") ? I("get.page") : 1;
            cookie("prevUrl", "Home/Coupon/config/page/" . $p);

            $condition = array("shop_id" => session("homeShopId"));
            $coupon = D("CouponCategory")->getList($condition, true, "id desc", $p, $num);
            $this->assign("coupons", $coupon);

            $count = D("CouponCategory")->getMethod($condition, "count");// 查询满足要求的总记录数
            $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
            $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
            $show = $Page->show();// 分页显示输出
            $this->assign('page', $show);// 赋值分页输出

            $config = D("Shop")->getShop(array("id" => session("homeShopId")));
            $this->assign("coupon", $config["coupon"]);

            $this->display();
        }

    }

    public function delCoupon()
    {
        D("CouponCategory")->del(array("id" => array("in", I("get.id"))));
        $this->success("删除成功", cookie("prevUrl"));
    }

    public function detail()
    {
        $condition = array("coupon_category_id" => I("get.id"));
        $details = D("Coupon")->getList($condition, true);
        $this->assign("details", $details);
        $this->display();
    }

    public function addCoupon()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["last_number"] = $data["number"];

            $valid = explode(" - ", $data["validity"]);
            unset($data["validity"]);

            $data["ctime"] = $valid[0];
            $data["last_time"] = $valid[1];

            $data["shop_id"] = session("homeShopId");
            $data["user_id"] = session("homeId");

            D("CouponCategory")->add($data);
            $this->success("新增成功", cookie("prevUrl"));
        } else {
            $this->display();
        }
    }
}