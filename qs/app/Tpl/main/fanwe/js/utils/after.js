//报单奖励
				
				$(window).ready(function(){
					var dianji = $("#.data_e button").val();
					if(dianji == 0){
						$("#.data_e button").attr("disabled",true);
					}else{
						$("#.data_e button").attr("disabled",false);
					}
					//状态颜色
					var zt = $(".mx_a div li span:last-child");
					var djz = "冻结中";
					var ysf = "已释放";
					for(var i = 0;i<zt.length;i++){
						var zts = zt.eq(i).text();
						if(zts == "0"){
							zt.eq(i).html(djz);
							zt.eq(i).css("color","#f56d06");
							
						}else if(zts == "1"){
							zt.eq(i).html(ysf);
							zt.eq(i).css("color","#219820");
						}
					}
					//转换时间格式
					var sj = $(".mx_a div li span:first-child");
					for(var j = 0;j<sj.length;j++){
						var time = new Date({$count.c_time}*1000);
						var year = time.getFullYear();
						var month = time.getMonth()+1;
						var day = time.getDate();
						var hour = time.getHours();
						var min = time.getMinutes();
						var sen = time.getSeconds();
						times = year +'-'+ getzf(month) +'-'+ getzf(day) +' '+ getzf(hour) +':'+ getzf(min) +':'+getzf(sen);
						sj.eq(j).html(times)
//						alert(times)
					}
//			        //补0操作
			      function getzf(num){  
			          if(parseInt(num) < 10){  
			              num = '0'+num;  
			          }  
			          return num;  
			      }
				});
				