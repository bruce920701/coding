<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_invite.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/plupload.full.min.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_invite.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_invite.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<script>
var MEDAL_BOX_URL = '<?php
echo parse_url_tag("u:index|uc_medal#load_medal|"."".""); 
?>';
</script>
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?> clearfix">
	<div class="side_nav left_box">
		<?php echo $this->fetch('inc/uc_nav_list.html'); ?>
	</div>
	<div class="right_box">
		<div class="myJueSe">
			<div class="goPayHead">
				<p>我的角色 ></p>
			</div>
			<!--<div class="blank20"></div>-->
			<div class="juese_head">
				<div class="js_head_xx">
					<div class="js_img">
						<?php 
$k = array (
  'name' => 'show_avatar',
  'id' => $this->_var['user_info']['id'],
  'type' => 'small',
  'is_card' => '0',
);
echo $k['name']($k['id'],$k['type'],$k['is_card']);
?>
					</div>
					<p style="margin-top: 30px;">ID: <span><?php echo $this->_var['user_info']['id']; ?></span></p>
					<p>昵称: <span><?php echo $this->_var['user_info']['user_name']; ?></span> 
						<p style="float: left;width: 30%;">当前奖金封顶值: <span><?php echo $this->_var['current_reward_max']; ?></span></p>
						<p style="float: left;width: 30%;">当前总获得奖金: <span><?php echo $this->_var['current_reward']; ?></span></p>
					</p>
					<p style="font-size: 14px;color: #666;">注册时间: <span class="time"><?php echo $this->_var['user_info']['create_time']; ?></span></p>
					<img src="<?php echo $this->_var['TMPL']; ?>/images/fgx.png"/>
				</div>
				<div class="juese_con">
					<div class="js_con_left">
						<p>等级身份:</p>
						<div class="js_con_xx">
							<p class="xfz"><?php echo $this->_var['user_info']['user_level']; ?></p>
							<p class="tjxfz">推荐消费者: <span><?php echo $this->_var['direct_users_num']; ?></span>个</p>
							<img src="<?php echo $this->_var['TMPL']; ?>/images/jibie.png"/>
						</div>
					</div>
					<div class="js_con_right">
						<p>升级条件进度:</p>
						<div class="js_right_jd">
							<div class="tj_a tj_b">
								<p>推荐消费者</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['direct_users_num']; ?></b>/<small><?php echo $this->_var['user_next_level_direct_members_min']; ?></small></span>
							</div>
							<?php if ($this->_var['will_show_order_detail'] == 1): ?>
							<div class="tj_b">
								<p>伞下各市场订单数满足<span><?php echo $this->_var['user_next_level_orders_min']; ?></span>单的市场数</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['current_order_satisfied_market_num']; ?></b>/<small><?php echo $this->_var['user_next_level_market_min']; ?></small></span>
							</div>
							<?php endif; ?>
							<div class="tj_b">
								<p>伞下市场出现六级代理数</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['user_market_6_num']; ?></b>/<small><?php echo $this->_var['user_next_level_market6_min']; ?></small></span>
							</div>
							<div class="tj_b">
								<p>伞下市场出现五级代理数</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['user_market_5_num']; ?></b>/<small><?php echo $this->_var['user_next_level_market5_min']; ?></small></span>
							</div>
							<div class="tj_b">
								<p>伞下市场出现四级代理数</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['user_market_4_num']; ?></b>/<small><?php echo $this->_var['user_next_level_market4_min']; ?></small></span>
							</div>
							<div class="tj_b">
								<p>伞下市场出现三级代理数</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['user_market_3_num']; ?></b>/<small><?php echo $this->_var['user_next_level_market3_min']; ?></small></span>
							</div>
							<div class="tj_b">
								<p>伞下市场出现二级代理数</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['user_market_2_num']; ?></b>/<small><?php echo $this->_var['user_next_level_market2_min']; ?></small></span>
							</div>
							<div class="tj_b">
								<p>伞下市场出现一级代理数</p>
								<span class="jd_a"></span><span class="jd_b"><b><?php echo $this->_var['user_market_1_num']; ?></b>/<small><?php echo $this->_var['user_next_level_market1_min']; ?></small></span>
							</div>
							<p style="text-align: left;font-weight: bold;color: #663208;">获得福利:</p>
							<div class="tj_c">
								<i></i><p>拿伞下所有市场购物额度的<span class="all"><?php echo $this->_var['fx_get_rainbow_rate']; ?></span></p>
								<p class="none">拿直推用户购物额度的<span class="zhitui"><?php echo $this->_var['fx_rate']; ?></span></p>
							</div>
							
						</div>
					</div>
					<script>
						$(window).ready(function(){
							var a = $(".jd_b>b");
							var c = $(".jd_b>small");
							var a1 = parseFloat($(".all").text());
							var a2 = parseFloat($(".zhitui").text());
							$(".all").text(a1*100+"%");
							$(".zhitui").text(a2*100+"%");
							var level = $(".xfz").text();
							if(level == 0){
									if(<?php echo $this->_var['level_0_fx']; ?> == 0){
										$(".xfz").text("消费者");
									}else if(<?php echo $this->_var['level_0_fx']; ?> == 1){
										$(".xfz").text("一级分销");
									}else if(<?php echo $this->_var['level_0_fx']; ?> == 2){
										$(".xfz").text("二级分销");
									}else if(<?php echo $this->_var['level_0_fx']; ?> == 3){
										$(".xfz").text("三级分销");
									}
							}else if(level == 1){
								$(".xfz").text("一级代理");
							}
							else if(level == 2){
								$(".xfz").text("二级代理");
							}
							else if(level == 3){
								$(".xfz").text("三级代理");
							}
							else if(level == 4){
								$(".xfz").text("四级代理");
							}
							else if(level == 5){
								$(".xfz").text("五级代理");
							}
							else if(level == 6){
								$(".xfz").text("六级代理");
							}
							else if(level == 7){
								$(".xfz").text("董事");
							}
							
							
							if(a1 == 0){
								$(".all").parent().addClass("none");
								$(".zhitui").parent().removeClass("none");
							}else if(a1 != 0){
								$(".all").parent().removeClass("none");
								$(".zhitui").parent().addClass("none");
							}
							for(var i = 0;i<a.length;i++){
								var b = a.eq(i).text();
								var d = c.eq(i).text();
								var img_width;
								if((b/d)*100>100){
									img_width = 105+"%";
								}else{
									img_width = (b/d)*100+5+"%";
								}
								$(".jd_a").eq(i).css("background-size",img_width +"32px");
								if(d == "" || d == null){
									c.eq(i).parents(".tj_b").css("display","none");
								}
							}
							//时间戳转换为时间
							var time = new Date(<?php echo $this->_var['user_info']['create_time']; ?>*1000);
							var year = time.getFullYear();
							var month = time.getMonth()+1;
							var day = time.getDate();
							var hour = time.getHours();
							var min = time.getMinutes();
							var sen = time.getSeconds();
							var times = year +'-'+ getzf(month) +'-'+ getzf(day) +' '+ getzf(hour) +':'+ getzf(min) +':'+getzf(sen);
							$(".time").html(times);
						})
						//补0操作
						function getzf(num){  
				          	if(parseInt(num) < 10){  
				             	num = '0'+num;  
				          	}  
				          	return num;  
				      	}
						
						
						//消费者等级
						
					</script>
				</div>
			</div>
			<div class="blank20"></div>
			
		</div>
		
	</div>	
</div>