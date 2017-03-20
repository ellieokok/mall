<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
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
                <a href="<?php echo U('Admin/Order/order',array('status'=>0));?>" class="small-box-footer">更多详情 <i
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
                <a href="<?php echo U('Admin/Order/order',array('status'=>0));?>" class="small-box-footer">更多详情 <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo ($user); ?></h3>

                    <p>总用户</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo ($order); ?></h3>

                    <p>总订单</p>
                </div>
                <div class="icon">
                    <i class="ion ion-connection-bars"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
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

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">系统信息</h3>
                </div>
                <div class="box-body">
                    <blockquote style="font-size: 13.5px;">程序版本：WeMall_<?php echo (APP_VERSION); ?><br/>
                        更新时间：<?php echo (APP_VERSION_TIME); ?><br/>
                        服务器IP：<?php echo (get_client_ip($ip)); ?><br/>
                        服务器系统：
                        <?php echo PHP_OS ?>
                        <br/>
                        PHP版本：
                        <?php echo PHP_VERSION ?>
                        <br/>
                        当前时间：
                        <?php echo date("Y-m-d H:i:s") ?>
                        <br/>
                        官网网址：http://www.inuoer.com<br/>
                    </blockquote>
                    <blockquote style="margin-top: 20px">
                        <p>
                            Better for life
                        </p>
                        <small>AI.何青.Better</small>
                    </blockquote>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $.get("<?php echo U('Admin/Base/getNotify');?>", function (data) {
            if(data){
                var json = eval(data);
                var html = '';
                $.each(json , function (index , value) {
                    html += '<tr><td><a target="_blank" href="'+value.href+'">'+value.title+'</a></td><td class="pull-right">'+value.time+'</td></tr>';
                });
                $('#notify').html(html);
            }
        });
    });
</script>