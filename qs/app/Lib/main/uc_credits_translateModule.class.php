<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21 0021
 * Time: 9:38
 */

class uc_credits_translate{

    public function index()
    {
        global_run();
        init_app_page();
        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉

        if(check_save_login()!=LOGIN_STATUS_LOGINED)
        {
            app_redirect(url("index","user#login"));
        }
        $GLOBALS['tmpl']->assign("page_title","积分转账");

        $user_info = $GLOBALS['user_info'];
        $user_id = $user_info['id'];
        $user_detail = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_id);
        $current_register_credits = $user_detail['register_credits'];

        $GLOBALS['tmpl']->assign("register_credits",register_credits);
        assign_uc_nav_list();
        //$GLOBALS['tmpl']->display("uc/uc_credits_translate.html");

    }

    public  function translate()
    {

    }
}