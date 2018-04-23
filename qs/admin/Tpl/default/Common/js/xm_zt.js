$(document).ready(function(){



	$(".add_row").bind('click',function(){
		set_zt_html();
	});
	$(".delete_row").live('click',function(){
		$(this).parents(".zt_big_box").remove();
		init_zt_key();
	});
	$(".delete_one").live('click',function(){
		var p_length = $(this).parents(".x_box").find('.xzt_link').length;		 		
		p_length = p_length -1;
		var width = (100/p_length).toFixed(2)+'%';	
		$(this).parents(".xzt_link").siblings('.xzt_link').find('.x_img_box').css('width',width);
		if(p_length==0){
			$(this).parents(".x_box").find('.delete_row').remove();
		}
		$(this).parents(".xzt_link").remove();
		init_zt_key();
	});
	
		
	$(".x_img_box > img").live("click",function(){
		
		var zt_img = $(this).attr('class');
		var zt_img_pic = $(this).attr('src');
		var mobile_type = $("#mobileTypeSelect").val();
		var type=$(this).siblings("input[name='type']").val();
		var ctl_name=$(this).siblings("input[name='ctl_name']").val();
		var ctl_value=$(this).siblings("input[name='ctl_value']").val();
		
		open_xzt_box(zt_img,mobile_type,type,ctl_name,ctl_value,zt_img_pic);
	});
	
	init_zt_key();
	init_zt_data();
});

function set_zt_html(){

	var pic_count =parseInt( $("input[name='pic_count']").val());
	if(pic_count > 6){
		alert('最后六张图片！');
		return false;
	}

	if(pic_count==0 || isNaN(pic_count)){
		alert('请正确输入图片个数！');
		return false;
	}
	$.ajax({
		url: ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "=set_zt_html&zt_id="+zt_id+"&pic_count="+pic_count,
		type: "POST",
		success: function (html) {
				$("#preview").append(html);
				init_zt_key();

			}
	});

}


function open_xzt_box(zt_img,mobile_type,type,ctl_name,ctl_value,zt_img_pic){

	var url= ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "=iframe_box&zt_img="+zt_img+'&mobile_type='+mobile_type+"&type="+type+"&ctl_name="+ctl_name+"&ctl_value="+ctl_value+"&zt_img_pic="+zt_img_pic;
	var query = new Object();
	query.ajax = 1;
	$.ajax({
		url:url,
		type: "POST",
		success:function(html){
				$.weeboxs.open(html, {boxid:"open_zt_box",contentType:'text',showButton:false,title:"图片上传",width:530,onopen:function(){

				},onok:function(){


				}});



		}
	});
}

function init_zt_key(){
	$(".zt_big_box .x_box").each(function(i,iobj){
		$(iobj).find(".x_img_box").each(function(j,jobj){
			var key = i+"_"+j;
			$(this).parents('.xzt_link').attr('key',key);
			$(this).find("img:first").attr('class',key);
			
		});
		
	});
	
	
	
	init_zt_html();
}

function init_zt_html(){

	var zt_clone = $("#preview").clone();
	$(zt_clone).find('.delete_one').remove();
	$(zt_clone).find('.delete_row').remove();
	$(zt_clone).find("input[name='type']").remove();
	$(zt_clone).find("input[name='ctl_name']").remove();
	$(zt_clone).find("input[name='ctl_value']").remove();
	var zt_html = $(zt_clone).html();
	$("input[name='zt_html']").val(zt_html);
}

function init_zt_data(){
	
	var delete_row = '<div class="delete_row">[ - ]</div>';
	var delete_one = '<span class="delete_one"><img src="./admin/Tpl/default/Common/images/delete_icon.png"></span>';
	$(".x_box").each(function(i,obj){
		$(this).append(delete_row);
	});
	var type;
	var ctl_name;
	var ctl_value;
	var type_row;
	var ctl_name_row;
	var ctl_value_row;
	var data_unit;

	$(".xzt_link").each(function(i,obj){
		var key = $(this).attr('key');
		var x_img_box = $(this).find('.x_img_box');
		$(x_img_box).append(delete_one);
		if(isNull(data_zt)){
			type='';
			ctl_name='';
			ctl_value='';
		}else{
			data_unit= data_zt[key];
	
			if(typeof(data_unit) == "undefined"){
				type='';
				ctl_name='';
				ctl_value='';
			}else{
				type=data_unit['type'];
				ctl_name=data_unit['ctl_name'];
				ctl_value=data_unit['ctl_value'];
			}
		}
		type_row = '<input type="hidden" name="type" value="'+type+'">';
		ctl_name_row = '<input type="hidden" name="ctl_name" value="'+ctl_name+'">';
		ctl_value_row = '<input type="hidden" name="ctl_value" value="'+ctl_value+'">';
		$(x_img_box).append(type_row);
		$(x_img_box).append(ctl_name_row);
		$(x_img_box).append(ctl_value_row);
	});
	
	
}

function isNull(arg1)
{
 return !arg1 && arg1!==0 && typeof arg1!=="boolean"?true:false;
}