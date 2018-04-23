<?php

class presellApiModule extends MainBaseApiModule
{
    //wap版首页接口
    public function index()
    {
        if($GLOBALS['request']['m_longitude']!=0&&$GLOBALS['request']['m_latitude']!=0&&APP_INDEX=="app"){
            $current_geo['xpoint']=$GLOBALS['request']['m_longitude'];
            $current_geo['ypoint']=$GLOBALS['request']['m_latitude'];
            es_session::set("current_geo",$current_geo);
        }
        global $is_app;
        $root = array();
        $root['return'] = 1;
        $user_id = $GLOBALS['user_info']['id'];
        $not_read_msg = 0;
        if($user_id)
            $not_read_msg = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."msg_box where is_read=0 and (type='delivery' or type='notify' or type='account' or type='confirm') and user_id=".intval($user_id));
        $root['not_read_msg']=$not_read_msg;
        $city_id = $GLOBALS['city']['id'];
        $city_name =  $GLOBALS['city']['name'];

        $root['city_id'] = $city_id;
        $root['city_name'] = $city_name;
        $adv_list = $GLOBALS['cache']->get("WAP_PRESELL_INDEX_ADVS_".intval($city_id).'_'.APP_INDEX);
        $root['is_banner_square'] = 0;  //广告图，0为沃形显示，1为长方形显示

        //广告列表
        if($adv_list===false)
        {
            if(APP_INDEX=='app')
            {
                $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '0' and position=9 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                $advs = $GLOBALS['db']->getAll($sql);
                if(empty($advs))
                {
                    $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '1' and position=9 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                    $advs = $GLOBALS['db']->getAll($sql);
                }
            }
            else
            {
                $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '1' and position=9 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                $advs = $GLOBALS['db']->getAll($sql);
            }


            $adv_list = array();
            foreach($advs as $k=>$v)
            {
                $adv_list[$k]['id'] = $v['id'];
                $adv_list[$k]['name'] = $v['name'];
                $adv_list[$k]['img'] = get_abs_img_root(get_spec_image($v['img'], 375, 175,1));  //首页顶部广告图片规格为 宽: 750px 高: 350px
                $adv_list[$k]['type'] = $v['type'];
                $adv_list[$k]['data'] = $v['data'] = unserialize($v['data']);
                $adv_list[$k]['ctl'] = $v['ctl'];
            }
            $GLOBALS['cache']->set("WAP_PRESELL_INDEX_ADVS_".intval($city_id).'_'.APP_INDEX,$adv_list,300);
        }

        $root['advs'] = $adv_list?$adv_list:array();

        // 广告2
        $adv_list2 = $GLOBALS['cache']->get("WAP_PRESELL_INDEX_ADVS2_".intval($city_id).'_'.APP_INDEX);
        if($adv_list2===false)
        {
            if(APP_INDEX=='app')
            {
                $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '0' and position=10 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                $advs2 = $GLOBALS['db']->getAll($sql);
                if(empty($advs2))
                {
                    $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '1' and position=10 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                    $advs2 = $GLOBALS['db']->getAll($sql);
                }
            }
            else
            {
                $sql = " select * from ".DB_PREFIX."m_adv where mobile_type = '1' and position=10 and city_id in (0,".intval($city_id).") and status = 1 order by sort desc ";
                $advs2 = $GLOBALS['db']->getAll($sql);
            }

            $adv_list2 = array();
            foreach($advs2 as $k=>$v)
            {
                $adv_list2[$k]['id'] = $v['id'];
                $adv_list2[$k]['name'] = $v['name'];
                $adv_list2[$k]['img'] =  get_abs_img_root(get_spec_image($v['img'], 750, 190,1)); //首页中部广告图片规格为 宽: 750px 高: 140px
                $adv_list2[$k]['type'] = $v['type'];
                $adv_list2[$k]['data'] = $v['data'] = unserialize($v['data']);
                $adv_list2[$k]['ctl'] = $v['ctl'];
            }
            $GLOBALS['cache']->set("WAP_PRESELL_INDEX_ADVS2_".intval($city_id).'_'.APP_INDEX, $adv_list2, 300);
        }
        $root['advs2'] = $adv_list2?$adv_list2:array();

        //首页菜单列表
        $indexs_list = mindex_cate_menu($city_id,$page=5);

        $indexs = array();
        $indexs['list'] = $indexs_list?$indexs_list:array();
        $indexs['count'] = intval(count($indexs_list));
        $root['indexs'] = $indexs;

        $indexs_deal = $GLOBALS['cache']->get("WAP_PRESELL_INDEX_LIKE_".intval($city_id));
        if($indexs_deal === false)
        {
            require_once(APP_ROOT_PATH."system/model/deal.php");
            //获取正在预售的产品列表
            $result = get_presell_list(10,$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>$city_id),""," (d.is_presell = 1 and d.is_shop=1 and d.presell_begin_time < ".NOW_TIME." and d.presell_end_time > ".NOW_TIME.")" );

            $indexs_deal_rs = $result['list'];
            $indexs_deal = array();
            foreach($indexs_deal_rs as $k=>$v){
                $indexs_deal[$k] = format_deal_list_item($v);
                $deal_param['data_id'] = $v['id'];
                $indexs_deal[$k]['url'] = wap_url("index", 'deal', $deal_param);
            }

            $GLOBALS['cache']->set("WAP_PRESELL_INDEX_LIKE_".intval($city_id),$indexs_deal,300);
        }
        $root['deal_list'] = $indexs_deal?$indexs_deal:array();

        //推荐位
        $root['zt_html3'] = load_zt_unit('index_zt3.html',$page=5);
        $root['zt_html4'] = load_zt_unit('index_zt4.html',$page=5);
        $root['zt_html5'] = load_zt_unit('index_zt5.html',$page=5);
        $root['zt_html6'] = load_zt_unit('index_zt6.html',$page=5);

        $root['xzt_html'] = load_xzt_unit($page=5);

        $root['page']=1;
        $root['has_next']=1;
        //$root['page_title'] = $GLOBALS['m_config']['program_title']?$GLOBALS['m_config']['program_title']." - ":"";
        $root['page_title']="预售";
        $root['mobile_btns_download'] = url("index","app_download");
        $root['user_login_status'] = check_login();
        return output($root);
    }

    /**
     * wap版预售首页热销商品接口
     * 输入：
     * 无
     *
     * 输出：
     * indexs: array 首页菜单
     * 结构如下
     *
     * page_title:string 页面标题
     *
     */

    public function load_index_list_data()
    {
        $root = array();

        $city_id = $GLOBALS['city']['id'];
        require_once(APP_ROOT_PATH."system/model/deal.php");
        $page = intval($GLOBALS['request']['page']); //分页

        $page=$page==0?1:$page;
        $max_size = 50;
        $page_size = 10;
        if((($page-1)*$page_size)+$page_size<$max_size){
            $limit = (($page-1)*$page_size).",".$page_size;
        }else{
            if((($page-1)*$page_size)<$max_size)
                $limit = (($page-1)*$page_size).",".($max_size-(($page-1)*$page_size));
            else{
                $limit="100,10";
            }
        }

        $result = get_presell_list($limit,$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>$city_id),""," (d.is_presell = 1 and d.is_shop=1 and d.presell_begin_time < ".NOW_TIME." and d.presell_end_time > ".NOW_TIME.")" );

        $indexs_deal_rs = $result['list'];
        $condition = $result['condition'];
        $tname = "d";
        $sql = "select count(*) from ".DB_PREFIX."deal as ".$tname." where  ".$condition;

        $deals_count = $GLOBALS['db']->getOne($sql);
        if($deals_count>$max_size){
            $deals_count=$max_size;
        }

        $indexs_deal = array();
        foreach($indexs_deal_rs as $k=>$v){
            $indexs_deal[$k] = format_deal_list_item($v);
            $deal_param['data_id'] = $v['id'];
            $indexs_deal[$k]['url'] = wap_url("index", 'deal', $deal_param);
        }
        $root['deal_list'] = $indexs_deal?$indexs_deal:array();
        $root['page_total'] = ceil($deals_count / $page_size);

        $root['page']=$page;

        if($root['page_total']>$page){
            $root['has_next']=1;
        }else{
            $root['has_next']=0;
        }

        return output($root);
    }

}
?>