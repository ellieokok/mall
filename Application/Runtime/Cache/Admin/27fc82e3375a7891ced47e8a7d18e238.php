<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        订单管理
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
                    <h3 class="box-title">订单搜索</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo U('Admin/Order/search');?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">订单ID</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="id" placeholder="" value="<?php echo ($orderPost["id"]); ?>"
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">订单编号</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="orderid" placeholder="" value="<?php echo ($orderPost["orderid"]); ?>"
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">用户ID</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="user_id" placeholder="" value="<?php echo ($orderPost["user_id"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">支付方式</label>

                            <div class="col-sm-3">
                                <select name="payment" class="form-control">
                                    <option value="-10">不选择支付方式</option>
                                    <option value="0">账户支付</option>
                                    <option value="1">微信支付</option>
                                    <option value="2">支付宝支付</option>
                                    <option value="3">货到付款</option>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">支付状态</label>

                            <div class="col-sm-3">
                                <select name="pay_status" class="form-control">
                                    <option value="-10">不选择支付状态</option>
                                    <option value="0">未支付</option>
                                    <option value="1">已支付</option>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">订单状态</label>

                            <div class="col-sm-3">
                                <select name="status" class="form-control">
                                    <option value="-10">不选择订单状态</option>
                                    <option value="0">未处理</option>
                                    <option value="1">已发货</option>
                                    <option value="2">已完成</option>
                                    <option value="-1">已取消</option>
                                    <option value="-2">退货中</option>
                                    <option value="-3">退货完成</option>
                                    <option value="-4">申请退货</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">商品</label>

                            <div class="col-sm-3">
                                <select name="product_id" class="form-control">
                                    <option value="-10">不选择商品</option>
                                    <?php if(is_array($productList)): $i = 0; $__LIST__ = $productList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option value="<?php echo ($list["id"]); ?>"><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">时间范围</label>

                            <div class="col-sm-7">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="timeRange"
                                           id="reservationtime" value="<?php echo ($orderPost["timeRange"]); ?>">
                                </div>
                            </div>
                            <!-- /.input group -->
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
                    <h3 class="box-title">订单管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Admin/Order/export',array('status'=>I('get.status') , 'pay_status'=>I('get.pay_status') ,'day'=>I('get.day')));?>"
                               target="_blank" class="btn btn-danger">
                                导出全部订单
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
                                <th>订单编号</th>
                                <th>联系人</th>
                                <th>地址</th>
                                <th>价格</th>
                                <th>优惠</th>
                                <th>支付方式</th>
                                <th>支付状态</th>
                                <th>订单状态</th>
                                <th>订单详情</th>
                                <th>备注</th>
                                <th>时间</th>
                            </tr>
                            <?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($order["id"]); ?>"></label>
                                    </td>
                                    <td>
                                        <?php echo ($order["id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($order["shop_id"]); ?>
                                    </td>                                    
                                    <td>
                                        <?php echo ($order["orderid"]); ?>
                                    </td>
                                    <td>
                                        <div>联系人:<span class="badge" style="margin-left: 3px;"><?php echo ($order["contact"]["name"]); ?></span></div>
                                        <div>手机号:<span class="badge" style="margin-left: 3px;"><?php echo ($order["contact"]["phone"]); ?></span></div>

                                    </td>
                                    <td style="max-width: 200px;overflow: hidden;">
                                        <div>省:<span class="badge" style="margin-left: 3px;"><?php echo ($order["contact"]["province"]); ?></span></div>
                                        <div>市:<span class="badge" style="margin-left: 3px;"><?php echo ($order["contact"]["city"]); ?></span></div>
                                        <div>区:<span class="badge" style="margin-left: 3px;"><?php echo ($order["contact"]["district"]); ?></span></div>
                                        <div>地址:<span class="badge" style="margin-left: 3px;"><?php echo ($order["contact"]["address"]); ?></span></div>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php echo ($order["totalprice"]); ?>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php echo ($order["discount"]); ?>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php if($order["payment"] == 0): ?>账户支付
                                            <?php elseif($order["payment"] == 1): ?>
                                            微信支付
                                            <?php elseif($order["payment"] == 2): ?>
                                            支付宝支付
                                            <?php else: ?>
                                            货到付款<?php endif; ?>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php if($order["pay_status"] == 1): ?>已支付
                                            <?php else: ?>
                                            <font color="red">未支付</font><?php endif; ?>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php if($order["status"] == -1): ?>已取消
                                            <?php elseif($order["status"] == 0): ?>
                                            <font color="red">未处理</font>
                                            <?php elseif($order["status"] == 1): ?>
                                            <font color="blue">已发货</font>
                                            <?php elseif($order["status"] == -2): ?>
                                            <font color="blue">已退货</font>
                                            <?php else: ?>
                                            已完成<?php endif; ?>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php $data = $order[detail]; for($i=0;$i < count($data);$i++){ $sku = ''; if($data[$i]['sku_id']){ $sku = '('.$data[$i][sku_name].')'; } echo '
                                            <div>'.$data[$i][name].$sku.'<span class="badge" style="margin-left: 3px;">'.$data[$i][price].'元*'.$data[$i][num].'</span>
                                            </div>
                                            '; } ?>

                                    </td>
                                    <td class="hidden-xs">
                                        <?php echo ($order["remark"]); ?>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php echo ($order["time"]); ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Order/update',array('status'=>1));?>')">发货
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Order/update',array('pay_status'=>1));?>')">
                                        已支付
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Order/update',array('status'=>-1));?>')">取消
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Order/update',array('status'=>2));?>')">已完成
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Order/update',array('status'=>-2));?>')">已退货
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "
                                            onclick="batchUrl('<?php echo U('Admin/Order/export',array('status'=>I('get.status') , 'pay_status'=>I('get.pay_status') ,'day'=>I('get.day')));?>',false)">
                                        导出订单
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
        if ('<?php echo ($orderPost); ?>') {
            $('select[name="payment"]').val('<?php echo ($orderPost["payment"]); ?>');
            $('select[name="pay_status"]').val('<?php echo ($orderPost["pay_status"]); ?>');
            $('select[name="status"]').val('<?php echo ($orderPost["status"]); ?>');
            $('select[name="product_id"]').val('<?php echo ($orderPost["product_id"]); ?>');
        }
    });
</script>