<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>
		<link rel="stylesheet" href="<?php echo $this->_var['TMPL']; ?>/style5.2/css/dist/media-100.css" />
		<title>消费奖</title>
	</head>
	<body style="background-color: #eee;">
		<div class="bean_nav">
			<p><a href="<?php echo $this->_var['url']; ?>" class="back"></a>消费奖</p>
		</div>
		<div class="silver">
			<div class="silver_head">
				<div class="head_img">
					<img src="<?php echo $this->_var['user_avatar']; ?>" style="border-radius: 50%;"/>
				</div>
			</div>
			<div class="silver_money">
				<p>
					<span><?php echo $this->_var['user_info']['avalible_benefit_credits']; ?></span>
					可用的受益积分
				</p>
				<p>
					<span><?php echo $this->_var['user_info']['avalible_consume_credits']; ?></span>
					可用的消费积分
				</p>
			</div>
			<div class="silver_title">
				<p class="left">订单记录<i></i></p>
				
			</div>
			<div class="silver_con" style="margin-bottom: 0.5rem;">
				<div class="order_top">
					<div class="top_left">
						<p>消费金额: <span> <?php echo $this->_var['total_consume']; ?></span></p>
						<p>冻结消费积分: <span> <?php echo $this->_var['frozen_consume_credits']; ?></span></p>
						<!-- <p>本周受益利息: <span> <?php echo $this->_var['static_rate_str']; ?></span></p> -->
					</div>
					<div class="top_right" style="height: 2.5rem">
						<p>说明: 每周可申请受益1次，申请后根据每日利息计入冻结受益积分里，每周一转化为可用受益积分。申请释放需要结算码个数: <span><?php echo $this->_var['expend_active_code']; ?></span>(首次免费)</p>
						<a href="javascript:;">
							<!--申请受益-->
							<button class="btn" type="button" value="<?php echo $this->_var['can_get_static_reward']; ?>">申请收益</button>
							<button class="btn1 none" type="button" value="<?php echo $this->_var['can_get_static_reward']; ?>">释放</button>
						</a>
					</div>
					<div class="bottom_con" style="height: 6.5rem;overflow: hidden;padding-bottom: 1rem;background-color: #fff">
						<p><span>时间</span><span>受益</span><span>状态</span></p>
						<ul style="height: 5rem"> 
							<?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'mydata');if (count($_from)):
    foreach ($_from AS $this->_var['mydata']):
?>
							<li>
								<span><?php echo $this->_var['mydata']['c_time']; ?></span>
								<span><?php echo $this->_var['mydata']['credits']; ?></span>
								<span><?php echo $this->_var['mydata']['status']; ?></span>
							</li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
	</body>
	<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/jquery-3.2.1.min.js"></script>
	<script>
		$(".top_right a .btn").click(function(){
			$.ajax({
				url:'index.php?ctl=uc_log&act=get_static_reward',
				type:"post",
				data:'',
				dataType:"json",
				success:function(data){
					if(data.status == true){
						alert('申请成功!!!');
						$(".top_right a .btn").attr("disabled",true);
						$(".top_right a .btn").css("background-color","#ddd");
						window.location.reload();
					}
				}
			});
		})

		$(".top_right a .btn1").click(function(){
			if(<?php echo $this->_var['user_info']['active_code']; ?> < <?php echo $this->_var['expend_active_code']; ?>) {
				alert("结算码数额不足,请充值!!!");
				return false;
			}else{
				$.ajax({
					url:'index.php?ctl=uc_log&act=release_static_reward',
					type:"post",
					data:'',
					dataType:"json",
					success:function(data){
						if(data.status == true){
							alert('释放成功');
							$(".btn1").addClass("none");
							$(".btn2").removeClass("none");
							window.location.reload();
						}
					}
				});
			}
		})
		$(window).ready(function(){
			var a = $(".bottom_con ul li span:nth-child(3)");
			var btn = $(".btn").val();
			if(btn == 0){
				$(".top_right a .btn").attr("disabled",true);
				$(".top_right a .btn").css("background-color","#ddd");
			}else if(btn == 1){
				$(".top_right a .btn").attr("disabled",false);
			}else if(btn == 2){
				$(".btn1").removeClass("none");
				$(".btn").addClass("none");
			}
			var zt = $(".bottom_con ul li span:last-child");
			var sj = $(".bottom_con ul li span:first-child");
			var djz = "冻结中";
			var ysf = "已释放";
			for(var i = 0;i<zt.length;i++){
				var zts = zt.eq(i).text();
				var sjs = sj.eq(i).text()*1000;
				if(zts == 0){
					zt.eq(i).html(djz);
					zt.eq(i).css("color","#f56d06");
					
				}else if(zts == "1"){
					zt.eq(i).html(ysf);
					zt.eq(i).css("color","#219820");
				}
				var time = new Date(sjs);
				var year = time.getFullYear();
				var month = time.getMonth()+1;
				var day = time.getDate();
				var hour = time.getHours();
				var min = time.getMinutes();
				var sen = time.getSeconds();
				times = year +'-'+ getzf(month) +'-'+ getzf(day) +' '+ getzf(hour) +':'+ getzf(min) +':'+getzf(sen);
				sj.eq(i).html(times);
			}
			//补0操作
			      function getzf(num){  
			          if(parseInt(num) < 10){  
			              num = '0'+num;  
			          }  
			          return num;  
			      }
		})
	</script>
</html>
