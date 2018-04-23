<?php

if (is_file(__DIR__ . '/../autoload.php')) {
    require_once __DIR__ . '/../autoload.php';
}
if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}
// require_once __DIR__ . '/OssConfig.php';

use OSS\OssClient;
use OSS\Core\OssException;

/**
 * Class Common
 *
 * 示例程序【Samples/*.php】 的Common类，用于获取OssClient实例和其他公用方法
 */
class Common
{
    // const endpoint = OssConfig::OSS_ENDPOINT;
    // const accessKeyId = OssConfig::OSS_ACCESS_ID;
    // const accessKeySecret = OssConfig::OSS_ACCESS_KEY;
    // const bucket = OssConfig::OSS_TEST_BUCKET;
    // const directory = OssConfig::OSS_DIRECTORY;

    public static $endpoint = ''; // 经典网络内网域名，不含bucket,例: oss-cn-hangzhou-internal.aliyuncs.com
    public static $accessKeyId = '';
    public static $accessKeySecret = '';
    public static $bucket = '';
    public static $directory = '';

    public static function init()
    {
        $siteRoot = substr(__DIR__, 0, strpos(__DIR__, 'alioss'));
        $distcfgFile = $siteRoot.'dist_cfg.php';
        $distCfg = include $distcfgFile;

        /*$endpoint = str_replace($distCfg['OSS_BUCKET_NAME'].'.', '', $distCfg['OSS_DOMAIN']);
        if ($distCfg['OSS_DIRECTORY'] != '') {
            $endpoint = str_replace('/'.$distCfg['OSS_DIRECTORY'], '', $endpoint);
        }
        
        self::$endpoint = $endpoint;*/
        self::$accessKeyId = $distCfg['OSS_ACCESS_ID'];
        self::$accessKeySecret = $distCfg['OSS_ACCESS_KEY'];
        self::$bucket = $distCfg['OSS_BUCKET_NAME'];
        if (isset($distCfg['OSS_DIRECTORY'])) {
            self::$directory = $distCfg['OSS_DIRECTORY'];
        }
    }

    /**
     * 根据OssConfig配置，得到一个OssClient实例
     *
     * @return OssClient 一个OssClient实例
     */
    public static function getOssClient()
    {
        try {
            $ossClient = new OssClient(self::$accessKeyId, self::$accessKeySecret, self::$endpoint, false);
        } catch (OssException $e) {
            printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $ossClient;
    }

    public static function getBucketName()
    {
        // return self::bucket;
        return self::$bucket;
    }

    public static function getDirectory()
    {
        // return self::directory;
        return self::$directory;
    }

    /**
     * 工具方法，创建一个存储空间，如果发生异常直接exit
     */
    public static function createBucket()
    {
        $ossClient = self::getOssClient();
        if (is_null($ossClient)) exit(1);
        $bucket = self::getBucketName();
        $acl = OssClient::OSS_ACL_TYPE_PUBLIC_READ;
        try {
            $ossClient->createBucket($bucket, $acl);
        } catch (OssException $e) {

            $message = $e->getMessage();
            if (\OSS\Core\OssUtil::startsWith($message, 'http status: 403')) {
                echo "Please Check your AccessKeyId and AccessKeySecret" . "\n";
                exit(0);
            } elseif (strpos($message, "BucketAlreadyExists") !== false) {
                echo "Bucket already exists. Please check whether the bucket belongs to you, or it was visited with correct endpoint. " . "\n";
                exit(0);
            }
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        print(__FUNCTION__ . ": OK" . "\n");
    }

    public static function println($message)
    {
        if (!empty($message)) {
            echo strval($message) . "\n";
        }
    }
}

//Common::createBucket();
Common::init();