<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/article.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/article.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/article.js";
?>
<?php echo $this->fetch('inc/header.html'); ?> 
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?>">
	<div class="blank20"></div>
	<div class="line"></div>
	<div class="blank20"></div>
	<div class="cate_box f_l">
		<?php $_from = $this->_var['deal_help']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');if (count($_from)):
    foreach ($_from AS $this->_var['cate']):
?>
		<div class="cate_item">			
			<div class="cate_title" style="padding-left:15px;"><?php if ($this->_var['cate']['iconfont'] != ''): ?><i class="diyfont"><?php echo $this->_var['cate']['iconfont']; ?></i>&nbsp;&nbsp;&nbsp;<?php endif; ?><?php echo $this->_var['cate']['title']; ?></div>
			<?php $_from = $this->_var['cate']['help_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
			<div class="cate_name">
				<a href="<?php echo $this->_var['item']['url']; ?>" <?php if ($this->_var['item']['id'] == $this->_var['article']['id']): ?>class="act"<?php endif; ?> <?php if ($this->_var['item']['new'] == 1): ?>target="_blank"<?php endif; ?>><span class="cate_icon"></span><?php echo $this->_var['item']['title']; ?></a>
			</div>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


	</div>
	<div class="article_box f_r">
		<!-- <div class="article_top"><h3><span><?php echo $this->_var['cur_title']; ?></span></h3></div> -->
		
		<div class="blank20"></div>
		<div class="article_content">
			<h2><?php echo $this->_var['article']['title']; ?></h2>
			<div class="update_time"><?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['article']['update_time'],
);
echo $k['name']($k['v']);
?></div>
			<div class="editor">
					<?php echo $this->_var['article']['content']; ?>
			</div>
		</div>
	</div>

</div>
<div class="blank"></div>

<?php echo $this->fetch('inc/footer.html'); ?>