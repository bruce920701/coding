<?php
/**
 * @desc      
 * @author    郑剑峰 <zhengjf@273.cn>
 * @since     2014-11-25  
 */

namespace App\Models;
use App\Library\DB\DB;
use App\Library\Err\ErrMap;

class YouhuiModel extends DB
{
    /**
     * 获取优惠券列表
     * @param string $limit
     * @param string $field_append
     * @param string $join
     * @param string $ext_condition
     * @param string $orderby
     * @param array $param
     * @return array|string
     */
    public function getYouhuiList($limit='',$field_append='',$join='',$ext_condition='',$orderby='',$param=array()){
        $select='select y.id,
                        y.name,
                        y.supplier_id,
                        y.youhui_type,
                        y.youhui_value,
                        y.start_use_price,
                        y.valid_type,
                        y.expire_day,
                        y.use_end_time,
                        CASE
                        WHEN (
                            end_time <> 0
                            AND end_time < 1502993335
                        ) THEN
                            2
                        WHEN (
                            y.total_num <> 0
                            AND y.total_num <= y.user_count
                        ) THEN
                            1
                        ELSE
                            0
                        END sort_status';
        $from=' from '.DB_PREFIX.'youhui y ';
        $where=' where y.is_effect = 1 ';
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
        $sql.=' GROUP BY y.id ';
        if($orderby){
            $sql.=' order by '.$orderby;
        }
        if($limit!=''){
            $sql.=' limit '.$limit;
        }
        $youhui_list=self::fetchAll($sql,$param);
        //echo $sql;echo "<pre>";print_r($param);exit;
        //echo self::getLastSql();exit;
        return $youhui_list;
    }

    /**
     * 获取门店下属的优惠券
     * @param int $Location_id
     * @param int $youhui_type
     * @return array|string
     */
    public function getLocationYouhuis($Location_id=0,$youhui_type=1,$user_id=0,$limit=''){

        $youhui_list=array();
        $select='';
        $left_where='';
        $param=array(NOW_TIME,NOW_TIME);
        if($user_id>0){
            $select.= 'user_limit,begin_time,end_time,user_everyday_limit,total_num
                ,count(yl.id) use_count,uys.id uys_id,uys.user_count,user_day_count,';
            $left_where.=' left join '.DB_PREFIX.'youhui_log yl on yll.youhui_id=yl.youhui_id and yl.user_id= ?
                    and yl.confirm_time=0 and (yl.expire_time=0 or (yl.expire_time<>0 and yl.expire_time > ?))
                    left join '.DB_PREFIX.'user_youhui_statistics uys on yll.youhui_id=uys.youhui_id and yl.user_id= ?
                    and stat_time= ?
                    ';
            //system\common.php
            $param_s=array($user_id,NOW_TIME,$user_id,to_date(NOW_TIME,"Y-m-d"));
            $param=array_merge($param,$param_s);
        }
        $param=array_merge($param,array($Location_id));
        if($youhui_type==1){//获得实体券
            $sql='SELECT
                    y.id,
                    y.name,
                    y.supplier_id,
                    y.youhui_type,
                    y.youhui_value,
                    y.start_use_price,
                    y.valid_type,
                    y.expire_day,
                    y.use_end_time,
                    s.name as supplier_name,
                    '.$select.'
                    y.total_num,
                    y.user_count,
                    case
                    WHEN  (
                        y.total_num <> 0
                        AND y.total_num <= y.user_count
                    ) THEN
                        1
                    ELSE
                        0
                    END sort_status
                FROM
                   '.DB_PREFIX.'youhui_location_link yll
                LEFT JOIN '.DB_PREFIX.'youhui y ON yll.youhui_id = y.id and y.youhui_type=1 and y.is_effect=1
                        and (( y.begin_time=0 or y.begin_time< ? ) and (y.end_time=0 or y.end_time> ? ))
                left join '.DB_PREFIX.'supplier s on s.id=y.supplier_id
                '.$left_where.'
                where
                    yll.location_id=? and y.id>0 GROUP BY y.id  order by y.youhui_value desc ';
            if($limit){
                $sql.=' LIMIT '.$limit;
            }
            $youhui_list=self::fetchAll($sql,$param);
            //echo self::getLastSql();exit;
        }
        return $youhui_list;
    }

    /**
     * 优惠券数据格式化
     * @param array $v
     * @return array
     */
    function format_youhui_item($v=array(),$is_user=0,$user_id=0)
    {
        $arr=array();
        $arr['youhuiId']=$v['id'];
        if($is_user==0){
            if($user_id>0){
                if(!$v['uys_id']>0){
                    //system\common.php
                    $youhui_use_statistics=getYouhuiStatistics($v['id'],$user_id);
                    $v['user_count']=$youhui_use_statistics['user_count'];
                    $v['user_day_count']=$youhui_use_statistics['user_day_count'];
                }
                //echo $v['use_count'];exit;
                $youhui_status=$this->getYouhuiStatus($v,$v['user_count'],$v['user_day_count'],$v['use_count']);
                $arr['status']=$youhui_status['status'];
                $arr['status_info']=$youhui_status['info'];
            }else{
                $arr['status']=$v['sort_status'];
                if($v['sort_status']==1){
                    $arr['status_info']='券已领完';
                }elseif($v['sort_status']==2){
                    $arr['status_info']='活动已结束';
                }else{
                    $arr['status_info']='立即领取';
                }
            }
        }else{
            $arr['youhuiCode']=$v['youhui_sn'];
            $arr['status']=$v['order_status'];
            if($v['order_status']==1){
                $arr['status_info']='已使用';
            }elseif($v['order_status']==2){
                $arr['status_info']='已过期';
            }else{
                $arr['status_info']='待使用';
            }
        }

        $arr['youhuiPrice']=$v['youhui_value'];
        $arr['youhuiPriceRule']=$v['start_use_price']?'满'.$v['start_use_price'].'元可用':'无使用限制';
        $arr['youhuiName']=$v['supplier_id']>0?'店铺券':'自营券';

        $arr['youhuiTime']='有效期至：';
        if($v['valid_type']==2&&$v['use_end_time']){
            $arr['youhuiTime'].=to_date($v['use_end_time'],'Y-m-d H:i');
        }elseif($v['valid_type']==1&&$v['expire_day']){
            $arr['youhuiTime'].='领取之日起'.$v['expire_day'].'天有效';
        }else{
            $arr['youhuiTime'].='永久';
        }
        $arr['youhuiShopRule'].='限['.$v['supplier_name'].']店铺商品使用';

        return $arr;
    }

    /**
     * 获取领券中心分类
     * @return array
     */
    function getYouhuiCateList($youhui_type=0){

        if($youhui_type==1){
            $youhui_where=' and y.youhui_type=1 ';
        }elseif($youhui_type==2){
            $youhui_where=' and y.youhui_type=2 ';
        }else{
            $youhui_where=' ';
        }
        $sql = 'SELECT
                    dc.id,
                    dc.name
                FROM
                    '.DB_PREFIX.'deal_cate dc
                LEFT JOIN '.DB_PREFIX.'youhui y on dc.id=y.deal_cate_id
                    '.$youhui_where.'
                    and y.is_effect=1
                    and (( y.begin_time=0 or y.begin_time< ? )
                    and (y.end_time=0 or y.end_time> ? ))
                WHERE
                dc.is_effect = 1
                AND dc.is_delete = 0
                and y.id>0
                GROUP BY dc.id';
        $param=array(NOW_TIME,NOW_TIME);
        $cate_list_rs = self::fetchAll($sql,$param);
        $cate_list_rs=$cate_list_rs?$cate_list_rs:array();
        $cate_list = array(
            array(
                "id"	=>	0,
                "name"	=>	"精选"
            )
        );
        foreach($cate_list_rs as $v)
        {
            $cate = array();
            $cate['id'] = $v['id'];
            $cate['name'] = $v['name']?$v['name']:"";

            $cate_list[] = $cate;
        }

        return $cate_list;
    }

    /**
     * 领券优惠券
     * @param int $data_id
     * @param int $user_id
     * @return array
     */
    function downloadYouhui($data_id=0,$user_id=0){
        $youhui_status=-1;
        $is_update=0;
        $status=0;
        $info=0;
        if($data_id>0&&$user_id>0){
            $youhui_info=self::getYouhui($data_id);
            if($youhui_info){
                if($youhui_info['begin_time']!=0&&$youhui_info['begin_time']>NOW_TIME){
                    $status=0;
                    $info='活动未开始,优惠券不能领取';
                }elseif($youhui_info['end_time']!=0&&$youhui_info['end_time']<=NOW_TIME){
                    $status=0;
                    $info='活动已过期,优惠券不能领取';
                }else{
                    $is_err=0;
                    if($youhui_info['user_everyday_limit']>0){
                        //system\common.php
                        $date_begin = to_timespan(to_date(NOW_TIME,"Y-m-d"),"Y-m-d");
                        $date_end = $date_begin+24*3600;
                        //验证每日限量
                        $sql="select count(*) from ".DB_PREFIX."youhui_log
                            where user_id = ? and youhui_id = ?
                            and create_time > ? and create_time < ?";
                        $param=array($user_id,$youhui_info['id'],$date_begin,$date_end);
                        $user_day_count = self::fetchOnly($sql,$param);
                        $user_day_count=$user_day_count?$user_day_count:0;
                        if($user_day_count>=$youhui_info['user_everyday_limit'])
                        {
                            $status=0;
                            $info="每人每天最多领取".$user_day_count."张优惠券";
                            $is_err=1;
                        }
                    }


                    if($is_err==0&&$youhui_info['user_limit']>0){
                        $sql="select count(*) from ".DB_PREFIX."youhui_log where user_id = ? and youhui_id = ?";
                        $param=array($user_id,$youhui_info['id']);
                        $user_day_count = self::fetchOnly($sql,$param);
                        $user_day_count=$user_day_count?$user_day_count:0;
                        if($user_day_count>=$youhui_info['user_limit']){
                            $status=0;
                            $info="您已经领取了".$user_day_count."张了，留一点给别人吧~";
                            $is_err=1;
                        }
                    }

                    if($is_err==0){
                        $sql="update ".DB_PREFIX."youhui set
                                user_count = user_count + 1
                                where id = ? and (user_count + 1 <= total_num or total_num=0)";
                        $param=array($youhui_info['id']);
                        $result=self::update($sql,$param);
                        if($result>0){
                            $field_data=array();
                            $field_data['youhui_id'] = $youhui_info['id'];
                            $field_data['user_id'] = $user_id;

                            $sql="select mobile from ".DB_PREFIX."user where id = ?";
                            $param=array($user_id);
                            $field_data['mobile'] = self::fetchOnly($sql,$param);

                            $field_data['create_time'] = NOW_TIME;

                            if($youhui_info['expire_day']>0 && $youhui_info['valid_type']==1){
                                $field_data['expire_time'] = NOW_TIME + $youhui_info['expire_day']*3600*24;
                            }else if($youhui_info['use_end_time']>0 && $youhui_info['valid_type']==2){
                                $field_data['expire_time'] = $youhui_info['use_end_time'];
                            }else{
                                $field_data['expire_time'] = 0;
                            }
                            while(intval($field_data['id'])==0)
                            {
                                $field_data['youhui_sn'] = '2' . substr(NOW_TIME, 1, 9). sprintf('%02s', rand(0, 99));
                                $field_data['id']=self::insert(DB_PREFIX.'youhui_log',$field_data);
                            }

                            $content="您已成功获得".$youhui_info['name']."，请及时使用";
                            //system\common.php
                            send_msg_new($user_id, $content,"account",array("type"=>8));
                            $is_update=1;

                            $status=1;
                            $info="领取成功";

                        }else{
                            $status=0;
                            $info="优惠券已领光";
                        }
                    }
                }
                //system\common.php
                $youhui_use_statistics=getYouhuiStatistics($youhui_info['id'],$user_id,$is_update);
                $v['user_count']=$youhui_use_statistics['user_count'];
                $v['user_day_count']=$youhui_use_statistics['user_day_count'];
                $sql="select count(*) from ".DB_PREFIX."youhui_log where user_id = ? and youhui_id = ?
                and confirm_time=0 and (expire_time=0 or (expire_time<>0 and expire_time > ?))";
                $param=array($user_id,$youhui_info['id'],NOW_TIME);
                $use_count = self::fetchOnly($sql,$param);
                //echo self::getLastSql();exit;
                $use_count=$use_count?$use_count:0;
                $youhui_status=$this->getYouhuiStatus($youhui_info,$v['user_count'],$v['user_day_count'],$use_count);
                $youhui_status=$youhui_status['status'];
            }else{
                list(self::$errno,self::$errmsg) = ErrMap::get(5002);
            }
        }else{
            list(self::$errno,self::$errmsg) = ErrMap::get(5001);
        }


        return array('status'=>$status,'info'=>$info,'youhui_status'=>$youhui_status);
    }

    /**
     * 获取优惠券
     * @param int $data_id
     * @return array|string
     */
    function getYouhui($data_id=0){

        $youhui=array();
        if($data_id>0){
            $sql='select
                        *
                  from '.DB_PREFIX.'youhui where id = ?';
            $param=array($data_id);
            $youhui = self::fetch($sql,$param);
            //echo self::getLastSql();exit;
        }
        return $youhui;
    }

    public function getUserYouhuis($limit='',$user_id=0,$youhui_type=0){
        if($youhui_type==1){
            $youhui_where=' and y.youhui_type=1 ';
        }elseif($youhui_type==2){
            $youhui_where=' and y.youhui_type=2 ';
        }else{
            $youhui_where=' ';
        }
        $youhui_list=array();
        if($user_id>0){
            $sql='SELECT
                yl.id,
                yl.youhui_id,
                yl.youhui_sn,
                yl.confirm_time,
                yl.expire_time,
                yl.create_time,
                y.id yid,
                y.name AS youhui_name,
                y.youhui_type,
                y.youhui_value,
                y.start_use_price,
                y.supplier_id,
                s.name as supplier_name,
                case
                when yl.confirm_time>0 then 1
                when (yl.expire_time<? and yl.expire_time<>0) then 2 else 0 end order_status
              FROM '.DB_PREFIX.'youhui_log AS yl
                left join '.DB_PREFIX.'youhui as y ON yl.youhui_id = y.id '.$youhui_where.'
                left join fanwe_supplier as s on y.supplier_id=s.id
              WHERE y.is_effect=1 and yl.user_id=? and y.id>0  order by order_status,yl.id desc LIMIT '.$limit;
            $param=array(NOW_TIME,$user_id);
            $youhui_list=self::fetchAll($sql,$param);
            //echo self::getLastSql();exit;
        }
        return $youhui_list;
    }

    public function getYouhuiLocation($youhui_log_id=0){
        $location_info=array();
        if($youhui_log_id>0){
            $sql='select youhui_sn,youhui_id from '.DB_PREFIX.'youhui_log where id= ?';
            $param=array($youhui_log_id);
            $youhui_info=self::fetch($sql,$param);


            $sql='select
                    sl.id,
                    sl.name shopName,
                    sl.address shopAddress,
                    sl.tel shopTel
                  from '.DB_PREFIX.'supplier_location as sl
                    left join '.DB_PREFIX.'youhui_location_link as yl on yl.location_id=sl.id
                  where yl.youhui_id= ?';
            $param=array($youhui_info['youhui_id']);
            $location_info['shopList']=self::fetchAll($sql,$param);
            foreach($location_info['shopList'] as $k=>$v){
                $location_info['shopList'][$k]['shopTel']=$v['shopTel']==''?0:$v['shopTel'];
            }

            $location_info['youhuiCode']=$youhui_info['youhui_sn'];
            //system\common.php
            $location_info['youhuiQrcode']=format_image_path(gen_qrcode($youhui_info['youhui_sn']));;
        }

        return $location_info;
    }

    public function getYouhuiStatus($youhui_info=array(),$user_count=0,$user_day_count=0,$is_use=0){
        $arr=array('status'=>-1,'info'=>'');
        if($youhui_info){
            if($youhui_info['begin_time']!=0&&$youhui_info['begin_time']>NOW_TIME){
                $arr['status']=3;
                $arr['info']='未开始';
            }elseif($youhui_info['end_time']!=0&&$youhui_info['end_time']<=NOW_TIME){
                $arr['status']=2;
                $arr['info']='活动已结束';
            }else{
                if($youhui_info['user_limit']>0&&$user_count>=$youhui_info['user_limit']){
                    $arr['status']=4;
                    $arr['info']='领取数量达到会员领取上限';
                }elseif($youhui_info['user_everyday_limit']>0
                    &&$user_day_count>=$youhui_info['user_everyday_limit']){
                    $arr['status']=5;
                    $arr['info']='领取数量达到会员每日领取上限';
                }elseif($youhui_info['total_num']!=0&&$youhui_info['total_num']<=$youhui_info['user_count']){
                    $arr['status']=1;
                    $arr['info']='券已领完';
                }else{
                    $arr['status']=0;
                    $arr['info']='可领取';
                }
                if($arr['status']==5||$arr['status']==4){
                    $arr['status']=1;
                    $arr['info']='券已领完';
                }

                if($is_use>0&&($arr['status']==4||$arr['status']==5||$arr['status']==1)){
                    $arr['status']=8;
                    $arr['info']='存在可使用的券，立即使用';
                }
            }
        }
        return $arr;
    }
    
} 