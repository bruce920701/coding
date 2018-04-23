<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class dealModule extends MainBaseModule
{
	public function index()
	{
	    
		global_run();
		init_app_page();
		$deal_key = strim($_REQUEST['act']);
		require_once(APP_ROOT_PATH."system/model/deal.php");
		$deal = get_deal($deal_key);	
		
		$GLOBALS['tmpl']->assign("is_presell",$deal['is_presell']);
		$group_id = $GLOBALS['user_info']['group_id'];
		if($group_id)
		    $group_info=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_group where id = ".$group_id);

		$deal_sub_name = $deal['sub_name'];
		if($group_info && $deal['allow_user_discount'] && $group_info['discount']<1 && $deal['is_presell']==0){
		        $deal['current_price'] = round($deal['current_price']*$group_info['discount'],2);
		        $deal['discount']=round($deal['current_price']/$deal['origin_price']*10,1);
		        $deal['discount_name']=$group_info['name']."优惠价";
		    
		}
		else if($deal['is_presell']==1){//正在参与预售
			$deal['sub_name'] = format_deal_name($deal['sub_name']);
			$deal['end_time'] = $deal['presell_end_time'];
			$deal['discount']=round($deal['current_price']/$deal['origin_price']*10,1);
			if($deal['presell_type']==0){
				$deal['presell_deposit_type']="订金";
			}else if($deal['presell_type']==1){
				$deal['presell_deposit_type']="定金";
			}
			$deal['presell_deposit_money']=round($deal['presell_deposit_money'],2);
			$deal['presell_discount_money']=round($deal['presell_discount_money'],2);
		}else
		{
	        $deal['discount_name']="销售价";
	    }
		
		$user_login_status=$GLOBALS['user_info']?1:0;
		$GLOBALS['tmpl']->assign('user_login_status',$user_login_status);
		
		if($deal)
		{	
			if($deal['is_shop']==1)
			{
				if($deal['buy_type']==1)
					$GLOBALS['tmpl']->assign("cate_tree_type",2); //积分商城商品下拉菜单加载积分分类
				else
				{
					set_view_history("shop", $deal['id']);
					$history_ids = get_view_history("shop");
					$GLOBALS['tmpl']->assign("cate_tree_type",1);
				}
				$GLOBALS['tmpl']->assign("search_type",5);
			}
			else
			{
				set_view_history("deal", $deal['id']);
				$history_ids = get_view_history("deal");
			}			
			//浏览历史
			if($history_ids)
			{
				$ids_conditioin = " d.id in (".implode(",", $history_ids).") ";
				
				if($deal['is_shop']==0)
				{
					$history_deal_list = get_deal_list(app_conf("SIDE_DEAL_COUNT"),array(DEAL_ONLINE),array("city_id"=>$GLOBALS['city']['id']),"",$ids_conditioin);	
				}
				elseif($deal['is_shop']==1)
				{
					if($deal['buy_type']==0)
						$history_deal_list = get_goods_list(app_conf("SIDE_DEAL_COUNT"),array(DEAL_ONLINE),array("city_id"=>$GLOBALS['city']['id']),"",$ids_conditioin);
					
				}
				
				//重新组装排序
				$history_list = array();
				foreach($history_ids as $k=>$v)
				{
					foreach($history_deal_list['list'] as $history_item)
					{
						if($history_item['is_presell']==1){
							require_once(APP_ROOT_PATH."system/model/deal.php");
							$history_item['current_price'] = round($history_item['current_price'],2);
							$history_item['sub_name'] = format_deal_name($history_item['sub_name']);
						}else if($group_info && $history_item['allow_user_discount'] && $group_info['discount']<1){
					        $history_item['current_price'] = round($history_item['current_price']*$group_info['discount'],2);
					    }
						if($history_item['id']==$v)
						{
							$history_list[] = $history_item;
						}
					}
				}
				$GLOBALS['tmpl']->assign("history_deal_list",$history_list);
			}
			
			//$GLOBALS['tmpl']->assign("drop_nav","no_drop"); //首页下拉菜单不输出
			//$GLOBALS['tmpl']->assign("wrap_type","1"); //首页宽屏展示			
			$deal['description'] = format_html_content_image($deal['description'],720);
			$deal['notes'] = format_html_content_image($deal['notes'],720);
			$deal['pc_setmeal'] = format_html_content_image($deal['pc_setmeal'],720);
			$promotes_list = array();
			$pro = array();
			$pro['type'] = "return";
			if($deal['return_money']>0){
			    $pro['content'].="购买返现".round($deal['return_money'],2)."元";
			}
			if($deal['return_score']>0){
			    if($pro['content']){
			        $pro['content'].=" ，";
			    }
			    $pro['content'].="购买返".$deal['return_score']."积分";
			}	
			if( $pro['content']){
			    $promotes_list[] = $pro;
			}
			
			if($deal['delivery_free_info']['is_open_delivery_free']==1 && $deal['is_shop']==1 && $deal['delivery_type']!=2){
			    $pro['content']="满".round($deal['delivery_free_info']['delivery_free_money'],2)."元免运费";
			    $pro['type'] = "free";
			    $promotes_list[] = $pro;
			}

			$deal['promotes_list'] = $promotes_list;
			$deal['promotes_count'] = count($promotes_list);
			$GLOBALS['tmpl']->assign("deal",$deal);
			$GLOBALS['tmpl']->assign("NOW_TIME",NOW_TIME);

			//输出右侧的其他团购
			if($deal['is_shop']==0){
				$side_deal_list = get_deal_list(5,array(DEAL_ONLINE,DEAL_NOTICE),array("cid"=>$deal['cate_id'],"city_id"=>$GLOBALS['city']['id']),"","  d.buy_type <> 1 and d.is_shop = 0 and d.id<>".$deal['id']);
			}elseif($deal['is_shop']==1)
			{
				if($deal['buy_type']==1){
					$side_deal_list = get_goods_list(app_conf("SIDE_DEAL_COUNT"),array(DEAL_ONLINE,DEAL_NOTICE),array("cid"=>$deal['shop_cate_id'],"city_id"=>$GLOBALS['city']['id']),"","  d.buy_type = 1 and d.is_shop = 1 and d.id<>".$deal['id']);
				}else{
					$side_deal_list = get_goods_list(app_conf("SIDE_DEAL_COUNT"),array(DEAL_ONLINE,DEAL_NOTICE),array("cid"=>$deal['shop_cate_id'],"city_id"=>$GLOBALS['city']['id']),"","  d.buy_type <> 1 and d.is_shop = 1 and d.id<>".$deal['id']);
				}
			}

			foreach ($side_deal_list['list'] as $k => $item){
				if($item['is_presell']==1){
					require_once(APP_ROOT_PATH."system/model/deal.php");
					$side_deal_list['list'][$k]['current_price'] = round($item['current_price'],2);
					$side_deal_list['list'][$k]['sub_name'] = format_deal_name($item['sub_name']);
				}else if($group_info && $item['allow_user_discount'] && $group_info['discount']<1){
					$side_deal_list['list'][$k]['current_price'] = round($item['current_price']*$group_info['discount'],2);
				}
			}
				
			//$side_deal_list = get_deal_list(4,array(DEAL_ONLINE));
			$GLOBALS['tmpl']->assign("side_deal_list",$side_deal_list['list']);		
			

			//关于分类信息与seo
			$page_title = "";
			$page_keyword = "";
			$page_description = "";
			if($deal['supplier_info']['name'])
			{
				$page_title.="[".$deal['supplier_info']['name']."]";
				$page_keyword.=$deal['supplier_info']['name'].",";
				$page_description.=$deal['supplier_info']['name'].",";
			}
			$page_title.= $deal_sub_name;
			$page_keyword.=$deal['sub_name'].",";
			$page_description.=$deal['sub_name'].",";
			
			$site_nav[] = array('name'=>$GLOBALS['lang']['HOME_PAGE'],'url'=>url("index"));			
			
			if($deal['cate_id'])
			{
				$deal['cate_name'] = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate where id = ".$deal['cate_id']);
				$deal['cate_url'] = url("index","tuan",array("cid"=>$deal['cate_id']));				
			}
			elseif($deal['shop_cate_id'])
			{
				$deal['cate_name'] = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."shop_cate where id = ".$deal['shop_cate_id']);
				if($deal['buy_type']==1)
				$deal['cate_url'] = url("index","scores",array("cid"=>$deal['shop_cate_id']));
				else
				$deal['cate_url'] = url("index","cate",array("cid"=>$deal['shop_cate_id']));
			}			
			if($deal['cate_name'])
			{
				$page_title.=" - ".$deal['cate_name'];
				$page_keyword.=$deal['cate_name'].",";
				$page_description.=$deal['cate_name'].",";
				$site_nav[] = array('name'=>$deal['cate_name'],'url'=>$deal['cate_url']);
			}
			$site_nav[] = array('name'=>$deal_sub_name,'url'=>$deal['url']);
			$GLOBALS['tmpl']->assign("site_nav",$site_nav);


			
			
			if($deal['seo_title'])$page_title = $deal['seo_title'];
			if($deal['seo_keyword'])$page_keyword = $deal['seo_keyword'];
			if($deal['seo_description'])$page_description = $deal['seo_description'];
	
			$GLOBALS['tmpl']->assign("page_title",$page_title);
			$GLOBALS['tmpl']->assign("page_keyword",$page_keyword);
			$GLOBALS['tmpl']->assign("page_description",$page_description);
			
			$GLOBALS['tmpl']->display("deal.html");
		}
		else
		{
			app_redirect_preview();
		}
		
		
	}
	
	/**
	 * 小能客服的商品数据
	 * http://www.example.com/index.php?ctl=deal&itemid={$itemid}&itemparam={$itemparam}
	 * @return json 
	 */
	public function xnDealInterface()
	{
		$deal_id = intval($_REQUEST['itemid']);
		if ($deal_id <= 0) {
			echo json_encode(array('item' => array('info' => '非法字段')));
			exit;
		}
		$dealSql = 'SELECT d.*, dc.name cname FROM '.DB_PREFIX.'deal d LEFT JOIN '.DB_PREFIX.'shop_cate dc ON d.shop_cate_id = dc.id  WHERE d.id='.$deal_id;
		$deal = $GLOBALS['db']->getRow($dealSql);
		if (empty($deal)) {
			echo json_encode(array('item' => array('info' => '商品不存在')));
			exit;
		}
		$item = array(
			'id' => $deal_id,
			'name' => $deal['name'],
			'imageurl' => format_image_path($deal['img']), // 图片地址
			'url' => SITE_DOMAIN.url('index', 'deal', array('act' => $deal_id)),  // 详情页地址
			'currency' => '￥', //货币符号
			'siteprice' => $deal['current_price'], // 网站价格
			'marketprice' => $deal['current_price'], // 市场价格
			'category' => $deal['cname'], // 分类
			'brand' => '', // 品牌
		);
		echo json_encode(array('item' => $item));
	}
	
}
?>