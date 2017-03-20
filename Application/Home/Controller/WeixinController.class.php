<?php
namespace Home\Controller;

class WeixinController extends BaseController
{
    public function wxSet()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["shop_id"] = session("homeShopId");
            $data["appsecret"] = trim($data["appsecret"]);
            D("WxConfig")->add($data);

            $this->success("保存成功", "Home/Weixin/wxSet");
        } else {
            $condition = array("shop_id" => session("homeShopId"));
            $config = D("WxConfig")->getWxSet($condition);
            $this->assign("config", $config);
            $this->assign("url", 'http://' . $_SERVER["HTTP_HOST"] . U("Admin/Wechat/index/shopId") . "/" . session("homeShopId"));
            $this->display();
        }

    }

    public function wxMenuSet()
    {
        $condition = array("shop_id" => session("homeShopId"));
        $wxMenu = D("WxMenu")->getWxMenuList($condition);

        $wxMenuModel = D("WxMenu");
        foreach ($wxMenu as $key => $value) {
            $wxMenu[$key]["parent"] = $wxMenuModel->getWxMenu(array("id" => $value["pid"]));
        }

        $this->assign("wxMenu", $wxMenu);
        $this->display();
    }

    public function wxReplySet()
    {
        $condition = array("shop_id" => session("homeShopId"));
        $wxReply = D("WxReply")->getWxReplyList($condition, true);
        $this->assign("wxReply", $wxReply);
        $this->display();
    }

    public function addWxMenu()
    {
        if (IS_POST) {
            $data = I("post.");

            $count = D("WxMenu")->getWxMenuListCount(array(
                "shop_id" => session("homeShopId"),
                "pid" => $data["pid"]
            ));
            if ($data["pid"]) {
                if ($count >= 5) {
                    $this->error("设置失败,二级菜单最多5个", "Home/Weixin/wxMenuSet");
                }
            } else {
                if ($count >= 3) {
                    $this->error("设置失败,一级菜单最多3个", "Home/Weixin/wxMenuSet");
                }
            }

            $data["shop_id"] = session("homeShopId");
            D("WxMenu")->addWxMenu($data);

            $this->success("保存成功", "Home/Weixin/wxMenuSet");
        } else {
            $parentWxMenuList = D("WxMenu")->getWxMenuList(array("pid" => 0, "shop_id" => session("homeShopId")));
            $this->assign("parentWxMenuList", $parentWxMenuList);

            $this->display();
        }
    }

    public function addWxReply()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["shop_id"] = session("homeShopId");
            D("WxReply")->addWxReply($data);

            $this->success("保存成功", "Home/Weixin/wxReplySet");
        } else {
            $this->display();
        }
    }

    public function modifyWxMenu()
    {
        $wxMenu = D("WxMenu")->getWxMenu(array("id" => I("get.id")));
        $this->assign("wxMenu", $wxMenu);

        $parentWxMenuList = D("WxMenu")->getWxMenuList(array("pid" => 0));
        $this->assign("parentWxMenuList", $parentWxMenuList);

        $this->display("Weixin:addWxMenu");
    }

    public function delWxMenu()
    {
        D("WxMenu")->delWxMenu(I("get.id"));

        $this->success("删除成功", "Home/Weixin/wxMenuSet");
    }

    public function modifyWxReply()
    {
        $wxReply = D("WxReply")->getWxReply(array("id" => I("get.id")), true);
        $this->assign("wxReply", $wxReply);

        $this->display("Weixin:addWxReply");
    }

    public function delWxReply()
    {
        D("WxReply")->delWxReply(I("get.id"));

        $this->success("删除成功", "Home/Weixin/wxReplySet");
    }
}