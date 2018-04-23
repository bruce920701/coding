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
	<div class="content infinite-scroll infinite-scroll-bottom">
		<div class="notice">
			<h2><?php echo $this->_var['data']['result']['name']; ?></h2>
			<h3><?php echo $this->_var['data']['result']['create_time']; ?></h3>
			<div><?php echo $this->_var['data']['result']['content']; ?></div>
		</div>
	</div><!--content end  -->
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>