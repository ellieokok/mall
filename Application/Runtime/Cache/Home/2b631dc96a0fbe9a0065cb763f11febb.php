<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        系统设置
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
                    <h3 class="box-title">地址管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Config/addressSet');?>" class="btn btn-danger ">
                                省份管理
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Config/addProvince');?>" class="btn btn-danger ">
                                新增省份
                            </a>
                        </div>
                        |
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Config/city');?>" class="btn btn-danger ">
                                城市管理
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Config/addCity');?>" class="btn btn-danger ">
                                新增城市
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
                                <th>省份</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$province): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($province["id"]); ?>"></label>
                                    </td>
                                    <td><?php echo ($province["id"]); ?></td>
                                    <td><?php echo ($province["name"]); ?></td>
                                    <td class="table-action"><a
                                            href="<?php echo U('Home/Config/modProvince',array('id'=>$province['id']));?>">修改</a><a
                                            href="<?php echo U('Home/Config/delProvince',array('id'=>$province['id']));?>">删除</a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger "
                                    onclick="batchUrl('<?php echo U('Home/Config/delProvince');?>')">全部删除
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
</section>