<?php
namespace APP\Library\Common;

/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/9
 * Time: 23:31
 */
class CommonRoute
{
    //路由数组 格式:路由名称=>控制器名称
    public static $auth_route = array(
        'user#onlogin'=>array('User','onLogin'),
        'index#index'=>array('Index','index'),
        'demo#index'=>array('Demo','index'),
        'youhui#leys'=>array('Youhui','locationEntityYouhuis'),
        'youhui#youhuilist'=>array('Youhui','youhuiList'),
        'youhui#downloadyouhui'=>array('Youhui','downloadYouhui'),
        'ucyouhui#index'=>array('UcYouhui','index'),
        'ucyouhui#getlocation'=>array('UcYouhui','getLocation'),
        'uccenter#index'=>array('UcCenter','index'),
    );

    /**
     * 返回 controller 名称
     * @param string $module 调用的模型
     * @param string $action 调用的方法
     * @return mixed|string 一个数组或者一个字符串
     */
    public static function getController($module='',$action=''){
        $key = $module.'#'.$action;

        $res = self::$auth_route[$key];
        if (empty($res)){
            $res = self::$auth_route['index#index'];;
        }
        return $res;
    }

    /**
     * 获取格式化实际地址
     * @param string $route
     * @param array $param
     * @return string
     */
    public static function url($route="index#index",$param=array())
    {
        static $url_cache;
        $key = md5("URL_KEY_API_".$route.serialize($param));
        if($url_cache[$key]){
            return $url_cache[$key];
        }

        $route_array = explode("#",$route);

        if(isset($param)&&$param!=''&&!is_array($param))
        {
            $param['id'] = $param;
        }

        $ctl = strtolower(trim($route_array[0]));
        $act = strtolower(trim($route_array[1]));


        if(1==1)
        {
            $app_index = "api";

            //原始模式
            $url = APP_ROOT."/".$app_index.".php";
            if($ctl!=''||$act!=''||count($param)>0) //有后缀参数
            {
                $url.="?";
            }

            if($ctl&&$ctl!='')
                $url .= "ctl=".$ctl."&";
            if($act&&$act!='')
                $url .= "act=".$act."&";
            if(count($param)>0)
            {
                foreach($param as $k=>$v)
                {
                    if($k&&$v)
                        $url =$url.$k."=".urlencode($v)."&";
                }
            }
            if(substr($url,-1,1)=='&'||substr($url,-1,1)=='?') $url = substr($url,0,-1);
            $url_cache[$key] = $url;
            return $url;
        }
        else
        {
            //重写的默认
//            $url = APP_ROOT;
//
//            if($app_index!='index')
//                $url .= "/".$app_index;
//
//            if($module&&$module!='')
//                $url .= "/".$module;
//            if($action&&$action!='')
//                $url .= "/".$action;
//
//            if(count($param)>0)
//            {
//                $url.="/";
//                foreach($param as $k=>$v)
//                {
//                    if($k!='city')
//                        $url =$url.$k."-".urlencode($v)."-";
//                }
//            }
//
//            //过滤主要的应用url
//            if($app_index==app_conf("MAIN_APP"))
//                $url = str_replace("/".app_conf("MAIN_APP"),"",$url);
//
//            $route = $module."#".$action;
//            switch ($route)
//            {
//                case "xxx":
//                    break;
//                default:
//                    break;
//            }
//
//            if(substr($url,-1,1)=='/'||substr($url,-1,1)=='-') $url = substr($url,0,-1);
//
//
//            if($url=='')$url="/";
//            $GLOBALS[$key] = $url;
//            set_dynamic_cache($key,$url);
//            return $url;
        }


    }

}