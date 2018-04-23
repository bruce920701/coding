<div class="dropdown-navlist flex-box">
	<a href="javascript:App.app_detail(1,0);" class="flex-1" data-no-cache="true">
		<i class="iconfont">&#xe61f;</i>
		<p>首页</p>
	</a>
	<a href="javascript:App.app_detail(105,0);" class="flex-1" data-no-cache="true">
		<i class="iconfont">&#xe621;</i>
		<p>搜索</p>
	</a>
	<?php if ($this->_var['is_login']): ?>
	<a href="javascript:App.app_detail(108,0);" class="flex-1" data-no-cache="true">
	<?php else: ?>
	<a href="javascript:App.login_sdk();" class="flex-1" data-no-cache="true">
		<?php endif; ?>
		<i class="iconfont <?php if ($this->_var['user_info']['msg_count'] > 0): ?>redpoint<?php endif; ?>">&#xe620;</i>
		<p>消息</p>
	</a>

	<a href="javascript:App.app_detail(106,0);" class="flex-1" data-no-cache="true">
		<i class="iconfont <?php if ($this->_var['data']['cart_total_num']): ?>redpoint<?php endif; ?>">&#xe61e;</i>
		<p>购物车</p>
	</a>
	<a href="javascript:App.app_detail(107,0)" class="flex-1" data-no-cache="true">
		<i class="iconfont">&#xe622;</i>
		<p>我的</p>
	</a>
</div>