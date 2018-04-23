<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_order.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_order.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_order.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
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
				<div class="title"><span>我的消费券</span></div>
				<div class="blank20"></div>
				
			</div>
			
			<?php if ($this->_var['list']): ?>
			<div class="info_box">
				<div class="info_table order_table">
					<table>
						<tbody>
							<?php if ($this->_var['deal']): ?>
							<tr>
								<td colspan=5>
									<table>
										<tr>
											<th width="50">&nbsp;</th>
											<th width="auto">详情</th>
											<th width="50">价格</th>
											<th width="70">数量</th>
										</tr>
										<tr>
												<td>
													<a href="<?php echo $this->_var['deal']['url']; ?>" target="_blank"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['deal']['deal_icon'],
  'w' => '50',
  'h' => '50',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" lazy="true" class="deal_icon" /></a>
												</td>
				                                <td class="tl">
				                                	<a href="<?php echo $this->_var['deal']['url']; ?>" target="_blank"><?php echo $this->_var['deal']['name']; ?></a>
												</td>
				                                <td>
				                                	<?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['deal']['total_price'],
);
echo $k['name']($k['v']);
?>
												</td>
				                                <td><?php echo $this->_var['deal']['number']; ?></td>												
										</tr>
									</table>
								</td>
							</tr>
							<?php endif; ?>
							<tr>
								<th width="100">序列号</th>
								<th width="auto">详情</th>
								<th width="150">有效期</th>
								<th width="120">状态</th>
								<th width="60">操作</th>
							</tr>
				
							<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'coupon');if (count($_from)):
    foreach ($_from AS $this->_var['coupon']):
?>
							<tr>
								<td><?php echo $this->_var['coupon']['password']; ?></td>
								<td>
									<a href="<?php echo $this->_var['coupon']['deal']['url']; ?>" target="_blank"><?php echo $this->_var['coupon']['deal']['sub_name']; ?></a>
									&nbsp;&nbsp;<?php if ($this->_var['coupon']['deal_type'] == 1): ?>【可消费 <h1><?php echo $this->_var['coupon']['number']; ?></h1> 位】<?php endif; ?>
									
								</td>
								<td>
									<?php if ($this->_var['coupon']['end_time']): ?><?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['coupon']['end_time'],
  'f' => 'Y-m-d',
);
echo $k['name']($k['v'],$k['f']);
?><?php endif; ?>
									<?php if ($this->_var['coupon']['end_time'] == 0): ?>无限期<?php endif; ?>
								</td>
								<td>
									<?php if ($this->_var['coupon']['confirm_time'] == 0): ?>
										<?php if ($this->_var['coupon']['refund_status'] == 1): ?>
											退款中
										<?php elseif ($this->_var['coupon']['refund_status'] == 2): ?>
											已退款
										<?php elseif ($this->_var['coupon']['refund_status'] == 3): ?>
											退款被拒
										<?php else: ?>
											<?php if ($this->_var['coupon']['is_valid'] == 1): ?>
												<?php if ($this->_var['coupon']['end_time'] > 0 && $this->_var['coupon']['end_time'] < $this->_var['NOW_TIME']): ?>
												已过期
												<?php else: ?>
												有效
												<?php endif; ?>
											<?php else: ?>
												作废
											<?php endif; ?>
										<?php endif; ?>
									<?php else: ?>
										<?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['coupon']['confirm_time'],
  'f' => 'Y-m-d',
);
echo $k['name']($k['v'],$k['f']);
?><br> 消费
									<?php endif; ?>
									
								</td>
								<td>
									<?php if ($this->_var['coupon']['refund_status'] == 0 && $this->_var['coupon']['confirm_time'] == 0): ?>
										<?php if ($this->_var['coupon']['any_refund'] == 1 || ( $this->_var['coupon']['expire_refund'] == 1 && $this->_var['coupon']['end_time'] > 0 && $this->_var['coupon']['end_time'] < $this->_var['NOW_TIME'] )): ?>
										<a href="javascript:void(0);" class="refund" action="<?php
echo parse_url_tag("u:index|uc_order#refund|"."cid=".$this->_var['coupon']['id']."".""); 
?>">退款</a>
										<?php else: ?>
										--
										<?php endif; ?>
									<?php else: ?>
									--
									<?php endif; ?>
									
									<?php if ($this->_var['coupon']['refund_status'] != 1 && $this->_var['coupon']['refund_status'] != 2 && $this->_var['coupon']['confirm_time'] == 0 && ( $this->_var['coupon']['end_time'] > $this->_var['NOW_TIME'] || $this->_var['coupon']['end_time'] = 0 )): ?> 
									<?php if ($this->_var['deal']['forbid_sms'] == 0 && app_conf ( "SMS_ON" ) == 1 && app_conf ( "SMS_SEND_COUPON" ) == 1 && $this->_var['coupon']['sms_count'] < app_conf ( "SMS_COUPON_LIMIT" )): ?>
									<br />
									<a href="javascript:void(0);" class="send_coupon" action="<?php
echo parse_url_tag("u:index|uc_coupon#send|"."t=sms&id=".$this->_var['coupon']['id']."".""); 
?>">短信发送</a>
									<?php endif; ?>
									
									<?php if (app_conf ( "MAIL_ON" ) == 1 && app_conf ( "MAIL_SEND_COUPON" ) == 1 && $this->_var['coupon']['mail_count'] < app_conf ( "MAIL_COUPON_LIMIT" )): ?>
									<br />
									<a href="javascript:void(0);" class="send_coupon" action="<?php
echo parse_url_tag("u:index|uc_coupon#send|"."t=mail&id=".$this->_var['coupon']['id']."".""); 
?>">邮件发送</a>
									<?php endif; ?>
									<?php endif; ?>
									<br />
									<a href="<?php
echo parse_url_tag("u:index|uc_order#view|"."id=".$this->_var['coupon']['order_id']."".""); 
?>">查看订单</a>
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
			<div class="empty_tip">没有相关的消费券记录</div>
			<?php endif; ?>
		</div>
	</div>	
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>