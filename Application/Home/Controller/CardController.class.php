<?php
namespace Home\Controller;

class CardController extends BaseController
{
    public function config()
    {
        if (IS_POST) {
            $data = I("post.");
            $data["shop_id"] = session("homeShopId");
            D("CardConfig")->add($data);
            $this->success("设置成功", "Home/Card/config");
        } else {
            $config = D("CardConfig")->get(array("shop_id" => session("homeShopId")));
            $this->assign("config", $config);

            $this->assign('url', "http://" . I("server.HTTP_HOST"));
            $this->display();
        }

    }
}