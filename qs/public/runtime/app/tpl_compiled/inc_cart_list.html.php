<?php if ($this->_var['cart_list']): ?>
<script type="text/javascript">
	var jsondata = <?php echo $this->_var['jsondata']; ?>;
</script>
<form name="cart_form" action="<?php
echo parse_url_tag("u:index|ajax#check_cart|"."".""); 
?>">
	<!-- 头部 -->
	<ul class="cart-list-hd">
		<li class="check-box-wrap"><label is_all="1" class="ui-checkbox" rel="common_cbo"><input type="checkbox" name="cbo1" value="1" <?php if ($this->_var['is_all_effect']): ?>checked="checked"<?php endif; ?> /></label></li>
		<li class="check-goods-img">全选</li>
		<li class="check-goods-info">商品信息</li>
		<li class="check-price">单价</li>
		<li class="check-num">数量</li>
		<li class="check-count">总计</li>
		<li class="check-edit">操作</li>
	</ul>
	<!-- 商家列表 -->
	<?php $_from = $this->_var['cart_list_new']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_list_supplier');if (count($_from)):
    foreach ($_from AS $this->_var['cart_list_supplier']):
?>
	<div class="shop-list">
		<ul class="shop-list-hd">
			<li class="check-box-wrap"><label is_item="1" is_main="1" shop_id="<?php echo $this->_var['cart_list_supplier']['supplier_id']; ?>"  class="ui-checkbox" rel="common_cbo"><input type="checkbox" name="cbo1[]" value="0" <?php if ($this->_var['cart_list_supplier']['supplier_is_effect']): ?>checked="checked"<?php endif; ?> /></label></li>
			<li class="shop-name"><?php if ($this->_var['cart_list_supplier']['supplier_id'] != 0): ?>店铺：<?php endif; ?><?php echo $this->_var['cart_list_supplier']['supplier_name']; ?></li>
		</ul>
		<!-- 商品列表 -->
		<div class="goods-list">
			<?php $_from = $this->_var['cart_list_supplier']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_item');if (count($_from)):
    foreach ($_from AS $this->_var['cart_item']):
?>
			<ul class="goods-item" rel="<?php echo $this->_var['cart_item']['id']; ?>">
				<li class="check-box-wrap"><label class="ui-checkbox" is_sub="1" is_item="1" rel="common_cbo"><input type="checkbox" shop_id="<?php echo $this->_var['cart_item']['supplier_id']; ?>" name="cbo1[]" value="<?php echo $this->_var['cart_item']['id']; ?>" <?php if ($this->_var['cart_item']['is_effect']): ?>checked="checked"<?php endif; ?> /></label></li>
				<li class="check-goods-img"><a href="<?php echo $this->_var['cart_item']['url']; ?>"><img src="<?php if ($this->_var['cart_item']['icon'] == ''): ?>public/images/no-image.png<?php else: ?><?php echo $this->_var['cart_item']['icon']; ?><?php endif; ?>" alt="商品图片"></a></li>
				<li class="check-goods-info">
					<p class="goods-name"><a href="<?php echo $this->_var['cart_item']['url']; ?>"><?php echo $this->_var['cart_item']['name']; ?></a></p>
					<?php if ($this->_var['cart_item']['attr_str'] != ''): ?><p class="goods-type">规格：<?php echo $this->_var['cart_item']['attr_str']; ?><!--颜色分类：黑色--></p><?php endif; ?>
				</li>
				<li class="check-price">&yen;<?php echo $this->_var['cart_item']['unit_price_format']; ?></li>
				<li class="check-num">
					<input type="hidden" name="id[]" value="<?php echo $this->_var['cart_item']['id']; ?>" />
					<i class="minus" rel="<?php echo $this->_var['cart_item']['id']; ?>">－</i>
					<input type="text" maxlength="4" class="num_ipt ui-textbox" name="number[]" value="<?php echo $this->_var['cart_item']['number']; ?>" rel="<?php echo $this->_var['cart_item']['id']; ?>" />
					<i class="add" rel="<?php echo $this->_var['cart_item']['id']; ?>">＋</i>
				</li>
				<li class="check-count">&yen;<span><?php echo $this->_var['cart_item']['unit_total_price']; ?><span></li>
				<li class="check-edit"><a href="javascript:void(0);" rel="<?php echo $this->_var['cart_item']['id']; ?>">删除</a></li>
			</ul>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</div>
	</div>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	<!-- 底部 -->
	<div class="cart-list-bd">
		<ul class="cart-list-bd">
			<li class="check-box-wrap"><label is_all="1" class="ui-checkbox" rel="common_cbo"><input type="checkbox" name="cbo1[]" value="0" <?php if ($this->_var['is_all_effect']): ?>checked="checked"<?php endif; ?> /></label></li>
			<li class="check-goods-img">全选</li>
			<li class="check-goods-info"><a class="remove-select" href="javascript:void(0);">删除已选中商品</a></li>
			<li class="check-select-num">已选中 <span class="select-num">0</span> 件商品</li>
			<li class="check-all-count">总计（不含运费）：<em class="count">9999.00</em></li>
			<li class="check-bd-sub">
				<a href="javascript:void(0);" class="check-sub">结算</a>
			</li>
		</ul>
	</div>
</form>
<?php else: ?>
<div class="cart_empty">
	<span>
		购物车内暂时没有商品<br />
		马上去 [ <a href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>">首页</a> ] 挑选商品<br />
		或者<?php if (! $this->_var['user_info']): ?> [<a href="<?php
echo parse_url_tag("u:index|user#login|"."".""); 
?>">登录</a>] 后<?php endif; ?>去 [ <a href="<?php
echo parse_url_tag("u:index|uc_collect|"."".""); 
?>">我的收藏夹</a> ] 看看。
	</span>
</div>
<?php endif; ?>