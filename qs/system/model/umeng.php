<?php

/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/7/7
 * Time: 11:23
 * 友盟调用类
 */



class Umeng
{
    protected $appkey           = NULL;
    protected $appMasterSecret     = NULL;
    protected $timestamp        = NULL;
    protected $validation_token = NULL;
    protected $param = array();
    protected $production_mode = false;//false为测试模式，true为生产模式

    public function __construct()
    {
        $this->timestamp = strval(time());
    }

    /**
     * android 推送
     * @param $msg_item
     * array(
    'send_type'=> 3,  //3 android,4 ios
     *      'dest'=>''
     *      'content'=>'',
     * )
     * @param $cast_type 默认为单用户推送, 1:单用户,2:全部推送
     */
    public function sendAndroid($msg_item,$cast_type = 1){
        $this->appMasterSecret = $GLOBALS['db']->getOne("select val from ".DB_PREFIX."m_config where code = 'android_".$msg_item['prefix']."master_secret'");
        $this->appkey = $GLOBALS['db']->getOne("select val from ".DB_PREFIX."m_config where code = 'android_".$msg_item['prefix']."app_key'");

        //发送类型
        if($cast_type == 1){
            $result = $this->sendAndroidUnicast($msg_item);
        }elseif ($cast_type == 2){
            $result = $this->sendAndroidBroadcast($msg_item);
        }
        return $result;
    }


    /**
     * ios推送
     * @param $msg_item
     * array(
     *      'dest'=>''
     *      'content'=>'',
     * )
     * @param $cast_type 默认为单用户推送, 1:单用户,2:全部推送
     */
    public function sendIos($msg_item,$cast_type = 1){
        $this->appMasterSecret = $GLOBALS['db']->getOne("select val from ".DB_PREFIX."m_config where code = 'ios_".$msg_item['prefix']."master_secret'");
        $this->appkey = $GLOBALS['db']->getOne("select val from ".DB_PREFIX."m_config where code = 'ios_".$msg_item['prefix']."app_key'");

        //发送类型
        if($cast_type == 1){
            $result = $this->sendIOSUnicast($msg_item);
        }elseif ($cast_type == 2){
            $result = $this->sendIOSBroadcast($msg_item);
        }
        return $result;
    }

    /**
     * 设置自定义字段
     * @param $param
     */
    public function setCustomizedField($param){
        $this->param = $param;
    }

    //ios 批量发送
    function sendIOSBroadcast($msg_item) {



        fanwe_require(APP_ROOT_PATH.'system/umeng_v1.4/ios/IOSBroadcast.php');      //群发
        try {
            $brocast = new IOSBroadcast();
            $brocast->setAppMasterSecret($this->appMasterSecret);
            $brocast->setPredefinedKeyValue("appkey",           $this->appkey);
            $brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);

            $brocast->setPredefinedKeyValue("alert", $msg_item['content']);
            $brocast->setPredefinedKeyValue("badge", 0);
            $brocast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $brocast->setPredefinedKeyValue("production_mode", $this->production_mode);
            // Set customized fields
            if ($this->param){
                foreach ($this->param as $k=>$v){
                    $brocast->setCustomizedField($k, $v);
                }
            }
            //$brocast->setCustomizedField("test", "helloworld");
            //print("Sending broadcast notification, please wait...\r\n");
            $brocast->send();
//            print("Sent SUCCESS\r\n");
            $resutl['status'] = 1;
            $resutl['info'] = 'Sent SUCCESS';
//            print("Sent SUCCESS\r\n");
        } catch (Exception $e) {
            $resutl['status'] = 0;
            $resutl['info'] = "Caught exception: " . $e->getMessage();
        }
        return $resutl;
    }

    //ios 单独发送
    function sendIOSUnicast($msg_item) {
        $resutl = array();
        fanwe_require(APP_ROOT_PATH.'system/umeng_v1.4/ios/IOSUnicast.php');    //单发
        try {
            $unicast = new IOSUnicast();
            $unicast->setAppMasterSecret($this->appMasterSecret);
            $unicast->setPredefinedKeyValue("appkey",           $this->appkey);
            $unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);
            // Set your device tokens here
            $unicast->setPredefinedKeyValue("device_tokens",    $msg_item['device_token']);
            $unicast->setPredefinedKeyValue("alert", $msg_item['content']);
            $unicast->setPredefinedKeyValue("badge", 0);
            $unicast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $unicast->setPredefinedKeyValue("production_mode", $this->production_mode);
            // Set customized fields
            if ($this->param){
                foreach ($this->param as $k=>$v){
                    $unicast->setCustomizedField($k, $v);
                }
            }
            $unicast->send();

            $resutl['status'] = 1;
            $resutl['info'] = 'Sent SUCCESS';
        } catch (Exception $e) {
            $resutl['status'] = 0;
            $resutl['info'] = "Caught exception: " . $e->getMessage();
        }
        return $resutl;
    }

    //android 批量发送
    function sendAndroidBroadcast($msg_item) {
        fanwe_require(APP_ROOT_PATH.'system/umeng_v1.4/android/AndroidBroadcast.php');  //群发
        try {
            $brocast = new AndroidBroadcast();
            $brocast->setAppMasterSecret($this->appMasterSecret);
            $brocast->setPredefinedKeyValue("appkey",           $this->appkey);
            $brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);
            $brocast->setPredefinedKeyValue("ticker",           $msg_item['content']);
            $brocast->setPredefinedKeyValue("title",            $msg_item['content']);
            $brocast->setPredefinedKeyValue("text",             $msg_item['content']);
            $brocast->setPredefinedKeyValue("after_open",       "go_app");
            // Set 'production_mode' to 'false' if it's a test device.
            // For how to register a test device, please see the developer doc.
            $brocast->setPredefinedKeyValue("production_mode", $this->production_mode);
            // [optional]Set extra fields
            if ($this->param){
                foreach ($this->param as $k=>$v){
                    $brocast->setExtraField($k, $v);
                }
            }
//            $brocast->setExtraField("test", "helloworld");
//            print("Sending broadcast notification, please wait...\r\n");
            $brocast->send();
//            print("Sent SUCCESS\r\n");
            $resutl['status'] = 1;
            $resutl['info'] = 'Sent SUCCESS';
//            print("Sent SUCCESS\r\n");
        } catch (Exception $e) {
            $resutl['status'] = 0;
            $resutl['info'] = "Caught exception: " . $e->getMessage();
        }
        return $resutl;
    }

    //android 单独发送
    function sendAndroidUnicast($msg_item) {

        fanwe_require(APP_ROOT_PATH.'system/umeng_v1.4/android/AndroidUnicast.php');    //单发
        try {
            $unicast = new AndroidUnicast();
            $unicast->setAppMasterSecret($this->appMasterSecret);
            $unicast->setPredefinedKeyValue("appkey",           $this->appkey);
            $unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);
            // Set your device tokens here
            $unicast->setPredefinedKeyValue("device_tokens",    $msg_item['device_token']);
            $unicast->setPredefinedKeyValue("ticker",           $msg_item['content']);
            $unicast->setPredefinedKeyValue("title",            $msg_item['content']);
            $unicast->setPredefinedKeyValue("text",             $msg_item['content']);
            $unicast->setPredefinedKeyValue("after_open",       "go_app");
            // Set 'production_mode' to 'false' if it's a test device.
            // For how to register a test device, please see the developer doc.
            $unicast->setPredefinedKeyValue("production_mode", $this->production_mode);
            // Set extra fields
            if ($this->param){
                foreach ($this->param as $k=>$v){
                    $unicast->setExtraField($k, $v);
                }
            }
//            $unicast->setExtraField("test", "helloworld");
//            print("Sending unicast notification, please wait...\r\n");

            $unicast->send();
            $resutl['status'] = 1;
            $resutl['info'] = 'Sent SUCCESS';
        } catch (Exception $e) {
            $resutl['status'] = 0;
            $resutl['info'] = "Caught exception: " . $e->getMessage();
        }
        return $resutl;
    }

}