<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
	var CART_URL='<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>';
	var AJAX_URL='<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
	var cart_check_url='<?php
echo parse_url_tag("u:index|cart#check|"."".""); 
?>';
	var order_id=0;
	<?php if ($this->_var['data']['cart_list']): ?>
		var allprice=<?php echo $this->_var['data']['total_data']['total_price']; ?>;
		var promote_cfg=<?php echo $this->_var['promote_cfg']; ?>;
		
	<?php endif; ?>
</script>
<style type="text/css">
	a.totop{
		bottom: 5.2rem;
	}
</style>
<div class="page page-index" id="cart">

	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<?php if ($this->_var['data']['cart_list']): ?>
	<div class="m-countBox t-line">
		<div class="list-block j-select-all">
			<?php if ($this->_var['data']['cart_list']): ?>
			<label class="label-checkbox item-content">
				<input type="checkbox" name="my-radio">
				<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
				<div class="item-inner">全选</div>
			</label>
			<?php endif; ?>
		</div>

		<div class="u-pr">
			<a href="javascript:void(0);" class="z-state j-accounts <?php if (! $this->_var['data']['cart_list']): ?>invalid<?php endif; ?>">结算(<?php echo $this->_var['data']['total_data']['total_num']; ?>)</a>
			<a href="#" class="z-state del-order j-del-order">删除(0)</a>

			<div class="allCount">
				<p class="u-lg-price">合计：<span class="u-money"><?php echo $this->_var['data']['total_data']['total_price_format']; ?></span></p>
				<p class="u-lg-count">不含运费</p>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="content" >

	<!--购物车列表开始-->
			
	<?php if ($this->_var['data']['cart_list']): ?>
	<!-- 
		<div class="u-prompt">
			<span class="iconfont">&#xe609;</span>满减活动和普通商品同时购买，不参与优惠
		</div>
	 -->	
		<!-- 页面主体 -->
	
	<div class="list-block m-cart">
		<?php $_from = $this->_var['data']['cart_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'supplier_list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['supplier_list']):
?>
			<!-- <?php echo $this->_var['supplier_list']['supplier_name']; ?> -->
			<?php if ($this->_var['supplier_list']['id'] == 'disable' && $this->_var['supplier_list']['supplier_name'] == '失效商品'): ?>


			<!--失效商品商品开始-->
			<div class="m-conBox m-invalid">
				<div class="m-title  item-content b-line">
					<div class="item-inner">
						<div class="item-title-row">
							<div class="item-title">失效商品</div>
						</div>
						<div class="item-after u-edit-child j-clear-all">清空</div>
					</div>
				</div>
				<ul class="m-cart-list">
					<?php $_from = $this->_var['supplier_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_item');if (count($_from)):
    foreach ($_from AS $this->_var['cart_item']):
?>
					<li class="item-content b-line" data-id="<?php echo $this->_var['cart_item']['id']; ?>">
						<span class="u-inval">失效</span>
						<label class="label-checkbox ">
							<div class="item-media">
								<i class="icon icon-form-checkbox"></i>
							</div>
						</label>
						<div class="item-inner">
							<div class="item-media shopImg">
								<img src="<?php echo $this->_var['cart_item']['icon']; ?>">
								<!-- <span class="u-cut"></span> -->
							</div>
							<div class="solute shopTi">
								<a data-no-cache="true" href="<?php echo $this->_var['cart_item']['url']; ?>"><?php echo $this->_var['cart_item']['name']; ?></a>
								<p class="z-inval">哎呦，<?php echo $this->_var['cart_item']['check_info']['info']; ?></p>
							</div>
						</div>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
			</div>
			<!--失效商品商品结束-->
			<?php else: ?>

				<div class="m-conBox j-conBox">

				<!--列表头部开始-->
				<div class="m-title  item-content b-line">
					<label class="label-checkbox j-select-title" style="width: 1rem;height: 1rem;">
						<input type="checkbox" name="my-radio" <?php if ($this->_var['supplier_list']['is_effect']): ?>checked="checked"<?php endif; ?>>
						<div class="item-media" style="width: 1rem;height: 1rem;"><i class="icon icon-form-checkbox"></i></div>
					</label>
					<div class="item-inner">
						<div class="item-title-row flex-1">
							<div class="item-title"><i class="iconfont u-shop-icon u-icon">&#xe616;</i><?php echo $this->_var['supplier_list']['supplier_name']; ?><i class="iconfont u-icon">&#xe607;</i></div>
						</div>
						<?php if ($this->_var['supplier_list']['youhui_count'] > 0): ?><div class="j-youhui get-youhui r-line" data-id="<?php echo $this->_var['supplier_list']['id']; ?>">领券</div><?php endif; ?>
						<div class="item-after u-edit-child j-edit-cur">编辑</div>
					</div>
				</div>
				<!--列表头部结束-->
				
				<ul class="m-cart-list j-select-body">
					<?php $_from = $this->_var['supplier_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_item');if (count($_from)):
    foreach ($_from AS $this->_var['cart_item']):
?>
				
					<li class="item-content b-line" data-id="<?php echo $this->_var['cart_item']['id']; ?>" allow_promote="<?php echo $this->_var['cart_item']['allow_promote']; ?>">
						<label class="label-checkbox ">
							<input type="checkbox" name="my-radio" <?php if ($this->_var['cart_item']['is_effect']): ?> checked="checked"<?php endif; ?>>
							<div class="item-media" style="width: 1rem;height: 1rem;">
								<i class="icon icon-form-checkbox"></i>
							</div>
						</label>
						<div class="item-inner">
							<div class="item-media shopImg">
								<img src="<?php echo $this->_var['cart_item']['f_icon']; ?>">
								<?php if ($this->_var['cart_item']['allow_promote']): ?><span class="u-cut"></span><?php endif; ?>
								<?php if ($this->_var['cart_item']['stock'] > - 1): ?><p class="u-surplus">仅剩<?php echo $this->_var['cart_item']['stock']; ?>件</p><?php endif; ?>
							</div>
							<div class="z-opera z-opera-sure">
								<div class="item-subtitle shopTi">
									<a data-no-cache="true" href="<?php echo $this->_var['cart_item']['url']; ?>" deal-name="<?php echo $this->_var['cart_item']['deal_name']; ?>"><?php echo $this->_var['cart_item']['name']; ?></a>
									<?php if ($this->_var['cart_item']['attr_str']): ?><p class="sizes" attr_key="<?php echo $this->_var['cart_item']['attr']; ?>" attr_str="<?php echo $this->_var['cart_item']['attr_str']; ?>">规格: <?php echo $this->_var['cart_item']['attr_str']; ?></p><?php endif; ?>
								</div>
								<div class="shop_price tr">
									<p class="u-sm-price"><span class="u-money " data_value="<?php echo $this->_var['cart_item']['unit_price']; ?>"><?php echo $this->_var['cart_item']['unit_price_format']; ?></span></p>
									<p class="shop-count">x<i class="j-count-num"><?php echo $this->_var['cart_item']['number']; ?></i></p>
								</div>
							</div>
							<div class="z-opera z-opera-edit flex-box">
								<div class="z-edit flex-1">
									<div class="m-num-box flex-box">
										<span class="u-reduce u-btn">-</span><input type="text" class="u-txt flex-1" value="<?php echo $this->_var['cart_item']['number']; ?>" deal-id="<?php echo $this->_var['cart_item']['deal_id']; ?>" max="<?php echo $this->_var['cart_item']['max_bought']; ?>"
										<?php if ($this->_var['cart_item']['user_min_bought']): ?>user_min_bought="<?php echo $this->_var['cart_item']['user_min_bought']; ?>"<?php endif; ?>
										<?php if ($this->_var['cart_item']['user_max_bought']): ?>user_max_bought="<?php echo $this->_var['cart_item']['user_max_bought']; ?>"<?php endif; ?>
										><span class="u-add u-btn">+</span>
									</div>
									<?php if ($this->_var['cart_item']['attr_str']): ?>
									<div class="m-size-box j-open-choose" data-price="9158.00" data-url="<?php echo $this->_var['TMPL']; ?>/style5.2/images/text/shopimg1.jpg">
										<span class="sizes" attr_key="<?php echo $this->_var['cart_item']['attr']; ?>" attr_str="<?php echo $this->_var['cart_item']['attr_str']; ?>">规格: <?php echo $this->_var['cart_item']['attr_str']; ?></span>
										<i class="iconfont">&#xe608;</i>
									</div>
									<?php endif; ?>
								</div>
								<div class="u-delete confirm-ok">删除</div>
							</div>
						</div>
						<input type="hidden" data-price="100.14" data-url="<?php echo $this->_var['TMPL']; ?>/style5.2/images/text/shopimg1.jpg" class="j-money-hid">
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
			</div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</div>
		
	<?php else: ?>
		<div class="cartNone">
			<div class="warmMess">
				<i class="iconfont">&#xe663;</i>购物车还是空的，您可以
				<?php if ($this->_var['page_finsh']): ?>
				<a class="visit" href="javascript:App.app_detail(1,0);">再逛逛</a>
				<?php else: ?>
				<a class="visit" href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>">再逛逛</a>
				<?php endif; ?>
			</div>
			<!--推荐数据列表-->
			<div class="recommend-list"></div>
		</div>	
	<?php endif; ?>



	</div>
<div class="youhui-mask j-close-mask"></div>
<div class="cart-youhui-box">
	<p class="shop-name b-line">志斌鸭店</p>
	<div class="youhui-wrap">
		<div class="youhui-item b-line flex-box">
			<div class="youhui-info flex-1">
				<p class="youhui-price">20积分</p>
				<p class="youhui-tip">订单满188积分使用</p>
				<p class="youhui-time">使用期限：2017.01.07-2017.05.31</p>
			</div>
			<a href="javascript:void(0);" class="youhui-btn">领取</a>
		</div>
		<div class="youhui-item b-line flex-box">
			<div class="youhui-info flex-1">
				<p class="youhui-price">20积分</p>
				<p class="youhui-tip">订单满188积分使用</p>
				<p class="youhui-time">使用期限：2017.01.07-2017.05.31</p>
			</div>
			<a href="javascript:void(0);" class="youhui-btn j-get-youhui">已领取</a>
		</div>
		<div class="youhui-item b-line flex-box">
			<div class="youhui-info flex-1">
				<p class="youhui-price">20积分</p>
				<p class="youhui-tip">订单满188积分使用</p>
				<p class="youhui-time">使用期限：2017.01.07-2017.05.31</p>
			</div>
			<a href="javascript:void(0);" class="youhui-btn">领取</a>
		</div>
		<div class="youhui-item b-line flex-box">
			<div class="youhui-info flex-1">
				<p class="youhui-price">20积分</p>
				<p class="youhui-tip">订单满188积分使用</p>
				<p class="youhui-time">使用期限：2017.01.07-2017.05.31</p>
			</div>
			<a href="javascript:void(0);" class="youhui-btn j-get-youhui">已领取</a>
		</div>
	</div>
</div>
<div class="cart_box"></div>

</div>

<script type="text/javascript">
	$(function () {
		load_cart_recommend_list();
	});

	function load_cart_recommend_list() {
		var query = new Object();
		query.act = "get_recommend_list";
		$.ajax({
			url:AJAX_URL,
			data:query,
			type:"post",
			success:function(data){
				if(data)
					$(".recommend-list").html(data);
			}
			,error:function(){
			}
		});
		return false;
	}
</script>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>

