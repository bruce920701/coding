<?php if ($this->_var['app_index'] == 'app'): ?>
	<?php echo $this->fetch('style5.2/inc/module/app-dropdown-nav.html'); ?>
	<header class="bar bar-nav b-line">

		<?php if ($this->_var['back_url']): ?>
		<a class="header-btn header-left iconfont go_back" data-no-cache="true"  href="">&#xe604;</a>
		<?php else: ?>
			<?php if ($this->_var['page_finsh']): ?>
			<a class="header-btn header-left iconfont" href="javascript:App.page_finsh();">&#xe604;</a>
			<?php else: ?>
			<a class="header-btn header-left iconfont back" data-no-cache="true" href="">&#xe604;</a>
			<?php endif; ?>
		<?php endif; ?>
		<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
		<a href="javascript:void(0);" class="header-btn header-right iconfont j-opendropdowm-default">&#xe624;</a>
	</header>
	<?php if ($this->_var['is_pop_box']): ?>
		<?php echo $this->fetch('style5.2/inc/module/pop-light-img.html'); ?>
	<?php endif; ?>
<?php else: ?>
	<?php echo $this->fetch('style5.2/inc/module/dropdown-nav.html'); ?>
	<header class="bar bar-nav b-line">
		<a class="header-btn header-left iconfont <?php if ($this->_var['back_url']): ?>go_back<?php else: ?>back<?php endif; ?>" <?php if ($this->_var['back_url']): ?>data-no-cache="true"<?php endif; ?> href="" >&#xe604;</a>
		<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
		<a href="javascript:void(0);" class="header-btn header-right iconfont j-opendropdowm-default">&#xe624;</a>
	</header>
	<!-- 弹出层 -->
	<?php if ($this->_var['is_pop_box']): ?>
		<?php echo $this->fetch('style5.2/inc/module/pop-light-img.html'); ?>
	<?php endif; ?>
<?php endif; ?>