<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-current" id="help">
<script>
	var settingid = '<?php echo $this->_var['data']['settingid']; ?>';
</script>
	<div class="help-search">
		<a href="<?php
echo parse_url_tag("u:index|help#search|"."".""); 
?>" class="search-link flex-box"><div class="iconfont">&#xe621;</div><p>有问题？点我搜搜看~</p></a>
	</div>
	<?php if ($this->_var['data']['data']): ?>
	<div class="m-nav-tab b-line">
		<ul class="nav-tab flex-box">
			<?php $index = 0; ?>
			<?php $_from = $this->_var['data']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
			<li class="j-nav-item flex-1 <?php if ($index == 0) {echo 'active';} ?>"><span class="nav-item"><?php echo $this->_var['item']['title']; ?></span></li>
			<?php $index++; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			
			<!-- <li class="j-nav-item flex-1"><span class="nav-item">其他问题</span></li> -->
		</ul>
		<div class="tab-line"></div>
	</div>
	<?php endif; ?>
	<div class="help-menu flex-box t-line">
		<?php if ($this->_var['app_index'] == 'app' && isOpenXN ( ) && $this->_var['data']['settingid']): ?>
		<a class="flex-1 xnOpenSdk">
			<div class="iconfont">&#xe693;</div>
			<p>在线客服</p>
		</a>
		<?php endif; ?>
		<a href="tel:<?php echo $this->_var['data']['shop_tel']; ?>" class="flex-1">
			<div class="iconfont">&#xe6ed;</div>
			<p>咨询电话</p>
		</a>
	</div>
    <?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
    <div class="content">
      <!-- 页面主体 -->
      	<?php if ($this->_var['data']['data']): ?>
		<div class="m-bar-list">
			<?php $index = 0; ?>
			<?php $_from = $this->_var['data']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lists');if (count($_from)):
    foreach ($_from AS $this->_var['lists']):
?>
			<ul class="bar-list <?php if ($index == 0) {echo 'active';} ?>">
			<?php $_from = $this->_var['lists']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
				<li class="b-line">
					<a href="<?php echo $this->_var['list']['url']; ?>" class="flex-box">
						<p class="flex-1 bar-tit"><?php echo $this->_var['list']['title']; ?></p>
						<div class="iconfont">&#xe607;</div>
					</a>
				</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<?php $index++; ?>
			</ul>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

			<!-- <ul class="bar-list active">
				<li class="b-line">
					<a href="" class="flex-box">
						<p class="flex-1 bar-tit">商品咨询</p>
						<div class="iconfont">&#xe607;</div>
					</a>
				</li>
			</ul> -->
		</div>
		<?php else: ?>
		<div class="tipimg no_data">
		暂无帮助文章
		</div>
		<?php endif; ?>
  	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>