<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        财务管理
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
        <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo (round($money,2)); ?></h3>

                        <p>账户余额</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?php echo U('Home/Trade/tx');?>" class="small-box-footer">申请提现 <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3><?php echo (round($allMoney,2)); ?></h3>

                        <p>账户流水</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-connection-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
        </div>

    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">财务管理</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Trade/export');?>" target="_blank" class="btn btn-danger ">
                                导出全部交易
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
                                <th>店铺名称</th>
                                <th>用户ID</th>
                                <th>交易号</th>
                                <th>交易方式</th>
                                <th>交易金额</th>
                                <th>时间</th>
                            </tr>
                            <?php if(is_array($tradeList)): $i = 0; $__LIST__ = $tradeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($trade["id"]); ?>"></label>
                                    </td>
                                    <td>
                                        <?php echo ($trade["shop"]["name"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($trade["user_id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($trade["tradeid"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($trade["payment"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($trade["money"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($trade["time"]); ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Home/Trade/export');?>',false)">导出
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