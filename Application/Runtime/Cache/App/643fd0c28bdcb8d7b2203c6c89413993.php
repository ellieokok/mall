<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=100%, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title id="oti"></title>
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/style.css?v=7">
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/shop.css?v=2">
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/icon/iconfont.css">
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/iphone.css">
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/swiper.min.css">
</head>
<body>

<div id="main">
    <div class="header-bar select-shopbar" style="position:fixed;">
        <div class="header-title" style="display:inline-block;width:100%;">选择店铺</div>
        <span id="pi_back" style="display:none" onclick="history.go(-1)"></span>
    </div>
    
    <div class="pi_sousuo1" style="">
    	<input class="pi_input" placeholder="请输入店铺名称"  style="">
    	<span class="pi_sousuo" style=""></span>
    	<span class="pi_sousuo2" style="" onclick="searchShop();">搜索</span>
    </div>
    <div style="padding:5px 14px;background-color: #f5f5f5;">
        <i class="iconfont" style="color:A9A9A9;">&#xe600;</i>
        <span id="pi_address" style=""></span> 
    </div>
    
    <div class="shop-list" id="mod-desc">
    
    
    </div>   
</div>
<div id="page_tag_load"><img src="/wemall/Theme/waimai/Public/image/ajax-loader.gif" alt="loader"></div>

<script>
    var data = {
        'wxConfig': <?php echo ($wxConfig? $wxConfig : '[]'); ?>,
        'config': <?php echo ($config? $config : '[]'); ?>,
        'user': <?php echo ($user? $user : '[]'); ?>,
        'ads': <?php echo ($ads? $ads : '[]'); ?>,
        'menu': <?php echo ($menu? $menu : '[]'); ?>,
        'product': <?php echo ($product? $product : '[]'); ?>,
        'baseUrl': '/wemall',
        'uploadsUrl': '/wemall/Public/Uploads/',
        'imageUrl': '/wemall/Theme/waimai/Public/image',
        'shopId':'',
    }
    console.log(data);
</script>
<script src="/wemall/Theme/waimai/Public/js/jquery.min.js"></script>
<script src="/wemall/Theme/waimai/Public/js/path.min.js"></script>
<script src="/wemall/Theme/waimai/Public/js/jquery.cookie.js"></script>
<script src="/wemall/Theme/waimai/Public/js/swiper.min.js"></script>
<script src="/wemall/Theme/waimai/Public/js/jweixin-1.0.0.js"></script>
<script src="/wemall/Theme/waimai/Public/build/template.js"></script>
<script src="/wemall/Theme/waimai/Public/js/echo.min.js"></script>
<script src="/wemall/Theme/waimai/Public/js/layer.m.js"></script>
<script src="/wemall/Theme/waimai/Public/js/wemall.js?v=31"></script>

<script>
    $('#page_tag_load').show();
    selectShop();
</script>

</body>
</html>