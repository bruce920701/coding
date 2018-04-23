$(document).on("pageInit", "#dc_position", function(e, pageId, $page) {
	//左侧结果点击对象
	var cur_item = null;
	var total;
	var cur_page = 0;
	var marker_array = new Array();
	$(function(){
	
		init_search_name();
		var map = new BMap.Map("map_show");
		map.centerAndZoom(CITY_NAME,12);                   // 初始化地图,设置城市和地图级别。
		//添加点击事件监听
		map.addEventListener("click", function(e){    
		 
		 var query = {ak:BAIDU_APPKEY,location:e.point.lat+","+e.point.lng,output:"json"};
			$.ajax({
				url:"http://api.map.baidu.com/geocoder/v2/",
				dataType:"jsonp",
				callback:"callback",
				data:query,
				success:function(obj){
					var address = obj.result.formatted_address;
					var title = obj.result.sematic_description;
					var infoWindow_obj = create_window({title:title,content:address,lng:e.point.lng,lat:e.point.lat});
					map.openInfoWindow(infoWindow_obj,new BMap.Point(e.point.lng,e.point.lat)); //开启信息窗口
				}
			});
	
		});
		var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
			{"input" : "q_text"
			,"location" : map
		});
	
	
		if($.trim(dc_title)!=''){
			$('#q_text').val(dc_title);
			ac.setInputValue(dc_title);
		}
		var myValue;
		ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
			var _value = e.item.value;
			myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
	
			searchlocation(myValue,_value.city);
		});
	
		
		$('.dc_clear_history').bind('click',function(){
			$.ajax({
				url:dc_clear_history_url,
				type:"GET",
				success:function(data){
					$('.search-history').hide();
					$('.history_address').hide();
					$('#now_address').html("<p class='flex-1 address'>定位失败</p><div class='flex-box re-position'><p class='iconfont position-ico'>&#xe691;</p><p>重新定位</p></div>");
				}
			});
			return false;
		});
	
			
	
		$('.result-item').bind("click",function(){
	
			var data=$(this).attr('data-params');
			var dataset=eval("("+data+")");  //json字体串转为json对象
			url=dc_position_url;
			$.ajax({
				url:url,
				type:"POST",
				data:{'xpoint':dataset.lng,'m_longitude':dataset.lng,'ypoint':dataset.lat,'m_latitude':dataset.lat,'dc_title':dataset.title,'dc_content':dataset.content,'dc_num':dataset.dc_num,'city':dataset.city},
				success:function(data){
					if(is_vs){
						location.href=vs_url;
					}else{
						location.href=dc_url;		
					}
	
				}
			});
		});
	
	
		$('.do_search').bind('click',function(){
			var kw=$.trim($("#q_text").val());
		
			searchlocation(kw,CITY_NAME);
		});
	
			
		$('.re-position').live('click', function() {
			relocation();
		})
	});
	
	$('.history_address_d').bind('click',function(){
		var h_val = $(this).html();
		searchlocation(h_val,CITY_NAME);
	});
	
	function init_search_name(){
	
		if(typeof(dc_title)!='undefined'){
		$('#q_text').val(dc_title);
		}
	}
	
	
	function searchlocation(kw,city){
	
		cur_item = null;
		marker_array = new Array();
		var op_ak = BAIDU_APPKEY;
		if($.trim(kw)){
		var op_q=encodeURIComponent(kw);
		}
		else
		{
		var op_q = encodeURIComponent($.trim($("#q_text").val()));
		}
	
		if(op_q==''){
			alert('请输入地址搜索周边商家');
			return false;
		}
		
		var op_page_size = 1;
		var op_page_num = cur_page;
		var op_region = encodeURIComponent(city);
		var url = "http://api.map.baidu.com/place/v2/search?ak="+op_ak+"&output=json&query="+op_q+"&page_size="+op_page_size+"&page_num="+op_page_num+"&scope=1&region="+op_region;
	
		if($.trim($("#q_text").val())){
			$.ajax({
				url:url,
				dataType:"jsonp",
		        jsonp: 'callback',
				type:"GET",
				success:function(obj){
					if(obj.status == 0){			
							var item=obj.results[0];
							var query = new Object();
							query.act = "get_dc_num";
							query.dc_xpoint = item.location.lng;
							query.dc_ypoint = item.location.lat;
							query.dc_title = item.name;
							query.city = city;
							query.dc_content = item.address;
							$.ajax({
								url:DC_AJAX_URL,
								data:query,
								dataType:"json",
								type:"POST",
								success:function(objdata)
								{
					
									url=dc_position_url;
									$.ajax({
										url:url,
										type:"POST",
										dataType:"json",
										data:{'xpoint':item.location.lng,'m_longitude':item.location.lng,'ypoint':item.location.lat,'m_latitude':item.location.lat,'dc_title':item.name,'dc_content':item.address,'dc_num':objdata.dc_num,'city':city},
										success:function(obj){
	
											if(obj.status){
												if(is_vs){
													location.href=vs_url;
												}else{
													location.href=dc_url;		
												}
											}else{
												$.toast(obj.info);
											}
										
										
										}
									});
									
								
								}
							});
							
	
	
					}
				}
			});
		}	
		
	}

	function relocation() {

		var options = {timeout: 8000};
		var geolocation = new qq.maps.Geolocation(TENCENT_MAP_APPKEY, "myapp");
		geolocation.getLocation(showPosition, showErr, options);

	}
	function showPosition(p){
		has_location = 1;//定位成功;
		m_latitude = p.lat; //纬度
		m_longitude = p.lng;
		userxypoint(m_latitude, m_longitude,'GCJ02');
	}
	function showErr(p){
		//alert("定位失败");
		console.log("定位失败");
	}
//将坐标返回到服务端;
	function userxypoint(latitude,longitude,type){
		var query = new Object();
		query.m_latitude = latitude;
		query.m_longitude = longitude;
		query.m_type=type;
		//alert(latitude+":"+longitude);
		//return;
		$.ajax({
			url:geo_url,
			data:query,
			type:"post",
			dataType:"json",
			success:function(data){

				if(data.status==1)
				{
					if(is_vs){
						location.href=vs_url;
					}else{
						location.href=dc_url;		
					}

				}
				else
				{
					alert(data.info);
				}
			}
			,error:function(){
			}
		});
	}
});


			