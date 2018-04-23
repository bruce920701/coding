<?php 
/**
 * 订单记录
 */
require APP_ROOT_PATH.'app/Lib/page.php';
require_once(APP_ROOT_PATH."system/model/user.php");
class promoteModule extends BizBaseModule
{
    
	function __construct()
	{
        parent::__construct();
        global_run();
        $this->check_auth();
    }
	
    
	
    public function index() {
        global_run();
        init_app_page();
        $s_account_info = $GLOBALS["account_info"];
        $supplier_id = intval($s_account_info['supplier_id']);
        $sql="select * from ".DB_PREFIX."promote where supplier_id=".$supplier_id." and class_name='Freebyprice'";
        $delivery_info =  $GLOBALS['db']->getRow($sql);
        $config = unserialize($delivery_info['config']);

        $delivery_free_money = $config['delivery_free_money'];
        $is_open_delivery_free = $config['is_open_delivery_free'];
    
        $GLOBALS['tmpl']->assign("page_title", "满免设置");
        $GLOBALS['tmpl']->assign("is_open_delivery_free", $is_open_delivery_free);
        $GLOBALS['tmpl']->assign("delivery_free_money", $delivery_free_money);
        $GLOBALS['tmpl']->display('pages/promote/index.html');
        
    }
    
    
    public function delivery_free_update()
    {
        $s_account_info = $GLOBALS["account_info"];
        $supplier_id = intval($s_account_info['supplier_id']);
        $delivery_free_money = round(floatval($_REQUEST['delivery_free_money']),2);
        $is_open_delivery_free = intval($_REQUEST['is_open_delivery_free']);
        
        // 更新数据
        
        if($delivery_free_money<=0){
            $result['status']=0;
            $result['info']='请正确填写满免金额';
            ajax_return($result);
        }

        $sql="select * from ".DB_PREFIX."promote where supplier_id=".$supplier_id." and class_name='Freebyprice'";
        $delivery_info =  $GLOBALS['db']->getRow($sql);
        $config = array();
        $config['delivery_free_money'] = $delivery_free_money;
        $config['is_open_delivery_free'] = $is_open_delivery_free;
        $data = array();
        $data['config'] = serialize($config);
        $data['type'] = 0;


        $data['name'] = '满免运费';
        $data['description'] = '满'.round($delivery_free_money,2).'元免运费';
        $data['supplier_or_platform'] = 1;

        if($delivery_info){
            $GLOBALS['db']->autoExecute(DB_PREFIX."promote",$data,"UPDATE","supplier_id=".$supplier_id." and class_name='Freebyprice'","SILENT");
        }else{
            $data['supplier_id'] = $supplier_id;
            $data['class_name'] = 'Freebyprice';
            $GLOBALS['db']->autoExecute(DB_PREFIX."promote",$data);
        }

        
        $result['status']=1;
        $result['info']='设置成功';

        ajax_return($result);
    
    }
    
	
}
?>