<header class="bar bar-nav b-line">
	<?php if ($this->_var['page_finsh']): ?>
		<a href="javascript:App.page_finsh();" class="header-btn header-left iconfont" >&#xe634;</a>
    <?php else: ?>
	<a class="header-btn header-left iconfont back"  data-transition='slide-out'>&#xe634;</a>
	<?php endif; ?>
	<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
</header>