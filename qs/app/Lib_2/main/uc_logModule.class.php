<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


require_once(APP_ROOT_PATH.'system/model/user.php');
class uc_logModule extends MainBaseModule
{
    private $unbrella_users_detail = array();
    private $all_unbrella_user = array();
    private $creditsettings;
    private $allow_exchange = false;
    private  $credits_CFG = array(
        '1' => array('title'=>'经验', 'unit'=>'' ,'field'=>'point'),
        '2' => array('title'=>'积分', 'unit'=>'' ,'field'=>'score'),
        '3' => array('title'=>'资金', 'unit'=>'' ,'field'=>'money'),
    );
    public function __construct(){
        
        if(file_exists(APP_ROOT_PATH."public/uc_config.php"))
        {
            require_once(APP_ROOT_PATH."public/uc_config.php");
        }
        if(app_conf("INTEGRATE_CODE")=='Ucenter'&&UC_CONNECT=='mysql')
        {
            if(file_exists(APP_ROOT_PATH."public/uc_data/creditsettings.php"))
            {
                require_once(APP_ROOT_PATH."public/uc_data/creditsettings.php");
                $this->creditsettings = $_CACHE['creditsettings'];
                if(count($this->creditsettings)>0)
                {
                    foreach($this->creditsettings as $k=>$v)
                    {
                        $this->creditsettings[$k]['srctitle'] = $this->credits_CFG[$v['creditsrc']]['title'];
                    }
                    $this->allow_exchange = true;
                    
                }
            }
        }
        $GLOBALS['tmpl']->assign("allow_exchange",$this->allow_exchange);
        parent::__construct();
        global_run();
        if(check_save_login()!=LOGIN_STATUS_LOGINED)
        {
            app_redirect(url("index","user#login"));
        }
        init_app_page();
    }

	public function index()
	{
		 app_redirect(url("index","uc_log#money"));
	}

    
    /**
     * 资金日志
     */
	public function money()
	{
	    $user_info = $GLOBALS['user_info'];
	    //业务逻辑部分
	    //分页
	    require_once(APP_ROOT_PATH."app/Lib/page.php");
		$page_size = 10;
		$page = intval($_REQUEST['p']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*$page_size).",".$page_size;
		
		require_once(APP_ROOT_PATH.'system/model/user_center.php');
		$data = get_user_log($limit,$user_info['id'],'money'); //获取资金数据
		
		//分页输出
		$page = new Page($data['count'],$page_size);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);
		
	    //数据
		$GLOBALS['tmpl']->assign("user_info",$user_info);
		$GLOBALS['tmpl']->assign('data',$data);
	    
	    //通用模版参数定义
		assign_uc_nav_list();//左侧导航菜单
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户资金日志"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html"); //title
        //echo json_encode($GLOBALS['tmpl']);
        //echo json_encode($data.list);
	}
	/**
	 * 积分日志
	 */
	public function score(){
	    $user_info = $GLOBALS['user_info'];
	     
	    //业务逻辑部分
	    //取出积分信息
	    $uc_query_data['cur_score'] = $user_info['score'];
        $cur_group = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_group where id=".$user_info['group_id']);
        $uc_query_data['cur_gourp'] = $cur_group['id'];
        $uc_query_data['cur_gourp_name'] = $cur_group['name'];
        $uc_query_data['cur_discount'] = floatval(sprintf('%.2f', $cur_group['discount']*10));
	     
	    //分页
	    require_once(APP_ROOT_PATH."app/Lib/page.php");
	    $page_size = 10;
	    $page = intval($_REQUEST['p']);
	    if($page==0)
	        $page = 1;
	    $limit = (($page-1)*$page_size).",".$page_size;
	    
	    require_once(APP_ROOT_PATH.'system/model/user_center.php');
	    $data = get_user_log($limit,$user_info['id'],'score'); //获取积分数据
	    
	    //分页输出
	    $page = new Page($data['count'],$page_size);   //初始化分页对象
	    $p  =  $page->show();
	    $GLOBALS['tmpl']->assign('pages',$p);
	    
	    //数据
	    $GLOBALS['tmpl']->assign("user_info",$user_info);
	    $GLOBALS['tmpl']->assign("uc_query_data",$uc_query_data);
	    $GLOBALS['tmpl']->assign('data',$data);
	     
	    //通用模版参数定义
	    assign_uc_nav_list();//左侧导航菜单
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户积分日志"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html");
	    
	}
	/**
	 * 经验日志
	 */
	public function point(){
	    $user_info = $GLOBALS['user_info'];
	    
	    //业务逻辑部分
	    //取出等级信息
	    $level_data = load_auto_cache("cache_user_level");
	    $cur_level = $level_data[$user_info['level_id']];
	     
	    //游标移动获取下一个等级
	    reset($level_data);
	    do{
	        $current_data = current($level_data);
	    
	        if($current_data['id']==$cur_level['id'])
	        {
	             
	            $next_data = next($level_data);
	            break;
	        }
	    }while(next($level_data));
	    $uc_query_data = array();
	    $uc_query_data['cur_level'] = $cur_level['level']; //当前等级
	    $uc_query_data['cur_point'] = $user_info['point'];
	    $uc_query_data['cur_level_name'] = $cur_level['name'];
	    if($next_data){
	        $uc_query_data['next_level'] = $next_data['id'];
	        $uc_query_data['next_point'] =$next_data['point'] - $user_info['point']; //我再增加：100 经验值，就可以升级为：青铜五
	        $uc_query_data['next_level_name'] = $next_data['name'];
	    }

	    
	    //分页
	    require_once(APP_ROOT_PATH."app/Lib/page.php");
		$page_size = 10;
		$page = intval($_REQUEST['p']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*$page_size).",".$page_size;
		
		require_once(APP_ROOT_PATH.'system/model/user_center.php');
		$data = get_user_log($limit,$user_info['id'],'point');    //获取经验数据

		//分页输出
		$page = new Page($data['count'],$page_size);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);
		
	    //数据
		$GLOBALS['tmpl']->assign("user_info",$user_info);
		$GLOBALS['tmpl']->assign("uc_query_data",$uc_query_data);
		$GLOBALS['tmpl']->assign('data',$data);
	    
	    //通用模版参数定义
		assign_uc_nav_list();//左侧导航菜单
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户成长日志"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html"); 
	}
    
	/**
	 * 兑换
	 */
	public function exchange(){
	    $user_info = $GLOBALS['user_info'];
	     
	    //业务逻辑部分
	    //分页
	    require_once(APP_ROOT_PATH."app/Lib/page.php");
	    $page_size = 10;
	    $page = intval($_REQUEST['p']);
	    if($page==0)
	        $page = 1;
	    $limit = (($page-1)*$page_size).",".$page_size;
	    
	    require_once(APP_ROOT_PATH.'system/model/user_center.php');

	    
	    //数据
	    $GLOBALS['tmpl']->assign("user_info",$user_info);
	    $GLOBALS['tmpl']->assign("exchange_data",$this->creditsettings);
		$GLOBALS['tmpl']->assign("exchange_json_data",json_encode($this->creditsettings));
	     
	    //通用模版参数定义
	    assign_uc_nav_list();//左侧导航菜单
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户uc兑换"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html"); //title
	}
	
	
	
	
	/**
	 * 报单奖励    静态分红
	 */
	public function bdjl(){
	    $user_info = $GLOBALS['user_info'];
	    //通用模版参数定义


        //获取静态分红
        $user_id = $user_info['id'];

         //test_time   为测试时设定的日期的时间戳，如果没有设置则获取当前时间戳
        $current_time = isset($_GET['test_time']) ? $_GET['test_time'] : time();

        $static_reward_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "reward_log where id=" . $user_id ." and c_time<".$current_time .' and type="static" order by c_time DESC');


        //判断受益有没有到结算时间，如果到了结算时间，则更新进相应的可用积分里面去，并将其状态改为1（可用，0为冻结），冻结的积分在用户表中没有实际字段记录，是根据受益日志动态计算出来的
        $type='"static"';
        foreach($static_reward_list as $item)
        {
            if(!$item['status'])
            {
                if($item['unfrezen_time'] < $current_time)    //到了解冻日期
                {
                    $GLOBALS['db']->query("update ".DB_PREFIX."reward_log set status=1 where id=".$item['id']."  and c_time=".$item['c_time'] ." and type=$type");
                    $GLOBALS['db']->query("update ".DB_PREFIX."user set avalible_benefit_credits=avalible_benefit_credits+".$item['credits']*0.9.",  avalible_consume_credits=avalible_consume_credits+".$item['credits']*0.1." where id=".$item['id']);
                }
            }
        }

        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "global_config  where config=$config");
        $static_rate =  isset($global_config['static_reward_rate'])&&$global_config['static_reward_rate']!=0 ? $global_config['static_reward_rate']*100 : 0;
        $static_rate_str = $static_rate."%";

        $static_reward_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "reward_log where id=" . $user_id ." and c_time<".$current_time .' and type="static" order by c_time DESC');

        $future_reward_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "reward_log where id=" . $user_id ." and c_time>".$current_time .' and type="static" order by c_time DESC');

        $total_frozen_static_reward = 0;
        foreach($static_reward_list as $item)
        {
            if(!$item['status'])
                $total_frozen_static_reward += $item['credits'];
        }
        $frozen_benefit_credits = $total_frozen_static_reward * 0.9;
        $frozen_consume_credits = $total_frozen_static_reward * 0.1;

        $can_get_static_reward = true;
        if(count($static_reward_list)%7 !=0 || count($future_reward_list) >0 )
        {
            $can_get_static_reward = false;
        }

        //消费记录
        $user_deal_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "deal_order where user_id=" . $user_id);
        $total_consume = 0;
        foreach($user_deal_list as $item)
        {
            $total_consume += $item['pay_amount'];
        }

        //静态奖受益记录分页展示
        require_once(APP_ROOT_PATH."app/Lib/page.php");
        $page_size = 10;
        $page = intval($_REQUEST['p']);
        if($page==0)
            $page = 1;
        $limit = (($page-1)*$page_size).",".$page_size;

        require_once(APP_ROOT_PATH.'system/model/user_center.php');
        if(count($static_reward_list) > $page_size)
            $count_num = $page_size;
        else
            $count_num = count($static_reward_list);
        if($count_num>0) {
            $data = array("list" => array_slice($static_reward_list, 0, $count_num), "count" => $count_num);
        }
        else
        {
            $data = array("list"=> array(),'count' => 0);
        }
        assign_uc_nav_list();//左侧导航菜单
        //分页输出
        $page = new Page($data['count'],$page_size);   //初始化分页对象
        $p  =  $page->show();
        if($can_get_static_reward)
        {
        	$can_get_static_reward = 1;
        }
        else
        {
        	$can_get_static_reward = 0;
        }
        $GLOBALS['tmpl']->assign('pages',$p);
        $GLOBALS['tmpl']->assign("user_info",$user_info);
        $GLOBALS['tmpl']->assign('data',$data);
        $GLOBALS['tmpl']->assign('frozen_benefit_credits',$frozen_benefit_credits);
        $GLOBALS['tmpl']->assign('frozen_consume_credits',$frozen_consume_credits);
        $GLOBALS['tmpl']->assign("can_get_static_reward",$can_get_static_reward);
        $GLOBALS['tmpl']->assign("total_consume",$total_consume);
        $GLOBALS['tmpl']->assign("static_rate_str",$static_rate_str);
        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
        $GLOBALS['tmpl']->assign("page_title","静态分红"); //title
        $GLOBALS['tmpl']->display("uc/uc_log.html");
        //echo json_encode($data);
    }

    public  function get_static_reward()
    {
        //
        global_run();
        require_once(APP_ROOT_PATH."system/model/user.php");
        $user_data = $_POST;
        $user_info = $GLOBALS['user_info'];
        foreach($user_data as $k=>$v)
        {
            $user_data[$k] = strim($v);
        }
        $post_static_reward_rate = $user_data['static_reward_rate'];
        $id = $user_info['id'];
        //$total_consume = $user_data['consume_total'];

        //消费记录
        $user_deal_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "deal_order where user_id=" . $id);
        $total_consume = 0;
        foreach($user_deal_list as $item)
        {
            $total_consume += $item['pay_amount'];
        }

        $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $id);
        //从全局配置中拿结算利率，然后写入用户表的   ststic_rewarad_rate
        $config = '"default"';
        $global_config = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "global_config  where config=$config");
        $static_reward_rate= $global_config['static_reward_rate'];
        if($post_static_reward_rate != $static_reward_rate)
        {
            //参数时间过期或已经被修改，请刷新再试

        }
        //1.生成静态分红数据
        $static_reward_money = $total_consume * $static_reward_rate;

        //更新7条冻结中的受益记录到日志表中，按发放时间记录，添加解冻日期，标记为冻结，每次进入页面的时候检测当前时间内有多少冻结中的记录可解冻，添加相应的冻结受益积分
        //到了解冻时间则把冻结的受益积分转换为可用的受用积分,并将日志中的冻结状态标记为释放状态。
        $unfrezen_time = $this->getNextMondaytime($this->getNextMondaytime(time()));  //奖金结算的日期
        for($i=1;$i<8;$i++)
        {
            $static_reward_end_time = strtotime(date("Y-m-d",strtotime("+$i day")));    //生效时间点，展示为冻结状态的起始时间
            $type = '"static"';
            $status = 0;
            $msg = '"您申请获得静态分红'.$static_reward_money.'"';
            $sql = "insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$id.",".$type.",".$static_reward_end_time.",".$static_reward_money.",".$unfrezen_time.",".$status.",".$msg.")";
            //$GLOBALS['db']->query("insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$id.",".$type.",".$static_reward_end_time.",".$static_reward_money.",".$unfrezen_time.",".$status.",".$msg.")");
            $GLOBALS['db']->query($sql);

        }

        //2.生成上级领导奖数据，上级领导奖获得比率和之和当前申请时间上级的等级有关，锁定期为1周，即上级一周内升级了，但还是按当前级数计算领导奖。
        //获取当前用户的所有上级
        $upon_user = $this->get_upon_rainbow_user($id);
        $unfrezen_time = $this->getNextMondaytime(time());  //为奖金结算的日期
        foreach($upon_user as $item) {
            $item_detail =  $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $item);
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
                $GLOBALS['db']->query($sql);

            }
        }
        $result = array("status" => true,"info" => "success!");
        ajax_return($result);
    }

    public function get_static_test()
    {
        $user_detail = $GLOBALS['user_info'];
        $id = $user_detail['id'];
        $static_reward_money = 64;
        $unfrezen_time = $this->getNextMondaytime($this->getNextMondaytime(time()))-25*24*3600;  //奖金结算的日期
        for($i=1;$i<8;$i++)
        {
            $static_reward_end_time =  $unfrezen_time-$i*24*3600;//生效时间点，展示为冻结状态的起始时间
            $type = '"static"';
            $status = 0;
            $msg = '"您申请获得静态分红'.$static_reward_money.'"';
            $sql = "insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$id.",".$type.",".$static_reward_end_time.",".$static_reward_money.",".$unfrezen_time.",".$status.",".$msg.")";
            echo $sql."\n";
            //$GLOBALS['db']->query("insert into ".DB_PREFIX."reward_log(id,type,c_time,credits,unfrezen_time,status,msg) values(".$id.",".$type.",".$static_reward_end_time.",".$static_reward_money.",".$unfrezen_time.",".$status.",".'{$msg}'.")");
            $GLOBALS['db']->query($sql);
            var_dump($GLOBALS['db']->error());
            //$GLOBALS['db']->query("insert into ".DB_PREFIX."reward_log(".$id.",".$type.",".$static_reward_end_time.",".$static_reward_money.",".$unfrezen_time.",".$status.",".$msg."));
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

    //通过当前时间戳获取上周一0:00时间戳  当前时间为utc时间
    private function getLastMondaytime($time)
    {
        $w = date('w', $time);
        if ($w == 0) {
            $nextMonday = 1-7;
        } else {
            $nextMonday = -7 - $w + 1;
        }
        $date_time = date("Y-m-d") . "00:00:00";
        $time_0 = strtotime($date_time);
        $next_Monday_0 = $time_0 + 3600 * 24 * $nextMonday;
        return $next_Monday_0;
    }



    //获取某个用户的所有上级用户
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



	/**
	 * 奖金明细     领导奖和直推奖
	 */
	public function jiangjin(){
	    $user_info = $GLOBALS['user_info'];
	    $user_id = $user_info['id'];

	    //1.获取所有直推奖记录   直推奖到期时间为每个周一，之前的为冻结状态（分为冻结的分享积分（90%）和冻结的消费积分（10%））
        //test_time   为测试时设定的日期的时间戳，如果没有设置则获取当前时间戳
        $current_time = isset($_GET['test_time']) ? $_GET['test_time'] : time();
        $type = '"direct"';
        $direct_reward_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "reward_log where id=" . $user_id ." and c_time<".$current_time ." and type=$type order by c_time DESC");
        $total_direct_reward = 0;    //总共获得多少直推奖,包括冻结状态的。
        foreach($direct_reward_list as $item)
        {
            $total_direct_reward += $item['credits'];
        }
        //判断受益有没有到结算时间，如果到了结算时间，则更新进相应的可用积分里面去，并将其状态改为1（可用，0为冻结），冻结的积分在用户表中没有实际字段记录，是更具受益日志动态计算出来的
        foreach($direct_reward_list as $item)
        {
            if($item['status'] == 0)
            {
                if($item['unfrezen_time'] < $current_time)    //到了解冻日期
                {
                    $GLOBALS['db']->query("update ".DB_PREFIX."reward_log set status=1 where id=".$item['id']."  and c_time=".$item['c_time'] ." and type=".$type);
                    $GLOBALS['db']->query("update ".DB_PREFIX.".user set avalible_share_credits=avalible_share_credits+".$item['credits']*0.9."  avalible_consume_credits=avalible_consume_credits+".$item['credits']*0.1." where id=".$item['id']);
                }
            }
        }
        //2/获取所有的领导奖
        $type ='"leader"';
        $leader_reward_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "reward_log where id=" . $user_id ." and c_time<".$current_time ." and type=$type order by c_time DESC");
        $total_leader_reward = 0;
        foreach($leader_reward_list as $item)
        {
            $total_leader_reward += $item['credits'];
        }
        //判断受益有没有到结算时间，如果到了结算时间，则更新进相应的可用积分里面去，并将其状态改为1（可用，0为冻结），冻结的积分在用户表中没有实际字段记录，是更具受益日志动态计算出来的
        foreach($leader_reward_list as $item)
        {
            if($item['status'] == 0)
            {
                if($item['unfrezen_time'] < $current_time)    //到了解冻日期
                {
                    $GLOBALS['db']->query("update ".DB_PREFIX."reward_log set status=1 where id=".$item['id']."  and c_time=".$item['c_time'] ." and type=".$type);
                    $GLOBALS['db']->query("update ".DB_PREFIX.".user set avalible_share_credits=avalible_share_credits+".$item['credits']*0.9."  avalible_consume_credits=avalible_consume_credits+".$item['credits']*0.1." where id=".$item['id']);
                }
            }
        }

        //3.分页展示获奖记录
        //静态奖受益记录分页展示
        require_once(APP_ROOT_PATH."app/Lib/page.php");
        $page_size = 10;
        $page = intval($_REQUEST['p']);
        if($page==0)
            $page = 1;
        $limit = (($page-1)*$page_size).",".$page_size;

        require_once(APP_ROOT_PATH.'system/model/user_center.php');
        if(count($direct_reward_list) > $limit)
            $direct_count_num = $limit;
        else
            $direct_count_num = count($direct_reward_list);
        if($direct_count_num>0) {
            $direct_data = array("list" => array_slice($direct_reward_list, 0, $direct_count_num), "count" => $direct_count_num);
        }
        else
        {
            $direct_data = array("list"=> array(),'count' => 0);
        }

        if(count($leader_reward_list) > $limit)
            $leader_count_num = $limit;
        else
            $leader_count_num = count($leader_reward_list);
        if($leader_count_num>0) {
            $leader_data = array("list" => array_slice($leader_reward_list, 0, $leader_count_num), "count" => $leader_count_num);
        }
        else
        {
            $leader_data = array("list"=> array(),'count' => 0);
        }
        assign_uc_nav_list();//左侧导航菜单
        //分页输出
        $direct_page = new Page($direct_data['count'],$page_size);   //初始化分页对象
        $direct_p  =  $direct_page->show();
        $GLOBALS['tmpl']->assign('direct_pages',$direct_p);

        $leader_page = new Page($leader_data['count'],$page_size);   //初始化分页对象
        $leader_p  =  $leader_page->show();
        $GLOBALS['tmpl']->assign('leader_pages',$leader_p);

        $GLOBALS['tmpl']->assign("total_direct_reward",$total_direct_reward);
        $GLOBALS['tmpl']->assign("direct_reward_list",$direct_reward_list);
        $GLOBALS['tmpl']->assign("total_leader_reward",$total_leader_reward);
        $GLOBALS['tmpl']->assign("leader_reward_detail",$leader_reward_list);

        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
        $GLOBALS['tmpl']->assign("page_title","用户奖金"); //title
        $GLOBALS['tmpl']->display("uc/uc_log.html");
        echo json_encode($GLOBALS['tmpl']);
    }
	/**
	 * 互转积分
	 */
	public function hzjf(){
	    $user_info = $GLOBALS['user_info'];
	    //通用模版参数定义
	    assign_uc_nav_list();//左侧导航菜单
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户积分日志"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html");
	}

	//转注册积分
	public function do_translate_credits()
    {
        $post_data = $_POST;
        foreach($post_data as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];
        $t_credits = $post_data['t_active_code'];
        $trade_pwd = $post_data['trade_pwd'];
        $t_id = $post_data['to_id'];
        //var_dump($post_data);

        //1 . chack for trade
        if($user_info['user_pwd'] != md5($trade_pwd))
        {
            $return = array("status" => false,"info" => "交易密码错误！",);
            ajax_return($return);
        }
        if($user_info['register_credits'] < $t_credits)
        {
            $return = array("status" => false,"info" => "注册积分不足！",);
            ajax_return($return);
        }
        $is_can_trade_user =  false;   //是否为直系链上的成员，旁部门是禁止转
        if($this->is_under_rainbow_user($user_id,$t_id) || $this->is_upon_rainbow_user($user_id,$t_id))
        {
            $is_can_trade_user = true;
        }
        if(!$is_can_trade_user)
        {
            $return = array("status" => false,"info" => "不能转给旁系用户！",);
            ajax_return($return);
        }

        //参数检查和规则检查，将积分更新到对应的账户
        //$register_credits = $user_info['register_credits'];

        $GLOBALS['db']->query("update ".DB_PREFIX."user set register_credits=register_credits-".$t_credits." where id=".$user_id);

        //$t_user_info = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $t_id);
        $sql = "update ".DB_PREFIX."user set register_credits=register_credits+".$t_credits." where id=".$t_id;
        $GLOBALS['db']->query($sql);
        //echo $sql;
        //var_dump($GLOBALS['db']->error());
        //转账成功，返回当前最新的注册积分
        $return = array("status" => true,"info" => "转账成功！");
        ajax_return($return);
    }

    private function is_under_rainbow_user($id,$t_id) //判断t_id 是否是id的伞下用户
    {
        $market_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX ."market_user where id=".$id);
        $market_users = array();
        foreach($market_list as $key => $value)
        {
            $market_users[] = $value['m_id'];
        }

        if(in_array($t_id,$market_users))
        {
            return true;
        }
        else
        {
            foreach($market_users as $item)
            {
                $this->is_under_rainbow_user($item,$t_id);
            }
            return false;
        }
    }

    private  function is_upon_rainbow_user($id,$t_id)
    {
        $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX ."user where id=".$id);
        $s_id = $user_detail['s_id'];
        while($s_id != NULL && $s_id!=$t_id)
        {
            $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX ."user where id=".$s_id);
            $s_id = $user_detail['s_id'];
            if($user_detail['s_id'] == $t_id)
            {
                return true;
            }
        }
        return false;
    }

    private function get_unbrella_users($uid)    //获取所有伞下用户的
    {
        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "direct_list where uid=" . $uid);
        foreach ($m_id_list as $key=>$value)
        {
            $this->all_unbrella_user[] = $value['m_id'];
            $this->get_unbrella_users($value['m_id']);
        }
    }


    private  $last_7_consume = 0;
	private  $total_comsume = 0;
    private function get_unbrella_users_detail($uid)    //获取所有伞下用户消费详细信息
    {
        $user_deal_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "deal_order where user_id=" . $uid);
        $current_time = time();
        $last_week_new_add_conusme = 0;
        $total_consume = 0;
        foreach($user_deal_list as $item)
        {
            if($item['create_time'] > $this->getLastMondaytime($current_time)  && $item['create_time'] < $this->getLastMondaytime($current_time)+7*24*3600 )
                $last_week_new_add_conusme += $item['pay_amount'];
            $total_consume += $item['pay_amount'];
        }
        $this->last_7_consume  += $last_week_new_add_conusme;
        $this->total_comsume += $total_consume;

        $m_id_list = $GLOBALS['db']->getAll("select * from " . DB_PREFIX . "market_user where id=" . $uid);
        foreach ($m_id_list as $key=>$value)
        {
            $this->get_unbrella_users_detail($value['m_id']);
        }
    }

	/**
	 * 互转激活码
	 */
	public function hzjhm(){
	    $user_info = $GLOBALS['user_info'];
	    //通用模版参数定义
	    assign_uc_nav_list();//左侧导航菜单
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户积分日志"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html");
	}

    public function do_translate_active_code()
    {
        $post_data = $_POST;
        foreach($post_data as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];
        $t_active_code = $post_data['t_credits'];
        $trade_pwd = $post_data['trade_pwd'];
        $t_id = $post_data['t_id'];

        //echo json_encode($post_data);

        //1 . chack for trade
        if($user_info['user_pwd'] != md5($trade_pwd))
        {
            $return = array("status" => false,"info" => "交易密码错误！",);
            ajax_return($return);
        }
        if($user_info['active_code'] < $t_active_code)
        {
            $return = array("status" => false,"info" => "激活码数目不足！",);
            ajax_return($return);
        }
        $is_can_trade_user =  false;   //是否为直系链上的成员，旁部门是禁止转
        if($this->is_under_rainbow_user($user_id,$t_id) || $this->is_upon_rainbow_user($user_id,$t_id))
        {
            $is_can_trade_user = true;
        }
        if(!$is_can_trade_user)
        {
            $return = array("status" => false,"info" => "不能转给旁系用户！",);
            ajax_return($return);
        }

        //参数检查和规则检查，将积分更新到对应的账户
        $active_code = $user_info['active_code'];
        $new_active_code = $active_code - $t_active_code;
        $GLOBALS['db']->query("update ".DB_PREFIX."user set active_code=active_code-".$t_active_code." where id=".$user_id);

        $t_user_info = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "user where id=" . $t_id);
        //$t_user_new_active_code = $t_user_info['active_code'] + $t_active_code;
        $GLOBALS['db']->query("update ".DB_PREFIX."user set active_code=active_code+".$t_active_code." where id=".$t_id);


        //转账成功，返回当前最新的注册积分
        $return = array("status" => true,"info" => "转账成功！","data" => array("current_active_code" => $new_active_code));
        ajax_return($return);


    }


	/**
	 * 业绩明细
	 */
	public function yjmx(){
	    $user_info = $GLOBALS['user_info'];
	    $user_id = $user_info['id'];
	    $user_market_list = $GLOBALS['db']->getALL("SELECT * from ".DB_PREFIX."market_user where id=".$user_id);
	    $this->get_unbrella_users_detail($user_id);

	    $detail = array("0" => array("id" => $user_info['id'],"name"=> $user_info["user_name"],"total_consume" => $this->total_comsume,"last_7_consume"=>$this->last_7_consume));
	    $market_detail = array();
	    foreach($user_market_list as $item)
        {
            $market_user_detail = $GLOBALS['db']->getRow("SELECT * from ".DB_PREFIX."user where id=".$item['m_id']);
            $this->last_7_consume = 0;
            $this->total_comsume = 0;
            $this->get_unbrella_users_detail($item['m_id']);
            $market_detail[] = array("id" => $market_user_detail['id'],"name"=>$market_user_detail["user_name"],"total_consume" => $this->total_comsume,"last_7_consume"=>$this->last_7_consume);
        }
        $detail["1"] = $market_detail;

	    //通用模版参数定义
	    assign_uc_nav_list();//左侧导航菜单
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户积分日志"); //title
        $GLOBALS['tmpl']->assign("detail_data" , $detail);
	    $GLOBALS['tmpl']->display("uc/uc_log.html");
        echo json_encode($GLOBALS['tmpl']);
        //echo json_encode($GLOBALS['tmpl']);

	    
	}
    //获取某个用户名下所有市场详情
    public  function  get_node_detail()
    {
        //参数没设置id的话默认获取当前登录用户的id，如果没有检测到当前登陆的用户id，则返回空
        $market_detail = array();
        $id = isset($_GET['id']) ? $_GET['id'] : $GLOBALS['user_info']['id'];
        $status = false;
        $count = 0;
        if($id)
        {
            $user_detail = $GLOBALS['db']->getRow("select * from " . DB_PREFIX ."user where id=".$id);
            $user_market_list = $GLOBALS['db']->getALL("SELECT * from ".DB_PREFIX."market_user where id=".$user_detail['id']);
            foreach($user_market_list as $item)
            {
                $this->total_comsume = 0;
                $this->last_7_consume = 0;
                $market_user_detail = $GLOBALS['db']->getRow("SELECT * from ".DB_PREFIX."user where id=".$item['m_id']);
                $this->get_unbrella_users_detail($item['m_id']);
                $market_detail[] = array("id" => $market_user_detail['id'],"name"=>$market_user_detail["user_name"],"total_consume" => $this->total_comsume,"last_7_consume"=>$this->last_7_consume);
            }
            $status = true;
            $count = count($market_detail);
        }
        $result = array('status' => $status,'count' => $count,'market_detail' => $market_detail);
        ajax_return($result);
    }

	/**
	 * 申请报单中心
	 */
	public function bdzx(){
	    $user_info = $GLOBALS['user_info'];
	    $user_id = $user_info['id'];
	    $type = '"new_add"';
	    $sql = "SELECT * from ".DB_PREFIX."reward_log where id=".$user_id." and type=".$type;
	    $bdzx_reward = $GLOBALS['db']->getALL($sql);
	    $new_bdzx_reward = array();
	    foreach($bdzx_reward as $item)
        {
            $msg = $item['msg'];
            $msg_detail = explode(',',$msg);
            $consume_id = $msg_detail[0];
            $consume = $msg_detail[1];
            $new_bdzx_reward[] = array("m_id" => $consume_id,'credits' => $item['credits'],'consume' => $consume,'status' => $item['status']);
        }


        $bdzx_status = $user_info['bdzx_status'];
        $data = array("count" => count($bdzx_reward),'data' => $new_bdzx_reward);

	    //通用模版参数定义
	    assign_uc_nav_list();//左侧导航菜单

        $GLOBALS['tmpl']->assign("bdzx_status",$bdzx_status);
        $GLOBALS['tmpl']->assign("bdzx_reward_detail",$data);
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户积分日志"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html");
	    echo json_encode($GLOBALS['tmpl']);

	}


	public  function do_request_bdzx()
    {
        $post_data = $_POST;
        foreach($post_data as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }
        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];

        //
        if($user_info['user_name'] != $post_data['user_name'])
        {
            $status = false;
            $info = "用户名不匹配！";
            $result = array('status'=> $status,"info"=>$info);
            ajax_return($result);
        }

        $requet_bdzx_time = time();    //申请时间
        $bdzx_status = 1;              //报单中心状态，0为还未申请，1已申请待审核，2为审核通过
        //$agree_bdzx_time = 0;          //管理员同意的时间
        $user_id_card = '"'.$post_data['user_id_card'].'"';  //用户的身份证号码

        $sql = "update ".DB_PREFIX."user set requet_bdzx_time=".$requet_bdzx_time.", bdzx_status=".$bdzx_status.", user_id_card=".$user_id_card." where id=".$user_id;

        $GLOBALS['db']->query($sql);

        $result = array("status" => true,"info" => "申请成功，请等待管理员审核");
        ajax_return($result);
    }

	/**
	 * 兑换注册积分
	 */
	public function dhzcjf(){
	    $user_info = $GLOBALS['user_info'];
	    $user_id = $user_info['id'];
	    $type = '"new_add"';
	    $sql = "SELECT * from ".DB_PREFIX."reward_log where id=".$user_id." and type=".$type;
	    $bdzx_reward = $GLOBALS['db']->getALL($sql);
	    $new_bdzx_reward = array();
	    foreach($bdzx_reward as $item)
        {
            $msg = $item['msg'];
            $msg_detail = explode(',',$msg);
            $consume_id = $msg_detail[0];
            $consume = $msg_detail[1];
            $new_bdzx_reward[] = array("id" => $consume_id,'credits' => $item['credits'],'consume' => $consume,'status' => $item['status']);
        }


        $bdzx_status = $user_info['bdzx_status'];
        $data = array("count" => count($bdzx_reward),'data' => $new_bdzx_reward);

	    //通用模版参数定义
	    assign_uc_nav_list();//左侧导航菜单

        $GLOBALS['tmpl']->assign("bdzx_status",$bdzx_status);
        $GLOBALS['tmpl']->assign("bdzx_reward_detail",$data);
	    $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
	    $GLOBALS['tmpl']->assign("page_title","用户积分日志"); //title
	    $GLOBALS['tmpl']->display("uc/uc_log.html");
	    echo json_encode($GLOBALS['tmpl']);

	}
    //检查用户升级条件，看是否满足升级条件，如满足则升级

    private  function check_upgrade()
    {
        $user_info = $GLOBALS['user_info'];
        $config = '"default"';
        $sql = "select * from " . DB_PREFIX . "global_config where config=" . $config;
        $global_config = $GLOBALS['db']->getRow($sql);

        $user_level = $user_info['user_level'];

        $sql = "select * from " . DB_PREFIX . "direct_user where id=" . $user_info['id'];
        $direct_user_list = $GLOBALS['db']->getAll($sql);
        $direct_user_num = count($direct_user_list);

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


    public  function to_register_credits()
    {
        $user_info = $GLOBALS['user_info'];
        $post_data = $_POST;
        foreach($post_data as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }

        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];
        $post_num = $post_data['num'];
        $type = $_GET['type'];
        if($type == "share")
        {
            $update_item = "avalible_share_credits";
        }
        else if($type = "benefit")
        {
            $update_item = "avalible_benefit_credits";
        }
        else
        {
            $result = array('status' => 0,'info' =>"type error！");
            ajax_return($result);
        }

        if($post_num > $user_info[$update_item])
        {

            $result = array('status' => 0,'info' =>"积分不足！");
            ajax_return($result);
        }

        $sql = "update ".DB_PREFIX."user set register_credits=register_credits-".$post_num.",  ".$update_item."=".$update_item."-".$post_num." where id=".$user_id;
        $GLOBALS['db']->query($sql);
        $result = array('status' => 1,'info'=>"转出成功！");
        ajax_return($result);

    }

}

?>