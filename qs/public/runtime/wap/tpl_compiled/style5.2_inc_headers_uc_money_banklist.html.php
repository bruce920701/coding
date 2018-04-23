<header class="bar bar-nav b-line">
  <?php if ($this->_var['page_finsh']): ?>

  <?php else: ?>
  <a class="header-btn header-left iconfont back">&#xe604;</a>
  <?php endif; ?>
  <h2 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h2>
  <a class="header-txt header-right load_page2" href="javascript:void(0);" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/add_card.js' url="<?php
echo parse_url_tag("u:index|uc_money#add_card|"."".""); 
?>">添加</a>
</header>
