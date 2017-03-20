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
                    <h3 class="box-title">微信自定义回复</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a href="<?php echo U('Home/Weixin/addWxReply');?>" class="btn btn-danger ">
                                新增自定义回复
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
                                <th>类型</th>
                                <th>标题</th>
                                <th>描述</th>
                                <th>图片</th>
                                <th>URL</th>
                                <th>关键词</th>
                                <th>备注</th>
                                <th>操作</th>
                            </tr>

                            <?php if(is_array($wxReply)): $i = 0; $__LIST__ = $wxReply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wxReply): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($wxReply["id"]); ?>"></label>
                                    </td>
                                    <td><?php echo ($wxReply["id"]); ?></td>
                                    <td><?php echo ($wxReply["type"]); ?></td>
                                    <td><?php echo (msubstr($wxReply["title"],0,12)); ?></td>
                                    <td><?php echo (msubstr($wxReply["description"],0,12)); ?></td>
                                    <td>
                                        <div class="btn-group" style="margin: 0px;">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                图片<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <img style="height: 200px"
                                                         src="/wemall-multiUser/Public/Uploads/<?php echo ($wxReply["savepath"]); echo ($wxReply["savename"]); ?>">
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?php echo ($wxReply["url"]); ?></td>
                                    <td><?php echo ($wxReply["key"]); ?></td>
                                    <td><?php echo ($wxReply["remark"]); ?></td>
                                    <td class="table-action"><a
                                            href="<?php echo U('Home/Weixin/modWxReply',array('id'=>$wxReply['id']));?>">修改</a><a
                                            href="<?php echo U('Home/Weixin/delWxReply',array('id'=>$wxReply['id']));?>">删除</a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Home/Weixin/delWxReply');?>')">全部删除
                                    </button>
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