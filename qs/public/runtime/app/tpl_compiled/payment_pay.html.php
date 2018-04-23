<?php
//本页不引用header.html， 直接在页面内编写单独header
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/cart_list.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/payment.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/payment_pay.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/payment_pay.js";
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
<?php if ($this->_var['payment_notice']['order_type'] != 5): ?>
var fx_pay = 1;
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
<?php if ($this->_var['payment_notice']['order_type'] == 5): ?>
var PAY_TIP = '<?php
echo parse_url_tag("u:index|payment#tip|"."id=".$this->_var['payment_notice']['id']."&type=5".""); 
?>';
<?php else: ?>
var PAY_TIP = '<?php
echo parse_url_tag("u:index|payment#tip|"."id=".$this->_var['payment_notice']['id']."".""); 
?>';
<?php endif; ?>
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
	
		<div class="layout_box payment">
			<div class="title"><?php echo $this->_var['page_title']; ?></div>
			<div class="content">
				<div class="blank20"></div>
				<p  class="order-check-form">
				<?php
echo lang("PAY_NOW"); 
?> 
				[&nbsp;&nbsp;<?php
echo lang("NOTICE_SN"); 
?> ：<span class="red"><?php echo $this->_var['payment_notice']['notice_sn']; ?></span>&nbsp;&nbsp;]
				</p>
				<div class="blank"></div>
				<div class="payment_code">
				<span>
				<?php echo $this->_var['payment_code']; ?>	
				</span>
				</div>
				<div class="blank"></div>
				<div  class="order-check-form">
				<?php if ($this->_var['payment_notice']['order_type'] == 5): ?>
				<a href="<?php
echo parse_url_tag("u:index|uc_fx#check|"."order_id=".$this->_var['order']['id']."".""); 
?>">
				<?php else: ?>
				<a href="<?php
echo parse_url_tag("u:index|cart#order|"."id=".$this->_var['order']['id']."".""); 
?>">
				<?php endif; ?>
					» <?php
echo lang("MODIFY_PAYMENT_TYPE"); 
?>
				</a>&nbsp;&nbsp;&nbsp;	
				<?php if ($this->_var['payment_notice']['order_type'] != 5): ?>				
				<a href="<?php
echo parse_url_tag("u:index|uc_order#index|"."".""); 
?>">» <?php
echo lang("MY_ORDERS"); 
?></a>
				<?php endif; ?>
				</div>		
			</div>
		</div>
	
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>