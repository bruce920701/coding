<?php echo $this->fetch('style5.2/inc/header1.html'); ?>

<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-current" id="uc_account">
<script>
var LOGIN_URL = '<?php
echo parse_url_tag("u:index|user#login|"."".""); 
?>';
var UPLOAD_URL = '<?php
echo parse_url_tag("u:index|file#upload_avatar|"."".""); 
?>';
var REFRESH_URL = '<?php
echo parse_url_tag("u:index|uc_account|"."".""); 
?>';
var APP_UPLOAD_URL = '<?php
echo parse_url_tag("u:index|uc_account#app_upload_avatar|"."".""); 
?>';
<?php if ($this->_var['data']['is_weixin_bind'] == 1): ?>
var is_weixin_bind = true;
<?php else: ?>
var is_weixin_bind = false;
<?php endif; ?>
</script>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content">
		<!--<div class="my-vip">
			<div class="my-vip-hd"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/uc-myvip.png" alt=""></div>
			<h1 class="vip-tit"><?php echo $this->_var['data']['currdis']['name']; ?>

			<div class="vip-tit-pic"><?php if ($this->_var['data']['currdis']['discount'] != 10): ?>享<?php echo $this->_var['data']['currdis']['discount']; ?>折优惠<?php endif; ?></div>

			</h1>
			<div class="progress flex-box">
				<p><?php echo $this->_var['data']['group_info']['0']['name']; ?></p>
				<div class="progress-bar flex-1">
					<div class="progress-bar-inner" data-width="<?php echo $this->_var['data']['group_percent']; ?>%"></div>
				</div>
				<p><?php echo $this->_var['data']['group_info']['1']['name']; ?></p>
			</div>
			<div class="vip-tip"><?php echo $this->_var['data']['next_group_info']; ?></div>
		</div>
		<div class="my-vip my-exp">
			<h1 class="vip-tit"><?php echo $this->_var['user_info']['point']; ?><div class="vip-tit-pic">当前经验值</div></h1>
			<div class="progress flex-box">
				<p><?php echo $this->_var['data']['level_info']['0']['name']; ?></p>
				<div class="progress-bar flex-1">
					<div class="progress-bar-inner" data-width="<?php echo $this->_var['data']['level_percent']; ?>%"></div>
				</div>
				<p><?php echo $this->_var['data']['level_info']['1']['name']; ?></p>
			</div>
			<div class="vip-tip"><?php echo $this->_var['data']['next_level_info']; ?></div>
		</div>-->
		<ul class="account-list">
			<li class="b-line flex-box">
				<p class="flex-1">头像</p>
				<div class="user-img"><img id="user_avatar" src="<?php echo $this->_var['user_info']['user_avatar']; ?>" alt=""></div>
				<i class="iconfont right-arrow">&#xe607;</i>
				<?php if ($this->_var['app_index'] == 'app'): ?>
				<input class="up_avatar" id="app_up_avatar" type="button" />
				<?php else: ?>
				<input class="up_avatar" id="up_avatar" type="file" accept="image/jpg,image/jpeg,image/png" />
				<?php endif; ?>
			</li>
			<?php if ($this->_var['user_info']['is_tmp'] == 1): ?>
			<li class="b-line flex-box">
				<a href="<?php
echo parse_url_tag("u:index|user#changeuname|"."".""); 
?>"class="flex-box"  style="width:100%;padding:0;">
				<p class="flex-1">会员名</p>
				<p><?php echo $this->_var['user_info']['user_name']; ?></p>
				<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
			<?php else: ?>
			<li class="b-line flex-box">
				<p class="flex-1">会员名</p>
				<p><?php echo $this->_var['user_info']['user_name']; ?></p>
				<i class="iconfont right-arrow" style="color:#fff;">&#xe607;</i>
			</li>
			<?php endif; ?>
			<?php if ($this->_var['user_info']['email']): ?>
			<li class="b-line flex-box">
				<p class="flex-1">邮箱</p>
				<p><?php echo $this->_var['user_info']['email']; ?></p>
				<i class="iconfont right-arrow" style="color:#fff;">&#xe607;</i>
			</li>
			<?php endif; ?>
			<li class="b-line">
				<a href="<?php
echo parse_url_tag("u:index|uc_account#phone|"."".""); 
?>" class="flex-box" data-no-cache="true">
					<p class="flex-1">绑定手机</p>
					<?php if ($this->_var['user_info']['mobile'] == ''): ?>
					<span>未绑定</span>
					<?php else: ?>
					<p><?php echo $this->_var['user_info']['mobile']; ?></p>
					<input type="hidden" name="phone" value="1">
					<?php endif; ?>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
			<?php if ($this->_var['user_info']['mobile']): ?>
			<?php if ($this->_var['is_weixin'] || $this->_var['is_app']): ?>
			<li class="b-line flex-box">
					<p class="flex-1">社交账号</p>
					<?php if ($this->_var['user_info']['is_bind_wx'] == 0): ?>
						<?php if ($this->_var['is_weixin']): ?>
						<span onclick="weixin_bind_authorize();" >绑定微信</span>
						<?php endif; ?>
						<?php if ($this->_var['is_app']): ?>
						<span onclick="weixin_login_app();">绑定微信</span>
						<?php endif; ?>
					<?php else: ?>
					<span class="wx_unbind" action="<?php
echo parse_url_tag("u:index|ajax#wx_unbind|"."".""); 
?>">解绑微信</span>
					<?php endif; ?>
					<i class="iconfont right-arrow">&#xe607;</i>
			</li>
			<?php endif; ?>
			<?php endif; ?>
			<li class="b-line">
				<a href="javascript:void(0);" href-data="<?php
echo parse_url_tag("u:index|user#changepassword|"."".""); 
?>" <?php if ($this->_var['user_info']['mobile'] == ''): ?>phone-href="<?php
echo parse_url_tag("u:index|uc_account#phone|"."".""); 
?>"<?php endif; ?> class="flex-box bindphone">
					<p class="flex-1">修改密码</p>
					<span style="margin-top: 5px;">******</span>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
			<?php if ($this->_var['data']['is_open_idvalidate'] != 0): ?>
			<li class="b-line">
				<a href="javascript:void(0);" href-data="<?php
echo parse_url_tag("u:index|idvalidate|"."".""); 
?>"  class="flex-box bindphone" data-no-cache="true">
					<p class="flex-1">实名认证</p>
					<span style="margin-top: 5px;"><?php if ($this->_var['user_info']['is_id_validate'] == 1): ?>已认证<?php elseif ($this->_var['user_info']['is_id_validate'] == 2): ?>审核中<?php elseif ($this->_var['user_info']['is_id_validate'] == 3): ?>认证失败<?php else: ?>未认证<?php endif; ?></span>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	function CutCallBack(data){
		$('#user_avatar').attr('src',data);
	}
</script>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>