<?php

/**
 * @desc
 * @author    吴庆祥
 * @since     2017-06-23 19:23
 */
class supplierApiModule extends MainBaseApiModule
{
    private $tabelNameAndComment = Array('sms_verify'=>'验证码','deal_cate_id'=>'所属分类','name' => '商家名称', 'cate_config' => '所属分类配置', 'location_config' => '所属地区商券配置', 'address' => '地址', 'tel' => '电话', 'open_time' => '营业时间', 'xpoint' => '经度', 'ypoint' => '纬度', 'location_id' => '认领的门店ID', 'is_publish' => '0:未审核 1:已审核 2:拒绝审核', 'user_id' => '入驻申请的会员ID', 'create_time' => '申请时间', 'h_name' => '企业名称', 'h_faren' => '法人', 'h_license' => '营业执照', 'h_other_license' => '其他资质上传', 'h_user_name' => '店铺管理员姓名', 'h_tel' => '存档的联系人电话', 'h_supplier_logo' => '商户商标图', 'h_supplier_image' => '门店图片', 'city_id' => '所在城市', 'h_bank_info' => '提现银行帐号', 'h_bank_user' => '提现银行户名', 'h_bank_name' => '提现银行名称', 'account_name' => '商户登录账户', 'account_password' => '登录密码', 'account_mobile' => '绑定手机号', 'agency_id' => '代理商ID', 'memo' => '拒绝申请说明', 'city_code' => '城市行政区划代码');
    private $needCheckField=Array("name","sms_verify","deal_cate_id","location_config","city_id","account_mobile","address","h_license","h_supplier_logo","h_supplier_image","h_bank_name","h_bank_user","h_bank_info");
    private $applyStatus=array(0=>"未申请过",1=>"您已经申请过无需认证",2=>"您已经是商家了",3=>"入驻驳回");
    public function index()
    {
        $root = array();
        $root['user_login_status'] = check_login();
        if (!$root['user_login_status']) return output($root, 0);

        $root['user_apply_supplier_status'] = $this->_searchUserApplySupplierStatus($GLOBALS['user_info']);
        $root['kf_phone'] = $GLOBALS['m_config']['kf_phone'];
        $root['app_ios_url'] = $GLOBALS['m_config']['ios_biz_down_url'];
        $root['app_android_url'] = $GLOBALS['m_config']['android_biz_filename'];
        $root['qrcode_url'] = url("biz","downapp");


        $root['page_title'] = "商家入驻";
		$root['entry_name_cssh_shop_title'] = $GLOBALS['m_config']['entry_name_cssh_shop_title'];
        return output($root);
    }

    /**
     * @desc
     * @author    吴庆祥
     * @param $user_info
     * @return int //0.未申请过 1.正在审核 2.入驻成功 3.入住驳回
     */
    private function _searchUserApplySupplierStatus($user_info)
    {
        $status = 0;
        if (!$user_info) return $status;
        if ($user_info['is_merchant']) {
            $status = 2;
        } else {
            $submit_info = $GLOBALS['db']->getRow("select * from " . DB_PREFIX . "supplier_submit where user_id={$user_info['id']} order by id desc");
            if (!$submit_info) {
                $status = 0;
            } else if ($submit_info['is_publish'] == 0) {
                $status = 1;
            } else if ($submit_info['is_publish'] == 2) {
                $status = 3;
            }
        }
        return $status;
    }

    public function register_add()
    {
        $root = array();
        $root['user_login_status'] = check_login();
        $root['user_apply_supplier_status'] = $this->_searchUserApplySupplierStatus($GLOBALS['user_info']);
        if (!$root['user_login_status']) return output($root, 0);
        $root['deal_cate'] = $this->_getDealCate();
        $root['province_list']=$this->_getProvinceList();
        $root['page_title']='入驻资料';
        return output($root, 1);
    }
    public function register_insert(){
        $root['user_login_status'] = check_login();
        if (!$root['user_login_status']) return output($root, 0);

        $applyStatus=$this->_searchUserApplySupplierStatus($GLOBALS['user_info']);
        if($root['user_apply_supplier_status']!=0)return output($root,0);

        $root['user_apply_supplier_status'] = $applyStatus;
        if($applyStatus){
            return output(array("jump"=>wap_url("index","supplier")),0,$this->applyStatus[$applyStatus]);
        }

        require_once APP_ROOT_PATH."/system/model/supplier.php";
        $params=$this->_initParams($GLOBALS['request']);
        unset($params['id']);

        $check_info=$this->_paramsIsEmpty($params);
        if(!$check_info['status'])return output("",0,$check_info['info']);

        $check_data = $this->_checkRegisterField($params);
        if(!$check_data['status'])return output("",0,$check_data['info']);

        $GLOBALS['db']->autoExecute(DB_PREFIX."supplier_submit",$params,'INSERT');
        $insert_id = $GLOBALS['db']->insert_id();

        if($insert_id){
            $GLOBALS['db']->query("delete from ".DB_PREFIX."sms_mobile_verify where mobile_phone = '".$params['account_mobile']."'");
            $data['status'] = 1;
            $data['info']	=	"申请成功，等待审核!";
            $data['jump'] = wap_url("index","supplier");
            return output($data,1,$data['info']);
        }else{
            $data['status'] = 0;
            $data['info']	=	"申请失败，请检查表单!";
            return output($data,0,$data['info']);
        }
    }
    public function register_update(){
        $root['user_login_status'] = check_login();
        if (!$root['user_login_status']) return output($root, 0);

        $applyStatus=$this->_searchUserApplySupplierStatus($GLOBALS['user_info']);
        $root['user_apply_supplier_status'] = $applyStatus;
        if($applyStatus!=3){
            return output(array("jump"=>wap_url("index","supplier")),0,$this->applyStatus[$applyStatus]);
        }

        require_once APP_ROOT_PATH."/system/model/supplier.php";
        $params=$this->_initParams($GLOBALS['request']);

        $check_info=$this->_paramsIsEmpty($params,array('id'));
        if(!$check_info['status'])return output("",0,$check_info['info']);

        $check_data = $this->_checkRegisterField($params);
        if(!$check_data['status'])return output("",0,$check_data['info']);
        $status=$GLOBALS['db']->autoExecute(DB_PREFIX."supplier_submit",$params,'UPDATE',"id={$params['id']} and user_id={$params['user_id']}");
        if($status){
            $data['status'] = 1;
            $data['info']	=	"更新成功，等待审核!";
            $data['jump'] = wap_url("index","supplier");
            return output($data,1,$data['info']);
        }else{
            $data['status'] = 0;
            $data['info']	=	"更新失败，请检查表单!";
            return output($data,0,$data['info']);
        }
    }
   public function register_view(){
       $root = array();
       $user_info=$GLOBALS['user_info'];
       $root['user_apply_supplier_status'] = $this->_searchUserApplySupplierStatus($GLOBALS['user_info']);
       if($root['user_apply_supplier_status']!=1)return output($root,0);

       $root['user_login_status'] = check_login();
       if (!$root['user_login_status']) return output($root, 0);

       $root['submit_info']=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."supplier_submit where user_id={$user_info['id']} order by id desc ");
       $areas=unserialize($root['submit_info']['location_config']);
       $root['submit_info']['area_id']=$areas?$areas[0]:0;
       $root['submit_info']['province_id']=$GLOBALS['db']->getOne("select pid from ".DB_PREFIX."deal_city where id={$root['submit_info']['city_id']}");
       $temp=$GLOBALS['db']->getCol("select name from ".DB_PREFIX."deal_city where id in({$root['submit_info']['province_id']},{$root['submit_info']['city_id']}) order by id");
       $temp[]=$GLOBALS['db']->getOne("select name from ".DB_PREFIX."area where id={$root['submit_info']['area_id']}");
       $root['submit_info']['city_address']=implode("",$temp);
       $root['submit_info']['h_license']=get_abs_img_root(get_spec_image($root['submit_info']['h_license'],200,200,1));
       $root['submit_info']['h_supplier_logo']=get_abs_img_root(get_spec_image($root['submit_info']['h_supplier_logo'],200,200,1));
       $root['submit_info']['h_supplier_image']=get_abs_img_root(get_spec_image($root['submit_info']['h_supplier_image'],200,200,1));
       $cate_config=unserialize($root['submit_info']['cate_config']);
       $root['submit_info']['cate_config']=$GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate where id={$cate_config['deal_cate_id']}");
       $root['page_title']='入驻资料';
       return output($root, 1);
   }

   private function _initParams($params){
       $user_info=$GLOBALS['user_info'];
       $params['account_mobile']=$params['mobile'];
       $params['location_id'] = 0;
       $params['create_time'] = NOW_TIME;
       $params['city_id'] = $params['region_lv3'];
       $params['account_password']=$user_info['user_pwd'];
       $params['user_id'] = $user_info['id'];
       $params['is_publish']=0;
       $params['tel'] = $user_info['mobile'];
       $params['h_tel'] = $user_info['mobile'];
       $params['account_name']=get_round_supplier_name();
       $params['h_user_name']= $user_info['user_name'];
       $params['location_config'] = serialize(array($params['region_lv4']));
       $params['cate_config'] = serialize(array('deal_cate_id'=>$params['deal_cate_id']));
       $params['city_code']=$GLOBALS['db']->getOne("select code from ".DB_PREFIX."deal_city where id=".$params['city_id']);
       $agency_id=$GLOBALS['db']->getOne("select id from ".DB_PREFIX."agency where city_code=".$params['city_code']);
       if($agency_id)
           $params['agency_id'] = $agency_id;
       return $params;
   }

    /**
     * @desc 检查入驻的一些字段
     * @author    吴庆祥
     * @param $params_data
     * @return array
     */
    private  function _checkRegisterField($params_data)
    {
        $data = array();
        $data['status'] = 1;
        $data['info'] = "";
        $sql = "DELETE FROM ".DB_PREFIX."sms_mobile_verify WHERE add_time <=".(NOW_TIME-SMS_EXPIRESPAN);
        $GLOBALS['db']->query($sql);
        $mobile_data = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."sms_mobile_verify where mobile_phone = '".$params_data['account_mobile']."'");
        if(!$params_data['sms_verify']||$mobile_data['code']!=$params_data['sms_verify'])
        {
            $data['status'] = 0;
            $data['info'] = "验证码错误";
            return $data;
        }
        if(!check_mobile($params_data['account_mobile']))
        {
            $data['status'] = 0;
            $data['info'] = "手机号格式不正确";
            return $data;
        }
        return $data;
    }

    /**
     * @desc 检查一些字段是否为空
     * @author    吴庆祥
     * @param $param
     * @param array $other_check_field
     * @return mixed
     */
    private function _paramsIsEmpty($param,$other_check_field=array()){
        $data['status']=1;
        $nameAndComment=$this->tabelNameAndComment;
        $needCheckField=array_merge($this->needCheckField,$other_check_field);
        foreach($needCheckField as $value){
            if(!isset($param[$value])){
                if(!$nameAndComment[$value]){
                    $info=$value;
                }else{
                    $info=$nameAndComment[$value];
                }
                $data['status']=0;
                $data['info']=$info."不能为空！";
                break;
            }
        }
        return $data;
    }
    private function _getProvinceList(){
        $provinceList=$GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."deal_city where pid=0");
        return $provinceList;
    }
    public function register_edit()
    {
        $root = array();
        $user_info=$GLOBALS['user_info'];
        $root['user_login_status'] = check_login();
        if (!$root['user_login_status']) return output($root, 0);

        $root['user_apply_supplier_status'] = $this->_searchUserApplySupplierStatus($GLOBALS['user_info']);
        if($root['user_apply_supplier_status']!=3)return output($root,0);

        $root['submit_info']=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."supplier_submit where user_id={$user_info['id']} order by id desc ");
        $areas=unserialize($root['submit_info']['location_config']);
        $root['submit_info']['area_id']=$areas?$areas[0]:0;
        $root['submit_info']['province_id']=$GLOBALS['db']->getOne("select pid from ".DB_PREFIX."deal_city where id={$root['submit_info']['city_id']}");
        $root['province_list']=$this->_getProvinceList();
        $root['city_list']=$this->_getCityListByProvinceId($root['submit_info']['province_id']);
        $root['area_list']=$this->_getAreaListByCityId(intval($root['submit_info']['city_id']));
        $root['submit_info']['h_license_ab']=get_abs_img_root(get_spec_image($root['submit_info']['h_license'],200,200,1));
        $root['submit_info']['h_supplier_logo_ab']=get_abs_img_root(get_spec_image($root['submit_info']['h_supplier_logo'],200,200,1));
        $root['submit_info']['h_supplier_image_ab']=get_abs_img_root(get_spec_image($root['submit_info']['h_supplier_image'],200,200,1));
        $root['deal_cate'] = $this->_getDealCate();
        $cate_config=unserialize($root['submit_info']['cate_config']);
        $root['submit_info']['cate_config']=$cate_config;
        $root['submit_info']['cate_config_name']=$GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate where id={$cate_config['deal_cate_id']}");
        $root['page_title']='入驻资料';
        return output($root, 1);
    }
    private function _getCityListByProvinceId($id){
        $id=intval($id);
        $cityList=$GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."deal_city where pid ={$id}");
        return $cityList;
    }
    private function _getAreaListByCityId($id){
        $id=intval($id);
        $areaList=$GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."area where city_id ={$id} and pid=0");
        return $areaList;
    }
    private function _getDealCate()
    {

        $cate_list = $GLOBALS['db']->getAll("select id,name from " . DB_PREFIX . "deal_cate where is_effect = 1 and is_delete = 0 order by sort desc");
        return $cate_list;
    }
}