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

<script type="text/javascript" src="__TMPL__Common/js/jquery.bgiframe.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.weebox.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/weebox.css" />
<script type="text/javascript" src="__TMPL__Common/js/carriage_template.js"></script>
<script type="text/javascript" src="<?php echo APP_ROOT; ?>/public/runtime/region.js"></script>
<style type="text/css">

.postage-detail{
	margin: 5px 0;
	padding: 5px;
	border: 1px solid #b2d1ff;
	width: 800px;
}
.postage-detail .entity{

}
.postage-detail .entity .default{
	margin-top: 5px;
	padding: 0 15px 5px;
	line-height: 32px;
	background-color: #f3feed;
}
.postage-detail .entity .default input{
	width: 50px;
	text-align: right;
}
.tbl-except table {
	width: 100%;
	border-width: 1px 0 0 1px;
	border-color: #bbb;
	border-style: solid;
}
.tbl-except th {
	height: 32px;
	font-weight: 400;
	background-color: #f5f5f5;
}
.tbl-except td {
	padding: 3px 5px;
}
.tbl-except td {
	border-width: 0 1px 1px 0;
	border-color: #bbb;
	border-style: solid;
	text-align: center;
}
.postage-detail .entity .tbl-except .input-text{
	width: 50px;
	text-align: right;
}
.tbl-except {
	margin-top: 10px;
}
.tbl-except .edit {
	float: right;
}
.tbl-except .area-group {
	padding-right: 3em;
	display: block;
}
.tbl-except .cell-area {
	text-align: left;
	width: 282px;
	font-size: 12px;
}
.tbl-attach {
	margin-top: 5px;
	line-height: 24px;
}


/*选择城市样式*/
.dialog-areas {
	position: absolute;
	width: 580px;
	border: 1px solid #c4d5df;
	background-color: #fff;
}
.dialog-areas .ks-ext-close {
	position: absolute;
	top: 5px;
	right: 5px;
	font-size: 10px;
}
.dialog-areas .title {
	padding-left: 10px;
	height: 22px;
	line-height: 22px;
	font-weight: 700;
	background-color: #e9f1f4;
	border-width: 1px;
	border-style: solid;
	border-color: #fff #fff #c4d5df;
}
.dialog-areas li {
	overflow: visible;
	border-bottom: 1px solid #c4d5df;
}
.dialog-areas label {
	margin: 0 1px;
	vertical-align: middle;
	display: inline-block;
}
.dcity {
	vertical-align: middle;
	display: block;
	z-index: 1;
}
.gcity, .province-list {
	display: inline-block;
}
.dialog-areas .even {
	background-color: #ecf4ff;
}
.ecity {
	position: relative;
	float: left;
	margin-right: 1px;
	padding-right: 8px;
	height: 38px;
	width: 80px;
}
.province-list {
	width: 450px;
}
.dialog-areas li span.group-label {
	margin-right: 5px;
	padding: 10px 0 5px 10px;
	display: inline-block;
	width: 70px;
	font-weight: 700;
}
.dialog-areas .even span.gareas {
	background-color: #ECF4FF;
	border-color: #ecf4ff;
}
.dialog-areas span.gareas {
	white-space: nowrap;
	margin-right: 3px;
	padding: 7px 4px 1px;
	display: inline-block;
	position: relative;
	height: 17px;
	border: 1px solid #fff;
}
.dialog-areas input, .dialog-areas button {
	margin: 0 1px;
	vertical-align: middle;
}
.check_num {
	color: #F60;
	font-size: 12px;
	letter-spacing: -1px;
}
.trigger {
	width: 8px;
	height: 8px;
	padding: 2px;
	cursor: pointer;
}
.showCityPop {
	z-index: 55556;
}
.dialog-areas .even .showCityPop .gareas {
	background-color: #FFFEC6;
	border-color: #f7e4a5 #f7e4a5 #FFFEC6;
}
.dialog-areas .showCityPop .gareas {
	background-color: #FFFEC6;
	border: solid 1px #f7e4a5;
	border-bottom: solid 1px #FFFEC6;
	z-index: 56000;
	padding-bottom: 4px;
}
.citys {
	background-color: #FFFEC6;
	position: absolute;
	float: right;
	border: solid 1px #f7e4a5;
	z-index: 20000;
	top: 28px;
	left: 0;
	width: 214px;
	display: none;
	white-space: wrap;
}
.dialog-areas li span.areas {
	margin-right: 3px;
	padding: 7px 0 1px 4px;
	display: inline-block;
}
.citys span {
	line-height: 2;
	margin-right: 2px;
}
.dialog-areas .btns {
	padding: 5px 0 5px 10px;
	margin-left: 430px;
}
.dialog-areas button {
	margin-right: 5px;
	padding: 2px 3px;
}
.input-err{
	border: 1px solid #ff8080;
	background-color: #fff2f2;
}

#postage-tpl span.msg {
	margin-right: 3px;
}
.msg span.error {
	font-size: 12px;
	line-height: 24px;
	padding: 0 5px;
	margin-top: 3px;
	margin-right: 3px;
	display: inline-block;
	border: 1px solid;
	border-color: #ff8080;
	background-color: #fff2f2;
}
</style>
<div class="main">
<div class="main_title"><?php echo L("EDIT");?> <a href="<?php echo u("CarriageTemplate/index");?>" class="back_list"><?php echo L("BACK_LIST");?></a></div>
<div class="blank5"></div>
<form name="edit" action="__APP__" method="post" enctype="multipart/form-data" >
<table class="form" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="item_title">模板名称:</td>
		<td class="item_input"><input type="text" class="textbox require" name="name" value="<?php echo ($data["name"]); ?>"/></td>
	</tr>
	<tr>
		<td class="item_title">商品地址:</td>
		<td class="item_input">
			<select name="region_lv1" class="ui-select region_select" height="300" style="display: none;">
				<option selected="selected" value="1">中国</option>
			</select>

			<select name="region_lv2" class="ui-select region_select" height="300">
				<option value="0">请选择省</option>
				<?php if(is_array($region_lv2)): foreach($region_lv2 as $key=>$lv2): ?><option <?php if($lv2['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo ($lv2["id"]); ?>"><?php echo ($lv2["name"]); ?></option><?php endforeach; endif; ?>
			</select>

			<select name="region_lv3" class="ui-select region_select" height="300">
				<option value="0">请选择城市</option>
				<?php if(is_array($region_lv3)): foreach($region_lv3 as $key=>$lv3): ?><option <?php if($lv3['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo ($lv3["id"]); ?>"><?php echo ($lv3["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			<?php if($region_lv4): ?><select name="region_lv4" class="ui-select region_select" height="300">
					<option value="0">请选择区县</option>
					<?php if(is_array($region_lv4)): foreach($region_lv4 as $key=>$lv4): ?><option <?php if($lv4['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo ($lv4["id"]); ?>"><?php echo ($lv4["name"]); ?></option><?php endforeach; endif; ?>
				</select><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class="item_title">是否包邮:</td>
		<td class="item_input">
			<label><input type="radio"  name="carriage_type" <?php if($data['carriage_type'] == 1): ?>checked="checked"<?php endif; ?> value="1"/>自定义运费</label>&nbsp;<label><input type="radio" name="carriage_type" value="2" <?php if($data['carriage_type'] == 2): ?>checked="checked"<?php endif; ?>/>卖家承担运费</label>
		</td>
	</tr>
	<tr class="carriage_type_1">
		<td class="item_title">计价方式:</td>
		<td class="item_input">
			<label><input type="radio"  name="valuation_type" <?php if($data['valuation_type'] == 1): ?>checked="checked"<?php endif; ?> value="1"/>按件数</label>&nbsp;<label><input type="radio" name="valuation_type" value="2" <?php if($data['valuation_type'] == 2): ?>checked="checked"<?php endif; ?>/>按重量</label>
		</td>
	</tr>
	<tr class="carriage_type_1 postage-detail-box" style="display: none;">
		<td class="item_title">
		运费详情:
		</td>
		<td class="item_input">
			<div class="postage-detail" >

			</div>
		</td>
	</tr>
	<tr>
		<td class="item_title"></td>
		<td class="item_input">
			<!--隐藏元素-->
			<intpu type="hidden" name="supplier_id" value="<?php echo ($vo["supplier_id"]); ?>"/>
			<input type="hidden" name="tbl_except_group" value=""/>
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"/>
			<input type="hidden" name="<?php echo conf("VAR_MODULE");?>" value="CarriageTemplate" />
			<input type="hidden" name="<?php echo conf("VAR_ACTION");?>" value="update" />
			<!--隐藏元素-->
			<input class="button submit_btn" type="button" value="<?php echo L("EDIT");?>" />
			<input type="reset" class="button" value="<?php echo L("RESET");?>" />
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>
</table>	 
</form>
</div>
<div class="valuation_type_1" style="display: none;">
	<div class="entity">
		<div class="default">
			默认运费：<input type="text" name="express_start" data-field="start" value="<?php echo intval($default_carriage['express_start']); ?>" class="textbox" maxlength="6"  onkeypress="return myNumberic(event,0)"  aria-label="默认运费件数"> <span class="unit">件</span>内，
			<input type="text"  name="express_postage" data-field="postage" value="<?php echo ($default_carriage["express_postage"]); ?>"  class="textbox" maxlength="6"   onkeypress="return myNumberic(event)"  aria-label="默认运费价格"> 元，
			每增加 <input type="text" name="express_plus" data-field="plus" value="<?php echo intval($default_carriage['express_plus']); ?>"  class="textbox"  maxlength="6"  onkeypress="return myNumberic(event,0)"   aria-label="每加件"> 件，
			增加运费 <input type="text" name="express_postage_plus" data-field="postage_plus" value="<?php echo ($default_carriage["express_postage_plus"]); ?>"  class="textbox" maxlength="6" onkeypress="return myNumberic(event)"  aria-label="加件运费"> 元
			<div class="J_DefaultMessage"></div>
		</div>
		<div class="tbl-except" style=" <?php if($carriage_list): ?><?php else: ?>display: none;<?php endif; ?> ">
			<table border="0" cellpadding="0" cellspacing="0">
				<colgroup>
					<col class="col-area">
					<col class="col-start">
					<col class="col-postage">
					<col class="col-plus">
					<col class="col-postageplus">
					<col class="col-action">
				</colgroup>
				<thead>
				<tr>
					<th>运送到</th>
					<th>首件(件)</th>
					<th>首费(元)</th>
					<th>续件(件)</th>
					<th>续费(元)</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php $i=1; ?>
				<?php if(is_array($carriage_list)): foreach($carriage_list as $key=>$carriage_item): ?><tr data-group="n<?php echo $i;?>">
						<td class="cell-area">
							<a href="#" class="acc_popup edit J_EditArea" title="编辑运送区域" >编辑</a>
							<div class="area-group">
								<p><?php echo ($carriage_item["show_city_name"]); ?></p>
							</div>
							<input type="hidden" data-field="express_areas" name="express_areas_n<?php echo $i;?>" value="<?php echo ($carriage_item["region_ids"]); ?>"/>
						</td>
						<td><input type="text" name="express_start_n<?php echo $i;?>" data-field="start" value="<?php echo intval($carriage_item['express_start']); ?>" class="input-text " maxlength="6"  onkeypress="return myNumberic(event,0)" ></td>
						<td><input type="text" name="express_postage_n<?php echo $i;?>" data-field="postage" value="<?php echo ($carriage_item["express_postage"]); ?>" class="input-text " maxlength="6" onkeypress="return myNumberic(event)" ></td>
						<td><input type="text" name="express_plus_n<?php echo $i;?>" data-field="plus" value="<?php echo intval($carriage_item['express_plus']); ?>" class="input-text " maxlength="6"  onkeypress="return myNumberic(event,0)" ></td>
						<td><input type="text" name="express_postage_plus_n<?php echo $i;?>" data-field="postage_plus" value="<?php echo ($carriage_item["express_postage_plus"]); ?>" class="input-text " maxlength="6" onkeypress="return myNumberic(event)" ></td>
						<td><a href="#" class="J_DeleteRule">删除</a></td>
					</tr>
					<?php $i++; ?><?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
		<div class="tbl-attach">
			<div class="J_SpecialMessage"></div>
			<a href="#" class=" J_AddRule">为指定地区城市设置运费</a>
		</div>
	</div>
</div>
<div class="valuation_type_2" style="display: none;">
	<div class="entity">
		<div class="default">
			默认运费：<input type="text" name="express_start" data-field="start" value="<?php echo number_format($default_carriage['express_start'],1); ?>" class="textbox"  maxlength="6" onkeypress="return myNumberic(event,1)" aria-label="默认运费重数"> kg内，
			<input type="text"  name="express_postage" data-field="postage" value="<?php echo ($default_carriage["express_postage"]); ?>"  class="textbox" maxlength="6"  onkeypress="return myNumberic(event)" aria-label="默认运费价格"> 元，
			每增加 <input type="text" name="express_plus" data-field="plus" value="<?php echo number_format($default_carriage['express_plus'],1); ?>"  class="textbox" maxlength="6"  onkeypress="return myNumberic(event,1)" aria-label="每加重"> kg，
			增加运费 <input type="text" name="express_postage_plus" data-field="postage_plus" value="<?php echo ($default_carriage["express_postage_plus"]); ?>"  class="textbox" maxlength="6"  onkeypress="return myNumberic(event)" aria-label="加重运费"> 元
			<div class="J_DefaultMessage"></div>
		</div>
		<div class="tbl-except" <?php if($carriage_list): ?><?php else: ?>style="display: none;"<?php endif; ?>  >
			<table border="0" cellpadding="0" cellspacing="0">
				<colgroup>
					<col class="col-area">
					<col class="col-start">
					<col class="col-postage">
					<col class="col-plus">
					<col class="col-postageplus">
					<col class="col-action">
				</colgroup>
				<thead>
				<tr>
					<th>运送到</th>
					<th>首重(kg)</th>
					<th>首费(元)</th>
					<th>续重(kg)</th>
					<th>续费(元)</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php $i=1; ?>
				<?php if(is_array($carriage_list)): foreach($carriage_list as $key=>$carriage_item): ?><tr data-group="n<?php echo $i;?>">
					<td class="cell-area">
						<a href="#" class="acc_popup edit J_EditArea" title="编辑运送区域" >编辑</a>
						<div class="area-group">
							<p><?php echo ($carriage_item["show_city_name"]); ?></p>
							</div>
						<input type="hidden" data-field="express_areas" name="express_areas_n<?php echo $i;?>" value="<?php echo ($carriage_item["region_ids"]); ?>"/>
						</td>
					<td><input type="text" name="express_start_n<?php echo $i;?>" data-field="start" value="<?php echo number_format($carriage_item['express_start'],1); ?>" class="input-text "  maxlength="6" onkeypress="return myNumberic(event,1)" ></td>
					<td><input type="text" name="express_postage_n<?php echo $i;?>" data-field="postage" value="<?php echo ($carriage_item["express_postage"]); ?>" class="input-text " maxlength="6"  onkeypress="return myNumberic(event)" ></td>
					<td><input type="text" name="express_plus_n<?php echo $i;?>" data-field="plus" value="<?php echo number_format($carriage_item['express_plus'],1); ?>" class="input-text " maxlength="6"  onkeypress="return myNumberic(event,1)" ></td>
					<td><input type="text" name="express_postage_plus_n<?php echo $i;?>" data-field="postage_plus" value="<?php echo ($carriage_item["express_postage_plus"]); ?>" class="input-text "  maxlength="6" onkeypress="return myNumberic(event)" ></td>
					<td><a href="#" class="J_DeleteRule">删除</a></td>
					</tr>
					<?php $i++; ?><?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
		<div class="tbl-attach">
			<div class="J_SpecialMessage"></div>
			<a href="#" class="J_AddRule">为指定地区城市设置运费</a>
		</div>
	</div>
</div>
<div class="ks-dialog dialog-areas" style="display: none;">
	<a tabindex="0" href='javascript:void("关闭")' role="button" style="z-index:9" class="ks-ext-close"><span class="ks-ext-close-x">关闭</span></a>
	<div class="ks-contentbox">
		<div class="ks-stdmod-header" id="ks-dialog-header7242"><div class="title">选择区域</div></div>

			<form method="post">
				<ul id="citylist">
					<?php $i=1; ?>
					<?php if(is_array($delivery_regions)): foreach($delivery_regions as $key=>$regions): ?><?php $i++; ?>
						<li <?php if($i%2!=0){echo 'class="even"';} ?>>
						<div class="dcity">
							<div class="ecity gcity">
								<span class="group-label"><input type="checkbox" class="J_Group" id="group_<?php echo ($key); ?>"><label for="group_<?php echo ($key); ?>"><?php echo ($regions["name"]); ?></label></span>
							</div>
							<div class="province-list">
								<?php if(is_array($regions["province_arr"])): foreach($regions["province_arr"] as $key=>$province): ?><div class="ecity">
										<span class="gareas"><input type="checkbox" value="<?php echo ($province["id"]); ?>" id="province_<?php echo ($province["id"]); ?>" class="J_Province" ><label for="province_<?php echo ($province["id"]); ?>"><?php echo ($province["name"]); ?></label><span class="check_num" style="display: none;"></span><img class="trigger" src="__TMPL__Common/images/jiantou.gif"></span>
										<div class="citys">
											<?php if(is_array($province["city_list"])): foreach($province["city_list"] as $key=>$city): ?><span class="areas"><input type="checkbox" value="<?php echo ($city["id"]); ?>" id="city_<?php echo ($city["id"]); ?>" class="J_City"><label for="city_<?php echo ($city["id"]); ?>"><?php echo ($city["name"]); ?></label></span><?php endforeach; endif; ?>
											<p style="text-align:right;"><input type="button" value="关闭" class="close_button"></p>
										</div>
									</div><?php endforeach; endif; ?>
							</div>
						</div>
						</li><?php endforeach; endif; ?>

				</ul>
				<div class="btns">
					<input type="hidden" name="edit_citys_index" value="0">
					<button type="submit" class="J_Submit">确定</button><button type="button" class="J_Cancel">取消</button>
				</div>
			</form>

	</div>
</div>

</body>
</html>