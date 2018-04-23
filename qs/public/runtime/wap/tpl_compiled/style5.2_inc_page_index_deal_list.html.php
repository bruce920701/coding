<?php if ($this->_var['data']['deal_list']): ?>
	<?php $_from = $this->_var['data']['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');if (count($_from)):
    foreach ($_from AS $this->_var['deal']):
?>
		<li>
			<a href="<?php echo $this->_var['deal']['url']; ?>">
				<div class="goods-img"><img alt="" date-load="1" data-src="<?php echo $this->_var['deal']['f_icon']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></div>
				<div class="goods-info">
					<h2 class="goods-name"><?php echo $this->_var['deal']['name']; ?></h2>
					<div class="sale-info">
						<p class="price"><?php echo $this->_var['deal']['current_price']; ?></p>
						<?php if ($this->_var['deal']['buy_count'] > 0): ?>
						<p class="sale">已售<?php echo $this->_var['deal']['buy_count']; ?></p>
						<?php endif; ?>
					</div>
				</div>
			</a>
		</li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
