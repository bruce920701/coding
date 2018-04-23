<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script type="text/javascript">
	var is_region_lv1_reset = '1';
</script>	
<div class="page page-index" <?php if (! $this->_var['check']): ?>id="uc_address_index"<?php else: ?>id="order_address"<?php endif; ?>>
	<script>
	var set_default_url="<?php
echo parse_url_tag("u:index|uc_address#set_default|"."".""); 
?>";
	</script>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<nav class="bar bar-tab u-add-address">
		<a class="tab-item load_page2"   href="javascript:void(0);" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/address_add.js' url="<?php echo $this->_var['data']['add_url']; ?>">
			<span class="tab-label"><i class="iconfont">&#xe62e;</i>添加新地址</span>
		</a>
	</nav>


	<div class="content">
		<!-- 页面主体 -->
		<?php if ($this->_var['data']['is_pick'] == 1 && $this->_var['data']['location']): ?>
			<?php if ($this->_var['data']['location']): ?>
			<div class="list-hd">自提门店</div>
			<?php endif; ?>
			<div class="m-pick-shop-list">		
				<ul class="pick-shop-list">
					<?php $_from = $this->_var['data']['location']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'location');$this->_foreach['location'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['location']['total'] > 0):
    foreach ($_from AS $this->_var['location']):
        $this->_foreach['location']['iteration']++;
?>
					<li class="t-line pick_address" url="<?php echo $this->_var['location']['carturl']; ?>" >
						<?php if ($this->_var['location']['name']): ?><p class="shop-name"><?php echo $this->_var['location']['name']; ?></p><?php endif; ?>
						<?php if ($this->_var['location']['address']): ?><p class="shop-address">地址：<?php echo $this->_var['location']['address']; ?></p><?php endif; ?>
						<?php if ($this->_var['location']['tel']): ?><p class="shop-phone">电话：<?php echo $this->_var['location']['tel']; ?></p><?php endif; ?>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<?php if ($this->_var['data']['location_count'] > 2): ?>
				<div class="check-more t-line">查看更多<i class="iconfont">&#xe608;</i></div>
				<div class="check-back t-line">收起<i class="iconfont">&#xe606;</i></div>
				<?php endif; ?>
			</div>
			<?php if ($this->_var['data']['consignee_list']): ?>
			<div class="list-hd">收货地址</div>
			<?php endif; ?>
		<?php endif; ?>
		
		
		<div class="list-block">
			<ul class="m-address-list" is_default="<?php echo $this->_var['data']['is_default']; ?>">
				<?php $_from = $this->_var['data']['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'consignee');$this->_foreach['consignee'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['consignee']['total'] > 0):
    foreach ($_from AS $this->_var['consignee']):
        $this->_foreach['consignee']['iteration']++;
?>
				<li>
					<div class="item-content m-address-top <?php if ($this->_var['check']): ?>address<?php endif; ?>" <?php if ($this->_var['check']): ?>data-id="<?php echo $this->_var['consignee']['id']; ?>" url="<?php echo $this->_var['consignee']['carturl']; ?>"<?php endif; ?>>
						<div class="item-inner u-address-title">
							<div class="item-title"><?php echo $this->_var['consignee']['consignee']; ?></div>
							<div class="item-after"><?php echo $this->_var['consignee']['mobile']; ?></div>
						</div>
					</div>
					<div class="item-content m-address-body b-line <?php if ($this->_var['check']): ?>address<?php endif; ?>" <?php if ($this->_var['check']): ?>data-id="<?php echo $this->_var['consignee']['id']; ?>" url="<?php echo $this->_var['consignee']['carturl']; ?>"<?php endif; ?>>
						<div class="item-inner">
							<div class="item-text u-address-mess"><?php echo $this->_var['consignee']['full_address']; ?></div>
						</div>
					</div>
					<div class="item-content m-address-bottom j-address-set">
						<label class="label-checkbox j-select-title">
							<input <?php if ($this->_var['consignee']['is_default'] == 1): ?>checked="true"<?php endif; ?> type="radio" name="my-radio" dfurl="<?php echo $this->_var['consignee']['dfurl']; ?>">
							<div class="item-media">
								<i class="icon icon-form-checkbox"></i>
								<div class="item-title u-set-default <?php if ($this->_var['consignee']['is_default'] == 1): ?>j-address-color<?php endif; ?>">设为默认</div>
							</div>
						</label>
						<div class="item-inner u-address-edit j-address-color">
							<div class="item-title-row"></div>
							<div class="item-after">
								<a href="javascript:void(0);" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/address_add.js' url="<?php echo $this->_var['consignee']['url']; ?>" class="u-address-opra load_page2"><i class="iconfont">&#xe600;</i>编辑</a>
								<span class="u-address-opra confirm-address" del_url="<?php echo $this->_var['consignee']['del_url']; ?>" data-id="<?php echo $this->_var['consignee']['id']; ?>"><i class="iconfont">&#xe601;</i>删除</span>
							</div>
						</div>
					</div>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>