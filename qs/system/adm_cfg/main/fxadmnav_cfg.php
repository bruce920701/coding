<?php 
return array(
//fx 营销菜单位于订单菜单后面
	"newmarketing"	=>	array(
			"name"	=>	"营销管理",
			"key"	=>	"newmarketing",
			"groups"	=>	array(
					"fx_extension"	=>	array(
							"name"	=>	"分销推广",
							"key"	=>	"fx_extension",
							"nodes"	=>	array(
							        array("name"=>"分销资格设置","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>1,"key"=>"fx_extension")),
							        array("name"=>"推荐会员(消费)返佣","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>2,"key"=>"fx_extension")),
							        array("name"=>"推荐商家(销售)返佣","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>3,"key"=>"fx_extension")),
							        array("name"=>"推荐商家优惠买单返佣","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>4,"key"=>"fx_extension")),
    							    array("name"=>"推荐商品(销售)返佣","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>5,"key"=>"fx_extension")),
    							    array("name"=>"推荐会员(缴费)返佣","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>6,"key"=>"fx_extension")),
							        array("name"=>"推荐会员(购买)返佣","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>7,"key"=>"fx_extension")),
							),
					),
			        "user_extension"=>   array(
			                "name"  =>   "会员推广",
			                "key"   =>   "user_extension",
			                "nodes" =>   array(
			                        array("name"=>"会员推广","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>1,"key"=>"user_extension")),
			                        array("name"=>"会员等级","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>2,"key"=>"user_extension")),
			                ),
			        ),
			        "marketing_extension"     =>   array(
			                "name"  =>   "营销推广",
			                "key"   =>   "marketing_extension",
			                "nodes" =>   array(
			                        array("name"=>"促进消费","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>1,"key"=>"marketing_extension")),
			                        array("name"=>"线下活动","module"=>"NewMarketingAdm","action"=>"index","parma"=>array("type"=>2,"key"=>"marketing_extension")),
			                ),
			        ),
			),
	),
);
?>