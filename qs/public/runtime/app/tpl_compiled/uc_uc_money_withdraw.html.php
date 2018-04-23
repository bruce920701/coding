<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_money_withdraw.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_money_withdraw.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_money_withdraw.js";

?>
<?php echo $this->fetch('inc/header.html'); ?>
<style>
.form_panel  .ui-textbox.hover{border: 1px solid #ddd;box-shadow:none;}
.form_panel  .ui-textbox{
	background:none;
    padding: 10px;
    width: 300px;
}
.form-item{
	text-align: left;
    line-height: 37px;
    height: 37px;
}
.refresh_verify{
	width: 80px;
    display: inline-block;
    height: 37px;
    float:left;
}
.refresh_verify img{
	width:100%;
	height:100%;
}
.img_verify{
	height: 37px;
    padding: 10px;
    box-sizing: border-box;
    margin-right: 15px;
    line-height: 37px;
    float: left;
}
.ui-icon{
	background:none;
	border:none;
	color:#666;
}
.form-item .icon-list{
	float: left;
	text-align: center;
	padding: 10px 0;
	width: 20%;
    box-sizing: border-box;
    border: 1px solid rgba(255, 255, 255, 0);
}
.icon-list.active{
    border: 1px solid #f80;
    color: #f80;
}
.icon-list i{
	display: block;
	font-size: 50px;
	margin-bottom: 10px;
	line-height: 50px;
	float: none;
}
.form-box-icon{
	margin-top:10px;
}
.ui-checkbox{
	margin-top:10px;
}
.batch{
	line-height:36px;
	margin-left:50px;
}
.info_table table .verification_code{
	padding-left:50px;
}
</style>
<script>
    var withdraw_ajax_url = "<?php
echo parse_url_tag("u:index|uc_money|"."del_user_bank".""); 
?>";
    var VERIFICATION_CODE_URL='<?php
echo parse_url_tag("u:index|ajax#verification_code|"."".""); 
?>';
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
		
		<div class="main_box uc_info_box">
			<div class="info_nav">
				<ul>
					<!--<li><a href="<?php
echo parse_url_tag("u:index|uc_money#incharge|"."".""); 
?>">会员充值</a></li>-->
					<li class="cur"><a href="<?php
echo parse_url_tag("u:index|uc_money#withdraw|"."".""); 
?>">会员提现</a></li>
				</ul>
			</div>

			<!-- 资产标题 -->
			<div class="info_box">
				<div class="blank20"></div>
				<h3>我的资产信息</h3>
				<div class="blank10"></div>
				<div class="bg_box growth_content">
					
					<div class="info_items">
						<ul>
							<li><label>我当前的余额是：</label><span class="main_color"><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['user_info']['money'],
);
echo $k['name']($k['v']);
?></span>
							<label>&nbsp;&nbsp;&nbsp;&nbsp;会员等级：</label><span class="level_bg level_<?php echo $this->_var['uc_query_data']['cur_level']; ?>" title="<?php echo $this->_var['uc_query_data']['cur_level_name']; ?>"></span>
							</li>
							<?php if ($this->_var['uc_query_data']['cur_gourp'] > 0): ?>
								<li><label>我当前所在的会员组：</label><span class="main_color"><?php echo $this->_var['uc_query_data']['cur_gourp_name']; ?></span></li>
								<?php if ($this->_var['uc_query']['data']['cur_discount'] < 10): ?>
								<li><label>会员组享受的折扣：</label><span class="main_color"><?php echo $this->_var['uc_query_data']['cur_discount']; ?> 折</span></li>
								<?php endif; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
			
			
			<div id="withdraw">
		
					<form name="withdraw_form" action="<?php
echo parse_url_tag("u:index|uc_money#withdraw_done|"."".""); 
?>" method="post" />	
					<div class="info_table">
					<table>
						<tr>
							<td class="withdraw">
								交易所地址
							</td>
							<td class="withcontent">
                                                            <input type="text" name="bank_name" class="ui-textbox" holder="请输入交易所地址" />
                                                            <?php if ($this->_var['user_bank_list']): ?>
                                                            <div class="bank_list_btn">已有银行卡<i class="iconfont">&#xe610;</i>
                                                                <div class="bank_list">
                                                                     
                                                                    <?php $_from = $this->_var['user_bank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
                                                                    <div class="bank_item bank_item_btn" rel="<?php echo $this->_var['row']['id']; ?>" data-bank-name="<?php echo $this->_var['row']['bank_name']; ?>" data-bank-account="<?php echo $this->_var['row']['bank_account']; ?>" data-bank-user="<?php echo $this->_var['row']['bank_user']; ?>"  title="<?php echo $this->_var['row']['bank_user']; ?> <?php echo $this->_var['row']['show_bank_name']; ?>">
                                                                        <?php echo $this->_var['row']['show_bank_name']; ?>
                                                                        <a class="iconfont del_bank_btn" rel="<?php echo $this->_var['row']['id']; ?>">&#xe619;</a>
                                                                    </div>
                                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                                    
                                                                   <div class="bank_item " >
                                                                         <a href="javascript:void(0);" class="new_bank_btn" >使用新的银行卡</a>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
							</td>
						</tr>
						<tr>
							<td class="withdraw">
								钱包地址
							</td>
							<td class="withcontent">
								<input type="text" name="bank_account" class="ui-textbox" holder="请输入钱包地址" />
							</td>
						</tr>
						<tr>
							<td class="withdraw">
								真实姓名
							</td>
							<td class="withcontent">
								<input type="text" name="bank_user" class="ui-textbox" holder="请输入开户人真实姓名" rel="<?php echo $this->_var['real_name']; ?>" <?php if ($this->_var['real_name']): ?>value="<?php echo $this->_var['real_name']; ?>"  readonly="readonly"<?php endif; ?>/>
							</td>
						</tr>
						<tr>
							<td class="withdraw">
								提币金额
							</td>
							<td class="withcontent">
								<input type="text" name="money" class="ui-textbox" holder="请输入提币金额" />
							</td>
						</tr>
						<?php if (app_conf ( "SMS_ON" ) == 1): ?>
						<tr <?php if ($this->_var['sms_ipcount'] > 1): ?>style="display:table-row"<?php endif; ?> class="ph_img_verify">
							<td class="withdraw">
								图片验证码
							</td>
							<td class="verification_code">
							</td>
						</tr>	
						<tr>
							<td class="withdraw">
								请输入验证码
							</td>
							<td class="withcontent">
								<input class="ui-textbox f_l ph_verify" id="sms_verify" name="sms_verify" holder="请输入验证码" />
								<button class="ui-button f_l light ph_verify_btn" rel="light" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" type="button">发送验证码</button>
							</td>
						</tr>
											
						<?php endif; ?>
                                                <tr id="is_bind_box">
							<td class="withdraw">
								&nbsp;
							</td>
							<td class="withcontent">
								<label class="ui-checkbox" rel="common_cbo"><input type="checkbox" name="is_bind" value="1" />是否绑定</label>
							</td>
						</tr>
						<tr>		
							<td colspan=2>
                                                            <input type="hidden" name="user_bank_id" value=""/>
                                                            <button class="ui-button orange" rel="orange" type="submit">提交申请</button>
                                                        </td>
						</tr>
					</table>
					</div>
					</form>					
	
			</div><!--end form-->
	
			
			<!-- 提现内容 -->
			<div class="blank20"></div>
			<div class="info_box">
				<h3>提现记录</h3>
				<div class="blank10"></div>
				<div class="info_table order_table">
					<table>
						<tbody>
							<tr>
								<th width="120">时间</th>
								<th width="100">金额</th>
								<th width="auto">详情</th>
								<th width="100">状态</th>
								<th width="70">操作</th>
							</tr>
							
							<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<tr class="alt">
                                <td>
								<?php 
$k = array (
  'name' => 'to_date',
  'value' => $this->_var['row']['create_time'],
);
echo $k['name']($k['value']);
?>
								</td>
                                <td>
                                	<h1><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['row']['money'],
);
echo $k['name']($k['v']);
?></h1>
                                </td>
                                <td class="detail">
                                	开户行全称:<?php echo $this->_var['row']['bank_name']; ?><br />
									开户行账号:<?php echo $this->_var['row']['bank_account']; ?><br />
									开户人真实姓名:<?php echo $this->_var['row']['bank_user']; ?><br />
                                </td>
								<td>									
									<?php if ($this->_var['row']['is_paid'] == 0): ?>
									<h1>审核中</h1>
									<?php else: ?>
                                        <?php if ($this->_var['row']['is_paid'] == 1): ?>
                                        <h1><?php 
$k = array (
  'name' => 'to_date',
  'value' => $this->_var['row']['pay_time'],
);
echo $k['name']($k['value']);
?></h1> 审核通过
                                        <?php else: ?>
                                        <h1><?php 
$k = array (
  'name' => 'to_date',
  'value' => $this->_var['row']['pay_time'],
);
echo $k['name']($k['value']);
?></h1> 审核未通过
                                        <?php endif; ?>
									<?php endif; ?>
								</td>
								<td class="op_box">
									<a href="javascript:void(0);" class="del_order" action="<?php
echo parse_url_tag("u:index|uc_money#del_withdraw|"."id=".$this->_var['row']['id']."".""); 
?>">删除</a>
								</td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                           
                            <tr >
                            	<?php if ($this->_var['list']): ?>
                                <td colspan="4"><div class="pages"><?php echo $this->_var['pages']; ?></div></td>
                                <?php else: ?>
                                <td colspan="4"><span>暂时没有提现记录</span></td>
                                <?php endif; ?>
                            </tr>
						</tbody>
					</table>
				</div>
				
			</div><!--end 列表-->
			
		</div>
	</div>	
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>