<?php
namespace Ext\Controller;

class UserController extends BaseController
{
    public function user()
    {
        $num = I("get.num") ? I("get.num") : 25;
        $p = I("get.page") ? I("get.page") : 1;

        $condition = array();
        $search = trim(I("get.search"));

        if ($search) {
            switch ($search) {
                case "启用":
                    $search = 1;
                    break;
                case "禁用":
                    $search = 0;
                    break;
            }

            $condition["id"] = $search;
            $condition["phone"] = $search;
            $condition["username"] = $search;
            $condition["status"] = $search;
            $condition["_logic"] = "OR";
        }

        $userList = D("User")->getList($condition, true, "id desc", $p, $num);
        $count = D("User")->getMethod($condition, "count");

        $this->ajaxReturn(array("total" => $count, "rows" => $userList));
    }

    public function update()
    {
        $data = I("get.");
        $data["id"] = array("in", $data["id"]);
        D("User")->save($data);

        $this->ajaxReturn(array("info" => "success", "msg" => "操作成功", "status" => 1));
    }
}