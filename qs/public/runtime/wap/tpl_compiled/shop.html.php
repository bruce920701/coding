<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var INDEX_URL='<?php
echo parse_url_tag("u:index|shop|"."".""); 
?>';
var geo_url = '<?php
echo parse_url_tag("u:index|userxypoint|"."".""); 
?>';
</script>
<div class="page page-current" id="shop">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
  	<div class="content infinite-scroll infinite-scroll-bottom infinite-index-bottom">
  		<div class="shop-nav flex-box b-line">
  			<a href="<?php
echo parse_url_tag("u:index|cate|"."".""); 
?>" class="cate-link"  data-no-cache="true">
  				<i class="iconfont">&#xe63e;</i>
  				<p>分类</p>
  			</a>
  			<a href="<?php
echo parse_url_tag("u:index|search#index|"."".""); 
?>" class="flex-1">
  				<div class="flex-box go-search">
  					<i class="iconfont">&#xe61a;</i>
  					<?php if ($this->_var['data']['keyword']): ?>
  					<p><?php echo $this->_var['data']['keyword']; ?></p>
  					<?php else: ?>
  					<p>搜索商品或店铺</p>
  					<?php endif; ?>
  				</div>
  			</a>
  		</div>
  <!-- Slider -->
<?php if ($this->_var['data']['advs']): ?>
	  <div class="m-index-banner j-index-banner" data-space-between='0'>
	    <div class="swiper-wrapper">
	    <?php $_from = $this->_var['data']['advs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'adv');if (count($_from)):
    foreach ($_from AS $this->_var['adv']):
?>
	      <div class="swiper-slide">
	      <a href="<?php echo $this->_var['adv']['url']; ?>"  data-no-cache="true">
	      <img alt="" src="<?php echo $this->_var['adv']['img']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/banner_load.jpg"/>
	      </a>
	      </div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	    </div>
	    <?php if ($this->_var['data']['is_banner_square'] == 1): ?>
	    <div class="swiper-pagination"></div>
	    <?php else: ?>
	    <div class="swiper-pagination"></div>
	    <div class="sbroud"><img alt="" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/sbroud.png"/></div>
	    <?php endif; ?>
	  </div>
	<?php endif; ?>

	<?php if ($this->_var['data']['indexs']['count'] > 0): ?>
		<div class="m-sort_nav  j-sort_nav" data-space-between='0'>
		  <div class="sort_list swiper-wrapper">
		  		<?php $_from = $this->_var['data']['indexs']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');$this->_foreach['index_nav'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['index_nav']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
        $this->_foreach['index_nav']['iteration']++;
?>
		  		<?php if (($this->_foreach['index_nav']['iteration'] - 1) % 10 == 0): ?>
		  		<div  class="sort_box swiper-slide" <?php echo ($this->_foreach['index_nav']['iteration'] - 1); ?>>
		  		<?php endif; ?>
			  			<div class="sort_li">	
							<a href="<?php echo $this->_var['item']['url']; ?>" data-no-cache="true">
		  	    			<span class="yuan" style="background-color:<?php echo $this->_var['item']['bg_color']; ?>" ><i class="diyfont" style="color:<?php echo $this->_var['item']['color']; ?>"><?php echo $this->_var['item']['icon_name']; ?></i></span>
							<span class="txt"><?php echo $this->_var['item']['name']; ?></span>
							</a>
				  		</div>
				<?php if (($this->_foreach['index_nav']['iteration'] - 1) == $this->_var['data']['indexs']['count'] - 1): ?>
		  		</div><!--第一版的闭合标签  -->
		  		<?php endif; ?> 		
		  		<?php if (($this->_foreach['index_nav']['iteration'] - 1) > 2 && ($this->_foreach['index_nav']['iteration'] - 1) % 10 == 9 && ($this->_foreach['index_nav']['iteration'] - 1) != $this->_var['data']['indexs']['count'] - 1): ?>
		  		</div><!-- 第二版的闭合标签 -->
		  		<?php endif; ?>
		  		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		  </div>
		  </div>
	<?php endif; ?>
	<?php if ($this->_var['data']['zt_html3']): ?>
	<?php echo $this->_var['data']['zt_html3']; ?>
	<?php endif; ?>
	<?php if ($this->_var['data']['zt_html4']): ?>
	<?php echo $this->_var['data']['zt_html4']; ?>
	<?php endif; ?>
	<?php if ($this->_var['data']['zt_html6']): ?>
	<?php echo $this->_var['data']['zt_html6']; ?>
	<?php endif; ?>
	<?php if ($this->_var['data']['advs2']): ?>
	<div class="m-index-lb j-index-lb index_adv2" data-space-between='0'>
	    <div class="swiper-wrapper">
	      <?php $_from = $this->_var['data']['advs2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'advs2');$this->_foreach['index_nav'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['index_nav']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['advs2']):
        $this->_foreach['index_nav']['iteration']++;
?>
	      <div class="swiper-slide">
	      <a href="<?php echo $this->_var['advs2']['url']; ?>"  data-no-cache="true">
	      <img alt="<?php echo $this->_var['advs2']['name']; ?>" src="<?php if ($this->_var['advs2']['img'] != ''): ?><?php echo $this->_var['advs2']['img']; ?><?php else: ?><?php echo $this->_var['TMPL']; ?>/style5.2/images/text/lb_index.jpg<?php endif; ?>"/>
	      </a>
	      </div>
		  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	    </div>
	    <div class="swiper-pagination"></div>
	</div>
	<?php endif; ?>
	<?php if ($this->_var['data']['zt_html5']): ?>
	<?php echo $this->_var['data']['zt_html5']; ?>
	<?php endif; ?>
	<?php if ($this->_var['data']['xzt_html']): ?>
	<?php echo $this->_var['data']['xzt_html']; ?>
	<?php endif; ?>
	<!-- 猜你喜欢 -->
	<?php if ($this->_var['data']['supplier_deal_list']): ?>
	<div class="m-guess">
		<div class="tit">
		<span><i class="icon iconfont">&#xe631;</i><i>猜你喜欢</i> </span>
		</div>
	</div>
	<!-- 猜你喜欢end -->
	<!-- 商品列表 -->
	<div class="m-goods-list">
		<ul class="type-cube clearfix j-ajaxadd"><!-- 豆腐块列表 -->
		<!-- 	<ul class="type-list clearfix">常规列表     -->		
			 <?php $_from = $this->_var['data']['supplier_deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'supplier_deal');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['supplier_deal']):
?>
			 <li>
				<a data-no-cache="true" href="<?php echo $this->_var['supplier_deal']['url']; ?>">
					<div class="goods-img"><img alt="" date-load="1" data-src="<?php if ($this->_var['supplier_deal']['f_icon'] != ''): ?><?php echo $this->_var['supplier_deal']['f_icon']; ?><?php else: ?><?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png<?php endif; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></div>
					<div class="goods-info">
						<h2 class="goods-name"><?php echo $this->_var['supplier_deal']['name']; ?></h2>
						<div class="sale-info">
							<p class="price"><?php echo $this->_var['supplier_deal']['current_price']; ?></p>
						</div>
					</div>
				</a>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
		<div class="page-load hide">
			<span></span>
		</div>
		<div class="infinite-scroll-preloader hide">
              <div class="preloader"></div>
        </div>
	</div>
	<?php endif; ?>
	<!-- 商品列表end -->
  	</div><!--content end  -->
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>