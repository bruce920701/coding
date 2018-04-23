<?php
/**
 * @desc      
 * @author    郑剑峰 <zhengjf@273.cn>
 * @since     2014-11-25  
 */

namespace App\Models;
use App\Library\DB\DB;
use App\Library\Err\ErrMap;
use App\Library\Common\CommonString;

class SupplierModel extends DB
{
    /**
     * 获取门店列表
     * @param string $limit
     * @param string $join
     * @param string $ext_condition
     * @param string $orderby
     * @param string $field_append
     * @param array $param
     * @return string
     */
    public function getLocationList($limit='',$join='',$ext_condition='',$orderby='',$field_append='',$param=array()){

        $select='select sl.id,sl.name,sl.preview,sl.deal_cate_id,sl.avg_point ';
        $from=' from '.DB_PREFIX.'supplier_location sl ';
        $where=' where sl.is_effect = 1 ';
        $sql=$select;
        if($field_append!=''){
            $sql.=$field_append;
        }
        $sql.=$from;
        if($join!=''){
            $sql.=$join;
        }
        $sql.=$where;
        if($ext_condition){
            $sql.=$ext_condition;
        }
        $sql.=' GROUP BY sl.id ';
        if($orderby){
            $sql.=' order by '.$orderby;
        }
        if($limit!=''){
            $sql.=' limit '.$limit;
        }
        $location_list=self::fetchAll($sql,$param);
        //echo "<pre>";print_r($location_list);exit;
        /*if($location_list){
            foreach($location_list as $k=>$v){
            }
        }*/
        //echo self::getLastSql();exit;
        //list(self::$errno,self::$errmsg) = ErrMap::get(2001);
        return $location_list;
    }

    /**
     * 获取门店数据
     * @param int $Location_id
     * @return bool|string
     */
    public function getLocation($Location_id=0){
        $store_info=false;
        if($Location_id>0){
            $sql='select id,name from '.DB_PREFIX.'supplier_location where id = ?';
            $param=array($Location_id);
            $store_info = self::fetch($sql,$param);
        }

        return $store_info;
    }
    /**
     * 优惠券数据格式化
     * @param array $v
     * @return array
     */
    function formatStoreItem($v=array())
    {
        $arr=array();
        $arr['shopId']=$v['id'];
        //system\common.php
        $arr['shopImg']=get_spec_image($v['preview'],92,82,1);
        $arr['shopName']=$v['name'];
        //system\common.php
        $arr['shopPoint']=format_price_html($v['avg_point'],$type=3);
        $arr['shopStar']=(($v['avg_point']/5)*100).'%';
        $arr['shopAddress']=$v['a_name']?$v['a_name']:'';
        $arr['shopDistance']=CommonString::getDistanceStr($v['distance']);
        $arr['shopType']=$v['cate_name']?$v['cate_name']:'';
        return $arr;
    }
}
