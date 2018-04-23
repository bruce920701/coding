<?php

/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/10
 * Time: 00:03
 */
namespace App\Controllers;
use App\Models\SupplierModel;
use App\Library\Common\CommonRequest;
use App\Library\Common\CommonPage;


class Index
{
    /**
     * @param string $key 关键词
     * @param int $p 分页
     * @return array()
     */
    public function index(){

        $location_list=array();
        $historyList=array();
        if(!$location_list){//获取门店列表


            if(CommonRequest::postRequest('historyList')){
                $historyList=json_decode(CommonRequest::postRequest('historyList'));
                $historyList=is_array($historyList)?$historyList:array();
                $historyList=array_reverse($historyList);
                $historyList=array_unique($historyList);
                $historyList=array_reverse($historyList);
                $historyList=array_slice($historyList,-10);
            }
            $key=strim(CommonRequest::request('key'));
            $page=intval(CommonRequest::request('p'))==0?0:intval(CommonRequest::request('p'));
            $page_size=20;
            $limit = $page.",".$page_size;

            $ypoint=intval(CommonRequest::request('ypoint'));
            $xpoint=intval(CommonRequest::request('xpoint'));

            $join='';
            $ext_condition='';
            $orderby=' id ';
            $field_append='';
            $param=array();
            if($ypoint>0&&$xpoint>0){
                $pi = PI;  //圆周率
                $r = EARTH_R;  //地球平均半径(米)
                $field_append = ", (ACOS(SIN((? * $pi) / 180 ) *SIN((sl.ypoint * $pi) / 180 )
                                +COS((? * $pi) / 180 ) * COS((sl.ypoint * $pi) / 180 ) *COS((? * $pi) / 180
                                - (sl.xpoint * $pi) / 180 ) ) * $r) as distance ";
                $param=array_merge($param,array($ypoint,$ypoint,$xpoint));
                //$field_append = ", (ACOS(SIN(($ypoint * $pi) / 180 ) *SIN((sl.ypoint * $pi) / 180 )
                //                +COS(($ypoint * $pi) / 180 ) * COS((sl.ypoint * $pi) / 180 ) *COS(($xpoint * $pi) / 180
                //                - (sl.xpoint * $pi) / 180 ) ) * $r) as distance ";
                //控制查询距离 111公里内
                //$ext_condition.= " and sl.ypoint > ? and sl.ypoint < ?
                //                    and sl.xpoint > ? and sl.xpoint < ?";
                //$param=array_merge($param,array($ypoint-1,$ypoint+1,$xpoint-1,$xpoint+1));
                //$ext_condition.= " and sl.ypoint > ".($ypoint-1)." and sl.ypoint < ".($ypoint+1)."
                //                    and sl.xpoint > ".($xpoint-1)." and sl.xpoint < ".($xpoint+1);
                $orderby = " distance asc ";
            }
            $field_append.=',y.id yid,dc.name cate_name,a.name a_name';
            $join.=' LEFT JOIN '.DB_PREFIX.'youhui_location_link yll on sl.id=yll.location_id
                     LEFT JOIN '.DB_PREFIX.'deal_cate dc on sl.deal_cate_id=dc.id
	                 LEFT JOIN '.DB_PREFIX.'youhui y on yll.youhui_id=y.id
						and y.youhui_type = 1 and y.is_effect=1
						and (( y.begin_time=0 or y.begin_time< ? ) and (y.end_time=0 or y.end_time> ? ))
					 LEFT JOIN '.DB_PREFIX.'supplier_location_area_link sla ON sl.id = sla.location_id
                     LEFT JOIN '.DB_PREFIX.'area a ON a.id = sla.area_id and a.pid=0';
            $ext_condition.=' and y.id>0 ';
            $param=array_merge($param,array(NOW_TIME,NOW_TIME));
            if($key){
                //system\common.php
                $kw_unicode = str_to_unicode_string($key);
                $ext_condition.=" and ( sl.name_match_row like ? or match(sl.tags_match) against(? IN BOOLEAN MODE) ) ";
                $param=array_merge($param,array('%'.$key.'%',$kw_unicode));
            }
            $supplier=new SupplierModel();
            $location_list=$supplier->getLocationList($limit,$join,$ext_condition,$orderby,$field_append,$param);
            $location_list=$location_list?$location_list:array();
            //echo "<pre>";print_r($list);exit;
            foreach($location_list as $k=>$v){
                $location_list[$k]=$supplier->formatStoreItem($v);
            }
        }
        $page=CommonPage::page($page_size,($page+count($location_list)));
        $root=array();
        $root['page_title']='方维小程序';
        $root['shopList']=$location_list;
        $root['historyList']=$historyList;
        $root['page']=$page;

        CommonRequest::reponse(SupplierModel::$errno,SupplierModel::$errmsg,$root);

    }
}