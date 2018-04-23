<?php

/**
 * @desc
 * @author    吴庆祥
 * @since     2017-06-23 19:19
 */
class supplierModule extends MainBaseModule
{
    public function index()
    {
        global_run();
        init_app_page();
        $data = call_api_core("supplier", "index");
        $this->_isLoginRedirect($data['user_login_status']);
        if(APP_INDEX=='app'){
            $back_url ='javascript:App.app_detail(107,0);';
        }else{
            $back_url = wap_url("index","user_center");
        }
        $GLOBALS['tmpl']->assign("back_url",$back_url);
        $GLOBALS['tmpl']->assign("data", $data);
        $GLOBALS['tmpl']->display("supplier_index.html");
    }

    private function _isLoginRedirect($status)
    {
        if (!$status) {
            app_redirect(wap_url("index", "user#login"));
        }
    }

    public function register_add()
    {
        global_run();
        init_app_page();
        $data = call_api_core("supplier", "register_add");
        $this->_isLoginRedirect($data['user_login_status']);
        if($data['user_apply_supplier_status']!=0)app_redirect(wap_url("index","supplier#index"));
        $data['action_url']=wap_url("index","supplier#register_insert");
        $GLOBALS['tmpl']->assign("sms_lesstime",load_sms_lesstime());
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("supplier_register_add.html");
    }
    public function register_insert(){
        global_run();
        $data = call_api_core("supplier", "register_insert",$_REQUEST);
        ajax_return($data);
    }
    public function register_view()
    {
        global_run();
        init_app_page();
        $data = call_api_core("supplier", "register_view",$_REQUEST);
        if($data['user_apply_supplier_status']!=1)app_redirect(wap_url("index","supplier#index"));
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("supplier_register_view.html");
    }

    public function register_edit()
    {
        global_run();
        init_app_page();
        $data = call_api_core("supplier", "register_edit");
        $this->_isLoginRedirect($data['user_login_status']);
        if($data['user_apply_supplier_status']!=3)app_redirect(wap_url("index","supplier#index"));
        $data['action_url']=wap_url("index","supplier#register_update");
        $GLOBALS['tmpl']->assign("sms_lesstime",load_sms_lesstime());
        $GLOBALS['tmpl']->assign("json_submit_info",json_encode($data['submit_info']));
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("supplier_register_edit.html");
    }
    public function register_update(){
        global_run();
        $data = call_api_core("supplier", "register_update",$_REQUEST);
        ajax_return($data);
    }
    public function load_area()
    {
        $area_id = intval($_REQUEST['id']);
        $area_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."area where city_id = ".$area_id." and pid = 0 order by sort desc");
        $html = "<option value=\"0\">=选择区县=</option>";
        foreach($area_list as $item)
        {
            $html.="<option value=\"{$item['id']}\">{$item['name']}</option>";
        }
        header("Content-Type:text/html; charset=utf-8");
        echo $html;
    }
    public function load_city(){
        $area_id = intval($_REQUEST['id']);
        $area_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_city where pid = ".$area_id." order by sort desc");
        $html = "<option value=\"0\">=选择城市=</option>";
        foreach($area_list as $item)
        {
            $html.="<option value=\"{$item['id']}\">{$item['name']}</option>";
        }
        header("Content-Type:text/html; charset=utf-8");
        echo $html;
    }
}