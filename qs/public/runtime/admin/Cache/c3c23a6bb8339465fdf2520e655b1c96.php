<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/style.css" />
<style type="text/css">
	
/**
 * 自定义的图标icon
 */
@font-face {font-family: "iconcode";
  src: url('<?php echo APP_ROOT; ?>/public/verificationcode/iconfont.eot?r=<?php echo time(); ?>'); /* IE9*/
  src: url('<?php echo APP_ROOT; ?>/public/verificationcode/iconfont.eot?#iefix&r=<?php echo time(); ?>') format('embedded-opentype'), /* IE6-IE8 */
  url('<?php echo APP_ROOT; ?>/public/verificationcode/iconfont.woff?r=<?php echo time(); ?>') format('woff'), /* chrome、firefox */
  url('<?php echo APP_ROOT; ?>/public/verificationcode/iconfont.ttf?r=<?php echo time(); ?>') format('truetype'), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
  url('<?php echo APP_ROOT; ?>/public/verificationcode/iconfont.svg#iconfont&r=<?php echo time(); ?>') format('svg'); /* iOS 4.1- */}
.iconcode {
  font-family:"iconcode" !important;
  font-size:20px;
  font-style:normal;
  -webkit-font-smoothing: antialiased;
  -webkit-text-stroke-width: 0.2px;
  -moz-osx-font-smoothing: grayscale;
}


/**
 * 自定义的font-face
 */
@font-face {font-family: "diyfont";
  src: url('<?php echo APP_ROOT; ?>/public/iconfont/iconfont.eot?r=<?php echo time(); ?>'); /* IE9*/
  src: url('<?php echo APP_ROOT; ?>/public/iconfont/iconfont.eot?#iefix&r=<?php echo time(); ?>') format('embedded-opentype'), /* IE6-IE8 */
  url('<?php echo APP_ROOT; ?>/public/iconfont/iconfont.woff?r=<?php echo time(); ?>') format('woff'), /* chrome、firefox */
  url('<?php echo APP_ROOT; ?>/public/iconfont/iconfont.ttf?r=<?php echo time(); ?>') format('truetype'), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
  url('<?php echo APP_ROOT; ?>/public/iconfont/iconfont.svg#iconfont&r=<?php echo time(); ?>') format('svg'); /* iOS 4.1- */}
.diyfont {
  font-family:"diyfont" !important;
  font-size:20px;
  font-style:normal;
  -webkit-font-smoothing: antialiased;
  -webkit-text-stroke-width: 0.2px;
  -moz-osx-font-smoothing: grayscale;
}

</style>
<script type="text/javascript">
 	var VAR_MODULE = "<?php echo conf("VAR_MODULE");?>";
	var VAR_ACTION = "<?php echo conf("VAR_ACTION");?>";
	var MODULE_NAME	=	'<?php echo MODULE_NAME; ?>';
	var ACTION_NAME	=	'<?php echo ACTION_NAME; ?>';
	var ROOT = '__APP__';
	var ROOT_PATH = '<?php echo APP_ROOT; ?>';
	var CURRENT_URL = '<?php echo btrim($_SERVER['REQUEST_URI']);?>';
	var INPUT_KEY_PLEASE = "<?php echo L("INPUT_KEY_PLEASE");?>";
	var TMPL = '__TMPL__';
	var APP_ROOT = '<?php echo APP_ROOT; ?>';
	
	//关于图片上传的定义
	var UPLOAD_SWF = '__TMPL__Common/js/Moxie.swf';
	var UPLOAD_XAP = '__TMPL__Common/js/Moxie.xap';
	var MAX_IMAGE_SIZE = '1000000';
	var ALLOW_IMAGE_EXT = 'zip';
	var UPLOAD_URL = '<?php echo u("File/do_upload_icon");?>';
	var ICON_FETCH_URL = '<?php echo u("File/fetch_icon");?>';
	var ofc_swf = '__TMPL__Common/js/open-flash-chart.swf';

    var img_index =parseInt('<?php if(isset($img_index)){echo $img_index;}else{echo 0;}; ?>');
    var max_img_size =parseInt('<?php if(isset($max_img_size)){echo $max_img_size;}else{echo 8;}; ?>');

</script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.timer.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/plupload.full.min.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/ui_upload.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.bgiframe.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.weebox.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/weebox.css" />
<script type="text/javascript" src="__TMPL__Common/js/swfobject.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/script.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/lrz.all.bundle.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/imgupload.js"></script>
<script type="text/javascript" src="__ROOT__/public/runtime/admin/lang.js"></script>
<script type='text/javascript'  src='__ROOT__/admin/public/kindeditor/kindeditor.js'></script>
</head>
<body>
<div id="info"></div>

<script type="text/javascript">
	var nav_cfg = <?php echo (json_encode($nav_cfg)); ?>;
	var data_json = <?php echo (json_encode($data)); ?>;
	var ctl_value = '<?php echo ($ctl_value); ?>';

	var mobile_type = <?php echo ($mobile_type); ?>;
	$(document).ready(function(){
		init_nav_type($("#typeSelect").val());
		$("#typeSelect").bind("change",function(){
			init_nav_type($(this).val());
		});
		
		$("#cancel").bind("click",function(){
			close_weebox();
		});
		
		$("#confirm").bind("click",function(){
			/*
			var query = $(form).serialize();
			var action = $(this).attr("action");
			ajax_do_submit(action,query);
			*/
			if(!$("#img_del_img").is(':visible')){
				alert('请上传广告图片');
				return false;
			}
			var img_url=$("#img_img").attr('src');
			var img_obj=$("input[name='zt_position']").val();
			var type=$("#typeSelect").val();
			var ctl_value=$("#type .item_input input").val();
			$('.'+img_obj,window.parent.document).attr('src',img_url);
			$('.'+img_obj,window.parent.document).siblings("input[name='type']").val(type);
			$('.'+img_obj,window.parent.document).siblings("input[name='ctl_value']").val(ctl_value);
			
			for(nav_key in nav_cfg)
			{
				nav_cfg_item = nav_cfg[nav_key];
				if(nav_cfg_item['mobile_type']==mobile_type)
				{
					navs = nav_cfg_item['nav'];
					break;
				}
			}



			for(nav_key in navs)
			{
				nav_item = navs[nav_key];
				if(type==nav_item['type'])
				{
					var ctl_name=nav_item['field'];
					break;
				}
			}
			$('.'+img_obj,window.parent.document).siblings("input[name='ctl_name']").val(ctl_name);


			var len=$("input[name='id']",window.parent.document).length;
			if(len > 0){
				zt_id=$("input[name='id']",window.parent.document).val();
			}else{
				zt_id=$("input[name='rid']",window.parent.document).val();
			}

			//rid
			var mobile_type2 = $("#mobileTypeSelect",window.parent.document);
			var query=$("form[name='edit']").serialize();
			//console.log(ROOT+'?'+query);
			$.ajax({ 
				url: ROOT+'?'+query+'&zt_id='+zt_id+'&mobile_type2='+mobile_type+'&img='+img_url,
				type: "POST",
				dataType:"json",
				success: function(obj){

					if(obj.status==1){
						
						close_weebox();	
					}else{
						alert(obj.info);
					}
							
				}
			});
			

			
			//alert(img_url);
			
		});

	});
	function init_nav_type(type)
	{
		$("#type").hide();

		var navs = null;
		for(nav_key in nav_cfg)
		{
			nav_cfg_item = nav_cfg[nav_key];
			if(nav_cfg_item['mobile_type']==mobile_type)
			{
				navs = nav_cfg_item['nav'];
				break;
			}
		}

		var val = type;

		for(nav_key in navs)
		{
			nav_item = navs[nav_key];
			if(val==nav_item['type'])
			{

				if(nav_item['field']!="")
				{
					$("#type").show();
					$("#type").find(".item_title").html(nav_item['fname']);
					$("#type").find(".item_input input").attr("name",nav_item['field']);


					var data_val = "";
					try{
						data_val = data_json[nav_item['field']];
					}catch(ex)
					{

					}

					if(data_val)
					{
						$("#type").find(".item_input input").val(data_val);
					}
					else
					{
						$("#type").find(".item_input input").val("");
					}
				}
				break;
			}
		}
	}
	
	function close_weebox(){
		$(".dialog-mask",window.parent.document).remove();
		$("#open_zt_box",window.parent.document).remove();
	}


</script>
<form name="edit" action="__APP__" method="post" enctype="multipart/form-data">
<table class="form" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
	<td class="item_title"><?php echo L("ADV_IMAGE");?>:</td>
	<td class="item_input">
		<div style='width:120px; height:40px; margin-left:10px; display:inline-block;  float:left;' class='none_border'><script type='text/javascript'>var eid = 'img';KE.show({id : eid,items : ['upload_image'],skinType: 'tinymce',allowFileManager : true,resizeMode : 0});</script><div style='font-size:0px;'><textarea id='img' name='img' style='width:120px; height:25px;' ><?php echo ($zt_img_pic); ?></textarea> </div></div><input type='text' id='focus_img' style='font-size:0px; border:0px; padding:0px; margin:0px; line-height:0px; width:0px; height:0px;' /></div><img src='<?php if($zt_img_pic == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($zt_img_pic); ?><?php endif; ?>' <?php if($zt_img_pic != ''): ?>onclick='openimg("img")'<?php endif; ?> style='display:inline-block; float:left; cursor:pointer; margin-left:10px; border:#ccc solid 1px; width:35px; height:35px;' id='img_img' /><img src='/qs/admin/Tpl/default/Common/images/del.gif' style='<?php if($zt_img_pic == ''): ?>display:none;<?php else: ?>display:inline-block;<?php endif; ?> margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' id='img_del_img' onclick='delimg("img")' title='删除' />

	</td>
</tr>

	<tr>
		<td class="item_title"><?php echo L("ADV_TYPE");?>:</td>
		<td class="item_input">
			<select name="type" id='typeSelect'>
				<?php if(is_array($nav_list)): foreach($nav_list as $key=>$nav): ?><option value="<?php echo ($nav["type"]); ?>" <?php if($type == $nav['type']): ?>selected="selected"<?php endif; ?>><?php echo ($nav["name"]); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
	</tr>

	<tr id="type" style="display:none;">
		<td class="item_title"></td>
		<td class="item_input">
			<input type="text" class="textbox " name=""  />
		</td>
	</tr>
</table>

	<input type="hidden" name="zt_moban" value="<?php echo ($zt_moban); ?>" />
	<input type="hidden" name="zt_position" value="<?php echo ($zt_img); ?>" />
	<input type="hidden" name="<?php echo conf("VAR_MODULE");?>" value="MZt" />
	<input type="hidden" name="<?php echo conf("VAR_ACTION");?>" value="zt_img_upload" />
	<!--隐藏元素-->

			
</form>	
<div style="clear:both"></div>
<div class="dialog-button" style="text-align:center; margin-top: 5px;">	
<button id="confirm" class="ui-button dialog-ok" rel="dialog-ok" value="确定">确定</button>	
<button id="cancel" class="ui-button dialog-cancel" rel="dialog-cancel" value="取消">关闭</button>
</div>
<div style="text-align:center;">
	<img style="margin: 10px auto 0;max-width: 99%;border: solid 2px #ccc;height: 320px;" src="<?php echo ($zt_moban_demo); ?>" />
</div>

</body>
</html>