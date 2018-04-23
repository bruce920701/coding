<style>
.ui-icon{
	width:180px;
	border:none;
	height: 22px;
    color: #666;
}
</style>
<?php if ($this->_var['is_verification_code'] == 2): ?>
<div class="form-item" >
	<input class="ui-textbox ui-icon" name="verify_code" value="请选出下图中的&nbsp;&nbsp;&nbsp;<?php echo $this->_var['key']['iconname']; ?>" readonly="readonly">&nbsp;&nbsp;&nbsp;
	<span style="color:#353d44;cursor:pointer;margin:0;"class="batch">换一批</span>
	<!-- <input type="text" name="verify_code" class="ui-textbox img_verify" holder="请输入图片文字" /> -->
	<div class="form-box-icon clearfix" >
		<?php $_from = $this->_var['verification_code']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
		<div class="icon-list">
			<i class="iconcode" rel="<?php echo $this->_var['item']['iconcode']; ?>"><?php echo $this->_var['item']['iconfont']; ?></i>
		</div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<input type="hidden" name="iconcode" value="">
	</div>
	<!-- <a href="javascript:void(0);" class="refresh_verify">
		<img src="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" class="verify" rel="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" />
	</a> -->
</div>
<span class="form_tip"></span>
<?php else: ?>
<div class="form-item" >
	<input type="text" name="verify_code" value="1234" class="ui-textbox img_verify" placeholder="请输入图片文字" />
	<a href="javascript:void(0);" class="refresh_verify">
		<img src="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" class="verify" rel="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" />
	</a> 
</div>
<span class="form_tip"></span>
<?php endif; ?>