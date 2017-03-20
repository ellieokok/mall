/*TMODJS:{"version":4,"md5":"39146471225873ce26a040f0124d852e"}*/
template('delivery-container',function($data,$filename
/**/) {
'use strict';var $utils=this,$helpers=$utils.$helpers,config=$data.config,$out='';$out+='<div class="confirmation-form"> <div class="confirmation-header-nb"> <span>收货人信息</span> <div class="dotted-divider"></div> </div> <div class="container-gird"> <form class="delivery-info"> <ul class="form_table"> <li> <span class="td_left">姓名</span> <span class="td_right"> <input type="text" name="username" id="username" placeholder="务必使用真实姓名" value="" required=""> <input type="hidden" name="id" id="id" value="0"> </span> </li> <li> <span class="td_left">手机</span> <span class="td_right"><input type="text" name="tel" id="tel" placeholder="" value="" required=""></span> </li> <li> <span class="td_left">地址</span> <span class="td_right"> <select id="hat_city" name="hat_city" class="hat_select" onchange="changeCity(this)"> </select> <select id="hat_area" name="hat_area" class="hat_select"> </select> </span> </li> <li> <span class="td_left"></span> <span class="td_right"> <input type="text" name="address" id="address" placeholder="详细地址" value="" required=""> </span> </li> <li> <span class="td_left">备注</span> <span class="td_right"><input type="text" name="note" id="note" placeholder="选填"></span> </li> <li> <span class="td_left">配送时间</span> <span class="td_right"> <select id="deliveryTime" name="deliveryTime" class="hat_select"> </select> </span> </li> <li></li> </ul> </form> </div> </div> <div class="payment"> <p class="heading">支付方式</p> <div class="container-gird"> <div class="payment-content"> ';
if(config.balance_payment=='1'){
$out+=' <span class="line" id="balance-payment"> <span class="radio"></span> <span class="label">账户支付</span> </span> ';
}
$out+=' ';
if(config.wechat_payment=='1'){
$out+=' <span class="line" id="wechat-payment"> <span class="radio"></span> <span class="label">微信支付</span> </span> ';
}
$out+=' ';
if(config.alipay_payment=='1'){
$out+=' <span class="line" id="alipay-payment"> <span class="radio"></span> <span class="label">支付宝支付</span> </span> ';
}
$out+=' ';
if(config.cool_payment=='1'){
$out+=' <span class="line" id="cool-payment"> <span class="radio"></span> <span class="label">货到付款</span> </span> ';
}
$out+=' </div> </div> </div> <a class="next mybtn" href="javascript:submitOrder();" > <span class="pi_next1" style="display: block; height: 39px; font-size: 1.2em;margin: 10px;background: #FF4146;color: #ffffff;border-radius: 6px;border: 0.5px solid #c3c4c8;">提交订单</span> </a> <div style="padding-top:80px;"> <a href="javascript:void(0);" style="text-align: center;color: #949494;font-size: 12px;display: block;"></a> </div>';
return new String($out);
});