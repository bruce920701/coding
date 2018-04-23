<?php
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/22
 * Time: 17:07
 */

namespace App\Library\Common;

/**
 * 会员返利相关类
 * Class CommonUserFanli
 * @package App\Library\Common
 */
class CommonUserFanli
{
    public static function resgister($user_id){
        $register_money = floatval(app_conf("USER_REGISTER_MONEY"));
        $register_score = intval(app_conf("USER_REGISTER_SCORE"));
        $register_point = intval(app_conf("USER_REGISTER_POINT"));
        if($register_money>0||$register_score>0 || $register_point>0)
        {
            $user_get['score'] = $register_score;
            $user_get['money'] = $register_money;
            $user_get['point'] = $register_point;
            modify_account($user_get,intval($user_id),"在".to_date(NOW_TIME)."注册成功");
        }
        fanwe_require(APP_ROOT_PATH.'system/msg/msg.php');
        $msgClass = new \Msg();
        $content="您已成功注册，成为".app_conf("SHOP_TITLE")."的会员";
        $msgClass->send_msg($user_id,$content,"notify",array("type"=>1));
    }


}