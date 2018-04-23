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

<?php function get_refuse_status($status)
	{
		if($status)
		return "<span style='color:#f30;'>有</span>";
		else
		return "无";
	}
	function get_handle($id,$order_info)
	{
		 
		$str = "<a href='".u("DealOrder/order_detail",array("id"=>$id, "type"=>$order_info['type']))."'>查看</a>";

		if($order_info['is_delete']==1 || $order_info['order_status']==1)
		{
			$str.="&nbsp;&nbsp;<a href='javascript:del(".$id.");'>删除</a>";
		}
		elseif($order_info['pay_status']==0)
		{
			$str.="&nbsp;&nbsp;<a href='".u("DealOrder/cancel",array("id"=>$id))."'>关闭交易</a>";
		}
		return $str;
	}

	
	function get_order_item($order_sn,$order_info)
	{
		$deal_order_item = unserialize($order_info['deal_order_item']);
		$str = "<span style='font-size:14px; font-family:verdana; font-weight:bold;'>".$order_sn."</span>";
		foreach($deal_order_item as $v)
		{
			$str.="<br />&nbsp;".l('DEAL_ID').":".$v['deal_id']."&nbsp;<span title='".$v['name']."'";
			if(intval($_REQUEST['deal_id'])==$v['deal_id'])
			{
				$str.=" style='color:red;' ";
			}
			$str.=">".msubstr($v['name'],0,5)."</span>&nbsp;".l("NUMBER")." [".$v['number']."]";
		}
		
		return $str;
		
	}
	function get_refund_status($s)
	{
		if($s==1){
			return "<span style='color:red;'>申请退款</span>";
		}else{
			return '-';
		}
			
		 
	} ?>
<script type="text/javascript" src="__TMPL__Common/js/jquery.bgiframe.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.weebox.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/weebox.css" />
<script type="text/javascript" src="__TMPL__Common/js/calendar/calendar.php?lang=zh-cn" ></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/js/calendar/calendar.css" />
<script type="text/javascript" src="__TMPL__Common/js/calendar/calendar.js"></script>
<script type="text/javascript">
	function batch_delivery()
	{
		express_id = $("select[name='express_id']").val();
		if(express_id==0)
		{
			alert(LANG['SELECT_EXPRESS_WARNING']);
			return;
		}
		idBox = $(".key:checked");
		if(idBox.length == 0)
		{
			alert(LANG['SELECT_EMPTY_WARNING']);
			return;
		}
		idArray = new Array();
		$.each( idBox, function(i, n){
			idArray.push($(n).val());
		});
		ids = idArray.join(",");
		
		$.weeboxs.open(ROOT+'?m=DealOrder&a=load_batch_delivery&ids='+ids+"&express_id="+express_id, {contentType:'ajax',showButton:false,title:LANG['BATCH_DELIVERY'],width:600,height:120});
	}
	
	function batch_print()
	{
		express_id = $("select[name='express_id']").val();
		if(express_id==0)
		{
			alert(LANG['SELECT_EXPRESS_WARNING']);
			return;
		}
		idBox = $(".key:checked");
		if(idBox.length == 0)
		{
			alert(LANG['SELECT_EMPTY_WARNING']);
			return;
		}
		idArray = new Array();
		$.each( idBox, function(i, n){
			idArray.push($(n).val());
		});
		ids = idArray.join(",");
		window.open(ROOT+'?m=Express&a=eprint&order_id='+ids+"&express_id="+express_id);
	}
</script>
<div class="main">
<div class="main_title"><?php echo ($title); ?></div>
<div class="blank5"></div>
<form name="search" action="__APP__" method="get">	

<div class="search_row">

		<?php echo L("ORDER_SN");?>：<input type="text" class="textbox" name="order_sn" value="<?php echo strim($_REQUEST['order_sn']);?>" style="width:100px;" />
		会员手机：<input type="text" class="textbox" name="mobile" value="<?php echo strim($_REQUEST['mobile']);?>" style="width:100px;" />
		
		 时间段：<input type="text" style="width:130px;" class="textbox" value="<?php echo strim($_REQUEST['start_time']);?>" name="start_time" id="start_time" onfocus="return showCalendar('start_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_start_time');"/>
        		<input type="button" class="button" id="btn_start_time" value="<?php echo L("SELECT_TIME");?>" onclick="return showCalendar('start_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_start_time');" />
        		-<input type="text" style="width:130px;" class="textbox" value="<?php echo strim($_REQUEST['end_time']);?>" name="end_time" id="end_time" onfocus="return showCalendar('end_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_end_time');"/>
        		<input type="button" class="button" id="btn_end_time" value="<?php echo L("SELECT_TIME");?>" onclick="return showCalendar('end_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_end_time');" />
		 
		
		发货状态: 
		<select name="delivery_status">
				<option value="" <?php if($_REQUEST['delivery_status'] === ''): ?>selected="selected"<?php endif; ?>>所有</option>
				<option value="0" <?php if($_REQUEST['delivery_status'] === '0'): ?>selected="selected"<?php endif; ?>>待发货</option>
				<option value="2" <?php if($_REQUEST['delivery_status'] === '2'): ?>selected="selected"<?php endif; ?>>全部发货</option>
				<option value="1" <?php if($_REQUEST['delivery_status'] === '1'): ?>selected="selected"<?php endif; ?>>部分发货</option>
		</select>
		 
	 
		退款申请: 
		<select name="refund_status">
				<option value="" <?php if($_REQUEST['refund_status'] === ''): ?>selected="selected"<?php endif; ?>><?php echo L("RS_ALL");?></option>
				<option value="-1" <?php if($_REQUEST['refund_status'] === '-1'): ?>selected="selected"<?php endif; ?>>无</option>
				<option value="1" <?php if($_REQUEST['refund_status'] === '1'): ?>selected="selected"<?php endif; ?>>有</option>
		</select>
		 
		 
		 
		订单状态: 
		<select name="order_status">
				<option value="" <?php if($_REQUEST['order_status'] === ''): ?>selected="selected"<?php endif; ?>>全部</option>
				<option value="0" <?php if($_REQUEST['order_status'] === '0'): ?>selected="selected"<?php endif; ?>>待结单</option>
				<option value="1" <?php if($_REQUEST['order_status'] === '1'): ?>selected="selected"<?php endif; ?>>已结单</option>
				
				<option value="2" <?php if($_REQUEST['order_status'] === '2'): ?>selected="selected"<?php endif; ?>>待付款</option>
				<option value="3" <?php if($_REQUEST['order_status'] === '3'): ?>selected="selected"<?php endif; ?>>交易关闭</option>
		</select>
		<input type="submit" class="button" value="<?php echo L("SEARCH");?>" />
		
		<input type="hidden" value="<?php echo ($type); ?>" name="type" />
		<input type="hidden" value="<?php echo ($is_supplier); ?>" name="is_supplier" />
		<input type="hidden" value="DealOrder" name="m" />
		<input type="hidden" value="scoresOrder" name="a" />
		

</div>
<div class="blank5"></div>
<div class="button_row">
	 
	<input type="button" class="button" value="删除订单" onclick="del();" />
	<input type="button" class="button" value="导出excel" onclick="export_csv();" />
	<a href="<?php echo U("DealOrder/deal_trash",array("type"=>$type, "is_supplier"=>$is_supplier)) ?>" class="button">历史订单</a>
	
	 
	
</div>


</form>
<div class="blank5"></div>
<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="dataTable" cellpadding=0 cellspacing=0 ><tr><td colspan="14" class="topTd" >&nbsp; </td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px"><a href="javascript:sortBy('id','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照<?php echo L("ID");?><?php echo ($sortType); ?> "><?php echo L("ID");?><?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('order_sn','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照<?php echo L("ORDER_SN");?><?php echo ($sortType); ?> "><?php echo L("ORDER_SN");?><?php if(($order)  ==  "order_sn"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('deal_id','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照商品ID<?php echo ($sortType); ?> ">商品ID<?php if(($order)  ==  "deal_id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('user_name','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照<?php echo L("USER_NAME");?><?php echo ($sortType); ?> "><?php echo L("USER_NAME");?><?php if(($order)  ==  "user_name"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('mobile','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照手机号<?php echo ($sortType); ?> ">手机号<?php if(($order)  ==  "mobile"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('region_lv2','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照收货所在城市<?php echo ($sortType); ?> ">收货所在城市<?php if(($order)  ==  "region_lv2"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('return_total_score','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照消耗积分<?php echo ($sortType); ?> ">消耗积分<?php if(($order)  ==  "return_total_score"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('total_price','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照订单金额<?php echo ($sortType); ?> ">订单金额<?php if(($order)  ==  "total_price"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('pay_amount','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照应付金额    <?php echo ($sortType); ?> ">应付金额    <?php if(($order)  ==  "pay_amount"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('create_time','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照<?php echo L("ORDER_CREATE_TIME");?>      <?php echo ($sortType); ?> "><?php echo L("ORDER_CREATE_TIME");?>      <?php if(($order)  ==  "create_time"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('delivery_status','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照发货状态    <?php echo ($sortType); ?> ">发货状态    <?php if(($order)  ==  "delivery_status"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('order_status','<?php echo ($sort); ?>','DealOrder','scoresOrder')" title="按照订单状态<?php echo ($sortType); ?> ">订单状态<?php if(($order)  ==  "order_status"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deal_order): ++$i;$mod = ($i % 2 )?><tr class="row" ><td><input type="checkbox" name="key" class="key" value="<?php echo ($deal_order["id"]); ?>"></td><td>&nbsp;<?php echo ($deal_order["id"]); ?></td><td>&nbsp;<?php echo ($deal_order["order_sn"]); ?></td><td>&nbsp;<?php echo ($deal_order["deal_id"]); ?></td><td>&nbsp;<?php echo ($deal_order["user_name"]); ?></td><td>&nbsp;<?php echo ($deal_order["mobile"]); ?></td><td>&nbsp;<?php echo (get_city($deal_order["region_lv2"],$deal_order)); ?></td><td>&nbsp;<?php echo ($deal_order["return_total_score"]); ?></td><td>&nbsp;<?php echo (format_price($deal_order["total_price"])); ?></td><td>&nbsp;<?php echo (get_pay_amount($deal_order["pay_amount"],$deal_order)); ?></td><td>&nbsp;<?php echo (to_date($deal_order["create_time"])); ?></td><td>&nbsp;<?php echo (get_delivery_status($deal_order["delivery_status"],$deal_order)); ?></td><td>&nbsp;<?php echo (get_order_status($deal_order["order_status"],$deal_order)); ?></td><td> <?php echo (get_handle($deal_order["id"],$deal_order)); ?>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td colspan="14" class="bottomTd"> &nbsp;</td></tr></table>
<!-- Think 系统列表组件结束 -->
 

<div class="blank5"></div>
<div class="page"><?php echo ($page); ?></div>
</div>
</body>
</html>