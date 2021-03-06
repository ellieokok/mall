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
                    <h3 class="box-title">商品搜索</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo U('Admin/Shop/productSearch');?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">商品ID</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="id" placeholder="" value="<?php echo ($productPost["id"]); ?>"
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">商品名称</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="name" placeholder="" value="<?php echo ($productPost["name"]); ?>"
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">推荐状态</label>

                            <div class="col-sm-3">
                                <select name="recommend" class="form-control">
                                    <option value="-10">不选择推荐状态</option>
                                    <option value="0">正常</option>
                                    <option value="1">推荐</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">商品状态</label>

                            <div class="col-sm-3">
                                <select name="status" class="form-control">
                                    <option value="-10">不选择商品状态</option>
                                    <option value="0">下架</option>
                                    <option value="1">上架</option>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">时间范围</label>

                            <div class="col-sm-7">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="timeRange"
                                           id="reservationtime" value="<?php echo ($productPost["timeRange"]); ?>">
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
                    <h3 class="box-title">商品管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!--<div class="btn-group">-->
                        <!--    <a href="<?php echo U('Admin/Shop/addProduct');?>" class="btn btn-danger ">-->
                        <!--        新增商品-->
                        <!--    </a>-->
                        <!--</div>-->
                        <div class="btn-group">
                            <a href="<?php echo U('Admin/Shop/exportProduct');?>" target="_blank" class="btn btn-danger ">
                                导出全部商品
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
                                <th>商品名称</th>
                                <th>菜单</th>
                                <th>链接</th>
                                <th>图片</th>
                                <th>价格</th>
                                <th>积分</th>
                                <th>标签</th>
                                <th>状态</th>
                                <th>排序</th>
                                <th>sku管理</th>
                                <th>备注</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($productList)): $i = 0; $__LIST__ = $productList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($product["id"]); ?>"></label>
                                    </td>
                                    <td><?php echo ($product["id"]); ?></td>
                                    <td><?php echo ($product["shop_id"]); ?></td>
                                    <td><?php echo ($product["name"]); ?></td>
                                    <td><?php echo ($product["menu_name"]); ?></td>
                                    <td>
                                        <div class="btn-group" style="margin: 0px">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                链接<span class="caret"></span></button>
                                            <div class="dropdown-menu" style="padding: 10px;max-width: none;">
                                                <?php echo ($url); echo U('App/Shop/product' , array('id'=>$product['id']));?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" style="margin: 0px">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                图片<span class="caret"></span></button>
                                            <div class="dropdown-menu">
                                                <img style="height: 200px"
                                                     src="/Public/Uploads/<?php echo ($product["savepath"]); echo ($product["savename"]); ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td><span style="background-color: #dd4b39;" class="badge"><?php echo ($product["price"]); ?>元</span>
                                    </td>
                                    <td><span style="background-color: #dd4b39;" class="badge"><?php echo ($product["score"]); ?></span>
                                    </td>
                                    <td><?php echo ($product["label"]); ?></td>
                                    <td>
                                        <?php if($product["status"] == 1): ?><span class="label label-success">上架</span>
                                            <?php elseif($product["status"] == -1): ?>
                                            下架
                                            <?php else: ?>
                                            <span class="label label-default">售罄</span><?php endif; ?>
                                    </td>
                                    <td><?php echo ($product["rank"]); ?></td>
                                    <td>
                                        <?php if($product["sku"] == 1): ?><a href="<?php echo U('Admin/Shop/sku',array('id'=>$product['id']));?>"
                                                                             class="btn bg-red" style="padding: 3px 6px;"><i
                                                class="fa fa-edit"></i> 管理</a><?php endif; ?>
                                        <?php if($product["sku"] == 0): ?>未启用<?php endif; ?>
                                    </td>
                                    <td><?php echo ($product["remark"]); ?></td>
                                    <td class="table-action">
                                        <?php if($product["status"] == -1): ?><a href="<?php echo U('Admin/Shop/updateProduct',array('id'=>$product['id'] , 'status'=>1));?>">上架</a>
                                            <a href="<?php echo U('Admin/Shop/updateProduct',array('id'=>$product['id'] , 'status'=>0));?>">售罄</a>
                                            <?php elseif($product["status"] == 1): ?>
                                            <a href="<?php echo U('Admin/Shop/updateProduct',array('id'=>$product['id'] , 'status'=>-1));?>">下架</a>
                                            <a href="<?php echo U('Admin/Shop/updateProduct',array('id'=>$product['id'] , 'status'=>0));?>">售罄</a>
                                            <?php else: ?>
                                            <a href="<?php echo U('Admin/Shop/updateProduct',array('id'=>$product['id'] , 'status'=>1));?>">上架</a>
                                            <a href="<?php echo U('Admin/Shop/updateProduct',array('id'=>$product['id'] , 'status'=>-1));?>">下架</a><?php endif; ?>

                                        <a href="<?php echo U('Admin/Shop/modProduct',array('id'=>$product['id']));?>">修改</a><a
                                            href="<?php echo U('Admin/Shop/delProduct',array('id'=>$product['id']));?>">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/Shop/delProduct');?>')">全部删除
                                    </button>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/Shop/updateProduct',array('status'=>1));?>')">
                                        上架
                                    </button>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/Shop/updateProduct',array('status'=>-1));?>')">
                                        下架
                                    </button>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/Shop/updateProduct',array('status'=>0));?>')">
                                        售罄
                                    </button>
                                </div>

                                <div class="pull-right">
                                    <?php echo ($page); ?>
                                    <!-- /.btn-group -->
                                </div>
                            </div>
                            <!-- /.btn-group -->
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
        if ('<?php echo ($productPost); ?>') {
            $('select[name="recommend"]').val('<?php echo ($productPost["recommend"]); ?>');
            $('select[name="status"]').val('<?php echo ($productPost["status"]); ?>');
        }
    });
</script>