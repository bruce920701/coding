<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21 0021
 * Time: 11:31
 */


class testModule extends MainBaseModule
{

    private $all_unbrella_user= array();

    public function test()
    {
        $user_id = 235;
        $upon_user_id= 219;
        echo $this->get_generation_num($upon_user_id,$user_id);
    }

    public  function test1()
    {
        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "global_config  where config=$config");

        $id = 306;
        $static_reward_money = 100;
        $sql = "select * from ".DB_PREFIX."user where id=".$id;
        $user_info = $GLOBALS['db']->getRow($sql);
        $upon_user = $this->get_upon_rainbow_user($id);
        $unfrezen_time = $this->getNextMondaytime(time());  //为奖金结算的日期
        echo json_encode($global_config);

        foreach($upon_user as $item) {
            $item_detail =  $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $item);
            $sql = "select * from ".DB_PREFIX."direct_user where id=".$item;
            $direct_user_list = $GLOBALS['db']->getAll($sql);
            echo json_encode($item_detail);
            $fx_0_members_0 = $global_config['fx_0_members_0'];
            $fx_0_members_1 = $global_config['fx_0_members_1'];
            $fx_0_members_2 = $global_config['fx_0_members_2'];

            $fx_0_members_0_child = $global_config['fx_0_members_0_child'];
            $fx_0_members_1_child = $global_config['fx_0_members_1_child'];
            $fx_0_members_2_child = $global_config['fx_0_members_2_child'];

            $fx_0_members_0_rate = $global_config['fx_0_members_0_rate'];
            $fx_0_members_1_rate = $global_config['fx_0_members_1_rate'];
            $fx_0_members_2_rate = $global_config['fx_0_members_2_rate'];

            $generation_num = $this->get_generation_num($item,$id);

            $should_continue = false;
            $direct_user_num = count($direct_user_list);
            $rate = 0;
            if($direct_user_num < $fx_0_members_0)
            {
                $should_continue = true;
                echo "skip1  ,direct_num = ".$direct_user_num;
            }
            else if($direct_user_num < $fx_0_members_1) //拿下一代
            {
                $rate = $fx_0_members_0_rate;
                if($generation_num > $fx_0_members_0_child)
                {
                    $should_continue = true;
                    echo "skip2";

                }
            }
            else if($direct_user_num < $fx_0_members_2) //拿下两代
            {
                $rate = $fx_0_members_1_rate;
                if($generation_num > $fx_0_members_1_child)
                {
                    $should_continue = true;
                    echo "skip3";

                }
            }
            else
            {
                $rate = $fx_0_members_2_rate;
                if($generation_num > $fx_0_members_2_child)
                {
                    $should_continue = true;
                    echo "skip4";

                }
            }
            //生成一级分销奖
            if($should_continue == false)
            {
                for ($i = 1; $i < 8; $i++)
                {
                    $upon_user_id = $item;
                    $type = '"leader"';
                    $status = 0;
                    $leader_reward_end_time = strtotime(date("Y-m-d", strtotime("+$i day")));    //生效时间点
                    $upon_user_level = $item_detail['user_level'];
                    //$key="fx_" . $upon_user_level . "_get_rainbow_rate";
                    //$upon_user_fx_get_rainbow_rate = $global_config[$key];
                    //$upon_user_fx_rate = $global_config["fx_" . $upon_user_level . "_rate"];
                    //$rate = $upon_user_fx_get_rainbow_rate == 0 ? $upon_user_fx_rate : $upon_user_fx_get_rainbow_rate;

                    $upon_user_leader_reward_money = $static_reward_money * $rate;
                    $msg = '"' . $user_info["user_name"] . "申请获得" . $static_reward_money . "静态分红，您获得" . $upon_user_leader_reward_money . "领导奖" . '"';
                    $sql = "insert into " . DB_PREFIX . "reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(" . $upon_user_id . "," . $type . "," . $leader_reward_end_time . "," . $upon_user_leader_reward_money . "," . $unfrezen_time . "," . $status . "," . $msg . ")";
                    //$GLOBALS['db']->query("insert into " . DB_PREFIX . "reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(" . $upon_user_id . "," . $type . "," . $leader_reward_end_time . "," . $static_reward_money . "," . $unfrezen_time . "," . $status . "," . $msg . ")");
                    //$GLOBALS['db']->query($sql);
                    echo $sql;
                }
            }

            if($item_detail['user_level'] == 0)
            {
                continue;
            }
            for ($i = 1; $i < 8; $i++) {
                $upon_user_id = $item;
                $type = '"leader"';
                $status = 0;
                $leader_reward_end_time = strtotime(date("Y-m-d",strtotime("+$i day")));    //生效时间点
                $upon_user_level = $item_detail['user_level'];
                $key="fx_" . $upon_user_level . "_get_rainbow_rate";
                $upon_user_fx_get_rainbow_rate = $global_config[$key];
                $upon_user_fx_rate = $global_config["fx_" . $upon_user_level . "_rate"];
                //$rate = $upon_user_fx_get_rainbow_rate == 0 ? $upon_user_fx_rate : $upon_user_fx_get_rainbow_rate;
                $rate = $upon_user_fx_get_rainbow_rate;
                $upon_user_leader_reward_money = $static_reward_money * $rate;
                $msg = '"'.$user_info["user_name"] . "申请获得" . $static_reward_money . "静态分红，您获得" . $upon_user_leader_reward_money . "领导奖".'"';
                $sql = "insert into " . DB_PREFIX . "reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(" . $upon_user_id . "," . $type . "," . $leader_reward_end_time . "," . $upon_user_leader_reward_money . "," . $unfrezen_time . "," . $status . "," . $msg . ")";
                //$GLOBALS['db']->query("insert into " . DB_PREFIX . "reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(" . $upon_user_id . "," . $type . "," . $leader_reward_end_time . "," . $static_reward_money . "," . $unfrezen_time . "," . $status . "," . $msg . ")");
                $GLOBALS['db']->query($sql);

            }
        }



    }

    public function index()
    {

        $id=239;
        $user_info = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $id);
        $static_reward_money = 100;
        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "global_config  where config=$config");

        $upon_user = $this->get_upon_rainbow_user($id);
        $unfrezen_time = $this->getNextMondaytime(time()+3600000);  //为奖金结算的日期
        $result = array();
        $result1 = array();

        foreach($upon_user as $item) {
            $item_detail =  $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $item);
            $result = array();
            for ($i = 1; $i < 8; $i++) {
                $upon_user_id = $item;
                $type = '"leader"';
                $status = 0;
                $leader_reward_end_time = strtotime(date("Y-m-d",strtotime("+$i day")));    //生效时间点
                $upon_user_level = $item_detail['user_level'];
                $key="fx_" . $upon_user_level . "_get_rainbow_rate";
                $upon_user_fx_get_rainbow_rate = $global_config[$key];
                $upon_user_fx_rate = $global_config["fx_" . $upon_user_level . "_rate"];
                $rate = $upon_user_fx_get_rainbow_rate == 0 ? $upon_user_fx_rate : $upon_user_fx_get_rainbow_rate;

                $upon_user_leader_reward_money = $static_reward_money * $rate;
                $msg = '"'.$user_info["user_name"] . "申请获得" . $static_reward_money . "静态分红，您获得" . $upon_user_leader_reward_money . "领导奖".'"';
                $sql = "insert into " . DB_PREFIX . "reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(" . $upon_user_id . "," . $type . "," . $leader_reward_end_time . "," . $upon_user_leader_reward_money . "," . $unfrezen_time . "," . $status . "," . $msg . ")";
                //$GLOBALS['db']->query("insert into " . DB_PREFIX . "reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(" . $upon_user_id . "," . $type . "," . $leader_reward_end_time . "," . $static_reward_money . "," . $unfrezen_time . "," . $status . "," . $msg . ")");
                //$GLOBALS['db']->query($sql);
                var_dump($GLOBALS['db']->error());
                $result[] = $sql;
            }
            $result1[] = $result;
        }

        echo json_encode($result1);


    }

    public function test3()
    {
        //写转账记录


        $user_id=12;
        $t_id = 95;
        $type = '"credits"';
        $time = time();
        $num = 100;
        $t_credits = $num;

        $sql = "select * from " . DB_PREFIX . "user where id=" . $t_id;
        $t_user_info = $GLOBALS['db']->getRow($sql);
        echo $sql;
        var_dump($t_user_info);
        $msg = "您转账给用户".$t_user_info['user_name']." ".$t_credits."积分";
        $msg = '"'.$msg.'"';

        $sql = "insert into ".DB_PREFIX."translate_log(id,to_id,time,type,num,msg) values(".$user_id.','.$t_id.','.$time.','.$type.','.$num.','.$msg.")";
        echo $sql;
        $GLOBALS['db']->query($sql);
        var_dump($GLOBALS['db']->error());
    }


    public function test4()
    {
        $user_info['id'] = 285;
        $type = '"active_code"';
        $sql = "select * from ".DB_PREFIX."translate_log where id=".$user_info['id']." and type=".$type;
        echo $sql;
        $translate_detail = $GLOBALS['db']->getAll($sql);
        var_dump($translate_detail);
    }
    //判断upon_user 是user的上面第几代用户
    private function get_generation_num($upon_user_id,$user_id)
    {
        $num = 0;
        $sql = "select * from ".DB_PREFIX."market_user where m_id=".$user_id;
        $upon_user_deatil = $GLOBALS['db']->getRow($sql);
        while($upon_user_deatil)
        {
            $num++;
            if($upon_user_deatil['id'] == $upon_user_id)
            {
                return $num;
            }
            else {
                $sql = "select * from " . DB_PREFIX . "market_user where m_id=" . $upon_user_deatil['id'];
                $upon_user_deatil = $GLOBALS['db']->getRow($sql);
            }
        }
        return 0;
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

    private  function get_upon_rainbow_user($id)
    {
        $upon_user = array();
        $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX ."market_user where m_id=".$id);
        $s_id = isset($user_detail['id']) ? $user_detail['id'] : null;
        if($s_id != NULL) {
            $upon_user[] = $s_id;
        }
        while($s_id != NULL) {
            $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "market_user where m_id=" . $s_id);
            $s_id = isset($user_detail['id']) ? $user_detail['id'] : null;
            if ($s_id != null) {
                $upon_user[] = $s_id;
            }
            else
            {
                break;
            }
        }
        return $upon_user;
    }

    private function get_unbrella_users($uid)    //获取所有伞下用户的id
    {
        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "market_user where id=" . $uid);
        var_dump($m_id_list);
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

    private  function check_upgrade()
    {
        $sql = "select * from ".DB_PREFIX."user where id=".$GLOBALS['user_info']['id'];
        $user_info = $GLOBALS['db']->getRow($sql);
        //$user_info = $GLOBALS['user_info'];
        echo json_encode($user_info);
        $config = '"default"';
        $sql = "select * from " . DB_PREFIX . "global_config where config=" . $config;
        $global_config = $GLOBALS['db']->getRow($sql);
        echo json_encode($global_config);

        $user_level = $user_info['user_level'];

        $sql = "select * from " . DB_PREFIX . "direct_user where id=" . $user_info['id'];
        $direct_user_list = $GLOBALS['db']->getAll($sql);

        $direct_user_num = $this->get_user_direct_user_num($user_info['id']);

        $sql = "select * from " . DB_PREFIX . "market_user where id=" . $user_info['id'];
        $market_user_list = $GLOBALS['db']->getAll($sql);
        $market_num = count($market_user_list);

        $next_level = $user_level + 1;
        $key_memebers_min = "fx_" . $next_level . "_memebers_min";
        $next_level_direct_num = isset($global_config[$key_memebers_min]) ? $global_config[$key_memebers_min] : 0;
        $key_market_min = "fx_" . $next_level . "_markets_min";
        $next_level_markets_min = isset($global_config[$key_market_min]) ? $global_config[$key_market_min] : 0;
        $key_orders_min = "fx_".$next_level."_orders_min";
        $next_level_orders_min = isset($global_config[$key_orders_min]) ? $global_config[$key_orders_min] : 0;

        $key_market_min = "fx_" . $user_level . "_markets_min";
        $current_level_market_min = isset($global_config[$key_market_min]) ? $global_config[$key_market_min] : 0;

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
            if($item['num'] >= $ $next_level_orders_min)
                $market_orders_num_satisfied ++;
        }

        $should_upgrade = true;

        //直推用户数少于下一等级最低要求的用户数，不升级
        if ($direct_user_num < $next_level_direct_num) {
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

        //升级
        if ($should_upgrade) {
            $sql = "update ".DB_PREFIX."user set user_level=user_level+1 where id=".$user_info['id'];
            $GLOBALS['db']->query($sql);
        }
    }

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


    public  function is_upon_rainbow_user($id,$t_id)
    {
        $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX ."market_user where m_id=".$id);
        $s_id = $user_detail['id'];
        echo $s_id;
        if($s_id==$t_id)
        {
            return true;
        }
        while($s_id != NULL && $s_id!=$t_id)
        {
            $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX ."market_user where m_id=".$s_id);
            $s_id = $user_detail['s_id'];
            if($user_detail['s_id'] == $t_id)
            {
                return true;
            }
        }
        return false;
    }

    public function test_1()
    {
        $id=160;
        $to_id=95;
        $re = $this->is_upon_rainbow_user($id,$to_id);
        if($re)
        {
            echo "is ";
        }
        else
        {
            echo "false";
        }
    }

    //判断是否达到奖金封顶值
    private function reach_max_reward($user_id)
    {
        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."global_config where config=".$config);

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
        $reward_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "reward_log where id=" . $user_id ." and c_time<".$current_time);
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
            $grade = 1;
        }
        else if($total_consume < $consume_3)
        {
            $grade = 2;
        }
        else
        {
            $grade = 3;
        }
        $current_reward_max = $total_consume * $grade;

        if($current_reward > $current_reward_max)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public  function test_max()
    {
        $user_id = 95;
        if($this->reach_max_reward($user_id))
        {
            echo "reach";
        }
        else
        {
            echo "not reach";
        }
    }

    public function  test_sms()
    {
        $mobile = "13544172374";
        $code = "123456";
        if(jh_send_verify_sms($mobile,$code))
        {
            echo "send success";
        }
        else
        {
            echo "send error";
        }
    }
}