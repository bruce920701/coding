<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script type="text/javascript">
	var AJAX_URL = '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
	var wx_url = '<?php
echo parse_url_tag("u:index|user_center|"."".""); 
?>';
</script>
<div class="page page-index" id="user_login" style="background: #FFFFFF">
	<header class="bar bar-nav b-line">
		<a class="header-btn header-left iconfont back" data-transition='slide-out'>&#xe634;</a>
		<h1 class="header-title">登录</h1>
		<!--<a href="<?php
echo parse_url_tag("u:index|user#register|"."".""); 
?>" class="header-txt header-right">立即注册</a>-->
	</header>
	<div class="content">
		<!--头部tab切换-->
		<ul class="tab-ways">
			<!--<li class="active" <?php if ($this->_var['is_weixin']): ?>style="width: 100%;"<?php endif; ?>>手机号快捷登录<span class="betweenLine"></span></li>-->
			<!--<?php if (! $this->_var['is_weixin']): ?>-->
			<li class="b-line active" style="width: 100%;text-align: center;color: #f24;">账号密码登录</li>
			<!--<?php endif; ?>-->
		</ul>

		<div class="user-form">
			<!--<form id="ph_login_box" action="<?php
echo parse_url_tag("u:index|user|"."".""); 
?>">
				<div class="phone-login">
					<ul class="form-list">
						<li class="b-line flex-box">
							<i class="iconfont">&#xe660;</i>
							<input type="tel" class="form-text phonenumer flex-1" id="phonenumer" name="mobile" placeholder="请输入手机号码">
							<i class="iconfont input-clear j-phone-clear">&#xe6b3;</i>
							<input type="button" id="btn" unique="0" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" class="sendBtn noUseful  j-sendBtn" value="发送验证码">
						</li>
						<li class="b-line flex-box">
							<i class="iconfont">&#xe661;</i>
							<input type="number" class="form-text flex-1" name="sms_verify" placeholder="请输入收到的验证码" id="sms_verify">
							<i class="iconfont input-clear j-verify-clear">&#xe6b3;</i>
						</li>
					</ul>
					<p class="loginWarm">点击登录,即表示您同意<a data-src="<?php
echo parse_url_tag("u:index|user#protocol|"."".""); 
?>" href="javascript:void(0);" class="open-popup">用户协议</a></p>
					<input type="hidden" name="act" value="dophlogin" />
					<input type="submit" value="登录" class="userBtn userBtn-red">
                    <a href="<?php
echo parse_url_tag("u:index|user#getpassword|"."".""); 
?>" class="getPsw">找回密码</a>
				</div>
			</form>-->
			<form id="com_login_box" action="<?php
echo parse_url_tag("u:index|user|"."".""); 
?>">
				<div class="phone-login">
					<ul class="form-list">
						<li class="b-line flex-box">
							<i class="iconfont">&#xe660;</i>
							<input type="text" class="form-text flex-1" name="user_key" placeholder="请输入用户名" id="user_key">
							<i class="iconfont input-clear j-name-clear" style="padding-right: 0;">&#xe6b3;</i>
						</li>
						<li class="b-line flex-box">
							<i class="iconfont">&#xe662;</i>
							<input type="password" class="form-text password flex-1" name="user_pwd" placeholder="请输入密码" id="password">
							<i class="iconfont input-clear j-password-clear">&#xe6b3;</i>
							<div class="eyes"><i class="iconfont eyes-no">&#xe65f;</i><i class="iconfont eyes-yes">&#xe65e;</i></div>
						</li>
					</ul>
                    <p class="loginWarm">点击登录,即表示您同意<a data-src="<?php
echo parse_url_tag("u:index|user#protocol|"."".""); 
?>" href="javascript:void(0);" class="open-popup">用户协议</a></p>
                    <input type="hidden" name="act" value="dologin" />
					<input type="submit" value="登录" class="userBtn userBtn-red">
					<a href="<?php
echo parse_url_tag("u:index|user#getpassword|"."".""); 
?>" class="getPsw">找回密码</a>
				</div>
			</form>
		</div>


		<!--<?php if ($this->_var['is_weixin'] || $this->_var['app_index'] == 'app'): ?>
		<div class="third-login">
			<p class="third-login-title">使用其他方式登录</p>
			<div class="third-login-info">
				<?php if ($this->_var['is_weixin']): ?>
				<a href="javascript:void(0);" onclick="weixin_login();" class="weixin-login">
					<i class="iconfont">&#xe664;</i>
				</a>
				<?php endif; ?>
				<?php if ($this->_var['app_index'] == 'app' && $this->_var['weixin_conf']['platform_appid'] != ''): ?>
				<a href="javascript:void(0);" onclick="weixin_login_app();" class="weixin-login">
					<i class="iconfont">&#xe6f7;</i>
					<span>微信</span>
				</a>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>-->

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