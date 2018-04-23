<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/user_register.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/login_page.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
?>
<?php echo $this->fetch('inc/no-header.html'); ?>
<script>
	var  VERIFICATION_CODE_URL='<?php
echo parse_url_tag("u:index|ajax#verification_code|"."".""); 
?>';
</script>
<div class="login-header">
	<div class="wrap_full_w clearfix">
		<a href="<?php echo $this->_var['APP_ROOT']; ?>/" class="logo f_l"></a>
		<p class="page-tit f_l">欢迎登录</p>
	</div>
</div>
<div class="wrap_full_w clearfix">
	<div class="login-img f_l">
		<img src="<?php echo $this->_var['TMPL']; ?>/images/login/login-img.png" alt="">
	</div>
	<div class="login_box clearfix login-box f_r">
		<?php if (app_conf ( "SMS_ON" ) == 1): ?>
		<div class="login-tab" rel="<?php echo $this->_var['form_prefix']; ?>">
			<a class="current" href="javascript:void(0);" rel="other" lk="<?php echo $this->_var['form_prefix']; ?>">账户登录</a>
			<!--<a href="javascript:void(0);" rel="ph" lk="<?php echo $this->_var['form_prefix']; ?>">手机登录</a>-->
		</div>
		<div class="blank"></div>
		<div class="blank"></div>
		<?php endif; ?>
		<div class="login-panel form_panel" rel="<?php echo $this->_var['form_prefix']; ?>">
			<div class="panel" rel="other" style="display:block;">
			<form name="<?php echo $this->_var['form_prefix']; ?>_login_form" class="login" method="post" action="<?php
echo parse_url_tag("u:index|user#dologin|"."".""); 
?>">
				<input type="hidden" name="form_prefix" value="<?php echo $this->_var['form_prefix']; ?>" />
				<div class="form-box">
					<div class="form-item">
						<label>用　户　名</label>
						<?php if ($this->_var['user_info']): ?>
						<input class="ui-textbox" disabled="true" holder="请输入用户名/邮箱/手机号" value="<?php echo $this->_var['user_info']['user_name']; ?>" />
						<input type="hidden" value="<?php echo $this->_var['user_info']['user_name']; ?>" name="user_key" />
						<?php else: ?>
						<input class="ui-textbox" name="user_key" holder="请输入用户名/邮箱/手机号" />
						<?php endif; ?>
						<div class="success-ico"></div>
					</div>
					<div class="form_tip"></div>
				</div>
				<div class="form-box">
					<div class="form-item">
						<label>登 录 密 码</label>
						<input type="password" name="user_pwd" class="ui-textbox" holder="请输入密码" />
						<div class="success-ico"></div>
					</div>
					<div class="form_tip"></div>
				</div>
				<div class="form-box ph_img_verify verification_code" <?php if ($this->_var['sms_ipcount'] > 1): ?>style="display:block"<?php endif; ?>>

				</div>
				<div class="form-box clearfix auto-login">
					<label class="ui-checkbox f_l" rel="common_cbo"><input type="checkbox" name="auto_login" value="1" />自动登录</label>
					<a href="<?php
echo parse_url_tag("u:index|user#getpassword|"."".""); 
?>" class="f_r">忘记密码？</a>
				</div>
				<div class="login-btn">
					登录
					<button class="ui-button f_l sub-btn" rel="orange" type="submit">登录</button>
				</div>
				<!--<div class="third-login clearfix">
					<div class="login-way f_l">
						<a href="javascript" id="wx_login" rel="<?php
echo parse_url_tag("u:index|user#wx_login|"."".""); 
?>">
							<i class="iconfont wx-ico">&#xe632;</i>微信登录
						</a>
					</div>
					<a href="<?php
echo parse_url_tag("u:index|user#register|"."".""); 
?>" class="regist_btn f_r">立即注册</a>
				</div>-->
			</form>
			</div>
			<div class="panel" rel="ph" style="display: none;">
			<form name="<?php echo $this->_var['form_prefix']; ?>_ph_login_form" class="ph_login" method="post" action="<?php
echo parse_url_tag("u:index|user#dophlogin|"."".""); 
?>">
				<input type="hidden" name="form_prefix" value="<?php echo $this->_var['form_prefix']; ?>" />
				<div class="form-box">
					<div class="form-item">
						<label>手 机 号 码</label>
						<input class="ui-textbox" name="user_mobile" <?php if ($this->_var['user_info']['mobile']): ?>value="<?php echo $this->_var['user_info']['mobile']; ?>"<?php else: ?>value="<?php echo $this->_var['fanwe_mobile']; ?>"<?php endif; ?> holder="请输入手机号" />
						<div class="success-ico"></div>
					</div>
					<div class="form_tip"></div>
				</div>
				<div class="form-box ph_img_verify verification_code" <?php if ($this->_var['sms_ipcount'] > 1): ?>style="display:block"<?php endif; ?>>

				</div>
				<div class="form-box">
					<div class="form-item">
						<label>手机验证码</label>
						<input class="ui-textbox ph_verify" name="sms_verify" holder="请输入手机验证码" />
						<button class="ui-button light ph_verify_btn f_l" rel="light" form_prefix="<?php echo $this->_var['form_prefix']; ?>" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" type="button">发送验证码</button>
					</div>
					<div class="form_tip"></div>
				</div>
				<div class="form-box clearfix auto-login">
						<label class="ui-checkbox" rel="common_cbo"><input type="checkbox" name="save_mobile" value="1" />记住手机号</label>
				</div>
				<div class="login-btn">
					登录
					<button class="ui-button f_l sub-btn" rel="orange" type="submit">登录</button>
				</div>
				<div class="third-login clearfix">
					<div class="login-way f_l">
						<a href="javascript" id="wx_login" rel="<?php
echo parse_url_tag("u:index|user#wx_login|"."".""); 
?>">
							<i class="iconfont wx-ico">&#xe632;</i>微信登录
						</a>
					</div>
					<a href="<?php
echo parse_url_tag("u:index|user#register|"."".""); 
?>" class="regist_btn f_r">立即注册</a>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>


<?php echo $this->fetch('inc/login_footer.html'); ?>