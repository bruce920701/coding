<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/23 0023
 * Time: 14:15
 */

class uc_coin_orderModule extends MainBaseModule
{
    public function incharge()
    {
        global_run();
        $post_data = array();
        foreach($_POST as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }
        $user_info = $GLOBALS['user_info'];

        $user_id = $user_info['id'];
        //获取所有的转入记录
        $sql = "select * from ".DB_PREFIX."coin_order where user_id=".$user_id." and type=0  order by 	create_time DESC";
        $detail = $GLOBALS['db']->getAll($sql);
        $data = array('count' => count($detail),detail => $detail);
        assign_uc_nav_list();//左侧导航菜单
        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->assign("page_title","用户充值日志");
        $GLOBALS['tmpl']->display("uc/uc_coin_order.html");
    }

    public function do_incharge()
    {
        global_run();
        $post_data = array();
        foreach($_POST as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }

        $user_id = $post_data['user_id'];
        $sql = "select * from ".DB_PREFIX."user where id=".$user_id;
        $user_info = $GLOBALS['db']->getRow($sql);
        if(!isset($user_info['id']))
        {
            $result = array("status" => false,"msg" => "用户不存在！");
            ajax_return($result);
        }
        $coin_amount = $post_data['coin_amount'];
        $coins_register_credits = $post_data['coins_register_credits'];

        $order_sn_gen = "";
        $order_sn = '"'.$order_sn_gen.'"';
        $type = 0;
        $create_time = time();
        $coin_amount = $post_data['coin_amount'];
        $coins_address = '"'.$post_data['coins_address'].'"';
        $coins_register_credits = $post_data['coins_register_credits'];
        $status = 0;
        //参数检查
        if($coin_amount <0)
        {
            $result = array("status" => false,"msg" => "转入币数目不能小于0");
            ajax_return($result);
        }
        if($coins_register_credits < 0)
        {
            $result = array("status" => false,"msg" => "转入积分数目不能小于0");
            ajax_return($result);
        }

        //将订单信息写入日志
        $sql = "insert into ".DB_PREFIX."coins_order(user_id,order_sn,type,create_time,coin_amount,coins_address,coins_register_credits,status)";
        $sql = $sql." values(".$user_id.",".$order_sn.",".$type.",".$create_time.",".$coin_amount.",".$coins_address.",".$coins_register_credits.",".$status.")";
        if($GLOBALS['db']->query($sql))
        {
            //从系统指定账号转出对应的注册积分
            $sql = "update ".DB_PREFIX."user set register_credits=register_credits-".$coins_register_credits." where id=0";
            if(!$GLOBALS['db']->query($sql))
            {
                $result = array("status" => false,"msg" => "转入失败！");
                ajax_return($result);
            }

            $admin_id = 0;
            $admin_id_detail = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=0");
            $admin_name = $admin_id_detail['user_name'];
            $type = '"credits"';
            $time = time();
            $num = $coins_register_credits;
            $msg = $admin_name."转账给用户".$user_info['user_name']." ".$num."积分";
            $msg = '"'.$msg.'"';
            $sql = "insert into ".DB_PREFIX."translate_log(id,to_id,time,type,num,msg) values(".$admin_id.','.$user_id.','.$time.','.$type.','.$num.','.$msg.")";
            if(!$GLOBALS['db']->query($sql))
            {
                $result = array("status" => false,"msg" => "转账记录更新失败！");
                ajax_return($result);
            }

            $sql = "update ".DB_PREFIX."user set register_credits=register_credits+".$coins_register_credits." where id =".$user_id;
            if($GLOBALS['db']->query($sql))
            {
                $result = array("status" => true,"msg" => "转入成功！");
                ajax_return($result);
            }
        }
        $result = array("status" => false,"msg" => "系统出现错误，转入失败！");
        ajax_return($result);
    }

    public function withdraw()
    {
        global_run();
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];

        //提币记录
        $sql = "select * from ".DB_PREFIX."coin_order where user_id=".$user_id." and type=0  order by 	create_time DESC";
        $detail = $GLOBALS['db']->getAll($sql);
        $data = array('count' => count($detail),detail => $detail);

        assign_uc_nav_list();//左侧导航菜单
        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
        $GLOBALS['tmpl']->assign("data",$data);
        $GLOBALS['tmpl']->assign("page_title","用户充值日志");
        $GLOBALS['tmpl']->display("uc/uc_coin_order.html");

    }

    public function do_withdraw()
    {
        global_run();
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];
        $post_data = array();
        foreach($_POST as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }
        $wallet_address = $post_data['wallet_address'];

        $amount = $post_data['amount'];
        $rate = $post_data['rate'];
        $coins = $amount * $rate;

        //参数检查
        if($amount > $user_info['register_credits'])
        {
            $result = array("status" => false,"msg" => "注册积分不足");
            ajax_return($result);
        }
        //更新钱包信息
        if($this->updata_wallet_balance($wallet_address,$coins))
        {
            //扣对应的注册积分并写日志
            $sql = "update ".DB_PREFIX."user set register_credits=register_credits-".$coins." where id=".$user_info['id'];
            if($GLOBALS['db']->query($sql))
            {
                $order_sn_gen = "";
                $order_sn = '"'.$order_sn_gen.'"';
                $type = 0;
                $create_time = time();
                $coin_amount = $post_data['coin_amount'];
                $coins_address = '"'.$post_data['coins_address'].'"';
                $coins_register_credits = $post_data['coins_register_credits'];
                $status = 0;
                $sql = "insert into ".DB_PREFIX."coins_order(user_id,order_sn,type,create_time,coin_amount,coins_address,coins_register_credits,status)";
                $sql = $sql." values(".$user_id.",".$order_sn.",".$type.",".$create_time.",".$coin_amount.",".$coins_address.",".$coins_register_credits.",".$status.")";
                if($GLOBALS['db']->query($sql))
                {
                    $result = array("status" => true,"msg"=> "提币成功，请前往钱包查看");
                    ajax_return($result);
                }
            }
        }
        else
        {
            //扣对应的注册积分并写日志
            $sql = "update ".DB_PREFIX."user set register_credits=register_credits-".$coins." where id=".$user_info['id'];
            if($GLOBALS['db']->query($sql))
            {
                $order_sn_gen = "";
                $order_sn = '"'.$order_sn_gen.'"';
                $type = 0;
                $create_time = time();
                $coin_amount = $post_data['coin_amount'];
                $coins_address = '"'.$post_data['coins_address'].'"';
                $coins_register_credits = $post_data['coins_register_credits'];
                $status = 1;   //表示待审核
                $sql = "insert into ".DB_PREFIX."coins_order(user_id,order_sn,type,create_time,coin_amount,coins_address,coins_register_credits,status)";
                $sql = $sql." values(".$user_id.",".$order_sn.",".$type.",".$create_time.",".$coin_amount.",".$coins_address.",".$coins_register_credits.",".$status.")";
                if($GLOBALS['db']->query($sql))
                {
                    $result = array("status" => true,"msg"=> "提币成功，等待系统审核");
                    ajax_return($result);
                }
            }
        }
    }

    private function updata_wallet_balance($wallet_address,$amount)
    {
        $url = "http://192.168.0.140/update_wallet_balance.php?address=".$wallet_address."amount=".$amount";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json')
        );
        $return_content = curl_exec($ch);
        //$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = json_decode($return_content,true);
        if($result['status'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
