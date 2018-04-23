<?php
/**
 * @desc      
 * @author    郑剑峰 <zhengjf@273.cn>
 * @since     2014-11-25  
 */

namespace App\Controllers;
use App\Models\SupplierModel;
use App\Library\Common\CommonRequest;
use App\Models\YouhuiModel;
use App\Library\Common\CommonSession;
use App\Library\Err\ErrMap;
use App\Models\CityModel;
use App\Library\Common\CommonPage;


class Youhui
{
    /**
     * 获取门店下属的实体优惠券
     * @param int $data_id 门店id
     * @return array|string
     */
    public function locationEntityYouhuis(){

        $location_id=intval(CommonRequest::request('data_id'));

        $page=intval(CommonRequest::request('p'))==0?0:intval(CommonRequest::request('p'));
        $page_size=20;
        $limit = $page.",".$page_size;

        $location_info=array();
        $youhui_list=array();
        if($location_id>0){
            $supplier=new SupplierModel();
            $location_info=$supplier->getLocation($location_id,1);
            if($location_info){
                $user_info=CommonSession::get('user_info');
                $user_id=intval($user_info['id']);
                //$user_id=73;
                $youhui=new YouhuiModel();
                $youhui_list=$youhui->getLocationYouhuis($location_id,1,$user_id,$limit);
                foreach($youhui_list as $k=>$v){
                    $youhui_list[$k]=$youhui->format_youhui_item($v,0,$user_id);
                }
            }else{
                list(YouhuiModel::$errno,YouhuiModel::$errmsg) = ErrMap::get(3001);
            }

        }else{
            list(YouhuiModel::$errno,YouhuiModel::$errmsg) = ErrMap::get(4001);
        }
        $page=CommonPage::page($page_size,($page+count($youhui_list)));
        //echo 1;exit;
        $root=array();
        $root['page_title']=$location_info['name'];
        $root['location_info']=$location_info;
        $root['youhui_list']=$youhui_list;
        $root['page']=$page;
        CommonRequest::reponse(YouhuiModel::$errno,YouhuiModel::$errmsg,$root);
    }

    /**
     * @param int $cate_id 分类id
     * @param int $p 分页
     * @return array()
     */
    public function youhuiList(){

        $wx_user_info=CommonSession::get('wx_user_info');
        $city=CityModel::LocationCity($wx_user_info['city']);

        $cate_id=intval(CommonRequest::request('cate_id'));

        $page=intval(CommonRequest::request('p'))==0?0:intval(CommonRequest::request('p'));
        $page_size=20;
        $limit = $page.",".$page_size;

        $field_append='';
        $join='';
        $ext_condition='';
        $orderby=' id ';
        $param=array();

        $user_info=CommonSession::get('user_info');
        $user_id=intval($user_info['id']);
        //$user_id=73;
        $field_append.=',s.name AS supplier_name ';
        if($user_id>0){
            $field_append.=',user_limit,begin_time,end_time,user_everyday_limit,total_num,
                count(yl.id) use_count,uys.id uys_id,uys.user_count,user_day_count';
        }
        $join.=' LEFT JOIN fanwe_supplier AS s ON s.id = y.supplier_id ';
        if($user_id>0){
            $join.=' left join '.DB_PREFIX.'youhui_log yl on y.id=yl.youhui_id and yl.user_id= ?
                    and yl.confirm_time=0 and (yl.expire_time=0 or (yl.expire_time<>0 and yl.expire_time > ?))
                    left join '.DB_PREFIX.'user_youhui_statistics uys on y.id=uys.youhui_id and yl.user_id= ?
                    and stat_time= ?
                    ';
            //system\common.php
            $param=array_merge($param,array($user_id,NOW_TIME,$user_id,to_date(NOW_TIME,"Y-m-d")));
        }
        $ext_condition.=' AND (
                            y.valid_type = 1
                            OR (
                                y.valid_type = 2
                                AND ( y.use_end_time = 0  OR y.use_end_time > ? )
                            )
                        )
                        AND  ( y.youhui_type = 1 AND y.city_id = ? )
                        AND (
                            y.begin_time < ?  OR y.begin_time = 0
                        )';
        $param=array_merge($param,array(NOW_TIME,$city['id'],NOW_TIME));
        if($cate_id>0){
            $ext_condition .= " and y.deal_cate_id= ?  ";
            $param=array_merge($param,array($cate_id));
        }

        $orderby=' sort_status,y.create_time DESC ';

        $youhui=new YouhuiModel();
        $youhui_list=$youhui->getYouhuiList($limit,$field_append,$join,$ext_condition,$orderby,$param);
        //echo "<pre>";print_r($youhui_list);exit;
        foreach($youhui_list as $k=>$v){
            $youhui_list[$k]=$youhui->format_youhui_item($v,0,$user_id);
        }

        $bcate_list = $youhui->getYouhuiCateList(1);

        $page=CommonPage::page($page_size,($page+count($youhui_list)));
        //echo 1;exit;
        $root=array();
        $root['page_title']='领券中心';
        $root['bcate_list']=$bcate_list;
        $root['youhui_list']=$youhui_list;
        $root['page']=$page;
        CommonRequest::reponse(0,'请求成功',$root);
    }

    /**
     * 领券接口
     * @param int $data_id 优惠券id
     * @return array()
     */
    public function downloadYouhui(){

        $user_info=CommonSession::get('user_info');
        //$user_info['id']=73;
        $status=0;
        $youhui_status=-1;
        if($user_info){
            $data_id=intval(CommonRequest::postRequest('data_id'));
            if($data_id>0){
                $youhui=new YouhuiModel();
                $result=$youhui->downloadYouhui($data_id,$user_info['id']);
                //echo '<pre>';print_r($result);exit;
                $youhui_status=$result['youhui_status'];
                $status=$result['status'];
                $info=$result['info'];
            }else{
                list(YouhuiModel::$errno,YouhuiModel::$errmsg) = ErrMap::get(4001);
            }
        }else{
            list(YouhuiModel::$errno,YouhuiModel::$errmsg) = ErrMap::get(2001);
        }
        $root=array();
        $root['youhui_status']=$youhui_status;
        $root['status']=$status;
        $root['info']=$info;
        CommonRequest::reponse(YouhuiModel::$errno,YouhuiModel::$errmsg,$root);
    }
} 