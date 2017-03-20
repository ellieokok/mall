<?php
namespace Home\Controller;

use Think\Controller;

class PublicController extends Controller
{

    // 发送邮箱验证码
    public function emailsms(){

        Vendor('Swift.swift_required');

        $emailCode = rand_code(6);
        session("emailCode", $emailCode);
        $email = I("post.email");

        $transport=\Swift_SmtpTransport::newInstance("smtp.qq.com","465","ssl")
            ->setUsername("80106964@qq.com")
            ->setPassword("mtwsozxqmvakbidj");
        $mailer =\Swift_Mailer::newInstance($transport);
        $message=\Swift_Message::newInstance()
            ->setSubject("SksMall多用户商城注册验证码")
            ->setFrom(array("80106964@qq.com"=>"SksMall"))
            ->setTo($email)
            ->setContentType("text/html")
            ->setBody('您好，您的验证码是' . $emailCode);
            // ->attach(\Swift_Attachment::fromPath('1.jpg', 'image/jpeg'));//发送附件
        $mailer->protocol='smtp';
        $result = $mailer->send($message);

        if ($result == 1) {
            $this->ajaxReturn('发送成功');
        } else {
            $this->ajaxReturn('发送失败');
        }

    }
    // 新用户注册发送给管理员
    public function emailadmin($user_id){
        $user = D("User")-> get(array("id" => $user_id));
        $username = $user['username'];

        Vendor('Swift.swift_required');

        $transport=\Swift_SmtpTransport::newInstance("smtp.qq.com","465","ssl")
            ->setUsername("1604583867@qq.com")
            ->setPassword("owllesvpfjvujbjb");
        $mailer =\Swift_Mailer::newInstance($transport);
        $message=\Swift_Message::newInstance()
            ->setSubject("多用户有人注册啦")
            ->setFrom(array("1604583867@qq.com"=>"新用户注册"))
            ->setTo("2861399191@qq.com")
            ->setContentType("text/html")
            ->setBody('新用户' . $username .'注册啦');
            // ->attach(\Swift_Attachment::fromPath('1.jpg', 'image/jpeg'));//发送附件
        $mailer->protocol='smtp';
        $result = $mailer->send($message);

    }
    //发送手机验证码
    public function sendSms()
    {
        if (session("sendSmsNum") && session("sendSmsNum") > 3) {
            $this->error("发送次数太多");
        }

        Vendor("ChuanglanSmsHelper.ChuanglanSmsApi");

        $smsCode = rand_code(6);
        session("smsCode", $smsCode);

        $phone = I("get.phone");
        if (strlen(I("get.phone")) != 11) {
            return;
        }

        $clapi = new \ChuanglanSmsApi();
        $result = $clapi->sendSMS($phone, '您好，您的验证码是' . $smsCode, 'true');
        $result = $clapi->execResult($result);

        $num = session("sendSmsNum") + 1;
        session("sendSmsNum", session("sendSmsNum") ? $num : 0);

        if ($result[1] == 0) {
            echo '发送成功';
        } else {
            echo "发送失败{$result[1]}";
        }

    }

    public function login()
    {
        if (IS_POST) {
            if (!$this->check_verify(I("post.verify"))) {
                $this->error("验证码错误");
            }

            $where = array();
            $where ["username"] = I("post.username");
            $where ["password"] = md5(I("post.password"));

            $user = D("User")->get($where, true);
//            print_r($user);
//            return;

            if ($user) {
                session("homeName", $user["username"]);
                session("homeId", $user["id"]);

                // $this->redirect("Home/Shop/shop");
                $this->redirect("Home/AddShop/shop");
            } else {
                $this->error("登录失败", U("Home/Public/login"));
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

    public function forgetPassword()
    {
        if (IS_POST) {

            if (I("post.smsVerify") == session("emailCode")) {
                $user = D("User")->get(array("email" => I("post.email")));
                if ($user) {
                    session("smsVerifyUserId", $user["id"]);
                    $this->redirect("Home/Public/resetPassword");
                } else {
                    $this->error("此邮箱未注册");
                }

            } else {
                $this->error("邮箱验证码无效");
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

    public function checkName()
    {
        $user = D("User")->get(array("username" => I("get.username")));
        if ($user) {
            echo "0";
        } else {
            echo "1";
        }
    }

    public function checkemail()
    {
        $email = D("User")->get(array("email" => I("post.email")));
        if ($email) {
            echo "0";
        } else {
            echo "1";
        }
    }

    public function resetPassword()
    {
        if (session("smsVerifyUserId")) {
            if (IS_POST) {
                if (!$this->check_verify(I("post.verify"))) {
                    $this->error("验证码错误");
                }

                if (I("post.password") != I("post.password2")) {
                    $this->error("密码不匹配");
                }

                D("User")->save(array("id" => session("smsVerifyUserId"), "password" => md5(I("post.password"))));
                $this->error("重置成功", U("Home/Public/login"));
            } else {
                $arr = array(4, 5, 7, 10, 11, 12);
                $get = $arr[mt_rand(0, count($arr) - 1)];
                $wallpaper = __ROOT__ . "/Public/WallPage/" . $get . ".jpg";
                $this->assign("wallpaper", $wallpaper);

                $this->display('', false);
            }
        } else {
            $this->error("非法操作", U("Home/User/login"));
        }
    }

    public function register()
    {
        if (IS_POST) {

            if (I("post.password") != I("post.password2")) {
                $this->error("密码不匹配");
            }

            $email = D("User")->get(array("email" => I("post.email")));
            if ($email) {
                $this->error("该邮箱已经注册,请重新输入");
            }

            $data = I("post.");
            unset($data["password2"]);

            if ($data["smsVerify"] != session("emailCode")) {
                $this->error("邮箱验证码无效");
            }
            //核对验证码
            unset($data["smsVerify"]);

            $data["type"] = 2;
            $data["password"] = md5($data["password"]);

            $user_id = D("User")->addUser($data);

            D("Analysis")->addAnalysis(0, 0, 1, 0, 1);

            //auto create shop
            // D("Shop")->addShop(array("user_id" => $user_id, "name" => "默认店铺"));
            if ($user_id) {
                // $this->redirect("Home/User/login");

                // $this->emailadmin($user_id);//注册信息发送给管理员
                $this->success("注册成功", U("Home/User/login"));

            } else {
                $this->error("注册失败");
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

        $this->redirect("Home/User/login");
    }
}
