<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class SupplierVisitingServicesAction extends CommonAction{
	public function index()
	{
		$page_idx = intval($_REQUEST['p'])==0?1:intval($_REQUEST['p']);
		$page_size = C('PAGE_LISTROWS');
		$limit = (($page_idx-1)*$page_size).",".$page_size;
		
		if (isset ( $_REQUEST ['_order'] )) {
			$order = $_REQUEST ['_order'];
		}

		$ex_condition = 'is_delete=0 ';

		if (isset($_REQUEST['is_effect'])) {
			$is_effect = intval($_REQUEST['is_effect']);
		} else {
			$is_effect = 1;
		}
		$this->assign('is_effect', $is_effect);
		$ex_condition .= ' and is_effect='.$is_effect;
		
		$supplier_id = intval($_REQUEST['supplier_id']);
		if ($supplier_id) {
			$this->assign('supplier_id', $supplier_id);
			$ex_condition .= " and supplier_id = ".$supplier_id." ";
		}

		
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset ( $_REQUEST ['_sort'] )) {
			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
		} else {
			$sort = 'desc';
		}
	    if(isset($order))
	    {
	    	$orderby = $order." ".$sort;
	    }else 
	    {
	    	 $orderby = "id desc ";
	    }

	    $cate_tree = M("ServiceCate")->where('is_delete = 0')->findAll();
		$cate_tree = D("ServiceCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);

	    if (intval($_REQUEST['cate_id'])) {
	    	$cate_name=$GLOBALS['db']->getOne("select name from ".DB_PREFIX ."service_cate where id =".intval($_REQUEST['cate_id']));
		    $ex_condition .= " and FIND_IN_SET('$cate_name',cate_match_row)";
	    }

	    if (strim($_REQUEST['service_key'])) {
	    	$ex_condition .= ' and name like "%'.strim($_REQUEST['service_key']).'%"';
	    }

	    if (strim($_REQUEST['supplier_key'])) {
	    	$ex_condition .= ' and supplier_name like "%'.strim($_REQUEST['supplier_key']).'%"';
	    }

	    $status = intval($_REQUEST['status']);
	    if ($status == 0) {
	    	$ex_condition .= ' and (begin_time <= '.NOW_TIME.' and ( end_time = 0 or end_time > '.NOW_TIME.'))';
	    } elseif ($status == 1) {
	    	$ex_condition .= ' and end_time < '.NOW_TIME.' and end_time > 0';
	    }

	    $total = M(MODULE_NAME)->where($ex_condition)->count();
	    // print_r(M(MODULE_NAME)->getLastSql());exit;
	    $list = M(MODULE_NAME)->where($ex_condition)->limit($limit)->order($orderby)->findAll();
		// print_r(M(MODULE_NAME)->getLastSql());

		$p = new Page ( $total, '' );
		$page = $p->show ();
		
		$sortImg = $sort; //排序图标
		$sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
		$sort = $sort == 'desc' ? 1 : 0; //排序方式
			//模板赋值显示
		$this->assign ( 'sort', $sort );
		$this->assign ( 'order', $order );
		$this->assign ( 'sortImg', $sortImg );
		$this->assign ( 'sortType', $sortAlt );
			
		$this->assign ( 'list', $list );
		$this->assign ( "page", $page );
		$this->assign ( "nowPage",$p->nowPage);
			
		$this->display ();
		return;
	}
	public function add()
	{	
		if (isset($_REQUEST['supplier_id'])) {
			$supplier_id = intval($_REQUEST['supplier_id']);
			$supplier_info = M('Supplier')->where(array('id'=>$supplier_id))->field('id,name')->find();
			$this->assign('supplier_id', $supplier_info['id']);
			$this->assign('supplier_info', $supplier_info);
		}

		
		$this->assign("new_sort", M(MODULE_NAME)->max("sort")+1);
		
		$this->display();
	}


	public function insert() 
	{
		/**
		 * 都是根据服务id的模板直接新增到商户的服务库，
		 * 都是先直接把默认的数据套出来。以下略有区别
		 * 如果是标准服务，服务id应该是唯一的，
		 * 如果是自定义服务，可以随意修改，服务id暂时不做唯一判断，服务的图片库要复制一份商户的
		 * 
		 */

		// 商户id
		$supplier_id = intval($_REQUEST['supplier_id']);
		if ($supplier_id <= 0) {
			$this->error('请选择商户');
		}

		$supplier_info = M('Supplier')->where(array('id' => $supplier_id))->field('id, name,publish_verify_balance')->find();
		if (empty($supplier_info)) {
			$this->error('商户不存在');
		}

		$location_id = $_REQUEST['location_id'];
		$location_id = array_map(function($id){return intval($id);}, $location_id);
		$location_id = array_filter($location_id);
		/*if (empty($location_id)) {
			$this->error('请至少选择一个门店');
		}*/

		// 服务类型
		$service_type = intval($_REQUEST['service_type']);
		if ($service_type != 1) {
			$service_type = 0;  // 如果不是自定义服务都是标准服务
		}

		$service_id = $_REQUEST['service_id'];
		$service_id = array_map(function($id){return intval($id);}, $service_id);
		$service_id = array_filter($service_id);
		if (empty($service_id)) {
			$this->error('请至少选择一个服务');
		}

		if ($service_type == 1 && count($service_id) > 1) {
			$this->error('自定义服务一次只能添加一个');
		}

		$where = ' id in ('.implode(',', $service_id).') ';
		$service_list = M('CommonService')->where($where)->findAll();
		// logger::write(M('CommonService')->getLastSql());
		if (empty($service_list)) {
			$this->error('非法的服务');
		}
		
		foreach ($service_list as $key => $service) {
			$service['service_id'] = $service['id'];
			unset($service['id']);
			$service['supplier_id'] = $supplier_info['id'];
			$service['supplier_name'] = $supplier_info['name'];
			$service['service_type'] = $service_type;
			if ($location_id) {
				$service['location_ids'] = implode(',', $location_id);
			}
			if ($service['service_balance_rate'] == 0) {
				// 如果通用服务的结算费率是0，去商户的结算费率
				$service['service_balance_rate'] = $supplier_info['publish_verify_balance'];
			}
			
			
			// 主图
			$imgWhere = array(
				'supplier_service_id' => 0,
				'common_service_id' => $service['service_id'],
			);
			$imgs = M('CommonServiceImg')->where($imgWhere)->findAll();
			if ($imgs) {
				foreach ($imgs as $img) {
					if ($img['is_main'] == 1) {
						$mainImg = $img['img'];
					}
				}
				if ($mainImg) {
					$service['service_img'] = $mainImg;
				}
			}
			$service['create_time'] = NOW_TIME;
			$service['sub_status'] = 0;
			$service['pub_status'] = 1;
			$id = M(MODULE_NAME)->add($service);
			logger::write(M(MODULE_NAME)->getLastSql());
			if ($id) {

				// 同步门店服务链接
				if ($location_id) {
					foreach ($location_id as $lid) {
						$linkData = array(
							'supplier_id' => $supplier_id,
							'location_id' => $lid,
							'supplier_vs_id' => $id
						);
						M('SupplierLocationServiceLink')->add($linkData);
					}
				}

				// 新增服务图片
				if ($imgs) {
					$supImg = array();
					foreach ($imgs as $img) {
						unset($img['id']);
						$img['supplier_service_id'] = $id;
						$supImg[] = $img;
					}
					$GLOBALS['db']->inserts(DB_PREFIX.'common_service_img', $supImg);
				}
			}
			/*if ($id) {
				
			} else {
				//错误提示
				save_log('商户服务'.L("INSERT_FAILED"),0);
				$this->error(L("INSERT_FAILED"));
			}*/
		}
		if ($service_type == 1) { // 如果是自定义服务跳转到编辑页
			$jumpUrl = u(MODULE_NAME."/edit", array('id' => $id));
		} else {
			$jumpUrl = u(MODULE_NAME."/index", array('supplier_id' => $supplier_info['id']));
		}
		$this->assign("jumpUrl", $jumpUrl);

		save_log('商户服务'.L("INSERT_SUCCESS"),1);
		$this->success(L("INSERT_SUCCESS"));
	}


	public function edit()
	{		
		$id = intval($_REQUEST ['id']);
		$condition['is_delete'] = 0;
		$condition['id'] = $id;		
		$vo = M(MODULE_NAME)->where($condition)->find();
		$vo['begin_time'] = $vo['begin_time']!=0?to_date($vo['begin_time']):'';
		$vo['end_time'] = $vo['end_time']!=0?to_date($vo['end_time']):'';
	    $vo['service_balance_rate'] =  $vo['service_balance_rate'] *100;
		
		$cate_tree = M("ServiceCate")->where('is_delete = 0 and pid=0')->findAll();		
		$this->assign("cate_tree",$cate_tree);


		$supplier_info = M("Supplier")->where("id=".$vo['supplier_id'])->find();
	    $this->assign("supplier_info",$supplier_info);

	    if (!empty($vo['location_ids'])) {
	    	$location_infos = M('SupplierLocation')->where('id in ('.$vo['location_ids'].')')->field('name')->findAll();
	    	$this->assign('location_infos', $location_infos);
	    }
		
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
		$img_list = M("CommonServiceImg")->where("supplier_service_id=".$vo['id'])->order("is_main desc")->findAll();
		$imgs=array();
		foreach ($img_list as $v){
		    $imgs[]=$v['img'];
		}
		$this->assign("img_list",$imgs);
		$this->assign("img_index",count($imgs));
		
		$this->assign("vo",$vo);

		$this->display ();
	}

	public function delete() {
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];

		if (isset ( $id )) {
			$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
			$service_ids = M(MODULE_NAME)->where($condition)->getField('id');
			if (empty($service_ids)) {
				$this->error(l('参数错误,请刷新重试'), $ajax);
			}
			
			$info = implode(",",$service_ids);

			$list = M(MODULE_NAME)->where ( $condition )->delete(); //save(array('is_delete'=>1));	
			if ($list!==false) {
				 
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

	public function foreverdelete() {
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];

		if (isset ( $id )) {
			$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
			$service_ids = M(MODULE_NAME)->where($condition)->getField('id');
			if (empty($service_ids)) {
				$this->error(l('参数错误,请刷新重试'), $ajax);
			}
			
			$info = implode(",",$service_ids);

			$list = M(MODULE_NAME)->where ( $condition )->delete();
			if ($list!==false) {
				 
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

	    $location_id = $_REQUEST['location_id'];
	    if ($location_id) {
	    	$location_id = array_map(function($id){return intval($id);}, $location_id);
			$location_id = array_filter($location_id);
	    }
		
		/*if (empty($location_id)) {
			$this->error('请至少选择一个门店');
		}*/
	    
	    // 更新数据
	    if($_REQUEST['tag_id'])
	        $data['tag_id']=implode(",", $_REQUEST['tag_id']);
	    $data['is_effect']=1;
	     
	    $data['subscription']=intval($data['subscription']);
	    $data['name']=strim($data['name']);
	    $data['service_balance_rate']=$data['service_balance_rate']/100;
	    $data['begin_time']=strim($_REQUEST['begin_time'])==''?0:to_timespan($_REQUEST['begin_time']);
	    $data['end_time']=strim($_REQUEST['end_time'])==''?0:to_timespan($_REQUEST['end_time']);

	    if ($location_id) {
	    	$data['location_ids'] = implode(',', $location_id);
	    } else {
	    	$data['location_ids'] = '';
	    }
	    
	    $data['update_time'] = NOW_TIME;
	    
	    $rst=M(MODULE_NAME)->save($data);
	    // logger::write(M('SupplierLocationServiceLink')->getLastSql());
	    // 更新数据
	    if ($rst != false) {
	        $id=$data['id'];
	        M('CommonServiceImg')->where(array('supplier_service_id' => $id))->delete();
	    
	        foreach ($_REQUEST['img'] as $t => $v){
	            if($t ==  0){
	                $img_data['is_main']=1;
	            }else{
	                $img_data['is_main']=0;
	            }
	            $img_data['img']=$v;
	            $img_data['supplier_service_id']=$id;
	            M('CommonServiceImg')->add($img_data);
	        }


			if ($location_id) {
				$addedLoc = M('SupplierLocationServiceLink')->where(array('supplier_vs_id'=>$id))->field('location_id,is_close')->findAll();
				$addLoc = array();
				if (empty($addedLoc)) {
					$addLoc = $location_id;
				} else {
					$addedLocIds = array();
					$ableLoc = array();
					$disableLoc = array();
					foreach ($addedLoc as $loc) {
						$addedLocIds[] = $loc['location_id'];
						if (in_array($loc['location_id'], $location_id)) {
							if ($loc['is_close'] == 0) {
								continue;
							} else {
								$ableLoc[] = $loc['location_id'];
							}
						} else {
							$disableLoc[] = $loc['location_id'];
						}
					}
					
					if (!empty($ableLoc)) {
						M('SupplierLocationServiceLink')->where(array('location_id'=>array('in', $ableLoc), 'supplier_vs_id' => $id))->save(array('is_close'=>0));
						// logger::write(M('SupplierLocationServiceLink')->getLastSql());
					}
					if (!empty($disableLoc)) {
						M('SupplierLocationServiceLink')->where(array('location_id'=>array('in', $disableLoc), 'supplier_vs_id' => $id))->save(array('is_close'=>1));
						// logger::write(M('SupplierLocationServiceLink')->getLastSql());
					}
					$addLoc = array_diff($location_id, $addedLocIds);
				}
				if (!empty($addLoc)) {
					foreach ($addLoc as $lid) {
						$linkData = array(
							'supplier_id' => $data['supplier_id'],
							'location_id' => $lid,
							'supplier_vs_id' => $id
						);
						M('SupplierLocationServiceLink')->add($linkData);
					}
				}	
			} else {
				M('SupplierLocationServiceLink')->where(array('supplier_vs_id'=>$id))->save(array('is_close' => 1));
			}

	    
	        $cate =array();
	        $cate_id_arr = explode(",",$data['cate_id']);
	        foreach ($cate_id_arr as $k=>$v){
	            get_all_parent_id(intval($v),DB_PREFIX."service_cate",$cate);
	        }
	    
	        if(count($cate)>0) {
	            $cates = $GLOBALS['db']->getAll("select name from ".DB_PREFIX."service_cate where id in (".implode(",",$cate).")");
	            foreach ($cates as $row)
	            {
	                insert_match_item(trim($row['name']),"supplier_visiting_services",$id,"cate_match");
	            }
	        }
	    
	        save_log($_REQUEST['name'].L("UPDATE_SUCCESS"),1);
	        $this->success(L("UPDATE_SUCCESS"));
	     } else {
	        //错误提示
	        save_log($_REQUEST['name'].L("UPDATE_FAILED"),0);
	        $this->error(L("UPDATE_FAILED"));
	    } 
	}

	public function service_box()
	{
		//分类
		$cate_tree = M("ServiceCate")->where('is_delete = 0 and pid=0')->findAll();
		$cate_tree = D("ServiceCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_p_tree",$cate_tree);

	    $this->display();
	}

	public function service_cate()
	{
		$pid = intval($_REQUEST['pid']);
		$cate_tree = M('ServiceCate')->where('is_delete = 0 and pid='.$pid)->findAll();
		$this->ajaxReturn($cate_tree);
	}

	public function service_list()
	{

		//开始加载搜索条件
		$map['is_delete'] = 0;
		if(strim($_REQUEST['name'])!='') {
			$map['name'] = array('like','%'.strim($_REQUEST['name']).'%');			
		}

		$map['_string']=" 1=1 ";

		if (intval($_REQUEST['stype']) == 0) {
			// 过滤查找商户已添加的标准服务
			$filterWhere = array(
				'supplier_id' => intval($_REQUEST['supplier_id']),
				'service_type' => 0,
			);
			$sids = M(MODULE_NAME)->where($filterWhere)->field('service_id')->findAll();
			// logger::write(M(MODULE_NAME)->getLastSql());
			$filterIds = array();
			foreach ($sids as $sid) {
				$filterIds[] = $sid['service_id'];
			}
			if ($filterIds) {
				$map['_string'] .= ' and id not in('.implode(',', $filterIds).')';
			}
		}
		
		$cate_id = 0;
		if (intval($_REQUEST['cate_id']) > 0) {
			$cate_id = intval($_REQUEST['cate_id']);
		} elseif (intval($_REQUEST['p_cate_id']) > 0) {
			$cate_id = intval($_REQUEST['p_cate_id']);
		}

		if($cate_id>0) {
		    $cate_name=$GLOBALS['db']->getOne("select name from ".DB_PREFIX ."service_cate where id =".$cate_id);
		    $map['_string'].=" and FIND_IN_SET('$cate_name',cate_match_row)";
		}

        $map['is_effect']=1;
        $map['begin_time']=array("elt",NOW_TIME);
        $map['end_time']=array(array("egt",NOW_TIME),array("eq",0),"or");

		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		// $name=$this->getActionName();
		$model = M ('CommonService');
		if (! empty ( $model )) {
			$list = $this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}

	public function do_downline()
	{
        $id = $_REQUEST['id'];
        if(!$id) $this->ajaxReturn(0,l("id不能为空"),1);
        $info = M(MODULE_NAME)->where("id in($id)")->getField("name");
        M(MODULE_NAME)->where("id in({$id})")->save(array("is_effect"=>0));
        save_log($info.l("SET_EFFECT_0"),1);
        
        $this->ajaxReturn(0,l("下架成功"),1);
    }

    public function do_upline()
    {
    	$id = $_REQUEST['id'];
        if(!$id) $this->ajaxReturn(0,l("id不能为空"),1)	;
        $info = M(MODULE_NAME)->where("id in($id)")->getField("name");
        M(MODULE_NAME)->where("id in({$id})")->save(array("is_effect"=>1));
        save_log($info.l("SET_EFFECT_0"),1);

        $this->ajaxReturn(1,l("上架成功"),1);
    }







	public function publishs()
	{
		$page_idx = intval($_REQUEST['p'])==0?1:intval($_REQUEST['p']);
		$page_size = C('PAGE_LISTROWS');
		$limit = (($page_idx-1)*$page_size).",".$page_size;
		
		if (isset ( $_REQUEST ['_order'] )) {
			$order = $_REQUEST ['_order'];
		}
		
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset ( $_REQUEST ['_sort'] )) {
			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
		} else {
			$sort = 'desc';
		}
	    if(isset($order))
	    {
	    	$orderby = "order by ".$order." ".$sort;
	    }else 
	    {
	    	 $orderby = "order by id desc ";
	    }

	    $where = array();
	    $pub_status = intval($_REQUEST['pub_status']) - 1;
	    if ($pub_status >= 0 && $pub_status <=2) {
	    	$where['pub_status'] = $pub_status;
	    }

	    if (strim($_REQUEST['search_key'])) {
	    	$where['service_name'] = array('like', strim($_REQUEST['search_key']));
	    }

	    $total = M(MODULE_NAME)->where($where)->count();

	    $list = M(MODULE_NAME)->where($where)->limit($limit)->order($orderby)->findAll();
		
		$p = new Page ( $total, '' );
		$page = $p->show ();

		
		$sortImg = $sort; //排序图标
		$sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
		$sort = $sort == 'desc' ? 1 : 0; //排序方式
			//模板赋值显示
		$this->assign ( 'sort', $sort );
		$this->assign ( 'order', $order );
		$this->assign ( 'sortImg', $sortImg );
		$this->assign ( 'sortType', $sortAlt );
			
		$this->assign ( 'list', $list );
		$this->assign ( "page", $page );
		$this->assign ( "nowPage",$p->nowPage);
			
		$this->display ();
	}
	
}
?>