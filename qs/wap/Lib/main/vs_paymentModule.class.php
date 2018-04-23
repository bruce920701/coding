<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


class vs_paymentModule extends MainBaseModule
{

	
	public function done()
	{
		global_run();
		init_app_page();
		$id = intval($_REQUEST['id']);

		$data = call_api_core("vs_payment","done",array("id"=>$id));
		// var_dump($data);exit;
        $back_url = wap_url("index","vs_order#view", array('id' => $id));
		if ($data['status']==1) { 
	        if (APP_INDEX=='app') {
	            $back_go_url ='javascript:App.app_detail(1,0);';
	        } else { 
	            $back_go_url = wap_url("index","index");
	        }
	        
			$GLOBALS['tmpl']->assign("back_url",$back_url);
			$GLOBALS['tmpl']->assign("back_go_url",$back_go_url);
			$GLOBALS['tmpl']->assign("data",$data);
			$GLOBALS['tmpl']->display("vs_payment_done.html");
		} else {
			if ($data['user_login_status'] !== LOGIN_STATUS_LOGINED) {
        		login_is_app_jump();
        	} else {
				app_redirect($pay_url);
        	}
		}
	}
}