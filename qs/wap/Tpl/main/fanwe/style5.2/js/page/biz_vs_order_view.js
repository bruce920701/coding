$(document).on("pageInit", "#biz_vs_order_view", function(e, pageId, $page) {
    var t1= parseInt($(".j-data-time").attr('data-time'));
    
    var leftGRObj = setInterval(GetRTime,1000);
    function GetRTime(){
      var t= $(".j-data-time").attr('data-time');
      var is_load = $(".j-data-time").attr('is_load');
      if(is_load==1){
          var d=0;
          var h=0;
          var m=0;
          var s=0;

            d=Math.floor(t/60/60/24);
            h=Math.floor(t/60/60%24);
            m=Math.floor(t/60%60);
            s=Math.floor(t%60);
            if (d>0) {
                $(".j-data-time .j-time").html(d + "天" + h +"小时" + m +"分钟" + s +"秒");
            } else {
                $(".j-data-time .j-time").html(h +"小时" + m +"分钟" + s +"秒");
            }
            if (h<1) {
                $(".j-data-time .j-time").html(m +"分钟" + s +"秒");
            }
            
            if (m<1) {
                $(".j-data-time .j-time").html(s +"秒");
            }

            if(t==0){

                $(".j-data-time .j-time").html("0秒");
                $(".pay_btn").addClass('no_pay_btn').removeClass('pay_btn').attr('error_tip','支付超时').attr('href','javascript:void(0)');     
                clearInterval(leftGRObj);
                $.loadPage(location.href);
                
            }
            t = t -1;
            $(".j-data-time").attr('data-time',t);
      }else{
          $(".j-data-time .j-time").html("0秒");
          clearInterval(leftGRObj);
      }
  
    }
    //打开送货时间选择
    $(".j-open-time").on('click', function() {
        $(".dc-mask").addClass('active');
        $(".time-select").addClass('active');
        var send_time=$(this).find('input').attr('value');
        $(".j-time-choose").each(function() {
            if ($(this).attr('value')==send_time) {
                $(this).addClass('active');
            }
        });
    });
    //关闭送货时间选择
    $(".j-close-time").on('click', function() {
        $(".dc-mask").removeClass('active');
        $(".time-select").removeClass('active');
    });
    //选择日期
    $(".j-day-item").on('click', function() {
        $(".j-day-item").removeClass('active');
        $(this).addClass('active');
        $(".time-select .select-time").removeClass("vs-show");
        $(".time-select .select-time").eq($(this).index()).addClass("vs-show");
    });
    //选择时间
    $(".j-time-choose").on('click', function() {
        $(".j-time-choose").removeClass('active');
        $(this).addClass('active');
        $(".j-send-day").html($(".j-day-item").eq($(this).parent().index()).find('p').html());
        $(".j-send-time").html($(this).find('p').html());
        $("#time-value").attr('value', $(this).attr('value'));
    });
    
    // 关闭弹层
    $(document).off('click', '.j-close-select');
    $(document).on('click', '.j-close-select', function() {
        $(".m-select-box").removeClass('active');
        $(".m-mask").removeClass('active');
    });
    // 工作日志文本框
    var _close=false;
    $(document).on('click',".j-work-log",function () {
        if($(".workArea textarea").val()){
           $(".workTitle-fill").html($(".workArea textarea").val());
        }
        if(_close==false){
            $('.workArea').show();
            return _close=true;
        }
        if(_close==true){
            $('.workArea').hide();
            return _close=false;
        }
    });

    $('#biz_vs_order_view .workBox .workArea textarea').on('input propertychange', function() {
        var that = $(this),
            _val = that.val();
        if (_val.length > 100) {
            that.val(_val.substring(0, 100));
        }
    });
});