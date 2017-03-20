<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        商城管理
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
                    <h3 class="box-title">店铺搜索</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo U('Admin/Shop/shop');?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">ID</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="id" placeholder=""
                                       value=""
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">名称</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="name" placeholder="" value=""
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">状态</label>

                            <div class="col-sm-3">
                                <select name="status" class="form-control">
                                    <option value="-10">不选择状态</option>
                                    <option value="0">未审核</option>
                                    <option value="1">休息中</option>
                                    <option value="2">营业中</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">时间范围</label>

                            <div class="col-sm-7">
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
                    <h3 class="box-title">店铺管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
<!--                     <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Admin/Shop/addShop');?>" class="btn btn-danger ">
                                新增店铺
                            </a>
                        </div>
                    </div> -->
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th class="hidden-xs">
                                    <label><input onchange="checkAll()" type="checkbox" value=""></label>
                                </th>

                                <th>ID</th>

                                <th>名称</th>
                                <th>图片</th>
                                <th>链接</th>
                                <th>状态</th>
                                <th>排序</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($shopList)): $i = 0; $__LIST__ = $shopList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($shop["id"]); ?>"></label>
                                    </td>

                                    <td>
                                        <?php echo ($shop["id"]); ?>
                                    </td>

                                    <td>
                                        <?php echo ($shop["name"]); ?>
                                    </td>
                                    <td>
                                        <?php if($shop["savepath"] && $shop.savename): ?><img style="height: 48px;max-width: 72px"
                                                 src="/Public/Uploads/<?php echo ($shop["savepath"]); echo ($shop["savename"]); ?>"><?php endif; ?>
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
                                        <?php echo ($shop["time"]); ?>
                                    </td>
                                    <td class="table-action">
                                        <a href="<?php echo U('Admin/Shop/delShop',array('id'=>$shop['id']));?>">删除</a>
                                        <?php if($shop["status"] != -1): ?><a href="<?php echo U('Admin/Shop/closeShop',array('id'=>$shop['id'],'status' => -1));?>"><span style="color: red">关闭</span></a><?php endif; ?>
                                        <?php if($shop["status"] == -1): ?><a href="<?php echo U('Admin/Shop/openShop',array('id'=>$shop['id'],'status' => 2));?>">开启</a><?php endif; ?>
                                    </td>                                   
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/Shop/delShop');?>')">全部删除
                                    </button>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/Shop/updateShop' , array('status' => 2));?>')">
                                        全部审核
                                    </button>
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