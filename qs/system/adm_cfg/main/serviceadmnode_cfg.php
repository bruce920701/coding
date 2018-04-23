<?php 
return array( 
	"ServiceTag"	=>	array(
		"name"	=>	"服务标签", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"服务标签列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加","action"=>"insert"),
			"update"	=>	array("name"=>"编辑","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"删除","action"=>"foreverdelete"),
			"set_effect"	=>	array("name"=>"设置有效性","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"设置排序","action"=>"set_sort"),

		)
	),
	"ServiceCate"	=>	array(
		"name"	=>	"通用服务分类", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"通用服务分类列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加","action"=>"insert"),
			"update"	=>	array("name"=>"编辑","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"set_effect"	=>	array("name"=>"设置有效性","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"设置排序","action"=>"set_sort"),

		)
	),
	"CommonService"	=>	array(
		"name"	=>	"通用服务库", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"通用服务列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加","action"=>"insert"),
			"update"	=>	array("name"=>"编辑","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"deal_upline"	=>	array("name"=>"服务上架","action"=>"deal_upline"),
		    "deal_downline"	=>	array("name"=>"服务下架","action"=>"deal_downline"),
			"set_sort"	=>	array("name"=>"设置排序","action"=>"set_sort"),

		)
	),
	"SupplierVisitingServices"	=>	array(
		"name"	=>	"商家服务", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"商家服务列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加","action"=>"insert"),
			"update"	=>	array("name"=>"编辑","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"upline"	=>	array("name"=>"服务上架","action"=>"upline"),
		    "downline"	=>	array("name"=>"服务下架","action"=>"downline"),
			"set_sort"	=>	array("name"=>"设置排序","action"=>"set_sort"),
			"publishs"  =>  array("name"=>"服务审核","action"=>"publishs")
		)
	),
);
?>