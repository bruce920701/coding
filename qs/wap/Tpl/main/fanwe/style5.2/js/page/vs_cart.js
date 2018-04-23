
$(document).on("pageInit", "#vs_cart", function(e, pageId, $page) {
    //打开送货时间选择
    $(".j-open-time").on('click', function() {
        $(".dc-mask").addClass('active');
        $(".time-select").addClass('active');
        /*var send_time=$(this).find('input').attr('value');
        $(".j-time-choose").each(function() {
            if ($(this).attr('value')==send_time) {
                $(this).addClass('active');
            }
        });*/
    });
    //关闭送货时间选择
    $(".j-close-time").on('click', function() {
        $(".dc-mask").removeClass('active');
        $(".time-select").removeClass('active');
    });
    //选择日期
    $(".j-day-item").on('click', function() {
        $(".time-select .select-time").removeClass("vs-show");
        $(".time-select .select-time").eq($(this).index()).addClass("vs-show");
    });
    //选择时间
    $(".j-time-choose").on('click', function() {
        if ($(this).hasClass('no_click')) {
            return false;
        }
        $(".j-time-choose").removeClass('active');
        $(this).addClass('active');

        var day_item = $(".j-day-item").eq($(this).parent().index()-2);
        $(".j-day-item").removeClass('active');
        $(day_item).addClass('active');
        var day_obj = $(day_item).find('p');
        $(".j-send-day").html(day_obj.html());
        $(".j-send-time").html($(this).find('p').html());
        
        $('input[name="rs_date"]').val($(day_item).attr('long-date'));
        $('input[name="tid"]').val($(this).attr('data-id'));
    });
    
    // 关闭弹层
    $(document).off('click', '.j-close-select');
    $(document).on('click', '.j-close-select', function() {
        $(".m-select-box").removeClass('active');
        $(".m-mask").removeClass('active');
    });

    var _close=false;
    $(document).on('click',"#vs_cart .remarkBox p.remarkTitle",function () {
    	var remarkArea = $(this).siblings('.remarkArea');
        if(_close==false){
            $(remarkArea).show();
            return _close=true;
        }
        if(_close==true){
            $(remarkArea).hide();
            return _close=false;
        }
    });

    $('#vs_cart .remarkBox .remarkArea textarea').on('input propertychange', function() {
        var that = $(this),
            _val = that.val();
        if (_val.length > 100) {
            that.val(_val.substring(0, 100));
        }
    });

    
    $(document).off('click', '.j-sure-cancel');
    $(document).on("click",".j-sure-cancel",function(){
        var _this=$(this);
        $(this).removeClass('j-sure-cancel');
        $.confirm('您确定要取消订单吗？', function () {
        	$(_this).addClass('j-sure-cancel');
        	
        	$.router.back();
        	
        	//$.router.load('#cart');
        },function(){
        	 $(_this).addClass('j-sure-cancel');
        });
    });

    /*listCli($(".j-reward-list li"));
    listCli($(".j-trans-list li"));*/

    $(document).on('click',".j-box-bg",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });


    //支付
    $(document).off('click', '.j-presell');
    $(".j-presell").on('click', function() {
        var consignee_id = $('input[name="consignee_id"]').val();
        if (!consignee_id) {
            $.toast('请选择一个地址');
            return false;
        }
        go_pay();
    });
    var pay_lock = false;
    function go_pay() {
        if (pay_lock) {
            return false;
        }
        pay_lock = true;

        $.showIndicator();
        var query = $("#pay_box").serialize();
        var url = $("#pay_box").attr("action");

        $.ajax({
            url: url,
            data:query,
            type: "POST",
            dataType: "json",
            success: function(data){
                $.hideIndicator();
                if(data.status==1) {
                    pay_lock = false;
                    $.router.load(data.jump, true);
                } else if (data.status == -2) {
                    $.toast(data.info);
                    setTimeout(function() {
                        pay_lock = false;
                        $.router.load(data.jump, true);
                    }, 2000);
                } else {
                    pay_lock = false;
                    $.alert(data.info);
                }
                ajaxing = false;
            },
            error:function(ajaxobj) {
                $.hideIndicator();

            }
        });
    }
 
});