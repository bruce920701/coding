<?php
/**
 * @desc      
 * @author    郑剑峰 <zhengjf@273.cn>
 * @since     2014-11-25  
 */

namespace App\Models;
use App\Library\DB\DB;
use App\Library\Err\ErrMap;
use App\Library\Common\CommonSession;

class CityModel extends DB
{
    public function getCity($key=''){
        $current_city=array();
        if($key){
            $sql='select * from '.DB_PREFIX.'deal_city
                  where is_effect = 1 and LOCATE(name,?)';
            $param=array($key);
            $current_city = self::fetch($sql,$param);

        }
        return $current_city;
    }

    public function LocationCity($city_py=''){
        if(!$city_py)$city_py = strim($_GET['city']);
        if($city_py){
            $current_city=CommonSession::get('current_city');
            if($current_city['uname']!=$city_py&&$current_city['id']!=$city_py){
                $sql="select * from ".DB_PREFIX."deal_city
                    where (uname = ? or id = ? ) and is_effect = 1";
                $param=array($city_py,$city_py);
                $current_city=DB::fetch($sql,$param);
            }

        }
        if(empty($current_city))
        {
            //无城市，由session中获取
            $current_city = CommonSession::get("current_city");
        }
        if(empty($current_city)){
            //ip定位，未写
        }
        if(empty($current_city)){
            $sql="select * from ".DB_PREFIX."deal_city where is_default = ? and is_effect = ?";
            $param=array(1,1);
            $current_city = DB::fetch($sql,$param);

        }
        CommonSession::set('current_city',$current_city);

        return $current_city;
    }
} 