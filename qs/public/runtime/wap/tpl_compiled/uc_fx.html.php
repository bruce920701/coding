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
			<p><a href="javascript:history.go(-1);" class="back"></a>奖金明细</p>
		</div>
		<div class="bean_tit_a">
			<p style="font-size: 0.3rem;">总获得:<span><?php echo $this->_var['total_direct_reward']; ?></span><span class="none"><?php echo $this->_var['total_leader_reward']; ?></span></p>
			<!--<p style="font-size: 0.3rem;"><span></span></p>-->
			<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/jj.png"/>
		</div>
		<div class="clear"></div>
		<div class="bonus_contant">
			<div class="head_a">
				<p class="head_active">直推奖</p>
				<p>管理奖</p>
			</div>
			<div class="contant_a">
				<div class="my_bean">
					<ul class="ztj">
						<li>
							<span>获奖时间</span>
							<span>获得奖励</span>
							<span>状态</span>
							<span>详情</span>
						</li>
						<?php $_from = $this->_var['$direct_reward_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'mydata1');if (count($_from)):
    foreach ($_from AS $this->_var['mydata1']):
?>
						<li>
							<span><?php echo $this->_var['mydata1']['c_time']; ?></span>
							<span><?php echo $this->_var['mydata1']['credits']; ?></span>
							<span><?php echo $this->_var['mydata1']['status']; ?></span>
							<span><?php echo $this->_var['mydata1']['msg']; ?></span>
						</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
					<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/none.png"/>
					<p>暂无数据</p>
				</div>
				<div class="my_bean guanli none">
					<ul class="glj">
						<li>
							<span>获奖时间</span>
							<span>获得奖励</span>
							<span>状态</span>
							<span>详情</span>
						</li>
						<?php $_from = $this->_var['leader_reward_detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'mydata2');if (count($_from)):
    foreach ($_from AS $this->_var['mydata2']):
?>
						<li>
							<span><?php echo $this->_var['mydata2']['c_time']; ?></span>
							<span><?php echo $this->_var['mydata2']['credits']; ?></span>
							<span><?php echo $this->_var['mydata2']['status']; ?></span>
							<span><?php echo $this->_var['mydata2']['msg']; ?></span>
						</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
					<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/none.png"/>
					<p>暂无数据</p>
				</div>
				
		</div>
	</body>
	<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/jquery-3.2.1.min.js"></script>
	<script>
		$(".bonus_contant>.head_a>p").click(function(){
			$(this).addClass("head_active").siblings().removeClass("head_active");
			var i = $(this).index();
			$(".bonus_contant>.contant_a>div").eq(i).removeClass("none").siblings().addClass("none");
			$(".bean_tit_a>p>span").eq(i).removeClass("none").siblings().addClass("none");
		})
		$(window).ready(function(){
			var a = $("div ul li p:nth-child(3)");
			var sj = $("div ul li p:nth-child(1)");
			for(var j=0;j<a.length;j++){
				var b = a.eq(j).text();
				var sjs = sj.eq(j).text();
				if(b == 1){
					a.eq(j).text("已释放");
					a.eq(j).css("color","#038e00");
				}else if(b == 0){
					a.eq(j).text("冻结中");
					a.eq(j).css("color","#ff7e00");
				}
				var Times = new Date(sjs*1000);
				var Year = Times.getFullYear();
				var Month = Times.getMonth()+1;
				var Day = Times.getDate();
				var Hour = Times.getHours();
				var Min = Times.getMinutes();
				var Sen = Times.getSeconds();
				Times = Year +'-'+ getzf(Month) +'-'+ getzf(Day) +' '+ getzf(Hour) +':'+ getzf(Min) +':'+getzf(Sen);
				sj.eq(j).html(Times)
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
