<?php if (!defined('THINK_PATH')) exit();?><?php if(!$is_show_attr): ?><div class="syn_box">
	<div class="f_l">
	<span class="syn_title">递增销售价 </span><input class="syn_value pricebox" name="syn_price" type="text" value="" />元，
	<?php if($supplier_id == 0): ?><span class="syn_title">递增成本价 </span><input class="syn_value pricebox" name="syn_add_balance_price" type="text" value="" />元，<?php endif; ?>
	<span class="syn_title">库存</span><input class="syn_value" name="syn_stock_cfg" type="text" value="" />
	</div>
	<div class="syn_price_setting deal_button ">
		<div class="button">批量设置</div>
	</div>
			
</div><?php endif; ?>
<?php echo ($html); ?>