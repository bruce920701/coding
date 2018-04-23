<?php if ($this->_var['app_index'] == 'app'): ?>
<?php echo $this->fetch('style5.2/inc/module/app-dropdown-nav.html'); ?>
<header class="bar bar-nav">
	<div class="m-search-header flex-box">
		<?php if ($this->_var['page_finsh']): ?>
		<a class="header-btn header-left iconfont" href="javascript:App.page_finsh();">&#xe604;</a>
		<?php else: ?>
		<a class="header-btn header-left iconfont back">&#xe604;</a>
		<?php endif; ?>
		<a href="javascript:App.app_detail(105,0)" class="flex-1">
		<div class="flex-box go-search">
			<i class="iconfont">&#xe61a;</i>
			<?php if ($this->_var['data']['keyword']): ?>
			<p><?php echo $this->_var['data']['keyword']; ?></p>
			<?php else: ?>
			<p>搜索活动关键字</p>
			<?php endif; ?>
		</div>
		</a>
		<a class="header-btn header-right iconfont j-opendropdowm-default" href="javascript:void(0)">&#xe624;</a>
	</div>
</header>
<?php else: ?>
<?php echo $this->fetch('style5.2/inc/module/dropdown-nav.html'); ?>
<header class="bar bar-nav">
	<div class="m-search-header flex-box">
		<a class="header-btn header-left iconfont back" href="">&#xe604;</a>
		<a href="<?php
echo parse_url_tag("u:index|search#index|"."".""); 
?>" class="flex-1">
			<div class="flex-box go-search">
				<i class="iconfont">&#xe61a;</i>
				<?php if ($this->_var['data']['keyword']): ?>
				<p><?php echo $this->_var['data']['keyword']; ?></p>
				<?php else: ?>
				<p>搜索活动关键字</p>
				<?php endif; ?>
			</div>
		</a>
		<a class="header-btn header-right iconfont j-opendropdowm-default" href="javascript:void(0)">&#xe624;</a>
	</div>
</header>
<?php endif; ?>
