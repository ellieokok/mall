<?php
namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
//      url中的pjax参数影响数据分页
        if (I("get._pjax")) {
            unset($_GET["_pjax"]);
        }

        if (!$this->is_login() || session("adminGroupId") == null) {
            $this->redirect('Admin/Public/login');
        }

        if (session("adminGroupId") > 1) {
            $auth = new \Think\Auth();
            if (!$auth->check(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME, session("adminId"))) {
                $this->error('你没有权限');
            }
        }
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
                if (ACTION_NAME == 'login' || ACTION_NAME == 'getVerify') {
                    layout(false);
                } else {
                    layout('layout');
                }
            }
        } else {
            layout(false);
        }

        return parent::display($templateFile);
    }

    public function is_login()
    {
        if (session("adminName") && session("adminId")) {
            return true;
        } else {
            return false;
        }
    }

    public function getNotify()
    {
        $notify = $this->http_get("http://notify.inuoer.com/notify.php?version=" . APP_VERSION . "&domain=http://" . I("server.HTTP_HOST"));
        echo $notify;
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