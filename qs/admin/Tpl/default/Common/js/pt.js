// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 吴庆祥
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-09-11 16:39
// +----------------------------------------------------------------------
$(document).ready(function () {
    $("#add_pt_goods").bind("click",function(){
        var action = $(this).attr('data-action');


        var html = '<table class="form" cellpadding=0 cellspacing=0 style="text-align:center;">' +
            '<tr><td class="topTd"></td></tr>' +
            '<tr><td><select name="deal_id" style="width:220px;padding-right:2px; "><option value="0">请输入商品信息搜索</option></select>' +
            '<input style="margin-left:4px;margin-right:4px;" type="text" name="deal_name" placeholder="请输入商品名称"><input type="button" class="search_button" value="搜索">' +
            '</td></tr>' +
            '</table>';
        $.weeboxs.open(html, {boxid:"dist_form",contentType:'text',showButton:true,title:"添加拼团商品",width:500,onopen:function(){
            $('.search_button').bind('click', function() {
                var sKey = $('input[name="deal_name"]').val();
                sKey = $.trim(sKey);
                if (!sKey) {
                    alert('请输入搜索关键字');
                    return false;
                }
                var query = {'key': sKey, 'ajax': 1};
                $.ajax({
                    url: deal_pt_search_url,
                    type: "POST",
                    data: query,
                    dataType: "json",
                    success: function(obj) {
                        if (obj.status) {
                            if(obj.data){
                                var html='<option value="0">未选择</option>';
                                obj.data.forEach(function(val){
                                    html+='<option value="'+val['id']+'">'+val['name']+'</option>';
                                })
                                $('select[name="deal_id"]').html(html);
                            }
                        } else {
                            alert(obj.info);
                        }
                    }
                });
            });
        }, onok: function() {
            // 确定按钮事件
            var did = $('select[name="deal_id"]').val();
            if (did == 0) {
                alert('请选择一个商品');
                return false;
            }
            var query = {'deal_id': did, 'ajax': 1};
            $.ajax({
                url: action,
                type: 'POST',
                data: query,
                dataType: 'json',
                success: function(obj) {
                    if (obj.status) {
                        $.weeboxs.close("dist_form");
                        alert(obj.info);
                        location.reload();
                    } else {
                        alert(obj.info);
                    }
                }
            })
        }});
    });
});
