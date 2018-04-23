<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class uc_fxcateApiModule extends MainBaseApiModule
{
	
	/**
	 */
	public function index()
	{
		/*输出商品分类*/

		$bcate_list = getShopCateList();
		
		$time = NOW_TIME;
		
		$condition = 'select shop_cate_id , count(*) as shop_cate_count from '.DB_PREFIX."deal where";

		
		$condition .= ' is_effect = 1 and is_delete = 0 and is_fx=2 and buy_type=0 and is_shop=1 and (';
		
		$condition .= " ((".$time.">= begin_time or begin_time = 0) and (".$time."< end_time or end_time = 0) and buy_status <> 2) ";
		
		$condition .= " or (".$time." < begin_time and begin_time <> 0 and notice = 1) ";

		$condition .=" )";

		$condition .=" group by shop_cate_id";

		$shop_cate_count = $GLOBALS['db']->getAll($condition);

		$shop_cate_count_key=array();

        $shop_all_count=0;
        foreach($shop_cate_count as $k=>$v){
            $arr=explode(',',$v['shop_cate_id']);
            foreach($arr as $vv){
                $shop_cate_count_key[$vv]+=$v['shop_cate_count'];
                $shop_all_count+=$v['shop_cate_count'];
            }

        }

		$shop_cate_count=array();

		foreach($shop_cate_count_key as $k=>$v){
			$arr['shop_cate_id']=$k;
			$arr['shop_cate_count']=$v;
			$shop_cate_count[$k]=$arr;
		}

		foreach ($bcate_list as $k=>$v){
			$bcate_list[$k]['cate_img']=$bcate_list[$k]['cate_img']?get_abs_img_root(get_spec_image($bcate_list[$k]['cate_img'],82,82,1)):"";
			foreach ($v['bcate_type'] as $kk=>$vv){
				$bcate_list[$k]['bcate_type'][$kk]['count']=intval($shop_cate_count[$vv['id']]['shop_cate_count']);
				$bcate_list[$k]['bcate_type'][$kk]['cate_img']=$vv['cate_img']?get_abs_img_root(get_spec_image($vv['cate_img'],82,82,1)):"";
                if ($vv['id'] == 0) {
                    $bcate_list[$k]['bcate_type'][$kk]['app_url'] = SITE_DOMAIN . wap_url("index", "uc_fx#shop_fx", array('cate_id' => $v['id']));
                } else{
                    $bcate_list[$k]['bcate_type'][$kk]['app_url'] = SITE_DOMAIN . wap_url("index", "uc_fx#shop_fx", array('cate_id' => $vv['id']));
                }
			}
			$bcate_list[$k]['bcate_type']['0']['name']=$bcate_list[$k]['name'];
			$bcate_list[$k]['bcate_type']['0']['cate_img']=$bcate_list[$k]['cate_img'];
            $bcate_list['0']['bcate_type']['0']['count']=intval($shop_all_count);
			
		}

		foreach($bcate_list as $k=>$v ){
			$count=0;
			foreach($v['bcate_type'] as $kk=>$vv ){
				$count += $vv['count'];
			}
			$bcate_list[$k]['bcate_type'][0]['count'] = $count;
		}
		//分类下无商品隐藏
		foreach($bcate_list as $k=>$v ){
			if($bcate_list[$k]['bcate_type']['0']['count']=="0"){
				unset($bcate_list[$k]);
				continue;
			}
			foreach($v['bcate_type'] as $kk=>$vv ){
				if($vv['count']=="0"){
					unset($bcate_list[$k]['bcate_type'][$kk]);
				}
			}
		}
		foreach($bcate_list as $k=>$v ){
			$bcate_list[$k]['bcate_type'] = array_values($v['bcate_type']);
		}
		$root['bcate_list'] = array_values($bcate_list);
		$root['page_title'] = "分销-商城分类";
		return output($root);
	}

    /**
     */
    public function tuan()
    {
        /*输出团购分类*/

        $bcate_list = getCateList();

        //一级分类
        $time = NOW_TIME;
        $condition = 'select d.cate_id , count(*) as count from '.DB_PREFIX."deal d   where";
        $where ='';
        $where .= ' d.is_effect = 1 and d.is_fx=2 and d.is_delete = 0 and d.is_shop=0 AND d.is_location=1 and (';
        $where .= " ((".$time.">= d.begin_time or d.begin_time = 0) and (".$time."< d.end_time or d.end_time = 0) and d.buy_status <> 2) ";
        $where .= " or (".$time." < d.begin_time and d.begin_time <> 0 and d.notice = 1) ";
        $where .=" )";
        $where .=" and ((d.is_coupon = 1 AND (d.coupon_end_time >= ".NOW_TIME." or d.coupon_end_time=0)) or d.is_coupon=0)";


        $condition.=$where;
        $cate_count = $GLOBALS['db']->getAll($condition." group by d.cate_id");
        $cate_count_key=array();
        foreach($cate_count as $k=>$v){
            $arr=explode(',',$v['cate_id']);
            foreach($arr as $vv){
                $cate_count_key[$vv]+=$v['count'];
            }

        }
        $cate_count=array();
        foreach($cate_count_key as $k=>$v){
            $arr=array();
            $arr['cate_id']=$k;
            $arr['count']=$v;
            $cate_count[$k]=$arr;
        }


        //二级分类
        $e_sql='select dc.cate_id,dl.deal_cate_type_id,count(*) as count from '.DB_PREFIX.'deal_cate_type_deal_link dl LEFT JOIN '.DB_PREFIX.'deal_cate_type_link dc ON dl.deal_cate_type_id = dc.deal_cate_type_id LEFT JOIN '.DB_PREFIX.'deal d on dl.deal_id=d.id where';


        $e_sql.=$where;
        $ey_count = $GLOBALS['db']->getAll($e_sql." and dc.cate_id=d.cate_id group by dl.deal_cate_type_id,dc.cate_id");

        foreach ($ey_count as $k=>$v){
            $e_count[$v['cate_id']][$v['deal_cate_type_id']]=$v['count'];
        }

        //全部分类的个数计算
        $cate_counts=$GLOBALS['db']->getOne('select count(*) as count from '.DB_PREFIX."deal d   where".$where);

        foreach($bcate_list as $k=>$v)
        {
            if($bcate_list[$k]['id']){
                $bcate_list[$k]["bcate_type"]['0']['cate_id']=$bcate_list[$k]['id'];
            }
            foreach($v['bcate_type'] as $kk=>$vv)
            {
                $tmp_url_param['cate_id']=$v['id'];
                $tmp_url_param['tid']=$vv["id"];

                $bcate_list[$k]["bcate_type"][$kk]["app_url"]= wap_url("index","uc_fx#deal_fx",$tmp_url_param);
                if($v['id']=="0"&&$vv["id"]=="0"&&$vv["cate_id"]=="0")
                    $bcate_list[$k]["bcate_type"][$kk]["count"]= intval($cate_counts);
                elseif($v['id']=="0"&&$vv["id"]!="0"&&$vv["cate_id"]=="0")
                    $bcate_list[$k]["bcate_type"][$kk]["cate_id"]=0;
                elseif($v['id']!="0"&&$vv["id"]=="0"&&$vv["cate_id"]=="0")
                    $bcate_list[$k]["bcate_type"][$kk]["count"]= intval($cate_count[$v['id']]['count']);
                else{
                    $bcate_list[$k]["bcate_type"][$kk]["count"]= intval($e_count[$v['id']][$vv['id']]['count']);
                }
                if($bcate_list[$k]["bcate_type"][$kk]["count"]==0){
                    if($bcate_list[$k]["bcate_type"][$kk]['id']==0&&$bcate_list[$k]["bcate_type"][$kk]['cate_id']==0){
                    }else{
                        unset($bcate_list[$k]["bcate_type"][$kk]);
                    }
                }else{
                    if($bcate_list[$k]["bcate_type"][$kk]['id']==0){
                        $bcate_list[$k]['bcate_type']['0']['name']=$bcate_list[$k]['name'];
                        $bcate_list[$k]['bcate_type']['0']['cate_img']=$bcate_list[$k]['cate_img'];
                    }
                }
            }
            if(count($bcate_list[$k]["bcate_type"])==0){
                if($bcate_list[$k]["id"]==0){
                }else{
                    unset($bcate_list[$k]);
                }
            }else{
                $bcate_list[$k]["bcate_type"]=array_values($bcate_list[$k]["bcate_type"]);
            }

        }
        foreach($bcate_list as $k=>$v ){
            $bcate_list[$k]['bcate_type'] = array_values($v['bcate_type']);
        }
        $root['bcate_list'] = array_values($bcate_list);

        $root['page_title'] = "分销-团购分类";
        return output($root);
    }
}
?>