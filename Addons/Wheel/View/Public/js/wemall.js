/**
 * Created by heqing on 15/1/13.
 */
$(document).ready(function () {
    $('#nav-sale').click();

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
        alert("支付宝支付已被微信屏蔽!");
        return;
        $('.payment-content').find('.radio').removeClass('selected');
        $(this).find('.radio').addClass('selected');
        payment = 2;
    });
    $('#cool-payment').click(function () {
        $('.payment-content').find('.radio').removeClass('selected');
        $(this).find('.radio').addClass('selected');
        payment = 3;
    });

    var action = location.href.substr(location.href.indexOf("action"));
    if (action) {
        if (action == "action/order.html") {
            $('#nav-user').click();
        }
    };
});
function backToTop(){
    $("html,body").animate({scrollTop: 0}, 200);
}
function displayNoneToTop() {
    $('#sale-container').hide();
    $('#product-container').hide();
    $('#cart-container').hide();
    $('#itemsDetail-container').hide();
    $('#delivery-container').hide();
    $('#orderResult-container').hide();
    $('#user-container').hide();
    backToTop();
}

function displayOrderResult(){

}

function changeMenu(obj, id , toggle) {
    $('.menuItem').removeClass("active");
    $(obj).addClass("active");

    if (toggle == 'toggle') {
        $('#types-dropdown').toggle();
        var ex  = $(obj).html();
        var exClick = $(obj).attr("onclick");
        var more = $('#more-types').html();
        var moreClick = $('#more-types').attr("onclick");

        $('#more-types').html(ex);
        $('#more-types').attr("onclick" , exClick);
        $(obj).html(more);
        $(obj).attr("onclick" , moreClick);

        $('#more-types').addClass("active");
    }

    $.each($('#items').children(), function (index, value) {
        if ($(this).attr("label-cate") == id) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
    backToTop();
}

function doCart(obj, id, name, price , attrIs) {
    if ($('#product-container').is(":hidden")) {

        if(attrIs == ""){
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
        }else{
            if(attr.product_id != id){
                alert("error");
                return;
            }

            var flag = 0;
            $.each(cartData, function (index, value) {
                if (value.id == id && value.attr_id == attr.attr_id) {
                    flag = 1;
                    value.num++;
                    return;
                }
            });
            if (flag == 0) {
                var current = '{"id":"' + id + '","name":"' + name + '","num":"' + 1 + '","price":"' + attr.price + '","attr":"' + attr.value + '","attr_id":"' + attr.attr_id + '"}';
                cartData.push(JSON.parse(current));
            }
        }

        initProduct();
        return;
    }else{
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
        initProduct();
        return;
    }
}
function initProduct() {
    $.each($('#items').children(), function (index, value) {
        $(this).find('.select-shadow').hide();
    });
    $.each(cartData, function (index, value) {
        $('#items').find('div[label-id="' + value.id + '"]').find('.select-shadow').show();
    });
    initCartDate();
}

function initCartDate() {
    totalNum = 0;
    totalPrice = 0;
    var freight = parseFloat($('#items-total-amount').html());
    $.each(cartData, function (index, value) {
        totalNum += parseInt(value.num);
        totalPrice += parseFloat(value.price) * value.num;
    });
    totalPrice = parseFloat(totalPrice + freight).toFixed(2);

    $('#shopcart-tip').show();
    $('#shopcart-tip').html(totalNum);
    if(totalNum == 0){
        $('#shopcart-tip').hide();
    }
}

function clickItemDetail(id) {
    displayNoneToTop();
    $('#itemsDetail-container').show();

    //attr = {};
    $.ajax({
        type: "post",
        url: baseUrl + "/App/Index/getProductDetail",
        data: {
            id: id
        },
        success: function (data) {
            var json = eval(data.product);
            //$('#itemsDetail-container .detail-image').attr('src', publicUrl + json.image);
            $('#itemsDetail-container .single-name').html(json.name);
            $('#itemsDetail-container .new-price').children().html(json.price);
            $('#itemsDetail-container .detail-title').next().html(json.detail);
            $('#itemsDetail-container .addItem.btn-shopping').attr("onclick", 'doCart(this ,' + json.id + ',\'' + json.name + '\',' + json.price +',\'\')');

            $('#product-attr').hide();
            if(json.attribute.length != 0){
                var html = '';
                $.each(json.attribute , function (index , value) {
                    html += '<span class="attr-btn" onclick="addAttr(this , '+json.id+' ,'+value.id+' , \''+value.value+'\', \''+value.price+'\')">'+value.value+'</span>';
                });
                $('#itemsDetail-container #detail-attr-btn').html(html);
                $('#product-attr').show();

                $('#itemsDetail-container .addItem.btn-shopping').attr("onclick", 'doCart(this ,' + json.id + ',\'' + json.name + '\',' + json.price + ')');
            }

            if(json.topImage.length == 0){
                var topimage = [];
                topimage.push(JSON.parse('{"image":"'+json.image+'"}'));
                json.topImage = topimage;
            }
            var html = '';
            $.each(json.topImage , function (index , value) {
                html += '<div class="swiper-slide" style="text-align: -webkit-center;"><img style="height: 200px" src="'+publicUrl+value.image+'"></div>';
            });
            $('#itemsDetail-container .swiper-wrapper').html(html);

            if (data.comment != null) {
                json = eval(data.comment);
                var html = '';
                $.each(json, function (index, value) {
                    html += '<li><span class="commit_left">' + value.username + '</span><span class="commit_right">' + value.name + '</span></li>';
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

            var mySwiper = new Swiper ('.swiper-container', {
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

var attr = {};
function addAttr(obj , product_id , attr_id ,value , price){
    $('.attr-btn').css("background-color" , "#ffffff");
    $('.attr-btn').css("color" , "#000000");
    $(obj).css("background-color" , "#ff6703");
    $(obj).css("color" , "#ffffff");
    $('.new-price').children().html(price);

    attr.product_id = product_id;
    attr.value = value;
    attr.attr_id = attr_id;
    attr.price = price;
}

function addproductNum(obj, id , attr_id) {
    var productNum = 0;
    $.each(cartData, function (index, value) {
        if(attr_id == 0){
            if (value.id == id) {
                productNum = value.num;
                value.num++;
                if (productNum == 1) {
                    $(obj).prev().prev().removeClass('disabled');
                }
            }
        }else{
            if (value.id == id && value.attr_id == attr_id) {
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
function reduceproductNum(obj, id , attr_id) {
    var productNum = 0;
    $.each(cartData, function (index, value) {
        if(attr_id == 0){
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
        }else{
            if (value.id == id && value.attr_id == attr_id) {
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
function deleteProduct(obj, id , attr_id) {
    $.each(cartData, function (index, value) {
        if(attr_id == 0){
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
        }else{
            if (value.id == id && value.attr_id == attr_id) {
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
    if (cartData.length == 0) {
        alert("购物车为空,请先选择商品!");
        return;    
    }
    displayNoneToTop();

    $('#delivery-container').show();
    $.ajax({
        type: "post",
        url: baseUrl + "/App/Index/getUserContact",
        data: {
            
        },
        success: function (data) {
            if (data) {
                var html = '';
                var city = eval(data.city);
                if (city != null) {
                    $.each(city, function (index, value) {
                        html += '<option value="' + value.name + '" label="' + index + '">' + value.name + '</option>';
                    });
                    $('#hat_city').html(html);
                };

                var html = '';
                area = city;
                if (city[0]["area"] != null) {
                    $.each(city[0]["area"], function (index, value) {
                        html += '<option value="' + value.name + '">' + value.name + '</option>';
                    });
                    $('#hat_area').html(html);
                };

                var html = '';
                var deliveryTime = eval(data.config.delivery_time);
                $.each(deliveryTime, function (index, value) {
                    html += '<option value="' + value + '">' + value + '</option>';
                });
                $('#deliveryTime').html(html);

                if (data.contact != null) {
                    $('#username').val(data.contact.name);
                    $('#tel').val(data.contact.phone);
                    $('#hat_city').val(data.contact.city);
                    $('#address').val(data.contact.address);

                    var label = $('#hat_city').find("option:selected").attr("label");
                    $.each(area[label]['area'], function (index, value) {
                        var html = '';
                        $.each(area[label]['area'], function (index, value) {
                            html += '<option value="' + value.name + '">' + value.name + '</option>';
                        });
                        $('#hat_area').html(html);
                    });
                    $('#hat_area').val(data.contact.area);
                };
                
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
    };
    var name = $('#username').val();
    var phone = $('#tel').val();
    var city = $('#hat_city').val();
    var area = $('#hat_area').val();
    var address = $('#address').val();
    var note = $('#note').val();
    var deliveryTime = $('#deliveryTime').val();

    if (payment == -1) {
        alert("请选择支付方式!");
        return;
    };
    if (name.length == 0 || phone.length == 0 || address.length == 0) {
        alert("请核对输入的信息!");
        return;
    };
    submitFlag = false;
    $.ajax({
        type: "post",
        url: baseUrl + "/App/Index/addOrder",
        data: {
            name: name,
            phone: phone,
            city: city,
            area: area,
            address: address,
            note: note,
            deliveryTime: deliveryTime,
            cartData: cartData,
            totalPrice: totalPrice,
            payment: payment
        },
        success: function (data) {
            if (data) {
                if (typeof data.pay != "undefined") {
                     window.location.href = data.pay;
                }
                displayNoneToTop();
                $('#orderResult-container').show();
                $('#qrcodePay-container').hide();

                $('#result-order-no').html(data.result.orderid);
                $('#items-order-result').find('.date').html(data.result.time);
                $('#items-order-result').find('.total').children().html(data.result.totalprice);

                if (data.result.pay_status == 1) {
                    $('#status').html("支付成功");
                }else{
                    $('#status').html("未支付");

                    //$('#qrcodePay-container').show();
                    //$('#qrcodePay').attr("src" , baseUrl + "/App/Pay/qrcodePay");
                }

                var json = eval(data.result.detail);
                var html = '';
                $.each(json, function (index, value) {
                    var attr = '';
                    if(value.attr){
                        attr = '（'+ value.attr +'）';
                    }
                    html += '<li><span class="order-item-name">' + value.name + attr +'</span><span class="order-item-price">￥' + value.price + '</span><span class="order-item-amount">' + value.num + '份</span></li>';
                });
                $('#item-order-list ul').html(html);

                cartData = [];
                totalNum = 0;
                totalPrice = 0;
                initProduct();
            } else {
                alert('提交失败!');
            }
        },
        beforeSend: function () {
            $('#page_tag_load').show();
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

    $.each(area[label]['area'], function (index, value) {
        var html = '';
        $.each(area[label]['area'], function (index, value) {
            html += '<option value="' + value.name + '">' + value.name + '</option>';
        });
        $('#hat_area').html(html);
    });
}

function cancelOrder(id) {
    $('#orderCancel-popup').show();
    $('#yesOrder').one('click' , function () {
        $.ajax({
            type: "post",
            url: baseUrl + "/App/Index/cancelOrder",
            data: {
                id: id
            },
            success: function (data) {
                if (data) {
                    $('#nav-user').click();
                } else {
                    alert("error");
                }
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
    $('#noOrder').one('click' , function () {
        $('#orderCancel-popup').hide();
    });
}

function commentOrder(id) {
    $('#orderComment-popup').show();
    $('#yesCommit').one('click' , function () {
        if ($('#comment-text').val().length == 0) {
            alert("请核对输入的信息!");
            return;
        };
        $.ajax({
            type: "post",
            url: baseUrl + "/App/Index/comment",
            data: {
                name: $('#comment-text').val(),
                id: id
            },
            success: function (data) {
                if (data) {
                    $('#nav-user').click();
                } else {
                    alert("评论失败!");
                }
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
    $('#noCommit').one('click' , function () {
        $('#orderComment-popup').hide();
        $('#comment-text').val("");
    });

}

function pay() {
    $('#pay-popup').show();
    $('#yesPay').one('click' , function () {
        if ($('#pay-text').val().length == 0) {
            alert("请核对输入的信息!");
            return;
        };
        $.ajax({
            type: "post",
            url: baseUrl + "/App/Index/pay",
            data: {
                recharge: 1,
                totalprice: $('#pay-text').val()
            },
            success: function (data) {
                if (data) {
                    window.location.href = data;
                }
                $('#pay-popup').hide();
            },
            beforeSend: function () {
                $('#page_tag_load').show();
            },
            complete: function () {
                $('#page_tag_load').hide();
            }

        });
        $('#pay-text').val("");
    });
    $('#noPay').one('click' , function () {
        $('#pay-popup').hide();
        $('#pay-text').val("");
    });
}
function payOrder(orderid , totalprice) {
    $.ajax({
        type: "post",
        url: baseUrl + "/App/Index/payOrder",
        data: {
            orderid: orderid,
            totalprice: totalprice
        },
        success: function (data) {
            if (data) {
                window.location.href = data;
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

function navSelect(o) {
    $('.navigation-item').removeClass("selected");
    $('.navigation-item').children().removeClass("selected");
    $(o).addClass("selected");
    $(o).children().addClass("selected");
}

function openSale(o){
    navSelect(o);

    displayNoneToTop();
    $("#sale-container").show();

    //延迟加载图片
    $("#list-section img.lazy").lazyload({
        threshold : 180,
        effect : "fadeIn",
        skip_invisible : false,
        failure_limit : 10
    });
}

function openProduct(o){
    navSelect(o);

    displayNoneToTop();
    $("#product-container").show();

    $('.menuItem').first().click();

    var swiper = new Swiper('#swiper-container', {
        slidesPerView: 3,
        spaceBetween: 0
    });

    //延迟加载图片
    $("#items img.lazy").lazyload({
        threshold : 180,
        effect : "fadeIn",
        skip_invisible : false,
        failure_limit : 10
    });
}


function openCart(o){
    navSelect(o);

    displayNoneToTop();
    $("#cart-container").show();

    var html = '';
    $.each(cartData, function (index, value) {
        var attr = '';
        var attr_id = 0;
        if(value.attr){
            attr = '（'+ value.attr +'）';
            attr_id = value.attr_id;
        }
        html += '<li><div class="confirmation-item"><div class="item-info"><span class="item-name">' + value.name + attr +'<br></span><span class="item-price-info"><span><span class="item-single-price">' + value.price + '</span>×<span class="item-amount">' + value.num + '</span></span></span></div><div class="select-box"><span class="minus disabled" onclick="reduceproductNum(this,' + value.id +','+ attr_id +')">—</span><input class="amount" type="text" name="amount" value="' + value.num + '" autocomplete="off" readonly=""><span class="add" onclick="addproductNum(this,' + value.id +','+attr_id +')">+</span></div><div class="delete"><a class="delete-btn" onclick="deleteProduct(this,' + value.id +','+ attr_id +')"><i class="ico ico-delete"></i></a></div></div><div class="divider"></div></li>';
    });
    $('#item-list ul').html(html);
    $('#items-total-price').html(totalPrice);
}

function openUser(o){
    navSelect(o);

    displayNoneToTop();
    $("#user-container").show();

    $.ajax({
        type: "post",
        url: baseUrl + "/App/Index/getUser",
        data: {

        },
        success: function (data) {
            $('#balance').html("");
            $('#userAddress').html("");

            if (data) {
                $('#balance').html(data.balance+'元');
                $('#userAddress').html(data.address);
                $('#items-order-result-list ul').html("");
                $('.myOrderList').hide();

                var json = eval(data.order);
                if (json.length != 0) {
                    $('.myOrderList').show();
                    var html = '';
                    $.each(json, function (index, value) {
                        var htmlfirst = '';
                        var htmlcenter = '';
                        var htmlend = '';

                        var pay_status = '未付款';
                        if(value.pay_status == 1){
                            pay_status = '已付款';
                        }

                        var order_status = '未处理';
                        if(value.status == 1){
                            order_status = '正在配送';
                        }else if(value.status == 2){
                            order_status = '已完成';
                        }
                        htmlfirst += '<li><div class="order-info"><span class="number">订单号：<span id="order-no">' + value.orderid + '</span></span><span class="date" style="float: right">' + value.time + '</span><span class="order-status">' + pay_status +','+order_status + '</span></div><div class="order-list" id="item-order-list"><ul>';
                        var jsoncenter = eval(value.detail);
                        $.each(jsoncenter, function (index, value) {
                            var attr = '';
                            if(value.attr){
                                attr = '（'+ value.attr +'）';
                            }
                            htmlcenter += '<li><span class="order-item-name">' + value.name + attr +'</span><span class="order-item-price">￥' + value.price + '</span><span class="order-item-amount">' + value.num + '份</span></li>';
                        });

                        var pay_status = '';
                        var cancel_status = '';
                        if(value.pay_status == 0){
                            pay_status = '<span class="payOrder" onclick="payOrder(\'' + value.orderid + '\',' + value.totalprice + ')">付款</span>';
                            cancel_status = '<span class="cancelOrder" onclick="cancelOrder(' + value.id + ')">取消</span>';
                        }
                        htmlend += '</ul><div class="mytotal-info"><span class="deliver">运费：0元</span><span class="total">共' + value.totalprice + '元</span></div></div><div class="divider"></div><div class="order-footer">'+cancel_status+'<span class="commitOrder" onclick="commentOrder(' + value.id + ')">评论</span>'+pay_status+'<a class="dail-small" href="tel:' + data.tel + '"><span class="dail-ico"><i class="ico ico-phone"></i></span><span class="dail-text">拨打电话催一催</span></a></div></li>';
                        html += htmlfirst + htmlcenter + htmlend;
                    });
                    $('#items-order-result-list ul').html(html);
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

jQuery.fn.shake = function(times,offset,delay) {//次数,偏移,间隔
    this.stop().each(function() {
        var Obj = $(this);
        var marginLeft = parseInt(Obj.css('margin-left'));
        var delay = delay > 20 ? delay : 20;
        Obj.animate({'margin-left':marginLeft+offset},delay,function(){
            Obj.animate({'margin-left':marginLeft},delay,function(){
                times = times - 1;
                if(times > 0)
                    Obj.shake(times,offset,delay);
            })
        });

    });
    return this;
}

