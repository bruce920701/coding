<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21 0021
 * Time: 11:31
 */


class testModule extends MainBaseModule
{

    public function index()
    {
        global_run();
        init_app_page();
        $user_info = $GLOBALS['user_info'];
        //var_dump($user_info);
        //echo json_encode($user_info);

        $user_id = $user_info['id'];

        $login_ip = "127.0.0.1";
        $user_detail = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."user where id>160");

        $result = $GLOBALS['db']->query("select * from ".DB_PREFIX."user where id>100");
        $result_2 = array();
        while($result_1 = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $result_2[] = $result_1;
        }

        echo json_encode($result_2);
        //echo json_encode($user_detail);

    }
}