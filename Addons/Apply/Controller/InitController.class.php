<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/30
 * Time: 12:11
 */

namespace Addons\Apply\Controller;


use Common\Controller\Addon;

class InitController extends Addon
{

    public function install()
    {
        $install_sql = './Addons/Apply/Data/install.sql';
        if (file_exists($install_sql)) {
            execute_sql_file($install_sql);
        }
        $this->success('安装成功', 'index.php/Admin/Addon/addon');
        return true;
    }

    public function uninstall()
    {
        $uninstall_sql = './Addons/Apply/Data/uninstall.sql';
        if (file_exists($uninstall_sql)) {
            execute_sql_file($uninstall_sql);
        }
        $this->success('卸载成功', 'index.php/Admin/Addon/addon');
        return true;

    }
}