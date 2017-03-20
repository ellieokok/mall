/**
 * Created by heqing on 15/9/25.
 */
(function ($) {
    NProgress.configure({
        template: '<div class="bar" role="bar" style="background: white"><div class="peg" style="box-shadow: 0 0 10px #fff, 0 0 5px #fff;"></div></div><div class="spinner" role="spinner"><div class="spinner-icon" style="border-top-color:white;border-left-color: white"></div></div>'
    });
    if ($.support.pjax) {
        $.pjax.defaults.timeout = 6000;
        $(document).pjax('a[target!=_blank][target!=_self]', '#pjax-container');

        $(document).on('pjax:send', function () {
            $('#loading').show();
            NProgress.start();
        });
        $(document).on('pjax:complete', function () {
            $('#loading').hide();
            NProgress.done();
        });
        $(document).on('pjax:timeout', function (event) {
            // Prevent default timeout redirection behavior
            event.preventDefault()
        });
        $(document).on('pjax:beforeReplace', function (contents, options) {
            //处理服务器返回的json通知
            if (options['0'].data != undefined) {
                options['0'].data = '';
            }
        });
        $(document).on('submit', 'form', function (event) {
            //隐藏返回值
            $.pjax.submit(event, '#pjax-container');
        });
        $(document).on('pjax:success', function (event, data, status, xhr) {
            //正则匹配JSON
            if (data.match("^\{(.+:.+,*){1,}\}$")) {
                var data = JSON.parse(data);

                if (data.status == 1) {
                    toastr.success(data.info);
                } else if (data.status == 0) {
                    toastr.error(data.info)
                }

                if (data.url) {
                    $.pjax({
                        url: URL + data.url,
                        container: '#pjax-container'
                    })
                }
            }
        });
    }

    //刷新浏览器导航菜单同步
    var pathname = window.location.pathname;
    $('.sidebar-menu').find('a[href="' + pathname + '"]').parent().addClass('active').parent().parent().addClass('active');
})(jQuery);

function imageUploader(obj, more) {
    $.ajax({
        type: "post",
        url: URL + "Admin/File/imageUploader",
        data: {},
        success: function (data) {
            bootbox.dialog({
                message: data,
                title: "图片上传管理器",
                className: "modal-darkorange",
                buttons: {
                    "确定": {
                        className: "btn-success",
                        callback: function () {
                            $(obj).parent().parent().find('input').val(selectedImage.id);
                            $(obj).parent().parent().find('img').attr('src', selectedImage.url);
                            selectedImage = {};

                            if (more) {
                                var moreObj = $('#albumsClone').children().first().clone();
                                moreObj.find('input').val('');
                                moreObj.find('img').attr('src', PUBLICURL + '/Admin/dist/img/noimage.gif');
                                $('#albumsClone').append(moreObj);
                            }
                        }
                    },
                    "取消": {
                        className: "btn-default",
                        callback: function () {

                        }
                    },
                    "删除": {
                        className: "btn-danger",
                        callback: function () {
                            var delUrl = URL + "Admin/File/delImage/id/" + selectedImage.id;
                            $.get(delUrl, function (data) {
                                var p = $('#dialog-imageUploader .pagination .current').text();
                                var pagUrl = URL + "Admin/File/imageUploader/p/" + p;
                                $.pjax({
                                    url: pagUrl,
                                    container: '.bootbox .bootbox-body',
                                    push: false,
                                });
                            });
                            return false;
                        }
                    }
                }
            });
        },
        error: function (xhr) {
            toastr.error("通讯失败！请重试！");
        }
    });
    return false;
}

function removeImage(obj, more) {
    var parentObj = $(obj).parent().parent();
    parentObj.find('input').val('');
    parentObj.find('img').attr('src', PUBLICURL + '/Admin/dist/img/noimage.gif');

    if (more) {
        parentObj.remove();
    }
}

function tabPage(obj) {
    var pagUrl = $(obj).attr('href');
    $.pjax({
        url: pagUrl,
        container: '.bootbox .bootbox-body',
        push: false,
    });
    event.preventDefault();
}

var selectedImage = {
    id: 0,
    url: '',
};
function selectImage(obj, id) {
    $('#dialog-content .cover').hide();
    $(obj).next().show();
    selectedImage.id = id;
    selectedImage.url = $(obj).attr('src');
}

function cancelSelectImage(obj, id) {
    $(obj).hide();
    selectedImage = {};
}

function ajaxForm() {
    $('#myForm').ajaxSubmit(function (data) {
        var pagUrl = URL + "Admin/File/imageUploader/p/1";
        $.pjax({
            url: pagUrl,
            container: '.bootbox .bootbox-body',
            push: false,
        });
    });
}

function checkAll() {
    //Enable check and uncheck all functionality
    $("table .check").prop("checked", function (index, oldValue) {
        return !oldValue;
    });
}

function batchUrl(url, is_pajx) {
    var id = "";
    $("table .check").each(function () {
        if ($(this).prop("checked")) {
            id += $(this).val() + ",";
        }
    });
    id = id.substr(0, id.length - 1);
    if (id) {
        is_pajx = (typeof(is_pajx) == "undefined") ? true : false;
        if (is_pajx) {
            $.pjax({
                url: url + '/id/' + id,
                container: '#pjax-container',
                push: false,
            });
        } else {
            window.location.href = url + '/id/' + id;
        }
    } else {
        toastr.error("请先选择目标");
    }
}