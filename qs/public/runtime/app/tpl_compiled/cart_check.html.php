<?php
//本页不引用header.html， 直接在页面内编写单独header
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/cart_list.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/cart_check.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/cart_check_new.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/cart_check.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/cart_check.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_consignee.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_consignee.js";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" />

<?php 
$k = array (
  'name' => 'load_compatible',
);
echo $k['name']();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_var['page_title']): ?><?php echo $this->_var['page_title']; ?> - <?php endif; ?><?php echo $this->_var['site_seo']['title']; ?></title>
<meta name="keywords" content="<?php if ($this->_var['page_keyword']): ?><?php echo $this->_var['page_keyword']; ?><?php else: ?><?php echo $this->_var['site_seo']['keyword']; ?><?php endif; ?>" />
<meta name="description" content="<?php if ($this->_var['page_description']): ?><?php echo $this->_var['page_description']; ?><?php else: ?><?php echo $this->_var['site_seo']['description']; ?><?php endif; ?>" />
<script type="text/javascript">
var APP_ROOT = '<?php echo $this->_var['APP_ROOT']; ?>';
var CART_URL = '<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>';
var CART_CHECK_URL = '<?php
echo parse_url_tag("u:index|cart#check|"."".""); 
?>';
<?php if (app_conf ( "APP_MSG_SENDER_OPEN" ) == 1): ?>
var send_span = <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SEND_SPAN',
);
echo $k['name']($k['v']);
?>000;
var IS_RUN_CRON = 1;
var DEAL_MSG_URL = '<?php
echo parse_url_tag("u:index|cron#deal_msg_list|"."".""); 
?>';
<?php endif; ?>
var AJAX_LOGIN_URL	= '<?php
echo parse_url_tag("u:index|user#ajax_login|"."".""); 
?>';
var AJAX_URL	= '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
var LOADER_IMG = '<?php echo $this->_var['TMPL']; ?>/images/loader_img.gif';
var order_id = <?php 
$k = array (
  'name' => 'intval',
  'value' => $this->_var['order_info']['id'],
);
echo $k['name']($k['value']);
?>;
var cart_check_url = '<?php
echo parse_url_tag("u:index|cart#check|"."id=".$this->_var['deal_id']."".""); 
?>';
</script>
<?php
//前台队列功能开启
if(app_conf("APP_MSG_SENDER_OPEN")==1)
{
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
}
?>
<script type="text/javascript" src="<?php echo $this->_var['APP_ROOT']; ?>/public/runtime/app/lang.js"></script>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['pagecss'],
);
echo $k['name']($k['v']);
?>" />
<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['pagejs'],
  'c' => $this->_var['cpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>
<script type="text/javascript" src="<?php echo $this->_var['APP_ROOT']; ?>/public/runtime/region.js"></script>
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=<?php 
$k = array (
  'name' => 'app_conf',
  'value' => 'BAIDU_MAP_APPKEY',
);
echo $k['name']($k['value']);
?>&s=1"></script>
</head>
<body>
<img src="<?php echo $this->_var['TMPL']; ?>/images/loader_img.gif" style="display:none;" /><!--延时加载的替代图片生成-->
<div class="top_nav">
	<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?>">
		<span class="f_l">欢迎来到<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SHOP_TITLE',
);
echo $k['name']($k['v']);
?></span>
		<span class="f_r">
			<ul class="head_tip">
				<li class="cart_tip" id="cart_tip"><?php 
$k = array (
  'name' => 'load_cart_count',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?></li>
				<li class="user_tip" id="head_user_tip"><?php 
$k = array (
  'name' => 'load_user_tip',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?></li>
			</ul>
		</span>
	</div>
</div><!--顶部横栏-->
<div class="blank15"></div>
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?> head_main">
	<div class="logo f_l">
	<a class="link" href="<?php echo $this->_var['APP_ROOT']; ?>/">
		<?php
			$this->_var['logo_image'] = app_conf("SHOP_LOGO");
		?>
		<?php 
$k = array (
  'name' => 'load_page_png',
  'v' => $this->_var['logo_image'],
);
echo $k['name']($k['v']);
?>
	</a>
	</div>
	<div class="cart_step f_r">
		<ul>
			<li>1. 提交订单</li>
			<li class="current">2. 选择支付方式</li>
			<li>3. 购买成功</li>
		</ul>
	</div>
</div><!--logo与头部搜索-->

<div class="blank20"></div>
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?>">

<form name="cart_form" id="cart_form" action="<?php if ($this->_var['order_info']): ?><?php
echo parse_url_tag("u:index|cart#order_done|"."".""); 
?><?php else: ?><?php
echo parse_url_tag("u:index|cart#done|"."".""); 
?><?php endif; ?>" method="post">

<?php if ($this->_var['is_delivery']): ?>
<!-- 配送地址 -->
<div class="info-bar">
	<?php if (! $this->_var['order_info']): ?>
	<a href='javascript:consignee_operation("<?php
echo parse_url_tag("u:index|ajax#load_consignee|"."is_open=1&deal_id=".$this->_var['deal_id']."".""); 
?>");' class="add-address">新增地址</a>
	<?php endif; ?>
	<p>配送信息</p>
</div>
<div class="logistics-info">
	<ul class="address-list">
		<?php if ($this->_var['consignee_list']): ?>
		<?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['consignee']):
?>
		<li <?php if ($this->_var['consignee']['consignee_info']['id'] == $this->_var['consignee_id']): ?>class="selected"<?php endif; ?> rel_address="<?php echo $this->_var['consignee']['consignee_info']['id']; ?>" rel_region="<?php echo $this->_var['consignee']['consignee_info']['region_lv4']; ?>">
			<div class="user-name"><span class="name"><?php echo $this->_var['consignee']['consignee_info']['consignee']; ?></span><div class="select-ico"></div></div>
			<p class="address-info"><span class="j-user-info"><?php echo $this->_var['consignee']['consignee_info']['consignee']; ?> <?php echo $this->_var['consignee']['consignee_info']['mobile']; ?> </span><span class="j-address"><?php echo $this->_var['consignee']['consignee_info']['full_address']; ?></span></p>
			<?php if ($this->_var['consignee']['consignee_info']['is_default'] == 1): ?><span class="defualt f_l">[默认地址]</span><?php endif; ?>
			<div class="address-edit f_r">
				<?php if ($this->_var['consignee']['consignee_info']['is_default'] != 1): ?><a href="javascript:void(0);" class="default" dfurl='<?php
echo parse_url_tag("u:index|uc_consignee#set_default|"."id=".$this->_var['consignee']['consignee_info']['id']."".""); 
?>'>设为默认</a><?php endif; ?>
				<?php if (! $this->_var['order_info']): ?>
				<a href='javascript:consignee_operation("<?php
echo parse_url_tag("u:index|ajax#load_consignee|"."is_open=1&id=".$this->_var['consignee']['consignee_info']['id']."&deal_id=".$this->_var['deal_id']."".""); 
?>",1);' >编辑</a><a href="javascript:void(0);" class="del" url='<?php
echo parse_url_tag("u:index|uc_consignee#del|"."id=".$this->_var['consignee']['consignee_info']['id']."".""); 
?>'>删除</a>
				<?php endif; ?>
			</div>
		</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php else: ?>
		 <p style="color: #666;text-decoration: none;">暂无收货地址，<a href='javascript:consignee_operation("<?php
echo parse_url_tag("u:index|ajax#load_consignee|"."is_open=1&deal_id=".$this->_var['deal_id']."".""); 
?>",0);' class="add-address" style="color: #0b5394;">马上添加</a></p>
		<?php endif; ?>
		<input type="hidden" value="<?php echo $this->_var['region_id']; ?>" name="region_id">
		<input type="hidden" value="<?php echo $this->_var['consignee_id']; ?>" name="address_id">
	</ul>
	<?php if (! $this->_var['order_info']): ?>
	<?php if ($this->_var['consignee_list'] && $this->_var['consignee_count'] > 1): ?>
	<div class="more-info"><a href="javascript:void(0);" class="more-address">更多地址<i class="iconfont">&#xe647;</i></a><a href="javascript:void(0);" class="close-address">收起地址<i class="iconfont">&#xe648;</i></a></div>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ($this->_var['is_pick'] == 1 && $this->_var['location']): ?>
	<ul class="shop-list">
		<?php $_from = $this->_var['location']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'location_item');$this->_foreach['location_item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['location_item']['total'] > 0):
    foreach ($_from AS $this->_var['location_item']):
        $this->_foreach['location_item']['iteration']++;
?>
		<li rel="<?php echo $this->_var['location_item']['id']; ?>">
			<div class="user-name"><span class="name"><?php if (($this->_foreach['location_item']['iteration'] - 1) == 0): ?><div class="recom-shop-ico"></div><?php endif; ?>到店自提</span><div class="select-ico"></div></div>
			<p class="address-info"><?php echo $this->_var['location_item']['name']; ?>　<?php echo $this->_var['location_item']['address']; ?></p>
		</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<input type="hidden" <?php if ($this->_var['location']): ?>value="<?php echo $this->_var['location_item']['0']['id']; ?>"<?php else: ?>value="0"<?php endif; ?> name="location_id">
	</ul>
	<?php if (! $this->_var['order_info']): ?>
	<div class="more-info"><a href="javascript:void(0);" class="more-shop">更多门店<i class="iconfont">&#xe647;</i></a><a href="javascript:void(0);" class="close-shop">收起门店<i class="iconfont">&#xe648;</i></a></div>
	<?php endif; ?>
	<?php else: ?>
		<input type="hidden" value="0" name="location_id">
	<?php endif; ?>
</div>
<?php endif; ?>
<!-- 订单信息 -->
<div class="info-bar">
	<p>订单信息</p>
</div>
<ul class="order-hd">
	<li class="order-info">商品信息</li>
	<li class="order-price">单价</li>
	<li class="order-num">数量</li>
	<li class="order-count">总计</li>
</ul>
<div class="order-detail">
	<?php $_from = $this->_var['cart_list_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cart_item_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['cart_item_group']):
?>
	<div class="order-detail-hd"><?php echo $this->_var['cart_item_group']['supplier']; ?></div>
	<?php $_from = $this->_var['cart_item_group']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_item');if (count($_from)):
    foreach ($_from AS $this->_var['cart_item']):
?>
	<ul class="order-item">
		<li class="order-info">
			<div class="goods-img"><a href='<?php
echo parse_url_tag("u:index|deal|"."act=".$this->_var['cart_item']['deal_id']."".""); 
?>'><img src="<?php if ($this->_var['cart_item']['icon'] == ''): ?>public/images/no-image.png<?php else: ?><?php echo $this->_var['cart_item']['icon']; ?><?php endif; ?>" alt="商品图片" /></a></div>
			<div class="goods-info">
				<a href='<?php
echo parse_url_tag("u:index|deal|"."act=".$this->_var['cart_item']['deal_id']."".""); 
?>'><p class="goods-name"><?php echo $this->_var['cart_item']['name']; ?></p></a>
				<?php if ($this->_var['cart_item']['attr_str'] != ''): ?><p class="goods-type">规格：<?php echo $this->_var['cart_item']['attr_str']; ?></p><?php endif; ?>
			</div>
		</li>
		<li class="order-price"><span><?php if ($this->_var['cart_item']['buy_type'] == 1): ?> <?php echo $this->_var['cart_item']['return_score']; ?><?php else: ?><?php 
$k = array (
  'name' => 'abs',
  'a' => $this->_var['cart_item']['unit_price_format'],
);
echo $k['name']($k['a']);
?><?php endif; ?></span>积分</li>
		<li class="order-num"><?php echo $this->_var['cart_item']['number']; ?></li>
		<li class="order-count"><span><?php if ($this->_var['cart_item']['buy_type'] == 1): ?><?php echo $this->_var['cart_item']['return_total_score']; ?><?php else: ?><?php 
$k = array (
  'name' => 'abs',
  'a' => $this->_var['cart_item']['total_price_format'],
);
echo $k['name']($k['a']);
?><?php endif; ?></span>积分</li>
	</ul>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	<div class="order-tip">
		<?php if (! $this->_var['order_info']): ?>
		<input class="ui-textbox remark memo_<?php echo $this->_var['key']; ?>" type="text" name="memo[<?php echo $this->_var['key']; ?>]" holder="请输入您的备注" value="<?php echo $this->_var['order_info']['memo']; ?>" <?php if ($this->_var['order_info']): ?>readonly="true"<?php endif; ?> />
		<?php else: ?>
		<p class="memo_<?php echo $this->_var['key']; ?> f_l memo">备注：<?php echo $this->_var['order_info']['memo']; ?></p>
		<?php endif; ?>
		<?php if ($this->_var['order_info']): ?>
			<?php if ($this->_var['is_delivery']): ?>
			<p class="logistics-way f_r">运送方式：普通配送 快递
			<span class="price price_<?php echo $this->_var['key']; ?>">
			<?php if ($this->_var['order_info']['delivery_fee'] > 0): ?><?php echo $this->_var['cart_item_group']['delivery_fee']['total_fee']; ?>元<?php else: ?>包邮<?php endif; ?>
			</span>
			</p>
			<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_var['cart_item_group']['delivery_fee'] != - 1): ?>
			<p class="logistics-way f_r">运送方式：普通配送 快递
			<span class="price price_<?php echo $this->_var['key']; ?>">
			<?php echo $this->_var['cart_item_group']['delivery_fee']; ?>
			</span>
			</p>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	
	<div class="order-tip invoice-<?php echo $this->_var['key']; ?>">
		<?php if ($this->_var['order_info']['youhui_money'] > 0): ?>
			<div class="youhui_box f_r">
			<span class="f_l">店铺优惠：</span>
				<?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['cart_item_group']['youhui_money'],
);
echo $k['name']($k['v']);
?>元
			</div>
		<?php else: ?>
			<?php if ($this->_var['cart_item_group']['youhui_info']): ?>
			<div class="youhui_box f_r">
			<span class="f_l">店铺优惠：</span>
				<select name='youhui_log_id[<?php echo $this->_var['key']; ?>]' data_id="<?php echo $this->_var['key']; ?>" class='ui-select voucher_select'>
						<?php $_from = $this->_var['cart_item_group']['youhui_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'youhui');if (count($_from)):
    foreach ($_from AS $this->_var['youhui']):
?>
						
							<option value="<?php echo $this->_var['youhui']['id']; ?>"><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['youhui']['youhui_value'],
);
echo $k['name']($k['v']);
?>
							<?php if ($this->_var['youhui']['start_use_price'] == 0): ?>
							( 无限制 )
							<?php else: ?>
							( 满<?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['youhui']['start_use_price'],
);
echo $k['name']($k['v']);
?>可用 )
							<?php endif; ?>
							</option>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<option value="0">=不使用优惠券=</option>
				</select>
			
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php if (! $this->_var['order_info']): ?>
			<?php if ($this->_var['showInvoiceInfo']): ?>
			<?php if (! $this->_var['cart_item_group']['invoice_conf'] || $this->_var['cart_item_group']['invoice_conf']['invoice_type'] == 0): ?>
			<div class="f_l">
				<p>发票类型: 暂不支持开发票</p>
			</div>
			<?php else: ?>
			<div class="">
				<p><span>发票类型：</span>
				<label><input type="radio" class="invoice-type" name="invoice_type[<?php echo $this->_var['key']; ?>]" value="0" checked /><span>不开发票</span></label>
				<label><input type="radio" class="invoice-type" name="invoice_type[<?php echo $this->_var['key']; ?>]" value="1"/><span>普通发票</span></label></p>
			</div>
			<div class="iov-type" style="display: none;">
				<p><span>发票抬头：</span>
				<label><input type="radio" class="invoice-title" name="invoice_title[<?php echo $this->_var['key']; ?>]" value="0" checked />个人</label>
				<label><input type="radio" class="invoice-title company-title" name="invoice_title[<?php echo $this->_var['key']; ?>]" value="1"/>企业</label>
				</p>
			</div>
			<div class="iov-type" style="display: none;">
				<input class="iov-person ui-textbox" name="invoice_person[<?php echo $this->_var['key']; ?>]" type="text" placeholder="请输入开票人" style="width: 250px;" />
				<input style="display: none; width: 250px;" class="iov-tax ui-textbox" name="invoice_taxnu[<?php echo $this->_var['key']; ?>]" type="text" placeholder="请输入纳税人识别号，免税单位填0" />
			</div>
			<div class="iov-type" style="display: none;">
				<p><span>发票内容：</span>
				<?php $_from = $this->_var['cart_item_group']['invoice_conf']['invoice_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'content');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['content']):
?>
				<label><input type="radio" name="invoice_content[<?php echo $this->_var['key']; ?>]" value="<?php echo $this->_var['content']; ?>" <?php if ($this->_var['k'] == 0): ?>checked<?php endif; ?>/><?php echo $this->_var['content']; ?></label>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
			</div>
			<!-- <div class="iov-type" style="padding-left: 67px;">
				<div class="info-bar invoice-check-box" rel-num="0" style="display: none;"><label class="ui-checkbox" rel="common_cbo"><input type="checkbox" name="invoice_check" value="1" />已同意</label><a class="invoice_notice" style="color: red;">《发票须知》</a>
					<div class="ivon-content">
						<?php echo $this->_var['invoice_notice']; ?>
					</div>
				</div>
			</div> -->
			<?php endif; ?>
			<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_var['order_info']['invoice_info']): ?><div>发票类型: <?php echo $this->_var['order_info']['invoice_info']; ?></div><?php endif; ?>
		<?php endif; ?>
		
		
		
	</div>

	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
<!-- <div class="cart_row">
<div class="cart_table">

		<table>
			<tr>
				<th class="w_name">项目</th>
				<th class="w_unit">单价</th>
				<th class="w_num">数量</th>
				<th class="w_total">总价</th>
			</tr>
			<?php $_from = $this->_var['cart_list_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cart_item_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['cart_item_group']):
?>
			<?php if ($this->_var['cart_item_group']['supplier']): ?>
			<tr class="cart_supplier_title">
				<td colspan=2 class="tl"><?php echo $this->_var['cart_item_group']['supplier']; ?></td>
				<td colspan=2 class="tr"><span id="delivery_fee_<?php echo $this->_var['key']; ?>" class="supplier_delivery_fee"></span></td>
			</tr>
			<?php endif; ?>
			<?php $_from = $this->_var['cart_item_group']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_item');if (count($_from)):
    foreach ($_from AS $this->_var['cart_item']):
?>
				<tr rel="<?php echo $this->_var['cart_item']['id']; ?>">
					<td class="w_name">
						<div class="cart_img">
							<a href="<?php echo $this->_var['cart_item']['url']; ?>" target="_blank" title="<?php echo $this->_var['cart_item']['name']; ?>"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['cart_item']['icon'],
  'w' => '50',
  'h' => '50',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" alt="<?php echo $this->_var['cart_item']['name']; ?>"  style="width:50px;height:50px;" /></a>
						</div>
						<div class="cart_name">
							<a href="<?php echo $this->_var['cart_item']['url']; ?>" target="_blank" title="<?php echo $this->_var['cart_item']['name']; ?>"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['cart_item']['name'],
  'b' => '0',
  'e' => '70',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?></a>
						</div>
					</td>
					<td class="w_unit">
						<?php if ($this->_var['cart_item']['buy_type'] != 1): ?>
						&yen;<?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['cart_item']['unit_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?>
						<?php else: ?>
						<?php 
$k = array (
  'name' => 'abs',
  'v' => $this->_var['cart_item']['return_score'],
);
echo $k['name']($k['v']);
?>积分
						<?php endif; ?>
					</td>
					<td class="w_num">
						<?php echo $this->_var['cart_item']['number']; ?>
					</td>
					<td class="w_total">
						<?php if ($this->_var['cart_item']['buy_type'] != 1): ?>
						&yen;<span><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['cart_item']['total_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?></span>
						<?php else: ?>
						<span><?php 
$k = array (
  'name' => 'abs',
  'v' => $this->_var['cart_item']['return_total_score'],
);
echo $k['name']($k['v']);
?></span>积分
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</table>

</div>
</div> -->
<!--
	


	
	<div class="blank"></div>
	<?php if ($this->_var['is_delivery']): ?>
	<div id="consignee_info_box">
	<div class="cart_row layout_box">
		<div class="title">
			<div class="f_l"><?php
echo lang("CONSIGNEE_INFO"); 
?></div>
			<?php if ($this->_var['consignee_count'] > 1): ?>
			<div class="f_r modify_consignee"><a href="javascript:void(0);" id="modify_consignee">修改</a></div>
			<?php endif; ?>
		</div>
		<div class="content">
			<div id="cart_consignee" rel="<?php echo $this->_var['consignee_id']; ?>"></div>
		</div>
	</div>
	<div class="blank"></div>
	</div>
	<div class="cart_row layout_box">
		<div class="title"><?php echo $this->_var['LANG']['DELIVERY_INFO']; ?></div>
		<div class="content">
			<div id="cart_delivery"></div>
		</div>
	</div>
	<?php endif; ?>
	


	
	<div class="blank"></div>
	<div id="cart_memo">
	<div class="cart_row layout_box">
		<div class="title"><?php
echo lang("ORDER_MEMO"); 
?></div>
		<div class="content">
			<textarea id="memo" name="memo" class="ui-textbox" holder="选填：对本次交易的说明，建议先与客服咨询沟通"><?php echo $this->_var['order_info']['memo']; ?></textarea>
		</div>
	</div>
	</div>
	

 -->


<?php if ($this->_var['show_payment']): ?>
<div class="blank15"></div>
<div id="cart_payment" style="display: none;">
<div class="cart_row">
	<div class="title"><?php
echo lang("PAYMENT_INFO"); 
?></div>
	<div class="content">
		<?php if ($this->_var['bank_paylist']): ?>
		<?php $_from = $this->_var['bank_paylist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment_item');if (count($_from)):
    foreach ($_from AS $this->_var['payment_item']):
?>
			<?php echo $this->_var['payment_item']['display_code']; ?>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<div class="blank"></div>
		<?php endif; ?>
		<?php if ($this->_var['icon_paylist']): ?>
		<?php $_from = $this->_var['icon_paylist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment_item');if (count($_from)):
    foreach ($_from AS $this->_var['payment_item']):
?>
			<?php echo $this->_var['payment_item']['display_code']; ?>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<div class="blank"></div>
		<?php endif; ?>
		<?php $_from = $this->_var['disp_paylist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment_item');if (count($_from)):
    foreach ($_from AS $this->_var['payment_item']):
?>
			<?php echo $this->_var['payment_item']['display_code']; ?>
			<div class="blank"></div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</div>
</div>
</div>
<?php endif; ?>
<div id="cart_buy_total">
</div>
<?php if ($this->_var['cart_item']['buy_type'] == 0): ?>
<div class="balance" style="width: 100%;height: 45px;border-bottom: 1px solid #ddd;font-size: 16px;">可用注册积分为:
	<span style="display: inline-block;height: 45px;line-height: 45px;color: #f80;"><?php echo $this->_var['user_info']['register_credits']; ?></span>
	<big class="none" style="color: red;margin-left: 50px;">余额不足，无法购买!!!</big>
</div>
<?php endif; ?>
<?php if ($this->_var['cart_item']['buy_type'] == 1): ?>
<div class="balance" style="width: 100%;height: 45px;border-bottom: 1px solid #ddd;font-size: 16px;">可用消费积分为:
	<span style="display: inline-block;height: 45px;line-height: 45px;color: #f80;"><?php echo $this->_var['user_info']['avalible_consume_credits']; ?></span>
	<big class="none" style="color: red;margin-left: 50px;">余额不足，无法购买!!!</big>
</div>
<?php endif; ?>
<?php if ($this->_var['cart_item']['buy_type'] == 2): ?>
<div class="balance" style="width: 100%;height: 45px;border-bottom: 1px solid #ddd;font-size: 16px;">可用注册积分为:
	<span style="display: inline-block;height: 45px;line-height: 45px;color: #f80;"><?php echo $this->_var['user_info']['register_credits']; ?></span>
	<big class="none" style="color: red;margin-left: 50px;">余额不足，无法购买!!!</big>
</div>
<?php endif; ?>


<div id="cart_buy_total">
</div>
<?php if ($this->_var['invoice_notice']): ?>
<div class="info-bar invoice-check-box" rel-num="0" style="display: none;">
	<div class="f_r"><input class="ui-checkbox invoice_check" type="checkbox" checked/>已同意<a class="invoice_notice" style="color: red;">《发票须知》</a></div>
	<div class="ivon-content" style="display: none;">
		<?php echo $this->_var['invoice_notice']; ?>
	</div>
</div>
<?php endif; ?>
<div id="cart_submit">
	<input type="hidden" value="<?php 
$k = array (
  'name' => 'intval',
  'value' => $this->_var['order_info']['id'],
);
echo $k['name']($k['value']);
?>" name="id" />
	<input type="hidden" name="hd_is_coupon" value="<?php echo $this->_var['is_coupon']; ?>">
	<input type="hidden" name="deal_id" value="<?php echo $this->_var['deal_id']; ?>">
	<button id="order_done" class="ui-button f_r" rel="blue" type="button"><?php echo $this->_var['LANG']['CONFIRM_ORDER_AND_PAY']; ?></button>
	<?php if ($this->_var['deal_id'] || $this->_var['order_info']): ?><?php else: ?>
	<a href="<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>" class="back-cart f_r">返回购物车</a>
	<?php endif; ?>
</div>
<script>
	$(window).ready(function(){
		var balance = parseFloat($(".balance span").text());
		var price = parseFloat($(".order-price span").text());
		var order_count = parseFloat($('.order-count span').text());
		var prices = Math.abs(price);
		$(".order-price span").text(prices);
		if(balance < order_count){
			$("#cart_submit").addClass("none");
			$(".balance").removClass("none");
		}
		
	})
</script>
<!-- <div class="blank"></div>
<div class="cart_row layout_box clearfix">

	
	<div id="user_mobile">
	<?php if ($this->_var['user_info']['mobile']): ?>
	<input type="hidden" name="user_mobile" value="<?php echo $this->_var['user_info']['mobile']; ?>" />
	<?php else: ?>
	<div class="form_panel">
	<div class="panel">

			<dl>
				<dt>手机号</dt>
				<dd>
					<input class="ui-textbox" name="user_mobile" value="" holder="请输入手机号" />
					<span class="form_tip"></span>
				</dd>
			</dl>
			<?php if (app_conf ( "SMS_ON" ) == 1): ?>
			<dl class="ph_img_verify" <?php if ($this->_var['sms_ipcount'] > 1): ?>style="display:block"<?php endif; ?>>
				<dt>图片验证码</dt>
				<dd>
					<input type="text" name="verify_code" class="ui-textbox img_verify" holder="请输入图片文字" />
					<img src="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" class="verify" rel="<?php echo $this->_var['APP_ROOT']; ?>/verify.php" />
					<a href="javascript:void(0);" class="refresh_verify">看不清楚？换一张！</a>
					<span class="form_tip"></span>
				</dd>
			</dl>

			<dl>
				<dt>验证码</dt>
				<dd>
					<input class="ui-textbox ph_verify" name="sms_verify" holder="请输入验证码" />
					<button class="ui-button f_l light ph_verify_btn" rel="light" form_prefix="<?php echo $this->_var['form_prefix']; ?>" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" type="button">发送验证码</button>

					<span class="form_tip"></span>
				</dd>
			</dl>
			<?php endif; ?>

		</div>
		</div>
	<?php endif; ?>
	</div>
	

	
	<div id="cart_total">
	</div>
	
	<div class="blank"></div>


</div>
 -->

</form>

</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>