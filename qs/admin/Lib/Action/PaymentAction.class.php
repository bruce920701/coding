<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class PaymentAction extends CommonAction{
	private function read_modules()
	{
		$directory = APP_ROOT_PATH."system/payment/";
		$read_modules = true;
		$dir = @opendir($directory);
	    $modules     = array();
	
	    while (false !== ($file = @readdir($dir)))
	    {
	        if (preg_match("/^.*?\.php$/", $file))
	        {
	            $modules[] = require_once($directory .$file);
	        }
	    }
	    @closedir($dir);
	    unset($read_modules);
	
	    foreach ($modules AS $key => $value)
	    {
	        ksort($modules[$key]);
	    }
	    ksort($modules);
	
	    return $modules;
	}
	public function index()
	{
		$modules = $this->read_modules();
		$db_modules = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."payment");
		foreach($modules as $k=>$v)
		{
			foreach($db_modules as $kk=>$vv)
			{
				if($v['class_name']==$vv['class_name'])
				{
					//已安装
					$modules[$k]['id'] = $vv['id'];
					$modules[$k]['total_amount'] = $vv['total_amount'];
					$modules[$k]['installed'] = 1;
					$modules[$k]['is_effect'] = $vv['is_effect'];
					$modules[$k]['sort'] = $vv['sort'];
					break;
				}
			}
			
			if($modules[$k]['installed'] != 1)
			$modules[$k]['installed'] = 0;
			$modules[$k]['is_effect'] = intval($modules[$k]['is_effect']);			
			$modules[$k]['sort'] = intval($modules[$k]['sort']);
			$modules[$k]['total_amount'] = floatval($modules[$k]['total_amount']);
			$modules[$k]['reg_url'] = $v['reg_url']?$v['reg_url']:'';
		}
		$this->assign("payment_list",$modules);
		$this->display();
	}
	
	public function install()
	{
		$class_name = sltrim($_REQUEST['class_name']);
		$directory = APP_ROOT_PATH."system/payment/";
		$read_modules = true;
		
		$file = $directory.$class_name."_payment.php";
		if(file_exists($file))
		{
			$module = require_once($file);
			$rs = M("Payment")->where("class_name = '".$class_name."'")->count();
			if($rs > 0)
			{
				$this->error(l("PAYMENT_INSTALLED"));
			}
		}
		else
		{
			$this->error(l("INVALID_OPERATION"));
		}
		
		//开始插入数据
		$data['name'] = $module['name'];
		$data['class_name'] = $module['class_name'];
		$data['online_pay'] = $module['online_pay'];
		$data['lang'] = $module['lang'];
		$data['config'] = $module['config'];
		$data['sort'] = (M("Payment")->max("sort") + 1);	
		
		$this->assign("data",$data);

		$this->display();
		
	}
	
	public function insert()
	{
		$data = M(MODULE_NAME)->create ();
		if($data['fee_type']==1&&$data['fee_amount']>1){
			$this->error("比率不能超过百分百",0);
		}
		if(!is_array($_REQUEST['config'])){
			$_REQUEST['config']=array();
		}
		$data['config'] = serialize($_REQUEST['config']);
		// 更新数据
		$log_info = $data['name'];
		$list=M(MODULE_NAME)->add($data);
		$this->assign("jumpUrl",u(MODULE_NAME."/index"));
		if (false !== $list) {
			if($data['class_name']=='Malipay'||$data['class_name']=='Mcod'||$data['class_name']=='Walipay'||$data['class_name']=='Wtenpay')
			{
				$GLOBALS['db']->query("update ".DB_PREFIX."m_config_list set pay_id = ".intval($list).",is_verify=".$data['is_effect']." where code = '".$data['class_name']."'");
			}
			//成功提示
			save_log($log_info.L("INSTALL_SUCCESS"),1);
			$this->success(L("INSTALL_SUCCESS"));
		} else {
			//错误提示
			save_log($log_info.L("INSTALL_FAILED"),0);
			$this->error(L("INSTALL_FAILED"));
		}
	}
	public function edit() {		
		$id = intval($_REQUEST ['id']);
		$condition['id'] = $id;		
		$vo = M(MODULE_NAME)->where($condition)->find();
		
		$directory = APP_ROOT_PATH."system/payment/";
		$read_modules = true;
		
		$file = $directory.$vo['class_name']."_payment.php";
		if(file_exists($file))
		{
			$module = require_once($file);
		}
		else
		{
			$this->error(l("INVALID_OPERATION"));
		}
		
		$vo['config'] = unserialize($vo['config']);

		$data['lang'] = $module['lang'];
		$data['config'] = $module['config'];
		
		$this->assign ( 'vo', $vo );
		$this->assign ( 'data', $data );
		$this->display ();
	}
	
	public function update()
	{
		$data = M(MODULE_NAME)->create ();
		if($data['fee_type']==1&&$data['fee_amount']>1){
			$this->error("比率不能超过百分百",0);
		}
		if(!is_array($_REQUEST['config'])){
			$_REQUEST['config']=array();
		}
		$data['config'] = serialize($_REQUEST['config']);
		$log_info = M(MODULE_NAME)->where("id=".intval($data['id']))->getField("name");

		$this->assign("jumpUrl",u(MODULE_NAME."/edit",array("id"=>$data['id'])));
		
		// 更新数据
		$list=M(MODULE_NAME)->save ($data);
		if (false !== $list) {
			//成功提示
			if($data['class_name']=='Malipay'||$data['class_name']=='Mcod'||$data['class_name']=='Walipay'||$data['class_name']=='Wtenpay')
			{
				$GLOBALS['db']->query("update ".DB_PREFIX."m_config_list set pay_id = ".intval($data['id']).",is_verify=".$data['is_effect']." where code = '".$data['class_name']."'");
			}
			save_log($log_info.L("UPDATE_SUCCESS"),1);
			$this->success(L("UPDATE_SUCCESS"));
		} else {
			//错误提示
			save_log($log_info.L("UPDATE_FAILED"),0);
			$this->error(L("UPDATE_FAILED"),0,$log_info.L("UPDATE_FAILED"));
		}
	}
	
	public function uninstall()
	{
		$ajax = intval($_REQUEST['ajax']);
		$id = intval($_REQUEST ['id']);
		$data = M(MODULE_NAME)->getById($id);
		if($data)
		{
			$info = $data['name'];
			$list = M(MODULE_NAME)->where ( array('id'=>$data['id']) )->delete();	
			if ($list!==false) {
					M("DealPayment")->where ( array('payment_id'=>$data['id']) )->delete();	
					save_log($info.l("UNINSTALL_SUCCESS"),1);
					$this->success (l("UNINSTALL_SUCCESS"),$ajax);
				} else {
					save_log($info.l("UNINSTALL_FAILED"),0);
					$this->error (l("UNINSTALL_FAILED"),$ajax);
				}
		}
		else
		{
			$this->error (l("INVALID_OPERATION"),$ajax);
		}
	}
	
}
?>