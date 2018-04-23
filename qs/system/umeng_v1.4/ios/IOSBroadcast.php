<?php
fanwe_require(APP_ROOT_PATH.'system/umeng_v1.4/IOSNotification.php');
class IOSBroadcast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}