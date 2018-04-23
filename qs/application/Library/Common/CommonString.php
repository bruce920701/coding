<?php
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/17
 * Time: 10:43
 */

namespace App\Library\Common;

/**
 * 字符串相关处理类
 * Class Common_String
 * @package App\Library\Common
 */
class CommonString
{
    /**
     * 距离转化，300.555转为'3km'
     * @param int $distance
     * @return string
     */
    public static function getDistanceStr($distance=0){
        $distance_str = "";
        if($distance>0) {
            if($distance>1000) {
                $distance_str .= round($distance/1000, 2)."km";
            } else {
                $distance_str .= round($distance)."m";
            }
        }
        return $distance_str;
    }

    /**
     * 过滤掉emoji表情
     * @param $str
     * @return mixed
     */
    public static function filterEmoji($str)
    {
        $str = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $str);

        return $str;
    }
}