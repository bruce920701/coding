$(document).ready(function(){
	var btns = $(".conf_btn");
	var tabs = $(".conf_tab");
	$.each(btns, function(i, btn){
		$(btn).bind("click",function(){
			$(tabs).hide();
			$(tabs[i]).show();
			$(btns).removeClass("currentbtn");
			$(this).addClass("currentbtn");
		});
		$(btn).bind("focus",function(){$(this).blur();});
	});
	$(btns[0]).click();
    show_customer_service();
    $("select[name=CHOOSE_CUSTOMER_SERVICE]").bind("change",function(){
        show_customer_service();
    });
});
function show_customer_service(){
   var val=parseInt($("select[name=CHOOSE_CUSTOMER_SERVICE]").val());
   if(val==0){
      $("#TR_XN_SETTING_ID").hide();
      $("input[name=XN_SETTING_ID]").val('');
      $("#TR_QIMO_ACCESSID").hide()
       $("input[name=QIMO_ACCESSID]").val('');
   }else if(val==1){
       $("#TR_XN_SETTING_ID").show();
       $("#TR_QIMO_ACCESSID").hide()
       $("input[name=QIMO_ACCESSID]").val('');
   }else if(val==2){
        $("#TR_XN_SETTING_ID").hide();
        $("#TR_QIMO_ACCESSID").show()
       $("input[name=XN_SETTING_ID]").val('');
   }

}
function myNumberic(e,len) {

    var obj=e.srcElement || e.target;
    var dot=obj.value.indexOf(".");//alert(e.which);
    len =(typeof(len)=="undefined")?2:len;
    var  key=e.keyCode|| e.which;
    if(key==46&&(!len||dot>0)){//整数就不让他输入了小数点
        return false;
    }
    if(key==8 || key==9 || key==46 || (key>=37  && key<=40))//这里为了兼容Firefox的backspace,tab,del,方向键
        return true;
    if (key<=57 && key>=48) { //数字
        if(dot==-1)//没有小数点
            return true;
        else if(obj.value.length<=dot+len)//小数位数
            return true;
    } else if((key==46) && dot==-1){//小数点
        return true;
    }
    return false;
}