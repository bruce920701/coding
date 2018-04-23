<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var AJAX_URL = '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
var id=<?php echo $this->_var['data']['order_id']; ?>;

</script>
<div class="page page-index" id="payment_done">

	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content" style="bottom: 0">
		<div class="list-block m-order-common media-list" style="margin-bottom: 0">
			<div class="item-content m-order-state">
				<div class="item-inner">
					<div class="item-subtitle u-order-state-font"><?php if ($this->_var['data']['buy_type'] == 1): ?>兑换成功<?php elseif ($this->_var['data']['order_type'] == 1): ?><?php echo $this->_var['data']['pay_info']; ?><?php else: ?>付款成功<?php endif; ?></div>
				</div>
				<div class="u-order-state-img">
					<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/pay_done.png" alt="恭喜，付款成功">
				</div>
			</div>
			<div class="item-content b-line u-order-ident">
				<div class="item-title">订单编号：<?php echo $this->_var['data']['order_sn']; ?></div>
			</div>
			<?php if ($this->_var['data']['consignee_info']): ?>
			<div class="item-content b-line" style="margin-left: 0.5rem">
				<div class="item-inner" style="margin-left: 0">
					<div class="item-subtitle user-name">收货人：<?php echo $this->_var['data']['consignee_info']['consignee']; ?><span class="u-phoneNum"><?php echo $this->_var['data']['consignee_info']['mobile']; ?></span></div>
					<div class="item-text user-address"><?php echo $this->_var['data']['consignee_info']['address']; ?></div>
				</div>
			</div>
			<?php endif; ?>
			<?php if ($this->_var['data']['couponlist']): ?>
				<?php $_from = $this->_var['data']['couponlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'coupon');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['coupon']):
?>
				<?php if ($this->_var['key'] < 3): ?>
				<div class="item-content order-replay b-line">
					<div class="item-inner">
						<div class="item-title j-codeNum"><?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'COUPON_NAME',
);
echo $k['name']($k['v']);
?>：<?php echo $this->_var['coupon']['password']; ?></div>
						<div class="item-after j-showCode"><i class="iconfont">&#xe60e;</i>查看二维码</div>
						<input type="hidden" class="hiddenBox" data-src="<?php echo $this->_var['coupon']['qrcode']; ?>">
					</div>
				</div>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<?php endif; ?>
			

			<?php if ($this->_var['data']['coupon_count'] > 3): ?>
			<div class="j-moreThan">
				<?php $_from = $this->_var['data']['couponlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'coupon');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['coupon']):
?>
				<?php if ($this->_var['key'] > 2): ?>
				<div class="item-content order-replay b-line">
					<div class="item-inner">
						<div class="item-title j-codeNum"><?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'COUPON_NAME',
);
echo $k['name']($k['v']);
?>：<?php echo $this->_var['coupon']['password']; ?></div>
						<div class="item-after j-showCode"><i class="iconfont">&#xe60e;</i>查看二维码</div>
						<input type="hidden" class="hiddenBox" data-src="<?php echo $this->_var['coupon']['qrcode']; ?>">
					</div>
				</div>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
			<?php endif; ?>
			<!--  
			<div class="item-content b-line u-order-ident">
				<div class="item-title"><input type="checkbox" id="share" style="-webkit-appearance:checkbox;" checked="checked"/>分享到个人中心</div>
			</div>
			-->
			<div class="loadMore">
				<i class="iconfont up_btn">&#xe608;</i>
				<i class="iconfont down_btn">&#xe606;</i>
			</div>
			
		</div>



		<!-- 页面主体 -->
		<div class="list-block pay-btn-box">
			<div class="item-content"  <?php if (! ( $this->_var['data']['consignee_info'] || $this->_var['data']['couponlist'] )): ?>style="margin-top:1rem;"<?php endif; ?>>
				<div class="item-inner">
					<?php if ($this->_var['data']['order_type'] == 1): ?>
					<a class="button u-look-order payBtn " href='<?php echo $this->_var['back_url']; ?>' data-no-cache="true">查看余额</a>
					<?php elseif ($this->_var['data']['order_type'] != 7): ?>
					<a class="button u-look-order payBtn " href='<?php echo $this->_var['back_url']; ?>' data-no-cache="true">查看订单</a>
					<?php endif; ?>
                    <?php if ($this->_var['detail_url']): ?>
                    <a class="button u-look-order payBtn " href='<?php echo $this->_var['detail_url']; ?>' data-no-cache="true">查看明细</a>
                    <?php endif; ?>
					<a href='<?php echo $this->_var['back_go_url']; ?>' data-no-cache="true" class="button u-look-shop payBtn index">再逛逛</a>
				</div>
			</div>
		</div>
	</div>

	<div class="codeShowBox">
		<div class="blackBox blackBox-i"></div>
		<div class="codeImgBox">
			<h4 class="codeName"></h4>
			<img class="codeImg" src="">
		</div>
	</div>
	<?php echo $this->fetch('style5.2/inc/module/share.html'); ?>
</div>

<?php echo $this->fetch('style5.2/inc/footer.html'); ?>