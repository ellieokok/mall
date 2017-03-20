<?php
namespace Ext\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
//      url中的pjax参数影响数据分页
//        if (I("get._pjax")) {
//            unset($_GET["_pjax"]);
//        }

        //自动登录
        if (I("get.token")) {
            $user = D("Admin")->get(array("token" => I("get.token")), true);
            if ($user) {
                session("adminName", $user["username"]);
                session("adminId", $user["id"]);
                session("adminGroupId", $user["groupAccess"]["group_id"]);
            }
            unset($_GET["token"]);
        }

        if (!$this->is_login() || session("adminGroupId") == null) {
            $this->ajaxReturn(array("info" => "error", "msg" => "未登录", "status" => 0));
        }

        if (session("adminGroupId") > 1) {
            $auth = new \Think\Auth();
            if (!$auth->check(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME, session("adminId"))) {
                $this->ajaxReturn(array("info" => "error", "msg" => "未授权", "status" => 0));
            }
        }
    }

    public function is_login()
    {
        if (session("adminName") && session("adminId")) {
            return true;
        } else {
            return false;
        }
    }
}