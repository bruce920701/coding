<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19 0019
 * Time: 14:16
 */

class uc_static_reward
{
    public function index()
    {
        global_run();
        init_app_page();
        $GLOBALS['tmpl']->assign("no_nav", true); //无分类下拉

        if (check_save_login() != LOGIN_STATUS_LOGINED) {
            app_redirect(url("index", "user#login"));
        }

        $GLOBALS['tmpl']->assign("page_title", "我的奖励");
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];

        $user_detail = $GLOBALS['db']->get_raws("select * from " . DB_PREFIX . "user where id=" . $user_id);

        //检测当前时间内有多少冻结中的记录，添加相应的冻结受益积分
        $static_reward_detail = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."reward_log where id=$user_id type=static" );
        $static_reward_list = array();
        $current_time = time();
        $has_unexpired_reward = false;
        $frozen_benefit_credits = 0;
        foreach($static_reward_detail as $key => $item)
        {
            //超过时间点，说明上次受益已完成，更新受益值为0；将对应的奖金发放到相应的账户，未到时间点的不展示
            if($item['time']< $current_time)
            {
                $static_reward_list[] = $item;
                if($item['status'] == 0)
                {
                    $frozen_benefit_credits += $item['credits'];
                }
            }
            else
            {
                $has_unexpired_reward = true;
            }
        }

        //获取当前利率,如果有未到期中的记录，则从用户表中获取
        //如果没有未到期中的记录，则从 global_config 中更新最新的static_reward_rate 到用户表中，将所有标记为冻结状态的记录标
        if($has_unexpired_reward)
        {
            $static_reward_rate = $user_detail['static_reward_rate'];
        }
        else {
            $global_config = $GLOBALS['db']->get_raw("select * from" . DB_PREFIX . "user_global_config where config=global");
            $static_reward_rate = $global_config['static_reward_rate'];
            $GLOBALS['db']->query("update " . DB_PREFIX . "user  set ststic_rewarad_rate $$static_reward_rate  where id=$user_id");
            foreach ($static_reward_detail as $key => $value)
            {
                if($value['staus'] == 0)
                {
                    $GLOBALS['db']->query("update " . DB_PREFIX . "reward_log  set status=1  where id=$user_id time=".$value['time']);
                }
            }
        }
        //获取消费记录和消费总额

        $consume_total = $user_detail['consume_total'];
        $static_reward_money = $consume_total * $static_reward_rate;

        //分页
        require_once(APP_ROOT_PATH."app/Lib/page.php");
        $page_size = 10;
        $page = intval($_REQUEST['p']);
        if($page==0)
            $page = 1;
        $limit = (($page-1)*$page_size).",".$page_size;

        require_once(APP_ROOT_PATH.'system/model/user_center.php');
        $consume_detail = get_user_log($limit,$user_id,'consumw');

        //reward_list
        $static_reward_detail = get_user_log($limit,$user_id,'$static_reward_detail');

        $avalible_benefit_credits = $user_detail['avalible_benefit_credits'];
        $GLOBALS['tmpl']->assign("consume_total",$consume_total);        //当前消费总额
        //$GLOBALS['tmpl']->assign("consume_detail",$consume_detail);
        $GLOBALS['tmpl']->asssign("reward_list",$static_reward_detail);  //受益记录
        $GLOBALS['tmpl']->assign("current_rate",$static_reward_rate);    //当前利率
        $GLOBALS['tmpl']->assign("avalible_benefit_credits",$avalible_benefit_credits);
        $GLOBALS['tmpl']-> assign("frozen_benefit_credits",$frozen_benefit_credits);
        echo "hi";
    }


    public  function get_reward()
    {
        //
        global_run();
        require_once(APP_ROOT_PATH."system/model/user.php");
        $user_data = $_POST;
        foreach($user_data as $k=>$v)
        {
            $user_data[$k] = strim($v);
        }
        $post_static_reward_rate = $user_data['static_reward_rate'];
        $id = $user_data['id'];
        $consume_total = $user_data['consume_total'];

        $user_detail = $GLOBALS['db']->get_raws("select * from " . DB_PREFIX . "user where id=" . $id);
        //从全局配置中拿结算利率，然后写入用户表的   ststic_rewarad_rate
        $global_config = $GLOBALS['db']->get_raw("select * from".DB_PREFIX."user_global_config where config=global");
        $static_reward_rate= $global_config['static_reward_rate'];
        if($post_static_reward_rate != $static_reward_rate)
        {
            //参数时间过期或已经被修改，请刷新再试

        }

        //1.生成静态分红数据
        $static_reward_money = $consume_total * $static_reward_rate;

        //更新7条冻结中的受益记录到日志表中，按发放时间记录，添加解冻日期，标记为冻结，每次进入页面的时候检测当前时间内有多少冻结中的记录可解冻，添加相应的冻结受益积分
        //到了解冻时间则把冻结的受益积分转换为可用的受用积分,并将日志中的冻结状态标记为释放状态。
        $unfrezen_time = $this->getNextMondaytime($this->getNextMondaytime(time()));  //奖金结算的日期
        for($i=1;$i<8;$i++)
        {
            $static_reward_end_time = strtotime(date("Y-m-d",strtotime("+$i day")));    //生效时间点，展示为冻结状态的起始时间
            $type = "static";
            $status = false;
            $msg = "您申请获得静态分红".$static_reward_money;
            $GLOBALS['db']->query("insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$id.",".$type.",".$static_reward_end_time.",".$static_reward_money.",".$unfrezen_time.",".$status.",".$msg.")");
        }


        //2.生成上级领导奖数据，上级领导奖获得比率和之和当前申请时间上级的等级有关，锁定期为1周，即上级一周内升级了，但还是按当前级数计算领导奖。
        //获取当前用户的所有上级
        $upon_user = $this->get_upon_rainbow_user($id);
        $unfrezen_time = $this->getNextMondaytime(time());  //为奖金结算的日期
        foreach($upon_user as $item) {
            for ($i = i; $i < 8; $i++) {
                $upon_user_id = $item['id'];
                $type = "leader";
                $status = fasle;
                $leader_reward_end_time = strtotime(date("Y-m-d",strtotime("+$i day")));    //生效时间点
                $upon_user_level = $item['user_level'];
                $upon_user_fx_rate = $global_config["fx_" . $upon_user_level . "rate"];
                $upon_user_leader_reward_money = $static_reward_money * $upon_user_fx_rate;
                $msg = $user_detail["name"] . "申请获得" . $static_reward_money . "静态分红，您获得" . $upon_user_leader_reward_money . "领导奖";
                $GLOBALS['db']->query("insert into " . DB_PREFIX . "reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(" . $upon_user_id . "," . $type . "," . $leader_reward_end_time . "," . $static_reward_money . "," . $unfrezen_time . "," . $status . "," . $msg . ")");
            }
        }
    }

    //通过当前时间戳获取下周一0:00时间戳  当前时间为utc时间
    private function getNextMondaytime($time){
        $w = date('w', $time);
        if($w == 0)
        {
            $nextMonday = 1;
        }
        else {
            $nextMonday = 7 - $w + 1;
        }
        $date_time = date("Y-m-d")."00:00:00";
        $time_0 = strtotime($date_time);
        $next_Monday_0 = $time_0 + 3600*24*$nextMonday;
        return $next_Monday_0;
    }

    private  function get_upon_rainbow_user($id)
    {
        $upon_user = array();
        $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX ."user where id=".$id);
        $s_id = $user_detail['s_id'];
        if($s_id != NULL) {
            $upon_user[] = $user_detail;
        }
        while($s_id != NULL) {
            $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $s_id);
            $s_id = $user_detail['s_id'];
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
}