<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21 0021
 * Time: 10:30
 */

class uc_myroleModule extends MainBaseModule
{

    public  function  index()
    {
        global_run();
        init_app_page();
        $GLOBALS['tmpl']->assign("sms_lesstime",load_sms_lesstime());
        $GLOBALS['tmpl']->assign("sms_ipcount",load_sms_ipcount());
        $GLOBALS['tmpl']->assign("form_prefix","page");

        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
        for($i=0;$i<7;$i++) {
            $this->check_upgrade();
        }
        //assign_uc_nav_list();


        //$user_info = $GLOBALS['user_info'];
        $user_id = $GLOBALS['user_info']['id'];

        $sql = "select * from ".DB_PREFIX."user where id=".$GLOBALS['user_info']['id'];
        //$user_info = $GLOBALS['db']->getRow($sql);

        $user_detail = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_id);
        $user_level = $user_detail['user_level'];

        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."global_config where config=".$config);

        $user_next_level = $user_level + 1;
        //$direct_users = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."direct_user where id=".$user_id);
        $direct_users_num = $this->get_user_direct_user_num($user_id);

        $market_users = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."market_user where id=".$user_id);
        $this->all_unbrella_user = array();
        $this->get_unbrella_users($user_id);
        $unbrella_user = $this->all_unbrella_user;
        $user_market_6_num = 0;
        $user_market_5_num = 0;
        $user_market_4_num = 0;
        $user_market_3_num = 0;
        $user_market_2_num = 0;
        $user_market_1_num = 0;
        $result = array();
        foreach($market_users as $item)
        {
            $this->total_order_num = 0;
            $this->get_unbrella_users_orders_num($item['m_id']);
            $result[] = array('id' => $item['m_id'], 'num' => $this->total_order_num);
        }


        foreach ($unbrella_user as $item)
        {
            $item_detail = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$item);
            switch ($item_detail['user_level']) {
                case 1:
                    $user_market_1_num++;
                    break;
                case 2:
                    $user_market_2_num++;
                    break;
                case 3:
                    $user_market_3_num++;
                    break;
                case 4:
                    $user_market_4_num++;
                    break;
                case 5:
                    $user_market_5_num++;
                    break;
                case 6:
                    $user_market_6_num++;
                    break;
                default:
                    break;
            }
        }

        $user_next_level_markets_min = $global_config["fx_".$user_next_level."_markets_min"];
        $user_next_level_direct_members_min = $global_config["fx_".$user_next_level."_members_min"];
        $user_next_level_orders_min = $global_config["fx_".$user_next_level."_orders_min"];
        $user_next_level_market6_min = $global_config["fx_".$user_next_level."_market6_min"];
        $user_next_level_market5_min = $global_config["fx_".$user_next_level."_market5_min"];
        $user_next_level_market4_min = $global_config["fx_".$user_next_level."_market4_min"];
        $user_next_level_market3_min = $global_config["fx_".$user_next_level."_market3_min"];
        $user_next_level_market2_min = $global_config["fx_".$user_next_level."_market2_min"];
        $user_next_level_market1_min = $global_config["fx_".$user_next_level."_market1_min"];
        $fx_rate = $global_config["fx_".$user_level."_rate"];
        $fx_get_rainbow_rate = $global_config["fx_".$user_level."_get_rainbow_rate"];

        $will_show_order_detail = 0;
        if($user_level == 1 || $user_level == 2 || $user_level ==3 || $user_level == 0)
        {
            $will_show_order_detail = 1;
        }

        $current_order_satisfied_market_num =0;
        foreach($result as $item)
        {
            if($item['num'] >= $user_next_level_orders_min)
                $current_order_satisfied_market_num ++;
        }

        if(APP_INDEX == 'app'){
            $url ='javascript:App.app_detail(107,0);';
        }else{
            $url = 'javascript:history.go(-1);';
        }

        $fx_0_members_0 = $global_config['fx_0_members_0'];
        $fx_0_members_1 = $global_config['fx_0_members_1'];
        $fx_0_members_2 = $global_config['fx_0_members_2'];

        if($direct_users_num < $fx_0_members_0)
        {
            $level_0_fx = 0;
        }
        else if($direct_users_num < $fx_0_members_1)
        {
            $level_0_fx = 1;
        }
        else if($direct_users_num < $fx_0_members_2)
        {
            $level_0_fx = 2;
        }
        else
        {
            $level_0_fx = 3;
        }

        //计算当前总获得奖金和当前奖金封顶值
        //消费记录
        $user_deal_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "deal_order where user_id=" . $user_id);
        $total_consume = 0;
        foreach($user_deal_list as $item)
        {
            $total_consume += $item['pay_amount'];
        }

        //获奖记录
        //test_time   为测试时设定的日期的时间戳，如果没有设置则获取当前时间戳
        $current_time = isset($_GET['test_time']) ? $_GET['test_time'] : time();
        $reward_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "reward_log where id=" . $user_id ." and status=1  and c_time<".$current_time);
        $current_reward = 0;
        foreach($reward_list as $item)
        {
            $current_reward += $item['credits'];
        }
        //杠杆倍数
        $consume_1 = $global_config['consume_1'];
        $consume_2 = $global_config['consume_2'];
        $consume_3 = $global_config['consume_3'];
        if($total_consume < $consume_1)
        {
            $grade= 0;
        }
        else if($total_consume < $consume_2)
        {
            $grade = $global_config['level_1'];
        }
        else if($total_consume < $consume_3)
        {
            $grade = $global_config['level_2'];
        }
        else
        {
            $grade = $global_config['level_3'];
        }
        $current_reward_max = $total_consume * $grade;

        $GLOBALS['tmpl']->assign('url',$url);
        $GLOBALS['tmpl']->assign("user_level",$user_level);
        $GLOBALS['tmpl']->assign("level_0_fx",$level_0_fx);
        $GLOBALS['tmpl']->assign("direct_users_num",$direct_users_num);
        $GLOBALS['tmpl']->assign("user_next_level_direct_members_min",$user_next_level_direct_members_min);
        $GLOBALS['tmpl']->assign("user_next_level_orders_min",$user_next_level_orders_min);
        $GLOBALS['tmpl']->assign("user_next_level_market6_min",$user_next_level_market6_min);
        $GLOBALS['tmpl']->assign("user_next_level_market5_min",$user_next_level_market5_min);
        $GLOBALS['tmpl']->assign("user_next_level_market4_min",$user_next_level_market4_min);
        $GLOBALS['tmpl']->assign("user_next_level_market3_min",$user_next_level_market3_min);
        $GLOBALS['tmpl']->assign("user_next_level_market2_min",$user_next_level_market2_min);
        $GLOBALS['tmpl']->assign("user_next_level_market1_min",$user_next_level_market1_min);
        $GLOBALS['tmpl']->assign("fx_rate",$fx_rate);
        $GLOBALS['tmpl']->assign("fx_get_rainbow_rate",$fx_get_rainbow_rate);
        $GLOBALS['tmpl']->assign("will_show_order_detail",$will_show_order_detail);
        $GLOBALS['tmpl']->assign("current_order_satisfied_market_num",$current_order_satisfied_market_num);
        $GLOBALS['tmpl']->assign("user_next_level_market_min",$user_next_level_markets_min);
        $GLOBALS['tmpl']->assign("user_market_1_num",$user_market_1_num);
        $GLOBALS['tmpl']->assign("user_market_2_num",$user_market_2_num);
        $GLOBALS['tmpl']->assign("user_market_3_num",$user_market_3_num);
        $GLOBALS['tmpl']->assign("user_market_4_num",$user_market_4_num);
        $GLOBALS['tmpl']->assign("user_market_5_num",$user_market_5_num);
        $GLOBALS['tmpl']->assign("user_market_6_num",$user_market_6_num);

        $GLOBALS['tmpl']->assign("current_reward",$current_reward);
        $GLOBALS['tmpl']->assign('current_reward_max',$current_reward_max);


        $GLOBALS['tmpl']->assign("page_title","我的角色");
        $GLOBALS['tmpl']->display("uc_myrole.html");
        //echo json_encode($GLOBALS['tmpl']);
    }

    /*
    private  function get_user_direct_user_num($id)
    {
        $num = 0;
        $sql = "select * from " . DB_PREFIX . "direct_user where id=" . $id;
        $direct_user_list = $GLOBALS['db']->getAll($sql);
        foreach($direct_user_list as $item)
        {
            $sql = "select * from ".DB_PREFIX."user where id=".$item['d_id'];
            $item_detail = $GLOBALS['db']->getRow($sql);
            if($item_detail['active'] == 1)
            {
                $num ++;
            }
        }
        return $num;
    }
    */

    private  function get_user_direct_user_num($id)
    {
        $num = 0;
        $sql = "select * from " . DB_PREFIX . "direct_user where id=" . $id;
        $direct_user_list = $GLOBALS['db']->getAll($sql);
        foreach($direct_user_list as $item)
        {
            $sql = "select * from ".DB_PREFIX."user where id=".$item['d_id'];
            $item_detail = $GLOBALS['db']->getRow($sql);
            if($item_detail['active'] == 1)
            {
                $num ++;
            }
        }
        return $num;
    }

    private $all_unbrella_user = array();
    private function get_unbrella_users($uid)    //获取所有伞下用户的id
    {
        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "market_user where id=" . $uid);
        foreach ($m_id_list as $key=>$value)
        {
            $this->all_unbrella_user[] = $value['m_id'];
            $this->get_unbrella_users($value['m_id']);
        }
    }

    private $total_order_num =0;
    private function get_unbrella_users_orders_num($uid)    //获取某个用户所有伞下用户的订单数，包括他自己的
    {
        $user_deal_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "deal_order where user_id=" . $uid);
        foreach($user_deal_list as $item)
        {
            if ($item['pay_amount'] > 0)
            {
                $this->total_order_num += 1;
            }
        }
        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "direct_user where id=" . $uid);
        foreach ($m_id_list as $key=>$value)
        {
            $this->get_unbrella_users_orders_num($value['m_id']);
        }
    }

    //检查用户升级条件，看是否满足升级条件，如满足则升级

    private  function check_upgrade()
    {
        $sql = "select * from ".DB_PREFIX."user where id=".$GLOBALS['user_info']['id'];
        $user_info = $GLOBALS['db']->getRow($sql);
        //$user_info = $GLOBALS['user_info'];
        $config = '"default"';
        $sql = "select * from " . DB_PREFIX . "global_config where config=" . $config;
        $global_config = $GLOBALS['db']->getRow($sql);

        $user_level = $user_info['user_level'];

        $sql = "select * from " . DB_PREFIX . "direct_user where id=" . $user_info['id'];
        $direct_user_list = $GLOBALS['db']->getAll($sql);

        $direct_user_num = $this->get_user_direct_user_num($user_info['id']);

        $sql = "select * from " . DB_PREFIX . "market_user where id=" . $user_info['id'];
        $market_user_list = $GLOBALS['db']->getAll($sql);
        $market_num = count($market_user_list);

        $next_level = $user_level + 1;

        $next_level_members_min = $global_config["fx_".$next_level."_members_min"];
        $key_market_min = "fx_" . $next_level . "_markets_min";
        $next_level_markets_min = isset($global_config[$key_market_min]) ? $global_config[$key_market_min] : 0;
        $key_orders_min = "fx_".$next_level."_orders_min";
        $next_level_orders_min = isset($global_config[$key_orders_min]) ? $global_config[$key_orders_min] : 0;

        $key_market_min = "fx_" . $next_level . "_markets_min";
        $current_level_market_min = isset($global_config[$key_market_min]) ? $global_config[$key_market_min] : 0;

        $key_market6_min = "fx_" . $next_level . "_market6_min";
        $next_level_markets_6_min = isset($global_config[$key_market6_min]) ? $global_config[$key_market6_min] : 0;

        $key_market5_min = "fx_" . $next_level . "_market5_min";
        $next_level_markets_5_min = isset($global_config[$key_market5_min]) ? $global_config[$key_market5_min] : 0;

        $key_market4_min = "fx_" . $next_level . "_market4_min";
        $next_level_markets_4_min = isset($global_config[$key_market4_min]) ? $global_config[$key_market4_min] : 0;

        $key_market3_min = "fx_" . $next_level . "_market3_min";
        $next_level_markets_3_min = isset($global_config[$key_market3_min]) ? $global_config[$key_market3_min] : 0;

        $key_market2_min = "fx_" . $next_level . "_market2_min";
        $next_level_markets_2_min = isset($global_config[$key_market2_min]) ? $global_config[$key_market2_min] : 0;

        $key_market1_min = "fx_" . $next_level . "_market1_min";
        $next_level_markets_1_min = isset($global_config[$key_market1_min]) ? $global_config[$key_market1_min] : 0;

        //echo "next_level_direct_num：".$next_level_members_min." next_level_markets_min :".$next_level_markets_min." next_level_orders_min : ".$next_level_orders_min." next_level_markets_min: ".$next_level_markets_min;

        $result = array();
        foreach($market_user_list as $item)
        {
            $this->total_order_num = 0;
            $this->get_unbrella_users_orders_num($item['m_id']);
            $result[] = array("id" => $item['m_id'], "num" => $this->total_order_num);
        }
        $market_orders_num_satisfied = 0;
        foreach($result as $item)
        {
            if($item['num'] >=  $next_level_orders_min)
                $market_orders_num_satisfied ++;
        }

        $market_users = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."market_user where id=".$user_info['id']);
        $this->all_unbrella_user = array();
        $this->get_unbrella_users($user_info['id']);
        $unbrella_user = $this->all_unbrella_user;
        $user_market_6_num = 0;
        $user_market_5_num = 0;
        $user_market_4_num = 0;
        $user_market_3_num = 0;
        $user_market_2_num = 0;
        $user_market_1_num = 0;
        $result = array();
        foreach($market_users as $item)
        {
            $this->total_order_num = 0;
            $this->get_unbrella_users_orders_num($item['m_id']);
            $result[] = array('id' => $item['m_id'], 'num' => $this->total_order_num);
        }


        foreach ($unbrella_user as $item)
        {
            $item_detail = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$item);
            switch ($item_detail['user_level']) {
                case 1:
                    $user_market_1_num++;
                    break;
                case 2:
                    $user_market_2_num++;
                    break;
                case 3:
                    $user_market_3_num++;
                    break;
                case 4:
                    $user_market_4_num++;
                    break;
                case 5:
                    $user_market_5_num++;
                    break;
                case 6:
                    $user_market_6_num++;
                    break;
                default:
                    break;
            }
        }



        $should_upgrade = true;

        //直推用户数少于下一等级最低要求的用户数，不升级
        if ($direct_user_num < $next_level_members_min) {
            $should_upgrade = false;
        }

        //市场数少于下一等级最低用户数，不升级
        if ($market_num < $next_level_markets_min) {
            $should_upgrade = false;

        }

        //订单数目满足最低配置数目的市场数少于配置值时不升级
        if ($market_orders_num_satisfied < $current_level_market_min) {
            $should_upgrade = false;
        }
        //每个市场内出现的指定等级的会员数少于配置值时不升级
        if($market_orders_num_satisfied < $next_level_markets_min) {
            $should_upgrade = false;
        }

        //每个等级的会员数小于配置值时不升级
        if($user_market_6_num < $next_level_markets_6_min)
        {
            $should_upgrade = false;
        }
        if($user_market_5_num < $next_level_markets_5_min)
        {
            $should_upgrade = false;
        }
        if($user_market_4_num < $next_level_markets_4_min)
        {
            $should_upgrade = false;
        }
        if($user_market_3_num < $next_level_markets_3_min)
        {
            $should_upgrade = false;
        }
        if($user_market_2_num < $next_level_markets_2_min)
        {
            $should_upgrade = false;
        }
        if($user_market_1_num < $next_level_markets_1_min)
        {
            $should_upgrade = false;
        }

        //升级
        if ($should_upgrade) {
            $sql = "update ".DB_PREFIX."user set user_level=user_level+1 where id=".$user_info['id'];
            $GLOBALS['db']->query($sql);
        }
    }



}


