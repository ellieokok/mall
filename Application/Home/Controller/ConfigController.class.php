<?php
namespace Home\Controller;

class ConfigController extends BaseController
{
    public function address()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $province = D("LocProvince")->getProvinceList($condition);
        $this->assign("province", $province);
        $this->display();
    }

    public function addProvince()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["shop_id"] = session("homeShopId");
            D("LocProvince")->addProvince($data);

            $this->success("保存成功", "Home/Config/address");
        } else {
            $this->display();
        }
    }

    public function modifyProvince()
    {
        $province = D("LocProvince")->get(array("id" => I("get.id")));
        $this->assign("province", $province);
        $this->display("Config:addProvince");
    }

    public function delProvince()
    {
        D("LocProvince")->delProvince(I("get.id"));

        $this->success("删除成功", "Home/Config/address");
    }

    public function addCity()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["shop_id"] = session("homeShopId");
            D("LocCity")->addCity($data);

            $this->success("添加成功", "Home/Config/city");
        } else {
            $condition = array(
                "shop_id" => session("homeShopId")
            );

            $provincelist = D("LocProvince")->getProvinceList($condition);
            $this->assign("provincelist", $provincelist);
            $this->display();
        }
    }

    public function city()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $city = D("LocCity")->getCityList($condition, true);
        $this->assign("city", $city);
        $this->display();
    }

    public function delCity()
    {
        D("LocCity")->delCity(I("get.id"));

        $this->success("删除成功", "Home/Config/city");
    }

    public function modifyCity()
    {
        $city = D("LocCity")->getCity(array("id" => I("get.id")));
        $this->assign("city", $city);

        $provincelist = D("LocProvince")->getProvinceList();
        $this->assign("provincelist", $provincelist);

        $this->display("Config:addCity");
    }

    public function wxPrintSet()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["shop_id"] = session("homeShopId");

//            print_r($data);
//            return;
            D("WxPrint")->addWxPrint($data);

            $this->success("保存成功", "Home/Config/wxPrintSet");
        } else {
            $wxPrint = D("WxPrint")->getWxPrint(array("shop_id" => session("homeShopId")));
            $this->assign("wxPrint", $wxPrint);
            $this->display();
        }
    }

    public function wxTplMsgSet()
    {
        if (IS_POST) {
            $data = I("post.");
            D("WxTplmsg")->addWxTplMsg($data, session("homeShopId"));

            $this->success("保存成功", "Home/Config/wxTplMsgSet");
        } else {
            $list = D("WxTplmsg")->getWxTplmsgList(array("shop_id" => session("homeShopId")));
            foreach ($list as $key => $value) {
                $this->assign($value["template_id_short"], $value["template_id"]);
            }

            $this->display();
        }
    }
}