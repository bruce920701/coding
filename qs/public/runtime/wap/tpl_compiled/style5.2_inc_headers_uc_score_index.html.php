<header class="bar bar-nav b-line">
  <?php if ($this->_var['page_finsh']): ?>
	<a href="javascript:App.page_finsh();"  class="header-btn header-left iconfont">&#xe604;</a>
  <?php else: ?>
  <a class="header-btn header-left iconfont back">&#xe604;</a>
  <?php endif; ?>
   <h2 class="header-title"><?php echo $this->_var['data']['page_title']; ?></h2>
<?php if ($this->_var['SCORE_RECHARGE_SWITCH']): ?>
<a class="header-txt header-right" data-no-cache="true" href="<?php
echo parse_url_tag("u:index|uc_score#buy_score|"."".""); 
?>">购买积分</a>
<?php else: ?>
<a class="header-txt header-right" data-no-cache="true" href="<?php
echo parse_url_tag("u:index|uc_order|"."pay_status=9".""); 
?>">兑换记录</a>
<?php endif; ?>
</header>