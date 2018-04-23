<?php
namespace App\Library\Common;
/**
 * 关于请求管理公共类
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/10
 * Time: 00:08
 */
class CommonRequest
{
    /**
     * 获取request 请求连接内容
     * @param string $key 变量名称
     * @param null $default 变量默认值
     * @param null $type 额外参数获取请求类型
     * @return null|string
     */
    public static function request($key='',$default=null,$type=null){
        if($type == 'get'){
            $result = isset($_GET[ $key ]) ? self::stripslashes_deep($_GET[ $key ]):null;
        }elseif($type == 'post'){
            $result = isset($_POST[ $key ]) ? self::stripslashes_deep($_POST[ $key ]):null;
        }else{
            $result = isset($_REQUEST[ $key ]) ? self::stripslashes_deep($_REQUEST[ $key ]):null;
        }

        if ($default!=null && $result == null){
            $result = $default;
        }
        return $result;
    }

    /**
     * 获取所有的$_REQUEST 内容
     * @return array|string
     */
    public static function getRequestAll(){
        return self::stripslashes_deep($_REQUEST);
    }


    /**
     * 获取get请求内容
     * @param string $key
     * @param null $default
     * @return null|string
     */
    public static function getRequest($key='',$default=null){
        return self::request($key,$default,'get');
    }

    /**
     * 获取post请求内容
     * @param $key
     * @param $default
     * @return null|string
     */
    public static function postRequest($key,$default=null){
        return self::request($key,$default,'post');
    }

    /**
     * json格式返回API内容
     * @param int $errno
     * @param string $errmsg
     * @param array $data
     */
    public static function reponse($errno=0,$errmsg='',$data=array()){
        $rep = array(
            'errno'=>$errno,
            'errmsg'=>$errmsg
        );
        if ($data){
            $rep['data']=$data;
        }
        $rep['session_id'] = CommonSession::$sess_id;
        echo json_encode($rep);
        exit;
    }

    /**
     * 除转义反斜线后的字符串
     */
    private static function stripslashes_deep($value)
    {
        $value = is_array($value) ?
                    array_map(function($data){
                        return self::stripslashes_deep($data);
                    }, $value) :
                    stripslashes($value);

        return $value;
    }

}