<?php
namespace Common\Model;


use Think\Model\RelationModel;

class TxModel extends RelationModel
{
    protected $_link = array(
        'User' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'user',
            'foreign_key' => 'user_id',//关联id
            'mapping_fields' => 'remark',
        ),
        'Shop' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'shop',
            'foreign_key' => 'shop_id',//关联id
//            'mapping_fields' => 'remark',
        ),
    );

    public function getTx($condition = array(), $relation = false)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation(true);
        }
        $data = $data->find();

        return $data;
    }

    public function getTxList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0)
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

    public function getTxListCount($condition = array())
    {
        $count = $this->where($condition)->count();
        return $count;
    }

    public function addTx($data)
    {
        $data["txid"] = date("ymdhis") . mt_rand(1, 9);
        $this->add($data);
    }

    public function saveTx($data)
    {
        $this->save($data);
    }
}