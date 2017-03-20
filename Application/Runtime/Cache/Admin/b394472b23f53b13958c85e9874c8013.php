<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        管理员管理
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">新增管理员</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo U('Admin/User/addAdmin');?>" method="post">
                    <div class="box-body">
                        <input class="form-control" name="id" placeholder="" value="<?php echo ($user['id']?$user['id']:0); ?>"
                               type="hidden">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="username" placeholder="" value="<?php echo ($user["username"]); ?>"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机号</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="phone" placeholder="" value="<?php echo ($user["phone"]); ?>"
                                       type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="password" placeholder="请输入新密码" value=""
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="email" placeholder="" value="<?php echo ($user["email"]); ?>"
                                       type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="remark" placeholder="" value="<?php echo ($user["remark"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">状态</label>

                            <div class="col-md-7">
                                <label class="radio-inline"><input name="status" type="radio"
                                    <?php if($user["status"] == 1): ?>checked="checked"<?php endif; ?>
                                    value="1"><span>启用</span></label>
                                <label class="radio-inline"><input name="status" type="radio"
                                    <?php if($user["status"] == 0): ?>checked="checked"<?php endif; ?>
                                    value="0"><span>禁用</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">用户组</label>

                            <div class="col-md-7">
                                <?php if(is_array($authGroupList)): $i = 0; $__LIST__ = $authGroupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><label class="radio-inline"><input name="group_id" type="radio"
                                        <?php if(($user["groupAccess"]["group_id"]) == $group['id']): ?>checked="checked"<?php endif; ?>
                                        value="<?php echo ($group["id"]); ?>"><span><?php echo ($group["title"]); ?></span></label><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <!-- /.box-body -->

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
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
</section>
<script type="text/javascript">
    function oaCheck(obj) {
        var auth = $('#auth').val();
        if ($(obj).is(":checked")) {
            auth += $(obj).val() + ',';
        } else {
            auth = auth.replace($(obj).val() + ',', '');
        }
        $('#auth').val(auth);
    }
</script>