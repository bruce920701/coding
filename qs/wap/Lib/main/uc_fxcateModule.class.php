<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class uc_fxcateModule extends MainBaseModule
{
	
	/**
	 * 分销商品分类页面
	 **/
	public function index()
	{	
		global_run();	
		init_app_page();
		$param=array();
		$data = call_api_core("uc_fxcate","index",$param);
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display("uc_fxcate.html");
		
	}
    /**
     * 分销团购分类页面
     **/
    public function tuan()
    {
        global_run();
        init_app_page();
        $param=array();
        $data = call_api_core("uc_fxcate","tuan",$param);
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("uc_fxcate.html");

    }
	

	
	
	
}
?>