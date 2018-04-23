/**
 * 上门服务
 */
$(document).ready(function(){
	$(".deal_box").css('display','block');
	
	$(".first_cate li").first().addClass('active');
	var first_cate_id = $(".first_cate li.active").attr('data_id');
	syn_second_cate(first_cate_id);	
	$(".second_cate li").live('click',function(){

		$(this).addClass('active').siblings().removeClass('active');
	});

	$(".first_cate li").click(function(){
		if(!$(this).hasClass('active')){
			$(this).addClass('active').siblings().removeClass('active');
			var first_cate_id = $(".first_cate li.active").attr('data_id');
			syn_second_cate(first_cate_id);
		}

	});
	
	init_next_button();
	cate_del_hide_show();
	init_user_discount();
	
	$(".add_cate").click(function(){
		
		var first_cate = $(".first_cate").find("li.active").text();
		var second_cate = $(".second_cate").find("li.active").text();
		var first_cate_id = $(".first_cate").find("li.active").attr('data_id');
		var second_cate_id = $(".second_cate").find("li.active").attr('data_id');
		
		if(first_cate==''){
			alert('请选择一级分类');
			return false;
		}
	   
		var delete_button = '<span class="selected_cate_delete">删除</span>'

		var selected_shop_cate_id = $(".selected_shop_cate input[name='cate_id']").val();
		var selected_shop_cate_arr=selected_shop_cate_id.split(',');
	    var second_shop_cate_id_str = '';
	    
		if(second_cate==''){
			second_cate_id=first_cate_id;			
		}else{
			second_cate = " > " + second_cate
		}
		
		if(selected_shop_cate_id!=''){

			if($.inArray(second_cate_id,selected_shop_cate_arr) ==-1){
				selected_shop_cate_arr.push(second_cate_id);
				second_shop_cate_id_str = selected_shop_cate_arr.join(',');
			}else{
				alert('该分类已添加');
				return false;
			}
			
		}else{
			second_shop_cate_id_str = second_cate_id;
		}


		
		var select_cate_str='<div class="select_item shop_id" data_id="'+second_cate_id+'">' + first_cate + second_cate + delete_button +'</div>';
		var select_cate_str_two='<div class="select_item" data_id="'+second_cate_id+'">' + first_cate + second_cate +'</div>';
			
		$(".selected_shop_cate").append(select_cate_str).find("input[name='cate_id']").val(second_shop_cate_id_str);
		
		$(".selected_shop_cate_two").append(select_cate_str_two);
		init_next_button();
		
	});
	
	$(".selected_cate_delete").live('click',function(){

		var index = $(this).parents('.selected_shop_cate').find(".select_item").index($(this).parents('.select_item'));
		$(this).parents('.select_item').remove();
		$(".selected_shop_cate_two").find(".select_item").eq(index).remove();
		cate_del_hide_show();
		syn_shop_cate();
		init_next_button();

	});
	
	$(".go_first_step").click(function(){
		
		$(".shop_box_one").show();
		$(".shop_box_two").hide();
	});
	
	$(".go_next_step").live('click',function(){
		
		var selected_tuan_cate_id = $(".selected_shop_cate input[name='cate_id']").val();
		var selected_second_tuan_cate_id = $(".selected_shop_cate input[name='second_cate_id']").val();
		
		if(selected_tuan_cate_id=='' && selected_second_tuan_cate_id==''){
			alert('请选择分类');
			return false;
		}
		
		$(".shop_box_one").hide();
		$(".shop_box_two").show();
	});
	
	$("input[name='allow_user_discount']").click(function(){
		init_user_discount();
	});
	
	$("input[name='current_price']").bind('keyup',function(){
		init_balance_price();
		set_price_profit($(this));
		get_user_discount_price();
	});
	
	$("input[name='service_balance_rate']").live('keyup',function(){
		init_balance_price();
		set_price_profit();
		
	});
	
});

function init_user_discount(){
	get_user_discount_price();
	if($("input[name='allow_user_discount']").is(':checked')){
		$(".user_discount").show();
	}else{
		$(".user_discount").hide();
	}
}

function get_user_discount_price(){
	user_group_json = $.parseJSON(user_group);
	var current_price = parseFloat($("input[name='current_price']").val());
	
	var user_discount_str = '';
	if(isNaN(current_price)){
		current_price=0;
	}
	for(var i in user_group_json){
		var obj = user_group_json[i];		
		var discount_price=(current_price * obj.discount).toFixed(2);
		user_discount_str+='<div class="user_discount_row"><div class="user_discount_name">'+obj.name+'</div><div class="user_discount_price">'+discount_price+'</div></div>';

	}	
	$(".user_discount .row_right .user_discount_box").html(user_discount_str);
}

function init_next_button(){
	var cate_id = $("input[name='cate_id']").val();
	var second_cate_id = $("input[name='second_cate_id']").val();
	if(cate_id=='' && second_cate_id==''){
		$(".go_next_step").addClass('go_next_step_disable').removeClass('go_next_step');
	}else{
		$(".go_next_step_disable").addClass('go_next_step').removeClass('go_next_step_disable');
	}
}

function syn_second_cate(first_cate_id){
	var query = new Object();
	query.cate_id = first_cate_id;
	query.ajax = 1;
	$.ajax({ 
		url: ROOT+"?"+VAR_MODULE+"=CommonService&"+VAR_ACTION+"=syn_second_cate", 
		data: query,
		type: "POST",
		success: function(obj){
			$(".second_cate").html(obj);
		}
	});
	
}

function cate_del_hide_show(){
	$(".select_item.tuan_first_id span.selected_cate_delete").show();
	$(".select_item.tuan_first_id").each(function(){
		//$(".select_item.tuan_second_id[pid='"+$(this).attr("data_id")+"']").hide();
		if($(".select_item.tuan_second_id[pid='"+$(this).attr("data_id")+"']").length>0){
			$(this).find("span.selected_cate_delete").hide();
		}
	});
}

function syn_shop_cate(){

	var selected_shop_cate_arr = new Array();
	
	$(".selected_shop_cate .select_item").each(function(i,obj){
		
		var shop_cate_id = $(obj).attr("data_id");
		
		selected_shop_cate_arr.push(shop_cate_id);
			
	});  
   var shop_cate_id_str = selected_shop_cate_arr.join(',');
    
   $(".selected_shop_cate").find("input[name='cate_id']").val(shop_cate_id_str);
}

function set_price_profit(obj){
	var origin_price = parseFloat($("input[name='origin_price']").val());

	
	var publish_verify_balance = $("input[name='service_balance_rate']").val();
	var current_price = $("input[name='current_price']").val();
	if(isNaN(current_price)){
		current_price=0;
	}
	if(isNaN(publish_verify_balance)){
		publish_verify_balance=0;
	}		
	var balance_price = publish_verify_balance * current_price / 100;
	
	var current_price = parseFloat($("input[name='current_price']").val());
		
	if(obj){
		var price = $(obj).val();
		
		if(isNaN(price)){
			if(isNaN(current_price) || isNaN(balance_price)){
				var price_profit_precentage = '0.00%';
				var price_profit = '0.00';
			}
			var error_tip='请填写有效价格';

		}else if(price==0){
			if(current_price==0 || balance_price==0){
				var price_profit_precentage = '0.00%';
				var price_profit = '0.00';
			}
			var error_tip='请填写有效价格';
		}else{


			if(isNaN(current_price) || isNaN(balance_price)){
				var price_profit_precentage = '0.00%';
				var price_profit = '0.00';
			}else{
				var price_profit_precentage =( ( current_price - balance_price ) / current_price * 100 ).toFixed(2) + '%';
				var price_profit = ( current_price - balance_price ).toFixed(2);
			}
			var error_tip='';
		}
		show_error_tip(obj,error_tip);
		
	}else{ 

		if(isNaN(current_price) || isNaN(balance_price) || isNaN(origin_price)){
		
			if(isNaN(current_price) || isNaN(balance_price)){
				var price_profit_precentage = '0.00%';
				var price_profit = '0.00';
			}

			var error_tip='请填写有效价格';
		}else if(current_price==0 || balance_price==0 || origin_price==0){
			
			if(current_price==0 || balance_price==0){
				var price_profit_precentage = '0.00%';
				var price_profit = '0.00';
			}
			var error_tip='请填写有效价格';
		}else{
			var price_profit_precentage =( ( current_price - balance_price ) / current_price * 100 ).toFixed(2) + '%';
			var price_profit = ( current_price - balance_price ).toFixed(2);
			var error_tip='';
		}
		show_error_tip($("input[name='current_price']"),error_tip);
	}
	$(".price_profit_precentage").html(price_profit_precentage);
	$(".price_profit").html(price_profit);

}

function init_balance_price(){
	
	var publish_verify_balance = $("input[name='service_balance_rate']").val();
	var current_price = $("input[name='current_price']").val();
	if(isNaN(current_price)){
		current_price=0;
	}
	if(isNaN(publish_verify_balance)){
		publish_verify_balance=0;
	}
	
	var balance_price = (publish_verify_balance * current_price / 100).toFixed(2);
	$("input[name='balance_price']").attr('readonly',true).val(balance_price);
}

function show_error_tip(obj,error_tip){

	if(error_tip){
		
		var error_row = '<div class="error_row">'+error_tip+'</div>';
		var len = $(obj).parents(".info_row .row_right").find(".error_row").length ;
		if(len==0){
			$(obj).parents(".info_row .row_right").append(error_row);
		}else{
			$(obj).parents(".info_row .row_right .error_row").replaceWith(error_row);
		}
		
	}else{
		$(obj).parents(".info_row .row_right").find(".error_row").remove();
	}

}
