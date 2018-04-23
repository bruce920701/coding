<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var AJAX_URL='<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
var CART_URL='<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>';
var order_id = '<?php echo $this->_var['data']['order_id']; ?>';  //订单号
</script>
<div class="page page-index" id="cart_check">
<div class="m-select-box invoice-type-box">
	<ul class="select-box">
		<li class="flex-box b-line j-close-select j-select-type" value="0">
			<p class="flex-1 invoice-type tc">暂不开票</p>
		</li>
		<li class="flex-box b-line j-close-select j-select-type" value="1">
			<p class="flex-1 invoice-type tc">个人</p>
		</li>
		<li class="flex-box b-line j-close-select j-select-type" value="2">
			<p class="flex-1 invoice-type tc">企业</p>
		</li>
	</ul>
</div>
<?php $_from = $this->_var['data']['invoice_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('shop_id', 'invoice');if (count($_from)):
    foreach ($_from AS $this->_var['shop_id'] => $this->_var['invoice']):
?>
<div class="m-select-box invoice-info-box" shop-id="<?php echo $this->_var['shop_id']; ?>" link-shop-id="<?php echo $this->_var['shop_id']; ?>">
	<ul class="select-box">
		<?php $_from = $this->_var['invoice']['invoice_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'content');if (count($_from)):
    foreach ($_from AS $this->_var['content']):
?>
		<li class="flex-box b-line j-close-select j-select-info" value="<?php echo $this->_var['content']; ?>">
			<p class="flex-1 invoice-info tc"><?php echo $this->_var['content']; ?></p>
		</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<!-- <li class="flex-box b-line j-close-select j-select-info" value="1">
			<p class="flex-1 invoice-info tc">？？</p>
		</li>
		<li class="flex-box b-line j-close-select j-select-info" value="2">
			<p class="flex-1 invoice-info tc">！！</p>
		</li> -->
	</ul>
</div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<div class="m-mask j-close-select"></div>

<form  action="<?php
echo parse_url_tag("u:index|cart#done|"."address_id=".$this->_var['data']['consignee_info']['id']."&id=".$this->_var['id']."".""); 
?>" id="pay_box">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<nav class="bar bar-tab ">
		<div class="m-check-paybox t-line">
			<!--j-presell预售定金时弹框提示-->
			<!-- <a href="javascript:void(0);" class="j-presell z-state"><?php if ($this->_var['buy_type'] == 1): ?>兑换<?php else: ?>去支付<?php endif; ?></a> -->
			<a href="javascript:void(0);" class="go_pay z-state none zhifu"><?php if ($this->_var['buy_type'] == 1): ?>兑换<?php else: ?>去支付<?php endif; ?></a>
			<a href="javascript:void(0);" class="z-state zhifu1">去支付</a>
			<p class="u-lg-price">还需支付：<span class="u-money"><i class="total_price_box">0</i> <small>积分</small></span></p>
			
		</div>
	</nav>


	<div class="content" style="bottom: 2.5rem">

		<!--收件人信息-->
		<?php if ($this->_var['data']['is_delivery']): ?>
		<div class="m-order-common check_head media-list" id="delivery-address">
		
		<?php if ($this->_var['data']['location']): ?>
				<div class="con_left" style="padding-top:.7rem;line-height:.75rem;margin-left:.5rem;">自提</div>
				<div class="con_right flex-1">
					<a href="javascript:void(0);" url="<?php
echo parse_url_tag("u:index|uc_address|"."check=check&id=".$this->_var['id']."&supplier_id=".$this->_var['supplier_id']."&is_pick=".$this->_var['is_pick']."&buy_type=".$this->_var['buy_type']."&address_id=".$this->_var['address_id']."".""); 
?>" class="item-link item-content load_page" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/order_address.js'>
						<div class="item-inner">
							<div class="item-subtitle user-name"><?php echo $this->_var['data']['location']['name']; ?></div>
							<div class="item-text user-address"><?php echo $this->_var['data']['location']['address']; ?> <?php if ($this->_var['data']['location']['tel']): ?>( 电话：<?php echo $this->_var['data']['location']['tel']; ?> )<?php endif; ?></div>
						</div>
					</a>
				</div>
				<input type="hidden" value="<?php echo $this->_var['data']['location']['id']; ?>" name="location_id" />
		<?php else: ?>
				<div class="con_left" style="padding-top:.7rem;line-height:.75rem;margin-left:.5rem;">送至</div>
				<div class="con_right flex-1">
					<?php if ($this->_var['data']['consignee_info']): ?>
						<a href="javascript:void(0);" url="<?php
echo parse_url_tag("u:index|uc_address|"."check=check&id=".$this->_var['id']."&supplier_id=".$this->_var['supplier_id']."&is_pick=".$this->_var['is_pick']."&buy_type=".$this->_var['buy_type']."&address_id=".$this->_var['address_id']."".""); 
?>" class="item-link item-content load_page" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/order_address.js'>
							<div class="item-inner">
								<div class="item-subtitle user-name">收货人:<?php echo $this->_var['data']['consignee_info']['consignee']; ?><span class="u-phoneNum"><?php echo $this->_var['data']['consignee_info']['mobile']; ?></span></div>
								<div class="item-text user-address"><?php echo $this->_var['data']['consignee_info']['full_address']; ?></div>
							</div>
							<?php if ($this->_var['data']['is_pick'] == 1): ?>
							<p style="color:#f24;margin-left:.5rem;">本次订单支持自提，请点击选择自提门店</p>
							<?php endif; ?>
						</a>
					<?php else: ?>
						<?php if ($this->_var['data']['consignee_count'] || $this->_var['data']['is_pick']): ?>
						<a href="javascript:void(0);" url="<?php
echo parse_url_tag("u:index|uc_address|"."check=check&id=".$this->_var['id']."&supplier_id=".$this->_var['supplier_id']."&is_pick=".$this->_var['is_pick']."&buy_type=".$this->_var['buy_type']."&address_id=".$this->_var['address_id']."".""); 
?>" class="item-link item-content load_page" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/order_address.js'>
						<?php else: ?>
						<a href="javascript:void(0);" class="item-link item-content load_page" js_url='<?php echo $this->_var['tmpl_path']; ?>js/load/address_add.js' url="<?php
echo parse_url_tag("u:index|uc_address#add|"."".""); 
?>">
						<?php endif; ?>
							<div class="item-inner">
								<div class="item-subtitle user-name">请填写收货地址</div>
							</div>
							<?php if ($this->_var['data']['is_pick'] == 1): ?>
							<p style="color:#f24;margin-left:.5rem;">本次订单支持自提，请点击选择自提门店</p>
							<?php endif; ?>
						</a>
					<?php endif; ?>

					<input type="hidden" value="<?php echo $this->_var['data']['consignee_info']['id']; ?>" name="address_id" />
				</div>
		
		<?php endif; ?>
		</div>
		<?php endif; ?>
		<!--收件人信息-->

		<!-- 页面主体 -->
		<div class="list-block m-cart">
			<!--购物车列表开始-->
		<?php if ($this->_var['data']['cart_list']): ?>
		<?php $_from = $this->_var['data']['cart_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_list');if (count($_from)):
    foreach ($_from AS $this->_var['cart_list']):
?>
			<div class="m-conBox m-check-order m-modify">
				<!--列表头部开始-->
				<div class="m-title  item-content b-line">
					<div class="item-inner">
						<div class="item-title-row">
							<div class="item-title" style="padding-left: 0.5rem"><?php echo $this->_var['cart_list']['supplier_name']; ?></div>
						</div>
					</div>
				</div>
				<!--列表头部结束-->

				<ul class="m-cart-list j-select-body">
				<?php $_from = $this->_var['cart_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart');if (count($_from)):
    foreach ($_from AS $this->_var['cart']):
?>
					<li class="item-content b-line">
						<div class="item-inner">
							<div class="item-media shopImg">
								<img src="<?php echo $this->_var['cart']['f_icon']; ?>">
								<?php if ($this->_var['cart']['allow_promote']): ?><span class="u-cut"></span><?php endif; ?>
								<?php if ($this->_var['cart']['stock'] > - 1): ?><p class="u-surplus">仅剩<?php echo $this->_var['cart']['stock']; ?>件</p><?php endif; ?>
							</div>
							<div class="z-opera z-opera-sure">
								<div class="item-subtitle shopTi">
									<a data-no-cache="true" href="<?php echo $this->_var['cart']['url']; ?>"><?php echo $this->_var['cart']['name']; ?></a>
									<?php if ($this->_var['cart']['attr_str']): ?><p class="sizes">规格: <?php echo $this->_var['cart']['attr_str']; ?></p><?php endif; ?>
								</div>
								<div class="shop_price tr">
									<p class="u-sm-price"><span class="u-money">
									<?php if ($this->_var['buy_type'] == 1): ?>
										<?php echo $this->_var['cart']['return_score_format']; ?>
									<?php else: ?>
										<?php echo $this->_var['cart']['unit_price_format']; ?>
									<?php endif; ?>
									</span></p>
									<p class="shop-count">x<i><?php echo $this->_var['cart']['number']; ?></i></p>
								</div>
							</div>
							
						</div>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
			</div>
			
			<!--配送方式-->
			<div class="m-conBox m-logist">
			<?php if (! $this->_var['data']['location'] && $this->_var['data']['is_delivery'] == 1 && $this->_var['data']['consignee_info']): ?>
				<a href="javascript:void(0);" class="item-content b-line">
					<div class="item-media"><i class="icon icon-f7"></i></div>
					<div class="item-inner u-common-inline ">
						<div class="item-title">配送运费</div>
							<div class="item-after j-reward-money"><span class="j-company-name"></span><span class="expore j-company-money"><?php echo $this->_var['cart_list']['delivery_fee']; ?></span></div>
					</div>
				</a>
			<?php endif; ?>
			<?php if ($this->_var['cart_list']['youhui_value'] && $this->_var['buy_type'] == 0): ?>
				<a href="javascript:void(0);" class="item-content b-line">
					<div class="item-media "><i class="icon icon-f7"></i></div>
					<div class="item-inner u-common-inline j-trans"  data-id="<?php echo $this->_var['cart_list']['id']; ?>" data-price="<?php echo $this->_var['cart_list']['total_price']; ?>">
						<div class="item-title">店铺优惠</div>
							<div class="item-after j-trans-commpany"><span class="j-company-name"></span><span class="expore j-company-money" style="color: red;">-￥<?php echo $this->_var['cart_list']['youhui_value']; ?></span><span class="iconfont">&#xe607;</span></div>
					</div>
				</a>
			<?php endif; ?>
			<?php if ($this->_var['data']['is_score'] != 1): ?>
			<div class="m-invoice-box" shop-id="<?php echo $this->_var['cart_list']['id']; ?>">
				<?php if ($this->_var['cart_list']['invoice_conf'] && ( $this->_var['cart_list']['invoice_conf']['invoice_type'] == 1 )): ?>
				<div class="invoice-item flex-box b-line j-open-type invoice-type">
					<p class="invoice-tit flex-1">发票类型</p>
					<p class="invoice-tip">暂不开票</p>
					<div class="iconfont">&#xe607;</div>
					<input name="invoice_type[<?php echo $this->_var['cart_list']['id']; ?>]" type="hidden" value="0">
				</div>
				<div class="invoice-detail hide">
					<div class="invoice-item flex-box b-line j-open-info invoice-info">
						<p class="invoice-tit flex-1">发票内容</p>
						<p class="invoice-tip"><?php echo $this->_var['cart_list']['invoice_conf']['invoice_content']['0']; ?></p>
						<div class="iconfont">&#xe607;</div>
						<input name="invoice_content[<?php echo $this->_var['cart_list']['id']; ?>]" type="hidden" value="<?php echo $this->_var['cart_list']['invoice_conf']['invoice_content']['0']; ?>">
					</div>
					<div class="invoice-item flex-box b-line">
						<p class="invoice-tit">发票抬头</p>
						<input name="invoice_title[<?php echo $this->_var['cart_list']['id']; ?>]" type="text" class="invoice-input flex-1 invoice-title" placeholder="请填写发票抬头" value="<?php echo $this->_var['data']['consignee_info']['consignee']; ?>">
					</div>
					<div class="invoice-item flex-box b-line inv-tax-box">
						<p class="invoice-tit">纳税人识别码</p>
						<input name="invoice_taxnu[<?php echo $this->_var['cart_list']['id']; ?>]" type="text" class="invoice-input flex-1 invoice-taxnu" placeholder="免税单位请填0">
					</div>
				</div>
				<?php else: ?>
				<div class="invoice-item flex-box b-line invoice-type">
					<p class="invoice-tit flex-1">发票类型</p>
					<p class="invoice-tip">暂不支持开票</p>
					<div class="iconfont">&#xe607;</div>
					<input name="invoice_info[<?php echo $this->_var['cart_list']['id']; ?>]" type="hidden" value="0">
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="remarkBox">
				<p class="remarkTitle">订单备注<span class="iconfont">&#xe607;</span></p>
				<div class="remarkArea">
					<textarea name="content[<?php echo $this->_var['cart_list']['id']; ?>]" placeholder="填写订单备注(100字以内)" maxlength="100"></textarea>
				</div>
			</div>
			<div class="remarkBox">
				<p class="remarkTitle">购买之前请阅读<a href="javascript:;" class="xieyi">《<u>中隆时尚网上商城消费协议书</u>》</a></p>
			</div>
			</div>	
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php endif; ?>
			<!--购物车列表结束-->



			<!--红包-->
			<?php if ($this->_var['data']['has_ecv'] == 1 && $this->_var['data']['voucher_count']): ?>
			<div class="m-conBox voucher_box">
				<a href="javascript:void(0);" class="item-content item-link">
					<div class="item-media"><i class="icon icon-f7"></i></div>
					<div class="item-inner u-common-inline j-reward">
						<div class="item-title">红包</div>
						<div class="item-after j-reward-money" value="0" money="0"><?php echo $this->_var['data']['voucher_count']; ?>个可用</div>
					</div>
				</a>
			</div>
			
			<div class="item-tip">
			注意：选择红包并下单后，红包不退还
			</div>
			<?php endif; ?>
			<!--红包-->

			<!--订单费用详情-->

			<div id="cart_total"></div>
			<script>
				$(window).ready(function(){
					if($(".check").attr("checked") == false){
						$(".zhifu").addClass("none");
						$(".zhifu1").removeClass("none");
					}else if($(".check").attr("checked") == true){
						$(".zhifu").removeClass("none");
						$(".zhifu1").addClass("none");
					}
				})
				$(document).on("click",".zhifu1",function(){
					if($(".check").attr("checked") == false){
						alert("请同意中隆时尚网上商城消费协议书");
						return false;
					}
				})
			</script>
			<div class="xy_con none">
				<h3 style="font-weight: normal;text-align: center;font-size: 1rem;line-height: 3rem;color: #000;">《中隆时尚网上商城消费协议书》</h3>
				<p>尊敬的消费者：</p>
				<p>为促进时尚商城在同行业的竞争优势，本着“时尚消费、互惠互利”的消费原则，经双方协议建立《中隆时尚网上商城消费协议书》达成意向如下：</p>
				<p>第一：甲方的权利及义务</p>
				<p>1、甲方需要保证产品质量，保证是正品产品。</p>
				<p>2、从收货之日起，7天内保证换货。产品三保：保质量、保换货、保积分兑换。</p>
				<p>3、产品的售后服务问题需要甲方全权负责。</p>
				<p>4、消费者在网上商城购买累计到公司规定的促销活动折扣时，商城将给与消费者积分，消费者可以通过积分在商城兑换积分产品。</p>
				<p>5、甲方确保派送的积分，从派送之日起规定的2年时间内，可兑换、可消费、可转让。本商场购买商品时公司派送的积分不涉及任何融资、投资、兑现等违法行为，如有误导宣传，公司将追究其法律责任。</p>
				<p>第二：乙方的权利及义务</p>
				<p>1、甲方在活动期间，有权利和乙方进行线下和线上进行宣传。</p>
				<p>2、乙方举行大型活动，甲方有权提出参与。</p>
				<p>3、乙方能够充分理解有关于此消费的一切权益，并且具有购买和消费经济能力的，年满18周岁，符合国家法律法规的具有完全民事能力的公民，不存在法律法规、规章和公司消费规则禁止或限制的消费情形。</p>
				<p>4、乙方保证向甲方提供的所有证件、资料真实、有效、合法，资金来源合法，不洗黑钱。如有个人行为恶意传播，恶意宣导导致损失者，本公司将追究其法律责任。由于乙方提供的上述资料有虚假或者其他问题所引起的法律后果和法律责任，由乙方承担。</p>
				<p>5、乙方重要资料变更时，应及时书面文件形式通知甲方，并根据甲方要求签署相关文件。乙方消费账户密码丢失，要填写密码重置申请表，需提供本人有效身份证件、客户协议书以及其他相关信息，并予以确认签字，经公司将这些信息核对无误后，方可重置交易密码，公司将通过电子邮件形式或手机信息将新密码发送至乙方邮箱或手机短信。</p>
				<p>6、乙方已经阅读并充分理解甲方向其提供的消费协议，同意遵守商城网上消费的规则及有关条款，并准确理解其含义后必须由乙方本人确认同意提交后才有效。</p>
				<p>第三：消费积分</p>
				<p>1、时尚商城分成两个消费区，普通区与精品区，在普通区消费累积达到3500元以下没有派送积分，享受等价值产品免费送货。达到3500元以上可以进入精品区消费，并可以获得工商规定的促销活动折扣，以积分的方式从消费之日起计算，公司拿出商城每日盈利的25%，每7天派送一次相对应的积分给消费者。</p>
				<p>2、派送的积分的用处：可兑换、可消费、可转让。 积分可以在公司的指定区域兑换产品，积分可以用于商城消费。可以在普通商城享受公司不同折扣的产品用积分兑换。积分可以转让，会员与会员之间拥有个人行为的转让积分消费权益。</p>
				<p>3、积分的优势与前景时尚积分取之于民，用之于民，在商城获得的积分用于打造时尚品牌，成为全球唯一的和谐文明时尚商城。</p>
				<p>五、积分操作注意事项</p>
				<p>1、乙方交易只限本人操作，不得转交他人操作，如乙方将积分账户转交他人操作，所引起的一切纠纷和损失均由乙方自行承担。乙方应妥善保存好本人的积分账号和相关的密码。</p>
				<p>2、所有乙方通过网上购买发出指令成交后一经发出成交后均不得撤销和撤回，所有乙方通过网上商城交易系统发出指令后，以网上订购数据为准，如乙方对当日的积分消费有异议，须在24小时之内以书面的方式向甲方质询。乙方逾期未以书面方式向甲方办理质询的，视同乙方已确认该结果。</p>
				<p style="width: 100%;text-align: right;margin-top: 2rem;margin-bottom: 30px;">中隆网络科技有限公司</p>
				<a href="javascript:;" class="back">返回</a>
				<a href="javascript:;" class="tongyi"><input type="checkbox" class="check" />同意</a>
			</div>
			<script>
				$(document).on("click",".xy_con .back",function(){
					$(this).parent().addClass("none");
				})
				$(document).on("click",".xy_con .tongyi",function(){
					$(this).parent().addClass("none");
					$(this).children().attr("checked","checked");
					$(".zhifu1").addClass("none");
					$(".zhifu").removeClass("none");
				})
				$(document).on("click",".xieyi",function(){
					$(".xy_con").removeClass("none");
				})
			</script>
			<!--订单费用详情-->
		</div>
	</div>


	<div class="popup-box">
		<div class="pup-box-bg j-box-bg"></div>	
		
		<div class="list-block m-trans-way j-trans-way">
			<div class="item-content u-common-box t-line-white trans-way-bg">
				<p class="u-ti tc">优惠券</p>
			</div>
			<?php $_from = $this->_var['data']['cart_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cart_list');if (count($_from)):
    foreach ($_from AS $this->_var['cart_list']):
?>
			<ul class="j-trans-list m-tv-list" data-id="<?php echo $this->_var['cart_list']['id']; ?>">
				<?php $_from = $this->_var['cart_list']['youhui_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
			  	<li class="t-line-white">
					<label class="label-checkbox item-content trans-way-bg">
						<div class="item-inner">
							<div class="item-title pay-way-name"><span class="j-company-name"><?php echo $this->_var['item']['youhui_value']; ?>积分（<?php if ($this->_var['item']['start_use_price']): ?>满<?php echo $this->_var['item']['start_use_price']; ?>积分可用<?php else: ?>无使用限制<?php endif; ?>）</span></div>
							<div class="item-after">
								<input type="radio" name="youhui_log_id[<?php echo $this->_var['cart_list']['id']; ?>]" money="<?php echo $this->_var['item']['youhui_value']; ?>" value="<?php echo $this->_var['item']['id']; ?>" <?php if ($this->_var['item']['is_checked'] == 1): ?>checked="checked"<?php endif; ?> <?php if ($this->_var['cart_list']['p_youhui_id'] == $this->_var['item']['id']): ?> disabled="disabled"<?php endif; ?>>
								<div class="item-media">
									<i class="icon icon-form-checkbox <?php if ($this->_var['cart_list']['p_youhui_id'] == $this->_var['item']['id']): ?>disabled-checked<?php endif; ?>" ></i>
								</div>
							</div>
						</div>
					</label>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<li>
					<label class="label-checkbox item-content trans-way-bg">
						<div class="item-inner">
							<div class="item-title pay-way-name">不使用优惠券</div>
							<div class="item-after">
								<input type="radio" name="youhui_log_id[<?php echo $this->_var['cart_list']['id']; ?>]" value="0">
								<div class="item-media">
									<i class="icon icon-form-checkbox"></i>
								</div>
							</div>
						</div>
					</label>
				</li>
			</ul>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<div class="item-content u-common-box">
				<p class="u-ti tc j-cancel">取消</p>
			</div>
		</div>
			
		<?php if ($this->_var['data']['has_ecv'] == 1 && $this->_var['data']['voucher_list']): ?>
		<div class="list-block m-trans-way j-red-reward voucher_box">
			<div class="item-content u-common-box t-line-white trans-way-bg">
				<p class="u-ti tc">红包</p>
			</div>
			
			<ul class="j-reward-list m-tv-list">
				<?php $_from = $this->_var['data']['voucher_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'voucher');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['voucher']):
?>
					<li class="t-line-white">
						<label class="label-checkbox item-content trans-way-bg">
							<div class="item-inner">
								<div class="item-title pay-way-name"><?php echo $this->_var['voucher']['money']; ?>积分（<?php if ($this->_var['voucher']['start_use_price']): ?>满<?php echo $this->_var['voucher']['start_use_price']; ?>积分可用<?php else: ?>无使用限制<?php endif; ?>）</div>
								<div class="item-after">
									<input type="radio" name="ecvsn" value="<?php echo $this->_var['voucher']['sn']; ?>" money="<?php echo $this->_var['voucher']['money']; ?>">
									<div class="item-media">
										<i class="icon icon-form-checkbox"></i>
									</div>
								</div>
							</div>
						</label>
					</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<li>
					<label class="label-checkbox item-content trans-way-bg">
						<div class="item-inner">
							<div class="item-title pay-way-name">不使用红包</div>
							<div class="item-after">
								<input type="radio" name="ecvsn" value="0" money="0" checked="checked">
								<div class="item-media">
									<i class="icon icon-form-checkbox"></i>
								</div>
							</div>
						</div>
					</label>
				</li>
			</ul>
			<div class="item-content u-common-box">
				<p class="u-ti tc j-cancel">取消</p>
			</div>
		</div>
		<?php endif; ?>
		<input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
		<input type="hidden" name="buy_type" value="<?php echo $this->_var['buy_type']; ?>" />
	</div>
</form>
<?php if ($this->_var['data']['invoice_notice']): ?>
<div class="popup invoice-popup">
	<header class="bar bar-nav b-line">
		<a class="header-btn header-left iconfont close-popup">&#xe604;</a>
		<h1 class="header-title">发票需知</h1>
	</header>
	<div>
		<div class="invoice-detail">
			<?php echo $this->_var['data']['invoice_notice']; ?>
		</div>
	</div>
	<script>
		$(document).on("click",".xieyi",function(){
			
		})
	</script>
</div>
<?php endif; ?>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>