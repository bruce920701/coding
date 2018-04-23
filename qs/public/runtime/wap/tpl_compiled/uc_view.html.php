<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>

<div class="page page-index" id="order_view">
<form  action="<?php
echo parse_url_tag("u:index|cart#done|"."address_id=".$this->_var['data']['consignee_info']['id']."".""); 
?>" id="pay_box">
<script>
    var AJAX_URL='<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
    var order_id = '<?php echo $this->_var['data']['order_id']; ?>';  //订单号
    var ajax_url='<?php
echo parse_url_tag("u:index|uc_order#refund|"."".""); 
?>';
</script>
    <?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
    <?php if ($this->_var['data']['contact']): ?>
	    <div class="m-mask j-close-box"></div>    
	    <div class="m-service-box flex-box">
	    <?php $_from = $this->_var['data']['contact']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'contact');if (count($_from)):
    foreach ($_from AS $this->_var['contact']):
?>
	        <a href="<?php if ($this->_var['contact']['type'] == 1): ?>tel:400-800-8888<?php endif; ?>" class="serviceItem flex-1 <?php if ($this->_var['contact']['type'] == 0): ?> xnOpenSdk <?php endif; ?>">
	        	<?php if ($this->_var['contact']['type'] == 0): ?>
	        	<script>
	        		var settingid = '<?php echo $this->_var['contact']['param']; ?>';
	        	</script>
	         	   <div class="iconfont">&#xe8a1;</div>
	            <?php else: ?>
	           	   <div class="iconfont">&#xe6ed;</div>
	            <?php endif; ?>
	            <p class="serviceTip"><?php echo $this->_var['contact']['name']; ?></p>
	        </a>
	    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
	    </div>
    <?php endif; ?>
    <nav class="bar bar-tab">
    <?php if ($this->_var['item']['is_delete'] == 0): ?>
        <?php $this->_var['data']['operation_count'] = count($this->_var['data']['item']['operation']);?>
        <div class="m-check-paybox t-line none ">
        	<?php $_from = $this->_var['data']['item']['operation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'operation');if (count($_from)):
    foreach ($_from AS $this->_var['operation']):
?>
                
                <?php if ($this->_var['operation']['type'] == 'j-payment'): ?>
	                <?php if ($this->_var['data']['item']['allow_pay'] == 1): ?>
		        	<a href="<?php echo $this->_var['operation']['url']; ?>" class="pay_btn conBtn" data-no-cache="true"><?php echo $this->_var['operation']['name']; ?></a>
		        	<?php else: ?>
		        	<a href="javascript:void(0);" class="no_pay_btn conBtn" error_tip="<?php echo $this->_var['data']['item']['error_tip']; ?>" data-no-cache="true"><?php echo $this->_var['operation']['name']; ?></a>
		        	<?php endif; ?>
	        	<?php elseif ($this->_var['operation']['type'] == 'j-refund'): ?>
	        	<a href="javascript:void(0)" js_url="<?php echo $this->_var['tmpl_path']; ?>js/load/order_refund.js" url="<?php echo $this->_var['operation']['url']; ?>" class="nonborder load_page  <?php if ($this->_var['data']['operation_count'] == 1): ?>only_one<?php endif; ?>"><?php echo $this->_var['operation']['name']; ?></a>
                <?php elseif ($this->_var['operation']['type'] == 'center-none'): ?>
                <a href="javascript:void(0)" class="center-none"><?php echo $this->_var['operation']['name']; ?></a>
	        	<?php elseif ($this->_var['operation']['type'] == 'j-cancel' || $this->_var['operation']['type'] == 'j-del'): ?>
	        	<input class="cancel_order conBtn" href="javascript:void(0);" button-type="<?php echo $this->_var['operation']['type']; ?>"  message="确定<?php echo $this->_var['operation']['name']; ?>?"ajaxUrl="<?php echo $this->_var['operation']['url']; ?>" type="button" value="<?php echo $this->_var['operation']['name']; ?>">
	        	<?php else: ?>
                 <input class="conBtn" style=" border: 1px solid #e3e5e9;color: #999;" onclick="$.router.load('<?php echo $this->_var['operation']['url']; ?>',true);" type="button" value="<?php echo $this->_var['operation']['name']; ?>">
                <?php endif; ?>
                
        	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
    <?php endif; ?>
    </nav>
    

    <div class="content" style="bottom: 2.5rem">
      
         <div class="presell-status">
            <img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/presell/presell-status-<?php echo $this->_var['data']['item']['order_status_arr']['order_status_id']; ?>.jpg" alt="" class="presell-bg">
            <?php if ($this->_var['data']['item']['order_status_arr']['order_status_id'] == 7 || $this->_var['data']['item']['order_status_arr']['order_status_id'] == 8 || $this->_var['data']['item']['order_status_arr']['order_status_id'] == 1): ?>
            <p class="status j-data-time" data-time="<?php echo $this->_var['data']['item']['order_status_arr']['count_time']; ?>" is_load="<?php if ($this->_var['data']['item']['order_status_arr']['count_time'] > 0): ?>1<?php else: ?>0<?php endif; ?>">         

				<?php if ($this->_var['data']['item']['order_status_arr']['count_type'] == 3): ?>
					<?php echo $this->_var['data']['item']['order_status_arr']['order_title']; ?>
				<?php else: ?>
				
					<?php echo $this->_var['data']['item']['order_status_arr']['order_title']; ?><span class="j-time"></span>
				<?php endif; ?>
	        </p>    
            <?php else: ?>
            <p class="status"><?php echo $this->_var['data']['item']['order_status_arr']['order_title']; ?></p>
            <?php endif; ?>
            <div class="status-wrap flex-box">
                <div class="status-info">
                    <p class="status-tit"><?php echo $this->_var['data']['item']['order_status_arr']['order_status']; ?></p>
                    <!--<p class="status-tip"><?php echo $this->_var['data']['item']['order_status_arr']['order_tip']; ?></p>-->
                </div>
            </div>
        </div>
         <?php if ($this->_var['data']['item']['type'] == 8): ?>
        <div class="presell-order-progress flex-box">
            <div class="order-status <?php if ($this->_var['data']['item']['pay_status'] > 0): ?> active <?php endif; ?>">
                <div class="status-circle"></div>
                <p>付订金</p>
            </div>
            <div class="progress-line <?php if ($this->_var['data']['item']['pay_status'] > 0): ?> active <?php endif; ?>"></div>
            <div class="order-status <?php if ($this->_var['data']['item']['pay_status'] == 2): ?> active <?php endif; ?>">
                <div class="status-circle"></div>
                <p>付尾款</p>
            </div>
            <div class="progress-line <?php if ($this->_var['data']['item']['pay_status'] == 2): ?> active <?php endif; ?>"></div>
            <div class="order-status <?php if ($this->_var['data']['item']['delivery_status'] == 2): ?> active <?php endif; ?>">
                <div class="status-circle"></div>
                <p>发货</p>
            </div>
        </div>
        <?php endif; ?>
        
        
		<?php if ($this->_var['data']['item']['existence_expire_refund'] == 1): ?>
		<div class="blank5"></div>
		<div class="order_total" style=" background-color:yellow;">
            <div class="order_dt b-line" >
                <p class="u-lg-price" style="text-align:center;">支持过期退，<a href="#" style="text-decoration:underline;" js_url="<?php echo $this->_var['tmpl_path']; ?>js/load/order_refund.js" url="<?php
echo parse_url_tag("u:index|uc_order#order_refund|"."data_id=".$this->_var['data']['item']['id']."".""); 
?>" class=" load_page  <?php if ($this->_var['data']['operation_count'] == 1): ?>only_one<?php endif; ?>">立即退款</a></span></p>
            </div>
        </div>
		<?php endif; ?>
        <div class="blank5"></div>
        <?php if ($this->_var['data']['item']['delivery_status'] != 5): ?>
        <?php if ($this->_var['data']['item']['consignee']): ?>
        <!--收件人信息-->
        <div class="list-block m-order-common  media-list" id="delivery-address">
            <a href="#" class="item-content">
                <div class="item-inner">
                    <div class="item-subtitle user-name">收货人: <?php echo $this->_var['data']['item']['consignee']; ?><span class="u-phoneNum"><?php echo $this->_var['data']['item']['mobile']; ?></span></div>
                    <div class="item-text user-address"><?php echo $this->_var['data']['item']['address']; ?></div>
                </div>
            </a>
            <input type="hidden" value="<?php echo $this->_var['data']['item']['consignee_id']; ?>" name="address_id" />
        </div>
        <div class="blank5"></div>
        <!--收件人信息-->
        <?php endif; ?>
		<?php endif; ?>
		<?php if ($this->_var['data']['item']['location_id'] > 0): ?>
        <!--收件人信息-->
		<a href="<?php echo $this->_var['data']['item']['location_address_url']; ?>" class="pick-shop">
			<p>自提门店：</p>
			<div class="flex-1 shop-info">
				<p><?php echo $this->_var['data']['item']['location_name']; ?></p>
				<p><?php echo $this->_var['data']['item']['tel']; ?></p>
				<p><?php echo $this->_var['data']['item']['location_address']; ?></p>
			</div>
			<i class="iconfont">&#xe607;</i>
		</a>
        <div class="blank5"></div>
        <!--收件人信息-->
        <?php endif; ?>
        <!-- 页面主体 -->
        <div class="list-block m-cart">
        	<?php $_from = $this->_var['data']['item']['deal_order_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal_order_item');$this->_foreach['deal_order_item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['deal_order_item']['total'] > 0):
    foreach ($_from AS $this->_var['deal_order_item']):
        $this->_foreach['deal_order_item']['iteration']++;
?>
            <!--购物车列表开始-->
            <div class="m-conBox m-check-order m-modify">
                <!--列表头部开始-->
                <div class="m-title  item-content b-line">
                    <div class="item-inner">
                        <div class="item-title-row flex-1">
                            <a href="#" class="item-title"><i class="iconfont u-shop-icon u-icon">&#xe616;</i><?php echo $this->_var['deal_order_item']['supplier_name']; ?></a>
                        </div>
                        <?php if ($this->_var['data']['contact']): ?>
	                        <p class="shop-contact j-open-service">联系客服</p>
	                        <div class="iconfont">&#xe607;</div>
                        <?php endif; ?>
                    </div>
                </div>
                <!--列表头部结束-->

                <ul class="m-cart-list j-select-body">
                	<?php $_from = $this->_var['deal_order_item']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');$this->_foreach['good'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['good']['total'] > 0):
    foreach ($_from AS $this->_var['good']):
        $this->_foreach['good']['iteration']++;
?>
                    <li class="item-content b-line">
                        <div class="item-inner">
                            <div class="item-media shopImg">
                                <img src="<?php echo $this->_var['good']['deal_icon']; ?>" alt="">
                                <!--<?php if ($this->_var['cart']['stock']): ?><p class="u-surplus">仅剩<?php echo $this->_var['cart']['stock']; ?>件</p><?php endif; ?>-->
                            </div>
                            <div class="z-opera z-opera-sure">
                                <div class="item-subtitle shopTi">
                                    <a href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['good']['deal_id']."".""); 
?>" data-no-cache="true"><?php echo $this->_var['good']['name']; ?></a>
                                    <?php if ($this->_var['good']['attr_str'] != ""): ?><p class="sizes">规格: <?php echo $this->_var['good']['attr_str']; ?></p><?php endif; ?>
                                </div>
                                <div class="shop_price tr">
                                    <p class="u-sm-price"><span class="u-money"><?php if ($this->_var['good']['buy_type'] == 1): ?><i><?php echo $this->_var['good']['return_score']['bai']; ?></i>积分<?php else: ?><i><?php echo $this->_var['good']['discount_unit_price']; ?></i> <small>积分</small></span><?php endif; ?></p>
                                    <p class="shop-count">x<i><?php echo $this->_var['good']['number']; ?></i></p>
                                    <p class="oreder_pay_state"><?php echo $this->_var['good']['deal_orders']; ?></p>
                                </div>
                            </div>

                        </div>
                    </li>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <!--购物车列表结束-->

            <!--配送方式-->
            <div class="m-conBox m-logist">

        		<div href="javascript:void(0);" class="item-content b-line">
                    <div class="item-media"><i class="icon icon-f7"></i></div>
                    <div class="item-inner u-common-inline">
                        <div class="item-title">订单编号</div>
                        <div class="item-after"><?php echo $this->_var['data']['item']['order_sn']; ?></div>
                    </div>
                </div>
                <div href="javascript:void(0);" class="item-content b-line">
                    <div class="item-media"><i class="icon icon-f7"></i></div>
                    <div class="item-inner u-common-inline">
                        <div class="item-title">下单时间</div>
                        <div class="item-after"><?php echo $this->_var['data']['item']['create_time']; ?></div>
                    </div>
                </div>
                <?php if ($this->_var['data']['item']['invoice_info']): ?>
                <div class="invoice-bar">
                    <p class="invoice-tit"><span>发票信息</span><i class="iconfont">&#xe994;</i></p>
                    <div class="invoice-tip flex-1">
                        <p><?php echo $this->_var['data']['item']['invoice_info']['persons']; ?></p>
                        <p><?php echo $this->_var['data']['item']['invoice_info']['content']; ?></p>
                        <?php if ($this->_var['data']['item']['invoice_info']['title'] == 1): ?>
                        <p><?php echo $this->_var['data']['item']['invoice_info']['taxnu']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
           
                <?php if ($this->_var['data']['item']['delivery_id'] != 0): ?>
                <a href="javascript:void(0);" class="item-content b-line">
                    <div class="item-media"><i class="icon icon-f7"></i></div>
                    <div class="item-inner u-common-inline">
                        <div class="item-title">配送方式</div>
                        <div class="item-after j-trans-commpany"><span class="j-company-name"><?php echo $this->_var['data']['item']['delivery_info']['name']; ?></span><span class="expore j-company-money">运费<?php echo $this->_var['data']['item']['delivery_fee']; ?>积分</span></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if ($this->_var['data']['item']['memo']): ?>
                <div class="remark_show">
                    <p><span class="remark_ti">订单备注：</span><?php echo $this->_var['data']['item']['memo']; ?></p>
                </div>
                <?php endif; ?>
				<?php if ($this->_var['data']['item']['payment_info']): ?>
				<div href="javascript:void(0);" class="item-content b-line">
                    <div class="item-media"><i class="icon icon-f7"></i></div>
                    <div class="item-inner u-common-inline">
                        <div class="item-title"><?php echo $this->_var['data']['item']['payment_info']['name']; ?></div>
                        <div class="item-after"><?php echo $this->_var['data']['item']['payment_info']['money']; ?></div>
                    </div>
                </div>
				<?php endif; ?>
            </div>
            <!--配送方式-->


            <!--订单费用详情-->
            <div id="cart_total">
            	<div class="m-conBox m-oreder-derail presell-price-info">
                <?php if ($this->_var['data']['item']['feeinfo']): ?>
					<ul class="shop_total b-line ">
						<?php $_from = $this->_var['data']['item']['feeinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'fee');if (count($_from)):
    foreach ($_from AS $this->_var['fee']):
?>
						<?php if ($this->_var['fee']['symbol'] == 2): ?>
						    <div class="flex-box price-item ">
	                        <div class="price-circle <?php if ($this->_var['fee']['color_left'] == 1): ?> active<?php endif; ?>"></div>
	                        <div class="price-line <?php if ($this->_var['fee']['color_right'] == 1): ?>active"<?php endif; ?>"></div>
	                        <p class="flex-1 <?php if ($this->_var['fee']['color_left'] == 1): ?> active<?php endif; ?>"><?php echo $this->_var['fee']['name']; ?></p>
	                        <p class="<?php if ($this->_var['fee']['color_right'] == 1): ?>active<?php endif; ?>"><?php echo $this->_var['fee']['value']; ?></p>
                  		    </div>
						<?php else: ?>
							<li class="item-content">
								<div class="item-media"><i class="icon icon-f7"></i></div>
								<div class="item-inner u-common-inline u-price">
									<div class="item-title"><?php echo $this->_var['fee']['name']; ?></div>
									<div class="item-after"><?php if ($this->_var['fee']['symbol'] == - 1): ?>-t <?php endif; ?><?php if ($this->_var['fee']['buy_type'] != 1): ?><i class="u-symbol"></i><?php echo $this->_var['fee']['value']; ?><?php else: ?><?php echo $this->_var['fee']['value']; ?><?php endif; ?>积分</div>
								</div>
							</li>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
                    <?php endif; ?>
					<?php if ($this->_var['data']['item']['paid']): ?>
					<ul class="shop_total reduce_total b-line">
						<?php $_from = $this->_var['data']['item']['paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'paid_item');if (count($_from)):
    foreach ($_from AS $this->_var['paid_item']):
?>
						<li class="item-content">
							<div class="item-media"><i class="icon icon-f7"></i></div>
							<div class="item-inner u-common-inline u-price">
								<div class="item-title"><?php echo $this->_var['paid_item']['name']; ?></div>
								<div class="item-after"><?php if ($this->_var['paid_item']['symbol'] == - 1): ?>- <?php endif; ?><?php if ($this->_var['paid_item']['buy_type'] != 1): ?><?php echo $this->_var['paid_item']['value']; ?><?php else: ?><?php echo $this->_var['paid_item']['value']; ?><i class="u-symbol">积分</i><?php endif; ?></div>
							</div>
						</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

					</ul>
					<?php endif; ?>
					<?php if ($this->_var['data']['item']['return_total_score'] >= 0): ?>
					<ul class="shop_total">
						<li class="item-content">
							<div class="item-media"><i class="icon icon-f7"></i></div>
							<div class="item-inner u-common-inline u-price">
								<div class="item-title">原价 <?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['data']['item']['order_total_price'],
);
echo $k['name']($k['v']);
?> <i class="u-symbol">积分</i><?php if ($this->_var['data']['item']['youhui_price']): ?>共优惠 <?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['data']['item']['youhui_price'],
);
echo $k['name']($k['v']);
?><i class="u-symbol">积分</i><?php endif; ?></div>
								<div class="item-after"><p class="u-lg-price">合计：<span class="u-money"><i class="u-symbol"><?php 
$k = array (
  'name' => 'format_price_txt',
  'v' => $this->_var['data']['item']['order_pay_price'],
);
echo $k['name']($k['v']);
?></i> <i class="u-symbol">积分</i></span></p></div>
							</div>
						</li>
					</ul>
                    <?php endif; ?>
				</div>
            </div>
            <!--订单费用详情-->
        </div>
    </div>

</form>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>