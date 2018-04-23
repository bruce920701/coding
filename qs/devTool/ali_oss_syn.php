<?php 
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


//同步本地文件至阿里oss
define("FILE_PATH", __DIR__); //文件目录，空为根目录

$system_init_file = dirname(__DIR__).'/system/system_init.php';
require_once $system_init_file;

set_time_limit(0);

$ossScriptPath = dirname(__DIR__).'/system/alioss/samples/FanweOss.php';
include $ossScriptPath;