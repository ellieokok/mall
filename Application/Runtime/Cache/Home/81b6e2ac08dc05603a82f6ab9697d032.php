<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        文章管理
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
                    <h3 class="box-title">文章管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Artical/addArtical');?>" class="btn btn-danger ">
                                新增文章
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
                                <th>标题</th>
                                <th>作者</th>
                                <th>链接</th>
                                <th>图片</th>
                                <th>备注</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($articalList)): $i = 0; $__LIST__ = $articalList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$artical): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($artical["id"]); ?>"></label>
                                    </td>
                                    <td>
                                        <?php echo ($artical["id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($artical["title"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($artical["author"]); ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" style="margin: 0px">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                链接<span class="caret"></span></button>
                                            <div class="dropdown-menu" style="padding: 10px;max-width: none;">
                                                <?php echo ($url); echo U('App/Artical/index' , array('id'=>$artical['id']));?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" style="margin: 0px">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                图片<span class="caret"></span></button>
                                            <div class="dropdown-menu">
                                                <img style="height: 200px"
                                                     src="/Public/Uploads/<?php echo ($artical["savepath"]); echo ($artical["savename"]); ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo ($artical["remark"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($artical["time"]); ?>
                                    </td>
                                    <td class="table-action"><a
                                            href="<?php echo U('Home/Artical/modArtical',array('id'=>$artical['id']));?>">修改</a><a
                                            href="<?php echo U('Home/Artical/delArtical',array('id'=>$artical['id']));?>">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Home/Artical/delArtical');?>')">全部删除
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