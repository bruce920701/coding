$(document).on("pageInit", "#biz_presell_order_logistics", function(e, pageId, $page) {

    if($(".buttons-tab .tab-link").length>0){
        var _width=$(".buttons-tab .tab-link.active").find("span").width();
        var _left=$(".buttons-tab .tab-link.active").find("span").offset().left;

        var btm_line=$(".buttons-tab .bottom_line");
        btm_line.css({"width":_width+"px","left":_left+"px"});

        var _tabs=$(".tabBox .tab_box");
    }
    $(".buttons-tab .tab-link").click(function () {
        var _wid=$(this).find("span").width();
        var _lef=$(this).find("span").offset().left;

        btm_line.css({"width":_wid+"px","left":_lef+"px"});
        var _index=$(this).index();

        $(this).addClass("active").siblings(".tab-link").removeClass("active");
        _tabs.eq(_index).addClass("active").siblings(".tab_box").removeClass("active");

    });

    $(".no_delivery_deal").click(function(){
        if($("input[type='checkbox']").length==$("input[disabled='disabled']").length){
            $("#uc_logistic nav.bar-tab").hide();
        }else{
            $("#uc_logistic nav.bar-tab").show();
        }
    });

});
