<?php
namespace Common\Model;

use Think\Model;

class AuthGroupAccessModel extends Model
{
    public function add($user_id, $group_id)
    {
        $data = $this->where(array("uid" => $user_id))->find();
        if ($data) {
            $data["group_id"] = $group_id;
            parent::save($data);
        } else {
            parent::add(array("uid" => $user_id, "group_id" => $group_id));
        }
    }

    public function del($user_id)
    {
        $this->where(array("uid" => $user_id))->delete();
    }
}