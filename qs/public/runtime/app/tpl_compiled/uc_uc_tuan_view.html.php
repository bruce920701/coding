<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_order_view.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/plupload.full.min.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_order.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_order.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<?php echo $this->fetch('inc/refuse_delivery_form.html'); ?>
<script>
	var ajax_url = "<?php
echo parse_url_tag("u:index|uc_tuan#do_refund|"."".""); 
?>";
</script>
<div class="blank20"></div>

<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?> clearfix">
	<div class="side_nav left_box">
		<?php echo $this->fetch('inc/uc_nav_list.html'); ?>
	</div>
	<div class="right_box">
		<div class="main_box">
			<div class="order-hd">订单详情</div>
			<div class="order-pay-bar">
				<?php if ($this->_var['order_info']['pay_status'] == 0 && $this->_var['order_info']['is_delete'] == 0): ?>
				<a href="<?php
echo parse_url_tag("u:index|cart#order|"."id=".$this->_var['order_info']['id']."".""); 
?>" class="order-pay-btn f_r">继续付款</a>
				<?php endif; ?>
				<p class="order-info">
					订单号：<?php echo $this->_var['order_info']['order_sn']; ?>，交易时间：<?php echo $this->_var['order_info']['create_time']; ?>
				</p>
			</div>

			<?php if ($this->_var['tuan_coupon']): ?>
			<table class="station-info" cellspacing="0" cellpadding="0">
				<thead class="station-info-hd">
					<tr>
						<td width="240">序列号</td>
						<td width="250">有效期</td>
						<td width="100">状态</td>
						<td width="200">操作</td>
					</tr>
				</thead>
				<tbody class="station-info-bd">
					<?php $_from = $this->_var['tuan_coupon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'coupon');if (count($_from)):
    foreach ($_from AS $this->_var['coupon']):
?>
					<tr>
						<td><?php echo $this->_var['coupon']['password']; ?></td>
						<td><?php echo $this->_var['coupon']['end_time']; ?></td>
						<td><?php echo $this->_var['coupon']['status']; ?></td>
						<td>
						<?php if ($this->_var['coupon']['handle']): ?>
						<a href="javascript:void(0);" action="<?php echo $this->_var['coupon']['action']; ?>" class="<?php echo $this->_var['coupon']['class']; ?>"><?php echo $this->_var['coupon']['handle']; ?></a>
						<?php else: ?>
						--
						<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</tbody>
			</table>
			<?php endif; ?>

			<?php if ($this->_var['order_info']['invoice_info'] && ( $this->_var['order_info']['invoice_info']['type'] == 1 )): ?>
			<div class="info-bar">
				<div class="info-hd">发票信息</div>
				<div class="shop-tip">
				<p>发票类型: 普通发票</p>
				<p>发票抬头: <?php echo $this->_var['order_info']['invoice_info']['persons']; ?></p>
				<?php if ($this->_var['order_info']['invoice_info']['title'] == 1): ?><p>纳税人识别码: <?php echo $this->_var['order_info']['invoice_info']['taxnu']; ?></p><?php endif; ?>
				<p>发票明细: <?php echo $this->_var['order_info']['invoice_info']['content']; ?></p>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="order-list">
				<ul class="order-list-hd">
					<li class="order-info">商品信息</li>
					<li class="order-price">单价</li>
					<li class="order-num">数量</li>
					<li class="order-status">商品状态</li>
				</ul>
				<?php if ($this->_var['order_info']['deal_order_item']): ?>
				<ul class="goods-list">
					<?php $_from = $this->_var['order_info']['deal_order_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_item');if (count($_from)):
    foreach ($_from AS $this->_var['order_item']):
?>
					<li>
						<div class="order-info">
							<div class="goods-img">
								<a href="<?php
echo parse_url_tag("u:index|deal|"."act=".$this->_var['order_item']['deal_id']."".""); 
?>" target="_blank"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['order_item']['deal_icon'],
  'w' => '100',
  'h' => '100',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" alt=""></a>
							</div>
							<div class="goods-info">
								<a href="<?php
echo parse_url_tag("u:index|deal|"."act=".$this->_var['order_item']['deal_id']."".""); 
?>" " target="_blank" class="goods-name"><?php echo $this->_var['order_item']['name']; ?></a>
								<?php if ($this->_var['order_item']['attr_str']): ?>
								<p class="goods-type">属性：<?php echo $this->_var['order_item']['attr_str']; ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div class="order-price"><?php if ($this->_var['order_item']['buy_type'] != 1): ?><?php echo $this->_var['order_item']['discount_unit_price']; ?><?php else: ?><?php 
$k = array (
  'name' => 'abs',
  'v' => $this->_var['order_item']['return_total_score'],
);
echo $k['name']($k['v']);
?>积分<?php endif; ?></div>
						<div class="order-num"><?php echo $this->_var['order_item']['number']; ?></div>
						<table class="order-status">
							<td>
								<?php if ($this->_var['order_item']['status']['url']): ?>
								<a href="<?php echo $this->_var['order_item']['status']['url']; ?>"><?php echo $this->_var['order_item']['status']['status']; ?></a>
								<?php else: ?>
								<p><?php echo $this->_var['order_item']['status']['status']; ?></p>
								<?php endif; ?>
								<?php $_from = $this->_var['order_item']['status']['handle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item_handle');if (count($_from)):
    foreach ($_from AS $this->_var['item_handle']):
?>
									<?php if ($this->_var['item_handle']['url']): ?>
									<a href="<?php echo $this->_var['item_handle']['url']; ?>" target="_blank"><?php echo $this->_var['item_handle']['info']; ?></a>
									<?php endif; ?>
									<?php if ($this->_var['item_handle']['action']): ?>
									<a href="javascript:void(0);" action="<?php echo $this->_var['item_handle']['action']; ?>" class="<?php echo $this->_var['item_handle']['class']; ?>"><?php echo $this->_var['item_handle']['info']; ?></a>
									<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								<?php if ($this->_var['order_item']['status']['vaice_status']): ?>
									<p class="font_hover"><?php echo $this->_var['order_item']['status']['vaice_status']; ?></p>
								<?php endif; ?>
								<?php if ($this->_var['order_item']['coupon_sn']): ?>
								<p class="code">（券码：<?php echo $this->_var['order_item']['coupon_sn']; ?>）</p>
								<?php endif; ?>
							</td>
						</table>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<?php endif; ?>
			</div>
			
			<div class="pay-info">
				<?php $_from = $this->_var['order_info']['fee']['feeinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<p><?php echo $this->_var['item']['pc_name']; ?>：
					
					<span class="price">
					<?php if ($this->_var['item']['symbol'] == - 1): ?>-<?php endif; ?><?php if ($this->_var['item']['buy_type'] == 0): ?><?php endif; ?><?php echo $this->_var['item']['value']; ?>
					<small style="font-size: 12px;">积分</small>
					</span>
				</p>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<?php $_from = $this->_var['order_info']['fee']['paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<p><?php echo $this->_var['item']['pc_name']; ?>：
					<span class="price">
					<?php if ($this->_var['item']['symbol'] == - 1): ?>-<?php endif; ?><?php if ($this->_var['item']['buy_type'] == 0): ?><?php endif; ?><?php echo $this->_var['item']['value']; ?>
					<small style="font-size: 12px;">积分</small>
					</span>
				</p>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<p class="order-count">合计：<span class="price font_hover"><?php echo $this->_var['order_info']['fee']['order_pay_price']; ?></span><small style="font-size: 12px;">积分</small></p>
			</div>
			
			<?php if ($this->_var['order_logs']): ?>
			<div class="info-bar">
				<div class="info-hd">订单日志</div>
				<ul class="order-tip-hd">
					<li class="order-tip f_l">内容</li>
					<li class="order-time f_l">时间</li>
				</ul>
				<ul class="order-tip-list clearfix">
				<?php $_from = $this->_var['order_logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'log');if (count($_from)):
    foreach ($_from AS $this->_var['log']):
?>
					<li class="clearfix">
						<p class="order-tip f_l"><?php echo $this->_var['log']['log_info']; ?></p>
						<p class="order-time f_l"><?php echo $this->_var['log']['log_time']; ?></p>
					</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>	
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>