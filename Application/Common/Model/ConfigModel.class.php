<?php
namespace Common\Model;

use Think\Model;

class ConfigModel extends Model
{
    public function get()
    {
        $config = $this->find();
        return $config;
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

    //pidong 超级管理员（新）
    public function getConfig()
    {
        $config = $this->find();
        return $config;
    }

    public function addConfig($data)
    {
        $this->where(array("id" => "1"))->save($data);
    }
}