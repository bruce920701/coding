<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/uc_exchange.js";

?>
<?php echo $this->fetch('inc/header.html'); ?>

<script type="text/javascript">
var ALLOW_EXCHANGE = 0;
<?php if ($this->_var['ACTION_NAME'] == 'exchange'): ?>
	ALLOW_EXCHANGE = '<?php echo $this->_var['allow_exchange']; ?>';
	var EXCHANGE_JSON_DATA = <?php echo $this->_var['exchange_json_data']; ?>;
<?php endif; ?>
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
			<div class="info_nav" >
				<ul>
					<!--<li <?php if ($this->_var['ACTION_NAME'] == 'money'): ?>class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#money|"."".""); 
?>">我的资金</a></li>-->
					<!--<li <?php if ($this->_var['ACTION_NAME'] == 'point'): ?>class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#point|"."".""); 
?>">我的成长</a></li>-->
					<!--<li <?php if ($this->_var['ACTION_NAME'] == 'score'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#score|"."".""); 
?>">我的积分</a></li>-->
					<li <?php if ($this->_var['ACTION_NAME'] == 'bdjl'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#bdjl|"."".""); 
?>">静态奖金</a></li>
					<li <?php if ($this->_var['ACTION_NAME'] == 'jiangjin'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#jiangjin|"."".""); 
?>">动态奖金</a></li>
					<li <?php if ($this->_var['ACTION_NAME'] == 'hzjf'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#hzjf|"."".""); 
?>">互转积分</a></li>
					<li <?php if ($this->_var['ACTION_NAME'] == 'hzjhm'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#hzjhm|"."".""); 
?>">互转结算码</a></li>
					<li <?php if ($this->_var['ACTION_NAME'] == 'yjmx'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#yjmx|"."".""); 
?>">业绩明细</a></li>
					<li <?php if ($this->_var['ACTION_NAME'] == 'bdzx'): ?> class="cur"<?php endif; ?>><a class="jinru none" href="<?php
echo parse_url_tag("u:index|uc_log#bdzx|"."".""); 
?>">申请报单中心</a></li>
					<li <?php if ($this->_var['ACTION_NAME'] == 'dhzcjf'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#dhzcjf|"."".""); 
?>">兑换注册积分</a></li>
					<?php if ($this->_var['allow_exchange']): ?><li <?php if ($this->_var['ACTION_NAME'] == 'exchange'): ?> class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|uc_log#exchange|"."".""); 
?>">uc兑换</a></li><?php endif; ?>
				</ul>
			</div>
			<!-- 资产 -->
			<?php if ($this->_var['ACTION_NAME'] == 'money'): ?>
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
?></span></li>
							<li><label>	充值到<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SHOP_TITLE',
);
echo $k['name']($k['v']);
?>帐户，方便抢购！：</label><span><a class="main_color" href="<?php
echo parse_url_tag("u:index|uc_money#incharge|"."".""); 
?>" target="_blank">[会员充值]</a></span></li>
						</ul>
					</div>
				</div>
			</div>
			
			<!-- 资产内容 -->
			<div class="blank20"></div>
			<div class="info_box">
				<h3>我的资产记录</h3>
				<div class="blank10"></div>
				<div class="info_table">
					<table>
						<tbody>
							<tr>
								<th width="120">时间</th>
								<th width="auto">详情</th>
								<th width="70">金额</th>
							</tr>
							<?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<tr class="alt">
                                <td><?php echo $this->_var['row']['flog_time']; ?></td>
                                <td class="detail"><?php echo $this->_var['row']['log_info']; ?></td>
                                <td class="value increase" ><span class="growth">&yen;<?php if ($this->_var['row']['money'] > 0): ?>+<?php endif; ?><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['row']['money'],
  'v2' => '2',
);
echo $k['name']($k['v'],$k['v2']);
?></span></td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            
                            <tr >
                            	<?php if ($this->_var['data']['count'] > 0): ?>
                                <td colspan="3"><div class="pages"><?php echo $this->_var['pages']; ?></div></td>
                                <?php else: ?>
                                <td colspan="3"><span>暂时没有成资金日志</span></td>
                                <?php endif; ?>

                            </tr>
						</tbody>
					</table>
				</div>
				
			</div>
			
			<?php endif; ?>
			
			<!--经验-->
			<?php if ($this->_var['ACTION_NAME'] == 'point'): ?> 
			<div class="info_box">
				<div class="blank20"></div>
				<h3>我的成长信息</h3>
				<div class="blank10"></div>
				<div class="bg_box growth_content">
					
					<div class="info_items">
						<ul>
							<li><label>我当前的等级是：</label><span class="level_bg level_<?php echo $this->_var['uc_query_data']['cur_level']; ?>" title="<?php echo $this->_var['uc_query_data']['cur_level_name']; ?>"></span></li>
							<li><label>我当前的经验值是：</label><span class="main_color"><?php echo $this->_var['uc_query_data']['cur_point']; ?></span></li>
							<?php if ($this->_var['uc_query_data']['next_level'] > 0): ?>
								<li><label>我再增加：</label><span><em class="main_color"><?php echo $this->_var['uc_query_data']['next_point']; ?></em> 经验值，就可以升级为：<em class="lv_name"><?php echo $this->_var['uc_query_data']['next_level_name']; ?></em></span></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="blank20"></div>
			<div class="info_box">
				<h3>我的成长记录</h3>
				<div class="blank10"></div>
				<div class="info_table">
					<table>
						<tbody>
							<tr>
								<th width="120">时间</th>
								<th width="auto">详情</th>
								<th width="70">经验值</th>
							</tr>
							<?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<tr class="alt">
                                <td><?php echo $this->_var['row']['flog_time']; ?></td>
                                <td class="detail"><?php echo $this->_var['row']['log_info']; ?></td>
                                <td class="value increase" ><span class="growth"><?php if ($this->_var['row']['point'] > 0): ?>+<?php endif; ?><?php echo $this->_var['row']['point']; ?></span></td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            
                            <tr >
                            	<?php if ($this->_var['data']['count'] > 0): ?>
                                <td colspan="3"><div class="pages"><?php echo $this->_var['pages']; ?></div></td>
                                <?php else: ?>
                                <td colspan="3"><span>暂时没有成长记录，^_^ 去发发文章或者图片，累计经验你就成长了~</span></td>
                                <?php endif; ?>

                            </tr>
						</tbody>
					</table>
				</div>
				
			</div>
			<?php endif; ?>
			
			
			<!--积分-->
			<?php if ($this->_var['ACTION_NAME'] == 'score'): ?> 
			<div class="info_box">
				<div class="blank20"></div>
					<h3>我的积分信息</h3>
				<div class="blank10"></div>
				<div class="bg_box ">
					<div class="info_items">
						<ul>
							<li><label>我当前的积分是：</label><span class="main_color"><?php echo $this->_var['uc_query_data']['cur_score']; ?></span></li>
							<?php if ($this->_var['uc_query_data']['cur_gourp'] > 0): ?>
								<li><label>我当前所在的会员组：</label><span class="main_color"><?php echo $this->_var['uc_query_data']['cur_gourp_name']; ?></span></li>
								<?php if ($this->_var['uc_query_data']['cur_discount'] >= 1): ?>
								<?php if ($this->_var['uc_query_data']['cur_discount'] < 10): ?>
								<li><label>会员组享受的折扣：</label><span class="main_color"><?php echo $this->_var['uc_query_data']['cur_discount']; ?> 折</span></li>
								<?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="blank20"></div>
			<div class="info_box">
				<h3>我的积分记录</h3>
				<div class="blank10"></div>
				<div class="info_table">
					<table>
						<tbody>
							<tr>
								<th width="120">时间</th>
								<th width="auto">详情</th>
								<th width="70">积分值</th>
							</tr>
							<?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<tr class="alt">
                                <td><?php echo $this->_var['row']['flog_time']; ?></td>
                                <td class="detail"><?php echo $this->_var['row']['log_info']; ?></td>
                                <td class="value increase" ><span class="growth"><?php if ($this->_var['row']['score'] > 0): ?>+<?php endif; ?><?php echo $this->_var['row']['score']; ?></span></td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <tr >
                            	<?php if ($this->_var['data']['count'] > 0): ?>
                                <td colspan="3"><div class="pages"><?php echo $this->_var['pages']; ?></div></td>
                                <?php else: ?>
                                <td colspan="3"><span>暂时没有积分记录，^_^ </span></td>
                                <?php endif; ?>
                            </tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>
			
			
			<!-- 兑换 -->
			<?php if ($this->_var['ACTION_NAME'] == 'exchange' && $this->_var['allow_exchange']): ?>
			<!-- 资产标题 -->
			<div class="info_box">
				<div class="blank20"></div>
				<h3>我的资产预览</h3>
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
?></span></li>
							<li><label>我累计的积分是：</label><span class="main_color"><?php echo $this->_var['user_info']['score']; ?></span></li>
							<li><label>我当前的经验是：</label><span class="main_color"><?php echo $this->_var['user_info']['point']; ?></span></li>
						</ul>
					</div>
				</div>
			</div>
			
			<!-- 资产内容 -->
			<div class="blank20"></div>
			<div class="info_box">
				<h3>我的兑换操作</h3>
				<div class="blank10"></div>
				<div class="info_table cnt_tf_left">
					<table>
						<tbody>
							<tr>
								<th width="80">兑换数量</th>
								<th width="auto">详情</th>
								<th width="150">消耗</th>
							</tr>
							<tr class="alt">
                                <td>
                                	<input type="text" class="ui-textbox field_text" name="amountdesc" id="amountdesc" size="4"  />
                                </td>
                                <td class="detail">
                                		<div class="field_select w430">
			                                <select name="key" id="key" class="ui-select ">
												<?php $_from = $this->_var['exchange_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'exchange_desc');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['exchange_desc']):
?>
												<option value="<?php echo $this->_var['key']; ?>" rel="<?php echo $this->_var['exchange_desc']['title']; ?>"><?php echo $this->_var['exchange_desc']['title']; ?>(<?php echo $this->_var['exchange_desc']['ratiodesc']; ?> <?php echo $this->_var['exchange_desc']['title']; ?>:<?php echo $this->_var['exchange_desc']['ratiosrc']; ?> <?php echo $this->_var['exchange_desc']['srctitle']; ?>)</option>
												<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
											</select>
										</div>
                                </td>
                                <td class="value increase" >
                                	<input type="text" class="ui-textbox field_text" name="amountsrc" id="amountsrc"   size="4" readonly="true" />
                                	<span id="titlesrc"></span>
                                </td>
                            </tr>
							<tr >
                                <td colspan="3">
	                                <span>登录密码：&nbsp;&nbsp;</span>
									<input type="password" name="user_pwd" id="user_pwd" class="ui-textbox field_text" />
								</td>
                            </tr>
                            <tr >
                                <td colspan="3">
                                <button id="doexchange" rel="orange" type="button" class="formbutton ui-button">兑换</button>
                                </td>
                            </tr>
						</tbody>
					</table>
				</div>
				
			</div>
			
			<?php endif; ?>
			
			
			<!--报单奖励-->
			<?php if ($this->_var['ACTION_NAME'] == 'bdjl'): ?> 
			<div class="info_box">
				<!--<div class="blank20"></div>-->
				<div class="myJinDou">
					<div class="goPayHead">
						<p>消费奖励 ></p>
					</div>
					<div class="blank20"></div>
					<div class="head_jindou">
						<div class="wode_img">
							<?php 
$k = array (
  'name' => 'show_avatar',
  'id' => $this->_var['user_info']['id'],
  'type' => 'small',
  'is_card' => '0',
);
echo $k['name']($k['id'],$k['type'],$k['is_card']);
?>
						</div>
						<div class="bd_mingxi">
							<p class="jindou_a">可用的受益积分:<span><?php echo $this->_var['user_info']['avalible_benefit_credits']; ?></span></p>
							<p class="xiaofei_a">可用的消费积分:<span><?php echo $this->_var['user_info']['avalible_consume_credits']; ?></span></p>
							<p class="jindou_b">进账明细:</p>
						</div>
						<div class="bd_shuoming">
							<p>说明: <span>每周可申请受益1次，申请后根据每日利息计入冻结受益积分里，每周一转化为可用受益积分。申请释放时需要结算码个数:<span> <?php echo $this->_var['expend_active_code']; ?></span></span></p>
						</div>
						
					</div>
					<!--<div class="blank20"></div>-->
					<ul class="mx">
						<li>
							<p>
								<span>消费金额</span>
								<!-- <span>本周受益利息</span> -->
								<span>冻结的受益积分</span>
								<span>冻结的消费积分</span>
								<span>操作</span>
							</p>
							<div>
								<span><?php echo $this->_var['total_consume']; ?></span>
								<!-- <span><?php echo $this->_var['static_rate_str']; ?></span> -->
								<span><?php echo $this->_var['frozen_benefit_credits']; ?></span>
								<span><?php echo $this->_var['frozen_consume_credits']; ?></span>
								<span class="data_e">
									<button class="btn1" type="button" value="<?php echo $this->_var['can_get_static_reward']; ?>">申请受益</button>
									<button class="btn2 none" type="button" value="<?php echo $this->_var['can_get_static_reward']; ?>">释放</button>
								</span>
							</div>
						</li>
					</ul>
					<ul class="mx_a">
						<p><span>时间</span><span>受益</span><span>状态</span></p>
						<div>
							
							<?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'count');if (count($_from)):
    foreach ($_from AS $this->_var['count']):
?>
							<li>
								<span><?php echo $this->_var['count']['c_time']; ?></span>
								<span><?php echo $this->_var['count']['credits']; ?></span>
								<span><?php echo $this->_var['count']['status']; ?></span>
							</li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</div>
					</ul>
				</div>
			</div>
			<script>
				$(".data_e .btn1").click(function(){
					$.ajax({
						url:'index.php?ctl=uc_log&act=get_static_reward',
						type:"post",
						data:'',
						dataType:"json",
						success:function(data){
							if(data.status == true){
								alert('申请成功!!!');
								$("#.data_e .btn1").attr("disabled",true);
								$("#.data_e .btn1").css("background-color","#ddd");
								window.location.reload();
							}
						}
					});
				})
				$(".data_e .btn2").click(function(){
					if(<?php echo $this->_var['user_info']['active_code']; ?> < <?php echo $this->_var['expend_active_code']; ?>) {
						alert("结算码数额不足,请充值!!!");
						return false;
					}else{
						$.ajax({
							url:'index.php?ctl=uc_log&act=release_static_reward',
							type:"post",
							data:'',
							dataType:"json",
							success:function(data){
								if(data.status == true){
									alert('释放成功');
									$(".btn1").removeClass("none");
									$(".btn2").addClass("none");
//									$("#.data_e .btn2").attr("disabled",true);
//									$("#.data_e .btn2").css("background-color","#ddd");
									window.location.reload();
								}
							}
						});
					}
				})
				//状态颜色
				$(window).ready(function(){
					var dianji = $(".data_e button").val();
					if(dianji == 0){
						$("#.data_e .btn1").attr("disabled",true);
						$("#.data_e .btn1").css("background-color","#ddd");
					}else if(dianji == 1){
						$("#.data_e .btn1").attr("disabled",false);
					}else if(dianji == 2){
						$(".btn2").removeClass("none");
						$(".btn1").addClass("none");
					}
					var zt = $(".mx_a div li span:last-child");
					var sj = $(".mx_a div li span:first-child");
					var djz = "冻结中";
					var ysf = "已释放";
					for(var i = 0;i<zt.length;i++){
						var zts = zt.eq(i).text();
						var sjs = sj.eq(i).text()*1000;
						if(zts == "0"){
							zt.eq(i).html(djz);
							zt.eq(i).css("color","#f56d06");
							
						}else if(zts == "1"){
							zt.eq(i).html(ysf);
							zt.eq(i).css("color","#219820");
						}
						var time = new Date(sjs);
						var year = time.getFullYear();
						var month = time.getMonth()+1;
						var day = time.getDate();
						var hour = time.getHours();
						var min = time.getMinutes();
						var sen = time.getSeconds();
						times = year +'-'+ getzf(month) +'-'+ getzf(day) +' '+ getzf(hour) +':'+ getzf(min) +':'+getzf(sen);
						sj.eq(i).html(times);
					}

//			        //补0操作
			      function getzf(num){  
			          if(parseInt(num) < 10){  
			              num = '0'+num;  
			          }  
			          return num;  
			      }
					
//					$.ajax({
//						type:"post",
//						url:"index.php?ctl=bdjl",
//						data:"",
//						dataType:"json",
//						success:function(data){
//							console.log(data);
//						}
//					});
				});
				
			</script>
			<?php endif; ?>
			<!--奖金明细-->
			<?php if ($this->_var['ACTION_NAME'] == 'jiangjin'): ?> 
			<div class="info_box">
				<div class="myJinDou">
					<div class="goPayHead">
						<p>奖金明细 ></p>
					</div>
					<div class="blank20"></div>
					<div class="head_jindou">
						<div class="wode_img_a">
							<?php 
$k = array (
  'name' => 'show_avatar',
  'id' => $this->_var['user_info']['id'],
  'type' => 'small',
  'is_card' => '0',
);
echo $k['name']($k['id'],$k['type'],$k['is_card']);
?>
						</div>
						<!--<p class="jindou_a">累计创业金豆:<span>0</span></p>-->
						<p class="jindou_a">总获得:<span><?php echo $this->_var['total_direct_reward']; ?></span><span class="none"><?php echo $this->_var['total_leader_reward']; ?></span></p>
						<p class="jindou_b">进账明细:</p>
					</div>
					<!--<div class="blank20"></div>-->
					<div class="head_a">
							<div class="con_b_a">   <!--我的金豆-->
								<p>
									<a href="javascript:;" class="con_b_a_active">直推奖</a>
									<a href="javascript:;">领导奖</a>
								</p>
								<div class="con_con">
									<div class="con_con_a"> <!--创业激励-->
										<p><span style="width: 20.6666%">获奖时间</span><span style="color: #000 !important;">获得奖励</span><span>状态</span><span>详情</span></p>
										<ul>
											<?php $_from = $this->_var['direct_reward_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'counts');if (count($_from)):
    foreach ($_from AS $this->_var['counts']):
?>
											<li>
												<span style="width: 20.6666%"><?php echo $this->_var['counts']['c_time']; ?></span>
												<span><?php echo $this->_var['counts']['credits']; ?></span>
												<span><?php echo $this->_var['counts']['status']; ?></span>
												<span><?php echo $this->_var['counts']['msg']; ?></span>
											</li>
											
											<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
											
										</ul>
									</div>
									<div class="con_con_a con_con_b none"><!--创新激励-->
										<p><span style="width: 20.6666% !important;">获奖时间</span><span>获得奖励</span><span style="color: #000 !important;">状态</span><span style="width: 45.4%;font-size: 16px;">详情</span></p>	
										<ul>
											<?php $_from = $this->_var['leader_reward_detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'coun');if (count($_from)):
    foreach ($_from AS $this->_var['coun']):
?>
											<li>
												<span style="width: 20.6666% !important;"><?php echo $this->_var['coun']['c_time']; ?></span>
												<span><?php echo $this->_var['coun']['credits']; ?></span>
												<span><?php echo $this->_var['coun']['status']; ?></span>
												<span><?php echo $this->_var['coun']['msg']; ?></span>
											</li>
											<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										</ul>
									</div>
								</div>
								<script>
									$(window).ready(function(){
										var text1 = $(".con_con_a ul li span:nth-child(3)");
										var sj = $(".con_con_a ul li span:first-child");
										for(var z = 0;z<text1.length;z++){
											var texts = text1.eq(z).text();
											var sjs = sj.eq(z).text();
											var djz = "冻结中";
											var ysf = "已释放";
											if(texts == "1"){
												text1.eq(z).html(ysf);
												text1.eq(z).css("color","#038e00");
											}else if(texts == "0"){
												text1.eq(z).html(djz);
												text1.eq(z).css("color","#ff7e00");
											}
											var Times = new Date(sjs*1000);
											var Year = Times.getFullYear();
											var Month = Times.getMonth()+1;
											var Day = Times.getDate();
											var Hour = Times.getHours();
											var Min = Times.getMinutes();
											var Sen = Times.getSeconds();
											Times = Year +'-'+ getzf(Month) +'-'+ getzf(Day) +' '+ getzf(Hour) +':'+ getzf(Min) +':'+getzf(Sen);
											sj.eq(z).html(Times)
						//			        //补0操作
									      function getzf(num){  
									          if(parseInt(num) < 10){  
									              num = '0'+num;  
									          }  
									          return num;  
			     							 }
										}
									})
								</script>
							</div>
					</div>
				</div>
			</div>
			<script>
				$(".con_b_a>p>a").click(function(){
					$(this).addClass("con_b_a_active").siblings().removeClass("con_b_a_active");
					var i =	$(this).index();
					$(".con_con>div").eq(i).removeClass("none").siblings().addClass("none");
					$(".jindou_a span").eq(i).removeClass("none").siblings().addClass("none");
				})
			</script>
			<?php endif; ?>
			<!--互转积分-->
			<?php if ($this->_var['ACTION_NAME'] == 'hzjf'): ?> 
			<div class="info_box">
				<div class="myJinDou">
					<div class="goPayHead">
						<p>互转积分 ></p>
					</div>
					<div class="blank20"></div>
					<form action="<?php
echo parse_url_tag("u:index|uc_log#do_translate_active_code|"."".""); 
?>" method="post">
						<div class="hzjf_con">
							<p class="hzjf_ye">注册积分余额: <span class="jf"><?php echo $this->_var['user_info']['register_credits']; ?></span></p>
							<p class="zcId"><span>转出ID或者昵称:</span><input class="id" name="to_id" type="text" placeholder="在此输入准确的ID或者昵称"/></p>
							<p><span>转出数量:</span><input type="text" class="num" name="t_active_code" placeholder="0.00"/></p>
							<p><span>交易密码:</span><input type="password" class="paw"  name="trade_pwd" placeholder="请输入交易密码"/></p>
							<!--<p><span>验证码:</span>
								<input type="text" class="code" placeholder="请输入验证码"/>
								<input type="button" class="huoqu" value="获取验证码" onclick="timing()"/>
							</p>-->
							<button class="tijiao" type="button" style="background-color: #f80;">立即转出</button>
						</div>
						<div class="hzjf_list">
							<p><span>转出ID</span><span>转入ID</span><span>转出数量</span><span>转出时间</span><span>明细</span></p>
							<ul>
								<?php $_from = $this->_var['translate_detail_credits']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item1');if (count($_from)):
    foreach ($_from AS $this->_var['item1']):
?>
								<li>
									<span><?php echo $this->_var['item1']['id']; ?></span>
									<span><?php echo $this->_var['item1']['to_id']; ?></span>
									<span><?php echo $this->_var['item1']['num']; ?></span>
									<span><?php echo $this->_var['item1']['time']; ?></span>
									<span><?php echo $this->_var['item1']['msg']; ?></span>
								</li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
					</form>
				</div>

			</div>

			<script>
				$(window).ready(function(){
					var list1 = $(".hzjf_list ul li span:nth-child(4)");
					for(var z1 = 0;z1<list1.length;z1++){
						var sjs1 = list1.eq(z1).text();
						var Times = new Date(sjs1*1000);
						var Year = Times.getFullYear();
						var Month = Times.getMonth()+1;
						var Day = Times.getDate();
						var Hour = Times.getHours();
						var Min = Times.getMinutes();
						var Sen = Times.getSeconds();
						Times = Year +'-'+ getzf(Month) +'-'+ getzf(Day) +' '+ getzf(Hour) +':'+ getzf(Min) +':'+getzf(Sen);
						list1.eq(z1).html(Times)
	//			        //补0操作
				      function getzf(num){  
				          if(parseInt(num) < 10){  
				              num = '0'+num;  
				          }  
				          return num;  
						 }
					}
				})
				//是否输入完成验证
//				$(document).on("click",".tijiao",function(){
					$(".tijiao").click(function(){
						var hzjf_ye = parseFloat($(".hzjf_ye .jf").text());
						var to_id = $(".id").val();
						var t_active_code = $(".num").val();
						var trade_pwd = $(".paw").val();
//						var code = $(".code").val();
						if(to_id == ""){
							alert("ID不能为空!!!");
							return false;
						}else if(hzjf_ye < t_active_code){
							alert("转出数量超过积分余额!!!");
							return false;
						}else if(t_active_code == ""){
							alert("转出数量不能为空!!!");
							return false;
						}else if(trade_pwd == ""){
							alert("交易密码不能为空!!!");
							return false;
						}else{
							$.ajax({
								url:'index.php?ctl=uc_log&act=do_translate_credits',
								type:"post",
								data:{"to_id":to_id,"t_active_code":t_active_code,"trade_pwd":trade_pwd},
								dataType:"json",
								success:function(data){
									if(data.status == false){
										alert(data.info);
										return false;
									}else{
										alert("转出成功!!!");
										window.location.reload();
									}
									
								}
							})
						}
					})
				//获取验证码倒计时
				var time=60; 
				function timing() { 
					if (time == 0) { 
						$(".huoqu").attr("disabled",false);
						$(".huoqu").val("重新获取"); 
						time = 60; 
						return;
					} else { 
						$(".huoqu").attr("disabled", true); 
						$(".huoqu").val("重新发送" + time + "s"); 
						time--; 
						setTimeout(function() { 
							timing() 
						},1000) 
					} 
				} 
			</script>
			<?php endif; ?>
			
			<!--互转结算码-->
			<?php if ($this->_var['ACTION_NAME'] == 'hzjhm'): ?> 
			<div class="info_box">
				<div class="myJinDou">
					<div class="goPayHead">
						<p>互转结算码 ></p>
					</div>
					<div class="blank20"></div>
					<!--<form action="<?php
echo parse_url_tag("u:index|uc_log#do_translate_credits|"."".""); 
?>" method="post">-->
						<div class="hzjf_con">
							<p class="hzjf_ye">结算码个数: <span class="jhm"><?php echo $this->_var['user_info']['active_code']; ?></span></p>
							<p class="zcId"><span>转出ID或者昵称:</span><input class="id1" name="t_id" type="text" placeholder="在此输入准确的ID或者昵称"/></p>
							<p><span>转出数量:</span><input type="text" class="num1"  name="t_credits" placeholder="0.00"/></p>
							<p><span>交易密码:</span><input type="password" class="paw1" name="trade_pwd" placeholder="请输入交易密码"/></p>
							<!--<p><span>验证码:</span>
								<input type="text" class="code1" placeholder="请输入验证码"/>
								<input type="button" class="huoqu" value="获取验证码" onclick="timing()"/>
							</p>-->
							<button class="tijiao1" type="button" style="background-color: #f80;">立即转出</button>
						</div>
						<div class="hzjf_list">
							<p><span>转出ID</span><span>转入ID</span><span>转出数量</span><span>转出时间</span><span>详情</span></p>
							<ul>
								<?php $_from = $this->_var['translate_detail_code']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item2');if (count($_from)):
    foreach ($_from AS $this->_var['item2']):
?>
								<li>
									<span><?php echo $this->_var['item2']['id']; ?></span>
									<span><?php echo $this->_var['item2']['to_id']; ?></span>
									<span><?php echo $this->_var['item2']['num']; ?></span>
									<span><?php echo $this->_var['item2']['time']; ?></span>
									<span><?php echo $this->_var['item2']['msg']; ?></span>
								</li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
					<!--</form>-->
				</div>
			</div>
			<script>
				
				$(window).ready(function(){
					var list1 = $(".hzjf_list ul li span:nth-child(4)");
					for(var z1 = 0;z1<list1.length;z1++){
						var sjs1 = list1.eq(z1).text();
						var Times = new Date(sjs1*1000);
						var Year = Times.getFullYear();
						var Month = Times.getMonth()+1;
						var Day = Times.getDate();
						var Hour = Times.getHours();
						var Min = Times.getMinutes();
						var Sen = Times.getSeconds();
						Times = Year +'-'+ getzf(Month) +'-'+ getzf(Day) +' '+ getzf(Hour) +':'+ getzf(Min) +':'+getzf(Sen);
						list1.eq(z1).html(Times)
	//			        //补0操作
				      function getzf(num){  
				          if(parseInt(num) < 10){  
				              num = '0'+num;  
				          }  
				          return num;  
						 }
					}
				})
				//是否输入完成验证
					$(".tijiao1").click(function(){
						var hzjf_ye1 = parseFloat($(".hzjf_ye .jhm").text());
						var t_id = $(".id1").val();
						var t_credits = $(".num1").val();
						var trade_pwd1 = $(".paw1").val();
//						var code1 = $(".code1").val();
						if(t_id == ""){
							alert("ID不能为空!!!");
							return false;
						}else if(hzjf_ye1 < t_credits){
							alert("转出数量超过积分余额!!!");
							return false;
						}else if(t_credits == ""){
							alert("转出数量不能为空!!!");
							return false;
						}else if(trade_pwd1 == ""){
							alert("交易密码不能为空!!!");
							return false;
						}else{
							$.ajax({
								url:'index.php?ctl=uc_log&act=do_translate_active_code',
								type:"post",
								data:{"t_id":t_id,"t_credits":t_credits,"trade_pwd":trade_pwd1},
								dataType:"json",
								success:function(data){
//									console.log(data);
									if(data.status == false){
										alert(data.info);
										return false;
									}else{
										alert("转出成功!!!");
										window.location.reload();
									}
									
								}
							})
						}
					})
				//获取验证码倒计时
				var time=60; 
				function timing() { 
					if (time == 0) { 
						$(".huoqu").attr("disabled",false);
						$(".huoqu").val("重新获取"); 
						time = 60; 
						return;
					} else { 
						$(".huoqu").attr("disabled", true); 
						$(".huoqu").val("重新发送" + time + "s"); 
						time--; 
						setTimeout(function() { 
							timing() 
						},1000) 
					} 
				} 
			</script>
			<?php endif; ?>
			<!--业绩明细-->
			<?php if ($this->_var['ACTION_NAME'] == 'yjmx'): ?> 
			<div class="info_box">
				<div class="myJueSe">
					<div class="goPayHead">
						<p>业绩明细 ></p>
					</div>
					<div class="blank20"></div>
					<div class="juese_head" style="height: 150px;">
						<div class="js_head_xx">
							<div class="js_img">
								<?php 
$k = array (
  'name' => 'show_avatar',
  'id' => $this->_var['user_info']['id'],
  'type' => 'small',
  'is_card' => '0',
);
echo $k['name']($k['id'],$k['type'],$k['is_card']);
?>
								<!--<img src="<?php echo $this->_var['TMPL']; ?>/images/angel.png" alt="" class="chibang"/>-->
							</div>
							<p style="margin-top: 30px;">ID: <span><?php echo $this->_var['user_info']['id']; ?></span></p>
							<p>昵称: <span><?php echo $this->_var['user_info']['user_name']; ?></span></p>
							<p>注册时间: <span class="zc_time"><?php echo $this->_var['time']; ?></span></p>
						</div>
						
					</div>
					<div class="blank20"></div>
					<div class="sanxia yeji">
						<p>伞下业绩:</p>
						<div class="title">
							<span>昵称</span>
							<span>ID</span>
							<span>上周新增业绩</span>
							<span>总业绩</span>
						</div>
						<ul>
							<!--<?php $_from = $this->_var['pidinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
							<li>
								<a href="javascript:;"></a>
								<span><?php echo $this->_var['item']['user_name']; ?></span>
								<span><?php echo $this->_var['item']['pid_id']; ?></span>
								<span class="yj"><?php echo $this->_var['item']['achievement_count_weekday']; ?></span>
								<span class="zyj"><?php echo $this->_var['item']['achievement_count']; ?></span>
								<ul class="erji none">
									<?php $_from = $this->_var['item']['infor']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item2');if (count($_from)):
    foreach ($_from AS $this->_var['item2']):
?>
									<li>
										<a href="javascript:;"></a>
										<span><?php echo $this->_var['item2']['user_name']; ?></span>
										<span><?php echo $this->_var['item2']['pid_id']; ?></span>
										<span class="yj"><?php echo $this->_var['item2']['achievement_count_weekday']; ?></span>
										<span class="zyj"><?php echo $this->_var['item2']['achievement_count']; ?></span>
										<ul class="erji none">
											<?php $_from = $this->_var['item2']['infor1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item3');if (count($_from)):
    foreach ($_from AS $this->_var['item3']):
?>
											<li>
												<a href="javascript:;"></a>
												<span><?php echo $this->_var['item3']['user_name']; ?></span>
												<span><?php echo $this->_var['item3']['pid_id']; ?></span>
												<span class="yj"><?php echo $this->_var['item3']['achievement_count_weekday']; ?></span>
												<span class="zyj"><?php echo $this->_var['item3']['achievement_count']; ?></span>
											</li>
											<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										</ul>
									</li>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</ul>
							</li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>-->
							<?php $_from = $this->_var['detail_data']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item1');if (count($_from)):
    foreach ($_from AS $this->_var['item1']):
?>
							<li id="get<?php echo $this->_var['item1']['id']; ?>">
								<a href="javascript:;"></a>
								<button type="button"></button>
								<span><?php echo $this->_var['item1']['name']; ?></span>
								<span><?php echo $this->_var['item1']['id']; ?></span>
								<span><?php echo $this->_var['item1']['last_7_consume']; ?></span>
								<span><?php echo $this->_var['item1']['total_consume']; ?></span>
							</li>
							<script>
								//获取孙子并展示
								$("#get<?php echo $this->_var['item1']['id']; ?>>button").click(function(){
									var id = <?php echo $this->_var['item1']['id']; ?>;
									$(this).prev().toggleClass("ssa");
									$(this).addClass('none');
									$.ajax({
										url:"index.php?ctl=uc_log&act=get_node_detail&id="+id,
										type:"post",
										data:"",
										async:true,
										dataType:"json",
										success:function(data){
											var obj = data.market_detail;
											console.log(obj);
											var $ul = $("<ul class='erji'></ul>");
											$ul.appendTo($("#get<?php echo $this->_var['item1']['id']; ?>"));
											for(var m = 0;m<obj.length;m++){
												var erjiId = "erji"+obj[m].id;
												$li = $("<li><a onclick='fang(event)' href='javascript:;'></a><button  type='button' onclick='getfull(event)'></button><span>"+obj[m].name+"</span><span>"+obj[m].id+"</span><span>"+obj[m].last_7_consume+"</span><span>"+obj[m].total_consume+"</span></li>");
												$li.attr("id",erjiId);
												$li.attr("title",obj[m].id);
												$li.appendTo($ul);
											}
										}
									})
								})
								//获取孙子所有后代展示
								function getfull(event){
									$obj = $(event.target);
									var id1 = $obj.parent().attr("title");
									$obj.addClass("none");
									$obj.prev().toggleClass("ssa");
									$.ajax({
										url:"index.php?ctl=uc_log&act=get_node_detail&id="+id1,
										type:"post",
										data:"",
										async:true,
										dataType:"json",
										success:function(data){
											var obj = data.market_detail;
											var $ul = $("<ul class='erji'></ul>");
											$ul.appendTo($obj.parent());
											for(var m = 0;m<obj.length;m++){
												var erjiId = "erji"+obj[m].id;
												$li = $("<li><a onclick='fang(event)' href='javascript:;'></a><button  type='button' onclick='getfull(event)'></button><span>"+obj[m].name+"</span><span>"+obj[m].id+"</span><span>"+obj[m].last_7_consume+"</span><span>"+obj[m].total_consume+"</span></li>");
												$li.attr("id",erjiId);
												$li.attr("title",obj[m].id);
												$li.appendTo($ul);
											}
										}
									})
								}
							</script>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</ul>
					</div>
				</div>
			</div>
			<script>
//					
					$(".yeji ul li a").click(function(){
						$(this).parent('li').children(".erji").toggleClass("none");
						$(this).toggleClass("ssa");
					})
					function fang(event){
						$eve = $(event.target);
						$eve.parent('li').children(".erji").toggleClass("none");
						$eve.toggleClass("ssa");
					}
				</script>
			<?php endif; ?>
			<!--申请报单中心-->
			<?php if ($this->_var['ACTION_NAME'] == 'bdzx'): ?> 
			<div class="info_box">
				<div class="myJueSe">
					<div class="goPayHead">
						<p>申请报单中心 ></p>
					</div>
					<div class="blank20"></div>
					<script>
						//判断显示内容
						$(window).ready(function(){
							var xs_status = <?php echo $this->_var['bdzx_status']; ?>;
							$(".xs_con").eq(xs_status).removeClass("none").siblings().addClass("none");
						})
					</script>
					<!--申请报单之前内容-->
					<div class="apply none xs_con">
						<!--<form action="">-->
							<p style="margin-top: 30px;">申请人信息</p>
							<p><span>姓名</span><input type="text" class="apply_name" placeholder="请输入您的姓名"/></p>
							<p><span>身份证号码</span><input type="text" class="apply_code" placeholder="请输入您的身份证号码"/></p>
							<p class="zhuyi">注:请务必填写正确的个人信息否则将影响到奖励的正确发放。</p>
							<button class="apply_btn" type="button">确定</button>
						<!--</form>-->
						
					</div>
					<script>
						$(".apply_btn").click(function(){
							var user_name = $(".apply_name").val();
							var user_id_card = $(".apply_code").val();
							if(user_name ==""){
								alert("姓名不能为空!!!");
								return false;
							}else if(user_id_card == ''){
								alert("身份证号不能为空!!!");
								return false;
							}else{
								$.ajax({
									url:'index.php?ctl=uc_log&act=do_request_bdzx',
									type:"post",
									data:{"user_name":user_name,"user_id_card":user_id_card},
									dataType:"json",
									success:function(data){
										if(data.status == false){
											alert(data.info);
											return false;
										}else{
											alert("提交成功，等待审核!!!");
											window.location.reload();
										}
										
									}
								})
							}
						})
					</script>
					<div class="erbu none xs_con">
						<div class="zt_img"><img src="<?php echo $this->_var['TMPL']; ?>/images/shz.png" alt="" /></div>
						<h2>审核中，敬请等待！！！</h2>
					</div>
					<div class="applyCon none xs_con">
						<div class="bdCon">
							<p><span>ID</span><span>新增业绩</span><span>业绩提成</span><span>状态</span></p>
							<ul>
								<?php $_from = $this->_var['bdzx_reward_detail']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'con1');if (count($_from)):
    foreach ($_from AS $this->_var['con1']):
?>
								<li>
									<span><?php echo $this->_var['con1']['m_id']; ?></span>
									<span><?php echo $this->_var['con1']['consume']; ?></span>
									<span><?php echo $this->_var['con1']['credits']; ?></span>
									<span><?php echo $this->_var['con1']['status']; ?></span>
								</li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
						<script>
			        		$(window).ready(function(){
			        			var textObj = $('.applyCon .bdCon ul li span:last-child');
			        			for(var apply_i = 0; apply_i<textObj.length;apply_i++){
			        				var text = textObj.eq(apply_i).text();
			        				if(text == "1"){
			        					textObj.eq(apply_i).text("已释放")
			        					textObj.eq(apply_i).css("color","#379f34");
			        				}else if(text == "0"){
			        					textObj.eq(apply_i).text("冻结中")
			        					textObj.eq(apply_i).css("color","#f56e07");
			        				}
			        			}
			        		})
						</script>
						 
					</div>
				</div>
			</div>
			<?php endif; ?>
			<!--兑换注册积分-->
			<?php if ($this->_var['ACTION_NAME'] == 'dhzcjf'): ?> 
			<div class="info_box">
				<div class="myJinDou">
					<div class="goPayHead">
						<p>兑换注册积分 ></p>
					</div>
					<div class="blank20"></div>
					<!--<form action="<?php
echo parse_url_tag("u:index|uc_log#do_translate_active_code|"."".""); 
?>" method="post">-->
						<div class="hzjf_con" style="width: 788px;">
							<p style="line-height: 50px;font-size: 20px;padding-left: 10px;"> 分享积分转注册积分:</p>
							<p class="hzjf_ye fx_jf" style="height: 100px;font-size: 18px;line-height: 50px;margin-top: 0;">
								分享积分余额: <span class="jf"><?php echo $this->_var['user_info']['avalible_share_credits']; ?></span> <br />
								转出数量 : <input type="text" style="width: 200px;float: none;" />
								<button type="button">确认转出</button>
							</p> <br />
							<p style="line-height: 50px;font-size: 20px;padding-left: 10px;"> 受益积分转注册积分:</p>
							<p class="hzjf_ye sy_jf" style="height: 100px;font-size: 18px;margin-top: 0;">
								受益积分余额: <span class="jf"><?php echo $this->_var['user_info']['avalible_benefit_credits']; ?></span> <br />
								转出数量 : <input type="text" style="width: 200px;float: none;"/>
								<button type="button">确认转出</button>
							</p>
						</div>
						<div class="hzjf_list">
							<p><span style="width: 25%">类型</span><span style="width: 25%">转出数量</span><span style="width: 25%">转出时间</span><span style="width: 25%">明细</span></p>
							<ul>
								<?php $_from = $this->_var['translate_detail_self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item3');if (count($_from)):
    foreach ($_from AS $this->_var['item3']):
?>
								<li>
									<span style="width: 25%"><?php echo $this->_var['item3']['type']; ?></span>
									<span style="width: 25%"><?php echo $this->_var['item3']['num']; ?></span>
									<span style="width: 25%"><?php echo $this->_var['item3']['time']; ?></span>
									<span style="width: 25%"><?php echo $this->_var['item3']['msg']; ?></span>
								</li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
					<!--</form>-->
				</div>
			</div>
			<script>
				//分享积分转注册积分
				$('.fx_jf button').click(function(){
					var fx_a = parseFloat($(".fx_jf jf").text());
					var fx_b = $(".fx_jf input").val();
					if(fx_b ==""){
						$(".fx_jf input").css("border","1px solid red");
						$(".fx_jf input").attr("placeholder","请在此输入兑换数量!!!");
						return false;
					}else if(fx_a < fx_b){
						alert("兑换数量大于分享余额!!!");
						return false;
					}else{
						$.ajax({
							url:"index.php?ctl=uc_log&act=to_register_credits&type=share",
							type:"post",
							data:{"num":fx_b},
							dataType:"json",
							success:function(data){
								if(data.status == 0){
									alert(data.info);
									return false;
								}else{
									alert(data.info);
									window.location.reload();
								}
							}
						})
					}
				});
				//受益积分转注册积分
				$('.sy_jf button').click(function(){
					var sy_a = parseFloat($(".sy_jf jf").text());
					var sy_b = $(".sy_jf input").val();
					if(sy_b ==""){
						$(".sy_jf input").css("border","1px solid red");
						$(".sy_jf input").attr("placeholder","请在此输入兑换数量!!!");
						return false;
					}else if(sy_a < sy_b){
						alert("兑换数量大于分享余额!!!");
						return false;
					}else{
						$.ajax({
							url:"index.php?ctl=uc_log&act=to_register_credits&type=benefit",
							type:"post",
							data:{"num":sy_b},
							dataType:"json",
							success:function(data){
								if(data.status == 0){
									alert(data.info);
									return false;
								}else{
									alert(data.info);
									window.location.reload();
								}
							}
						})
					}
				})
				$(window).ready(function(){
					var list1 = $(".hzjf_list ul li span:nth-child(3)");
					var type = $(".hzjf_list ul li span:nth-child(1)");
					for(var z1 = 0;z1<list1.length;z1++){
						var sjs1 = list1.eq(z1).text();
						var types = type.eq(z1).text();
						var Times = new Date(sjs1*1000);
						var Year = Times.getFullYear();
						var Month = Times.getMonth()+1;
						var Day = Times.getDate();
						var Hour = Times.getHours();
						var Min = Times.getMinutes();
						var Sen = Times.getSeconds();
						Times = Year +'-'+ getzf(Month) +'-'+ getzf(Day) +' '+ getzf(Hour) +':'+ getzf(Min) +':'+getzf(Sen);
						list1.eq(z1).html(Times);
						if(types == "self_t_share"){
							type.eq(z1).text("分享积分");
						}else if(types == "self_t_benefit"){
							type.eq(z1).text("受益积分");
						}
	//			        //补0操作
				      function getzf(num){  
				          if(parseInt(num) < 10){  
				              num = '0'+num;  
				          }  
				          return num;  
						 }
					}
				})
			</script>
			<?php endif; ?>
		</div>
	</div>	
	<script>
		$(window).ready(function(){
			if(<?php echo $this->_var['user_info']['user_level']; ?> != 0){
				$(".jinru").removeClass("none");
			}
		})
	</script>
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>