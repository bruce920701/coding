<?php
class biz_vs_pay_itemsModule extends MainBaseModule
{
    /**
     * 团购订单列表
     **/
    public function index()
    {
        $GLOBALS['tmpl']->display("biz_vs_pay_items.html");
    }

}