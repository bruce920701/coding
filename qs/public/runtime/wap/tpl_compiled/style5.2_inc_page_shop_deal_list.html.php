<?php if ($this->_var['data']['deal_list']): ?>
	<?php $_from = $this->_var['data']['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'supplier_deal');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['supplier_deal']):
?>
		 <li>
			<a href="<?php echo $this->_var['supplier_deal']['url']; ?>">
				<div class="goods-img"><img alt="" date-load="1" data-src="<?php if ($this->_var['supplier_deal']['f_icon'] != ''): ?><?php echo $this->_var['supplier_deal']['f_icon']; ?><?php else: ?><?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png<?php endif; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></div>
				<div class="goods-info">
					<h2 class="goods-name"><?php echo $this->_var['supplier_deal']['name']; ?></h2>
					<div class="sale-info">
						<p class="price"><?php echo $this->_var['supplier_deal']['current_price']; ?><del class="p-price"><?php echo $this->_var['supplier_deal']['origin_price']; ?></del></p>
						<p class="sale"><?php if ($this->_var['supplier_deal']['buy_count'] > 0): ?>已售<?php echo $this->_var['supplier_deal']['buy_count']; ?><?php endif; ?></p>
					</div>
				</div>
			</a>
		</li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>	