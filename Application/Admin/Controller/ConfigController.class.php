<?php
namespace Admin\Controller;

class ConfigController extends BaseController
{
    public function configSet()
    {
        if (IS_POST) {
            D("Config")->addConfig(I("post."));
            $this->success("保存成功", "Admin/Config/configSet");
        } else {
            $config = D("Config")->getConfig();
            $this->assign("config", $config);
            $this->display();
        }
    }

    public function addressSet()
    {
        $province = D("LocProvince")->getList();
        $this->assign("province", $province);
        $this->display();
    }

    public function addProvince()
    {
        if (IS_POST) {
            D("LocProvince")->add(I("post."));

            $this->success("保存成功", "Admin/Config/addressSet");
        } else {
            $this->display();
        }
    }

    public function modProvince()
    {
        $province = D("LocProvince")->get(array("id" => I("get.id")));
        $this->assign("province", $province);
        $this->display("Config:addProvince");
    }

    public function delProvince()
    {
        D("LocProvince")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", "Admin/Config/addressSet");
    }

    public function addCity()
    {
        if (IS_POST) {
            D("LocCity")->add(I("post."));

            $this->success("添加成功", "Admin/Config/city");
        } else {
            $provincelist = D("LocProvince")->getList();
            $this->assign("provincelist", $provincelist);
            $this->display();
        }
    }

    public function city()
    {
        $city = D("LocCity")->getList(array(), true);
        $this->assign("city", $city);
        $this->display();
    }

    public function delCity()
    {
        D("LocCity")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", "Admin/Config/city");
    }

    public function modCity()
    {
        $city = D("LocCity")->get(array("id" => I("get.id")));
        $this->assign("city", $city);

        $provincelist = D("LocProvince")->getList();
        $this->assign("provincelist", $provincelist);

        $this->display("Config:addCity");
    }


    public function tplSet()
    {
        if (I("get.theme")) {
            D("Config")->add(array("theme" => I("get.theme"),"id"=>1));
            $this->success("设置成功", "Admin/Config/tplSet");
        } else {
            $config = D("Config")->get();
            $themedir = getDir("./Theme");

            $this->assign("theme", $themedir);
            $this->assign("settheme", $config["theme"]);
            $this->display();
        }
    }

    public function alipaySet()
    {
        if (IS_POST) {
            D("Alipay")->add(I("post."));

            $this->success("保存成功", "Admin/Config/alipaySet");
        } else {
            $alipay = D("Alipay")->get();
            $this->assign("alipay", $alipay);
            $this->display();
        }
    }

    public function wxPrintSet()
    {
        if (IS_POST) {
            D("WxPrint")->add(I("post."));

            $this->success("保存成功", "Admin/Config/wxPrintSet");
        } else {
            $wxPrint = D("WxPrint")->get();
            $this->assign("wxPrint", $wxPrint);
            $this->display();
        }
    }

    public function smsSet()
    {
        if (IS_POST) {
            D("Sms")->add(I("post."));

            $this->success("保存成功", "Admin/Config/smsSet");
        } else {
            $sms = D("Sms")->get();
            $this->assign("sms", $sms);
            $this->display();
        }
    }


    public function wxTplMsgSet()
    {
        if (IS_POST) {
            D("WxTplmsg")->addWxTplMsg(I("post."));

            $this->success("保存成功", "Admin/Config/wxTplMsgSet");
        } else {
            $list = D("WxTplmsg")->getList();
            foreach ($list as $key => $value) {
                $this->assign($value["template_id_short"], $value["template_id"]);
            }
            $this->display();
        }
    }
}