<?php
/**
*自动引入头文件
*如：<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
*/


$page_finsh= intval($_REQUEST['page_finsh']);
$ctl = $this->_var['MODULE_NAME'];
$act = $this->_var['ACTION_NAME'];
$key = $ctl."_".$act;

//过滤头部有定义的文件数组
$header_file_arr = array(
	"presell_index",
	"presell_detail",
    "index_index",
    "deal_index",
    "events_index",
    "cart_index",
    "scores_index_index",
	"uc_collect_index",
	"uc_address_add",
	"cart_check",
	"uc_money_banklist",
	"uc_score_index",
	"uc_ecv_index",
	"uc_account_phone",
	"uc_fxwithdraw_index",
	'user_protocol',
	'store_pay_index',
	'main_index',
	'city_index',
	'uc_home_index',
	'uc_fx_qrcode',
	'uc_youhui_index',
	"store_index",
	"uc_order_index",
	"visiting_service_detail_index",
	"vs_cart_index",
	"biz_vs_pay_items_index",
	"pt_index",
	"pt_detail",
);

/**
*是否有弹出层
*如：<?php echo $this->fetch('style5.2/inc/module/pop-light-img.html'); ?>
*有要添加弹出显示的是默认头部的需要在下面数组里面加上,图片轮播
*/
$pop_file_arr = array(
    'store_index',
    'event_index',
    'event_reviews',
    'event_detail',
    'store_reviews',
    'uc_account_index',
    'youhui_index',
	'uc_review_index'
);

$is_pop_box = 0;
if(in_array($key,$pop_file_arr)){
    $is_pop_box = 1;
}

/**
*是否有分享和收藏
*有要添加弹出显示的是默认头部的需要在下面数组里面加上
*/
$is_header_detail = 0;
$header_detail_arr = array(
    'event_index',
    'youhui_index',
	
    
);
if(in_array($key,$header_detail_arr)){
    $is_header_detail = 1;
}

/**
* 是否是右侧没有更多的按钮的
*/

$is_header_simple = 0;
$header_simple_arr = array(
	'uc_money_money_log',
	'uc_money_withdraw_bank_list',
	'uc_money_withdraw_log',
	'uc_ecv_exchange',
	'user_changepassword',
	"uc_fx_check",
	'store_pay_check',
	'shop_index',
	'user_changeuname',
	'idvalidate_index'
);
if(in_array($key,$header_simple_arr)){
$is_header_simple=1;
}

/**
* 右侧是分享按钮
*/

$is_header_share = 0;
$header_share_arr = array(

);
if(in_array($key,$header_share_arr)){
$is_header_share=1;
}

/**
*分销市场团购和商品头部文件
*/
$is_header_fx = 0;
$header_fx_arr = array(
'uc_fx_deal_fx',
'uc_fx_shop_fx',
);
if(in_array($key,$header_fx_arr)){
	$is_header_fx=1;
}

if(in_array($key,$header_file_arr)){
    $header_file = "style5.2/inc/headers/".$key.".html";
}elseif($is_header_detail){
    $header_file = "style5.2/inc/headers/header_detail.html";
}elseif($is_header_simple){
    $header_file = "style5.2/inc/headers/header_simple.html";
}elseif($is_header_share){
    $header_file = "style5.2/inc/headers/header_share.html";
}elseif($is_header_fx){
	$header_file = "style5.2/inc/headers/header_fx.html";
}else{
	$header_file = "style5.2/inc/headers/header_default.html";
}

//引用输出模板
$this->assign("app_index",APP_INDEX);
$this->assign("page_finsh",PAGE_FINSH);
$this->assign("is_pop_box",$is_pop_box);

echo $this->fetch($header_file);

?>
