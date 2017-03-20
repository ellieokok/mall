<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=100%, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>订单管理中心</title>
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/style.min.css">
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/iphone.min.css">
    <link rel="stylesheet" href="/wemall/Theme/waimai/Public/css/swiper.min.css">
    <style type="text/css">
        .pagination {
            margin: 12px 0;
            text-align: center;
        }
        .current {
            float: left;
            width: 47px;
            height: 24px;
            line-height: 24px;
            border: 1px solid #3e3e3e;
            text-align: center;
            font-size: 12px;
            color: #2c2c2c;
            cursor: pointer;
            border-color: #fafaf0 #fafaf0 #dfdfdf;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fafaf0', endColorstr='#dfdfdf', GradientType=0);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)
        }
        .current {
            background-color: #ff6703;
            color: #fff;
        }

        .num{
            float: left;
            width: 47px;
            height: 24px;
            line-height: 24px;
            border: 1px solid #3e3e3e;
            text-align: center;
            font-size: 12px;
            color: #2c2c2c;
            cursor: pointer;
            border-color: #fafaf0 #fafaf0 #dfdfdf;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fafaf0', endColorstr='#dfdfdf', GradientType=0);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)
        }

        .prev{
            float: left;
            width: 47px;
            height: 24px;
            line-height: 24px;
            border: 1px solid #3e3e3e;
            text-align: center;
            font-size: 12px;
            color: #2c2c2c;
            cursor: pointer;
            border-color: #fafaf0 #fafaf0 #dfdfdf;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fafaf0', endColorstr='#dfdfdf', GradientType=0);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)
        }

        .next{
            float: left;
            width: 47px;
            height: 24px;
            line-height: 24px;
            border: 1px solid #3e3e3e;
            text-align: center;
            font-size: 12px;
            color: #2c2c2c;
            cursor: pointer;
            border-color: #fafaf0 #fafaf0 #dfdfdf;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fafaf0', endColorstr='#dfdfdf', GradientType=0);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)
        }
    </style>
</head>

<body>
<div id="main" style="margin: 0px;padding: 0px;">
    <div class="container-gird" style="margin-top: 0px;">
        <div class="confirmation-form">
            <div class="confirmation-list">
                <img src="<?php echo ($user["avater"]); ?>" class="avater lazy">
                <div style="text-align: center;padding: 10px 0px;">员工</div>
                <div class="divider" style="background-color: #f5f5f0"></div>
                <div class="dotted-divider" style="width: 105.263157894737%; margin-left: -2.9%"></div>
                <ul>
                    <li>
                        <div class="confirmation-item">
                            <div class="item-info">
                                <span class="item-name">我的账号:<br></span>
                            </div>
                            <div class="select-box" id="nickname"><?php echo ($user['username']?$user['username']:'匿名'); ?></div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="my-order-header">
        <span>订单管理</span>

        <div class="dotted-divider"></div>
    </div>

    <div class="myOrderList">
        <div>
            <div class="container-gird" style="margin-top: 20px;padding: 10px;">
                <!--<div class="orderResult-form"></div>-->
                <div>
                    <div class="orderResult-list" id="items-order-result-list">
                        <ul>
                            <?php if(empty($order)): ?><div style="text-align: center;padding: 10px;">暂无要处理的订单</div><?php endif; ?>
                            <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li>
                                    <div class="order-info"><span class="number">订单号：<span id="order-no"><?php echo ($order["orderid"]); ?></span></span><span
                                            class="date" style="float: right"><?php echo ($order["time"]); ?></span><span
                                            class="order-status">
                                        <?php $pay_status = '未付款'; if ($order["pay_status"] == 1) { $pay_status = '已付款'; } $order_status = '未处理'; if ($order["status"] == 1) { $order_status = '正在配送'; } else if ($order["status"] == 2) { $order_status = '已完成'; } else if ($order["status"] == -1) { $order_status = '已取消'; } ?>
                                        <?php echo ($pay_status); ?>,<?php echo ($order_status); ?>
                                    </span></div>
                                    <div class="order-list" id="item-order-list">
                                        <ul>
                                            <?php if(is_array($order["detail"])): $i = 0; $__LIST__ = $order["detail"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($i % 2 );++$i;?><li><span class="order-item-name"><?php echo ($detail["name"]); ?></span><span
                                                    class="order-item-price">￥<?php echo ($detail["price"]); ?></span><span
                                                    class="order-item-amount"><?php echo ($detail["num"]); ?>份</span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                        <div class="mytotal-info"><span class="deliver">运费：<?php echo ($order["freight"]); ?>元</span><span class="total">共<?php echo ($order["totalprice"]); ?>元</span>
                                        </div>
                                        <div class="mytotal-info"><span class="deliver">联系人：<?php echo ($order["contact"]["name"]); ?></span></div>
                                        <div class="mytotal-info"><span class="deliver">联系方式：<?php echo ($order["contact"]["phone"]); ?></span></div>
                                        <div class="mytotal-info"><span class="deliver">配送地址：<?php echo ($order["contact"]["city"]); ?>-<?php echo ($order["contact"]["area"]); ?>-<?php echo ($order["contact"]["address"]); ?></span></div>
                                    </div>
                                    <div class="order-footer">
                                        <span class="payOrder" onclick="openUrl('<?php echo U('App/Admin/orderCancel',array('id'=>$order['id']));?>')">取消</span>
                                        <!--<span class="payOrder" onclick="openUrl('<?php echo U('App/Admin/orderWxPrint',array('id'=>$order['id']));?>')">打印</span>-->
                                        <span class="payOrder" onclick="openUrl('<?php echo U('App/Admin/orderPublish',array('id'=>$order['id']));?>')">发货</span>
                                        <span class="payOrder" onclick="openUrl('<?php echo U('App/Admin/orderComplete',array('id'=>$order['id']));?>')">完成</span>
                                        <!--<span class="payOrder" onclick="openUrl('<?php echo U('App/Admin/orderPayComplete',array('id'=>$order['id']));?>')">已支付</span>-->
                                    </div>
                                    <div class="divider"></div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="page_tag_load"><img src="/wemall/Theme/waimai/Public/image/ajax-loader.gif" alt="loader"></div>

    <div style="display: none">
        <a href="javascript:void(0);" style="text-align: center;background-color: #fff; color: #949494;font-size: 12px;display: block;">inuoer</a>
    </div>

</div>

<script src="/wemall/Theme/waimai/Public/js/jquery.min.js"></script>
<script src="/wemall/Theme/waimai/Public/js/jquery.lazyload.js"></script>

<script>
    function openUrl(url) {
        $.ajax({
            type: "get",
            url: url,
            success: function () {
                window.location.reload()
            },
            beforeSend: function () {
                $("#page_tag_load").show();
            },
            complete: function () {
                $("#page_tag_load").hide();
            }
        });
    }
</script>
</body>
</html>