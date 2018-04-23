<?php
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/14
 * Time: 21:49
 */
define("FILE_PATH",""); //文件目录，空为根目录
require_once './system/system_init.php';
require APP_ROOT_PATH.'/vendor/autoload.php';

use App\Bootstrap;
//实例化一个网站应用实例
$App = new Bootstrap();
