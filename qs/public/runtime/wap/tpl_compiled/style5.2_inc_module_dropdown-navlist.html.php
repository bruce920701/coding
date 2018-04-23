<div class="dropdown-navlist flex-box">
	<a href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>" class="flex-1" data-no-cache="true">
		<i class="iconfont">&#xe61f;</i>
		<p>首页</p>
	</a>
	<a href="<?php
echo parse_url_tag("u:index|search|"."".""); 
?>" class="flex-1" data-no-cache="true">
		<i class="iconfont">&#xe621;</i>
		<p>搜索</p>
	</a>
	 
	<a href="<?php
echo parse_url_tag("u:index|uc_msg|"."".""); 
?>" class="flex-1" data-no-cache="true">
		<i class="iconfont <?php if ($this->_var['user_info']['msg_count'] > 0): ?>redpoint<?php endif; ?>">&#xe620;</i>
		<p>消息</p>
	</a>
	
	<a href="<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>" class="flex-1" data-no-cache="true">
		<i class="iconfont <?php if ($this->_var['data']['cart_total_num']): ?>redpoint<?php endif; ?>">&#xe61e;</i>
		<p>购物车</p>
	</a>
	<a href="<?php
echo parse_url_tag("u:index|user_center|"."".""); 
?>" class="flex-1" data-no-cache="true">
		<i class="iconfont">&#xe622;</i>
		<p>我的</p>
	</a>
</div>