<?php 
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

define("DEAL_OUT_OF_STOCK",4); //库存不足
define("DEAL_ERROR_MIN_USER_BUY",5); //用户最小购买数不足
define("DEAL_ERROR_MAX_USER_BUY",6); //用户最大购买数超出
define("EXIST_DEAL_COUPON_SN",1);  //消费券序列号已存在

define("DEAL_NOTICE",3); //未上线
define("DEAL_ONLINE",1); //进行中
define("DEAL_HISTORY",2); //过期
define("COUPON_HISTORY",7); //团购卷过期

define("DEAL_NOT_SUCCESS",0); //未成团
define("DEAL_SUCCESS",1); //成团
define("DEAL_NOT_STOCK",2); //卖光

define("PRESELL_DEAL_NOTICE",10); //预售未开始
define("PRESELL_DEAL_ONLINE",11); //预售进行中
define("PRESELL_DEAL_HISTORY",12); //预售已过期

/**
 * 公用生成消费券的函数
 * 用于环境
 * 1. 自动发放的消费券，即有$order_item_id, 将生成 order_id, order_deal_id, 且user_id与order_id相关数据同步，begin_time与end_time也与deal的同步
 * 2. 无自定义sn，由系统自动生成，以deal_id数据的code为前缀
 * 3. 手动生成，指定user_id, is_valid, sn, password,begin_time,end_time, 无order_id与相关数据 * 
 */
function add_coupon($deal_id,$user_id,$is_valid=0,$sn='',$password='',$begin_time=0,$end_time=0,$order_item_id=0,$order_id=0 )
{
	$res = array('status'=>1,'info'=>'',$data=''); //用于返回的结果集
	$coupon_data = array();
	$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id =".$deal_id);
	$order_item_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order_item where id = ".$order_item_id);
	
	
	if($deal_info['deal_type']==1)
	{
		//按单
		$coupon_data['balance_price'] = $order_item_info['balance_total_price'];
		$coupon_data['add_balance_price'] = $order_item_info['add_balance_price_total'];
		$coupon_data['coupon_price'] = $order_item_info['total_price'];
		
		$coupon_data['coupon_score'] = $order_item_info['return_total_score'];
		$coupon_data['coupon_money'] = $order_item_info['return_total_money'];
		$coupon_data['deal_type'] = 1;

	}
	else
	{
		//按件
		$coupon_data['balance_price'] = $order_item_info['balance_unit_price'];
		$coupon_data['add_balance_price'] = $order_item_info['add_balance_price'];
		$coupon_data['coupon_price'] = $order_item_info['unit_price'];
		
		$coupon_data['coupon_score'] = $order_item_info['return_score'];
		$coupon_data['coupon_money'] = $order_item_info['return_money'];
		$coupon_data['deal_type'] = 0;
	}
	
	//自动发券
	if($order_id>0)
	{
		$order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$order_id);			
		$coupon_data['user_id'] = $order_info['user_id'];
		$coupon_data['order_id'] = $order_info['id'];
		$coupon_data['order_deal_id'] = $order_item_id;
	}
	else
	{
		$coupon_data['user_id'] = $user_id;
	}
	
	if($deal_info['coupon_time_type']==0)
	{
		if($begin_time == 0)
		{
			$coupon_data['begin_time'] = $deal_info['coupon_begin_time'];
		}
		else
		{
			$coupon_data['begin_time'] = $begin_time;
		}
		
		if($end_time == 0)
		{
			$coupon_data['end_time'] = $deal_info['coupon_end_time'];
		}
		else
		{
			$coupon_data['end_time'] = $end_time;
		}
	}
	else
	{
		$day = $deal_info['coupon_day'];
		$coupon_data['begin_time'] = NOW_TIME;
		if($day>0)
		{
			$coupon_data['end_time'] = NOW_TIME+$day*3600*24;
		}
	}
	
	if($sn!='')
	{
		if($GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_coupon where sn='".$sn."'")>0)
		{
			$res['status'] = 0;
			$res['info'] = EXIST_DEAL_COUPON_SN;
			return $res;
		}
		$coupon_data['sn'] = $sn;
	}
	else
	{
		$coupon_data['sn'] = $deal_info['code'].$deal_id.rand(100000,999999);
	}
	
	if($password!='')
	{
		$coupon_data['password'] = $password;
	}
	else
	{
	    $startStr = $deal_info['is_pick'] == 1 ? '4' : '1';
	    $password = $startStr . substr(NOW_TIME, 1, 9). sprintf('%02s', rand(0, 99));
		$coupon_data['password'] = $password;
	}
	
	$coupon_data['is_valid'] = $is_valid;
	$coupon_data['deal_id'] = $deal_id;
	$coupon_data['supplier_id'] = $deal_info['supplier_id'];
	$coupon_data['expire_refund'] = $deal_info['expire_refund'];
	$coupon_data['any_refund'] = $deal_info['any_refund'];
	 
	while($GLOBALS['db']->autoExecute(DB_PREFIX."deal_coupon",$coupon_data,'INSERT','','SILENT')==false)
	{
		$coupon_data['sn'] = $deal_info['code'].$deal_id.rand(100000,999999);
		
		$startStr = $deal_info['is_pick'] == 1 ? '4' : '1';
		$password = $startStr . substr(NOW_TIME, 1, 9). sprintf('%02s', rand(0, 99));
		
		$coupon_data['password'] = $password;
	}
    fanwe_require(APP_ROOT_PATH.'system/model/AppPush.php');
    AppPush::singleUserPush("add_coupon",$order_info['user_id'],lang("APP_PUSH_ORDER_ADD_COUPON",$deal_info['sub_name']),$order_id);
    $res['data'] = $coupon_data;
	return $res;
		
}


/**
 * 检测团购的时间状态
 * $id 团购ID
 * 
 */
function check_deal_time($id)
{
	$deal_info = get_deal($id);
	$now = NOW_TIME;
	
	$is_presell = 0;
	if(IS_PRESELL && $deal_info['is_presell']==1 && $deal_info['presell_begin_time']<NOW_TIME && $deal_info['presell_end_time']>NOW_TIME){
	    $is_presell=1;
	}
    if($is_presell==1){
        if($now < $deal_info['presell_begin_time']){
            $result['status'] = 0;
            $result['data'] = PRESELL_DEAL_NOTICE;  //预售还未开始
            $result['info'] = $deal_info['sub_name'];
            return $result;
        }
        
        if($now > $deal_info['presell_end_time']){
            $result['status'] = 0;
            $result['data'] = PRESELL_DEAL_NOTICE;  //预售已经结束
            $result['info'] = $deal_info['sub_name'];
            return $result;
        }
    }else{
        //开始验证团购时间
        if($deal_info['begin_time']!=0)
        {
            //有开始时间
            if($now<$deal_info['begin_time'])
            {
                $result['status'] = 0;
                $result['data'] = DEAL_NOTICE;  //未上线
                $result['info'] = $deal_info['sub_name'];
                return $result;
            }
        }
        
        
        	
        if($deal_info['end_time']!=0)
        {
            //有结束时间
            if($now>=$deal_info['end_time'])
            {
                $result['status'] = 0;
                $result['data'] = DEAL_HISTORY;  //过期
                $result['info'] = $deal_info['sub_name'];
                return $result;
            }
        }
        
        if($deal_info['is_shop']==0){//团购还要验证团购卷是否已过期
        
            if($deal_info['coupon_end_time']!=0)
            {
                //有结束时间
                if($now>=$deal_info['coupon_end_time'])
                {
                    $result['status'] = 0;
                    $result['data'] = COUPON_HISTORY;  //过期
                    $result['info'] = $deal_info['sub_name'];
                    return $result;
                }
            }
        }
        
    }


	//验证团购时间
	
	$result['status'] = 1;
	$result['info'] = $deal_info['name'];
	return $result;	
}



/**
 * 检测团购的数量状态
 * $id 团购ID
 * $number 数量
 */
function check_deal_number($id,$number = 0,$is_no_addcart=true)
{
	require_once(APP_ROOT_PATH."system/model/cart.php");
	
	$cart_result = load_cart_list($id);
	
	
	$id = intval($id);
	$deal_info = get_deal($id);
	
	
	/*验证数量*/	
	//定义几组需要的数据
	//1. 本团购记录下的购买量
	$deal_buy_count = $deal_info['buy_count'];
	//2. 本团购当前会员的购物车中数量
	$deal_user_cart_count = 0;
	foreach($cart_result['cart_list'] as $k=>$v)
	{
		if($v['deal_id']==$id)
		{
			$deal_user_cart_count += intval($v['number']);
		}
	}
	//3. 本团购当前会员已付款的数量
	$deal_user_paid_count = intval($GLOBALS['db']->getOne("select sum(oi.number) from ".DB_PREFIX."deal_order_item as oi left join ".DB_PREFIX."deal_order as o on oi.order_id = o.id where o.is_main=0 and  o.user_id = ".intval($GLOBALS['user_info']['id'])." and o.pay_status = 2 and oi.deal_id = ".$id." and o.is_delete = 0"));
	//4. 本团购当前会员未付款的数量

	$invalid_count = 0;
	foreach($cart_result['cart_list'] as $k=>$v)
	{
		if($v['number']<=0)
		{
			$invalid_count++;
		}
	}

	$stock = $deal_info['max_bought'];

	$result['stock'] = intval($stock);
	if($invalid_count>0)
	{
		$result['status'] = 0;
		$result['data'] = DEAL_ERROR_MIN_USER_BUY;  //用户最小购买数不足
		$result['info'] = $deal_info['sub_name']." ".sprintf($GLOBALS['lang']['DEAL_USER_MIN_BOUGHT'],1);
		return $result;
	}

	if($deal_info['max_bought'] == 0||($deal_user_cart_count+$number>$deal_info['max_bought']&&$deal_info['max_bought']>0))
	{			
		$result['status'] = 0;
		$result['data'] = DEAL_OUT_OF_STOCK;  //库存不足
		$result['info'] = $deal_info['sub_name']." ".sprintf($GLOBALS['lang']['DEAL_MAX_BOUGHT'],$deal_info['max_bought']);
		return $result;
	}
	
	
    if($is_no_addcart){
    	if($deal_user_cart_count + $number < $deal_info['user_min_bought'] && $deal_info['user_min_bought'] > 0)
    	{
    		$result['status'] = 0;
    		$result['data'] = DEAL_ERROR_MIN_USER_BUY;  //用户最小购买数不足
    		$result['info'] = $deal_info['sub_name']." ".sprintf($GLOBALS['lang']['DEAL_USER_MIN_BOUGHT'],$deal_info['user_min_bought']).",已购买".$deal_user_cart_count."件";
    		return $result;
    	}
    }
    
	if($deal_user_cart_count + $deal_user_paid_count + $number > $deal_info['user_max_bought'] && $deal_info['user_max_bought'] > 0)
	{
		$result['status'] = 0;
		$result['data'] = DEAL_ERROR_MAX_USER_BUY;  //用户最大购买数超出
		$result['info'] = $deal_info['sub_name']." ".sprintf($GLOBALS['lang']['DEAL_USER_MAX_BOUGHT'],$deal_info['user_max_bought']).",已购买".$deal_user_paid_count."件";
		if(!$is_no_addcart){
			$result['info'] = $deal_info['sub_name']." ".sprintf($GLOBALS['lang']['DEAL_USER_MAX_BOUGHT'],$deal_info['user_max_bought']).",已购买".($deal_user_paid_count+$deal_user_cart_count)."件";
		}
		return $result;
	}
	
	
	/*验证数量*/
	$result['status'] = 1;
	$result['info'] = $deal_info['sub_name'];
	return $result;	
}


/**
 * 检测团购的属性数量状态
 * $id 团购ID
 * $attr_setting 属性组合的字符串
 * $number 数量
 */
function check_deal_number_attr($id,$attr_setting,$number=0)
{

    if($attr_setting){
    	require_once(APP_ROOT_PATH."system/model/cart.php");
    	$cart_result = load_cart_list($id);
    	
    	$id = intval($id);	
    	$deal_info = get_deal($id);
    	
    	$attr_stock_cfg = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."attr_stock where deal_id = ".$id." and locate(attr_str,'".$attr_setting."') > 0 ");
    
    	if(!$attr_stock_cfg){
    	    $result['status'] = 0;
    	    $result['data'] = "规格已失效";
    	    $result['info'] = "规格:".$attr_setting."已下架，请选择其他规格";
    	    $result['attr'] = $attr_setting;
    	    return $result;
    	}
    	
    	$stock_setting = $attr_stock_cfg?intval($attr_stock_cfg['stock_cfg']):-1;
    	$stock_attr_setting = $attr_stock_cfg['attr_str'];
    	// 获取到当前规格的库存
    		
    	/*验证数量*/	
    	//定义几组需要的数据
    	//1. 本团购记录下的购买量
    	$deal_buy_count = intval($attr_stock_cfg['buy_count']);
    	//2. 本团购当前会员的购物车中数量
    	$deal_user_cart_count = 0;
    	/*foreach($cart_result['cart_list'] as $k=>$v)
    	{
    		if($v['deal_id']==$id&&strpos($v['attr_str'],$stock_attr_setting)!==false)
    		{
    			$deal_user_cart_count+=intval($v['number']);
    		}
    	}*/
    	//3. 本团购当前会员未付款的数量
    
    	$stock = $stock_setting;
    
    	$result['stock'] = intval($stock);
    
    	
    	if($stock_setting == 0||($deal_user_cart_count+$number>$stock_setting&&$stock_setting>=0))
    	{		
    		$result['status'] = 0;
    		$result['data'] = DEAL_OUT_OF_STOCK;  //库存不足
    		$result['info'] = $deal_info['sub_name'].$stock_attr_setting." ".sprintf($GLOBALS['lang']['DEAL_MAX_BOUGHT'],$stock_setting);
    		$result['attr'] = $stock_attr_setting;
    		return $result;
    	}
    
    	/*验证数量*/
    }	

	$result['status'] = 1;
	$result['info'] = $deal_info['sub_name'];	
	return $result;	

}


/**
 * 获取指定的团购产品
 * @param unknown_type $key 商品的关键ID或uname
 * @param unknown_type $preview 是否为管理员预览
 * @return number
 */
function get_deal($key,$preview=false)
{
	static $deals;
	$deal = $deals[$key];	
	if($deal)return $deal;
	
	$deal = load_auto_cache("deal",array("id"=>$key));

	if($deal)
	{
		if(!$preview&&$deal['is_effect']==0) //未生效的商品，在非预览状态下不可见
		return false;
		
		//重定义time_status
		if($deal['begin_time']>NOW_TIME)
		{
			if($deal['notice']==1||$preview) //未开团不允许预告的团购，预览状态下可见
				$deal['time_status'] = DEAL_NOTICE; //未开始
			else
				return false; //不允许预告
		}
		elseif($deal['end_time']>0&&$deal['end_time']<=NOW_TIME)
		{
			$deal['time_status'] = DEAL_HISTORY; //已过期
		}
		else
		{
			$deal['time_status'] = DEAL_ONLINE; //上线中
		}
		
		//重定义buy_status
		if($deal['min_bought']>$deal['buy_count'])
		{
			$deal['buy_status'] = DEAL_NOT_SUCCESS; //未成团
		}
		elseif($deal['max_bought']==0)
		{
			$deal['buy_status'] = DEAL_NOT_STOCK; //卖光
		}
		else
		{
			$deal['buy_status'] = DEAL_SUCCESS; //成团
		}
			
		//格式化数据
		$deal['percent'] = $deal['avg_point']/5.0*100.0;
		$deal['begin_time_format'] = to_date($deal['begin_time']);
		$deal['end_time_format'] = to_date($deal['end_time']);
		$deal['coupon_begin_time_format'] = to_date($deal['coupon_begin_time'],"Y-m-d");
		$deal['coupon_end_time_format'] = to_date($deal['coupon_end_time'],"Y-m-d");
		$deal['origin_price_format'] = $deal['origin_price'];
		$deal['current_price_format'] = $deal['current_price'];
		$deal['success_time_format']  = to_date($deal['success_time']);
		$deal['set_meal'] = $deal['set_meal'];
		$deal['pc_setmeal'] = $deal['pc_setmeal'];
		$deal['allow_promote'] = $deal['allow_promote'];
		$deal['return_score'] = $deal['return_score'];
		$deal['presell_type'] = $deal['presell_type'];
		$deal['presell_deposit_money'] = $deal['presell_deposit_money'];
		$deal['presell_discount_money'] = $deal['presell_discount_money'];
		$deal['presell_buy_count'] = $deal['presell_buy_count'];
		if($deal['origin_price']>0&&floatval($deal['discount'])==0) //手动折扣
			$deal['save_price'] = $deal['origin_price'] - $deal['current_price'];
		else
			$deal['save_price'] = $deal['origin_price']*((10-$deal['discount'])/10);
			
		if($deal['origin_price']>0&&floatval($deal['discount'])==0)
			$deal['discount'] = round(($deal['current_price']/$deal['origin_price'])*10,1);

		$deal['discount'] = round($deal['discount'],2);
			
		$deal['save_price_format'] = $deal['save_price'];

		$deal['deal_success_num'] = sprintf($GLOBALS['lang']['SUCCESS_BUY_COUNT'],$deal['buy_count']);
		$deal['current_bought'] = $deal['buy_count'];
			
		//团购图片集
		$img_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_gallery where deal_id=".intval($deal['id'])." order by sort asc");

		if($img_list)
		{
			$img_list[0]['current'] = 1;
			$deal['image_list'] = $img_list;
			$deal['icon'] = $img_list[0]['img'];						
		}		

			
// 		//商户信息
		if($deal['supplier_id']>0)
		{
 			$deal['supplier_info'] = $GLOBALS['db']->getRow("select id,name,preview,content,city_id from ".DB_PREFIX."supplier where id = ".intval($deal['supplier_id']));
 			$deal['supplier_location_count'] = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_location_link where deal_id = ".$deal['id']);
 			//$deal['supplier_address_info'] = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."supplier_location where supplier_id = ".intval($deal['supplier_id'])." and is_main = 1");
 			$deal['supplier_info']['url'] = url("index","stores",array("supplier_id"=>$deal['supplier_id']));

 			//获取门店QQ号
 			$deal['location_qqs'] = $GLOBALS['db']->getAll("select name,location_qq from ".DB_PREFIX."supplier_location where supplier_id=".$deal['supplier_id']." limit 0,3");
		}

		//品牌信息
		if($deal['brand_id']>0)
		{
			$deal['brand_info'] = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."brand where id = ".intval($deal['brand_id']));
			if($deal['brand_info'])
				$deal['brand_info']['url'] = url("index","brand#".$deal['brand_id']);
		}
		$sql = "select * from ".DB_PREFIX."promote where supplier_id=".$deal['supplier_id']." and class_name='Freebyprice'";
		$delivery_free_info = $GLOBALS['db']->getRow($sql);
		if($delivery_free_info){
		    $deal['delivery_free_info'] = unserialize($delivery_free_info['config']);
		}
		
		$is_presell = 0;
		if(IS_PRESELL && $deal['is_presell']==1 && $deal['presell_begin_time'] < NOW_TIME &&  $deal['presell_end_time'] > NOW_TIME){
		    $is_presell = 1;
		}
		$deal['is_presell'] = $is_presell;
		
		//规格属性选择
        $deal_attr = array();
        if($deal['deal_goods_type']){
            $deal_attr = $GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."goods_type_attr where goods_type_id = ".$deal['deal_goods_type']);
            foreach($deal_attr as $k=>$v)
            {
                $deal_attr[$k]['attr_list'] = $GLOBALS['db']->getAll("select id,name,is_checked from ".DB_PREFIX."deal_attr where deal_id = ".$deal['id']." and goods_type_attr_id = ".$v['id']);
                if(!$deal_attr[$k]['attr_list'])
                    unset($deal_attr[$k]);
            }
        }
		$deal['deal_attr'] = $deal_attr;
		//开始输出库存json
		$attr_stock_list =$GLOBALS['db']->getAll("select id,attr_cfg,stock_cfg,attr_str,buy_count,attr_key,price,add_balance_price,presell_deposit_money from ".DB_PREFIX."attr_stock where deal_id = ".$deal['id'],false);
		$attr_stock_data = array();
		foreach($attr_stock_list as $row)
		{
			$row['attr_cfg'] = unserialize($row['attr_cfg']);
			//$row['presell_deposit_money'] = round($row['presell_deposit_money'],2);
			$group_id = $GLOBALS['user_info']['group_id'];
			
			if($group_id && $deal['allow_user_discount']){
			    $group_info=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_group where id = ".$group_id);
			
			    if($group_info && $group_info['discount']<1 && $is_presell==0){
			        $row['price'] = round($row['price']*$group_info['discount'],2);
			    }
			}
			$attr_stock_data[$row['attr_key']] = $row;
		}
		
		if($GLOBALS['request']['from']=='app'){
			$deal['deal_attr_stock_json'] = count($attr_stock_data)>0?json_encode($attr_stock_data):'';
		}else{
			$deal['deal_attr_stock_json'] = json_encode($attr_stock_data);
		}
		//获取真实库存（非属性库存 在属性库存不存在时候使用）
		$deal['deal_stock'] = intval($GLOBALS['db']->getOne("select stock_cfg from ".DB_PREFIX."deal_stock where deal_id = ".$deal['id']));
		$durl = $deal['url'];
			
		$deal['share_url'] = SITE_DOMAIN.$durl;
	    //二维码链接json_url
        if($deal['buy_type']==1)
            $json['type']=415;
        else
            $json['type']=414;

        $json['data_id']=$deal['id'];

        if($GLOBALS['user_info'])
        {
            if(app_conf("URL_MODEL")==0)
            {
                $deal['share_url'] .= "&r=".base64_encode(intval($GLOBALS['user_info']['id']));
            }
            else
            {
                $deal['share_url'] .= "?r=".base64_encode(intval($GLOBALS['user_info']['id']));
            }
            $json['user_id']=intval($GLOBALS['user_info']['id']);
            $deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('r'=>base64_encode(intval($GLOBALS['user_info']['id'])),'json'=>base64_encode(json_encode($json))));

        }else{
            $deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('json'=>base64_encode(json_encode($json))));
        }
		
		//开始解析商品标签
		$dealTagNum = getDealTagNum();
		for($tt=0;$tt<$dealTagNum;$tt++)
		{
			if(($deal['deal_tag']&pow(2,$tt))==pow(2,$tt))
			{
				$deal['deal_tags'][] = $tt;
			}
		}
		
		//$deal['is_today'] = get_is_today($deal);
		
		//查询抽奖号
		//$deal['lottery_count'] = intval($GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."lottery where deal_id = ".intval($deal['id'])." and buyer_id <> 0 ")) + intval($deal['buy_count']);
	}

	$deals[$deal['id']] = $deal;
	$deals[$deal['uname']] = $deal;
	return $deal;

}


/**
 * 获取指定条件的商品数量
 */
function get_deal_count($type=array(DEAL_ONLINE,DEAL_HISTORY,DEAL_NOTICE),$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0), $join='', $where='')
{
	if(empty($param))
		$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0);
	
	$tname = "d";
	$time = $GLOBALS['db']->getCacheTime(NOW_TIME);
	$condition = ' '.$tname.'.is_effect = 1 and '.$tname.'.is_delete = 0 and ( 1<>1 ';
	if(in_array(DEAL_ONLINE,$type))
	{
		//进行中的团购
		$condition .= " or ((".$time.">= ".$tname.".begin_time or ".$tname.".begin_time = 0) and (".$time."< ".$tname.".end_time or ".$tname.".end_time = 0) and ".$tname.".buy_status <> 2) ";
	}
	
	if(in_array(DEAL_HISTORY,$type))
	{
		//往期团购
		$condition .= " or ((".$time.">=".$tname.".end_time and ".$tname.".end_time <> 0) or ".$tname.".buy_status = 2) ";
	}
	if(in_array(DEAL_NOTICE,$type))
	{
		//预告
		$condition .= " or ((".$time." < ".$tname.".begin_time and ".$tname.".begin_time <> 0 and ".$tname.".notice = 1)) ";
	}
	
	$condition .= ')';
	
	
	$param_condition = build_deal_filter_condition($param,$tname);
	$condition.=" ".$param_condition;
	
	if($where != '')
	{
		$condition.=" and ".$where;
	}
	
	if($join)
		$sql = "select count(*) from ".DB_PREFIX."deal as ".$tname." ".$join." where  ".$condition;
	else
		$sql = "select count(*) from ".DB_PREFIX."deal as ".$tname." where  ".$condition;

	$count = $GLOBALS['db']->getOne($sql,false);
	return $count;
}

/**
 * 获取正在团购的产品列表
 */
function get_deal_list($limit,$type=array(DEAL_ONLINE,DEAL_HISTORY,DEAL_NOTICE),$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0), $join='', $where='',$orderby = '',$append_field="")
{
    
	if(empty($param))
		$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0);

	$tname = "d";
	$time = $GLOBALS['db']->getCacheTime(NOW_TIME);
	
	
	
	$geo=$GLOBALS['geo'];
	
	//开始身边团购的地理定位
	$ypoint =  $geo['ypoint'];  //ypoint
	$xpoint =  $geo['xpoint'];  //xpoint
	$address = $geo['address'];
	
	
	if($xpoint>0)/* 排序（$order_type）  default 智能（默认）*/
	{
	    $pi = PI;  //圆周率
	    $r = EARTH_R;  //地球平均半径(米)
	    $append_field .= ", (ACOS(SIN(($ypoint * $pi) / 180 ) *SIN((d.ypoint * $pi) / 180 ) +COS(($ypoint * $pi) / 180 ) * COS((d.ypoint * $pi) / 180 ) *COS(($xpoint * $pi) / 180 - (d.xpoint * $pi) / 180 ) ) * $r) as distance ";
	    //$orderby = " distance asc ";
	    
	}
	 
	
	
	
	
	$condition = ' '.$tname.'.is_effect = 1 and '.$tname.'.is_delete = 0 and ( 1<>1 ';
	if(in_array(DEAL_ONLINE,$type))
	{
		//进行中的团购
		$condition .= " or ((".$time.">= ".$tname.".begin_time or ".$tname.".begin_time = 0) and (".$time."< ".$tname.".end_time or ".$tname.".end_time = 0) and ".$tname.".buy_status <> 2) ";
	}

	if(in_array(DEAL_HISTORY,$type))
	{
		//往期团购
		$condition .= " or ((".$time.">=".$tname.".end_time and ".$tname.".end_time <> 0) or ".$tname.".buy_status = 2) ";
	}
	if(in_array(DEAL_NOTICE,$type))
	{
		//预告
		$condition .= " or ((".$time." < ".$tname.".begin_time and ".$tname.".begin_time <> 0 and ".$tname.".notice = 1)) ";
	}

	$condition .= ')';

	
	$param_condition = build_deal_filter_condition($param,$tname);
	$condition.=" ".$param_condition;

	if($where != '')
	{
		$condition.=" and ".$where;
	}

// 	//开始计算使用的索引
// 	$index_key = '';
// 	if(preg_match("/is_recommend/i", $condition))
// 	{
// 		if($orderby=='')
// 			$index_key = "IDX_IS_RECOMMEND_SORT";
// 	}

// 	if($index_key)
// 	{
// 		if($join)
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." use index(`".$index_key."`) ".$join." where  ".$condition;
// 		else
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." use index(`".$index_key."`) where  ".$condition;
// 	}
// 	else
// 	{
// 		if($join)
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." ".$join." where  ".$condition;
// 		else
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." where  ".$condition;
// 	}
	
	if($join)
		$sql = "select ".$tname.".*".$append_field." from ".DB_PREFIX."deal as ".$tname." ".$join." where  ".$condition;
	else
		$sql = "select ".$tname.".*".$append_field." from ".DB_PREFIX."deal as ".$tname." where  ".$condition;

	if($orderby=='')
		$sql.=" order by ".$tname.".sort desc";
	else
		$sql.=" order by ".$orderby;

	if($limit)
		$sql.=" limit ".$limit;

	$deals = $GLOBALS['db']->getAll($sql,false);

	if($deals)
	{
		foreach($deals as $k=>$deal)
		{
			//格式化数据
			$deal['begin_time_format'] = to_date($deal['begin_time']);
			$deal['end_time_format'] = to_date($deal['end_time']);
			$deal['origin_price_format'] = $deal['origin_price'];
			$deal['current_price_format'] = $deal['current_price'];
			$deal['success_time_format']  = to_date($deal['success_time']);

			$is_presell = 0;
			if(IS_PRESELL && $deal['is_presell']==1 && $deal['presell_begin_time'] < NOW_TIME &&  $deal['presell_end_time'] > NOW_TIME){
				$is_presell = 1;
			}
			$deal['is_presell'] = $is_presell;

			if($deal['origin_price']>0&&floatval($deal['discount'])==0) //手动折扣
				$deal['save_price'] = $deal['origin_price'] - $deal['current_price'];
			else
				$deal['save_price'] = $deal['origin_price']*((10-$deal['discount'])/10);
			if($deal['origin_price']>0&&floatval($deal['discount'])==0)
			{
				$deal['discount'] = round(($deal['current_price']/$deal['origin_price'])*10,2);
			}

			$deal['discount'] = round($deal['discount'],2);

			if($deal['uname']!='')
				$durl = url("index","deal#".$deal['uname']);
			else
				$durl = url("index","deal#".$deal['id']);
			$deal['share_url'] = SITE_DOMAIN.$durl;
			$deal['url'] = $durl;


              //二维码链接json_url
            if($deal['buy_type']==1)
                $json['type']=415;
            else
                $json['type']=414;

            $json['data_id']=$deal['id'];

			if($GLOBALS['user_info'])
			{
				if(app_conf("URL_MODEL")==0)
				{
					$deal['share_url'] .= "&r=".base64_encode(intval($GLOBALS['user_info']['id']));
				}
				else
				{
					$deal['share_url'] .= "?r=".base64_encode(intval($GLOBALS['user_info']['id']));
				}
                $json['user_id']=intval($GLOBALS['user_info']['id']);

                $deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('r'=>base64_encode(intval($GLOBALS['user_info']['id'])),'json'=>base64_encode(json_encode($json))));
			}else{
                $deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('json'=>base64_encode(json_encode($json))));
            }

				

			//$deal['is_today'] = get_is_today($deal);
			$deal['save_price_format'] = $deal['save_price'];
			$deal['deal_success_num'] = sprintf($GLOBALS['lang']['SUCCESS_BUY_COUNT'],$deal['buy_count']);
			$deal['current_bought'] = $deal['buy_count'];

			//开始解析商品标签
			$dealTagNum = getDealTagNum();
			for($tt=0;$tt<$dealTagNum;$tt++)
			{
				if(($deal['deal_tag']&pow(2,$tt))==pow(2,$tt))
				{
					$deal['deal_tags'][] = $tt;
				}
			}

			$deal['percent'] = $deal['avg_point']/5.0*100.0;
			$deals[$k] = $deal;
		}
	}
	return array('list'=>$deals,'condition'=>$condition);
}

/**
 * 获取正在预售的产品列表
 */
function get_presell_list($limit,$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0), $join='', $where='',$orderby = '',$append_field="")
{

	if(empty($param))
		$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0);

	$condition = " d.is_effect = 1 and d.is_delete = 0 ";
	$param_condition = build_deal_filter_condition($param,d);
	$condition.=" ".$param_condition;

	if($where != '')
	{
		$condition.=" and ".$where;
	}

	if($join)
		$sql = "select d.*".$append_field." from ".DB_PREFIX."deal as d ".$join." where  ".$condition;
	else
		$sql = "select d.*".$append_field." from ".DB_PREFIX."deal as d where  ".$condition;

	if($orderby=='')
		$sql.=" order by d.sort desc";
	else
		$sql.=" order by ".$orderby;

	if($limit)
		$sql.=" limit ".$limit;

	$deals = $GLOBALS['db']->getAll($sql,false);

	if($deals)
	{
		foreach($deals as $k=>$deal)
		{
			//格式化数据
			$deal['begin_time_format'] = to_date($deal['begin_time']);
			$deal['end_time_format'] = to_date($deal['end_time']);
			$deal['presell_begin_time_format'] = to_date($deal['presell_begin_time']);
			$deal['presell_end_time_format'] = to_date($deal['presell_end_time']);
			$deal['origin_price_format'] = $deal['origin_price'];
			$deal['current_price_format'] = $deal['current_price'];
			$deal['success_time_format']  = to_date($deal['success_time']);

			if($deal['origin_price']>0&&floatval($deal['discount'])==0) //手动折扣
				$deal['save_price'] = $deal['origin_price'] - $deal['current_price'];
			else
				$deal['save_price'] = $deal['origin_price']*((10-$deal['discount'])/10);
			if($deal['origin_price']>0&&floatval($deal['discount'])==0)
			{
				$deal['discount'] = round(($deal['current_price']/$deal['origin_price'])*10,2);
			}

			$deal['discount'] = round($deal['discount'],2);

			if($deal['uname']!='')
				$durl = url("index","deal#".$deal['uname']);
			else
				$durl = url("index","deal#".$deal['id']);
			$deal['share_url'] = SITE_DOMAIN.$durl;
			$deal['url'] = $durl;

			//二维码链接json_url
			if($deal['buy_type']==1)
				$json['type']=415;
			else
				$json['type']=414;

			$json['data_id']=$deal['id'];

			if($GLOBALS['user_info'])
			{
				if(app_conf("URL_MODEL")==0)
				{
					$deal['share_url'] .= "&r=".base64_encode(intval($GLOBALS['user_info']['id']));
				}
				else
				{
					$deal['share_url'] .= "?r=".base64_encode(intval($GLOBALS['user_info']['id']));
				}
				$json['user_id']=intval($GLOBALS['user_info']['id']);

				$deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('r'=>base64_encode(intval($GLOBALS['user_info']['id'])),'json'=>base64_encode(json_encode($json))));
			}else{
				$deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('json'=>base64_encode(json_encode($json))));
			}
			$deal['is_today'] = get_is_today($deal);
			$deal['save_price_format'] = $deal['save_price'];
			$deal['deal_success_num'] = sprintf($GLOBALS['lang']['SUCCESS_BUY_COUNT'],$deal['buy_count']);
			$deal['current_bought'] = $deal['buy_count'];

			//开始解析商品标签
			$dealTagNum = getDealTagNum();
			for($tt=0;$tt<$dealTagNum;$tt++)
			{
				if(($deal['deal_tag']&pow(2,$tt))==pow(2,$tt))
				{
					$deal['deal_tags'][] = $tt;
				}
			}

			$deal['percent'] = $deal['avg_point']/5.0*100.0;
			$deals[$k] = $deal;
		}
	}
	return array('list'=>$deals,'condition'=>$condition);
}

function format_deal_list($deals=array()){

	if($deals){
		foreach($deals as $k=>$deal)
		{
			//格式化数据
			$deal['begin_time_format'] = to_date($deal['begin_time']);
			$deal['end_time_format'] = to_date($deal['end_time']);
			$deal['origin_price_format'] = $deal['origin_price'];
			$deal['current_price_format'] = $deal['current_price'];
			$deal['success_time_format']  = to_date($deal['success_time']);
		
			if($deal['origin_price']>0&&floatval($deal['discount'])==0) //手动折扣
				$deal['save_price'] = $deal['origin_price'] - $deal['current_price'];
			else
				$deal['save_price'] = $deal['origin_price']*((10-$deal['discount'])/10);
			if($deal['origin_price']>0&&floatval($deal['discount'])==0)
			{
				$deal['discount'] = round(($deal['current_price']/$deal['origin_price'])*10,2);
			}
		
			$deal['discount'] = round($deal['discount'],2);
		
			if($deal['uname']!='')
				$durl = url("index","deal#".$deal['uname']);
			else
				$durl = url("index","deal#".$deal['id']);
			$deal['share_url'] = SITE_DOMAIN.$durl;
			$deal['url'] = $durl;
		
		
			if($GLOBALS['user_info'])
			{
				if(app_conf("URL_MODEL")==0)
				{
					$deal['share_url'] .= "&r=".base64_encode(intval($GLOBALS['user_info']['id']));
				}
				else
				{
					$deal['share_url'] .= "?r=".base64_encode(intval($GLOBALS['user_info']['id']));
				}
			}
		
		
			//$deal['is_today'] = get_is_today($deal);
			$deal['save_price_format'] = $deal['save_price'];
			$deal['deal_success_num'] = sprintf($GLOBALS['lang']['SUCCESS_BUY_COUNT'],$deal['buy_count']);
			$deal['current_bought'] = $deal['buy_count'];
		
			//开始解析商品标签
			$dealTagNum = getDealTagNum();
			for($tt=0;$tt<$dealTagNum;$tt++)
			{
				if(($deal['deal_tag']&pow(2,$tt))==pow(2,$tt))
				{
					$deal['deal_tags'][] = $tt;
				}
			}
		
			$deal['percent'] = $deal['avg_point']/5.0*100.0;
			$deals[$k] = $deal;
		}
		return $deals;
	}
	return array();
}


/**
 * 获取正在团购的产品列表(根据门店查询)
 */
function get_location_deal_list($limit,$type=array(DEAL_ONLINE,DEAL_HISTORY,DEAL_NOTICE),$param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0), $join='', $where='',$orderby = '',$append_field="")
{

    if(empty($param))
        $param=array("cid"=>0,"tid"=>0,"aid"=>0,"qid"=>0,"city_id"=>0);

    $tname = "d";
    $time = $GLOBALS['db']->getCacheTime(NOW_TIME);

    $condition = ' '.$tname.'.is_effect = 1 and '.$tname.'.is_delete = 0 and ( 1<>1 ';
    if(in_array(DEAL_ONLINE,$type))
    {
        //进行中的团购
        $condition .= " or ((".$time.">= ".$tname.".begin_time or ".$tname.".begin_time = 0) and (".$time."< ".$tname.".end_time or ".$tname.".end_time = 0) and ".$tname.".buy_status <> 2) ";
    }

    if(in_array(DEAL_HISTORY,$type))
    {
        //往期团购
        $condition .= " or ((".$time.">=".$tname.".end_time and ".$tname.".end_time <> 0) or ".$tname.".buy_status = 2) ";
    }
    if(in_array(DEAL_NOTICE,$type))
    {
        //预告
        $condition .= " or ((".$time." < ".$tname.".begin_time and ".$tname.".begin_time <> 0 and ".$tname.".notice = 1)) ";
    }

    $condition .= ')';


    $param_condition = build_deal_location_filter_condition($param,$tname);

    $condition.=" ".$param_condition;

    if($where != '')
    {
        $condition.=" and ".$where;
    }

    // 新添加的
    $join .= ' LEFT JOIN '.DB_PREFIX.'deal_location_link l ON '.$tname.'.id = l.deal_id ';
    $join .= ' LEFT JOIN '.DB_PREFIX.'supplier_location sl ON sl.id = l.location_id ';

    $join .= ' LEFT JOIN '.DB_PREFIX.'supplier_location_area_link slal ON sl.id = slal.location_id';
    $join .= ' LEFT JOIN '.DB_PREFIX.'area area ON area.id = slal.area_id';
    
    $append_field = $append_field. ', sl.name location_name, sl.address location_address, sl.avg_point location_avg_point, area.name area_name ';
    
    $condition_in = $condition." AND l.location_id IN ( SELECT location_id FROM
            			(
            				(
            					SELECT
            						location_id
            					FROM
            						`".DB_PREFIX."deal` d
            					LEFT JOIN ".DB_PREFIX."deal_location_link dl ON dl.deal_id = d.id
            				    LEFT JOIN ".DB_PREFIX."supplier_location sl ON sl.id = dl.location_id
            					WHERE
            						dl.location_id <> ''
            					    AND ".$condition."
            					GROUP BY
            						dl.location_id
            					ORDER BY
            						".$orderby."
            					LIMIT ".$limit."
            				) AS tb
            			)
        	       )";
    // 新添加的

    if($join)
        $sql = "select ".$tname.".*".$append_field." from ".DB_PREFIX."deal as ".$tname." ".$join." where  ".$condition_in;
    else
        $sql = "select ".$tname.".*".$append_field." from ".DB_PREFIX."deal as ".$tname." where  ".$condition_in;

    if($orderby=='')
        $sql.="GROUP BY d.id ORDER BY ".$tname.".sort desc ";
    else
        $sql.="GROUP BY d.id ORDER BY ".$orderby;

    $deals = $GLOBALS['db']->getAll($sql,false);
    
    if($deals)
    {
        foreach($deals as $k=>$deal)
        {
            //格式化数据
            $deal['begin_time_format'] = to_date($deal['begin_time']);
            $deal['end_time_format'] = to_date($deal['end_time']);
            $deal['origin_price_format'] = $deal['origin_price'];
            $deal['current_price_format'] = $deal['current_price'];
            $deal['success_time_format']  = to_date($deal['success_time']);

            if($deal['origin_price']>0&&floatval($deal['discount'])==0) //手动折扣
                $deal['save_price'] = $deal['origin_price'] - $deal['current_price'];
            else
                $deal['save_price'] = $deal['origin_price']*((10-$deal['discount'])/10);
            if($deal['origin_price']>0&&floatval($deal['discount'])==0)
            {
                $deal['discount'] = round(($deal['current_price']/$deal['origin_price'])*10,2);
            }

            $deal['discount'] = round($deal['discount'],2);

            if($deal['uname']!='')
                $durl = url("index","deal#".$deal['uname']);
            else
                $durl = url("index","deal#".$deal['id']);
            $deal['share_url'] = SITE_DOMAIN.$durl;
            $deal['url'] = $durl;


            if($GLOBALS['user_info'])
            {
                if(app_conf("URL_MODEL")==0)
                {
                    $deal['share_url'] .= "&r=".base64_encode(intval($GLOBALS['user_info']['id']));
                }
                else
                {
                    $deal['share_url'] .= "?r=".base64_encode(intval($GLOBALS['user_info']['id']));
                }
            }


            //$deal['is_today'] = get_is_today($deal);
            $deal['save_price_format'] = $deal['save_price'];
            $deal['deal_success_num'] = sprintf($GLOBALS['lang']['SUCCESS_BUY_COUNT'],$deal['buy_count']);
            $deal['current_bought'] = $deal['buy_count'];

            //开始解析商品标签
            $dealTagNum = getDealTagNum();
            for($tt=0;$tt<$dealTagNum;$tt++)
            {
                if(($deal['deal_tag']&pow(2,$tt))==pow(2,$tt))
                {
                    $deal['deal_tags'][] = $tt;
                }
            }

            $deal['percent'] = $deal['avg_point']/5.0*100.0;
            $deals[$k] = $deal;
        }
    }
    return array('list'=>$deals,'condition'=>$condition);
}



/**
 * 构建商品查询条件
 * @param unknown_type $param
 * @return string
 */
function build_deal_filter_condition($param,$tname="")
{
	$area_id = intval($param['aid']);
	$quan_id = intval($param['qid']);
	$cate_id = intval($param['cid']);
	$deal_type_id = intval($param['tid']);
	$city_id = intval($param['city_id']);
	$condition = "";
	if($city_id>0)
	{
		$ids = load_auto_cache("deal_city_belone_ids",array("city_id"=>$city_id));
		if($ids)
		{
			if($tname)
				$condition .= " and ".$tname.".city_id in (".implode(",",$ids).")";
			else
				$condition .= " and city_id in (".implode(",",$ids).")";
		}
	}
	if($area_id>0)
	{
		if($quan_id>0)
		{

			$area_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."area where id = ".$quan_id);
			$kw_unicodes[] = str_to_unicode_string($area_name);
				
			$kw_unicode = implode(" ",$kw_unicodes);
			//有筛选
			if($tname)
				$condition .=" and (match(".$tname.".locate_match) against('".$kw_unicode."' IN BOOLEAN MODE)) ";
			else
				$condition .=" and (match(locate_match) against('".$kw_unicode."' IN BOOLEAN MODE)) ";
		}
		else
		{
			$ids = load_auto_cache("deal_quan_ids",array("quan_id"=>$area_id));
			$quan_list = $GLOBALS['db']->getAll("select `name` from ".DB_PREFIX."area where id in (".implode(",",$ids).")");
			$unicode_quans = array();
			foreach($quan_list as $k=>$v){
				$unicode_quans[] = str_to_unicode_string($v['name']);
			}
			$kw_unicode = implode(" ", $unicode_quans);
			if($tname)
				$condition .= " and (match(".$tname.".locate_match) against('".$kw_unicode."' IN BOOLEAN MODE))";
			else
				$condition .= " and (match(locate_match) against('".$kw_unicode."' IN BOOLEAN MODE))";
		}
	}

	if($cate_id>0)
	{
		$cate_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate where id = ".$cate_id);
		$cate_name_unicode = str_to_unicode_string($cate_name);
			
		if($deal_type_id>0)
		{
			$deal_type_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate_type where id = ".$deal_type_id);
			$deal_type_name_unicode = str_to_unicode_string($deal_type_name);
			if($tname)
				$condition .= " and (match(".$tname.".deal_cate_match) against('+".$cate_name_unicode." +".$deal_type_name_unicode."' IN BOOLEAN MODE)) ";
			else
				$condition .= " and (match(deal_cate_match) against('+".$cate_name_unicode." +".$deal_type_name_unicode."' IN BOOLEAN MODE)) ";
		}
		else
		{
			if($tname)
				$condition .= " and (match(".$tname.".deal_cate_match) against('".$cate_name_unicode."' IN BOOLEAN MODE)) ";
			else
				$condition .= " and (match(deal_cate_match) against('".$cate_name_unicode."' IN BOOLEAN MODE)) ";
		}
	}
	return $condition;
}

/**
 * 构建门店中商品查询条件
 * @param unknown_type $param
 * @return string
 */
function build_deal_location_filter_condition($param,$tname="")
{
    $area_id = intval($param['aid']);
    $quan_id = intval($param['qid']);
    $cate_id = intval($param['cid']);
    $deal_type_id = intval($param['tid']);
    $city_id = intval($param['city_id']);
    $condition = "";
    if($city_id>0)
    {
        $ids = load_auto_cache("deal_city_belone_ids",array("city_id"=>$city_id));
        if($ids)
        {
            if($tname)
                $condition .= " and ".$tname.".city_id in (".implode(",",$ids).")";
            else
                $condition .= " and city_id in (".implode(",",$ids).")";
        }
    }
    if($quan_id>0)
    {
    
        $area_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."area where id = ".$quan_id);
        $kw_unicodes[] = str_to_unicode_string($area_name);
    
        $kw_unicode = implode(" ",$kw_unicodes);
        //有筛选
        if($tname)
            $condition .=" and (match(".$tname.".locate_match) against('".$kw_unicode."' IN BOOLEAN MODE)) ";
        else
            $condition .=" and (match(locate_match) against('".$kw_unicode."' IN BOOLEAN MODE)) ";
    }else if($area_id>0){
        $ids = load_auto_cache("deal_quan_ids",array("quan_id"=>$area_id));
        $quan_list = $GLOBALS['db']->getAll("select `name` from ".DB_PREFIX."area where id in (".implode(",",$ids).")");
        $unicode_quans = array();
        foreach($quan_list as $k=>$v){
            $unicode_quans[] = str_to_unicode_string($v['name']);
        }
        $kw_unicode = implode(" ", $unicode_quans);
        if($tname)
            $condition .= " and (match(".$tname.".locate_match) against('".$kw_unicode."' IN BOOLEAN MODE))";
        else
            $condition .= " and (match(locate_match) against('".$kw_unicode."' IN BOOLEAN MODE))";
    }

    if($cate_id>0||$deal_type_id>0)
    {
        $cate_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate where id = ".$cate_id);
        $cate_name_unicode = str_to_unicode_string($cate_name);
        	
        if($deal_type_id>0)
        {
            $deal_type_name = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate_type where id = ".$deal_type_id);
            $deal_type_name_unicode = str_to_unicode_string($deal_type_name);
            if($tname)
                $condition .= " and (match(".$tname.".deal_cate_match) against('+".$cate_name_unicode." +".$deal_type_name_unicode."' IN BOOLEAN MODE)) ";
            else
                $condition .= " and (match(deal_cate_match) against('+".$cate_name_unicode." +".$deal_type_name_unicode."' IN BOOLEAN MODE)) ";
        }
        else
        {
            if($tname)
                $condition .= " and (match(".$tname.".deal_cate_match) against('".$cate_name_unicode."' IN BOOLEAN MODE)) ";
            else
                $condition .= " and (match(deal_cate_match) against('".$cate_name_unicode."' IN BOOLEAN MODE)) ";
        }
    }
    return $condition;
}



/**
 * 获取某个条件的商品数量
 */
function get_goods_count($type=array(DEAL_ONLINE,DEAL_HISTORY,DEAL_NOTICE),$param=array("cid"=>0,"city_id"=>0), $join='', $where='')
{
	if(empty($param))
		$param=array("cid"=>0,"city_id"=>0);
	
	$tname = "d";
	$time = $GLOBALS['db']->getCacheTime(NOW_TIME);
	$condition = ' '.$tname.'.is_effect = 1 and '.$tname.'.is_delete = 0 and ( 1<>1 ';
	if(in_array(DEAL_ONLINE,$type))
	{
		//进行中的团购
		$condition .= " or ((".$time.">= ".$tname.".begin_time or ".$tname.".begin_time = 0) and (".$time."< ".$tname.".end_time or ".$tname.".end_time = 0) and ".$tname.".buy_status <> 2) ";
	}
	
	if(in_array(DEAL_HISTORY,$type))
	{
		//往期团购
		$condition .= " or ((".$time.">=".$tname.".end_time and ".$tname.".end_time <> 0) or ".$tname.".buy_status = 2) ";
	}
	if(in_array(DEAL_NOTICE,$type))
	{
		//预告
		$condition .= " or ((".$time." < ".$tname.".begin_time and ".$tname.".begin_time <> 0 and ".$tname.".notice = 1)) ";
	}
	
	$condition .= ')';
	
	
	$param_condition = build_goods_filter_condition($param,$tname);
	$condition.=" ".$param_condition;
	
	if($where != '')
	{
		$condition.=" and ".$where;
	}
	
	if($join)
		$sql = "select count(*) from ".DB_PREFIX."deal as ".$tname." ".$join." where  ".$condition;
	else
		$sql = "select count(*) from ".DB_PREFIX."deal as ".$tname." where  ".$condition;

	
	
	$count = $GLOBALS['db']->getOne($sql,false);
	return $count;
}

/**
 * 获取商品列表
 * cid:分类ID, bid:品牌ID, fid_x: ID为x的分组筛选的关键词,kw:关键词,city_id:城市ID
 */
function get_goods_list($limit,$type=array(DEAL_ONLINE,DEAL_HISTORY,DEAL_NOTICE),$param=array("cid"=>0,"city_id"=>0), $join='', $where='',$orderby = '')
{
	if(empty($param))
		$param=array("cid"=>0,"city_id"=>0);

	$tname = "d";
	$time = $GLOBALS['db']->getCacheTime(NOW_TIME);
	$condition = ' '.$tname.'.is_effect = 1 and '.$tname.'.is_delete = 0 and ( 1<>1 ';
	if(in_array(DEAL_ONLINE,$type))
	{
		//进行中的团购
		$condition .= " or ((".$time.">= ".$tname.".begin_time or ".$tname.".begin_time = 0) and (".$time."< ".$tname.".end_time or ".$tname.".end_time = 0) and ".$tname.".buy_status <> 2) ";
	}

	if(in_array(DEAL_HISTORY,$type))
	{
		//往期团购
		$condition .= " or ((".$time.">=".$tname.".end_time and ".$tname.".end_time <> 0) or ".$tname.".buy_status = 2) ";
	}
	if(in_array(DEAL_NOTICE,$type))
	{
		//预告
		$condition .= " or ((".$time." < ".$tname.".begin_time and ".$tname.".begin_time <> 0 and ".$tname.".notice = 1)) ";
	}

	$condition .= ')';


	$param_condition = build_goods_filter_condition($param,$tname);
	$condition.=" ".$param_condition;

	if($where != '')
	{
		$condition.=" and ".$where;
	}

// 	//开始计算使用的索引
// 	$index_key = '';
// 	if(preg_match("/is_recommend/i", $condition))
// 	{
// 		if($orderby=='')
// 			$index_key = "IDX_IS_RECOMMEND_SORT";
// 	}

// 	if($index_key)
// 	{
// 		if($join)
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." use index(`".$index_key."`) ".$join." where  ".$condition;
// 		else
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." use index(`".$index_key."`) where  ".$condition;
// 	}
// 	else
// 	{
// 		if($join)
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." ".$join." where  ".$condition;
// 		else
// 			$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." where  ".$condition;
// 	}
	
	if($join)
		$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." ".$join." where  ".$condition;
	else
		$sql = "select ".$tname.".* from ".DB_PREFIX."deal as ".$tname." where  ".$condition;

	if($orderby=='')
		$sql.=" order by ".$tname.".sort desc ";
	else
		$sql.=" order by ".$orderby;

	if($limit)
		$sql.=" limit ".$limit;

	$deals = $GLOBALS['db']->getAll($sql);
	if($deals)
	{
		foreach($deals as $k=>$deal)
		{
			//格式化数据
			$deal['begin_time_format'] = to_date($deal['begin_time']);
			$deal['end_time_format'] = to_date($deal['end_time']);
			$deal['origin_price_format'] = $deal['origin_price'];
			$deal['current_price_format'] = $deal['current_price'];
			$deal['success_time_format']  = to_date($deal['success_time']);

			if($deal['origin_price']>0&&floatval($deal['discount'])==0) //手动折扣
				$deal['save_price'] = $deal['origin_price'] - $deal['current_price'];
			else
				$deal['save_price'] = $deal['origin_price']*((10-$deal['discount'])/10);
			if($deal['origin_price']>0&&floatval($deal['discount'])==0)
			{
				$deal['discount'] = round(($deal['current_price']/$deal['origin_price'])*10,2);
			}

			$deal['discount'] = round($deal['discount'],2);

			if($deal['uname']!='')
				$durl = url("index","deal#".$deal['uname']);
			else
				$durl = url("index","deal#".$deal['id']);
			$deal['share_url'] = SITE_DOMAIN.$durl;
			$deal['url'] = $durl;

			$is_presell = 0;
			if(IS_PRESELL && $deal['is_presell']==1 && $deal['presell_begin_time'] < NOW_TIME &&  $deal['presell_end_time'] > NOW_TIME){
				$is_presell = 1;
			}
			$deal['is_presell'] = $is_presell;

            //二维码链接json_url buy_type 1积分商品 0普通商品
            if($deal['buy_type']==1)
                $json['type']=415;
            else
                $json['type']=414;
            $json['data_id']=$deal['id'];

            if($GLOBALS['user_info'])
            {
                if(app_conf("URL_MODEL")==0)
                {
                    $deal['share_url'] .= "&r=".base64_encode(intval($GLOBALS['user_info']['id']));
                }
                else
                {
                    $deal['share_url'] .= "?r=".base64_encode(intval($GLOBALS['user_info']['id']));
                }
                $json['user_id']=intval($GLOBALS['user_info']['id']);
                $deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('r'=>base64_encode(intval($GLOBALS['user_info']['id'])),'json'=>base64_encode(json_encode($json))));

            }
            else{
                $deal['json_url']= SITE_DOMAIN.url("index","deal#".$deal['id'],array('json'=>base64_encode(json_encode($json))));

            }



			//$deal['is_today'] = get_is_today($deal);
			$deal['save_price_format'] = $deal['save_price'];
			$deal['deal_success_num'] = sprintf($GLOBALS['lang']['SUCCESS_BUY_COUNT'],$deal['buy_count']);
			$deal['current_bought'] = $deal['buy_count'];
			//查询抽奖号
			if($deal['is_lottery']==1)
				$deal['lottery_count'] = intval($GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."lottery where deal_id = ".intval($deal['id'])." and buyer_id <> 0 ")) + intval($deal['buy_count']);

			//开始解析商品标签
			$dealTagNum = getDealTagNum();
			for($tt=0;$tt<$dealTagNum;$tt++)
			{
				if(($deal['deal_tag']&pow(2,$tt))==pow(2,$tt))
				{
					$deal['deal_tags'][] = $tt;
				}
			}

			$deal['percent'] = $deal['avg_point']/5.0*100.0;
			$deals[$k] = $deal;
		}
	}
	//logger::write(print_r($deals,1));
	return array('list'=>$deals,'condition'=>$condition);
}

/**
 * 获取商品一级分类
 */
function get_cate_list($limit='', $where='', $orderby = '')
{
    $tname = DB_PREFIX."deal_cate";
    $condition = ' '.$tname.'.is_effect = 1 and '.$tname.'.is_delete = 0 ';

    if($where != '')
    {
        $condition.=" and ".$where;
    }

   
    $sql = "select ".$tname.".* from ".$tname." where  ".$condition;

    if($orderby=='')
        $sql.=" order by ".$tname.".sort desc ";
    else
        $sql.=" order by ".$orderby;
    if ($limit) {
        $sql .= ' limit '.$limit;
    }
    

    $cate = $GLOBALS['db']->getAll($sql,false);
    //		echo $count_sql;
    
    return array('list'=>$cate,'condition'=>$condition);
}


/**
 * 获得商品的查询条件，根据输入的参数
 * cid:分类ID, bid:品牌ID, fid_x: ID为x的分组筛选的关键词,city_id:城市ID
 */
function build_goods_filter_condition($filter_param,$tname="")
{
	 $condition = " ";
	 
	 //禁用商城的城市传入
// 	 $city_id = intval($filter_param['city_id']);
	 
// 	 if($city_id>0)
// 	 {
// 	 	$ids = load_auto_cache("deal_city_belone_ids",array("city_id"=>$city_id));
// 	 	if($ids)
// 	 	{
// 	 		if($tname)
// 	 			$condition .= " and ".$tname.".city_id in (".implode(",",$ids).")";
// 	 		else
// 	 			$condition .= " and city_id in (".implode(",",$ids).")";
// 	 	}
// 	 }
	 
	 
	 //分类
	 if($filter_param['cid']>0)
	 {
	 		$cate_cache = load_auto_cache("cache_shop_cate",array("all"=>1));
	 		$cate_info = $cate_cache[$filter_param['cid']];
	 		$cate_name_unicode = "";	 		
	 		while($cate_info)
	 		{
	 			$cate_name_unicode .= " +".str_to_unicode_string($cate_info['name'])." ";
	 			$cate_info = $cate_cache[$cate_info['pid']];
	 		}
	 		if($cate_name_unicode)
	 		$condition .=" and (match(".$tname.".shop_cate_match) against('".$cate_name_unicode."' IN BOOLEAN MODE))";	 	
	 }

	 //品牌
	 if(is_array($filter_param['bid']))
	 {   
	     if(!empty($filter_param['bid'])){
	           $brand_ids = implode("," , $filter_param['bid']);
	           $condition.=" and ".$tname.".brand_id in (".$brand_ids.")";
	      }
	 	 
	 }elseif($filter_param['bid']>0){
	      $condition.=" and ".$tname.".brand_id = ".$filter_param['bid'];
	 }
	
	 
	 //标签
	 foreach($filter_param as $k=>$v)
	 {
	 	if(preg_match("/fid_(\d+)/i", $k,$matches))
	 	{
	 			if($v!="")
	 			{	 				
	 				$unicode_tags[] = "+".str_to_unicode_string($v);	 	 				
	 			}
	 	}
	 }
	 if(count($unicode_tags)>0)
	 {
	 	$kw_unicode = implode(" ", $unicode_tags);
	 	//有筛选
	 	$condition .=" and (match(".$tname.".tag_match) against('".$kw_unicode."' IN BOOLEAN MODE))";
	 }
	 

	 
	 return $condition;
}

function deal_auto_publish($id){
    $submit_data = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_submit where id = ".$id);
    if ($submit_data){
        $result = format_deal_submit($submit_data);
        $deal_submit_id = $result['deal_submit_id'];
        $data = $result['data'];
        $other_data = $result['other_data'];
        
        if($result['act_type']){ //更新操作
            // 获取旧数据，下面更新关键字有用
            $old_data = $GLOBALS['db']->getAll("select id, is_shop, name_match_row, deal_cate_match_row,  shop_cate_match_row,  locate_match_row, tag_match_row  from ".DB_PREFIX."deal where id = '".$result['deal_id']."'");
            $data['id'] = $result['deal_id'];
            $GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,'UPDATE'," id=".$result['deal_id']);
            $list = $GLOBALS['db']->affected_rows();
        }else{//新增操作
            $GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data);
            $list = $GLOBALS['db']->insert_id();
            $data['id'] = $list;
        }
         
        if (false !== $list) {

        	$deal_stock = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_stock where deal_id = '".$data['id']."'");
        	if(!$deal_stock)
        	{
        		$deal_stock['deal_id'] = $data['id'];
        		$deal_stock['stock_cfg'] = $data['max_bought'];
        		$GLOBALS['db']->autoExecute(DB_PREFIX."deal_stock",$deal_stock,"INSERT","","SILENT");
        	}
        	else
        	{
        		$GLOBALS['db']->query("update ".DB_PREFIX."deal_stock set stock_cfg = ".$data['max_bought']." where deal_id = ".$data['id']);
        	}
        	
            //同步消费券
            if ($data['is_shop'] == 1){
                /*商城部分的内容*/
                 
                //免运费
//                $GLOBALS['db']->query("delete from ".DB_PREFIX."free_delivery where deal_id=".$data['id']);

//                if(intval($data['free_delivery'])==1)
//                {
//                    $delivery_ids = $_REQUEST['delivery_id'];
//                    $free_counts = $_REQUEST['free_count'];
//                    foreach($delivery_ids as $k=>$result)
//                    {
//                        $free_conf = array();
//                        $free_conf['delivery_id'] = $delivery_ids[$k];
//                        $free_conf['free_count'] = $free_counts[$k];
//                        $free_conf['deal_id'] = $data['id'];
//                        $GLOBALS['db']->autoExecute(DB_PREFIX."free_delivery",$free_conf);
//                    }
//                }
        
                 
                 
                //开始创建筛选项
                $GLOBALS['db']->query("delete from ".DB_PREFIX."deal_filter where deal_id=".$data['id']);
                foreach($other_data['cache_deal_filter'] as $filter_value)
                {
                    $filter_data = array();
                    $filter_data['filter'] = $filter_value['filter'];
                    $filter_data['filter_group_id'] = $filter_value['filter_group_id'];
                    $filter_data['deal_id'] = $data['id'];
                    $GLOBALS['db']->autoExecute(DB_PREFIX."deal_filter",$filter_data);
                }
            }else{
                $GLOBALS['db']->query("update ".DB_PREFIX."deal_coupon set expire_refund = ".$data['expire_refund'].",any_refund = ".$data['any_refund'].",supplier_id=".$data['supplier_id']." where deal_id = ".$data['id']);
        
                if($data['coupon_time_type']==0)
                    $GLOBALS['db']->query("update ".DB_PREFIX."deal_coupon set end_time=".$data['coupon_end_time'].",begin_time=".$data['coupon_begin_time']." where deal_id = ".$data['id']);
                 
                $GLOBALS['db']->query("delete from ".DB_PREFIX."deal_cate_type_deal_link where deal_id=".$data['id']);
                foreach($other_data['deal_cate_type_id'] as $link_data)
                {
                    $ins_data = array();
                    $ins_data['deal_id'] = $data['id'];
                    $ins_data['deal_cate_type_id'] = $link_data;
                    $GLOBALS['db']->autoExecute(DB_PREFIX."deal_cate_type_deal_link",$ins_data);
                }
                 
                 
            }
            //门店处理
            $GLOBALS['db']->query("delete from ".DB_PREFIX."deal_location_link where deal_id=".$data['id']);
            foreach($other_data['location_id'] as $location_id_data)
            {
                $ins_data = array();
                $ins_data['deal_id'] = $data['id'];
                $ins_data['location_id'] = $location_id_data;
                $GLOBALS['db']->autoExecute(DB_PREFIX."deal_location_link",$ins_data);
            }
             
            //开始处理图片
            $GLOBALS['db']->query("delete from ".DB_PREFIX."deal_gallery where deal_id=".$data['id']);
            foreach($other_data['imgs'] as $img_k=>$img_v)
            {
                $img_v['deal_id'] = $data['id'];
                $GLOBALS['db']->autoExecute(DB_PREFIX."deal_gallery",$img_v);
            }
            //end 处理图片

            
             //同步关联商品
            $cache_relate=$other_data['cache_relate'];
            if($cache_relate['good_id']>0) {
            	$GLOBALS['db']->query("delete from ".DB_PREFIX."relate_goods where good_id=".$cache_relate['good_id']);      
            }       
            $GLOBALS['db']->autoExecute(DB_PREFIX."relate_goods",$cache_relate);            
            
            
            //开始处理属性
            //$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_attr where deal_id=".$data['id']);
            $new_ids = array(0);
            foreach($other_data['deal_attr'] as $deal_attr_k=>$deal_attr_item)
            {
                $deal_attr_item_res = array();
                if($deal_attr_item['goods_type_attr_id'])
            	    $deal_attr_item_res = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_attr where name = '".$deal_attr_item['name']."' and goods_type_attr_id = '".$deal_attr_item['goods_type_attr_id']."' and deal_id = '".$data['id']."'");
            	if($deal_attr_item_res)
            	{
            		$GLOBALS['db']->autoExecute(DB_PREFIX."deal_attr",$deal_attr_item,"UPDATE","id=".$deal_attr_item_res['id']);
            		$new_ids[] = $deal_attr_item_res['id'];
            	}
            	else
            	{            	
	                $deal_attr_item['deal_id'] = $data['id'];
	                $GLOBALS['db']->autoExecute(DB_PREFIX."deal_attr",$deal_attr_item);
	                $new_ids[] = $GLOBALS['db']->insert_id();
            	}
            }
            $sql = "delete from ".DB_PREFIX."deal_attr where id not in (".implode(",",$new_ids).") and deal_id = '".$data['id']."'";
            $GLOBALS['db']->query($sql);
        
            //开始创建属性库存
            //$GLOBALS['db']->query("delete from ".DB_PREFIX."attr_stock where deal_id=".$data['id']);
            $new_ids = array(0);
            foreach($other_data['attr_stock'] as $attr_stock_k=>$attr_stock_v){
                $attr_stock_v['deal_id'] = $data['id'];
//                 $sql = "select sum(oi.number) from ".DB_PREFIX."deal_order_item as oi left join ".
//                     DB_PREFIX."deal as d on d.id = oi.deal_id left join ".
//                     DB_PREFIX."deal_order as do on oi.order_id = do.id where".
//                     " do.pay_status = 2 and do.is_delete = 0 and d.id = ".$data['id'].
//                     " and oi.attr_str like '%".$attr_stock_v['attr_str']."%'";
//                 $attr_stock_v['buy_count'] = intval($GLOBALS['db']->getOne($sql));

                $stock_data = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."attr_stock where deal_id = '".$data['id']."' and attr_str = '".$attr_stock_v['attr_str']."'");
                if($stock_data)
                {
                	$GLOBALS['db']->autoExecute(DB_PREFIX."attr_stock",$attr_stock_v,"UPDATE","id=".$stock_data['id']);
                	$new_ids[] = $stock_data['id'];
                }
                else
                {
              	  	$GLOBALS['db']->autoExecute(DB_PREFIX."attr_stock",$attr_stock_v);
              	  	$new_ids[] = $GLOBALS['db']->insert_id();
                }
            }
            $sql = "delete from ".DB_PREFIX."attr_stock where id not in (".implode(",",$new_ids).") and deal_id = '".$data['id']."'";
            $GLOBALS['db']->query($sql);
            
            //成功提示
            syn_deal_status($data['id']);
            foreach($other_data['location_id'] as $location_id)
            {
                recount_supplier_data_count($location_id,"tuan");
            }
            syn_deal_match($data['id']);
            
            // 更新关键字
            require_once(APP_ROOT_PATH."system/model/search_key_words.php");
            if($result['act_type']){ //更新操作
                updateKeyWordsApi($old_data, 1);
            }else{//新增操作
                insertKeyWordsApi($list, 1);
            }
             
            syn_attr_stock_key($data['id']);
             
            //对于商户请求操作
            $GLOBALS['db']->autoExecute(DB_PREFIX."deal_submit",array("admin_check_status"=>1),"UPDATE","id=".$deal_submit_id); // 1 通过 2 拒绝',
        }
        rm_auto_cache("deal",$data['id']);
    }
}

function format_deal_submit($data){
    $temp_data = array();
    $temp_data['name'] = $data['name'];
    $temp_data['sub_name'] = $data['sub_name'];
    $temp_data['supplier_id'] = $data['supplier_id'];
    $temp_data['img'] = $data['img'];
    $temp_data['description'] = $data['description'];
    $temp_data['begin_time'] = $data['begin_time'];
    $temp_data['end_time'] = $data['end_time'];
    $temp_data['max_bought'] = $data['max_bought'];
    $temp_data['user_min_bought'] = $data['user_min_bought'];
    $temp_data['user_max_bought'] = $data['user_max_bought'];
    $temp_data['origin_price'] = $data['origin_price'];
    $temp_data['is_effect'] = $data['is_effect'];
    $temp_data['allow_promote'] = 0;
    $temp_data['return_money'] = $data['return_money'];
    $temp_data['return_score'] = $data['return_score'];
    $temp_data['brief'] = $data['brief'];
    $temp_data['sort'] = $data['sort'];
    $temp_data['is_referral'] = $data['is_referral'];
    $temp_data['icon'] = $data['icon'];
    $temp_data['define_payment'] =0;
    $temp_data['seo_title'] = $data['seo_title'];
    $temp_data['seo_keyword'] = $data['seo_keyword'];
    $temp_data['seo_description'] = $data['seo_description'];
    $temp_data['uname'] = $data['uname'];
    $temp_data['cart_type'] = 0;
    $temp_data['is_recommend'] = $data['is_recommend'];
    $temp_data['balance_price'] = $data['balance_price'];
    $temp_data['deal_tag'] = $data['deal_tag'];
    $temp_data['update_time'] = $data['update_time'];
    $temp_data['publish_wait'] = $data['publish_wait'];
    $temp_data['multi_attr'] = $data['multi_attr'];
    $temp_data['is_lottery'] = $data['is_lottery'];
    $temp_data['is_delivery'] = $data['is_delivery'];
    $temp_data['is_pick'] = $data['is_pick'];
    $temp_data['is_refund'] = $data['is_refund'];
    $temp_data['coupon_begin_time'] = $data['coupon_begin_time'];
    $temp_data['coupon_end_time'] = $data['coupon_end_time'];
    $temp_data['current_price'] = $data['current_price'];
    $temp_data['expire_refund'] = $data['expire_refund'];
    $temp_data['any_refund'] = $data['any_refund'];
    $temp_data['update_time'] = NOW_TIME;
     
    if(intval($data['deal_id']) == 0)
        $temp_data['create_time'] = NOW_TIME;
     
    //图片数据
    $imgs = unserialize($data['cache_focus_imgs']);
    $img_data = array();
    $temp_other = array();
    foreach($imgs as $img_k=>$img_v)
    {
        if($img_v!='')
        {
            $img_data['img'] = $img_v;
            $img_data['sort'] = $img_k;
        }
        $temp_other['imgs'][] = $img_data;
    }
     
    //开始处理属性
    $temp_other['deal_attr'] = unserialize($data['cache_deal_attr']);
    $temp_other['attr_stock'] = unserialize($data['cache_attr_stock']);
     
    $temp_other['cache_relate'] = unserialize($data['cache_relate']);     
    
    if($data['is_shop'] == 1){
        $temp_data['is_delivery'] = $data['is_delivery'];
        $temp_data['weight'] = $data['weight'];
        $temp_data['weight_id'] = $data['weight_id'];
        $temp_data['buy_type'] = $data['buy_type'];
        $temp_data['free_delivery'] = 0;
        $temp_data['shop_cate_id'] = $data['shop_cate_id'];
        $temp_data['brand_id'] = $data['brand_id'];
        $temp_data['is_refund'] = $data['is_refund'];
        $temp_data['is_shop'] = 1;
        $temp_data['delivery_type']=$data['delivery_type'];
        $temp_data['deal_goods_type'] = $data['deal_goods_type'];
        $temp_data['carriage_template_id']=$data['carriage_template_id'];
         
        //免运费
        $temp_other['cache_free_delivery'] = unserialize($data['cache_free_delivery']);
        //支付方式
        $temp_other['cache_deal_payment'] = unserialize($data['cache_deal_payment']);
        //快递
        $temp_other['cache_deal_delivery'] = unserialize($data['cache_deal_delivery']);
        //过滤
        $temp_other['cache_deal_filter'] = unserialize($data['cache_deal_filter']);
        //门店
        $temp_other['location_id'] = unserialize($data['cache_location_id']);
    }else{
        $temp_data['auto_order'] = $data['auto_order'];
        $temp_data['notes'] = $data['notes'];
        $temp_data['notice'] = $data['notice'];
        $temp_data['deal_goods_type'] = $data['deal_goods_type'];
        $temp_data['cate_id'] = $data['cate_id'];
        $temp_data['min_bought'] = $data['min_bought'];
        $temp_data['city_id'] = $data['city_id'];
        $temp_data['is_coupon'] = 1;
        $temp_data['buy_count'] = $data['buy_count'];
        $temp_data['deal_type'] = $data['deal_type'];
        $temp_data['coupon_time_type'] = intval($data['coupon_time_type']);
        $temp_data['coupon_day'] = intval($data['coupon_day']);
        $temp_data['discount'] = $data['discount'];
        $temp_data['forbid_sms'] = $data['forbid_sms'];
        $temp_data['cart_type'] = 0;
         
        //分类
        $temp_other['deal_cate_type_id'] = unserialize($data['cache_deal_cate_type_id']);
        //门店
        $temp_other['location_id'] = unserialize($data['cache_location_id']);
    }
     
     
    $act_type = 0; //0:新增，1更新
    
    if($data['deal_id']>0){
        $act_type = 1;
    }
    
    $result_data = array("data"=>$temp_data,"other_data"=>$temp_other,"act_type"=>$act_type,"deal_submit_id"=>$data['id'],"deal_id"=>$data['deal_id']);
    
    return $result_data;

}

function deal_auto_downline($id){
	
    $deal_submit_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_submit where id = ".$id);
    if($deal_submit_info && $deal_submit_info['biz_apply_status']==3){
        //更新商户表状态
        $GLOBALS['db']->autoExecute(DB_PREFIX."deal_submit",array("admin_check_status"=>1),"UPDATE","id=".$id);
        //更新团购数据表
        $GLOBALS['db']->autoExecute(DB_PREFIX."deal",array("is_effect"=>0),"UPDATE","id=".$deal_submit_info['deal_id']);
        return true;
    }else{
        return false;
    }
}

/**
 * 根据deal_ids获取列表信息(包括属性，库存)
 * 
 * return array(
 * 	'goodsList'	=>	array(),
 * 	'dealArray'	=>	array(
 * 						'id'=>array(
 * 							'name'=>'','origin_price'=>'','current_price'=>''
 * 						),
 * 					),
 * 	'attrArray'	=>	array(
 * 						'id'=>array(
 * 							'规格类型'=>array(
 * 								'规格id'=>array(),
 * 							),
 * 						),
 * 					),
 * 	'stockArray'	=>	array(
 * 						'id'=>array(
 * 							'规格类型_规格类型'=>array(),
 * 						),
 * 					),
 * 
 * )
*/

function getDetailedList($id,$param=array()){
	if( is_array($id) ){
		$id = implode(',', $id);
	}
	
	$group_id = $GLOBALS['user_info']['group_id'];
	if($group_id)
	    $group_info=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_group where id = ".$group_id);
	
	$dealArray  = array();
	$attrArray  = array();
	$stockArray = array();	//库存
	
	$goodsList = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal where id in (".$id.")");
	foreach( $goodsList as $k => $item ){
	    if($group_info && $item['allow_user_discount'] && $group_info['discount']<1){	    
	            $goodsList[$k]['current_price'] = $item['current_price']*$group_info['discount'];
	            $item['current_price'] = $item['current_price']*$group_info['discount'];
	    }
	    
//		$item['deal_attr']  = array();
		$item['stock'] 		= array();
		//商品属性
		$itemAttr = $GLOBALS['db']->getAll("select ".DB_PREFIX."deal_attr.*,".DB_PREFIX."deal_attr.id as id_1,".DB_PREFIX."deal_attr.name as name_1,".DB_PREFIX."goods_type_attr.* from ".DB_PREFIX."deal_attr left join ".DB_PREFIX."goods_type_attr on ".DB_PREFIX."deal_attr.goods_type_attr_id=".DB_PREFIX."goods_type_attr.id where ".DB_PREFIX."deal_attr.deal_id=".$item['id']);
		
		$dealAttrTypeArr = array();
		foreach($itemAttr as $attrItem){
			if( !empty($dealAttrTypeArr[$attrItem['id']]) ){
				$dealAttrTypeArr[$attrItem['id']]['attr_list'][] = array(
					'id'	=>	$attrItem['id_1'],
					'name'	=>	$attrItem['name_1'],
					'price'	=>	$group_info['discount']?($group_info['discount']*$attrItem['price']):$attrItem['price'],
					'is_checked'	=>	$attrItem['is_checked'],
				);
			}else{
				$dealAttrTypeArr[$attrItem['id']] = array(
					'id'	=>	$attrItem['id'],
					'name'	=>	$attrItem['name']
				);
				$dealAttrTypeArr[$attrItem['id']]['attr_list'][] = array(
					'id'	=>	$attrItem['id_1'],
					'name'	=>	$attrItem['name_1'],
					'price'	=>	$group_info['discount']?($group_info['discount']*$attrItem['price']):$attrItem['price'],
					'is_checked'	=>	$attrItem['is_checked'],
				);
			}
			
			unset($attrItem['id']);
			$attrArray[$item['id']][$attrItem['name']][$attrItem['id_1']] = $attrItem;
		}
		
		$dealAttrTypeArr = array_values($dealAttrTypeArr);
		$item['deal_attr']  = $dealAttrTypeArr;
		
		//如果有规格，查询库存
		if( $itemAttr ){
			$itemStock = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."attr_stock where deal_id=".$item['id']);
			foreach( $itemStock as $stockItem ){
				$stockItem['attr_cfg'] = unserialize($stockItem['attr_cfg']);
				$stockArray[$item['id']][$stockItem['attr_key']] = $stockItem;
				$item['stock'][$stockItem['attr_key']] = $stockItem;
			}
		}

		$dealArray[$item['id']] = array(
				'name' => $item['name'],
				'origin_price' 	=> $item['origin_price'],
				'current_price' => $item['current_price'],
				'min_bought' 	=> $item['min_bought'],
				'max_bought' 	=> $item['max_bought'],
		);
		
		if(empty($item['deal_attr'])){
			unset($item['deal_attr']);
		}
		
		if(empty($item['stock'])){
			unset($item['stock']);
		}
		
		if(function_exists("format_deal_item"))
		$item = format_deal_item($item);
	}
	return array(
				'goodsList'		=>	$goodsList,
				'dealArray'		=>	$dealArray,
				'attrArray'		=>	$attrArray,
				'stockArray'	=>	$stockArray,
			);
}


/**
 * 根据deal_ids获取列表信息(包括属性，库存)
 *
 * return array(
 * 	'goodsList'	=>	array(),
 * 	'dealArray'	=>	array(
 * 						'id'=>array(
 * 							'name'=>'','origin_price'=>'','current_price'=>''
 * 						),
 * 					),
 * 	'attrArray'	=>	array(
 * 						'id'=>array(
 * 							'规格类型'=>array(
 * 								'规格id'=>array(),
 * 							),
 * 						),
 * 					),
 * 	'stockArray'	=>	array(
 * 						'id'=>array(
 * 							'规格类型_规格类型'=>array(),
 * 						),
 * 					),
 *
 * )
 */

function getDetailedList_v1($id,$param=array()){
    if( is_array($id) ){
        $id = implode(',', $id);
    }

    $dealArray  = array();
    $attrArray  = array();
    $stockArray = array();	//库存

    $tname = 'd';
    $time = $GLOBALS['db']->getCacheTime(NOW_TIME);
    $condition = ' '.$tname.'.is_effect = 1 and '.$tname.'.is_delete = 0 and '.$tname.'.id in('.$id.') and ( 1<>1 ';
   
    //进行中的团购
    $condition .= " or ((".$time.">= ".$tname.".begin_time or ".$tname.".begin_time = 0) and (".$time."< ".$tname.".end_time or ".$tname.".end_time = 0) and ".$tname.".buy_status <> 2) ";
    $condition .= ')';
    
    $goodsList = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal d where {$condition}");

    foreach( $goodsList as &$item ){
        //		$item['deal_attr']  = array();
        $item['stock'] 		= array();
        //商品属性
        $itemAttr = $GLOBALS['db']->getAll("select ".DB_PREFIX."deal_attr.*,".DB_PREFIX."deal_attr.id as id_1,".DB_PREFIX."deal_attr.name as name_1,".DB_PREFIX."goods_type_attr.* from ".DB_PREFIX."deal_attr left join ".DB_PREFIX."goods_type_attr on ".DB_PREFIX."deal_attr.goods_type_attr_id=".DB_PREFIX."goods_type_attr.id where ".DB_PREFIX."deal_attr.deal_id=".$item['id']." ORDER BY ".DB_PREFIX."goods_type_attr.id");

        $dealAttrTypeArr = array();
        foreach($itemAttr as $attrItem){
            if( !empty($dealAttrTypeArr[$attrItem['id']]) ){
                $dealAttrTypeArr[$attrItem['id']]['attr_list'][] = array(
                    'id'	=>	$attrItem['id_1'],
                    'name'	=>	$attrItem['name_1'],
                    'price'	=>	$attrItem['price'],
                    'is_checked'	=>	$attrItem['is_checked'],
                );
            }else{
                $dealAttrTypeArr[$attrItem['id']] = array(
                    'id'	=>	$attrItem['id'],
                    'name'	=>	$attrItem['name']
                );
                $dealAttrTypeArr[$attrItem['id']]['attr_list'][] = array(
                    'id'	=>	$attrItem['id_1'],
                    'name'	=>	$attrItem['name_1'],
                    'price'	=>	$attrItem['price'],
                    'is_checked'	=>	$attrItem['is_checked'],
                );
            }
            	
            unset($attrItem['id']);
            $attrArray[$item['id']][$attrItem['name']][$attrItem['id_1']] = $attrItem;
        }

        $dealAttrTypeArr = array_values($dealAttrTypeArr);
        $item['deal_attr']  = $dealAttrTypeArr;

        //如果有规格，查询库存
        if( $itemAttr ){
            $itemStock = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."attr_stock where deal_id=".$item['id']);
            foreach( $itemStock as $stockItem ){
                $stockItem['attr_cfg'] = unserialize($stockItem['attr_cfg']);
                $stockArray[$item['id']][$stockItem['attr_key']] = $stockItem;
                $item['stock'][$stockItem['attr_key']] = $stockItem;
            }
        }
        if(APP_INDEX=='app'){
            $dealArray[] = array(
                'id'=>$item['id'],
                'name' => $item['name'],
                'origin_price' 	=> $item['origin_price'],
                'current_price' => $item['current_price'],
                'min_bought' 	=> $item['min_bought'],
                'max_bought' 	=> $item['max_bought'],
            );
        }else{
            $dealArray[$item['id']] = array(
                'name' => $item['name'],
                'origin_price' 	=> $item['origin_price'],
                'current_price' => $item['current_price'],
                'min_bought' 	=> $item['min_bought'],
                'max_bought' 	=> $item['max_bought'],
            );
        }


        if(empty($item['deal_attr'])){
            unset($item['deal_attr']);
        }

        if(empty($item['stock'])){
            unset($item['stock']);
        }

        if(function_exists("format_deal_item"))
            $item = format_deal_item($item);
    }
    return array(
        'goodsList'		=>	$goodsList,
        'dealArray'		=>	$dealArray,
        'attrArray'		=>	$attrArray,
        'stockArray'	=>	$stockArray,
    );
}



function getDealTagNum()
{
	$tagNum = PC_DEAL_TAG_NUMBER;
	if (APP_INDEX === 'wap' || APP_INDEX === 'app') {
		$tagNum = WAP_DEAL_TAG_NUMBER;
	}
	return $tagNum;
}

function format_deal_name($deal_name,$type=0){
    if($type==0){
        $pre_name = '【预售】';
    }elseif($type==1){
        $pre_name = '【拼团】';
    }
    return "<span style='color: #ff2244'>".$pre_name."</span>".$deal_name;
}



?>