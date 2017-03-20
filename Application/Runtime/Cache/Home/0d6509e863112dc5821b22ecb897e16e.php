<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>wemall多用户微信商城后台管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/dist/css/skins/_all-skins.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/multi_putong/Public/Admin/dist/js/html5shiv.min.js"></script>
    <script src="/multi_putong/Public/Admin/dist/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/toastr/toastr.min.css">

    <!-- jQuery 2.1.4 -->
    <script src="/multi_putong/Public/Admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
        var URL = '/multi_putong/';
        var UEURL = '/multi_putong/Public/Admin/UEditor/';
        var PUBLICURL = '/multi_putong/Public';
        var UPLOADSURL = '/multi_putong/Public/Uploads/';
    </script>
    <!--ueditor-->
    <script type="text/javascript" charset="utf-8" src="/multi_putong/Public/Admin/UEditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/multi_putong/Public/Admin/UEditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/multi_putong/Public/Admin/UEditor/lang/zh-cn/zh-cn.js"></script>

    <script type="text/javascript" charset="utf-8" src='/multi_putong/Public/Admin/nprogress/nprogress.js'></script>
    <link rel='stylesheet' href='/multi_putong/Public/Admin/nprogress/nprogress.css'/>

    <link rel='stylesheet' href='/multi_putong/Public/Home/dist/css/lrtk.css'/>
    <!--<script type="text/javascript" charset="utf-8" src='/multi_putong/Public/Home/dist/js/lrtk.js'></script>-->
    <link rel="stylesheet" href="/multi_putong/Public/Admin/bootstrap/css/piAdmin.css">
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
                            <a href="<?php echo U('Home/AddShop/shop');?>" target="_parent">
                                <li class="header" style="padding:5px 18px;">
                                    店铺列表
                                </li>
                            </a>
                            <?php if(is_array($shopBarList)): $i = 0; $__LIST__ = $shopBarList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shopBarList): $mod = ($i % 2 );++$i;?><li>
                                    <a href="<?php echo U('Home/Shop/switchShop',array('id'=>$shopBarList['id']));?>"
                                       target="_parent">
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
                            <img src="/multi_putong/Public/Admin/dist/img/avatar-wemall.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo (session('homeName')); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/multi_putong/Public/Admin/dist/img/avatar-wemall.png" class="img-circle"
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
                    <!--<li>-->
                    <!--    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
                    <!--</li>-->
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

    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-shopping-cart"></i> <span>商城管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <!--<li><a href="<?php echo U('Home/Shop/shop');?>"><i class="fa "></i>店铺管理</a></li>-->
        <li><a href="<?php echo U('Home/Shop/ads');?>"><i class="fa "></i>广告管理</a></li>
        <li><a href="<?php echo U('Home/Shop/menu');?>"><i class="fa "></i>菜单管理</a></li>
        <li><a href="<?php echo U('Home/Shop/label');?>"><i class="fa "></i>标签管理</a></li>
        <li><a href="<?php echo U('Home/Shop/product');?>"><i class="fa "></i>商品管理</a></li>
        <li><a href="<?php echo U('Home/Shop/comment');?>"><i class="fa "></i>评论管理</a></li>
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
        <li><a href="<?php echo U('Home/Trade/tx');?>"><i class="fa "></i>提现管理</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-group"></i> <span>用户管理</span> <i
            class="fa fa-angle-right pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo U('Home/User/user');?>"><i class="fa "></i>用户管理</a></li>
        <li><a href="<?php echo U('Home/User/employee');?>"><i class="fa "></i>员工管理</a></li>
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
        系统首页
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo ($newOrder); ?></h3>

                    <p>新订单</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo U('Home/Order/order',array('status'=>0));?>" class="small-box-footer">更多详情 <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo ($newMoney); ?></h3>

                    <p>新销售额</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo U('Home/Order/order',array('status'=>0));?>" class="small-box-footer">更多详情 <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">系统公告</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody id="notify">
                            <?php if(is_array($artical)): $i = 0; $__LIST__ = $artical;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$artical): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="col-md-10"><a target="_blank"
                                           href="<?php echo U('App/Artical/index' , array('id'=>$artical['id']));?>"><?php echo ($artical["title"]); ?></a>
                                    </td>
                                    <td><span class="pull-right"><?php echo ($artical["time"]); ?></span></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
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
    <div class="lcont"><img src="/multi_putong/Public/Admin/dist/img/loading.gif" alt="loading...">正在加载...</div>
</div>

<!-- Bootstrap 3.3.5 -->
<script src="/multi_putong/Public/Admin/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="/multi_putong/Public/Admin/plugins/chartjs/Chart.min.js"></script>
<!-- daterangepicker -->
<script src="/multi_putong/Public/Admin/dist/js/moment.min.js"></script>
<script src="/multi_putong/Public/Admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/multi_putong/Public/Admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/multi_putong/Public/Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/multi_putong/Public/Admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/multi_putong/Public/Admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="/multi_putong/Public/Admin/dist/js/app.min.js?v=1"></script>
<!--layer-->
<script src="/multi_putong/Public/Admin/layer/layer.js"></script>
<!--toastr-->
<script src="/multi_putong/Public/Admin/toastr/toastr.min.js"></script>
<!--bootbox-->
<script src="/multi_putong/Public/Admin/bootbox/bootbox.js"></script>
<!--pjax-->
<script src="/multi_putong/Public/Admin/pjax/jquery.pjax.js"></script>
<!--jquery.form-->
<script src="/multi_putong/Public/Admin/form/jquery.form.js"></script>
<script src="/multi_putong/Public/Admin/dist/js/template.js"></script>
<script src="/multi_putong/Public/Home/dist/js/wemall.js?v=2"></script>
<!--<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BtCUE2NQjVUTSjctQELcfULl"></script>-->

<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=8daf0e161f44e7900d2193f85c5cfe1f&plugin=AMap.DistrictSearch"></script>
<script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>

</body>
</html>