<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index page-current" id="login_out">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content">
		<div class="m-setting-con">
			<div class="flex-box setting-item b-line">
				<div>当前版本</div>
				<div class="flex-1 item-con"><?php echo $this->_var['data']['DB_VERSION']; ?></div>
			</div>
			<div class="flex-box setting-item b-line">
				<div>客服电话</div>
				<div class="flex-1 item-con"><a href="tel:<?php echo $this->_var['conf']['SHOP_TEL']['value']; ?>"><?php echo $this->_var['data']['SHOP_TEL']; ?></a></div>
			</div>
			<div class="flex-box setting-item b-line">
				<div>客服邮箱</div>
				<div class="flex-1 item-con"><?php echo $this->_var['data']['REPLY_ADDRESS']; ?></div>
			</div>
			<?php if ($this->_var['data']['APP_ABOUT_US']): ?>
			<div class="open-about flex-box setting-item b-line">
				<div>关于我们</div>
				<div class="flex-1 item-con"><i class="iconfont">&#xe607;</i></div>
			</div>
			<?php endif; ?>
		</div>
		
		<?php if ($this->_var['data']['user_login_status'] == 1): ?>
		<div class="big-btn logout">
			<a href="javascript:void(0)" class="btn-con" data-url="<?php echo $this->_var['data']['url']; ?>">退出登录</a>
		</div>
		<?php endif; ?>
		
	</div>
	<?php if ($this->_var['data']['APP_ABOUT_US']): ?>
	<div class="popup popup-about">
	    <div class="popup-hd">
	      <h1 class="title b-line">关于我们</h1>
	      <a href="javascript:void(0);" class="close-popup"><i class="iconfont">&#xe634;</i></a>
	    </div>
	    <div class="protocol"><?php echo $this->_var['data']['APP_ABOUT_US']; ?></div>
	</div>
	<?php endif; ?>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>