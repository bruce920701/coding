<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/getpassword_page.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/user_m_getpassword.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/user_m_getpassword.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<style>
.form_panel dl dd .ui-textbox.hover{border: 1px solid #ddd;box-shadow:none;}
.form_panel dl dd .ui-textbox{background:none;}
.form_panel dl dd {
	height:auto;
}
.form-item .icon-list{
	float: left;
	text-align: center;
	padding: 5px 0;
	width: 20%;
    box-sizing: border-box;
    border: 1px solid rgba(255, 255, 255, 0);
}
.icon-list.active{
    border: 1px solid #f80;
    color: #f80;
}
.form_panel dl dd .icon-list i{
	display: block;
	font-size: 50px;
	line-height: 50px;
	float: none;
}
.weedialog.weebox .dialog-content{
	height: 496px;
}
.form-box-icon{
	margin:10px 0;
	
}
.ui-checkbox{
	margin-top:10px;
}
.batch{
	line-height:36px;
	margin-left:50px;
}
</style>
<script>
	var VERIFICATION_CODE_URL='<?php
echo parse_url_tag("u:index|ajax#verification_code|"."".""); 
?>';
</script>
<div class="blank20"></div>
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?>">

	
	<div class="layout_box">	
	<div class="title">短信找回密码</div>
	<div class="content clearfix" id="getpassword_form">	
		<div class="form_panel">
		<div class="panel">
		<form name="getpassword_form" class="getpassword" method="post" action="<?php
echo parse_url_tag("u:index|user#dogetpassword_m|"."".""); 
?>">
			
			<dl>
				<dt>手机</dt>
				<dd>
					<input class="ui-textbox" name="user_mobile" holder="请输入您用来登录的手机号码" />
					<span class="form_tip"></span>
				</dd>
			</dl>			
			
			<dl class="ph_img_verify clearfix" <?php if ($this->_var['sms_ipcount'] > 1): ?>style="display:block;height:auto;"<?php endif; ?>>
				<dt>图片验证码</dt>
				<dd>
					<div class="form-box ph_img_verify verification_code" >
					</div>
				</dd>
			</dl>	
					
			<dl>
				<dt>验证码</dt>
				<dd>
					<input class="ui-textbox ph_verify" name="sms_verify" holder="请输入验证码" />
					<button class="ui-button light ph_verify_btn f_l" rel="light" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" type="button">发送验证码</button>
					<span class="form_tip"></span>
				</dd>
			</dl>
			
			<dl>
				<dt></dt>
				<dd>
					<button class="ui-button orange f_l" rel="orange" type="submit">找回密码</button>
				</dd>
			</dl>
			
		</form>
		</div>
		</div>
	</div><!--end content-->
	</div>
	

</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>