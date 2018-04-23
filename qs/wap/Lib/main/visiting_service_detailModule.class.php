<?php
class visiting_service_detailModule extends MainBaseModule
{

    /**
     * 团购首页
     **/
    public function index()
    {
        global_run();
        init_app_page();
        $data = call_api_core("visiting_service_detail","index",array("data_id",$_REQUEST['data_id']));
        
        $back_url = wap_url("index","index");
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("visiting_service_detail.html");

    }

}