<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class X_MZtAction extends CommonAction{
	

    
	public function index()
	{
	    $model = M('MZt');
	    $map['z_type'] = 1;
	    if (!empty($model)) {
	        $this->_list($model, $map);
	    }
	
	    $this->display();
	}
	
	
	public function add()
	{
		
		$nav_cfg = $GLOBALS['mobile_cfg'];
		$this->assign("nav_cfg",$nav_cfg);
		
		foreach($nav_cfg as $k=>$v)
		{
			if($v['mobile_type']==0)
			{
				$this->assign("nav_list",$v['nav']);
			}
		}	

		$this->assign("new_sort",intval(M('MZt')->max("sort"))+1);
		$city_list = M("DealCity")->where('is_delete = 0')->findAll();
		$city_list = D("DealCity")->toFormatTree($city_list,'name');
		foreach($city_list as $k=>$v)
		{
			if($v['pid']==0)$city_list[$k]['id'] = 0;
		}
		$this->assign("city_list",$city_list);
		$zt_id=rand(10000000,90000000);
		$this->assign("zt_id",$zt_id);

		$this->display();
	}
	
	public function insert() {
		B('FilterString');
		$ajax = intval($_REQUEST['ajax']);
		$nav_cfg = $GLOBALS['mobile_cfg'];	
		
		$data = M('MZt')->create ();
		
		foreach($nav_cfg as $k=>$v)
		{
			if($v['mobile_type']==$data['mobile_type'])
			{
				$navs = $v['nav'];
			}
		}
		
		foreach($navs as $ctl=>$v)
		{
			if($v['type']==$data['type'])
			{
				$data['ctl'] = $ctl;				
				$cfg = array($v['field']=>$_POST[$v['field']]);				
				$data['data'] = serialize($cfg);
			}
		}
			
		//开始验证有效性
		$this->assign("jumpUrl",u(MODULE_NAME."/add"));
		if(!check_empty($data['name']))
		{
			$this->error(L("NAME_EMPTY_TIP"));
		}	
		
		if($_REQUEST['page']){
			$data['page'] = implode(",",$_REQUEST['page']);
		}
		
		$data['z_type'] = 1;

		$log_info = $data['name'];
		$list=M('MZt')->add($data);
		if (false !== $list) {
			//成功提示
			save_log($log_info.L("INSERT_SUCCESS"),1);

			M('MAdv')->where(array('zt_id'=>$_REQUEST['rid']))->save(array('zt_id'=>$list));
			
			$this->success(L("INSERT_SUCCESS"));
			
		} else {
			//错误提示
			save_log($log_info.L("INSERT_FAILED"),0);
			$this->error(L("INSERT_FAILED"));
		}
	}

	
	
	public function edit()
	{
		$nav_cfg = $GLOBALS['mobile_cfg'];
		$this->assign("nav_cfg",$nav_cfg);
		
		$id = intval($_REQUEST['id']);
		$vo = M("MZt")->getById($id);
		$page = explode(",",$vo['page']);
		$page_arr=array();
		if($page){
		    foreach($page as $k=>$v){
		        $page_arr[$v]=$v;
		    }
		}

		$this->assign ('page', $page_arr);
		$vo['data'] = unserialize($vo['data']);
		
		$this->assign ('vo', $vo);
		$city_list = M("DealCity")->where('is_delete = 0')->findAll();
		$city_list = D("DealCity")->toFormatTree($city_list,'name');
		foreach($city_list as $k=>$v)
		{
			if($v['pid']==0)$city_list[$k]['id'] = 0;
		}
		$this->assign("city_list",$city_list);
		
		
		foreach($nav_cfg as $k=>$v)
		{
			if($v['mobile_type']==$vo['mobile_type'])
				$this->assign("nav_list",$v['nav']);
		}
		
        $sql = " select * from ".DB_PREFIX."m_adv where zt_id = ".$vo['id'];
        $zt_layout_list = $GLOBALS['db']->getAll($sql);
        $data_zt = array();
        if($zt_layout_list){
            foreach($zt_layout_list as $k=>$v){
                $data_adv = unserialize($v['data']);
                $data_unit = array();
                $data_unit['type'] = $v['type'];
            
                foreach($data_adv as $kk=>$vv){
                    $data_unit['ctl_name'] = $kk;
                    $data_unit['ctl_value'] = $vv;
                }
                $data_zt[$v['zt_position']] = $data_unit;
            }
            $this->assign("data_zt",$data_zt);
        }


		
		$this->display();
	}
	
	
	public function update() {
		B('FilterString');

		$nav_cfg = $GLOBALS['mobile_cfg'];
	
		$data = M('MZt')->create ();
		
		foreach($nav_cfg as $k=>$v)
		{
			if($v['mobile_type']==$data['mobile_type'])
			{
				$navs = $v['nav'];
			}
		}
		
		foreach($navs as $ctl=>$v)
		{
			if($v['type']==$data['type'])
			{
				$data['ctl'] = $ctl;
				$cfg = array($v['field']=>$_POST[$v['field']]);
				$data['data'] = serialize($cfg);
			}
		}

		$data['page'] = implode(",",$_REQUEST['page']);
		$log_info = $data['id'];
		
		//开始验证有效性
		$this->assign("jumpUrl",u(MODULE_NAME."/edit",array("id"=>$data['id'])));
		if(!check_empty($data['name']))
		{
			$this->error(L("NAME_EMPTY_TIP"));
		}
		$data['z_type'] = 1;
		$log_info = $data['name'];
		$list=M('MZt')->save ($data);
		if (false !== $list) {
			//成功提示
			save_log($log_info.L("UPDATE_SUCCESS"),1);
			$this->success(L("UPDATE_SUCCESS"));
		} else {
			//错误提示
			save_log($log_info.L("UPDATE_FAILED"),0);
			$this->error(L("UPDATE_FAILED"),0,$log_info.L("UPDATE_FAILED"));
		}
	}
	
	
	public function foreverdelete() {
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );	
				foreach($rel_data as $data)
				{
					$info[] = $data['id'];	
				}
				if($info) $info = implode(",",$info);
				$list = M('MZt')->where ( $condition )->delete();	
		
				if ($list!==false) {
					$ztcondition = array ('zt_id' => array ('in', explode ( ',', $id ) ) );
					M("MAdv")->where($ztcondition)->delete();
					save_log($info.l("FOREVER_DELETE_SUCCESS"),1);
					$this->success (l("FOREVER_DELETE_SUCCESS"),$ajax);
				} else {
					save_log($info.l("FOREVER_DELETE_FAILED"),0);
					$this->error (l("FOREVER_DELETE_FAILED"),$ajax);
				}
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}
	}
	
	public function set_sort()
	{
		$id = intval($_REQUEST['id']);
		$sort = intval($_REQUEST['sort']);
		$log_info = M('MZt')->where("id=".$id)->getField("name");
		if(!check_sort($sort))
		{
			$this->error(l("SORT_FAILED"),1);
		}
		M('MZt')->where("id=".$id)->setField("sort",$sort);
		save_log($log_info.l("SORT_SUCCESS"),1);
		$this->success(l("SORT_SUCCESS"),1);
	}

    public function set_zt_html()
    {

        $zt_id = intval($_REQUEST['zt_id']);
        $pic_count = intval($_REQUEST['pic_count']);
        if($zt_id > 0){
            $zt_data = M("MAdv")->where('zt_id='.$zt_id)->findAll();
            foreach($zt_data as $k=>$v){
                $zt_data[$k]['data']=unserialize($v['data']);
            }   
        }

        
        
        $this->assign("pic_count",$pic_count);
        $width = round( 100/$pic_count,2)."%";
        $this->assign("width",$width);
        $this->display();

        
        

    }
    
    

    public function iframe_box()
    {

        $zt_img = strim($_REQUEST['zt_img']);
        $mobile_type = strim($_REQUEST['mobile_type']);
        $type = intval($_REQUEST['type']);
        $ctl_name = strim($_REQUEST['ctl_name']);
        $ctl_value = strim($_REQUEST['ctl_value']);
        $zt_img_pic = strim($_REQUEST['zt_img_pic']);

        $parma=array('zt_img'=>$zt_img,
            'mobile_type'=>$mobile_type,'type'=>$type,
            'ctl_name'=>$ctl_name,'ctl_value'=>$ctl_value,
            'zt_img_pic'=>$zt_img_pic,
        );

        $url=U('X_MZt/open_zt_box',$parma);
        $this->assign("url",$url);
        $this->display();

    }

    public function open_zt_box()
    {

        $zt_img = strim($_REQUEST['zt_img']);
        $type = intval($_REQUEST['type']);

        $ctl_name = strim($_REQUEST['ctl_name']);
        $ctl_value = strim($_REQUEST['ctl_value']);
        $zt_img_pic = strim($_REQUEST['zt_img_pic']);
        $nav_cfg = $GLOBALS['mobile_cfg'];
        $nav_cfg=get_mobile_cfg($nav_cfg,2);
        $this->assign("nav_cfg",$nav_cfg);
        $mobile_type = intval($_REQUEST['mobile_type']);
        //$id = intval($_REQUEST['id']);
        foreach($nav_cfg as $k=>$v)
        {
            if($v['mobile_type']==$mobile_type)
                $this->assign("nav_list",$v['nav']);
        }
         
        $this->assign("mobile_type",$mobile_type);
        $this->assign("type",$type);
        $this->assign("ctl_name",$ctl_name);
        $data=array($ctl_name=>$ctl_value);
        $this->assign("ctl_value",$ctl_value);
        $this->assign("zt_img_pic",$zt_img_pic);
        $this->assign("zt_img",$zt_img);
        $this->assign("data",$data);

        $this->display();

    }
    

    public function zt_img_upload() {
        B('FilterString');
    
        $nav_cfg = $GLOBALS['mobile_cfg'];

        $data = M('MAdv')->create();
        $data['name'] = $data['zt_position'];

        
        
        if($data['img']=="")
        {
            $result['status']=0;
            $result['info']='未上传图片';
            ajax_return($result);
            
        }
        foreach($nav_cfg as $k=>$v)
        {
            if($v['mobile_type']==$data['mobile_type'])
            {
                $navs = $v['nav'];
            }
        }
    
        foreach($navs as $ctl=>$v)
        {
            if($v['type']==$data['type'])
            {
                $data['ctl'] = $ctl;
                $cfg = array($v['field']=>$_REQUEST[$v['field']]);
                $data['data'] = serialize($cfg);
            }
        }
        $data['status']=1;
        $data['position']=2;
        $old_data = M('MAdv')->where(array('zt_id'=>$data['zt_id'],'zt_position'=>$data['zt_position']))->find();

        if($old_data){
            $data['id']=$old_data['id'];
            $list=M('MAdv')->save ($data);
        }else{
            $list=M('MAdv')->add($data);
        }
    
        $log_info = $data['id'];
        $log_info = $data['name'];
       
        if (false !== $list) {
            //成功提示
            save_log($log_info.L("UPDATE_SUCCESS"),1);

        } else {
            //错误提示
            save_log($log_info.L("UPDATE_FAILED"),0);

        }
        $result['status']=1;
        $result['info']='上传图片成功';
        ajax_return($result);
    }

}
?>