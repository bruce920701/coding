<?php
namespace App\Models;
use App\Library\Common\CommonString;
use App\Library\DB\DB;
use App\Library\Err\ErrMap;

/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/16
 * Time: 08:55
 */
class UserModel extends DB
{
    public static $openid;      //公众号唯一id
    public static $unionid;     //开放平台唯一id
    public static $user_info;   //用户信息
    public static $user_icon;   //用户头像


    public static function setOpenid($openid){
        self::$openid = $openid;
    }
    public static function setUnionid($unionid){
        self::$unionid = $unionid;
    }


    /**
     * 检查用户是否存在
     * @param int $unionid_or_openiud 两种ID 模式
     * @return array
     */
    public function checkUser(){
        $res = array();

        if(self::fetchOnly("select value from ".DB_PREFIX."weixin_conf where name = ? ",array('platform_status'))){//开启开放平台
            $res = self::fetch("select * from ".DB_PREFIX."user where unionid = '".self::$unionid."'");
        }else{
            $res = self::fetch("select * from ".DB_PREFIX."user where wx_openid = '".self::$openid."'");
        }

        return $res;
    }

    public function createUser($user_info = array(),$type='wx'){

        $user_data = array();

        if($type == 'wx'){ //微信接口来源数据
            $user_data['user_name'] = strim(CommonString::filterEmoji($user_info['nickName']));
            $user_avatar = $user_info['avatarUrl'];
            $user_data['sex'] = $user_info['gender']>0?($user_info['gender']==1?1:0):-1; //微信过来数据//性别 0：未知、1：男、2：女  系统数据 -1:未知,0:女,1:男

        }else{//其他渠道来源用户
            $user_name = $user_info['user_name'];
            if (empty($user_name)){
                $user_data['user_name'] = self::getRoundUserName();
            }
        }

        $user_data['user_pwd'] = md5($user_name.NOW_TIME);
        $user_data['create_time'] = NOW_TIME;
        $user_data['update_time'] = NOW_TIME;
        $user_data['login_ip'] = CLIENT_IP;
        $user_data['login_time'] = NOW_TIME;
        $user_data['is_tmp'] = 1;
        $user_data['pid'] = $GLOBALS['ref_uid'];
        $user_data['is_effect'] = 1;
        $user_data['wx_openid'] = self::$openid?self::$openid:'';
        $user_data['union_id'] = self::$unionid?self::$unionid:'';
        $run_count = 0;
        do{
            $user_data['user_name'] = $run_count>0?$user_data['user_name'].$run_count:$user_data['user_name'];
            $run_count++;
            $id = self::insert(DB_PREFIX."user",$user_data);
        }while(!$id && $run_count<10);

        if($id){
            $user_data['id'] =  $id;
            if($user_avatar)
                save_url_avatar($user_avatar,$id);
            self::clearErr();
        }else{
            //有可能用户插入失败
            $user_data = array();
            list(self::$errno,self::$errmsg) = ErrMap::get(2002);
        }
        return $user_data;
    }

    /**
     * 随机生成用户名
     * @return string
     */
    public function getRoundUserName(){
        $max_id = intval(DB::fetchOnly("select max(id) from ".DB_PREFIX."user"));
        $new_id = strval($max_id+1);
        //随机字符串
        $randStr = str_shuffle('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM');
        //毫秒时间
        list($usec, $sec) = explode(" ", microtime());
        $msec=round($usec*1000);
        //生成规则:三位随机(数字或者字母)+当前时间戳和毫秒拼接的MD5加密截取后9-用户id的位数 = 总共 11 位随机用户名
        $str = substr($randStr,0,3).substr(NOW_TIME.$msec,-(9-strlen($new_id))).$new_id;
        return $str;
    }
    
    
    


}