<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>我的角色</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		
		<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['TMPL']; ?>/style5.2/css/dist/media-100.css"/>
		<link rel="stylesheet" href="<?php echo $this->_var['TMPL']; ?>/style5.2/css/dist/my_role.css" />
		<link href="<?php echo $this->_var['TMPL']; ?>/style5.2/css/dist/main.css" rel="stylesheet"/>
		<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/jquery-3.2.1.min.js"></script>
		<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/hammer.min.js"></script>
		<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/hammer.jquery.min.js"></script>
		<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/itemslide.min.js"></script>
		<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/sliding.js"></script>
	
	</head>
	<style>
		
		.abc{
			transform: none !important;
		}
	</style>
	<body>
		<div class="nav_top">
			<p><a href="<?php echo $this->_var['url']; ?>"><i></i></a>我的角色</p>
		</div>
		<!--<div class="nav">
			<div class="nav_a">
				<div class="nav_head">
					
					<img src="images/nav_b.png"/>
				</div>
				<div class="nav_tit">
					<p class="id"><span>ID:</span>2017</p>
					<p class="name"><span>昵称:</span>丹丹</p>
					<p class="time"><span>注册时间:</span>2017-11-04  19:38:22</p>
				</div>
				<div class="xian">
					
					<img src="images/xian.png"/>
				</div>
			</div>
		</div>-->
		<div class="clear"></div>
		 <ul style="position: none;float: left;height: 13rem;">
	        <li>
	            <div id="blackcover">
					<div class="con">
						<div class="con_a">
							<!--<p>等级身份:</p>-->
							<div class="con_tit">
								<p class="title"><?php echo $this->_var['user_info']['user_level']; ?></p>
								<!--<p class="business"><span>推荐商家:</span>38</p>-->
								<p class="consumer"><span>推荐消费者:</span><?php echo $this->_var['direct_users_num']; ?></p>
								<!--<img src="images/center2.png" alt="" />-->
								<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/center.png"/>
							</div>
							<div class="current" style="width: 100%;height: .5rem;font-size: .26rem;">
								<p style="float: left;width: 50%;">当前总获的奖金: <span><?php echo $this->_var['current_reward']; ?></span></p>
								<p style="float: left;width: 50%;">当前奖金封顶值: <span><?php echo $this->_var['current_reward_max']; ?></span></p>
							</div>
							<p class="bot_time">
								<!--<span>2017-11-04</span>19:38:22-->
								<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/xian.png"/>
							</p>
							
						</div>
						<div class="con_b">
							<p>升级条件进度:</p>
							<div class="con_b_a">
								<div class="con_one">
									<p>推荐消费者</p>
									<div class="jindu_a">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['direct_users_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_direct_members_min']; ?></span></p>
								</div>
								<div class="con_two">
									<p>伞下各市场订单数满足<span><?php echo $this->_var['user_next_level_orders_min']; ?></span>单的市场数</p>
									<div class="jindu_b">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['current_order_satisfied_market_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_market_min']; ?></span></p>
								</div>
								<div class="con_two none">
									<p>伞下市场出现六级代理数</p>
									<div class="jindu_b">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['user_market_6_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_market6_min']; ?></span></p>
								</div>
								<div class="con_two none">
									<p>伞下市场出现五级代理数</p>
									<div class="jindu_b">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['user_market_5_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_market5_min']; ?></span></p>
								</div>
								<div class="con_two none">
									<p>伞下市场出现四级代理数</p>
									<div class="jindu_b">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['user_market_4_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_market4_min']; ?></span></p>
								</div>
								<div class="con_two none">
									<p>伞下市场出现三级代理数</p>
									<div class="jindu_b">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['user_market_3_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_market3_min']; ?></span></p>
								</div>
								<div class="con_two none">
									<p>伞下市场出现二级代理数</p>
									<div class="jindu_b">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['user_market_2_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_market2_min']; ?></span></p>
								</div>
								<div class="con_two none">
									<p>伞下市场出现一级代理数</p>
									<div class="jindu_b">
										<div class="son">
											<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/guangbiao.png"/>
										</div>
									</div>
									<p class="data"><span class="data_a"><?php echo $this->_var['user_market_1_num']; ?></span>/<span class="data_b"><?php echo $this->_var['user_next_level_market1_min']; ?></span></p>
								</div>
								<div class="con_three">
									<h3>福利发放条件:</h3>
									<p>拿伞下所有市场购物额度的<span class="all"><?php echo $this->_var['fx_get_rainbow_rate']; ?></span></p>
									<p class="none">拿伞下直推市场购物额度的<span class="zhitui"><?php echo $this->_var['fx_rate']; ?></span></p>
								</div>
								
							</div>
						</div>
					</div>				
				</div>
	        </li>
	       
    </ul>

	</body>
	<script>
		//进度条
		$(window).ready(function(){
			var a = $(".data_a");
			var b = $(".data_b");
			var a1 = $(".all").text();
			var a2 = $(".zhitui").text();
			$(".all").text(a1*100+"%");
			$(".zhitui").text(a2*100+"%");
			if(a1 == 0){
				$(".all").parent().addClass("none");
				$(".zhitui").parent().removeClass("none");
			}
			for(var i = 0;i<a.length;i++){
				var c = a.eq(i).text();
				var d = b.eq(i).text();
				var e = c/d;
				var img_width = (1-e)*100+"%";
				$(".son").eq(i).css("width",img_width);
				if(d != null && d != ''){
					b.eq(i).parents(".con_two").removeClass("none");
				}
			}
			//升级条件
			var level = $(".con_tit .title").text();
			if(level == 0){
				if(<?php echo $this->_var['level_0_fx']; ?> == 0){
					$(".con_tit .title").text("消费者");
				}else if(<?php echo $this->_var['level_0_fx']; ?> == 1){
					$(".con_tit .title").text("一级分销");
				}else if(<?php echo $this->_var['level_0_fx']; ?> == 2){
					$(".con_tit .title").text("二级分销");
				}else if(<?php echo $this->_var['level_0_fx']; ?> == 3){
					$(".con_tit .title").text("三级分销");
				}
			}else if(level == 1){
				$(".con_tit .title").text("一级代理");
			}
			else if(level == 2){
				$(".con_tit .title").text("二级代理");
			}
			else if(level == 3){
				$(".con_tit .title").text("三级代理");
			}
			else if(level == 4){
				$(".con_tit .title").text("四级代理");
			}
			else if(level == 5){
				$(".con_tit .title").text("五级代理");
			}
			else if(level == 6){
				$(".con_tit .title").text("六级代理");
			}
			else if(level == 7){
				$(".con_tit .title").text("董事");
			} 
		})

	</script>
</html>