$(function(){
	//初始化地图
	ini_map();
	//上传控件
	$(".preview_upbtn div.preview_btn").ui_upload({multi:false,FilesAdded:function(files){
		//选择文件后判断
		if($(".preview_upload_box").find("span").length+files.length>1)
		{
			$.showErr("最多只能传1张图片");
			return false;
		}
		else
		{
			for(i=0;i<files.length;i++)
			{
				var html = '<span><div class="loader"></div></span>';
				var dom = $(html);		
				$(".preview_upload_box").append(dom);	
			}
			uploading = true;
			return true;
		}
	},FileUploaded:function(responseObject){
		if(responseObject.error==0)
		{
			var first_loader = $(".preview_upload_box").find("span div.loader:first");
			var box = first_loader.parent();
			first_loader.remove();
			var html = '<a href="javascript:void(0);"></a>'+
			'<img src="'+responseObject.web_40+'" />'+
			'<input type="hidden" name="h_other_license" value="'+responseObject.url+'" />';
			$(box).html(html);
			$(box).find("a").bind("click",function(){
				$(this).parent().remove();
			});
		}
		else
		{
			$.showErr(responseObject.message);
		}
	},UploadComplete:function(files){
		//全部上传完成
		uploading = false;
	},Error:function(errObject){
		$.showErr(errObject.message);
	}});
	/*发布*/
	$("form[name='supplier_save']").submit(function(){
		
		var form = $("form[name='supplier_save']");
		$(".sub_form_btn").html('<button class="ui-button" rel="disabled" type="button">保存</button>');
		init_ui_button();
		var query = $(form).serialize();
		var url = $(form).attr("action");
		$.ajax({
			url:url,
			data:query,
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 0){
					$(".sub_form_btn").html('<button class="ui-button " rel="orange" type="submit">确认提交</button>');
					init_ui_button();
					$.showErr(data.info);
				}else if(data.status==1){
					$.showSuccess(data.info,function(){window.location = location.href;});
				}
				return false;
			}
		});
		
		return false;
	});
});
/*地图初始化*/
function ini_map()
{
	var xpoint ='119.3';
	var ypoint ='26.1';
	if($("input[name='xpoint']").val()){
		 xpoint = $("input[name='xpoint']").val();
	}
	
	if($("input[name='ypoint']").val()){
		 ypoint = $("input[name='ypoint']").val();
	}
	draw_map(xpoint,ypoint);	
	$("#search_api").bind("click", function() {
		var api_address = $("input[name='api_address']").val();		
		var city = $(".selected_city span").html();
	    if($.trim(api_address) == '') {
			$.showErr("请先输入地址");
		} else {
			search_api(api_address,city);
		}
	});
	
	$("#container_front").hide();
	$("#cancel_btn").bind("click", function() {
		$("#container_front").hide();
	});
	$("#chang_api").bind("click", function() {
		if($("input[name='xpoint']").val()){
			 xpoint = $("input[name='xpoint']").val();
		}
		
		if($("input[name='ypoint']").val()){
			 ypoint = $("input[name='ypoint']").val();
		}
		editMap(xpoint, ypoint);
	});		
}