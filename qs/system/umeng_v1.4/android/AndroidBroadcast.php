<?php
fanwe_require(APP_ROOT_PATH.'system/umeng_v1.4/AndroidNotification.php');
class AndroidBroadcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}