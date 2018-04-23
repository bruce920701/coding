<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19 0019
 * Time: 13:43
 */

class uc_dynamic_reward{

    private $all_unbrella_user = array();

    public function index()
    {
        global_run();
        init_app_page();
        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉

        if(check_save_login()!=LOGIN_STATUS_LOGINED)
        {
            app_redirect(url("index","user#login"));
        }

        $GLOBALS['tmpl']->assign("page_title","我的信息");
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];
        $user_detail = $GLOBALS['db']->get_raws("select * from ".DB_PREFIX."user where id=".$user_id);

        $direct_users = $GLOBALS['']->getAll("select * from ".DB_PREFIX."direct_user where id=".$user_id);
        $total_direct_user_consume = 0;
        foreach($direct_users as $key => $value)
        {
            $d_id = $value['did'];
            $d_id_detail = $GLOBALS['db']->get_raws("select * from ".DB_PREFIX."user where id=".$d_id);
            $total_direct_user_consume += $d_id_detail['total_consume'];
        }
        $global_config = $GLOBALS['db']->get_raw("select * from".DB_PREFIX."user_global_config where config=global");
        $direct_rate = $global_config['direct_rate'];
        //获取直推奖的总额和领导奖的总额
        $all_leader_reward = $this->get_all_leader_reward($user_id);
        $all_direct_reward = $total_direct_user_consume * $direct_rate;
        $all_leader_reward_detail = array();
        $all_direct_reward_detail = array();

        assign_uc_nav_list();
        $GLOBALS['tmpl']->assign("all_leader_reward",$all_leader_reward);
        $GLOBALS['tmpl']->assign("all_direct_reward",$all_direct_reward);
        $GLOBALS['tmpl']->assign("all_leader_reward_detail",$all_leader_reward_detail);
        $GLOBALS['tmpl']->assign("all_direct_reward_detail",$all_direct_reward_detail);

    }

    private function get_unbrella_users($uid)
    {
        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "direct_list where uid=" . $uid);
        foreach ($m_id_list as $key=>$value)
        {
            $this->all_unbrella_user[] = $value['m_id'];
            $this->get_unbrella_users($value['m_id']);
        }
    }

    private  function  get_all_leader_reward($uid)
    {
        $this->get_unbrella_users($uid);
        $d_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "direct_list where uid=" . $uid);
        $user_info = $GLOBALS['db']->getRaw("select * from " . DB_PREFIX . "user where uid=" . $uid);
        $global_config = $GLOBALS['db']->getRaw("select * from".DB_PREFIX."user_global_config where config=global");
        $user_level = $user_info['user_level'];


        //所有伞下用户的每日的收益总额
        $total_rainbow_user_benefit = 0;
        foreach ($this->all_unbrella_user as $item)
        {
            $item_detail = $GLOBALS['db']->getRaw("select * REFIX" . "user where id=" . $item);
            $total_rainbow_user_benefit += $item_detail['static_reward_money'];
        }

        $total_direct_user_benefit = 0;
        //所有直推用户的每日收益总额
        foreach($d_id_list as $key => $value)
        {
            $d_detail = $GLOBALS['db']->getRaw("select * REFIX" . "user where id=" . $item);
            $total_direct_user_benefit += $d_detail['static_reward_money'];
        }
        switch ($user_level) {
            case 0:
                {
                    $dynamic_reward_rate = $global_config['	direct_rate'];
                    $total_dynamic_reward = $total_direct_user_benefit * $dynamic_reward_rate;
                }
                break;
            case 1:
                {
                    $dynamic_reward_rate = $global_config['	fx_1_rate'];
                    $total_dynamic_reward = $total_rainbow_user_benefit * $dynamic_reward_rate;
                }
                break;
            case 2:
                {
                    $dynamic_reward_rate = $global_config['	fx_2_rate'];
                    $total_dynamic_reward = $total_rainbow_user_benefit * $dynamic_reward_rate;
                }
                break;
            case 4:
                {
                    $dynamic_reward_rate = $global_config['	fx_4_rate'];
                    $total_dynamic_reward = $total_rainbow_user_benefit * $dynamic_reward_rate;
                }
                break;
            case 5:
                {
                    $dynamic_reward_rate = $global_config['	fx_5_rate'];
                    $total_dynamic_reward = $total_rainbow_user_benefit * $dynamic_reward_rate;
                }
                break;
            case 6:
                {
                    $dynamic_reward_rate = $global_config['	fx_6_rate'];
                    $total_dynamic_reward = $total_rainbow_user_benefit * $dynamic_reward_rate;
                }
                break;
            case 7:
                {
                    $dynamic_reward_rate = $global_config['	fx_7_rate'];
                    $total_dynamic_reward = $total_rainbow_user_benefit * $dynamic_reward_rate;
                }
                break;
                defalt:
                    return 0;

        }
        return $total_dynamic_reward;
    }

}