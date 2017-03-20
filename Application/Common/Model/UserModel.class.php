<?php
namespace Common\Model;

use Think\Model\RelationModel;

class UserModel extends RelationModel
{
    protected $_link = array(
        'Contact' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'contact',
            'foreign_key' => 'user_id',//关联id
        ),
        'AuthGroupAccess' => array(
            'mapping_type' => self::HAS_ONE,
            'mapping_name' => 'authGroup',
            'foreign_key' => 'uid',//关联id
            'as_fields' => 'group_id:group_id',
        ),
        'Shop' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'shop',
            'foreign_key' => 'user_id',//关联id
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
    public function getUser($condition = array(), $relation = false)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation(true);
        }
        $data = $data->field('password', true)->find();

        return $data;
    }    
    public function getUserList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0)
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

        $list = $list->field("password", true)->order($order)->select();

        if ($relation) {
            $authGroupModel = D("AuthGroup");
            foreach ($list as $key => $value) {
                $authGroup = $authGroupModel->getAuthGroup($value["group_id"]);
                $list[$key]["groupName"] = $authGroup["title"] ? $authGroup["title"] : "";
            }
        }

        return $list;
    }
    public function getUserListCount($condition = array())
    {
        $count = $this->where($condition)->count();
        return $count;
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

    public function addUser($data)
    {
        $data["ctime"] = date("Y-m-d H:i:s");
        $data["status"] = 1;
        $userId = $this->add($data);

        //统计
        D("Analysis")->addAnalysis(0, 0, 1, 0, 0);
        return $userId;
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
}