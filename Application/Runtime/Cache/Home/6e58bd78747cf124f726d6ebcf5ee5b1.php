<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        商城管理
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
                    <h3 class="box-title">新增商品</h3>
                </div>
                <!-- form start -->
                <form action="<?php echo U('Home/Shop/addProduct');?>" method="post" class="form-horizontal">
                    <div class="box-body">
                        <input class="form-control" name="id" placeholder="" value="<?php echo ($product['id']?$product['id']:0); ?>"
                               type="hidden">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品菜单</label>

                            <div class="col-sm-10">
                                <select name="menu_id" class="form-control">
                                    <?php if(is_array($menuList)): $i = 0; $__LIST__ = $menuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($menuList["id"]); ?>"><?php echo ($menuList["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品名称</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="name" placeholder="" value="<?php echo ($product["name"]); ?>" required
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品子名称</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="subname" placeholder="" value="<?php echo ($product["subname"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品价格</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="price" placeholder="" value="<?php echo ($product["price"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品原价格</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="old_price" placeholder="" value="<?php echo ($product["old_price"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品单位</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="unit" placeholder="" value="<?php echo ($product["unit"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">赠送积分</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="score" placeholder="" value="<?php echo ($product["score"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <!--<div class="form-group">-->
                        <!--    <label class="col-sm-2 control-label">商品库存</label>-->

                        <!--    <div class="col-sm-10">-->
                        <!--        <input class="form-control" name="store" placeholder="" value="<?php echo ($product["store"]); ?>"-->
                        <!--               type="text">-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品排序</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="rank" placeholder="" value="<?php echo ($product["rank"]); ?>"
                                       type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片</label>

                            <div class="col-sm-10">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new img-thumbnail">
                                        <?php if(empty($product["file_id"])): ?><img
                                                src="/Public/Admin/dist/img/noimage.gif">
                                            <?php else: ?>
                                            <img src="/Public/Uploads/<?php echo ($product["savepath"]); echo ($product["savename"]); ?>"><?php endif; ?>
                                        <input class="form-control" name="file_id" id="file_id" placeholder=""
                                               value="<?php echo ($product["file_id"]); ?>"
                                               type="hidden">

                                        <div class="edit_pic_mask">
                                            <i class="fa fa-plus-circle" onclick="imageUploader(this,false)"></i>
                                            <i class="fa fa-minus-circle" onclick="removeImage(this,false)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品图集</label>

                            <div class="col-sm-10">
                                <div class="fileupload fileupload-new" data-provides="fileupload" id="albumsClone">
                                    <?php if(is_array($product["albums"])): $i = 0; $__LIST__ = $product["albums"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$albums): $mod = ($i % 2 );++$i;?><div class="fileupload-new img-thumbnail">
                                            <img src="/Public/Uploads/<?php echo ($albums["savepath"]); echo ($albums["savename"]); ?>">
                                            <input class="form-control" name="albums[]" placeholder=""
                                                   value="<?php echo ($albums["id"]); ?>"
                                                   type="hidden">

                                            <div class="edit_pic_mask">
                                                <i class="fa fa-plus-circle" onclick="imageUploader(this,true)"></i>
                                                <i class="fa fa-minus-circle" onclick="removeImage(this,true)"></i>
                                            </div>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

                                    <div class="fileupload-new img-thumbnail">
                                        <img src="/Public/Admin/dist/img/noimage.gif">
                                        <input class="form-control" name="albums[]" placeholder="" value=""
                                               type="hidden">

                                        <div class="edit_pic_mask">
                                            <i class="fa fa-plus-circle" onclick="imageUploader(this,true)"></i>
                                            <i class="fa fa-minus-circle" onclick="removeImage(this,true)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">启用Sku</label>

                            <div class="col-md-7">
                                <label class="radio-inline"><input name="psku" type="radio"
                                    <?php if($product["psku"] == 1): ?>checked="checked"<?php endif; ?>
                                    value="1"><span>开启</span></label>
                                <label class="radio-inline"><input name="psku" type="radio"
                                    <?php if($product["psku"] == 0): ?>checked="checked"<?php endif; ?>
                                    value="0"><span>关闭</span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">商品标签</label>

                            <div class="col-md-7">
                                <?php if(is_array($labelList)): $i = 0; $__LIST__ = $labelList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$label): $mod = ($i % 2 );++$i;?><div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="label[]" value="<?php echo ($label["name"]); ?>"
                                            <?php if(is_array($product["label"])): $i = 0; $__LIST__ = $product["label"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo == $label['name']): ?>checked="checked"<?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                            ><?php echo ($label["name"]); ?>
                                        </label>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">商品状态</label>

                            <div class="col-md-7">
                                <label class="radio-inline"><input name="status" type="radio"
                                    <?php if($product["status"] == 1): ?>checked="checked"<?php endif; ?>
                                    value="1"><span>出售</span></label>
                                <label class="radio-inline"><input name="status" type="radio"
                                    <?php if($product["status"] == -1): ?>checked="checked"<?php endif; ?>
                                    value="-1"><span>下架</span></label>
                                <label class="radio-inline"><input name="status" type="radio"
                                    <?php if($product["status"] == 0): ?>checked="checked"<?php endif; ?>
                                    value="0"><span>售罄</span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注</label>

                            <div class="col-md-10">
                                <input class="form-control" name="remark" placeholder="" value="<?php echo ($product["remark"]); ?>"
                                       type="text">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品详情</label>

                            <div class="col-sm-10">
                                <!-- 加载编辑器的容器 -->
                                <script id="UEditor" name="detail" type="text/plain" style="height:500px;">
                                    <?php echo ($product["detail"]); ?>
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-block btn-danger">保存</button>
                        </div>

                        <div class="col-sm-2">
                            <button type="button" class="btn btn-block btn-default" onclick="history.go(-1)">取消</button>
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
    $(function () {
        //实例化编辑器异步载入
        var editor = new UE.ui.Editor();
        editor.render("UEditor");

        if ('<?php echo ($product); ?>') {
            $('select[name="menu_id"]').val('<?php echo ($product["menu_id"]); ?>');
        }
    });

    function addAttribute() {
        var obj = $('.cloneAttr').first().clone();
        obj.find('input').val('');
        $('#addAttrBtn').before(obj);
    }
</script>