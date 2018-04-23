<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index" id="user_center">
<style type="text/css">
	.icon {
		width: 1.4rem; height: 1.4rem;
		vertical-align: -0.15rem;
		fill: currentColor;
		overflow: hidden;
	}
</style>
	<?php echo $this->fetch('style5.2/inc/module/nav.html'); ?>
	<div class="content">
		<div class="person-head">
			<div class="bg-img">
				<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/person_bg.jpg">
			</div>
			<div class="contentBox">
				<a class="setting icon-posi" href="<?php
echo parse_url_tag("u:index|setting|"."".""); 
?>" data-no-cache="true"><i class="iconfont">&#xe8ba;</i></a>
				<a class="message icon-posi fun-check-login" href="javascript:void(0);" data-url="<?php
echo parse_url_tag("u:index|uc_msg|"."".""); 
?>" data-no-cache="true"><i class="iconfont">&#xe8bc;</i><?php if ($this->_var['data']['not_read_msg']): ?><em class="tishi"></em><?php endif; ?></a>
					<a  class="manage fun-check-login" href="javascript:void(0);" data-url="<?php
echo parse_url_tag("u:index|uc_account|"."".""); 
?>" data-no-cache="true">账户管理<i class="iconfont">&#xe607;</i></a>
					<a  class="manage fun-check-login sqbd" href="javascript:void(0);" data-url="<?php
echo parse_url_tag("u:index|uc_log#bdzx|"."".""); 
?>" data-no-cache="true" style="margin-top: 2rem;">申请报单中心<i class="iconfont">&#xe607;</i></a>
					<?php if ($this->_var['data']['user_login_status']): ?>
					<div class="headImg">
						<img alt="" src="<?php echo $this->_var['data']['user_avatar']; ?>">
					</div>
					<div class="chibang">
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/angel.png" alt="" />
						<p><?php echo $this->_var['user_info']['user_level']; ?></p>
					</div>
					<p class="userName"><?php echo $this->_var['data']['user_name']; ?></p>
					<!--<ul class="vipBox flex-box">
						<?php if ($this->_var['app_index'] == 'app'): ?>
						<li class="flex-1"><a class="vipName" href="<?php
echo parse_url_tag("u:index|uc_account|"."".""); 
?>" data-no-cache="true"><i class="icon-vip"></i><?php echo $this->_var['data']['user_group']; ?></a></li>
						<li class="flex-1"></li>
						<?php else: ?>
						<li><a class="vipName" href="<?php
echo parse_url_tag("u:index|uc_account|"."".""); 
?>" data-no-cache="true"><i class="icon-vip"></i><?php echo $this->_var['data']['user_group']; ?></a></li>
						 <li class="flex-1"><a href="<?php
echo parse_url_tag("u:index|uc_home|"."".""); 
?>" class="share_other"  data-no-cache="true"><i class="iconfont">&#xe8d5;</i>朋友圈</a></li>  
						<?php endif; ?>
					</ul>-->
					<?php else: ?>
					<div class="headImg">
						<img alt="请登录"  src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/noavatar_big.gif">
					</div>
					<a class="fun-check-login" href="javascript:void(0);" data-url="<?php
echo parse_url_tag("u:index|user#login|"."".""); 
?>"  data-no-cache="true"><p class="userName">点击登录</p></a>
					<?php endif; ?>
			</div>
		</div>
		<div class="hd-bar b-line" style="background-color: #fff;">
			<!--<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/11111.png"/>-->
			我的收益</div>
		<div class="user-balance flex-box" style="margin-bottom: 0;">
			<!--<a href="<?php
echo parse_url_tag("u:index|uc_money|"."".""); 
?>" data-no-cache="true" class="balance-item flex-1 r-line">
				<p class="balance-num"><?php if ($this->_var['data']['user_money'] > 0): ?><?php echo $this->_var['data']['user_money']; ?><?php else: ?>0<?php endif; ?></p>
				<p class="balance-tit">余额</p>
			</a>-->
			<a href="javascript:;" class="balance-item flex-1 r-line">
				<p class="balance-num"><?php echo $this->_var['user_info']['register_credits']; ?></p>
				<p class="balance-tit">注册积分</p>
			</a>
			<a href="javascript:;" class="balance-item flex-1 r-line">
				<p class="balance-num"><?php echo $this->_var['user_info']['avalible_benefit_credits']; ?></p>
				<p class="balance-tit">受益积分</p>
			</a>
			<a href="javascript:;" class="balance-item flex-1">
				<p class="balance-num"><?php echo $this->_var['user_info']['avalible_share_credits']; ?></p>
				<p class="balance-tit">分享积分</p>
			</a>
			<!--<a href="javascript:;" class="balance-item flex-1 r-line">
				<p class="balance-num"><?php if ($this->_var['data']['youhui_count'] > 0): ?><?php echo $this->_var['data']['youhui_count']; ?><?php else: ?>0<?php endif; ?></p>
				<p class="balance-tit">累计动态受益</p>
			</a>
			<a href="javascript:;" class="balance-item flex-1 r-line">
				<p class="balance-num"><?php if ($this->_var['data']['coupon_count'] > 0): ?><?php echo $this->_var['data']['coupon_count']; ?><?php else: ?>0<?php endif; ?></p>
				<p class="balance-tit">累计静态受益</p>
			</a>
			<a href="javascript:;" class="balance-item flex-1">
				<p class="balance-num"><?php if ($this->_var['data']['user_score'] > 0): ?><?php echo $this->_var['data']['user_score']; ?><?php else: ?>0<?php endif; ?></p>
				<p class="balance-tit">当前的封顶值</p>
			</a>-->
		</div>
		<div class="user-balance flex-box" style="margin-top: 0;">
			<a href="javascript:;" class="balance-item flex-1 r-line">
				<p class="balance-num"><?php echo $this->_var['user_info']['avalible_consume_credits']; ?></p>
				<p class="balance-tit">消费积分</p>
			</a>
			<a href="javascript:;" class="balance-item flex-1 r-line">
				<p class="balance-num"><?php echo $this->_var['user_info']['active_code']; ?></p>
				<p class="balance-tit">结算码数</p>
			</a>
			<!--<a href="javascript:;" class="balance-item flex-1">
				<p class="balance-num"><?php if ($this->_var['data']['user_score'] > 0): ?><?php echo $this->_var['data']['user_score']; ?><?php else: ?>0<?php endif; ?></p>
				<p class="balance-tit">当前封顶值</p>
			</a>-->
		</div>
		<?php if ($this->_var['data']['user_mobile_empty']): ?>
		<div class="u-prompt t-line">
			<a href="<?php
echo parse_url_tag("u:index|uc_account#phone|"."".""); 
?>"><i class="iconfont">&#xe66f;</i>点击<span>绑定手机号</span>，确保账户安全~</a>
			<span class="pro_close_btn"><i class="iconfont">&#xe635;</i></span>
		</div>
		<?php endif; ?>

		<!--我的订单-->
		<div class="my-order">
			<div class="order-box clearfix">
				<a href="<?php
echo parse_url_tag("u:index|uc_order|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico">
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/uc-ico-1.png" alt="">
						<?php if ($this->_var['data']['countOrder']): ?><div class="order-num"><?php echo $this->_var['data']['countOrder']; ?></div><?php endif; ?>
					</div>
					<div class="order-tit">商城单</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_log#bdjl|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico">
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/uc-ico-2.png" alt="">
						<?php if ($this->_var['data']['countTuan']): ?><div class="order-num"><?php echo $this->_var['data']['countTuan']; ?></div><?php endif; ?>
					</div>
					<div class="order-tit">消费奖</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_review|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/uc-ico-7.png" alt=""></div>
					<div class="order-tit">我的评价</div>
				</a>
			<!-- 	<a href="<?php
echo parse_url_tag("u:index|uc_order#refund_list|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/uc-ico-4.png" alt=""></div>
					<div class="order-tit">退款/售后</div>
				</a> -->
				<a href="<?php
echo parse_url_tag("u:index|uc_money|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico">
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_b.png" alt="" style="width: 1.1rem;">
						<?php if ($this->_var['data']['countOrder']): ?><div class="order-num"><?php echo $this->_var['data']['countOrder']; ?></div><?php endif; ?>
					</div>
					<div class="order-tit">我要提币</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_log#jiangjin|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico">
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_a.png" alt="" style="width: 1.1rem;">
						<?php if ($this->_var['data']['countTuan']): ?><div class="order-num"><?php echo $this->_var['data']['countTuan']; ?></div><?php endif; ?>
					</div>
					<div class="order-tit">奖金明细</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_log#yjmx|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_c.png" alt="" style="width: 0.98rem;"></div>
					<div class="order-tit">业绩明细</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_myrole|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_i.png" alt="" style="width: 1.1rem;"></div>
					<div class="order-tit">我的身份</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_log#hzjf|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_d.png" alt="" style="width: 1.3rem;position: relative;left: -0.15rem;"></div>
					<div class="order-tit">互转资产</div>
				</a>
				<a href="javascript:;" class="order-item jinru" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_k.png" alt="" style="width: 1rem;position: relative;left: -0.15rem;"></div>
					<div class="order-tit">注册会员</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_collect|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_e.png" alt="" style="width: 1.1rem;"></div>
					<div class="order-tit">产品收藏</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_log#dhzcjf|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico" style="padding-top: 0;"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_f.png" alt="" style="width: 1.03rem;"></div>
					<div class="order-tit">兑换注册积分</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_address|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico" style="padding-top: 0;"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_g.png" alt="" style="width: 0.88rem;"></div>
					<div class="order-tit">收货地址</div>
				</a>
				<a href="<?php
echo parse_url_tag("u:index|help|"."".""); 
?>" class="order-item" data-no-cache="true">
					<div class="uc-ico"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/user_center/admin_h.png" alt=""></div>
					<div class="order-tit">客服中心</div>
				</a>
			</div>
		</div>
	</div>
	<script>
		$(window).ready(function(){
			//进行身份识别
			var level = $(".chibang p").text();
			if(level == 0){
				$(".sqbd").addClass("none");
				if(<?php echo $this->_var['data']['level_0_fx']; ?> == 0){
					$(".chibang p").text("消费者");
				}else if(<?php echo $this->_var['data']['level_0_fx']; ?> == 1){
					$(".chibang p").text("一级分销");
				}else if(<?php echo $this->_var['data']['level_0_fx']; ?> == 2){
					$(".chibang p").text("二级分销");
				}else if(<?php echo $this->_var['data']['level_0_fx']; ?> == 3){
					$(".chibang p").text("三级分销");
				}
			}else if(level == 1){
				$(".chibang p").text("一级代理");
			}
			else if(level == 2){
				$(".chibang p").text("二级代理");
			}
			else if(level == 3){
				$(".chibang p").text("三级代理");
			}
			else if(level == 4){
				$(".chibang p").text("四级代理");
			}
			else if(level == 5){
				$(".chibang p").text("五级代理");
			}
			else if(level == 6){
				$(".chibang p").text("六级代理");
			}
			else if(level == 7){
				$(".chibang p").text("董事");
			} 
		})
		//会员注册
		$(".jinru").click(function(){
			if(<?php echo $this->_var['data']['user_info']['active']; ?> == 0){
				alert("报单激活后才能注册会员!!!");
			}else{
				window.location.href="<?php
echo parse_url_tag("u:index|uc_register|"."".""); 
?>";
			}
		})
	</script>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
