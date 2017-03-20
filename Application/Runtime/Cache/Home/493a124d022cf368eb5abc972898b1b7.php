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

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

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
                            <li class="user-footer">
                                <a href="<?php echo U('Home/Public/logout');?>" target="_self"
                                   class="btn btn-default btn-flat">注销</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<section class="content-header" style="margin-left: 10%;margin-top:5px;width:80%;">
    <h1>
        WeMall店铺管理
        <small></small>
    </h1>

    <!--<a href="<?php echo U('Home/Public/logout');?>" target="_self" class="pull-right" style="margin-left: 10px;position: relative;">-->
    <!--    注销-->
    <!--</a>-->
    <!--<p class="pull-right">-->
    <!--    <?php echo (session('homeName')); ?>-->
    <!--</p>-->
    <!--<span class="pull-right">哈哈哈</span>-->
</section>

<!-- Main content -->
<section class="content" style="width: 80%;min-height: auto;">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">店铺管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Home/AddShop/addShop');?>" class="btn btn-danger ">
                                新增店铺
                            </a>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>名称</th>
                                <th>图片</th>
                                <th>链接</th>
                                <th>状态</th>
                                <th>排序</th>
                                <th>备注</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($shopList)): $i = 0; $__LIST__ = $shopList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($i % 2 );++$i;?><tr>
                                    <td>
                                        <?php echo ($shop["name"]); ?>
                                    </td>
                                    <td>
                                        <?php if($shop["savepath"] && $shop.savename): ?><img style="height: 48px;max-width: 72px"
                                                 src="/multi_putong/Public/Uploads/<?php echo ($shop["savepath"]); echo ($shop["savename"]); ?>"><?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" style="margin: 0px">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                链接<span class="caret"></span></button>
                                            <div class="dropdown-menu" style="padding: 10px;max-width: none;">
                                                <?php echo ($url); echo U('App/Index/index' , array('shopId'=>$shop['id']));?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($shop["status"] == -1): ?><span style="color: red">已关闭</span><?php endif; ?>
                                        <?php if($shop["status"] == 0): ?><span style="color: red">未审核</span><?php endif; ?>
                                        <?php if($shop["status"] == 1): ?><span style="color: blue">休息中</span><?php endif; ?>
                                        <?php if($shop["status"] == 2): ?>营业中<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo ($shop["rank"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($shop["remark"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($shop["time"]); ?>
                                    </td>
                                    <td class="table-action">
                                        <a target="_parent" href="<?php echo U('Home/Shop/switchShop',array('id'=>$shop['id']));?>">进入</a>
                                        <a href="<?php echo U('Home/Shop/delShop',array('id'=>$shop['id']));?>">删除</a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group" style="height: 45px">

                                </div>
                                <div class="pull-right">
                                    <?php echo ($page); ?>
                                    <!-- /.btn-group -->
                                </div>
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