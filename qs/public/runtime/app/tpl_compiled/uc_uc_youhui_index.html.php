<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_order.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_youhui.css";

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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_youhui.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_youhui.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<script>
	var ajax_url='<?php
echo parse_url_tag("u:index|uc_youhui#view_shop_list|"."".""); 
?>'
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
			<div class="youhui-nav">
				<a href="<?php
echo parse_url_tag("u:index|uc_youhui|"."".""); 
?>" class="active">优惠券</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_voucher|"."".""); 
?>">红包</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_voucher#exchange|"."".""); 
?>">红包兑换</a>
			</div>
			<div class="m-youhui-list">
				<ul class="youhui-list clearfix">
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
					<li class='<?php if ($this->_var['item']['youhui_status'] != 0): ?>disable<?php endif; ?>'>
						<div class="youhui-hd">
							<p class="youhui-price"><span>&yen;</span><?php echo $this->_var['item']['youhui_value']; ?></p>
							<p class="youhui-tip">
								<?php if ($this->_var['item']['youhui_type'] == 2 && $this->_var['item']['supplier_id'] == 0 && $this->_var['item']['city_id'] == 0): ?>
									自营券
								<?php else: ?>
									店铺券
								<?php endif; ?>
								<?php if ($this->_var['item']['start_use_price'] == 0): ?>
									无使用限制
								<?php else: ?>
									[满<?php echo $this->_var['item']['start_use_price']; ?>元可用]
								<?php endif; ?>
							</p>
							<?php if ($this->_var['item']['youhui_status'] == 1): ?>
								<div class="disable-ico"><img src="<?php echo $this->_var['TMPL']; ?>/images/youhui/youhui-disable-1.png" alt=""></div><!--已使用图标-->
							<?php elseif ($this->_var['item']['youhui_status'] == 2): ?>
								<div class="disable-ico"><img src="<?php echo $this->_var['TMPL']; ?>/images/youhui/youhui-disable-2.png" alt=""></div><!--已过期图标-->
							<?php endif; ?>
						</div>
						<div class="youhui-bd">
							<p class="youhui-tip">
								<?php if ($this->_var['item']['youhui_type'] == 2 && $this->_var['item']['supplier_id'] == 0 && $this->_var['item']['city_id'] == 0): ?>
									限购<span>平台自营</span>商品
								<?php elseif ($this->_var['item']['youhui_type'] == 2 && $this->_var['item']['supplier_id'] != 0): ?>
									限<span>[<?php echo $this->_var['item']['supplier_name']; ?>]</span>店铺商品使用
								<?php elseif ($this->_var['item']['youhui_type'] == 1 && $this->_var['item']['supplier_id'] != 0): ?>
								限<span>[<?php echo $this->_var['item']['supplier_name']; ?>]</span>实体店铺消费使用
								<?php endif; ?>
							</p>
							<p class="youhui-time">
								<?php if ($this->_var['item']['expire_time'] != 0): ?>有效期至：
									<span><?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['item']['expire_time'],
  'x' => 'Y.m.d　H:i',
);
echo $k['name']($k['v'],$k['x']);
?></span>
								<?php else: ?>
									永久有效
								<?php endif; ?>
								<?php if ($this->_var['item']['youhui_type'] == 1 && $this->_var['item']['supplier_id'] != 0 && $this->_var['is_sms'] == 1 && $this->_var['item']['confirm_time'] == 0): ?>
								<a href="javascript:void(0);" class="youhui-sms" action="<?php
echo parse_url_tag("u:index|uc_youhui#send|"."t=sms&id=".$this->_var['item']['id']."".""); 
?>">短信发券</a>
								<?php endif; ?>
							</p>
							<?php if ($this->_var['item']['youhui_type'] == 1 && $this->_var['item']['supplier_id'] != 0): ?>
							<p class="youhui-code">券码：<span><?php echo $this->_var['item']['youhui_sn']; ?></span></p>
							<?php endif; ?>
							<?php if ($this->_var['item']['youhui_status'] == 0): ?>
							<div class="youhui-btn-box">
								<!--<a href="" class="youhui-btn">立即使用</a>-->
								<?php if ($this->_var['item']['supplier_id'] > 0): ?>
								<a href="javascript:void(0);" class="j-check-shop youhui-btn">查看门店</a>
								<input type="hidden" value="<?php echo $this->_var['item']['supplier_id']; ?>" name="supplier_id">
								<input type="hidden" value="<?php echo $this->_var['item']['youhui_id']; ?>" name="youhui_id">
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<div class="pages"><?php echo $this->_var['pages']; ?></div>
			</div>
		</div>
	</div>
</div>
<div class="mask j-close"></div>
<div class="shop-box">
	<div class="shop-box-hd">支持门店<a class="j-close iconfont" href="javascript:void(0);">&#xe619;</a></div>
	<div class="shop-tip"></div>
	<ul class="shop-list"></ul>
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>