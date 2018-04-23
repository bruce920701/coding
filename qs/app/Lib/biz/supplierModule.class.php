<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


class supplierModule extends BizBaseModule
{
	public function __construct()
	{
		parent::__construct();
		global_run();
		
		if($GLOBALS['account_info']['is_main']!=1){
			$this->check_auth();
		}
	}
	public function index()
	{		
		init_app_page();
		$s_account_info = $GLOBALS['account_info'];
		$account_id = intval($s_account_info['id']);
		
		//获取商户信息
		$sql="SELECT
				s.id,
				s.name,
				dca.name as cate_name,
				dcy.name as city_name,
				sl.address,
				sl.xpoint,
				sl.ypoint,
				sl.district,
				sl.tel,
				sl.open_time,
				u.user_name,
				sa.mobile,
				s.h_license,
				s.h_other_license,
				s.preview,
				sl.preview as sl_preview,
				s.h_name,
				s.h_faren,
				s.h_tel,
				s.bank_name,
				s.bank_user,
				s.bank_info
			FROM
				fanwe_supplier s
			LEFT JOIN " . DB_PREFIX . "supplier_location sl ON s.id = sl.supplier_id
			LEFT JOIN " . DB_PREFIX . "deal_cate dca ON sl.deal_cate_id = dca.id
			LEFT JOIN " . DB_PREFIX . "deal_city dcy ON s.city_id = dcy.id
			LEFT JOIN " . DB_PREFIX . "supplier_account sa ON s.id = sa.supplier_id
			LEFT JOIN " . DB_PREFIX . "user u ON u.id = sa.user_id
			WHERE
				s.id = ".intval($s_account_info['supplier_id'])."
			AND sl.is_main = 1
			AND sa.is_main = 1";
		$supplier_info = $GLOBALS['db']->getRow($sql);
		//echo "<pre>";print_r($supplier_info);exit;
		$GLOBALS['tmpl']->assign("vo",$supplier_info);
		$GLOBALS['tmpl']->assign("page_title","商户资料管理");
		$GLOBALS['tmpl']->display("pages/supplier/edit.html");
	}
	/*
	* 编辑部分商户信息
	*/
	public function save()
	{		
		$account_info = $GLOBALS['account_info'];
	    $supplier_id = $account_info['supplier_id'];
	    $account_id = $account_info['id'];
		
		$isMob="/^1[3-8]{1}[0-9]{9}$/";
		$isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
		if(!preg_match($isMob,strim($_REQUEST['h_tel'])) && !preg_match($isTel,strim($_REQUEST['h_tel']))){
			$result['status'] = 0;
			$result['info'] = "法人电话格式不正确";
			ajax_return($result);
		}
		if(!preg_match($isMob,strim($_REQUEST['tel'])) && !preg_match($isTel,strim($_REQUEST['tel']))){
			$result['status'] = 0;
			$result['info'] = "商户电话格式不正确";
			ajax_return($result);
		}
		
		$supplier_info['h_other_license']=strim($_REQUEST['h_other_license']);
		$supplier_info['h_name']=strim($_REQUEST['h_name']);
		$supplier_info['h_faren']=strim($_REQUEST['h_faren']);
		$supplier_info['h_tel']=strim($_REQUEST['h_tel']);
		$GLOBALS['db']->autoExecute(DB_PREFIX . "supplier", $supplier_info, "UPDATE", " id=" . $supplier_id);
		
		$supplier_location_info['tel']=strim($_REQUEST['tel']);
		$supplier_location_info['open_time']=strim($_REQUEST['open_time']);
		$GLOBALS['db']->autoExecute(DB_PREFIX . "supplier_location", $supplier_location_info, "UPDATE", " is_main=1 and supplier_id=".$supplier_id);
		
		
		$result['status'] = 1;
		$result['info'] = "编辑成功";
		ajax_return($result);
	}
}
?>