<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo conf("APP_NAME");?><?php echo l("ADMIN_PLATFORM");?></title>
<script type="text/javascript" src="__ROOT__/public/runtime/admin/lang.js"></script>
<script type="text/javascript">
	var version = '<?php echo app_conf("DB_VERSION");?>';
	var app_type = '<?php echo ($apptype); ?>';
	var ofc_swf = '__TMPL__Common/js/open-flash-chart.swf';
	var sale_line_data_url = '<?php echo urlencode(u("Ofc/sale_line"));?>';
	var sale_refund_data_url = '<?php echo urlencode(u("Ofc/sale_refund"));?>';
</script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/style.css" />
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/main.css" />
<script type="text/javascript" src="__TMPL__Common/js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/swfobject.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/script.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/main.js"></script>
</head>

<body>
	<div class="main">
	<div class="main_title"><?php echo conf("APP_NAME");?><?php echo l("ADMIN_PLATFORM");?> <?php echo L("HOME");?>	</div>
	<div class="notify_box">
		<table>
			<tr>
			<td class="version_box">
				<table>
					<tr><td>
						当前版本：<?php echo conf("DB_VERSION");?><?php if(app_conf("APP_SUB_VER")){ ?>.<?php echo app_conf("APP_SUB_VER");?><?php } ?><br />
						<div id="version_tip"></div>
					</td></tr>
				</table>
			</td><!--version_box 版本提示-->
			<td class="order_box">
				<table>
					<tr><td>
						订单累计 无权限查看
					</td></tr>
				</table>
			</td><!--order_box 订单提醒-->
			<td class="user_box">
				<table>
					<tr><td>
						平台会员总数  无权限查看
					</td></tr>
				</table>
			</td><!--user_box 会员提醒-->
			<td class="tuan_box">
				<table>
					<tr><td>
						上线的团购数   无权限查看
					</td></tr>
				</table>
			</td><!--tuan_box 团购提醒-->
			</tr>
			
			<tr>
			<td class="shop_box">
				<table>
					<tr><td>
						上线的商品数   无权限查看
					</td></tr>
				</table>
			</td><!--shop_box 商城提醒-->
			<td class="youhui_box">
				<table>
					<tr><td>
						上线的优惠券数   无权限查看
					</td></tr>
				</table>
			</td><!--youhui_box 优惠券提醒-->
			<td class="event_box">
				<table>
					<tr><td>
						上线的活动数  无权限查看
					</td></tr>
				</table>
			</td><!--event_box 活动提醒-->
			<td class="store_box">
				<table>
					<tr><td>
						平台共入驻商户  无权限查看
					</td></tr>
				</table>
			</td><!--store_box 门店提醒-->
			</tr>
		</table>
	</div>	

	</div>
</body>
</html>