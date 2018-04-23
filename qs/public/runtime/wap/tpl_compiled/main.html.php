<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index" id="main">
<script>
var INDEX_URL='<?php
echo parse_url_tag("u:index|main|"."".""); 
?>';
var html_id='main';
var geo_url = '<?php
echo parse_url_tag("u:index|userxypoint|"."".""); 
?>';
var TENCENT_MAP_APPKEY="<?php echo app_conf("TENCENT_MAP_APPKEY"); ?>";
</script>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
  	<div class="content infinite-scroll infinite-scroll-bottom infinite-index-bottom">
  <!-- Slider -->
	<?php if ($this->_var['data']['advs']): ?>
	  <div class="m-index-banner j-index-banner" data-space-between='0'>
	    <div class="swiper-wrapper">
	    <?php $_from = $this->_var['data']['advs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'adv');if (count($_from)):
    foreach ($_from AS $this->_var['adv']):
?>
	      <div class="swiper-slide">
	      <a href="<?php echo $this->_var['adv']['url']; ?>" data-no-cache="true">
	      <img alt="" src="<?php echo $this->_var['adv']['img']; ?>"/>
	      </a>
	      </div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	    </div>
	    <?php if ($this->_var['data']['is_banner_square'] == 1): ?>
	    <div class="swiper-pagination flex-box"></div>
	    <?php else: ?>
	    <div class="swiper-pagination flex-box"></div>
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
		  <?php if ($this->_var['data']['indexs']['count'] - 1 > 9): ?>
		  <div class="sort-pagination flex-box"></div>
		  <?php endif; ?>
		  </div>
	<?php endif; ?>
	<?php if ($this->_var['data']['zt_html5']): ?>
	<?php echo $this->_var['data']['zt_html5']; ?>
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
	<?php if ($this->_var['data']['xzt_html']): ?>
	<?php echo $this->_var['data']['xzt_html']; ?>
	<?php endif; ?>
	<!--<div class="m-topic m-topic3">
		<div class="con">
			<div class="imgbox b-line">
			规格374*300 
			<a  href=""><img alt="" date-load="1" data-src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/text/topic22.jpg" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></a>
			</div>
			<div class="imgbox b-line l-line">
			规格374*300
			<a href=""><img alt="" date-load="1" data-src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/text/topic22.jpg" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></a>
			</div>
			<div class="imgbox b-line">
			<a href=""><img alt="" date-load="1" data-src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/text/topic22.jpg" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></a>
			</div>
			<div class="imgbox b-line l-line">
			<a href=""><img alt="" date-load="1" data-src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/text/topic22.jpg" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></a>
			</div>
		</div>
	</div>--><!-- m-topic3 -->
	<?php if ($this->_var['data']['deal_list']): ?>
	<!-- 团购推荐 -->
	<div class="m-guess">
		<div class="tit">
		<span><i class="icon iconfont">&#xe63c;</i><i>团购推荐</i> </span>
		</div>
	</div>
	<!-- 团购推荐end -->
	<!-- 团购列表 -->
	<div class="m-goods-list m-tuan-list">
		<ul class="type-list clearfix j-ajaxadd">
			<?php $_from = $this->_var['data']['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'supplier_deal_item');$this->_foreach['supplier_deal_item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['supplier_deal_item']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['supplier_deal_item']):
        $this->_foreach['supplier_deal_item']['iteration']++;
?>
			<li class="b-line">
				<a data-no-cache="true" href="<?php echo $this->_var['supplier_deal_item']['url']; ?>">
					<div class="goods-img">
						<img alt="" src="<?php if ($this->_var['supplier_deal_item']['f_icon'] != ""): ?><?php echo $this->_var['supplier_deal_item']['f_icon']; ?><?php else: ?><?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png<?php endif; ?>"/>
						<div class="tuan-sale-info">
							<p class="sale"><?php if ($this->_var['supplier_deal_item']['buy_count'] > 0): ?>已售<?php echo $this->_var['supplier_deal_item']['buy_count']; ?><?php endif; ?></p>
							<p class="distance"><?php echo $this->_var['supplier_deal_item']['distance']; ?></p>
						</div>
					</div>
					<div class="goods-info">
						<div class="tuan-name"><h2><?php echo $this->_var['supplier_deal_item']['supplier_name']; ?></h2><p class="distance"><?php echo $this->_var['supplier_deal_item']['distance']; ?></p></div>
						<p class="tuan-tip"><?php echo $this->_var['supplier_deal_item']['brief']; ?></p>
						<div class="sale-info">
							<p class="price"><?php echo $this->_var['supplier_deal_item']['current_price']; ?><?php if ($this->_var['supplier_deal_item']['origin_price'] > 0): ?><del class="p-price">￥<?php echo $this->_var['supplier_deal_item']['origin_price']; ?></del><?php endif; ?></p>
							<p class="sale"><?php if ($this->_var['supplier_deal_item']['buy_count'] > 0): ?>已售<?php echo $this->_var['supplier_deal_item']['buy_count']; ?><?php endif; ?></p>
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
	<!-- 团购列表end -->
	<div class="tuan-more">
		<ul class="tuan-more-list">
			<?php $_from = $this->_var['data']['recommend_deal_cate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['cate'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cate']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['cate']['iteration']++;
?>
			<?php if ($this->_foreach['cate']['iteration'] < 7): ?>
			<li><a href="<?php echo $this->_var['cate']['url']; ?>"><?php echo $this->_var['cate']['name']; ?></a></li>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
	</div>
  	</div><!--content end  -->
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>