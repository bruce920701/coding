<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/register_page.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/user_register.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/user_register.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/user_register.js";
?>
<?php echo $this->fetch('inc/no-header.html'); ?>
<script type="text/javascript" src="<?php echo $this->_var['APP_ROOT']; ?>/system/region.js"></script>
<script>
	var VERIFICATION_CODE_URL='<?php
echo parse_url_tag("u:index|ajax#verification_code|"."".""); 
?>';
</script>
<div class="login-header">
	<div class="wrap_full_w clearfix">
		<a href="<?php echo $this->_var['APP_ROOT']; ?>/" class="logo f_l"></a>
		<p class="page-tit f_l">欢迎注册</p>
	</div>
</div>
<div class="login-box register_box clearfix">
	<div class="register-panel form_panel" rel="<?php echo $this->_var['form_prefix']; ?>">
		<div class="panel" rel="ph" style="display: block;">
		<form name="<?php echo $this->_var['form_prefix']; ?>_ph_register_form" class="ph_register" method="post" action="<?php
echo parse_url_tag("u:index|user#dophregister|"."".""); 
?>">
			<input type="hidden" name="form_prefix" value="<?php echo $this->_var['form_prefix']; ?>" />
			<div class="form-box">
				<div class="form-item">
					<label>用　户　名</label>
					<input class="ui-textbox" name="user_name" holder="请输入用户名" />
					<div class="success-ico"></div>
				</div>
				<div class="form_tip"></div>
			</div>
			<div class="form-box clearfix" >
				<div class="field_select f_l">
				    <select class="settings_province_id phone ui-select" name="province_id" height="200">
				        <option value="0">所在省份</option>
				    </select>
				</div>
				<div class="field_select f_r">
				    <select class="settings_city_id phone ui-select" name="city_id" height="200">
				        <option value="0">所在城市</option>
				    </select>
				</div>
				<span class="form_tip" style="padding-top: 54px;"></span>
			</div>
			<div class="form-box">
				<div class="form-item">
					<label>设 置 密 码</label>
					<input type="password" name="user_pwd" class="ui-textbox" holder="请输入密码"  rel="ph"/>
					<div class="success-ico"></div>
				</div>
				<div class="form_tip"></div>
			</div>
			<div class="form-box">
				<div class="form-item">
					<label>确 认 密 码</label>
					<input type="password" name="user_pwd_confirm" class="ui-textbox" holder="请再次输入密码" rel="ph" />
					<div class="success-ico"></div>
				</div>
				<div class="form_tip"></div>
			</div>
			<div class="form-box">
				<div class="form-item">
					<label>手 机 号 码</label>
					<input class="ui-textbox" name="user_mobile" value="" holder="请输入手机号" />
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
					<button class="ui-button f_l light ph_verify_btn" rel="light" form_prefix="<?php echo $this->_var['form_prefix']; ?>" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" type="button">发送验证码</button>
				</div>
				<div class="form_tip"></div>
			</div>
			<div class="login-btn">
				立即注册
				<button class="ui-button orange sub-btn" rel="orange" type="submit">立即注册</button>
			</div>
		</form>
		</div>
		<div class="login-side">
			<div class="side-hd">已有账号？<a href="<?php
echo parse_url_tag("u:index|user#login|"."".""); 
?>">请登录</a></div>
			<ul class="other-login-list">
				<li>
					<a href="javascript" id="wx_login" rel="<?php
echo parse_url_tag("u:index|user#wx_login|"."".""); 
?>">
						<i class="iconfont wx-ico">&#xe632;</i>微信登录
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php echo $this->fetch('inc/login_footer.html'); ?>