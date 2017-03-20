<?php
namespace Admin\Controller;

class ShopController extends BaseController
{
    public function menu()
    {
        $menu = D("Menu")->getList(array(), true);
        $this->assign("menu", $menu);
        $this->display();
    }

    public function product()
    {
//      每页显示的记录数
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Admin/Shop/product/page/" . $p);

        $productList = D("Product")->getList(array(), array("menu", "file"), "id desc", $p, $num);
        $this->assign('productList', $productList);// 赋值数据集

        $count = D("Product")->getMethod(array(), "count");// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->assign('url', "http://" . I("server.HTTP_HOST"));
        $this->display();
    }

    public function addMenu()
    {
        if (IS_POST) {
            D("Menu")->add(I("post."));

            $this->success("保存成功", "Admin/Shop/menu");
        } else {
            $menuList = D("Menu")->getList(array("pid" => 0));
            $this->assign("menuList", $menuList);
            $this->display();
        }
    }

    public function modMenu()
    {
        $menu = D("Menu")->get(array("id" => I("get.id")), true);
        $this->assign("menu", $menu);

        $menuList = D("Menu")->getList(array("pid" => 0));
        $this->assign("menuList", $menuList);

        $this->display("Shop:addMenu");
    }

    public function delMenu()
    {
        D("Menu")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", "Admin/Shop/menu");
    }

    public function addProduct()
    {
        if (IS_POST) {
            $data = I("post.");
            $data['detail'] = I("post.detail", '', '');
            $data['label'] = implode(',', I("post.label"));
            $data['albums'] = implode(',', I("post.albums"));
            D("Product")->add($data);

            $this->success("保存成功", cookie("prevUrl"));
        } else {
            $menuList = D("Menu")->getList();
            $this->assign("menuList", $menuList);

            $labelList = D("ProductLabel")->getList();
            $this->assign("labelList", $labelList);

            $this->display();
        }
    }

    public function modProduct()
    {
        $product = D("Product")->get(array("id" => I("get.id")), array('menu', 'file'));
        $product["label"] = explode(",", $product["label"]);

        $albums = explode(",", $product["albums"]);
        $product["albums"] = $albums ? D("File")->getList(array("id" => array("in", $albums))) : "";
        $this->assign("product", $product);

        $menuList = D("Menu")->getList();
        $this->assign("menuList", $menuList);

        $labelList = D("ProductLabel")->getList();
        $this->assign("labelList", $labelList);

        // dump($product);

        $this->display("Shop:addProduct");
    }

    public function updateProduct()
    {
        $data = I("get.");
        $data["id"] = array("in", $data["id"]);
        D("Product")->save($data);

        $this->success("保存成功", cookie("prevUrl"));
    }


    public function delProduct()
    {
        D("Product")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", cookie("prevUrl"));
    }

    public function ads()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Admin/Shop/ads/page/" . $p);

        $adsList = D("Ads")->getList(array(), true, "id desc", $p, $num);
        $this->assign('ads', $adsList);// 赋值数据集

        $count = D("Ads")->getMethod(array(), "count");// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    public function addAds()
    {
        if (IS_POST) {
            D("Ads")->add(I("post."));

            $this->success("保存成功", cookie("prevUrl"));
        } else {
            $this->display();
        }
    }

    public function modAds()
    {
        $ads = D("Ads")->get(array("id" => I("get.id")), true);
        $this->assign("ads", $ads);

        $this->display("Shop:addAds");
    }

    public function delAds()
    {
        D("Ads")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", cookie("prevUrl"));
    }

    public function comment()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Admin/Shop/comment/page/" . $p);

        $comment = D("Comment")->getList(array(), true, "id desc", $p, $num);
        $this->assign("comment", $comment);

        $count = D("Comment")->getMethod(array(), "count");// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    public function delComment()
    {
        D("Comment")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", cookie("prevUrl"));
    }

    public function productSearch()
    {
        $condition = array();
        if (I("post.id")) {
            array_push($condition, array("id" => I("post.id")));
        }
        if (I("post.name")) {
            array_push($condition, array("name" => array("like", array("%" . I("post.name") . "%", "%" . I("post.name"), I("post.name") . "%"), 'OR')));
        }
        if (I("post.recommend") != -10) {
            array_push($condition, array("recommend" => I("post.recommend")));
        }
        if (I("post.status") != -10) {
            array_push($condition, array("status" => I("post.status")));
        }
        if (I("post.timeRange")) {
            $timeRange = I("post.timeRange");
            $timeRange = explode(" --- ", $timeRange);
            array_push($condition, array("time" => array('between', array($timeRange[0], $timeRange[1]))));
        }

        $productList = D("Product")->getList($condition, true);

        $this->assign("productPost", I("post."));
        $this->assign("productList", $productList);
        $this->display("product");
    }

    public function exportProduct()
    {
        $product = D('Product')->getList(array(), true);
        foreach ($product as $key => $value) {
            unset($product[$key]["comment"]);
        }
        Vendor("PHPExcel.Excel#class");
        \Excel::export($product);
    }

    public function feedback()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Admin/Shop/feedback/page/" . $p);

        $feedbackList = D("Feedback")->getList(array(), false, "id desc", $p, $num);
        $this->assign('feedback', $feedbackList);// 赋值数据集

        $count = D("Feedback")->getMethod(array(), "count");// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    public function exportFeedback()
    {
        if (I("get.id")) {
            $feedback = D("Feedback")->getList(array("id" => array("in", I("get.id"))));
        } else {
            $feedback = D("Feedback")->getList();
        }

        Vendor("PHPExcel.Excel#class");
        \Excel::export($feedback);
    }

    public function label()
    {
        $label = D("ProductLabel")->getList();
        $this->assign("label", $label);
        $this->display();
    }

    public function modLabel()
    {
        $label = D("ProductLabel")->get(array("id" => I("get.id")), false);
        $this->assign("label", $label);

        $this->display("Shop:addLabel");
    }

    public function addLabel()
    {
        if (IS_POST) {
            D("ProductLabel")->add(I("post."));

            $this->success("保存成功", "Admin/Shop/label");
        } else {
            $this->display();
        }
    }

    public function delLabel()
    {
        D("ProductLabel")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", "Admin/Shop/label");
    }

    public function sku()
    {
        cookie("prevUrl", "Admin/Shop/sku/id/" . I("get.id"));

        $sku = D("ProductSku")->getList(array("product_id" => I("get.id")));
        $this->assign("sku", $sku);

        $this->display();
    }

    public function addSku()
    {
        $new = I("post.new");
        $old = I("post.old");

        $skuModel = D("ProductSku");
        foreach ($new as $key => $value) {
            $new[$key]["product_id"] = I("post.product_id");
            $skuModel->add($new[$key]);
        }

        foreach ($old as $key => $value) {
            $old[$key]["product_id"] = I("post.product_id");
            $skuModel->save($old[$key]);
        }

        $this->success("操作成功", cookie("prevUrl"));
    }

    public function delSku()
    {
        D("ProductSku")->del(array("id" => I("get.id")));

        $this->success("删除成功", cookie("prevUrl"));
    }
    //pidong 店铺管理页面
    // public function shop()
    // {
    //     $shop = D("Shop")->select();  
    //     $this->assign("shop",$shop);
    //     $this->display();
    // }
    public function shop()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Admin/Shop/shop/page/" . $p);

        $condition = array();
        if (I("post.id")) {
            array_push($condition, array("id" => I("post.id")));
        }
        if (I("post.name")) {
            array_push($condition, array("name" => array("like", array("%" . I("post.name") . "%", "%" . I("post.name"), I("post.name") . "%"), 'OR')));
        }
        
        if (I("post.status") != ""){
            array_push($condition, array("status" => I("post.status")));
        }
        if (I("post.timeRange")) {
            $timeRange = I("post.timeRange");
            $timeRange = explode(" --- ", $timeRange);
            array_push($condition, array("time" => array('between', array($timeRange[0], $timeRange[1]))));
        }

        $shopList = D("Shop")->getShopList($condition, true, "id desc", $p, $num);
        $this->assign('shopList', $shopList);// 赋值数据集

        $count = D("Shop")->getShopListCount($condition);// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->assign('url', "http://" . I("server.HTTP_HOST"));
        $this->display();
    }    
    //pidong 新增店铺
    public function addShop(){
        if (IS_POST) {
            $data = I("post.");

            if (!$data["id"]) {
                $data["user_id"] = session("adminId");
            }

            unset($data["wd"]);

            D("Shop")->addShop($data);

            $this->success("保存成功", "Admin/Shop/shop");
        } else {
            $this->display();
        }
    }
    //pidong 店铺审核成功
    public function updateShop()
    {
        $data = I("get.");
        M("Shop")->where(array("id" => array("in", I("get.id"))))->save(array("status" => I("get.status")));

        $this->success("审核成功", cookie("prevUrl"));
    }
    //pidong 店铺删除
    public function delShop()
    {
        D("Shop")->delShop(I("get.id"));

        $this->success("删除成功", cookie("prevUrl"));
    }
    //pidong 关闭店铺
    public function closeShop(){
        $data = I("get.");
        M("Shop")->where(array("id" => array("in", I("get.id"))))->save(array("status" => I("get.status")));

        $this->success("关闭成功", cookie("prevUrl"));
    }
    //pidong 开启店铺
    public function openShop(){
        $data = I("get.");
        M("Shop")->where(array("id" => array("in", I("get.id"))))->save(array("status" => I("get.status")));

        $this->success("开启成功", cookie("prevUrl"));
    }         
}