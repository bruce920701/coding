<?php if ($this->_var['app_index'] == 'app'): ?>
<header class="bar bar-nav">
	<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
	<?php if ($this->_var['page_finsh']): ?>
		<a href="javascript:App.page_finsh();"  class="header-btn header-left iconfont">&#xe604;</a>
    <?php else: ?>
    <a class="header-btn header-left iconfont go-back back">&#xe604;</a>
    <?php endif; ?>
	<i class="header-txt header-right j-edit" rel="0" data-isedit="0">编辑</i>
</header>

<?php else: ?>
<header class="bar bar-nav">
	<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
	<a class="header-btn header-left iconfont go-back back">&#xe604;</a>
	<i class="header-txt header-right j-edit" rel="0" data-isedit="0">编辑</i>
</header>
<?php endif; ?>