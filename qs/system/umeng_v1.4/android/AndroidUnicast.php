<?php
fanwe_require(APP_ROOT_PATH.'system/umeng_v1.4/AndroidNotification.php');
class AndroidUnicast extends AndroidNotification {
	function __construct() {
		parent::__construct();
		$this->data["type"] = "unicast";
		$this->data["device_tokens"] = NULL;
	}

}