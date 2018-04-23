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
<meta name="keywords" content="<?php if ($this->_var['page_keyword']): ?><?php echo $this->_var['page_keyword']; ?><?php endif; ?> <?php echo $this->_var['site_seo']['keyword']; ?>" />
<meta name="description" content="<?php if ($this->_var['page_description']): ?><?php echo $this->_var['page_description']; ?><?php endif; ?> <?php echo $this->_var['site_seo']['description']; ?>" />
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
var CITY_COUNT	= <?php echo $this->_var['city_count']; ?>;

//关于图片上传的定义
var LOADER_IMG = '<?php echo $this->_var['TMPL']; ?>/images/loader_img.gif';
var UPLOAD_SWF = '<?php echo $this->_var['TMPL']; ?>/js/utils/Moxie.swf';
var UPLOAD_XAP = '<?php echo $this->_var['TMPL']; ?>/js/utils/Moxie.xap';
var MAX_IMAGE_SIZE = '<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'MAX_IMAGE_SIZE',
);
echo $k['name']($k['v']);
?>';
var ALLOW_IMAGE_EXT = '<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'ALLOW_IMAGE_EXT',
);
echo $k['name']($k['v']);
?>';
var UPLOAD_URL = '<?php
echo parse_url_tag("u:index|file#upload|"."".""); 
?>';
var QRCODE_ON = '<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'QRCODE_ON',
);
echo $k['name']($k['v']);
?>';
</script>
<?php
//前台队列功能开启
if(app_conf("APP_MSG_SENDER_OPEN")==1)
{
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
}
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/auto_search.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/auto_search.js";

$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/auto_search.css";
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

</head>
<body>