<?php 
require_once __DIR__.'/Common.php';

define('IS_CLI', (false !== strpos(PHP_SAPI, 'cli')) ? 1 : 0);

define('OSS_SITE_ROOT', substr(__DIR__, 0, strpos(__DIR__, 'system') - 1));

/**
* 自定义的oss同步类
* 根据官方SDK调整，目前只做同步图片，且为本地未裁剪过的图片（文件名不包含_00×00等样式、文件后缀为(gif|png|jpg|jpeg)的文件）过滤的条件在OssUtil::isValidImg (OssUtil.php #429)
*/
class FanweOss
{
	private $ossClient;

	private $bucket;

	private $deep = 2; // 目录需要遍历的深度

	private $currDeep = 0;

	private $ossDir = '';

	private $localSiteRoot = '/'; // 本地图片的根目录，绝对路径

	private $subImgDirs = array();  // 需要上传的目录

	private $localDirArr = array();

	private $exclude = array('.', '..', '.svn', '.git');

	private $synedDirArr = array();

	private $failedListFile;

	private $successListFile;

	private $successList = array();

	private $linebreak = "\n";

	public function __construct()
	{
		$this->ossClient = Common::getOssClient();
		$this->bucket = Common::getBucketName();
		$this->ossDir = Common::getDirectory();
		if (is_null($this->ossClient)) {
			exit(1);
		}

		$platform = PHP_OS;
		if (stripos($platform, 'win') !== false) {
			$this->linebreak = "\r\n";
		}
		$this->localSiteRoot = OSS_SITE_ROOT;
	}

	public function setConfig($config = array())
	{
		if (isset($config['subDirs'])) {
			$this->subImgDirs = $config['subDirs'];
		}
		if (isset($config['deep'])) {
			$this->deep = intval($config['deep']);
		}
		if (isset($config['ossDir'])) {
			$this->ossDir = $config['ossDir'];
		}
		if (isset($config['exclude'])) {
			$exclude_array = explode('|', $exclude);
			$this->exclude = array_unique(array_merge($this->exclude, $exclude_array));
		}
		if (isset($config['maxRetries'])) {
			$this->ossClient->setMaxTries(intval($config['maxRetries']));
		}
		$logDir = 'public';
		if (isset($config['logDir'])) {
			$logDir = $config['logDir'];
		}
		$logDir = rtrim($this->localSiteRoot, '/').'/'.ltrim($logDir, '/');
		$this->failedListFile = $logDir.'/failedFile.txt';
		$this->successListFile = $logDir.'/ossSuccessDir.txt';
		if (is_file($this->successListFile)) {
			$content = file_get_contents($this->successListFile);
			if ($content) {
				$this->successList = explode($this->linebreak, $content);
			}
		}
	}


	public function readDir($dir)
	{
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if (!in_array(strtolower($file), $this->exclude)) {
					$newDir = $dir.'/'.$file;
					if (is_dir($newDir)) {
						$scanRes = scandir($newDir); 
						if ($scanRes === false || count($scanRes) <= 2) { // 判断当前目录是否为空
							continue;
						}
						if ($this->currDeep < $this->deep) {
							$this->currDeep++;
							$this->readDir($newDir);
						} else {
							if (!in_array($newDir, $this->successList)) {
								$this->localDirArr[] = array('path' => $newDir);
							}
						}
					} elseif (!in_array($newDir, $this->successList)) {
						$this->localDirArr[] = array('path' => $newDir);
					}
				}
			}
			closedir($handle);
		}
	}

	/**
	 * 按目录同步
	 * @return  
	 */
	public function upload_dir()
	{
		foreach ($this->subImgDirs as $sdir) {
			$absDir = rtrim($this->localSiteRoot,'/').'/'.ltrim($sdir, '/');
			
			if (is_dir($absDir)) {
				$this->readDir($absDir);
			} else {
				$this->localDirArr[] = array('path', $absDir);
			}
		}

		if ($this->localDirArr) {
			foreach ($this->localDirArr as $dir) {
				$path = $dir['path'];
				$object = str_replace($this->localSiteRoot, '', $path);
				if ($this->ossDir) {
					$object = rtrim($this->ossDir, '/').'/'.ltrim($object, '/');
				} else {
					$object = ltrim($object, '/');
				}
				
				// echo 'local: '.$path.'-- object: '.$object.$this->linebreak;
				try {
					if (is_dir($path)) {
						$result = $this->ossClient->uploadDir($this->bucket, $object, $path, implode('|', $this->exclude), true);
						if (!empty($result['failedList'])) {
							$failedArray = array_keys($result['failedList']);
							$failedStr = implode($this->linebreak, $failedArray);
							file_put_contents($this->failedListFile, $failedStr.$this->linebreak, FILE_APPEND|LOCK_EX);
							Common::println("Failed to upload local dir '". $path."'");
							Common::println('Failed reason: '.current($result['failedList']));
							if (defined('IS_CLI') && IS_CLI) {
								Common::println("If you want to try these dir again, add argument '-rf' when exec script!");
							}
							
						} else {
							file_put_contents($this->successListFile, $path.$this->linebreak, FILE_APPEND|LOCK_EX);
							Common::println("local dir ".$path.' is uploaded to the bucket '.$this->bucket.', '.$object);
						}
					} else {
						$this->ossClient->multiuploadFile($this->bucket, $object, $path, array());
					}
				} catch (OssException $e) {
					printf(__FUNCTION__ . ": $path upload FAILED ".$this->linebreak);
				    printf($e->getMessage() . $this->linebreak);
				    file_put_contents($this->failedListFile, $object.$this->linebreak, FILE_APPEND|LOCK_EX);
				}
			}
			echo $this->linebreak."------done------". $this->linebreak;
		}
	}

	/**
	 * 此方法用于继续同步按目录同步出现失败的图片，当前仅在CLI模式下使用
	 * @return  
	 */
	public function retryFailedFile()
	{
		if (is_file($this->failedListFile)) {
			$content = file_get_contents($this->failedListFile);
			if ($content) {
				@unlink($this->failedListFile);
				$content = trim($content, $this->linebreak);
				$lists = explode($this->linebreak, $content);
				$failedNum = 0;
				foreach ($lists as $object) {
					$object = str_replace('/\\', '/', $object);
					
					$localPath = rtrim($this->localSiteRoot, '/').'/'.str_replace($this->ossDir.'/', '', $object);
					
					try {
						$this->ossClient->multiuploadFile($this->bucket, $object, $localPath, array());
					} catch (OssException $e) {
						printf(__FUNCTION__ . ": $localPath upload FAILED ". $this->linebreak);
				        printf($e->getMessage() . $this->linebreak);
				        file_put_contents($this->failedListFile, $object.$this->linebreak, FILE_APPEND|LOCK_EX);
				        $failedNum++;
					}
				}
				if ($failedNum > 0) {
					Common::println("There was some file upload failed, if you want to try again, exec the last command again!!". $this->linebreak);
				}
			}
		}
	}

}

$config = array(
	'subDirs' => array( // 需要上传的图片目录
		'public',
		// 'public/avatar',
		// 'public/comment',
		// 'public/attachment',
		// 'public/images'
	),
	'deep' => 2, // 目录深度，越大表示同步的目录越小
	'maxRetries' => 2, // 每次同步操作的最大尝试次数
	'logDir' => 'public', // 上传日志记录的目录，注意要有读写权限
);


$method = 'upload_dir';
if ($argc == 2 && $argv[1] == '-rf') {
 // CLI(command line interface)模式下的而外操作方法，只要用于处理按目录同步出现失败的文件，
 // 使用方法: /path/to/php __FILE__ -rf
	$method = 'retryFailedFile';
}


$fanweOss = new FanweOss();
$fanweOss->setConfig($config);
$fanweOss->$method();
