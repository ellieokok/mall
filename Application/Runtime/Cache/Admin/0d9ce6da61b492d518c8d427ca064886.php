<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        用户管理
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
                    <h3 class="box-title">新增用户组</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo U('Admin/User/addAuthGroup');?>" method="post">
                    <div class="box-body">
                        <input class="form-control" name="id" placeholder="" value="0"
                               type="hidden">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="title" placeholder="" value="<?php echo ($authGroup["title"]); ?>"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">权限</label>

                            <div class="col-sm-10">

                                <!--<ul style="list-style-type:none;padding: 0px;padding-top: 6px;">-->
                                    <!--<th class="hidden-xs">-->
                                        <!--<input onchange="checkAll()" type="checkbox" value="">-->
                                        <!--全选/反选-->
                                    <!--</th>-->
                                    <!--<hr/>-->
                                    <!--<?php if(is_array($authRuleList)): foreach($authRuleList as $key=>$auth): ?>-->
                                        <!--<li>-->
                                            <!--<input type="checkbox" name="rules[]" value="<?php echo ($auth["id"]); ?>"-->
                                            <!--<?php if(strpos($authGroup['rules'] , $auth['id']) > -1): ?>checked="true"<?php endif; ?>/>-->
                                            <!--<?php echo ($auth["title"]); ?>-->
                                        <!--</li>-->
                                    <!--<?php endforeach; endif; ?>-->
                                <!--</ul>-->

                                <div class="table-responsive" style="overflow-x: visible;">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <th style="width: 30px">
                                                <input onchange="checkAll()" type="checkbox" value="">
                                            </th>
                                            <th>权限标题</th>
                                            <th>权限</th>
                                        </tr>
                                        <?php if(is_array($authRuleList)): $i = 0; $__LIST__ = $authRuleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$auth): $mod = ($i % 2 );++$i;?><tr>
                                                <td>
                                                    <label><input type="checkbox" name="rules[]" class="check" value="<?php echo ($auth["id"]); ?>"
                                                        <?php if(strpos($authGroup['rules'] , ','.$auth['id'].',') > -1): ?>checked="true"<?php endif; ?>/></label>
                                                </td>
                                                <td>
                                                    <?php echo ($auth["title"]); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($auth["name"]); ?>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </table>
                                </div>
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
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
</section>
<script type="text/javascript">
    if ('<?php echo ($authGroup); ?>') {
        $('input[name="id"]').val('<?php echo ($authGroup["id"]); ?>');
    }
</script>