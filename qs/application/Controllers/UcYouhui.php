<?php
/**
 * @desc      
 * @author    郑剑峰 <zhengjf@273.cn>
 * @since     2014-11-25  
 */

namespace App\Controllers;
use App\Library\Common\CommonRequest;
use App\Models\YouhuiModel;
use App\Library\Common\CommonSession;
use App\Library\Err\ErrMap;
use App\Library\Common\CommonPage;

class UcYouhui
{
    public function index(){

        $youhui_list=array();
        $user_info=CommonSession::get('user_info');
        //$user_info['id']=73;

        $page=intval(CommonRequest::request('p'))==0?0:intval(CommonRequest::request('p'));
        $page_size=20;
        $limit = $page.",".$page_size;

        if($user_info){
            $youhui=new YouhuiModel();
            $youhui_list=$youhui->getUserYouhuis($limit,$user_info['id'],1);
            foreach($youhui_list as $k=>$v){
                $youhui_list[$k]=$youhui->format_youhui_item($v,1);
            }
        }else{
            list(YouhuiModel::$errno,YouhuiModel::$errmsg) = ErrMap::get(2001);
        }
        $page=CommonPage::page($page_size,($page+count($youhui_list)));
        $root=array();
        $root['page_title']='我的优惠券';
        $root['youhui_list']=$youhui_list;
        $root['page']=$page;
        CommonRequest::reponse(YouhuiModel::$errno,YouhuiModel::$errmsg,$root);
    }

    public function getLocation(){

        $location_info=array();

        $data_id=intval(CommonRequest::postRequest('data_id'));
        if($data_id>0){
            $youhui=new YouhuiModel();
            $location_info=$youhui->getYouhuiLocation($data_id);

        }else{
            list(YouhuiModel::$errno,YouhuiModel::$errmsg) = ErrMap::get(4001);
        }


        $root=array();
        $root['location_info']=$location_info;
        CommonRequest::reponse(YouhuiModel::$errno,YouhuiModel::$errmsg,$root);
    }
} 