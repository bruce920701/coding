$(document).on("pageInit", "#biz_vs_pay_items", function(e, pageId, $page) {
    //扫码弱提示
    $('.j-qrcode').on('click', function() {
        $.toast('请下载APP使用扫码功能')
    });
    select_box($(".j-vspay-popup"),$(".setting-box"));
    //
    price_count();
    function price_count() {
        var sum = 0;
        $(".vs_pay.active .u-txt").each(function() {
            sum += parseFloat($(this).parents().find(".u-txt").val() * $(this).parents().find(".vs-price").val());
        });
        sum = sum.toFixed(2);
        $('.price_all em').text(sum);
    }

    //切换
    $(".j-tab-link").on('click', function() {

        var $me = $(this);
        var rel = parseInt($(this).attr("rel"));
        $(".j-tab-link").removeClass("active");
        $me.addClass('active');
        var _index = $me.index();
        $('.vs_pay').removeClass('active');
        $('.vs_pay').eq(_index).addClass('active');
        $('.select-btn').addClass('hide');
        $('.select-btn').eq(_index).removeClass('hide');
        if ($me.hasClass("active")) {
            var ac_left = $(".j-tab-link.active").offset().left;
            $('.buttons-tab .tab-line').css("left", ac_left);
        }
        price_count();
    });
    var ac_left = $(".j-tab-link.active").offset().left;
    var ac_width = $(".j-tab-link.active").width();
    $('.buttons-tab .tab-line').css({ "left": ac_left, "width": ac_width });




    /*输入框加减按钮*/
    $(".j-add").click(function() {
        var val = parseInt($(this).parent().find(".u-txt").val());
        var id = parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var max = parseInt($(this).parent().find(".u-txt").attr("max"));
        var user_max = parseInt($(this).parent().find(".u-txt").attr("user_max_bought"));
        //var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        val++;
        var num = $(".u-txt[deal-id='" + id + "']").length;
        if (val >= max && max != -1) {
            val = max;
            $(this).addClass('u-reduce').removeClass('u-add');
        }
        if (val >= 2) {
            $(this).parent().find('.j-sub').addClass('u-add').removeClass('u-reduce');
        }
        $(this).parent().find(".u-txt").val(val);
        price_count()
    });
    $(".j-sub").click(function() {
        var val = $(this).parent().find(".u-txt").val();
        var user_min = parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        var id = parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var num = $(".u-txt[deal-id='" + id + "']").length;
        var max = parseInt($(this).parent().find(".u-txt").attr("max"));
        val--;
        if (val == 1) {
            $(this).addClass('u-reduce').removeClass('u-add');
        }
        if (val < max) {
            $(this).parent().find('j-add').addClass('u-add').removeClass('u-reduce');
        }
        if (val < 1) {
            val = 1;
            $.confirm('确定要删除这个宝贝吗？', function() {
                var id = parseInt($(this).parents(".service-list").attr("data-id"));

                $.ajax({
                    url: '',
                    data: id,
                    type: "post",
                    dataType: "json",
                    success: function(data) {
                        $(this).parents(".service-list").remove;
                    },
                    error: function() {}
                });


            });
        }
        $(this).parent().find(".u-txt").val(val);
        price_count()
    });
});