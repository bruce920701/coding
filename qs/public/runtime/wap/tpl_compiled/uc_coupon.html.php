<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index page-current" id="uc_coupon">
	<script>
	var eq=parseInt(<?php echo $this->_var['status']; ?>)+1;
	var url=new Array();
	url[1] = '<?php
echo parse_url_tag("u:index|uc_coupon|"."coupon_status=0&order_id=".$this->_var['order_id']."".""); 
?>';
	url[2] = '<?php
echo parse_url_tag("u:index|uc_coupon|"."coupon_status=1&order_id=".$this->_var['order_id']."".""); 
?>';
	url[3] = '<?php
echo parse_url_tag("u:index|uc_coupon|"."coupon_status=2&order_id=".$this->_var['order_id']."".""); 
?>';
	
	var status=parseInt("<?php echo $this->_var['status']; ?>")+1;
	
	</script>
	 
	 <div class="coupon-tab flex-box b-line">
	 	<div class="flex-1 coupon-tab-item"><a href="#tab1" rel="1" class="tab-link j-tab-link btn-item <?php if ($this->_var['status'] == 0): ?>active<?php endif; ?>">团购</a></div>
	 	<div class="flex-1 coupon-tab-item"><a href="#tab2" rel="2" class="tab-link j-tab-link btn-item <?php if ($this->_var['status'] == 1): ?>active<?php endif; ?>">自提</a></div>
	 	<?php if ($this->_var['data']['is_open_distribution']): ?>
	 	<div class="flex-1 coupon-tab-item"><a href="#tab3" rel="3" class="tab-link j-tab-link btn-item <?php if ($this->_var['status'] == 2): ?>active<?php endif; ?>">取货</a></div>
	 	<?php endif; ?>
	 	<span class="tab-line"></span>
	 </div>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>

	<div class="content infinite-scroll infinite-scroll-bottom">
		<div class="tabs">
			<?php if ($this->_var['status'] == 0): ?>
			<div id="tab1" class="tab active j_ajaxlist_1" rel="1">
				<?php if ($this->_var['tuan']): ?>
				<ul class="m-tuan-list j_ajaxadd_1">
					<?php $_from = $this->_var['tuan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item_tuan');if (count($_from)):
    foreach ($_from AS $this->_var['item_tuan']):
?>
					<li class="tuan-item">
						<a href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['item_tuan']['deal_id']."".""); 
?>" data-no-cache="true" class="flex-box good-info b-line">
							<div class="img-box">
								<img src="<?php echo $this->_var['item_tuan']['img']; ?>" alt="">
							</div>
							<div class="flex-1">
								<div class="good-name"><?php echo $this->_var['item_tuan']['name']; ?></div>
								<div class="good-date"><?php if ($this->_var['item_tuan']['end_time']): ?>有效期：<?php echo $this->_var['item_tuan']['coupon_end_time']; ?><?php else: ?>使用期限：永久<?php endif; ?></div>
							</div>
						</a>
						<div class="quan-show">
							<ul class="quan-list">
							<?php $_from = $this->_var['item_tuan']['coupon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tuan_coupon');if (count($_from)):
    foreach ($_from AS $this->_var['tuan_coupon']):
?>
								<li class="flex-box quan-item <?php if ($this->_var['tuan_coupon']['status'] == 1): ?>j-open-quaninfo<?php endif; ?> b-line" <?php if ($this->_var['tuan_coupon']['status'] == 1): ?>data="<?php echo $this->_var['tuan_coupon']['qrcode']; ?>" data-id="<?php echo $this->_var['tuan_coupon']['password']; ?>"<?php endif; ?>>
									<div class="flex-1 <?php if ($this->_var['tuan_coupon']['status'] != 1): ?>isOver<?php endif; ?>">
										券码：<em class="quan-detail"><?php echo $this->_var['tuan_coupon']['password']; ?></em>
										<?php if ($this->_var['tuan_coupon']['status'] == 0): ?>(<?php echo $this->_var['tuan_coupon']['info']; ?>)<?php endif; ?>
									</div>
									<div>
										<i class="iconfont erweima">&#xe60e;</i>
										<i class="iconfont">&#xe607;</i>
									</div>
								</li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
						<?php if ($this->_var['item_tuan']['count'] > 1): ?>
						<div class="show-more-quan j-show-more-quan t-line">
							<em>点击展开</em><i class="iconfont"></i>
						</div>
						<?php endif; ?>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<?php else: ?>
				<div class="tipimg no_data">暂无团购消费券</div>
				<?php endif; ?>
				<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
			</div>
			<?php endif; ?>
			<?php if ($this->_var['status'] == 1): ?>
			<div id="tab2" class="tab active j_ajaxlist_2" rel="2">
				<?php if ($this->_var['pick']): ?>
				<ul class="m-ziti-list j_ajaxadd_2">
					<?php $_from = $this->_var['pick']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pick_item');if (count($_from)):
    foreach ($_from AS $this->_var['pick_item']):
?>
					<li class="ziti-item">
						<div class="order-id b-line">订单编号: <?php echo $this->_var['pick_item']['order_sn']; ?></div>
						<a href="<?php
echo parse_url_tag("u:index|uc_order#view|"."data_id=".$this->_var['pick_item']['order_id']."".""); 
?>" class="store-detail flex-box b-line">
							<div class="store-name flex-1"><i class="iconfont store-iocn">&#xe616;</i><?php echo $this->_var['pick_item']['supplier_name']; ?></div>
							<div><?php if ($this->_var['pick_item']['all_number']): ?>共<?php echo $this->_var['pick_item']['all_number']; ?>件商品<?php endif; ?><i class="iconfont">&#xe607;</i></div>
						</a>
						<div class="quan-show">
							<ul class="quan-list">
								<?php $_from = $this->_var['pick_item']['coupon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pick_coupon');if (count($_from)):
    foreach ($_from AS $this->_var['pick_coupon']):
?>
								<li class="flex-box quan-item <?php if ($this->_var['pick_coupon']['status'] == 1): ?>j-open-quaninfo<?php endif; ?> b-line" <?php if ($this->_var['pick_coupon']['status'] == 1): ?>data="<?php echo $this->_var['pick_coupon']['qrcode']; ?>" data-id="<?php echo $this->_var['pick_coupon']['password']; ?>"<?php endif; ?>>
									<div class="flex-1 <?php if ($this->_var['pick_coupon']['status'] != 1): ?>isOver<?php endif; ?>">
										券码：<em class="quan-detail"><?php echo $this->_var['pick_coupon']['password']; ?></em>
										<?php if ($this->_var['pick_coupon']['status'] == 0): ?>(<?php echo $this->_var['pick_coupon']['info']; ?>)<?php endif; ?>
									</div>
									<div>
										<i class="iconfont erweima">&#xe60e;</i>
										<i class="iconfont">&#xe607;</i>
									</div>
								</li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
						<?php if ($this->_var['pick_item']['count'] > 1): ?>
						<div class="show-more-quan j-show-more-quan t-line">
							<em>点击展开</em><i class="iconfont"></i>
						</div>
						<?php endif; ?>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<?php else: ?>
				<div class="tipimg no_data">暂无自提消费券</div>
				<?php endif; ?>
				<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
			</div>
			<?php endif; ?>
			<?php if ($this->_var['status'] == 2 && $this->_var['data']['is_open_distribution']): ?>
			<div id="tab3" class="tab active j_ajaxlist_3"  rel="3">
				<?php if ($this->_var['dist']): ?>
				<ul class="m-ziti-list j_ajaxadd_3">
					<?php $_from = $this->_var['dist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'dist_item');if (count($_from)):
    foreach ($_from AS $this->_var['dist_item']):
?>
					<li class="ziti-item">
						<div class="order-id b-line">订单编号: <?php echo $this->_var['dist_item']['order_sn']; ?></div>
						<a href="<?php
echo parse_url_tag("u:index|uc_order#view|"."data_id=".$this->_var['dist_item']['order_id']."".""); 
?>" class="store-detail flex-box b-line">
							<div class="store-name flex-1"><i class="iconfont store-iocn">&#xe616;</i><?php echo $this->_var['dist_item']['dist_name']; ?></div>
							<div><?php if ($this->_var['dist_item']['number']): ?>共<?php echo $this->_var['dist_item']['number']; ?>件商品<?php endif; ?><i class="iconfont">&#xe607;</i></div>
						</a>
						<div class="quan-show">
							<ul class="quan-list">
								<li class="flex-box quan-item <?php if ($this->_var['dist_item']['status'] == 1): ?>j-open-quaninfo<?php endif; ?> b-line" <?php if ($this->_var['dist_item']['status'] == 1): ?>data="<?php echo $this->_var['dist_item']['qrcode']; ?>" data-id="<?php echo $this->_var['dist_item']['sn']; ?>"<?php endif; ?>>
									<div class="flex-1 <?php if ($this->_var['dist_item']['status'] == 0): ?>isOver<?php endif; ?>">
										券码：<em class="quan-detail"><?php echo $this->_var['dist_item']['sn']; ?></em>
										<?php if ($this->_var['dist_item']['status'] == 0): ?>(<?php echo $this->_var['dist_item']['info']; ?>)<?php endif; ?>
									</div>
									<div>
										<i class="iconfont erweima">&#xe60e;</i>
										<i class="iconfont">&#xe607;</i>
									</div>
								</li>
							</ul>
						</div>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<?php else: ?>
				<div class="tipimg no_data">暂无驿站取货码</div>
				<?php endif; ?>
				<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="pop-up">
		<div class="close-pop"></div>
		<div class="img-box">
			<div class="img-box-con">
				<div class="pop-quan-id">券码：<em class="j-quan-id"></em></div>
				<div>请将二维码出示给服务人员，扫码使用</div>
				<img src="" alt="" class="j-pop-img">
				<i class="iconfont close-pop-btn j-close-pop-btn">&#xe634;</i>
			</div>
		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>