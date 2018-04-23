<?php

// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


// 上门服务的公共方法
/**
 * 门店上门服务的预订时间格式化方法
 * @param  int  $location_id 门店的id
 * @param  integer $chooseTime  选择的时间 格式 id-2017-08-31
 * @return [type]               [description]
 */
function formatVSTimes($location_id, $chooseTime = 0)
{
	// 日期模板
	$formatDateAndWeekday = formatDateAndWeekday();
	$keyRsDate = array_keys($formatDateAndWeekday);

	// 门店设置的预约时间
	$location_id = intval($location_id);
	$serviceTimeSql = 'SELECT * FROM '.DB_PREFIX.'supplier_location_service_time WHERE location_id='.$location_id;
	$serviceTimes = $GLOBALS['db']->getAll($serviceTimeSql);
	foreach ($serviceTimes as &$time) {
		$begin_time_h = $time['begin_time_h'] < 10 ? '0'.$time['begin_time_h'] : $time['begin_time_h'];
		$begin_time_m = $time['begin_time_m'] < 10 ? '0'.$time['begin_time_m'] : $time['begin_time_m'];
		$end_time_h = $time['end_time_h'] < 10 ? '0'.$time['end_time_h'] : $time['end_time_h'];
		$end_time_m = $time['end_time_m'] < 10 ? '0'.$time['end_time_m'] : $time['end_time_m'];
		$time['rsTime'] = $begin_time_h.':'.$begin_time_m.'-'.$end_time_h.':'.$end_time_m;
	}unset($time);

	// 门店已经预约的时间
	$orderTimeSql = 'SELECT * FROM '.DB_PREFIX.'vs_order_time WHERE location_id='.$location_id.' AND rs_date in('.implode(',', $keyRsDate).')';
	$orderTime = $GLOBALS['db']->getAll($orderTimeSql);
	$formatOrderTime = array();
	foreach ($orderTime as $ot) {
		$formatOrderTime[$ot['rs_date']][$ot['time_id']] = $ot;
	}

	if (!empty($chooseTime)) {
		$chooseTimeArr = explode('-', $chooseTime, 2);
	}

	foreach ($formatDateAndWeekday as $dateKey => &$dateItem) {
		$newItemList = array();
		$timeChoose = 0;
		foreach ($serviceTimes as $stime) {
			$is_effect = 1;

			$itemDateTime = $dateKey.' '.$stime['end_time_h'].':'.$stime['end_time_m'];
			$itemTimestamp = to_timespan($itemDateTime);
			
			if ($itemTimestamp < NOW_TIME) {
				$is_effect = 0;
			}
			$buyCount = 0;
			if (in_array($stime['id'], $formatOrderTime[$dateKey])) {
				$buyCount = $formatOrderTime[$dateKey][$stime['id']]['buy_count'];
			}

			if ($buyCount >= $stime['limit_num']) {
				$is_effect = 0;
			}
			$stime['is_effect'] = $is_effect;
			$stime['is_choose'] = 0;
			if (!empty($chooseTime)) {
				if ($chooseTimeArr[0] == $stime['id'] && $chooseTimeArr[1] == $dateKey) {
					$stime['is_choose'] = 1;
					$timeChoose = 1;
				}
			}
			
			$newItemList[$stime['id']] = $stime;
		}
		if (empty($newItemList)) {
			unset($formatDateAndWeekday[$dateKey]);
			continue;
		}
		$dateItem['timeChoose'] = $timeChoose;
		$dateItem['serviceTimes'] = $newItemList;
	}unset($dateItem);
	return $formatDateAndWeekday;
}


function formatDateAndWeekday($start = 0)
{
	$start = intval($start);
	if ($start == 0) {
		$start = time();//NOW_TIME;
	}
	
	$origDateStr = date('Y-m-d', $start);
	// $weekdayIndex = date('w', $start);
	$objDate = date_create($origDateStr);
	$returnDate = array();
	$returnDate[$origDateStr] = array('weekday' => '今天', 'shortDate' => date_format($objDate, 'm-d'));
	for ($i=0; $i < 6; $i++) { 
		date_add($objDate, date_interval_create_from_date_string('1 day'));
		$currentDateStr = date_format($objDate, 'Y-m-d');
		$currentWeekday = getWeekday(date_format($objDate, 'w'));
		$currentShortDate = date_format($objDate, 'm-d');
		$returnDate[$currentDateStr] = array('weekday' => $currentWeekday, 'shortDate' => $currentShortDate);
	}
	return $returnDate;
}

function getWeekday($index)
{
	$weekdayStr = array(
		'周天', '周一', '周二', '周三', '周四', '周五', '周六'
	);
	$index = intval($index) % 7;
	return $weekdayStr[$index];
}


/**
 * 支付表单更新
 * @param  int $notice_id 支付单id
 * @return int            支付结果
 */
function vsPaymentPaid($notice_id)
{
	try {
		// $GLOBALS['db']->query('START TRANSACTION');
		$step = 0;
		$dbInfo = false;
		$notice_id = intval($notice_id);
		$noticeInfoSql = 'SELECT * FROM '.DB_PREFIX.'payment_notice WHERE id='.$notice_id;
		$noticeInfo = $GLOBALS['db']->getRow($noticeInfoSql);
		if ($noticeInfo['is_paid'] == 1) {
			throw new Exception('支付单已支付');
		}
		$orderInfoSql = 'SELECT * FROM '.DB_PREFIX.'vservice_order WHERE id='.$noticeInfo['order_id'];
		$orderInfo = $GLOBALS['db']->getRow($orderInfoSql);
		if ($orderInfo['is_delete'] == 1 || $orderInfo['is_cancel'] != 0) {
			throw new Exception('订单已取消或删除');
		}
		if ($orderInfo['pay_status'] == 2 || ($orderInfo['order_status'] == 0 && $orderInfo['pay_amount'] == $orderInfo['subscription'])) {
			// 支付完成的订单或者已经支付定金的订单
			throw new Exception('订单已支付');
		}
		$dbInfo = true;
        $step++; // 1  支付单更新
		// 更新支付表单信息
		$updateNoticeSql = 'UPDATE '.DB_PREFIX.'payment_notice SET pay_time = '.NOW_TIME.', is_paid=1 WHERE id='.$notice_id;
		$GLOBALS['db']->query($updateNoticeSql);
		$noticeRst = $GLOBALS['db']->affected_rows();
		if (!$noticeRst) {
			throw new Exception('更新支付单失败');
		}

        $step++; // 2 订单更新
		$updateOrderSql = 'UPDATE '.DB_PREFIX.'vservice_order SET pay_amount=pay_amount+'.$noticeInfo['money'].' WHERE id='.$orderInfo['id'].'';
		$GLOBALS['db']->query($updateOrderSql);
		$orderRst = $GLOBALS['db']->affected_rows();
		if (!$orderRst) {
			throw new Exception('订单表更新失败');
		}

        $step++; // 3 支付方式总额变更
		$paymentSql = 'SELECT class_name FROM '.DB_PREFIX.'payment_notice WHERE id='.$noticeInfo['payment_id'];
		$paymentInfo = $GLOBALS['db']->getRow($paymentSql);
		$updatePaymentSql = 'UPDATE '.DB_PREFIX.'payment SET total_amount=total_amount+'.$noticeInfo['money'].' WHERE class_name="'.$paymentInfo['class_name'];
		$GLOBALS['db']->query($updatePaymentSql);
		$paymentRst = $GLOBALS['db']->affected_rows();
		if (!$paymentRst) {
		    throw new Exception('支付方式总额更新失败');
        }

        return 1;

	} catch (Exception $e) {
		// $GLOBALS['db']->query('ROLLBACK')
        serviceDebugLog($e->getMessage(), $dbInfo);
        switch ($step) { // 模拟回滚
            case 3: // 支付方式总额更新失败
                $rollOrderSql = 'UPDATE '.DB_PREFIX.'vservice_order SET pay_amount=pay_amount-'.$noticeInfo['money'].' WHERE id='.$orderInfo['id'].'';
                $GLOBALS['db']->query($rollOrderSql);
            case 2: // 订单更新失败
                $rollNoticeSql = 'UPDATE '.DB_PREFIX.'payment_notice SET pay_time=0, is_paid=0 WHERE id='.$notice_id;
        }
        return 0;
	}
}

function visit_service_order_paid($order_id)
{
	try {
		$dbInfo = false;
		$orderInfoSql = 'SELECT * FROM '.DB_PREFIX.'vservice_order WHERE id='.$order_id;

		$orderInfo = $GLOBALS['db']->getRow($orderInfoSql);
		if ($orderInfo['is_delete'] == 1 || $orderInfo['is_cancel'] != 0) {
			throw new Exception('订单已取消或删除');
		}

		if ($orderInfo['pay_status'] == 2 || ($orderInfo['pay_status'] == 1 && $orderInfo['pay_status'] < 3)) {
			return false;
		}
		
		$update = array('update_time' => NOW_TIME);
		$msg = '';
		if ($orderInfo['pay_status'] == 0 && $orderInfo['pay_amount'] == $orderInfo['subscription']) { // 支付定金
			$update['pay_status'] = 1;
			$update['order_status'] = 1;
			$msg = '支付定金';
		} elseif ($orderInfo['pay_status'] == 1 && $orderInfo['pay_amount'] == $orderInfo['total_price']) {
			$update['pay_status'] = 2;
			$update['order_status'] = 4;
			$msg = '支付尾款';
		}
		if (isset($update['pay_status'])) {
			$GLOBALS['db']->autoExecute(DB_PREFIX.'vservice_order', $update, 'UPDATE', 'id='.$orderInfo['id']);
			$updateRst = $GLOBALS['db']->affected_rows();
			if (!$updateRst) {
				$dbInfo = true;
				throw new Exception($msg.'订单状态更新失败');
			}
			$orderLog = $orderInfo['order_sn'].$msg.'完成';
			vs_order_log($orderLog, $orderInfo['id']);
			return true;
		}
	} catch (Exception $e) {
		serviceDebugLog($e->getMessage(), $dbInfo);
	}
	return false;
	
}


function vs_order_log($log_info, $order_id)
{
	$data['id'] = 0;
	$data['log_info'] = $log_info;
	$data['log_time'] = NOW_TIME;
	$data['order_id'] = $order_id;
	$GLOBALS['db']->autoExecute(DB_PREFIX."vservice_order_log", $data);
}

/**
 * 更新门店已预约的服务数量
 * @param  int  $order_id 订单id
 * @param  integer $num      更新的数量
 * @return boolean            
 */
function updateVSOrderTimes($location_id, $time_id, $num=1)
{
	try {
		$order_info = getVSOrderInfo($order_id, $user_id, false);
		$num = intval($num);
		$updateTimeSql = 'UPDATE '.DB_PREFIX.'vservice_order_time SET buy_count=buy_count+('.$num.') WHERE location_id='.$location_id.' AND time_id='.$time_id;
		$GLOBALS['db']->query($updateTimeSql);
		$updateRst = $GLOBALS['db']->affected_rows();
		if (!$updateRst) {
			throw new Exception('预约数量统计更新失败');
		}
		return true;
	} catch (Exception $e) {
		serviceDebugLog($e->getMessage());
	}
	return false;
}

/**
 * 变更订单状态并更新相应的统计数量
 * @param  int $order_id 
 * @param  int $status   
 * @return            
 */
function vsOrderStatusChange($order_id, $status)
{
	try {
		$order_id = intval($order_id);
		$orderInfo = getVSOrderInfo($order_id);
		$orderStatus = $orderInfo['order_status'];
		$status = intval($status);
		
		if ($status < 2 && $status > 5) {
			return false;
		}
		$update = array(
			'update_time' => NOW_TIME,
			'order_status' => $status
		);

		$GLOBALS['db']->autoExecute(DB_PREFIX.'vservice_order', $update, 'UPDATE', 'id='.$orderInfo['id']);
		$updateRst = $GLOBALS['db']->affected_rows();
		if (!$updateRst) {
			throw new Exception('订单状态更新失败');
		}
		$orderLogs = array(
			2 => '已接单',
			3 => '服务中',
			4 => '服务完',
			5 => '已评价'
		);
		$orderLog = $orderInfo['order_sn'].$orderLogs[$status];
		vs_order_log($orderLog, $orderInfo['id']);
		return true;

	} catch (Exception $e) {
		serviceDebugLog($e->getMessage());
	}
	return false;
}

function cancelVSOrder($order_id, $user_id = 0)
{
	try {
		$orderInfo = getVSOrderInfo($order_id, $user_id);
		if ($orderInfo['pay_status'] == 2 || ($orderInfo['pay_status'] == 1 && $orderInfo['order_status'] >= 3)) {
			throw new Exception('该订单无法进行取消操作');
		}
		$update = array('update_time' => NOW_TIME);
		$cancelStatus = 0;
		if ($orderInfo['pay_status'] == 0) {// 未支付的订单
			$cancelStatus = 1;
		} elseif ($update['pay_status'] == 1) {
			$cancelStatus = 2;
		}
		if ($cancelStatus > 0) {
			$update['is_cancel'] = $cancelStatus;
			$GLOBALS['db']->autoExecute(DB_PREFIX.'vservice_order', $update, 'UPDATE', 'id='.$orderInfo['id']);
			$updateRst = $GLOBALS['db']->affected_rows();
			if (!$updateRst) {
				throw new Exception('订单无法取消，请刷新重试');
			}
			if ($cancelStatus == 1) {
				return true;
			} else { // 已付款的订单取消
				$pay_amount = $orderInfo['pay_amount'];
				modify_account(array('money'=>$pay_amount), $orderInfo['user_id'], $orderInfo['order_sn'].'订单取消，'.format_price($pay_amount).'已退到会员余额');
				$update = array(
					'refund_status' => 2,
					'refund_money'  => $pay_amount
				);
				$GLOBALS['db']->autoExecute(DB_PREFIX.'vservice_order', $update, 'UPDATE', 'id='.$orderInfo['id']);
				if (!$GLOBALS['db']->affected_rows()) {
					// throw new Exception('退款后订单状态变更失败');
				}
				// 统计的预约数量减1
				updateVSOrderTimes($orderInfo['location_id'], $orderInfo['sub_time_id'], -1);
				return true;
			}
		}
	} catch (Exception $e) {
		serviceDebugLog($e->getMessage());
	}
	return false;
}

/**
 * 获取订单的信息
 * @param  integer  $order_id    订单id
 * @param  integer $user_id     会员id
 * @param  boolean $cancelCheck 是否需要判断取消状态,默认要
 * @return array               
 */
function getVSOrderInfo($order_id, $user_id = 0, $cancelCheck = true)
{
	$order_id = intval($order_id);
	$orderInfoSql = 'SELECT * FROM '.DB_PREFIX.'vservice_order WHERE id='.$order_id.' AND is_delete=0';
	$user_id = intval($user_id);
	if ($user_id > 0) {
		$orderInfoSql .= ' AND user_id='.$user_id;
	}
	$orderInfo = $GLOBALS['db']->getRow($orderInfoSql);
	if (empty($orderInfo)) {
		throw new Exception('订单不存在或已删除');
	}
	if ($cancelCheck && $orderInfo['is_cancel'] != 0) {
		throw new Exception('订单已取消');
	}
	return $orderInfo;
}

function serviceDebugLog($message, $dbInfo = true)
{
	if (is_array($message)) {
		$message = print_r($message, 1);
	}
	if ($dbInfo) {
		$message .= ': '.$GLOBALS['db']->error().'; SQL: '.$GLOBALS['db']->getLastSql();
	}
	logger::write($message, 'ERR', '3', 'vservice');
}