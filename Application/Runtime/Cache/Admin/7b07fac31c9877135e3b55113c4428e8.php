<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
    .select2-container--default .select2-selection--multiple {
        border-radius: 0px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #dd4b39;
        border: 0px;
        border-radius: 0px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #dd4b39;
    }

    #allmap {
        width: 100%;
        height: 100%;
        overflow: hidden;
        margin: 0;
        font-family: "微软雅黑";
    }
</style>

<section class="content-header">
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
                    <h3 class="box-title">商城设置</h3>
                </div>
                <!-- form start -->
                <form action="<?php echo U('Admin/Shop/addShop');?>" method="post" class="form-horizontal">
                    <div class="box-body">
                        <input class="form-control" name="id" placeholder="" value="<?php echo ($shop['id']?$shop['id']:0); ?>"
                               type="hidden">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商城名称</label>

                            <div class="col-sm-6">
                                <input class="form-control" name="name" placeholder="" value="<?php echo ($shop["name"]); ?>"
                                       type="text">
                            </div>
                            <div class="col-md-4" style="color: red">
                                *名称最多8个字
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">子名称</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="subname" placeholder="" value="<?php echo ($shop["subname"]); ?>"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片</label>

                            <div class="col-sm-10">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new img-thumbnail">
                                        <?php if(empty($shop["file_id"])): ?><img
                                                src="/wemall-multiUser/Public/Admin/dist/img/noimage.gif">
                                            <?php else: ?>
                                            <img src="/wemall-multiUser/Public/Uploads/<?php echo ($shop["savepath"]); echo ($shop["savename"]); ?>"><?php endif; ?>
                                        <input class="form-control" name="file_id" id="file_id" placeholder=""
                                               value="<?php echo ($shop["file_id"]); ?>"
                                               type="hidden">

                                        <div class="edit_pic_mask">
                                            <i class="fa fa-plus-circle" onclick="imageUploader(this,false)"></i>
                                            <i class="fa fa-minus-circle" onclick="removeImage(this,false)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if($_SESSION['adminGroupId']== 1 || $shop["status"] > 0): ?><div class="form-group">
                                <label class="control-label col-md-2">店铺状态</label>

                                <div class="col-md-7">
                                    <label class="radio-inline"><input name="status" type="radio"
                                        <?php if($shop["status"] == 1): ?>checked="checked"<?php endif; ?>
                                        value="1"><span>休息</span></label>
                                    <label class="radio-inline"><input name="status" type="radio"
                                        <?php if($shop["status"] == 2): ?>checked="checked"<?php endif; ?>
                                        value="2"><span>营业</span></label>
                                </div>
                            </div><?php endif; ?>

                        <div class="form-group">
                            <label class="control-label col-md-2">首页是否显示店铺列表</label>

                            <div class="col-md-7">
                                <label class="radio-inline"><input name="shoplist" type="radio"
                                    <?php if($shop["shoplist"] == 1): ?>checked="checked"<?php endif; ?>
                                    value="1"><span>显示</span></label>
                                <label class="radio-inline"><input name="shoplist" type="radio"
                                    <?php if($shop["shoplist"] == 0): ?>checked="checked"<?php endif; ?>
                                    value="0"><span>隐藏</span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">店铺是否隐藏</label>

                            <div class="col-md-7">
                                <label class="radio-inline"><input name="is_show" type="radio"
                                    <?php if($shop["is_show"] == 1): ?>checked="checked"<?php endif; ?>
                                    value="1"><span>显示</span></label>
                                <label class="radio-inline"><input name="is_show" type="radio"
                                    <?php if($shop["is_show"] == 0): ?>checked="checked"<?php endif; ?>
                                    value="0"><span>隐藏</span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">店铺员工</label>

                            <div class="col-md-6">
                                <input class="form-control" name="employee" placeholder="格式:A,B"
                                       value="<?php echo ($shop["employee"]); ?>"
                                       type="text">
                                <!--<textarea class="form-control" id="employee" value="" placeholder="格式:A,B"-->
                                <!--          onblur="selectEmployee(this)"-->
                                <!--          rows="3"><?php echo ($shop["employeeName"]); ?></textarea>-->
                            </div>
                            <div class="col-md-4" style="color: red">
                                *输入用户ID（微信用户中心查找）
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商城公告</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" name="notification"
                                          rows="3"><?php echo ($shop["notification"]); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">温馨提示</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" name="reminder" rows="3"><?php echo ($shop["reminder"]); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">客服电话</label>

                            <div class="col-sm-10">
                                <input class="form-control" placeholder="" name="tel" value="<?php echo ($shop["tel"]); ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">客服QQ</label>

                            <div class="col-sm-10">
                                <input class="form-control" placeholder="" name="qq" value="<?php echo ($shop["qq"]); ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">地址</label>

                            <div class="col-sm-10">
                                <input class="form-control" placeholder="" id="address" readonly name="address"
                                       value="<?php echo ($shop["address"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">经纬度</label>

                            <div class="col-md-2">
                                <input class="form-control" name="lng" readonly id="lng" value="<?php echo ($shop["lng"]); ?>"
                                       placeholder="经度"
                                       type="text">
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" name="lat" readonly id="lat" value="<?php echo ($shop["lat"]); ?>"
                                       placeholder="纬度"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">定位</label>

                            <div class="col-sm-10" style="height: 600px">
                                <div id="allmap"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">订单满多少免运费</label>

                            <div class="col-md-2">
                                <input class="form-control" name="full" value="<?php echo ($shop["full"]); ?>" placeholder="满多少"
                                       type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">账户支付折扣</label>

                            <div class="col-md-2">
                                <input class="form-control" step="0.01" name="zhekou" value="<?php echo ($shop["zhekou"]); ?>"
                                       placeholder="在线支付折扣"
                                       type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">运费</label>

                            <div class="col-sm-10">
                                <input class="form-control" placeholder="" name="freight" value="<?php echo ($shop["freight"]); ?>"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">配送时间</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" name="delivery_time"
                                          rows="3"
                                          placeholder="格式(英文逗号)10:30-11:30,14:30-15:30"><?php echo ($shop["delivery_time"]); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="remark" placeholder="" value="<?php echo ($shop["remark"]); ?>"
                                       type="text">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-block btn-danger">保存</button>
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
    var lng = <?php echo ($shop['lng'] ? $shop['lng'] : 113); ?>;
    var lat = <?php echo ($shop['lat'] ? $shop['lat'] : 34); ?>;
    $(document).ready(function () {
        // 百度地图API功能
        var map = new BMap.Map("allmap");
        var point = new BMap.Point(lng, lat);
        map.centerAndZoom(point, 14);
        map.enableScrollWheelZoom();
        map.enableInertialDragging();
        map.enableContinuousZoom();

        var marker = new BMap.Marker(point);  // 创建标注
        map.addOverlay(marker);               // 将标注添加到地图中
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        marker.disableDragging();           // 不可拖拽

        var size = new BMap.Size(10, 20);
        var geoc = new BMap.Geocoder();

        map.addControl(new BMap.CityListControl({
            anchor: BMAP_ANCHOR_TOP_LEFT,
            offset: size,
            // 切换城市之间事件
            // onChangeBefore: function(){
            //    alert('before');
            // },
            // 切换城市之后事件
            // onChangeAfter:function(){
            //   alert('after');
            // }
        }));
        //单击获取点击的经纬度
        map.addEventListener("click", function (e) {
            map.clearOverlays();

//            alert(e.point.lng + "," + e.point.lat);
            var point = new BMap.Point(e.point.lng, e.point.lat);
            marker = new BMap.Marker(point);  // 创建标注
            marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
            marker.disableDragging();
            map.addOverlay(marker);               // 将标注添加到地图中

            $('#lng').val(e.point.lng);
            $('#lat').val(e.point.lat);

            var pt = e.point;
            geoc.getLocation(pt, function (rs) {
                var addComp = rs.addressComponents;
                var address = addComp.province + "," + addComp.city + "," + addComp.district + "," + addComp.street + "," + addComp.streetNumber;
                $('#address').val(address);
            });
        });
    });

    function selectEmployee(obj) {
        ReplaceDot(obj);
        $.ajax({
            type: "post",
            url: URL + "Admin/Shop/selectEmployee",
            data: {
                name: $(obj).val()
            },
            success: function (data) {
                var json = eval(data);
                var id = json.id.join();
                var name = json.name.join();

                $('input[name="employee"]').val(id);
                $('#employee').val(name);
            },
            error: function (xhr) {
                toastr.error("通讯失败！请重试！");
            }
        });
    }
</script>