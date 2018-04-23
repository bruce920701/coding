<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
$(document).ready(function() {
	init_list_scroll_bottom();//下拉刷新加载
});
</script>
<div class="page page-current" id="uc_withdraw_log">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
	<div class="j-ajaxlist">
	<?php if ($this->_var['data']['data']): ?>
		<ul class="record-list j-ajaxadd">
			<?php $_from = $this->_var['data']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
			<li class="flex-box b-line">
				<div class="user-info">
					<p class="bank-name"><?php echo $this->_var['row']['bank_name']; ?></p>
					<p class="bank-name"><?php echo $this->_var['row']['bank_user']; ?><?php echo $this->_var['row']['bank_info']; ?></p>
					<p class="time"><?php echo $this->_var['row']['create_time']; ?></p>
				</div>
				<div class="price-status flex-1">
					<p class="price"><span>&yen;</span><?php echo $this->_var['row']['money']; ?></p>
					<p class="status<?php if ($this->_var['row']['is_paid'] == 1): ?>success<?php endif; ?>"><?php if ($this->_var['row']['is_paid'] == 1): ?>提现成功<?php else: ?><?php if ($this->_var['row']['is_paid'] == 2): ?>审核未通过<?php else: ?>审核中<?php endif; ?><?php endif; ?></p>
				</div>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<!-- <?php $_from = $this->_var['data']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
			<li>
			    <span class="fr">&yen;<?php echo $this->_var['row']['money']; ?></span>
				<p class="pay-way"><?php echo $this->_var['row']['bank_name']; ?></p>
				<time>状态：<?php if ($this->_var['row']['is_paid'] == 1): ?>提现成功<?php else: ?>审核中<?php endif; ?></time>
				<p class="payed"><?php echo $this->_var['row']['create_time']; ?></p>
				<div class="clear"></div>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
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