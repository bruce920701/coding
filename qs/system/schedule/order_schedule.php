<?php

class order_schedule {
	
	/**
	 * $data 格式
	 * array("dest"=>openid,"content"=>序列化的消息配置);
	 */
	public function exec($data){
        $this->_cancelUnpayOrder();
        $this->_refundUnpayLeftmoneyInPresellOrder();
		//关闭未付款的买单定单(1小时)
		$order_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."store_pay_order where is_delete=0 and pay_status = 0 and create_time < ".(NOW_TIME-3600)." order by create_time asc limit 20");

		if(count($order_list)>0){
			require_once APP_ROOT_PATH."system/model/store_pay.php";
			foreach ($order_list as $key=>$order_info){
				if($order_info)
				{
					syn_cancel_store_order($order_info['id']);
				}
			}
		}
		//发券的不支持过期退的团购订单，自动结单
		$select_where='';
		
		syn_auto_over_status(0,$limit='limit 20');

        $GLOBALS['db']->query("delete from ".DB_PREFIX."schedule_list where type='order'");
        $schedule_obj = new Schedule();
        $schedule_obj->send_schedule_plan("order", "定时任务", array(), NOW_TIME);

        $result['status'] = 1;
        $result['attemp'] = 0;
        $result['info'] = "处理成功";
        return $result;
	}
    /**
     * @desc  取消30分钟未款订单
     * @author    吴庆祥
     */
    private function _cancelUnpayOrder(){
        $cancel_time=NOW_TIME-30*60;
        $GLOBALS['db']->query("update ".DB_PREFIX."deal_order set is_cancel=1,is_delete=1 where is_delete=0 and pay_status=0 and create_time<{$cancel_time}");
    }

    /**
     * @desc  待付尾款的预售订单七天未支付，订金退款，定金不退
     * @author    吴庆祥
     */
    private function _refundUnpayLeftmoneyInPresellOrder(){
        $refund_time=NOW_TIME-7*24*60*60;
        $deal_order=$GLOBALS['db']->getAll("select DealOrderItem.id,DealOrder.pay_amount from ".DB_PREFIX."deal_order DealOrder left join ".DB_PREFIX."deal_order_item DealOrderItem on DealOrder.id=DealOrderItem.order_id where DealOrder.is_presell_order=1 and DealOrder.pay_status=1 and DealOrder.refund_status=0 and DealOrder.presell_end_time<{$refund_time}");
        foreach($deal_order as $value){
            fanwe_require(APP_ROOT_PATH."system/model/deal_order.php");
            if(!$value['presell_type']){
                $status = refund_item_new($deal_order['id'], $deal_order['pay_amount'], "七天未支付尾款则退单，退订金");
            }else{
                $status = refund_item_new($deal_order['id'],0, "七天未支付尾款退单，不退定金");
            }
        }
    }
}