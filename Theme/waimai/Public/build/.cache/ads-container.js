/*TMODJS:{"version":172,"md5":"c550289051588cebd7fee115cbb9907b"}*/
template('ads-container',function($data,$filename
/**/) {
'use strict';var $utils=this,$helpers=$utils.$helpers,$escape=$utils.$escape,imageUrl=$data.imageUrl,$each=$utils.$each,ads=$data.ads,value=$data.value,i=$data.i,uploadsUrl=$data.uploadsUrl,product=$data.product,$out='';$out+='<div class="header-bar select-shopbar"> <div class="header-title" style="display:inline-block;">{$name}</div> <span style="line-height:45px;position:absolute;"> <a href="#/selectShop" id="selectShop"> <img class="dianpu-img" src="';
$out+=$escape(imageUrl);
$out+='/dianpu.png"> </a> </span> </div> <div class="swiper-container"> <div class="swiper-wrapper" style="height:180px;"> ';
$each(ads,function(value,i){
$out+=' ';
if(value.adsname == 1){
$out+=' <div class="swiper-slide"> <img src="';
$out+=$escape(imageUrl);
$out+='/blank.gif" data-echo="';
$out+=$escape(uploadsUrl+value.savepath+value.savename);
$out+='" style="display: inline; width: 100%;"> </div> ';
}
$out+=' ';
});
$out+=' </div> <div class="swiper-pagination"></div> </div> <div class="mod-desc"> ';
$each(ads,function(value,i){
$out+=' ';
if(value.adsname == 2){
$out+=' <div class="mod-cnt mod-cnt-5"> <a href="';
$out+=$escape(value.url);
$out+='"> <div class="mod-icon"> <img class="lazy" src="';
$out+=$escape(imageUrl);
$out+='/blank.gif" data-echo="';
$out+=$escape(uploadsUrl+value.savepath+value.savename);
$out+='" style="display: inline;"> </div> <div class="mod-txt">';
$out+=$escape(value.name);
$out+='</div> </a> </div> ';
}
$out+=' ';
});
$out+=' </div> <section class="m-component-promotion" id="list-section"> <div class="mod-title" style="padding-top: 5px;">热门活动</div> <ul class="list-unstyled" id="list-sale"> ';
$each(ads,function(value,i){
$out+=' ';
if(value.adsname == 3){
$out+=' <li> <a onclick="clickItemDetail(\'';
$out+=$escape(value.remark);
$out+='\')"><img class="lazy" src="';
$out+=$escape(imageUrl);
$out+='/blank.gif" data-echo="';
$out+=$escape(uploadsUrl+value.savepath+value.savename);
$out+='" style="display: inline; height: 137px;"></a> </li> ';
}
$out+=' ';
});
$out+=' </ul> </section> <div id="product-hot"> <div class="mod-title">推荐</div> <ul> ';
$each(product,function(value,i){
$out+=' ';
if(value.label == "推荐"){
$out+=' <li class="item ';
if(value.recommend == 1){
$out+='large';
}
$out+='" label-cate="';
$out+=$escape(value.menu_id);
$out+='" label-id="';
$out+=$escape(value.id);
$out+='"> <a href="#/product/';
$out+=$escape(value.id);
$out+='" title=""> <div class="item-image"><img src="';
$out+=$escape(imageUrl);
$out+='/blank.gif" data-echo="';
$out+=$escape(uploadsUrl+value.savepath+value.savename);
$out+='" class="lazy" style="width: 100%; margin-top: 0px; display: inline;background: #FFF url(';
$out+=$escape(imageUrl);
$out+='/loading.gif) no-repeat center center;background-size: 30px;"> <div class="select-shadow"> <div class="select-inner"><img src="';
$out+=$escape(imageUrl);
$out+='/ico_select.png" alt="selected"><span>已选</span></div> </div> </div> </a> <div class="single-item-info"> <div class="item-title">';
$out+=$escape(value.name);
$out+='</div> <div class="item-price-show"> <div class="item-price"><span class="hotspot">￥';
$out+=$escape(value.price);
$out+='</span></div> </div> ';
if(value.status == 1){
$out+=' <div class="message-icon"style="right:0px;"> ';
if(value.sku.length){
$out+=' <input class="numbers-add" type="button" onclick="clickItemDetail(\'';
$out+=$escape(value.id);
$out+='\')"> ';
}else{
$out+=' <input class="numbers-minus" type="button" onclick="reducehotproductNum(this,\'';
$out+=$escape(value.id);
$out+='\' , false)" style="display: none;"> <input class="numbers" type="text" value="0" style="display: none;"> <input class="numbers-add" type="button" onclick="doCart(this ,\'';
$out+=$escape(value.id);
$out+='\',\'';
$out+=$escape(value.name);
$out+='\',\'';
$out+=$escape(value.price);
$out+='\',\'\')"> ';
}
$out+=' </div> ';
}else if(value.status == 0){
$out+=' <div class="item-amount"><span>已售罄</span></div> ';
}
$out+=' </div> </li> ';
}
$out+=' ';
});
$out+=' </ul> <div class="copyright" style="text-align: center;margin: 20px 0px 70px 0px;color: #ccc;font-size: 12px;float: left;width: 100%">&nbsp;</div> </div> ';
return new String($out);
});