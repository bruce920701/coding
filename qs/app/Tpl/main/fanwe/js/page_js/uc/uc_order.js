$(document).ready(function(){
	$(".check_delivery[ajax='true']").bind("click",function(){
		return false;
	});
	
	//全选
	$('.all_check').click(function(){
		var table = $(this).parents('table:first');
		var is_all_check = $(this).attr('checked');
		var is_disabled_check = $('.check-box').attr('disabled');
		//console.log(is_disabled_check);
		if(is_all_check != true){
			$(table).find('input[type=checkbox]').attr('checked',false);
		    $(this).attr('checked',false);
		}else{
			$(table).find('input[type=checkbox]').attr('checked',true);
		}
	});
	$('.check-box').click(function(){
		var is_check = $(this).attr('checked');
		if(!is_check){
			$('.all_check').attr('checked',false);
		}
	});
	
	
	$(".check_delivery[ajax='true']").hover(function(){
		var id = "delivery_box_"+$(this).attr("rel");
		$("#"+id).stopTime();
		var dom = $(this);
		if($("#"+id).length>0)
		{
			$("#"+id).show();
		}
		else
		{
			var kuaidi_type = $(this).attr("kuaidi_type");
			if(kuaidi_type == 1){
				var html = "<div id='"+id+"' class='check_delivery_pop'><div class='loading'></div></div>";
				var box = $(html);
				$("body").append(box);
				$(box).css({"position":"absolute","left":$(dom).position().left-80,"top":$(dom).position().top+20,"z-index":10});

				$.ajax({
					url:$(dom).attr("action"),
					type:"POST",
					dataType:"json",
					success:function(obj){
						if(obj.status)
						{
							$(box).html(obj.html);
						}
						else
						{
							$(box).remove();
						}
					}
				});
			}else if(kuaidi_type == 3){
				var html = "<div id='"+id+"' class='check_delivery_pop'><div class='loading'></div><div class='iframe'></iframe></div>";
				var box = $(html);
				$("body").append(box);
				$(box).css({"position":"absolute","left":$(dom).position().left-80,"top":$(dom).position().top+20,"z-index":10});
				

				$.ajax({
					url:$(dom).attr("action"),
					type:"POST",
					dataType:"json",
					success:function(obj){
						if(obj.status)
						{
							$(box).find(".iframe").hide();
							$(box).find(".iframe").html(obj.html);
							$("iframe[name='kuaidi100']").load(function(){
								$(box).find(".loading").hide();
								$(box).css({"position":"absolute","left":$(dom).position().left-394,"top":$(dom).position().top+16,"z-index":10});
								$(box).find(".iframe").show();
								$(box).removeClass("check_delivery_pop");
							});
						}
						else
						{
							$(box).remove();
						}
					}
				});
			}
			
		}
		$("#"+id).hover(function(){
			$("#"+id).stopTime();
			$("#"+id).show();
		},function(){
			$("#"+id).oneTime(300,function(){
				$("#"+id).remove();
			});
		});
	},function(){
		var id = "delivery_box_"+$(this).attr("rel");
		if($("#"+id).length>0)
		{
			$("#"+id).oneTime(300,function(){
				$("#"+id).remove();
			});
		}
		
	});
	
	
	
	/**
	 * 确认收货
	 */
	$(".verify_delivery").bind("click",function(){
		var dom = $(this);
		$.showConfirm("确定已经收到快递发来的货物了吗？",function(){
			$.ajax({
				url:$(dom).attr("action"),
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==1000)
					{
						ajax_login();
					}
					else if(obj.status==1)
					{
						//console.log(obj);
						if(obj.dp_url){
							$.showConfirm("您已成功收货，立即去点评吗？",function(){
								location.href = obj.dp_url;
							},function(){
								location.reload();
							});
						}else{
							$.showSuccess("您已成功收货",function(){
								location.reload();
							});
						}
					}
					else
					{
						$.showErr("收货失败");
					}
				}
			});
		});
		return false;
	});
	
	
	/**
	 * 没收到货
	 */
	$(".refuse_delivery").bind("click",function(){
		var dom = $(this);
		$.showConfirm("没收到货吗？确定提交维权订单吗？",function(){
			$.weeboxs.open(refuse_delivery_form_html, {boxid:'refuse_box',contentType:'text',showButton:true, showCancel:false, showOk:true,title:'没收到货',width:250,type:'wee',onopen:function(){
				init_ui_button();
				init_ui_textbox();
			},onok:function(){
				var content = $("#refuse_box").find("textarea[name='content']").val();
				var query = new Object();
				query.content = content;
				$.ajax({
					url:$(dom).attr("action"),
					data:query,
					type:"POST",
					dataType:"json",
					success:function(obj){
						$.weeboxs.close("refuse_box");
						if(obj.status==1000)
						{
							ajax_login();
						}
						else if(obj.status==1)
						{							
							$.showSuccess("维权订单已提交，请等待管理员审核",function(){
								location.reload();
							});
						}
						else
						{
							$.showErr(obj.info);
						}
					}
				});
					
			}});
			return false;
			
			
			
		});
		return false;
	});
	
	
	$(".del_order").bind("click",function(){
		var dom = $(this);
		$.showConfirm("确定要删除本订单吗？",function(){
			$.ajax({
				url:$(dom).attr("action"),
				type:"POST",
				dataType:"json",
				success:function(obj){
					console.log(obj);
					if(obj.status==1000)
					{
						ajax_login();
					}
					else if(obj.status==1)
					{
						$.showSuccess("订单删除成功！",function(){
							location.reload();
						});
					}
					else
					{
						$.showErr(obj.info);
					}
				}
			});
		});
		return false;
	});
	
	$(".cancel_order").bind("click",function(){
		var dom = $(this);
		$.showConfirm("确定要取消本订单吗？",function(){
			$.ajax({
				url:$(dom).attr("action"),
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==1000)
					{
						ajax_login();
					}
					else if(obj.status==1)
					{
						$.showSuccess("订单取消成功！",function(){
							location.reload();
						});
					}
					else
					{
						$.showErr(obj.info);
					}
				}
			});
		});
		return false;
	});
	
	
	$(".refund").bind("click",function(){
		var dom = $(this);
		$.showConfirm("确定要申请退款吗？",function(){
			$.ajax({
				url:$(dom).attr("action"),
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==1000)
					{
						ajax_login();
					}
					else if(obj.status)
					{
						$.weeboxs.open(obj.html, {boxid:'refund_box',contentType:'text',showButton:true, showCancel:false, showOk:true,title:'退款申请',width:250,type:'wee',onopen:function(){
							init_ui_button();
							init_ui_textbox();
						},onok:function(){
							var form = $("form[name='refund_form']");
							var query = $(form).serialize();
							$.weeboxs.close("refund_box");
							$.ajax({
								url:$(form).attr("action"),
								data:query,
								dataType:"json",
								type:"POST",
								success:function(obj){
									if(obj.status==1000)
									{
										ajax_login();
									}
									else if(obj.status)
									{
										$.showSuccess(obj.info,function(){
											location.reload();
										});
									}
									else
									{
										$.showErr(obj.info);
									}
								}
							});
						}});
					}
					else
					{
						$.showErr(obj.info);
					}
				}
			});
		});
		return false;
	});
	
	
	$(".send_coupon").bind("click",function(){
		var dom = $(this);
		$.ajax({
			url:$(dom).attr("action"),
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status==1000)
				{
					ajax_login();
				}
				else if(obj.status==1)
				{
					IS_RUN_CRON = 1;
					$.showSuccess(obj.info,function(){
						location.reload();
					});
				}
				else
				{
					$.showErr(obj.info,function(){
						if(obj.jump)
						{
							location.href = obj.jump;
						}
					});
				}
			}
		});
	});
	
	$(".all_refund").bind("click",function(){
		var dom = $(this);
		$.showConfirm("确定要申请退款吗？",function(){
			var ids = [];
			dom.parents('table:first').find('input[type=checkbox]').each(function(i, elm) {
				if ($(elm).attr('checked') == true) {
					if($(elm).attr('cid')!=0){
						ids.push($(elm).attr('cid'));
					}
				}
			});
			var cids={cids:ids.join(",")};
			$.ajax({
				url:dom.attr("action"),
				data:cids,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==1000)
					{
						ajax_login();
					}
					else if(obj.status)
					{
						$.weeboxs.open(obj.html, {boxid:'refund_box',contentType:'text',showButton:true, showCancel:false, showOk:true,title:'退款申请',width:250,type:'wee',onopen:function(){
							init_ui_button();
							init_ui_textbox();
							$("input[name='cids']").val(ids.join(","));
						},onok:function(){
							var form = $("form[name='refund_form']");
							var query = $(form).serialize();
							//cids={cids:ids.join(",")};
							$.weeboxs.close("refund_box");
							$.ajax({
								url:ajax_url,
								data:query,
								dataType:"json",
								type:"POST",
								success:function(obj){
									if(obj.status==1000)
									{
										ajax_login();
									}
									else if(obj.status)
									{
										$.showSuccess(obj.info,function(){
											location.reload();
										});
									}
									else
									{
										$.showErr(obj.info);
									}
								}
							});
						}});
					}
					else
					{
						$.showErr(obj.info);
					}
				}
			});
		});
		return false;
	});
	

	/**
 * 初始化倒计时
 */
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
				$(".j-time").html(d + "天" + h +"小时" + m +"分钟" + s +"秒");
			} else {
				$(".j-time").html(h +"小时" + m +"分钟" + s +"秒");
			}
			if (h<1) {
				$(".j-time").html(m +"分钟" + s +"秒");
			}

			if (m<1) {
				$(".j-time").html(s +"秒");
			}

			if(t==0){

				$(".j-time").html("0秒");
				//$(".order-pay-btn").addClass('order-no-pay-btn').removeClass('order-pay-btn').attr('error_tip','支付超时').attr('href','javascript:void(0)');
				clearInterval(leftGRObj);
				window.location.reload();
			}
			t = t -1;
			$(".j-data-time").attr('data-time',t);
		}else{
			$(".j-time").html("0秒");
			clearInterval(leftGRObj);
		}

	}




});