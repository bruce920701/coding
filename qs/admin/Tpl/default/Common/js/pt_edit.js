// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 吴庆祥
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-09-11 17:52
// +----------------------------------------------------------------------
$(document).ready(function () {
    set_price_profit();
    init_syn_price_setting();
    check_lang_ding();
    $("input[name=pt_type]").bind("click",function(){
        check_lang_ding();
    });
});
function set_price_profit(){
    var origin_price = parseFloat($("#origin_price").val());
    var current_price = parseFloat($("#current_price").val());
    var balance_price =  parseFloat($("#balance_price").val());
    var price_profit_precentage =( ( current_price - balance_price ) / current_price * 100 ).toFixed(2) + '%';
    var price_profit = ( current_price - balance_price ).toFixed(2);
    $(".price_profit_precentage").html(price_profit_precentage);
    $(".price_profit").html(price_profit);
}
function check_lang_ding(){
    var pt_type=parseInt($("input[name=pt_type]:checked").val());
    if(pt_type){
        $(".lang-ding").html("定");
    }else{
        $(".lang-ding").html("订");
    }
}
function init_syn_price_setting(){

    if($("input[name^=pt_deposit_money]").length<2){
        $(".syn_price_setting").hide();
    }else{
        $(".syn_price_setting").live("click",function(){
            var pt_deposit_money_default=parseFloat($("input[name=pt_deposit_money_default]").val());
            var pt_discount_money_default=parseFloat($("input[name=pt_discount_money_default]").val());
            if(!pt_deposit_money_default){
                alert("拼团订金不能为空");return;
            }else if(!pt_discount_money_default){
                alert("折扣金额不能为空");return;
            }
            $("input[name^=pt_deposit_money]").val(pt_deposit_money_default);
            $("input[name^=pt_discount_money]").val(pt_discount_money_default);
        });

    }
}