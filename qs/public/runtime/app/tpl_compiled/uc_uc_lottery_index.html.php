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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_lottery.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_lottery.js";
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
				<div class="title"><span>我的抽奖号</span></div>
				<div class="blank20"></div>
				
			</div>
			<?php if ($this->_var['list']): ?>
			<div class="info_box">
				<div class="info_table order_table">
					<table>
						<tbody>	
							<tr>
								<td colspan=3 class="order_sum">
									<h1>开奖结果请关注站点公告</h1>
								</td>
							</tr>							
							<tr>
								<th width="100">序列号</th>
								<th width="auto">详情</th>
								<th width="60">操作</th>
							</tr>
										
							<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lottery');if (count($_from)):
    foreach ($_from AS $this->_var['lottery']):
?>
							<tr>
								<td><?php echo $this->_var['lottery']['lottery_sn']; ?></td>
								<td>
									<a href="<?php echo $this->_var['lottery']['deal']['url']; ?>" target="_blank"><?php echo $this->_var['lottery']['deal']['name']; ?></a>																
								</td>
								<td>											
									<?php if (app_conf ( "SMS_ON" ) == 1 && app_conf ( "LOTTERY_SN_SMS" ) == 1 && $this->_var['lottery']['sms_count'] < app_conf ( "SMS_COUPON_LIMIT" )): ?>
									<a href="javascript:void(0);" class="send_lottery" action="<?php
echo parse_url_tag("u:index|uc_lottery#send|"."t=sms&id=".$this->_var['lottery']['id']."".""); 
?>">短信发送</a>
									<?php else: ?>
									--
									<?php endif; ?>	
								</td>
								
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                   
   
						</tbody>
					</table>
				</div>
				
			</div>

			<div class="blank20"></div>
			<div class="pages"><?php echo $this->_var['pages']; ?></div>
			<?php else: ?>
			<div class="empty_tip">没有抽奖记录</div>
			<?php endif; ?>
		</div>
	</div>	
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>