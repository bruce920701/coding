<?php if ($this->_var['is_verification_code'] == 1): ?>
<div class="form-item" >
  <div class="form-box-text">
    <input class="ui-textbox" readonly="readonly" name="verify_code" value="请选出下图中的&nbsp;<?php echo $this->_var['key']['iconname']; ?>"><span class="batch">换一批</span>
  </div>
  <div class="form-box-icon">
  	<?php $_from = $this->_var['verification_code']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
		<div class="icon-list">
			<i class="iconcode" rel="<?php echo $this->_var['item']['iconcode']; ?>"><?php echo $this->_var['item']['iconfont']; ?></i>
		</div>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <input type="hidden" name="verify_image" value="">
  </div>
  <div class="v_btn_box">
    <input style="-webkit-appearance: none;" type="button" class="v_btn" name="confirm_btn" value="确认">
  </div>
</div>
<?php else: ?>
<div class="v_input_box"><input type="text" class="v_txt" placeholder="图形码" name="verify_image"/><img src="<?php echo $this->_var['APP_ROOT']; ?>/verify.php"  rel="<?php echo $this->_var['APP_ROOT']; ?>/verify.php"/></div>
<div class="blank"></div><div class="blank"></div>
<div class="v_btn_box"><input style="-webkit-appearance: none;"  type="button" class="v_btn" name="confirm_btn" value="确认"/></div>        
<?php endif; ?>
                    
