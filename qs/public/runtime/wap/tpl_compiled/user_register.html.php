<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script type="text/javascript">
	var AJAX_URL = '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
</script>
<div class="page page-index" id="user_register" style="background: #FFFFFF">
	<header class="bar bar-nav b-line">
		<a class="header-btn header-left iconfont back" data-transition='slide-out'>&#xe604;</a>
		<h1 class="header-title">注册</h1>
		<!--<a href="#" class="pull-right u-register">立即登录</a>-->
	</header>
	<div class="content">
		<div class="user-form" style="padding: 0 1.25rem">
			<form id="ph_register" action="<?php
echo parse_url_tag("u:index|user|"."".""); 
?>">
				<div class="phone-login">
					<ul class="form-list">
						<li class="b-line flex-box">
							<i class="iconfont">&#xe660;</i>
							<input type="tel" class="form-text flex-1" id="phonenumer" name="user_mobile" placeholder="请输入手机号码">
							<i class="iconfont input-clear j-phone-clear" style="padding-right: 0;">&#xe6b3;</i>
						</li>
						<li class="b-line flex-box">
							<i class="iconfont">&#xe662;</i>
							<input type="password" class="form-text flex-1 password"  name="user_pwd" placeholder="请输入密码" id="password">
							<i class="iconfont input-clear j-password-clear">&#xe6b3;</i>
							<span class="eyes"><i class="iconfont eyes-no">&#xe65f;</i><i class="iconfont eyes-yes">&#xe65e;</i></span>
						</li>
						<li class="b-line flex-box">
							<i class="iconfont">&#xe661;</i>
							<input type="number" class="form-text flex-1" name="sms_verify" placeholder="请输入手机验证码" id="sms_verify">
							<i class="iconfont input-clear j-verify-clear">&#xe6b3;</i>
							<input type="button" id="btn" unique="1" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" class="sendBtn noUseful  j-sendBtn" value="发送验证码">
						</li>
					</ul>
					<p class="loginWarm">点击注册,即表示您同意<a data-src="<?php
echo parse_url_tag("u:index|user#protocol|"."".""); 
?>" href="javascript:void(0);" class="open-popup">用户协议</a></p>
					<input type="hidden" name="act" value="dophregister" />
					<input type="button" value="注册" class="userBtn userBtn-yellow">
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
	<div class="popup popup-agreement">
		<div class="popup-hd">
			<h1 class="title b-line"></h1>
			<a href="javascript:void(0);" class="close-popup"><i class="iconfont">&#xe634;</i></a>
		</div>
		<div class="protocol"></div>
	</div>

<?php echo $this->fetch('style5.2/inc/module/sms_verify_code.html'); ?>
</div>
<div id="prohibit" style="width: 100%;height: 100%;position: fixed;z-index:999999999;display:none" ></div>


<?php echo $this->fetch('style5.2/inc/footer.html'); ?>