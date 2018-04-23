<?php if (!defined('THINK_PATH')) exit();?>

<script type="text/javascript">
	$(document).ready(function(){
		load_attr_stock();
		$(".delete_attr").live('click',function(){
			var len = $(this).parents(".attr_content").find(".attr_item").length;
			if(len <= 1){
				return false;
			}
			$(this).parents(".attr_item").remove();
			load_attr_stock();
		});
		
	});
	function addRow(obj)
	{
		var html = $(obj).parents(".attr_row").find(".attr_item:eq(0)").clone();
		$(html).find("input[type='text']").val('');
		$(html).find(".attr_value").attr('deal_attr_id','');
		$(html).insertAfter($(obj).parents(".attr_row").find(".attr_item").last());
		if($(".deal_attr_stock").eq(0).attr("checked")){
			$(".deal_attr_stock").attr("checked", true);
		}else{
			$(".deal_attr_stock").attr("checked", false);
		}
		load_attr_stock();
	}

</script>
<?php if(is_array($goods_type_attr)): foreach($goods_type_attr as $key=>$attr_item_group): ?><div class="attr_row clearfix">
		<span id="title_<?php echo ($attr_item["id"]); ?>" class="f_l attr_name" data_name='<?php echo ($attr_item_group["0"]["name"]); ?>'><?php echo ($attr_item_group["0"]["name"]); ?> :</span>
		<div class="attr_content">
		
		<?php if(is_array($attr_item_group)): foreach($attr_item_group as $key=>$attr_item): ?><div class="attr_item f_l">
			<div class="f_l">
			<?php if($attr_item['input_type'] == 0): ?><input type="text" class="textbox attr_value" style="width:65px;" deal_attr_id="<?php echo ($attr_item["deal_attr_id"]); ?>" name="deal_attr[<?php echo ($attr_item["id"]); ?>][]" value="<?php echo ($attr_item["attr_name"]); ?>" onchange="load_attr_stock();"  /><?php endif; ?>
			<?php if($attr_item['input_type'] == 1): ?><select class="selectbox attr_value" deal_attr_id="<?php echo ($attr_item["deal_attr_id"]); ?>" name="deal_attr[<?php echo ($attr_item["id"]); ?>][]" onchange="load_attr_stock();">
	
				<?php if(is_array($attr_item["attr_list"])): foreach($attr_item["attr_list"] as $key=>$attr_row): ?><option value="<?php echo ($attr_row); ?>" <?php if($attr_item['attr_name'] == $attr_row): ?>selected="selected"<?php endif; ?>><?php echo ($attr_row); ?></option><?php endforeach; endif; ?>
				</select><?php endif; ?>
			</div>
			<div class="delete_attr f_l"></div>
		</div><?php endforeach; endif; ?>
		
		<a href="javascript:void(0);" onclick="addRow(this);" style="text-decoration:none;">添加+</a> 
		</div>
		
	
	</div><?php endforeach; endif; ?>