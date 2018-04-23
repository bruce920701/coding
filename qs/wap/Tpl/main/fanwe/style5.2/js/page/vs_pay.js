/**
 * Created by Administrator on 2016/9/7.
 */

$(document).on("pageInit", "#vs_pay", function(e, pageId, $page) {
	count_order_total_change();
	count_order_total();
	function count_order_total_change(){

		var payment_id = $("input[name='payment']:checked").val();
		if (typeof payment_id == 'undefined') {
			if ($('.m-my-conut').length != 0) {
				$("input[name='payment']").prop("checked",false);
				$('.m-my-conut').find('input').prop('checked', true);
			}
		}

		$(".payment").unbind("click");
		$(".payment").bind("click",function(){
			$("input[name='payment']").prop("checked",false);
			$(this).siblings("input[name='payment']").prop("checked",true);
			count_order_total();
		});
		$(".j_pay_button").unbind("click");
		$(".j_pay_button").bind("click",function(){
			submit_order($(this));
		});
	}
	function count_order_total() {
		$('.fee-box').addClass('hide');
		var paymentElm = $('input[name="payment"]:checked').parents('.pay_line');
		var payFee = Number($(paymentElm).find('.payment_fee').html());
		payFee = Math.round(payFee * 100) / 100;
		if (payFee > 0) {
			$('.fee-box').find('i').html(format_fee(payFee));
			$('.fee-box').removeClass('hide');
		}
	}
	function format_fee(fee) {
		var intPart = Math.floor(fee);
		var decimalsPart = fee - intPart;
		decimalsPartToStr = (decimalsPart * 100 + 100).toString();
		return intPart + '.' + decimalsPartToStr.slice(1);
	}
	function submit_order(obj) {
		$(obj).removeClass('j_pay_button');
		var query = new Object();
		//支付方式
		var payment = $("input[name='payment']:checked").val();
		if(!payment) {
			payment = 0;
		}
		query.payment = payment;
		query.id = order_id;
		query.act = "do_pay";
		$.ajax({
			url: CART_URL,
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
								$(obj).addClass('j_pay_button');
							} catch (ex) {

								$.toast(ex);
								$.loadPage(location.href);
							}
						}else if(data.online_pay==2){
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
				}else if(data.status==0){
					$.alert(data.info);
					$(obj).addClass('j_pay_button');
				}else{
					$(obj).addClass('j_pay_button');
				}
			},
			error:function(ajaxobj) {
				$(obj).addClass('j_pay_button');
			}
		});
	}
});

