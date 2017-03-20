<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 12:11
 */

namespace Addons\Card\Controller;


use Common\Controller\Addon;

class InitController extends Addon
{

    public function install()
    {
        $install_sql = './Addons/Card/Data/install.sql';
        if (file_exists($install_sql)) {
            execute_sql_file($install_sql);
        }
        $this->success("安装成功", "Admin/Addon/addon");
    }

    public function uninstall()
    {
        $uninstall_sql = './Addons/Card/Data/uninstall.sql';
        if (file_exists($uninstall_sql)) {
            execute_sql_file($uninstall_sql);
        }
        $this->success("卸载成功", "Admin/Addon/addon");
    }
}