<?php
;
class sms_schedule{
	
	/**
	 * $data 格式
	 * array("dest"=>xxxxx,"content"=>xxxxxx,"type"=>xxxx);//type 0.短信 1.会员站内信
	 */
	public function exec($data){
		
		//短信
        $type=intval($data['type']);
        logger($data);
		if($type==0){
            $return=$this->_sendShortMessage($data);
        }else{
            $return=$this->_sendUserMessage($data);
        }
        logger($return);
		$result['status'] = intval($return['status']);
		$result['attemp'] = 0;
		$result['info'] = $return['msg'];
		return $result;
				
    }

    /**
     * @desc  发送短信
     * @author    吴庆祥
     * @param $data
     * @return mixed
     */
    private function _sendShortMessage($data){
        fanwe_require(APP_ROOT_PATH."system/utils/es_sms.php");
        $sms = new sms_sender();
        $return = $sms->sendSms($data['dest'],$data['content']);
        return $return;
    }

    /**
     * @desc 发送会员站内信
     * @author    吴庆祥
     * @param $data
     * @return array
     */
    private function _sendUserMessage($data){
        send_msg($data['dest'],$data['content'],"notify",0);
        return array("status"=>1,"msg"=>"处理成功");
    }
}
