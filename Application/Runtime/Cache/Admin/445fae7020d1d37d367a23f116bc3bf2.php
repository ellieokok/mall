<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        报名设置
        <small></small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">报名设置</h3>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body no-padding">                        
                    <div class="mailbox-controls">
                        <div class="btn-group">
                            <a data-toggle="tab" href="#tab1" class="btn btn-danger "><i class="icon-comments"></i>报名设置</a>
                        </div>    
                        <div class="btn-group">
                            <a data-toggle="tab" href="#tab2" class="btn btn-danger "><i class="icon-user"></i>报名记录</a>
                        </div>
                        <div class="tab-content padded" id="my-tab-content">
                            <div class="tab-pane active" id="tab1">
<!--                                 <h3>
                                    报名设置
                                </h3> -->

                                <p>

                                <form action="<?php echo u_addons('Apply://Admin/Admin/addConfig/addon/Apply');?>" id="myForm" method="post"
                                      onsubmit="return false;" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-md-2">报名名称</label>

                                        <div class="col-md-7">
                                            <input class="form-control" placeholder="" value="<?php echo ($config["name"]); ?>"
                                                   name="name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">项目名称(多项目英文逗号区分)</label>

                                        <div class="col-md-7">
                                            <textarea class="form-control" name="event"
                                                      type="text"><?php echo ($config["event"]); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">项目时间</label>

                                        <div class="col-md-7">
                                            <input class="form-control" placeholder="" value="<?php echo ($config["time_range"]); ?>"
                                                   name="time_range" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">项目介绍</label>

                                        <div class="col-md-7">
                                            <!--style给定宽度可以影响编辑器的最终宽度-->
                                            <script type="text/plain" id="UEditor" name="introduce" style="width:100%;height:340px;">
                                                <?php echo ($config["introduce"]); ?>
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">浏览量</label>

                                        <div class="col-md-7">
                                            <input class="form-control" placeholder="" value="<?php echo ($config["visiter"]); ?>"
                                                   name="visiter" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">申请量</label>

                                        <div class="col-md-7">
                                            <input class="form-control" placeholder="" value="<?php echo ($config["apply"]); ?>"
                                                   name="apply" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">状态</label>

                                        <div class="col-md-7">
                                            <select class="form-control" name="status">
                                                <option value="1">开启</option>
                                                <option value="0">关闭</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <!-- <label class="control-label col-md-2"></label> -->

                                        <div class="col-md-2">
                                            <button class="btn btn-block btn-danger"
                                                    type="submit">保存
                                            </button>
                                        </div>
                                        <div class="col-md-2">    
                                            <button class="btn btn-block btn-default">取消</button>
                                        </div>
                                    </div>
                                </form>
                                </p>
                            </div>
                            <div class="tab-pane" id="tab2">
<!--                                 <h3>
                                    报名记录
                                </h3> -->

                                <p>

                                <div class="widget-content padded clearfix">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <th class="check-header hidden-xs">
                                                <label><input id="checkAll" name="checkAll"
                                                              type="checkbox"><span></span></label>
                                            </th>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                联系人
                                            </th>
                                            <th class="hidden-xs">
                                                联系电话
                                            </th>
                                            <th class="hidden-xs">
                                                项目
                                            </th>
                                            <th class="hidden-xs">
                                                时间
                                            </th>
                                        </tbody>
                                        <tbody>
                                        <?php if(is_array($record)): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$record): $mod = ($i % 2 );++$i;?><tr>
                                                <td class="check hidden-xs">
                                                    <label><input name="optionsRadios1" type="checkbox"
                                                                  value="option1"><span></span></label>
                                                </td>
                                                <td>
                                                    <?php echo ($record["id"]); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($record["name"]); ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo ($record["phone"]); ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo ($record["event"]); ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo ($record["time"]); ?>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="pull-right">
                                        
                                         <?php echo ($page); ?>
                                    </div>
                                   
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                        
                    

                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(function () {
        //实例化编辑器异步载入
        var editor = new UE.ui.Editor();
        editor.render("UEditor");

        if ('<?php echo ($config); ?>') {
            $('select[name="status"]').val('<?php echo ($config["status"]); ?>');
        }
    });
</script>