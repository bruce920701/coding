<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>
		<link rel="stylesheet" href="<?php echo $this->_var['TMPL']; ?>/style5.2/css/dist/media-100.css" />
		<title>奖金明细</title>
	</head>
	<body>
		<div class="bean_nav">
			<p><a href="<?php echo $this->_var['url']; ?>" class="back"></a>奖金明细</p>
		</div>
		<div class="bean_tit_a">
			<p class="zhd" style="padding-top: 30px;font-size: 0.3rem;">总获得:<span><?php echo $this->_var['total_direct_reward']; ?></span><span class="none"><?php echo $this->_var['total_leader_reward']; ?></span></p>
			<p style="font-size: 0.3rem;"></p>
			<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/jj.png"/>
		</div>
		<div class="clear"></div>
		<div class="bonus_contant">
			<div class="head_a">
				<p class="head_active">直推奖</p>
				<p>领导奖</p>
			</div>
			<div class="jlmx">
				<div>
					<p>
						<span>获奖时间</span>
						<span>获得奖励</span>
						<span>状态</span>
						<span>详情</span>
					</p>
					<ul>
						<?php $_from = $this->_var['direct_reward_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'counts');if (count($_from)):
    foreach ($_from AS $this->_var['counts']):
?>
						<li>
							<span><?php echo $this->_var['counts']['c_time']; ?></span>
							<span><?php echo $this->_var['counts']['credits']; ?></span>
							<span><?php echo $this->_var['counts']['status']; ?></span>
							<span><?php echo $this->_var['counts']['msg']; ?></span>
						</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
				</div>
				<div class="none">
					<p>
						<span>获奖时间</span>
						<span>获得奖励</span>
						<span>状态</span>
						<span>详情</span>
					</p>
					<ul>
						<?php $_from = $this->_var['leader_reward_detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'coun');if (count($_from)):
    foreach ($_from AS $this->_var['coun']):
?>
						<li>
							<span><?php echo $this->_var['coun']['c_time']; ?></span>
							<span><?php echo $this->_var['coun']['credits']; ?></span>
							<span><?php echo $this->_var['coun']['status']; ?></span>
							<span><?php echo $this->_var['coun']['msg']; ?></span>
						</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
				</div>
			</div>
				
		</div>
	</body>
	<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/jquery-3.2.1.min.js"></script>
	<script>
		$(".bonus_contant>.head_a>p").click(function(){
			$(this).addClass("head_active").siblings().removeClass("head_active");
			var i = $(this).index();
			$(".jlmx>div").eq(i).removeClass("none").siblings().addClass("none");
			$(".zhd span").eq(i).removeClass("none").siblings().addClass("none");
		})
		$(window).ready(function(){
			var a = $(".jlmx ul li span:nth-child(3)");
			var c = $(".jlmx ul li span:nth-child(1)");
			for(var j=0;j<a.length;j++){
				var b = a.eq(j).text();
				var d = c.eq(j).text();
				if(b == 0){
				a.eq(j).css("color","#ff7e00");
				a.eq(j).text('冻结中');
				}else if(b == 1){
					a.eq(j).css("color","#038e00");
					a.eq(j).text('已释放');
				}
				var Times = new Date(d*1000);
				var Year = Times.getFullYear();
				var Month = Times.getMonth()+1;
				var Day = Times.getDate();
				var Hour = Times.getHours();
				var Min = Times.getMinutes();
				var Sen = Times.getSeconds();
				Times = Year +'-'+ getzf(Month) +'-'+ getzf(Day) +' '+ getzf(Hour) +':'+ getzf(Min) +':'+getzf(Sen);
				c.eq(j).html(Times)
//			        //补0操作
		      function getzf(num){  
		          if(parseInt(num) < 10){  
		              num = '0'+num;  
		          }  
		          return num;  
				 }
			}
			
		})
	</script>
</html>