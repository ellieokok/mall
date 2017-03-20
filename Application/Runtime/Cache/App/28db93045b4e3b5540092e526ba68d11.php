<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=100%, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title><?php echo ($name); ?></title>
    <link rel="stylesheet" href="/waimai/Theme/default1/Public/css/style.css?v=2">
    <link rel="stylesheet" href="/waimai/Theme/default1/Public/css/icon/iconfont.css">
    <link rel="stylesheet" href="/waimai/Theme/default1/Public/css/iphone.css">
    <link rel="stylesheet" href="/waimai/Theme/default1/Public/css/swiper.min.css">
</head>
<body>

<div id="main"></div>

<div id="page_tag_load"><img src="/waimai/Theme/default1/Public/image/ajax-loader.gif" alt="loader"></div>
<div class="navigation-wrap">
    <a class="navigation-item selected" id="nav-ads" href="#/index" onclick="openAds(this)">
        <div class="icon-home selected"></div>
        <div>首页</div>
    </a>
    <a class="navigation-item" id="nav-product" href="#/product" onclick="openProduct(this)">
        <div class="icon-product"></div>
        <div>全部商品</div>
    </a>
    <a class="navigation-item" id="nav-cart" href="#/cart" onclick="openCart(this)">
        <div class="icon-cart">
            <div class="icon-hit" id="shopcart-tip" style="display:none"></div>
        </div>
        <div>购物车</div>
    </a>
    <a class="navigation-item" id="nav-user" href="#/user" onclick="openUser(this)">
        <div class="icon-user"></div>
        <div>我的</div>
    </a>
</div>

<script>
    var cartData = [];
    var totalNum = 0;
    var totalPrice = 0;
    var area = '';
    var payment = -1;
    var data = {
        'config': <?php echo ($config? $config : '[]'); ?>,
        'user': <?php echo ($user? $user : '[]'); ?>,
        'ads': <?php echo ($ads? $ads : '[]'); ?>,
        'menu': <?php echo ($menu? $menu : '[]'); ?>,
        'product': <?php echo ($product? $product : '[]'); ?>,
        'baseUrl': '/waimai/index.php',
        'uploadsUrl': '/waimai/Public/Uploads/',
        'imageUrl': '/waimai/Theme/default1/Public/image',
    }
    console.log(data);
</script>
<script src="/waimai/Theme/default1/Public/js/jquery.min.js"></script>
<script src="/waimai/Theme/default1/Public/js/path.min.js"></script>
<script src="/waimai/Theme/default1/Public/js/jquery.cookie.js"></script>
<script src="/waimai/Theme/default1/Public/js/swiper.min.js"></script>
<script src="/waimai/Theme/default1/Public/js/jweixin-1.0.0.js"></script>
<script src="/waimai/Theme/default1/Public/build/template.js"></script>
<script src="/waimai/Theme/default1/Public/js/echo.min.js"></script>
<script src="/waimai/Theme/default1/Public/js/layer.m.js"></script>
<script src="/waimai/Theme/default1/Public/js/wemall.js?v=7"></script>
</body>
</html>