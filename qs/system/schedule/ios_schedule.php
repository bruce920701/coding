<?php

class ios_schedule{
	
	/**
	 * $data 格式
	 * array("dest"=>device_tokens,"content"=>序列化的消息配置);
	 */
	public function exec($data){

        fanwe_require(APP_ROOT_PATH.'system/model/umeng.php');
        $umeng = new Umeng();
        $umeng->setCustomizedField($data['param']);
        $data = $umeng->sendIos($data);
	
		$result = array();
		$result['status'] = $data['status'];
		$result['attemp'] = 0;
		$result['info'] = $data['info'];
		return $result;
	}
}
?>