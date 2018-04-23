$(document).on("pageInit", "#supplier_register_edit", function (e, pageId, $page) {
    select_box($(".j-cate-select"), $(".j-cate-box"));
    $(".j-select-cate").on('click', function () {
        $(".supplier-bar .j-cate").html($(this).find('.j-cate').html());
        $("input[name=deal_cate_id]").val($(this).attr("value"));
    });
    function bind_select(){
        $(".j-open-address").on('click', function () {
            var $me = $(this);
            var region = '';
            var r2id = $('select[name="region_lv2"]').val(); // 获取地区的信息先定位地图
            if (r2id != 0) {
                region += $('option[value="' + r2id + '"]').html();
            } else {
                $.toast('请先选择省市区信息');
                return;
            }
            var r3id = $('select[name="region_lv3"]').val();
            if (r3id != 0) {
                region += $('option[value="' + r3id + '"]').html();
            } else {
                $.toast('请先选择省市区信息');
                return;
            }
            var r4id = $('select[name="region_lv4"]').val();
            if (r4id != 0) {
                region += $('option[value="' + r4id + '"]').html();
            }

                load_baidu_pick(region);



            $.popup('.address-popup');
        });
    }
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        window.HOST_TYPE = "2";
        window.BMap_loadScriptTime = (new Date).getTime();
        js.src = script_region_url;
        fjs.parentNode.insertBefore(js, fjs);
        js.onload=function(){
            bind_select();
        };
    }(document, 'script', 'script_region'));

    init_form_submit_wqx();
    init_supplier_register_add_region_ui_change();
    function init_form_submit_wqx(){
        $(".user_register_btn.active").bind("click",function(){
            $(this).removeClass("active");
            var $form=$("form[name=user_register_form]");
            var is_error = 1;
            var error_msg = '';
            if($("input[name=name]").val() == "") {
                error_msg = "商户名不能为空！";
            }else if(!$("input[name=h_license]").val()) {
                error_msg = "营业执照不能为空！";
            }else if(!$("input[name=h_supplier_logo]").val()) {
                error_msg = "商户图标不能为空！";
            }else if(!$("input[name=h_supplier_image]").val()) {
                error_msg = "门店图片不能为空！";
            }else if(!$("select[name=region_lv2]").val()){
                error_msg = "省份不能为空！";
            }else if(!$("select[name=region_lv3]").val()){
                error_msg = "城市不能为空！";
            }else if(!$("input[name=address]").val()){
                error_msg = "商户地址不能为空！";
            }else if($("#sms_verify").val()==""){
                error_msg = "验证码不能为空！";
            }else if($("input[name=name]").val()==""){
                error_msg = "商户名不能为空！";
            }else if($("input[name=deal_cate_id]").val()==""){
                error_msg = "所属分类不能为空！";
            }else if($("input[name=mobile]").val() == "") {
                error_msg = "请输入手机号！";
            }else if(!$("input[name=h_bank_name]").val()){
                error_msg = "请输入开户银行！";
            }else if(!$("input[name=h_bank_user]").val()){
                error_msg = "请输入银行卡开户人名称！";
            }else if(!$("input[name=h_bank_info]").val()){
                error_msg = "请输入银行卡号码！";
            }else{
                is_error=0;
            }

            if(is_error == 1) {
                $.toast(error_msg);
                return false;
            }
            var url = $form.attr("action");
            var query =$form.serialize();
            $.ajax({
                url : url,
                type : "POST",
                data : query,
                dataType : "json",
                success : function(data) {
                    if(data.status) {
                        $.toast(data.info);
                        setTimeout(function(){
                            if(data.jump){
                                $.router.load(data.jump, true);
                            }
                            $("#user_register_btn.active").addClass("active");
                        },1000);
                    } else {
                        $.toast(data.info);
                        setTimeout(function(){
                            if(data.jump){
                                $.router.load(data.jump, true);
                            }
                            $("#user_register_btn.active").addClass("active");
                        },1000);
                    }

                }
            });
        });
    }
    function load_baidu_pick(region) {

        // 百度地图API功能
        var map = new BMap.Map("baidu_allmap");

//        var orx = $('input[name="xpoint"]').val();
//        var ory = $('input[name="ypoint"]').val();
        var point = new BMap.Point(0, 0);
        map.centerAndZoom(point, 16);
        map.enableScrollWheelZoom(true);
        var myValue = '';

        var geoc = new BMap.Geocoder();

//        if (orx && ory) {
//            map.panTo(new BMap.Point(orx, ory));
//            getLoc();
//        } else {
            myValue = region;
            setPlace();
//        }

        map.addEventListener('moveend', getLoc); // 移动结束检索地区
        function getLoc() {
            var p = map.getCenter();
            geoc.getLocation(p, function (rs) {
                var addComp = rs.addressComponents;
                var lstr = /*addComp.province + addComp.city + addComp.district +*/ addComp.street + addComp.streetNumber;
                var sstr = addComp.street ? addComp.street : addComp.district;
                var surrPois = rs.surroundingPois;
                var cx = rs.point.lng;
                var cy = rs.point.lat;
                var res = '<div class="r-loca">';
                res += '<div class="b-line baidu-select-address click-select-address  selected close-popup" title="'+sstr+'" address="'+lstr+'" xpoint="'+cx+'" ypoint="'+cy+'" ><li class="loca-curr"><h3><i class="search-icon iconfont">&#xe62f;</i><em>[当前]</em>' + sstr + '</h3><p class="loca-curr">' + lstr + '</p></li></div>';
                if (surrPois) {
                    for (i in surrPois) {
                        var x = surrPois[i].point.lng;
                        var y = surrPois[i].point.lat;
                        res += '<div class="b-line baidu-select-address click-select-address close-popup" title="'+surrPois[i]['title']+'" address="'+surrPois[i]['address']+'" xpoint="'+x+'" ypoint="'+y+'"><li><h3><i class="search-icon iconfont">&#xe62f;</i>' + surrPois[i]['title'] + '</h3><p>' + surrPois[i]['address'] + '</p></li></div>';
                    }
                }
                res += '</div>'
                $('#baidu-m-result').html(res);
            });
        }
        $(".click-select-address").live("click",function(){
            if($(this).hasClass("baidu-select-address")){
                var $selected=$(this);
            }else{
                var $selected=$(".baidu-select-address.selected");
            }
            var addr=$selected.attr('address');
            var patt = /^([^(]*?省|)([^(]*?市|)([^(]*?(区|县)|)(.*)/;
            var mat = addr.match(patt);
            var addr1 = mat.pop();
            $('input[name="address"]').val(addr1);
            $('input[name="street"]').val($selected.attr("title"));
            $('input[name=xpoint]').val($selected.attr("xpoint"));
            $('input[name=ypoint]').val($selected.attr("ypoint"));
        });

        // 搜索方法
        var ac = new BMap.Autocomplete({'input': 'suggestId', 'location': map});
        ac.addEventListener('onhighlight', function (e) {
            var str = '';
            var _value = e.fromitem.value;
            var value = '';
            if (e.fromitem.index > -1) {
                value = _value.province + _value.city + _value.district + _value.street;
            }
            str = "FromItem<br />index = " + e.fromitem.index + "<br />value= " + value;

            value = "";
            if (e.toitem.index > -1) {
                _value = e.toitem.value;
                value = _value.province + _value.city + _value.district + _value.street + _value.business;
            }
            str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
            $("#baidu_searchResultPanel").html(str);
        });


        ac.addEventListener("onconfirm", function (e) {    //鼠标点击下拉列表后的事件
            var _value = e.item.value;
            myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
            $("#baidu_searchResultPanel").html("onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue);
            setPlace();
        });

        function setPlace() {
            function myFun() {
                var pp = local.getResults().getPoi(0);    //获取第一个智能搜索的结果
                if (!pp) {
                    $.toast('地址查询错误');
                    setTimeout(function () {
                        // var pro = myValue.substr(0, myValue.indexOf('省'));
                        // console.log(pro);
                        map.centerAndZoom('北京', 12);
                    }, 2000);

                    return;
                }
                map.centerAndZoom(pp.point, 18);
            }

            var local = new BMap.LocalSearch(map, { //智能搜索
                onSearchComplete: myFun
            });
            // local.clearResults();
            local.search(myValue);
        }

        // 添加定位控件
        var geolocationControl = new BMap.GeolocationControl({
            // 靠左上角位置
            anchor: BMAP_ANCHOR_BOTTOM_LEFT,
            // 是否显示定位信息面板
            showAddressBar: false,
            // 启用显示定位
            enableGeolocation: true
        });
        geolocationControl.addEventListener("locationSuccess", function (e) {
            // 定位成功事件
            /*var address = '';
             address += e.addressComponent.province;
             address += e.addressComponent.city;
             address += e.addressComponent.district;
             address += e.addressComponent.street;
             address += e.addressComponent.streetNumber;
             alert("当前定位地址为：" + address);*/
        });
        geolocationControl.addEventListener("locationError", function (e) {
            // 定位失败事件
            alert(e.message);
        });
        map.addControl(geolocationControl);

    }
    // 上传图片。
    $('.upload-image').bind('change', function() {
        var $me=$(this);
        var upName=$me.attr('up-name');
        lrz(this.files[0], {width: 200})
            .then(function(rst) {
                // 处理上传到后端的逻辑
                rst.formData.append('fileLen', rst.fileLen);
                $.ajax({
                    url: UPLOAD_URL,
                    data: rst.formData,
                    processData: false,
                    contentType: false,
                    dataType:"json",
                    type: 'POST',
                    success: function(obj) {
                        var data = obj;
                        if (data.error == 1000) {
                            $.router.load(LOGIN_URL, true);
                        } else if (data.error == 2000) {
                            $.toast('图片上传发生错误,跟换浏览器重试');
                        } else if (data.error > 0) {
                            $.toast('图片上传发生错误');
                        } else {
                            $('img[up-name='+upName+']').attr('src',data.absolute_url);
                            $('input[name='+upName+']').val(data.url);
                            $.toast('图片上传成功');
                        }
                    },
                    error: function(msg) {
                        $.toast('网络被风吹走了～');
                    }
                })
            })
            .catch(function(err) {
                // 捕获错误
                $.toast('数据异常,请重试');
            })
            .always(function() {
                // 总是会发生。要发生什么
            });
    });
    $(".app-upload-image").bind("click",function () {
        var $me=$(this);
        var upName=$me.attr('up-name');
        App.UploadImg(upName);
    });
    function init_supplier_register_add_region_ui_change() {
        $("select[name='region_lv2']").bind("change", function () {
            var id = $(this).val();
            $.post(load_city_url,{id:id},function(data){
                $("select[name='region_lv3']").html(data);
                if($("select[name='region_lv3']").find("option").length<2){
                    $("select[name='region_lv3']").hide();
                    $("select[name='region_lv4']").hide();
                }else{
                    $("select[name='region_lv3']").show();
                    $("select[name='region_lv4']").html("<option value='0'>==选择区县==</option>");
                }
            })
        });
        $("select[name='region_lv3']").bind("change", function () {
            var id = $(this).val();
            $.post(load_area_url,{id:id},function(data){
                $("select[name='region_lv4']").html(data);
                if($("select[name='region_lv4']").find("option").length<2){
                    $("select[name='region_lv4']").hide();
                }else{
                    $("select[name='region_lv4']").show();
                }
            })
        });
    }

});
