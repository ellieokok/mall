<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=100%, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title></title>
    <link rel="stylesheet" href="/wemall-chajian/Theme/default/Public/css/style.css?v=3">
    <link rel="stylesheet" href="/wemall-chajian/Theme/default/Public/css/iphone.css">
    <link rel="stylesheet" href="/wemall-chajian/Theme/default/Public/css/swiper.min.css">
</head>
<body>

<div class="header-bar">
    <div class="header-left" onclick="headerBack()"></div>
    <div class="header-title"><?php echo ($name); ?></div>
</div>

<div id="main"></div>

<div id="page_tag_load"><img src="/wemall-chajian/Theme/default/Public/image/ajax-loader.gif" alt="loader"></div>
<div class="navigation-wrap">
    <a class="navigation-item selected" id="nav-ads" onclick="openAds(this)">
        <div class="icon-home selected"></div>
        <div>首页</div>
    </a>
    <a class="navigation-item" id="nav-product" onclick="openProduct(this)">
        <div class="icon-product"></div>
        <div>全部商品</div>
    </a>
    <a class="navigation-item" id="nav-cart" onclick="openCart(this)">
        <div class="icon-cart">
            <div class="icon-hit" id="shopcart-tip" style="display:none"></div>
        </div>
        <div>购物车</div>
    </a>
    <a class="navigation-item" id="nav-user" onclick="openUser(this)">
        <div class="icon-user"></div>
        <div>我的账户</div>
    </a>
</div>

<script>
    var cartData = [];
    var totalNum = 0;
    var totalPrice = 0;
    var discount = 0;
    var area = '';
    var payment = -1;
    var data = {
        'config': <?php echo ($config? $config : '[]'); ?>,
        'user': <?php echo ($user? $user : '[]'); ?>,
        'ads': <?php echo ($ads? $ads : '[]'); ?>,
        'menu': <?php echo ($menu? $menu : '[]'); ?>,
        'product': <?php echo ($product? $product : '[]'); ?>,
        'baseUrl': '/wemall-chajian/index.php',
        'uploadsUrl': '/wemall-chajian/Public/Uploads/',
        'imageUrl': '/wemall-chajian/Theme/default/Public/image',
    }
</script>
<script src="/wemall-chajian/Theme/default/Public/js/jquery.min.js"></script>
<script src="/wemall-chajian/Theme/default/Public/js/jquery.cookie.js"></script>
<script src="/wemall-chajian/Theme/default/Public/js/swiper.min.js"></script>
<script src="/wemall-chajian/Theme/default/Public/js/jweixin-1.0.0.js"></script>
<script src="/wemall-chajian/Theme/default/Public/build/template.js"></script>
<script src="/wemall-chajian/Theme/default/Public/js/echo.min.js"></script>
<script src="/wemall-chajian/Theme/default/Public/js/layer.m.js"></script>
<script src="/wemall-chajian/Theme/default/Public/js/path.min.js"></script>
<script src="/wemall-chajian/Theme/default/Public/js/wemall.js?v=9"></script>
</body>
</html>