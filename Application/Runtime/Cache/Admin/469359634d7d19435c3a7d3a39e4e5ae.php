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
                    <h3 class="box-title">广告管理</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!--<div class="mailbox-controls">-->
                    <!--    <div class="btn-group">-->
                    <!--        <a href="<?php echo U('Admin/Shop/addAds');?>" class="btn btn-danger ">-->
                    <!--            新增广告-->
                    <!--        </a>-->
                    <!--    </div>-->
                        <!-- /.btn-group -->
                    <!--</div>-->
                    <div class="table-responsive" style="overflow-x: visible;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th class="hidden-xs">
                                    <label><input onchange="checkAll()" type="checkbox" value=""></label>
                                </th>
                                <th>ID</th>
                                <th>店铺ID</th>
                                <th>分类</th>
                                <th>名称</th>
                                <th>介绍</th>
                                <th>链接</th>
                                <th>图片</th>
                                <th>排序</th>
                                <th>备注</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($ads)): $i = 0; $__LIST__ = $ads;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ads): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="hidden-xs">
                                        <label><input name="checkbox" class="check" type="checkbox"
                                                      value="<?php echo ($ads["id"]); ?>"></label>
                                    </td>
                                    <td>
                                        <?php echo ($ads["id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($ads["shop_id"]); ?>
                                    </td>                                                                        
                                    <td>
                                        <?php if($ads["adsname"] == 1): ?><span class="label label-primary">幻灯片</span>
                                        <?php elseif($ads["adsname"] == 2): ?>
                                            <span class="label label-info">插件</span>
                                        <?php else: ?>
                                            <span class="label label-warning">广告位</span><?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo ($ads["name"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($ads["sub"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($ads["url"]); ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" style="margin: 0px">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                图片<span class="caret"></span></button>
                                            <div class="dropdown-menu">
                                                <img style="height: 200px"
                                                     src="/Public/Uploads/<?php echo ($ads["savepath"]); echo ($ads["savename"]); ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo ($ads["rank"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($ads["remark"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($ads["time"]); ?>
                                    </td>
                                    <td class="table-action"><a
                                            href="<?php echo U('Admin/Shop/modAds',array('id'=>$ads['id']));?>">修改</a><a
                                            href="<?php echo U('Admin/Shop/delAds',array('id'=>$ads['id']));?>">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"
                                            onclick="batchUrl('<?php echo U('Admin/Shop/delAds');?>')">全部删除
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