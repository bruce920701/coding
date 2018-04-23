<?php if ($this->_var['data']['deal_list']): ?>
	<?php $_from = $this->_var['data']['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'supplier_deal_item');$this->_foreach['supplier_deal_item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['supplier_deal_item']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['supplier_deal_item']):
        $this->_foreach['supplier_deal_item']['iteration']++;
?>
		<li class="b-line">
			<a href="<?php echo $this->_var['supplier_deal_item']['url']; ?>">
				<div class="goods-img">
					<img alt="" date-load="1" data-src="<?php if ($this->_var['supplier_deal_item']['f_icon'] != ""): ?><?php echo $this->_var['supplier_deal_item']['f_icon']; ?><?php else: ?><?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png<?php endif; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/>
					<div class="tuan-sale-info">
						<p class="sale"><?php if ($this->_var['supplier_deal_item']['buy_count'] > 0): ?>已售<?php echo $this->_var['supplier_deal_item']['buy_count']; ?><?php endif; ?></p>
						<p class="distance"><?php echo $this->_var['supplier_deal_item']['distance']; ?></p>
					</div>
				</div>
				<div class="goods-info">
					<div class="tuan-name"><h2><?php echo $this->_var['supplier_deal_item']['supplier_name']; ?></h2><p class="distance"><?php echo $this->_var['supplier_deal_item']['distance']; ?></p></div>
					<p class="tuan-tip"><?php echo $this->_var['supplier_deal_item']['brief']; ?></p>
					<div class="sale-info">
						<p class="price"><?php echo $this->_var['supplier_deal_item']['current_price']; ?><del class="p-price"><?php echo $this->_var['supplier_deal_item']['origin_price']; ?></del></p>
						<p class="sale"><?php if ($this->_var['supplier_deal_item']['buy_count'] > 0): ?>已售<?php echo $this->_var['supplier_deal_item']['buy_count']; ?><?php endif; ?></p>
					</div>
				</div>
			</a>
		</li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>	