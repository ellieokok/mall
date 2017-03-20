<?php
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
//      url中的pjax参数影响数据分页
        if (I("get._pjax")) {
            unset($_GET["_pjax"]);
        }

        if (!$this->is_login()) {
            $this->redirect('Home/Public/login');
        }

        // if (!session("homeShopId") && !(MODULE_NAME == "Home" && CONTROLLER_NAME == "Shop" && ACTION_NAME == "shop"
        //         || ACTION_NAME == "switchShop" || ACTION_NAME == "addShop" || ACTION_NAME == "modifyShop" || ACTION_NAME == "delShop")
        // ) {
        //     $this->error('请先选择店铺', 'Home/Shop/shop');
        // }
    }

    public function is_pjax()
    {
        return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'];
    }

    public function display($templateFile = '', $toggle = true)
    {
        if ($toggle) {
            if ($this->is_pjax()) {
                layout(false);
            } else {
                //切换店铺
                $shopBarList = D("Shop")->getShopList(array("user_id" => session("homeId")));
                $this->assign("shopBarList", $shopBarList);

                $this->assign("shopBar", session("homeShop"));

//                if (session("homeShopId")) {
//                    $shopBar = D("Shop")->getShop(array("id" => session("homeShopId")));
//                    $this->assign("shopBar", $shopBar);
//
//                    $member = D("UserMember")->where(array("user_id" => session("homeId"), "status" => 1))->order("id desc")->find();
//                    $this->assign("member", $member);
//                }

                layout('layout');
            }
        } else {
            layout(false);
        }

        return parent::display($templateFile);
    }

    public function is_login()
    {
        if (session("homeId")) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * GET 请求
     * @param string $url
     */
    private function http_get($url)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }
}