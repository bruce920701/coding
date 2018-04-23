<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var brand_list=<?php echo $this->_var['data']['brand_list_json']; ?>;
var brand_url='<?php echo $this->_var['brand_url']; ?>';
var price_url='<?php echo $this->_var['price_url']; ?>';
</script>
<div class="page page-current" id="goods">
 	<?php echo $this->fetch('style5.2/inc/module/search_header.html'); ?>
  	<div class="content infinite-scroll infinite-scroll-bottom" data-distance="10">
   		<!-- 页面主体 -->
   		<div class="m-screen-bar b-line flex-box">
   			<ul class="flex-box flex-1">
   				<li class="screen-item"><a class="screen-all" href="javascript:void(0)"><p><?php echo $this->_var['data']['cate_name']; ?></p><i class="iconfont arrow-down">&#xe608;</i><i class="iconfont arrow-up">&#xe606;</i></a></li>
   				<li class="screen-item"><a class="screen-brand" href="javascript:void(0)"><p>品牌</p><i class="iconfont arrow-down">&#xe608;</i><i class="iconfont arrow-up">&#xe606;</i></a></li>
   				<li class="screen-item j-jg">
	   				<a class="screen-price screen-link j-listchoose" date-href="<?php echo $this->_var['price_url']; ?>" href="javascript:void(0);">
	   					<p>价格</p>
	   					<div class="arrow-btn">
	   						<i class="iconfont arrow-up <?php if ($this->_var['order_type'] == 'price_asc'): ?>active<?php endif; ?>">&#xe606;</i><i class="iconfont arrow-down <?php if ($this->_var['order_type'] == 'price_desc'): ?>active<?php endif; ?>">&#xe608;</i>
	   					</div>
	   				</a>
   				</li>
   				<li class="screen-item j-xl"><a class="screen-sales screen-link j-listchoose <?php if ($this->_var['order_type'] == 'buy_count'): ?>active<?php endif; ?>" date-href="<?php echo $this->_var['sale_url']; ?>" href="javascript:void(0);"><p>销量</p></a></li>
   			</ul>
   			<a href="javascript:void(0)" class="type-switch"><i class="iconfont type-btn j-type-btn" id="type-cube">&#xe61b;</i><i class="iconfont type-btn j-type-btn" id="type-list">&#xe619;</i></a>
   		</div>
   		<div class="m-screen-list">
	   		<div class="mask"></div>
	   		<div class="all-screen" id="all-goods">
	   			<ul class="goods-type r-line">
		   			<?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['goods-type'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods-type']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['goods-type']['iteration']++;
?>
		   			<li class="b-line <?php if ($this->_var['cate']['active']): ?> active<?php endif; ?>" data-id="<?php echo ($this->_foreach['goods-type']['iteration'] - 1); ?>"><?php echo $this->_var['cate']['name']; ?></li>
		   			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	   			</ul>
	   			<div class="type-detail flex-1">
			   	<?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['goods-type'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods-type']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['goods-type']['iteration']++;
?>
			   	    <ul data-id="<?php echo ($this->_foreach['goods-type']['iteration'] - 1); ?>" <?php if ($this->_var['cate']['active']): ?> style="display:block;"<?php endif; ?>>
					<?php $_from = $this->_var['cate']['bcate_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'blist');if (count($_from)):
    foreach ($_from AS $this->_var['blist']):
?>
						<li><a data-no-cache="true" class="j-listchoose <?php if ($this->_var['blist']['active']): ?> active<?php endif; ?>" date-href="<?php echo $this->_var['blist']['url']; ?>" href="javascript:void(0);"><p class="flex-1"><?php echo $this->_var['blist']['name']; ?></p><p class="goods-num"><?php echo $this->_var['blist']['count']; ?></p></a></li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		  	   	    </ul>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	   			</div>
	   		</div>
	   		<div class="brand-screen j-pp">
	   			<ul>
	   			<?php if ($this->_var['data']['brand_list']): ?>
	   			<?php $_from = $this->_var['data']['brand_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['brand']):
?>
					<li data-id="<?php echo $this->_var['brand']['id']; ?>" <?php if ($this->_var['brand'] [ 'active' ] == 1): ?>class="active"<?php endif; ?>><p><?php echo $this->_var['brand']['name']; ?></p><i class="iconfont">&#xe61c;</i></li>
  				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  				<?php else: ?>
  					<li style="text-align:center;width:100%;display:block">暂无品牌</li>
  				<?php endif; ?>
	   			</ul>
	   			<div class="brand-btn flex-box">
	   				<a href="javascript:void(0)" class="flex-1 t-line brand-reset">重置</a>
	   				<a date-href="<?php echo $this->_var['brand_url']; ?>" href="javascript:void(0)" class="flex-1 j-listchoose brand-comfirm">确定</a>
	   			</div>
	   		</div>
   		</div>
      <?php if ($this->_var['data']['item']): ?>
   		<div class="m-goods-list j-ajaxlist">
   			<ul class="type-cube clearfix j-ajaxadd">
   				<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tuanlist');if (count($_from)):
    foreach ($_from AS $this->_var['tuanlist']):
?>
   				<li>
   					<a data-no-cache="true" href="<?php echo $this->_var['tuanlist']['url']; ?>">
   						<div class="goods-img">
							<img alt="" date-load="1" data-src="<?php echo $this->_var['tuanlist']['f_icon_v1']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/>
						</div>
   						<div class="goods-info">
   							<h2 class="goods-name"><?php echo $this->_var['tuanlist']['name']; ?></h2>
   							<div class="sale-info">
   								<p class="price"><?php echo $this->_var['tuanlist']['current_price']; ?>
   									<?php if ($this->_var['tuanlist']['origin_price'] != 0): ?>
   									<del class="p-price"><?php echo $this->_var['tuanlist']['origin_price']; ?>积分</del>
   									<?php endif; ?>
   								</p>
   								
   								<?php if ($this->_var['tuanlist']['buy_count'] != 0): ?>
                  				<p class="sale">已售<?php echo $this->_var['tuanlist']['buy_count']; ?></p>
                  				<?php endif; ?>
   							</div>
   						</div>
   					</a>
   				</li>
   				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   			</ul>
        <div class="pages hide"><?php echo $this->_var['pages']; ?></div>
   		</div>
      <?php else: ?>
      <div class="tipimg no_data">暂无数据</div>
      <?php endif; ?>
  	</div>
  	<script>
  		$(window).ready(function(){
//			console.log(<?php echo $this->_var['tuanlist']['url']; ?>)
  		})
  	</script>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
