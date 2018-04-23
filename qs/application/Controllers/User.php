<?php
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/16
 * Time: 08:55
 */

namespace App\Controllers;
use App\Library\Common\CommonRequest;
use App\Library\Common\CommonSession;
use App\Library\Err\ErrMap;
use App\Models\UserModel;
use App\Library\WxUtils\WxLogin;

class User
{
    public function onlogin(){
        //通过rdsession 验证用户
//        $wx_obj = new WxLogin();
//        $wx_obj->setCode('071RdwBf2D3McE0iFgEf232uBf2RdwBm');
//        $wx_obj->setVi('ScuJbS+DcIdfJdTWyRdF2A==');
//        $wx_obj::$session_key = 'pBi/eemjFrf3Q+5NpzDv5g==';
//        $res = $wx_obj->checkSign('{"nickName":"jobin","gender":1,"language":"zh_CN","city":"Fuzhou","province":"Fujian","country":"China","avatarUrl":"https://wx.qlogo.cn/mmopen/ajNVdqHZLLAA5GrVx1Y97J2KQ9jJyyRRmKqicjzWCdiccQ17JmGcCf1DAJdcYYYfSiac0EiaNl67ib11v5V0ibRK5gog/0"}',"1198c97092db4d24180524f183f88d75946fdc26");
//print_r($wx_obj->getDecryptData("vfCDhhpsg4d8sHCcYZ6QTlUbmU56vrFqT64pVweoR3qov2nbL7i1RYO+KFGyuDOSwGF+kWawOP1Cedfg6V/f9iTn81IbnLOlaBvywhHyYmPT/s6HtmUeWwuydvKr6hV2REl6W8YgefBedoRJKzQLA85h3v+C9RlS4lA3KxS8q+E3B0+6croigGqT7dufKTIryv0GfDg9i4eykrh6Lym9aVZyNdRW90YUAZ0kZp8KiMyoLYhYoJVuxzJTCOHK37s8mJQkleVpLzCHzjdLmWxVhH2SgMNISl2viusIwWMK1M1N1rKfjwJlKy7xQor4C8cipT+RaRrEp0WiwD27rYpEq8byI4gErPdEQ0mMWVJI6Q6QEwJrUiOHj1HFTj+Ikdu4av1qFhhUFay9zA6xD4c6VpuEn1fPI9ozs8I7A2K6fB09EdGqITYdJpUHkHZmXiW3up/Zchw4Uv69RuFUHonjKA=="));
//
//        exit;
        $rdsession_key = CommonRequest::postRequest('rdsession_key');

        if($rdsession_key){
            $wxdata = CommonSession::get($rdsession_key);
        }

        $rel = array();
        if ($wxdata){
            $user_obj = new UserModel();
            $user_obj::setOpenid($wxdata['openid']);
            $user_obj::setUnionid($wxdata['unionid']);
            $user_info = $user_obj->checkUser();
            self::autoLogin($user_info,$wxdata);
            UserModel::$errmsg = $user_info['user_name'].'登陆成功';
        }else{

            //首次登陆用户
            $code = CommonRequest::postRequest('code');
            $iv = CommonRequest::postRequest('iv');
            $encryptedData = CommonRequest::postRequest('encryptedData');
            $rawData = CommonRequest::postRequest('rawData');
            $signature = CommonRequest::postRequest('signature');

            $wx_obj = new WxLogin();
            $wx_obj->setCode($code);
            $wx_obj->setIv($iv);

            $data = $wx_obj->get3RdSession();

            $rel['rdsession_key'] = $data['rdsession_key'];
            if(empty($data)){
                list(UserModel::$errno,UserModel::$errmsg) = ErrMap::get(2201);
            }else{
                $user_obj = new UserModel();
                $user_obj::setOpenid($data['openid']);
                $user_obj::setUnionid($data['unionid']);

                $user_info = $user_obj->checkUser();
                $wx_obj->checkSign($rawData,$signature);
                if($user_info){
                    self::autoLogin($user_info,$data);
                }else{
                    if($check_res = $wx_obj->checkSign($rawData,$signature)<0){
                        UserModel::$errmsg = $check_res;
                    }else{
                        $wx_user_info = json_decode($wx_obj->getDecryptData($encryptedData),true);
                        CommonSession::set('wx_user_info',$wx_user_info);
                        $new_user_info = $user_obj->createUser($wx_user_info);
                        if(!empty($new_user_info)){
                            self::autoLogin($new_user_info,$data);
                            if(UserModel::$errno==0)
                                UserModel::$errmsg = $new_user_info['user_name'].'登陆成功';
                        }
                    }

                }
            }


        }
        CommonRequest::reponse(UserModel::$errno,UserModel::$errmsg,$rel);

    }


    private function autoLogin($user_info,$data){
        CommonSession::set($data['rdsession_key'],
            array(
                'session_key'=>$data['session_key'],
                'openid'=>$data['openid'],
                'unionid'=>$data['unionid']
            )
        );

        CommonSession::set('user_info',$user_info);
    }

}