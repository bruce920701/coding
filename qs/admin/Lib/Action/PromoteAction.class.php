<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class PromoteAction extends CommonAction{

	
	public function delivery_free() {		
		

	    $sql="select * from ".DB_PREFIX."promote where supplier_id=0 and class_name='Freebyprice'";
	    $delivery_info =  $GLOBALS['db']->getRow($sql);
	    $config = unserialize($delivery_info['config']);
	    $delivery_free_money = $config['delivery_free_money'];
	    $is_open_delivery_free = $config['is_open_delivery_free'];
 
        $this->assign("is_open_delivery_free",$is_open_delivery_free);
        $this->assign("delivery_free_money",$delivery_free_money);
		$this->display ();
	}
	
	
	public function delivery_free_update()
	{
		
	    $delivery_free_money = floatval($_REQUEST['delivery_free_money']);
	    $is_open_delivery_free = intval($_REQUEST['is_open_delivery_free']);
	    if($is_open_delivery_free==1 && $delivery_free_money==0){
	        $this->error('输入信息有误，请重新输入');
	    }
		// 更新数据

	    $sql="select * from ".DB_PREFIX."promote where supplier_id=0 and class_name='Freebyprice'";
	    $delivery_info =  $GLOBALS['db']->getRow($sql);
	    $config = array();
	    $config['delivery_free_money'] = $delivery_free_money;
	    $config['is_open_delivery_free'] = $is_open_delivery_free;
	    $data = array();
	    $data['config'] = serialize($config);
	    $data['type'] = 0;
	    $data['supplier_id'] = 0;
	    $data['class_name'] = 'Freebyprice';
	    $data['name'] = '满免运费';
	    $data['description'] = '满'.round($delivery_free_money,2).'元免运费';
	    $data['supplier_or_platform'] = 0;
	    
	    if($delivery_info){
	        $GLOBALS['db']->autoExecute(DB_PREFIX."promote",$data,"UPDATE","supplier_id=0","SILENT");
	    }else{
	        $GLOBALS['db']->autoExecute(DB_PREFIX."promote",$data);
	    }
	    
	    $info = '满免运费活动设置';
	    $this->assign("jumpUrl",u(MODULE_NAME."/delivery_free"));
	    save_log($info.L("UPDATE_SUCCESS"),1);
	    $this->success(L("UPDATE_SUCCESS"));
		
	}
	

	
}
?>