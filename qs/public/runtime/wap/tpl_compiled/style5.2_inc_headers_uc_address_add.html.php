<?php if ($this->_var['app_index'] == 'app'): ?>
	<header class="bar bar-nav b-line">
	<?php if ($this->_var['page_finsh']): ?>

    <?php else: ?>
    <a class="header-btn header-left iconfont back map-pop" data-transition='slide-out'>&#xe635;</a>
    <?php endif; ?>
	
	<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
	<span class="header-txt header-right active u-edit_all" check="<?php echo $this->_var['check']; ?>">完成</span>
</header>
<?php else: ?>
<header class="bar bar-nav b-line">
	<a class="header-btn header-left iconfont back map-pop" data-transition='slide-out'>&#xe635;</a>
	<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
	<span class="header-txt header-right active u-edit_all" check="<?php echo $this->_var['check']; ?>">完成</span>
</header>
<?php endif; ?>