
function add_service_time() {
	/*var html = '<div class="service_time_item"><input type="text" name="visit_service_time[]" placeholder="服务时间">&nbsp;&nbsp;<input type="number" name="visit_service_number[]">&nbsp;<a href="javascript:void(0);" onclick="add_service_time()">+</a>&nbsp;<a href="javascript:void" onclick="remove_service_time(this)">-</a></div>';
	$(".service_time_box").append(html);*/
	// 增加一个字段判断是否有新增
	$.ajax({ 
		url: ROOT+"?"+VAR_MODULE+"="+MODULE_NAME+"&"+VAR_ACTION+"=add_service_time", 
		data: "ajax=1",
		type: "POST",
		success: function(obj){
			$(".service_time_box").append(obj);
		}
	});
}

function remove_service_time(o) {
	$(o).parent().remove();
}

function service_list() {
		var query =  $("form[name='seach_form']").serialize();
		$.ajax({ 
			url: ROOT+"?"+VAR_MODULE+"="+MODULE_NAME+"&"+VAR_ACTION+"=service_list", 
			data: query,
			success: function(obj){
				$(".list_table_box").html(obj);
			}
		});
}



function add_service_box() {
	// 先判断是否选择了商家
	var supplier_id = $('input[name="supplier_id"]').val();
	if (!supplier_id) {
		var supplier_id = $("select[name='supplier_id']").val();
	}
	supplier_id = Number(supplier_id);
	if (!supplier_id) {
		alert('请选择一个商家');
		return;
	}

	var service_type = $('input[name="service_type"]:checked').val();
	
	var url = ROOT+'?m=SupplierVisitingServices&a=service_box&supplier_id='+supplier_id+'&stype='+service_type;
	var box = $.weeboxs.open(url, {
		contentType:'ajax',
		showButton:true,
		title:'添加服务',
		width:750,
		height:360,
		position: 'center',
		onopen:function(){
			$("form[name='seach_form']").submit(function(e){
				service_list();
				return false;
			});
			service_list();
		},
		onok:function(){
			
			var idLen = $('input[name="key"]:checked').length;
			if (idLen == 0) {
					alert('至少选择一个服务');
					return false;
				}
			if (service_type == 1 && idLen > 1) {
				alert('自定义服务一次只能添加一个');
				return false;
			}
			var html = '';
			$(".key").each(function(i){
				if($(this).attr("checked")==true){
					var id = $(this).val();
					var name = $(this).parents('tr').find('td:last').html();
					html += '<div class="service-item"><input type="hidden" name="service_id[]" value='+id+'>'+'<span>'+name+'</span><a onclick="remove_service_time(this);">[-]</a></div>';
				}
			});
			$('.service-box').html(html);
			box.close();
			return false;
			},
		}
	);
}

function location_list(sid) {
	if (!sid) {
		var sid = $("select[name='supplier_id']").val();	
	}
	if(Number(sid)<=0) {
		$("#location_list").html('');
		return;
	} else {
		var svsid = $('input[name="id"]').val();
		$.ajax({ 
			url: ROOT+"?"+VAR_MODULE+"=Supplier&"+VAR_ACTION+"=location_service_list&svsid="+svsid, 
			data: "ajax=1&supplier_id="+sid,
			type: "GET",
			dataType: "json",
			success: function(obj){
				$("#location_list").html(obj.data);
			}
		});
	}
}

$(document).ready(function(){

	// $('select=[name="is_visiting_service"]').bind('change', function() {
	// 	if ($(this).val() == 1) {
	// 		$('.service-box').show();
	// 	} else {
	// 		$('.service-box').hide();
	// 	}
	// });

	$("input[name='supplier_key_btn']").bind("click",function(){
		search_supplier();
	});
	
	$("select[name='supplier_id']").live("change",function(){
		location_list();
	});

	if (typeof supplier_id != 'undefined') {
		location_list(supplier_id);
	}

	$('.add_service').bind('click', function() {
		var url = $(this).attr('data-url');
		location.href = url;
	});

	$('.down_line').bind('click', function() {
		var idBox = $(".key:checked");
		if (idBox.length == 0) {
			alert('请选择要下架的服务');
			return;
		}
		var idArr = [];
		$.each(idBox, function(_, elm) {
			idArr.push($(elm).val());
		});
		ids = idArr.join(',');
		if (confirm('确认下架？')) {
			$.ajax({
				url: ROOT+"?"+VAR_MODULE+"="+MODULE_NAME+"&"+VAR_ACTION+"=do_downline&id="+ids,
        data: "ajax=1",
        dataType: "json",
        success: function(obj){
          $("#info").html(obj.info);
          if(obj.status==1) {
            location.href=location.href;
          }
        } 
			});
		}
	});

	$('.up_line').bind('click', function() {
		var idBox = $(".key:checked");
		if (idBox.length == 0) {
			alert('请选择要上架的服务');
			return;
		}
		var idArr = [];
		$.each(idBox, function(_, elm) {
			idArr.push($(elm).val());
		});
		ids = idArr.join(',');
		if (confirm('确认上架？')) {
			$.ajax({
				url: ROOT+"?"+VAR_MODULE+"="+MODULE_NAME+"&"+VAR_ACTION+"=do_upline&id="+ids,
        data: "ajax=1",
        dataType: "json",
        success: function(obj){
          $("#info").html(obj.info);
          if(obj.status==1) {
            location.href=location.href;
          }
        } 
			});
		}
	});

	$('select[name="p_cate_id"]').live('change', function() {
		var cate_html = '<option value="0">请选择服务子类</option>';
		if ($(this).val() > 0) {
			$.ajax({
				url: ROOT+"?"+VAR_MODULE+"="+MODULE_NAME+"&"+VAR_ACTION+"=service_cate&pid="+$(this).val(),
				dataType: "json",
				success: function(obj) {
					if (obj.data) {
						for (var i in obj.data) {
							cate_html += '<option value='+obj.data[i].id+'>'+obj.data[i].name+'</option>';

							console.log(cate_html);
						}
					} else {
						cate_html += '<option value=0>没有更多分类</option>';
					}
					$('select[name="cate_id"]').html(cate_html);
				}
			});
		} else {
			$('select[name="cate_id"]').html(cate_html);
		}
	})

	$(".go_first_step").click(function(){
		location_list(supplier_id);
	});

	$('.add_service_box').bind('click', function() {
		add_service_box();
	});
});