<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_refund.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_refund.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_refund.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
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
		<div class="order-list">
			<ul class="order-list-hd">
				<li class="goods-info">商品信息</li>
<!-- 				<li class="goods-price">单价</li> -->
				<li class="goods-num">数量</li>
 				<li class="refund-price">退款金额</li>
				<li class="refund-time">申请时间</li>
				<li class="goods-status">状态</li>
			</ul>
			<?php $_from = $this->_var['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
			<?php if ($this->_var['item']['order_sn']): ?>
			<div class="order-shop">
				<ul class="order-shop-hd">
					<li class="order-code">订单编号：<span class="font_hover"><?php echo $this->_var['item']['order_sn']; ?></span></li>
					<li class="shop-name"><i class="shop-ico"></i><?php echo $this->_var['item']['supplier_name']; ?></li>
					<li class="check-reason"><a class="j-check-reason" href="javascript:void(0);">查看详情</a></li>
				</ul>
				<div class="order-goods-list clearfix">
					<ul class="goods-list">
						<li>
							<div class="goods-info">
								<div class="goods-img"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['item']['deal_icon'],
  'w' => '80',
  'h' => '80',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" width="80" height="80"></div>
								<div class="goods-detail">
									<a href="<?php
echo parse_url_tag("u:index|deal|"."act=".$this->_var['item']['deal_id']."".""); 
?>" target="_blank"><p class="goods-name"><?php echo $this->_var['item']['name']; ?></p></a>
									<p class="goods-type"><?php echo $this->_var['item']['attr_str']; ?></p>
								</div>
							</div>
<!-- 							<div class="goods-price">&yen;<?php echo $this->_var['item']['unit_price']; ?></div> -->
							<div class="goods-num"><?php echo $this->_var['item']['number']; ?></div>
							<?php if ($this->_var['item']['rs1'] == 2): ?>
 							<div class="refund-price"><?php echo $this->_var['item']['rm1']; ?></div>
 							<?php elseif ($this->_var['item']['rs2'] == 2): ?>
 							<div class="refund-price"><?php echo $this->_var['item']['rm2']; ?></div>
 							<?php else: ?>
 							<div class="refund-price">-</div>
 							<?php endif; ?>
							<div class="refund-time"><?php echo $this->_var['item']['create_time']; ?></div>
							<table class="goods-status">
								<td>
									<p class="font_hover"><?php echo $this->_var['item']['status_str']; ?></p>
								</td>
							</table>
						</li>
					</ul>
				</div>
				<div class="refund-reason"><?php echo $this->_var['item']['content']; ?></div>
			</div>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<div class="pages"><?php echo $this->_var['pages']; ?></div>
	<div class="refund-mask"></div>
	<div class="refund-reason-box">
		<div class="refund-reason-hd">
			<a href="javascript:void(0);" class="iconfont j-close-reason">&#xe619;</a>
			<p>退款原因</p>
		</div>
		<div class="refund-reason-bd"></div>
	</div>
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>