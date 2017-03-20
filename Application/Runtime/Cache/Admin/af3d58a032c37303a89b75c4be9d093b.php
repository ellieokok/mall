<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        微信设置
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
                    <h3 class="box-title">微信菜单管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Admin/Weixin/addWxMenu');?>" class="btn btn-danger ">
                                新增菜单
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
                                <th>PID(上级)</th>
                                <th>菜单名称</th>
                                <th>类型</th>
                                <th>URL</th>
                                <th>KEY</th>
                                <th>备注</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($wxMenu)): $i = 0; $__LIST__ = $wxMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox" value="<?php echo ($menu["id"]); ?>"></label>
                                    </td>
                                    <td><?php echo ($menu["id"]); ?></td>
                                    <td><?php echo ($menu["pid"]); ?></td>
                                    <td><?php echo ($menu["name"]); ?></td>
                                    <td><?php echo ($menu["type"]); ?></td>
                                    <td><?php echo ($menu["url"]); ?></td>
                                    <td><?php echo ($menu["key"]); ?></td>
                                    <td><?php echo ($menu["remark"]); ?></td>
                                    <td class="table-action"><a
                                            href="<?php echo U('Admin/Weixin/modWxMenu',array('id'=>$menu['id']));?>">修改</a><a
                                            href="<?php echo U('Admin/Weixin/delWxMenu',array('id'=>$menu['id']));?>">删除</a></td>
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
                            <button type="button" class="btn btn-danger"
                                    onclick="batchUrl('<?php echo U('Admin/Weixin/delWxMenu');?>')">全部删除
                            </button>
                        </div>
                    </div>
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a class="btn btn-danger" href="<?php echo U('Admin/Wechat/createWxMenu');?>">生成自定义菜单</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
</section>