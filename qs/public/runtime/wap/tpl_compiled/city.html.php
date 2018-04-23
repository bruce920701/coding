<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php
	$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/page/city.css";
	$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/module/search_header.css";	
	$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/page/city.js";

?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-city" id="city">
<script type="text/javascript">
var CITY_URL = '<?php
echo parse_url_tag("u:index|city|"."".""); 
?>';
</script>
<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>


<div class="content infinite-scroll">
	<div class="m-search-box">
	  <div class="searchbar">
	    <a class="searchbar-cancel">重置</a>
	    <div class="search-input">
	      <label class="icon icon-search" for="search"></label>
	      <input type="search" id='search' placeholder='城市/行政区/拼音'/>
	    </div>
	  </div>
	</div><!--m-search-box -->


	<?php if ($this->_var['data']['hot_city']): ?>
	<div class="m-hotcity m-linetit">
		<div class="tit">
			<span>热门城市</span>
		</div>
		<div class="con">
			<?php $_from = $this->_var['data']['hot_city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('keys', 'items');if (count($_from)):
    foreach ($_from AS $this->_var['keys'] => $this->_var['items']):
?>
			<div class="hotcity"><a href="javascript:void(0);" class="city_change" url="<?php echo $this->_var['items']['url']; ?>"><?php echo $this->_var['items']['name']; ?></a></div>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="m-allcity m-linetit">
		<div class="tit">
			<span>全部城市</span>
		</div>
		<div class="con">
			<?php $_from = $this->_var['data']['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
			<ul class="m-city_table">
				<li data="<?php echo $this->_var['key']; ?>" class="letter"><a href="javascript:;"><?php echo $this->_var['key']; ?></a></li>
				<?php $_from = $this->_var['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('keys', 'items');if (count($_from)):
    foreach ($_from AS $this->_var['keys'] => $this->_var['items']):
?>
				<li class="cityname"><a href="javascript:void(0);" class="city_change" url="<?php echo $this->_var['items']['url']; ?>"><?php echo $this->_var['items']['name']; ?></a></li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</div>
	</div>

</div><!-- content end  -->
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>