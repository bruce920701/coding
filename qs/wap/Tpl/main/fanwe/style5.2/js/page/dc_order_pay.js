/**
 * Created by Administrator on 2016/9/7.
 */

$(document).on("pageInit", "#dc_order_pay", function(e, pageId, $page) {

	// $('.fee_count').hide();
	init_payment_input();
	init_pay_btn();
	function init_payment_input(){
		account_click();

		$('#all_account_money').live('click', account_click)
		
		$(".payment").live("click", payment_click);
	}

	function account_click() {
		$(this).addClass('active');
		$("input[name='all_account_money']").prop("checked",true);
		$(".payment").removeClass('active');
		$("input[name='payment']").prop("checked",false);
		$('.fee_count').addClass('hide');
		$('.fee_count .payment_fee').text(0);
		local_count();
	}

	function payment_click() {
		$("input[name='payment']").prop("checked",false);
		$(".payment").removeClass('active');
		$(this).siblings("input[name='payment']").prop("checked",true);
		$(this).addClass("active");

		$("#all_account_money").removeClass("active");
		$("input[name='all_account_money']").prop("checked",false);
		var fee = Number($('.active .fee_amount').text());
		fee = fee > 0 ? fee.toFixed(2) : 0;
		if (fee > 0) {
			$('.fee_count').removeClass('hide');
		} else {
			$('.fee_count').addClass('hide');
		}
		$('.fee_count .payment_fee').text(fee);
		local_count()
	}

	function local_count() {
		var total= $('.total_count').text().replace(",","");
		var payment_fee= $('.payment_fee').text().replace(",","");
		var discount= 0; // $('.discount').text().replace(",","");
		var ready_pay = Number(total) - Number(discount) + Number(payment_fee);
		$('.ready_pay').text(ready_pay.toFixed(2));
	}

	function init_pay_btn(){
	    $(".u-sure-pay").bind("click",function(){
	    	var all_account_money = 0; // 是否余额支付
			var payment = 0;
			//全额支付
			if($("#all_account_money").hasClass("active")) {
				all_account_money = 1;
			} else { // 其它支付方式
				payment = $("input[name='payment']:checked").val();
			}

			if (all_account_money == 0 && payment == 0) {
				$.toast('请选择一个支付方式');
				return;
			}
			var query = {
				'payment': payment, 
				'all_account_money': all_account_money,
				'id': order_id,
				'act': 'order_done'
			};
	        $.ajax({
				url: ORDER_AJAX,
				data:query,
				type: "POST",
				dataType: "json",
				success: function(data){
					if(data.status==1){
						if(data.app_index=='wap' ){  //SKD支付做好后，用 App.pay_sdk支付
							if(data.pay_status==1){
								$.router.load(data.jump, true);
							}else{
								location.href=data.jump;
							}
						} else if( data.app_index=='app' && data.pay_status==1){  //APP余额支付
							 $.router.load(data.jump, true);

						} else if( data.app_index=='app' && data.pay_status==0){  //APP第三方支付
							if(data.online_pay==3){
								try {

									var str = pay_sdk_json(data.sdk_code);
									App.pay_sdk(str);
								} catch (ex) {

									$.toast(ex);
									$.loadPage(location.href);
								}
							}else{
								var pay_json = '{"open_url_type":"1","url":"'+data.jump+'","title":"'+data.title+'"}';

								try {
									App.open_type(pay_json);
									$.confirm('已支付完成？', function () {
										$.loadPage(location.href);

									},function(){
										$.loadPage(location.href);

									});
								} catch (ex) {
									$.toast(ex);
									$.loadPage(location.href);
								}
							}
						}
					}else{
						
						$.alert(data.info);
					}
				},
				error:function(ajaxobj) {

				}
			});
	    });
	};
});

