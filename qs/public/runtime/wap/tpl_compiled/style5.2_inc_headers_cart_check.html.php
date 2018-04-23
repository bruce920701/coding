<?php if ($this->_var['app_index'] == 'app'): ?>
<header class="bar bar-nav b-line">
  <!--  <?php if ($this->_var['page_finsh']): ?>
		<a class="iconfont header-btn header-left" href="javascript:App.page_finsh();" >&#xe604;</a>
    <?php else: ?>
	   	<a class="header-btn header-left iconfont <?php if ($this->_var['address_id'] > 0): ?>back<?php else: ?>j-sure-cancel <?php endif; ?> " data-transition='slide-out'>&#xe604;</a>
	   	<?php if ($this->_var['data']['invoice_notice']): ?><a href="" class="header-txt header-right j-open-invoice-popup">发票需知</a><?php endif; ?>
    <?php endif; ?>
-->
	<a class="header-btn header-left iconfont <?php if ($this->_var['address_id'] > 0): ?>back<?php else: ?>j-sure-cancel <?php endif; ?> " data-transition='slide-out'>&#xe604;</a>
	<h1 class="header-title">确认订单</h1>
</header>
<?php else: ?>
<header class="bar bar-nav b-line">
	<a class="header-btn header-left iconfont <?php if ($this->_var['address_id'] > 0): ?>back<?php else: ?>j-sure-cancel <?php endif; ?> " data-transition='slide-out'>&#xe604;</a>
	<h1 class="header-title">确认订单</h1>
	<?php if ($this->_var['data']['invoice_notice']): ?><a href="" class="header-txt header-right j-open-invoice-popup">发票需知</a><?php endif; ?>
</header>
<?php endif; ?>