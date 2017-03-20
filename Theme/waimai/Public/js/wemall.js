/**
 * Created by heqing on 15/1/13.
 */
$(document).ready(function () {

    var cookie = $.cookie("load");
    if (cookie) {
        cookie = JSON.parse(cookie);
        cartData = cookie.cartData;
        totalPrice = cookie.totalPrice;
        totalNum = cookie.totalNum;

        $("#shopcart-tip").show();
        $("#shopcart-tip").html(totalNum);
        if (totalNum == 0) {
            $("#shopcart-tip").hide();
        }
    }

    // js路由
    Path.map("#/index").to(function() {
        $(".navigation-wrap").show();
        $('#nav-ads').click();
        var mySwiper = new Swiper('.swiper-container',{
            pagination : '.swiper-pagination',
            autoplay: 2000,//可选选项，自动滑动
        })
    });
    Path.map("#/product").to(function () {
        $('#nav-product').click();
    });
    Path.map("#/product/:id").to(function () {
        var id = this.params['id'];
        clickItemDetail(id);
    });
    Path.map("#/cart").to(function () {
        $('#nav-cart').click();
    });
    Path.map("#/order/:id").to(function () {
        var id = this.params['id'];
        displayOrderResult(id);
    });
    Path.map("#/user").to(function () {
        $('#nav-user').click();
    });
    Path.map("#/selectShop").to(function () {
        selectShop()                
    });    
    Path.root("#/index");
    Path.listen();
    // $("#selectShop12").click();
    // selectShop();
    // $("#nav-cart").click();

    //下拉刷新懒加载店铺
    // var lazyNum = 1;
    // $(window).scroll(function () {
    //     var doc = document,
    //     win = window,
    //     scrollBottom = $(doc).height() - $(win).height() - $(win).scrollTop();
    //     if(scrollBottom<30){
    //         lazyNum++;
    //         lazyShop(lazyNum);
    //     }
    // });

    if(is_weixin()){
        if(isbindPhone == 0){
            openRegister();
        }         
    }
    // else{
    //     //非微信浏览器下，isbindPhone等同登录状态值，1为登录
    //     if(isbindPhone == 1){

    //     }else{
    //         openLogin();
    //     }   
    // }    
});
// var firstCome=0;
// if(firstCome==0){
    
//     firstCome = 1;
// }

//判断是否是微信浏览器
function is_weixin(){
    var ua = navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i)=="micromessenger") {
        return true;
    } else {
        return false;
    }
}

var lng = '';//用户经度
var lat = '';//用户纬度
function locationmy(){
    // lng = 113.650035;//用户经度
    // lat = 34.7854;//用户纬度
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'http://restapi.amap.com/v3/geocode/regeo?output=json&location='+lng+','+lat+'&key=22f9022b217b7d764f5befb4aa74456f&radius=1000&extensions=all&callback=renderOption';
    document.head.appendChild(script);
}
function renderOption(response) {
    document.getElementById('pi_address').innerHTML = response.regeocode.formatted_address;
}

// 微信定位
var  appIdo= ''; // 必填，公众号的唯一标识
var  timestampo= ''; // 必填，生成签名的时间戳
var  nonceStro= ''; // 必填，生成签名的随机串
var  signatureo= '';// 必填，签名，见附录1


wx.config({
    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: data.wxConfig.appId, // 必填，公众号的唯一标识
    timestamp: data.wxConfig.timestamp, // 必填，生成签名的时间戳
    nonceStr: data.wxConfig.nonceStr, // 必填，生成签名的随机串
    signature: data.wxConfig.signature,// 必填，签名，见附录1
    jsApiList: ['getLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
//pidong 打开多店铺
 function selectShop(){

    tabTmpl("select-shop");
    $(".navigation-wrap").hide();
    var firstOpen = data.config.id;
    if(firstOpen != 0 && firstOpen != undefined && firstOpen !=''){
        $("#pi_back").show();
    }else{
        $("#pi_back").hide();
    }
    wx.ready(function () {
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                lat = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                lng = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
                locationmy();
                shopList();            
            }
        });
    })

 }

 function shopList(){
        $.ajax({
        type: "post",
        url: data.baseUrl + "/App/User/getShopList",
        data: {
            lng: lng,
            lat: lat,
        },
        success: function (res) {
            var html = '';
            $.each(res, function (index, value) {
                html += '<a class="grst-block" onclick="openTHisShop('+value.id+')"><img class="grst-logo" style="opacity: 1; transition: opacity 0.5s;" alt="'+value.name+'" src="'+data.uploadsUrl+value.savepath+value.savename+'"><div class="grst-detail"><div class="grst-name"><span class="ng-binding">'+value.name+'</span><span class="grst-misc ng-binding">&nbsp;&nbsp;'+value.km+'km</span></div><span class="grst-misc ng-binding">'+value.subname+'</span><div class="grst-misc"><span class="ng-binding">'+value.address+'</span></div><div class="grst-activity "><p class="grst-activity-detail "><span class="rst-badge ng-binding" style="background: rgb(240, 115, 115);">减</span> <span class="ng-binding">满减优惠</span><span class="activity-offline"> (满'+value.full+'减'+value.discount+')</span></p><p class="grst-activity-detail "><span class="rst-badge ng-binding" style="background: rgb(255, 78, 0);">付</span> <span class="ng-binding">在线支付</span></p></div></div></a>';
            });

            $('#mod-desc').html(html);
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }

    });
 }
 //pidong 搜索店铺
 function searchShop(){
    var name = $('.pi_input').val(); 
    $.ajax({
        type: "post",
        url: data.baseUrl + "/App/User/getShopList",
        data: {
            name:name,
            lng: lng,
            lat: lat,            
        },
        success: function (res) {
            var html = '';
            $.each(res, function (index, value) {
                html += '<a class="grst-block" onclick="openTHisShop('+value.id+')"><img class="grst-logo" style="opacity: 1; transition: opacity 0.5s;" alt="'+value.name+'" src="'+data.uploadsUrl+value.savepath+value.savename+'"><div class="grst-detail"><div class="grst-name"><span class="ng-binding">'+value.name+'</span><span class="grst-misc ng-binding">&nbsp;&nbsp;'+value.km+'km</span></div><span class="grst-misc ng-binding">'+value.subname+'</span><div class="grst-misc"><span class="ng-binding">'+value.address+'</span></div><div class="grst-activity "><p class="grst-activity-detail "><span class="rst-badge ng-binding" style="background: rgb(240, 115, 115);">减</span> <span class="ng-binding">满减优惠</span><span class="activity-offline"> (满'+value.full+'减'+value.discount+')</span></p><p class="grst-activity-detail "><span class="rst-badge ng-binding" style="background: rgb(255, 78, 0);">付</span> <span class="ng-binding">在线支付</span></p></div></div></a>';
            });

            $('#mod-desc').html(html);
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }

    });
 }
//pidong  懒加载店铺列表

// function lazyShop(lazyNum){
//     $.ajax({
//         type: "post",
//         url: data.baseUrl + "/App/User/getShopList",
//         data: {
//             status: 2,
//             lazyNum: lazyNum,
//             // lat:,
//         },
//         success: function (res) {
//             var html = '';
//             $.each(res, function (index, value) {
//                 html += '<a class="grst-block" onclick="openTHisShop('+value.id+')"><img class="grst-logo" style="opacity: 1; transition: opacity 0.5s;" alt="'+value.name+'" src="'+data.uploadsUrl+value.savepath+value.savename+'"><div class="grst-detail"><div class="grst-name"><span class="ng-binding">'+value.name+'</span></div><span class="grst-misc ng-binding">'+value.subname+'</span><div class="grst-misc"><span class="ng-binding">'+value.address+'</span></div><div class="grst-activity "><p class="grst-activity-detail "><span class="rst-badge ng-binding" style="background: rgb(240, 115, 115);">减</span> <span class="ng-binding">满减优惠</span><span class="activity-offline"> (满'+value.full+'减'+value.discount+')</span></p><p class="grst-activity-detail "><span class="rst-badge ng-binding" style="background: rgb(255, 78, 0);">付</span> <span class="ng-binding">在线支付</span></p></div></div></a>';
//             });
//             $('#mod-desc').append(html);
//         },
//         beforeSend: function () {
//             $('#page_tag_load').show();
//         },
//         complete: function () {
//             $('#page_tag_load').hide();
//         }

//     });

// }

//pidong 打开当前店铺
function openTHisShop(id){
    window.location.href=data.baseUrl + "/App/Index/index/shopid/"+id;
    set("shopId",id);
    cartData = [];
    totalNum = 0;
    totalPrice = 0;
    payment = -1;
    initProduct();
 }

function set(key, data) {
    return window.localStorage.setItem(key, window.JSON.stringify(data));
}
function get(key) {
    return window.JSON.parse(window.localStorage.getItem(key));
}
function remove(key) {
    return window.localStorage.removeItem(key);
}
       

function backToTop() {
    $("html,body").animate({scrollTop: 0}, 200);
}

function displayOrderResult(id) {
    $.ajax({
        type: "get",
        url: data.baseUrl + "/App/Order/getOrder",
        data: {
            id:id
        },
        success: function (data) {
            $('#nav-cart').click();
            tabTmpl("orderResult-container");
            $(".header-title").html("支付结果");

            $('#result-order-no').html(data.orderid);
            $('#items-order-result').find('.date').html(data.time);
            $('#items-order-result').find('.freight').html(data.freight);
            if(data.totalprice >= data.full ){
                $('#items-order-result').find('.discount').html(data.discount);
            }
            $('#items-order-result').find('.total').children().html(data.totalprice);

            if (data.pay_status == 1) {
                $('#status').html("支付成功");
            } else {
                $('#status').html("未支付");
            }

            var json = eval(data.detail);
            var html = '';
            $.each(json, function (index, value) {
                var sku = '';
                if (parseInt(value.sku_id)) {
                    sku = '（' + value.sku_name + '）';
                }
                html += '<li><span class="order-item-name">' + value.name + sku + '</span><span class="order-item-price">￥' + value.price + '</span><span class="order-item-amount">' + value.num + '份</span></li>';
            });
            $('#item-order-list ul').html(html);
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }

    });
}

var menuId = 0;
function changeMenu(obj, id, toggle) {
    $('.menuItem').removeClass("active");
    $(obj).addClass("active");

    menuId = id;
    if (toggle == 'toggle') {
        $('#types-dropdown').toggle();
        var ex = $(obj).html();
        var exClick = $(obj).attr("onclick");
        var more = $('#more-types').html();
        var moreClick = $('#more-types').attr("onclick");

        $('#more-types').html(ex);
        $('#more-types').attr("onclick", exClick);
        $(obj).html(more);
        $(obj).attr("onclick", moreClick);

        $('#more-types').addClass("active");
    }

    $.each($('#items').children(), function (index, value) {
        if ($(this).attr("label-cate") == id) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    if ($('#notification').length) {
        $('#notification').show();
    }

    backToTop();
}


function doCart(obj, id, name, price, skuIs) {
    if ($('#itemsDetail').length > 0) {
        if (skuIs == "") {
            var flag = 0;
            $.each(cartData, function (index, value) {
                if (value.id == id) {
                    flag = 1;
                    value.num++;
                    return;
                }
            });
            if (flag == 0) {
                var current = '{"id":"' + id + '","name":"' + name + '","num":"' + 1 + '","price":"' + price + '"}';
                cartData.push(JSON.parse(current));
            }
        } else {
            if (sku.product_id != id) {
                alert("error");
                return;
            }

            var flag = 0;
            $.each(cartData, function (index, value) {
                if (value.id == id && value.sku_id == sku.sku_id) {
                    flag = 1;
                    value.num++;
                    return;
                }
            });
            if (flag == 0) {
                var current = '{"id":"' + id + '","name":"' + name + '","num":"' + 1 + '","price":"' + sku.price + '","sku_name":"' + sku.sku_name + '","sku_id":"' + sku.sku_id +'"}';
                cartData.push(JSON.parse(current));
            }
        }
        // console.log(cartData);
        initProduct();
        return;
    } else {
        var flag = 0;
        $.each(cartData, function (index, value) {
            if (value.id == id) {
                flag = 1;
                value.num++;
                return;
            }
        });
        if (flag == 0) {
            var current = '{"id":"' + id + '","name":"' + name + '","num":"' + 1 + '","price":"' + price + '"}';
            cartData.push(JSON.parse(current));
        }
        // console.log(cartData);
        initProduct();
        return;
    }
}
function initProduct() {
    $.each($('#items').children(), function (index, value) {
        $(this).find('.numbers-minus').hide();
        $(this).find('.numbers').hide();
        $(this).find('.numbers').val(0);
    });
    $.each(cartData, function (index, value) {
        $('#items').find('li[label-id="' + value.id + '"]').find('.numbers-minus').show();
        $('#items').find('li[label-id="' + value.id + '"]').find('.numbers').show();
        $('#items').find('li[label-id="' + value.id + '"]').find('.numbers').val(value.num);

        $('#product-hot').find('li[label-id="' + value.id + '"]').find('.numbers-minus').show();
        $('#product-hot').find('li[label-id="' + value.id + '"]').find('.numbers').show();
        $('#product-hot').find('li[label-id="' + value.id + '"]').find('.numbers').val(value.num);
    });
    initCartDate();
}

function initCartDate() {
    totalNum = 0;
    totalPrice = 0;

    $.each(cartData, function (index, value) {
        totalNum += parseInt(value.num);
        totalPrice += parseFloat(value.price) * value.num;
    });

    totalPrice = (parseFloat(totalPrice) + parseFloat(data.config.freight)).toFixed(2);

    if (totalPrice > parseFloat(data.config.full)) {
        totalPrice = (totalPrice - parseFloat(data.config.discount)).toFixed(2);
    }
    $('#shopcart-tip').show();
    $('#shopcart-sure').show();
    $('#shopcart-tip').html(totalNum);
    $('#shopcart-totalPrice').html(totalPrice);
    if (totalNum == 0) {
        $('#shopcart-tip').hide();
        $('#shopcart-sure').hide();
        $('#shopcart-totalPrice').html(0);
    }

    var cookie = {
        cartData: cartData,
        totalPrice: totalPrice,
        totalNum: totalNum,
    };
    $.cookie("load", JSON.stringify(cookie), {path: "/"});
}

function clickItemDetail(id) {
    tabTmpl("itemsDetail-container");
    backContainer = "product-container";
    if (totalNum != 0) {
        $('#shopcart-tip').show();
        $('#shopcart-tip').html(totalNum);
    }
    // pushHistory();

    //attr = {};
    $.ajax({
        type: "get",
        url: data.baseUrl + "/App/Shop/getProduct",
        data: {
            id: id
        },
        success: function (res) {
           
            var json = eval(res);
            $('#itemsDetail .single-name').html(json.name);
            $('#itemsDetail .new-price').children().html(json.price);
            $('#itemsDetail .detail-label').html(json.label);
            $('#itemsDetail .detail-title').next().html(json.detail);
            $('#itemsDetail .detail-score').children().html(json.score);
            $('#itemsDetail .addItem.btn-shopping').attr("onclick", 'doCart(this ,' + json.id + ',\'' + json.name + '\',' + json.price + ',\'\')');

            $('#product-attr').hide();

            if (json.status == 1) {
                $('#itemsDetail #addCartBtn').show();
                $('#itemsDetail .addItem.btn-shopping').attr("onclick", 'doCart(this ,' + json.id + ',\'' + json.name + '\',' + json.price + ','+json.sku.length+')');
            } else {
                $('#itemsDetail #soldOut').show();
            }

            if (json.sku.length) {
                var html = '';
                $.each(json.sku, function (index, value) {
                    html += '<p class="attr-btn" onclick="addAttr(this , ' + json.id + ' ,' + value.id + ' , \'' + value.name + '\', \'' + value.price+ '\')">' + value.name+'</p>';
                });
                $('#itemsDetail #detail-attr-btn').html(html);
                $('#product-attr').show();
            }

            if (json.albums == "") {
                var topimage = [];
                topimage.push(JSON.parse('{"savename":"' + json.savename + '","savepath":"' + json.savepath + '"}'));
                json.albums = topimage;
            }

            var html = '';
            $.each(json.albums, function (index, value) {
                html += '<div class="swiper-slide" style="text-align: -webkit-center;"><img style="height: 200px" src="' + data.uploadsUrl + value.savepath + value.savename + '"></div>';
            });
            $('#itemsDetail .swiper-wrapper').html(html);

            if (res.comment != null) {
                json = eval(res.comment);
                var html = '';
                $.each(json, function (index, value) {
                    html += '<li><span class="commit_left">' + value.user_name + '</span><span class="commit_right">' + value.name + '</span></li>';
                });
                $('#commentList').html(html);
            } else {
                $('#commentList').html('');
            }
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();

            var mySwiper = new Swiper('.swiper-container', {
                direction: 'horizontal',
                loop: true,

                // 如果需要分页器
                pagination: '.swiper-pagination',

                // 如果需要滚动条
                scrollbar: '.swiper-scrollbar'
            });

            $('.attr-btn').first().click();
        }

    });
}

var sku = {};
function addAttr(obj, product_id, sku_id, sku_name, price) {
    $('.attr-btn').css("background-color", "#ffffff");
    $('.attr-btn').css("color", "#000000");
    $(obj).css("background-color", "#FF4146");
    $(obj).css("color", "#ffffff");
    $('.new-price').children().html(price);

    sku.product_id = product_id;
    sku.sku_name = sku_name;
    sku.sku_id = sku_id;
    sku.price = price;
}

function addproductNum(obj, id, sku_id) {
    var productNum = 0;
    $.each(cartData, function (index, value) {
        if (sku_id == 0) {
            if (value.id == id) {
                productNum = value.num;
                value.num++;
                if (productNum == 1) {
                    $(obj).prev().prev().removeClass('disabled');
                }
            }
        } else {
            if (value.id == id && value.sku_id == sku_id) {
                productNum = value.num;
                value.num++;
                if (productNum == 1) {
                    $(obj).prev().prev().removeClass('disabled');
                }
            }
        }

    });
    productNum++;
    $(obj).prev().val(productNum);
    $(obj).parent().prev().find('.item-amount').html(productNum);
    initCartDate();
    $('#items-total-price').html(totalPrice);
}
function reducehotproductNum(obj, id, sku_id){
 var productNum = 0;
    $.each(cartData, function (index, value) {
        if (sku_id == 0) {
            if (value.id == id) {
                productNum = value.num;
                value.num--;
                if (value.num == 0) {
                    cartData.splice(index, 1);
                    initProduct();
                    $('#items-total-price').html(totalPrice);
                    $('#product-hot').find('li[label-id="' + value.id + '"]').find('.numbers-minus').hide();
                    $('#product-hot').find('li[label-id="' + value.id + '"]').find('.numbers').hide();
                    $('#item').find('li[label-id="' + value.id + '"]').find('.numbers-minus').hide();
                    $('#item').find('li[label-id="' + value.id + '"]').find('.numbers').hide();
                    return;
                }
                if (productNum == 1) {
                    $(obj).addClass('disabled');
                }
            }
        } else {
            if (value.id == id && value.sku_id == sku_id) {
                productNum = value.num;
                value.num--;
                if (value.num == 0) {
                    cartData.splice(index, 1);
                    initProduct();
                    $('#items-total-price').html(totalPrice);
                    $('#product-hot').find('li[label-id="' + value.id + '"]').find('.numbers-minus').hide();
                    $('#product-hot').find('li[label-id="' + value.id + '"]').find('.numbers').hide();
                    $('#item').find('li[label-id="' + value.id + '"]').find('.numbers-minus').hide();
                    $('#item').find('li[label-id="' + value.id + '"]').find('.numbers').hide();
                    return;
                }
                if (productNum == 1) {
                    $(obj).addClass('disabled');
                }
            }
        }
    });
    productNum--;
    $(obj).next().val(productNum);
    $(obj).parent().prev().find('.item-amount').html(productNum);
    initCartDate();
    $('#items-total-price').html(totalPrice);

}



function reduceproductNum(obj, id, sku_id) {
    var productNum = 0;
    $.each(cartData, function (index, value) {
        if (sku_id == 0) {
            if (value.id == id) {
                productNum = value.num;
                value.num--;
                if (value.num == 0) {
                    cartData.splice(index, 1);
                    $(obj).parent().parent().parent().remove();
                    initProduct();
                    $('#items-total-price').html(totalPrice);

                    if (cartData.length == 0) {
                        $('#nav-product').click();
                    }
                    return;
                }
                if (productNum == 1) {
                    $(obj).addClass('disabled');
                }
            }
        } else {
            if (value.id == id && value.sku_id == sku_id) {
                productNum = value.num;
                value.num--;
                if (value.num == 0) {
                    cartData.splice(index, 1);
                    $(obj).parent().parent().parent().remove();
                    initProduct();
                    $('#items-total-price').html(totalPrice);

                    if (cartData.length == 0) {
                        $('#nav-product').click();
                    }
                    return;
                }
                if (productNum == 1) {
                    $(obj).addClass('disabled');
                }
            }
        }
    });
    productNum--;
    $(obj).next().val(productNum);
    $(obj).parent().prev().find('.item-amount').html(productNum);
    initCartDate();
    $('#items-total-price').html(totalPrice);
}

function deleteProduct(obj, id, sku_id) {
    $.each(cartData, function (index, value) {
        if (sku_id == 0) {
            if (value.id == id) {
                cartData.splice(index, 1);
                $(obj).parent().parent().parent().remove();
                initProduct();
                $('#items-total-price').html(totalPrice);

                if (cartData.length == 0) {
                    $('#nav-product').click();
                }
                return;
            }
        } else {
            if (value.id == id && value.sku_id == sku_id) {
                cartData.splice(index, 1);
                $(obj).parent().parent().parent().remove();
                initProduct();
                $('#items-total-price').html(totalPrice);

                if (cartData.length == 0) {
                    $('#nav-product').click();
                }
                return;
            }
        }
    });
}

function cartNext() {
    //非微信浏览器下，isbindPhone等同登录状态值，1为登录
    if(isbindPhone != 1){
        openLogin();
        return;
    }     
    if (cartData.length == 0) {
        // alert("购物车为空,请先选择商品!");
        return;
    }

    tabTmpl("delivery-container");
    backContainer = "cart-container";
    $('.header-left').show();
    // pushHistory();

    $('#balance-payment').click(function () {
        $('.payment-content').find('.radio').removeClass('selected');
        $(this).find('.radio').addClass('selected');
        payment = 0;
    });
    $('#wechat-payment').click(function () {
        $('.payment-content').find('.radio').removeClass('selected');
        $(this).find('.radio').addClass('selected');
        payment = 1;
    });
    $('#alipay-payment').click(function () {
        $('.payment-content').find('.radio').removeClass('selected');
        $(this).find('.radio').addClass('selected');
        payment = 2;
    });
    $('#cool-payment').click(function () {
        $('.payment-content').find('.radio').removeClass('selected');
        $(this).find('.radio').addClass('selected');
        payment = 3;
    });

    $.ajax({
        type: "get",
        url: data.baseUrl + "/App/User/getContactList",
        data: {
            getProvince: true
        },
        success: function (res) {
            // console.log(res);
            if (res) {
                if (res.code == 0) {
                    openLogin();
                    return;
                }

                if (res.province != []) {
                    var html = '';
                    var city = eval(res.province);

                    if (city != null) {
                        $.each(city, function (index, value) {
                            html += '<option value="' + value.name + '" label="' + index + '">' + value.name + '</option>';
                        });
                        $('#hat_city').html(html);
                    }

                    var html = '';
                    if (city[0]["city"] != null) {
                        $.each(city[0]["city"], function (index, value) {
                            html += '<option value="' + value.name + '">' + value.name + '</option>';
                        });
                        $('#hat_area').html(html);
                    }
                    area = res.province;
                }

                var html = '';
                var deliveryTime = eval(data.config.delivery_time);
                $.each(deliveryTime, function (index, value) {
                    html += '<option value="' + value + '">' + value + '</option>';
                });
                $('#deliveryTime').html(html);

                if (res[0] != null) {
                    $('#username').val(res[0].name);
                    $('#tel').val(res[0].phone);
                    $('#id').val(res[0].id);
                    $('#hat_city').val(res[0].city);
                    $('#address').val(res[0].address);

                    var label = $('#hat_city').find("option:selected").attr("label");
                    if (label) {
                        var html = '';
                        $.each(city[label]['city'], function (index, value) {
                            html += '<option value="' + value.name + '">' + value.name + '</option>';
                            $('#hat_area').html(html);
                        });
                    }

                    $('#hat_area').val(res[0].city);
                }

            }
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }

    });
}
var submitFlag = true;
function submitOrder() {
    if (submitFlag == false) {
        alert("请不要重复操作!");
        return;
    }
    var name = $('#username').val();
    var id = $('#id').val();
    var phone = $('#tel').val();
    var province = $('#hat_city').val();
    var city = $('#hat_area').val();
    var address = $('#address').val();
    var note = $('#note').val();
    var deliveryTime = $('#deliveryTime').val();
    var shopId = get("shopId");
    var freights = data.config.freight;
    var contact = {
        "id": id,
        "name": name,
        "phone": phone,
        "province": province,
        "city": city,
        "address": address,
    }

    if (totalPrice >= data.config.full) {
        var discount = data.config.discount;
    } else {
        var discount = 0;
    }

    var order = {
        shop_id:shopId,
        remark: note,
        delivery_time: deliveryTime,
        totalprice: totalPrice,
        freight:freights,
        payment: payment,
        discount:discount,       
    }

    if (payment == -1) {
        alert("请选择支付方式!");
        return;
    }
    if (name.length == 0 || phone.length == 0 || address.length == 0) {
        alert("请核对输入的信息!");
        return;
    }
    submitFlag = false;
    $.ajax({
        type: "post",
        url: data.baseUrl + "/App/Order/addOrder",
        data: {
            contact: contact,
            cartData: cartData,
            order: order
        },
        success: function (res) {
            if (res) {
                tabTmpl('orderResult-container');
                // console.log(res.freight);
                // console.log(res.discount);
                console.log(eval(res));
                $('#result-order-no').html(res.orderid);
                $('#items-order-result').find('.date').html(res.time);
                $('#items-order-result').find('.total').children().html(res.totalprice);

                $('.freight').html(res.freight);
                $('.discount').html(res.discount);
                
                

                if (res.pay_status == 1) {
                    $('#status').html("支付成功");
                } else {
                    $('#status').html("未支付");
                }

                var json = eval(res.detail);
                var html = '';
                $.each(json, function (index, value) {
                    var sku = '';
                    if (parseInt(value.sku_id)) {
                        sku = '（' + value.sku_name + '）';
                    }
                    html += '<li><span class="order-item-name">' + value.name + sku + '</span><span class="order-item-price">￥' + value.price + '</span><span class="order-item-amount">' + value.num + '份</span></li>';
                });
                $('#item-order-list ul').html(html);

                cartData = [];
                totalNum = 0;
                totalPrice = 0;
                payment = -1;
                initProduct();

                if (typeof res.payUrl != "undefined") {
                    if (res.payUrlMent != 1) {
                        layer.open({
                            content: '请稍后,正在打开在线支付...',
                            //shade: false,
                            style: 'border-radius: 3px;text-align: center;border:0;',
                        });
                        window.location.href = res.payUrl;
                    } else {
                        var html = template("qrcodePay-container", {qrcode: res.payUrl});
                        $("#orderResult").append(html);
                    }
                }
            } else {
                alert('提交失败!余额不足或者商品已下架,请重新选购!');
            }
        },
        beforeSend: function () {
            $('#page_tag_load').show();
            backToTop();
        },
        complete: function () {
            $('#page_tag_load').hide();
            submitFlag = true;
        }

    });

}
function empty(id) {
    $('#' + id).val("");
}

function changeCity(obj) {
    var label = $(obj).find("option:selected").attr("label");
    $('#hat_area').html("");

    var html = '';
    $.each(area[label]['city'], function (index, value) {
        html += '<option value="' + value.name + '">' + value.name + '</option>';
        $('#hat_area').html(html);
    });
}

function cancelOrder(id) {

    $('#orderCancel-popup').show();
    $('#yesOrder').one('click', function () {
        $.ajax({
            type: "get",
            url: data.baseUrl + "/App/Order/updateOrder",
            data: {
                id: id,
                status:-1
            },
            success: function (data) {
                $('#nav-user').click();
                $('#orderCancel-popup').hide();
            },
            beforeSend: function () {
                $('#page_tag_load').show();
            },
            complete: function () {
                $('#page_tag_load').hide();
            }

        });
    });
    $('#noOrder').one('click', function () {
        $('#orderCancel-popup').hide();
    });
}

function commentOrder(id) {
    $('#orderComment-popup').show();
    $('#yesCommit').one('click', function () {
        if ($('#comment-text').val().length == 0) {
            alert("请核对输入的信息!");
            return;
        }
        $.ajax({
            type: "post",
            url: data.baseUrl + "/App/Order/commentOrder",
            data: {
                name: $('#comment-text').val(),
                id: id
            },
            success: function (res) {
                $('#orderComment-popup').hide();
                alert(res.msg);
            },
            beforeSend: function () {
                $('#page_tag_load').show();
            },
            complete: function () {
                $('#page_tag_load').hide();
            }

        });
        $('#orderComment-popup').hide();
        $('#comment-text').val("");
    });
    $('#noCommit').one('click', function () {
        $('#orderComment-popup').hide();
        $('#comment-text').val("");
    });

}

function openLogin() {
    tabTmpl("login-container");
    $(".header-title").html("登录");
    $(".header-left").show();
    $(".navigation-wrap").hide();

    backContainer = "user-container";
}

function openRegister() {
    tabTmpl("register-container");
    $(".header-title").html("注册");
    $(".header-left").show();
    $(".navigation-wrap").hide();
    if(is_weixin()){
        if(isbindPhone == 0 && oauthlogin != -1){
            $(".bind-phone").html("绑定手机");
            $(".header-title").html("绑定手机");
        }    
    }
    backContainer = "user-container";
}
function openForgetPassword() {
    tabTmpl("forgetPassword-container");
    $(".header-title").html("忘记密码");
    $(".header-left").show();

    backContainer = "login-container";
}

function login() {
    // var phone = $('#loginPhone').val();
    // var password = $('#loginPassword').val();   

    // if (phone.length == 0 || password.length == 0) {
    //     alert("请核对输入的信息!");
    //     return;
    // }
    var username = $("input[name=username]");
    var password = $("input[name=password]");
    if (username.val() == '') {
        d_messages('请输入用户名', 2);
        $("div[name=usernamediv]").addClass("active");
        return false;
    }
    if (password.val() == '') {
        d_messages('请输入密码', 2);
        $("div[name=passworddiv]").addClass("active");
        return false;
    }
    $.ajax({
        type: "post",
        url: data.baseUrl + "/App/Public/login",
        data: {
            phone: username.val(),
            password: password.val()
        },
        success: function (res) {
            if (res) {
                data.username = res.username;
                data.avater = res.image;
                location.reload();
            } else {
                alert("登录失败!");
            }
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }

    });
}
function loginout(){
    $.ajax({
        type: "get",
        url: data.baseUrl + "/App/Public/logout",
        data: {

        },
        success: function (data) {
            if (data) {
                alert(data.msg);
                location.reload();
            } else {
                alert("退出失败!");
            }
            // $('#orderComment-popup').hide();
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }

    });    
}
var registerAgain = 0;  
function register() {
    var mobile = $("input[name=mobile]");
    var mobile_code = $("input[name=mobile_code]");
    var smspassword = $("input[name=smspassword]");
    var repassword = $("input[name=repassword]");
    var sms_code = $("input[name=sms_code]");
    var return_code = $("input[name=return_code]").val();
    var myreg = /^13[0-9]{9}|15[012356789][0-9]{8}|18[0-9]{9}|14[579][0-9]{8}|17[0-9]{9}$/;
    if (mobile.val() == '') {
        d_messages('请输入手机号', 2);
        $("div[name=mobilediv]").addClass("active");
        return false;
    } else if (!myreg.test(mobile.val())) {
        d_messages('请输入有效的手机号', 2);
        $("div[name=mobilediv]").addClass("active");
        return false;
    }
    if (mobile_code.val() == '') {
        d_messages('请输入手机验证码', 2);
        $("div[name=mobile_codediv]").addClass("active");
        return false;
    }
    if (smspassword.val() == '') {
        d_messages('请输入密码', 2);
        $("div[name=smspassworddiv]").addClass("active");
        return false;
    } else if (smspassword.val().length < 6) {
        d_messages('密码至少为6位', 2);
        $("div[name=smspassworddiv]").addClass("active");
        return false;
    }
    if (smspassword.val() != repassword.val()) {
        d_messages('两次密码输入不一致', 2);
        $("div[name=smspassworddiv]").addClass("active");
        $("div[name=repassworddiv]").addClass("active");
        return false;
    }
    if(registerAgain == 1){
        d_messages('请勿再次提交', 1);
        return false;
    }
    registerAgain = 1;    
    // if (codecheck) {
    //     d_messages('验证码错误');
    //     return false;
    // }

    $.ajax({
        type: "post",
        url: data.baseUrl + "/App/Public/register",
        data: {
            phone: mobile.val(),
            password: smspassword.val(),
            code: mobile_code.val()
        },
        success: function (data) {
            if (data.status == 1) {
                registerAgain = 0;
                d_messages('注册成功，跳转中', 2);
                location.reload();
            } else {
                registerAgain = 0;
                alert(data.msg);
            }
        },
        beforeSend: function () {
            
        },
        complete: function () {
            
        }

    });
}

var time = 60;
var c = 1;

function datasms() {
    if (time == 0) {
        c = 1;
        $("#sendsms").html("发送验证码");
        time = 60;
        return;
    }

    if (time != 0) {
        if ($(".ipt-check-btn").attr("class").indexOf("disabled") < 0) {
            $(".ipt-check-btn").addClass('disabled');
        }
        c = 0;
        $("#sendsms").html("<span>重新获取(" + time + ")</span>");
        time--;
    }
    setTimeout(datasms, 1000);
}

function sendsms(){

    if (c == 0) {
        d_messages('发送频繁');
        return;
    }
    var mobile = $("input[name=mobile]").val();
    var myreg = /^13[0-9]{9}|15[012356789][0-9]{8}|18[0-9]{9}|14[579][0-9]{8}|17[0-9]{9}$/;
    if (mobile == '') {
        d_messages('请输入手机号');
        $("div[name=mobilediv]").addClass("active");
        return false;
    } else if (!myreg.test(mobile)) {
        d_messages('请输入有效的手机号', 2);
        $("div[name=mobilediv]").addClass("active");
        return false;
    }
    datasms();
    $.ajax({
        type: "post",
        url: data.baseUrl + "/App/Public/sendSms",
        data: {
            phone: mobile,
        },
        success: function (data) {
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }

    }); 

}

function openForgetPassword() {
    tabTmpl("forgetPassword-container");
    $(".header-title").html("忘记密码");
    $(".header-left").show();

    backContainer = "login-container";
}
function nextForget(){
    var mobile = $("input[name=write_mobile]");
    var myreg = /^13[0-9]{9}|15[012356789][0-9]{8}|18[0-9]{9}|14[579][0-9]{8}|17[0-9]{9}$/;
    if (!myreg.test(mobile.val())) {
        $("div[name=write_mobilediv]").addClass("active");
        d_messages('请输入有效的手机号码！', 2);
        return false;
    }
    $("#show_mobile").text(mobile.val());
    $("input[name=mobile]").val(mobile.val());
    $("#show").css({
        display: "none"
    });
    $("#check").css({
        display: "block"
    });
}
function resetPassword() {
    var error = 0;
    var htmlcode = $("input[name=sms_code]");
    var mobile = $("input[name=mobile]").val();
    var password = $("input[name=newpassword]").val();
    var passwords = $("input[name=newpasswords]").val();

    if(password.length == 0 || passwords.length == 0){
        d_messages("请填写新密码!");
        return;
    }
    if(!password == passwords){
        d_messages("两次密码输入不一致!");
        return;
    }    
    if (htmlcode.val() == '') {
        $("div[name=sms_codediv]").addClass("active");
        d_messages('请输入验证码！');
        return false;
    }
    if (mobile == '') {
        d_messages('请刷新页面');
        return false;
    }
    //
    if (c == 0) {
        d_messages('发送频繁', 2);
        return;
    }
    var mobile = $("input[name=mobile]").val();
    var myreg = /^13[0-9]{9}|15[012356789][0-9]{8}|18[0-9]{9}|14[579][0-9]{8}|17[0-9]{9}$/;
    if (mobile == '') {
        d_messages('请输入手机号', 2);
        $("div[name=mobilediv]").addClass("active");
        return false;
    } else if (!myreg.test(mobile)) {
        d_messages('请输入有效的手机号', 2);
        $("div[name=mobilediv]").addClass("active");
        return false;

    }
    datasms();
    $.ajax({
        type: "post",
        url: data.baseUrl + "/App/Public/resetPassword",
        data: {
            code: htmlcode.val(),
            phone: mobile,
            password: password
        },
        success: function (data) {
            if (data.status == 1) {
                d_messages(data.msg);
                tabTmpl("login-container");
                $(".header-title").html("登录");
            } else {
                d_messages(data.msg);
            }
            // $('#orderComment-popup').hide();
        },
        beforeSend: function () {
            // $('#page_tag_load').show();
        },
        complete: function () {
            // $('#page_tag_load').hide();
        }

    });
}
function payOrder(method, orderid) {
    if (method == 1) {
        window.location.href = data.baseUrl + "/App/Pay/wxPay/id/" + orderid;
    } else {
        window.location.href = data.baseUrl + "/App/Pay/alipay/id/" + orderid;
    }
}

function navSelect(o) {
    $('.navigation-item').removeClass("selected");
    $('.navigation-item').children().removeClass("selected");
    $(o).addClass("selected");
    $(o).children().addClass("selected");
}

function openAds(o) {
    navSelect(o);
    $('#shopcart-tip').show();
    $('#shopcart-tip').html(totalNum);

    tabTmpl("ads-container");
    initProduct();
    // $(".header-title").show();
    $(".header-title").html(data.config.name);
}

function tabTmpl(id) {
    var html = template(id, data);
    $("#main").html(html);

    $('.header-left').hide();

    echo.init({
        offset: 100,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
        }
    });
    backToTop();

    menuId = 0;
}

function openProduct(o) {
    navSelect(o);
    $('#shopcart-tip').hide();

    var html = template("product-container", data);
    $("#main").html(html);

    echo.init({
        offset: 100,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
        }
    });

    initProduct();

    $('.shop-menu li').first().click();

    var swiper = new Swiper('#swiper-container', {
        slidesPerView: 3,
        spaceBetween: 0
    });

    $('#items .shop-product li[style!="display:none"]').find(':last').css("padding-bottom","150px");
}

function openCartsure(){
    $("#nav-cart").click();
}


function openCart(o) {
    navSelect(o);
    // console.log(cartData);
    tabTmpl("cart-container");

    $('#shopcart-tip').show();
    $('#shopcart-tip').html(totalNum);
    if (totalNum == 0) {
        $('#shopcart-tip').hide();
    }

    // console.log(cartData);

    var html = '';
    $.each(cartData, function (index, value) {
        var sku = '';
        var sku_id = 0;
        if (value.sku_id) {
            sku = '（' + value.sku_name + '）';
            sku_id = value.sku_id;
        }
        html += '<li><div class="confirmation-item"><div class="item-info"><span class="item-name">' + value.name + sku + '<br></span><span class="item-price-info"><span><span class="item-single-price">' + value.price + '</span>×<span class="item-amount">' + value.num + '</span></span></span></div><div class="select-box"><span class="minus disabled" onclick="reduceproductNum(this,' + value.id + ',' + sku_id + ')">—</span><input class="amount" type="text" name="amount" value="' + value.num + '" autocomplete="off" readonly=""><span class="add" onclick="addproductNum(this,' + value.id + ',' + sku_id + ')">+</span></div><div class="delete"><a class="delete-btn" onclick="deleteProduct(this,' + value.id + ',' + sku_id + ')"><i class="ico ico-delete"></i></a></div></div><div class="divider"></div></li>';
    });
    $('#item-list ul').html(html);
    $('#items-total-price').html(totalPrice);
}

function openUser(o) {
    navSelect(o);

    //非微信浏览器下，isbindPhone等同登录状态值，1为登录
    if(isbindPhone != 1){
        openLogin();
        return;
    }

    if (totalNum != 0) {
        $('#shopcart-tip').show();
        $('#shopcart-tip').html(totalNum);
    }

    if (data.user.length == 2) {
        openLogin();
        return;
    }

    tabTmpl("user-container");
    //微信浏览器下，不显示退出按钮 
    if(is_weixin()){
        $(".pi-loginout").hide();
    }

    $.ajax({
        type: "get",
        url: data.baseUrl + "/App/User/getUser",
        data: {
            getOrder: true
        },
        success: function (res) {
            $('#balance').html("");
            if (res) {
                if (res.identity == 1) {
                    $('#identity').html('管理员');
                }
                $('#balance').html(res.money + '元');
                $('#score').html(res.score + '分');
                $('#items-order-result-list ul').html("");
                $('.myOrderList').hide();

                if (res.order != undefined) {
                    var json = eval(res.order);
                    if (json.length != 0) {
                        $('.myOrderList').show();
                        var html = '';
                        $.each(json, function (index, value) {
                            var htmlfirst = '';
                            var htmlcenter = '';
                            var htmlend = '';

                            var pay_status = '未付款';
                            if (value.pay_status == 1) {
                                pay_status = '已付款';
                            }
                            var order_status = '未处理';
                            if (value.status == 1) {
                                order_status = '正在配送';
                            } else if (value.status == 2) {
                                order_status = '已完成';
                            }
                            // alert(value.shop.name);
                            htmlfirst += '<li><span style="color:#16aad8;">'+ value.shop.name +'</span><div class="order-info"><span class="number">订单号：<span id="order-no">' + value.orderid + '</span></span><span class="date" style="float: right">' + value.time + '</span><span class="order-status">' + pay_status + ',' + order_status + '</span></div><div class="order-list" id="item-order-list"><ul>';
                            var jsoncenter = eval(value.detail);
                            $.each(jsoncenter, function (index,value) {
                                var sku = '';
                                if (parseInt(value.sku_id)) {
                                    sku = '（' + value.sku_name + '）';
                                }
                                htmlcenter += '<li><span class="order-item-name">' + value.name + sku + '</span><span class="order-item-price">￥' + value.price + '</span><span class="order-item-amount">' + value.num + '份</span></li>';
                            });

                            var pay_status = '';
                            var cancel_status = '';
                            var comment_status = '';
                            if (value.pay_status == 0) {
                                pay_status = '<span class="payOrder" onclick="payOrder(1,\'' + value.id + '\')">微信付款</span><span class="payOrder" onclick="payOrder(2,\'' + value.id + '\')">支付宝</span>';
                                cancel_status = '<span class="cancelOrder" onclick="cancelOrder(' + value.id + ')">取消</span>';
                            } else if (value.pay_status == 1) {
                                comment_status = '<span class="commitOrder" onclick="commentOrder(' + value.id + ')">评论</span>';
                            }
                            htmlend += '</ul><div class="mytotal-info"><span class="deliver">运费：' + value.freight + '元</span><span class="deliver">优惠：' + value.discount + '元</span><span class="total">共' + value.totalprice + '元</span></div></div><div class="order-footer">' + cancel_status + comment_status + pay_status + '<a class="dail-small" href="tel:' + data.config.tel + '"><span class="dail-ico"><i class="ico ico-phone"></i></span><span class="dail-text">拨打电话催一催</span></a></div><div class="divider"></div></li>';
                            html += htmlfirst + htmlcenter + htmlend;

                        });
                        $('#items-order-result-list ul').html(html);
                    }
                }

            }
        },
        beforeSend: function () {
            $('#page_tag_load').show();
        },
        complete: function () {
            $('#page_tag_load').hide();
        }
    });
}

function backToSale() {
    window.location.reload();
}

jQuery.fn.shake = function (times, offset, delay) {//次数,偏移,间隔
    this.stop().each(function () {
        var Obj = $(this);
        var marginLeft = parseInt(Obj.css('margin-left'));
        var delay = delay > 20 ? delay : 20;
        Obj.animate({'margin-left': marginLeft + offset}, delay, function () {
            Obj.animate({'margin-left': marginLeft}, delay, function () {
                times = times - 1;
                if (times > 0)
                    Obj.shake(times, offset, delay);
            })
        });

    });
    return this;
}

var backContainer = '';
function headerBack() {
    if (backContainer != '') {
        switch (backContainer) {
            case "product-container":
                $("#nav-product").click();
                backContainer = '';
                break;
            case "cart-container":
                $("#nav-cart").click();
                backContainer = '';
                break;
            case "user-container":
                $("#nav-user").click();
                backContainer = '';
                break;
            case "login-container":
                openLogin();
                break;
        }
    }
}

// function pushHistory() {
//     var state = {
//         title: "title",
//         url: "#"
//     };
//     window.history.pushState(state, "title", "");
// }

//忽略webkit load popstate事件
// pushHistory();
// window.addEventListener('load', function () {
//     setTimeout(function () {
//         window.addEventListener('popstate', function (e) {
//             var state = e.state;
//             if (state) {
//                 headerBack();
//             } else {
//                 close_wechat();
//             }
//         });
//     }, 0);
// });

// function close_wechat() {
//     if (window.confirm('你确定要离开吗?')) {
//         WeixinJSBridge.call("closeWindow");
//     } else {
//         pushHistory();
//     }
// }

//new js
//左侧菜单切换
var menuId = 0;
function switchMenu(obj, id) {
    $(obj).removeClass("lia").addClass("lib").siblings().removeClass("lib").addClass("lia");
    $('.menu-name span').html($(obj).html());
    menuId = id;
    $.each($('.mui-table-viewa').children(), function (index, value) {
        if ($(this).attr("label-cate") == id) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    backToTop();

    echo.init({
        offset: 100,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
        }
    });
}

function prevView(obj){
    var src = $(obj).attr('src');
    layer.open({
        content: '<img style="width: 200px" src="'+src+'"/>'
    });
}



function openSearch(){
    var searchtxt = $("input[name = 'searchtxt']").val();
    var searchval = $('.shop-product li').filter(':contains("'+searchtxt+'")').html();
    if (searchval == undefined) {
        // alert("没有此商品");
        layer.open({
            content: '没有搜到此商品'
        });
    }else{
        $(".shop-menu .lib").removeClass("lib").addClass("lia");
        $('.shop-product li').hide().filter(':contains("'+searchtxt+'")').show();
    }
}






