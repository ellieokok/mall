<?php
namespace Admin\Controller;

class ArticalController extends BaseController
{
    public function artical()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Admin/Artical/artical/page/" . $p);

        $articalList = D("Artical")->getList(array(), true, "id desc", $p, $num);
        $this->assign('articalList', $articalList);// 赋值数据集

        $count = D("Artical")->getMethod(array(), "count");// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->assign('url', "http://" . I("server.HTTP_HOST"));
        $this->display();
    }

    public function modArtical()
    {
        $artical = D("Artical")->get(array("id" => I("get.id")), true);
        $this->assign("artical", $artical);
        $this->display("Artical:addArtical");
    }

    public function delArtical()
    {
        D("Artical")->del(array("id" => array("in", I("get.id"))));
        $this->success("删除成功", cookie("prevUrl"));
    }

    public function addArtical()
    {
        if (IS_POST) {
            $data = I("post.");
            $data['content'] = I("post.content", '', '');
            D("Artical")->add($data);

            $this->success("保存成功", cookie("prevUrl"));
        } else {
            $this->display();
        }
    }
}