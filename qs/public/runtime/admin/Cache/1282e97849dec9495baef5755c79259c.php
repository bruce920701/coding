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
<script type="text/javascript" src="__TMPL__Common/js/user.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/weebox.css" />
<?php function get_user_group($group_id)
	{
		$group_name = M("UserGroup")->where("id=".$group_id)->getField("name");
		if($group_name)
		{
			return $group_name;
		}
		else
		{
			return l("NO_GROUP");
		}
	}
	function get_user_level($id)
	{
		$level_name = M("UserLevel")->where("id=".$id)->getField("name");
		if($level_name)
		{
			return $level_name;
		}
		else
		{
			return "没有等级";
		}
	}
	function get_referrals_name($user_id)
	{
		$user_name = M("User")->where("id=".$user_id)->getField("user_name");
		if($user_name)
		return $user_name;
		else
		return l("NO_REFERRALS");
	}
	function get_region_conf_name($id){
	    $name= M("DeliveryRegion")->where("id=".$id)->getField("name");
	    if($name){
	         return $name;
	    }else{
	         return "未填写";
	    }
	}
    function get_agency_name($id)
    {
        if($id){
             return $agency_name=M("Agency")->where("id=".$id)->getField("name");
        }else{
             return "无";
        }

    } ?>
<div class="main">
<div class="main_title"><?php echo ($main_title); ?></div>
<div class="blank5"></div>
<div class="button_row">
	<input type="button" class="button" value="<?php echo L("ADD");?>" onclick="add();" />
	<input type="button" class="button" value="<?php echo L("DEL");?>" onclick="del();" />
</div>

<div class="blank5"></div>
<div class="search_row">
	<form name="search" action="__APP__" method="get">	
		<?php echo L("USER_NAME");?>：<input type="text" class="textbox" name="user_name" value="<?php echo strim($_REQUEST['user_name']);?>" style="width:100px;" />
		<?php echo L("USER_EMAIL");?>：<input type="text" class="textbox" name="email" value="<?php echo strim($_REQUEST['email']);?>" style="width:100px;" />
		<?php echo L("USER_MOBILE");?>：<input type="text" class="textbox" name="mobile" value="<?php echo strim($_REQUEST['mobile']);?>" style="width:100px;" />
		<?php echo L("REFERRALS_NAME");?>：<input type="text" class="textbox" name="pid_name" value="<?php echo strim($_REQUEST['pid_name']);?>" style="width:100px;" />
		<?php echo L("USER_GROUP");?>: 
		<select name="group_id">
				<option value="0" <?php if(intval($_REQUEST['group_id']) == 0): ?>selected="selected"<?php endif; ?>><?php echo L("ALL");?></option>
				<?php if(is_array($group_list)): foreach($group_list as $key=>$group_item): ?><option value="<?php echo ($group_item["id"]); ?>" <?php if(intval($_REQUEST['group_id']) == $group_item['id']): ?>selected="selected"<?php endif; ?>><?php echo ($group_item["name"]); ?></option><?php endforeach; endif; ?>
		</select>
		实名认证: 
		<select name="is_id_validate">
				<option value="0" <?php if(intval($_REQUEST['is_id_validate']) == 0): ?>selected="selected"<?php endif; ?>>所有</option>
				<option value="-1" <?php if(intval($_REQUEST['is_id_validate']) == -1): ?>selected="selected"<?php endif; ?>>未认证</option>
				<option value="2" <?php if(intval($_REQUEST['is_id_validate']) == 2): ?>selected="selected"<?php endif; ?>>待认证</option>
				<option value="1" <?php if(intval($_REQUEST['is_id_validate']) == 1): ?>selected="selected"<?php endif; ?>>已认证</option>
				<option value="3" <?php if(intval($_REQUEST['is_id_validate']) == 3): ?>selected="selected"<?php endif; ?>>已拒绝</option>
		</select>

		报单状态:
		<select name="bdzx_status">
			<option checked value="-1" <?php if(intval($_REQUEST['bdzx_status']) == -1): ?>selected="selected"<?php endif; ?>> 所有</option>
			<option value="0" <?php if(intval($_REQUEST['bdzx_status']) == 0): ?>selected="selected"<?php endif; ?>>未申请</option>
			<option value="1" <?php if(intval($_REQUEST['bdzx_status']) == 1): ?>selected="selected"<?php endif; ?>>待认证</option>
			<option value="2" <?php if(intval($_REQUEST['bdzx_status']) == 2): ?>selected="selected"<?php endif; ?>>已认证</option>
			<option value="3" <?php if(intval($_REQUEST['bdzx_status']) == 3): ?>selected="selected"<?php endif; ?>>已拒绝</option>
		</select>

		
		<input type="hidden" value="User" name="m" />
		<input type="hidden" value="index" name="a" />
		<input type="submit" class="button" value="<?php echo L("SEARCH");?>" />
		<input type="button" class="button" value="<?php echo L("EXPORT");?>" onclick="export_csv();" />
	</form>
</div>
<div class="blank5"></div>
<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="dataTable" cellpadding=0 cellspacing=0 ><tr><td colspan="18" class="topTd" >&nbsp; </td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px"><a href="javascript:sortBy('id','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("ID");?><?php echo ($sortType); ?> "><?php echo L("ID");?><?php if(($order)  ==  "id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('user_name','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("USER_NAME");?><?php echo ($sortType); ?> "><?php echo L("USER_NAME");?><?php if(($order)  ==  "user_name"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('email','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("USER_EMAIL");?><?php echo ($sortType); ?> "><?php echo L("USER_EMAIL");?><?php if(($order)  ==  "email"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('city_id','<?php echo ($sort); ?>','User','index')" title="按照城市<?php echo ($sortType); ?> ">城市<?php if(($order)  ==  "city_id"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('mobile','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("USER_MOBILE");?><?php echo ($sortType); ?> "><?php echo L("USER_MOBILE");?><?php if(($order)  ==  "mobile"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('register_credits','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("USER_REGISTER_CREDITS");?><?php echo ($sortType); ?> "><?php echo L("USER_REGISTER_CREDITS");?><?php if(($order)  ==  "register_credits"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('avalible_benefit_credits','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("USER_BENEFIT_CREDITS");?><?php echo ($sortType); ?> "><?php echo L("USER_BENEFIT_CREDITS");?><?php if(($order)  ==  "avalible_benefit_credits"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('avalible_consume_credits','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("USER_CONSUME_CREDITS");?><?php echo ($sortType); ?> "><?php echo L("USER_CONSUME_CREDITS");?><?php if(($order)  ==  "avalible_consume_credits"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('active_code','<?php echo ($sort); ?>','User','index')" title="按照激活码数目<?php echo ($sortType); ?> ">激活码数目<?php if(($order)  ==  "active_code"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('active','<?php echo ($sort); ?>','User','index')" title="按照是否激活<?php echo ($sortType); ?> ">是否激活<?php if(($order)  ==  "active"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('user_level','<?php echo ($sort); ?>','User','index')" title="按照会员等级<?php echo ($sortType); ?> ">会员等级<?php if(($order)  ==  "user_level"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('pid','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("REFERRALS_NAME");?><?php echo ($sortType); ?> "><?php echo L("REFERRALS_NAME");?><?php if(($order)  ==  "pid"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('create_time','<?php echo ($sort); ?>','User','index')" title="按照注册时间<?php echo ($sortType); ?> ">注册时间<?php if(($order)  ==  "create_time"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('login_time','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("LOGIN_TIME");?><?php echo ($sortType); ?> "><?php echo L("LOGIN_TIME");?><?php if(($order)  ==  "login_time"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('is_effect','<?php echo ($sort); ?>','User','index')" title="按照<?php echo L("IS_EFFECT");?><?php echo ($sortType); ?> "><?php echo L("IS_EFFECT");?><?php if(($order)  ==  "is_effect"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('bdzx_status','<?php echo ($sort); ?>','User','index')" title="按照报单状态<?php echo ($sortType); ?> ">报单状态<?php if(($order)  ==  "bdzx_status"): ?><img src="__TMPL__Common/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): ++$i;$mod = ($i % 2 )?><tr class="row" ><td><input type="checkbox" name="key" class="key" value="<?php echo ($user["id"]); ?>"></td><td>&nbsp;<?php echo ($user["id"]); ?></td><td>&nbsp;<a href="javascript:edit('<?php echo (addslashes($user["id"])); ?>')"><?php echo ($user["user_name"]); ?></a></td><td>&nbsp;<?php echo ($user["email"]); ?></td><td>&nbsp;<?php echo (get_region_conf_name($user["city_id"])); ?></td><td>&nbsp;<?php echo ($user["mobile"]); ?></td><td>&nbsp;<?php echo ($user["register_credits"]); ?></td><td>&nbsp;<?php echo ($user["avalible_benefit_credits"]); ?></td><td>&nbsp;<?php echo ($user["avalible_consume_credits"]); ?></td><td>&nbsp;<?php echo ($user["active_code"]); ?></td><td>&nbsp;<?php echo ($user["active"]); ?></td><td>&nbsp;<?php echo ($user["user_level"]); ?></td><td>&nbsp;<?php echo (get_referrals_name($user["pid"])); ?></td><td>&nbsp;<?php echo (to_date($user["create_time"])); ?></td><td>&nbsp;<?php echo (to_date($user["login_time"])); ?></td><td>&nbsp;<?php echo (get_is_effect($user["is_effect"],$user['id'])); ?></td><td>&nbsp;<?php echo ($user["bdzx_status"]); ?></td><td><a href="javascript:edit('<?php echo ($user["id"]); ?>')"><?php echo L("EDIT");?></a>&nbsp;<a href="javascript: del('<?php echo ($user["id"]); ?>')"><?php echo L("DEL");?></a>&nbsp;<a href="javascript: account('<?php echo ($user["id"]); ?>')"><?php echo L("USER_ACCOUNT");?></a>&nbsp;<a href="javascript:account_detail('<?php echo ($user["id"]); ?>')"><?php echo L("USER_ACCOUNT_DETAIL");?></a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td colspan="18" class="bottomTd"> &nbsp;</td></tr></table>
<!-- Think 系统列表组件结束 -->


<div class="blank5"></div>
<div class="page"><?php echo ($page); ?></div>
</div>
<!--</body>
</html>-->

<!--
	show="id:<?php echo L("ID");?>|50px,user_name:<?php echo L("USER_NAME");?>:edit,agency_id|get_agency_name:所属代理商,email:<?php echo L("USER_EMAIL");?>,city_id|get_region_conf_name:城市,mobile:<?php echo L("USER_MOBILE");?>,money|format_price:<?php echo L("USER_MONEY");?>,score|format_score:<?php echo L("USER_SCORE");?>,frozen_score|format_score:冻结积分,total_score|format_score:累积积分,point:经验,group_id|get_user_group:<?php echo L("USER_GROUP");?>,level_id|get_user_level:会员等级,pid|get_referrals_name:<?php echo L("REFERRALS_NAME");?>,create_time|to_date:注册时间,login_time|to_date:<?php echo L("LOGIN_TIME");?>,is_effect|get_is_effect=$user['id']:<?php echo L("IS_EFFECT");?>"

-->