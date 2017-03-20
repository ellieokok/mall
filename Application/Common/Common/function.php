<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/7/17
 * Time: 16:08
 */

function request_by_fsockopen($url, $post_data = array())
{
    $url_array = parse_url($url);
    $hostname = $url_array['host'];
    $port = isset($url_array['port']) ? $url_array['port'] : 80;
    $requestPath = $url_array['path'] . "?" . $url_array['query'];
    $fp = fsockopen($hostname, $port, $errno, $errstr, 10);
    if (!$fp) {
        echo "$errstr ($errno)";
        return false;
    }
    $method = "GET";
    if (!empty($post_data)) {
        $method = "POST";
    }
    $header = "$method $requestPath HTTP/1.1\r\n";
    $header .= "Host: $hostname\r\n";
    if (!empty($post_data)) {
        $_post = strval(NULL);
        foreach ($post_data as $k => $v) {
            $_post[] = $k . "=" . urlencode($v);//必须做url转码以防模拟post提交的数据中有&符而导致post参数键值对紊乱
        }
        $_post = implode('&', $_post);
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";//POST数据
        $header .= "Content-Length: " . strlen($_post) . "\r\n";//POST数据的长度
        $header .= "Connection: Close\r\n\r\n";//长连接关闭
        $header .= $_post; //传递POST数据
    } else {
        $header .= "Connection: Close\r\n\r\n";//长连接关闭
    }
    fwrite($fp, $header);
    //-----------------调试代码区间-----------------
    /*$html = '';
    while (!feof($fp)) {
        $html.=fgets($fp);
    }
    echo $html;*/
    //-----------------调试代码区间-----------------
    fclose($fp);
}

/**
 * 其它版本
 * 使用方法：
 * $post_string = "app=request&version=beta";
 * request_by_other('http://facebook.cn/restServer.php',$post_string);
 */
function request_by_other($remote_server, $post_string)
{
    $context = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded' .
                '\r\n' . 'User-Agent : Jimmy\'s POST Example beta' .
                '\r\n' . 'Content-length:' . strlen($post_string) + 8,
            'content' => 'mypost=' . $post_string)
    );
    $stream_context = stream_context_create($context);
    $data = file_get_contents($remote_server, false, $stream_context);
    return $data;
}

/**
 * Goofy 2011-11-30
 * getDir()去文件夹列表，getFile()去对应文件夹下面的文件列表,二者的区别在于判断有没有“.”后缀的文件，其他都一样
 */

//获取文件目录列表,该方法返回数组
function getDir($dir)
{
    $dirArray[] = NULL;
    if (false != ($handle = opendir($dir))) {
        $i = 0;
        while (false !== ($file = readdir($handle))) {
            //去掉"“.”、“..”以及带“.xxx”后缀的文件
            if ($file != "." && $file != ".." && !strpos($file, ".") && $file != '.DS_Store') {
                $dirArray[$i] = $file;
                $i++;
            }
        }
        //关闭句柄
        closedir($handle);
    }
    return $dirArray;
}

//获取文件列表
function getFile($dir)
{
    $fileArray[] = NULL;
    if (false != ($handle = opendir($dir))) {
        $i = 0;
        while (false !== ($file = readdir($handle))) {
            //去掉"“.”、“..”以及带“.xxx”后缀的文件
            if ($file != "." && $file != ".." && strpos($file, ".")) {
                $fileArray[$i] = "./imageroot/current/" . $file;
                if ($i == 100) {
                    break;
                }
                $i++;
            }
        }
        //关闭句柄
        closedir($handle);
    }
    return $fileArray;
}

//调用方法getDir("./dir")……
function displayDir($str)
{
    if (!is_dir($str))
        die ('不是一个目录！');
    $files = array();
    if ($hd = opendir($str)) {
        while ($file = readdir($hd)) {
            if ($file != '.' && $file != '..') {
                if (is_dir($str . '/' . $file)) {
                    $files [$file] = displayDir($str . '/' . $file);
                } else {
                    $files [] = $file;
                }
            }
        }
    }
    return $files;
}

/**
 * 执行SQL文件
 */
function execute_sql_file($sql_path)
{
    // 读取SQL文件
    $sql = wp_file_get_contents($sql_path);
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    // 替换表前缀
    $orginal = 'wp_';
    $prefix = C('DB_PREFIX');
    $sql = str_replace("{$orginal}", "{$prefix}", $sql);

    // 开始安装
    foreach ($sql as $value) {
        $value = trim($value);
        if (empty ($value))
            continue;

        $res = M()->execute($value);
        // dump($res);
        // dump(M()->getLastSql());
    }
}

// 防超时的file_get_contents改造函数
function wp_file_get_contents($url)
{
    $context = stream_context_create(array(
        'http' => array(
            'timeout' => 30
        )
    )); // 超时时间，单位为秒

    return file_get_contents($url, 0, $context);
}

/**
 * 插件显示内容里生成访问插件的url
 * @param string $url url
 * @param array $param 参数
 * @author better
 * @useage u_addons('apply://App/Index/addorder',array('id'=>'1'))
 */
function u_addons($url, $param = array())
{
    $url = explode('://', $url);
    $addon = $url[0];
    $url = $url[1];

    $url = U($url, $param, false);
    return $url . '/addon/' . $addon;
}

/**
 *  产生一个随机数，传入长度
 * @param [type]  用户 QQ互联一键登录　产生密码随机
 * .@param string $length 随机数密码长度  默认为10个字符;
 **/
function rand_code($length = 6)
{
    $chars = "0123456789";
    $str = "";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, $size - 1)];
    }
    return $str;
}

//调用：getRandom(32)
function getRandom($length)
{
    $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $key = "";
    for ($i = 0; $i < $length; $i++) {
        $key .= $str{mt_rand(0, 63)};    //生成php随机数
    }
    return $key;
}


/**
 * where in 数组为空时返回不存在的字符例如(-10000000000)
 * @param $value
 * @return string
 */
function in_parse_str($value)
{
    if (!$value) {
        $value = '-10000000000';
    }
    return $value;
}

/**
 * 把返回的数据集转换成Tree
 *
 * @param array $list
 *            要转换的数据集
 * @param string $pid
 *            parent标记字段
 * @param string $level
 *            level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer [$data [$pk]] = &$list [$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data [$pid];
            if ($root == $parentId) {
                $tree [] = &$list [$key];
            } else {
                if (isset ($refer [$parentId])) {
                    $parent = &$refer [$parentId];
                    $parent [$child] [] = &$list [$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 *
 * @param array $tree
 *            原来的树
 * @param string $child
 *            孩子节点的键
 * @param string $order
 *            排序显示的键，一般是主键 升序排列
 * @param array $list
 *            过渡用的中间数组，
 * @return array 返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array())
{
    if (is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if (isset ($reffer [$child])) {
                unset ($reffer [$child]);
                tree_to_list($value [$child], $child, $order, $list);
            }
            $list [] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby = 'asc');
    }
    return $list;
}

/**
 * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
 * 注意：服务器需要开通fopen配置
 * @param $word 要写入日志里的文本内容 默认值：空值
 */
function logResult($word = '')
{
    $fp = fopen("./Data/log.log", "a");
    flock($fp, LOCK_EX);
    fwrite($fp, "执行日期：" . strftime("%Y%m%d%H%M%S", time()) . "\n" . $word . "\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}

/**
 * 发送短信接口
 * @param $user
 * @param $pass
 * @param $content
 * @param $phone
 * @return mixed 发送回调
 */
function sendSms($user, $pass, $content, $phone)
{
    $statusStr = array(
        "0" => "短信发送成功",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词"
    );
    $smsapi = "http://www.smsbao.com/"; //短信网关
    $user = $user; //短信平台帐号
    $pass = md5($pass); //短信平台密码
    $content = $content;//要发送的短信内容
    $phone = $phone;
    $sendurl = $smsapi . "sms?u=" . $user . "&p=" . $pass . "&m=" . $phone . "&c=" . urlencode($content);
    $result = file_get_contents($sendurl);
    return $statusStr[$result];
}

/**
 * @param $user
 * @param $pass
 * @param $phone
 *
 * 发送短信验证码
 */
function sendSmsVerify($user, $pass, $phone)
{
    $code = rand(1000, 9999);
    session("smsVerify", $code);

    $config = D("Config")->get();
    $content = "[" . $config["name"] . "],您的验证码是:" . $code;//要发送的短信内容

    sendSms($user, $pass, $content, $phone);
}


/**
 * @param $id
 *
 * 易联云微信打印机
 */
// function wxPrint($id)
// {
//     $result = D("Order")->get(array("id" => $id));
//     if ($result["pay_status"] == 0) {
//         $pay_status = "未付款";
//     } else {
//         $pay_status = "已付款";
//     }

//     $config = D("Config")->get();

//     $msg = '';
//     $msgtitle = $config['name'] . '欢迎您订购

// 订单编号：' . $result["orderid"] . '

// 条目      单价（元）    数量
// --------------------------------------------
// ';
//     $detail = '';
//     for ($j = 0; $j < count($result["detail"]); $j++) {
//         $row = $result["detail"][$j];
//         $title = $row['name'];
//         $price = $row['price'];
//         $num = $row['num'];

//         $detail .=
//             $title . '      ' . $price . '      ' . $num . '
// ';
//     }
//     $msgcontent = $detail;

//     $msgfooter = '
// 备注：' . $result["note"] . '
// --------------------------------------------
// 合计：' . $result["totalprice"] . '元
// 付款状态：' . $pay_status . '

// 联系用户：' . $result["contact"]["name"] . '
// 送货地址：' . $result["contact"]["province"] . $result["contact"]["city"] . $result["contact"]["district"] . $result["contact"]["address"] . '
// 联系电话：' . $result["contact"]["phone"] . '
// 订购时间：' . $result["time"] . '




// ';//自由输出

//     $msg .= $msgtitle . $msgcontent . $msgfooter;

//     $wxPrint = D("WxPrint")->get();
//     $apiKey = $wxPrint["apiKey"];//apiKey
//     $mKey = $wxPrint["mKey"];//秘钥
//     $partner = $wxPrint["partner"];//用户id
//     $machine_code = $wxPrint["machine_code"];//机器码

//     $params = array(
//         'partner' => $partner,
//         'machine_code' => $machine_code,
//         'content' => $msg,
//     );

//     Vendor("Wechat.wechat#class");
//     $wxPrint = new \WxPrint();
//     $sign = $wxPrint->generateSign($params, $apiKey, $mKey);
//     $params['sign'] = $sign;
//     $wxPrint->httppost1($params);
// }

/**
 * @param $id
 *
 * 易联云微信打印机
 */
function wxPrint($id)
{
    $result = D("Order")->getOrder(array("id" => $id) , true);
    if ($result["pay_status"] == 0) {
        $pay_status = "未付款";
    } else {
        $pay_status = "已付款";
    }

    $config = D("Shop")->getShop(array("id" => $result["shop_id"]));

    $msg = '';
    $msgtitle = $config['name'] . '欢迎您订购

订单编号：' . $result["orderid"] . '

条目        单价（元）      数量
--------------------------------------------
';
    $detail = '';
    for ($j = 0; $j < count($result["detail"]); $j++) {
        $row = $result["detail"][$j];
        $title = $row['name'];
        $price = $row['price'];
        $num = $row['num'];

        $detail .= wxPrintFormet($title).number_format($price,2)."           ".$num."\n";
    }
    $msgcontent = $detail;

    $msgfooter = '
备注：' . $result["remark"] . '
--------------------------------------------
合计：' . $result["totalprice"] . '元
付款状态：' . $pay_status . '

联系用户：' . $result["contact"]["name"] . '
送货地址：' . $result["contact"]["province"] . $result["contact"]["city"] . $result["contact"]["district"] . $result["contact"]["address"] . '
联系电话：' . $result["contact"]["phone"] . '
订购时间：' . $result["time"] . '




';//自由输出

    $msg .= $msgtitle . $msgcontent . $msgfooter;
    
    // print_r($msg);
    // die();

    $wxPrint = D("WxPrint")->getWxPrint(array("shop_id" => $result["shop_id"]));

    $apiKey = $wxPrint["apikey"];//apiKey
    $mKey = $wxPrint["mkey"];//秘钥
    $partner = $wxPrint["partner"];//用户id
    $machine_code = $wxPrint["machine_code"];//机器码

    $params = array(
        'partner' => $partner,
        'machine_code' => $machine_code,
        'content' => $msg,
    );

    Vendor("Wechat.WxPrint#class");
    $wxPrint = new \WxPrint();
    $sign = $wxPrint->generateSign($params, $apiKey, $mKey);
    $params['sign'] = $sign;
    $wxPrint->httppost1($params);
}

function wxPrintFormet($str){
    // print_r(iconv_strlen($str)."-");
    // if(strlen($str) <= 8){
    //     $num = 8-strlen($str);
        
    //     print_r($num."?");
    //     for($x=0; $x<=$num; $x++) {
    //         $str .= " ";
    //     }
    //     // $str .= "\t";
    // }else{
        $str .= "\n" . "            ";
    // }
    
    return $str;                    
}

/**
 * 最简单的XML转数组
 * @param string $xmlstring XML字符串
 * @return array XML数组
 */
function simplest_xml_to_array($xmlstring)
{
    return json_decode(json_encode((array)simplexml_load_string($xmlstring)), true);
}

/**
 * @param $dir
 * 删除文件夹
 */
function deleteDir($dir)
{
    if (rmdir($dir) == false && is_dir($dir)) {
        if ($dp = opendir($dir)) {
            while (($file = readdir($dp)) != false) {
                if (is_dir($file) && $file != '.' && $file != '..') {
                    deleteDir($file);
                } else {
                    unlink($file);
                }
            }
            closedir($dp);
        } else {
            exit('Not permission');
        }
    }
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}

//多维数组全组合
function arrCombine($arr)
{
    if (count($arr) >= 2) {
        $tmparr = array();
        $arr1 = array_shift($arr);
        $arr2 = array_shift($arr);
        foreach ($arr1 as $k1 => $v1) {
            foreach ($arr2 as $k2 => $v2) {
                $tmparr[] = $v1 . ',' . $v2;
            }
        }
        array_unshift($arr, $tmparr);
        $arr = arrCombine($arr);
    } else {
        return $arr;
    }
    return $arr;
}

//多维数组合并
function arrMerge($arr)
{
    if (count($arr) >= 2) {
        $arr1 = array_shift($arr);
        $arr2 = array_shift($arr);
        $arr3 = array_merge($arr1, $arr2);
        array_unshift($arr, $arr3);
        $arr = arrMerge($arr);
    } else {
        return $arr;
    }
    return $arr;
}

/**
 *计算某个经纬度的周围某段距离的正方形的四个点
 *
 *@param lng float 经度
 *@param lat float 纬度
 *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
 *@return array 正方形的四个点的经纬度坐标
 */
//获取周围坐标
function returnSquarePoint($lng, $lat, $distance = 0.5)
{
    $earthRadius = 6378138;
    $dlng = 2 * asin(sin($distance / (2 * $earthRadius)) / cos(deg2rad($lat)));
    $dlng = rad2deg($dlng);
    $dlat = $distance / $earthRadius;
    $dlat = rad2deg($dlat);
    return array(
        'left-top' => array('lat' => $lat + $dlat, 'lng' => $lng - $dlng),
        'right-top' => array('lat' => $lat + $dlat, 'lng' => $lng + $dlng),
        'left-bottom' => array('lat' => $lat - $dlat, 'lng' => $lng - $dlng),
        'right-bottom' => array('lat' => $lat - $dlat, 'lng' => $lng + $dlng)
    );
}

//计算两个坐标的直线距离(单位米)
function getDistance($lat1, $lng1, $lat2, $lng2)
{
    $earthRadius = 6378138; //近似地球半径米
    // 转换为弧度
    $lat1 = ($lat1 * pi()) / 180;
    $lng1 = ($lng1 * pi()) / 180;
    $lat2 = ($lat2 * pi()) / 180;
    $lng2 = ($lng2 * pi()) / 180;
    // 使用半正矢公式  用尺规来计算
    $calcLongitude = $lng2 - $lng1;
    $calcLatitude = $lat2 - $lat1;
    $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
    $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
    $calculatedDistance = $earthRadius * $stepTwo;
    return round($calculatedDistance);
}

/**
 * GET 请求
 * @param string $url
 */
function http_get($url){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}
//判断是否是微信浏览器
function is_weixin(){ 
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
    }   
    return false;
}
?>
