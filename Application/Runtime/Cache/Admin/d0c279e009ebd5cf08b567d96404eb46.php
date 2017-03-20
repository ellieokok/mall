<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        优惠券管理
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
                    <h3 class="box-title">优惠券管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo u_addons('Coupon://Admin/Admin/index');?>" class="btn btn-danger ">
                                返回优惠券列表页
                            </a>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <!--<th class="hidden-xs">-->
                                    <!--<label><input onchange="checkAll()" type="checkbox" value=""></label>-->
                                <!--</th>-->
                                <th>ID</th>
                                <th>优惠码</th>
                                <th>金额</th>
                                <th>状态</th>
                                <th>截止时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($coupon)): $i = 0; $__LIST__ = $coupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?><tr>
                                    <!--<td class="hidden-xs">-->
                                        <!--<label><input name="checkbox" class="check" type="checkbox"-->
                                                      <!--value="<?php echo ($coupon["id"]); ?>"></label>-->
                                    <!--</td>-->
                                    <td>
                                        <?php echo ($coupon["id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($coupon["code"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($coupon["price"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($coupon["status"]); ?>
                                    </td>
                                    <td>
                                        <?php echo date('Y-m-d H:i:s',$coupon['last_time']);?>
                                    </td>
                                    <td class="table-action"><a
                                            href="<?php echo u_addons('Coupon://Admin/Admin/detail_del',array('id'=>$coupon['id']));?>">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <!--<div class="btn-group">-->
                                    <!--<button type="button" class="btn btn-danger"-->
                                            <!--onclick="batchUrl('<?php echo U('Admin/coupon/delcoupon');?>')">全部删除-->
                                    <!--</button>-->
                                <!--</div>-->
                                <div class="pull-right" style="margin-bottom: 6px">
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