<?php 
return array( 
	"service"	=>	array(
				"name"	=>	"上门服务",
				"key"	=>	"service",
				"groups"	=>	array(
						"common_service"	=>	array(
								"name"	=>	"通用服务",
								"key"	=>	"dcorder",
								"nodes"	=>	array(
										array("name"=>"通用服务库","module"=>"CommonService","action"=>"index"),
										array("name"=>"通用分类管理","module"=>"ServiceCate","action"=>"index"),
										array("name"=>"服务标签管理","module"=>"ServiceTag","action"=>"index"),
								),
						),
						"supplier_service"	=>	array(
								"name"	=>	"商家服务",
								"key"	=>	"supplier_service",
								"nodes"	=>	array(
										array("name"=>"服务商家","module"=>"Supplier","action"=>"service_list"),
										array("name"=>"服务列表","module"=>"SupplierVisitingServices","action"=>"index"),
								        array("name"=>"商家提交服务审核","module"=>"SupplierVisitingServices","action"=>"publishs"),
								),
						),
				),
		),
);
?>