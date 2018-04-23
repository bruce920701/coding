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

        assign_uc_nav_list();
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];

        $user_detail = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_id);
        $user_level = $user_detail['user_level'];

        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."global_config where config=".$config);

        $user_next_level = $user_level + 1;
        $direct_users = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."direct_user where id=".$user_id);
        $direct_users_num = count($direct_users);

        $market_users = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."market_user where id=".$user_id);
        $unbrella_user = $this->get_unbrella_users($user_id);
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
        if($user_level == 1 || $user_level == 2 || $user_level ==3)
        {
            $will_show_order_detail = 1;
        }

        $current_order_satisfied_market_num =0;
        foreach($result as $item)
        {
            if($item['num'] > $user_next_level_orders_min)
                $current_order_satisfied_market_num ++;
        }

        $GLOBALS['tmpl']->assign("user_level",$user_level);
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


        $GLOBALS['tmpl']->assign("page_title","我的角色");
        $GLOBALS['tmpl']->display("uc/uc_myrole.html");
        echo json_encode($GLOBALS['tmpl']);
    }

    private function get_unbrella_users($uid)    //获取所有伞下用户的id
    {
        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "direct_list where uid=" . $uid);
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
        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "direct_list where uid=" . $uid);
        foreach ($m_id_list as $key=>$value)
        {
            $this->get_unbrella_users_orders_num($value['m_id']);
        }
    }
}
