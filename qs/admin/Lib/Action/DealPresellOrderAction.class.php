<?php
/**
 * @desc      
 * @author    吴庆祥
 * @since     2017-08-14 15:26  
 */
class DealPresellOrderAction extends CommonAction{
    public function index(){
        $this->order_list('', 8);
        $this->assign ('title', '预售订单');
        $this->display();
    }
    public function supplier_index(){
        $this->order_list('', 8,1);
        $this->assign ('title', '预售订单');
        $this->display("index");
    }
    protected function _search($model) {

        //生成查询条件
        $map = array ();
        foreach ( $model->serchFields as $key => $val ) {
            if (isset ( $_REQUEST [$val] ) && $_REQUEST [$val] != '' ) {
                $map[$key] = $_REQUEST [$val];
            }
        }
        return $map;

    }
    protected function order_list($model, $type=0, $is_supplier=0, $pageNum=0){
        $orderModel = $model ? $model : D('DealOrderView');
        $map = $this->_search ($orderModel);
        $map['DealOrder.is_main']       = 0;
//        $map['DealOrder.type']          = $type;
        $map['DealOrder.is_presell_order']=1;
        // 商户订单，或者非商户订单
        $map['DealOrder.supplier_id'] = $is_supplier == 1 ?  array( 'gt' , 0) :  array( 'eq' , 0);

        $start_time = strtotime($_REQUEST['start_time']) - date('Z');
        $end_time   = strtotime($_REQUEST['end_time']) - date('Z');

        if ($start_time > 0 && $end_time > 0) {
            if ( $start_time >= $end_time ) {
                $this->error('开始时间必须小于结束时间');
            };
            $map['DealOrder.create_time'] = array('between', "{$start_time}, {$end_time}");
        }else if($start_time>0){
            $map['DealOrder.create_time'] = array("gt",$start_time);
        }else if($end_time>0){
            $map['DealOrder.create_time'] = array("lt",$end_time);
        }

        //print_r($map);exit;
        $group='DealOrder.id';
        $distinct_field = 'DealOrder.id';
        $this->assign ('type', $type);
        $this->assign ('is_supplier', $is_supplier);
        return $this->_list($orderModel, $map, '', false, $pageNum,$group,$distinct_field);
    }
    public function export_csv($parameter)
    {
        set_time_limit(0);
        error_reporting(0);
        $type         = intval($_REQUEST['type']);
        $is_supplier  = intval($_REQUEST['is_supplier']);

        $is_history   = $parameter[1] ? $parameter[1] : intval($_REQUEST['is_history']);
        $page         = $parameter[0] ? $parameter[0] : 1;

        // 如果是历史订单
        if ($is_history == 1) {
            $list = $this->deal_trash(1, $page);
        }else{
            $list = $this->order_list('', $type, $is_supplier, $parameter[0]);
        }

        if($list)
        {
            register_shutdown_function( array(&$this, 'export_csv'), array($page+1, $is_history));

            $order_value = array('sn'=>'""', 'user_name'=>'""', 'deal_name'=>'""','number'=>'""', 'create_time'=>'""', 'total_price'=>'""', 'pay_amount'=>'""', 'consignee'=>'""', 'address'=>'""', 'mobile'=>'""', 'memo'=>'""', 'delivery_status'=>'""','refund_status'=>'""','order_status'=>'""');
            if($page == 1)
            {
                $content = iconv("utf-8","gbk","订单编号,用户名,商品名称,订购数量,下单时间,订单总额,已收金额,收货人,发货地址,手机号码,订单留言,发货状态,退款申请,订单状态");
                $content = $content . "\n";
            }

            foreach($list as $k=>$v)
            {
                require_once(APP_ROOT_PATH."system/model/user.php");
                $user_info = load_user($v['user_id']);
                $order_value['sn'] = '"' . "sn:".iconv('utf-8','gbk',$v['order_sn']) . '"';
                $order_value['user_name'] = '"' . iconv('utf-8','gbk',$v['user_name']) . '"';
                $order_items = unserialize($v['deal_order_item']);
                $names = "";
                $total_num = 0;
                foreach($order_items as $key => $row)
                {
                    $names.=  addslashes($row['name'])."[".$row['number']."]";
                    if($key<count($order_items)-1)
                        $names.="\n";
                    $total_num+=$row['number'];
                }

                $order_value['deal_name'] = '"' . iconv('utf-8','gbk',$names) . '"';
                $order_value['number'] = '"' . iconv('utf-8','gbk',$total_num) . '"';

                $order_value['create_time'] = '"' . iconv('utf-8','gbk',to_date($v['create_time'])) . '"';
                $order_value['total_price'] = '"' . iconv('utf-8','gbk',floatval($v['total_price'])."元") . '"';

                $order_value['pay_amount'] = '"' . iconv('utf-8','gbk',floatval($v['pay_amount'])."元") . '"';

                $order_value['consignee'] = '"' . iconv('utf-8','gbk',$v['consignee']) . '"';

                $region = array(
                    $v['region_lv1'],
                    $v['region_lv2'],
                    $v['region_lv3'],
                    $v['region_lv4']
                );
                $region = array_filter($region);
                $region_ids = join(',', $region);

                $region_info = $GLOBALS['db']->getAll( "select name from ".DB_PREFIX."delivery_region where id in($region_ids)" );

                $address = $region_info[0]['name'].$region_info[1]['name'].$region_info[2]['name'].$region_info[3]['name'].$v['address'];
                $order_value['address'] = '"' . iconv('utf-8','gbk',$address) . '"';


                if($v['mobile']!='')
                    $mobile = $v['mobile'];
                else
                    $mobile = $user_info['mobile'];
                $order_value['mobile'] = '"' . iconv('utf-8','gbk',$mobile) . '"';
                $order_value['memo'] = '"' . iconv('utf-8','gbk',$v['memo']) . '"';

                // 发货状态get_delivery_status($status,$order_info)
                if($v['is_delete'] == 1 ){
                    $delivery_status =  '-';
                }elseif ($v['order_status'] == 1){
                    $delivery_status = '全部发货';
                }else{
                    $status_array = array(
                        '0' => '待发货',
                        '1' => '部份发货',
                        '2' => '全部发货',
                        '5' => '待发货',
                    );
                    $delivery_status = $status_array[$v['delivery_status']];
                }
                $order_value['delivery_status'] = '"' . iconv('utf-8','gbk', $delivery_status) . '"';


                $refund_status = $refund_status ? '申请退款':'-';
                $refund_status = $v['is_delete'] == 1 ? '-':$refund_status;
                $order_value['refund_status'] = '"' . iconv('utf-8','gbk', $refund_status) . '"';


                $order_value['order_status'] = '"' . iconv('utf-8','gbk',get_order_status_csv($v['order_status'], $v)) . '"';

                $content .= implode(",", $order_value) . "\n";

            }

            header("Content-Disposition: attachment; filename=order_list.csv");
            echo $content;
        }
        else
        {
            $this->error('查询数据为空');
        }

    }
    public function delete() {
        //删除指定记录
        require_once(APP_ROOT_PATH."system/model/deal_order.php");
        $ajax = intval($_REQUEST['ajax']);
        $id = $_REQUEST ['id'];
        if (isset ( $id )) {
            $condition = array ('id' => array ('in', explode ( ',', $id ) ) );
            $rel_data = M('DealOrder')->where($condition)->findAll();
            foreach($rel_data as $data)
            {
                if(del_order($data['id']))
                {
                    $info[] = $data['order_sn'];
                }
            }
            $info = implode(",", $info);
            save_log($info.l("DELETE_SUCCESS"),1);
            $this->success (l("DELETE_SUCCESS"),$ajax);
        } else {
            $this->error (l("INVALID_OPERATION"),$ajax);
        }
    }
    public function foreverdelete() {
        //彻底删除指定记录
        $ajax = intval($_REQUEST['ajax']);
        $id = $_REQUEST ['id'];
        if (isset ( $id )) {
            $condition = array ('id' => array ('in', explode ( ',', $id ) ) );
            $rel_data = M("DealOrderHistory")->where($condition)->findAll();
            foreach($rel_data as $data)
            {
                $info[] = $data['order_sn'];
            }
            if($info) $info = implode(",",$info);
            $list = M("DealOrderHistory")->where ( $condition )->delete();

            if ($list!==false) {
                //删除关联数据
                save_log($info.l("FOREVER_DELETE_SUCCESS"),1);
                $this->success (l("FOREVER_DELETE_SUCCESS"),$ajax);
            } else {
                save_log($info.l("FOREVER_DELETE_FAILED"),0);
                $this->error (l("FOREVER_DELETE_FAILED"),$ajax);
            }
        } else {
            $this->error (l("INVALID_OPERATION"),$ajax);
        }
    }
    public function deal_trash($is_export=0, $pageNum)
    {
        $type          = intval($_REQUEST['type']);
        $is_supplier   = intval($_REQUEST['is_supplier']);

        $this->assign ('type', $type);
        $this->assign ('is_supplier', $is_supplier);

        $orderModel = D('DealOrderHistoryView');
        $map = $this->_search ($orderModel);
        $map['DealOrderHistory.is_main']     = 0;
        $map['DealOrderHistory.supplier_id'] = $is_supplier;
        $map['DealOrderHistory.type']        = $type;
        $map['DealOrderHistory.supplier_id'] = $is_supplier == 1 ?  array( 'gt' , 0) :  array( 'eq' , 0);

        if( isset($map['DealOrderHistory.refund_status']) ){
            $map['DealOrderHistory.refund_status'] = $map['DealOrderHistory.refund_status'] > 0 ? '1' : array( 'neq' , 1);
        }

        if ($is_export == 1) {
            $list = $this->_list($orderModel, $map, '', false, $pageNum);
            return $list;
        }else{
            $list = $this->_list($orderModel, $map);
        }
        $this->display();
    }
    public function order_detail(){
        $id = intval($_REQUEST['id']);
        $order_info = M("DealOrder")->where("id={$id}")->find();
        $this->assign("DEPOSIT_MONEY",L("DEPOSIT_MONEY_{$order_info['presell_type']}"));
        $type = intval($order_info['type']);
        $this->assign("type",$type);

        if(!$order_info)
        {
            $this->error(l("INVALID_ORDER"));
        }

        // 配送信息
        $region_ids = $order_info['region_lv2'].",".$order_info['region_lv3'].",".$order_info['region_lv4'];
        $region_names_db = $GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."delivery_region where id in(".$region_ids.")");
        $region_names = array();
        foreach ($region_names_db as $k=>$v){
            $region_names[$v['id']] = $v['name'];
        }
        $order_info['region_lv2'] = $region_names[$order_info['region_lv2']];
        $order_info['region_lv3'] = $region_names[$order_info['region_lv3']];
        $order_info['region_lv4'] = $region_names[$order_info['region_lv4']];


        // 驿站信息
        $disSql = 'SELECT name FROM '.DB_PREFIX.'distribution WHERE id = '.$order_info['distribution_id'];

        $order_info['distribute'] = $GLOBALS['db']->getOne($disSql);

        $order_deal_items = M("DealOrderItem")->where("order_id=".$order_info['id'])->findAll();


        $this->assign("is_pick", $order_deal_items[0]['is_pick']);

        $buy_type=intval($order_deal_items[0]['buy_type']);


        require_once(APP_ROOT_PATH."system/model/cart.php");
        $order_deal_items = cart_list_group($order_deal_items);
        $supplier_name = '';
        if($order_info['supplier_id']){ //存在商户id
            $supplier_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."supplier where id = ".$order_info['supplier_id']);
        }

        foreach($order_deal_items as $k=>$v)
        {
            if ($type==5){ //为团购的时候，只会有一条订单商品信息
                $order_deal_item = $v['goods_list'][0];
            }

            $order_deal_items[$k]['supplier'] = $supplier_name?$supplier_name:app_conf("SHOP_TITLE")."直营";
            $s_is_delivery = 0;
            foreach($v['goods_list'] as $kk=>$vv)
            {
                if($vv['is_delivery'])
                    $s_is_delivery = 1;
            }
            if($s_is_delivery)
                $order_deal_items[$k]['delivery_fee'] = round($GLOBALS['db']->getOne("select delivery_fee from ".DB_PREFIX."deal_order_supplier_fee where order_id = ".$order_info['id']." and supplier_id = ".$v['supplier_id']),2);
            else
                $order_deal_items[$k]['delivery_fee'] = -1;
        }

        // 发票信息
        if (!empty($order_info['invoice_info'])) {
            $order_info['invoice_info'] = unserialize($order_info['invoice_info']);
        }

        $order_info['ecv_money']        = 0 - $order_info['ecv_money'];
        $order_info['youhui_money']     = 0 - $order_info['youhui_money'];
        $order_info['discount_price']   = 0 - $order_info['discount_price'];
        $order_info['pay_price']        = $order_info['total_price']-($order_info['presell_discount_money']-$order_info['presell_deposit_money']);
        $this->assign("order_deals", $order_deal_items);
        $this->assign("order_info", $order_info);
        $this->assign("buy_type",$buy_type);

        $oid = $order_info['order_id'] ? $order_info['order_id'] : $order_info['id'];
        $payment_notice = M("PaymentNotice")->where("order_id = {$oid} and is_paid = 1 and order_type=3")->order("pay_time desc")->findAll();
        $this->assign("payment_notice",$payment_notice);

        //输出订单相关的消费券
        if ( $order_info['type'] == 5 ) {
            if($order_deal_item['is_coupon']){ //是否发券
                $coupon_list = D("DealCouponView")->where("DealCoupon.order_id = ".$order_info['id']." and DealCoupon.is_delete = 0")->order('DealCoupon.deal_id desc')->findAll();
                foreach($coupon_list as $k=>$v){
                    $coupon_list[$k]['is_coupon']=1;
                }
            }else{
                $coupon_list[] = array('deal_id'=>$order_deal_item['deal_id'],
                    'deal_name'=>$order_deal_item['name'],
                    'coupon_price'=>$order_deal_item['unit_price'],
                    'supplier_name'=>$supplier_name,
                    'supplier_id'=>$order_deal_item['supplier_id'],
                    'is_valid'=>0,
                    'end_time'=>'-',
                    'confirm_time'=>'-',
                    'password'=>'-',
                    'refund_status'=>$order_deal_item['refund_status'],
                    'is_coupon'=>$order_deal_item['is_coupon']);

            }
            $this->assign("coupon_list",$coupon_list);
        }


        //输出订单日志
        $log_list = M("DealOrderLog")->where("order_id=".$order_info['id'])->order("log_time desc, id desc")->findAll();
        $this->assign("log_list",$log_list);


        $item_info    = M("DealOrderItem")->where("order_id={$order_info['id']}")->find();

        $this->assign("delivery_type",$item_info['delivery_type']);

        $title = array(1=>'充值订单',2=>'积分订单',3=>'自营订单',4=>'自营-驿站订单',5=>'团购订单',6=>'商城订单',8=>'预售订单' );

        $this->assign("title",$title[$type]);
        if ($type == 2) {
            $this->display('score_order_detail');
        }else{
            $this->display();
        }

    }
}