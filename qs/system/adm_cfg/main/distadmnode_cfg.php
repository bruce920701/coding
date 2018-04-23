<?php
return array(
    "DistributionOrder"	=>	array(
        "name"	=>	"驿站订单管理",
        "node"	=>	array(
            "distributionOrder"	=>	array("name"=>"订单列表","action"=>"distributionOrder"),
            "distributionOrderFee"	=>	array("name"=>"驿站服务费列表","action"=>"distributionOrderFee"),
        )
    ),
    "Distribution"	=>	array(
        "name"	=>	"驿站管理",
        "node"	=>	array(
            "index"	=>	array("name"=>"驿站列表","action"=>"index"),
            "charge_index"	=>	array("name"=>"提现列表","action"=>"charge_index"),
        )
    ),
    "DistributionShipping"	=>	array(
        "name"	=>	"驿站配送点管理",
        "node"	=>	array(
            "index"	=>	array("name"=>"配送点列表","action"=>"index"),
        )
    ),
    "DistributionAuth"	=>	array(
        "name"	=>	"驿站入驻管理",
        "node"	=>	array(
            "index"	=>	array("name"=>"申请列表","action"=>"index"),
        )
    ),
);
?>