<script type="text/javascript">
	var share_url='<?php echo $this->_var['wx_share_url']; ?>';
	var share_title='<?php echo $this->_var['share_title']; ?>';
	var share_content='<?php echo $this->_var['share_content']; ?>';
	var imgUrl = '<?php echo $this->_var['share_img']; ?>';
	<?php if ($this->_var['is_weixin'] && $this->_var['signPackage']['appId']): ?>
	var appId = '<?php echo $this->_var['signPackage']['appId']; ?>';
	var timestamp = '<?php echo $this->_var['signPackage']['timestamp']; ?>';
	var nonceStr = '<?php echo $this->_var['signPackage']['nonceStr']; ?>';
	var signature = '<?php echo $this->_var['signPackage']['signature']; ?>';
	

	var page_title = '<?php echo $this->_var['data']['page_title']; ?>';	


	<?php endif; ?>
</script>

<?php if ($this->_var['is_weixin'] && $this->_var['signPackage']['appId']): ?>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php endif; ?>

