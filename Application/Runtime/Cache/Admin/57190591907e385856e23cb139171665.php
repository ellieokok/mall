<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        用户管理
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
                    <h3 class="box-title">用户组管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Admin/User/addAuthGroup');?>" class="btn btn-danger ">
                                新增用户组
                            </a>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>用户组</th>
                                <th>状态</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($authGroupList)): $i = 0; $__LIST__ = $authGroupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($group["id"]); ?></td>
                                    <td><?php echo ($group["title"]); ?></td>
                                    <td>
                                        <?php if(($group["status"]) == "1"): ?>启用
                                            <?php else: ?>
                                            禁用<?php endif; ?>
                                    </td>
                                    <td><?php echo ($group["time"]); ?></td>
                                    <td class="table-action">
                                        <?php if(($group["id"]) > "1"): ?><a href="<?php echo U('Admin/User/modAuthGroup',array('id'=>$group['id']));?>">修改</a><a
                                                href="<?php echo U('Admin/User/delAuthGroup',array('id'=>$group['id']));?>">删除</a><?php endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
</section>