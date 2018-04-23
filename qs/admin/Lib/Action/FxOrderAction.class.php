<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class FxOrderAction extends CommonAction{	
	/*
	 * 分销订单
	 */
	public function index()
	{
		$condition = " 1=1 and o.is_presell_order=0 ";
		if(strim($_REQUEST['order_sn'])!="")	$condition .= " and o.order_sn = ".strim($_REQUEST['order_sn']);
		//if(intval($_REQUEST['deal_id'])>0) $condition .= " and i.deal_id = ".intval($_REQUEST['deal_id']);
		if(strim($_REQUEST['user_name'])!=''){
			$condition .= " and o.user_name = '".strim($_REQUEST['user_name'])."' ";
		}

		if(strim($_REQUEST['order_status'])==1)$condition .= " and o.order_status = 0";
		if(strim($_REQUEST['order_status'])==2)$condition .= " and o.order_status = 1";

		$count_list =$GLOBALS['db']->getAll("select o.id from ".DB_PREFIX."deal_order as o left join ".DB_PREFIX."deal_order_item as i on i.order_id=o.id where i.fx_user_id>0 and ".$condition." GROUP BY o.id");
		$count=count($count_list);
		$p = new Page ( $count);
		$limit=$p->firstRow . ',' . $p->listRows;
		$list =$GLOBALS['db']->getAll("select o.id,o.order_sn,o.order_sn,o.deal_order_item,o.user_id,o.order_status,o.refund_status from ".DB_PREFIX."deal_order as o left join ".DB_PREFIX."deal_order_item as i on i.order_id=o.id where i.fx_user_id>0 and ".$condition." GROUP BY o.id order by o.create_time desc limit ".$limit);
		foreach ($list as $k=>$v){
			$list[$k]['deal_order_item']=$v['deal_order_item']=unserialize($v['deal_order_item']);
			$deal_name=$v['deal_order_item']['0']['name']."等";
			$num=0;
			$fx_deal_total_price=0;
			$fx_salary_1=0;
			$fx_salary_2=0;
			$fx_salary_3=0;
			$fx_salary_total=0;
			$fx_salary_1_user_name="";
			$fx_salary_2_user_name="";
			$fx_salary_3_user_name="";
			foreach($list[$k]['deal_order_item'] as $kk=>$vv){
				$num+=$vv['number'];
				$list[$k]['deal_order_item'][$kk]['fx_salary_all']=$vv['fx_salary_all']=unserialize($vv['fx_salary_all']);
				if($vv['fx_salary_total']>0){
					$fx_deal_total_price+=$vv['total_price'];
					if(is_array($vv['fx_salary_all']['1'])){
						$fx_salary_1+=$vv['fx_salary_all']['1']['salary'];
						$fx_salary_2+=$vv['fx_salary_all']['2']['salary'];
						$fx_salary_3+=$vv['fx_salary_all']['3']['salary'];
						$fx_salary_1_user_name=$vv['fx_salary_all']['1']['user_name']."：";
						$fx_salary_2_user_name=$vv['fx_salary_all']['2']['user_name']."：";
						$fx_salary_3_user_name=$vv['fx_salary_all']['3']['user_name']."：";
					}else{
						$fx_salary_1+=intval($vv['fx_salary_all']['1']);
						$fx_salary_2+=intval($vv['fx_salary_all']['2']);
						$fx_salary_3+=intval($vv['fx_salary_all']['3']);
					}
					$fx_salary_total+=$vv['fx_salary_total'];
				}
			}
			$list[$k]['deal_name']=$deal_name.$num."件";
			$list[$k]['fx_deal_total_price']=$fx_deal_total_price;
			$list[$k]['fx_salary_1']=$fx_salary_1==0?'-':$fx_salary_1_user_name.format_price($fx_salary_1);
			$list[$k]['fx_salary_2']=$fx_salary_2==0?'-':$fx_salary_2_user_name.format_price($fx_salary_2);
			$list[$k]['fx_salary_3']=$fx_salary_3==0?'-':$fx_salary_3_user_name.format_price($fx_salary_3);
			$list[$k]['fx_salary_total']=$fx_salary_total;
		}
		//echo "<pre>";print_r($list);exit;
		$page = $p->show ();
		$this->assign("list",$list);
		$this->assign ( "page", $page );
		$this->display ();
		return;
	}
	
	/*
	 * 分销订单
	 */
	public function ref_index()
	{
		$condition = " 1=1 ";
		if(strim($_REQUEST['order_sn'])!="")	$condition .= " and o.order_sn = ".strim($_REQUEST['order_sn']);
		//if(intval($_REQUEST['deal_id'])>0) $condition .= " and i.deal_id = ".intval($_REQUEST['deal_id']);
		if(strim($_REQUEST['user_name'])!=''){
			$condition .= " and o.user_name = '".strim($_REQUEST['user_name'])."' ";
		}

		if(strim($_REQUEST['order_status'])==1)$condition .= " and o.order_status = 0";
		if(strim($_REQUEST['order_status'])==2)$condition .= " and o.order_status = 1";

		$count =$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_order as o where o.is_participate_ref_salary=1 and ".$condition);
		$p = new Page ( $count);
		$limit=$p->firstRow . ',' . $p->listRows;
		$list =$GLOBALS['db']->getAll("select o.* from ".DB_PREFIX."deal_order as o where o.is_participate_ref_salary=1 and ".$condition." order by o.create_time desc limit ".$limit);
		//echo "<pre>";print_r($list);exit;
		foreach ($list as $k=>$v){
			$v['ref_salary_all']=unserialize($v['ref_salary_all']);
			if($v['ref_salary_all']['ref_salary_all']['0']){
				$salary=$v['ref_salary_all']['ref_salary_all']['0'];
				$v['ref_salary1']=$salary['user_name'].'：¥'.round($salary['salary'],2);
			}else{
				$v['ref_salary1']="-";
			}
			if($v['ref_salary_all']['ref_salary_all']['1']){
				$salary=$v['ref_salary_all']['ref_salary_all']['1'];
				$v['ref_salary2']=$salary['user_name'].'：¥'.round($salary['salary'],2);
			}else{
				$v['ref_salary2']="-";
			}
			if($v['ref_salary_all']['ref_salary_all']['2']){
				$salary=$v['ref_salary_all']['ref_salary_all']['2'];
				$v['ref_salary3']=$salary['user_name'].'：¥'.round($salary['salary'],2);
			}else{
				$v['ref_salary3']="-";
			}
			$v['log']=$v['ref_salary_all']['log']?$v['ref_salary_all']['log']:'-';
			$list[$k]=$v;
		}
		$page = $p->show ();
		$this->assign("list",$list);
		$this->assign ( "page", $page );
		$this->display ();
		return;
	}
	/*
	 * 分销订单
	 */
	public function store_pay_index()
	{
		$condition = " 1=1 ";
		if(strim($_REQUEST['order_sn'])!="")	$condition .= " and o.order_sn = ".strim($_REQUEST['order_sn']);
		//if(intval($_REQUEST['deal_id'])>0) $condition .= " and i.deal_id = ".intval($_REQUEST['deal_id']);
		if(strim($_REQUEST['user_mobile'])!=''){
			$condition .= " and o.user_mobile = '".strim($_REQUEST['user_mobile'])."' ";
		}

		$count =$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."store_pay_order as o where o.is_participate_ref_salary=1 and ".$condition);
		$p = new Page ( $count);
		$limit=$p->firstRow . ',' . $p->listRows;
		$list =$GLOBALS['db']->getAll("select s.ref_user_id,s.name,o.* from ".DB_PREFIX."store_pay_order as o LEFT JOIN ".DB_PREFIX."supplier s on o.supplier_id=s.id where o.is_participate_ref_salary=1 and ".$condition." order by o.create_time desc limit ".$limit);
		foreach ($list as $k=>$v){
			$v['ref_salary_all']=unserialize($v['ref_salary_all']);
			if($v['ref_salary_all']['ref_salary_all']['0']){
				$salary=$v['ref_salary_all']['ref_salary_all']['0'];
				$v['ref_salary1']=$salary['user_name'].'：¥'.$salary['salary'];
			}else{
				$v['ref_salary1']="-";
			}
			if($v['ref_salary_all']['ref_salary_all']['1']){
				$salary=$v['ref_salary_all']['ref_salary_all']['1'];
				$v['ref_salary2']=$salary['user_name'].'：¥'.$salary['salary'];
			}else{
				$v['ref_salary2']="-";
			}
			if($v['ref_salary_all']['ref_salary_all']['2']){
				$salary=$v['ref_salary_all']['ref_salary_all']['2'];
				$v['ref_salary3']=$salary['user_name'].'：¥'.$salary['salary'];
			}else{
				$v['ref_salary3']="-";
			}
			$v['log']=$v['ref_salary_all']['log'];
			$list[$k]=$v;
		}
		$page = $p->show ();
		$this->assign("list",$list);
		$this->assign ( "page", $page );
		$this->display ();
		return;
	}

	
	
}
?>