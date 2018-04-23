<?php
/**
 * @desc      
 * @author    吴庆祥
 * @since     2017-09-11 10:12  
 */
class PtAction extends CommonAction
{
    function __construct()
    {
        parent::__construct();
        if (!IS_PT) {
            $this->error("拼团模块未开放");
        }
    }
    public function index()
    {
        if (!isset($_REQUEST['is_effect'])) $_REQUEST['is_effect'] = -1;
        $model = D("PtDealView");
        $map = $this->_initIndexMap();
        $map['is_pt'] = 1;

        $this->_list($model, $map);
        $this->display();
    }
    public function insert()
    {
        $deal_id = strim($_REQUEST['deal_id']);
        if (!$deal_id) {
            $this->error("商品id不能为空");
        }
        $deal = M("Deal")->where(array("id" => $deal_id))->find();
        if ($deal['supplier_id']) {
            $this->error("平台不能添加商家商品");
        }
        if ($deal['is_presell']) {
            $this->error("该商品已经参与拼团");
        }
        if ($deal['return_score'] < 0) {
            $this->error("积分商品不参与拼团");
        }
        $flag = M("Deal")->where(array("id" => $deal_id))->save(array("is_pt" => 1));
        syn_deal_match($deal_id);
        if ($flag) {
            M("PtDeal")->add(array("is_effect"=>1,"deal_id"=>$deal_id,"create_time"=>NOW_TIME));
            $this->success("添加拼团商品成功");
        } else {
            $this->error("添加拼团商品失败");
        }
    }
    public function edit()
    {
        $pt_id = intval($_REQUEST['id']);
        $pt_info=M("PtDeal")->where(array("id"=>$pt_id))->find();
        $pt_info['start_time']=to_date($pt_info['start_time']);
        $pt_info['end_time']=to_date($pt_info['end_time']);
        $this->assign("pt_info",$pt_info);

        $deal_info = M("Deal")->where(array("id" => $pt_info['deal_id']))->find();
        $this->assign("deal_info", $deal_info);
        $brand_name = M("Brand")->where("id={$deal_info['brand_id']}")->getField('name');
        $this->assign("brand_name", $brand_name);

        $this->_assignShopCate($deal_info['shop_cate_id']);
        $this->_assignDealGallery($deal_info['id']);
        $this->_attrTable();
        $this->display();
    }
    private function _assignDealGallery($deal_id)
    {
        $img_list = M("DealGallery")->where("deal_id=" . $deal_id)->order("sort asc")->findAll();
        $imgs = array();
        foreach ($img_list as $k => $v) {
            $imgs[$v['sort']] = $v['img'];
        }

        $this->assign("img_list", $imgs);
        $this->assign("img_index", count($imgs));
    }

    private function _assignShopCate($shop_cate_id)
    {

        $shop_cate = M("shop_cate")->where('id in (' . $shop_cate_id . ')')->findAll();
        foreach ($shop_cate as $k => $v) {
            if ($v['pid'] > 0) {
                $first_cate = M("shop_cate")->where(array('id' => $v['pid']))->find();
                $shop_cate[$k]['first_cate'] = $first_cate['name'];
            } else {
                $shop_cate[$k]['first_cate'] = '';
            }
        }
        $this->assign("shop_cate", $shop_cate);
    }
    private function _initIndexMap()
    {
        $map = array();
        if ($_REQUEST['search_name']) {
            $search_name = strim($_REQUEST['search_name']);
            $map['_string'] = "(instr(Deal.name,'{$search_name}')>0 or Deal.id='{$search_name}')";
        }
        $map['Deal.supplier_id']=0;
        //状态：有效，无效
        $is_effect = intval($_REQUEST['is_effect']);
        if ($is_effect > -1) {
            $map['Deal.is_effect'] = $is_effect;
        }
        //拼团商品状态:0全部拼团，1.进行中 2.未开始 3.已结束
        $status = intval($_REQUEST['status']);
        if ($status == 1) {
            $map['PtDeal.start_time'] = array("elt", NOW_TIME);
            $map['PtDeal.end_time'] = array("egt", NOW_TIME);
        } else if ($status == 2) {
            $map['PtDeal.begin_time'] = array("gt", NOW_TIME);
        } else if ($status == 3) {
            $map['PtDeal.end_time'] = array("lt", NOW_TIME);
        }
        return $map;
    }
    public function delete()
    {
        $id = $_REQUEST ['id'];
        if (isset($id)) {
            $flag = M("Deal")->where("id in({$id})")->save(array("is_pt" => 0));
            if (!$flag) $this->error("编号；{$id}删除失败");
            $id_array=explode(",",$id);
            foreach($id_array as $v){
                syn_deal_match($v);
            }
            M("PtDeal")->where("id in({$id})")->delete();
            $this->success("删除成功");
        } else {
            $this->error("编号为空");
        }
    }
    public function search_goods()
    {
        $key = strim($_REQUEST['key']);
        $data = M("Deal")->where("instr(name,'{$key}')>0 and is_shop=1 and supplier_id=0 and is_presell=0 and is_pt=0 and is_effect=1 and is_delete=0 and return_score>=0")->findAll();
        if (empty($data)) {
            ajax_return(array("status" => 0, "info" => "商品不存在或已参与其他营销活动"));
        } else {
            ajax_return(array("status" => 1, 'data' => $data));
        }
    }

    public function set_effect()
    {
        $id = intval($_REQUEST['id']);
        $info = M("Deal")->where("id=" . $id)->getField("name");
        $c_is_effect = M("Deal")->where("id=" . $id)->getField("is_effect"); //当前状态
        $n_is_effect = $c_is_effect == 0 ? 1 : 0; //需设置的状态
        M("Deal")->where("id in({$id})")->save(array("is_effect" => $n_is_effect, "update_time" => NOW_TIME));
        save_log($info . l("SET_EFFECT_" . $n_is_effect), 1);
        $locations = M("DealLocationLink")->where(array('deal_id' => $id))->findAll();
        foreach ($locations as $location) {
            recount_supplier_data_count($location['location_id'], "daijin");
            recount_supplier_data_count($location['location_id'], "tuan");
        }
        $this->ajaxReturn($n_is_effect, l("SET_EFFECT_" . $n_is_effect), 1);
    }
    private  function _attrTable()
    {
        $deal_id = intval($_REQUEST['id']);
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
                $html = '<table><tboty><tr>';

                foreach ($attr_row_arr as $k => $v) {
                    $html .= '<th>' . $v['name'] . '</th>';
                    $attr_row_arr[$k]['count'] = count($v['attr']);
                }
                $p_str = '递增成本价';
                $lang_deposit_money = L("DEPOSIT_MONEY_" . $type);
                $this->assign("lang_deposit_money", $lang_deposit_money);
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
                    $attr_stock = M("AttrStock")->where("deal_id=" . intval($deal_id))->order("id asc")->findAll();
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

                                                $row_html = $this->get_attr_row_html($attr_stock, $key);
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

                                                $row_html = $this->get_attr_row_html($attr_stock, $key);
                                                $html .= $row_html;

                                            }
                                        }

                                    }
                                } else {

                                    $key_arr = array($vv['key'], $vvv['key']);
                                    $key = $this->get_data_key($attr_stock, $key_arr);

                                    $row_html = $this->get_attr_row_html($attr_stock, $key);
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

                                                $row_html = $this->get_attr_row_html($attr_stock, $key);
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

                                                $row_html = $this->get_attr_row_html($attr_stock, $key);
                                                $html .= $row_html;

                                            }

                                        }

                                    }
                                } else {

                                    $key_arr = array($vv['key'], $vvv['key']);
                                    $key = $this->get_data_key($attr_stock, $key_arr);

                                    $row_html = $this->get_attr_row_html($attr_stock, $key);
                                    $html .= $row_html;
                                }
                            }

                        }
                    } else {
                        $row_html = $this->get_attr_row_html($attr_stock, $vv['key']);
                        $html .= $row_html;
                    }
                    $html .= '</tr>';
                }
                $html .= '</tboty></table>';
            }
        } else {
            $html = '';
        }
        $this->assign("html", $html);
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

    private function get_attr_row_html($attr_stock, $key)
    {
        $html = '';
        $html .= '<td><input type="hidden" name="deal_attr_price[]" value="'.$attr_stock[$key]['price'].'" /><span style="width:100px;" class="pricebox">' . $attr_stock[$key]['price'] . '<span></td>';
        $html .= '<td><input type="hidden" name="deal_add_balance_price[]" value="'.$attr_stock[$key]['add_balance_price'].'" /><span style="width:100px;" class="pricebox">' . $attr_stock[$key]['add_balance_price'] . '<span></td>';
        $html .= '<td><input type="hidden" name="stock_cfg_num[]" value="'.$attr_stock[$key]['stock_cfg'].'" /><span style="width:100px;" class="pricebox">' . $attr_stock[$key]['stock_cfg'] . '<span></td>';
        $html .= '<td><input style="width:100px;"  type="text" name="presell_deposit_money[' . $attr_stock[$key]['attr_key'] . ']" value="' . $attr_stock[$key]['presell_deposit_money'] . '" /></td>';
        $html .= '<td><input style="width:100px;"  type="text" name="presell_discount_money[' . $attr_stock[$key]['attr_key'] . ']" value="' . $attr_stock[$key]['presell_discount_money'] . '" /></td>';
        $html .= '<td><input type="hidden" name="attr_key[]" value="'.$attr_stock[$key]['attr_key'].'" /><input type="hidden" name="stock_buy_count[]" value="'.$attr_stock[$key]['buy_count'].'" />' . intval($attr_stock[$key]['presell_buy_count']) . '</td>';
        return $html;
    }
}