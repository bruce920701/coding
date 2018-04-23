<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var INDEX_URL='<?php
echo parse_url_tag("u:index|scores_index|"."".""); 
?>';
</script>
<div class="page page-index page-current" id="scores_index">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content  infinite-scroll infinite-scroll-bottom">
		<div class="m-user-info flex-box">
		 <?php if ($this->_var['data']['user_login_status'] == 0): ?>
			<a href="javascript:void(0);" class="ulogin flex-box" data-no-cache="true">
				<div class="flex-1">点击登录，领取免费积分</div>
				<i class="iconfont">&#xe607;</i>
			</a>
		 <?php else: ?>
		 	<div class="user-avatar">
				<div class="avatar">
					<img src="<?php echo $this->_var['data']['user_info']['user_avatar']; ?>" alt="头像">
				</div>
				<div class="vip-info">
					<img class="vip-icon" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/vip_icon.png"><em><?php echo $this->_var['data']['user_info']['user_group_name']; ?></em>
				</div>
			</div>
			<div class="user-info flex-1">
				<div class="user-name"><?php echo $this->_var['data']['user_info']['user_name']; ?></div>
				<div class="score">积分<em><?php echo $this->_var['data']['user_info']['user_score']; ?></em></div>
				<?php if ($this->_var['data']['user_info']['user_login_text']): ?>
					<div class="sign-day">
						<?php echo $this->_var['data']['user_info']['user_login_text']; ?>
					</div>
				<?php endif; ?>
			</div>
            <?php if ($this->_var['SCORE_RECHARGE_SWITCH']): ?>
               <div class="sign" style="top: 35%;right:0.2rem; border-radius: 0.5rem;text-align: center;padding-right: 0.5rem; background-color: white;">
                   <a href="<?php
echo parse_url_tag("u:index|uc_score#buy_score|"."".""); 
?>" data-no-cache="true" style="color:red;">购买积分</a>
               </div>
            <?php endif; ?>
			<?php if ($this->_var['data']['user_info']['user_login_score'] > 0): ?>
			<div class="sign <?php if ($this->_var['data']['user_info']['is_user_login_today'] == 0): ?>signin<?php endif; ?>" <?php if ($this->_var['SCORE_RECHARGE_SWITCH']): ?>style="top:65%;"<?php endif; ?>>
				<i class="iconfont"></i>
				<span>
				<?php if ($this->_var['data']['user_info']['is_user_login_today'] == 1): ?>
					已签到
				<?php else: ?>
					签到+<?php echo $this->_var['data']['user_info']['user_login_score']; ?>积分
				<?php endif; ?>
				</span>
			</div>
			<?php endif; ?>
		 <?php endif; ?>	
		</div>
		<?php if ($this->_var['data']['bcate_list']): ?>
		<div class="m-score-type j-score-type">
			<div class="swiper-wrapper">
				<?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');if (count($_from)):
    foreach ($_from AS $this->_var['cate']):
?>
				<a class="type-item swiper-slide" href="<?php echo $this->_var['cate']['url']; ?>">
					<span class="yuan" style="background-color:<?php echo $this->_var['cate']['iconbgcolor']; ?>" ><i class="diyfont" style="color:<?php echo $this->_var['cate']['iconcolor']; ?>"><?php echo $this->_var['cate']['iconfont']; ?></i></span>
					<span class="txt"><?php echo $this->_var['cate']['name']; ?></span>
				</a>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php if ($this->_var['data']['item']): ?>
		<dl class="m-hot-dui">
			<dt class="dui-tit">大家都在兑</dt>
			<div class="j-ajaxlist">
			<div class="j-ajaxadd">
			<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');if (count($_from)):
    foreach ($_from AS $this->_var['deal']):
?>
			<a data-no-cache="true" href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['deal']['id']."".""); 
?>">
			<dd class="flex-box dui-item b-line">	
				<img src="<?php if ($this->_var['deal']['f_icon_v1']): ?><?php echo $this->_var['deal']['f_icon_v1']; ?><?php else: ?><?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png<?php endif; ?>" alt="<?php echo $this->_var['deal']['name']; ?>" class="good-img">
				<div class="flex-1 good-info">
					<div class="good-name"><?php echo $this->_var['deal']['name']; ?></div>
					<div class="good-score flex-box"><div class="flex-1"><em><?php echo $this->_var['deal']['deal_score']; ?></em>&nbsp;积分</div><?php if ($this->_var['deal']['buy_count'] > 0): ?><em class="has-ex">已兑换：<?php echo $this->_var['deal']['buy_count']; ?></em><?php endif; ?></div>
				</div>	
			</dd>
			</a>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
			</div>
		</dl>
		<?php endif; ?>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>