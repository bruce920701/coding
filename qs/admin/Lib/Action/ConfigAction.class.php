<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2 0002
 * Time: 9:06
 */

class ConfigAction extends CommonAction{

    public function index()
    {
        $config = '"default"';
        $sql = "select * from ".DB_PREFIX."global_config where config=".$config;
        //echo $sql;
        $config = $GLOBALS['db']->getRow($sql);
        //var_dump($config);
        $this->assign("config",$config);
        $this->display();

    }

    public function do_update()
    {
        $post_data = $_POST;
        foreach($post_data as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }

        $config = '"default"';
        foreach($post_data as $k=>$v)
        {
            $sql = "update ".DB_PREFIX."global_config set ".$k."=".$v." where config=".$config;
            $GLOBALS['db']->query($sql);
        }
    }

}