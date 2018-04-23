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
	var zt_id=<?php echo (intval($vo["id"])); ?>;
	var nav_cfg = <?php echo (json_encode($nav_cfg)); ?>;	
	var adv_type = <?php echo (intval($vo["type"])); ?>;
	var data_json = <?php echo (json_encode($vo["data"])); ?>;
</script>
<style>
	#preview{
		border: solid 2px #ccc;
		padding: 0;
		width:600px;
	}
</style>
<script type="text/javascript" src="__TMPL__Common/js/mnav_cfg.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/m_zt.js"></script>
<div class="main">
<div class="main_title"><?php echo L("EDIT");?> <a href="<?php echo u("MZt/index");?>" class="back_list"><?php echo L("BACK_LIST");?></a></div>
<div class="blank5"></div>
<form name="edit" action="__APP__" method="post" enctype="multipart/form-data">
<table class="form" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="item_title"><?php echo L("NAME");?>:</td>
		<td class="item_input">
			<input type="text" class="textbox require" name="name" value="<?php echo ($vo["name"]); ?>"  />
		</td>
	</tr>
	<tr>
		<td class="item_title">专题标题:</td>
		<td class="item_input">
			<input type="text" class="textbox " name="zt_title"  value="<?php echo ($vo["zt_title"]); ?>" />
		</td>
	</tr>
	<tr>
		<td class="item_title">手机类型:</td>
		<td class="item_input">
			<select name=mobile_type id = "mobileTypeSelect">
				<?php if(is_array($nav_cfg)): foreach($nav_cfg as $key=>$cfg): ?><option value="<?php echo ($cfg["mobile_type"]); ?>" <?php if($vo['mobile_type'] == $cfg['mobile_type']): ?>selected="selected"<?php endif; ?>><?php echo ($cfg["name"]); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="item_title">专题模板:</td>
		<td class="item_input">
			<table>
				<tr>
					<td>
						<select name="zt_moban">
						<?php if(is_array($zt_moban)): foreach($zt_moban as $key=>$moban): ?><option value="<?php echo ($moban); ?>" <?php if($vo['zt_moban'] == $moban): ?>selected="selected"<?php endif; ?>><?php echo ($moban); ?></option><?php endforeach; endif; ?>
						</select>
					</td>
					<td id="preview">
						
					</td>
				</tr>
			</table>
			<div style="color: red">
				<p>备注：</p>
				<p>&nbsp;&nbsp;点击图片区域 上传/更换 图片</p>
				<div style="height: 5px;"></div>
				<p>&nbsp;&nbsp;同一页面只能显示一个相同专题位</p>
			</div>
		</td>
	</tr>
	<tr>
		<td class="item_title">所属城市:</td>
		<td class="item_input">
		<select name="city_id">
			<option value="0" <?php if($vo['city_id'] == 0): ?>selected="selected"<?php endif; ?>>全部显示</option>
			<?php if(is_array($city_list)): foreach($city_list as $key=>$city_item): ?><option value="<?php echo ($city_item["id"]); ?>" <?php if($vo['city_id'] == $city_item['id'] and $city_item['pid'] != 0): ?>selected="selected"<?php endif; ?> <?php if($city_item['pid'] == 0): ?>disabled="disabled"<?php endif; ?>><?php echo ($city_item["title_show"]); ?></option><?php endforeach; endif; ?>
		</select>
		</td>
	</tr>

	
	<tr id="page_tr">
		<td class="item_title">显示页面:</td>
		<td class="item_input">
			<label><input type="checkbox" name="page[]" value="1" <?php if($page[1] == 1): ?>checked="checked"<?php endif; ?> /> 首页</label>
			<label><input type="checkbox" name="page[]" value="2" <?php if($page[2] == 2): ?>checked="checked"<?php endif; ?> /> 团购首页</label>
			<label><input type="checkbox" name="page[]" value="3" <?php if($page[3] == 3): ?>checked="checked"<?php endif; ?> /> 商城首页</label>
			<!-- <label><input type="checkbox" name="page[]" value="4" <?php if($page[4] == 4): ?>checked="checked"<?php endif; ?> /> 积分商城首页</label> -->
			<?php if(IS_PRESELL): ?><label><input type="checkbox" name="page[]" value="5" <?php if($page[5] == 5): ?>checked="checked"<?php endif; ?> /> 预售首页</label><?php endif; ?>
			<?php if(IS_VISITING_SERVICE): ?><label><input type="checkbox" name="page[]" value="6"  <?php if($page[6] == 6): ?>checked="checked"<?php endif; ?> /> 上门服务首页</label><?php endif; ?>
		</td>
	</tr>
	
	<tr>
		<td class="item_title"><?php echo L("ADV_TYPE");?>:</td>
		<td class="item_input">
			<select name="type" id='typeSelect'>
				<?php if(is_array($nav_list)): foreach($nav_list as $key=>$nav): ?><option value="<?php echo ($nav["type"]); ?>" <?php if($vo['type'] == $nav['type']): ?>selected="selected"<?php endif; ?>><?php echo ($nav["name"]); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
	</tr>
	
	<tr id="type" style="display:none;">
		<td class="item_title"></td>
		<td class="item_input">
			<input type="text" class="textbox " name=""  />
		</td>
	</tr>
		
	<tr style="display:none;">
		<td class="item_title">是否显示在中间:</td>
		<td class="item_input">
			<select name="is_middle">
				<option value="0" <?php if($vo['is_middle'] == 0): ?>selected="selected"<?php endif; ?>>否</option>
				<option value="1" <?php if($vo['is_middle'] == 1): ?>selected="selected"<?php endif; ?>>是</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="item_title"><?php echo L("SORT");?>:</td>
		<td class="item_input">
			<input type="text" class="textbox " name="sort" value="<?php echo ($vo["sort"]); ?>"  />
		</td>
	</tr>	
	<tr>
		<td class="item_title"></td>
		<td class="item_input">
			<!--隐藏元素-->
			<input type="hidden" value="<?php echo ($vo["id"]); ?>" name="id" />
			<input type="hidden" name="<?php echo conf("VAR_MODULE");?>" value="MZt" />
			<input type="hidden" name="<?php echo conf("VAR_ACTION");?>" value="update" />
			<!--隐藏元素-->
			<input type="submit" class="button" value="<?php echo L("EDIT");?>" />
			<input type="reset" class="button" value="<?php echo L("RESET");?>" />
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>
</table>	 
</form>
</div>
</body>
</html>