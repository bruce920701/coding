<?php

class presellModule extends MainBaseModule
{
    function __construct()
    {
        parent::__construct();
        if(IS_PRESELL==0){
           // showErr("invalid access");
        }
    }

    public function index()
    {
        global_run();
        init_app_page();
        $data = call_api_core("presell","index");
        foreach($data['advs'] as $k=>$v)
        {
            $data['advs'][$k]['url'] =  getWebAdsUrl($v);
        }
        $data['advs_count'] = count($data['advs']);
        foreach($data['advs2'] as $k=>$v)
        {
            $data['advs2'][$k]['url'] =  getWebAdsUrl($v);
        }

        if($data['deal_list']){
            require_once(APP_ROOT_PATH."system/model/deal.php");
            foreach($data['deal_list'] as $k=>$v){
                $data['deal_list'][$k]['url'] = wap_url("index", 'deal', array('data_id'=>$v['id']));
                $data['deal_list'][$k]['name'] = format_deal_name($v['name']);
                $data['deal_list'][$k]['current_price'] = format_price_html($v['current_price']);
            }
        }
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("presell_index.html");
    }


    public function load_index_list_data(){
        global_run();
        $param['page'] = intval($_REQUEST['page']);
        $data = call_api_core("presell","load_index_list_data",$param);

        if($data['deal_list']){
            require_once(APP_ROOT_PATH."system/model/deal.php");
            foreach($data['deal_list'] as $k=>$v){
                $data['deal_list'][$k]['url'] = wap_url("index", 'deal', array('data_id'=>$v['id']));
                $data['deal_list'][$k]['name'] = format_deal_name($v['name']);
                $data['deal_list'][$k]['current_price'] = format_price_html($v['current_price']);
            }
        }

        $GLOBALS['tmpl']->assign("data",$data);

        $deal_html =  $GLOBALS['tmpl']->fetch("style5.2/inc/page/index_deal_list.html");
        $deal_data=array();
        $deal_data['html'] = $deal_html;
        $deal_data['page_total'] = $data['page_total'];
        $deal_data['page'] = $data['page'];
        ajax_return($deal_data);

    }

}