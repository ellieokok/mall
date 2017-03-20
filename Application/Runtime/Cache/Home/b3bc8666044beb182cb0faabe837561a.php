<?php if (!defined('THINK_PATH')) exit();?><div id="dialog-imageUploader">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="border-bottom:1px solid #f4f4f4;">
            <div class="margin pull-right">
                <form action="<?php echo U('Home/File/uploadImage');?>" id="myForm" method="post">
                    <div class="btn btn-success" style="cursor: pointer">本地上传</div>
                    <input type="file" id="file" name="file[]" multiple="multiple" onchange="ajaxForm()"
                           style="margin-top: -30px;width: 82px;height: 34px;opacity: 0;cursor: pointer;"/>
                </form>
            </div>
        </div>
        <div class="row" id="dialog-content">
            <?php if(is_array($file)): $i = 0; $__LIST__ = $file;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><div class="margin" style="width: 120px;height: 120px;float: left;">
                    <img class="img-thumbnail" style="width: 120px; height: 120px;"
                         onclick="selectImage(this,'<?php echo ($file["id"]); ?>')"
                         src="/multi_putong/Public/Uploads/<?php echo ($file["savepath"]); echo ($file["savename"]); ?>">

                    <div class="cover" onclick="cancelSelectImage(this,'<?php echo ($file["id"]); ?>')"></div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php echo ($page); ?>
    </div>
</div>
<script type="text/javascript">
    $('#dialog-imageUploader .pagination a[href]').attr('onclick', 'tabPage(this)');
</script>