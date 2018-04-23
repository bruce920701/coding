var lesstime = 0;
$(document).on("pageInit", "#uc_money_withdraw", function(e, pageId, $page) {
	$(".bank-select").click(function() {
		if(bank==1){
			$(".select-bank").addClass('active');
		}
	});
	$(".mask").click(function() {
		$(".select-bank").removeClass('active');
	});
	$(".bank-list li").click(function() {
		$(".bank-list li .iconfont").removeClass('selected');
		$(this).find('.iconfont').addClass('selected');
		$(".bank-select .bank-info").html($(this).find('.bank-info').html());
		$(".select-bank").removeClass('active');
		$("input[name='bank_id']").val($(this).attr("bank_id"));
	});
	
	$(".select-bank .add-bank").click(function(){
		$(".select-bank").removeClass('active');
	});
	
	$(".select-bank .close-btn").click(function(){
		$(".select-bank").removeClass('active');
	});
	
	$("form[name='withdraw']").find("input[name='money']").change(function(){
		var money=parseFloat($(this).val());
		if(money>all_money){
			$.toast("提现超额");
			$(this).val(all_money);
		}
	});

	// 绑定删除用户银行卡的事件
	$('.del_bank').bind('click', function() {
		var bank_id = $(this).attr('data-id');
		var ajax_url = $(this).attr('data-action');
		// if_confirm??
		$.ajax({
			url: ajax_url,
			data: {'bank_id':bank_id},
			dataType: 'json',
			success: function(obj) {
				if (obj.status == 1) {
					$.toast('删除成功');
					// 移除前台展示的DOM
				} else {
					$.toast(obj.info);
				}
			}
		});
		return false;
	});
	function init_bank(){
		var bank_name=$(".bank").find(".checked").attr("bank_name");
		var bank_id=$(".bank").find(".checked").attr("rel");
		$("input[name='bank_name']").val(bank_name);
		$("input[name='bank_id']").val(bank_id);
	}


	submit();
	
	function submit(){
		$(".withdraw_submit").bind("click",function(){	
			$(".withdraw_submit").attr('disabled',"true");
			setTimeout(function(){
				$(".withdraw_submit").removeAttr("disabled");
			},3000);
			var bank_id = $("form[name='withdraw']").find("input[name='bank_id']").val();
			var money = $("form[name='withdraw']").find("input[name='money']").val();


			if($.trim(bank_id)==""||isNaN(bank_id)||parseFloat(bank_id)<=0)
			{
				$.toast("请选择提现账户");
				setTimeout(function(){
					load_page($(".load_page"));
				},1000);
				return false;
			}
			if($.trim(money)==""||isNaN(money)||parseFloat(money)<=0)
			{
				$.toast("请输入正确的提现金额");
				return false;
			}
			
			var ajax_url = $("form[name='withdraw']").attr("action");
			var query = $("form[name='withdraw']").serialize();
			//console.log(query);
			$.ajax({
				url:ajax_url,
				data:query,
				dataType:"json",
				type:"POST",
				success:function(obj){
					if(obj.status==1){
						$.toast("提现申请成功，请等待管理员审核");
						$("form[name='withdraw']").find("input[name='money']").val('');
						if(obj.url){
							setTimeout(function(){
								location.href = obj.url;
							},1500);
						}
					}else if(obj.status==0){
						if(obj.info)
						{
							$.toast(obj.info);
							if(obj.url){
								setTimeout(function(){
									location.href = obj.url;
								},1500);
							}
						}
						else
						{
							if(obj.url)location.href = obj.url;
						}
						
					}
				}
			});		
			return false;
		});
	}

	wtime($("#uc_withdraw_btn"));
	$("#main1  #verify_image_box").find(".verify_close_btn").bind("click",function(){
		$("#main1 #verify_image_box").hide();
	});

	if ($('#mobile').val() == '') {
		$("#uc_withdraw_btn").addClass("noUseful").removeClass("isUseful");
	}
	/*手机号码正则验证*/

	if($("#mobile").length>0){
		document.getElementById("mobile").oninput=function () {
			if(parseInt($("#uc_withdraw_btn").attr("lesstime"))==0){
				var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;

				var text=$(this).val();
				if(reg.test(text)){
					$(".j-mobilesendBtn").addClass("isUseful").removeClass("noUseful");
					$(".j-mobilesendBtn").prop("disabled",false);
					/*发送验证码倒计时*/
					$(".j-mobilesendBtn .isUseful").click(function () {
						do_withdraw_send($("#uc_withdraw_btn"));
					});
				}
				else {
					$(".j-mobilesendBtn").addClass("noUseful").removeClass("isUseful");
					$(".j-mobilesendBtn").prop("disabled", true);
				}
			}
		};
	}
	function wtime(obj) {
		wait=parseInt(obj.attr("lesstime"));
		if (wait == 0) {
			obj.prop("disabled",false);
			obj.addClass("isUseful").removeClass("noUseful");
			obj.val("发送验证码");
			obj.attr("lesstime",0);
			$(".j-mobilesendBtn.isUseful").click(function () {
				do_withdraw_send($("#uc_withdraw_btn"));
			});
			$("#uc_withdraw_btn").attr("verify_code","");
			//wait = 60;
		} else {
			obj.prop("disabled", true);
			obj.addClass("noUseful").removeClass("isUseful");
			obj.val("重新发送(" + (wait-1) + ")");
			obj.attr("lesstime",wait-1);
			//wait--;
			setTimeout(function() {
				wtime(obj)
			}, 1000);
		}
	}

	function do_withdraw_send(btn)
	{
		var account = $(btn).attr("account");
		if($.trim($("#mobile").val())=="" && account!=1)
		{
			$.toast("请输入手机号码");
			return false;
		}
		if(lesstime>0)return;
		var query = new Object();
		query.mobile = $("#mobile").val();
		query.act = "send_sms_code";
		query.unique = $(btn).attr("unique");
		query.account = account;
		query.verify_code = (btn).attr("verify_code");
		$.ajax({
			url:AJAX_URL,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status==1)
				{
					$(btn).attr("lesstime",obj.lesstime);
					wtime(btn);
					$.toast(obj.info);

				}
				else
				{
					if(obj.status==-1)
					{
						get_verification_code(btn);
						$(".page-current #main1 #verify_image_box").show();

						if($(btn).attr("verify_code")&&$(btn).attr("verify_code")!="")
						{
							$.alert(obj.info,function(){
								$(btn).attr("verify_code","")
							});
						}
					}
					else
					{
						$.toast(obj.info);
					}

				}
			}
		});
	}

	function get_verification_code(btn){
		//刷新验证码
		$.ajax({
			url:VERIFICATION_CODE_URL,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status){
					$(".form-item").html(obj.html);
					$(".icon-list").click(function(){
						//选择验证码图标
						$(this).addClass('active').siblings().removeClass('active');
						var iconcode = $(this).find(".iconcode").attr("rel");
						$("input[name='verify_image']").val(iconcode);
						
					});
					$(".batch").click(function(){
						//选择验证码图标
						get_verification_code();
						
					});
					$("#verify_image_box").find("img").bind("click",function(){
						var rel = $(this).attr("rel");
						$(this).attr("src",rel+"&r="+Math.random());
					});
					$("#main1 #verify_image_box").find("input[name='confirm_btn']").unbind("click");
					$("#main1 #verify_image_box").find("input[name='confirm_btn']").bind("click",function(){
						var verify_code = $.trim($("#verify_image_box").find("input[name='verify_image']").val());
						if(verify_code==""){
							$.toast("请输入图形验证码");
						}else{
							$(btn).attr("verify_code",$("input[name='verify_image']").val());
							$("#main1 #verify_image_box .verify_form_box .form-item").html("");
	                        $("#main1 #verify_image_box").hide();
	                        do_withdraw_send(btn);

						}
					});
				}
			}
		});
	}

});


