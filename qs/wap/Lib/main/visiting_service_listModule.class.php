<?php
class visiting_service_listModule extends MainBaseModule
{

    /**
     * 团购首页
     **/
    public function index()
    {
        global_run();
        init_app_page();
        
        $param['cate_id'] = intval($_REQUEST['cate_id']);
        $param['page'] = intval($_REQUEST['page']);
        $param['keyword'] = strim($_REQUEST['keyword']);
        $param['qid'] = intval($_REQUEST['qid']);
        $param['order_type'] = strim($_REQUEST['order_type'])?strim($_REQUEST['order_type']):"distance";
        
        $data = call_api_core("visiting_service_list","index",$param);
       
        foreach($data['location_list'] as $k=>$v){
            $data['location_list'][$k]['count']=count($v['list'])-2;
        }
        
        if(isset($data['page']) && is_array($data['page'])){
            $page = new Page($data['page']['data_total'],$data['page']['page_size']);   //初始化分页对象
            $p  =  $page->show();
            $GLOBALS['tmpl']->assign('pages',$p);
        }

        
        $sort_param = $param;
        $sort_param['order_type'] = "avg_point";
        $distance_param = $param;
        $distance_param['order_type'] = "distance";
        
        $GLOBALS['tmpl']->assign("sort_url",wap_url('index','visiting_service_list',$sort_param));
        $GLOBALS['tmpl']->assign("distance_url",wap_url('index','visiting_service_list',$distance_param));
               
        $back_url = wap_url("index","index");
        $GLOBALS['tmpl']->assign("param",$param);
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->display("visiting_service_list.html");

    }

}