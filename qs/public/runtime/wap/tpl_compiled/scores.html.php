<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php
	$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/page/scores_index.css";
	$this->_var['cpagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/page/scores_index.css";
	$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/page/scores_index.js";
	$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/page/scores_index.js";
?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var INDEX_URL='<?php
echo parse_url_tag("u:index|scores|"."".""); 
?>';
</script>
<div class="page page-index page-current" id="scores">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
		<?php if ($this->_var['data']['item']): ?>
			<div class="j-ajaxlist">
			<div class="j-ajaxadd">
				<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');if (count($_from)):
    foreach ($_from AS $this->_var['deal']):
?>
				<dl class="m-hot-dui">
					<a data-no-cache="true" href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['deal']['id']."".""); 
?>">
					<dd class="flex-box dui-item b-line">
						<img src="<?php echo $this->_var['deal']['f_icon_v1']; ?>" alt="<?php echo $this->_var['deal']['name']; ?>" class="good-img">
						<div class="flex-1 good-info">
							<div class="good-name"><?php echo $this->_var['deal']['name']; ?></div>
							<div class="good-score"><em><?php echo $this->_var['deal']['deal_score']; ?></em>&nbsp;积分</div>
						</div>
					</dd>
					</a>
				</dl>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
			<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
			</div>
			
		<?php else: ?>
        <div class="tipimg no_data">暂无团购</div>	
		<?php endif; ?>	
	</div>
	<!-- 弹出层 -->
	<div class="flippedout ">
	<!-- 导航下拉开始 -->
		<div class="m-nav-dropdown">
			<div class="nav-dropdown-con">
				<div class="flex-box func-list">
					<div class="flex-1"><a href="javascript:window.location.reload();"><i class="iconfont">&#xe630;</i></a></div>
				</div>
				<?php echo $this->fetch('style5.2/inc/module/dropdown-navlist.html'); ?>
			</div>
		</div>
	<!-- 导航下拉结束 -->
		<div class="close-flippedout j-flippedout-close">
			<i class="iconfont">&#xe635;</i>
		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>