<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16 0016
 * Time: 11:50
 */


class active_codeModule extends MainBaseModule
{
    public function index()
    {
        global_run();
        init_app_page();
        $GLOBALS['tmpl']->assign("no_nav", true); //无分类下拉


    }

    public  function translate()
    {

    }

    public function  translate_done()
    {

    }
}

?>