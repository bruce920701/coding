<?php
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/16
 * Time: 17:14
 */

namespace App\Controllers;
use App\Library\DB\DB;

class Demo
{

    public function index(){
        $db = DB::getDb();
        echo DB::insert('fanwe_store_pay_order_log',
            array('log_info'=>'jobin','log_time'=>'13131312','order_id'=>rand(0,19999).'1231'));

        echo "<pre>";

        DB::setFetchType('FETCH_BOUND');

        $sql = "select * from fanwe_store_pay_order_log WHERE log_info=?";
        $res = DB::fetch($sql,array('jobin2'));
        $res = DB::fetchAll($sql,array('jobin2'));
        $res = DB::fetchOnly($sql,array('jobin2'));
        print_r($res);
        echo "</pre>";
        exit;
        $sql  = 'select * from fanwe_user limit 100';
        $users =  DB::query($sql);
        var_dump($users);exit;
        $users = array('jobin','kkkf','wjfekja');
        CommonRequest::reponse(0,'',$users);

    }

}