<?php if (!defined('THINK_PATH')) exit();?><iframe src="http://114.55.28.162/addon/Home/addon/" allowtransparency="true" id="myiframe"
        style="background-color:transparent;min-height: 800px;" frameborder="0" width="100%">
</iframe>

<script type="text/javascript">
    window.addEventListener('message', function (e) {
        if (e.origin != 'http://114.55.28.162') {
            return
        }
        var data = JSON.parse(e.data);
        install(data.path, data.filename, data.type);
    }, false);
    function install(path, filename, type) {
        $.ajax({
            type: "post",
            url: "<?php echo U('Home/Addon/getFileDownload');?>",
            data: {
                path: path,
                filename: filename,
                type: type
            },
            success: function (res) {
                console.log('开始下载');
                layer.msg('开始下载');
                compare(res.savePath, res.saveName, res.fileSize);
            }
        });
    }

    function compare(path, filename, filesize) {
        var interval = setInterval(function () {
            $.ajax({
                type: "post",
                url: "<?php echo U('Home/Addon/compare');?>",
                data: {
                    path: path,
                    filename: filename,
                    filesize: filesize,
                },
                success: function (res) {
                    if (res == 1) {
                        clearInterval(interval);
                        console.log('下载完成');
                        layer.msg('下载完成', {time: 2000});
                    }
                }
            });
        }, 2000);
    }
</script>