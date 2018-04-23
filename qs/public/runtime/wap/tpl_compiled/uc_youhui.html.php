<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index page-current" id="uc_youhui">
	<script>
	var url=new Array();
	url[0] = '<?php
echo parse_url_tag("u:index|uc_youhui|"."type=0".""); 
?>';
	url[1] = '<?php
echo parse_url_tag("u:index|uc_youhui|"."type=1".""); 
?>';
	
	var type=parseInt("<?php echo $this->_var['type']; ?>");
	
	</script>
	<div class="list-nav b-line">
		<ul class="flex-box">
			<li class="list-nav-item flex-1 j-list-choose j-youhui <?php if ($this->_var['type'] == 0): ?> active <?php endif; ?>" rel="0"><span>优惠券</span></li>
			<li class="list-nav-item flex-1 j-list-choose j-ecv <?php if ($this->_var['type'] == 1): ?> active <?php endif; ?>" rel="1"><span>红包</span></li>
		</ul>
		<div class="list-nav-line"></div>
	</div>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
		<?php if ($this->_var['type'] == 0): ?>
		<div class="m-youhui-list j-ajaxlist-0">
			<?php if ($this->_var['data']['item']): ?>
			<ul class="j-ajaxadd-0 youhui-list">
			<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<li class="flex-box <?php if ($this->_var['item']['status'] != 1): ?>disable<?php endif; ?>">
					<div class="youhui-line"></div>
					<div class="youhui-price">
						<p class="price"><span>&yen;</span><?php echo $this->_var['item']['youhui_value']; ?></p>
						<p class="price-tip"><?php if ($this->_var['item']['start_use_price']): ?>满<?php echo $this->_var['item']['start_use_price']; ?>元可用<?php else: ?>无使用限制<?php endif; ?></p>
					</div>
					<div class="youhui-info flex-1">
						<p class="youhui-name"><?php if ($this->_var['item']['supplier_id']): ?>店铺券<?php else: ?>自营券<?php endif; ?></p>
						<p class="youhui-time">有效期至：<?php echo $this->_var['item']['expire_time']; ?></p>
						<?php if ($this->_var['item']['youhui_type'] == 1): ?>
						<p class="youhui-code">券码：<span><?php echo $this->_var['item']['youhui_sn']; ?></span></p>
						<?php endif; ?>
						<div class="youhui-tip flex-box">
							<p class="flex-1">
							<?php if ($this->_var['item']['supplier_id']): ?>
							限[<?php echo $this->_var['item']['supplier_name']; ?>]<?php if ($this->_var['item']['youhui_type'] == 1): ?>实体店铺消费使用<?php elseif ($this->_var['item']['youhui_type'] == 2): ?>店铺商品使用<?php endif; ?>
							<?php else: ?>
							限 【平台自营】可用
							<?php endif; ?>
							</p>
							<?php if ($this->_var['item']['youhui_type'] == 1 && $this->_var['item']['supplier_id'] != 0): ?>
							<a href="javascript:void(0);" class="j-support-shop youhui-btn" ajax-url="<?php
echo parse_url_tag("u:index|uc_youhui#get_location|"."id=".$this->_var['item']['youhui_id']."".""); 
?>">支持门店</a>
							<?php endif; ?>
						</div>
						<?php if ($this->_var['item']['youhui_type'] == 1): ?>
						<a href="javascript:void(0);" class="j-qrcode qrcode iconfont" img-url="<?php echo $this->_var['item']['qrcode']; ?>" data-sn="<?php echo $this->_var['item']['youhui_sn']; ?>" ajax-url="<?php
echo parse_url_tag("u:index|uc_youhui#get_location|"."id=".$this->_var['item']['youhui_id']."".""); 
?>">&#xe60e;</a>
						<?php endif; ?>
						<?php if ($this->_var['item']['status'] == 2): ?>
						<div class="youhui-disable"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/youhui-used.png" alt=""></div>
						<?php elseif ($this->_var['item']['status'] == 0): ?>
						<div class="youhui-disable"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/youhui-time-up.png" alt=""></div>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<!-- 红包 -->
			</ul>
			<?php else: ?>
			<div class="tipimg no_data">暂无优惠券</div>
			<?php endif; ?>
			<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
		<?php endif; ?>
		<?php if ($this->_var['type'] == 1): ?>
		<div class="m-youhui-list j-ajaxlist-1">
			<?php if ($this->_var['data']['item']): ?>
			<ul class="j-ajaxadd-1 youhui-list ecv-list">
				<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<li class="flex-box <?php if ($this->_var['item']['status'] != 1): ?>disable<?php endif; ?>">
					<div class="youhui-line"></div>
					<div class="youhui-price">
						<p class="price"><span>&yen;</span><?php echo $this->_var['item']['money']; ?></p>
						<p class="price-tip"><?php if ($this->_var['item']['start_use_price']): ?>满<?php echo $this->_var['item']['start_use_price']; ?>元可用<?php else: ?>无使用限制<?php endif; ?></p>
					</div>
					<div class="youhui-info flex-1">
						<p class="youhui-name"><?php echo $this->_var['item']['name']; ?></p>
						<p class="youhui-time">有效期至：<?php echo $this->_var['item']['end_time']; ?></p>
					</div>
					<?php if ($this->_var['item']['status'] == 2): ?>
					<div class="youhui-disable"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/youhui-used.png" alt=""></div>
					<?php elseif ($this->_var['item']['status'] == 0): ?>
					<div class="youhui-disable"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/youhui-time-up.png" alt=""></div>
					<?php endif; ?>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
			<?php else: ?>
			<div class="tipimg no_data">暂无红包</div>
			<?php endif; ?>
			<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
		<?php endif; ?>
	</div>
	
	<div class="youhui-mask j-close-mask"><div class="iconfont">&#xe68e;</div></div>
	
	<div class="support-shop-box">
		<p class="support-hd">本券限以下实体店到店消费使用</p>
		<ul class="support-list">
			<li class="flex-box">
				<div class="shop-info flex-1 r-line">
					<p class="shop-name">志斌鸭店（马尾店）</p>
					<p class="shop-address">马尾肯德基厕所</p>
				</div>
				<a href="tel:110" class="iconfont">&#xe618;</a>
			</li>
			<li class="flex-box">
				<div class="shop-info flex-1 r-line">
					<p class="shop-name">志斌鸭店（马尾店）</p>
					<p class="shop-address">马尾肯德基厕所</p>
				</div>
				<a href="tel:110" class="iconfont">&#xe618;</a>
			</li>
			<li class="flex-box">
				<div class="shop-info flex-1 r-line">
					<p class="shop-name">志斌鸭店（马尾店）</p>
					<p class="shop-address">马尾肯德基厕所</p>
				</div>
				<a href="tel:110" class="iconfont">&#xe618;</a>
			</li>
		</ul>
	</div>
	<div class="qrcode-box">
		<div class="youhui-code">券码：123456789</div>
		<p class="qrcode-tip">请将二维码出示给服务人员，扫码使用</p>
		<div class="qrcode"><img src="" alt=""></div>
		<p class="support-hd t-line">本券限以下实体店到店消费使用</p>
		<ul class="support-list">
			<li class="flex-box">
				<div class="shop-info flex-1 r-line">
					<p class="shop-name">志斌鸭店（马尾店）</p>
					<p class="shop-address">马尾肯德基厕所</p>
				</div>
				<a href="tel:110" class="iconfont">&#xe618;</a>
			</li>
			<li class="flex-box">
				<div class="shop-info flex-1 r-line">
					<p class="shop-name">志斌鸭店（马尾店）</p>
					<p class="shop-address">马尾肯德基厕所</p>
				</div>
				<a href="tel:110" class="iconfont">&#xe618;</a>
			</li>
			<li class="flex-box">
				<div class="shop-info flex-1 r-line">
					<p class="shop-name">志斌鸭店（马尾店）</p>
					<p class="shop-address">马尾肯德基厕所</p>
				</div>
				<a href="tel:110" class="iconfont">&#xe618;</a>
			</li>
		</ul>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>