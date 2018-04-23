<?php
namespace App;

use App\Library\Common\CommonRoute;
use App\Library\Common\CommonRequest;
use App\Library\Common\CommonSession;

const CTL = 'ctl';
const ACT = 'act';
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/14
 * Time: 21:52
 */
class Bootstrap
{
    private $api_data;

    //网站项目构造
    public function __construct(){

        //获取session_id 设置固定session
        $session_id = CommonRequest::request('session_id');
        if ($session_id){
            CommonSession::set_sessid($session_id);
            CommonSession::restart();
        }

        $module = strtolower($_REQUEST[CTL]?$_REQUEST[CTL]:"index");
        $action = strtolower($_REQUEST[ACT]?$_REQUEST[ACT]:"index");

        $module = filter_ctl_act_req($module);
        $action = filter_ctl_act_req($action);
        list($controller_name,$action_name) = CommonRoute::getController($module,$action);

//        echo APP_ROOT_PATH.'application/controllers/'.$controller_name.'.php';
//        echo $controller_name;exit;

        $namespase_name = 'App\\Controllers\\'.$controller_name;
        $controller_obj = new $namespase_name();
        $this->api_data = $controller_obj->$action_name();
    }

    public function data()
    {
        return $this->api_data;
    }

    public function __destruct()
    {
        unset($this);
    }
}