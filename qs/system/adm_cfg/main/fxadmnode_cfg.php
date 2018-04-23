<?php
return array(
    "fx_extension"      =>     array(
        "key"       =>   "fx_extension",
        "groups"    =>  array(
            array(
                "name"          =>  "分销资格设置",
                "type"          =>  "1",
                "nodes"         =>  array(
                    array("name"=>"分销资格设置","module"=>"FxQualification","action"=>"index","icon"=>'icon_fxzgsz'),
                    array("name"=>"分销会员列表","module"=>"FxUser","action"=>"index","explain"=>'全是大腿，推广就靠他们了',"icon"=>'icon_fxhy'),
                )
            ),
            array(
                "name"          =>  "推荐会员(消费)返佣",
                "type"          =>  "2",
                "nodes"         =>  array(
                    array("name"=>"佣金设置","module"=>"FxSalary","action"=>"index","explain"=>'设置商品佣金,合理分配每一分收益',"icon"=>'icon_yjsz'),
                    array("name"=>"分销订单","module"=>"FxOrder","action"=>"index","explain"=>'订单日志,钱就是这样分的',"icon"=>'icon_fxdd'),
                    array("name"=>"佣金报表","module"=>"FxStatement","action"=>"promote","explain"=>'数字统计,数字告诉你一切',"icon"=>'icon_yjbb'),
                )
            ),
            array(
                "name"          =>  "推荐商家(销售)返佣",
                "type"          =>  "3",
                "nodes"         =>  array(
                    array("name"=>"佣金设置","module"=>"FxSalary","action"=>"ref_salary","explain"=>'设置商品佣金,合理分配每一分收益',"icon"=>'icon_yjsz'),
                    array("name"=>"分销订单","module"=>"FxOrder","action"=>"ref_index","explain"=>'订单日志,钱就是这样分的',"icon"=>'icon_fxdd'),
                    array("name"=>"佣金报表","module"=>"FxStatement","action"=>"ref_promote","explain"=>'数字统计,数字告诉你一切',"icon"=>'icon_yjbb'),
                )
            ),
            array(
                "name"          =>  "推荐商家优惠买单返佣",
                "type"          =>  "4",
                "nodes"         =>  array(
                    array("name"=>"分销订单","module"=>"FxOrder","action"=>"store_pay_index","explain"=>'订单日志,钱就是这样分的',"icon"=>'icon_fxdd'),
                    array("name"=>"佣金报表","module"=>"FxStatement","action"=>"store_payment_promote","explain"=>'数字统计,数字告诉你一切',"icon"=>'icon_yjbb'),
                )
            ),
            array(
                "name"          =>  "推荐商品(销售)返佣",
                "type"          =>  "5",
                "nodes"         =>  array(
                    array("name"=>"商品管理","module"=>"NewMarketingAdm","action"=>"zy_shop_fx","explain"=>'设置商品佣金,合理分配每一分收益',"icon"=>'icon_spgl'),
                    array("name"=>"佣金报表","module"=>"FxStatement","action"=>"recommend_money","explain"=>'数字统计,数字告诉你一切',"icon"=>'icon_yjbb'),
                )
            ),
            array(
                "name"          =>  "推荐会员(缴费)返佣",
                "type"          =>  "6",
                "nodes"         =>  array(
                    array("name"=>"缴费明细","module"=>"FxDetail","action"=>"index","explain"=>'缴费日志,钱就是这样来的',"icon"=>'icon_jfmx'),
                    array("name"=>"佣金报表","module"=>"FxStatement","action"=>"refer","explain"=>'数字统计,数字告诉你一切',"icon"=>'icon_yjbb'),
                )
            ),
            array(
                "name"          =>  "推荐会员(购买)返佣",
                "type"          =>  "7",
                "nodes"         =>  array(
                    array("name"=>"佣金设置","module"=>"NewMarketingAdm","action"=>"recommend_user_register","explain"=>'邀请好友有礼,给会员一个帮你推广的理由',"icon"=>'icon_yjsz'),
                    array("name"=>"佣金报表","module"=>"Referrals","action"=>"index","explain"=>'数字统计,数字告诉你一切',"icon"=>'icon_yjbb'),
                )
            ),
        )
    ),
    "user_extension"    =>     array(
        "key"       =>   "user_extension",
        "groups"    =>  array(
            array(
                "name"          =>  "会员推广",
                "type"          =>  "1",
                "nodes"         =>  array(
                    array("name"=>"新人礼","module"=>"NewMarketingAdm","action"=>"new_user_gift","explain"=>'品牌传播，吸引新会员加入',"icon"=>'icon_xrl'),
                    array("name"=>"会员奖励","module"=>"NewMarketingAdm","action"=>"user_reward","explain"=>'会员福利管理,留住更多会员',"icon"=>'icon_hyjl'),
                )
            ),
            array(
                "name"          =>  "会员等级",
                "type"          =>  "2",
                "nodes"         =>  array(
                    array("name"=>"会员分组","module"=>"UserGroup","action"=>"index","explain"=>'不同分组,不同折扣',"icon"=>'icon_hyfz'),
                    array("name"=>"会员等级","module"=>"UserLevel","action"=>"index","explain"=>'资历越老,等级越高',"icon"=>'icon_hydj'),
                    array("name"=>"会员勋章","module"=>"Medal","action"=>"index","explain"=>'定制勋章,特别的勋章给特别的你',"icon"=>'icon_hyxz'),
                )
            ),
        )
    ),
    "marketing_extension"  =>  array(
        "key"       =>   "marketing_extension",
        "groups"    =>  array(
            array(
                "name"          =>  "促进销量",
                "type"          =>  "1",
                "nodes"         =>  array(
                    array("name"=>"优惠券管理","module"=>"Youhui","action"=>"index","explain"=>'维护新老会员,提升订单销量',"icon"=>'icon_yhq'),
                    array("name"=>"红包管理","module"=>"EcvType","action"=>"index","explain"=>'维护新老会员,提升订单销量',"icon"=>'icon_hb'),
                    array("name"=>"满免运费","module"=>"Promote","action"=>"delivery_free","explain"=>'提升销量,刺激会员提升客单价',"icon"=>'icon_mmyf'),
                    array("name"=>"积分抵现","module"=>"ScoreMarketing","action"=>"score_purchase","explain"=>'提升销量,刺激会员提升客单价',"icon"=>'icon_jfdx'),
                    array("name"=>"积分购买","module"=>"ScoreMarketing","action"=>"score_recharge","explain"=>'小积分大作用,提升客户忠诚值',"icon"=>'icon_jfgm'),
                    array("name"=>"商品预售","module"=>"DealPresell","action"=>"index","explain"=>'先付订金，再付尾款，订金抵扣，销量不愁',"icon"=>'icon_spys'),
                    array("name"=>"商品拼团","module"=>"Pt","action"=>"index","explain"=>'散客成团，享受成团优惠',"icon"=>'icon_spys'),
                )
            ),
            array(
                "name"          =>  "线下活动",
                "type"          =>  "2",
                "nodes"         =>  array(
                    array("name"=>"活动列表","module"=>"Event","action"=>"index","explain"=>'社会传播,线下活动',"icon"=>'icon_hdlb'),
                    array("name"=>"活动分类","module"=>"EventCate","action"=>"index","explain"=>'丰富的活动类型',"icon"=>'icon_hdfl'),
                    array("name"=>"商家活动审核","module"=>"Event","action"=>"publish","explain"=>'审核,避免违规活动',"icon"=>'icon_hdsh'),
                )
            ),
        )
    )
);
?>