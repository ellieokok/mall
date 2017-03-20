/*TMODJS:{"version":1,"md5":"7e3836512beb78a9f2875b0215cf1c00"}*/
template('product-container',function($data,$filename
/**/) {
'use strict';var $utils=this,$helpers=$utils.$helpers,include=function(filename,data){data=data||$data;var text=$utils.$include(filename,data,$filename);$out+=text;return $out;},$out='';$out+='<div id="mainList" class="main"> <div id="items" class="items"> ';
include("./productList-container");
$out+=' </div> </div> ';
return new String($out);
});