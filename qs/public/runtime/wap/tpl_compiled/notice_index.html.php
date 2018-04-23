<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var INDEX_URL='<?php
echo parse_url_tag("u:index|main|"."".""); 
?>';
var geo_url = '<?php
echo parse_url_tag("u:index|userxypoint|"."".""); 
?>';
</script>
<div class="page page-index">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
<div class="content infinite-scroll infinite-scroll-bottom"  data-distance="10">
		<?php if ($this->_var['data']['list']): ?>
	<div class="m-noticeindex j-ajaxlist">
	<ul class="j-ajaxadd">

	<?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['list']):
?>
	<li>
		<a class="con" href="<?php echo $this->_var['list']['url']; ?>">
			<div class="name"><?php echo $this->_var['list']['name']; ?></div>
			<div class="time"><?php echo $this->_var['list']['create_time']; ?></div>
		</a>
	</li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
	<?php if ($this->_var['pages']): ?>
		<div class="pages hide">
			<?php echo $this->_var['pages']; ?>
		</div>
	<?php endif; ?>
	</div>
	<?php else: ?>
	<div class="tipimg no_data">
	暂无数据
	</div>
	<?php endif; ?>





</div><!--content end  -->
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>