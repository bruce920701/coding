<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
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
			<div class="youhui-nav">
				<a href="<?php
echo parse_url_tag("u:index|uc_youhui|"."".""); 
?>">优惠券</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_voucher|"."".""); 
?>" class="active">红包</a>
				<a href="<?php
echo parse_url_tag("u:index|uc_voucher#exchange|"."".""); 
?>">红包兑换</a>
			</div>
			<div class="m-youhui-list">
				<ul class="youhui-list clearfix">
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
					<li class='<?php if ($this->_var['item']['status'] != 2): ?>disable<?php endif; ?>'>
						<div class="youhui-hd">
							<p class="youhui-price"><span>&yen;</span><?php echo $this->_var['item']['money']; ?></p>
							<p class="youhui-tip">
								<?php if ($this->_var['item']['start_use_price'] == 0): ?>
									无使用限制
								<?php else: ?>
									[满<?php echo $this->_var['item']['start_use_price']; ?>元可用]
								<?php endif; ?>
							</p>

							<?php if ($this->_var['item']['status'] == 1): ?>
								<div class="disable-ico"><img src="<?php echo $this->_var['TMPL']; ?>/images/youhui/youhui-disable-1.png" alt=""></div><!--已使用图标-->
							<?php elseif ($this->_var['item']['status'] == 0): ?>
								<div class="disable-ico"><img src="<?php echo $this->_var['TMPL']; ?>/images/youhui/youhui-disable-2.png" alt=""></div><!--已过期图标-->
							<?php endif; ?>

						</div>
						<div class="youhui-bd">
							<p class="youhui-tip"><?php echo $this->_var['item']['name']; ?></p>
							<p class="youhui-time">有效期至：<?php echo $this->_var['item']['end_time']; ?></p>
						</div>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<div class="pages"><?php echo $this->_var['pages']; ?></div>
			</div>
		</div>
	</div>
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>