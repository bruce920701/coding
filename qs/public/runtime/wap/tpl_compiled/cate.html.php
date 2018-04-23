<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-current" id="cate">
	<?php echo $this->fetch('style5.2/inc/module/nav.html'); ?>
 	<?php echo $this->fetch('style5.2/inc/module/city_search_header.html'); ?>
  	<div class="content">
   		<!-- 页面主体 -->
      <div class="cate-list r-line">
      	<?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['goods-type'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods-type']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['goods-type']['iteration']++;
?>
        <li class="<?php if ($this->_var['cate']['id'] == '0'): ?>active<?php endif; ?> b-line"><?php echo $this->_var['cate']['name']; ?></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </div>
      <div class="cate-info flex-1">
        <?php if ($this->_var['data']['bcate_list']): ?>
      	<?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');if (count($_from)):
    foreach ($_from AS $this->_var['cate']):
?>
        <ul class="clearfix">
          <?php $_from = $this->_var['cate']['bcate_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate_item');if (count($_from)):
    foreach ($_from AS $this->_var['cate_item']):
?>
          <li>
            <div class="cate-detail">
              <a href="<?php
echo parse_url_tag("u:index|goods|"."cate_id=".$this->_var['cate_item']['id']."".""); 
?>">
              <div class="cate-img"><img alt="" src="<?php if ($this->_var['cate_item']['cate_img'] != ''): ?><?php echo $this->_var['cate_item']['cate_img']; ?><?php else: ?><?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png<?php endif; ?>"/></div>
              <p class="cate-tit"><?php echo $this->_var['cate_item']['name']; ?></p>
              </a>
            </div>
          </li>
    		  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php else: ?>
        <div class="tipimg no_data">暂无数据</div>
        <?php endif; ?>
      </div>
  	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
