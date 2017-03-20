<?php
if (file_exists("Data/Conf/db.php")) {
    $db = include "Data/Conf/db.php";
} else {
    $db = array();
}


$config = array(
    //'配置项'=>'配置值'
    'DEFAULT_MODULE' => 'Home',  // 默认模块
    'MODULE_ALLOW_LIST' => array('Home', 'Admin', 'App', 'Install', 'Ext'),
    'URL_MODEL' => 2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持

    'TMPL_FILE_DEPR' => '_', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'SHOW_PAGE_TRACE' => false,
    'VAR_URL_PARAMS' => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR' => '/', //PATHINFO URL分割符
    'URL_HTML_SUFFIX' => '',  // URL伪静态后缀设置

    'AUTH_USER' => 'admin',
    //auth认证 auth.class.php 用户表名member->admin

    'AUTOLOAD_NAMESPACE' => array(
        'Addons' => ADDON_PATH, //自动加载命名空间
    )
);

return array_merge($config, $db);