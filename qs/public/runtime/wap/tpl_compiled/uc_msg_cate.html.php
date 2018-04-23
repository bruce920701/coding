<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>

<script>
$(document).ready(function() {
	init_list_scroll_bottom();
});
</script>
<div class="page page-index page-current" id="uc_msg_cate">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<?php if ($this->_var['data']['data']): ?>
	<div class="content m-msg-list infinite-scroll infinite-scroll-bottom">
		<div class="j-ajaxlist">
		<div class="j-ajaxadd">
		<?php $_from = $this->_var['data']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'msg');if (count($_from)):
    foreach ($_from AS $this->_var['msg']):
?>
		<div class="msg-item">
			<div class="msg-date"><?php echo $this->_var['msg']['create_time']; ?></div>
			<div class="msg-detail">
				<div class="new-msg"><?php echo $this->_var['msg']['title']; ?></div>
				<a href="<?php if ($this->_var['msg']['link']): ?><?php echo $this->_var['msg']['link']; ?><?php else: ?>javascript:void(0)<?php endif; ?>" class="new-con flex-box" data-no-cache="true">
					<div class="flex-1 nowrap"><?php echo $this->_var['msg']['content']; ?> </div>
					<i class="iconfont">&#xe607;</i>
				</a>
			</div>
		</div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</div>
		<div class="blank"></div>
		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
		<div class="blank"></div>
	</div>
	<?php else: ?>
	<div class="tipimg no_data">
		暂无消息记录
	</div>
	<?php endif; ?>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>