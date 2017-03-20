<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 09:40
 */

namespace Addons\Coupon\Controller;

class AdminController extends InitController
{
    public function index()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;

        $couponModel = D('Addons://Coupon/AddonCouponMenu');
        $coupon = $couponModel->getPageConditionOrder($p, $num, "id desc");
        $this->assign("couponList", $coupon);// 赋值数据集

        $count = $couponModel->getCount();// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出

        $this->display(); // 输出模板
    }

    public function add()
    {
        if (IS_POST) {
            if (!I("post.name")) {
                return;
            }

            $data = I("post.");
            $data['last_time'] = I('post.last_time', '', 'strtotime');
            $coupon_id = D('Addons://Coupon/AddonCouponMenu')->addCouponMenu($data);

            isset($coupon_id) ? $this->success('添加成功', 'Admin/Admin/index/addon/Coupon') : $this->error('添加失败', u_addons("Coupon://Admin/Admin/index"));
        } else {
            $this->display(); // 输出模板
        }
    }

    public function detail()
    {
        $cdata['coupon_menu_id'] = I('get.id');
        $m = M('AddonCoupon');
        $count = $m->where($cdata)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page ($count, 15); // 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show(); // 分页显示输出
        $detail = $m->where($cdata)->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign("page", $show); // 赋值分页输出
        $this->assign('coupon', $detail);
        $this->display();
    }

    public function export()
    {

    }

    public function del()
    {
        $cdata['coupon_menu_id'] = $data['id'] = I('get.id');
        $c = M('AddonCouponMenu')->where($data)->delete();
        $m = M('AddonCoupon')->where($cdata)->delete();
        if ($c != false && $m != false) {
            $this->success('删除成功', 'Admin/Admin/index/addon/Coupon');
        } else {
            $this->error('操作失败', 'Admin/Admin/index/addon/Coupon');
        }
    }

    public function detail_del()
    {
        $cdata['id'] = I('get.id');
        $m = M('AddonCoupon')->where($cdata)->delete();
        if ($m != false) {
            $this->success('删除成功', 'Admin/Admin/index/addon/Coupon');
        } else {
            $this->error('操作失败', 'Admin/Admin/index/addon/Coupon');
        }
    }
}