<?php if (!defined('THINK_PATH')) exit();?><section class="content-header">
    <h1>
        微信设置
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
                    <h3 class="box-title">微信设置</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo U('Admin/Weixin/wxSet');?>">
                    <div class="box-body">
                        <input class="form-control" name="id" placeholder="" value="<?php echo ($config['id']?$config['id']:0); ?>"
                               type="hidden">
                        <div class="form-group">
                            <label class="control-label col-md-2">url</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="url" placeholder="" disabled value="<?php echo ($url); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">token</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="token" placeholder="" value="<?php echo ($config["token"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">appid</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="appid" placeholder="" value="<?php echo ($config["appid"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">appsecret</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="appsecret" placeholder="" value="<?php echo ($config["appsecret"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">encodingaeskey</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="encodingaeskey" placeholder=""
                                       value="<?php echo ($config["encodingaeskey"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">微信二维码支付</label>

                            <div class="col-md-7">
                                <label class="radio-inline"><input name="switch" type="radio"
                                    <?php if($config["switch"] == 1): ?>checked="checked"<?php endif; ?>
                                    value="1"><span>开启</span></label>
                                <label class="radio-inline"><input name="switch" type="radio"
                                    <?php if($config["switch"] == 0): ?>checked="checked"<?php endif; ?>
                                    value="0"><span>关闭</span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">mchid</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="mchid" placeholder="" value="<?php echo ($config["mchid"]); ?>"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">key</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="key" placeholder="" value="<?php echo ($config["key"]); ?>"
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