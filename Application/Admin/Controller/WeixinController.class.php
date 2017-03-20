<?php
namespace Admin\Controller;

class WeixinController extends BaseController
{
    public function wxSet()
    {
        if (IS_POST) {
            D("WxConfig")->add(I("post."));

            $this->success("保存成功", "Admin/Weixin/wxSet");
        } else {
            $config = D("WxConfig")->get();
            $this->assign("config", $config);
            $this->assign("url", 'http://' . $_SERVER["HTTP_HOST"] . U("Admin/Wechat/index"));
            $this->display();
        }

    }

    public function wxMenuSet()
    {
        $wxMenu = D("WxMenu")->getList();
        $this->assign("wxMenu", $wxMenu);
        $this->display();
    }

    public function wxReplySet()
    {
        $wxReply = D("WxReply")->getList(array(), true);
        $this->assign("wxReply", $wxReply);
        $this->display();
    }

    public function addWxMenu()
    {
        if (IS_POST) {
            D("WxMenu")->add(I("post."));

            $this->success("保存成功", "Admin/Weixin/wxMenuSet");
        } else {
            $parentWxMenuList = D("WxMenu")->getList(array("pid" => 0));
            $this->assign("parentWxMenuList", $parentWxMenuList);

            $this->display();
        }
    }

    public function addWxReply()
    {
        if (IS_POST) {
            D("WxReply")->add(I("post."));

            $this->success("保存成功", "Admin/Weixin/wxReplySet");
        } else {
            $this->display();
        }
    }

    public function modWxMenu()
    {
        $wxMenu = D("WxMenu")->get(array("id" => I("get.id")));
        $this->assign("wxMenu", $wxMenu);

        $parentWxMenuList = D("WxMenu")->getList(array("pid" => 0));
        $this->assign("parentWxMenuList", $parentWxMenuList);

        $this->display("Weixin:addWxMenu");
    }

    public function delWxMenu()
    {
        D("WxMenu")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", "Admin/Weixin/wxMenuSet");
    }

    public function modWxReply()
    {
        $wxReply = D("WxReply")->get(array("id" => I("get.id")), true);
        $this->assign("wxReply", $wxReply);

        $this->display("Weixin:addWxReply");
    }

    public function delWxReply()
    {
        D("WxReply")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", "Admin/Weixin/wxReplySet");
    }
}