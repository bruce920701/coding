<?php
namespace App\Library\Err;
/**
 * 错误字典类
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/15
 * Time: 17:27
 */
class ErrMap
{
    //错误字段常量
    private static $_errMap = array(
                        //数据库错误
                        1000=>'数据库连接失败',
                        1001=>'数据库插入数据失败',
                        1002=>'更新数据失败',
                        1003=>'执行query失败',
                        1004=>'执行fetchAll失败',
                        1005=>'执行fetch失败',
                        1006=>'执行fetchOnly失败',
                        1007=>'执行exec失败',

                        //用户错误信息
                        2001=>'会员不存在',
                        2002=>'用户创建失败',

                        //用户-微信相关
                        2201=>'微信获取session_key失败',

                        //门店错误信息
                        3001=>'门店不存在',

                        //参数错误
                        4001=>'id未传递',

                        //优惠券错误信息
                        5001=>'领取优惠券参数错误',
                        5002=>'优惠券不存在',
                    );

    /**
     * 根据错误码返回错误内容
     * @param $code
     * @return array
     */
    public static function get($code){
        if(isset(self::$_errMap[$code])){
            return array((0-$code),self::$_errMap[$code]);
        }
        return array((0-$code),'undefined this error code !');
    }

    public static function getMsg($code){
        if(isset(self::$_errMap[$code])){
            return self::$_errMap[$code];
        }
        return 'undefined this error code !';
    }
}