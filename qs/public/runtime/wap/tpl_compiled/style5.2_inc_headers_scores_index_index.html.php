<?php if ($this->_var['app_index'] == 'app'): ?>
<header class="bar bar-nav">
    <h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
    <?php if ($this->_var['page_finsh']): ?>
        <a href="javascript:App.page_finsh();"  class="header-btn header-left iconfont">&#xe604;</a>
    <?php else: ?>
        <a class="header-btn header-left iconfont back">&#xe604;</a>
    <?php endif; ?>
    <a href="<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=9".""); 
?>" class="header-txt header-right">兑换记录</a>
</header>
<?php else: ?>
<header class="bar bar-nav m-scores-index-head">
    <h1 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h1>
    <a class="header-btn header-left iconfont back">&#xe604;</a>
    <a href="<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=9".""); 
?>" data-no-cache="true" class="header-txt header-right">兑换记录</a>
</header>
<?php endif; ?>