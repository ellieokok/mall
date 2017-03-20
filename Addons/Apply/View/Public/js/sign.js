var id = 0;
var score = 0;
function hidePop(){
    $("#join_box").hide();
    $("#cover2").hide();
}
function showPop(){
    $("#join_box").show();
    $("#cover2").show();
}
function doCart(obj , scoreIn ,idIn){
    if(parseFloat(scoreIn) > parseFloat($('#myscore').html())){
        alert("积分不足!");
        return;
    }
    id = idIn;
    score = scoreIn;
    showPop();
}

var signFlag = true;
function signIn(obj){
    $.ajax({
        type: "post",
        url: baseUrl + "/App/Sign/sign",
        data: {

        },
        success: function (data) {
            if(data){
                var json = eval(data)
                $("#alert").show();
                if (typeof json.score != "undefined") {
                    $("#alert_text").html("恭喜您获得"+json.score+"积分");
                }else{
                    $("#alert_text").html("对不起，您已签到！");
                }

            }
        },
        beforeSend: function () {

        },
        complete: function () {
        }

    });

    $("#alert").show();
}
function hideAlert(){
    $("#alert").hide();
    location.reload();
}
var submitFlag = true;
function submitOrder(){
    if (submitFlag == false) {
        alert("请不要重复操作!");
        return;
    };
    var name = $('#name').val();
    var phone = $('#phone').val();
    var address = $('#address').val();
    var note = $('#note').val();

    if (name.length == 0 || phone.length == 0 || address.length == 0) {
        alert("请核对输入的信息!");
        return;
    };
    submitFlag = false;

    $.ajax({
        type: "post",
        url: baseUrl + "/App/Sign/addOrder",
        data: {
            name: name,
            phone: phone,
            id: id,
            score: score,
            address: address,
            note: note
        },
        success: function (data) {
            if(data){
                hidePop();
                alert("商品兑换成功!");
                location.reload();
            }
        },
        beforeSend: function () {

        },
        complete: function () {
        }

    });
}