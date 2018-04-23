<?php
class NewMarketingAdmAction extends CommonAction {
    function index() {
        
        $type = $_REQUEST['type'];
        $key = $_REQUEST['key'];
        $config_file = APP_ROOT_PATH."system/adm_cfg/".APP_TYPE."/fxadmnav_cfg.php";
        $navs = array_merge_admnav($navs, $config_file);
        $config_node = APP_ROOT_PATH."system/adm_cfg/".APP_TYPE."/fxadmnode_cfg.php";
        $new_node = require $config_node;
        
        $arr=$navs['newmarketing']['groups'][$key];
        unset($navs['newmarketing']['groups']);
        $navs['newmarketing']['groups'][$key]=$arr;
        $arr=$new_node['newmarketing'][$key];
        unset($new_node['newmarketing']);
        $new_node['newmarketing'][$key]=$arr;
        
        foreach ($navs['newmarketing']['groups'][$key]['nodes'] as $k => $v){
            foreach ($new_node[$key]['groups'] as $kk => $vv){
                if($v['parma']['type']==$vv['type']){
                    foreach ($vv['nodes'] as $kkk => $vvv){
                        if(!IS_PRESELL&&$vvv['module']=='DealPresell'){
                            unset($vv['nodes'][$kkk]);
                        }elseif(!IS_PT&&$vvv['module']=='Pt'){
                            unset($vv['nodes'][$kkk]);
                        }else{
                            $vv['nodes'][$kkk]['url']=u($vvv['module']."/".$vvv['action'],$vvv['parma']);
                        }
                        
                    }
                    $navs['newmarketing']['groups'][$key]['nodes'][$k]['parma']['new_node']=$vv['nodes'];
                    
                }
            }
            
        }
        $this->assign("type",$type);
        $this->assign("menus",$navs['newmarketing']['groups']);
        $this->display();
    }
    function zy_shop_fx(){
        $map=array();
        $map['recommend_user_id']=array("GT",0);
        $map['supplier_id']=0;
        $map['buy_type']=0;
        $map['is_delete'] = 0;
        if (method_exists ( $this, '_filter' )) {
            $this->_filter ( $map );
        }
        $model = D ('deal');
        
        if (! empty ( $model )) {
            $this->_list ( $model, $map );
        }
        $this->display ();
        return;
    }
    function add_zy_shop_fx(){
	    $this->display();
    }
    
    public function load_seach_deal(){
        $param = array();
         
         
        if(strim($_REQUEST['name'])!='')
        {
            $param['name'] = strim($_REQUEST['name']);
            $map['name'] = array('like','%'.strim($_REQUEST['name']).'%');
        }
    
        $map['recommend_user_id']=array("eq",0);
        $map['supplier_id']=0;
        $map['buy_type']=0;
        $map['is_delete'] = 0;
         
    
        /*获取参数*/
        $page = intval($_REQUEST['p']); //分页
        $page=$page==0?1:$page;
         
        //分页
        $page_size = 5;
        $limit = (($page-1)*$page_size).",".$page_size;
         
         
        $model = D ('Deal');
        $voList = $model->where($map)->order('id desc')->limit($limit)->field('id,name')->findAll();
    
        $count = $model->where($map)->count();// 查询满足要求的总记录数
    
        //分页
        $page_total = ceil($count/$page_size);
    
        if($page_total>0){
            $page = new Page($count,$page_size);
            foreach($param as $key=>$val) {
                $page->parameter .= "$key=".urlencode($val).'&';
            }
            $p  =  $page->show();
             
            $this->assign('pages',$p);
        }
        $this->assign('vo',$voList);
        $this->display();
    }
    function add_zy_shop_fx_save(){
        $id=$_REQUEST['id'];
        $recommend_user_id=$_REQUEST['recommend_user_id'];
        $recommend_user_return_ratio=$_REQUEST['recommend_user_return_ratio'];
        if($id==''){
            $this->error("请选择商品");
        }
        if($recommend_user_id<=0){
            $this->error("请填写会员ID");
        }
        if($recommend_user_return_ratio<0||$recommend_user_return_ratio>100){
            $this->error("推荐会员返佣率在0~100");
        }
        $data['recommend_user_id']=$recommend_user_id;
        $data['recommend_user_return_ratio']=$recommend_user_return_ratio;
        $deal=M('deal')->where('id in'.'('.implode(',', $id).')')->save($data);
        if($deal){
            $this->success(L("UPDATE_SUCCESS"));
        }
        
    }
    function edit(){
        $id = $_REQUEST['id'];
        $model = D ('Deal');
        $voList = $model->where('id ='.$id)->field('id,recommend_user_id,recommend_user_return_ratio')->find();
        $this->assign('vo',$voList);
        $this->display();
    }
    function delete(){
        $id = $_REQUEST['id'];
        if($id==''){
            $this->error ("请选择商品");
        }else{
            $data['recommend_user_id']=0;
            $data['recommend_user_return_ratio']=0;
            $deal=M('deal')->where('id in'.'('. $id.')')->save($data);
            if($deal){
                $this->success(L("UPDATE_SUCCESS"));
            }else {
                $this->error (l("UPDATE_FAILED"));
            }
        }
    }
    function recommend_user_register(){
        $vo = M("Conf")->where('name = "INVITE_REFERRALS" or name = "INVITE_REFERRALS_TYPE" or name = "REFERRAL_LIMIT" or name = "REFERRALS_DELAY" or name = "REFERRAL_IP_LIMIT"')->findAll ();
        $arr=array();
        foreach($vo as $k=>$v){
            $arr[$v['name']]=$v['value'];
        }
        $this->assign ( 'vo', $arr );
        $this->assign("title_name","佣金设置");
        $this->display();
    }
    
    function recommend_user_register_save(){
        $conf_res=array();
        $conf_res['INVITE_REFERRALS']=$_REQUEST['INVITE_REFERRALS'];
        $conf_res['INVITE_REFERRALS_TYPE']=$_REQUEST['INVITE_REFERRALS_TYPE'];
        $conf_res['REFERRAL_LIMIT']=$_REQUEST['REFERRAL_LIMIT'];
        $conf_res['REFERRALS_DELAY']=$_REQUEST['REFERRALS_DELAY'];
        $conf_res['REFERRAL_IP_LIMIT']=$_REQUEST['REFERRAL_IP_LIMIT'];
        foreach($conf_res as $k=>$v)
        {
            conf($k,$v);
        }
        $this->_refreshConfFile();
        $this->success(L("UPDATE_SUCCESS"));
    }
    
    function new_user_gift(){
        $vo = M("Conf")->where('name = "USER_REGISTER_MONEY" or name = "USER_REGISTER_SCORE" or name = "USER_REGISTER_POINT"')->findAll ();
        $arr=array();
        foreach($vo as $k=>$v){
            $arr[$v['name']]=$v['value'];
        }
        logger::write(print_r($arr,1));
        $this->assign ( 'vo', $arr );
        $this->assign("title_name","新人礼");
        $this->display();
    }
    
    function new_user_gift_save(){
        $conf_res=array();
        $conf_res['USER_REGISTER_MONEY']=$_REQUEST['USER_REGISTER_MONEY'];
        $conf_res['USER_REGISTER_SCORE']=$_REQUEST['USER_REGISTER_SCORE'];
        $conf_res['USER_REGISTER_POINT']=$_REQUEST['USER_REGISTER_POINT'];
        foreach($conf_res as $k=>$v)
        {
            conf($k,$v);
        }
        $this->_refreshConfFile();
        $this->success(L("UPDATE_SUCCESS"));
    }
    
    function user_reward(){
        $vo = M("Conf")->where('name = "USER_LOGIN_MONEY" or name = "USER_LOGIN_SCORE" or name = "USER_LOGIN_POINT" or name = "USER_LOGIN_KEEP_MONEY" or name = "USER_LOGIN_KEEP_SCORE" or 
          name = "USER_LOGIN_KEEP_POINT" or name = "USER_ACTIVE_MONEY" or name = "USER_ACTIVE_SCORE"or name = "USER_ACTIVE_POINT"or name = "USER_ACTIVE_MONEY_MAX"or name = "USER_ACTIVE_SCORE_MAX"or name = "USER_ACTIVE_POINT_MAX"')->findAll ();
        $arr=array();
        foreach($vo as $k=>$v){
            $arr[$v['name']]=$v['value'];
        }
        $this->assign ( 'vo', $arr );
        $this->assign("title_name","会员奖励");
        $this->display();
    }
    function user_reward_save(){
        $conf_res=array();
        $conf_res['USER_LOGIN_MONEY']=$_REQUEST['USER_LOGIN_MONEY'];
        $conf_res['USER_LOGIN_SCORE']=$_REQUEST['USER_LOGIN_SCORE'];
        $conf_res['USER_LOGIN_POINT']=$_REQUEST['USER_LOGIN_POINT'];
        $conf_res['USER_LOGIN_KEEP_MONEY']=$_REQUEST['USER_LOGIN_KEEP_MONEY'];
        $conf_res['USER_LOGIN_KEEP_SCORE']=$_REQUEST['USER_LOGIN_KEEP_SCORE'];
        $conf_res['USER_LOGIN_KEEP_POINT']=$_REQUEST['USER_LOGIN_KEEP_POINT'];
        $conf_res['USER_ACTIVE_MONEY']=$_REQUEST['USER_ACTIVE_MONEY'];
        $conf_res['USER_ACTIVE_SCORE']=$_REQUEST['USER_ACTIVE_SCORE'];
        $conf_res['USER_ACTIVE_POINT']=$_REQUEST['USER_ACTIVE_POINT'];
        $conf_res['USER_ACTIVE_MONEY_MAX']=$_REQUEST['USER_ACTIVE_MONEY_MAX'];
        $conf_res['USER_ACTIVE_SCORE_MAX']=$_REQUEST['USER_ACTIVE_SCORE_MAX'];
        $conf_res['USER_ACTIVE_POINT_MAX']=$_REQUEST['USER_ACTIVE_POINT_MAX'];
        foreach($conf_res as $k=>$v)
        {
            conf($k,$v);
        }
        $this->_refreshConfFile();
        $this->success(L("UPDATE_SUCCESS"));
    }
    /**
     * @desc  根据conf表刷新配置文件
     * @author    吴庆祥
     */
    private function _refreshConfFile(){
        //开始写入配置文件
        $sys_configs = M("Conf")->findAll();
        $config_str = "<?php\n";
        $config_str .= "return array(\n";
        foreach($sys_configs as $k=>$v)
        {
            $config_str.="'".$v['name']."'=>'".addslashes($v['value'])."',\n";
        }
        $config_str.=");\n ?>";
        $filename = get_real_path()."public/sys_config.php";
    
        if (!$handle = fopen($filename, 'w')) {
            $this->error(l("OPEN_FILE_ERROR").$filename);
        }
    
    
        if (fwrite($handle, $config_str) === FALSE) {
            $this->error(l("WRITE_FILE_ERROR").$filename);
        }
    
        fclose($handle);
        save_log("更新营销模块设置",1);
    }
}
?>