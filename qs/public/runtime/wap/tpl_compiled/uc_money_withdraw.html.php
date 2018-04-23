<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
	AJAX_URL = '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
	var bank='<?php echo $this->_var['data']['bank']; ?>';
	var add_url="<?php
echo parse_url_tag("u:index|uc_money#add_card|"."".""); 
?>";
	var all_money=parseFloat('<?php echo $this->_var['data']['money']; ?>');
	var r_url="<?php
echo parse_url_tag("u:index|uc_account#phone|"."".""); 
?>";
	function ac_phone(){
		var phone=$("#phonenumer").val();
		if(phone == ''){
			setTimeout(function(){
				location.href = r_url;
			},1500);
		}
	}
</script>
<div class="page page-current" id="uc_money_withdraw">
<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content">
	 	<div id="withdraw">
	 	<?php if ($this->_var['data']['step'] == 1): ?>
	 	<form action="<?php
echo parse_url_tag("u:index|uc_money#do_withdraw|"."".""); 
?>" method="post" name="withdraw">
	 		<div class="bank-select <?php if (! $this->_var['bank_list']): ?>load_page<?php endif; ?> flex-box" <?php if (! $this->_var['bank_list']): ?> url="<?php
echo parse_url_tag("u:index|uc_money#add_card|"."".""); 
?>"  js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/add_card.js'<?php endif; ?>>
	 			<div class="bank-info flex-1">
	 				<?php if ($this->_var['bank_list']): ?>
	 				<p class="bank-name"><?php echo $this->_var['data']['bank_info']; ?></p>
	 				<p class="user-info"><?php echo $this->_var['data']['bank_user']; ?></p>
	 				<?php else: ?>
	 				<p class="bank-name">暂无银行卡</p>
	 				<?php endif; ?>
	 			</div>
	 			<i class="iconfont right-arrow">&#xe607;</i>
	 		</div>
	 		<div class="can-use">
	 			<p class="can-use-num"><?php if ($this->_var['data']['money'] > 0): ?>可提现余额 <?php echo $this->_var['data']['money']; ?>元<?php else: ?>无可提现余额<?php endif; ?></p>
	 		</div>
			<ul class="address-input withdraw-list">
				<li class="b-line">
					<span>提现金额</span>
					<input class="ui-textbox" value="" type="text" name="money" <?php if ($this->_var['data']['money'] == 0): ?>disabled="disabled"  placeholder="无可提现余额"<?php else: ?> placeholder="请输入提现金额"<?php endif; ?>  pattern="([0-9]*)|(\d+(\.\d{1,2}))" onkeyup="value=value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3') " />
				</li>
			<!--	<li class="b-line">
					<span>登录密码</span>
					<input class="ui-textbox" value="" name="pwd" type="password"  placeholder="请输入登录密码" <?php if ($this->_var['data']['money'] == 0): ?>disabled="disabled"<?php endif; ?>/>
				</li>-->
				<li class="b-line">
					<span>验证码</span>
					<input class="ui-textbox ph_verify" id="mobile_verify" name="mobile_verify" placeholder="请输入验证码" />
					<div class="l-line">
						<input class="btn_phone l-line j-mobilesendBtn isUseful" type="Button"  id="uc_withdraw_btn" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" main="1" account="1" value="发送验证码" />
					</div>
				</li>


				<!-- <?php $_from = $this->_var['data']['bank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
				<li class="b-line bank" >
					<label><?php echo $this->_var['item']['bank_name']; ?><span  bank_name="<?php echo $this->_var['item']['bank_name']; ?>" rel="<?php echo $this->_var['item']['id']; ?>"  <?php if ($this->_var['key'] == 0): ?>class="checked"<?php endif; ?>></span></label>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->

				<!-- <?php $_from = $this->_var['data']['bank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
				<li class="b-line bank" >
					<label><?php echo $this->_var['item']['bank_name']; ?><span  bank_name="<?php echo $this->_var['item']['bank_name']; ?>" rel="<?php echo $this->_var['item']['id']; ?>"  <?php if ($this->_var['key'] == 0): ?>class="checked"<?php endif; ?>></span></label>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
				<input type="hidden" value="<?php echo $this->_var['data']['mobile']; ?>" name="mobile" id="mobile"/>
				<input type="hidden" value="<?php echo $this->_var['data']['default_id']; ?>" name="bank_id"/>
				</ul>
				<div class="big-btn">
					<input type="button" class="sub goahead btn-con withdraw_submit" value="确认提现">
				</div>
				</form>
				<?php elseif ($this->_var['data']['step'] == 2): ?>
				<form action="<?php
echo parse_url_tag("u:index|uc_money#do_bind_bank|"."".""); 
?>" method="post" name="add_card">
				<ul class="address-input">
				<li class="b-line">
					<span>卡号</span>
					<input  name="bank_account" value="" type="number" pattern="[0-9]*" class="ui-textbox" placeholder="请输入银行卡号" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"/>
				</li>
				<li class="b-line">
					<span>开户行</span>
					<input  name="bank_name" value="" class="ui-textbox" placeholder="请输开户行名称" />
				</li>
				<li class="b-line">
					<span>持卡人</span>
					<input  name="bank_user" value="" class="ui-textbox" placeholder="请输入开户银行真实姓名" />
				</li>
				<li class="b-line">
					<span>验证码</span>
					<input class="ui-textbox ph_verify" id="sms_verify" name="sms_verify" placeholder="请输入验证码" />
					<div class="l-line">
						<input class="btn_phone l-line j-sendBtn isUseful" type="Button"  id="uc_sms_btn" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" account="1" main="2" value="发送验证码" onclick="ac_phone();"/>
					</div>
				</li>
				<input type="hidden" id="phonenumer" value="<?php echo $this->_var['data']['mobile']; ?>" name="bank_mobile"/>
				<div class="big-btn">
                    <input type="submit" class="sub btn-con" value="提交">
				</div>
				</form>
				<?php endif; ?>
			</ul>
	 	</div>
	</div>
	<div class="select-bank">
		<div class="mask"></div>
		<div class="bank-list">
			<div class="close-btn"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/close-btn.png" alt=""></div>
			<div class="hd b-line">选择提现的银行卡</div>
			<ul>
			<?php $_from = $this->_var['bank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
				<li class="flex-box b-line" bank_id="<?php echo $this->_var['item']['id']; ?>">
					<div class="bank-info flex-1">
						<p class="bank-name"><?php echo $this->_var['item']['bank_name']; ?></p>
						<p class="user-info"><?php echo $this->_var['item']['bank_user']; ?></p>
					</div>
					
					<i class="iconfont <?php if ($this->_var['item']['id'] == $this->_var['data']['default_id']): ?>selected<?php endif; ?>">&#xe66c;</i>
					
				</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
			<a href="javascript:void(0);" url="<?php
echo parse_url_tag("u:index|uc_money#add_card|"."".""); 
?>" class="flex-box add-bank b-line t-line load_page" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/add_card.js'>
				<p class="flex-1">添加新卡提现</p>
				<i class="iconfont right-arrow">&#xe607;</i>
			</a>
		</div>
	</div>
	<?php if ($this->_var['data']['step'] == 2): ?>
	<div id="main2"><?php echo $this->fetch('style5.2/inc/module/sms_verify_code.html'); ?></div>
	<?php elseif ($this->_var['data']['step'] == 1): ?>
	<div id="main1"><?php echo $this->fetch('style5.2/inc/module/sms_verify_code.html'); ?></div>
	<?php endif; ?>




</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
