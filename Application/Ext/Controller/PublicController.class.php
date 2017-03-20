<?php
namespace Ext\Controller;

use Think\Controller;

class PublicController extends Controller
{
    public function login()
    {
//        if (!$this->check_verify(I("post.verify"))) {
//            $this->error("验证码错误");
//        }
        $where = array();
        $where ["username"] = I("post.username");
        $where ["password"] = md5(I("post.password"));

        $user = D("Admin")->get($where, true);
        if ($user) {
            session("adminName", $user["username"]);
            session("adminId", $user["id"]);
            session("adminGroupId", $user["groupAccess"]["group_id"]);

            //reset token
            $user["token"] = getRandom(32);
            D("Admin")->save($user);

            $this->ajaxReturn($user);
        } else {
            $this->ajaxReturn(array("info" => "error", "msg" => "登录失败", "status" => 0));
        }
    }

    public function getVerify()
    {
        $config = array(
            "fontSize" => 30,    // 验证码字体大小
            "length" => 4,     // 验证码位数
            "useNoise" => true, // 关闭验证码杂点
            "useCurve" => false, // 关闭验证码杂点
            "codeSet" => "0123456789",
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    public function check_verify($code, $id = "")
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    public function logout()
    {
        D("Admin")->save(array("id" => session("adminId"), "token" => ""));
        session(null);

        $this->ajaxReturn(array("info" => "success", "msg" => "注销成功", "status" => 1));
    }
}