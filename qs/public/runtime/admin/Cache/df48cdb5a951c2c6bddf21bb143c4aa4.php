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
<style>
    table.form th {
        height: 25px;
        text-align: center;
        background: #edf3f7;
        line-height: 25px;
        border-right: #ccc solid 1px;
        border-bottom: #ccc solid 1px;
    }
    #navs{ background:url(__TMPL__Common/images/navbgs.png) 0px 24px repeat-x; height:28px; position:relative;}
    #navs ul{position:absolute;}
    #navs ul li{ float:left; display:inline; padding:0px 5px; width:90px; }

    #navs a.show{ display:block; background:#4E6A81 0px 0px repeat-x; color:#fff;  padding:0px 10px;text-align:center; text-decoration:none; line-height:25px; height:28px; font-weight:bold; }
    #navs a.show.current{  color:#fff; background:#8EA7BB repeat-x; line-height:28px;  }
    #stock_table table th {
        background: white;
        padding: 10px;
        height: 25px;
        text-align: center;
        line-height: 25px;
        border-right: #ccc solid 1px;
        border-bottom: #ccc solid 1px;
    }
    #stock_table table td {
        text-align: center;
        padding: 10px;
        border-right: #ccc solid 1px;
        border-bottom: #ccc solid 1px;
    }
    #stock_table table {
         border-spacing: 0px;
         border-top: solid 1px #ccc;
         border-left: solid 1px #ccc;
     }
</style>
<script type="text/javascript">
	function preview(id)
	{
		window.open("__ROOT__/index.php?ctl=deal&act="+id+"&preview=1");
	}
    function show_detail(id)
    {
        $.weeboxs.open(ROOT+'?m=Deal&a=show_detail&id='+id, {contentType:'ajax',showButton:false,title:LANG['COUNT_TOTAL_DEAL'],width:600,height:330});
    }
</script>
<?php function get_shop_cate_name($cate_id)
	{
        $cate_id=explode(",",$cate_id);
		$cate_name=M("ShopCate")->where("id=".$cate_id[0])->getField("name");
        if(count($cate_id)>1){
            return $cate_name."...";
        }else{
            return $cate_name;
        }

		
	}
    function get_deal_no_city_name($city_id){
        if($city_id){
           return get_city_name($city_id);
        }else{
           return "全国";
       }
    }
	function get_buy_type_title($buy_type)
	{
		return l("SHOP_BUY_TYPE_".$buy_type);
	}
	function a_get_time_status($time_status,$deal_id)
	{
		$str = l("TIME_STATUS_".$time_status);
		return $str;
	}
	function a_get_deal_type($type,$id)
	{
		$deal = M("Deal")->getById($id);
		if($deal['is_coupon'])
		{
		$link = "&nbsp;&nbsp;[ <a href='".__APP__."?m=DealCoupon&a=index&deal_id=".$id."' style='color:red;'>".l("DEAL_COUPON")."</a> ]";
		return l("COUNT_TYPE_".$deal['deal_type']).$link;
		}
		else
		return l("NO_DEAL_COUPON_GEN");
		
	}
    function format_max_bought($max_bought){
      if($max_bought==-1){
         return "不限";
      }else{
         return $max_bought;
      }
    }
	function get_coupon($id)
	{
		$deal = M("Deal")->where("id=".$id)->find();
		if($deal['is_coupon'] == 1 || $deal['is_pick'] == 1)
		{
			$link = "[ <a href='".__APP__."?m=DealCoupon&a=index&deal_id=".$id."' style='color:red;'>".l("DEAL_COUPON")."</a> ]";
		}
		return $link;
	}
    function a_get_buy_status($buy_status,$deal_id)
    {
        $is_coupon = M("Deal")->where("id=".$deal_id)->getField("is_coupon");
        if($is_coupon == 1)
        {
        $link = "&nbsp;&nbsp;[ <a href='".__APP__."?m=DealCoupon&a=index&deal_id=".$deal_id."' style='color:red;'>".l("DEAL_COUPON")."</a> ]";
        }
        $count = "&nbsp;&nbsp;[<a href='javascript:void(0);' onclick='show_detail(".$deal_id.");' style='color:red;'>".l("COUNT_TOTAL_DEAL")."</a>]";
        return l("BUY_STATUS_".$buy_status).$link.$count;
    }
	function show_attr_stock($id,$name){
       $link='';
       $count=M("AttrStock")->where("deal_id=".$id)->count();
       if($count){
            $link = "<a href=\"javascript:show_attr_stock(".$id.",'".$name."')\">规格库存</a>";
       }
       return $link;
    }
    function get_real_buy_count($id){
      return $real_buy_count =  intval($GLOBALS['db']->getOne("select sum(doi.number) from ".DB_PREFIX."deal_order_item as doi left join ".DB_PREFIX."deal_order as do on doi.order_id = do.id where doi.deal_id = ".$id." and do.pay_status = 2"));
    } ?>

<div class="main">
<div class="main_title"><?php if($type==0): ?>商城商品<?php elseif($type==1): ?>积分商品<?php elseif($type==4): ?>精品区商品<?php elseif($type==3): ?>团购商品<?php endif; ?></div>
<div class="blank5"></div>
<div id="navs">
    <div>
        <ul>
            <li ><a class="show <?php if($status==0): ?>current<?php endif; ?>" href="<?php echo u("Deal/shop",array("status"=>0,"type"=>$type));?>">出售中</a></li>
            <li><a class="show <?php if($status==1): ?>current<?php endif; ?>" href="<?php echo u("Deal/shop",array("status"=>1,"type"=>$type));?>">已售罄</a></li>
            <li><a class="show <?php if($status==2): ?>current<?php endif; ?>" href="<?php echo u("Deal/shop",array("status"=>2,"type"=>$type));?>">仓库中</a></li>
        </ul>
    </div>
    <div style="float:right">
        <a style="color:black;margin: 0 10px 0 0;font-weight: bold;font-size: 14px;" href="<?php echo u("Deal/trash",array("type"=>$type));?>">商品回收站</a>
    </div>
</div>
<div class="search_row">
    <div class="button_row" style="float: left;">
        <div style="display: inline-block;">
        <input type="button" class="button" style="background:#FF9900;" value="新增商品" onclick="add_goods(<?php echo ($type); ?>);" />
        <input type="button" class="button" value="<?php echo L("DEL");?>" onclick="del();" />
            <?php if($status==2): ?><input type="button" class="button" value="上架" onclick="up_line();" />
                <span class="item_input">注：如果无法上架，请查看库存和上下架时间是否有问题</span>
                <?php else: ?>
                <input type="button" class="button" value="下架" onclick="down_line();" /><?php endif; ?>
        </div>

    </div>
    <div style="float: right;">
        <form name="search" action="__APP__" method="get">
          <?php if($type==0||$type==1 || $type=4): ?><select name="cate_id">
                  <option value="0" <?php if(intval($_REQUEST['cate_id']) == 0): ?>selected="selected"<?php endif; ?>>所有分类</option>
                  <?php if(is_array($cate_tree)): foreach($cate_tree as $key=>$cate_item): ?><option value="<?php echo ($cate_item["id"]); ?>" <?php if(intval($_REQUEST['cate_id']) == $cate_item['id']): ?>selected="selected"<?php endif; ?>><?php echo ($cate_item["title_show"]); ?></option><?php endforeach; endif; ?>
              </select>
              <input type="text" class="textbox" name="name" value="<?php echo strim($_REQUEST['name']);?>" placeholder="商品名" />
              <input type="hidden" value="Deal" name="<?php echo conf("VAR_MODULE");?>" />
              <input type="hidden" value="shop" name="<?php echo conf("VAR_ACTION");?>" />
              <input type="hidden" value="<?php echo ($type); ?>" name="type" />
              <input type="hidden" value="<?php echo ($status); ?>" name="status" />
              <input type="submit" class="button" value="<?php echo L("SEARCH");?>" />
          <?php elseif($type==2||$type==3): ?>
              <select name="cate_id">
                  <option value="0" <?php if(intval($_REQUEST['cate_id']) == 0): ?>selected="selected"<?php endif; ?>>所有分类</option>
                  <?php if(is_array($cate_tree)): foreach($cate_tree as $key=>$cate_item): ?><option value="<?php echo ($cate_item["id"]); ?>" <?php if(intval($_REQUEST['cate_id']) == $cate_item['id']): ?>selected="selected"<?php endif; ?>><?php echo ($cate_item["title_show"]); ?></option><?php endforeach; endif; ?>
              </select>
              <input type="text" class="textbox" name="name" value="<?php echo strim($_REQUEST['name']);?>" placeholder="商品名" />
              <input type="text" class="textbox" name="supplier_name" value="<?php echo strim($_REQUEST['supplier_name']);?>" placeholder="商家名"/>

              <input type="hidden" value="Deal" name="<?php echo conf("VAR_MODULE");?>" />
              <input type="hidden" value="shop" name="<?php echo conf("VAR_ACTION");?>" />
              <input type="hidden" value="<?php echo ($type); ?>" name="type" />
              <input type="hidden" value="<?php echo ($status); ?>" name="status" />
              <input type="submit" class="button" value="<?php echo L("SEARCH");?>" /><?php endif; ?>

        </form>
    </div>
    <div style="clear:both;"></div>
</div>
<div class="blank5"></div>
<?php if($type==0): ?><!-- Think 系统列表组件开始 -->
<table id="dataTable" class="dataTable" cellpadding=0 cellspacing=0 ><tr><td colspan="9" class="topTd" >&nbsp; </td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px   "><a href="javascript:sortBy('id','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("ID");?><?php echo ($sortType); ?> "><?php echo L("ID");?><?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("GOODS_NAME");?><?php echo ($sortType); ?> "><?php echo L("GOODS_NAME");?><?php if(($order)  ==  "name"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('current_price','<?php echo ($sort); ?>','Deal','shop')" title="按照价格   <?php echo ($sortType); ?> ">价格   <?php if(($order)  ==  "current_price"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('shop_cate_id','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("SHOP_CATE_TITLE");?>         <?php echo ($sortType); ?> "><?php echo L("SHOP_CATE_TITLE");?>         <?php if(($order)  ==  "shop_cate_id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('max_bought','<?php echo ($sort); ?>','Deal','shop')" title="按照库存         <?php echo ($sortType); ?> ">库存         <?php if(($order)  ==  "max_bought"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','Deal','shop')" title="按照总销量   <?php echo ($sortType); ?> ">总销量   <?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('sort','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("SORT");?><?php echo ($sortType); ?> "><?php echo L("SORT");?><?php if(($order)  ==  "sort"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deal): ++$i;$mod = ($i % 2 )?><tr class="row" ><td><input type="checkbox" name="key" class="key" value="<?php echo ($deal["id"]); ?>"></td><td>&nbsp;<?php echo ($deal["id"]); ?></td><td>&nbsp;<a href="javascript:edit_goods   ('<?php echo (addslashes($deal["id"])); ?>')"><?php echo (msubstr_name($deal["name"])); ?></a></td><td>&nbsp;<?php echo (number_format($deal["current_price"],2)); ?></td><td>&nbsp;<?php echo (get_shop_cate_name($deal["shop_cate_id"])); ?></td><td>&nbsp;<?php echo (format_max_bought($deal["max_bought"])); ?></td><td>&nbsp;<?php echo (get_real_buy_count($deal["id"])); ?></td><td>&nbsp;<?php echo (get_sort($deal["sort"],$deal['id'])); ?></td><td> <?php echo (get_coupon($deal["id"])); ?>&nbsp;<a href="javascript:edit_goods('<?php echo ($deal["id"]); ?>')"><?php echo L("EDIT");?></a>&nbsp;<a href="javascript: del('<?php echo ($deal["id"]); ?>')"><?php echo L("DEL");?></a>&nbsp;<a href="javascript: preview('<?php echo ($deal["id"]); ?>')"><?php echo L("PREVIEW");?></a>&nbsp; <?php echo (show_attr_stock($deal["id"],$name)); ?>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td colspan="9" class="bottomTd"> &nbsp;</td></tr></table>
<!-- Think 系统列表组件结束 -->

<?php elseif($type==1): ?>
    <!-- Think 系统列表组件开始 -->
<table id="dataTable" class="dataTable" cellpadding=0 cellspacing=0 ><tr><td colspan="9" class="topTd" >&nbsp; </td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px   "><a href="javascript:sortBy('id','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("ID");?><?php echo ($sortType); ?> "><?php echo L("ID");?><?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("GOODS_NAME");?><?php echo ($sortType); ?> "><?php echo L("GOODS_NAME");?><?php if(($order)  ==  "name"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('return_score','<?php echo ($sort); ?>','Deal','shop')" title="按照所需积分   <?php echo ($sortType); ?> ">所需积分   <?php if(($order)  ==  "return_score"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('shop_cate_id','<?php echo ($sort); ?>','Deal','shop')" title="按照分类         <?php echo ($sortType); ?> ">分类         <?php if(($order)  ==  "shop_cate_id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('max_bought','<?php echo ($sort); ?>','Deal','shop')" title="按照库存         <?php echo ($sortType); ?> ">库存         <?php if(($order)  ==  "max_bought"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','Deal','shop')" title="按照总销量   <?php echo ($sortType); ?> ">总销量   <?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('sort','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("SORT");?><?php echo ($sortType); ?> "><?php echo L("SORT");?><?php if(($order)  ==  "sort"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deal): ++$i;$mod = ($i % 2 )?><tr class="row" ><td><input type="checkbox" name="key" class="key" value="<?php echo ($deal["id"]); ?>"></td><td>&nbsp;<?php echo ($deal["id"]); ?></td><td>&nbsp;<a href="javascript:edit_goods   ('<?php echo (addslashes($deal["id"])); ?>')"><?php echo (msubstr_name($deal["name"])); ?></a></td><td>&nbsp;<?php echo (abs($deal["return_score"])); ?></td><td>&nbsp;<?php echo (get_shop_cate_name($deal["shop_cate_id"])); ?></td><td>&nbsp;<?php echo (format_max_bought($deal["max_bought"])); ?></td><td>&nbsp;<?php echo (get_real_buy_count($deal["id"])); ?></td><td>&nbsp;<?php echo (get_sort($deal["sort"],$deal['id'])); ?></td><td> <?php echo (get_coupon($deal["id"])); ?>&nbsp;<a href="javascript:edit_goods('<?php echo ($deal["id"]); ?>')"><?php echo L("EDIT");?></a>&nbsp;<a href="javascript: del('<?php echo ($deal["id"]); ?>')"><?php echo L("DEL");?></a>&nbsp;<a href="javascript: preview('<?php echo ($deal["id"]); ?>')"><?php echo L("PREVIEW");?></a>&nbsp; <?php echo (show_attr_stock($deal["id"],$name)); ?>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td colspan="9" class="bottomTd"> &nbsp;</td></tr></table>
<!-- Think 系统列表组件结束 -->

<?php elseif($type==4): ?>
    <!-- Think 系统列表组件开始 -->
<table id="dataTable" class="dataTable" cellpadding=0 cellspacing=0 ><tr><td colspan="9" class="topTd" >&nbsp; </td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px   "><a href="javascript:sortBy('id','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("ID");?><?php echo ($sortType); ?> "><?php echo L("ID");?><?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("GOODS_NAME");?><?php echo ($sortType); ?> "><?php echo L("GOODS_NAME");?><?php if(($order)  ==  "name"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('current_price','<?php echo ($sort); ?>','Deal','shop')" title="按照价格   <?php echo ($sortType); ?> ">价格   <?php if(($order)  ==  "current_price"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('shop_cate_id','<?php echo ($sort); ?>','Deal','shop')" title="按照分类   <?php echo ($sortType); ?> ">分类   <?php if(($order)  ==  "shop_cate_id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('supplier_id','<?php echo ($sort); ?>','Deal','shop')" title="按照商家         <?php echo ($sortType); ?> ">商家         <?php if(($order)  ==  "supplier_id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','Deal','shop')" title="按照总销量   <?php echo ($sortType); ?> ">总销量   <?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('sort','<?php echo ($sort); ?>','Deal','shop')" title="按照<?php echo L("SORT");?><?php echo ($sortType); ?> "><?php echo L("SORT");?><?php if(($order)  ==  "sort"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deal): ++$i;$mod = ($i % 2 )?><tr class="row" ><td><input type="checkbox" name="key" class="key" value="<?php echo ($deal["id"]); ?>"></td><td>&nbsp;<?php echo ($deal["id"]); ?></td><td>&nbsp;<a href="javascript:edit_goods   ('<?php echo (addslashes($deal["id"])); ?>')"><?php echo (msubstr_name($deal["name"])); ?></a></td><td>&nbsp;<?php echo (number_format($deal["current_price"],2)); ?></td><td>&nbsp;<?php echo (get_shop_cate_name($deal["shop_cate_id"])); ?></td><td>&nbsp;<?php echo (get_supplier_name($deal["supplier_id"])); ?></td><td>&nbsp;<?php echo (get_real_buy_count($deal["id"])); ?></td><td>&nbsp;<?php echo (get_sort($deal["sort"],$deal['id'])); ?></td><td> <?php echo (get_coupon($deal["id"])); ?>&nbsp;<a href="javascript:edit_goods('<?php echo ($deal["id"]); ?>')"><?php echo L("EDIT");?></a>&nbsp;<a href="javascript: del('<?php echo ($deal["id"]); ?>')"><?php echo L("DEL");?></a>&nbsp;<a href="javascript: preview('<?php echo ($deal["id"]); ?>')"><?php echo L("PREVIEW");?></a>&nbsp; <?php echo (show_attr_stock($deal["id"],$name)); ?>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td colspan="9" class="bottomTd"> &nbsp;</td></tr></table>
<!-- Think 系统列表组件结束 --><?php endif; ?>
<div class="blank5"></div>
<div class="page"><?php echo ($page); ?></div>
</div>
</body>
</html>