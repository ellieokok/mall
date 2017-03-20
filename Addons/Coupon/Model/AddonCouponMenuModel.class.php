<?php
namespace Addons\Coupon\Model;

use Think\Model\RelationModel;

class AddonCouponMenuModel extends RelationModel
{
    protected $_link = array();

    public function getCount()
    {
        $count = $this->count();
        return $count;
    }

    public function getPageConditionOrder($p = 1, $num = 1, $order)
    {
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $orderList = $this->page($p . ',' . $num . '')->order($order)->select();
        return $orderList;
    }

    public function addCouponMenu($data)
    {
        $data['ctime'] = time();
        $number = $data['num'] = intval($data['num']);
        $data['coupon_menu_id'] = $this->add($data);

        for ($i = 0; $i < $number; $i++) {
            $data['code'] = rand_code(6);
            $code = M('AddonCoupon')->where(array('code' => $data['code']))->find();
            if (!isset($code)) {
                $coupon_id = M('AddonCoupon')->add($data);
            } else {
                $number = $number + 1;
            }
        }
        return $coupon_id;
    }
}