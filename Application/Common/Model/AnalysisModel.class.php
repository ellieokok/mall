<?php
namespace Common\Model;

use Think\Model;


class AnalysisModel extends Model
{
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

    public function getMethod($condition = array(), $method, $args)
    {
        $field = isset($args) ? $args : '*';
        $data = $this->where($condition)->getField(strtoupper($method) . '(' . $field . ') AS tp_' . $method);
        return $data;
    }

    /**
     * @param int $orders 新订单
     * @param int $trades 新交易额
     * @param int $registers 新注册量
     * @param int $users 新购买用户
     */
    public function add($orders = 0, $trades = 0, $registers = 0, $users = 0)
    {
        $today = date("Y-m-d");
        $where["time"] = array("like", $today . "%");
        $data = $this->where($where)->find();
        if ($data) {
            $this->where(array("id" => $data["id"]))->setInc("orders", $orders);
            $this->where(array("id" => $data["id"]))->setInc("trades", $trades);
            $this->where(array("id" => $data["id"]))->setInc("registers", $registers);
            $this->where(array("id" => $data["id"]))->setInc("users", $users);
        } else {
            parent::add(array("orders" => $orders, "trades" => $trades, "registers" => $registers, "users" => $users));
        }
    }


    public function getAnalysisList($condition = array(), $order = "id desc")
    {
        $analysis = $this->where($condition)->order($order)->select();
        return $analysis;
    }

    public function getAnalysis($condition = array())
    {
        $analysis = $this->where($condition)->find();
        return $analysis;
    }

    /**
     * @param int $orders 新订单
     * @param int $trades 新交易额
     * @param int $registers 新注册量
     * @param int $users 新购买用户
     */
    public function addAnalysis($orders = 0, $trades = 0, $registers = 0, $users = 0, $shops = 0)
    {
        $today = date("Y-m-d");
        $where["time"] = array("like", $today . "%");
        $analysis = $this->where($where)->find();
        if ($analysis) {
            $this->where(array("id" => $analysis["id"]))->setInc("orders", $orders);
            $this->where(array("id" => $analysis["id"]))->setInc("trades", $trades);
            $this->where(array("id" => $analysis["id"]))->setInc("registers", $registers);
            $this->where(array("id" => $analysis["id"]))->setInc("users", $users);
            $this->where(array("id" => $analysis["id"]))->setInc("shops", $shops);
        } else {
            $this->add(array("orders" => $orders, "trades" => $trades, "registers" => $registers, "users" => $users, "shops" => $shops));
        }
    }
}