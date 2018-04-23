<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class uc_orderApiModule extends MainBaseApiModule
{

    private $user_login_status;

    private $returnMsg = '';

    private $returnStatus = 0;

    private $orderList = array();

    private $orderView = array();

    public function index()
    {
    	try {
            $root = array();
            $this->check_login();
            $request = $GLOBALS['request'];
            $userInfo = $GLOBALS['user_info'];
            $order_status = intval($request['status']);
            $extWhere = '';
            switch ($order_status) {
                case 1: // 待付款
                    $extWhere .= ' AND order_status=0';
                    break;
                case 2:
                case 3: // 待服务
                     $extWhere .= ' AND order_status in (2, 3)';
                    break;
                case 4: // 待评价
                     $extWhere .= ' AND order_status=4';
                    break;
                default:
                    # code...
                    break;
            }
            if ($extWhere) {
                $extWhere .= ' AND is_cancel=0';
            }
            $page = intval($request['page']);
            $page = $page <= 0 ? 1 : $page;
            $page_size = PAGE_SIZE;
            $limit = (($page - 1) * $page_size).','.$page_size;
            $baseSql = 'SELECT %s FROM '.DB_PREFIX.'vservice_order WHERE is_delete=0 AND user_id='.$userInfo['id']; // .$extWhere.' ORDER BY create_time DESC limit '.$limit;
            $listFields = 'location_id, location_name, subscription, pay_status, pay_amount, total_price, is_cancel, order_status';
            $orderListSql = sprintf($baseSql, $listFields).$extWhere.' ORDER BY create_time DESC limit '.$limit;
            $orderCountSql = sprintf($baseSql, 'count(id)').$extWhere;

            $formatOrderList = array();
            $orderCount = $GLOBALS['db']->getOne($orderCountSql);
            if ($orderCount == 0) {
                // 如果统计的数量为0则没有订单，列表循环直接跳过
                goto ignoreList;
            }
            $orderList = $GLOBALS['db']->getAll($orderListSql);
            $orderIds = array(); // 订单id, 用来获取订单明细
            foreach ($orderList as $order) {
                $orderIds[] = $order['id'];
                $order['order_status_txt'] = $this->orderStatusTxt($order);
                $order['operators'] = $this->orderOperators($order);
                $formatOrderList[$order['id']] = $order;
            }

            // 获取订单的明细信息
            $itemListSql = 'SELECT * FROM '.DB_PREFIX.'vservice_order_item WHERE order_id in ('.implode(',', $orderIds).')';
            $itemList = $GLOBALS['db']->getAll($itemListSql);
            foreach ($itemList as $item) {
                $item['service_img'] = get_abs_img_root(get_spec_image($item['service_img'],182,182,1));
                $formatOrderList[$item['order_id']]['item'][$item['type']][] = $item;
            }

            ignoreList:

            // 统计未支付的数量
            if ($order_status == 1) {
                $notPayCount = $orderCount;
            } else {
                $notPayCountSql = sprintf($baseSql, 'count(id)').' AND order_status=0 AND is_cancel=0';
                $notPayCount = $GLOBALS['db']->getOne($notPayCountSql);
            }

            $root['notPayCount'] = $notPayCount;

            $root['orderCount'] = $orderCount;
            $root['orderList'] = $formatOrderList;

            $page_total = ceil($orderCount / $page_size);
            $root['page'] = array("page" => $page, "page_total" => $page_total, "page_size" => $page_size, "data_total" => $orderCount);
        
            $root['page_title'] = "服务单";    
        } catch (Exception $e) {
            $this->returnMsg = $e->getMessage();
        }
        $this->output($root);
    }

    private function orderStatusTxt($order)
    {
        // key  is_cancel-pay_status-order_status
        $statusTxts = array(
            '0-0-0' => '待付款(定金)',
            '0-1-1' => '待接单',
            '0-1-2' => '待服务(未开始)',
            '0-1-3' => '待服务(服务中)',
            '0-1-4' => '待付款(尾款)',
            '0-2-5' => '待评价',
            '0-2-6' => '已完成',
            '1-0-0' => '已取消',
            '2-0-0' => '已退款',
            'default' => '',
        );
        
        $key = 'default';
        switch ($order['is_cancel']) {
            case 0:
                $key = '0-'.$order['pay_status'].'-'.$order['order_status'];
                break;
            case 1:
                $key = '1-0-0';
                break;
            case 2:
            case 3:
                $key = '2-0-0';
                break;
        }
        return $statusTxts[$key];
    }

    private function orderOperators($order)
    {
        $paybuttons = array('go_pay' => '去支付');
        $cancelbuttons = array('cancel' => '取消订单');
        $dpbuttons = array('dp' => '评价');

        $operators = array();
        if ($order['is_cancel'] == 0) {
            switch ($order['order_status']) {
                case 0:
                    $operators = array_merge($operators, $paybuttons, $cancelbuttons);
                    break;
                case 1:
                    $operators = array_merge($operators, $cancelbuttons);
                    break;
                case 2: // 待服务？
                    # code...
                    break;
                case 4:
                    $operators = array_merge($operators, $paybuttons);
                    break;
                case 5:
                    $operators = array_merge($operators, $dpbuttons);
                    break;
                default:
                    # code...
                    break;
            }
        }
        return $operators;
            
    }


    /**
     * 输入：
     * data_id:int 订单id
     * @return array
     */
    public function view()
    {
        try {
            $root = array();
            $this->check_login();
            $request = $GLOBALS['request'];
            $id = intval($request['id']);

            $orderSql = 'SELECT * FROM '.DB_PREFIX.'vservice_order WHERE id='.$id.' AND is_delete=0 AND user_id='.$userInfo['id'];
            
            $order = $GLOBALS['db']->getAll($orderSql);

            if (empty($order)) {
                throw new Exception('订单不存在或已删除');
            }
            
            $order['order_status_txt'] = $this->orderStatusTxt($order);
            $order['operators'] = $this->orderOperators($order);
            $order['format_sub_time'] = to_date($order['sub_start_time'], 'Y-m-d H:i').' '.to_date($order['sub_end_time'], 'H:i');

            // 获取订单的明细信息
            $itemListSql = 'SELECT * FROM '.DB_PREFIX.'vservice_order_item WHERE order_id ='.$id;
            $itemList = $GLOBALS['db']->getAll($itemListSql);
            foreach ($itemList as $item) {
                $item['service_img'] = get_abs_img_root(get_spec_image($item['service_img'],182,182,1));
            }
            if (count($itemList) > 1) {
                usort($itemList, $this->_sortType('type'));
            }


            $root['page_title'] = "订单详情";    
        } catch (Exception $e) {
            $this->returnMsg = $e->getMessage();
        }
        $this->output($root);
    }

    private function _sortType($key)
    {
        return function ($a, $b) use ($key) {
            return strnatcmp($a[$key], $b[$key]);
        };
    }


    /**
     * 取消订单接口
     */
    public function cancel()
    {
        try {
            $root = array();
            $this->check_login();
            $request = $GLOBALS['request'];
        
            $root['page_title'] = "订单详情";    
        } catch (Exception $e) {
            $this->returnMsg = $e->getMessage();
        }
        $this->output($root);
    }

    /**
     * 评价页面
     *输入：订单ID
     */
    public function dp()
    {
        try {
            $root = array();
            $this->check_login();
            $request = $GLOBALS['request'];
        
            $root['page_title'] = "订单详情";    
        } catch (Exception $e) {
            $this->returnMsg = $e->getMessage();
        }
        $this->output($root);
    }

    /**
     * 订单评价提交
     * @return unknown_type
     */
    public function do_dp()
    {
        try {
            $root = array();
            $this->check_login();
            $request = $GLOBALS['request'];
        
            $root['page_title'] = "订单详情";    
        } catch (Exception $e) {
            $this->returnMsg = $e->getMessage();
        }
        $this->output($root);
    }

    private function check_login()
    {
        $user_login_status = check_login();
        if($user_login_status != LOGIN_STATUS_LOGINED){
            throw new Exception('请先登录');
        }
    }

    private function output($data)
    {
        $data['user_login_status'] = $this->user_login_status();
        return output($data, $this->returnStatus, $this->$returnMsg);
    }
}

?>