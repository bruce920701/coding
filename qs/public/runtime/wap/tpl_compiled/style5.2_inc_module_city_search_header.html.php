<?php if ($this->_var['app_index'] == 'app'): ?>
<?php echo $this->fetch('style5.2/inc/module/app-dropdown-nav.html'); ?>
<header class="bar bar-nav">
	<div class="m-search-header flex-box">
		<div class="left">
			<a class="choosecity" href="<?php
echo parse_url_tag("u:index|city|"."".""); 
?>"><?php echo $this->_var['data']['city_name']; ?><i class="iconfont">&#xe608;</i></a>
		</div>
		<a href="javascript:App.app_detail(105,0)" class="flex-1">
		<div class="flex-box go-search">
			<i class="iconfont">&#xe61a;</i>
			<?php if ($this->_var['data']['keyword']): ?>
			<p><?php echo $this->_var['data']['keyword']; ?></p>
			<?php else: ?>
			<p>搜索商品或店铺</p>
			<?php endif; ?>
		</div>
		</a>
	</div>
</header>
<?php else: ?>
<?php echo $this->fetch('style5.2/inc/module/dropdown-nav.html'); ?>
<header class="bar bar-nav">
	<div class="m-search-header flex-box">
		<div class="left" style="padding: 0 .5rem;">
			<a class="choosecity" href="<?php
echo parse_url_tag("u:index|city|"."type=".$this->_var['data']['ctl']."".""); 
?>"><?php echo $this->_var['data']['city_name']; ?><i class="iconfont">&#xe608;</i></a>
		</div>
		<a href="<?php
echo parse_url_tag("u:index|search#index|"."".""); 
?>" class="flex-1">
			<div class="flex-box go-search">
				<i class="iconfont">&#xe61a;</i>
				<?php if ($this->_var['data']['keyword']): ?>
				<p><?php echo $this->_var['data']['keyword']; ?></p>
				<?php else: ?>
				<p>搜索商品或店铺</p>
				<?php endif; ?>
			</div>
		</a>
	</div>
</header>
<?php endif; ?>
