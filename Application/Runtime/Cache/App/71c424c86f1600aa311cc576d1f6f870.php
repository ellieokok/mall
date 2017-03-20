<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=100%, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title id="oti"></title>
    <link rel="stylesheet" href="/multi_putong/Theme/waimai/Public/css/style.css?v=7">
    <link rel="stylesheet" href="/multi_putong/Theme/waimai/Public/css/shop.css?v=2">
    <link rel="stylesheet" href="/multi_putong/Theme/waimai/Public/css/icon/iconfont.css">
    <link rel="stylesheet" href="/multi_putong/Theme/waimai/Public/css/iphone.css">
    <link rel="stylesheet" href="/multi_putong/Theme/waimai/Public/css/swiper.min.css">
</head>
<body>

<div id="main"></div>

<div id="page_tag_load"><img src="/multi_putong/Theme/waimai/Public/image/ajax-loader.gif" alt="loader"></div>
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
    var isbindPhone = '<?php echo ($bindPhone); ?>';
    var oauthlogin = '<?php echo ($oauthlogin); ?>';    
    var data = {
        'wxConfig': <?php echo ($wxConfig? $wxConfig : '[]'); ?>,
        'config': <?php echo ($config? $config : '[]'); ?>,
        'user': <?php echo ($user? $user : '[]'); ?>,
        'ads': <?php echo ($ads? $ads : '[]'); ?>,
        'menu': <?php echo ($menu? $menu : '[]'); ?>,
        'product': <?php echo ($product? $product : '[]'); ?>,
        'baseUrl': '/multi_putong',
        'uploadsUrl': '/multi_putong/Public/Uploads/',
        'imageUrl': '/multi_putong/Theme/waimai/Public/image',
        'shopId':'',
    }
    console.log(data);
</script>
<script src="/multi_putong/Theme/waimai/Public/js/jquery.min.js"></script>
<script src="/multi_putong/Theme/waimai/Public/js/path.min.js"></script>
<script src="/multi_putong/Theme/waimai/Public/js/jquery.cookie.js"></script>
<script src="/multi_putong/Theme/waimai/Public/js/swiper.min.js"></script>
<script src="/multi_putong/Theme/waimai/Public/js/jweixin-1.0.0.js"></script>
<script src="/multi_putong/Theme/waimai/Public/build/template.js?v=26"></script>
<script src="/multi_putong/Theme/waimai/Public/js/echo.min.js"></script>
<script src="/multi_putong/Theme/waimai/Public/js/layer.m.js"></script>
<script src="/multi_putong/Theme/waimai/Public/js/wemall.js?v=26"></script>

<script>
    $('#oti').html(data.config.name);
</script>
</body>
</html>