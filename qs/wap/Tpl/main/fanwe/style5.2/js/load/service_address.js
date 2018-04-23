/**
 * Created by Administrator on 2016/9/8.
 */
$("#order_address").on("click",".load_page",function(){
	load_page($(this));
});

$("#order_address").on("click",".load_page2",function(){
    load_page2($(this));
});
	
$("#order_address").on('click','.confirm-address', function () {
    var _this=$(this);
    var address_id=$(this).attr("data-id");
    var order_address=$("#pay_box").find("input[name='address_id']").val();
    $.confirm('确定要删除该地址吗？', function () {
    	if(address_id==order_address){
    		$.alert("正在使用的地址无法删除");
    	}else{
        	$.ajax({
				url: _this.attr('del_url'),
				data: {},
				dataType: "json",
				type: "post",
				success: function(obj){
					if(obj.status == 1){
						_this.parents("li").remove();
					}else{
						$.alert(obj.info);
					}
				},
        	});
    	}
    });
});


$("#order_address").on("change",".j-address-set input[type=radio]",function () {
    if($(this).prop('checked')==true){

		var vobj=$(this);
    	$.ajax({
			url: $(this).attr('dfurl'),
			data: {},
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status == 1){
					vobj.parents(".j-address-set").find(".u-set-default").addClass("j-address-color");
					vobj.parents("li").siblings("li").find(".u-set-default").removeClass("j-address-color");
				}else{
					$.toast("失败");
				}
			},
    	});
        
    }
});

$("#order_address").on("click",".address",function(){
	var is_default=$(this).parent().parent().attr("is_default");
	var id=$(this).attr("data-id");
	var url=$(this).attr("url");
	$(".page-current").remove();
	$(".page").last().addClass('page-current');
	$.ajax({
        url:url,
        type:"POST",
        success:function(data){
        	$(".page-current").find(".content").html($(data).find(".content").html());
        	$(".page-current").find(".popup-box .j-trans-way").html($(data).find(".popup-box .j-trans-way").html());
        	$(".page-current").find(".popup-box .j-red-reward").html($(data).find(".popup-box .j-red-reward").html());
        }
    });
});
