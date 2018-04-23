<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script type="text/javascript">
	var AJAX_URL = '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
</script>
<div class="page page-index" id="user_getpassword" style="background: #FFFFFF">
	<header class="bar bar-nav b-line">
		<a class="header-btn header-left iconfont back" <?php if ($this->_var['user_info']): ?> onclick ="go_back();"<?php endif; ?> data-transition='slide-out'>&#xe604;</a>
		<h1 class="header-title">找回密码</h1>
		<!--<a href="#" class="pull-right u-register">立即登录</a>-->
	</header>
	<div class="content">

		<div class="user-form" style="padding: 0 1.25rem">
			<form id="ph_getpassword" action="<?php
echo parse_url_tag("u:index|user|"."".""); 
?>">
				<div class="phone-login">
					<ul class="form-list">
						<li class="b-line flex-box">
							<i class="iconfont">&#xe660;</i>
							<input type="tel" name="user_mobile" class="form-text flex-1 phonenumer" id="phonenumer" placeholder="请输入手机号码">
							<i class="iconfont input-clear j-phone-clear" style="padding-right: 0;">&#xe6b3;</i>
						</li>
						<li class="b-line flex-box">
							<i class="iconfont">&#xe661;</i>
							<input type="number" name="sms_verify" class="form-text flex-1" placeholder="请输入手机验证码" id="sms_verify">
							<i class="iconfont input-clear j-verify-clear">&#xe6b3;</i>
							<input type="button" id="btn"  unique="2" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" class="sendBtn noUseful  j-sendBtn" value="发送验证码">
						</li>
						<li class="b-line flex-box">
							<i class="iconfont">&#xe662;</i>
							<input type="password" name="user_pwd" class="form-text flex-1" placeholder="请输入新密码" id="password">
							<i class="iconfont input-clear j-password-clear">&#xe6b3;</i>
						</li>
					</ul>
					<input type="hidden" name="act" value="dogetpassword" />
					<input type="button" value="确定" class="userBtn userBtn-yellow" id="getpassword">
				</div>
			</form>
		</div>


		<?php if ($this->_var['is_weixin']): ?>
		<div class="third-login">
			<p class="third-login-title">使用其他方式登录</p>
			<div class="third-login-info">
				<a href="javascript:void(0);" onclick="weixin_login();" class="weixin-login">
					<i class="iconfont">&#xe664;</i>
				</a>
			</div>
		</div>
		<?php endif; ?>
	</div>

<?php echo $this->fetch('style5.2/inc/module/sms_verify_code.html'); ?>

</div>


<?php echo $this->fetch('style5.2/inc/footer.html'); ?>