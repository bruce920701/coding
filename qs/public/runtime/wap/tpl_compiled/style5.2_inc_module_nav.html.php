<?php if ($this->_var['app_index'] == 'app'): ?>
//app上显示
<nav class="bar bar-tab">
	<a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'index'): ?>active<?php endif; ?>" href="javascript:App.app_detail(1,0);">
	<span class="icon iconfont i-home"></span>
	<span class="tab-label">首页</span>
	</a>
	<a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'cate'): ?>active<?php endif; ?>" href="javascript:App.app_detail(208,0);">
	<span class="icon iconfont i-find"></span>
	<span class="tab-label">分类</span>
	</a>
	<a data-no-cache="true" class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'cart'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>;" >
	<span class="icon iconfont i-shopcart"></span>
	<span class="tab-label">购物车</span>
	</a>

	<?php if ($this->_var['is_login']): ?>
	<a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'user_center'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|user_center|"."".""); 
?>;" data-no-cache="true">
		<span class="icon iconfont i-mine"></span>
		<span class="tab-label">我的</span>
	</a>
		<?php else: ?>
		<a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'user_center'): ?>active<?php endif; ?>" href="javascript:App.login_sdk();" data-no-cache="true">

			<span class="icon iconfont i-mine"></span>
			<span class="tab-label">我的</span>
		</a>
		<?php endif; ?>


</nav>
<?php else: ?>
  	<nav class="bar bar-tab">
	    <a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'index'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>" data-no-cache="true">
	      	<span class="icon iconfont i-home"></span>
	      	<span class="tab-label">首页</span>
	    </a>
	    <a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'cate'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|cate|"."".""); 
?>" data-no-cache="true">
	      	<span class="icon iconfont i-find"></span>
	      	<span class="tab-label">分类</span>
	    </a>
	    <a data-no-cache="true" class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'cart'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>" data-no-cache="true">
	      	<span class="icon iconfont i-shopcart"></span>
	      	<span class="tab-label">购物车</span>
	    </a>
	    <a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'user_center'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|user_center|"."".""); 
?>" data-no-cache="true">
	      	<span class="icon iconfont i-mine"></span>
	      	<span class="tab-label">我的</span>
	    </a>
  	</nav>
<?php endif; ?>