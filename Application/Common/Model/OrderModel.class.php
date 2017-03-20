<?php
namespace Common\Model;

use Think\Model\RelationModel;

class OrderModel extends RelationModel
{
    protected $_link = array(
        'OrderContact' => array(
            'mapping_type' => self::HAS_ONE,
            'mapping_name' => 'contact',
            'foreign_key' => 'order_id',//关联id
        ),
        'User' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'user',
            'foreign_key' => 'user_id',//关联id
        ),
        'OrderDetail' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'detail',
            'foreign_key' => 'order_id',
        ),
        'Shop' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'shop',
            'foreign_key' => 'shop_id',//关联id
//            'mapping_fields' => 'remark',
        ),
    );

    public function get($condition = array(), $relation = false)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation($relation);
        }
        $data = $data->find();

        return $data;
    }

    public function getList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation($relation);
        }
        if ($p && $num) {
            $data = $data->page($p . ',' . $num . '');
        }
        if ($limit) {
            $data = $data->limit($limit);
        }

        $data = $data->order($order)->select();

        return $data;
    }
//崔
    public function getOrderListCount($condition = array())
    {
        $count = $this->where($condition)->count();
        return $count;
    }
//崔
    public function getOrderListSum($condition)
    {
        $sum = $this->where($condition)->sum("totalprice");
        return $sum;
    }

    public function getMethod($condition = array(), $method, $args)
    {
        $field = isset($args) ? $args : '*';
        $data = $this->where($condition)->getField(strtoupper($method) . '(' . $field . ') AS tp_' . $method);
        return $data;
    }

    public function add($data)
    {
        if ($data["id"] == 0 || !isset($data["id"])) {
            $id = parent::add($data);
            return $id;
        } else {
            $this->save($data);
            return $data["id"];
        }
    }

    public function addAll($data)
    {
        parent::addAll($data);
    }

    public function save($data)
    {
        parent::save($data);
    }

    public function del($condition = array())
    {
        $this->where($condition)->delete();
    }
 //崔  
     public function getOrder($condition = array(), $relation = false)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation(true);
        }
        $data = $data->find();

        return $data;
    }

    public function getOrderList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0)
    {
        $list = $this->where($condition);
        if ($relation) {
            $list = $list->relation(true);
        }
        if ($p && $num) {
            $list = $list->page($p . ',' . $num . '');
        }
        if ($limit) {
            $list = $list->limit($limit);
        }

        $list = $list->order($order)->select();

        return $list;
    }

    public function getOrderDetail($id)
    {
        $order = $this->getOrder(array("id" => $id) , true);
        $orderDetail = $order["detail"];
        return $orderDetail;
    }

    public function cancelOrder($ids)
    {
        $this->where(array("id" => array("in", $ids)))->save(array("status" => -1));
    }

    public function addOrder($userId, $contact_id, $payFlag, $discount, $data , $shopId)
    {
        $order ["user_id"] = $userId;
        $order ["contact_id"] = $contact_id;
        $order ["shop_id"] = $shopId;
        $order ["orderid"] = date("ymdhis") . mt_rand(1, 9);
        $order ["totalprice"] = $data["totalPrice"];
        $order ["payment"] = $data["payment"];
        if ($payFlag || $order ["totalprice"] == 0) {
            $order ["pay_status"] = 1;
        } else {
            $order ["pay_status"] = 0;
        }
        $order ["status"] = 0;
        $order ["remark"] = $data["remark"];
        $order ["delivery_time"] = $data["deliveryTime"];

        $config = D("Shop")->getShop(array("id" => $shopId));
        $order ["freight"] = $config["freight"]?$config["freight"]:0;

        $order ["discount"] = $discount;
        $order ["time"] = date("Y-m-d H:i:s");
        $order_id = $this->add($order);

        $cartdata = $data["cartData"];
        $detailAll = array();
        $product = D("Product");
        $scoreInc = 0;

        foreach ($cartdata as $key => $value) {
            $detail = array();
            $detail["order_id"] = $order_id;
            $detail["product_id"] = $value["id"];
            $detail["user_id"] = $userId;
            $detail["name"] = $value["name"];
            $detail["attr"] = isset($value["attr"]) ? $value["attr"] : "";
            $detail["num"] = $value["num"];
            $detail["price"] = $value["price"];

            $getProduct = $product->getProduct(array("id" => $value["id"]));
            $detail["file_id"] = $getProduct["file_id"];
            $scoreInc += floatval($getProduct["score"]);

            //销量库存cal
            if ($getProduct["store"] > 0) {
                if (floatval($getProduct["store"]) - floatval($value["num"]) == 0) {
                    $product->where(array("id" => $value["id"]))->setDec("status");
                }
                $product->where(array("id" => $value["id"]))->setDec("store", $value["num"]);
            }
            $product->where(array("id" => $value["id"]))->setInc("sales", $value["num"]);

            array_push($detailAll, $detail);
        }
        M("OrderDetail")->addAll($detailAll);

        $user = D("User");
        $user->where(array("id" => $userId))->setInc("buy_num");
        $user->where(array("id" => $userId))->setInc("score", $scoreInc);

        //统计
        $newBuyUser = 0;
        $buyUser = $this->getOrder(array("user_id" => $userId));
        if ($buyUser) {
            $newBuyUser = 1;
        }
        D("Analysis")->addAnalysis(1, floatval($order ["totalprice"]), 0, $newBuyUser , 0);

        return $order_id;
    }

    public function updateAllOrder($ids, $data)
    {
        $this->where(array("id" => array("in", $ids)))->save($data);
    }

    public function updateOrder($data)
    {
        $this->save($data);
    }   
    
    
}