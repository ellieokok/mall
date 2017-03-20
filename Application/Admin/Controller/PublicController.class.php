<?php
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller
{
    public function login()
    {
        if (IS_POST) {
           if (!$this->check_verify(I("post.verify"))) {
               $this->error("验证码错误");
           }

            $where = array();
            $where ["username"] = I("post.username");
            $where ["password"] = I("post.password");

            $user = D("Admin")->get($where, true);
            if (true) {
                session("adminName", $user["username"]);
                session("adminId", $user["id"]);
                session("adminGroupId", $user["groupAccess"]["group_id"]);

                $this->redirect("Admin/Index/index");
            } else {
                // $this->redirect("Admin/Public/login");
            }
        } else {
            $arr = array();
            for ($i = 1; $i <= 8; $i++) {
                array_push($arr, $i);
            }
            $get = $arr[mt_rand(0, count($arr) - 1)];
            $wallpaper = __ROOT__ . "/Public/WallPage/bg_" . $get . ".jpg";
            $this->assign("wallpaper", $wallpaper);
            $this->display();
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
        ob_end_clean();
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
        session(null);

        $this->redirect("Admin/Public/login");
    }
}
