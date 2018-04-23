<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
$(document).ready(function() {
	init_list_scroll_bottom();//下拉刷新加载
});
</script>
<div class="page page-current" id="uc_money_log">
<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
		<?php if ($this->_var['log']): ?>
		<div class="j-ajaxlist">
		<ul class="record-list j-ajaxadd">
			<?php $_from = $this->_var['log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
			<li class="flex-box b-line">
				<div class="user-info">
					<p class="bank-name"><?php echo $this->_var['row']['log_info']; ?></p>
					<p class="time"><?php echo $this->_var['row']['flog_time']; ?></p>
				</div>
				<div class="price-status flex-1">
					<p class="price"><?php echo $this->_var['row']['money']; ?></p>
				</div>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
		<?php else: ?>
		<div class="tipimg no_data">暂无记录</div>
		<?php endif; ?>
	</div>
	<div class="blank"></div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>