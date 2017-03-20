<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WeMall微信商城后台管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/multi/Public/Admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/multi/Public/Admin/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/multi/Public/Admin/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/multi/Public/Admin/dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/multi/Public/Admin/dist/css/skins/_all-skins.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/multi/Public/Admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/multi/Public/Admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/multi/Public/Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/multi/Public/Admin/dist/js/html5shiv.min.js"></script>
    <script src="/multi/Public/Admin/dist/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/multi/Public/Admin/toastr/toastr.min.css">

    <!-- jQuery 2.1.4 -->
    <script src="/multi/Public/Admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
        var URL = '/multi/';
        var UEURL = '/multi/Public/Admin/UEditor/';
        var PUBLICURL = '/multi/Public';
        var UPLOADSURL = '/multi/Public/Uploads/';
    </script>
    <!--ueditor-->
    <script type="text/javascript" charset="utf-8" src="/multi/Public/Admin/UEditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/multi/Public/Admin/UEditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/multi/Public/Admin/UEditor/lang/zh-cn/zh-cn.js"></script>

    <script type="text/javascript" charset="utf-8" src='/multi/Public/Admin/nprogress/nprogress.js'></script>
    <link rel='stylesheet' href='/multi/Public/Admin/nprogress/nprogress.css'/>
    <link rel="stylesheet" href="/multi/Public/Admin/bootstrap/css/piAdmin.css">
</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo U('Admin/Index/index');?>" target="_self" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>We</b>Mall</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>WeMall</b>管理后台</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!--信息通知-->
                    <!--<li class="dropdown messages-menu">-->
                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                            <!--<i class="fa fa-envelope-o"></i>-->
                        <!--</a>-->
                        <!--<ul class="dropdown-menu">-->

                        <!--</ul>-->
                    <!--</li>-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                        </a>
                        <ul class="dropdown-menu">

                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <!--手机端预览-->
                    <!--<li class="dropdown tasks-menu">-->
                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                            <!--<i class="fa fa-flag-o"></i>-->
                        <!--</a>-->
                        <!--<ul class="dropdown-menu" style="height: 796px;max-width: 377px">-->
                            <!--<link rel="stylesheet" href="/multi/Public/Preview/app.css">
<div class="phone-content">
    <div class="phone">
        <iframe src="<?php echo U('App/Index/index');?>" frameborder="0"
                scrolling="yes"></iframe>
    </div>
</div>
-->
                        <!--</ul>-->
                    <!--</li>-->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/multi/Public/Admin/dist/img/avatar-wemall.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo (session('adminName')); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/multi/Public/Admin/dist/img/avatar-wemall.png" class="img-circle"
                                     alt="User Image">

                                <p>
                                    <?php echo (session('adminName')); ?>
                                    <small>管理员</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="<?php echo U('Admin/Public/logout');?>" target="_self"
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
            <!-- Sidebar user panel -->
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form" style="display: none">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="搜索..." onclick="layer.msg('此功能预留')">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" style="margin-top: 12px">
                <li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>系统首页</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Index/index');?>"><i class="fa "></i>系统首页</a></li>
        <li><a href="<?php echo U('Admin/Index/userChart');?>"><i class="fa "></i>用户分析</a></li>
        <li><a href="<?php echo U('Admin/Index/orderChart');?>"><i class="fa "></i>订单分析</a></li>
        <li><a href="<?php echo U('Admin/Index/productChart');?>"><i class="fa "></i>商品分析</a></li>
        <li><a href="<?php echo U('Admin/Index/shopChart');?>"><i class="fa "></i>店铺分析</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-gears"></i> <span>系统设置</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Config/configSet');?>"><i class="fa "></i>系统设置</a></li>
        <li><a href="<?php echo U('Admin/Config/tplSet');?>"><i class="fa "></i>模板设置</a></li>
        <li><a href="<?php echo U('Admin/Config/alipaySet');?>"><i class="fa "></i>支付宝设置</a></li>
        <!--<li><a href="<?php echo U('Admin/Config/wxPrintSet');?>"><i class="fa "></i>微信打印机设置</a></li>-->
        <!--<li><a href="<?php echo U('Admin/Config/smsSet');?>"><i class="fa "></i>短信验证设置</a></li>-->
        <li><a href="<?php echo U('Admin/Config/wxTplMsgSet');?>"><i class="fa "></i>微信模板消息设置</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-link"></i> <span>微信管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Weixin/wxSet');?>"><i class="fa "></i>微信设置</a></li>
        <li><a href="<?php echo U('Admin/Weixin/wxMenuSet');?>"><i class="fa "></i>微信菜单设置</a></li>
        <li><a href="<?php echo U('Admin/Weixin/wxReplySet');?>"><i class="fa "></i>自定义回复设置</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-edit"></i> <span>文章管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Artical/artical');?>"><i class="fa "></i>文章管理</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-shopping-cart"></i> <span>商城管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Shop/shop');?>"><i class="fa "></i>店铺管理</a></li>
        <li><a href="<?php echo U('Admin/Shop/ads');?>"><i class="fa "></i>广告管理</a></li>
        <li><a href="<?php echo U('Admin/Shop/menu');?>"><i class="fa "></i>菜单管理</a></li>
        <!-- <li><a href="<?php echo U('Admin/Shop/label');?>"><i class="fa "></i>标签管理</a></li> -->
        <li><a href="<?php echo U('Admin/Shop/product');?>"><i class="fa "></i>商品管理</a></li>
        <li><a href="<?php echo U('Admin/Shop/comment');?>"><i class="fa "></i>评论管理</a></li>
        <!--<li><a href="<?php echo U('Admin/Shop/feedback');?>"><i class="fa "></i>反馈管理</a></li>-->
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-bar-chart"></i> <span>订单管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Order/order',array('day'=>date('Y-m-d')));?>"><i class="fa "></i>当天订单</a></li>
        <li><a href="<?php echo U('Admin/Order/order');?>"><i class="fa "></i>全部订单</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('pay_status'=>0));?>"><i class="fa "></i>未付款</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('pay_status'=>1));?>"><i class="fa "></i>已付款</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('status'=>0));?>"><i class="fa "></i>未处理</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('status'=>1));?>"><i class="fa "></i>已发货</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('status'=>-4));?>"><i class="fa "></i>申请退货</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('status'=>-2));?>"><i class="fa "></i>退货中</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('status'=>-3));?>"><i class="fa "></i>退货完成</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('status'=>2));?>"><i class="fa "></i>交易完成</a></li>
        <li><a href="<?php echo U('Admin/Order/order',array('status'=>-1));?>"><i class="fa "></i>交易取消</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-credit-card"></i> <span>财务管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Trade/trade');?>"><i class="fa "></i>财务管理</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-group"></i> <span>用户管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/User/authGroup');?>"><i class="fa "></i>用户组管理</a></li>
        <li><a href="<?php echo U('Admin/User/admin');?>"><i class="fa "></i>管理员管理</a></li>
        <li><a href="<?php echo U('Admin/User/user');?>"><i class="fa "></i>用户管理</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-inbox"></i> <span>插件管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Admin/Addon/addon');?>"><i class="fa "></i>插件管理</a></li>
        <li><a href="<?php echo U('Admin/Addon/addonShop');?>"><i class="fa "></i>插件商店</a></li>
    </ul>
</li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
    <h1>
        商城管理
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
                    <h3 class="box-title">反馈管理</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Admin/Shop/exportFeedback');?>" target="_blank" class="btn btn-danger ">
                                导出全部反馈
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
                                <th>店铺ID</th>
                                <th>用户ID</th>
                                <th>反馈</th>
                                <th>时间</th>
                            </tr>
                            <?php if(is_array($feedback)): $i = 0; $__LIST__ = $feedback;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$feedback): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($feedback["id"]); ?>"></label>
                                    </td>
                                    <td>
                                        <?php echo ($feedback["id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($feedback["shop_id"]); ?>
                                    </td>                                    
                                    <td>
                                        <?php echo ($feedback["user_id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($feedback["value"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($feedback["time"]); ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Shop/exportFeedback');?>',false)">导出
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
            <b>Version</b> 5.1.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://www.inuoer.com">inuoer.com</a>.</strong> All rights
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
    <div class="lcont"><img src="/multi/Public/Admin/dist/img/loading.gif" alt="loading...">正在加载...</div>
</div>

<!-- Bootstrap 3.3.5 -->
<script src="/multi/Public/Admin/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="/multi/Public/Admin/plugins/chartjs/Chart.min.js"></script>
<!-- daterangepicker -->
<script src="/multi/Public/Admin/dist/js/moment.min.js"></script>
<script src="/multi/Public/Admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/multi/Public/Admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/multi/Public/Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/multi/Public/Admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/multi/Public/Admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="/multi/Public/Admin/dist/js/app.min.js?v=1"></script>
<!--layer-->
<script src="/multi/Public/Admin/layer/layer.js"></script>
<!-- Bmap -->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&amp;ak=BtCUE2NQjVUTSjctQELcfULl"></script>
<script type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&amp;ak=BtCUE2NQjVUTSjctQELcfULl&amp;services=&amp;t=20160310104956"></script>
<!--toastr-->
<script src="/multi/Public/Admin/toastr/toastr.min.js"></script>
<!--bootbox-->
<script src="/multi/Public/Admin/bootbox/bootbox.js"></script>
<!--pjax-->
<script src="/multi/Public/Admin/pjax/jquery.pjax.js"></script>
<!--jquery.form-->
<script src="/multi/Public/Admin/form/jquery.form.js"></script>
<!--template-->
<script src="/multi/Public/Admin/dist/js/template.js"></script>
<script src="/multi/Public/Admin/dist/js/wemall.js?v=2"></script>

</body>
</html>