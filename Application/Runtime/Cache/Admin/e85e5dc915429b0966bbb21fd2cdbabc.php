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
            <!-- general form elements -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">提现搜索</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo U('Admin/Trade/tx');?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">ID</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="id" placeholder=""
                                       value=""
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">流水号</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="txid" placeholder="" value=""
                                       type="text">
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">店铺ID</label>
                                <div class="col-sm-3">
                                    <input class="form-control" name="shop_id" placeholder="" value="" type="text">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                                <label class="col-sm-1 control-label">账号</label>
                                <div class="col-sm-3">
                                    <input class="form-control" name="account" placeholder="" value="" type="text">
                                </div>
                                <label class="col-sm-1 control-label">昵称</label>
                                <div class="col-sm-3">
                                    <input class="form-control" name="name" placeholder="" value="" type="text">
                                </div>
                            <label class="col-sm-1 control-label">时间范围</label>

                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="timeRange"
                                           id="reservationtime" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-block btn-danger">开始搜索</button>
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
                            <a href="<?php echo U('Admin/Trade/exportTx');?>" target="_blank" class="btn btn-danger ">
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

                                <th>ID</th>
                                <th>流水号</th>
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
                                        <?php if($tx["status"] == 0): ?><a href="<?php echo U('Admin/Trade/updateTx',array('id'=>$tx['id'],'status' => 1));?>">通过</a>
                                            <a href="<?php echo U('Admin/Trade/updateTx',array('id'=>$tx['id'],'status' => -1));?>">拒绝</a>
                                            <?php else: ?>
                                            <a href="<?php echo U('Admin/Trade/updateTx',array('id'=>$tx['id'],'status' => -1));?>">取消</a><?php endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Trade/export');?>',false)">导出
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
<script type="text/javascript">
    $(function () {
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'YYYY-MM-DD h:mm:ss',
            separator: ' --- ',
        });
    });
</script>