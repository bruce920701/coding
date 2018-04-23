<?php
/**
 * @desc      
 * @author    吴庆祥
 * @since     2017-08-07 19:21  
 */
class deal_presellModule extends BizBaseModule{
    function __construct()
    {
        parent::__construct();
        global_run();
        $this->check_auth();
        if (!IS_PRESELL) {
            $this->error("预售模块未开放");
        }
        if(!intval($_REQUEST['is_ajax'])){
            init_app_page();
        }
    }
    public function index()
    {
        if (!isset($_REQUEST['is_effect'])) $_REQUEST['is_effect'] = -1;
        $page = intval($_REQUEST['p']);
        $limit =formatLimit($page);
        $where = $this->_initIndexWhere();
        $total=$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal Deal where {$where}");
        $list=$GLOBALS['db']->getAll("SELECT Deal.*, count(DealOrder.pay_status=2 or NULL) AS order_number FROM ".DB_PREFIX."deal Deal LEFT JOIN ".DB_PREFIX."deal_order_item DealOrederItem ON DealOrederItem.deal_id = Deal.id LEFT JOIN ".DB_PREFIX."deal_order DealOrder ON DealOrder.id = DealOrederItem.order_id WHERE {$where} GROUP BY Deal.id ".$limit);
        formatPage($total);
        $GLOBALS['tmpl']->assign("_REQUEST",$_REQUEST);
        $GLOBALS['tmpl']->assign("list",$list);
        $GLOBALS['tmpl']->display("pages/deal_presell/index.html");
    }

    private function _initIndexWhere()
    {
        $account_info = $GLOBALS['account_info'];
        $where =" Deal.is_presell=1 ";
        if ($_REQUEST['search_name']) {
            $search_name = strim($_REQUEST['search_name']);
            $where.= " and (instr(Deal.name,'{$search_name}')>0 or Deal.id='{$search_name}')";
        }
        $where.=" and Deal.supplier_id={$account_info['supplier_id']} ";
        //状态：有效，无效
        $is_effect = intval($_REQUEST['is_effect']);
        if ($is_effect > -1) {
            $where.= " and Deal.is_effect={$is_effect}";
        }
        //预售商品状态:0全部预售，1.进行中 2.未开始 3.已结束
        $status = intval($_REQUEST['status']);
        if ($status == 1) {
            $where.=" and Deal.presell_begin_time<".NOW_TIME." and Deal.presell_end_time>".NOW_TIME;
        } else if ($status == 2) {
            $where.=" and Deal.presell_begin_time>".NOW_TIME;
        } else if ($status == 3) {
            $where.=" and Deal.presell_end_time<".NOW_TIME;
        }
        return $where;
    }
    public function search_goods()
    {
        $account_info = $GLOBALS['account_info'];
        $key = strim($_REQUEST['key']);
        $data=$GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal where instr(name,'{$key}')>0 and is_shop=1 and is_effect=1 and is_delete=0 and supplier_id={$account_info['supplier_id']} and is_presell=0 and return_score>=0");
        if (empty($data)) {
            $this->error("商品不存在或已参与其他营销活动");
        } else {
            ajax_return(array("status" => 1, 'data' => $data));
        }
    }
    public function insert()
    {
        $deal_id = strim($_REQUEST['deal_id']);
        if (!$deal_id) {
            $this->error("商品id不能为空");
        }
        $deal =$GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id={$deal_id}");
        if (!$deal['supplier_id']) {
            $this->error("不能添加平台商品");
        }
        if ($deal['is_presell']) {
            $this->error("该商品已经参与预售");
        }
        if ($deal['return_score'] < 0) {
            $this->error("积分商品不能参与预售");
        }
        $flag = $GLOBALS['db']->query("update ".DB_PREFIX."deal set is_presell=1 where id={$deal_id}");
        syn_deal_match($deal_id);
        if ($flag) {
            $this->success("添加预售商品成功");
        } else {
            $this->error("添加预售商品失败");
        }
    }
    public function foreverdelete(){
        $id = $_REQUEST ['id'];
        if (isset($id)) {
            $flag = $GLOBALS['db']->query("update ".DB_PREFIX."deal set is_presell=0 where id in({$id})");
            if (!$flag) $this->error("编号；{$id}删除失败");
            $id_array=explode(",",$id);
            foreach($id_array as $v){
                syn_deal_match($v);
            }
            $this->success("删除成功");
        } else {
            $this->error("编号为空");
        }
    }
    public function edit()
    {
        $deal_id = intval($_REQUEST['deal_id']);
        $deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id={$deal_id}");
        $deal_info['presell_begin_time'] = to_date($deal_info['presell_begin_time']);
        $deal_info['presell_end_time'] = to_date($deal_info['presell_end_time']);
        $deal_info['presell_delivery_time'] = to_date($deal_info['presell_delivery_time']);
        if(!$deal_info['presell_deposit_money']){
            $deal_info['presell_deposit_money']=$deal_info['current_price']-$deal_info['balance_price'];
        }
        $GLOBALS['tmpl']->assign("deal_info", $deal_info);
        $brand_name =$GLOBALS['db']->getOne("select name where ".DB_PREFIX."brand where id={$deal_info['brand_id']}");
        $GLOBALS['tmpl']->assign("brand_name", $brand_name);
        $this->_assignShopCate($deal_info['shop_cate_id']);
        $this->_assignDealGallery($deal_info['id']);
        $this->_assignSupplierInfo($deal_info['id']);
        $this->_attrTable($deal_info);
        $GLOBALS['tmpl']->display("pages/deal_presell/edit.html");
    }
    private function _assignSupplierInfo($deal_id){
        $supplier_id=intval($GLOBALS['account_info']['supplier_id']);
        $supplier_name=$GLOBALS['db']->getOne("select name from ".DB_PREFIX."supplier where id={$supplier_id}");
        $location_ids=$GLOBALS['db']->getCol("select location_id from ".DB_PREFIX."deal_location_link where deal_id={$deal_id}");
        $location_ids=implode(",",$location_ids);
        $location_name=$GLOBALS['db']->getCol("select name from ".DB_PREFIX."supplier_location where id in ({$location_ids})");
        $location_name=implode("、",$location_name);
        $GLOBALS['tmpl']->assign("supplier_name",$supplier_name);
        $GLOBALS['tmpl']->assign("location_name",$location_name);
    }
    private function _assignDealGallery($deal_id)
    {
        $img_list=$GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_gallery where deal_id={$deal_id}");
        $imgs = array();
        foreach ($img_list as $k => $v) {
            $imgs[$v['sort']] = $v['img'];
        }

        $GLOBALS['tmpl']->assign("img_list", $imgs);
        $GLOBALS['tmpl']->assign("img_index", count($imgs));
    }
    public function update()
    {

        $deal_id = intval($_REQUEST['id']);
        $deal_info=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id={$deal_id}");
        $deal_presell_data = $this->_checkDealPresellDataByDeal($deal_info);
        $attr_stock_array = $this->_checkAttrStock($deal_info);
        $flag=$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$deal_presell_data,"update","id={$deal_id}");
        syn_deal_match($deal_id);
        $GLOBALS['db']->query("delete from ".DB_PREFIX."attr_stock where deal_id={$deal_info['id']}");
        $GLOBALS['db']->autoExecute(DB_PREFIX."attr_stock",$attr_stock_array);
        $this->success("保存成功");
    }

    private function _checkAttrStock($deal_info)
    {
        $type = intval($_REQUEST['type']);
        $attr_stock_array=$GLOBALS['db']->getAll("select * from ".DB_PREFIX."attr_stock where deal_id={$deal_info['id']}");
        $attr_stock = array();
        $presell_deposit_money_array=$_REQUEST['presell_deposit_money'];
        $presell_discount_money_array=$_REQUEST['presell_discount_money'];
        foreach($attr_stock_array as $value){
            $attr_key=$value['attr_key'];
            $value['presell_deposit_money']=floatval($presell_deposit_money_array[$attr_key]);
            $value['presell_discount_money']=floatval($presell_discount_money_array[$attr_key]);
            $this->_checkDepositAndDiscount($value['presell_deposit_money'],$value['presell_discount_money'],$deal_info['current_price'],$deal_info['current_price']-$deal_info['balance_price'],$type);
            unset($value['id']);
            $attr_stock[]=$value;
        }
        return $attr_stock;
    }

    private function _checkDealPresellDataByDeal($deal_info)
    {
        $deal_presell_info = array();
        $type = intval($_REQUEST['presell_type']);
        $deal_presell_info['presell_type']=$type;
        $deal_presell_info['presell_begin_time'] = $this->_getTotime($_REQUEST['begin_time']);
        if ($deal_presell_info['presell_begin_time']&&$deal_presell_info['presell_begin_time'] < $deal_info['begin_time']) {
            $this->error("预售开始时间不能小于商品上架时间");
        }
        //预售结束时间
        $deal_presell_info['presell_end_time'] = $this->_getTotime($_REQUEST['end_time']);
        if($deal_presell_info['presell_end_time']<NOW_TIME){
            $this->error("预售结束时间不能为已过期时间");
        }
        if (!$deal_presell_info['presell_end_time']) {
            $this->error("预售结束时间不能为空");
        }
        if ($deal_info['end_time'] && $deal_presell_info['presell_end_time'] > $deal_info['end_time']) {
            $this->error("预售结束时间不能大于商品下架时间");
        }
        if ($deal_presell_info['presell_end_time'] < $deal_presell_info['presell_begin_time']) {
            $this->error("预售结束时间不能小于预售开始时间");
        }
        //预售发货时间
        $deal_presell_info['presell_delivery_time'] = $this->_getTotime($_REQUEST['delivery_time']);
        if($deal_presell_info['presell_delivery_time']<NOW_TIME){
            $this->error("预售发货时间不能为已过期时间");
        }
        if (!$deal_presell_info['presell_delivery_time']) {
            $this->error("发货时间不能为空");
        }
        if ($deal_presell_info['presell_delivery_time'] < $deal_presell_info['presell_end_time']) {
            $this->error("发货时间不能小于预售结束时间");
        }
        $deal_presell_info['presell_deposit_money'] = floatval($_REQUEST['presell_deposit_money_default']);
        $deal_presell_info['presell_discount_money'] = floatval($_REQUEST['presell_discount_money_default']);
        if (!$deal_presell_info['presell_deposit_money']) $this->error("默认" . lang("DEPOSIT_MONEY_{$type}") . "不能为空");
        if (!$deal_presell_info['presell_discount_money']) $this->error("默认抵扣金额不能为空");
        $this->_checkDepositAndDiscount($deal_presell_info['presell_deposit_money'], $deal_presell_info['presell_discount_money'], $deal_info['current_price'],$deal_info['current_price']-$deal_info['balance_price'], $type);
        return $deal_presell_info;
    }

    private function _checkDepositAndDiscount($presell_deposit_money, $presell_discount_money,$current_price,$min_presell_deposit_money, $type = 0)
    {
        if(!$presell_deposit_money){
            $this->error("规则库存中".lang("DEPOSIT_MONEY_{$type}")."不能为空");
        }
        if(!$presell_discount_money){
            $this->error("规则库存中".lang("DEPOSIT_MONEY_{$type}")."抵扣不能为空");
        }
        if ($presell_deposit_money >= $presell_discount_money) {
            $this->error(lang("DEPOSIT_MONEY_{$type}") . "要小于抵扣金额");
        }
        if ($presell_discount_money >= $current_price) {
            $this->error("抵扣金额要小于商品销售价");
        }
        if($presell_deposit_money<$min_presell_deposit_money){
            $this->error("最小".lang("DEPOSIT_MONEY_{$type}")."金额为{$min_presell_deposit_money}");
        }
    }

    private function _getTotime($data)
    {
        $data = strim($data);
        if ($data) {
            return intval(to_timespan($data));
        } else {
            return 0;
        }
    }
    private  function _attrTable($deal_info)
    {
        $deal_id = intval($_REQUEST['deal_id']);
        $edit_type = 1;
        $type = intval($_REQUEST['type']);
        $temp_attr = array();
        $attr_stock_count=$GLOBALS['db']->getOne("select * from ".DB_PREFIX."attr_stock where deal_id={$deal_id}");
        if($attr_stock_count){
            $attr_row_arr = $GLOBALS['db']->getAll("select a.name as attr_name,a.is_checked as is_checked,a.id as deal_attr_id ,b.* from " . DB_PREFIX . "deal_attr as a left join " . DB_PREFIX . "goods_type_attr as b on a.goods_type_attr_id = b.id where a.deal_id=" . $deal_id . " order by a.id asc");

        }else{
            $attr_row_arr=array();
        }
        foreach ($attr_row_arr as $val) {
            $temp_attr[$val['name']][] = array('attr_name' => $val['attr_name'], "key" => $val['deal_attr_id']);
        }
        $attr_row_arr = array();
        foreach ($temp_attr as $key => $val) {
            $attr_row_arr[] = array('name' => $key, 'attr' => $val);
        }
        if ($attr_row_arr) {

            $attr_row_count = count($attr_row_arr);
            if ($attr_row_count == 0) {
                $html = '';
            } else {
                $html = '<table class="t3"><tboty><tr>';

                foreach ($attr_row_arr as $k => $v) {
                    $html .= '<th>' . $v['name'] . '</th>';
                    $attr_row_arr[$k]['count'] = count($v['attr']);
                }
                $p_str = '递增成本价';
                $lang_deposit_money = lang("DEPOSIT_MONEY_" . $type);
                $GLOBALS['tmpl']->assign("lang_deposit_money", $lang_deposit_money);
                $html .= '<th>递增销售价</th><th>' . $p_str . '</th><th>库存</th><th>' . $lang_deposit_money . '</th><th>' . $lang_deposit_money . '抵扣</th><th>预售销量</th></tr>';

                foreach ($attr_row_arr as $k => $v) {

                    $span = 1;
                    for ($i = 0; $i < $attr_row_count; $i++) {
                        if ($k < $i) {
                            $span *= $attr_row_arr[$i]['count'];
                        }
                    }
                    $attr_row_arr[$k]['span'] = $span;
                }

                if ($edit_type == 1) {
                    $attr_stock = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."attr_stock where deal_id={$deal_id}");
                    foreach ($attr_stock as $k => $v) {
                        $attr_stock[$k]['attr_cfg'] = unserialize($v['attr_cfg']);
                    }
                } else {
                    $attr_stock = $GLOBALS['db']->getOne("select cache_attr_stock from " . DB_PREFIX . "deal_submit where id=" . $deal_id);
                    $attr_stock = unserialize($attr_stock);
                }


                require_once(APP_ROOT_PATH . "system/model/dc.php");
                $attr_stock = data_format_idkey($attr_stock, $key = 'attr_key');
                //第一层
                foreach ($attr_row_arr[0]['attr'] as $kk => $vv) {
                    $html .= '<tr><td rowspan="' . $attr_row_arr[0]['span'] . '">' . $vv['attr_name'] . '</td>';


                    //第二层
                    if ($attr_row_arr[1]['attr']) {


                        foreach ($attr_row_arr[1]['attr'] as $kkk => $vvv) {
                            if ($attr_row_arr[0]['span'] > 1 && $kkk > 0) {

                                $html .= '<tr><td rowspan="' . $attr_row_arr[1]['span'] . '">' . $vvv['attr_name'] . '</td>';
                                //第三层
                                if ($attr_row_arr[2]['attr']) {
                                    foreach ($attr_row_arr[2]['attr'] as $kkkk => $vvvv) {
                                        if ($attr_row_arr[1]['span'] > 1 && $kkkk > 0) {
                                            $html .= '<tr><td rowspan="' . $attr_row_arr[2]['span'] . '">' . $vvvv['attr_name'] . '</td>';

                                            //第四层
                                            if ($attr_row_arr[3]['attr']) {
                                                foreach ($attr_row_arr[3]['attr'] as $kkkkk => $vvvvv) {
                                                    if ($attr_row_arr[2]['span'] > 1 && $kkkkk > 0) {
                                                        $html .= '<tr><td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';

                                                        $html .= '</tr>';
                                                    } else {
                                                        $html .= '<td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';
                                                    }

                                                }
                                            } else {

                                                $key_arr = array($vv['key'], $vvv['key'], $vvvv['key']);
                                                $key = $this->get_data_key($attr_stock, $key_arr);

                                                $row_html = $this->get_attr_row_html($attr_stock, $key,$deal_info['publish_verify_balance']);
                                                $html .= $row_html;

                                            }
                                            $html .= '</tr>';
                                        } else {
                                            $html .= '<td rowspan="' . $attr_row_arr[2]['span'] . '">' . $vvvv['attr_name'] . '</td>';
                                            //第四层
                                            if ($attr_row_arr[3]['attr']) {
                                                foreach ($attr_row_arr[3]['attr'] as $kkkkk => $vvvvv) {
                                                    if ($attr_row_arr[2]['span'] > 1 && $kkkkk > 0) {
                                                        $html .= '<tr><td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';

                                                        $html .= '</tr>';
                                                    } else {
                                                        $html .= '<td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';
                                                    }

                                                }
                                            } else {

                                                $key_arr = array($vv['key'], $vvv['key'], $vvvv['key']);
                                                $key = $this->get_data_key($attr_stock, $key_arr);

                                                $row_html = $this->get_attr_row_html($attr_stock, $key,$deal_info['publish_verify_balance']);
                                                $html .= $row_html;

                                            }
                                        }

                                    }
                                } else {

                                    $key_arr = array($vv['key'], $vvv['key']);
                                    $key = $this->get_data_key($attr_stock, $key_arr);

                                    $row_html = $this->get_attr_row_html($attr_stock, $key,$deal_info['publish_verify_balance']);
                                    $html .= $row_html;

                                }

                                $html .= '</tr>';
                            } else {
                                $html .= '<td rowspan="' . $attr_row_arr[1]['span'] . '">' . $vvv['attr_name'] . '</td>';
                                //第三层
                                if ($attr_row_arr[2]['attr']) {
                                    foreach ($attr_row_arr[2]['attr'] as $kkkk => $vvvv) {
                                        if ($attr_row_arr[1]['span'] > 1 && $kkkk > 0) {
                                            $html .= '<tr><td rowspan="' . $attr_row_arr[2]['span'] . '">' . $vvvv['attr_name'] . '</td>';
                                            //第四层
                                            if ($attr_row_arr[3]['attr']) {
                                                foreach ($attr_row_arr[3]['attr'] as $kkkkk => $vvvvv) {
                                                    if ($attr_row_arr[2]['span'] > 1 && $kkkkk > 0) {
                                                        $html .= '<tr><td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';

                                                        $html .= '</tr>';
                                                    } else {
                                                        $html .= '<td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';
                                                    }

                                                }
                                            } else {

                                                $key_arr = array($vv['key'], $vvv['key'], $vvvv['key']);
                                                $key = $this->get_data_key($attr_stock, $key_arr);

                                                $row_html = $this->get_attr_row_html($attr_stock, $key,$deal_info['publish_verify_balance']);
                                                $html .= $row_html;

                                            }
                                            $html .= '</tr>';
                                        } else {
                                            $html .= '<td rowspan="' . $attr_row_arr[2]['span'] . '">' . $vvvv['attr_name'] . '</td>';

                                            //第四层
                                            if ($attr_row_arr[3]['attr']) {
                                                foreach ($attr_row_arr[3]['attr'] as $kkkkk => $vvvvv) {
                                                    if ($attr_row_arr[2]['span'] > 1 && $kkkkk > 0) {
                                                        $html .= '<tr><td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';

                                                        $html .= '</tr>';
                                                    } else {
                                                        $html .= '<td rowspan="' . $attr_row_arr[3]['span'] . '">' . $vvvvv['attr_name'] . '</td>';
                                                    }

                                                }
                                            } else {

                                                $key_arr = array($vv['key'], $vvv['key'], $vvvv['key']);
                                                $key = $this->get_data_key($attr_stock, $key_arr);

                                                $row_html = $this->get_attr_row_html($attr_stock, $key,$deal_info['publish_verify_balance']);
                                                $html .= $row_html;

                                            }

                                        }

                                    }
                                } else {

                                    $key_arr = array($vv['key'], $vvv['key']);
                                    $key = $this->get_data_key($attr_stock, $key_arr);

                                    $row_html = $this->get_attr_row_html($attr_stock, $key,$deal_info['publish_verify_balance']);
                                    $html .= $row_html;
                                }
                            }

                        }
                    } else {
                        $row_html = $this->get_attr_row_html($attr_stock, $vv['key'],$deal_info['publish_verify_balance']);
                        $html .= $row_html;
                    }
                    $html .= '</tr>';
                }
                $html .= '</tboty></table>';
            }
        } else {
            $GLOBALS['tmpl']->assign("is_show_attr", 1);
            $html = '';
        }
        $GLOBALS['tmpl']->assign("html", $html);
    }

    private function get_data_key($data, $key_arr)
    {
        if (count($key_arr) == 1) {
            return $key_arr[0];
        } elseif (count($key_arr) == 2) {

            if ($data[$key_arr[0] . '_' . $key_arr[1]]) {
                return $key_arr[0] . '_' . $key_arr[1];
            } else {
                return $key_arr[1] . '_' . $key_arr[0];
            }
        } elseif (count($key_arr) == 3) {

            if ($data[$key_arr[0] . '_' . $key_arr[1] . '_' . $key_arr[2]]) {
                return $key_arr[0] . '_' . $key_arr[1] . '_' . $key_arr[2];
            } elseif ($data[$key_arr[0] . '_' . $key_arr[2] . '_' . $key_arr[1]]) {
                return $key_arr[0] . '_' . $key_arr[2] . '_' . $key_arr[1];
            } elseif ($data[$key_arr[1] . '_' . $key_arr[0] . '_' . $key_arr[2]]) {
                return $key_arr[1] . '_' . $key_arr[0] . '_' . $key_arr[2];
            } elseif ($data[$key_arr[1] . '_' . $key_arr[2] . '_' . $key_arr[0]]) {
                return $key_arr[1] . '_' . $key_arr[2] . '_' . $key_arr[0];
            } elseif ($data[$key_arr[2] . '_' . $key_arr[1] . '_' . $key_arr[0]]) {
                return $key_arr[2] . '_' . $key_arr[1] . '_' . $key_arr[0];
            } elseif ($data[$key_arr[2] . '_' . $key_arr[0] . '_' . $key_arr[1]]) {
                return $key_arr[2] . '_' . $key_arr[0] . '_' . $key_arr[1];
            }

        }

    }
    private function get_attr_row_html($attr_stock, $key,$publish_verify_balance)
    {
        $add_balance_price = $publish_verify_balance * $attr_stock[$key]['price'] / 100;
        $html = '';
        $html .= '<td><input type="hidden" name="deal_attr_price[]" value="'.$attr_stock[$key]['price'].'" /><span style="width:100px;" class="pricebox">' . $attr_stock[$key]['price'] . '<span></td>';
        $html .= '<td><input type="hidden" name="deal_add_balance_price[]" value="'.$add_balance_price.'" /><span style="width:100px;" class="pricebox">' . $add_balance_price. '<span></td>';
        $html .= '<td><input type="hidden" name="stock_cfg_num[]" value="'.$attr_stock[$key]['stock_cfg'].'" /><span style="width:100px;" class="pricebox">' . $attr_stock[$key]['stock_cfg'] . '<span></td>';
        $html .= '<td><input style="width:100px;"  type="text" name="presell_deposit_money[' . $attr_stock[$key]['attr_key'] . ']" value="' . $attr_stock[$key]['presell_deposit_money'] . '" /></td>';
        $html .= '<td><input style="width:100px;"  type="text" name="presell_discount_money[' . $attr_stock[$key]['attr_key'] . ']" value="' . $attr_stock[$key]['presell_discount_money'] . '" /></td>';
        $html .= '<td><input type="hidden" name="attr_key[]" value="'.$attr_stock[$key]['attr_key'].'" /><input type="hidden" name="stock_buy_count[]" value="'.$attr_stock[$key]['buy_count'].'" />' . intval($attr_stock[$key]['presell_buy_count']) . '</td>';
        return $html;
    }
    private function _assignShopCate($shop_cate_id)
    {

        $sql = "select sc.id,sc.name,sc.pid,psc.name as pname ".
            "from ".DB_PREFIX."shop_cate sc LEFT JOIN ".DB_PREFIX."shop_cate psc on sc.pid=psc.id ".
            "where sc.id in(".$shop_cate_id.")";
        $deal_shop_cate = $GLOBALS['db']->getAll($sql);
        $GLOBALS['tmpl']->assign("deal_shop_cate", $deal_shop_cate); // 商品分类
    }

}