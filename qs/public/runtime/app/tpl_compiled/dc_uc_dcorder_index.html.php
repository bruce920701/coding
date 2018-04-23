<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/dc/css/uc_order.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/plupload.full.min.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/dc/js/page_js/uc_order.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/dc/js/page_js/uc_order.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<?php echo $this->fetch('inc/refuse_delivery_form.html'); ?>
<script>
var	DEL_TIP = '<?php
echo parse_url_tag("u:index|dc_dcorder#del_tip|"."id=".$this->_var['order']['location_id']."".""); 
?>';
var DC_AJAX_URL = "<?php
echo parse_url_tag("u:index|dcajax|"."".""); 
?>";
</script>
<div class="blank20"></div>

<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?> clearfix">
	<div class="side_nav left_box">
		<?php echo $this->fetch('inc/uc_nav_list.html'); ?>
	</div>
	<div class="right_box">
		
		<div class="main_box setting_user_info">
			<div class="content">
				<div class="title"><span>我的外卖</span></div>
				<div class="blank20"></div>
				
			</div>
			
			<?php if ($this->_var['list']): ?>
			<div class="info_box">
				<div class="info_table order_table">
					<table>
						<tbody>
							<tr>
								<th width="50">商家</th>
								<th width="120">送餐信息</th>
								<th width="200">菜单</th>
								<th width="70">价格</th>
								<th width="70">送达时间</th>
								<th width="70">状态</th>
								<th width="70">操作</th>
							</tr>
				
							<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
							<tr>
								<td colspan=7 class="tl order_sum">
									<div class="f_l">
									订单号：<h1><?php echo $this->_var['order']['order_sn']; ?></h1>，交易时间：<h1><?php echo $this->_var['order']['create_time']; ?></h1>，应付总额：<h1><?php echo $this->_var['order']['total_price']; ?></h1>
									<?php if ($this->_var['order']['payment_id'] == 0): ?>
									，实付金额：<h1><?php echo $this->_var['order']['pay_amount']; ?></h1>
									<?php elseif ($this->_var['order']['payment_id'] == 1): ?>
									，货到付款
									<?php endif; ?>
									
									<?php if ($this->_var['order']['promote_amount'] > 0): ?>
									，享受优惠：
									<h1><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['order']['promote_amount'],
  'g' => '2',
);
echo $k['name']($k['v'],$k['g']);
?></h1>
									<?php endif; ?>
									</div>
								</td>
							</tr>

							<tr class="alt">
									<td>
										<a target="_blank" href="<?php echo $this->_var['order']['location_url']; ?>" target="_blank"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['order']['preview'],
  'w' => '50',
  'h' => '50',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" lazy="true" class="deal_icon" /><?php echo $this->_var['order']['location_name']; ?></a>
									</td>
	                                <td class="tl">
                              		 	<?php echo $this->_var['order']['api_address']; ?><?php echo $this->_var['order']['address']; ?><br/>
                              		 	联系人：<?php echo $this->_var['order']['consignee']; ?><br/>
                              		 	电话：<?php echo $this->_var['order']['mobile']; ?><br/>
	                                	
									</td>
	                                <td class="tl">
	                                	<?php $_from = $this->_var['order']['order_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_menu');if (count($_from)):
    foreach ($_from AS $this->_var['order_menu']):
?>
	                                		<?php echo $this->_var['order_menu']['name']; ?>*<?php echo $this->_var['order_menu']['num']; ?><br/>
	                                	
	                                	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</td>
	                                <td><?php echo $this->_var['order']['total_price']; ?></td>
	                                <td><?php echo $this->_var['order']['order_delivery_time']; ?></td>
									<td>
										<?php if ($this->_var['order']['is_cancel'] != 0): ?>
											订单已取消
										<?php elseif ($this->_var['order']['refund_status'] == 1): ?>	
											申请退款中
										<?php elseif ($this->_var['order']['refund_status'] == 2): ?>	
											已退款<br/>订单已取消
										<?php elseif ($this->_var['order']['refund_status'] == 3): ?>	
											退款驳回
										<?php else: ?>
											<?php if ($this->_var['order']['payment_id'] == 0): ?>  
												<?php if ($this->_var['order']['pay_status'] == 0): ?>
												等待支付
												<?php else: ?>
													<?php if ($this->_var['order']['confirm_status'] == 0): ?>
													等待接单
													<?php elseif ($this->_var['order']['confirm_status'] == 1): ?>
													已接单
													<?php elseif ($this->_var['order']['confirm_status'] == 2): ?>
													已送达
													<?php endif; ?>
												<?php endif; ?>
												
											<?php elseif ($this->_var['order']['payment_id'] == 1): ?>  
													<?php if ($this->_var['order']['confirm_status'] == 0): ?>
													等待接单
													<?php elseif ($this->_var['order']['confirm_status'] == 1): ?>
													已接单
													<?php elseif ($this->_var['order']['confirm_status'] == 2): ?>
													已送达
													<?php endif; ?>
											
											<?php endif; ?>
											
										<?php endif; ?>
										
									</td>


									<td class="op_box">		
										<a href="<?php
echo parse_url_tag("u:index|dc_dcorder#view|"."id=".$this->_var['order']['id']."".""); 
?>">查看</a>
										<?php if ($this->_var['order']['is_cancel'] == 0 && $this->_var['order']['refund_status'] == 0): ?>		
											<?php if ($this->_var['order']['pay_status'] == 0): ?>  
												<?php if ($this->_var['order']['payment_id'] == 0): ?>
												<a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:index|dcorder#order|"."id=".$this->_var['order']['id']."".""); 
?>" date-i="<?php echo $this->_var['order']['id']; ?>" class="continue_pay tip_color">继续付款</a>
												<?php elseif ($this->_var['order']['payment_id'] == 1): ?>
												
													<?php if ($this->_var['order']['confirm_status'] == 0): ?> 
													<a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:index|dc_dcorder#dc_reminder|"."id=".$this->_var['order']['id']."".""); 
?>" class="tip_color dc_reminder">我要催单</a>
													<?php elseif ($this->_var['order']['confirm_status'] == 1): ?> 	
													<a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:index|dc_dcorder#dc_reminder|"."id=".$this->_var['order']['id']."".""); 
?>" class="tip_color dc_reminder">我要催单</a>
													<a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:index|dc_dcorder#verify_delivery|"."id=".$this->_var['order']['id']."".""); 
?>" class="tip_color verify_delivery">确认收货</a>
													<?php endif; ?>
												<?php endif; ?>
											<?php else: ?>	
												<?php if ($this->_var['order']['confirm_status'] != 2): ?> 							
												<a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:index|dc_dcorder#dc_reminder|"."id=".$this->_var['order']['id']."".""); 
?>" class="tip_color dc_reminder">我要催单</a>
													<?php if ($this->_var['order']['confirm_status'] == 1): ?> 	
													<a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:index|dc_dcorder#verify_delivery|"."id=".$this->_var['order']['id']."".""); 
?>" class="tip_color verify_delivery">确认收货</a>
													<?php endif; ?>
												<?php else: ?>  
													<?php if ($this->_var['order']['is_dp'] == 0 && $this->_var['order']['dp_id'] == 0): ?>
													<a target="_blank" href="<?php echo $this->_var['order']['dp_url']; ?>" class="tip_color">我要点评</a>
													<?php endif; ?>
												<?php endif; ?>
											<?php endif; ?>
											
											<?php if ($this->_var['order']['order_status'] == 0 && $this->_var['order']['confirm_status'] != 2 && $this->_var['order']['refund_status'] == 0): ?> 
												<a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:index|dc_dcorder#cancel|"."id=".$this->_var['order']['id']."".""); 
?>" class="del_order">取消订单</a>
											<?php endif; ?>	
										<?php endif; ?>									
										
									</td>

									
	                            </tr>
							
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                   
   
						</tbody>
					</table>
				</div>
				
			</div>

			<div class="blank20"></div>
			<div class="pages"><?php echo $this->_var['pages']; ?></div>
			<?php else: ?>

			<div class="empty_tip">暂无订单，<a style="color:red;" href="<?php
echo parse_url_tag("u:index|dc|"."".""); 
?>">马上叫外卖</a></div>
			<?php endif; ?>
		</div>
	</div>	
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>