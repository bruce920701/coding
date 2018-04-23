<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class vs_cartModule extends MainBaseModule
{
	public function index()
	{
		global_run();
        init_app_page();
        $param = array();
        if (isset($_REQUEST['id'])) {
        	$param['id'] = intval($_REQUEST['id']);
        }
        if (isset($_REQUEST['consignee_id'])) {
        	$param['consignee_id'] = intval($_REQUEST['consignee_id']);
        }
        if (isset($_REQUEST['rs_date'])) {
        	$param['rs_date'] = strim($_REQUEST['rs_date']);
        }
        if (isset($_REQUEST['tid'])) {
        	$param['tid'] = intval($_REQUEST['tid']);
        }
        $data = call_api_core("vs_cart", "index", $param);
        // print_r($data);exit;
        if ($data['status'] == 0) {
        	if ($data['user_login_status'] !== LOGIN_STATUS_LOGINED) {
        		login_is_app_jump();
        	} else {
        		$script = suiShow($data['info']);
	        	$GLOBALS['tmpl']->assign('suijump', $script);
	        	$GLOBALS['tmpl']->display('style5.2/inc/nodata.html');
        	}
	        	
        } else {
        	$GLOBALS['tmpl']->assign('param', $param);
        	$GLOBALS['tmpl']->assign('data', $data);
			$GLOBALS['tmpl']->display('vs_cart.html');
        }
        
       
	}

	public function done()
	{
		global_run();
        $param = $_REQUEST;
        $data = call_api_core('vs_cart', 'done', $param);
        if ($data['status'] == 1) {
        	$data['jump'] = wap_url('index', 'vs_cart#pay', array('id'=>$data['id']));
        }
        ajax_return($data);
	}

	public function pay()
	{
		global_run();
        init_app_page();
        $param = $_REQUEST;

        $data = call_api_core('vs_cart', 'pay', $param);
		// var_dump($data);exit;
        if ($data['status'] == 0) {
        	if ($data['user_login_status'] !== LOGIN_STATUS_LOGINED) {
        		login_is_app_jump();
        	} else {
	        	$jump = wap_url('index', 'vs_order');
	        	$script = suiShow($data['info'], $jump);
	        	$GLOBALS['tmpl']->assign('suijump', $script);
	        	$GLOBALS['tmpl']->display('style5.2/inc/nodata.html');
	        }
        } else {
	        $GLOBALS['tmpl']->assign('data', $data);
			$GLOBALS['tmpl']->display('vs_pay.html');
		}
	}

	public function do_pay()
	{
		global_run();
		$param = $_REQUEST;

		$data = call_api_core('vs_cart', 'do_pay', $param);
        if ($data['status'] == 1 && $data['pay_status'] == 1) {
            $data['jump'] = wap_url('index', 'vs_payment#done', array('id' => $data['order_id']));
        }

		ajax_return($data);
	}

}
