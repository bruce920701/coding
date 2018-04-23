<?php if ($this->_var['app_index'] == 'app'): ?>
<header class="headerindex">
	<div class="mark"></div>
	<div class="left">
		<a class="choosecity" href="<?php
echo parse_url_tag("u:index|city|"."".""); 
?>"><?php echo $this->_var['data']['city_name']; ?><i class="iconfont">&#xe608;</i></a>
	</div>
	<div class="middle">
		<a class="flex-1" href="<?php
echo parse_url_tag("u:index|search#index|"."".""); 
?>" data-no-cache="true"><i class="iconfont">&#xe61a;</i>搜索商品或店铺</a>
		<?php if ($this->_var['data']['is_weixin']): ?>
		<a id="scanQRCode" href="javascript:void(0);" style='-webkit-flex-shrink: 0;flex-shrink: 0; width: auto;'> <i class="iconfont">&#xe754;</i></a>
		<?php endif; ?>
	</div>
	<i class="iconfont">&#xe754;</i>
	<div class="right">
		<a class="" href="<?php
echo parse_url_tag("u:index|uc_msg|"."".""); 
?>"> <i class="iconfont">&#xe605;</i><?php if ($this->_var['data']['not_read_msg']): ?><div class="newstip"></div><?php endif; ?></a>
	</div>
</header>
<?php else: ?>
<header class="headerindex">
	<div class="mark"></div>
	<div class="left">
	<a class="choosecity" href="<?php
echo parse_url_tag("u:index|city|"."".""); 
?>"><?php echo $this->_var['data']['city_name']; ?><i class="iconfont">&#xe608;</i></a>
	</div>
	<div class="middle">
		<a class="flex-1" href="<?php
echo parse_url_tag("u:index|search#index|"."".""); 
?>" data-no-cache="true"><i class="iconfont">&#xe61a;</i>搜索商品或店铺</a>
		<?php if ($this->_var['data']['is_weixin']): ?>
		<a id="scanQRCode" href="javascript:void(0);" style='-webkit-flex-shrink: 0;flex-shrink: 0; width: auto;'> <i class="iconfont">&#xe754;</i></a>
		<?php endif; ?>
	</div>

	
	<div class="right">
	<a class="" href="<?php
echo parse_url_tag("u:index|uc_msg|"."".""); 
?>"> <i class="iconfont">&#xe605;</i><?php if ($this->_var['data']['not_read_msg']): ?><div class="newstip"></div><?php endif; ?></a>
	</div>
</header>
<?php endif; ?>