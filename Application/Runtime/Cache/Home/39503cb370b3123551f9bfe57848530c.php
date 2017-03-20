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
                    <h3 class="box-title">用户管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!--<div class="mailbox-controls">-->
                    <!--    <div class="btn-group">-->
                    <!--        <a href="" class="btn btn-danger ">-->
                    <!--            导出全部用户-->
                    <!--        </a>-->
                    <!--    </div>-->
                        <!-- /.btn-group -->
                    <!--</div>-->
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <!--<th class="hidden-xs">-->
                                <!--    <label><input onchange="checkAll()" type="checkbox" value=""></label>-->
                                <!--</th>-->
                                <th>用户名</th>
                                <th>头像</th>
                                <th>账户</th>
                                <th>积分</th>
                                <th>状态</th>
                                <th>备注</th>
                                <th>时间</th>
                                <!--<th>操作</th>-->
                            </tr>
                            <?php if(is_array($userList)): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                    <!--<td class="hidden-xs">-->
                                    <!--    <label><input name="checkbox" class="check" type="checkbox" value="<?php echo ($user["id"]); ?>"></label>-->
                                    <!--</td>-->
                                    <td><?php echo ($user["username"]); ?></td>
                                    <td>
                                        <?php if($user["avater"] != ''): ?><img src="<?php echo ($user["avater"]); ?>" style="width: 48px;height: 48px"><?php endif; ?>
                                    </td>
                                    <td><?php echo ($user["money"]); ?></td>
                                    <td><?php echo ($user["score"]); ?></td>
                                    <td>
                                        <?php if($user["status"] == 1): ?>启用<?php endif; ?>
                                        <?php if($user["status"] == 0): ?><span style="color: red">禁用</span><?php endif; ?>
                                    </td>
                                    <td><?php echo ($user["remark"]); ?></td>
                                    <td><?php echo ($user["time"]); ?></td>
                                    <!--<td class="table-action"><a-->
                                    <!--        href="<?php echo U('Home/User/modUser',array('id'=>$user['id']));?>">修改</a>-->
                                    <!--    <?php if(($user["id"]) > "1"): ?>-->
                                    <!--        <a href="<?php echo U('Home/User/delUser',array('id'=>$user['id']));?>">删除</a>-->
                                    <!--<?php endif; ?>-->
                                    <!--</td>-->
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <!--<div class="btn-group">-->
                                <!--    <button type="button" class="btn btn-danger"-->
                                <!--            onclick="batchUrl('<?php echo U('Home/User/delUser');?>')">全部删除-->
                                <!--    </button>-->
                                <!--</div>-->
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