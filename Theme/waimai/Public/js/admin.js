/**
 * Created by heqing on 15/7/9.
 */
$(function(){
    //图片延时加载
    $("img.lazy").lazyload({
        threshold: 180,
        effect: "fadeIn",
        skip_invisible: false,
        failure_limit: 10
    });
});

function openUrl(url) {
    $.ajax({
        type: "get",
        url: url,
        success: function () {
            location.reload();
        },
        beforeSend: function () {
            $("#page_tag_load").show();
        },
        complete: function () {
            $("#page_tag_load").hide();
        }
    });
}