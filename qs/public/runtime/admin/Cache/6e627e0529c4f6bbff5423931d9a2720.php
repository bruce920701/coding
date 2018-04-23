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

<script type="text/javascript" src="__TMPL__Common/js/conf.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/calendar/calendar.php?lang=zh-cn" ></script>
<script type="text/javascript">
	var relate_goods_num = parseInt("<?php echo ($relate_goods_num); ?>");
	var LOAD_GOODS_LIST_URL = "<?php echo u("Deal/ajaxGoodsList",array("is_shop"=>$is_shop,"id"=>$vo['id']));?>";
	var is_shop = 1;
	var carriage_template_ajax_url = "<?php echo u("Deal/carriage_template");?>";
	var DEFAULT_DELIVERY = '<?php echo ($default_delivery); ?>';
    var carriage_detail_url='<?php echo u("Deal/get_carriage_detail");?>';
    var user_group = '<?php echo ($user_group); ?>';   
    var img_index = <?php echo ($img_index); ?>;
    var deal_type = <?php echo ($type); ?>;
    var cancel_jump = '<?php echo u("Deal/shop",array("type"=>$type));?>';
</script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/js/calendar/calendar.css" />
<script type="text/javascript" src="__TMPL__Common/js/calendar/calendar.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/deal.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/deal_brand.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/init_relate_reply.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/deal_tc.js"></script>
<script type="text/javascript">
	
	window.onload = function()
	{
		var has_carriage_template = "<?php echo ($carriage_number); ?>";
		if(!has_carriage_template){
			if(confirm("请先去添加一个运费模板")){
				window.location = ROOT+"?"+VAR_MODULE+"=CarriageTemplate&"+VAR_ACTION+"=add";
				return false;
			}
		}
        ajax_carriage_tempate();
		init_dealform();
		
		//是否需要显示关联商品
		//initRelateGood();		
	}
	
	/**
	 * 设置关联商品
	*/
	function initRelateGood(){
		var is_shop = $("input[name='buy_type']").val();
		if( parseInt(is_shop)==1 ){	//积分商品
			$('table .relate_goods').hide();
			$('#supplier').empty();
			$('#supplier').append("<option value='0' selected='selected'>未选择</option>");
			$("#sl input[type='checkbox']").removeAttr("checked");
			$("#sl").empty();
			$('#relate_goods_flag').val('0');
		}else{
			$('table .relate_goods').show();
			$('#relate_goods_flag').val('1');
		}
	}
</script>
<div class="main">
<div class="main_title"><?php echo ($vo["name"]); ?><?php echo L("EDIT");?>  <a href="<?php echo u("Deal/shop",array('type'=>$type));?>" class="back_list"><?php echo L("BACK_LIST");?></a></div>
<div class="blank5"></div>
<form name="edit" action="__APP__" method="post" enctype="multipart/form-data">

<div class="blank5"></div>

<table style="display:none;" class="form shop_box_one" cellpadding=0 cellspacing=0 rel="1">
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	
		
	<?php if($supplier_info && $type == 2): ?><tr>
		<td class="item_title"><?php echo L("SUPPLIER_NAME");?>:</td>
		<td class="item_input">
		

			<?php if($supplier_info): ?><?php echo ($supplier_info["name"]); ?>
			<input type="hidden" name="supplier_id" value="<?php echo ($supplier_info["id"]); ?>" />
			<?php else: ?>
			
			<span id="supplier_list">
				<select name="supplier_id" id="supplier">
					<option value="0"><?php echo L("EMPTY_SELECT_SUPPLIER");?></option>
				</select>
				</span>
				<input type="text" class="textbox" name="supplier_key" /> 
			<input type="button" name="supplier_key_btn" class="button" value="<?php echo L("SEARCH");?>" /><?php endif; ?>


			
			<div class="info_row"><span class="row_left" style="width:auto;"><?php echo L("SUPPLIER_LOCATION");?> :</span>
			<div class="row_right">
				<div id="supplier_location">

				</div>
			
			</div>
			</div>
		</td>
	</tr><?php endif; ?>
	
	
	<tr>
		<td class="item_title">请选择商品分类</td>
		<td class="item_input">
		
		<ul class="shop_cate_box first_cate">
		
			<?php if(is_array($cate_tree)): foreach($cate_tree as $key=>$cate): ?><li data_id="<?php echo ($cate["id"]); ?>"><?php echo ($cate["name"]); ?></li><?php endforeach; endif; ?>

		</ul>
		<ul class="shop_cate_box second_cate">
		


		</ul>
		<div class="add_cate deal_button">
		<div class="button">添加分类</div>
		</div>
		</td>
	</tr>
	
	<tr>
		<td class="item_title">已选择分类</td>
		<td class="item_input">
		
		<div class="selected_shop_cate f_l">
		<input type="hidden" name="shop_cate_id" value="<?php echo ($vo["shop_cate_id"]); ?>"/>
		
		<?php if(is_array($shop_cate)): foreach($shop_cate as $key=>$cate): ?><div class="select_item shop_id" data_id="<?php echo ($cate["id"]); ?>">
		<?php if($cate['first_cate']): ?><?php echo ($cate["first_cate"]); ?> &gt;<?php endif; ?>
		<?php echo ($cate["name"]); ?><span class="selected_cate_delete">删除</span></div><?php endforeach; endif; ?>
		
		</div>

		</td>
	</tr>


	<tr>
		<td class="item_title"></td>
		<td class="item_input">
			<div class="go_next_step deal_button">
			<div class="button" >下一步</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>

</table>
<table class="form shop_box_two" cellpadding=0 cellspacing=0 rel="2">
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="item_title">商品分类</td>
		<td class="item_input cate_row">
		
		<div class="selected_shop_cate_two f_l">

		<?php if(is_array($shop_cate)): foreach($shop_cate as $key=>$cate): ?><div class="select_item shop_id" data_id="<?php echo ($cate["id"]); ?>">		
		<?php if($cate['first_cate']): ?><?php echo ($cate["first_cate"]); ?> &gt;<?php endif; ?>
		<?php echo ($cate["name"]); ?></div><?php endforeach; endif; ?>
		
		</div>
		<div class="f_l tip_span go_first_step">切换分类</div>
		</td>
	</tr>
	
	<?php if($supplier_info && $type == 2): ?><tr>
		<td class="item_title"><?php echo L("SUPPLIER_NAME");?>:</td>
		<td class="item_input supplier cate_row">	
		<?php if($supplier_info): ?><?php echo ($supplier_info["name"]); ?>
		<?php else: ?>
			平台自营<?php endif; ?>
		</td>
	</tr><?php endif; ?>
	
	<?php if($supplier_info && $type == 2): ?><tr id="supplier_location">
		<td class="item_title"><?php echo L("SUPPLIER_LOCATION");?>:</td>
		<td class="item_input cate_row">
			<div class="info_row">
			<div class="row_right">
				<div id="location">

				</div>
			
			</div>
			</div>
		</td>	
	</tr><?php endif; ?>
	
	<tr>
		<td class="item_title">基本信息</td>
		<td class="item_input">
		
		<div class="info_row"><span class="row_left row_left_require">商品标题 :</span><div class="row_right"><input type="text" class="textbox require count_num" name="name" style="width:500px;" value="<?php echo ($vo["name"]); ?>" maxlength="30" /><span class="text_tip"><span class="text_count">0</span>/<span class="text_limit">30</span></div></div>
		<div class="info_row"><span class="row_left row_left_require">商品简称 :</span><div class="row_right"><input type="text" class="textbox require count_num" name="sub_name"  value="<?php echo ($vo["sub_name"]); ?>" maxlength="18"/> <span class="text_tip"><span class="text_count">0</span>/<span class="text_limit">18</span></div></div>
		<div class="info_row"><span class="row_left"><?php echo L("URL_UNAME");?> :</span><div class="row_right"><input type="text" class="textbox word-only" name="uname" value="<?php echo ($vo["uname"]); ?>" /><span class="text_tip">限英文字母</span></div>	</div>
		<div class="info_row"><span class="row_left">商品卖点 :</span><div class="row_right"><input type="text" class="textbox count_num" name="brief" style="width:500px;" value="<?php echo ($vo["brief"]); ?>" maxlength="60" /><span class="text_tip"><span class="text_count">0</span>/<span class="text_limit">60</span></div></div>
		<div class="info_row"><span class="row_left row_left_require">商品图片 :</span>
			<div class="row_right">
				﻿<style>
.img-show-box {
    width: 700px;
    float: left;
}

.img-show-box .add_img{
    display: inline-block;
    position: relative;
    text-align: center;
    vertical-align: middle;
    width: 50px;
    height: 50px;
	border: dashed 1px #ccc !important;
	cursor: pointer;
}

.img-show-box .add_img img{
    width: 100%;
}

.img-show-box .add_img .file-btn{
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    height: 50px;
    opacity: 0;
	cursor: pointer;
} 

.img-show-box .img-item{
	width: 50px;
    height: 50px;
    float: left;
	border: solid 1px #ccc;
    margin-right: 10px;
	cursor: pointer;
}

.img-show-box .img-item .item_span{
	width: 100%;
    height: 100%;
    display: block;
}
.img-show-box .img-item:hover .close-btn{
    display: block;
}
.img-show-box .img-item .close-btn{
	top: -59px;
    right: -8px;
    float: right;
	display: none;
	position: relative;
}  
.big_demo_img{
	width:400px;
	height:400px;
	position:fixed;
	top:25%;
	left:40%;
	border:solid 1px #ccc;
	display:none;
	z-index:100;
}  

.big_demo_img .close_demo_img{
	top: -13px;
    right: -10px;
    float: right;
    position: relative;
	cursor: pointer;
} 
.img_bg_box{
	position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    text-align: center;
    z-index: 1;
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
	display:none;
}
</style>
<script>
var delete_icon = "__TMPL__Common/images/delete_icon.png";

</script>

<div class="img-show-box">
<?php if(is_array($img_list)): foreach($img_list as $key=>$img): ?><div ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)" class="img-item img-index-<?php echo ($key); ?>" data-index="<?php echo ($key); ?>">
    <span class="item_span" style="background-image:url('<?php echo ($img); ?>');background-size: cover;background-position: 50% 20%;background-repeat: no-repeat;"></span>
    <!-- <span class="item_span">
        <img src="<?php echo ($img); ?>" style="width: 100%; height: 100%">
    </span> -->
    <a class="close-btn" href="javascript:void(0);" onclick="del_img_box(this)">
        <img src="__TMPL__Common/images/delete_icon.png">
    </a>
    <input type="hidden" name="img[]" value="<?php echo ($img); ?>">
</div><?php endforeach; endif; ?>


	<div class="add_img img-item"  style="display:none;" ><img src="__TMPL__Common/images/add_img_icon.png" />
	<input class="file-btn" id="file-btn" type="file" capture="camera">
	</div>



<div class="blank5"></div>
<?php if($img_info): ?><div class="text_info">
	   <?php echo ($img_info); ?>
	</div><?php endif; ?>



<div class="big_demo_img">
<div class="demo_img_attr"><img src="" style=""></div>
<div class="close_demo_img"><img src="__TMPL__Common/images/delete_icon_big.png" /></div>

</div>
<div class="img_bg_box"></div>
</div>

			</div>
		</div>
		<div class="info_row relate_goods deal_box"><span class="row_left">合并购买 :</span>
	    <div class=" row_right">
		    <div id="relate_goods_box">
		    
		    
		    <?php if(is_array($relate_goods)): foreach($relate_goods as $key=>$relate_good): ?><div class="relate_row"><div class="relate_left"><input type="hidden" id="relate_goods_id_<?php echo ($relate_good["id"]); ?>" name="relate_goods_id[]" value="<?php echo ($relate_good["id"]); ?>">
				<span class="dl_img">
					<a href="<?php echo ($relate_good["share_url"]); ?>" title="<?php echo ($relate_good["name"]); ?>" target="_blank"><img src="<?php echo ($relate_good["img"]); ?>" width="100" heigth="70"></a>
				</span>
				</div><div class="relate_right"><a href="<?php echo ($relate_good["share_url"]); ?>" title="<?php echo ($relate_good["name"]); ?>" target="_blank"><?php echo ($relate_good["name"]); ?></a><a class="relate_close_btn" href="javascript:void(0);"><img src="__TMPL__Common/images/delete_icon.png"></a></div></div><?php endforeach; endif; ?>
		    
			<div class="add_icon" <?php if($relate_goods_count >= $relate_goods_num): ?>style="display:none;"<?php endif; ?> ><img src="__TMPL__Common/images/add_img_icon.png" />
				<button type="button" class="btn" id="add_relate_goods">添加关联商品</button>
			</div>
				
			</div>
		
		<div class="text_info">最多关联<?php echo ($relate_goods_num); ?>个商品</div>
        <input type="hidden" name="relate_goods_flag" id="relate_goods_flag" />
	    </div>
		</div>
		
		<div class="info_row deal_box"><span class="row_left">商品标签 :</span>
			<div class="row_right">
				
			<?php for($i=1;$i<WAP_DEAL_TAG_NUMBER;$i++)
				{
					// if($i!=1&&$i!=3&&$i!=4&&$i!=5&&$i!=6&&$i!=9)
					if(!in_array($i, array(1,3,4,5,6,9,10)))
					{
					if(($vo['deal_tag']&pow(2,$i))==pow(2,$i))
					echo "<label><input type='checkbox' name='deal_tag[]' value='".$i."' checked='checked' />".l("DEAL_TAG_".$i)."</label>&nbsp;";
					else
					echo "<label><input type='checkbox' name='deal_tag[]' value='".$i."' />".l("DEAL_TAG_".$i)."</label>&nbsp;";
					}
				} ?>
			</div>
		</div>
		
		<div class="info_row"><span class="row_left"><?php echo L("BRAND_NAME");?> :</span>
			<div class="row_right brand_box">

			<select name="brand_id">
				<option value="0">请选择品牌</option>
				<?php if(is_array($brand_list)): foreach($brand_list as $key=>$brand_item): ?><option value="<?php echo ($brand_item["id"]); ?>" <?php if($vo['brand_id'] == $brand_item['id']): ?>selected="selected"<?php endif; ?> ><?php echo ($brand_item["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			</div>
		</div>
		
		</td>
	</tr>
	
	<tr>
		<td class="item_title">
			<?php if($type == 1): ?>库存
			<?php else: ?>
			库存/规格<?php endif; ?>
		</td>
		<td class="item_input">

		<div class="info_row"><span class="row_left">上架时间 :</span>
		<div class="row_right">
			<input type="text" class="textbox" name="begin_time" id="begin_time" value="<?php echo ($vo["begin_time"]); ?>" onfocus="this.blur(); return showCalendar('begin_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_begin_time');" />
			<input type="button" class="button" id="btn_begin_time" value="<?php echo L("SELECT_TIME");?>" onclick="return showCalendar('begin_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_begin_time');" />	
			<input type="button" class="button" value="<?php echo L("CLEAR_TIME");?>" onclick="$('#begin_time').val('');" />	
			<span class="text_tip">不设置立即上架</span>
		</div>
		</div>
		
		<div class="info_row"><span class="row_left">下架时间 :</span>
		<div class="row_right">
			<input type="text" class="textbox" name="end_time" id="end_time" value="<?php echo ($vo["end_time"]); ?>" onfocus="this.blur(); return showCalendar('end_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_end_time');" />
			<input type="button" class="button" id="btn_end_time" value="<?php echo L("SELECT_TIME");?>" onclick="return showCalendar('end_time', '%Y-%m-%d %H:%M:%S', false, false, 'btn_end_time');" />	
			<input type="button" class="button" value="<?php echo L("CLEAR_TIME");?>" onclick="$('#end_time').val('');" />
		</div>
		</div>
		
		<div class="info_row score_box"><span class="row_left">所需积分 :</span>
		<div class="row_right">
			<input type="text" class="textbox" name="deal_score" value="<?php echo ($vo["deal_score"]); ?>" />			
		</div>
		</div>
		
		<?php if($type == 2): ?><div class="info_row deal_box"><span class="row_left row_left_require">结算费率 :</span><div class="row_right"><input type="text" class="textbox require pricebox" name="publish_verify_balance" value="<?php echo ($vo["publish_verify_balance"]); ?>" /> %	<span class="text_tip">不可设置为空</span></div>
		</div><?php endif; ?>
		
		<div class="info_row deal_box"><span class="row_left row_left_require">价格 :</span>
		<div class="row_right">
		
		<div class="price_item">
			<span class="price_title">销售价</span>
			<input type="text" class="textbox pricebox <?php if($type == 0 || $type == 2): ?>require<?php endif; ?> f_l" name="current_price" style="width:80px;" value="<?php echo ($vo["current_price"]); ?>" maxlength="10" />
		</div>
		
		<div class="price_item">
			<span class="price_title"><?php echo L("DEAL_ORIGIN_PRICE");?></span>
			<input type="text" class="textbox pricebox <?php if($type == 0 || $type == 2): ?>require<?php endif; ?> f_l" name="origin_price" style="width:80px;" value="<?php echo ($vo["origin_price"]); ?>" maxlength="10" />
		</div>
		
		<div class="price_item">
			<span class="price_title">
			<?php if($type == 0): ?>成本价
			<?php else: ?>
			<?php echo L("DEAL_BALANCE_PRICE");?><?php endif; ?>
			</span>
			<input type="text" class="textbox pricebox <?php if($type == 0 || $type == 2): ?>require<?php endif; ?> f_l" name="balance_price" style="width:80px;" value="<?php echo ($vo["balance_price"]); ?>" maxlength="10" />
		</div>
		
		<div class="text_info">

			毛利率：<span class="price_profit_precentage">0.00%</span>   毛利额：<span class="price_profit">0.00</span> 
		</div>
		</div></div>
	
		<div class="info_row deal_box">
		<div class="unit_row">
				<label><input type='checkbox' name='allow_user_discount' value='1'  <?php if($vo['allow_user_discount'] == 1): ?>checked="checked"<?php endif; ?> />参与会员等级折扣优惠</label>			
		</div>
		</div>
		
		<div class="info_row user_discount"><span class="row_left">会员价 :</span>
		<div class="row_right">
		<div class="user_discount_box">
		
		</div>

		<div class="text_info">
			会员价根据会员等级折扣实时变动，请注意控制会员等级折扣，以免会员价低于成本价 
		</div>
		</div>

		</div>
		
				
		<div class="info_row deal_box"><span class="row_left">商品属性 :</span>
		<div class="row_right">
			<select name="deal_goods_type">
			<option value="0" <?php if($vo['deal_goods_type'] == 0): ?>selected="selected"<?php endif; ?>>请选择</option>
			<?php if(is_array($goods_type_list)): foreach($goods_type_list as $key=>$goods_type_item): ?><option value="<?php echo ($goods_type_item["id"]); ?>" <?php if($vo['deal_goods_type'] == $goods_type_item['id']): ?>selected="selected"<?php endif; ?>><?php echo ($goods_type_item["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			
			<div id="deal_attr"></div>
			
		</div>

		</div>
		
		<div class="info_row attr_box deal_box"><span class="row_left">商品库存 :</span>
		<div class="row_right">

			<div id="stock_table">
                <div class="syn_box">
                    <div class="f_l">
                        <span class="syn_title">递增销售价 </span><input class="syn_value pricebox" name="syn_price" type="text" value="" />元，
                        <?php if($supplier_id == 0): ?><span class="syn_title">递增成本价 </span><input class="syn_value pricebox" name="syn_add_balance_price" type="text" value="" />元，<?php endif; ?>
                        <span class="syn_title">库存</span><input class="syn_value" name="syn_stock_cfg" type="text" value="" />
                    </div>
                    <div class="syn_price_setting deal_button ">
                        <div class="button">批量设置</div>
                    </div>

                </div>
                <?php echo ($html); ?>
			</div>
			
		</div>

		</div>
		
		<div class="info_row"><span class="row_left">总库存 :</span>
		<div class="row_right">
			<input type="text" class="textbox" name="max_bought" value="<?php echo ($vo["max_bought"]); ?>" />			
		</div>
		</div>
		
		<div class="info_row"><span class="row_left"><?php echo L("DEAL_USER_MIN_BOUGHT");?> :</span>
		<div class="row_right">
			<input type="text" class="textbox" name="user_min_bought" value="<?php echo ($vo["user_min_bought"]); ?>" />			
		</div>
		</div>
		
		<div class="info_row"><span class="row_left"><?php echo L("DEAL_USER_MAX_BOUGHT");?> :</span>
		<div class="row_right">
			<input type="text" class="textbox" name="user_max_bought" value="<?php echo ($vo["user_max_bought"]); ?>" />			
		</div>
		</div>
	
		<div class="info_row"><span class="row_left">虚拟件数 :</span>
		<div class="row_right">
			<input type="text" name="buy_count" class="textbox" value="<?php echo ($vo["buy_count"]); ?>" />			
		</div>
		</div>

	</tr>
	
	<tr>
		<td class="item_title">物流配置</td>
		<td class="item_input">
		
		<div class="info_row"><span class="row_left row_left_require">配送方式 :</span><div class="row_right">
			<?php if(is_array($delivery_type)): foreach($delivery_type as $key=>$delivery_item): ?><label class="delivery-type-<?php echo ($delivery_item["value"]); ?>"><input name="delivery_type" type="radio" value="<?php echo ($delivery_item["value"]); ?>" <?php if($delivery_item['value'] == $vo['delivery_type']): ?>checked="checked"<?php endif; ?> /><?php echo ($delivery_item["name"]); ?></label>&nbsp;<?php endforeach; endif; ?>
		
			<div  style="display:none;">

			<select name="is_delivery">
				<option value="0" <?php if($vo['is_delivery'] == 0): ?>selected="selected"<?php endif; ?>><?php echo L("IS_DELIVERY_0");?></option>
				<option value="1" <?php if($vo['is_delivery'] == 1): ?>selected="selected"<?php endif; ?>><?php echo L("IS_DELIVERY_1");?></option>
			</select>
			<span class='tip_span'>[<?php echo L("DEAL_IS_DELIVERY_TIP");?>]</span>
			</div>
			
		</div>
		</div>
		
		<div class="info_row carriage-tpl delivery"><span class="row_left row_left_require">运费模版 :</span><div class="row_right">

			<div>		
					<select name="carriage_template_id" >
						<option value="0">==请选择运费模板==</option>
						<?php if(is_array($carriage_template)): foreach($carriage_template as $key=>$carriage_template_item): ?><option value="<?php echo ($carriage_template_item["id"]); ?>" data-valuation-type="<?php echo ($carriage_template_item["type"]); ?>" <?php if($carriage_template_item['id'] == $vo['carriage_template_id']): ?>selected="selected"<?php endif; ?>><?php echo ($carriage_template_item["name"]); ?></option><?php endforeach; endif; ?>
					</select>
		            <div class="box-gray J_transportTpl" >
		                <div id="J_hintDefault"  style="display: none;">
		                    <div id="carriage_default_carriage">
		               		         默认运费：1.0千克内1.00元，每增加1.0千克，加1.00元
		                    </div>
		                </div>
		                <div id="deliver-warn" style="display: none;">发货地：<span id="carriage_teplate_address">阿富汗</span></div>
		            </div>
		
			</div>
			
		</div>
		</div>
		<div class="info_row weight_box"><span class="row_left">配送重量 :</span><div class="row_right">

			<input type="text" class="textbox" name="weight" value="<?php echo ($vo["weight"]); ?>" />
			<span class='text_tip'>千克 </span>
			
		</div>
		</div>
		
		<?php if($type == 2): ?><div class="info_row deal_box pick_box">
		<div class="unit_row">
				<label><input type='checkbox' name='is_pick' value='1' <?php if($vo['is_pick'] == 1): ?>checked="checked"<?php endif; ?> />允许自提</label>			
		</div>
		</div><?php endif; ?>
		
		<div class="info_row delivery-3" style="display: none;"><span class="row_left">驿站服务费率 :</span><div class="row_right">
			<input class="textbox pricebox" name="dist_service_rate" value="<?php echo ($vo["dist_service_rate"]); ?>"/>
			<span class='text_tip'>% [服务费＝（现价－成本价）*比率]</span>		
		</div>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="item_title">购买需知</td>
		<td class="item_input">
			<script type='text/javascript'> var eid = 'notes';KE.show({id : eid,skinType: 'tinymce',allowFileManager : true,resizeMode : 0,items : [
							'source','fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
							'plainpaste', 'wordpaste', 'justifyleft', 'justifycenter', 'justifyright',
							'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
							'superscript', 'selectall', '-',
							'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold',
							'italic', 'underline', 'strikethrough', 'removeformat', 'image',
							'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink'
						]});</script><div  style='margin-bottom:5px; '><textarea id='notes' name='notes' style='width:750px; height:350px;' ><?php echo ($vo["notes"]); ?></textarea> </div>

		</td>
	</tr>

	<tr>
		<td class="item_title">电脑端设置</td>
		<td class="item_input">
			 <script type='text/javascript'> var eid = 'description';KE.show({id : eid,skinType: 'tinymce',allowFileManager : true,resizeMode : 0,items : [
							'source','fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
							'plainpaste', 'wordpaste', 'justifyleft', 'justifycenter', 'justifyright',
							'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
							'superscript', 'selectall', '-',
							'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold',
							'italic', 'underline', 'strikethrough', 'removeformat', 'image',
							'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink'
						]});</script><div  style='margin-bottom:5px; '><textarea id='description' name='description' style='width:750px; height:350px;' ><?php echo ($vo["description"]); ?></textarea> </div>
		</td>
	</tr>
	<tr>
		<td class="item_title">手机端设置</td>
		<td class="item_input">
		<div class="phone_description_box">
			﻿<iframe src="__TMPL__Common/js/phone/phone.html" id="phone_description_box" name="<?php echo ($name); ?>" class="" allowtransparency="true" style="background-color=transparent" title="test" frameborder="0" width="320" height="570" scrolling="no"></iframe>
<script type="text/javascript">
var admin_root='<?php echo ($admin_root); ?>';
var app_root='<?php echo ($app_root); ?>';  
</script>


			<input type="hidden" id="phone_description" name="phone_description" value='<?php echo ($vo["phone_description"]); ?>'>
		</div>
		</td>
	</tr>


	<tr class="deal_box_tr">
		<td class="item_title">分销设置</td>
		<td class="item_input">
		
		<div class="info_row">
		<div class="unit_row">
				<label><input type='checkbox' name='is_referral' value='1' <?php if($vo['is_referral'] == 1): ?>checked="checked"<?php endif; ?> />参与邀请好友注册购买得返利</label>			
		</div>
		</div>
		
		<?php if( $type == 0): ?><div class="info_row"><span class="row_left">推荐会员ID :</span><div class="row_right">
			<input class="textbox" name="recommend_user_id" value="<?php echo ($vo["recommend_user_id"]); ?>"/>
			<span class='text_tip'>[设置推荐会员ID才生效，返佣金额＝（现价－
			<?php if($type == 0): ?>成本价
			<?php else: ?>
			结算价<?php endif; ?>
			）*比率]</span>		
		</div>
		</div>
		
		<div class="info_row"><span class="row_left">推荐会员返佣率 :</span><div class="row_right">
			<input class="textbox pricebox" name="recommend_user_return_ratio" value="<?php echo ($vo["recommend_user_return_ratio"]); ?>"/>
			<span class='text_tip'>%</span>		
		</div>
		</div><?php endif; ?>	
		<?php if(defined("FX_LEVEL")){ ?>
		<div class="info_row">
		<div class="unit_row">
				<label><input type='checkbox' name='is_allow_fx' value='1' <?php if($vo['is_fx'] > 0): ?>checked="checked"<?php endif; ?> />参与分销</label>			
		</div>
		</div>
	
		<div class="info_row fx_box"><span class="row_left row_left_require">分销方式 :</span><div class="row_right">
			<label><input name="is_fx" type="radio" value="2" <?php if($vo['is_fx'] == 2 ): ?>checked="checked"<?php endif; ?> />允许会员领取</label>&nbsp;
			<label><input name="is_fx" type="radio" value="1" <?php if($vo['is_fx'] == 1 ): ?>checked="checked"<?php endif; ?> />系统强制分配</label>&nbsp;
		</div>
		</div>	
		
		<div class="info_row fx_box"><span class="row_left row_left_require">佣金分配 :</span><div class="row_right">
			<label><input name="fx_salary_type" type="radio" value="0" <?php if($vo['fx_salary_type'] == 0 ): ?>checked="checked"<?php endif; ?> />定额</label>&nbsp;
			<label><input name="fx_salary_type" type="radio" value="1" <?php if($vo['fx_salary_type'] == 1 ): ?>checked="checked"<?php endif; ?> />比率</label>&nbsp;
		</div>
		</div>	
		
		<div class="info_row fx_box"><span class="row_left row_left_require">佣金设置 :</span><div class="row_right">
	
			<div><span class="row_right_title">一级邀请佣金</span>
			<input type="text" class="textbox pricebox" name="fx_salary[]" value="<?php echo ($fx_salary["0"]["fx_salary"]); ?>"><span class="fx_unit">元</span></div>
			<div class="blank5"></div>	
			
			<div><span class="row_right_title">二级邀请佣金</span>
			<input type="text" class="textbox pricebox" name="fx_salary[]" value="<?php echo ($fx_salary["1"]["fx_salary"]); ?>"><span class="fx_unit">元</span></div>
			<div class="blank5"></div>	
			
			<div><span class="row_right_title">三级邀请佣金</span>
			<input type="text" class="textbox pricebox" name="fx_salary[]" value="<?php echo ($fx_salary["2"]["fx_salary"]); ?>"><span class="fx_unit">元</span></div>
			<div class="blank5"></div>	
			
			
		</div>
		</div>
		
		<?php } ?>
		
		</td>
	</tr>
	
	
	
	<tr>
		<td class="item_title">特权/其他设置</td>
		<td class="item_input">
		
		<div class="info_row deal_box">
		<div class="unit_row">
				<label><input type='checkbox' name='buyin_app' value='1' <?php if($vo['buyin_app'] == 1): ?>checked="checked"<?php endif; ?> />限制仅APP端可购买</label>			
		</div>
		</div>
		<div class="info_row deal_box">
		<div class="unit_row">
				<label><input type='checkbox' name='is_refund' value='1' <?php if($vo['is_refund'] == 1): ?>checked="checked"<?php endif; ?> />支持退款</label>			
		</div>
		</div>
		
		<div class="info_row deal_box">
		<div class="unit_row">
				<label><input type='checkbox' name='is_recommend' value='1' <?php if($vo['is_recommend'] == 1): ?>checked="checked"<?php endif; ?> />设为推荐商品</label>			
		</div>
		</div>
		
		
		<div class="info_row deal_box"><span class="row_left">购买送积分 :</span><div class="row_right">
		<input type="text" class="textbox number-int" name="return_score" value="<?php echo ($vo["return_score"]); ?>" maxlength="10" />
		</div></div>
		
		<div class="info_row deal_box"><span class="row_left">购买送现金 :</span><div class="row_right">
		<input type="text" class="textbox pricebox" name="return_money" value="<?php echo ($vo["return_money"]); ?>" maxlength="10" />&nbsp;&nbsp;元
		</div></div>

		<div class="info_row"><span class="row_left">SEO标题 :</span><div class="row_right">
		<input type="text" class="textbox count_num" name="seo_title" style="width:500px;" value="<?php echo ($vo["seo_title"]); ?>" maxlength="30" />
		<span class="text_tip"><span class="text_count">0</span>/<span class="text_limit">30</span></div></div>
	
		<div class="info_row"><span class="row_left">SEO关键词 :</span><div class="row_right">
		<input type="text" class="textbox count_num" name="seo_keyword" style="width:500px;" value="<?php echo ($vo["seo_keyword"]); ?>" maxlength="30" />
		<span class="text_tip"><span class="text_count">0</span>/<span class="text_limit">30</span></div></div>
		
		<div class="info_row"><span class="row_left">SEO描述 :</span><div class="row_right">
		<input type="text" class="textbox count_num" name="seo_description" style="width:500px;" value="<?php echo ($vo["seo_description"]); ?>" maxlength="60" />
		<span class="text_tip"><span class="text_count">0</span>/<span class="text_limit">60</span></div></div>
		
		<div class="info_row"><span class="row_left"><?php echo L("SORT");?> :</span><div class="row_right">
		<input type="text" class="textbox" name="sort" value="<?php echo ($vo["sort"]); ?>" maxlength="10"/>
		</div></div>

		<div class="info_row"><span class="row_left">状态 :</span><div class="row_right">
			<label><input name="is_effect" type="radio" value="1" <?php if($vo['is_effect'] == 1 ): ?>checked="checked"<?php endif; ?> />有效</label>&nbsp;
			<label><input name="is_effect" type="radio" value="0" <?php if($vo['is_effect'] == 0 ): ?>checked="checked"<?php endif; ?> />无效</label>&nbsp;

		</div>
		</div>
	
		</td>
	</tr>

	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="item_title"></td>
		<td class="item_input">
		<!--隐藏元素-->
			
			
		<input type="hidden" name="buy_type" value="<?php echo ($vo["buy_type"]); ?>" />	
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
		<input type="hidden" name="<?php echo conf("VAR_MODULE");?>" value="Deal" />
		<input type="hidden" name="<?php echo conf("VAR_ACTION");?>" value="shop_update" />
		<!--隐藏元素-->
		<input type="hidden" name="edit_type" value="1" />
		<input type="hidden" name="type" value="<?php echo ($type); ?>" />

		<input type="submit" class="button" value="保存" />
		<input type="reset" class="button cancel_deal" value="取消" />
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>

</table>

<div class="blank5"></div>
	 
</form>
</div>
<div style="display:none" id="DefaultHtmlMeal">
		<?php echo ($vo["set_meal"]); ?>
</div>
<div style="display:none" id="DefaultHtmlPCMeal">
		<?php echo ($vo["pc_setmeal"]); ?>
</div>
</body>
</html>