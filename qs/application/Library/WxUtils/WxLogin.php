<?php
namespace App\Library\WxUtils;
use App\Library\Common\CommonSession;
use App\Library\DB\DB;
use App\Library\Err\ErrMap;
use Curl\Curl;
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/17
 * Time: 12:06
 */
class WxLogin
{
    const SESSION_KEY_URL = 'https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code';


    public static $appid;
    public static $appsecret;
    public static $code;
    public static $openid;
    public static $unionid;
    public static $session_key;
    public static $resession;
    public static $iv;

    public function __construct()
    {
        if (!isset(self::$appid)){
            $sql = "select code,val from ".DB_PREFIX."m_config where code=? or code=?";
            $data = DB::fetchAll($sql,array('wxapp_appid','wxapp_secrit'));
            foreach($data as $item){
                $wx_conf[$item['code']] = $item['val'];
            }
            self::$appid = $wx_conf['wxapp_appid'];
            self::$appsecret = $wx_conf['wxapp_secrit'];
        }

    }

    /**
     * 根据code 生成3rd session
     * @return string
     */
    public function get3RdSession(){

        $url = str_replace(array('APPID','SECRET','JSCODE'),
            array(self::$appid,self::$appsecret,self::$code),self::SESSION_KEY_URL);
        //$rdsession_key=`head -n 80 /dev/urandom | tr -dc A-Za-z0-9 | head -c 168`;
        $rdsession_key = $this->randomFromDev(168);
        $curl = new Curl();
        $curl_data = $curl->get($url);
        $curl_data = json_decode($curl_data->response,true);
        //模拟数据
        //$analog_data = '{"openid": "OPENID","session_key": "SESSIONKEY","unionid": "UNIONID"}';

        $res = array();
        if($curl_data['errcode']){
            \logger::write(ErrMap::getMsg(2201).print_r($curl_data,1),'EMERG',3,'weixin_err');
            $rdsession_key = '';
        }else{
            self::$openid = $curl_data['openid'];
            self::$unionid = $curl_data['unionid'];
            self::$session_key = $curl_data['session_key'];

            $res = array('openid'=>self::$openid,'unionid'=>self::$unionid,'session_key'=>self::$session_key,'rdsession_key'=>$rdsession_key);
        }

        return $res;

    }

    public function setCode($code){
        self::$code = $code;
    }

    public function setIv($iv){
        self::$iv = $iv;
    }

    public function checkSign($rawData,$signature){
        $signature2 = sha1($rawData.self::$session_key);
        if ($signature2 !== $signature) return ['code'=>ErrorCode::$SignNotMatch, 'message'=>'签名不匹配'];
    }


    /**
     * 解码
     * @param $session_key
     */
    public function getDecryptData($encryptedData){
        $data = array();
        require_once APP_ROOT_PATH."/application/Library/WxUtils/WxBizDataCrypt.php";
        $pc = new \WxBizDataCrypt(self::$appid, self::$session_key);
        $errCode = $pc->decryptData($encryptedData, self::$iv, $data );

        if ($errCode == 0) {
            return $data;
        } else {
            return $errCode;
        }
    }

    /**
     * 读取/dev/urandom获取随机数
     * @param $len
     * @return mixed|string
     */
    private function randomFromDev($len) {
        try{
            $fp = fopen('/dev/urandom','rb');
            $result = '';
            if ($fp !== FALSE) {
                $result .= fread($fp, $len);
                fclose($fp);
            }
            else
            {
                trigger_error('Can not open /dev/urandom.');
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }

        // convert from binary to string
        $result = base64_encode($result);
        // remove none url chars
        $result = strtr($result, '+/', '-_');

        return substr($result, 0, $len);
    }
}