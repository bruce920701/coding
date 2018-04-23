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

	
	public function done()
	{
		global_run();
		init_app_page();
		$id = intval($_REQUEST['id']);
		
		$data = call_api_core("payment","done",array("id"=>$id));
		
		if(!$data['status'])
		{
			showErr($data['info']);
		}
        //print_r($data);
		if($data['pay_status']==1)
		{ 
			$data['page_title'] = "支付结果";
			if($data['is_main']==1){
			   
			    if(APP_INDEX=='app'){
			        $back_url ='javascript:App.app_detail(305,0);';
			        $back_go_url ='javascript:App.app_detail(1,0);';
			    }else{
			        $back_go_url = wap_url("index","index#index");
			        $back_url = wap_url("index","uc_order");
			    }
			    $type=305;  // 我的订单--普通订单列表  
			}else{
			   
			    
			    if($data['order_type']==1){ //充值订单
			        $back_url = wap_url("index","uc_money#index");
			        $type=0;  // wap链接
			        $json_parma = json_encode(array());    			   
			        
			    }else if($data['order_type']==7){
                    $back_url = '';
                    $back_go_url=wap_url("index","scores_index");
                    $GLOBALS['tmpl']->assign("detail_url",wap_url("index","uc_score#index"));
                }else{
					$arr=array('data_id'=>$id,'is_done'=>1);
			        if(APP_INDEX=='app'){
			            $json_parma = addslashes(json_encode($arr));
			            $back_url ='javascript:App.app_detail(308,"'.$json_parma.'");';
			            $back_go_url ='javascript:App.app_detail(1,0);';
			        }else{
			            $back_url = wap_url("index","uc_order#view",$arr);
			            $back_go_url = wap_url("index","index#index");
			        }

			    }
			}
			
			$GLOBALS['tmpl']->assign("back_url",$back_url);
			$GLOBALS['tmpl']->assign("back_go_url",$back_go_url);
			$GLOBALS['tmpl']->assign("data",$data);
			$GLOBALS['tmpl']->display("payment_done.html");


            $order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$id);
            //当type=8表示为精品区订单，此时判断账户是否激活，如没激活则激活账户
            $user_info = $GLOBALS['user_info'];
            if($user_info['active'] ==0  && $order_info['type'] == 8)
            {
                $sql = "update ".DB_PREFIX."user set active=1 where id=".$user_info['id'];
                $GLOBALS['db']->query($sql);
                //echo "$sql";
                //var_dump($GLOBALS['db']->error());
            }

            /*
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
                $unfrezen_time = $this->getNextMondaytime($c_time);
                $unfrezen_time = $c_time;
                $status = 0;
                $msg = '"'.$user_info["user_name"] . "消费了" . $order_info['pay_amount'] . "，您获得" . $credits . "直推奖".'"';
                $sql = "insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$d_id.",".$type.",".$c_time.",".$credits.",".$unfrezen_time.",".$status.",".$msg.")";
                $GLOBALS['db']->query($sql);
                //echo "$sql";
                //var_dump($GLOBALS['db']->error());
            }
            */


		}
		else
		{
		        $pay_url = $data['payment_code']['pay_action'];
		        app_redirect($pay_url);
    
		    /*
			$data['payment_code']['page_title'] = "订单付款";
			$GLOBALS['tmpl']->assign("data",$data['payment_code']);
			$GLOBALS['tmpl']->display("payment_pay.html");
			*/
		}
		
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

	public function incharge_done(){
	    $this->done();
	}
	public function order_share(){
	    global_run();
	    init_app_page();
	    $id = intval($_REQUEST['id']);
	    $is_share = intval($_REQUEST['is_share']);

	    if($is_share){
	        $data = call_api_core("payment","order_share",array("id"=>$id));
	        if($data['user_login_status']!=LOGIN_STATUS_LOGINED){
				login_is_app_jump();
	            //app_redirect(wap_url("index","user#login"));
	            exit;
	        }
	    }
	    app_redirect(wap_url("index","uc_order#index",array('pay_status'=>1)));
	}
		
}
?>