<?php

/**
 * 定期处理的杂项事务计划任务
 */
class gc_schedule
{

    /**
     * $data 格式
     * array();
     */
    public function exec($data)
    {
        $this->_cancelUnpayOrder();
        $this->_refundUnpayLeftmoneyInPresellOrder();
        send_schedule_plan("gc", "定时任务", array(), NOW_TIME);
        $result['status'] = 1;
        $result['attemp'] = 0;
        $result['info'] = "处理成功";
        return $result;
    }




}
