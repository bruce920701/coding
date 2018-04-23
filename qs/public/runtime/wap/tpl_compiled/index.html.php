<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php
/*    $this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/page/index.css";
    $this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/module/list.css";*/
    /*$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/page/index.js";*/
?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-current" id="index">
<script>
var INDEX_URL='<?php
echo parse_url_tag("u:index|index|"."".""); 
?>';
var html_id='index';
var geo_url = '<?php
echo parse_url_tag("u:index|userxypoint|"."".""); 
?>';
var TENCENT_MAP_APPKEY="<?php echo app_conf("TENCENT_MAP_APPKEY"); ?>";
</script>
<?php echo $this->fetch('style5.2/inc/module/nav.html'); ?>
<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
  	<div class="content  infinite-scroll infinite-scroll-bottom infinite-index-bottom" data-distance="10">
  <!-- Slider -->

	<?php if ($this->_var['data']['advs']): ?>

	  <div class="m-index-banner j-index-banner" data-space-between='0'>
	    <div class="swiper-wrapper">
	    <?php $_from = $this->_var['data']['advs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'adv');if (count($_from)):
    foreach ($_from AS $this->_var['adv']):
?>
	      <div class="swiper-slide">
	      <a href="<?php echo $this->_var['adv']['url']; ?>"  data-no-cache="true">
	      <img alt="" src="<?php echo $this->_var['adv']['img']; ?>"/>
	      </a>
	      </div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	    </div>
	    <?php if ($this->_var['data']['advs_count'] > 1): ?>
	    <div class="swiper-pagination"></div>
	    <?php endif; ?>
		<?php if ($this->_var['data']['is_banner_square'] == 0): ?>
		<!-- 两种展示方式判断 -->
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
							<a data-no-cache="true" href="<?php echo $this->_var['item']['url']; ?>">
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

	<?php if ($this->_var['data']['article']): ?>
	<div class="m-headlines t-line flex-box">
		<div class="left">
			<img alt="" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/m-headlines.png"/>
		</div>
		<div class="middle flex-1 l-line j-headlines ">
			<div class="swiper-wrapper">
			<?php $_from = $this->_var['data']['article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
				<a class="swiper-slide" href="<?php echo $this->_var['article']['url']; ?>"  data-no-cache="true"><?php echo $this->_var['article']['name']; ?></a>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
		</div>
		<div class="right l-line">
			<a href="<?php
echo parse_url_tag("u:index|notices|"."".""); 
?>"  data-no-cache="true">更多</a>
		</div>
	</div>
	<?php endif; ?>
	<!-- m-headlines -->

		<?php if ($this->_var['data']['zt_html3']): ?>
		<?php echo $this->_var['data']['zt_html3']; ?>
		<?php endif; ?>
		<?php if ($this->_var['data']['zt_html6']): ?>
		<?php echo $this->_var['data']['zt_html6']; ?>
		<?php endif; ?>
		<?php if ($this->_var['data']['advs2']): ?>
		<div class="m-index-lb j-index-lb index_adv2" data-space-between='0'>
		    <div class="swiper-wrapper">
		    <?php $_from = $this->_var['data']['advs2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'advs2');if (count($_from)):
    foreach ($_from AS $this->_var['advs2']):
?>
		      <div class="swiper-slide">
		      <a href="<?php echo $this->_var['advs2']['url']; ?>"  data-no-cache="true">
		      <img alt="<?php echo $this->_var['advs2']['name']; ?>" src="<?php echo $this->_var['advs2']['img']; ?>"/>
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
		<?php if ($this->_var['data']['zt_html4']): ?>
		<?php echo $this->_var['data']['zt_html4']; ?>
		<?php endif; ?>
		<?php if ($this->_var['data']['xzt_html']): ?>
		<?php echo $this->_var['data']['xzt_html']; ?>
		<?php endif; ?>

	<?php if ($this->_var['data']['supplier_list']): ?>
		<div class="m-horse">
			<div class="tit">
				<div class="left">好店推荐</div>
				<a class="right" href="<?php
echo parse_url_tag("u:index|stores|"."".""); 
?>"  data-no-cache="true">更多精彩<i class="icon iconfont">&#xe607;</i></a>
			</div>
			<div class="con m-horse-lamp j-horse-lamp">
			   <div class="swiper-wrapper">
			   <?php $_from = $this->_var['data']['supplier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'supplier');if (count($_from)):
    foreach ($_from AS $this->_var['supplier']):
?>
			      <a class="horsebox swiper-slide" href="<?php echo $this->_var['supplier']['url']; ?>"  data-no-cache="true">
			      <div class="imgbox"><img alt="" src="<?php echo $this->_var['supplier']['preview_v2']; ?>"/></div>
			      <h1><?php echo $this->_var['supplier']['name']; ?></h1>
			      </a>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			    </div>
			</div>
		</div><!-- m-horse -->
	<?php endif; ?>

	<?php if ($this->_var['data']['deal_list']): ?>
		<div class="m-guess">
			<div class="tit">
			<span><i class="icon iconfont">&#xe631;</i><i>猜你喜欢</i> </span>
			</div>
		</div>
		<div class="m-goods-list j-ajaxlist">
			<ul class="type-cube clearfix index_tuan-ul  j-ajaxadd"><!-- 豆腐块列表 -->
			<!-- 	<ul class="type-list clearfix">常规列表
				 -->
					<?php $_from = $this->_var['data']['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');if (count($_from)):
    foreach ($_from AS $this->_var['deal']):
?>
						<li>
							<a href="<?php echo $this->_var['deal']['url']; ?>" data-no-cache="true">
								<div class="goods-img"><img alt="" src="<?php echo $this->_var['deal']['f_icon']; ?>"/></div>
								<div class="goods-info">
									<h2 class="goods-name"><?php echo $this->_var['deal']['name']; ?></h2>
									<div class="sale-info">
										<p class="price"><?php echo $this->_var['deal']['current_price']; ?> <small>积分</small></p>
										<?php if ($this->_var['deal']['buy_count'] > 0): ?>
										<p class="sale">已售<?php echo $this->_var['deal']['buy_count']; ?></p>
										<?php endif; ?>
									</div>
								</div>
							</a>
						</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div><!--m-goods-list  -->
	<?php endif; ?>

      
      
  	</div><!--content end  -->
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
