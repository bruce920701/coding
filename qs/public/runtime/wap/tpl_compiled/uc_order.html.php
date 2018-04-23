<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<style type="text/css">
	a.totop{
		bottom: 5.2rem;
	}
</style>
<!-- <script type="text/javascript">
		var url=new Array();
		url[0] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=0".""); 
?>';
		url[1] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=1".""); 
?>';
		url[2] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=2".""); 
?>';
		url[3] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=3".""); 
?>';
		url[4] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=4".""); 
?>';
		url[9] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=9".""); 
?>';
		var pay_status=<?php echo $this->_var['data']['pay_status']; ?>;
    </script> -->
<div class="page page-index " id="uc_order">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<?php if ($this->_var['data']['page_type'] == 1): ?>
	<script type="text/javascript">
		var url=new Array();
		url[0] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=0&tuan=1".""); 
?>';
		url[1] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=1&tuan=1".""); 
?>';
		/*url[2] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=2&tuan=1".""); 
?>';*/
		url[2] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=2&tuan=1".""); 
?>';
		url[3] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=3&tuan=1".""); 
?>';
		url[9] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=9&tuan=1".""); 
?>';
		var pay_status=<?php echo $this->_var['data']['pay_status']; ?>;
    </script>
	<div class="buttons-tab">
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 0): ?>active<?php endif; ?>"><span>全部</span></span>
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 1): ?>active<?php endif; ?>"><span>待付款</span><span><?php if ($this->_var['data']['not_pay'] > 0): ?>(<?php echo $this->_var['data']['not_pay']; ?>)<?php endif; ?></span></span>
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 2): ?>active<?php endif; ?>"><span>待使用</span><span><?php if ($this->_var['data']['not_use_coupon'] > 0): ?>(<?php echo $this->_var['data']['not_use_coupon']; ?>)<?php endif; ?></span></span>
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 3): ?>active<?php endif; ?>"><span>待评价</span></span>
		<span class="bottom_line"></span>
	</div>
	<?php else: ?>
	<script type="text/javascript">
		var url=new Array();
		url[0] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=0".""); 
?>';
		url[1] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=1".""); 
?>';
		/*url[2] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=2".""); 
?>';*/
		url[2] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=2".""); 
?>';
		url[3] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=3".""); 
?>';
		url[9] = '<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=9".""); 
?>';
		var pay_status=<?php echo $this->_var['data']['pay_status']; ?>;
    </script>
	<div class="buttons-tab <?php if ($this->_var['data']['pay_status'] > 3): ?>hide<?php endif; ?>">
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 0): ?>active<?php endif; ?>"><span>全部</span></span>
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 1): ?>active<?php endif; ?>"><span>待付款</span><span><?php if ($this->_var['data']['not_pay'] > 0): ?>(<?php echo $this->_var['data']['not_pay']; ?>)<?php endif; ?></span></span>
		<!-- <span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 2): ?>active<?php endif; ?>"><span>待发货</span></span> -->
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 2): ?>active<?php endif; ?>"><span>待收货</span></span>
		<span class="tab-link button <?php if ($this->_var['data']['pay_status'] == 3): ?>active<?php endif; ?>"><span>待评价</span></span>
		<?php if ($this->_var['data']['pay_status'] > 3): ?><span class="tab-link button active"><span>来啊</span></span><?php endif; ?>
		<span class="bottom_line"></span>
	</div>
	<?php endif; ?>
	<div class="content infinite-scroll  infinite-scroll-bottom" <?php if ($this->_var['data']['pay_status'] < 5): ?>style="top: 4.2rem;padding-top: 0.5rem"<?php endif; ?>>
		<div class="tabBox">
			<?php $_from = $this->_var['data']['tab_box']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'tab_box');$this->_foreach['tab_box'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tab_box']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['tab_box']):
        $this->_foreach['tab_box']['iteration']++;
?>
			<?php if ($this->_var['tab_box']): ?>
				<div class="tab_box <?php if ($this->_var['data']['pay_status'] == $this->_var['key']): ?>active<?php endif; ?> j_ajaxlist_<?php echo $this->_var['key']; ?>">
				<div class="j_ajaxadd_<?php echo $this->_var['key']; ?>">
				<?php $_from = $this->_var['tab_box']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['item']['iteration']++;
?>
				<div class="list-block m-cart">
					<a href='<?php echo $this->_var['item']['url']; ?>' style="display: block" data-no-cache="true">
						<div class="orderId" style="display:none">
							<div class="order_id b-line">
								<p><?php echo $this->_var['item']['order_sn']; ?></p>
								<span class="order_state"><?php echo $this->_var['item']['status_name']; ?></span>
							</div>
						</div>
						<?php $_from = $this->_var['item']['deal_order_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal_order_item');$this->_foreach['deal_order_item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['deal_order_item']['total'] > 0):
    foreach ($_from AS $this->_var['deal_order_item']):
        $this->_foreach['deal_order_item']['iteration']++;
?>
						<div class="m-conBox m-check-order m-modify">
							<!--列表头部开始-->
							<div class="m-title  item-content b-line">
								<div class="item-inner">
									<div class="item-title-row">
										<div class="item-title"><i class="iconfont u-shop-icon u-icon">&#xe616;</i><?php echo $this->_var['deal_order_item']['supplier_name']; ?><i class="iconfont u-icon">&#xe607;</i></div>
										<span class="order_state"><?php echo $this->_var['deal_order_item']['status_name']; ?></span>
									</div>
								</div>
							</div>
							<!--列表头部结束-->
							<?php if ($this->_var['deal_order_item']['count'] < 2): ?>
							<!--当商品只有一件时-->
							<ul class="m-cart-list j-select-body">
								<li class="item-content">
									<div class="item-inner">
										<div class="item-media shopImg">
											<img src="<?php echo $this->_var['deal_order_item']['list']['0']['deal_icon']; ?>">
										</div>
										<div class="z-opera z-opera-sure">
											<div class="item-subtitle shopTi">
												<div class="shop_txt"><?php echo $this->_var['deal_order_item']['list']['0']['name']; ?></div>
												<?php if ($this->_var['deal_order_item']['list']['0']['attr_str'] != ""): ?><p class="sizes">规格: <?php echo $this->_var['deal_order_item']['list']['0']['attr_str']; ?></p><?php endif; ?>
											</div>
											<div class="shop_price tr">
												<p class="u-sm-price"><span class="u-money"><?php if ($this->_var['deal_order_item']['list']['0']['buy_type'] == 1): ?><i><?php echo $this->_var['deal_order_item']['list']['0']['return_score']['bai']; ?></i></span>积分<?php else: ?><i><?php echo $this->_var['deal_order_item']['list']['0']['discount_unit_price']['bai']; ?></i>.<?php echo $this->_var['deal_order_item']['list']['0']['discount_unit_price']['fei']; ?></span>积分<?php endif; ?></p>
												<p class="shop-count">x<i><?php echo $this->_var['deal_order_item']['list']['0']['number']; ?></i></p>
											</div>
										</div>
									</div>
								</li>
							</ul>
							<?php else: ?>
							<div class="shopBox j-order-lamp j-order-lamp1">
								<div class="swiper-wrapper">
									<?php $_from = $this->_var['deal_order_item']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');$this->_foreach['good'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['good']['total'] > 0):
    foreach ($_from AS $this->_var['good']):
        $this->_foreach['good']['iteration']++;
?>
									<div class="shopShow swiper-slide">
										<div class="shopImg">
											<img src="<?php echo $this->_var['good']['deal_icon']; ?>">
											<p class="shop_num"><?php echo $this->_var['good']['number']; ?></p>
										</div>
									</div>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</a>

					<div class="order_total">
					<?php if ($this->_var['item']['pay_status'] != 2): ?>
						<div class="order_dt b-line">
							<p class="u-lg-price">共<i><?php echo $this->_var['item']['count']; ?></i>件商品需付款：<span class="u-money"><?php echo $this->_var['item']['format_total_price']; ?></span></p>
						</div>
					<?php endif; ?>
					<?php if ($this->_var['item']['operation']): ?>
						<div class="order_dt order_bt">
							<?php $_from = $this->_var['item']['operation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'operation');if (count($_from)):
    foreach ($_from AS $this->_var['operation']):
?>
							<?php if ($this->_var['operation']['type'] == 'j-payment'): ?>
								<?php if ($this->_var['item']['allow_pay'] == 1): ?>
									<a href="<?php echo $this->_var['operation']['url']; ?>" class="go_pay btn" data-no-cache="true"><?php echo $this->_var['operation']['name']; ?></a>
								<?php else: ?>
									<a href="javascript:void(0);" class="no_go_pay btn" error_tip="<?php echo $this->_var['item']['error_tip']; ?>" data-no-cache="true"><?php echo $this->_var['operation']['name']; ?></a>
								<?php endif; ?>
							<?php elseif ($this->_var['operation']['type'] == 'j-cancel'): ?>
							<a href="javascript:void(0);" class="manage-order btn" message="确定要取消该订单？" ajaxUrl="<?php echo $this->_var['operation']['url']; ?>" class="cancelBtn btn"><?php echo $this->_var['operation']['name']; ?></a>
							<?php elseif ($this->_var['operation']['type'] == 'j-coupon'): ?>
							<a href="<?php echo $this->_var['operation']['url']; ?>"class="go_coupon btn" data-no-cache="true"><?php echo $this->_var['operation']['name']; ?></a>
							<?php elseif ($this->_var['operation']['type'] == 'j-dp'): ?>
							<a href="<?php echo $this->_var['operation']['url']; ?>" class="cancelBtn btn" data-no-cache="true"><?php echo $this->_var['operation']['name']; ?></a>
							<?php elseif ($this->_var['operation']['type'] == 'j-del'): ?>
							<a href="javascript:void(0);" message="确定要删除该订单?" ajaxUrl="<?php echo $this->_var['operation']['url']; ?>" class="manage-order btn"><?php echo $this->_var['operation']['name']; ?></a>
							<?php else: ?>
							<a href="<?php echo $this->_var['operation']['url']; ?>" class="look_load btn" data-no-cache="true"><?php echo $this->_var['operation']['name']; ?></a>
							<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</div>
					<?php endif; ?>
					</div>
					<div class="blank_line"></div>
				</div>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</div>
				<div class="blank"></div>
				<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
				<div class="blank"></div>
			</div>
			<?php else: ?>
				<?php if ($this->_var['app_index'] == 'app'): ?>
					<div class="tab_box <?php if ($this->_var['data']['pay_status'] == $this->_var['key']): ?>active<?php endif; ?> j_ajaxlist_<?php echo $this->_var['key']; ?>"><?php if ($this->_var['data']['pay_status'] == $this->_var['key']): ?><div class="tipimg no_data">列表这么空，不如去买买买～</div><?php endif; ?></div>
				<?php else: ?>
					<div class="tab_box <?php if ($this->_var['data']['pay_status'] == $this->_var['key']): ?>active<?php endif; ?> j_ajaxlist_<?php echo $this->_var['key']; ?>"><?php if ($this->_var['data']['pay_status'] == $this->_var['key']): ?><div class="tipimg no_data wap_nodata">列表这么空，不如去买买买～</div><?php endif; ?></div>
				<?php endif; ?>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</div>
	</div>

</div>

<?php echo $this->fetch('style5.2/inc/footer.html'); ?>

