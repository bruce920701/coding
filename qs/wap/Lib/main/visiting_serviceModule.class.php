<?php
class visiting_serviceModule extends MainBaseModule
{

    /**
     * 上门服务首页
     **/
    public function index()
    {
        global_run();
        init_app_page();
        $data = call_api_core("visiting_service","index");
        
        if(empty($GLOBALS['geo']['address']))
            app_redirect(wap_url('index','dcposition',array("is_vs"=>1)));
        
        $back_url = wap_url("index","index");
        $GLOBALS['tmpl']->assign("back_url",$back_url);
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("visiting_service.html");

    }
    
    public function load_index_list_data(){
        global_run();
        $param['page'] = intval($_REQUEST['page']);
        $data = call_api_core("visiting_service","load_index_list_data",$param);
         
        $GLOBALS['tmpl']->assign("data",$data);
    
        $deal_html =  $GLOBALS['tmpl']->fetch("style5.2/inc/page/visiting_service_list.html");
    
        $deal_data=array();
        $deal_data['html'] = $deal_html;
        $deal_data['page_total'] = $data['page_total'];
        ajax_return($deal_data);
        
    }

}