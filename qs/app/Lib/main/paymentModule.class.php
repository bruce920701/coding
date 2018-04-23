<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class paymentModule extends MainBaseModule
{
	//订单支付页
	public function pay()
	{
		global_run();
		init_app_page();
		$GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
		$id = intval($_REQUEST['id']);
		$payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where id = ".$id);

		if($payment_notice)
		{
			if($payment_notice['is_paid'] == 0)
			{
				$payment_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment where id = ".$payment_notice['payment_id']);
				if(empty($payment_info))
				{
					app_redirect(url("index"));
				}
				if($payment_notice['order_type']==5){
				    $order = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."fx_buy_order where id = ".$payment_notice['order_id']." and is_delete = 0");
				    
				}else{
				    $order = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$payment_notice['order_id']." and is_delete = 0");
				    
				}
				if(empty($order))
				{
					app_redirect(url("index"));
				}
				if($order['pay_status']==2)
				{
					if($order['after_sale']==0)
					{
					   if($payment_notice['order_type']==5){
					        app_redirect(url("index","uc_fx#payment_done",array("id"=>$order['id'])));
					    }    
					    else {
						    app_redirect(url("index","payment#done",array("id"=>$order['id'])));
					    }
						exit;
					}
					else
					{
						showErr($GLOBALS['lang']['DEAL_ERROR_COMMON'],0,url("index"),1);
					}
				}
				require_once(APP_ROOT_PATH."system/payment/".$payment_info['class_name']."_payment.php");
				$payment_class = $payment_info['class_name']."_payment";
				$payment_object = new $payment_class();
				$payment_code = $payment_object->get_payment_code($payment_notice['id']);
				$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['PAY_NOW']);
				$GLOBALS['tmpl']->assign("payment_code",$payment_code);
	
				$GLOBALS['tmpl']->assign("order",$order);
				$GLOBALS['tmpl']->assign("payment_notice",$payment_notice);
				if(intval($_REQUEST['check'])==1)
				{
					showErr($GLOBALS['lang']['PAYMENT_NOT_PAID_RENOTICE'],0,url("index","payment#pay",array("id"=>$id)));
				}
				$GLOBALS['tmpl']->display("payment_pay.html");
			}
			else
			{
			    if($payment_notice['order_type']==5){
				    $order = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."fx_buy_order where id = ".$payment_notice['order_id']." and is_delete = 0");
				    
				}else{
				    $order = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$payment_notice['order_id']." and is_delete = 0");
				    
				}			
				if($order['pay_status']==2)
				{
					if($order['after_sale']==0)
					    if($payment_notice['order_type']==5){
					        app_redirect(url("index","uc_fx#payment_done",array("id"=>$order['id'])));
					    }    
					    else {
						    app_redirect(url("index","payment#done",array("id"=>$order['id'])));
					    }
					else
						showErr($GLOBALS['lang']['DEAL_ERROR_COMMON'],0,url("index"),1);
				}
				else
					showSuccess($GLOBALS['lang']['NOTICE_PAY_SUCCESS'],0,url("index"),1);
			}
		}
		else
		{
			showErr($GLOBALS['lang']['NOTICE_SN_NOT_EXIST'],0,url("index"),1);
		}
	}
	
	
	public function tip()
	{
		$payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where id = ".intval($_REQUEST['id']));
		$GLOBALS['tmpl']->assign("payment_notice",$payment_notice);
		$GLOBALS['tmpl']->assign("type",intval($_REQUEST['type']));
		$GLOBALS['tmpl']->display("payment_tip.html");
	}
	
	
	public function response()
	{
		//支付跳转返回页
		if($GLOBALS['pay_req']['class_name'])
			$_REQUEST['class_name'] = $GLOBALS['pay_req']['class_name'];
			
		$class_name = strim($_REQUEST['class_name']);
		$payment_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment where class_name = '".$class_name."'");
		if($payment_info)
		{
			require_once(APP_ROOT_PATH."system/payment/".$payment_info['class_name']."_payment.php");
			$payment_class = $payment_info['class_name']."_payment";
			$payment_object = new $payment_class();
			adddeepslashes($_REQUEST);
			$payment_code = $payment_object->response($_REQUEST);
		}
		else
		{
			showErr($GLOBALS['lang']['PAYMENT_NOT_EXIST']);
		}
	}
	
	public function notify()
	{
		//支付跳转返回页
		if($GLOBALS['pay_req']['class_name'])
			$_REQUEST['class_name'] = $GLOBALS['pay_req']['class_name'];
			
		$class_name = strim($_REQUEST['class_name']);
		$payment_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment where class_name = '".$class_name."'");
		if($payment_info)
		{
			require_once(APP_ROOT_PATH."system/payment/".$payment_info['class_name']."_payment.php");
			$payment_class = $payment_info['class_name']."_payment";
			$payment_object = new $payment_class();
			adddeepslashes($_REQUEST);
			$payment_code = $payment_object->notify($_REQUEST);
		}
		else
		{
			showErr($GLOBALS['lang']['PAYMENT_NOT_EXIST']);
		}
	}
	
	
	
	public function done()
	{
		global_run();
		init_app_page();
		$GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
		$order_id = intval($_REQUEST['id']);
		$order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$order_id);
	
		if($order_info['type']!=1)
		{		
// 			$deal_ids = $GLOBALS['db']->getOne("select group_concat(deal_id) from ".DB_PREFIX."deal_order_item where order_id = ".$order_id);
// 			if(!$deal_ids)
// 				$deal_ids = 0;
// 			$order_deals = $GLOBALS['db']->getAll("select d.* from ".DB_PREFIX."deal as d where id in (".$deal_ids.")");
		    $deal_order_item=unserialize($order_info['deal_order_item']);
		    $order_info['is_shop']=$deal_order_item['0']['is_shop'];
			$order_deals = $GLOBALS['db']->getAll("select d.id,d.uname,d.is_coupon,d.is_shop,d.buy_status,d.forbid_sms,doi.name,doi.is_pick from ".DB_PREFIX."deal_order_item as doi left join ".DB_PREFIX."deal as d on d.id = doi.deal_id where doi.order_id = ".$order_id);
				
			
			$GLOBALS['tmpl']->assign("order_info",$order_info);
			
			$is_coupon = 0;
			$send_coupon_sms = 0;
			$is_lottery = 0;
			foreach($order_deals as $k=>$v)
			{
				if($v['is_coupon'] == 1&&$v['buy_status']>0)
				{
					$is_coupon = 1;
				}
				if($v['is_pick']==1)
				{
					$is_coupon = 1;
				}
				if($v['forbid_sms'] == 0)
				{
					$send_coupon_sms = 1;
				}
				if($v['is_lottery'] == 1&&$v['buy_status']>0)
				{
					$is_lottery = 1;
				}
				if($v['uname']=="")
					$order_deals[$k]['url'] = url("index","deal#".$v['id']);
				else
					$order_deals[$k]['url'] = url("index","deal#".$v['uname']);
			}


			$GLOBALS['tmpl']->assign("order_deals",$order_deals);		
			$GLOBALS['tmpl']->assign("is_lottery",$is_lottery);
			$GLOBALS['tmpl']->assign("is_coupon",$is_coupon);
			$GLOBALS['tmpl']->assign("send_coupon_sms",$send_coupon_sms);
		}
		else
		{
			if($order_info['user_id']==$GLOBALS['user_info']['id'])
			{
				showSuccess(round($order_info['pay_amount'],2)." 元 充值成功",0,url("index","uc_money"));
			}
			else
			{
				showSuccess(round($order_info['pay_amount'],2)." 元 充值成功",0);
			}
		}

		//当type=8表示为精品区订单，此时判断账户是否激活，如没激活则激活账户
        $user_info = $GLOBALS['user_info'];
		if($user_info['active'] ==0  && $order_info['type'] == 8)
        {
            $sql = "update ".DB_PREFIX."user set active=1 where id=".$user_info['id'];
            $GLOBALS['db']->query($sql);
            //echo "$sql";
            //var_dump($GLOBALS['db']->error());
        }

        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "global_config  where config=$config");
        //生成报单奖
        $bdzx_user_id = $this->get_bdzx_user($user_info['id']);
		if($bdzx_user_id != NULL)
        {
            $type = '"new_add"';//报单奖
            $c_time = time();
            $credits = $order_info['pay_amount'] * 0.1;
            //$unfrezen_time = $c_time;
            $unfrezen_time = $this->getNextMondaytime($c_time);
            $unfrezen_time = $c_time;
            $status = 0;
            $msg = '"'.$user_info['id'].",".$order_info['pay_amount'].'"';
            $sql = "insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$bdzx_user_id.",".$type.",".$c_time.",".$credits.",".$unfrezen_time.",".$status.",".$msg.")";
            $GLOBALS['db']->query($sql);
            //echo "$sql";
            //var_dump($GLOBALS['db']->error());
        }

        //生成直推奖

        $direct_rate = $global_config['direct_rate'];
		$sql = "select * from ".DB_PREFIX."direct_user where d_id=".$user_info['id'];
		$d_user_info = $GLOBALS['db']->getRow($sql);
		$d_id = $d_user_info['id'];
        if(!($type == 1 || $type ==2 || $type==7))
        {
            $type = '"direct"';//直推奖
            $c_time = time();
            $credits = $order_info['pay_amount'] * $direct_rate;
            //$unfrezen_time = $this->getNextMondaytime($c_time);
            $unfrezen_time = $c_time;
            $status = 0;
            $msg = '"'.$user_info["user_name"] . "消费了" . $order_info['pay_amount'] . "，您获得" . $credits . "直推奖".'"';
            $sql = "insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$d_id.",".$type.",".$c_time.",".$credits.",".$unfrezen_time.",".$status.",".$msg.")";
            $GLOBALS['db']->query($sql);
            //echo "$sql";
            //var_dump($GLOBALS['db']->error());
        }


		$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['PAY_SUCCESS']);
		$GLOBALS['tmpl']->display("payment_done.html");
	}

    //通过当前时间戳获取下周一0:00时间戳  当前时间为utc时间
    private function getNextMondaytime($time)
    {
        $w = date('w', $time);
        if ($w == 0) {
            $nextMonday = 1;
        } else {
            $nextMonday = 7 - $w + 1;
        }
        $date_time = date("Y-m-d") . "00:00:00";
        $time_0 = strtotime($date_time);
        $next_Monday_0 = $time_0 + 3600 * 24 * $nextMonday;
        return $next_Monday_0;
    }


	//获取用户的报单中心是谁，即获取该用户上面的最近的通过报单审核的用户
    public function  get_s_id()
    {
        $id = $_GET['id'];
        $result = $this->get_bdzx_user($id);
        if($result)
            echo $result;
        else
            echo "NULL";
    }

	private function get_bdzx_user($id)
    {
        $sql = "select * from " . DB_PREFIX . "user where id=" . $id;
        $user_info = $GLOBALS['db']->getRow($sql);
        $s_id = $user_info['s_id'];
        if ($s_id != 0) {
            $sql = "select * from " . DB_PREFIX . "user where id=" . $s_id;
            $up_user_detail = $GLOBALS['db']->getRow($sql);
            if ($up_user_detail['bdzx_status'] == 2) //管理员通过审核，成为报单中心
            {
                return $s_id;
            } else {
                $this->get_bdzx_user($s_id);
            }
        } else {
            return null;
        }
    }


	
	public function incharge_done()
	{
		global_run();
		init_app_page();
		$GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
		$order_id = intval($_REQUEST['id']);
		$order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$order_id);
		//$order_deals = $GLOBALS['db']->getAll("select d.* from ".DB_PREFIX."deal as d where id in (select distinct deal_id from ".DB_PREFIX."deal_order_item where order_id = ".$order_id.")");
		$GLOBALS['tmpl']->assign("order_info",$order_info);
		//$GLOBALS['tmpl']->assign("order_deals",$order_deals);
		
		if($order_info['user_id']==$GLOBALS['user_info']['id'])
		{
			showSuccess(round($order_info['pay_amount'],2)." 元 充值成功",0,url("index","uc_money"));
		}
		else
		{
			showSuccess(round($order_info['pay_amount'],2)." 元 充值成功",0);
		}
	
		$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['PAY_SUCCESS']);
		$GLOBALS['tmpl']->display("payment_done.html");
	}
}
?>