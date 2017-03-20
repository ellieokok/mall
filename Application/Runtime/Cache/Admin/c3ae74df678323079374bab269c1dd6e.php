<?php if (!defined('THINK_PATH')) exit();?> <section class="content-header">
    <h1>
        大转盘管理
        <small></small>
    </h1>
</section> 
 <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">大转盘设置</h3>  
<!-- /.box-tools -->
  </div>
                
        
                            <div class="box-body no-padding">
                                <div class="mailbox-controls">
                                    <div class="btn-group">
                            <a data-toggle="tab" href="#tab1" class="btn btn-danger "><i class="icon-comments"></i>大转盘设置</a>
                        </div>    
                        <div class="btn-group">
                            <a data-toggle="tab" href="#tab2" class="btn btn-danger "><i class="icon-user"></i>大转盘记录</a>
                        </div>
                               
                                <div class="tab-content padded" id="my-tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <p>
                                            <form action="<?php echo u_addons('Wheel://Admin/Admin/addConfig');?>" id="myForm" method="post" onsubmit="return false;" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">大转盘名称</label>
                                                    <div class="col-md-7">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["name"]); ?>" name="name" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">活动时间</label>
                                                    <div class="col-md-7">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["activity_time"]); ?>" name="activity_time" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">活动说明</label>
                                                    <div class="col-md-7">
                                                        <!--style给定宽度可以影响编辑器的最终宽度-->
                                                        <script id="UEditor" name="activity_explain" type="text/plain" style="height:500px;">
                                                            <?php echo ($config["activity_explain"]); ?>

                                                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">状态</label>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="status">
                                                            <option value="1">是</option>
                                                            <option value="0">否</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">一天参与一次</label>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="everyday">
                                                            <option value="1">是</option>
                                                            <option value="0">否</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">一等奖中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level1_prob"]); ?>" name="level1_prob" type="text">
                                                    </div>
                                                    <label class="control-label col-md-2">一等奖库存</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level1_store"]); ?>" name="level1_store" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">二等奖中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level2_prob"]); ?>" name="level2_prob" type="text">
                                                    </div>
                                                    <label class="control-label col-md-2">二等奖库存</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level2_store"]); ?>" name="level2_store" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">三等奖中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level3_prob"]); ?>" name="level3_prob" type="text">
                                                    </div>
                                                    <label class="control-label col-md-2">三等奖库存</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level3_store"]); ?>" name="level3_store" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">四等奖中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level4_prob"]); ?>" name="level4_prob" type="text">
                                                    </div>
                                                    <label class="control-label col-md-2">四等奖库存</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level4_store"]); ?>" name="level4_store" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">五等奖中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level5_prob"]); ?>" name="level5_prob" type="text">
                                                    </div>
                                                    <label class="control-label col-md-2">五等奖库存</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level5_store"]); ?>" name="level5_store" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">六等奖中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level6_prob"]); ?>" name="level6_prob" type="text">
                                                    </div>
                                                    <label class="control-label col-md-2">六等奖库存</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level6_store"]); ?>" name="level6_store" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">未中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level7_prob"]); ?>" name="level7_prob" type="text">
                                                    </div>
                                                    <label class="control-label col-md-2">未中奖概率</label>
                                                    <div class="col-md-2">
                                                        <input class="form-control" placeholder="" value="<?php echo ($config["level7_store"]); ?>" name="level7_store" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2"></label>
                                                    <div class="col-md-7">
                                                        <button class="btn btn-danger" onclick="myFormSubmit('<?php echo u_addons('Wheel://Admin/Admin/index');?>')" type="submit">提交
                                                        </button>
                                                        <button class="btn btn-default-outline">取消</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <p>
                                            <div class="widget-content padded clearfix">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <th class="check-header hidden-xs">
                                                            <label>
                                                                <input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                                                        </th>
                                                        <th>
                                                            ID
                                                        </th>
                                                        <th>
                                                            用户名
                                                        </th>
                                                        <th class="hidden-xs">
                                                            奖项
                                                        </th>
                                                        <th class="hidden-xs">
                                                            时间
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(is_array($record)): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$record): $mod = ($i % 2 );++$i;?><tr>
                                                                <td class="check hidden-xs">
                                                                    <label>
                                                                        <input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($record["id"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($record["username"]); ?>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo ($record["level"]); ?>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo ($record["time"]); ?>
                                                                </td>
                                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </tbody>
                                                </table>
                                                <div class="box-footer no-padding">
             
<div class="pull-right" style="margin-bottom: 6px">
                                                            <?php echo ($page); ?>
<!-- /.btn-group -->
 </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
       
    
</section>

<!-- <script type="text/javascript">
//实例化编辑器
var um = UM.getEditor('myEditor', {
    textarea: 'activity_explain'
});

function setFocus() {
    UM.getEditor('myEditor').focus();
}
</script>
<script>
if ('<?php echo ($config); ?>') {
    $('select[name="status"]').val('<?php echo ($config["status"]); ?>');
    $('select[name="everyday"]').val('<?php echo ($config["everyday"]); ?>');
    UM.getEditor('myEditor').setContent('<?php echo ($config["activity_explain"]); ?>');
}
</script>
 -->

<script type="text/javascript">
    $(function() {
    //实例化编辑器异步载入
    var editor = new UE.ui.Editor();
        editor.render("UEditor");
    });

    if ('<?php echo ($config); ?>') {
        $('select[name="status"]').val('<?php echo ($config["status"]); ?>');
        $('select[name="everyday"]').val('<?php echo ($config["everyday"]); ?>');
        // UE.getEditor('myEditor').setContent('<?php echo ($config["activity_explain"]); ?>');
    }
</script>