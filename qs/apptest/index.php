<?php
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/10
 * Time: 00:39
 */

require __DIR__ . '/../vendor/autoload.php';
use \Curl\Curl;

//$emil = new Email();


$_root = dirname($_SERVER['PHP_SELF']);
$_root = (($_root=='/' || $_root=='\\')?'':$_root);
if(defined("FILE_PATH"))
    $_root = str_replace(FILE_PATH,"",$_root);

$_root=str_replace("/apptest","",$_root);

$host = 'http://'.$_SERVER['SERVER_NAME'].$_root.'/api.php';
//echo $host;exit;
$curl = new Curl();
header("Content-Type:text/html;charset=utf-8");
echo "首页接口:";
/**
 * 首页接口验证
 */
$curl->get($host);

if ($curl->error) {
    echo $curl->error_code;
}
else {
    $rep = json_decode($curl->response,true); //true 转换为数组
    if($rep['errno'] == 0){
        echo '测试成功';
    }else{
        echo $rep['errmsg'];
    }
}

/////////////////////////////////////////////////////////////////
$host = 'http://'.$_SERVER['SERVER_NAME'].$_root.'/api.php';
//echo $host;exit;
$curl = new Curl();
header("Content-Type:text/html;charset=utf-8");
echo "<br />门店实体券接口:";
/**
 * 门店实体券接口验证
 */
$data=array('ctl'=>"youhui",'act'=>'leys','data_id'=>82);
$curl->get($host,$data);

if ($curl->error) {
    echo $curl->error_code;
}
else {
    $rep = json_decode($curl->response,true); //true 转换为数组
    if($rep['errno'] == 0){
        echo '测试成功';
    }else{
        echo $rep['errmsg'];
    }
}

$host = 'http://'.$_SERVER['SERVER_NAME'].$_root.'/api.php';
//echo $host;exit;
$curl = new Curl();
header("Content-Type:text/html;charset=utf-8");
echo "<br />领券中心接口:";
/**
 * 领券中心接口验证
 */
$data=array('ctl'=>"youhui",'act'=>'youhuiList');
$curl->get($host,$data);

if ($curl->error) {
    echo $curl->error_code;
}
else {
    $rep = json_decode($curl->response,true); //true 转换为数组
    if($rep['errno'] == 0){
        echo '测试成功';
    }else{
        echo $rep['errmsg'];
    }
}

$host = 'http://'.$_SERVER['SERVER_NAME'].$_root.'/api.php';
//echo $host;exit;
$curl = new Curl();
header("Content-Type:text/html;charset=utf-8");
echo "<br />领券接口:";
/**
 * 领券接口验证
 */
$data=array('ctl'=>"youhui",'act'=>'downloadyouhui');
$curl->get($host,$data);

if ($curl->error) {
    echo $curl->error_code;
}
else {
    $rep = json_decode($curl->response,true); //true 转换为数组
    if($rep['errno'] == 0){
        echo '测试成功';
    }else{
        echo $rep['errmsg'];
    }
}

$host = 'http://'.$_SERVER['SERVER_NAME'].$_root.'/api.php';
//echo $host;exit;
$curl = new Curl();
header("Content-Type:text/html;charset=utf-8");
echo "<br />我的优惠券接口:";
/**
 * 我的优惠券接口验证
 */
$data=array('ctl'=>"ucyouhui",'act'=>'index');
$curl->get($host,$data);

if ($curl->error) {
    echo $curl->error_code;
}
else {
    $rep = json_decode($curl->response,true); //true 转换为数组
    if($rep['errno'] == 0){
        echo '测试成功';
    }else{
        echo $rep['errmsg'];
    }
}

$host = 'http://'.$_SERVER['SERVER_NAME'].$_root.'/api.php';
//echo $host;exit;
$curl = new Curl();
header("Content-Type:text/html;charset=utf-8");
echo "<br />获得优惠券支持门店接口:";
/**
 * 获得优惠券支持门店接口验证
 */
$data=array('ctl'=>"ucyouhui",'act'=>'getlocation','data_id'=>18);
$curl->post($host,$data);

if ($curl->error) {
    echo $curl->error_code;
}
else {
    $rep = json_decode($curl->response,true); //true 转换为数组
    if($rep['errno'] == 0){
        echo '测试成功';
    }else{
        echo $rep['errmsg'];
    }
}


exit;