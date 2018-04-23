<?php if (!defined('THINK_PATH')) exit();?><select name="brand_id">
	<option value="0">请选择品牌</option>
	<?php if(is_array($brand_list)): foreach($brand_list as $key=>$brand_item): ?><option value="<?php echo ($brand_item["id"]); ?>"><?php echo ($brand_item["name"]); ?></option><?php endforeach; endif; ?>
</select>