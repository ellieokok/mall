<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo ($config["name"]); ?></title>
    <meta name="format-detection" content="telephone=no, address=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- apple devices fullscreen -->
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="/wemall/Addons/Apply/View/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/wemall/Addons/Apply/View/Public/css/font-awesome.min.css" rel="stylesheet">
    <link href="/wemall/Addons/Apply/View/Public/css/animate.css" rel="stylesheet">
    <link href="/wemall/Addons/Apply/View/Public/css/common.css" rel="stylesheet">
    <link href="/wemall/Addons/Apply/View/Public/css/sign.css" rel="stylesheet">

    <script type="text/javascript" src="/wemall/Addons/Apply/View/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/wemall/Addons/Apply/View/Public/js/bootstrap.min.js"></script>

    <style type="text/css">
        #page_tag_load {
            display: none;
            font-size: 14px;
            position: fixed;
            bottom: 70px;
            height: 16px;
            margin-left: -29px;
            left: 50%
        }
    </style>
</head>
<body>
<div class="container container-fill">
    <div class="pcenter-main">
        <div class="head">
            <div class="pdetail">
                <div class="img-circle"><img src="<?php echo ($user["avater"]); ?>"></div>
                <div class="pull-left">
                    <span class="name"><?php echo ($user["username"]); ?></span>
                    <span class="type">会员ID: <?php echo ($user["id"]); ?></span>
                </div>
            </div>
            <div class="head-nav">
                <a class="head-nav-list"
                   href="">累计报名<span><?php echo ($config["apply"]); ?></span></a>
                <a class="head-nav-list"
                   href="">访问量<span><?php echo ($config["visiter"]); ?></span></a>
            </div>
        </div>
    </div>
    <div class="scroll-container">
        <div class="wrapper">
            <ul class="list-group">
                <li class="list-group-item" style="padding: 0px 0px;border-bottom: 1px solid #ccc;">
                    <div class="con">
                        <div class="list-hd">
                            <h5>项目：</h5><span><?php echo ($config["event"]); ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item" style="padding: 1px 0px;border-bottom: 1px solid #ccc;">
                    <div class="con">
                        <div class="list-hd">
                            <h5>时间：</h5><span><?php echo ($config["time_range"]); ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item" style="padding: 0px;">
                    <div class="con">
                        <div class="list-hd">
                            <h5>项目介绍：</h5><span><?php echo ($config["introduce"]); ?></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <ul class="nav nav-bardown nav-justified" style="z-index:10;">
        <li><a><span class="btn btn-default" style="border-radius: 50px;padding: 11.5px 30px;" onclick="submitApply();">点击报名</span></a></li>
    </ul>

    <div id="page_tag_load"><img src="/wemall/Addons/Apply/View/Public/image/ajax-loader.gif" alt="loader"></div>

    <div id="cover2" style="display: none; position: fixed; width: 100%; height: 100%;"></div>
    <div class="tc_c2" id="join_box"
         style="left: 0px; bottom: 0px; z-index: 3000; position: fixed; display: none;width: 100%;">
        <div class="join_box_Xq_out" style="max-height: 641px;">
            <div class="tc_c_close">
                <div><img title="关闭" onclick="hidePop(this);" ontouchstart="" src="/wemall/Addons/Apply/View/Public/image/share_qr_close3.png"></div>
            </div>
            <div class="join_box_Xq">
                <ul id="ul_join_property" class="pop_massage">
                    <li>
                        <div class="optionsName">姓名</div>
                        <div class="inpoutK">
                            <input value="<?php echo ($contact["name"]); ?>" type="text" class="font0" name="name" id="name">
                        </div>
                    </li>
                    <li>
                        <div class="optionsName">手机</div>
                        <div class="inpoutK">
                            <input value="<?php echo ($contact["phone"]); ?>" type="text" class="font0" name="phone" id="phone">
                        </div>
                    </li>
                    <li>
                        <div class="optionsName">地址</div>
                        <div class="inpoutK">
                            <input value="<?php echo ($contact["address"]); ?>" type="text" class="font0" name="address" id="address">
                        </div>
                    </li>
                    <li>
                        <div class="optionsName">项目</div>
                        <div class="inpoutK">
                            <!--<input value="<?php echo ($contact["address"]); ?>" type="text" class="font0" name="address" id="address">-->
                            <select name="event" style="width: 98%;" id="event">
                                <?php if(is_array($event)): $i = 0; $__LIST__ = $event;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$event): $mod = ($i % 2 );++$i;?><option value="<?php echo ($event); ?>"><?php echo ($event); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="optionsName">备注</div>
                        <div class="inpoutK">
                            <input value="" type="text" class="font0" name="note" id="note">
                        </div>
                    </li>
                </ul>
            </div>

            <div class="tc_c_btn2" ontouchstart="" id="xdBtn">
                <a title="返回" class="fanHui" href="javascript:void(0);" ontouchstart="" onclick="_joinBox._prev()"
                   style="display: none;"></a>

                <div class="join_Btn">
                    <input id="input_submit" class="blueBtn" type="submit" value="我要报名"
                           style="display: none; width: 100%;">
                    <a style="width: 100%;" id="a_submit" class="blueBtn font02" href="javascript:void(0);"
                       onclick="submitOrder()">提交</a>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    function submitApply(){
        $('#cover2').show();
        $('#join_box').show();
    }
    function hidePop(){
        $("#join_box").hide();
        $("#cover2").hide();
    }
    var submitFlag = true;
    function submitOrder(){
        if (submitFlag == false) {
            alert("请不要重复操作!");
            return;
        };
        var name = $('#name').val();
        var phone = $('#phone').val();
        var event = $('#event').val();
        var note = $('#note').val();
        var address = $('#address').val();
     

        if (name.length == 0 || phone.length == 0) {
            alert("请核对输入的信息!");
            return;
        };
        submitFlag = false;

        $.ajax({
            type: "post",
            url: "<?php echo u_addons('Apply://Index/addOrder');?>",
            data: {
                name: name,
                phone: phone,
                event: event,
                note: note,
                address: address
            },
            success: function (data) {
                if(data){
                    hidePop();
                    alert("报名成功!");
                    location.reload();
                }
            },
            beforeSend: function () {
                $('#page_tag_load').show();
            },
            complete: function () {
                $('#page_tag_load').hide();
                submitFlag = true;
            }

        });
    }
</script>
</body>
</html>