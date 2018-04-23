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

<?php function foreverdel_carriage_template($id)
	{
		if(M("CarriageTemplate")->where("id=".$id)->getField("supplier_id")==0)
		{
			return "<a href='".u("CarriageTemplate/foreverdelete",array("id"=>$id))."'>".l("删除")."</a>";
		}else{
			return "";
		}
	}
	function carriage_template_edit($id)
	{
		if(M("CarriageTemplate")->where("id=".$id)->getField("supplier_id")==0)
		{
			return "<a href='".u("CarriageTemplate/edit",array("id"=>$id))."'>".l("编辑")."</a>";
		}else{
			return "";
		}
	} ?>
<script>
 $(document).ready(function(){
     $(".deleteButton").bind("click",function(){
         var href=$(this).attr("data-href");
         if(confirm("确认删除该模板？")){
             $.get(href,"",function(da){
                 window.location.reload();
             },"json");
         }
     });
 });
</script>
<div class="main">
<div class="main_title"><?php echo ($main_title); ?></div>
<div class="blank5"></div>
<div class="button_row">
	<form name="search" action="__APP__" method="get">
    <div style="margin-bottom: 5px;">
        <input type="button" class="button" value="新建模板" onclick="add();" />
    </div>
	<div class="search_row">
        <input type="text" class="" placeholder="模板名称" name="name"/>
        <select name="valuation_type" class="">
            <option value="0">请选择计价方式</option>
            <option value="1">按件数</option>
            <option value="2">按重量</option>
            <option value="3">包邮</option>
        </select>
        <input type="hidden" value="CarriageTemplate" name="m" />
        <input type="hidden" value="index" name="a" />
        <input type="submit" class="button" value="<?php echo L("SEARCH");?>" />
	</div>

	</form>
</div>
    <?php if($list): ?><?php if(is_array($list)): foreach($list as $key=>$row): ?><div class="comments_details">
        <table class="table_box dataTable" style="margin-top: 10px;">
            <thead>
            <tr class="row" >
                <th width="10%">模板名称:<?php echo ($row["name"]); ?></th>
                <th width="50%" style="text-align: center;">计价方式:<?php if($row['carriage_type']==2): ?>包邮<?php elseif($row['valuation_type']==1): ?>按件数<?php elseif($row['valuation_type']==2): ?>按重量<?php endif; ?></th>
                <th colspan="4" style="text-align: right; padding-right: 15px;">
                    <a class="blue " href="<?php echo u("CarriageTemplate/edit",array("id"=>$row['id']));?>">修改</a>&nbsp;|&nbsp;
                    <a class="blue deleteButton " href="javascript:void(0);" data-href="<?php echo u("CarriageTemplate/foreverdelete",array("id"=>$row['id']));?>">删除</a>
                </th>
            </tr>
            </thead>
            <tbody>

            <tr class="row">
                <td width="10%">
                    运送方式
                </td>
                <td width="50%">
                    运送到
                </td>
                <td width="10%">
                    <?php if($row['valuation_type']==2): ?>首重(kg)<?php else: ?> 首件(件)<?php endif; ?>
                </td>
                <td width="10%">
                    运费(元)
                </td>
                <td width="10%">
                    <?php if($row['valuation_type']==2): ?>续重(kg)<?php else: ?>续件(件)<?php endif; ?>
                </td>
                <td width="10%">
                    续费(元)
                </td>
            </tr>
            <?php if($row['carriage_type']==2): ?><tr>
                    <td>
                        快递
                    </td>
                    <td>
                        全国
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        0.00
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        0.0
                    </td>
                </tr>
            <?php else: ?>
            <?php if(is_array($row["carriage_detail_data"])): foreach($row["carriage_detail_data"] as $key=>$item): ?><tr class="row">
                    <td>
                        <?php if($row['tpl_type']==1): ?>快递<?php else: ?>其他<?php endif; ?>
                    </td>
                    <td>
                        <?php if(!$item['region_ids']): ?>全国<?php else: ?><?php echo ($item["show_city_name"]); ?><?php endif; ?>
                    </td>
                    <td>
                        <?php echo ($item["express_start"]); ?>
                    </td>
                    <td>
                        <?php echo ($item["express_postage"]); ?>
                    </td>
                    <td>
                        <?php echo ($item["express_plus"]); ?>
                    </td>
                    <td>
                        <?php echo ($item["express_postage_plus"]); ?>
                    </td>
                </tr><?php endforeach; endif; ?><?php endif; ?>
            </tbody>
        </table>
    </div><?php endforeach; endif; ?>
    <div class="blank"></div>
    <div class="page">
        <?php echo ($page); ?>
    </div>
    <?php else: ?>
        <div class="comments_details">
            <table class="table_box dataTable">
                <tr style="text-align: center;"><td>无数据</td></tr>
            </table>
        </div><?php endif; ?>
</div>
</body>
</html>