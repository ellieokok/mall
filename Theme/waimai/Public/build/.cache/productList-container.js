/*TMODJS:{"version":18,"md5":"8933c4933819eb99ddad5a11d59ce8d0"}*/
template('productList-container',function($data,$filename
/**/) {
'use strict';var $utils=this,$helpers=$utils.$helpers,$each=$utils.$each,menu=$data.menu,value=$data.value,i=$data.i,$escape=$utils.$escape,product=$data.product,imageUrl=$data.imageUrl,uploadsUrl=$data.uploadsUrl,$out='';$out+='<div class="header-bar"> <div id="header-searchInput"> <div class="input-group"> <div class="input-text"> <i class="iconfont">&#xe601;</i> <div class="ui-suggestion-mask"> <input class="icon-input" name="searchtxt" type="search" placeholder="输入搜索商品"> <div class="widget-common-eraser widget-common-eraser-hidden"></div> </div> </div> <input type="button"class="search-btn" onclick="openSearch()" value="搜索"> </div> </div> </div> <ul class="shop-menu"> ';
$each(menu,function(value,i){
$out+=' <li onclick="switchMenu(this,\'';
$out+=$escape(value.id);
$out+='\',\'\')"> <span>';
$out+=$escape(value.name);
$out+='</span> </li> ';
});
$out+=' <div style="height: 200px;"></div> </ul> <div class="shop-product">  <ul class="mui-table-view mui-table-viewa" id="items"> ';
$each(product,function(value,i){
$out+=' <li class="mui-table-view-cell mui-media" label-cate="';
$out+=$escape(value.menu_id);
$out+='" label-id="';
$out+=$escape(value.id);
$out+='" style="display: none"> <img onclick="prevView(this)" class="mui-media-object mui-pull-left mui-pull-lefts" src="';
$out+=$escape(imageUrl);
$out+='/blank.gif" style="background: #FFF url(';
$out+=$escape(imageUrl);
$out+='/loading.gif) no-repeat center center;background-size: 20px;" data-echo="';
$out+=$escape(uploadsUrl+value.savepath+value.savename);
$out+='"> <div class="mui-media-body"> <a href="#/product/';
$out+=$escape(value.id);
$out+='" title=""> <span class="product-name">';
$out+=$escape(value.name);
$out+='</span> </a> <span class="monthlySales"><span>';
$out+=$escape(value.subname);
$out+='</span></span> <span class="mui-ellipsis mui-ellipsisa">￥';
$out+=$escape(value.price);
$out+='</span> <div class="message-icon"> <input class="numbers-minus" type="button" onclick="reducehotproductNum(this,\'';
$out+=$escape(value.id);
$out+='\' , false)" style="display: none;"> <input class="numbers" type="text" value="0" style="display: none;"> <input class="numbers-add" type="button" onclick="doCart(this ,\'';
$out+=$escape(value.id);
$out+='\',\'';
$out+=$escape(value.name);
$out+='\',\'';
$out+=$escape(value.price);
$out+='\',\'\')"> </div> </div> </li> ';
});
$out+=' </ul> </div> <div id="shopmenu-cart"> <div id="shopmenu-cart-bar" class="shopmenu-cart-bar"> <div class="row-num" onclick="location.href=\'#/cart\'" ng-class="shopCartAnimate"><em class="cart-count " id="shopcart-tip" style="display:none">1</em> </div> <div class="row-cart"> <div class="price-info"> <div class="cart-price" >共&nbsp;¥<span id="shopcart-totalPrice">0.00</span>元</div> <div class="cart-premium" style="display: none;"></div> </div> <a class="row-status" style="display: none;">差¥8起送</a> </div> <a class="row-status" id="shopcart-sure" onclick="openCartsure()" style="display: none;">选好了</a> </div> </div> ';
return new String($out);
});