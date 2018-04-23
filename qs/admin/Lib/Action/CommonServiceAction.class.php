<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class CommonServiceAction extends CommonAction{
	public $page = 1;
	private $img_info = '建议尺寸：640 x 640 像素，最多可上传8张图片。首张为列表缩列图，您可以拖拽图片调整图片顺序。';
	
	public function __construct(){
	    parent::__construct();
        if(!IS_VISITING_SERVICE){
            $this->error (l("请先开启上门服务功能"),0);
        }
		
		if(isset($_REQUEST['page'])){
			$this->page = max(1,(int)$_REQUEST['page']);
		}
		if(isset($_REQUEST['isajax'])){
			$this->isajax = (int)$_REQUEST['isajax'] > 0 ? 1 : 0;
		}
		if(isset($_REQUEST['page'])){
			$this->page = max(1,(int)$_REQUEST['page']);
		}
		
		$this->assign('img_info',$this->img_info);
		$this->assign('pager_num_now',$this->page);
	}
	
	public function index()
	{
		//分类
		$cate_tree = M("ServiceCate")->where('is_delete = 0')->findAll();
		$cate_tree = D("ServiceCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);
		
		//开始加载搜索条件
		if(intval($_REQUEST['id'])>0)
		$map['id'] = intval($_REQUEST['id']);
		$map['is_delete'] = 0;
		if(strim($_REQUEST['name'])!='')
		{
			$map['name'] = array('like','%'.strim($_REQUEST['name']).'%');			
		}
		
		$map['_string']=" 1=1 ";
		
		if(intval($_REQUEST['cate_id'])>0)
		{
		    $cate_name=$GLOBALS['db']->getOne("select name from ".DB_PREFIX ."service_cate where id =".intval($_REQUEST['cate_id']));
		    $map['_string'].=" and FIND_IN_SET('$cate_name',cate_match_row) ";
		}
		$this->assign("cate_id",$_REQUEST['cate_id']);
		
        //商品状态:出售中0，已下架1
         //商品状态:出售中0，已下架1
        $status=intval($_REQUEST['status']);
        if($status==0){
            $map['is_effect']=1;
            $map['begin_time']=array("elt",NOW_TIME);
            $map['end_time']=array(array("egt",NOW_TIME),array("eq",0),"or");
        }
        else if($status==1){
            $map['_string'].=" and is_effect=0 or (is_effect=1 and ((begin_time>".NOW_TIME." and begin_time>0) or (end_time<".NOW_TIME." and end_time>0)))";
        }
        $this->assign("status",$status);
        
        
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = M ($name);
		
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	
	public function add()
	{
		$cate_tree = M("ServiceCate")->where('is_delete = 0 and pid = 0')->findAll();
		$cate_tree = D("ServiceCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);
		$this->assign("new_sort", M("CommonService")->where("is_delete=0")->max("sort")+1);
		
		$user_group = M("UserGroup")->order("score asc")->findAll();
		$this->assign("user_group",json_encode($user_group));
		
		$tag=M("ServiceTag")->where("is_delete=0 and is_effect=1")->findAll();
		
		$this->assign("tag",$tag);
		
		$this->assign("img_index",0);
		$this->display();
	}

	public function insert() {
		B('FilterString');
		$ajax = intval($_REQUEST['ajax']);
		$data = M(MODULE_NAME)->create ();
		
		//开始验证有效性
		
		if(empty($_REQUEST['img'])){
		    $this->error("请添加至少一张的服务图片");
		}
		
		if(intval($_REQUEST['continue_add'])==1){
		    $this->assign("jumpUrl",u(MODULE_NAME."/add"));
		}else{
		    $this->assign("jumpUrl",u(MODULE_NAME."/index"));
		}
		
		if($data['current_price']<0)
		{
		    $this->error("销售价不能为负数");
		}
			
		if($data['origin_price']<0)
		{
		    $this->error("原价不能为负数");
		}
		
		if($data['origin_price']<$data['current_price'])
		{
		    $this->error("原价不能小于销售价");
		}
		
		if($data['balance_price'] > $data['current_price'])
		{
		    $this->error("结算价不能高于销售价");
		}
		
		if(!check_empty($data['name']))
		{
			$this->error("请填写服务名称");
		}	
		
		if($_REQUEST['cate_id']=='')
		{
			$this->error("请选择服务分类");
		}
		
		if(intval($data['subscription'])>$data['current_price']){
		    $this->error("定金不能超过服务金额");
		}
		
		// 更新数据
		if($_REQUEST['tag_id'])
	       $data['tag_id']=implode(",", $_REQUEST['tag_id']);
	    $data['is_effect']=1;
	    
	    $data['subscription']=intval($data['subscription']);
	    $data['name']=strim($data['name']);
	    $data['service_balance_rate']=$data['service_balance_rate']/100;
	    $data['begin_time']=strim($_REQUEST['begin_time'])==''?0:to_timespan($_REQUEST['begin_time']);
	    $data['end_time']=strim($_REQUEST['end_time'])==''?0:to_timespan($_REQUEST['end_time']);

		$list=M(MODULE_NAME)->add($data);
	    
		// 更新数据
		if ($list != false) {
		    $id=$list;
		    
		    $GLOBALS['db']->query("delete from ".DB_PREFIX."common_service_img where common_service_id = ".$id." and supplier_service_id=0");
		    
		    foreach ($_REQUEST['img'] as $t => $v){
		        if($t ==  0){
		            $img_data['is_main']=1;
		        }else{
		            $img_data['is_main']=0;
		        }
		        $img_data['img']=$v;
		        $img_data['common_service_id']=$id;
		        
		        M('CommonServiceImg')->add($img_data);
		    }
		    
		    $cate =array();
		    $cate_id_arr = explode(",",$data['cate_id']);
		    foreach ($cate_id_arr as $k=>$v){
		        get_all_parent_id(intval($v),DB_PREFIX."service_cate",$cate);
		    }
		    
		    if(count($cate)>0)
		    {
		        $cates = $GLOBALS['db']->getAll("select name from ".DB_PREFIX."service_cate where id in (".implode(",",$cate).")");
		        foreach ($cates as $row)
		        {
		            insert_match_item(trim($row['name']),"common_service",$id,"cate_match");
		        }
		    }
		    
			save_log($_REQUEST['name'].L("INSERT_SUCCESS"),1);
			$this->success(L("INSERT_SUCCESS"));
		} else {
			//错误提示
			save_log($_REQUEST['name'].L("INSERT_FAILED"),0);
			$this->error(L("INSERT_FAILED"));
		}
	}	
	
	public function edit() {
		$id = intval($_REQUEST ['id']);
		$condition['is_delete'] = 0;
		$condition['id'] = $id;		
		$vo = M(MODULE_NAME)->where($condition)->find();
		$vo['begin_time'] = $vo['begin_time']!=0?to_date($vo['begin_time']):'';
		$vo['end_time'] = $vo['end_time']!=0?to_date($vo['end_time']):'';
	    $vo['service_balance_rate'] =  $vo['service_balance_rate'] *100;
		
		$cate_tree = M("ServiceCate")->where('is_delete = 0 and pid=0')->findAll();		
		$this->assign("cate_tree",$cate_tree);
		
		$cate1=M("ServiceCate");
		$name1=$cate1->where('id in ('.$vo['cate_id'].')')->findAll();
		
		foreach ($name1 as $k=>$v){
		    if($v['pid'] > 0){
		        $first_cate = $cate1->where(array('id'=>$v['pid']))->find();
		        $name1[$k]['first_cate'] = $first_cate['name'];
		    }else{
		        $name1[$k]['first_cate']='';
		    }
		}
		$this->assign("shop_cate",$name1);
		
		$tag=M("ServiceTag")->where("is_delete=0 and is_effect=1")->findAll();
		$check_tag=explode(",", $vo['tag_id']);
		foreach ($tag as $t => $v){
		    if(in_array($v['id'], $check_tag)){
		        $tag[$t]['is_checked']=1;
		    }
		}
		$this->assign("tag",$tag);
		
		$user_group = M("UserGroup")->order("score asc")->findAll();
		$this->assign("user_group",json_encode($user_group));
		
		//输出图片集
		$img_list = M("CommonServiceImg")->where("common_service_id=".$vo['id']." and supplier_service_id=0")->order("is_main desc")->findAll();
		$imgs=array();
		foreach ($img_list as $v){
		    $imgs[]=$v['img'];
		}
		$this->assign("img_list",$imgs);
		$this->assign("img_index",count($imgs));
		
		$this->assign("vo",$vo);

		$this->display ();
	}
	
	public function update() {
	    B('FilterString');
	    $ajax = intval($_REQUEST['ajax']);
	    $data = M(MODULE_NAME)->create ();
	    
	    //开始验证有效性
	    
	    if(empty($_REQUEST['img'])){
	        $this->error("请添加至少一张的服务图片");
	    }
	    
	    if($data['current_price']<0)
	    {
	        $this->error("销售价不能为负数");
	    }
	    	
	    if($data['origin_price']<0)
	    {
	        $this->error("原价不能为负数");
	    }
	    
	    if($data['origin_price']<$data['current_price'])
	    {
	        $this->error("原价不能小于销售价");
	    }
	    
	    if($data['balance_price'] > $data['current_price'])
	    {
	        $this->error("结算价不能高于销售价");
	    }
	    
	    if(!check_empty($data['name']))
	    {
	        $this->error(L("请填写服务名称"));
	    }
	    
	    if($_REQUEST['cate_id']=='')
	    {
	        $this->error(L("请选择服务分类"));
	    }
	    
	    if(intval($data['subscription'])>$data['current_price']){
	        $this->error("定金不能超过服务金额");
	    }
	    
	    // 更新数据
	    if($_REQUEST['tag_id'])
	        $data['tag_id']=implode(",", $_REQUEST['tag_id']);
	    $data['is_effect']=1;
	     
	    $data['subscription']=intval($data['subscription']);
	    $data['name']=strim($data['name']);
	    $data['service_balance_rate']=$data['service_balance_rate']/100;
	    $data['begin_time']=strim($_REQUEST['begin_time'])==''?0:to_timespan($_REQUEST['begin_time']);
	    $data['end_time']=strim($_REQUEST['end_time'])==''?0:to_timespan($_REQUEST['end_time']);
	    
	    $list=M(MODULE_NAME)->save($data);
	     
	    // 更新数据
	    /* if ($list != false) { */
	        $id=$data['id'];
	    
	        $GLOBALS['db']->query("delete from ".DB_PREFIX."common_service_img where common_service_id = ".$id." and supplier_service_id=0");
	    
	        foreach ($_REQUEST['img'] as $t => $v){
	            if($t ==  0){
	                $img_data['is_main']=1;
	            }else{
	                $img_data['is_main']=0;
	            }
	            $img_data['img']=$v;
	            $img_data['common_service_id']=$id;
	    
	            M('CommonServiceImg')->add($img_data);
	        }
	    
	        $cate =array();
	        $cate_id_arr = explode(",",$data['cate_id']);
	        foreach ($cate_id_arr as $k=>$v){
	            get_all_parent_id(intval($v),DB_PREFIX."service_cate",$cate);
	        }
	    
	        if(count($cate)>0)
	        {
	            $cates = $GLOBALS['db']->getAll("select name from ".DB_PREFIX."service_cate where id in (".implode(",",$cate).")");
	            foreach ($cates as $row)
	            {
	                insert_match_item(trim($row['name']),"common_service",$id,"cate_match");
	            }
	        }
	    
	        save_log($_REQUEST['name'].L("UPDATE_SUCCESS"),1);
	        $this->success(L("UPDATE_SUCCESS"));
	    /* } else {
	        //错误提示
	        save_log($_REQUEST['name'].L("UPDATE_FAILED"),0);
	        $this->error(L("UPDATE_FAILED"));
	    } */
	}
	
	public function delete() {
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
				//删除的验证
				if(M("DealOrder")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->count()>0)
				{
					$this->error(l("DEAL_ORDER_NOT_EMPTY"),$ajax);
				}
				M("CommonServiceImg")->where(array ('common_service_id' => array ('in', explode ( ',', $id ) ),"supplier_service_id"=>0 ))->delete();
				
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['name'];	
					 
					 
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->delete();	
					
				if ($list!==false) {

					save_log($info.l("FOREVER_DELETE_SUCCESS"),1);
					$this->success (l("DELETE_SUCCESS"),$ajax);
				} else {
					save_log($info.l("FOREVER_DELETE_FAILED"),0);
					$this->error (l("DELETE_FAILED"),$ajax);
				}
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}
	}
	
	public function set_sort()
	{
		$id = intval($_REQUEST['id']);
		$sort = intval($_REQUEST['sort']);
		$log_info = M(MODULE_NAME)->where("id=".$id)->getField('name');
		if(!check_sort($sort))
		{
			$this->error(l("SORT_FAILED"),1);
		}
		M(MODULE_NAME)->where("id=".$id)->setField("sort",$sort);
		 
		save_log($log_info.l("SORT_SUCCESS"),1);
		$this->success(l("SORT_SUCCESS"),1);
	}
	/** 
	public function set_effect()
	{
		$id = intval($_REQUEST['id']);
		$ajax = intval($_REQUEST['ajax']);
		$info = M(MODULE_NAME)->where("id=".$id)->getField("name");
		$c_is_effect = M(MODULE_NAME)->where("id=".$id)->getField("is_effect");  //当前状态
		$n_is_effect = $c_is_effect == 0 ? 1 : 0; //需设置的状态
		M(MODULE_NAME)->where("id in({$id})")->save(array("is_effect"=>$n_is_effect,"update_time"=>NOW_TIME));
		save_log($info.l("SET_EFFECT_".$n_is_effect),1);
		 
		$locations = M("DealLocationLink")->where(array ('deal_id' => $id ))->findAll();
					foreach($locations as $location)
					{
						recount_supplier_data_count($location['location_id'],"daijin");
						recount_supplier_data_count($location['location_id'],"tuan");
					}
		$this->ajaxReturn($n_is_effect,l("SET_EFFECT_".$n_is_effect),1)	;	
	}
	 */
	/**
	 * 上架申请（二次上架）
	 */
	public function deal_upline(){
	    $ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
			$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
			
			$list=M(MODULE_NAME)->where($condition)->save(array("is_effect"=>1));
			
			$rel_data = M(MODULE_NAME)->where($condition)->findAll();
			foreach($rel_data as $data)
			{
			    $info[] = $data['name'];
			}
			
			if ($list!==false) {
                save_log($info."上架架成功",1);
			    $this->success ("上架成功",$ajax);
			} else {
			    save_log($info."上架失败",0);
			    $this->error ("上架失败",$ajax);
			}
			
		}
		else{
		    $this->error("请选择上架的商品");
		}
	}
	/**
	 * 下架申请
	 */
	public function deal_downline(){
	    $ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
			$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
			
			$list=M(MODULE_NAME)->where($condition)->save(array("is_effect"=>0));
			
			$rel_data = M(MODULE_NAME)->where($condition)->findAll();
			foreach($rel_data as $data)
			{
			    $info[] = $data['name'];
			}
			
			if ($list!==false) {
                save_log($info."下架成功",1);
			    $this->success ("下架成功",$ajax);
			} else {
			    save_log($info."下架失败",0);
			    $this->error ("下架失败",$ajax);
			}
			
		}
		else{
		    $this->error("请选择上架的商品");
		}
	}

    
     public function syn_second_cate(){
         
         $cate_id=intval($_REQUEST['cate_id']);

         $cate=M("ServiceCate");
         $sub_cate_tree=$cate->where(array("pid"=>$cate_id,'is_delete'=>0,'is_effect'=>1))->findAll();
       
         $this->assign("sub_cate_tree",$sub_cate_tree);
         $this->display();
         
     }
     
}