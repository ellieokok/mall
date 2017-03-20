<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        提现管理
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-danger">
                    <p>目前仅支持支付宝提现申请</p>
                    <p>提现手续费比例为<?php echo ($config["tx_fee"]); ?></p>
                </div>

                <!-- general form elements -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">目前仅支持支付宝提现申请</h3>
                        <h3 class="box-title">每次提现大于100元</h3>
                    </div>

                    <!-- form start -->
                    <form class="form-horizontal" action="<?php echo U('Home/Trade/addTx');?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">支付宝账户</label>

                                <div class="col-sm-8">
                                    <input class="form-control" name="account" placeholder=""
                                           value="<?php echo ($txConfig['account']); ?>" required
                                           type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">支付宝昵称</label>

                                <div class="col-sm-8">
                                    <input class="form-control" name="name" placeholder="" value="<?php echo ($txConfig['name']); ?>"
                                           required
                                           type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">提现金额</label>

                                <div class="col-sm-8">
                                    <input class="form-control" name="money"
                                           placeholder="最大提现金额<?php echo ($maxMoney?$maxMoney:0); ?>元,每次提现大于100元"
                                           value=""
                                           required
                                           type="number">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-block btn-danger">申请</button>
                            </div>

                            <div class="col-sm-2">
                                <button type="button" class="btn btn-block btn-default" onclick="history.go(-1)">取消
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>

    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">提现管理</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Trade/exportTx');?>" target="_blank" class="btn btn-danger ">
                                导出全部提现
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
                                <th>流水号</th>
                                <th>提现id</th>
                                <th>店铺名称</th>
                                <th>用户ID</th>
                                <th>金额</th>
                                <th>手续费</th>
                                <th>提现金额</th>
                                <th>账号</th>
                                <th>昵称</th>
                                <th>状态</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($txList)): $i = 0; $__LIST__ = $txList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tx): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($tx["id"]); ?>"></label>
                                    </td>
                                    <td>
                                        <?php echo ($tx["id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($tx["txid"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($tx["shop"]["name"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($tx["user_id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($tx["money"]); ?>元
                                    </td>
                                    <td>
                                        -<?php echo ($tx["fee"]); ?>元
                                    </td>
                                    <td>
                                        <span style="background-color: #dd4b39;" class="badge"><?php echo ($tx["tx"]); ?>元</span>
                                    </td>
                                    <td>
                                        <?php echo ($tx["account"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($tx["name"]); ?>
                                    </td>
                                    <td>
                                        <?php if($tx["status"] == 1): ?>审核通过<?php endif; ?>
                                        <?php if($tx["status"] == -1): ?>拒绝/取消<?php endif; ?>
                                        <?php if($tx["status"] == 0): ?><span style="color: red">未审核</span><?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo ($tx["time"]); ?>
                                    </td>
                                    <td class="table-action">
                                        <?php if($tx["status"] == 0): ?><a href="<?php echo U('Home/Trade/updateTx',array('id'=>$tx['id'],'status' => -1));?>">取消</a><?php endif; ?>
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