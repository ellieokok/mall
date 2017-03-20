/*TMODJS:{"version":1,"md5":"3e459a26a6a210063238d81684210574"}*/
template('qrcodePay-container',function($data,$filename
/**/) {
'use strict';var $utils=this,$helpers=$utils.$helpers,$escape=$utils.$escape,qrcode=$data.qrcode,$out='';$out+='<div class="orderResult-header"> <span> <i class=""></i>微信扫码支付</span> </div> <div class="orderResultList-container"> <div> <div class="orderResult-form"> <div class="orderResult-list"> <div class="order-info" style="text-align:center;"><img id="qrcodePay" style="width: 200px; height: 200px;" src="';
$out+=$escape(qrcode);
$out+='"> </div> <div class="divider"></div> </div> </div> <div class="tips" style="text-align:center;"> <span>温馨提示：由于微信订阅号不支持微信支付，请长按图片【识别二维码】付款</span> </div> </div> </div>';
return new String($out);
});