<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>wemall多用户微信商城后台管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/dist/css/skins/_all-skins.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/wemall-multiUser/Public/Admin/dist/js/html5shiv.min.js"></script>
    <script src="/wemall-multiUser/Public/Admin/dist/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/wemall-multiUser/Public/Admin/toastr/toastr.min.css">

    <!-- jQuery 2.1.4 -->
    <script src="/wemall-multiUser/Public/Admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
        var URL = '/wemall-multiUser/';
        var UEURL = '/wemall-multiUser/Public/Admin/UEditor/';
        var PUBLICURL = '/wemall-multiUser/Public';
        var UPLOADSURL = '/wemall-multiUser/Public/Uploads/';
    </script>
    <!--ueditor-->
    <script type="text/javascript" charset="utf-8" src="/wemall-multiUser/Public/Admin/UEditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/wemall-multiUser/Public/Admin/UEditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/wemall-multiUser/Public/Admin/UEditor/lang/zh-cn/zh-cn.js"></script>

    <script type="text/javascript" charset="utf-8" src='/wemall-multiUser/Public/Admin/nprogress/nprogress.js'></script>
    <link rel='stylesheet' href='/wemall-multiUser/Public/Admin/nprogress/nprogress.css'/>

    <link rel='stylesheet' href='/wemall-multiUser/Public/Home/dist/css/lrtk.css'/>
    <script type="text/javascript" charset="utf-8" src='/wemall-multiUser/Public/Home/dist/js/lrtk.js'></script>
</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
    <div id="top"></div>
    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>wemall</b>管理后台</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-exchange"></i>
                            <?php echo ($shopBar['name']?$shopBar['name']:'选择店铺'); ?>
                        </a>


                        <ul class="dropdown-menu">
                            <li class="header">请选择店铺</li>
                            <?php if(is_array($shopBarList)): $i = 0; $__LIST__ = $shopBarList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shopBarList): $mod = ($i % 2 );++$i;?><li>
                                    <a href="<?php echo U('Home/Shop/switchShop',array('id'=>$shopBarList['id']));?>"
                                       target="_parent" style="color:#dd4b39">
                                        <i class="fa fa-exchange"></i>
                                        <?php echo ($shopBarList["name"]); ?>
                                    </a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <li class="footer"><a href="#"></a></li>
                        </ul>

                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/wemall-multiUser/Public/Admin/dist/img/avatar-wemall.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo (session('homeName')); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/wemall-multiUser/Public/Admin/dist/img/avatar-wemall.png" class="img-circle"
                                     alt="User Image">

                                <p>
                                    <?php echo (session('homeName')); ?>
                                    <small>管理员</small>
                                </p>
                            </li>
                            <style type="text/css">
                                .infobox {
                                    display: inline-block;
                                    width: 100%;
                                    color: #555;
                                    background-color: #FFF;
                                    box-shadow: none;
                                    margin: -1px 0 0 -1px;
                                    padding: 8px 3px 6px 9px;
                                    border: 1px dotted;
                                    border-color: #D8D8D8 !important;
                                    vertical-align: middle;
                                    text-align: left;
                                    position: relative;
                                }

                                .infobox > .infobox-data {
                                    display: inline-block;
                                    border-width: 0;
                                    font-size: 13px;
                                    text-align: left;
                                    line-height: 21px;
                                    min-width: 130px;
                                    padding-left: 8px;
                                    position: relative;
                                    top: 0;
                                }

                                .infobox > .infobox-data > .infobox-data-number {
                                    display: block;
                                    font-size: 22px;
                                    margin: 2px 0 4px;
                                    position: relative;
                                    text-shadow: 1px 1px 0 rgba(0, 0, 0, .15);
                                }

                                .infobox .infobox-content {
                                    color: #555;
                                }

                                .get-member {
                                    position: absolute;
                                    right: 10px;
                                    top: 12px;
                                    cursor: pointer;
                                }

                                .label-sm {
                                    padding: .2em .4em .3em;
                                    font-size: 11px;
                                    line-height: 1;
                                    height: 18px;
                                }
                            </style>
                            <!--<div class="infobox infobox-pink">-->
                            <!--    <div class="infobox-data">-->
                            <!--        <span class="infobox-data-number" style="font-size: 18px;">-->
                            <!--            <?php if(!empty($member)): ?>-->
                            <!--                <?php echo ($member["level"]); ?>-->
                            <!--                <?php else: ?>-->
                            <!--                免费版-->
                            <!--<?php endif; ?>-->
                            <!--        </span>-->
                            <!--        <div class="infobox-content">-->
                            <!--            开始时间:<?php echo date('Y-m-d H:i:s',$member['start_time']);?>-->
                            <!--        </div>-->
                            <!--        <div class="infobox-content">-->
                            <!--            结束时间:<?php echo date('Y-m-d H:i:s',$member['end_time']);?>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <a href="<?php echo U('Admin/Buy/pay',array('type'=>1));?>" class="get-member label label-sm label-danger">-->
                            <!--        升级会员-->
                            <!--    </a>-->
                            <!--</div>-->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="<?php echo U('Home/Public/logout');?>" target="_self"
                                   class="btn btn-default btn-flat">注销</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" style="margin-top: 12px">
                <li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>店铺首页</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Home/Index/index');?>"><i class="fa "></i>店铺首页</a></li>
        <li><a href="<?php echo U('Home/Index/productChart');?>"><i class="fa "></i>商品分析</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-gears"></i> <span>系统设置</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Home/Shop/modifyShop');?>"><i class="fa "></i>商城设置</a></li>
        <li><a href="<?php echo U('Home/Config/address');?>"><i class="fa "></i>地址设置</a></li>
        <li><a href="<?php echo U('Home/Config/wxPrintSet');?>"><i class="fa "></i>微信打印机设置</a></li>
        <!--<li><a href="<?php echo U('Home/Config/wxTplMsgSet');?>"><i class="fa "></i>微信模板消息设置</a></li>-->

    </ul>
</li>

<!--<li class="treeview">-->
<!--    <a href="#">-->
<!--        <i class="fa fa-link"></i> <span>微信管理</span> <i-->
<!--            class="fa fa-angle-right pull-right"></i>-->
<!--    </a>-->
<!--    <ul class="treeview-menu">-->
<!--        <li><a href="<?php echo U('Home/Weixin/wxSet');?>"><i class="fa "></i>微信设置</a></li>-->
<!--        <li><a href="<?php echo U('Home/Weixin/wxMenuSet');?>"><i class="fa "></i>微信菜单设置</a></li>-->
<!--        <li><a href="<?php echo U('Home/Weixin/wxReplySet');?>"><i class="fa "></i>自定义回复设置</a></li>-->
<!--    </ul>-->
<!--</li>-->


<li class="treeview">
    <a href="#">
        <i class="fa fa-shopping-cart"></i> <span>商城管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Home/Shop/shop');?>"><i class="fa "></i>店铺管理</a></li>
        <li><a href="<?php echo U('Home/Shop/ads');?>"><i class="fa "></i>广告管理</a></li>
        <li><a href="<?php echo U('Home/Shop/menu');?>"><i class="fa "></i>菜单管理</a></li>
        <li><a href="<?php echo U('Home/Shop/label');?>"><i class="fa "></i>标签管理</a></li>
        <li><a href="<?php echo U('Home/Shop/product');?>"><i class="fa "></i>商品管理</a></li>
        <li><a href="<?php echo U('Home/Shop/comment');?>"><i class="fa "></i>评论管理</a></li>
        <!--<li><a href="<?php echo U('Home/Shop/feedback');?>"><i class="fa "></i>反馈管理</a></li>-->
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-edit"></i> <span>文章管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Home/Artical/artical');?>"><i class="fa "></i>文章管理</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-bar-chart"></i> <span>订单管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Home/Order/order',array('day'=>date('Y-m-d')));?>"><i class="fa "></i>当天订单</a></li>
        <li><a href="<?php echo U('Home/Order/order');?>"><i class="fa "></i>全部订单</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('pay_status'=>0));?>"><i class="fa "></i>未付款</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('pay_status'=>1));?>"><i class="fa "></i>已付款</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('status'=>0));?>"><i class="fa "></i>未处理</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('status'=>1));?>"><i class="fa "></i>已发货</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('status'=>-4));?>"><i class="fa "></i>申请退货</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('status'=>-2));?>"><i class="fa "></i>退货中</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('status'=>-3));?>"><i class="fa "></i>退货完成</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('status'=>2));?>"><i class="fa "></i>交易完成</a></li>
        <li><a href="<?php echo U('Home/Order/order',array('status'=>-1));?>"><i class="fa "></i>交易取消</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-credit-card"></i> <span>财务管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Home/Trade/trade');?>"><i class="fa "></i>财务管理</a></li>
        <!--<li><a href="<?php echo U('Home/Trade/tx');?>"><i class="fa "></i>提现管理</a></li>-->
    </ul>
</li>

<!--    <li class="treeview">-->
<!--        <a href="#">-->
<!--            <i class="fa fa-star"></i> <span>产品购买</span> <i-->
<!--                class="fa fa-angle-right pull-right"></i>-->
<!--        </a>-->
<!--        <ul class="treeview-menu">-->
<!--            <li><a href="<?php echo U('Home/Buy/pay');?>"><i class="fa "></i>会员充值</a></li>-->
<!--        </ul>-->
<!--    </li>-->

<!--<li class="treeview">-->
<!--    <a href="#">-->
<!--        <i class="fa fa-bullhorn"></i> <span>营销管理</span> <i-->
<!--            class="fa fa-angle-right pull-right"></i>-->
<!--    </a>-->
<!--    <ul class="treeview-menu">-->
<!--        <li><a href="<?php echo U('Home/Coupon/config');?>"><i class="fa "></i>优惠券管理</a></li>-->
<!--        <li><a href="<?php echo U('Home/Card/config');?>"><i class="fa "></i>会员卡管理</a></li>-->
<!--    </ul>-->
<!--</li>-->

<li class="treeview">
    <a href="#">
        <i class="fa fa-group"></i> <span>用户管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <!--<li><a href="<?php echo U('Home/User/employee');?>"><i class="fa "></i>员工管理</a></li>-->
        <!--<li><a href="<?php echo U('Home/User/admin');?>"><i class="fa "></i>管理员管理</a></li>-->
        <li><a href="<?php echo U('Home/User/user');?>"><i class="fa "></i>用户管理</a></li>
    </ul>
</li>

<!--<li class="treeview">-->
<!--    <a href="#">-->
<!--        <i class="fa fa-inbox"></i> <span>使用帮助</span> <i-->
<!--            class="fa fa-angle-right pull-right"></i>-->
<!--    </a>-->
<!--    <ul class="treeview-menu">-->
<!--        <li><a href="<?php echo U('Home/Help/manual');?>"><i class="fa "></i>使用手册</a></li>-->
<!--        <li><a href="<?php echo U('Home/Help/operate');?>"><i class="fa "></i>运营干货</a></li>-->
<!--    </ul>-->
<!--</li>-->

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
    <h1>
        用户管理
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">管理员管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Home/User/addAdmin');?>" class="btn btn-danger ">
                                新增管理员
                            </a>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th class="hidden-xs">
                                    <label><input onchange="checkAll()" type="checkbox" value=""></label>
                                </th>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>用户组</th>
                                <th>手机号</th>
                                <th>邮箱</th>
                                <th>状态</th>
                                <th>备注</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($userList)): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox" value="<?php echo ($user["id"]); ?>"></label>
                                    </td>
                                    <td><?php echo ($user["id"]); ?></td>
                                    <td><?php echo ($user["username"]); ?></td>
                                    <td><?php echo ($user["group"]["title"]); ?></td>
                                    <td><?php echo ($user["phone"]); ?></td>
                                    <td><?php echo ($user["email"]); ?></td>
                                    <td>
                                        <?php if($user["status"] == 1): ?>启用<?php endif; ?>
                                        <?php if($user["status"] == 0): ?><span style="color: red">禁用</span><?php endif; ?>
                                    </td>
                                    <td><?php echo ($user["remark"]); ?></td>
                                    <td><?php echo ($user["time"]); ?></td>
                                    <td class="table-action"><a
                                            href="<?php echo U('Home/User/modAdmin',array('id'=>$user['id']));?>">修改</a>
                                        <?php if(($user["id"]) > "1"): ?><a href="<?php echo U('Home/User/delAdmin',array('id'=>$user['id']));?>">删除</a><?php endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Home/User/delAdmin');?>')">全部删除
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                                <div class="pull-right">
                                    <?php echo ($page); ?>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                        </div>
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
</section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 5.0.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a
                href="http://www.inuoer.com">www.inuoer.com</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-light">

    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div id="loading" style="top: 150px;">
    <div class="lbk"></div>
    <div class="lcont"><img src="/wemall-multiUser/Public/Admin/dist/img/loading.gif" alt="loading...">正在加载...</div>
</div>

<!-- Bootstrap 3.3.5 -->
<script src="/wemall-multiUser/Public/Admin/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="/wemall-multiUser/Public/Admin/plugins/chartjs/Chart.min.js"></script>
<!-- daterangepicker -->
<script src="/wemall-multiUser/Public/Admin/dist/js/moment.min.js"></script>
<script src="/wemall-multiUser/Public/Admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/wemall-multiUser/Public/Admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/wemall-multiUser/Public/Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/wemall-multiUser/Public/Admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/wemall-multiUser/Public/Admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="/wemall-multiUser/Public/Admin/dist/js/app.min.js?v=1"></script>
<!--layer-->
<script src="/wemall-multiUser/Public/Admin/layer/layer.js"></script>
<!--toastr-->
<script src="/wemall-multiUser/Public/Admin/toastr/toastr.min.js"></script>
<!--bootbox-->
<script src="/wemall-multiUser/Public/Admin/bootbox/bootbox.js"></script>
<!--pjax-->
<script src="/wemall-multiUser/Public/Admin/pjax/jquery.pjax.js"></script>
<!--jquery.form-->
<script src="/wemall-multiUser/Public/Admin/form/jquery.form.js"></script>
<script src="/wemall-multiUser/Public/Admin/dist/js/template.js"></script>
<script src="/wemall-multiUser/Public/Home/dist/js/wemall.js?v=2"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BtCUE2NQjVUTSjctQELcfULl"></script>

</body>
</html>