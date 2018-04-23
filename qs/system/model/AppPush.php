<?php

/**
 * app 推送配置类
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/7/10
 * Time: 18:20
 */
class AppPush
{

    protected static function getRoute($action,$data_id = '',$data2_id = ''){
        $route_list = array(
            'do_delivery' =>array('type'=>'308','url'=>'','data_id'=>$data_id),
            'confirm_delivery' =>array('type'=>'308','url'=>'','data_id'=>$data_id),
            'dist_do_delivery' =>array('type'=>'308','url'=>'','data_id'=>$data_id),
            'dist_confirm_delivery' =>array('type'=>'308','url'=>'','data_id'=>$data_id),
            'tuan_quan_expiring' =>array('type'=>'207','url'=>'','data_id'=>$data_id),
            'use_coupon'=>array('type'=>'0','url'=>get_domain().wap_url("index","uc_coupon"),'data_id'=>'0'),
            'add_coupon'=>array('type'=>'0','url'=>get_domain().wap_url("index","uc_coupon"),'data_id'=>'0'),
            'send_voucher'=>array('type'=>'0','url'=>get_domain().wap_url("index","uc_youhui"),'data_id'=>'0'),
            'biz_shop_order_view'=>array('type'=>'4','url'=>get_domain().wap_url("biz","shop_order#view",array('data_id'=>$data_id)),'data_id'=>$data_id),
            'biz_dc_resorder_view'=>array('type'=>'4','url'=>get_domain().wap_url("biz","dc_resorder#view",array('lid'=>$data2_id,'data_id'=>$data_id)),'data_id'=>'0'),
            'biz_docharge'=>array('type'=>'4','url'=>get_domain().wap_url("biz","money_index"),'data_id'=>'0'),
            'dist_new_order'=>array('type'=>'4','url'=>get_domain().wap_url("dist","order",array('status'=>1)),'data_id'=>'0'),
        );
        return $route_list[$action];
    }

    /**
     * @desc 大写转为_小写
     * @author    吴庆祥
     * @param $name
     * @return string
     */
    public static function cc_format($name){
        $temp_array = array();
        for($i=0;$i<strlen($name);$i++){
            $ascii_code = ord($name[$i]);
            if($ascii_code >= 65 && $ascii_code <= 90){
                if($i == 0){
                    $temp_array[] = chr($ascii_code + 32);
                }else{
                    $temp_array[] = '_'.chr($ascii_code + 32);
                }
            }else{
                $temp_array[] = $name[$i];
            }
        }
        return implode('',$temp_array);
    }
    public static function getFunctionName($param){
        $function=array();
        $function['function_lower']=self::cc_format($param);
        $function['function_up']=strtoupper($function['function_lower']);
        return $function;
    }
    /**
     * @desc 添加发货通知
     * @author
     * @param $delivery_sn 快递单号
     * @param $express_name 快递名称
     * @param $order_info
     */
    public static function doDelivery($delivery_sn,$express_name,$order_info){
        $user_info = $GLOBALS['db']->getRow('select id,user_name,dev_type,device_token from '.DB_PREFIX.'user where id = '.$order_info['user_id']);

        $send_data = array(
            'content' =>lang('APP_PUSH_ORDER_DO_DELIVERY',$order_info['order_sn'],$express_name,$delivery_sn),
            'device_token'=> $user_info['device_token'],
            'param'=>self::getRoute('do_delivery',$order_info['id']), //app 额外参数
        );
        fanwe_require(APP_ROOT_PATH.'system/model/Schedule.php');
        $schedule = new Schedule();
        $schedule->send_schedule_plan($user_info['dev_type'],'APP推送任务「发货通知」',$send_data,NOW_TIME,'用户ID:'.$user_info['id'].'「'.$user_info['user_name'].'」');
    }

    public static function commonSend($user_id,$action,$data_id,$title,$content){
        $user_info= $GLOBALS['db']->getRow("select id,user_name,dev_type,device_token from ".DB_PREFIX."user where id = {$user_id}");
//        if(empty($user_info)||!$user_info['device_token'])return;
        $send_data = array(
            'content' =>$content,
            'device_token'=> $user_info['device_token'],
            'param'=>self::getRoute($action,$data_id), //app 额外参数
        );
        if(class_exists("Schedule")){
            $schedule = new Schedule();
        }else{
            fanwe_require(APP_ROOT_PATH.'system/model/Schedule.php');
            $schedule = new Schedule();
        }
        $schedule->send_schedule_plan($user_info['dev_type'],"APP推送任务「{$title}」",$send_data,NOW_TIME,'用户ID:'.$user_info['id'].'「'.$user_info['user_name'].'」');
    }

    /**
     * @desc 确认收货
     * @author    吴庆祥
     * @param $order_info
     */
    public static function confirmDelivery($order_info){
        $function=self::getFunctionName(__FUNCTION__);
        $content=lang("APP_PUSH_ORDER_{$function['function_up']}",$order_info['order_sn']);
        self::commonSend($order_info['user_id'],$function['function_lower'],$order_info['id'],lang("APP_PUSH_TITLE_{$function['function_up']}"),$content);
    }

    /**
     * @desc  驿站发货
     * @author    吴庆祥
     * @param $delivery_sn
     * @param $dist_name
     * @param $order_info
     */
    public static function distDoDelivery($delivery_sn,$dist_name,$order_info){
        $function=self::getFunctionName(__FUNCTION__);
        $content=lang("APP_PUSH_ORDER_{$function['function_up']}",$order_info['order_sn'],$dist_name,$delivery_sn);
        self::commonSend($order_info['user_id'],$function['function_lower'],$order_info['id'],lang("APP_PUSH_TITLE_{$function['function_up']}"),$content);
    }

    /**
     * @desc 驿站收货
     * @author    吴庆祥
     * @param $order_info
     */
    public static function distConfirmDelivery($order_info){
        $function=self::getFunctionName(__FUNCTION__);
        $content=lang("APP_PUSH_ORDER_{$function['function_up']}",$order_info['order_sn']);
        self::commonSend($order_info['user_id'],$function['function_lower'],$order_info['id'],lang("APP_PUSH_TITLE_{$function['function_up']}"),$content);
    }

    /**
     * @desc 团购券即将过期
     * @author    吴庆祥
     * @param $user_id
     * @param $quan_name
     * @param $expire_time
     */
    public static function tuanQuanExpiring($user_id,$quan_name,$expire_time){
        $function=self::getFunctionName(__FUNCTION__);
        $content=lang("APP_PUSH_ORDER_{$function['function_up']}",$quan_name,$expire_time);
        self::commonSend($user_id,$function['function_lower'],0,lang("APP_PUSH_TITLE_{$function['function_up']}"),$content);
    }

    /**
     * @desc 团购券过期
     * @author    吴庆祥
     * @param $user_id
     * @param $quan_name
     */
    public static function tuanQuanExpired($user_id,$quan_name){
        $function=self::getFunctionName(__FUNCTION__);
        $content=lang("APP_PUSH_ORDER_{$function['function_up']}",$quan_name);
        self::commonSend($user_id,$function['function_lower'],0,lang("APP_PUSH_TITLE_{$function['function_up']}"),$content);
    }

    /**
     * @desc 通用的单个用户推送方法
     * @author    吴庆祥
     * @param $action
     * @param $user_id
     * @param $content
     * @param int $params_id
     */
    public static function singleUserPush($action,$user_id,$content,$params_id=0){
        self::commonSend($user_id,$action,$params_id,lang("APP_PUSH_TITLE_".strtoupper($action)),$content);
    }

    /**
     * @param string $action
     * @param int $data_id
     * @param string $title
     * @param string $content
     * @param array $supplier_account
     * @param int $data2_id
     */
    public static function biz_commonSend($action='',$data_id=0,$title='',$content='',$supplier_account=array(),$data2_id=0){
//        if(empty($user_info)||!$user_info['device_token'])return;

        if(class_exists("Schedule")){
            $schedule = new Schedule();
        }else{
            fanwe_require(APP_ROOT_PATH.'system/model/Schedule.php');
            $schedule = new Schedule();
        }
        $send_data = array(
            'content' =>$content,
            'device_token'=> $supplier_account['device_token'],
            'param'=>self::getRoute($action,$data_id,$data2_id), //app 额外参数
            'prefix'=>'biz_',
        );
        $schedule->send_schedule_plan($supplier_account['dev_type'],"APP推送任务「{$title}」",$send_data,NOW_TIME,$supplier_account['name'].':'.$supplier_account['mobile']);
    }

    /**
     * @desc 新发货订单通知
     * @param array $order_info
     */
    public static function biz_new_deliver_goods_order($order_info=array()){
        $sql = "SELECT
                    sa.id,
                    s.name,
                    u.mobile,
                    sa.dev_type,
                    sa.device_token
                FROM
                    ".DB_PREFIX."supplier_account sa
                LEFT JOIN ".DB_PREFIX."supplier s ON sa.supplier_id = s.id
                LEFT JOIN ".DB_PREFIX."user u ON u.merchant_name = sa.account_name
                WHERE
                    sa.supplier_id = ".$order_info['supplier_id']." and u.id>0";
        $supplier_account_list= $GLOBALS['db']->getAll($sql);
        foreach($supplier_account_list as $v){
            $content=sprintf(lang("APP_PUSH_ORDER_BIZ_NEW_DELIVER_GOODS_ORDER"), $v['name'],$order_info['order_sn']);
            self::biz_commonSend('biz_shop_order_view',$order_info['id'],lang("APP_PUSH_TITLE_BIZ_NEW_DELIVER_GOODS_ORDER"),$content,$v);
        }

    }

    /**
     * @desc 提现成功
     * @param array $charge
     */
    public static function biz_docharge($charge=array()){
        $sql = "SELECT
                    sa.id,
                    s.name,
                    s.money,
                    u.mobile,
                    sa.dev_type,
                    sa.device_token
                FROM
                    ".DB_PREFIX."supplier_account sa
                LEFT JOIN ".DB_PREFIX."supplier s ON sa.supplier_id = s.id
                LEFT JOIN ".DB_PREFIX."user u ON u.merchant_name = sa.account_name
                WHERE
                    sa.supplier_id = ".$charge['supplier_id']." and u.id>0";
        $supplier_account_list= $GLOBALS['db']->getAll($sql);
        foreach($supplier_account_list as $v){
            $content=sprintf(lang("APP_PUSH_ORDER_BIZ_DOCHARGE"), $v['name'],$charge['money'],$v['money']);
            self::biz_commonSend('biz_docharge',0,lang("APP_PUSH_TITLE_BIZ_DOCHARGE"),$content,$v);
        }

    }
    /**
     * @desc 新预定订单
     * @param array $order_info
     */
    public static function biz_new_dc_rs_order($order_info=array()){
        $sql = "SELECT
                    sa.id,
                    s.name,
                    u.user_name,
                    u.mobile,
                    sa.dev_type,
                    sa.device_token,
                    sl.name supplier_location_name,
                    sl.address
                FROM
                    ".DB_PREFIX."supplier_account sa
                LEFT JOIN ".DB_PREFIX."supplier s ON sa.supplier_id = s.id
                LEFT JOIN ".DB_PREFIX."user u ON u.merchant_name = sa.account_name
                LEFT JOIN ".DB_PREFIX."supplier_location sl ON s.id=sl.supplier_id
                WHERE
                    sa.supplier_id = ".$order_info['supplier_id']." and u.id>0 and sl.id=".$order_info['location_id'];
        $supplier_account_list= $GLOBALS['db']->getAll($sql);
        $order_menu_list=unserialize($order_info['order_menu']);
        $table_time_format=to_date($order_menu_list['rs_list']['cart_list'][0]['table_time']);
        foreach($order_menu_list['menu_list']['cart_list'] as $vv){
            $deal_name_arr[]=$vv['name'];
        }
        $v=$supplier_account_list[0];
        if(count($deal_name_arr)>0){
            $content=sprintf(lang("APP_PUSH_ORDER_BIZ_NEW_DC_RS_ORDER"), $v['supplier_location_name'],$v['user_name'],$v['address'],$table_time_format,$order_info['order_sn'],implode(',',$deal_name_arr));
        }else{
            $content=sprintf(lang("APP_PUSH_ORDER_BIZ_NEW_DC_RS_ORDER_0"), $v['supplier_location_name'],$v['user_name'],$v['address'],$table_time_format,$order_info['order_sn']);
        }
        foreach($supplier_account_list as $v){
            self::biz_commonSend('biz_dc_resorder_view',$order_info['id'],lang("APP_PUSH_TITLE_BIZ_NEW_DC_RS_ORDER"),$content,$v,$order_info['location_id']);
        }

    }
    /**
     * @desc 新外卖订单
     * @param array $order_info
     */
    public static function biz_new_dc_order($order_info=array()){
        $sql = "SELECT
                    sa.id,
                    s.name,
                    u.mobile,
                    sa.dev_type,
                    sa.device_token,
                    sl.name supplier_location_name
                FROM
                    ".DB_PREFIX."supplier_account sa
                LEFT JOIN ".DB_PREFIX."supplier s ON sa.supplier_id = s.id
                LEFT JOIN ".DB_PREFIX."user u ON u.merchant_name = sa.account_name
                LEFT JOIN ".DB_PREFIX."supplier_location sl ON s.id=sl.supplier_id
                WHERE
                    sa.supplier_id = ".$order_info['supplier_id']." and u.id>0 and sl.id=".$order_info['location_id'];
        $supplier_account_list= $GLOBALS['db']->getAll($sql);
        foreach($supplier_account_list as $v){
            $content=sprintf(lang("APP_PUSH_ORDER_BIZ_NEW_DC_ORDER"), $v['supplier_location_name'],$order_info['order_sn']);
            self::biz_commonSend('biz_shop_order_view',$order_info['id'],lang("APP_PUSH_TITLE_BIZ_NEW_DC_ORDER"),$content,$v);
        }

    }

    public static function dist_commonSend($dist_id=0,$action='',$data_id=0,$title='',$content=''){
        $sql = "SELECT
                    id,
                    name,
                    dev_type,
                    device_token
                FROM
                    ".DB_PREFIX."distribution
                WHERE
                    id = {$dist_id}";
        $dist_info= $GLOBALS['db']->getRow($sql);
//        if(empty($user_info)||!$user_info['device_token'])return;

        if(class_exists("Schedule")){
            $schedule = new Schedule();
        }else{
            fanwe_require(APP_ROOT_PATH.'system/model/Schedule.php');
            $schedule = new Schedule();
        }
        $send_data = array(
            'content' =>$content,
            'device_token'=> $dist_info['device_token'],
            'param'=>self::getRoute($action,$data_id), //app 额外参数
            'prefix'=>'dist_',
        );
        $schedule->send_schedule_plan($dist_info['dev_type'],"APP推送任务「{$title}」",$send_data,NOW_TIME,'驿站ID:'.$dist_info['id'].'「'.$dist_info['name'].'」');

    }

    /**
     * @desc 新驿站订单订单
     * @param array $dist_info
     */
    public static function dist_new_order($dist_info=array()){
        $content=sprintf(lang("APP_PUSH_ORDER_DIST_NEW_ORDER"), $dist_info['name']);
        self::dist_commonSend($dist_info['id'],'dist_new_order',0,lang("APP_PUSH_TITLE_DIST_NEW_ORDER"),$content);
    }
}