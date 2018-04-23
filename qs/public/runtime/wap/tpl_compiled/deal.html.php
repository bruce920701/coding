<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index deal-page page-current" id="deal">
	<div class="m-mask j-close-box"></div>
	<div class="m-qrcode-box">
		<p class="qrcode-hd b-line">分享二维码</p>
		<div class="qrcode-img"><img src="<?php 
$k = array (
  'name' => 'gen_scan_qrcode',
  'v' => $this->_var['data']['json_url'],
  's' => '3',
);
echo $k['name']($k['v'],$k['s']);
?>" alt="<?php echo $this->_var['data']['name']; ?>"></div>
		<p class="qrcode-bd">请打开微信扫一扫，扫描二维码</p>
	</div>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
<!--添加商品部分初始化参数-->
<script type="text/javascript">
var deal_id = <?php echo $this->_var['data']['id']; ?>;
var ajax_url = '<?php
echo parse_url_tag("u:index|deal|"."".""); 
?>';
var get_recommend_data_url='<?php
echo parse_url_tag("u:index|deal#get_recommend_data|"."data_id=".$this->_var['data']['id']."".""); 
?>';
var get_dp_detail_url='<?php
echo parse_url_tag("u:index|deal#dp_detail|"."data_id=".$this->_var['data']['id']."".""); 
?>';
var deal_price = <?php echo $this->_var['data']['current_price']; ?>;
var deal_buy_count = <?php echo $this->_var['data']['buy_count']; ?>;
var deal_stock = '<?php echo $this->_var['data']['max_bought']; ?>';
var deal_attr_stock_json = <?php echo $this->_var['data']['deal_attr_stock_json']; ?>;
var deal_user_min_bought = parseInt(<?php echo $this->_var['data']['user_min_bought']; ?>);  //会员最小购买
var deal_user_max_bought = parseInt(<?php echo $this->_var['data']['user_max_bought']; ?>);	 //会员最大购买
var now_buy=1;//判断是立即购买还是加入购物车
var cart_url='<?php
echo parse_url_tag("u:index|cart|"."".""); 
?>';

</script>
	<nav class="bar bar-tab m-deal-nav flex-box">
	<?php if (! ( $this->_var['data']['buy_type'] == 1 )): ?>
		<?php if ($this->_var['app_index'] == 'app' && $this->_var['data']['settingid'] && isOpenXN ( )): ?>
		<a class="nav-item link-btn r-line <?php if ($this->_var['data']['settingid']): ?>xnOpenSdk<?php endif; ?>" <?php if ($this->_var['data']['settingid']): ?> settingid="<?php echo $this->_var['data']['settingid']; ?>" goodsTitle="<?php echo $this->_var['data']['goodsTitle']; ?>" goods_URL="<?php echo $this->_var['data']['goods_URL']; ?>" goodsPrice="<?php echo $this->_var['data']['goodsPrice']; ?>" goods_showURL="<?php echo $this->_var['data']['goods_showURL']; ?>"<?php endif; ?>>
			<i class="iconfont">&#xe693;</i>
			<p>客服</p>
		</a>
		<?php endif; ?>
		<?php if ($this->_var['data']['location_id']): ?>
		<a href="<?php if ($this->_var['data']['location_id']): ?><?php
echo parse_url_tag("u:index|store|"."data_id=".$this->_var['data']['location_id']."".""); 
?><?php else: ?><?php
echo parse_url_tag("u:index|index|"."".""); 
?><?php endif; ?>" class="nav-item link-btn r-line">
			<i class="iconfont">&#xe616;</i>
			<p>店铺</p>
		</a>
		<?php endif; ?>
		<a href="javascript:void(0);" data-isdel="<?php if ($this->_var['data']['is_collect'] != 1): ?>0<?php else: ?>1<?php endif; ?>" class="nav-item link-btn r-line collection j-collection ">
			<i class="iconfont icon-collection <?php if ($this->_var['data']['is_collect'] == 1): ?>isCollection<?php endif; ?>"></i>
			<p>收藏</p>
		</a>
		<?php if ($this->_var['data']['in_cart'] == 1): ?>

			<a href="<?php if ($this->_var['app_index'] == 'app'): ?>javascript:App.app_detail(106,0);<?php else: ?><?php
echo parse_url_tag("u:index|cart|"."".""); 
?><?php endif; ?>" class="nav-item link-btn"  data-no-cache="true">
				<i class="iconfont">&#xe617;</i>
				<p>购物车</p>
				<em class="cart-num <?php if ($this->_var['data']['cart_num'] == 0): ?>hide<?php endif; ?>"><?php echo $this->_var['data']['cart_num']; ?></em>
			</a>
		<?php endif; ?>
		<div class="flex-1 flex-box">
			<?php if ($this->_var['data']['check_deal_time']['status'] == 1): ?>
			<?php if ($this->_var['data']['in_cart'] == 1): ?>
			<a href="javascript:void(0);" class="nav-item func-btn add-cart flex-1 j-addcart" data-num="2">
			加入购物车
			</a>
			<?php endif; ?>
			<a href="javascript:void(0);" class="nav-item func-btn now-buy flex-1 j-nowbuy" data-num="2">
				立即购买
			</a>
			<?php else: ?>
			<div href="javascript:void(0);" class="nav-item func-btn flex-1 isOver" data-num="2">


				<?php if ($this->_var['data']['check_deal_time']['data'] == $this->_var['data']['check_deal_time']['DEAL_NOTICE']): ?>
				未开始<?php endif; ?>
				<?php if ($this->_var['data']['check_deal_time']['data'] == $this->_var['data']['check_deal_time']['DEAL_HISTORY']): ?>
				已结束<?php endif; ?>
				<?php if ($this->_var['data']['check_deal_time']['data'] == $this->_var['data']['check_deal_time']['COUPON_HISTORY']): ?>
				消费券已过期<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	<?php else: ?>
		<a href="javascript:void(0);" class="nav-item func-btn flex-1 now-buy <?php if ($this->_var['data']['score_button']['status'] == 1): ?>  j-nowbuy<?php endif; ?>" <?php if ($this->_var['data']['score_button']['status'] == - 1): ?> style="background:#ccc;"<?php endif; ?> data-num="2">
			<?php echo $this->_var['data']['score_button']['name']; ?>
		</a>

	<?php endif; ?>
	</nav>
	<!-- 弹出层 -->
<div class="flippedout-spec">

<!-- 规格选择框开始 -->
	<div class="spec-choose t-line">
		<form id="goods-form" action="<?php
echo parse_url_tag("u:index|cart#addcart|"."".""); 
?>"  method="post">
			<input type="hidden" name="buy_type" value="<?php echo $this->_var['data']['buy_type']; ?>" />
			<div class="close-btn j-spec-choose-close">
				<img class="close-img" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/close-btn.png" alt="">
			</div>
			<div class="good-info b-line">
				<div class="spec-choose-img">
					<img src="<?php echo $this->_var['data']['f_icon']; ?>" alt="商品图片"/>
				</div>
				<!--<div class="spec-goodprice">
				<?php if ($this->_var['data']['buy_type'] == 1): ?>
					<?php echo $this->_var['data']['return_score_show']; ?>
				<?php else: ?>
					<?php echo $this->_var['data']['f_current_price']; ?>
				<?php endif; ?>	
				</div>-->
				<div class="spec-goodstock">库存:<?php if ($this->_var['data']['max_bought'] == - 1): ?>不限<?php elseif ($this->_var['data']['max_bought'] == 0): ?>库存不足<?php elseif ($this->_var['data']['max_bought'] > 0): ?><?php echo $this->_var['data']['max_bought']; ?>件<?php endif; ?>
				</div>
				<?php if ($this->_var['data']['deal_attr']): ?>
				<div class="spec-goodspec"></div>
				<?php endif; ?>
			</div>
			<div class="spec-info">
				<?php $_from = $this->_var['data']['deal_attr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
					<div class="choose-part">
						<div class="spec-tit unchoose"><?php echo $this->_var['attr']['name']; ?></div>
						<ul class="choose-list">
							<?php $_from = $this->_var['attr']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr_item');if (count($_from)):
    foreach ($_from AS $this->_var['attr_item']):
?>
								<li class="j-choose choose-item choose-item-big" data-value="<?php echo $this->_var['attr_item']['name']; ?>" data-id="<?php echo $this->_var['attr_item']['id']; ?>" pirce="<?php echo $this->_var['attr_item']['price']; ?>"><?php echo $this->_var['attr_item']['name']; ?></li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</ul>
						<input type="hidden" class="spec-data" name="deal_attr[<?php echo $this->_var['attr']['id']; ?>]"  />
					</div>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<div class="choose-part t-line clearfix">
					<div class="spec-tit">数量<em><?php if ($this->_var['data']['user_min_bought'] > 0): ?>每人最少购买<?php echo $this->_var['data']['user_min_bought']; ?>件<?php if ($this->_var['data']['in_cart'] == 1): ?>，可分别购买<?php endif; ?><?php if ($this->_var['data']['user_max_bought'] > 0): ?>,<?php else: ?>。<?php endif; ?><?php endif; ?><?php if ($this->_var['data']['user_max_bought'] > 0): ?>每人限购<?php echo $this->_var['data']['user_max_bought']; ?>件。<?php endif; ?></em></div>
					<i class="nummiuns add-miuns j-add-miuns j-miuns isUse" data-operate="-">&#45;</i>
					<input type="text" name="num" class="numplusminus" value="1"  data-max="<?php if ($this->_var['data']['user_max_bought'] > 0): ?><?php echo $this->_var['data']['user_max_bought']; ?><?php else: ?>100<?php endif; ?>" data-min="1">
					<i class="numadd add-miuns j-add-miuns j-add" data-operate="+" id="addnum" max-num="<?php echo $this->_var['data']['max_bought']; ?>">&#43;</i>
					<!-- <input type="hidden" name="num" value="1" /> -->
					<input type="hidden" name="id" value="<?php echo $this->_var['data']['id']; ?>"  />
					<input type="hidden" name="type" value="0"  />
					<input type="hidden" name="max_bought" value="<?php echo $this->_var['data']['max_bought']; ?>"  />
				</div>
			</div>
			<div class="spec-btn-list flex-box t-line">
				<input type="hidden" class="deal_attr_stock_str" data-value="" />
				<?php if ($this->_var['data']['in_cart'] == 1): ?>
				<a href="javascript:void(0);" class="flex-1 joincart">加入购物车</a>
				<?php endif; ?>
				<a href="javascript:void(0);" class="flex-1 nowbuy"><?php if ($this->_var['data']['buy_type'] == 1): ?>立即兑换<?php else: ?>立即购买<?php endif; ?></a>
				<a href="javascript:void(0);" class="flex-1 isOk">确定</a>
				<div class="flex-1 noStock">确定</div>
			</div>
		</form>
	</div>
<!-- 规格选择框结束 -->
	<div class="close-flippedout j-flippedout-close">
	</div>
</div>
	<div class="content  infinite-scroll">
		<div class="content-block m-deal-content">
			<div class="tabs">
				<div id="tab1" class="tab active">
					<div style="position: relative;z-index: 1;width: 100%;">
						<div class="j-deal-content-banner deal-banner" data="<?php echo $this->_var['data']['images_count']; ?>">
							<div class="swiper-wrapper">
							<?php if ($this->_var['data']['f_images']): ?>
								<?php $_from = $this->_var['data']['f_images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');$this->_foreach['img'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['img']['total'] > 0):
    foreach ($_from AS $this->_var['img']):
        $this->_foreach['img']['iteration']++;
?>
								<div class="swiper-slide" rel="<?php echo $this->_foreach['img']['iteration']; ?>">
									<?php if ($this->_var['data']['is_shop'] == 0): ?>
									<a href="#tab2" class="t-line j-detail tab-link" data="1" data-type="0">
										<img alt="" date-load="1" data-src="<?php echo $this->_var['img']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png" width="100%">
									</a>
									<?php else: ?>
									<img alt="" date-load="1" data-src="<?php echo $this->_var['img']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png" width="100%">
									<?php endif; ?>
								</div>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							<?php else: ?>
								<!--没有图片的情况-->
								<div class="swiper-slide">
									<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png" width="100%" />
								</div>
							<?php endif; ?>
							</div>
						</div>
						   <div class="qrcode-btn j-open-qrcode iconfont">&#xe60e;</div>  
						<div class="banner-bottom">
							<?php if ($this->_var['data']['is_shop'] != 0 && $this->_var['data']['images_count'] > 0): ?>
							<div class="slideindex">
								<em></em>&nbsp;/&nbsp;<?php echo $this->_var['data']['images_count']; ?>
							</div>
							<?php endif; ?>
							<?php if ($this->_var['data']['is_shop'] == 0): ?>
							<div class="tuan-goodinfo">
								<div class="goodname"><?php echo $this->_var['data']['supplier_name']; ?></div>
								<div class="gooddetail">
								<?php echo $this->_var['data']['brief']; ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<!-- 商品信息开始 -->
					<div class="m-good-info b-line">
						<?php if ($this->_var['data']['is_shop'] == 1): ?>
							<div class="good-name"><?php echo $this->_var['data']['name']; ?>
							</div>
							<div class="good-general">
								<?php echo $this->_var['data']['brief']; ?>
							</div>
						<?php endif; ?>
						<div class="price-info flex-box">
							<?php if (! ( $this->_var['data']['buy_type'] == 1 )): ?>
							<div>
						
								<p class="price"><?php echo $this->_var['data']['f_current_price']; ?> <small>积分</small></p>
								<p style="color: #ff7575;margin-right: .5rem;">
									<?php if ($this->_var['data']['user_login_status']): ?>
									<?php echo $this->_var['data']['discount_name']; ?>
									<?php else: ?>
									登录后确认是否享有会员优惠价
									<?php endif; ?>
								</p>
							</div>
							<!--<?php if ($this->_var['data']['f_origin_price'] > 0): ?><p class="p-price t-line">&yen;<?php echo $this->_var['data']['f_origin_price']; ?></p><?php endif; ?>-->
							<p class="sale-num flex-1 tr">
								已售<?php echo $this->_var['data']['buy_count']; ?>
							</p>
							<?php else: ?>
							<p class="price"><?php echo $this->_var['data']['return_score_show']; ?><span>积分</span></p>
							<?php endif; ?>
						</div>
						<div class="">
							<?php if ($this->_var['data']['is_shop'] == 0 && $this->_var['data']['end_time'] != 0): ?>
							<div class="tuan-residuetime left_time AdvLeftTime" data="<?php echo $this->_var['data']['f_end_time']; ?>">
								还剩
								<span class="s day">--</span><span class="l">天</span><span class="s hour">--</span><span class="l">:</span><span class="s min">--</span><span class="l">:</span><span class="s sec">--</span>
							</div>	
							<?php endif; ?>
						</div>
					</div>
					<!--<div class="m-good-info">
						<div class="price-info flex-box">
							<?php if ($this->_var['data']['is_shop'] == 0 && $this->_var['data']['end_time'] != 0): ?>
							<div class="tuan-residuetime left_time AdvLeftTime" data="<?php echo $this->_var['data']['f_end_time']; ?>">
								还剩
								<span class="s day">&#45;&#45;</span><span class="l">天</span><span class="s hour">&#45;&#45;</span><span class="l">:</span><span class="s min">&#45;&#45;</span><span class="l">:</span><span class="s sec">&#45;&#45;</span>
							</div>
							<?php endif; ?>
						</div>
					</div>-->
					<?php $this->_var['data']['promotes_count'] = count($this->_var['data']['promotes_list_arr']);?>
					<?php if ($this->_var['data']['promotes_list_arr'] && $this->_var['data']['buy_type'] == 0): ?>
					<ul   <?php if ($this->_var['data']['is_display'] == 1): ?> class="shop-active b-line" style="overflow:visible;height:auto;padding-top:.1rem;"<?php else: ?>class="shop-active b-line j-activeopen" rel="1"<?php endif; ?>>
						<?php $_from = $this->_var['data']['promotes_list_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
						<li class="active-item">
							<?php if ($this->_var['row']['type'] == "free"): ?>
							<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/tag/3.png" class="tag" />
							<?php endif; ?>
							<?php if ($this->_var['row']['type'] == "return"): ?>
							<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/tag/1.png" class="tag" />
							<?php endif; ?>
							<?php if ($this->_var['row']['type'] == "minus"): ?>
							<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/tag/2.png" class="tag" />
							<?php endif; ?>
							<?php echo $this->_var['row']['content']; ?>
						</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<?php if ($this->_var['data']['promotes_count'] > 1 && $this->_var['data']['is_display'] != 1): ?>
							<i class="iconfont f_r icon-style icon-more">&#xe608;</i>
							<i class="iconfont f_r icon-style icon-less">&#xe606;</i>
						<?php endif; ?>
					</ul>
					<?php endif; ?>
					<?php $this->_var['data']['deal_tags_count'] = count($this->_var['data']['deal_tags']);?>
					<?php if ($this->_var['data']['deal_tags'] && $this->_var['data']['buy_type'] == 0): ?>
					<div class="shop-fuli">
						<ul class="shop-active j-activeopen" rel="2">
						<?php $_from = $this->_var['data']['deal_tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<li class="shop-active-item"><?php echo $this->_var['row']['v']; ?></li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							<i class="iconfont f_r icon-style icon-more">&#xe608;</i>
							<i class="iconfont f_r icon-style icon-less">&#xe606;</i>
						</ul>
					</div>
					<?php endif; ?>
					<?php if ($this->_var['data']['deal_attr'] && $this->_var['data']['buy_type'] == 0): ?>
					<div class="j-open-choose good-specifications open-bar flex-box b-line" data-num="<?php echo $this->_var['data']['deal_attr']['length']; ?>">
						<p class="open-txt flex-1">
							请选择<?php $_from = $this->_var['data']['deal_attr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>&nbsp;&nbsp;<?php echo $this->_var['attr']['name']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</p>
						<div class="iconfont open-ico">&#xe612;</div>
					</div>
					<?php endif; ?>
					<!-- 商品信息结束 -->
					<?php if ($this->_var['data']['supplier_location_list']): ?>
					<div class="tuan-shopinfo">
						<div class="name-range">
							<div class="shopName" onclick ="javascript:location.href='<?php
echo parse_url_tag("u:index|store|"."data_id=".$this->_var['data']['supplier_0']['id']."".""); 
?>'"><?php echo $this->_var['data']['supplier_0']['name']; ?></div>

							<div class="shopRange"><?php echo $this->_var['data']['supplier_0']['distance']; ?></div>

						</div>
						<div class="addressTel">
							<div class="shop-address r-line"><a href="<?php
echo parse_url_tag("u:index|position|"."location_id=".$this->_var['data']['supplier_0']['id']."".""); 
?>"><?php echo $this->_var['data']['supplier_0']['address']; ?></a></div>
							<div class="shop-tel">
								<a href="tel:<?php echo $this->_var['data']['supplier_0']['tel']; ?>">
									<i class="iconfont">&#xe618;</i>
								</a>
							</div>
						</div>
						
						<?php if ($this->_var['data']['supplier_location_count'] > 1): ?>
						<a class="tuan-showMore t-line" href="<?php
echo parse_url_tag("u:index|location|"."data_id=".$this->_var['data']['id']."".""); 
?>">
							查看全部<?php echo $this->_var['data']['supplier_location_count']; ?>家分店
							<i class="iconfont f_r icon-style">&#xe607;</i>
						</a>
						<?php endif; ?>
					</div>
					<?php endif; ?>


				<!-- ———————————————————————————————————————————————————团购———————————————————————————————————————————————————————————— -->
				<?php if ($this->_var['data']['notes'] != ''): ?>
				<div class="consume-tip">
					<div class="tuan-tit b-line">消费提示</div>
					<div class="">
						<?php echo $this->_var['data']['notes']; ?>
					</div>
				</div>
				<?php endif; ?>
				
					<?php if ($this->_var['data']['is_shop'] == 1 && $this->_var['data']['buy_type'] == 0): ?>
					<?php if ($this->_var['data']['relate_data']['goodsList']): ?>
					<div class="best-group">
						<a class="best-group-tit flex-box" href="<?php
echo parse_url_tag("u:index|dealgroup|"."data_id=".$this->_var['data']['id']."".""); 
?>">
							<p class="flex-1">最佳组合</p>
							<div class="iconfont">&#xe607;</div>
						</a>
						<div class="flex-box">
							<?php if ($this->_var['data']['relate_data']['goodsList']['0']): ?>
							<a class="bestimg-box flex-1" href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['data']['relate_data']['goodsList']['0']['id']."".""); 
?>">
								<img alt="<?php echo $this->_var['data']['relate_data']['goodsList']['0']['name']; ?>" date-load="1" data-src="<?php echo $this->_var['data']['relate_data']['goodsList']['0']['f_icon_middle']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png" width="100%">
								<div class="best-price">&yen;<?php echo $this->_var['data']['relate_data']['goodsList']['0']['current_price']; ?></div>
							</a>
							<?php endif; ?>
							<?php if ($this->_var['data']['relate_data']['goodsList']['1']): ?>
							<div class="best-add">＋</div>
							<a class="bestimg-box flex-1" href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['data']['relate_data']['goodsList']['1']['id']."".""); 
?>">
								<img alt="<?php echo $this->_var['data']['relate_data']['goodsList']['1']['name']; ?>" date-load="1" data-src="<?php echo $this->_var['data']['relate_data']['goodsList']['1']['f_icon_middle']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png" width="100%">
								<div class="best-price">&yen;<?php echo $this->_var['data']['relate_data']['goodsList']['1']['current_price']; ?></div>
							</a>
							<?php endif; ?>
							<?php if ($this->_var['data']['relate_data']['goodsList']['2']): ?>
							<div class="best-add">＋</div>
							<a class="bestimg-box flex-1" href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['data']['relate_data']['goodsList']['2']['id']."".""); 
?>">
								<img alt="<?php echo $this->_var['data']['relate_data']['goodsList']['2']['name']; ?>" date-load="1" data-src="<?php echo $this->_var['data']['relate_data']['goodsList']['2']['f_icon_middle']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png" width="100%">
								<div class="best-price">&yen;<?php echo $this->_var['data']['relate_data']['goodsList']['2']['current_price']; ?></div>
							</a>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
					<?php endif; ?>
					<div id="dp_list_click"></div>
					<?php if ($this->_var['data']['buy_type'] == 0): ?>
						<div class="m-promote">
						    <em class="promote-tit"><svg class="icon" aria-hidden="true">
							<use xlink:href="#icon-tuwenxiangqing"></use>
						</svg>商品详情</em>
						</div>
					<div class="tuan-packageInfo">
						<?php if ($this->_var['data']['is_shop'] == 0): ?>
						<?php if ($this->_var['data']['set_meal']): ?>
						<div class="tuan-tit b-line">套餐内容</div>
						<div class="">
							<?php echo $this->_var['data']['set_meal']; ?>
						</div>
						<?php endif; ?>
						<?php endif; ?>
						<div class="deal-detail" style="<?php if (! $this->_var['data']['description']): ?>background:transparent;<?php endif; ?>">
						<?php if ($this->_var['data']['description']): ?>
							<?php echo $this->_var['data']['description']; ?>
						<?php else: ?>
							<div class="tipimg no_data">
							暂无详情
							</div>
						<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>



					<?php if ($this->_var['data']['other_location_deal'] && $this->_var['data']['is_shop'] == 0): ?>
					<div class="tuan-shopoher">
						<div class="tuan-tit b-line">本商家其他热卖<?php if ($this->_var['data']['is_shop'] == 1): ?>商品<?php else: ?>团购<?php endif; ?></div>
						<ul class="tuan-list">
							<?php $_from = $this->_var['data']['other_location_deal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'other_deal_item');if (count($_from)):
    foreach ($_from AS $this->_var['other_deal_item']):
?>
							<li>
								<a href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['other_deal_item']['id']."".""); 
?>">
									<div class="tuan-img">
										<img date-load="1" data-src="<?php echo $this->_var['other_deal_item']['f_icon']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png" width="100%">
									</div>
									<div class="tuan-info">
										<h2 class="tuan-name"><?php echo $this->_var['other_deal_item']['name']; ?></h2>
										<div class="tuan-sale">
											<p class="price">&yen;<?php echo $this->_var['other_deal_item']['f_current_price_arr']['0']; ?>.<span><?php echo $this->_var['other_deal_item']['f_current_price_arr']['1']; ?></span><?php if ($this->_var['other_deal_item']['f_origin_price'] > 0): ?><del class="p-price">&yen;<?php echo $this->_var['other_deal_item']['f_origin_price']; ?></del><?php endif; ?></p>
											<?php if ($this->_var['other_deal_item']['buy_count'] > 0): ?><p class="sale">已售<?php echo $this->_var['other_deal_item']['buy_count']; ?></p><?php endif; ?>
										</div>
									</div>
								</a>
							</li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

						</ul>
						<?php if ($this->_var['data']['count_other_location_deal'] > 0): ?>
							<div class="tuan-showMore t-line j-tuan-showMore">
									<span id="other" content="查看剩余<?php echo $this->_var['data']['count_other_location_deal']; ?>个<?php if ($this->_var['data']['is_shop'] == 1): ?>商品<?php else: ?>团购<?php endif; ?>">查看剩余<?php echo $this->_var['data']['count_other_location_deal']; ?>个<?php if ($this->_var['data']['is_shop'] == 1): ?>商品<?php else: ?>团购<?php endif; ?></span>
									<i class="iconfont f_r icon-style icon-more">&#xe608;</i>
									<i class="iconfont f_r icon-style icon-less">&#xe606;</i>
							</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<!--商户推荐团购-->
            <div id="recommend_data"></div>
			<?php if ($this->_var['data']['buy_type'] == 1): ?>
				<div class="deal-detail" style="<?php if (! $this->_var['data']['description']): ?>background:transparent;<?php endif; ?>">
					<?php if ($this->_var['data']['description']): ?>
						<?php echo $this->_var['data']['description']; ?>
					<?php else: ?>
						<div class="tipimg no_data">
						暂无详情
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<div id="tab3" class="tab comment-list j-ajaxlist"  style="<?php if (! $this->_var['data']['dp_list']): ?>background:transparent;<?php endif; ?>">
			<dl class="m-comment j-ajaxadd">
					<div class="tipimg no_data no_dp_data">
					暂无评价
					</div>
			</dl>
		</div>

			</div>
		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
