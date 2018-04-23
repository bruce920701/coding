<?php if ($this->_var['score_purchase']['score_purchase_switch'] == 1 && $this->_var['score_purchase']['exchange_money'] > 0): ?>
<div class="m-conBox m-logist score_purchase">
	<a href="javascript:void(0);" class="item-content b-line">
		<div class="item-media"><i class="icon icon-f7"></i></div>
		<div class="item-inner u-common-inline ">
			<div class="item-title">
				<p class="u-lg-price-score">
					使用
					<span class="u-score"><?php echo $this->_var['score_purchase']['user_use_score']; ?></span>
					积分抵扣
					<span class="u-money"><?php echo $this->_var['score_purchase']['exchange_money']; ?> <small>积分</small></span>
				</p>
				<p class="u-lg-price-score">
					可用积分
					<span class="u-score"><?php echo $this->_var['score_purchase']['user_score']; ?></span>
				</p>
			</div>
			<div class="item-after">
				<label class="label-checkbox">
					<input type="checkbox" name="all_score" <?php if ($this->_var['all_score'] == 1): ?> checked="checked"<?php endif; ?> value="1">
					<div id="all_score" class="item-media <?php if ($this->_var['all_score'] == 1): ?> active<?php endif; ?>" >
						<i class="icon icon-form-checkbox"></i>
					</div>
				</label>
			</div>
		</div>
	</a>
</div>
<?php endif; ?>

<div class="m-conBox m-oreder-derail">
	<?php if ($this->_var['feeinfo']): ?>
	<div class="presell-price-info">
		<?php $_from = $this->_var['feeinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'fee');if (count($_from)):
    foreach ($_from AS $this->_var['fee']):
?>
		<?php if ($this->_var['fee']['symbol'] != 3): ?>
	    <div class="flex-box price-all">
	        <p class="flex-1"><?php echo $this->_var['fee']['name']; ?></p>
	        <p class="price"><?php if ($this->_var['fee']['symbol'] == - 1): ?>- <?php endif; ?><?php if ($this->_var['fee']['symbol'] == 1): ?><?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['fee']['value'],
);
echo $k['name']($k['v']);
?><?php else: ?><?php echo $this->_var['fee']['value']; ?><?php endif; ?><small>积分</small></p>
	    </div>
	    <?php else: ?>
	    <div class="flex-box price-item <?php if ($this->_var['fee']['tag'] == 1): ?>active<?php endif; ?>" >
	        <div class="price-circle"></div>
	        <div class="price-line"></div>
	        <p class="flex-1"><?php echo $this->_var['fee']['name']; ?></p>
	        <p><?php echo $this->_var['fee']['value']; ?></p>
	    </div>
	    <?php endif; ?>
	    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</div>
	<?php endif; ?>
	<?php if ($this->_var['paid']): ?>
	<ul class="shop_total reduce_total b-line">
		<?php $_from = $this->_var['paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'paid_item');if (count($_from)):
    foreach ($_from AS $this->_var['paid_item']):
?>
		<li class="item-content">
			<div class="item-media"><i class="icon icon-f7"></i></div>
			<div class="item-inner u-common-inline">
				<div class="item-title"><?php echo $this->_var['paid_item']['name']; ?></div>
				<div class="item-after"><?php if ($this->_var['paid_item']['symbol'] == - 1): ?>- <?php endif; ?><i class="u-symbol">¥</i><?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['paid_item']['value'],
);
echo $k['name']($k['v']);
?></div>
			</div>
		</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
	<?php endif; ?>
	<?php if ($this->_var['promote']): ?>
	<ul class="shop_total b-line">
		<?php $_from = $this->_var['promote']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'promote_item');if (count($_from)):
    foreach ($_from AS $this->_var['promote_item']):
?>
		<li class="item-content">
			<div class="item-media"><i class="icon icon-f7"></i></div>
			<div class="item-inner u-common-inline">
				<div class="item-title"><?php echo $this->_var['promote_item']['name']; ?></div>
				<div class="item-after"><?php if ($this->_var['promote_item']['symbol'] == - 1): ?>- <?php endif; ?><?php if ($this->_var['promote_item']['symbol'] == 1): ?><i class="u-symbol">¥</i><?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['promote_item']['value'],
);
echo $k['name']($k['v']);
?><?php else: ?><?php echo $this->_var['promote_item']['value']; ?><?php endif; ?></div>
			</div>
		</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
	<?php endif; ?>

	<?php if ($this->_var['buy_type'] == 0): ?>
	<ul class="shop_total">
		<li class="item-content">
			<div class="item-media"><i class="icon icon-f7"></i></div>
			<div class="item-inner u-common-inline">
				<?php if (! $this->_var['is_presell']): ?>
				<div class="item-title">原价 <?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['total_price'],
);
echo $k['name']($k['v']);
?><i class="u-symbol">积分</i> <?php if ($this->_var['total_promote_price']): ?>共优惠 <?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['total_promote_price'],
);
echo $k['name']($k['v']);
?><i class="u-symbol">积分</i><?php endif; ?></div>
				<?php else: ?>	
				<div class="item-title"></div>
				<?php endif; ?>
				<div class="item-after"><p class="u-lg-price">合计：<span class="u-money"> <i class="u-symbol"><?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['pay_price'],
);
echo $k['name']($k['v']);
?></i><i class="u-symbol">积分</i></span></p></div>
			
			</div>
		</li>
	</ul>
	<?php endif; ?>
</div>