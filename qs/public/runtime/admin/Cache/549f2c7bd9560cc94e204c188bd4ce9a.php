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
	<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/index_main.css" />
	<script type="text/javascript" src="__TMPL__Common/js/jquery.js"></script>
	<script type="text/javascript" src="__TMPL__Common/js/swfobject.js"></script>
	<script type="text/javascript" src="__TMPL__Common/js/script.js"></script>
	<script type="text/javascript" src="__TMPL__Common/js/main.js"></script>
</head>

<body>
<div class="main">
	<div class="main_title"><?php echo conf("APP_NAME");?><?php echo l("ADMIN_PLATFORM");?> <?php echo L("HOME");?>	</div>
	<div class="notify_box">
		<div class="index-main-contents">
			<div class="list-box">
				<div class="item-title"><span>待处理</span></div>
				<div class="item-box">
					<div class="item-info">
						<dl>
							<dt class="item-info-name">自营订单</dt>
							<dd class="item-info-content">
								<a class="clearfix" href="<?php echo u("DealOrder/selfOrder",array("delivery_status"=>4,"type"=>3));?>">
									<span class="info-label">待发货</span>
									<span class="info-link-value"><?php echo ($shop_count); ?></span>
								</a>
							</dd>
							<dd class="item-info-content">
								<a class="clearfix" href="<?php echo u("DealOrder/selfOrder",array("refund_status"=>1,"type"=>3));?>">
								<span class="info-label">退款申请</span>
								<span class="info-link-value"><?php echo ($shop_refund_status_count); ?></span>
								</a>
							</dd>
						</dl>
					</div>
				</div>
				<div class="item-box">
					<div class="item-info">
						<dl>
							<dt class="item-info-name">积分订单</dt>
							<dd class="item-info-content">
								<a class="clearfix" href="<?php echo u("DealOrder/scoresOrder",array("delivery_status"=>0,"type"=>2));?>">
								<span class="info-label">待发货</span>
								<span class="info-link-value"><?php echo ($shop_score_status_count); ?></span>
								</a>
							</dd>
						</dl>
					</div>
				</div>
				<div class="item-box">
					<div class="item-info">
						<dl>
							<dt class="item-info-name">团购订单</dt>
							<dd class="item-info-content">
								<a class="clearfix" href="<?php echo u("DealOrder/tuanOrder",array("refund_status"=>1,"type"=>5,"is_supplier"=>1));?>">
								<span class="info-label">退款申请</span>
								<span class="info-link-value"><?php echo ($tuan_refund_status_count); ?></span>
								</a>
							</dd>
						</dl>
					</div>
				</div>
				<div class="item-box">
					<div class="item-info">
						<dl>
							<dt class="item-info-name">商城订单</dt>
							<dd class="item-info-content">
								<a class="clearfix" href="<?php echo u("DealOrder/shopOrder",array("delivery_status"=>4,"type"=>6,"is_supplier"=>1));?>">
								<span class="info-label">待发货</span>
								<span class="info-link-value"><?php echo ($supplier_shop_count); ?></span>
								</a>
							</dd>
							<dd class="item-info-content">
								<a class="clearfix" href="<?php echo u("DealOrder/shopOrder",array("refund_status"=>1,"type"=>6,"is_supplier"=>1));?>">
									<span class="info-label">退款申请</span>
									<span class="info-link-value"><?php echo ($supplier_shop_refund_status_count); ?></span>
								</a>
							</dd>
						</dl>
					</div>
				</div>
			</div>
			<div class="blank5"></div>
			<div class="list-box">
				<div class="item-title-box">
					<div class="item-title" ><span>待审核/点评</span></div>
				</div>

				<div class="item-box">
					<div class="item-info">
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("User/withdrawal_index",array("is_paid"=>0));?>">
								<span class="info-label">会员提现</span>
								<span class="info-link-value"><?php echo ($user_withdraw_count); ?></span>
							</a>
						</div>
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("Supplier/charge_index",array("status"=>0));?>">
								<span class="info-label">商家提现</span>
								<span class="info-link-value"><?php echo ($supplier_withdraw_count); ?></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item-box">
					<div class="item-info">
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("Deal/tuan_publish",array("admin_check_status"=>3,"status"=>0));?>">
								<span class="info-label">待审团购</span>
								<span class="info-link-value"><?php echo ($supplier_tuan_check_count); ?></span>
							</a>
						</div>
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("Deal/shop_publish",array("admin_check_status"=>3,"status"=>0));?>">
								<span class="info-label">待审商品</span>
								<span class="info-link-value"><?php echo ($supplier_shop_check_count); ?></span>
							</a>
						</div>
					</div>

				</div>
				<div class="item-box">
					<div class="item-info">
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("SupplierSubmit/index",array("is_publish"=>0));?>">
								<span class="info-label">待审商家</span>
								<span class="info-link-value"><?php echo ($supplier_check_count); ?></span>
							</a>
						</div>
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("SupplierLocation/publish",array("admin_check_status"=>0));?>">
							<span class="info-label">待审门店</span>
							<span class="info-link-value"><?php echo ($supplier_location_check_count); ?></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item-box">
					<div class="item-info">
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("SupplierLocationDp/index");?>">
								<span class="info-label">点评总数</span>
								<span class="info-link-value"><?php echo ($dp_count); ?></span>
							</a>
						</div>
						<div class="item-info-content">
							<a class="clearfix" href="<?php echo u("SupplierLocationDp/index",array("wait_reply"=>1));?>">
								<span class="info-label">待回复数</span>
								<span class="info-link-value"><?php echo ($dp_wait_count); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="blank5"></div>
	<div class="blank5"></div>
	<div class="blank5"></div>
	<div class="blank5"></div>
	<div class="main_title">最近30天运营数据</div>
	<table width=100%>

		<tr>
			<td width=10>&nbsp;</td>
			<td width=50%>
				<div id="sale_line_data_chart"></div>
			</td>
			<td width=10>&nbsp;</td>
			<td width=50%>
				<div id="sale_refund_data_chart"></div>
			</td>
			<td width=10>&nbsp;</td>
		</tr>
	</table>
</div>
</body>
</html>