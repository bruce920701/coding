<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
$(document).ready(function() {
	init_list_scroll_bottom();//下拉刷新加载
});
</script>
<div class="page page-index page-current" id="uc_lottery">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
		<div class="m-warning"><i class="iconfont">&#xe66f;</i>开奖结果请关注公告~<i class="iconfont close-warning j-close-warning">&#xe634;</i></div>
		<div class="j-ajaxlist">
		<ul class="m-lottery-list j-ajaxadd">
		<?php if ($this->_var['item']): ?>
		<?php $_from = $this->_var['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
			<li class="flex-box lottery-item">
				<img src="<?php echo $this->_var['item']['icon']; ?>" alt="" class="lottery-img">
				<div class="flex-1">
					<div class="lottery-name"><?php if ($this->_var['item']['name']): ?><?php echo $this->_var['item']['name']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
					<div class="lottery-id">抽奖号：<em><?php if ($this->_var['item']['lottery_sn']): ?><?php echo $this->_var['item']['lottery_sn']; ?><?php else: ?>&nbsp;<?php endif; ?></em></div>
				</div>
			</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php else: ?>
		<div class="tipimg no_data">
			暂无抽奖码记录
		</div>
		<?php endif; ?>
		</ul>
		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
	</div>
	<div class="pop-up">
		<div class="close-pop"></div>
		<div class="img-box">
			<div class="img-box-con">
				<div class="pop-quan-id">券码：<em class="j-quan-id"></em></div>
				<div>请扫描二维码进行验证</div>
				<img src="" alt="" class="j-pop-img">
				<i class="iconfont close-pop-btn j-close-pop-btn">&#xe634;</i>
			</div>

		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>