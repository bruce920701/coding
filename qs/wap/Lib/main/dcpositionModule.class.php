<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

require_once(APP_ROOT_PATH."app/Lib/main/core/dc_init.php");
/**
 * 外卖订餐
 * 
 *
 */
class dcpositionModule extends MainBaseModule
{

	/**
	 * 外卖定位页面
	 * 
	 * 输出
	 * s_info：Array 当明地理位置信息
	 *    结构如下
	 *     Array
        (
            [dc_title] => 宝龙城市广场
            [city_name] => 福州
        )
	 * city_name：string当前城市名称
	 * 
	 * 
*/
	public function index()
	{		
		
		global_run();
		dc_global_run();
		init_app_page();
		$param=array();
		$data = call_api_core("dcposition","index",$param);
		//参数处理
		require_once(APP_ROOT_PATH."system/model/dc.php");
		
		$is_vs=intval($_REQUEST['is_vs']);
		if($is_vs)
		    $GLOBALS['tmpl']->assign("vs_url",wap_url("index","visiting_service"));
		else 
		    $GLOBALS['tmpl']->assign("vs_url",'');
		$GLOBALS['tmpl']->assign("is_vs",$is_vs);
		
		$s_info=get_lastest_search_name();
		$GLOBALS['tmpl']->assign("s_info",$s_info);
		$GLOBALS['tmpl']->assign("city_name",$GLOBALS['city']['name']);
		
		$GLOBALS['tmpl']->assign("data",$data);
		$dc_search_history_str=dc_stripslashes(es_cookie::get('dc_search_history'));
		$dc_search_history=array();
		$dc_search_history=json_decode($dc_search_history_str,true);
		$dc_search_history=array_values($dc_search_history);
		$GLOBALS['tmpl']->assign('dc_search_history',$dc_search_history);
		$GLOBALS['tmpl']->display("dc/dc_position.html");

	}
	
	
	

	/**
	 * 搜索历史的保存
	 * 输入：
	 * xpoint：float 经度
	 * ypoint：float 维度
	 * dc_title:搜索地址
	 * dc_content：搜索地址下面的具体信息
	 * dc_num：商家个数
	 */
	public function do_position(){
		
		global_run();
		
		if($_REQUEST['xpoint']!='' && $_REQUEST['ypoint']!='' && $_REQUEST['dc_title']!=''){
		
			$dc_search['dc_xpoint']=floatval($_REQUEST['xpoint']);
			$dc_search['dc_ypoint']=floatval($_REQUEST['ypoint']);
			$dc_search['dc_title']=strim($_REQUEST['dc_title']);
			$dc_search['dc_content']=strim($_REQUEST['dc_content']);
			$dc_search['dc_num']=intval($_REQUEST['dc_num']);
			$dc_search['type'] = intval($_REQUEST['type']); // 1:定位
		
			$city= strim($_REQUEST['city']);
			$dc_search['city_name']=$city;
				
				
			//定位当前城市
			$city=str_replace('市', '', $city);
			$city_id=$GLOBALS['db']->getOne("select id from ".DB_PREFIX."deal_city where name='".$city."'");
		
			if(intval($city_id)>0){
				global $city;
				require_once(APP_ROOT_PATH."system/model/city.php");
				require_once(APP_ROOT_PATH."system/model/dc.php");
				City::locate_city(intval($city_id));
				if (!$dc_search['type'] || $dc_search['type'] != 1) {
					$dc_search_history_str=dc_stripslashes(es_cookie::get('dc_search_history'));
					$dc_search_history=array();
					$dc_search_history=json_decode($dc_search_history_str,true);
					$search_key=md5($dc_search['dc_xpoint'].$dc_search['dc_ypoint'].$dc_search['dc_title'].$dc_search['dc_content']);
					$dc_search_history_new[$search_key]=$dc_search;
					foreach($dc_search_history as $k=>$v){
						if($k!=$search_key){
							$dc_search_history_new[$k]=$v;
						}
					}
					es_cookie::set('dc_search_history', json_encode($dc_search_history_new),3600*24*7);
				}
				$result['status']= 1;
				$result['info']='';
				ajax_return($result);
			}else{
				$result['status']= 0;
				$result['info']= '不支持该城市';
				ajax_return($result);
			}
		
		}else{
			$result['status']= 0;
			$result['info']= '请输入正确地址，并从下拉框中选择';
			ajax_return($result);
		
		}
		
	}
	
	/**
	 * 搜索历史的清空
	 */
	public function clear_history(){
	
		es_cookie::delete('dc_search_history');
		$data['status']= 1;
		ajax_return($data);
	}
	

	
}
?>