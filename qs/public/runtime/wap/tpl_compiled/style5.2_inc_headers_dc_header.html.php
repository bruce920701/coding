<?php if ($this->_var['app_index'] == 'app'): ?>
	<header class="bar bar-nav b-line">
		<?php if ($this->_var['page_finsh']): ?>
		<a class="header-btn header-left iconfont" href="javascript:App.page_finsh();">&#xe604;</a>
		<?php else: ?>
		<a class="header-btn header-left iconfont <?php if ($this->_var['back_url']): ?>go_back<?php else: ?>back<?php endif; ?>" <?php if ($this->_var['back_url']): ?><?php else: ?>data-no-cache="true"<?php endif; ?> href="">&#xe604;</a>
		<?php endif; ?>
		<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
	</header>
<?php else: ?>
	<header class="bar bar-nav b-line">
		<a class="header-btn header-left iconfont <?php if ($this->_var['back_url']): ?>go_back<?php else: ?>back<?php endif; ?>" <?php if ($this->_var['back_url']): ?><?php else: ?>data-no-cache="true"<?php endif; ?> href="" >&#xe604;</a>
		<h1 class="header-title"><?php echo $this->_var['page_title']; ?></h1>
	</header>
<?php endif; ?>