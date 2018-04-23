<?php
/**
 * 上门服务首页接口
 *
 * @author 钱彩凡
 */
class visiting_service_listApiModule extends MainBaseApiModule
{

    /**
     * 
     */
    public function index()
    {
        //缓存下来的地区配置
        $root = array();
        $area_data = load_auto_cache("cache_area",array("city_id"=>$GLOBALS['city']['id']));
        
        $root = array();
        $cate_id = intval($GLOBALS['request']['cate_id']);//商品分类ID
        $city_id = intval($GLOBALS['city']['id']);//城市分类ID
        $page = intval($GLOBALS['request']['page']); //分页
        $keyword = strim($GLOBALS['request']['keyword']);
        $page=$page==0?1:$page;
        $quan_id = intval($GLOBALS['request']['qid']); //商圈id
        $area_id = intval($area_data[$quan_id]['pid']); //大区id
        $order_type=strim($GLOBALS['request']['order_type']);
        $ytop = $latitude_top = floatval($GLOBALS['request']['latitude_top']);//最上边纬线值 ypoint
        $ybottom = $latitude_bottom = floatval($GLOBALS['request']['latitude_bottom']);//最下边纬线值 ypoint
        $xleft = $longitude_left = floatval($GLOBALS['request']['longitude_left']);//最左边经度值  xpoint
        $xright = $longitude_right = floatval($GLOBALS['request']['longitude_right']);//最右边经度值 xpoint
        $ypoint =  $m_latitude = $GLOBALS['geo']['ypoint'];  //ypoint
        
        $xpoint = $m_longitude = $GLOBALS['geo']['xpoint'];  //xpoint

        $root['keyword']=$keyword;
        
        /*输出分类*/
        $cate_where="";
        $cate_join="";
        if($quan_id){
            $cate_join=" left join ".DB_PREFIX."supplier_location_area_link as la on la.location_id=l.id ";
            $cate_where=" and area_id=".$quan_id." ";
        }
        $cate_sql="select sc.id,sc.pid,sc.name,COUNT(sl.id) as count from ".DB_PREFIX."service_cate as sc 
                left join ".DB_PREFIX."supplier_visiting_services as vs on find_in_set(sc.name,vs.cate_match_row)
                left join ".DB_PREFIX."supplier_location_service_link as sl on sl.supplier_vs_id = vs.id 
                LEFT JOIN ".DB_PREFIX."supplier_location as l on l.id=sl.location_id ".$cate_join."
                WHERE sc.is_delete=0 and sl.is_close=0 and vs.is_delete=0 and vs.is_effect=1 and l.city_id=".$city_id." 
                and (vs.begin_time<".NOW_TIME." or vs.begin_time=0) and (vs.end_time>".NOW_TIME." or vs.end_time=0) ".$cate_where." GROUP BY sc.id ORDER BY sc.pid";
        $all_count="select COUNT(*) from ".DB_PREFIX."supplier_location_service_link as sl 
                left join ".DB_PREFIX."supplier_visiting_services as vs on sl.supplier_vs_id = vs.id              
                LEFT JOIN ".DB_PREFIX."supplier_location as l on l.id=sl.location_id ".$cate_join."
                WHERE sl.is_close=0 and vs.is_delete=0 and vs.is_effect=1 and l.city_id=".$city_id."
                and (vs.begin_time<".NOW_TIME." or vs.begin_time=0) and (vs.end_time>".NOW_TIME." or vs.end_time=0)".$cate_where;
    
        $cate_list=$GLOBALS['db']->getAll($cate_sql);
        $all_count=$GLOBALS['db']->getOne($all_count);
        
        $bcate_list = array(
            array(
                "id"	=>	0,
                "name"	=>	"全部分类",
                "bcate_type"	=>	array(
                    array(
                        "id"	=>	0,
                        "cate_id"	=>	0,
                        "name"	=>	"全部分类",
                        "count" => $all_count,
                    )
                )
            )
        );
        $cate=array();
        foreach ($cate_list as $t => $v){
            
            if($v['pid']==0){
                $p_cate=array(
                    "id"	=>	$v['id'],
                    "name"	=>	$v['name'],
                    "bcate_type"	=>	array(
                        array(
                            "id"	=>	$v['id'],
                            "cate_id"	=>	$v['id'],
                            "name"	=>	"全部分类",
                            "count" =>  $v['count'],
                        )
                    )
                );
                if($v['id']==$GLOBALS['request']['cate_id']){
                    $root['default_cate_id']=$v['id'];
                    $catename=$v['name'];
                    $p_cate['bcate_type'][0]['is_checked']=1;
                }
                $bcate_list[]=$p_cate;
            }else {
                $sub_cate=array(
                    "id" => $v['id'],
                    "cate_id" => $v['id'],
                    "name" => $v["name"],
                    "count" => $v['count'],
                );
                if($v['id']==$GLOBALS['request']['cate_id']){
                    $root['default_cate_id']=$v['id'];
                    $catename=$v['name'];
                    $sub_cate['is_checked']=1;
                }
                $cate[$v['pid']][]=$sub_cate;
            }
        }
        
        foreach ($bcate_list as $t => $v){
            foreach ($cate[$v['id']] as $tt => $vv){
                $bcate_list[$t]['bcate_type'][]=$vv;
            }
        }
        
        sort($bcate_list);
        
        /*输出商圈*/
        $quan_where = "";
        if($catename){
            $quan_where .= " and find_in_set('".$catename."',cate_match_row) ";
        }
        $quan_sql="select la.area_id as id,count(sl.id) as count from fanwe_supplier_location_service_link as sl 
                   left join fanwe_supplier_visiting_services as vs on sl.supplier_vs_id = vs.id              
                   LEFT JOIN fanwe_supplier_location as l on l.id=sl.location_id
                   left join fanwe_supplier_location_area_link as la on la.location_id=l.id
                   WHERE sl.is_close=0 and vs.is_delete=0 and vs.is_effect=1 and l.city_id=".$city_id." ".$quan_where."
                   and (vs.begin_time<".NOW_TIME." or vs.begin_time=0) and (vs.end_time>".NOW_TIME." or vs.end_time=0) GROUP BY la.area_id";
        $quan_all_sql= "select count(*) from fanwe_supplier_location_service_link as sl 
                   left join fanwe_supplier_visiting_services as vs on sl.supplier_vs_id = vs.id              
                   LEFT JOIN fanwe_supplier_location as l on l.id=sl.location_id
                   WHERE sl.is_close=0 and vs.is_delete=0 and vs.is_effect=1 and l.city_id=".$city_id.$quan_where."
                   and (vs.begin_time<".NOW_TIME." or vs.begin_time=0) and (vs.end_time>".NOW_TIME." or vs.end_time=0)";
        
        $quan_id_list=$GLOBALS['db']->getAll($quan_sql);
        $quan_all_count=$GLOBALS['db']->getOne($quan_all_sql);
        
        $quan_list=array(
            array(
                'id' => 0,
                'name' => '全城',
                'quan_sub' => Array
                (
                    Array
                    (
                        'id' => 0,
                        'pid' => 0,
                        'name' => '全城',
                        'count' => $quan_all_count,
                    ),
                ),
            ),
        );
        $quan=array();
        foreach ($quan_id_list as $t => $v){
            if($area_data[$v['id']]['pid']==0){
                $p_quan=array(
                    'id' => $area_data[$v['id']]['id'],
                    'name' => $area_data[$v['id']]['name'],
                    'quan_sub' => Array
                    (
                        Array
                        (
                            'id' => $area_data[$v['id']]['id'],
                            'pid' => 0,
                            'name' => '全部',
                            'count' => $v['count'],
                        ),
                    ),
                );
                $quan_list[]=$p_quan;
            }else{
                $sub_cate=array(
                    "id" => $area_data[$v['id']]['id'],
                    "pid" => $area_data[$v['id']]['pid'],
                    "name" => $area_data[$v['id']]["name"],
                    "count" => $v['count'],
                );
                $quan[$area_data[$v['id']]['pid']][]=$sub_cate;
            }
        }
        foreach ($quan_list as $t => $v){
            foreach ($quan[$v['id']] as $tt => $vv){
                $quan_list[$t]['quan_sub'][]=$vv;
            }
        }
        sort($quan_list);
        
        $page_size = 20;
        $limit = (($page-1)*$page_size).",".$page_size;

        $ext_condition = " sl.is_close =0 and vs.is_effect=1 and vs.is_delete=0 and si.is_main=1 and (vs.begin_time<".NOW_TIME." or vs.begin_time=0) and (vs.end_time>".NOW_TIME." or vs.end_time=0) ";
        
        if($city_id>0)
        {
            $join=" left join ".DB_PREFIX."supplier_location as l on l.id=sl.location_id ";
            $ext_condition .= " and l.city_id = ".$city_id." ";
        }
        
       
        if($cate_id){
            $cate_name=$GLOBALS['db']->getOne("select name from ".DB_PREFIX."service_cate where id=".$cate_id);
            $ext_condition .= " and find_in_set('".$cate_name."',cate_match_row)";
        }
        
        if($quan_id){
            $join .= " left join ".DB_PREFIX."supplier_location_area_link as la on la.location_id=l.id ";
            $ext_condition .= " and la.area_id = ".$quan_id;
        }
        
		if($keyword)
        {
            $ext_condition.=" and vs.name like '%".$keyword."%' ";
        }

        if($xpoint>0)/* 排序（$order_type）  default 智能（默认）*/
        {
            $pi = PI;  //圆周率
            $r = EARTH_R;  //地球平均半径(米)
            $field_append = ", (ACOS(SIN(($ypoint * $pi) / 180 ) *SIN((l.ypoint * $pi) / 180 ) +COS(($ypoint * $pi) / 180 ) * COS((l.ypoint * $pi) / 180 ) *COS(($xpoint * $pi) / 180 - (l.xpoint * $pi) / 180 ) ) * $r) as distance ";
            	
            if($ybottom!=0&&$ytop!=0&&$xleft!=0&&$xright!=0)
            {
                if($ext_condition!="")
                    $ext_condition.=" and ";
                $ext_condition.= " l.ypoint > $ybottom and l.ypoint < $ytop and l.xpoint > $xleft and l.xpoint < $xright ";
            }
            $order = " (ACOS(SIN(($ypoint * $pi) / 180 ) *SIN((l.ypoint * $pi) / 180 ) +COS(($ypoint * $pi) / 180 ) * COS((l.ypoint * $pi) / 180 ) *COS(($xpoint * $pi) / 180 - (l.xpoint * $pi) / 180 ) ) * $r) asc ";
        }
        else
            $order = " vs.id ";

        /*排序
                    智能排序和 离我最的 是一样的 都以距离来升序来排序，只有这两种情况有传经纬度过来，就没有把 这两种情况写在 下面的判断里，写在上面了。
        default 智能（默认），nearby  离我，avg_point 评价，newest 最新，buy_count 人气，price_asc 价低，price_desc 价高 */
			if($order_type=='avg_point')/*评价*/
	            $order= " l.dp_count>0 desc,l.avg_point desc  ";
	        else
	        	$order= " (ACOS(SIN(($ypoint * $pi) / 180 ) *SIN((l.ypoint * $pi) / 180 ) +COS(($ypoint * $pi) / 180 ) * COS((l.ypoint * $pi) / 180 ) *COS(($xpoint * $pi) / 180 - (l.xpoint * $pi) / 180 ) ) * $r)  ";
	       
        	
        $location_sql = "select sl.location_id as id,l.name as location_name,l.avg_point".$field_append."  from ".DB_PREFIX."supplier_location_service_link as sl 
               left join ".DB_PREFIX."supplier_visiting_services as vs on sl.supplier_vs_id=vs.id 
               left join ".DB_PREFIX."common_service_img as si on si.supplier_service_id = vs.id ".$join."
               where ".$ext_condition." group by sl.location_id ORDER BY ".$order." limit ".$limit;
        $location_list=$GLOBALS['db']->getAll($location_sql);
        
        $location_id=array();
        foreach ($location_list as $t => $v){
            $location_id[]=$v['id'];
        }
        
        $sql_count =  "select count(*) from (select sl.location_id as id  from ".DB_PREFIX."supplier_location_service_link as sl 
                       left join ".DB_PREFIX."supplier_visiting_services as vs on sl.supplier_vs_id=vs.id 
                       left join ".DB_PREFIX."common_service_img as si on si.supplier_service_id = vs.id ".$join."
                       where ".$ext_condition." group by sl.location_id) as t ";
        
        $sql = "select vs.id as id,sl.location_id,l.name as location_name,l.avg_point,vs.name,si.img,vs.current_price,vs.origin_price,sl.buy_count".$field_append."
               from ".DB_PREFIX."supplier_location_service_link as sl
               left join ".DB_PREFIX."supplier_visiting_services as vs on sl.supplier_vs_id=vs.id
               left join ".DB_PREFIX."common_service_img as si on si.supplier_service_id = vs.id ".$join."
               where ".$ext_condition." and sl.location_id in (".implode(',',$location_id).") group by sl.id ORDER BY ".$order;
        $list=$GLOBALS['db']->getAll($sql);
        
        foreach ($location_list as $t => $v){
            
            $location_list[$t]['avg_point']=round($v['avg_point'],1);
            $location_list[$t]['bfb']=round($v['avg_point'],1)/5*100;
            if($v['distance']<1000){
                $location_list[$t]['distance']=round($v['distance'])."m";
            }else{
                $location_list[$t]['distance']=round($v['distance']/1000,2)."km";
            }
            
            foreach ($list as $tt => $vv){
                $vv['img']=get_abs_img_root(get_spec_image($vv['img'], 135, 135,1));
                $vv['current_price']=format_price($vv['current_price']);
                $vv['origin_price']=format_price($vv['origin_price']);
                
                if($vv['location_id'] == $v['id']){
                    $location_list[$t]['list'][]=$vv;
                }
            }
            
        }
        
        $root['location_list']=$location_list?$location_list:array();
        
        $data_count= $GLOBALS['db']->getOne($sql_count);
        
        $page_total = ceil($data_count/$page_size);

        $city_str=implode(",",load_auto_cache("deal_city_belone_ids",array("city_id"=>$city_id)));
		//一级分类
        $time = NOW_TIME;
        
        
        $root['city_id']= $city_id;
        $root['area_id']= $area_id;
        $root['quan_id']= $quan_id;
        $root['cate_id']=$cate_id;

        //$root['page_title'] = $GLOBALS['m_config']['program_title']?$GLOBALS['m_config']['program_title']." - ":"";
        $root['page_title']="服务列表";

        $root['page'] = array("page"=>$page,"page_total"=>$page_total,"page_size"=>$page_size,"data_total"=>$data_count);
        
		//$quan_list[0]['quan_sub']['0']['count']=$GLOBALS['db']->getOne('select count(*) as count from '.DB_PREFIX."deal d   where".$cata_where.$where);
        //全部分类的个数计算
		$root['catename']=$catename?$catename:"全部分类";
		$root['bcate_list'] = $bcate_list?$bcate_list:array();
        $root['quan_list'] = $quan_list?$quan_list:array();
		$root['quanname'] = $area_data[$GLOBALS['request']['qid']]['name']?$area_data[$GLOBALS['request']['qid']]['name']:"全城·热门";	

        return output($root);
    }
    
    public function build_deal_filter_condition($param,$tname="")
    {
        $area_id = intval($param['aid']);
        $quan_id = intval($param['qid']);
        $cate_id = intval($param['cid']);
        $condition = "";
        
        if($area_id>0)
        {
            if($quan_id>0)
            {
    
                $area_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."area where id = ".$quan_id);
                $kw_unicodes[] = str_to_unicode_string($area_name);
    
                $kw_unicode = implode(" ",$kw_unicodes);
                //有筛选
                $condition .=" and (match(sl.locate_match) against('".$kw_unicode."' IN BOOLEAN MODE)) ";
            }
            else
            {
                $ids = load_auto_cache("deal_quan_ids",array("quan_id"=>$area_id));
                $quan_list = $GLOBALS['db']->getAll("select `name` from ".DB_PREFIX."area where id in (".implode(",",$ids).")");
                $unicode_quans = array();
                foreach($quan_list as $k=>$v){
                    $unicode_quans[] = str_to_unicode_string($v['name']);
                }
                $kw_unicode = implode(" ", $unicode_quans);
                $condition .= " and (match(sl.locate_match) against('".$kw_unicode."' IN BOOLEAN MODE))";
            }
        }
    
        if($cate_id>0)
        {
            $cate_name=$GLOBALS['db']->getOne("select name from ".DB_PREFIX."service_name where id=".$cate_id);
            $kw_unicode = str_to_unicode_string($cate_name);
            
            $cate_name_unicode = str_to_unicode_string($cate_name);
            
            $condition .= " and (match(d.cate_match) against('".$cate_name_unicode."' IN BOOLEAN MODE)) ";
                
        }
        return $condition;
    }
    
}