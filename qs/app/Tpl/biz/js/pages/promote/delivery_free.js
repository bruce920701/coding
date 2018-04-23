$(function(){
	$(".open-btn").bind('click', function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$("input[name='is_open_delivery_free']").val(0);

		} else {
			$(this).addClass('active');
			$("input[name='is_open_delivery_free']").val(1);

		}
	});
	
	
	$(".delivery_free").bind("click",function(){

		var form = $("form[name='delivery_free']");
		var query = $(form).serialize();
		var url = $(form).attr("action");

		var delivery_free_money=$("input[name='delivery_free_money']").val();
		
		if(delivery_free_money=='' || isNaN(delivery_free_money) || parseFloat(delivery_free_money)<0){
			$.showErr("输入信息有误，请重新输入");
			return false;
		}
		
		$.ajax({
			url:url,
			data:query,
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 0){
					$.showErr(data.info,function(){
						if(data.jump){
							window.location = data.jump;
						}
					});
				}else if(data.status==1){
					$.showSuccess(data.info,function(){
						if(data.jump){
							window.location = data.jump;
						}
					});
				}
			}
		});
		
	});



		


	
	
});//JQUERY END




