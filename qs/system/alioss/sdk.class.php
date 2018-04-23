<?php 

require_once __DIR__.'/samples/Common.php';
/**
* -
*/
class ALIOSS
{
	private $ossClient;

	public function __construct()
	{
		$this->ossClient = Common::getOssClient();
	}

	public function set_debug_mode($bool)
	{
		# code...
	}
	

	public function upload_file_by_file($bucket, $object, $file_path)
	{
		return $this->ossClient->multiuploadFile($bucket, $object, $file_path, array());
	}
}