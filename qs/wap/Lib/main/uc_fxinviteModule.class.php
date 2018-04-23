<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class uc_fxinviteModule extends MainBaseModule
{

	public function index()
	{
		global_run();		
		init_app_page();
		
		$param=array();	
		$param['page'] = intval($_REQUEST['page']);
		if (!empty($_REQUEST['user_id'])) {
			$param['user_id'] = intval($_REQUEST['user_id']);
		}
				
		$data = call_api_core("uc_fxinvite","wap_index",$param);
		$this->_judgeDataStatus($data);
        if(!$data['is_fx']){
            app_redirect(wap_url("index","user_center"));
        }
		$this->_initPage($data);
		$data['ptype']="invite";
		// $GLOBALS['tmpl']->assign("back_url",wap_url("index","user_center"));
		$GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->assign("back_url",wap_url("index","user_center"));
		$GLOBALS['tmpl']->display("uc_fxinvite.html");
	}
	private function _judgeDataStatus($data){
        if($data['user_login_status']!=LOGIN_STATUS_LOGINED){
            login_is_app_jump();
        }
    }
    private function _initPage($data){
        if(isset($data['page']) && is_array($data['page'])){
            $page = new Page($data['page']['data_total'],$data['page']['page_size']);   //初始化分页对象
            $p  =  $page->show();
            $GLOBALS['tmpl']->assign('pages',$p);
        }
    }
	public function supplier(){
        global_run();
        init_app_page();
        $data = call_api_core("uc_fxinvite","supplier");
        $this->_judgeDataStatus($data);
        $this->_initPage($data);
        $data['ptype']="invite";
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->assign("back_url",wap_url("index","user_center"));
        $GLOBALS['tmpl']->display("uc_fxinvite_supplier.html");
    }

	public function money_log()
	{
		global_run();
		init_app_page();
		$param=array();
		$param['page'] = intval($_REQUEST['page']);

		$data = call_api_core("uc_fxinvite","money_log",$param);
		
		if($data['user_login_status']!=LOGIN_STATUS_LOGINED){
			login_is_app_jump();
			//app_redirect(wap_url("index","user#login"));
		}
		
		if(isset($data['page']) && is_array($data['page'])){			
			$page = new Page($data['page']['data_total'],$data['page']['page_size']);   //初始化分页对象			
			$p  =  $page->show();
			
			$GLOBALS['tmpl']->assign('pages',$p);
		}
		
		$data['ptype']="moneylog";
		//print_r($data);exit;
		$GLOBALS['tmpl']->assign("data",$data);	
		$GLOBALS['tmpl']->display("uc_fxinvite.html");		
		

	}


}
?>