<?php if ($this->_var['app_index'] == 'app'): ?>
	<header class="bar bar-nav b-line">
		<?php if ($this->_var['page_finsh']): ?>
		<a class="header-btn header-left iconfont" href="javascript:App.page_finsh();">&#xe604;</a>
		<?php else: ?>
		<a class="header-btn header-left iconfont <?php if ($this->_var['back_url']): ?>go_back<?php else: ?>back<?php endif; ?>" <?php if ($this->_var['back_url']): ?>data-no-cache="true"<?php endif; ?> href="">&#xe604;</a>
		<?php endif; ?>
		<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
		<a href="<?php
echo parse_url_tag("u:index|youhuis|"."".""); 
?>" class="header-txt header-right youhui-link <?php if ($this->_var['type'] == 1): ?>hide<?php endif; ?>" data-no-cache="true">领券</a>
		<a href="<?php
echo parse_url_tag("u:index|uc_ecv#exchange|"."".""); 
?>" class="header-txt header-right ecv-link <?php if ($this->_var['type'] == 0): ?>hide<?php endif; ?>" data-no-cache="true">红包兑换</a>
	</header>
<?php else: ?>
	<header class="bar bar-nav b-line">
		<a class="header-btn header-left iconfont <?php if ($this->_var['back_url']): ?>go_back<?php else: ?>back<?php endif; ?>" <?php if ($this->_var['back_url']): ?>data-no-cache="true"<?php endif; ?> href="" >&#xe604;</a>
		<h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
		<a href="<?php
echo parse_url_tag("u:index|youhuis|"."".""); 
?>" class="header-txt header-right youhui-link <?php if ($this->_var['type'] == 1): ?>hide<?php endif; ?>" data-no-cache="true">领券</a>
		<a href="<?php
echo parse_url_tag("u:index|uc_ecv#exchange|"."".""); 
?>" class="header-txt header-right ecv-link <?php if ($this->_var['type'] == 0): ?>hide<?php endif; ?>" data-no-cache="true">红包兑换</a>
	</header>
	<!-- 弹出层 -->
<?php endif; ?>