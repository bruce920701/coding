<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index deal-page page-current" id="dcorder_index">
	<?php echo $this->fetch('style5.2/inc/headers/dc_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
		<div class="dc-order-list j-ajaxlist">
			<?php if ($this->_var['data']['order_list']): ?>
			<ul class="order-list j-ajaxadd">
				<?php $_from = $this->_var['data']['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<li>
					<a href="<?php
echo parse_url_tag("u:index|dc_dcorder#view|"."id=".$this->_var['item']['id']."".""); 
?>" class="order-hd" data-no-cache="true">
						<div class="shop-img"><img src="<?php echo $this->_var['item']['preview']; ?>" alt="" class="img-comment"></div>
						<div class="shop-info flex-1">
							<div class="shop-info-hd flex-box b-line">
								<p class="shop-name flex-1 name-comment"><?php echo $this->_var['item']['location_name']; ?></p>
								<p class="order-status"><?php echo $this->_var['item']['order_state']['state_format']; ?></p>
							</div>
							<div class="order-info flex-box">
								<p class=" order-goods"><?php echo $this->_var['item']['menu_name']['0']['name']; ?></p>
								<?php if ($this->_var['item']['count'] > 1): ?>
								<p class="order-num flex-1">等<?php echo $this->_var['item']['count']; ?>个商品</p>
								<?php else: ?>
								<p class="order-num flex-1"></p>
								<?php endif; ?>
								<p class="price"><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['item']['total_price'],
  'g' => '2',
);
echo $k['name']($k['v'],$k['g']);
?></p>
							</div>
						</div>
						<input name="location_id" type="hidden" value="<?php echo $this->_var['item']['location_id']; ?>"/>
						<input name="order_id" type="hidden" value="<?php echo $this->_var['item']['id']; ?>"/>
					</a>
					<?php if ($this->_var['item']['order_state']['act']): ?>
					<?php $_from = $this->_var['item']['order_state']['act']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'act');if (count($_from)):
    foreach ($_from AS $this->_var['act']):
?>
					<?php if ($this->_var['item']['order_state']['state'] == 1): ?>
					<div class="order-edit-bar t-line">
						<a href="javascript:void(0);" jump_url="<?php echo $this->_var['act']['url']; ?>" data_url="<?php
echo parse_url_tag("u:index|dcorder#to_pay|"."id=".$this->_var['item']['id']."".""); 
?>" class="order-btn j-confirm to-pay">去支付</a>
					</div>
					<?php elseif ($this->_var['item']['order_state']['state'] == 4): ?>
					<div class="order-edit-bar t-line">
						<a href="javascript:void(0);" class="order-btn j-open-comment">评价</a>
					</div>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					<?php endif; ?>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
			<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
			<?php else: ?>
			<div class="tipimg no_data">暂无订单</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="popup popup-comment">
		<div class="popup-header b-line">
			<p class="popup-tit">评价</p>
			<div class="iconfont j-close-popup">&#xe604;</div>
		</div>
		<div class="shop-info flex-box">
			<div class="shop-img"><img src="" alt="" class="img-comment-1"></div>
			<p class="shop-name flex-1 name-comment-1"></p>
		</div>
		<div class="comment-point flex-box">
			<p class="comment-tit">总评</p>
			<ul class="comment-stars flex-box">
				<li value="1" class="iconfont j-point">&#xe65b;</li>
				<li value="2" class="iconfont j-point">&#xe65b;</li>
				<li value="3" class="iconfont j-point">&#xe65b;</li>
				<li value="4" class="iconfont j-point">&#xe65b;</li>
				<li value="5" class="iconfont j-point">&#xe65b;</li>
			</ul>
			<input type="hidden" id="star-value">
		</div>
		<div class="comment-text">
			<textarea name="content" id="" placeholder="请输入不超过140字的评价" maxlength="140" style="border: 1px solid #e6e6e6;border-radius: 0.3rem;padding: 0 0.25rem;"></textarea>
		</div>
		<input name="location_id_1" type="hidden" value=""/>
		<input name="order_id_1" type="hidden" value=""/>
		<div class="comment-sub t-line">
			<a href="javascript:void(0);" class="comment-btn j-comment-sub" action="<?php
echo parse_url_tag("u:index|dcreview#save|"."".""); 
?>">发表评价</a>
		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>