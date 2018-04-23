<?php
/**
 * 上门服务首页接口
 *
 * @author 钱彩凡
 */
class visiting_serviceApiModule extends MainBaseApiModule
{

    /**
     * 
     */
    public function index()
    {
        global $is_app;
        $root = array();
        $root['return'] = 1;
        
        $city_id = $GLOBALS['city']['id'];
        $city_name =  $GLOBALS['city']['name'];
        
        if($GLOBALS['geo']){
            $url=wap_url("index","dcposition",array("is_vs"=>1));
            $root['page_title']=$GLOBALS['geo']['address'];
        }
        
        $root['city_id'] = $city_id;
        $root['city_name'] = $city_name;
        $adv_list = $GLOBALS['cache']->get("WAP_VISITING_SERVICE_ADVS_".intval($city_id));
        
        //广告列表
        if($adv_list===false)
        {
            if(APP_INDEX=='app')
            {
                $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '0' and position=11 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                $advs = $GLOBALS['db']->getAll($sql);
                if(empty($advs))
                {
                    $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '1' and position=11 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                    $advs = $GLOBALS['db']->getAll($sql);
                }
            }
            else
            {
                $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '1' and position=11 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                $advs = $GLOBALS['db']->getAll($sql);
            }
        
        
            $adv_list = array();
            foreach($advs as $k=>$v)
            {
                $adv_list[$k]['id'] = $v['id'];
                $adv_list[$k]['name'] = $v['name'];
                $adv_list[$k]['img'] = get_abs_img_root(get_spec_image($v['img'], 750, 230,1));  //首页顶部广告图片规格为 宽: 750px 高: 230px
                $adv_list[$k]['type'] = $v['type'];
                $adv_list[$k]['data'] = $v['data'] = unserialize($v['data']);
                $adv_list[$k]['ctl'] = $v['ctl'];
            }
            $GLOBALS['cache']->set("WAP_VISITING_SERVICE_ADVS_".intval($city_id),$adv_list,300);
        }
        $root['advs'] = $adv_list?$adv_list:array();
        
        //专题位
        $root['zt_html5'] = load_zt_unit("index_zt5.html",$page=6);
        $root['zt_html3'] = load_zt_unit("index_zt3.html",$page=6);
        $root['zt_html4'] = load_zt_unit("index_zt4.html",$page=6);
        $root['zt_html6'] = load_zt_unit("index_zt6.html",$page=6);
        $root['xzt_html'] = load_xzt_unit($page=6);
        
        //推荐团购
        $indexs_service = $GLOBALS['cache']->get("WAP_INDEX_SERVICE_".intval($city_id));
        if($indexs_service === false)
        {
    
            $sql = " select id,name from ".DB_PREFIX."service_cate where is_delete = 0 and is_effect = 1 and pid=0 order by sort limit 3";
            $indexs_service=$GLOBALS['db']->getAll($sql);
            
            foreach ($indexs_service as $t => $v){
                
            }
            
            $GLOBALS['cache']->set("WAP_INDEX_SERVICE_".intval($city_id),$indexs_service,300);
        }
        $root['indexs'] = $indexs_service?$indexs_service:array();
        
        //首页菜单列表
        $mindexs_list = mindex_cate_menu($city_id,$page=6);
        
        //推荐分类
        $sql = " select * from ".DB_PREFIX."service_cate where is_delete = 0 and is_effect = 1 and recommend = 1 order by sort";
        $recommend_deal_cate=$GLOBALS['db']->getAll($sql);
        foreach ($recommend_deal_cate as $tt => $vv){
            $deal_sql=" select count(*) from ".DB_PREFIX."supplier_visiting_services where FIND_IN_SET( '".$v['name']."',cate_match_row) and is_effect=1 and is_delete=0 and (end_time>".NOW_TIME." or end_time=0) and (begin_time < ".NOW_TIME." or begin_time=0)";
            $count=$GLOBALS['db']->getOne($deal_sql);
            $recommend_deal_cate[$tt]['url'] =  wap_url("index","visiting_service_list",array("cate_id"=>$v['id']));
            if(!$count){
                unset($recommend_deal_cate[$tt]);
            }else {
                $vv['data']['cate_id'] = $vv['id'];
                $vv['ctl'] = "visiting_service_list";
                $vv['icon_name'] = $vv['m_iconfont'];//图标名 http://fontawesome.io/icon/bars/
                $vv['color'] = $vv['m_iconcolor'];//颜色
                $vv['bg_color'] = $vv['m_iconbgcolor'];//背景颜色
                $vv['img'] = $vv['app_icon_img'];
                $vv['type'] = 11;
                $indexs_list[$tt]=format_indexs_i($vv);
            }
        }
        $indexs_list = array_merge($mindexs_list,$indexs_list);
        
        $indexs = array();
        $indexs['list'] = $indexs_list?$indexs_list:array();
        $indexs['count'] = intval(count($indexs_list));
        $root['indexs'] = $indexs;
        $root['indexs']=$indexs;
        
        foreach($root['advs'] as $k=>$v)
        {
        
            $root['advs'][$k]['url'] =  getWebAdsUrl($v);
        }
        $root['advs_count'] = count($root['advs']);
        foreach ($root['deal_list'] as $k=>$v){
            //$data['deal_list'][$k]['current_price'] = format_price_html($v['current_price']);
            $deal_param['data_id'] = $v['id'];
            $root['deal_list'][$k]['url'] = wap_url("index", 'visiting_service_detail', $deal_param);
        
        
            $distance = $v['distance'];
            $distance_str = "";
            if($distance>0)
            {
                if($distance>1000)
                {
                    $distance_str =  round($distance/1000,2)."km";
                }
                else
                {
                    $distance_str = round($distance)."m";
                }
            }
            $root['deal_list'][$k]['distance'] = $distance_str;
        
        }
        
        //$root['page_title'] = $GLOBALS['m_config']['program_title']?$GLOBALS['m_config']['program_title']." - ":"";
        
        //分类商品
        $cate_ids = $GLOBALS['cache']->get("WAP_SERVICE_CATE_".intval($city_id));
        if($cate_ids == false){
            $sql="select id,name from ".DB_PREFIX."service_cate where is_delete = 0 and is_effect = 1 and pid=0";
            $cate_list=$GLOBALS['db']->getAll($sql);
            $cate_ids=array();
            foreach ($cate_list as $t => $v){
                $count_sql="select count(*) from ".DB_PREFIX."supplier_visiting_services as vs 
                            left join ".DB_PREFIX."supplier as s on s.id = supplier_id where s.city_id=".intval($city_id)."
                            and find_in_set('".$v['name']."',vs.cate_match_row) and vs.is_effect=1 and vs.is_delete=0";
                
                $service_count=$GLOBALS['db']->getOne($count_sql);
                if($service_count>0){
                    $cate_ids[]=$v['id'];
                }
            }
            $GLOBALS['cache']->set("WAP_SERVICE_CATE_".intval($city_id),$cate_ids,300);
        }
        
        $service_cate_list=$GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."service_cate where is_delete = 0 and is_effect = 1 and pid=0 and id in (".implode(',', $cate_ids).") limit 3");
        foreach ($service_cate_list as $t => $v){
            $service_sql="select sl.id,sl.buy_count,sl.location_id,l.name as location_name,vs.id as vs_id,vs.name as vs_name,si.img,vs.current_price
                        from ".DB_PREFIX."supplier_location_service_link as sl 
                        left join ".DB_PREFIX."supplier_visiting_services as vs on vs.id=sl.supplier_vs_id
                        left join ".DB_PREFIX."supplier_location as l on l.id = sl.location_id 
                        left join ".DB_PREFIX."common_service_img as si on vs.id=si.supplier_service_id
                        where l.city_id=".intval($city_id)." and find_in_set('".$v['name']."',vs.cate_match_row) and vs.is_effect=1 and 
                        vs.is_effect=1 and l.is_close=0 group by sl.id order by sl.buy_count desc limit 3";

            $service_list=$GLOBALS['db']->getAll($service_sql);
            
            foreach ($service_list as $tt => $vv){
                $service_list[$tt]['img']=get_abs_img_root(get_spec_image($vv['img'], 135, 135,1));
                $service_list[$tt]['current_price']=format_price($vv['current_price']);
            }
            if(count($service_list)<3){
                //$more['img']=get_abs_img_root(get_spec_image('',135,135,1));
                $more['vs_name']="敬请期待";
                $service_list[]=$more;
            }
           
            $service_cate_list[$t]['list']=$service_list;
        }
        $root['service_list']=$service_cate_list?$service_cate_list:array();
        $root['page'] = 1;
        $root['has_next'] = 1;
        
        return output($root);
    }
        
    //团购首页《推荐团购》分页
    public function load_index_list_data()
    {
        $root = array();
        $city_id = $GLOBALS['city']['id'];
        require_once(APP_ROOT_PATH."system/model/deal.php");
        $page = intval($GLOBALS['request']['page']); //分页
    
        $page=$page==0?1:$page;
    
        $page_size = 3;
        $limit = (($page-1)*$page_size).",".$page_size;
        
        $cate_ids = $GLOBALS['cache']->get("WAP_SERVICE_CATE_".intval($city_id));
        if($cate_ids == false){
            $sql="select id,name from ".DB_PREFIX."service_cate where is_delete = 0 and is_effect = 1 and pid=0";
            $cate_list=$GLOBALS['db']->getAll($sql);
            $cate_ids=array();
            foreach ($cate_list as $t => $v){
                $count_sql="select count(*) from ".DB_PREFIX."supplier_visiting_services as vs
                            left join ".DB_PREFIX."supplier as s on s.id = supplier_id where s.city_id=".intval($city_id)."
                            and find_in_set('".$v['name']."',vs.cate_match_row) and vs.is_effect=1 and vs.is_delete=0";
        
                $service_count=$GLOBALS['db']->getOne($count_sql);
                if($service_count>0){
                    $cate_ids[]=$v['id'];
                }
            }
            $GLOBALS['cache']->set("WAP_SERVICE_CATE_".intval($city_id),$cate_ids,300);
        }
        
        $service_cate_list=$GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."service_cate where is_delete = 0 and is_effect = 1 and pid=0 and id in (".implode(',', $cate_ids).") limit ".$limit);
        foreach ($service_cate_list as $t => $v){
            $service_sql="select sl.id,sl.buy_count,sl.location_id,l.name as location_name,vs.id as vs_id,vs.name as vs_name,si.img,vs.current_price
                        from ".DB_PREFIX."supplier_location_service_link as sl
                        left join ".DB_PREFIX."supplier_visiting_services as vs on vs.id=sl.supplier_vs_id
                        left join ".DB_PREFIX."supplier_location as l on l.id = sl.location_id
                        left join ".DB_PREFIX."common_service_img as si on vs.id=si.supplier_service_id
                        where l.city_id=".intval($city_id)." and find_in_set('".$v['name']."',vs.cate_match_row) and vs.is_effect=1 and
                        vs.is_effect=1 and l.is_close=0 group by sl.id order by sl.buy_count desc limit 3";
        
            $service_list=$GLOBALS['db']->getAll($service_sql);
        
            foreach ($service_list as $tt => $vv){
                $service_list[$tt]['img']=get_abs_img_root(get_spec_image($vv['img'], 135, 135,1));
                $service_list[$tt]['current_price']=format_price($v['current_price']);
            }
            if(count($service_list)<3){
                $more['img']=get_abs_img_root(get_spec_image('',135,135,1));
                $more['vs_name']="敬请期待";
                $service_list[]=$more;
            }
        
            $service_cate_list[$t]['list']=$service_list;
        }
        
        $sql = "select count(*) from ".DB_PREFIX."service_cate where is_delete = 0 and is_effect = 1 and pid=0 and id in (".implode(',', $cate_ids).")";
        $deals_count = $GLOBALS['db']->getOne($sql);
    
        $root['service_list']=$service_cate_list?$service_cate_list:array();
        
        $root['page_total'] = ceil($deals_count / $page_size);
        $root['page'] = $page;
        $root['has_next'] = $root['page_total']>$root['page']?1:0;
        return output($root);
    }
    
}