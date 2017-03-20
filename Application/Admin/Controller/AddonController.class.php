<?php
namespace Admin\Controller;

use Org\Net\Http;
use ZipArchive;

class AddonController extends BaseController
{
    private static $addonUrl = "http://addon.wemallshop.com/Public/Uploads/";

    public function addon()
    {
        $addons = getDir(ADDON_PATH);
        $info = array();
        foreach ($addons as $key => $value) {
            if (is_file(ADDON_PATH . '/' . $value . '/' . 'config.php')) {
                $config = require ADDON_PATH . '/' . $value . '/' . 'config.php';
                $_info = $config['info'];
                $name = $_info['name'];

                $_info['addons_config_url'] = u_addons($name . '://Admin/Config/index');
                $_info['addons_admin_url'] = u_addons($name . '://Admin/Admin/index');
                $_info['addons_install_url'] = u_addons($name . '://Admin/Init/install');
                $_info['addons_uninstall_url'] = u_addons($name . '://Admin/Init/uninstall');
                array_push($info, $_info);
            }
        }
        $this->assign('addons', $info);
        $this->assign('url', "http://" . I("server.HTTP_HOST"));
        $this->display();
    }

    public function addonShop()
    {
        $this->display();
    }

    public function getFileDownload()
    {
        $path = I("post.path");
        $filename = I("post.filename");
        $type = I("post.type");

        $filePath = self::$addonUrl . $path . '/' . $filename;
        $header_array = get_headers($filePath, true);
        $size = $header_array['Content-Length'];

        switch ($type) {
            case 1:
                $savePath = "./Addons/";
                break;
            case 2:
                $savePath = "./Theme/";
                break;
            case 3:
                $savePath = "./";
                break;
        }

        Http::curlDownload($filePath, $savePath . $filename);

        $this->ajaxReturn(
            array(
                "savePath" => $savePath,
                "saveName" => $filename,
                "fileSize" => $size,
            )
        );
    }

    public function compare()
    {
        $path = I("post.path");
        $filename = I("post.filename");
        $filesize = I("post.filesize");
        $filePath = $path . $filename;

        $length = filesize($filePath);
        if ($filesize == $length) {
            $zip = new ZipArchive;
            if ($zip->open($filePath) === TRUE) {
                $zip->extractTo($path);
                $zip->close();
            }
            //删除文件夹./Addons/__MACOSX
            unlink($filePath);
            deleteDir($path . '__MACOSX');
            echo 1;
        } else {
            echo 0;
        }
    }
}