<?php
    $this->_var['modlecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/module/nav.css";
?>
  	<nav class="bar bar-tab">
  		<a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'uc_fx' && $this->_var['ACTION_NAME'] == 'index'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|uc_fx#index|"."".""); 
?>" data-no-cache="true">
  		  	<span class="icon iconfont i-mine"></span>
  		  	<span class="tab-label">我的</span>
  		</a>
	    <a class="tab-item <?php if (( $this->_var['MODULE_NAME'] == 'uc_fx' && ( $this->_var['ACTION_NAME'] == 'deal_fx' || $this->_var['ACTION_NAME'] == 'shop_fx' ) || $this->_var['MODULE_NAME'] == 'uc_fxcate' )): ?>active<?php endif; ?>
" href="<?php
echo parse_url_tag("u:index|uc_fx#shop_fx|"."".""); 
?>">
	      	<span class="icon iconfont i-shopcart"></span>
	      	<span class="tab-label">市场</span>
	    </a>
	    <a class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'discover'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|uc_fxwithdraw#index|"."".""); 
?>">
	      	<span class="icon iconfont i-tixian"></span>
	      	<span class="tab-label">提现</span>
	    </a>
	    <a data-no-cache="true" class="tab-item <?php if ($this->_var['MODULE_NAME'] == 'uc_fxinvite'): ?>active<?php endif; ?>" href="<?php
echo parse_url_tag("u:index|uc_fxinvite#index|"."".""); 
?>">
	      	<span class="icon iconfont">&#xe640;</span>
	      	<span class="tab-label">推荐</span>
	    </a>
  	</nav>