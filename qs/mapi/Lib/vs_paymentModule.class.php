<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


class vs_paymentApiModule extends MainBaseApiModule
{
	
	/**
	 * 订单支付页，包含检测状态，获取支付代码与消费券
	 * 
	 * 输入:
	 * id: int 订单ID
	 * 
	 * 输出:
	 * status:int 状态 0:失败 1:成功
	 * info: string 失败的原因
	 * 以下参数为成功时返回
	 * pay_status: int 支付状态 0:未支付 1:已支付 
	 * order_id: int 订单ID
	 * order_sn: string 订单号
	 * buy_type int 0 代表普通购买，1为积分兑换
	 * order_type int 1为充值订单，否则为商品或者团购下单
	 * pay_info: string 显示的信息
	 * consignee_info 收货地址
	 * 当pay_status 为1时
	 * 
	 * 当pay_status 为0时
	 * payment_code: Array() 相关支付接口返回的支付数据
	 */
	public function done()
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

			fanwe_require(APP_ROOT_PATH."system/model/visit_service.php");
			$orderInfo = getVSOrderInfo($order_id, $user_info['id']);
			if ($orderInfo['pay_status'] == 0 || ($orderInfo['pay_status'] == 1 && $orderInfo['order_status'] != 1)) { // 已经支付完或者支付完定金还未接单
				throw new Exception('');
			}
			if ($orderInfo['pay_status'] == 2) {
				$subTitle = '尾款支付成功';
			} else {
				$subTitle = '定金支付成功';
			}

			$root['orderInfo'] = $orderInfo;

			$root['subTitle'] = $subTitle;
			$root['page_title'] = '支付结果';
			return output($root);
		} catch (Exception $e) {
			return output($root, 0, $e->getMessage());
		}
	}
}