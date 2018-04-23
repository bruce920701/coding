// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 吴庆祥
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-05-08 19:07
// +----------------------------------------------------------------------
$(document).on("pageInit", "#uc_score_buy_score", function (e, pageId, $page) {
    //支付金额点击绑定
    $(".select_num").bind("click", function () {
        var money = getMoney($(this));
        if (!judge_account_money(money, 1))return;
        $(".money_number").removeClass("selected");
        $(this).addClass("selected");
        setScore(money);
		calFee();
    });
    if (score_number_array_other) {
        $(".select_other").picker({
            toolbarTemplate: '<header class="bar bar-nav">\
          <button class="button button-link pull-right close-picker">确定</button>\
          <h1 class="title">请选择金额</h1>\
          </header>',
            cols: [
                {
                    textAlign: 'center',
                    values: score_number_array_other
                }
            ],
            onClose: function () {
                var money = getMoney($(".select_other"));
                if (!judge_account_money(money, 0)) {
                    $(".select_other").val("");
                    return;
                } else {
                    setScore(money);
                }
            },
            onOpen: function () {
                var money = getMoney($(".select_other"));
                if (!judge_account_money(money, 0)) {
                    $(".select_other").picker("close");
                    return;
                }
                ;
                $(".money_number").removeClass("selected");
                $(".select_other").addClass("selected");
                setScore(money);
            }
        });
    }

    //支付按钮绑定
    $("input[name='all_account_money']").unbind('change').bind("change", function () {
        if (!$("#all_account_money").hasClass("active")){
            $("input[name='payment_id']").prop("checked",false);
            var money = getMoney();
            if (!judge_account_money(money, 1)) {
                $("input[name='all_account_money']").prop("checked", false);
                $("#all_account_money").removeClass("active");
                calFee();
                return;
            } else {
                calFee();
                $("#all_account_money").addClass("active");
            }
        }
    });
    $(".payment").unbind("click").bind("click", function () {
        $("input[name='payment_id']").prop("checked", false);
        $(this).siblings("input[name='payment_id']").prop("checked", true);
        $("input[name='all_account_money']").prop("checked", false);
        $("#all_account_money").removeClass("active");
        calFee();
    });
    $("#submit").bind("click", function () {
        var $form = $("form[name=buy_score]");
        //判断数据
        if ($(".money_number.selected").length < 1) {
            $.toast("请选择充值金额!");
            return;
        }
        if (!$("input[name=all_account_money]:checked").val() && !$("input[name=payment_id]:checked").val()) {
            $.toast("请选择充值方式!");
            return;
        }
        var url = $form.attr("data-action");
        var data = $form.serialize();
        $.ajax({
            url: url,
            data: data,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    if (data.app_index == 'wap') {  //SKD支付做好后，用 App.pay_sdk支付
                        if (data.pay_status == 1) {
                            $.router.load(data.jump, true);
                        } else {
                            location.href = data.jump;
                        }
                    } else if (data.app_index == 'app' && data.pay_status == 1) {  //APP余额支付
                        $.router.load(data.jump, true);

                    } else if (data.app_index == 'app' && data.pay_status == 0) {  //APP第三方支付
                        if (data.online_pay == 3) {
                            try {
                                var str = pay_sdk_json(data.sdk_code);
                                App.pay_sdk(str);
                            } catch (ex) {
                                $.toast(ex);
                                $.loadPage(location.href);
                            }
                        } else {
                            var pay_json = '{"open_url_type":"1","url":"' + data.jump + '","title":"' + data.title + '"}';
                            try {
                                App.open_type(pay_json);
                                $.confirm('已支付完成？', function () {
                                    $.loadPage(location.href);

                                }, function () {

                                    $.loadPage(location.href);
                                });
                            } catch (ex) {
                                $.toast(ex);
                                $.loadPage(location.href);
                            }
                        }
                    }
                } else {
                    $.alert(data.info);
                }
                return false;
            }, error: function () {
                $.showErr("服务器提交错误");
            }
        })

    });
    function intval(p) {
        if (!p)return 0;
        if (typeof p == "number") {
            return parseInt(p);
        } else if (typeof p == "string") {
            return parseInt(p.replace(/[^0-9\.]*/ig, ""));
        }
    }

    function getMoney($this) {
        if (!$this) {
            $this = $(".money_number.selected");
        }
        var money = 0;
        if ($this.hasClass("select_other")) {
            money = intval($this.val())
        } else {
            money = intval($this.attr("data-money"));
        }
        return money;
    }

    function setScore(val) {
        calFee();
        if (val) {
            $("input[name=money]").val(val);
            var usable = val * usable_score + "积分";
            var frozen = val * frozen_score + "积分";
        } else {
            $("input[name=money]").val(0);
            var usable = "请选择购买金额";
            var frozen = "请选择购买金额";
        }
        $(".usable").html(usable);
        $(".frozen").html(frozen);

    }

    function judge_account_money(money, money_number_selected) {
        if ($("input[name=all_account_money]:checked").val()) {
            if (intval($("input[name=all_account_money]:checked").val()) > money) {
                return 1;
            } else {
                $.toast("会员余额不足");
                if (!money_number_selected) {
                    setScore(0);
                }
                return 0;
            }
        } else {
            return 1;
        }
    }
    function calFee() {
        $('.fee-box').hide();
        var money = Number($("input[name=money]").val());
        var payment_id=Number($("input[name=payment_id]:checked").val());
        if(!payment_id || isNaN(payment_id) ||!money)return;

        var fee_type = Number($('#fee_type_'+payment_id).val());
        var fee_amount = Number($('#fee_amount_'+payment_id).val());

        var fee_money = 0;
        if (fee_type === 1) {
            fee_money = money * fee_amount;
        } else {
            fee_money = fee_amount;
        }
        fee_money = Math.round(fee_money * 100) / 100;
        if (fee_money > 0) {
            $('.fee-box .money').html(fee_money);
            $('.fee-box').show();
        }
    }
});
