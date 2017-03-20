/*TMODJS:{"version":1,"md5":"4939328897ad0726367bc88ef990aa0f"}*/
template('popup',function($data,$filename
/**/) {
'use strict';var $utils=this,$helpers=$utils.$helpers,$escape=$utils.$escape,header=$data.header,tips=$data.tips,$out='';$out+='<div id="popup" class="popup"> <div class="popup-header">';
$out+=$escape(header);
$out+='</div> <div class="popup-tips"> ';
if(tips){
$out+=' ';
$out+=$escape(tips);
$out+=' ';
}else{
$out+=' <input style="width: 86%;margin: 0px 10px 10px 10px;height: 20%;" type="number" id="popup-number"> ';
}
$out+=' </div> <div class="btn-group"> <button class="btn" id="yes" onclick="confirmPopup()">确定</button> <button class="btn" id="cancel" onclick="closePopup()">取消</button> </div> </div>';
return new String($out);
});