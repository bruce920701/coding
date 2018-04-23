<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index page-current" id="uc_review">
	<script>
	var eq=parseInt(<?php echo $this->_var['status']; ?>)+1;
	var url=new Array();
	url[1] = '<?php
echo parse_url_tag("u:index|uc_review|"."status=0".""); 
?>';
	url[2] = '<?php
echo parse_url_tag("u:index|uc_review|"."status=1".""); 
?>';
	</script>
	 <div class="review-tab flex-box b-line">
	 	<div class="flex-1 review-tab-item"><a href="#tab1" rel="1" class="tab-link j-tab-link btn-item active">商品</a></div>
	 	<div class="flex-1 review-tab-item"><a href="#tab2" rel="2" class="tab-link j-tab-link btn-item">店铺</a></div>
	 	<span class="tab-line"></span>
	 </div>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
		<div class="tabs m-comment ">
			<?php if ($this->_var['status'] == 0): ?>
			<div id="tab1" class="tab active j_ajaxlist_1">
			<?php if ($this->_var['data']['item']): ?>
				<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['row']):
?>
				<dd class="comment-con">
					<a href="<?php echo $this->_var['row']['url']; ?>" data-no-cache="ture">
						<div class="commenter flex-box">
							<img alt="商品图标" class="good-logo" src="<?php echo $this->_var['row']['deal_icon']; ?>">
							<div class="user-date flex-1">
								<p class="good-name"><?php echo $this->_var['row']['name']; ?></p>
								<p class="good-spec"><?php if ($this->_var['row']['attr_str']): ?>规格：<?php echo $this->_var['row']['attr_str']; ?><?php endif; ?></p>
							</div>
						</div>
						<div class="comment-txt">
							<?php echo $this->_var['row']['content']; ?>
						</div>
						<div class="dp-date"><?php echo $this->_var['row']['create_time']; ?></div>
					</a>
					<ul class="comment-imglist comment-imglist-nolimit" rel="review">
					<?php $_from = $this->_var['row']['oimages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k1', 'oimage');if (count($_from)):
    foreach ($_from AS $this->_var['k1'] => $this->_var['oimage']):
?>
						<li class="comment-imgitem j-review-item" data="<?php echo $this->_var['k1']; ?>">
							<img date-load="1" data-src="<?php echo $this->_var['oimage']; ?>" src="<?php echo $this->_var['oimage']; ?>" data-lingtsrc="<?php echo $this->_var['oimage']; ?>" width="65" height="65"/>
						</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
					<?php if ($this->_var['row']['reply_content']): ?>
					<div class="shop-reply">
						<div class="sjj-up"></div>
						<p><em>商家回复：</em><?php echo $this->_var['row']['reply_content']; ?></p>
					</div>
					<?php endif; ?>
				</dd>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
			</dl>
			<?php else: ?>
				<div class="tipimg no_data">暂无评论</div>
			<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if ($this->_var['status'] == 1): ?>
			<div id="tab2" class="tab active j_ajaxlist_2">
			<?php if ($this->_var['data']['item']): ?>
				<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['row']):
?>
				<dd class="comment-con">
					<a href="<?php echo $this->_var['row']['url']; ?>" data-no-cache="ture">
						<div class="commenter flex-box">
							<img alt="店铺图标" class="good-logo" src="<?php echo $this->_var['row']['deal_icon']; ?>">
							<div class="user-date flex-1">
								<p class="good-name"><?php echo $this->_var['row']['name']; ?></p>
								<p class="good-spec">&nbsp;</p>
							</div>
						</div>
						<div class="comment-txt">
							<?php echo $this->_var['row']['content']; ?>
						</div>
						<div class="dp-date"><?php echo $this->_var['row']['create_time']; ?></div>
					</a>
					<ul class="comment-imglist comment-imglist-nolimit" rel="review">
					<?php $_from = $this->_var['row']['oimages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k1', 'oimage');if (count($_from)):
    foreach ($_from AS $this->_var['k1'] => $this->_var['oimage']):
?>
						<li class="comment-imgitem j-review-item" data="<?php echo $this->_var['k1']; ?>">
							<img date-load="1" data-src="<?php echo $this->_var['oimage']; ?>" src="<?php echo $this->_var['oimage']; ?>" data-lingtsrc="<?php echo $this->_var['oimage']; ?>" width="65" height="65"/>
						</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
					<?php if ($this->_var['row']['reply_content']): ?>
					<div class="shop-reply">
						<div class="sjj-up"></div>
						<p><em>商家回复：</em><?php echo $this->_var['row']['reply_content']; ?></p>
					</div>
					<?php endif; ?>
				</dd>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
			</dl>
			<?php else: ?>
				<div class="tipimg no_data">暂无评论</div>
			<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>