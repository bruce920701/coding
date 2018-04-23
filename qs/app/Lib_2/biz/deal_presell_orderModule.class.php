<?php
/**
 * @desc
 * @author    吴庆祥
 * @since     2017-08-09 20:31
 */
class deal_presell_orderModule extends BizBaseModule{
    function __construct()
    {

        parent::__construct();
        fanwe_require(APP_ROOT_PATH."system/model/user.php");
        global_run();
        $this->check_auth();
        if (!IS_PRESELL) {
            $this->error("预售模块未开放");
        }
        if(!intval($_REQUEST['is_ajax'])){
            init_app_page();
        }
    }
    private function _getTotime($data)
    {
        $data = strim($data);
        if ($data) {
            return intval(to_timespan($data));
        } else {
            return 0;
        }
    }
    public function index(){
        $page = intval($_REQUEST['p']);
        $limit =formatLimit($page);
        $where=$this->_initIndexWhere();
        //退款允许

        $list=$GLOBALS['db']->getAll("select Deal.presell_delivery_time,DealOrder.id,DealOrder.pay_status,DealOrderItem.unit_price,DealOrder.deal_order_item,DealOrderItem.number,DealOrder.order_status,DealOrder.type,DealOrderItem.name,User.user_name,DealOrder.create_time,DealOrder.total_price,DealOrder.order_sn from ".DB_PREFIX."deal_order DealOrder left join ".DB_PREFIX."deal_order_item DealOrderItem on DealOrder.id=DealOrderItem.order_id left join ".DB_PREFIX."deal Deal on Deal.id=DealOrderItem.deal_id left join ".DB_PREFIX."user User on User.id =DealOrder.user_id LEFT JOIN ".DB_PREFIX."deal_location_link AS DealLocationLink ON DealOrderItem.deal_id = DealLocationLink.deal_id where {$where} GROUP BY DealOrderItem.id  order by DealOrder.id desc ".$limit);
        $total=$GLOBALS['db']->getOne("select count(distinct(DealOrderItem.id)) from ".DB_PREFIX."deal_order DealOrder left join ".DB_PREFIX."deal_order_item DealOrderItem on DealOrder.id=DealOrderItem.order_id LEFT JOIN ".DB_PREFIX."deal_location_link AS DealLocationLink ON DealOrderItem.deal_id = DealLocationLink.deal_id where {$where}");
        formatPage($total);
        foreach($list as $key=>$value){
            $list[$key]['create_time']=to_date($list[$key]['create_time']);
            $list[$key]['list']=unserialize($list[$key]['deal_order_item']);

            if ($list[$key]['invoice_info']) {
                $list[$key]['invoice_info'] = unserialize($list[$key]['invoice_info']);
            }
            foreach($list[$key]['list'] as $k=>$v){
                $v['item_status']=$this->_itemStatus($value,$v);
                if ($v['item_status'] == 4) { // 待收货
                    $deal_order_ids[] = $v['id'];
                }
                $list[$key]['list'][$k]=$v;
            }
            $list[$key]['ostatus']=$this->_getOstatus($list[$key]);
        }

        $this->assign("list",$list);
        $this->display("pages/deal_presell_order/index.html");
    }
    private function _getOstatus($deal_order=array()){
        $vCount = count($deal_order['list']);  // 订单的商品条数
        $refund1 = 0;  // 退款中的数量
        $refund2 = 0;  // 已退款的数量
        $fi = 0; // 已完结|已自提 的数量
        $de = 0; // 待发货的数量
        // $is_pick = false;
        foreach ($deal_order['list'] as $k => $v) {
            switch ($v['item_status']) {
                case 0:
                    $refund1++;
                    break;
                case 1:
                    $refund1++;
                    break;
                case 2:
                    $refund2++;
                    break;
                case 3:
                    $de++;
                    break;
                case 4: break;
                case 5:
                case 6:
                    $fi++;
                    break;
                case 8:
                    $fi++;
                    $is_pick = true;
                    break;
                case 9:
                    $is_pick = true;
                    break;
                case 10:break;
            }
        }

        if ($de > 0 && !$is_pick&&$deal_order['presell_delivery_time']<NOW_TIME) { // 非自提订单待发货
            $status = 1;
        } elseif (($fi + $refund2) == $vCount) { // 已收货和退款通过的数量
            $status = 2; // 已完结
        } else {
            $status = 0;
        }
        return $status;
    }
    private  function _itemStatus($deal_order,$order_item)
    {
        if ($order_item['refund_status'] == 1 && $order_item['delivery_status'] == 0) {
            return 0; // 申请退款且未发货
        } elseif ($order_item['refund_status'] == 1) {
            return 1; // 申请退款
        } elseif ($order_item['refund_status'] == 2) {
            return 2; // 退款审核通过
        } elseif ($order_item['is_pick']) { // 自提判断
            if ($order_item['consume_count'] > 0 && $order_item['dp_id'] == 0) {
                return 5;  // 自提完
            } elseif ($order_item['consume_count'] > 0 && $order_item['dp_id'] > 0) {
                return 6;
            }
            return 9; // 待验证
        } elseif($deal_order['pay_status']==1){
            return 10;//待付款
        }elseif ($order_item['delivery_status'] == 0) {
            return 3; // 待发货
        } elseif ($order_item['delivery_status'] == 1 && $order_item['is_arrival'] == 0) {
            return 4; // 待收货
        } elseif ($order_item['delivery_status'] == 1 && $order_item['is_arrival'] == 1 && $order_item['dp_id'] == 0) {
            return 5; // 待评价
        } elseif ($order_item['dp_id'] > 0) {
            return 6; // 已评价
        }
    }
    private function _initIndexWhere(){

        $account_info=$GLOBALS['account_info'];
        $allow_refund = $GLOBALS['db']->getOne("select allow_refund from ".DB_PREFIX."supplier where id = ".$account_info['supplier_id']);
        $GLOBALS['tmpl']->assign("allow_refund",$allow_refund);
        $where=" DealLocationLink.location_id IN (".implode(",",$account_info['location_ids']).") and DealOrder.is_presell_order=1 and DealOrder.pay_status>0 and DealOrderItem.supplier_id={$account_info['supplier_id']} ";
        $name = strim($_REQUEST['name']);
        $begin_time =to_timespan(strim($_REQUEST['begin_time']));
        $end_time =to_timespan(strim($_REQUEST['end_time']));
        $deal_id=intval($_REQUEST['deal_id']);
        if($name!="") {
            $where .=" and (DealOrderItem.name like '%".$name."%' or DealOrderItem.sub_name like '%".$name."%') ";
        }
        if($begin_time) {
            $where .=" and DealOrder.create_time > ".$begin_time." ";
        }
        if($deal_id){
            $where.=" and DealOrderItem.deal_id={$deal_id} ";
        }
        if($end_time) {
            $where .=" and DealOrder.create_time < ".$end_time." ";
        }

        $assign = array(
            'name' => $name,
            'begin_time' => $_REQUEST['begin_time'],
            'end_time' => $_REQUEST['end_time'],
            'head_title' => '预售订单记录',
        );

        $invoiceConfSql = 'SELECT * FROM '.DB_PREFIX.'invoice_conf WHERE supplier_id='.$account_info['supplier_id'];
        $invoiceConf = $GLOBALS['db']->getRow($invoiceConfSql);
        if ($invoiceConf && $invoiceConf['invoice_type']) {
            $assign['hasInvoiceConf']=1;
        }
        $this->assign($assign);
        return $where;
    }
    public function do_delivery()
    {
        $s_account_info = $GLOBALS['account_info'];
        $supplier_id = intval($s_account_info['supplier_id']);
        require_once(APP_ROOT_PATH."system/model/deal_order.php");
        $order_item_table_name = get_supplier_order_item_table_name($supplier_id);
        $order_table_name = get_supplier_order_table_name($supplier_id);

        // $id = intval($_REQUEST['id']); //发货商品的ID
        $id = $_REQUEST['ids'];
        if (empty($id)) {
            $data['status'] = 0;
            $data['info'] = "请选择需要发货的商品";
            ajax_return($data);
        }
        $ids = implode(',', $id);
        $express_id = intval($_REQUEST['express_id']);
        if(empty($express_id)) {
            $data['status'] = 0;
            $data['info'] = "请选择快递公司";
            ajax_return($data);
        }
        $express_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."express where id = ".$express_id);
        if (empty($express_info)) {
            $data['status'] = 0;
            $data['info'] = "快递公司选择有误，请重选或去后台编辑";
            ajax_return($data);
        }
        $delivery_sn = strim($_REQUEST['delivery_sn']);
        if(empty($delivery_sn)) {
            $data['status'] = 0;
            $data['info'] = "请输入快递单号";
            ajax_return($data);
        }
        // 检验单号是否重复
        $exist = $GLOBALS['db']->getOne('SELECT id FROM '.DB_PREFIX.'delivery_notice WHERE notice_sn = "'.$delivery_sn.'" AND express_id = '.$express_id);
        if ($exist) {
            $data['status'] = 0;
            $data['info'] = "快递单号已经存在";
            ajax_return($data);
        }
        $memo = strim($_REQUEST['memo']);
        $location_id = intval($_REQUEST['location_id']);
        $order_id = $GLOBALS['db']->getOne("select order_id from ".$order_item_table_name." where id in (".$ids.')');
        $order_info = $GLOBALS['db']->getRow("select * from ".$order_table_name." where id = '".$order_id."'");


        $item_sql = "select name, delivery_status from ".$order_item_table_name.' where id in('.$ids.') and refund_status in (0,3) and supplier_id='.$supplier_id;
        $item = $GLOBALS['db']->getAll($item_sql);

        $isvalid = true; // 判断是否每个商品都是可发货状态
        if ($item && (count($item) == count($id))) { // 获取的条数应和传递的数量一致
            $item_names = array();
            foreach ($item as $v) {
                if ($v['delivery_status'] != 0 && $isvalid == true) {
                    $isvalid = false;
                    break;
                }
                $item_names[] = $v['name'];
            }
            if (!$isvalid) {
                $data['status'] = 0;
                $data['info'] = "非法的参数";
                ajax_return($data);
            }

            $rs = make_delivery_notices($order_id, $id, $delivery_sn, $memo, $express_id, $location_id);
            if ($rs) {
                $delivery_status_sql = "update ".DB_PREFIX."deal_order_item set delivery_status = 1,delivery_time=".NOW_TIME.",delivery_memo='".$memo."',location_id=".$location_id." where id in (".$ids.')';
                $GLOBALS['db']->query($delivery_status_sql);
                $item_name = implode(',', $item_names);
                send_delivery_mail($delivery_sn, $item_name, $order_id);
                send_delivery_sms($delivery_sn, $item_name, $order_id);

                //开始同步订单的发货状态
                $order_deal_items = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_order_item where order_id = ".$order_id);

                $nod5 = 0; // 无需发货的数量
                $nod0 = 0; // 未发货的数量
                foreach ($order_deal_items as $item) {
                    if ($item['delivery_status'] == 5) {
                        $nod5++;
                    }
                    if ($item['delivery_status'] == 0) {
                        $nod0++;
                    }
                }
                $update_sql_format = "update ".DB_PREFIX.'deal_order set delivery_status = %d, update_time = '.NOW_TIME.' where id='.$order_id;
                $itemCount = count($order_deal_items);
                $needSend = $itemCount - $nod5;
                $updateNum = 0;
                if ($nod0 > 0 && $needSend > $nod0) { // 待发货的条数大于0并且小于需要发货的条数
                    $updateNum = 1; // 部分发货
                } elseif ($nod0 == 0 && $needSend > $nod0) { // 所有商品都已经发货
                    $updateNum = 2;
                }
                if ($updateNum > 0) {
                    $update_sql = sprintf($update_sql_format, $updateNum);
                    $GLOBALS['db']->query($update_sql);
                }
                // 订单同步结束

                $log_msg = $item_name." 发货了，发货单号：".$delivery_sn;
                if ($memo) {
                    $log_msg .= ' 备注: '.$memo;
                }
                order_log($log_msg, $order_id);
                update_order_cache($order_id);
                distribute_order($order_id);

                $msg_content = '您购买的<'.$item_name.'>已发货,物流单号: '.$delivery_sn;
                send_msg_new($order_info['user_id'], $msg_content, 'delivery', array('type' => 1, 'data_id' => $order_id));

                //发微信通知
                $weixin_conf = load_auto_cache("weixin_conf");
                if($weixin_conf['platform_status']==1) {
                    $wx_account = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."weixin_account where user_id = ".$supplier_id);

                    send_wx_msg("OPENTM200565259", $order_info['user_id'], $wx_account,array("order_id"=>$order_id,"order_sn"=>$order_info['order_sn'],"company_name"=>$express_info['name'],"delivery_sn"=>$delivery_sn,"order_item_id"=>$id[0]));
                }

                if($delivery_sn){
                    //向快递网发送快递查询订阅
                    require_once(APP_ROOT_PATH.'system/model/express.php');
                    $express = new express();
                    $result = $express->get($expressCode=$express_info['class_name'],$delivery_sn,0,$order_info['region_lv3'],$order_id,$order_info['user_id'],$supplier_id,1,$memo,3);
                }

                $data['status'] = 1;
                $data['info'] = "发货成功";

                ajax_return($data);
            }
        }
        $data['status'] = 0;
        $data['info'] = "数据错误，请刷新重试";
        ajax_return($data);

    }
    /**
     * 快递查询
     */
    public function check_delivery()
    {
        $id = intval($_REQUEST['id']);

        $s_account_info = $GLOBALS["account_info"];
        $supplier_id = intval($s_account_info['supplier_id']);


        $delivery_notice = $GLOBALS['db']->getRow("select n.* from ".DB_PREFIX."delivery_notice as n left join ".DB_PREFIX."deal_location_link as l on l.deal_id = n.deal_id where n.order_item_id = ".$id." and  l.location_id in (".implode(",",$s_account_info['location_ids']).")  order by n.delivery_time desc");
        if($delivery_notice)
        {
            $data['status'] = true;

            $express_id = intval($delivery_notice['express_id']);
            $typeNu = strim($delivery_notice["notice_sn"]);
            $express_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."express where is_effect = 1 and id = ".$express_id);
            $express_info['config'] = unserialize($express_info['config']);
            $typeCom = strim($express_info['config']["app_code"]);

            if(isset($typeCom)&&isset($typeNu)){

                $AppKey = app_conf("KUAIDI_APP_KEY");//请将XXXXXX替换成您在http://kuaidi100.com/app/reg.html申请到的KEY
                $url ='http://api.kuaidi100.com/api?id='.$AppKey.'&com='.$typeCom.'&nu='.$typeNu.'&show=0&muti=1&order=asc';


                //优先使用curl模式发送数据
                //KUAIDI_TYPE : 1. API查询 2.页面查询
                if (app_conf("KUAIDI_TYPE")==1){
                    $data = es_session::get(md5($url));
                    if(empty($data)||(NOW_TIME - $data['time'])>600)
                    {
                        $api_result = get_delivery_api_content($url);
                        $api_result_status = $api_result['status'];
                        $get_content = $api_result['html'];

                        //请勿删除变量$powered 的信息，否者本站将不再为你提供快递接口服务。
                        $powered = '查询数据由：<a href="http://kuaidi100.com" target="_blank">KuaiDi100.Com （快递100）</a> 网站提供 ';

                        $data['html'] = $get_content . '<br/>' . $powered;
                        $data['status'] = true;   //API查询
                        $data['time'] = NOW_TIME;
                        if($api_result_status)
                            es_session::set(md5($url),$data);
                    }

                    ajax_return($data);
                }else{
                    $url = "http://www.kuaidi100.com/chaxun?com=".$typeCom."&nu=".$typeNu;
                    app_redirect($url);
                }

            }else{
                if(app_conf("KUAIDI_TYPE")==1)
                {
                    $data['status'] = false;
                    $data['status'] = "非法的快递查询";
                    ajax_return($data);
                }
                else
                {
                    init_app_page();
                    showErr("非法的快递查询");
                }
            }

        }
        else
        {
            if(app_conf("KUAIDI_TYPE")==1)
            {
                $data['status'] = false;
                ajax_return($data);
            }
            else
            {
                init_app_page();
                showErr("非法的快递查询");
            }

        }


    }
    public function un_do_delivery()
    {
        $s_account_info = $GLOBALS['account_info'];
        $supplier_id = intval($s_account_info['supplier_id']);
        require_once(APP_ROOT_PATH."system/model/deal_order.php");
        $order_item_table_name = get_supplier_order_item_table_name($supplier_id);
        $order_table_name = get_supplier_order_table_name($supplier_id);

        $ids = $_REQUEST['ids']; //发货商品的ID数组
        $id = intval($ids[0]);  // 只会有一个商品
        $location_id = intval($_REQUEST['location_id']);
        $order_id = $GLOBALS['db']->getOne("select order_id from ".$order_item_table_name." where id = ".$id);
        $memo = strim($_REQUEST['memo']);
        $item = $GLOBALS['db']->getRow("select doi.* from ".$order_item_table_name." as doi left join ".DB_PREFIX."deal_location_link as l on doi.deal_id = l.deal_id where doi.id = ".$id." and l.location_id in (".implode(",",$s_account_info['location_ids']).")");
        if($item && $item['delivery_status']!=5) {

            $GLOBALS['db']->query("update ".DB_PREFIX."deal_order_item set delivery_status = 1,delivery_time=".NOW_TIME.",delivery_memo='".$memo."',location_id=".$location_id." where id = ".$id); //修改发货状态


            if($GLOBALS['db']->affected_rows()) {
                //开始同步订单的发货状态
                $order_deal_items = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_order_item where order_id = ".$order_id);
                foreach($order_deal_items as $k=>$v) {
                    if($v['delivery_status']==5) { //无需发货的商品
                        unset($order_deal_items[$k]);
                    }
                }
                $delivery_deal_items = $order_deal_items;
                foreach($delivery_deal_items as $k=>$v) {
                    if($v['delivery_status']==0) {//未发货去除
                        unset($delivery_deal_items[$k]);
                    }
                }

                if(count($delivery_deal_items)==0&&count($order_deal_items)!=0) {
                    $GLOBALS['db']->query("update ".DB_PREFIX."deal_order set delivery_status = 0,update_time = '".NOW_TIME."' where id = ".$order_id); //未发货
                } elseif(count($delivery_deal_items)>0&&count($order_deal_items)!=0&&count($delivery_deal_items)<count($order_deal_items)) {
                    $GLOBALS['db']->query("update ".DB_PREFIX."deal_order set delivery_status = 1,update_time = '".NOW_TIME."' where id = ".$order_id); //部分发
                } else {
                    $GLOBALS['db']->query("update ".DB_PREFIX."deal_order set delivery_status = 2,update_time = '".NOW_TIME."' where id = ".$order_id); //全部发
                }

                update_order_cache($order_id);
                distribute_order($order_id);

                $data['status'] = 1;
                $data['info'] = "发货成功";

                ajax_return($data);
            } else {
                $data['status'] = 0;
                $data['info'] = "发货失败";
                ajax_return($data);
            }

        } else {
            $data['status'] = 0;
            $data['info'] = "数据错误，请刷新重试";
            ajax_return($data);
        }
    }
    public function load_order_detail()
    {
        global_run();
        $s_account_info = $GLOBALS['account_info'];
        if(intval($s_account_info['id']) ==0 ) {
            $data['status'] = 1000;
            ajax_return($data);
        }
        if(!check_module_auth("goodso")) {
            $data['status'] = 0;
            $data['info'] = "权限不足";
            ajax_return($data);
        }

        $supplier_id = intval($s_account_info['supplier_id']);
        require_once(APP_ROOT_PATH."system/model/deal_order.php");
        $order_item_table_name = get_supplier_order_item_table_name($supplier_id);
        $order_table_name = get_supplier_order_table_name($supplier_id);

        $id = intval($_REQUEST['id']);
        $ordersql = 'SELECT * FROM '.$order_table_name.' WHERE id='.$id.' AND supplier_id = '.$supplier_id;
        $order = $GLOBALS['db']->getRow($ordersql);
        if ($order) {

            $itemsql = 'SELECT oi.*, sl.name AS slname,DealOrder.presell_deposit_money,DealOrder.presell_discount_money FROM '.$order_item_table_name.' oi LEFT JOIN '.DB_PREFIX.'deal_order DealOrder ON DealOrder.id = oi.order_id LEFT JOIN '.DB_PREFIX.'supplier_location sl ON oi.location_id = sl.id WHERE oi.order_id = '.$order['id'];
            logger($itemsql);
            $item = $GLOBALS['db']->getAll($itemsql);
            if ($item) {
                $notdev = array(); // 无配送
                $package = array(); // 包裹
                $total_balance = 0;
                $is_delivery = 1;
                $total_refund_money=0;
                $total_balance_price=0;
                foreach ($item as $val) {
                    if($val['refund_status']<>2){
                        $total_balance_price+=$val['balance_total_price'];
                    }

                    $total_balance += $val['balance_total_price'];
                    $val['unit_price'] = format_price($val['unit_price']);
                    $val['total_price'] = format_price($val['total_price']);
                    logger($val);
                    $val['balance_unit_price'] = format_price($val['balance_unit_price']-($val['presell_discount_money']-$val['presell_deposit_money']));
                    $val['balance_total_price'] = format_price($val['balance_total_price']);
                    $val['statusStr'] = '';

                    $total_refund_money+=$val['refund_money'];


                    if ( in_array($val['refund_status'], array(1, 2))) {
                        $val['statusStr'] = $val['refund_status'] == 1 ? '退款审核中' : '已退款';
                    }
                    if ($val['is_delivery'] == 0) { // 无需配送，只有一条
                        if ($val['is_pick'] == 1) { // 如果是自提
                            $val['statusStr'] = $val['statusStr'] ?: ($val['dp_id'] > 0 ? '已评价' : ($val['consume_count'] > 0 ? '待评价' : '待验证'));
                            $order['slname'] = $val['slname'];
                        } else {
                            $val['statusStr'] = $val['statusStr'] ?: ($val['dp_id'] > 0 ? '已评价' : ($val['is_arrival'] == 1 ? '待评价' : ($val['delivery_status'] == 0 ? '待发货' : '待收货')));
                        }
                        $notdev[] = $val;
                        $is_delivery = 0;
                    } elseif ($val['delivery_status'] == 0) {
                        $val['statusStr'] = $val['statusStr'] ?: '待发货';
                        $notdev[] = $val;
                    } else { // 需要配送并且已发货
                        $val['statusStr'] = $val['statusStr'] ?: ($val['dp_id'] > 0 ? '已评价' : ($val['is_arrival'] == 1 ? '待评价' : '待收货'));
                        $package[$val['id']] = $val;
                        $pkid[] = $val['id'];
                    }
                }
                $order['create_time'] = to_date($order['create_time']);
                $assign = array(
                    'order' => $order,
                    'item1' => $notdev,
                    'total_balance' => $total_balance,
                    'is_delivery' => $is_delivery,
                );
                if ($package) {
                    $pksql = 'SELECT distinct(dn.notice_sn), dn.order_item_id,dn.memo, dn.delivery_time , dn.express_id , dn.is_arrival, e.name FROM '.DB_PREFIX.'delivery_notice dn INNER JOIN '.DB_PREFIX.'express e ON e.id = dn.express_id WHERE dn.order_item_id IN ('.implode(',', $pkid).')';
                    $pk = $GLOBALS['db']->getAll($pksql);
                    // $data['sql'] = $pksql;
                    // $data['pk'] = $pk;
                    $sepk = array(); // 分离包裹
                    foreach ($pk as $v) {
                        if (NOW_TIME - $v['delivery_time'] > 3600 * 24 * ORDER_DELIVERY_EXPIRE && $v['is_arrival'] == 0) {
                            $v['force_dev'] = 1;
                        }
                        // $package[$v['order_item_id']]['info'] = $v;
                        $sepk[$v['notice_sn']]['info'] = $v;
                        $sepk[$v['notice_sn']]['list'][] = $package[$v['order_item_id']];
                    }
                    $assign['package'] = $sepk;
                }


                //支付明细
                $feeinfo=array();

                $fee_detail['name']="商品总价";
                $fee_detail['symbol'] = 1;
                $fee_detail['value'] = round($order['deal_total_price'],2);
                $feeinfo[] = $fee_detail;
                if($order['type']==8&&$order['presell_discount_money']>0){

                    $fee_detail['name']=lang("DEPOSIT_MONEY_".$order['presell_type'])."抵扣";
                    $fee_detail['symbol'] = -1;
                    $fee_detail['value'] = round($order['presell_discount_money'],2);

                    $feeinfo[] = $fee_detail;
                }
                if($order['discount_price']>0){
                    $fee_detail['name']="等级折扣";
                    $fee_detail['symbol'] = -1;
                    $fee_detail['value'] = round($order['discount_price'],2);
                    $feeinfo[] = $fee_detail;
                }

                if($order['youhui_money']>0){
                    $fee_detail['name']="优惠券";
                    $fee_detail['symbol'] = -1;
                    $fee_detail['value'] = round($order['youhui_money'],2);
                    $feeinfo[] = $fee_detail;
                }

                if($order['ecv_money']>0){
                    $fee_detail['name']="红包";
                    $fee_detail['symbol'] = -1;
                    $fee_detail['value'] = round($order['ecv_money'],2);
                    $feeinfo[] = $fee_detail;
                }

                if($order['exchange_money']>0){
                    $fee_detail['name']="积分抵扣";
                    $fee_detail['symbol'] = -1;
                    $fee_detail['value'] = round($order['exchange_money'],2);
                    $feeinfo[] = $fee_detail;
                }
                if($order['delivery_fee']>0){
                    $fee_detail['name']="运费";
                    $fee_detail['symbol'] = 1;
                    $fee_detail['value'] = round($order['delivery_fee'],2);
                    $feeinfo[] = $fee_detail;
                }
                $fee_detail['name'] = '实际支付金额';
                $fee_detail['symbol'] = 1;
                $fee_detail['value'] = round($order['total_price']-($order['presell_discount_money']-$order['presell_deposit_money']),2);
                $feeinfo[] = $fee_detail;

                if( $total_refund_money > 0){
                    $fee_detail['name'] = '退款金额';
                    $fee_detail['symbol'] = -1;
                    $fee_detail['value'] = round($total_refund_money,2);
                    $feeinfo[] = $fee_detail;
                }

                $fee_detail['name'] = '结算金额';
                $fee_detail['symbol'] = 1;
                $fee_detail['value'] = round($total_balance_price+$order['delivery_fee']-($order['presell_discount_money']-$order['presell_deposit_money']),2);
                $feeinfo[] = $fee_detail;

                $GLOBALS['tmpl']->assign('fee_info',$feeinfo);

                if ($is_delivery) { // 需要配送。获取配送地址信息
                    $region_lv = array($order['region_lv1'], $order['region_lv2'], $order['region_lv3'], $order['region_lv4']);
                    $region_lv_sql = 'select name from '.DB_PREFIX.'delivery_region where id in ('.implode(',', $region_lv).') order by id';
                    $region_names = $GLOBALS['db']->getCol($region_lv_sql);

                    $address = $order['address'];
                    $mobile = $order['mobile'];
                    $consignee = $order['consignee'];
                    $street = $order['street'];
                    $doorplate = $order['doorplate'];
                    $zip = $order['zip'];

                    $assign['address'] = $consignee.'&nbsp;&nbsp;'.$mobile.'&nbsp;&nbsp;'.implode('', $region_names).$address.$street.$doorplate.'&nbsp;&nbsp;'.$zip;
                }

                $GLOBALS['tmpl']->assign($assign);

                $data['html'] = $GLOBALS['tmpl']->fetch("inc/order_detail.html");
                $data['status'] = 1;
                ajax_return($data);
            }
        }
        $data['status'] = 0;
        $data['info'] = "非法的数据";
        ajax_return($data);
    }
}