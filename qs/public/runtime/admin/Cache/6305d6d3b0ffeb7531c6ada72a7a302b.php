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

<script type="text/javascript" src="__TMPL__Common/js/calendar/calendar.php?lang=zh-cn" ></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/js/calendar/calendar.css" />
<script type="text/javascript" src="__TMPL__Common/js/calendar/calendar.js"></script>
<script type="text/javascript">
	$(document).ready(function(){	
		var data_url = "<?php echo urlencode(u("Ofc/order_referer",array("begin_time"=>$_REQUEST['begin_time'],"end_time"=>$_REQUEST['end_time'],"r"=>time())));?>";	
		load_ofc("data_chart",data_url,"100%",350);
	});
</script>
<?php function show_referer($referer)
	{
		$referer_show = $referer==""?"直接访问":$referer;
		$referer = $referer==""?"-1":$referer;
		return "<a href='".u("DealOrder/deal_index",array("referer"=>$referer))."'>".$referer_show."</a>";
	} ?>
<div class="main">
<div class="main_title"><?php echo L("ORDER_REFERER");?></div>
<div class="blank5"></div>
<div class="search_row">
	<form name="search" action="__APP__" method="get">	
		<?php echo L("SEARCH_REFERER_TIME");?>：
		<input type="text" class="textbox" name="begin_time" id="begin_time" value="<?php echo strim($_REQUEST['begin_time']);?>" onfocus="return showCalendar('begin_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_begin_time');" />
		<input type="button" class="button" id="btn_begin_time" value="<?php echo L("SELECT_TIME");?>" onclick="return showCalendar('begin_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_begin_time');" />	
		-
		<input type="text" class="textbox" name="end_time" id="end_time" value="<?php echo strim($_REQUEST['end_time']);?>" onfocus="return showCalendar('end_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_end_time');" />
		<input type="button" class="button" id="btn_end_time" value="<?php echo L("SELECT_TIME");?>" onclick="return showCalendar('end_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_end_time');" />	
		
		<input type="hidden" value="DealOrder" name="m" />
		<input type="hidden" value="referer" name="a" />
		<input type="submit" class="button" value="<?php echo L("SEARCH");?>" />
	</form>
</div>
<div class="blank5"></div>
<table width="100%">
	<tr>
		
		<td valign="top" >
			<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="dataTable" cellpadding=0 cellspacing=0 ><tr><td colspan="3" class="topTd" >&nbsp; </td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th><a href="javascript:sortBy('referer','<?php echo ($sort); ?>','DealOrder','referer')" title="按照<?php echo L("ORDER_REFERER");?><?php echo ($sortType); ?> "><?php echo L("ORDER_REFERER");?><?php if(($order)  ==  "referer"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('ct','<?php echo ($sort); ?>','DealOrder','referer')" title="按照<?php echo L("REFERER_COUNT");?><?php echo ($sortType); ?> "><?php echo L("REFERER_COUNT");?><?php if(($order)  ==  "ct"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$referer): ++$i;$mod = ($i % 2 )?><tr class="row" ><td><input type="checkbox" name="key" class="key" value="<?php echo ($referer["id"]); ?>"></td><td>&nbsp;<?php echo (show_referer($referer["referer"])); ?></td><td>&nbsp;<?php echo ($referer["ct"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td colspan="3" class="bottomTd"> &nbsp;</td></tr></table>
<!-- Think 系统列表组件结束 -->

				
			<div class="blank5"></div>
			<div class="page"><?php echo ($page); ?></div>
		</td>
		<td width=450 valign="top" style="padding-left:10px;">
			<table cellspacing="0" cellpadding="0" class="dataTable">
				<tr><td class="topTd">&nbsp; </td></tr>
				<tr class="row">
					<th>图表分析</th>
				</tr>
				<tr class="row">
					<td><div id="data_chart"></div></td>
				</tr>
				<tr><td class="bottomTd"> &nbsp;</td></tr>
			</table>
			
		</td>
	</tr>
</table>


</div>
</body>
</html>