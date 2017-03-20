<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        商城管理
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
                    <h3 class="box-title">属性管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="padding: 0px;">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="javascript:void(0)" onclick="addAttr()" class="btn btn-danger ">
                                新增属性
                            </a>
                        </div>
                        <!-- /.btn-group -->
                    </div>

                    <div class="table-responsive" style="overflow-x: visible;">
                        <form class="form-horizontal" action="<?php echo U('Admin/Shop/addSku');?>" method="post">
                            <input class="form-control" name="product_id" placeholder="" value="<?php echo ($_GET['id']); ?>"
                                   type="hidden">
                            <div class="box-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <th style="text-align: center;line-height: 34px">规格</th>
                                    <th style="text-align: center;line-height: 34px">价格</th>
                                    <th style="text-align: center;line-height: 34px">库存</th>
                                    <th style="text-align: center;line-height: 34px">运费</th>
                                    <th style="text-align: center;line-height: 34px">操作</th>
                                    </thead>
                                    <tbody id="skuData">

                                    <?php if(is_array($sku)): $i = 0; $__LIST__ = $sku;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sku): $mod = ($i % 2 );++$i;?><tr>
                                            <td style="text-align: center;line-height: 34px" class="col-md-1">
                                                <input name="old[<?php echo ($sku["id"]); ?>][id]" value="<?php echo ($sku["id"]); ?>" type="hidden">
                                                <input name="old[<?php echo ($sku["id"]); ?>][name]" value="<?php echo ($sku["name"]); ?>" type="text"
                                                       style="text-align: center;height: 34px">
                                            </td>
                                            <td style="text-align: center;line-height: 34px" class="col-md-1"><input
                                                    class="form-control" type="number" step="0.01"
                                                    name="old[<?php echo ($sku["id"]); ?>][price]" value="<?php echo ($sku["price"]); ?>">
                                            </td>
                                            <td style="text-align: center;line-height: 34px" class="col-md-1"><input
                                                    class="form-control" type="number" name="old[<?php echo ($sku["id"]); ?>][store]"
                                                    value="<?php echo ($sku["store"]); ?>">
                                            </td>
                                            <td style="text-align: center;line-height: 34px" class="col-md-1"><input
                                                    class="form-control" type="number" step="0.01"
                                                    name="old[<?php echo ($sku["id"]); ?>][freight]"
                                                    value="<?php echo ($sku["freight"]); ?>">
                                            </td>
                                            <td style="text-align: center;line-height: 34px" class="col-md-1">
                                                <a href="javascript:void(0)"
                                                   onclick="removeAttr(this,'old','<?php echo ($sku["id"]); ?>')">删除</a></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                    </tbody>
                                </table>
                            </div>

                            <div class="box-footer">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-block btn-danger">保存</button>
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-block btn-default" onclick="history.go(-1)">取消
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.col -->
</section>

<script type="text/html" id="skuTpl">
    <tr>
        <td style="text-align: center;line-height: 34px" class="col-md-1">
            <input name="new[{{i}}][id]" value="0" type="hidden">
            <input name="new[{{i}}][name]" value="" type="text"
                   style="text-align: center;height: 34px">
        </td>
        <td style="text-align: center;line-height: 34px" class="col-md-1"><input
                class="form-control" type="number" step="0.01"
                name="new[{{i}}][price]" value="0">
        </td>
        <td style="text-align: center;line-height: 34px" class="col-md-1"><input
                class="form-control" type="number" name="new[{{i}}][store]"
                value="0">
        </td>
        <td style="text-align: center;line-height: 34px" class="col-md-1"><input
                class="form-control" type="number" step="0.01"
                name="new[{{i}}][freight]"
                value="0">
        </td>
        <td style="text-align: center;line-height: 34px" class="col-md-1">
            <a href="javascript:void(0)"
               onclick="removeAttr(this,'new')">删除</a></td>
    </tr>
</script>


<script type="text/javascript">
    var i = 0;
    function addAttr() {
        var html = template("skuTpl", {i: i});
        $('#skuData').append(html);

        i++;
    }

    function removeAttr(obj, type, id) {
        if (type == 'new') {
            $(obj).parent().parent().remove();
        } else if (type == 'old' && id != undefined) {
            $.pjax({
                url: URL + "Admin/Shop/delSku/id/" + id,
                container: '#pjax-container'
            })
        }
    }
</script>