<?php
namespace App\Models;
use App\Library\DB\DB;
use App\Library\Err\ErrMap;

/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/16
 * Time: 08:55
 */
class User extends DB
{
    /**
     * @return array|bool
     */
    public function doLogin(){

        if(1==2){
            list(self::$errno,self::$errmsg) = ErrMap::get(2001);
            return false;
        }

        $res = array();
        return $res;

    }

}