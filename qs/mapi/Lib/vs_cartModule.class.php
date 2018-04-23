<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


class vs_cartApiModule extends MainBaseApiModule
{
	public function index()
	{
		try {
			$root = array();
			$user_login_status = check_login();
			$root['user_login_status'] = $user_login_status;
			if($user_login_status != LOGIN_STATUS_LOGINED){
				throw new Exception('请先登录');
			}
			$user_info = $GLOBALS['user_info'];
			
			$request = $GLOBALS['request'];

			// 服务信息
			$id = intval($request['id']);
			$service_info = $this->getLocationServiceInfo($id);

			fanwe_require(APP_ROOT_PATH."system/model/visit_service.php");
			// 判断服务的销量和时间?
			$tid = intval($request['tid']);
			$rs_date = strim($request['rs_date']);
			$formatRsTime = $this->rsTimeCheck($tid, $rs_date);

			// 获取门店信息
			$location_info = $this->getLocationInfo($service_info['location_id']);

			$serviceTimesList = formatVSTimes($location_info['id'], $tid.'-'.$rs_date);

			// 会员地址信息
			$consignee_id = intval($request['consignee_id']);
			/*if ($consignee_id<=0) {
				$defaultConsigneeSql = 'SELECT id FROM '.DB_PREFIX.'user_consignee WHERE user_id='.$user_info['id'];
				$consignee_id = $GLOBALS['db']->getOne($defaultConsigneeSql);
			}
			$consignee_info = load_auto_cache("consignee_info", array("consignee_id" => $consignee_id));*/
			$consignee_info = $this->getConsigneeInfo($consignee_id);

			// 判断地址是否在商家服务范围内
			if (!$this->addressCheck($consignee_info, $location_info)) {
				$consignee_info = array();
			}

			// 服务信息格式化 图片、跳转地址、会员价等
			$service_info['service_img'] = get_abs_img_root(get_spec_image($service_info['service_img'],182,182,1));
			$user_price = $service_info['current_price'];
			$discount = getUserDiscount($user_info['id']);
			$user_price *= $discount;
			$service_info['format_user_price'] = format_price($user_price);
			$service_info['format_subscription'] = format_price($service_info['subscription']);
			$service_info['residue_money'] = $user_price - $service_info['subscription'];
			$service_info['format_residue'] = format_price($service_info['residue_money']);
			
			$root['service_info'] = $service_info;
			$root['location_info'] = $location_info;
			$root['serviceTimesList'] = $serviceTimesList;
			$root['formatRsTime'] = $formatRsTime;
			if ($consignee_info) {
				$root['consignee_info'] = $consignee_info;
			}
			
			return output($root);
		} catch (Exception $e) {
			$this->debugLog($e->getMessage());
			return output($root, 0, $e->getMessage());
		}
	}

	
	public function done()
	{
		try {
			// 一、验证参数
			// 1、登录验证
			$root = array();
			$user_login_status = check_login();
			$root['user_login_status'] = $user_login_status;
			if($user_login_status != LOGIN_STATUS_LOGINED){
				throw new Exception('请先登录');
			}
			$user_info = $GLOBALS['user_info'];

			$request = $GLOBALS['request'];
			$id = intval($request['id']);
			$service_info = $this->getLocationServiceInfo($id);

			fanwe_require(APP_ROOT_PATH."system/model/visit_service.php");
			// 判断服务的销量和时间?
			$tid = intval($request['tid']);
			$rs_date = strim($request['rs_date']);
			$formatRsTime = $this->rsTimeCheck($tid, $rs_date);

			// 获取门店信息
			$location_info = $this->getLocationInfo($service_info['location_id']);

			// 会员地址信息
			$consignee_id = intval($request['consignee_id']);
			$consignee_info = $this->getConsigneeInfo($consignee_id, true);

			// 判断地址是否在商家服务范围内
			if (!$this->addressCheck($consignee_info, $location_info)) {
				throw new Exception('所选地址不在商家服务范围内');
			}

			// 获得会员折扣
			$userDiscountPercent = getUserDiscount($user_info['id']);
			$discountPrice = $service_info['current_price'] * $userDiscountPercent;

			// 会员留言
			$memo = '';
			if (!empty($request['memo'])) {
				$memo = strim($request['memo']);
			}

			// 二、新增订单
			$order = array(
				'supplier_id' => $location_info['supplier_id'],
				'location_id' => $location_info['id'],
				'location_name' => $location_info['name'],
				'create_time' => NOW_TIME,
				'update_time' => NOW_TIME,
				'subscription' => $service_info['subscription'], // 定金
				// 'pay_status' => 0, // 未支付
				'pay_amount' => 0, // 已付总额
				'service_price' => $service_info['current_price'], // 服务金额
				'total_price' => $discountPrice, // 应付金额
				// 'order_status' => 0, // 订单状态
				'sub_time_id' => $tid, // 预约时间id
				'sub_start_time' => $formatRsTime['sub_start_time'], // 预约开始时间戳
				'sub_end_time' => $formatRsTime['sub_end_time'], // 预约结束时间戳

				'memo' => $memo, // 客户留言

				'consignee_id' => $consignee_info['id'], // 地址id
				'address' => $consignee_info['full_address'], // 地址
				'mobile' => $consignee_info['mobile'], // 联系手机
				'consignee' => $consignee_info['consignee'], // 联系人
				'xpoint' => $consignee_info['xpoint'], // 地址经度
				'ypoint' => $consignee_info['ypoint'], // 地址纬度
				'user_id' => $user_info['id'], // 下单会员id
			);

			$i = 1;
			do {
				if ($i >= 5) {
					$this->debugLog('服务订单生产失败');
					throw new Exception('订单生成失败，请刷新重试');
				}
				$order['order_sn'] = to_date(NOW_TIME, 'Ymdhis').rand(10,99);
				$GLOBALS['db']->autoExecute(DB_PREFIX.'vservice_order', $order, 'INSERT', '', 'SILENT');
				$order_id = intval($GLOBALS['db']->insert_id());
				$i++;
			} while ($order_id == 0);

			$order_item = array(
				'order_id' => $order_id,
				'service_id' => $service_info['id'],
				'service_name' => $service_info['name'],
				'service_img' => $service_info['service_img'],
				'number' => 1,
				'unit_price' => $service_info['current_price'], // 原单价
				'disu_price' => $discountPrice, // 会员价，如无会员价则等于原单价
				'disu_total_price' => $discountPrice, // 会员总价
				'type' => 0,
				'balance_money' => $service_info['balance_price'], // 结算价
			);
			$GLOBALS['db']->autoExecute(DB_PREFIX."vservice_order_item",$order_item,'INSERT','','SILENT');
			if ($GLOBALS['db']->errno()) {
				$this->debugLog('服务订单明细生产失败');
				throw new Exception('订单生成失败，请刷新重试.');
			}
			$root['id'] = $order_id;
			return output($root);
		} catch (Exception $e) {
			return output($root, 0, $e->getMessage());
		}
	}

	private function getLocationServiceInfo($id)
	{
		$service_sql = 'SELECT lsl.location_id, lsl.is_close, lsl.buy_count ,vs.* FROM '.DB_PREFIX.'supplier_location_service_link lsl INNER JOIN '.DB_PREFIX.'supplier_visiting_services vs ON lsl.supplier_vs_id=vs.id WHERE lsl.is_close=0 AND lsl.id='.$id;
		$service_info = $GLOBALS['db']->getRow($service_sql);
		if (empty($service_info)) {
			throw new Exception('门店服务不存在');
		}
		// $this->debugLog($service_sql, false);
		return $service_info;
	}

	private function getLocationInfo($location_id)
	{
		$location_sql = 'SELECT id,name,supplier_id,xpoints,ypoints FROM '.DB_PREFIX.'supplier_location WHERE id='.$location_id.' AND is_visiting_service=1 AND is_close=0';
		$location_info = $GLOBALS['db']->getRow($location_sql);
		if (empty($location_info)) {
			throw new Exception('门店不存在或已关闭');
		}
		return $location_info;
	}

	private function getConsigneeInfo($cid, $idForce = false)
	{
		if ($cid<=0) {
			if ($idForce) {
				throw new Exception('地址不能为空');
			}
			$defaultConsigneeSql = 'SELECT id FROM '.DB_PREFIX.'user_consignee WHERE user_id='.$user_info['id'];
			$cid = $GLOBALS['db']->getOne($defaultConsigneeSql);
		}
		$consignee_info = load_auto_cache("consignee_info", array("consignee_id" => $cid));
		return $consignee_info['consignee_info'];
	}



	/**
	 * 判断选择的时间是否在7日内，且预订数量未满
	 * @param  int $tid     时间id
	 * @param  date $rs_date xxxx-xx-xx
	 * @return bool          
	 */
	private function rsTimeCheck($tid, $rs_date)
	{
		if (empty($rs_date) || $tid <= 0) {
			throw new Exception('未选择预约时间');
		}
		
		$serviceTimeSql = 'SELECT lst.*, vot.buy_count FROM '.DB_PREFIX.'supplier_location_service_time lst LEFT JOIN '.DB_PREFIX.'vservice_order_time vot ON lst.id=vot.time_id AND vot.rs_date='.$rs_date.' WHERE lst.id='.$tid;
		// print_r($serviceTimeSql);exit;
		$serviceTime = $GLOBALS['db']->getRow($serviceTimeSql);
		if (empty($serviceTime)) {
			throw new Exception('预订项目不存在');
		}
		$serviceTime = $this->formatHMTime($serviceTime);

		// 预约起止时间戳
		$rsStartTime = to_timespan($rs_date.' '.$serviceTime['begin_time_h'].':'.$serviceTime['begin_time_m']);
		$rsEndTime = to_timespan($rs_date.' '.$serviceTime['end_time_h'].':'.$serviceTime['end_time_m']);

		// 先获取今天和七天的起止时间戳
		$startTime = to_timespan(to_date(NOW_TIME, 'Y-m-d'));
		$endTime = $startTime + 3600 * 24 * 7;
		/*print_r('预订开始'.$rsStartTime);
		print_r('预订结束'.$rsEndTime);
		print_r('今天开始'.$startTime);
		print_r('7天结束'.$endTime);
		print_r('当前时间戳'.NOW_TIME);
		exit;*/
		if ($rsStartTime > $endTime || $rsEndTime < $startTime || $rsEndTime < NOW_TIME) {
			throw new Exception('指定时间暂不能预约');
		}
		
		// 判断预订数量是否已满
		if (intval($serviceTime['buy_count']) >= $serviceTime['limit_num']) {
			throw new Exception('指定时间预约已满');
		}

		$rs_date_split = explode('-', $rs_date, 2);
		$weekdayIndex = to_date($rsStartTime,'w');
		
		$weekdayStr = getWeekday($weekdayIndex);

		return array(
			'shortDate' => $rs_date_split[1],
			'weekday' => $weekdayStr,
			'formatTime' => $serviceTime['begin_time_h'].':'.$serviceTime['begin_time_m'].'-'.$serviceTime['end_time_h'].':'.$serviceTime['end_time_m'],
			'sub_start_time' => $rsStartTime,
			'sub_end_time' => $rsEndTime
		);
	}

	private function formatHMTime($serviceTime)
	{
		$serviceTime['begin_time_h'] = $serviceTime['begin_time_h'] < 10 ? '0'.$serviceTime['begin_time_h'] : $serviceTime['begin_time_h'];
		$serviceTime['begin_time_m'] = $serviceTime['begin_time_m'] < 10 ? '0'.$serviceTime['begin_time_m'] : $serviceTime['begin_time_m'];
		$serviceTime['end_time_h'] = $serviceTime['end_time_h'] < 10 ? '0'.$serviceTime['end_time_h'] : $serviceTime['end_time_h'];
		$serviceTime['end_time_m'] = $serviceTime['end_time_m'] < 10 ? '0'.$serviceTime['end_time_m'] : $serviceTime['end_time_m'];
		return $serviceTime;
	}

	public function addressCheck($consignee_info, $location_info)
	{
		$x = $consignee_info['xpoint'];
		$y = $consignee_info['ypoint'];
		$xpoints = explode(',', $location_info['xpoints']);
		$ypoints = explode(',', $location_info['ypoints']);
		if (count($xpoints) < 3 || count($xpoints) != count($ypoints)) {
			return false;
		}
		$count = count($xpoints);
		// $this->debugLog($count, false);
		$sum = 0;
		for ($i=0; $i < $count; $i++) {
			$x1 = $xpoints[$i];
			$y1 = $ypoints[$i];
			if ($i == $count - 1) {
				$x2 = $xpoints[0];
				$y2 = $ypoints[0];
			} else {
				$x2 = $xpoints[$i+1];
				$y2 = $ypoints[$i+1];
			}
			// 先判断坐标是否在两个端点的水平平行线之间，有则可能有交点
			if ((($y >= $y1) && ($y < $y2)) || (($y >= $y2) && ($y < $y1))) {
				// $this->debugLog($i, false);
				if (abs($y1 - $y2) > 0) {
					// 求出坐标向左射线与边的交点的x坐标
					$dLon = $x1 - (($x1 - $x2) * ($y1 - $y)) / ($y1 - $y2);
					// 如果交点在A点左侧，则有交点
					// $this->debugLog($dLon.':'.$x, false);
					if ($dLon < $x) {

						$sum++;
					}
				}
			}
		}
		// $this->debugLog($consignee_info, false);
		// $this->debugLog($location_info, false);
		// $this->debugLog($sum, false);
		// 交点数位偶数，表示在区域内
		/*if (($sum % 2) != 0) {
			return true;
		}*/

		return (($sum % 2) ? true : false);
	}

	public function pay()
	{
		try {
			$root = array();
			$user_login_status = check_login();
			$root['user_login_status'] = $user_login_status;
			if($user_login_status != LOGIN_STATUS_LOGINED){
				throw new Exception('请先登录');
			}
			$user_info = $GLOBALS['user_info'];
			
			$request = $GLOBALS['request'];

			$order_id = intval($request['id']);
			
			$order_info = $this->getOrderInfo($order_id, $user_info['id']);
			$pay_price = $this->getPayPrice($order_info);

			// 支付方式列表
			$onlineOptions = array(4, 5, 6);
			
			if (APP_INDEX == 'wap') {
				$option = 2;
			} else {
				$option = 3;
			}
			array_unshift($onlineOptions, $option);
			$payment_sql = 'SELECT id, class_name as code, logo, config, fee_type, fee_amount FROM '.DB_PREFIX.'payment where is_effect=1 AND online_pay in ('.implode(',', $onlineOptions).')';
			
			if (APP_INDEX == 'wap' && !isWeixin()) {
				$payment_sql .= ' AND class_name != "Wwxjspay"';
			}
			$payment_list = array();
			if (allow_show_api()) {
				$payment_list = $GLOBALS['db']->getAll($payment_sql);
			}
			$format_payment_list = array();
			if ($payment_list) {
				$directory = APP_ROOT_PATH.'system/payment/';
				foreach ($payment_list as $payment) {
					if ($payment['code'] == 'Cod') {
						continue;
					}

					if ($payment['logo']) {
						$payment['logo'] = get_abs_img_root(get_spec_image($payment['logo'], 40, 49, 1));
					}
					$payment['payment_fee'] = $payment['fee_type'] == 0 ? $payment['fee_amount'] : $payment['fee_amount'] * $pay_price;

					$file = $directory.$payment['code'].'_payment.php';
					
					if (file_exists($file)) {
						fanwe_require($file);
						$paymentClass = $payment['code'].'_payment';
						$paymentObj = new $paymentClass();
						$payment['name'] = $paymentObj->get_display_code();
					}
					$format_payment_list[] = $payment;
				}
			}
			$has_account = 0;
			if ($pay_price <= $user_info['money']) {
				
				$accountPaymentSql = 'SELECT id, fee_amount, fee_type FROM '.DB_PREFIX.'payment WHERE class_name="Account" AND is_effect=1';
				$accountPayment = $GLOBALS['db']->getRow($accountPaymentSql);
				if ($accountPayment) {
					$has_account = 1;
					$account_fee = $accountPayment['fee_type'] == 0 ? $accountPayment['fee_amount'] : $accountPayment['fee_amount'] * $pay_price;
					$root['accountPayment'] = $accountPayment;
					$root['account_fee'] = $account_fee;
					$root['account_money'] = $user_info['money'];
				}
				
			}
			$root['id'] = $order_id;
			$root['has_account'] = $has_account;
			$root['pay_price'] = $pay_price;
			$root['pay_amount'] = $order_info['pay_amount'];
			$root['payment_list'] = $format_payment_list;
			$root['page_title'] = '收银台';
			return output($root);
		} catch (Exception $e) {
			return output($root, 0, $e->getMessage());
		}
	}

	public function do_pay()
	{
		try {
			$root = array();
			$user_login_status = check_login();
			$root['user_login_status'] = $user_login_status;
			if($user_login_status != LOGIN_STATUS_LOGINED){
				throw new Exception('请先登录');
			}
			$user_info = $GLOBALS['user_info'];

			$request = $GLOBALS['request'];

			$order_id = intval($request['id']);

			$order_info = $this->getOrderInfo($order_id, $user_info['id']);

			// 待支付金额
			/*if ($order_info['pay_status'] == 0) {
				// 未支付，付定金
				$pay_price = $order_info['subscription'];
			} else { // 付尾款
				$pay_price = $order_info['total_price'] - $order_info['pay_amount'];
			}*/
			$pay_price = $this->getPayPrice($order_info);

			if ($pay_price > 0) {
				$payment_id = intval($request['payment']);
				$payments = $this->getPaymentOrFee($payment_id, $pay_price);
				$pay_price += $payments['pay_fee'];

				$notice_id = $this->makePaymentNotice($order_info, $pay_price, $payment_id);

				$payment_info = $payments['payment_info'];
				$paymentClassFile = APP_ROOT_PATH.'system/payment/'.$payment_info['class_name'].'_payment.php';
				fanwe_require($paymentClassFile);
				$paymentClass = $payment_info['class_name'].'_payment';
				$paymentObj = new $paymentClass();
				if ($payment_info['class_name'] == 'Account') {
					// 余额支付
					if ($user_info['money'] < $pay_price) { // 余额不足
						throw new Exception('余额不足，支付失败');
					}
				}
				$paymentData = $paymentObj->get_payment_code($notice_id);
				$payRst = $this->orderPaid($order_info['id']);
				if ($payRst) {
					$pay_status = 1;
				} else {
					$pay_status = 0;

					if (APP_INDEX == 'app') {
						$root['sdk_code'] = $paymentData['sdk_code'];
						$root['pay_url'] = $paymentData['pay_action'];
						$root['online_pay'] = $payment_info['online_pay'];
						$root['title'] = $payment_info['name'];
						$root['is_account_pay'] = 0;
					}
				}
			} else {
				$payRst = $this->orderPaid($order_info['id']);
				if ($payRst) {
					$pay_status = 1;
				} else {
					throw new Exception("支付失败,请重试");
				}
			}

			$root['app_index'] = APP_INDEX;
			$root['pay_status'] = $pay_status;
			$root['order_id'] = $order_info['id'];
			return output($root);
		} catch (Exception $e) {
			$this->debugLog($e->getMessage);
			return output($root, 0, $e->getMessage());
		}
	}

	public function getOrderInfo($order_id, $user_id)
	{
		if ($order_id <= 0) {
			throw new Exception('订单参数错误');
		}

		$order_sql = 'SELECT * FROM '.DB_PREFIX.'vservice_order WHERE id='.$order_id.' AND user_id='.$user_id;
		$order_info = $GLOBALS['db']->getRow($order_sql);
		
		if (empty($order_info)) {
			throw new Exception('订单不存在');
		}
		if ($order_info['is_delete'] == 1) {
			throw new Exception('订单已删除');
		}
		if ($order_info['pay_status'] == 2 || ($order_info['pay_status'] == 1 && $order_info['order_status'] < 4)) { // 服务完之后才能继续支付
			throw new Exception('订单已支付');
		}

		return $order_info;
	}

	/**
	 * 获取需要支付的金额
	 * @param  array $order_info 订单信息
	 * @return float             
	 */
	private function getPayPrice($order_info)
	{
		if ($order_info['pay_status'] == 0) {
			// 未支付，付定金
			$pay_price = $order_info['subscription'];
		} else { // 付尾款
			$pay_price = $order_info['total_price'] - $order_info['pay_amount'];
		}
		return $pay_price;
	}

	/**
	 * 获取需要支付的手续费
	 * @param  float $pay_price 需要支付的金额
	 * @param  int $pid       支付方式id
	 * @return float            
	 */
	private function getPaymentOrFee($pid, $pay_price = 0)
	{
		$rst = array();

		$payment_sql = 'SELECT * FROM '.DB_PREFIX.'payment where id='.$pid.' AND is_effect=1';
		$payment_info = $GLOBALS['db']->getRow($payment_sql);

		if (empty($payment_info)) {
			throw new Exception('支付参数错误');
		}

		if ($payment_info['class_name'] != 'Account') {
			$msg = '';
			if (APP_INDEX == 'wap') {
				$wap_check = in_array($payment_info['online_pay'], array(2,4,5,6));
				if (!$wap_check || ($wap_check && !isWeixin() && $payment_info['class_name'] == 'Wwxjspay')) {
					$msg = '该支付方式不支持wap支付';
				}
			} else {
				$app_check = in_array($payment_info['online_pay'], array(3,4,5,6));
				if (!$app_check) {
					$msg = '该支付方式不支持手机支付';
				}
			}
			if ($msg != '') {
				throw new Exception($msg);
			}
		}

		$rst['payment_info'] = $payment_info;

		if ($pay_price > 0) {
			$fee = $payment_info['fee_type'] == 0 ? $payment_info['fee_amount'] : ($pay_price * $payment_info['fee_amount']);
			$rst['pay_fee'] = $fee;
		}

		return $rst;
	}

	/**
	 * 生成付款单号
	 * @param  array $order_info 订单信息
	 * @param  int $pid        支付方式id
	 * @return int             
	 */
	private function makePaymentNotice($order_info, $pay_price, $pid, $memo = '')
	{
		if ($pay_price > 0) {
			$notice = array(
				'create_time' => NOW_TIME,
				'order_id'    => $order_info['id'],
				'user_id'     => $order_info['user_id'],
				'order_type'  => 9,
				'payment_id'  => $pid,
				'money'       => $pay_price,
				'memo'        => $memo,
				'ecv_id'      => 0,
			);
			$i = 1;
			do {
				if ($i >= 5) {
					$this->debugLog('生成付款单失败');
					throw new Exception('支付失败,请重试');
				}
				$notice['notice_sn'] = to_date(NOW_TIME, 'Ymdhis').rand(10, 99);
				$GLOBALS['db']->autoExecute(DB_PREFIX."payment_notice",$notice,'INSERT','','SILENT');
    			$notice_id = intval($GLOBALS['db']->insert_id());
			} while ($notice_id == 0);
			return $notice_id;
		} else {
			return -1;
		}
	}

	private function orderPaid($order_id)
	{
		fanwe_require(APP_ROOT_PATH."system/model/visit_service.php");
		$result = visit_service_order_paid($order_id);
		return $result;
	}

	private function debugLog($message, $dbInfo = true)
	{
		fanwe_require(APP_ROOT_PATH."system/model/visit_service.php");
		serviceDebugLog($message, $dbInfo);
	}

}