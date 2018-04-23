$(document).on("pageInit", "#order_view", function(e, pageId, $page) {
    select_box($(".j-open-service"),$(".m-service-box"));
    $(".invoice-bar").click(function(){
        $(this).toggleClass("active");
    });
    var t1= parseInt($(".j-data-time").attr('data-time'));
    
	var leftGRObj = setInterval(GetRTime,1000);
    function GetRTime(){
      var t= $(".j-data-time").attr('data-time');
      var is_load = $(".j-data-time").attr('is_load');
      if(is_load==1){
          var d=0;
          var h=0;
          var m=0;
          var s=0;

    	    d=Math.floor(t/60/60/24);
    	    h=Math.floor(t/60/60%24);
    	    m=Math.floor(t/60%60);
    	    s=Math.floor(t%60);
    	    if (d>0) {
    	        $(".j-data-time .j-time").html(d + "天" + h +"小时" + m +"分钟" + s +"秒");
    	    } else {
    	        $(".j-data-time .j-time").html(h +"小时" + m +"分钟" + s +"秒");
    	    }
    	    if (h<1) {
    	        $(".j-data-time .j-time").html(m +"分钟" + s +"秒");
    	    }
    	    
    	    if (m<1) {
    	        $(".j-data-time .j-time").html(s +"秒");
    	    }

    	    if(t==0){

    	    	$(".j-data-time .j-time").html("0秒");
    	    	$(".pay_btn").addClass('no_pay_btn').removeClass('pay_btn').attr('error_tip','支付超时').attr('href','javascript:void(0)'); 	
    	    	clearInterval(leftGRObj);
    	    	$.loadPage(location.href);
    	    	
    	    }
    	    t = t -1;
    	    $(".j-data-time").attr('data-time',t);
      }else{
    	  $(".j-data-time .j-time").html("0秒");
    	  clearInterval(leftGRObj);
      }
  
    }

    $(".cancel_order").unbind("click").bind("click",function(){
        var message=$(this).attr("message");
        var url=$(this).attr("ajaxUrl");
		var button_type=$(this).attr("button-type");
        $.confirm(message, function () {
            $.showIndicator();
            $.ajax({
                url:url,
                dataType:"json",
                success:function(data){
                    if(data.status==0){
                        $.toast(data.info);
                    }else{
//                        $.alert(data.info,function(){
//                            window.location.href=data.jump;
//                        })
                    	$.toast(data.info);
                   	 	window.setTimeout(function(){
							if(button_type=="j-cancel"){
								window.location.href=location.href;
							}else{
								window.location.href=data.jump;
							}
    					},1500);
                    }
                }
            });
        });
    });
    
	$('.xnOpenSdk').bind('click', function() {
		if (app_index != 'app') {
			return;
		}
		if(is_login==0){
			App.login_sdk();
			return false;
		}
		var xnOptionsObj = {
			goods_id:'',
			goods_showURL:'',
			goodsTitle: '',
			goodsPrice: '',
			goods_URL: '',
			settingid: settingid,
			appGoods_type: '0',
		};
		xnOptions = JSON.stringify(xnOptionsObj);
		try {
			App.xnOpenSdk(xnOptions);
		} catch (e) {
			$.toast(e);
		}
	})

});