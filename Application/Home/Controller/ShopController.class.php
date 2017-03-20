<?php
namespace Home\Controller;

class ShopController extends BaseController
{
    public function addShop()
    {
        if (IS_POST) {
            $data = I("post.");

// dump($data);

            // if( floatval($data["zhekou"]) > 1 || floatval($data["zhekou"]) <= 0){
            //     $this->error("账户支付折扣的值只能设置(  0 < x <= 1 )" , "Home/Shop/modifyShop");
            // }

            if (!$data["id"]) {
                $data["user_id"] = session("homeId");
            }
            cookie("prevUrl1", "Home/Shop/addShop");   
            unset($data["wd"]);

            D("Shop")->addShop($data);

            if (session("homeShopId")) {
                $this->success("保存成功", "Home/Shop/modifyShop");
            } else {
                $this->success("创建成功", U("Home/AddShop/shop"));
            }

        } else {
            $this->display();
        }
    }

    public function updateShop()
    {
//        $data = I("get.");
        M("Shop")->where(array("id" => array("in", I("get.id"))))->save(array("status" => I("get.status")));

        $this->success("审核成功", cookie("prevUrl1"));
    }

    public function delShop()
    {
        D("Shop")->delShop(I("get.id"));

        $this->success("删除成功", cookie("prevUrl1"));
    }

    public function modifyShop()
    {
        if (session("homeShopId")) {
            $id = session("homeShopId");
            $shop = D("Shop")->getShop(array("id" => $id), true);

            $username = array();
            $employee = explode(',', $shop["employee"]);
            foreach ($employee as $key => $value) {
                $user = D("User")->get(array("id" => $value));
                array_push($username, $user["username"]);
            }
            $shop["employeeName"] = implode(",", $username);
            $this->assign("shop", $shop);

            $this->display("Shop:addShop");
        } else {
            $this->error("请先选择店铺", "Home/Shop/shop");
        }
    }

    public function switchShop()
    {
        if (I("get.id")) {
            session("homeShopId", I("get.id"));

            $shop = D("Shop")->getShop(array("id" => I("get.id")));
            session("homeShop", $shop);
        } else {
            session("homeShopId", null);
        }
        $this->redirect("Home/Index/index");
    }

//    public function selectEmployee()
//    {
//        $ids = array();
//        $employees = explode(",", I("post.name"));
//
//        if (count($employees)) {
//            foreach ($employees as $key => $value) {
//                $user = D("User")->getUser(array("username" => $value));
//                if ($user) {
//                    array_push($ids, $user["id"]);
//                } else {
//                    unset($employees[$key]);
//                }
//            }
//        } else {
//            $user = D("User")->getUser(array("username" => $employees));
//            array_push($ids, $user["id"]);
//        }
//
//        $this->ajaxReturn(array("id" => $ids, "name" => $employees));
//    }

    public function menu()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $menu = D("Menu")->getMenuList($condition, true);
        $menuModel = D("Menu");
        foreach ($menu as $key => $value) {
            $menu[$key]["parent"] = $menuModel->getMenu(array("id" => $value["pid"]));
        }
        $this->assign("menu", $menu);
        $this->display();
    }

    public function product()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Home/Shop/product/page/" . $p);

        $productList = D("Product")->getProductList($condition, true, "id desc", $p, $num);
        $this->assign('productList', $productList);// 赋值数据集
        
        // dump($productList);
        $count = D("Product")->getProductListCount($condition);// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->assign('url', "http://" . I("server.HTTP_HOST"));
        $this->display();
    }

    public function shop()
    {
        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Home/Shop/shop/page/" . $p);

        $condition = array("user_id" => session("homeId"));
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

    public function addMenu()
    {
        if (IS_POST) {
            $data = I("post.");
            if (!$data["id"]) {
                $data["shop_id"] = session("homeShopId") ? session("homeShopId") : 0;
            }
            D("Menu")->addMenu($data);

            $this->success("保存成功", "Home/Shop/menu");
        } else {
            $menuList = D("Menu")->getMenuList(array("pid" => 0, "shop_id" => session("homeShopId") ? session("homeShopId") : 0));
            $this->assign("menuList", $menuList);
            $this->display();
        }
    }

    public function modifyMenu()
    {
        $menu = D("Menu")->getMenu(array("id" => I("get.id")), true);
        $this->assign("menu", $menu);

        $menuList = D("Menu")->getMenuList(array("pid" => 0));
        $this->assign("menuList", $menuList);

        $this->display("Shop:addMenu");
    }

    public function delMenu()
    {
        D("Menu")->delMenu(I("get.id"));

        $this->success("删除成功", "Home/Shop/menu");
    }

    public function addProduct()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );
        if (IS_POST) {
            $data = I("post.");
            $data['shop_id'] = session("homeShopId");
            $data['detail'] = I("post.detail", '', '');
            $data['label'] = implode(',', I("post.label"));
            $data['albums'] = implode(',', I("post.albums"));
            D("Product")->add($data);

            $this->success("保存成功", cookie("prevUrl"));
        } else {
            $menuList = D("Menu")->getList($condition);
            $this->assign("menuList", $menuList);

            $labelList = D("ProductLabel")->getList();
            $this->assign("labelList", $labelList);

            $this->display();
        }
    }

    public function modifyProduct()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );
        
        $product = D("Product")->get(array("id" => I("get.id")), array('menu', 'file'));
        $product["label"] = explode(",", $product["label"]);

        $albums = explode(",", $product["albums"]);
        $product["albums"] = $albums ? D("File")->getList(array("id" => array("in", $albums))) : "";
        $this->assign("product", $product);

        $menuList = D("Menu")->getList($condition);
        $this->assign("menuList", $menuList);

        $labelList = D("ProductLabel")->getList();
        $this->assign("labelList", $labelList);

        // dump($product);

        $this->display("Shop:addProduct");        
    }

    public function updateProduct()
    {
        $data = I("get.");
        $id = $data["id"];
        unset($data["id"]);
        D("Product")->updateProduct($id, $data);

        $this->success("保存成功", cookie("prevUrl"));
    }


    public function delProduct()
    {
        D("Product")->delProduct(I("get.id"));

        $this->success("删除成功", cookie("prevUrl"));
    }

    public function ads()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Home/Shop/ads/page/" . $p);

        $adsList = D("Ads")->getAdsList($condition, true, "id desc", $p, $num);
        $this->assign('ads', $adsList);// 赋值数据集

        $count = D("Ads")->getAdsListCount($condition);// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    public function addAds()
    {
        if (IS_POST) {
            $data = I("post.");

            if (!$data["id"]) {
                $data["shop_id"] = session("homeShopId") ? session("homeShopId") : 0;
            }

            D("Ads")->addAds($data);

            $this->success("保存成功", cookie("prevUrl"));
        } else {
            $this->display();
        }
    }

    public function modifyAds()
    {
        $ads = D("Ads")->getAds(array("id" => I("get.id")), true);
        $this->assign("ads", $ads);

        $this->display("Shop:addAds");
    }

    public function delAds()
    {
        D("Ads")->delAds(I("get.id"));

        $this->success("删除成功", cookie("prevUrl"));
    }

    public function comment()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Home/Shop/comment/page/" . $p);

        $comment = D("Comment")->getCommentList($condition, true, "id desc", $p, $num);
        $this->assign("comment", $comment);

        $count = D("Comment")->getCommentListCount($condition);// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    public function delComment()
    {
        D("Comment")->delComment(I("get.id"));

        $this->success("删除成功", cookie("prevUrl"));
    }

    public function productSearch()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        if (I("post.id")) {
            array_push($condition, array("id" => I("post.id")));
        }
        if (I("post.shop_id") || session("homeShopId")) {
            array_push($condition, array("shop_id" => I("post.shop_id") ? I("post.shop_id") : session("homeShopId")));
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

        $productList = D("Product")->getProductList($condition, true);

        $this->assign("productPost", I("post."));
        $this->assign("productList", $productList);
        $this->display("product");
    }

    public function exportProduct()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $product = D('Product')->getProductList($condition, true);
        foreach ($product as $key => $value) {
            unset($product[$key]["comment"]);
        }
        Vendor("PHPExcel.Excel#class");
        \Excel::export($product);
    }

    public function feedback()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );

        $num = 25;
        $p = I("get.page") ? I("get.page") : 1;
        cookie("prevUrl", "Home/Shop/feedback/page/" . $p);

        $feedbackList = D("Feedback")->getFeedbackList($condition, false, "id desc", $p, $num);
        $this->assign('feedback', $feedbackList);// 赋值数据集

        $count = D("Feedback")->getFeedbackListCount();// 查询满足要求的总记录数
        $Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $show = $Page->show();// 分页显示输出

        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    public function exportFeedback()
    {
        if (I("get.id")) {
            $feedback = D("Feedback")->getFeedbackList(array("id" => array("in", I("get.id"))));
        } else {
            $condition = array(
                "shop_id" => session("homeShopId")
            );

            $feedback = D("Feedback")->getFeedbackList($condition);
        }

        Vendor("PHPExcel.Excel#class");
        \Excel::export($feedback);
    }

//崔
    public function label()
    {
        $condition = array(
            "shop_id" => session("homeShopId")
        );
        
        $label = D("ProductLabel")->getList($condition, false);
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
            $data = I("post.");
            if (!$data["id"]) {
                $data["shop_id"] = session("homeShopId") ? session("homeShopId") : 0;
            }
            D("ProductLabel")->add($data);

            $this->success("保存成功", "Home/Shop/label");
        } else {
            $this->display();
        }
        
    }

    public function delLabel()
    {
        D("ProductLabel")->del(array("id" => array("in", I("get.id"))));

        $this->success("删除成功", "Home/Shop/label");
    }

    public function sku()
    {
        cookie("prevUrl", "Home/Shop/sku/id/" . I("get.id"));

        $condition = array(
            "shop_id" => session("homeShopId"),
            "product_id" => I("get.id")
        );

        $sku = D("ProductSku")->getList($condition);
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
            $new[$key]["shop_id"] = session("homeShopId"); 
            $skuModel->add($new[$key]);
        }

        foreach ($old as $key => $value) {
            $old[$key]["product_id"] = I("post.product_id");
            $new[$key]["shop_id"] = session("homeShopId"); 
            $skuModel->save($old[$key]);
        }

        $this->success("操作成功", cookie("prevUrl"));
    }

    public function delSku()
    {
        D("ProductSku")->del(array("id" => I("get.id")));

        $this->success("删除成功", cookie("prevUrl"));
    }

}