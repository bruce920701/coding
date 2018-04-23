<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_account.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_account.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_account.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>

<script type="text/javascript" src="<?php echo $this->_var['APP_ROOT']; ?>/system/region.js"></script>	
<script>
var UPLOAD_URL = '<?php
echo parse_url_tag("u:index|file#upload_avatar|"."".""); 
?>';
</script>
<div class="blank20"></div>

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
		
		<div class="main_box setting_user_info">
			
			<form name="setting_user_info" action="<?php
echo parse_url_tag("u:index|uc_account#save|"."".""); 
?>" method="post" bindsubmit="true">
			<div class="content">
				<div class="title"><span>基本信息</span></div>
				<?php if ($this->_var['user_info']['is_tmp'] == 1): ?>
				<div class="confirm_login_tip">
				为确保账户安全，请完善会员资料以及会员密码
				</div>
				<?php endif; ?>
				<div class="blank20"></div>
				<div class="content_item clearfix">
					
					<div class="upimg_box clearfix">

						<h3>没头像，没礼貌</h3>
						<div class="avatar_box">
							<img class="avatar" src="<?php 
$k = array (
  'name' => 'get_user_avatar',
  'uid' => $this->_var['user_info']['id'],
  'type' => 'big',
);
echo $k['name']($k['uid'],$k['type']);
?>"/>
						</div>
						<div class="loading hide"></div>
						<div class="up_btn"><button class="ui-button upload_avatar_btn" rel="light" id="upload_avatar_btn" type="button">选择文件</button></div>
						<div class="img_tip">支持<?php 
$k = array (
  'name' => 'app_conf',
  'p' => 'ALLOW_IMAGE_EXT',
);
echo $k['name']($k['p']);
?></div>
						<div class="blank0"></div>
					</div>
					<div class="info_box">
						<div class="blank20"></div>
						<div class="field_group clearfix">
							<label class="f_label">Email</label>
							<div class="f_text">
								<?php if ($this->_var['user_info']['email']): ?>
									<input type="text" id="settings_email" name="email" value="<?php echo $this->_var['user_info']['email']; ?>"  holder="" readonly="readonly"/>
								<?php else: ?>
									<input type="text" id="settings_email" name="email" value="<?php echo $this->_var['user_info']['email']; ?>" class="ui-textbox " holder=""/>
								<?php endif; ?>
							</div>
						</div>
						<div class="field_group clearfix">
							<label class="f_label">用户名</label>
							<div class="f_text">
								<?php if ($this->_var['user_info']['is_tmp']): ?>
									<input type="text" id="settings_user_name" name="user_name" value="<?php echo $this->_var['user_info']['user_name']; ?>" class="ui-textbox " holder=""/>
								<?php else: ?>
									<input type="text" id="settings_user_name" name="user_name" value="<?php echo $this->_var['user_info']['user_name']; ?>"  holder="" readonly="readonly" />
								<?php endif; ?>
							</div>
						</div>
						<div class="field_group clearfix">
							<label class="f_label">当前密码</label>
							<div class="f_text">
								<input type="password" id="current_password" name="current_password" class="ui-textbox" holder="请输入当前密码"/>
							</div>
						</div>
						<div class="field_group clearfix">
							<label class="f_label">新密码</label>
							<div class="f_text">
								<input type="password" id="settings_password" name="user_pwd" class="ui-textbox" holder="如果不想修改密码，请保持空白"/>
							</div>
						</div>
						<div class="field_group clearfix">
							<label class="f_label">确认密码</label>
							<div class="f_text">
								<input type="password" id="settings_password_confirm" name="user_pwd_confirm" class="ui-textbox" holder=""/>
							</div>
						</div>	
						<div class="field_group clearfix">
							<label class="f_label">手机号</label>
							<div class="f_text">
								<input type="text" id="settings_mobile" name="mobile" value="<?php echo $this->_var['user_info']['mobile']; ?>" data="<?php echo $this->_var['user_info']['mobile']; ?>" class="ui-textbox f_text" holder=""/>
							</div>
							<input type="hidden" class="is_check_mobile" name="is_check_mobile" value="0"/>
						</div>	
						<!--短信验证手机号-->
						<?php if (app_conf ( "SMS_ON" ) == 1): ?>
						
						<div class="ph_img_verify field_group clearfix ph_sms_verify" <?php if ($this->_var['sms_ipcount'] > 1): ?>style="display:block"<?php endif; ?>>
							<label class="f_label">图形验证码</label> 
							<div class="sms_verify_box">
								<div class="f_text">
									<input type="text" name="verify_code" class="ui-textbox img_verify f_l" style="width:150px;" holder="请输入图片文字" />
									<img src="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" class="verify f_l" style="padding:8px 0 0 5px; cursor:pointer;" rel="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" />
									<a href="javascript:void(0);" class="refresh_verify f_l" style="padding:10px 0 0 5px;">看不清楚？换一张！</a>
								</div>
								
							</div>
							<div class="status_icon hide"> <i class=""></i></div>
							<div class="clear"></div>
						</div>
						
						<div class="field_group clearfix ph_sms_verify">
							<label class="f_label">验证手机号</label> 
							<div class="sms_verify_box">
								<div class="f_text">
									<input class="ui-textbox f_l ph_verify" id="sms_verify" name="sms_verify" holder="请输入验证码" />
								</div>
								<button class="ui-button f_l light ph_verify_btn" rel="light" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" type="button">发送验证码</button>
							</div>
							<div class="status_icon hide"> <i class=""></i></div>
							<div class="clear"></div>
						</div>
						

						
						<?php endif; ?>
					</div>
				
				</div>
			</div>
			
			<div class="blank20"></div>
			
			<div class="content" >
				<div class="title"><span>更多用户资料</span></div>
				<div class="content_item clearfix" style="border:none;">
					
					<div class="content_box">
						<div class="blank20"></div>
						
						<div class="field_group clearfix">
							<label class="f_label">用户所在地</label>
							<div class="field_select f_l" style="padding-right:10px;">
								<select id="settings_province_id" name="province_id" class="ui-select" height="200">
									<option value="0">所在省份</option>
									<?php $_from = $this->_var['region_lv2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv2');if (count($_from)):
    foreach ($_from AS $this->_var['lv2']):
?>
									<option <?php if ($this->_var['lv2']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv2']['id']; ?>"><?php echo $this->_var['lv2']['name']; ?></option>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</select>
							</div>

							<div class="field_select f_l">
								<select id="settings_city_id" name="city_id" class="ui-select" height="200">
									<option value="0">所在城市</option>		
									<?php $_from = $this->_var['region_lv3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv3');if (count($_from)):
    foreach ($_from AS $this->_var['lv3']):
?>
									<option <?php if ($this->_var['lv3']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv3']['id']; ?>"><?php echo $this->_var['lv3']['name']; ?></option>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</select>
							</div>
							
						</div>
						<div class="field_group clearfix">
							<label class="f_label">出生日期</label>
							<div class="field_select f_l" style="padding-right:10px;">
								<select id="settings_byear" name="byear" class="ui-select" height="200">
									<option value="0">年</option>
									<?php for($i = date("Y") - 100 ;$i<=date("Y"); $i++){ ?>
									<option value="<?php echo $i; ?>" <?php if($i==$GLOBALS['user_info']['byear']){echo 'selected="selected"';} ?>><?php echo $i; ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="field_select f_l" style="padding-right:10px;">
								<select id="settings_bmonth" name="bmonth" class="ui-select" height="200">
									<option value="0">月</option>
									<?php for($i = 1 ;$i<=12; $i++){ ?>
									<option value="<?php echo $i; ?>"  <?php if($i==$GLOBALS['user_info']['bmonth']){echo 'selected="selected"';} ?>><?php echo $i; ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="field_select f_l" style="padding-right:10px;">
								<select id="settings_bday" name="bday" class="ui-select" height="200">
									<option value="0">日</option>
									<?php for($i = 1 ;$i<=31; $i++){ ?>
									<option value="<?php echo $i; ?>" <?php if($i==$GLOBALS['user_info']['bday']){echo 'selected="selected"';} ?>><?php echo $i; ?></option>
									<?php
									}
									?>
								</select>
							</div>

						</div>
						<div class="field_group clearfix">
							<label class="f_label">性别</label>
							<div class="field_select f_l">
								<select id="settings_sex" name="sex" class="ui-select" height="200">
									<option value="-1" >保密</option>		
									<option value="0" <?php if ($this->_var['user_info']['sex'] == 0): ?>selected="selected"<?php endif; ?> >女</option>	
									<option value="1" <?php if ($this->_var['user_info']['sex'] == 1): ?>selected="selected"<?php endif; ?>>男</option>	
								</select>
							</div>
						</div>
						<div class="field_group clearfix">
							<label class="f_label">个人简介</label>
							<textarea class="ui-textarea" style="resize:none;width:472px; height:100px; border:#ccc solid 1px;font-size:14px;word-spacing:8px; letter-spacing: 1px;" cols="10" name="my_intro"><?php echo $this->_var['user_info']['my_intro']; ?></textarea>
						</div>
						
					</div>
					<div class="blank20"></div>
				</div>
				<div class="title"><span>第三方资料设置</span></div>
				<div class="blank20"></div>
				<div class="api_group">
					<div class="f_l label_txt">同步到其他网站：</div>
					<div class="f_l api_box">
						<ul>
							<?php $_from = $this->_var['apis']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<li class="api_item">
								<span><i class="iconfont"><?php echo $this->_var['row']['iconfont']; ?></i><?php echo $this->_var['row']['api_item']['name']; ?></span>
								<span class="clearance10"></span>
								<span><?php if ($this->_var['row']['is_bind'] == 1): ?><a class="item_link_btn" href="javascript:void(0);" onclick="unset_bind_api('<?php echo $this->_var['row']['class_name']; ?>');">取消绑定</a><?php else: ?><a class="item_link_btn" href="<?php echo $this->_var['row']['api_item']['url']; ?>">设置</a><?php endif; ?></span>
								<span class="clearance10"></span>
								<?php if ($this->_var['row']['is_bind'] == 1 && $this->_var['row']['is_weibo'] == 1): ?><label class="ui-checkbox" rel="common_cbo"><input type="checkbox" class="syn_weibo" autocomplete="off" name="is_syn_<?php echo $this->_var['row']['api_item']['class']; ?>" value="1" data="<?php echo $this->_var['row']['class_name']; ?>" <?php if ($this->_var['row']['is_syn'] == 1): ?>checked=checked<?php endif; ?> />同步微博</label><?php endif; ?>
							</li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</ul>
					</div>
				</div>
				<div class="blank20"></div>
				<div class="content_item clearfix" style="border:none;">
						<div class="blank20"></div>
						<div class="field_group clearfix" style="margin-left:120px">
							<input type="hidden" value="<?php echo $this->_var['user_info']['id']; ?>" name="id" />
							<input type="hidden" name="is_ajax" value="1" />
							<button class="ui-button " rel="orange">保存修改</button>
						</div>
				</div>
			</div>
			</form>

			<div class="blank20"></div>
		</div>
	</div>	
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>