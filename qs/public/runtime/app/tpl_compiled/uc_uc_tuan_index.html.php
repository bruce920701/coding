<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_order.css";
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
		<div class="main_box setting_user_info">
			<ul class="order-tab">
				<li <?php if ($this->_var['pay_status'] == 0): ?>class="active"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_tuan|"."".""); 
?>">全部订单</a></li>
				<li <?php if ($this->_var['pay_status'] == 1): ?>class="active"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_tuan|"."pay_status=1".""); 
?>">待付款</a></li>
				<li <?php if ($this->_var['pay_status'] == 3): ?>class="active"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_tuan|"."pay_status=3".""); 
?>">待使用</a></li>
				<li <?php if ($this->_var['pay_status'] == 4): ?>class="active"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_tuan|"."pay_status=4".""); 
?>">待评价</a></li>
			</ul>
			<?php if ($this->_var['list']): ?>
			<div class="order-list">
				<ul class="order-list-hd">
					<li class="goods-info">商品信息</li>
					<li class="goods-price">单价</li>
					<li class="goods-num">数量</li>
					<li class="goods-status">商品状态</li>
					<li class="goods-edit">操作</li>
				</ul>
				<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
				<div class="order-shop">
					<ul class="order-shop-hd">
						<li class="order-time"><?php echo $this->_var['order']['create_time']; ?></li>
						<li class="order-code">订单号：<?php echo $this->_var['order']['order_sn']; ?></li>
						<li class="shop-name">商户：<?php echo $this->_var['order']['supplier_name']; ?></li>
					</ul>
					<div class="order-goods-list clearfix">
						<table class="goods-edit f_r">
							<td>
								<?php if ($this->_var['order']['status']['status']): ?>
								<p style="text-align:center"><?php echo $this->_var['order']['status']['status']; ?></p>
								<?php endif; ?>
								<?php $_from = $this->_var['order']['status']['handle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_handle');if (count($_from)):
    foreach ($_from AS $this->_var['order_handle']):
?>
								<?php if ($this->_var['order_handle']['url']): ?>
								<a href="<?php echo $this->_var['order_handle']['url']; ?>" target="_blank"><?php echo $this->_var['order_handle']['info']; ?></a>
								<?php endif; ?>
								<?php if ($this->_var['order_handle']['action']): ?>
								<a href="javascript:void(0);" action="<?php echo $this->_var['order_handle']['action']; ?>" class="<?php echo $this->_var['order_handle']['class']; ?>"><?php echo $this->_var['order_handle']['info']; ?></a>
								<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</td>
						</table>
						<?php if ($this->_var['order']['deal_order_item']): ?>
						<ul class="goods-list">
						<?php $_from = $this->_var['order']['deal_order_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');$this->_foreach['deal_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['deal_loop']['total'] > 0):
    foreach ($_from AS $this->_var['deal']):
        $this->_foreach['deal_loop']['iteration']++;
?>
							<li>
								<div class="goods-info">
									<div class="goods-img">
										<a href="<?php
echo parse_url_tag("u:index|deal|"."act=".$this->_var['deal']['deal_id']."".""); 
?>" target="_blank"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['deal']['deal_icon'],
  'w' => '100',
  'h' => '100',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" alt=""></a>
									</div>
									<div class="goods-detail">
										<a class="goods-name" href="<?php
echo parse_url_tag("u:index|deal|"."act=".$this->_var['deal']['deal_id']."".""); 
?>" target="_blank"><?php echo $this->_var['deal']['name']; ?></a>
										<?php if ($this->_var['deal']['attr_str']): ?>
										<p class="goods-type">属性：<?php echo $this->_var['deal']['attr_str']; ?></p>
										<?php endif; ?>
									</div>
								</div>
								<div class="goods-price"><?php if ($this->_var['deal']['buy_type'] != 1): ?><?php echo $this->_var['deal']['unit_price']; ?><?php else: ?><?php 
$k = array (
  'name' => 'abs',
  'v' => $this->_var['deal']['return_score'],
);
echo $k['name']($k['v']);
?>积分<?php endif; ?></div>
								<div class="goods-num"><?php echo $this->_var['deal']['number']; ?></div>
								<table class="goods-status">
									<td>
										<?php if ($this->_var['deal']['status']['url']): ?>
										<a href="<?php echo $this->_var['deal']['status']['url']; ?>"><?php echo $this->_var['deal']['status']['status']; ?></a>
										<?php else: ?>
										<p><?php echo $this->_var['deal']['status']['status']; ?></p>
										<?php endif; ?>
										<?php if ($this->_var['deal']['status']['vaice_status']): ?>
										<p class="font_hover"><?php echo $this->_var['deal']['status']['vaice_status']; ?></p>
										<?php endif; ?>
									</td>
								</table>
							</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</ul>
						<?php endif; ?>
						<div class="order-count">合计：<b><?php echo $this->_var['order']['total_price_format']; ?></b></div>
					</div>
				</div>
				<br>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
			<div class="pages"><?php echo $this->_var['pages']; ?></div>
			<?php else: ?>
			<div class="empty_tip">没有订单记录</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>