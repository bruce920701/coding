// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 吴庆祥
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-08-08 09:58
// +----------------------------------------------------------------------
$(document).ready(function () {
    initAddClick();
});
//全选
function CheckAll(tableID)
{
    var checked=$("#check").attr("checked");
    if(checked){
        checked=true;
    }else{
        checked=false;
    }
    $("#"+tableID).find(".key").attr("checked",checked);
}

function initAddClick(){
    $("#add_presell_goods").bind("click",function(){
        var action = $(this).attr('data-action');
        var html = '<table class="form" cellpadding=0 cellspacing=0 style="text-align:center;">' +
            '<tr><td class="topTd"></td></tr>' +
            '<tr><td><select name="deal_id" style="width:220px;padding-right:2px; "><option value="0">请输入商品信息搜索</option></select>' +
            '<input style="margin-left:4px;margin-right:4px;" type="text" name="deal_name" placeholder="请输入商品名称"><input type="button" class="search_button" value="搜索">' +
            '</td></tr>' +
            '</table>';
        $.weeboxs.open(html, {boxid:"dist_form",contentType:'text',showButton:true, showCancel:true, showOk:true,type:'wee',title:"添加预售商品",width:500,onopen:function(){
            init_ui_button();
            $('.search_button').bind('click', function() {
                var sKey = $('input[name="deal_name"]').val();
                sKey = $.trim(sKey);
                if (!sKey) {
                    alert('请输入搜索关键字');
                    return false;
                }
                var query = {'key': sKey, 'is_ajax': 1};
                $.ajax({
                    url: deal_presell_search_url,
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
}
function foreverdel(id)
{
    if(!id)
    {
        idBox = $(".key:checked");
        if(idBox.length == 0)
        {
            $.showErr("未选择要删除商品");
            return;
        }
        idArray = new Array();
        $.each( idBox, function(i, n){
            idArray.push($(n).val());
        });
        id = idArray.join(",");
    }
    $.showConfirm("确认删除预售商品？",function(){
        var query = new Object();
        query.act = "foreverdelete";
        query.id = id;
        $.ajax({
            url:AJAX_URL,
            data:query,
            dataType:"json",
            type:"POST",
            success: function(obj){
                $("#info").html(obj.info);
                if(obj.status==1)
                    location.href=location.href;
            }
        })
    })

}