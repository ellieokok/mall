<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        商家管理
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
                    <h3 class="box-title">商家搜索</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo U('Admin/User/biz');?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">ID</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="id" placeholder=""
                                       value=""
                                       type="text">
                            </div>

                            <label class="col-sm-1 control-label">用户名</label>

                            <div class="col-sm-3">
                                <input class="form-control" name="username" placeholder="" value=""
                                       type="text">
                            </div>
                            <!--<label class="col-sm-1 control-label">推荐人ID</label>-->

                            <!--<div class="col-sm-3">-->
                            <!--    <input class="form-control" name="tuijianren_id" placeholder=""-->
                            <!--           value=""-->
                            <!--           type="text">-->
                            <!--</div>-->

                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">时间范围</label>

                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="timeRange"
                                           id="reservationtime" value="<?php echo ($orderPost["timeRange"]); ?>">
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
                    <h3 class="box-title">用户管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!--<div class="mailbox-controls">-->
                    <!--<div class="btn-group">-->
                    <!--<a href="<?php echo U('Admin/User/addUser');?>" class="btn btn-danger ">-->
                    <!--新增用户-->
                    <!--</a>-->
                    <!--</div>-->
                    <!--<div class="btn-group">-->
                    <!--<a href="" class="btn btn-danger ">-->
                    <!--导出全部用户-->
                    <!--</a>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /.btn-group &ndash;&gt;-->
                    <!--</div>-->

                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th class="hidden-xs">
                                    <label><input onchange="checkAll()" type="checkbox" value=""></label>
                                </th>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>账户</th>
                                <th>积分</th>
                                <th>状态</th>
                                <!--<th>推荐人</th>-->
                                <!--<th>角色</th>-->
                                <th>备注</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($userList)): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox" value="<?php echo ($user["id"]); ?>"></label>
                                    </td>
                                    <td><?php echo ($user["id"]); ?></td>
                                    <td><?php echo ($user["username"]); ?></td>
                                    <td><?php echo ($user["money"]); ?></td>
                                    <td><?php echo ($user["score"]); ?></td>
                                    <td><?php echo ($user["status"]); ?></td>
                                    <!--<td><?php echo ($user["tuijianren"]["name"]); ?></td>-->
                                    <!--<td>-->
                                    <!--    <span style="background-color: #dd4b39;" class="badge">商家</span>-->
                                    <!--</td>-->
                                    <td><?php echo ($user["remark"]); ?></td>
                                    <td><?php echo ($user["time"]); ?></td>

                                    <td class="table-action"><a
                                            href="<?php echo U('Admin/User/modifyUser',array('id'=>$user['id']));?>">修改</a>
                                        <?php if(($user["id"]) > "1"): ?><a href="<?php echo U('Admin/User/delUser',array('id'=>$user['id']));?>">删除</a><?php endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group" style="height:45px">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/User/delUser');?>')">全部删除
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