<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/index.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/business_address.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/side_deal_list.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/review_list.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/sort_row.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fancybox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/store.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/qrcode_box.css";

$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/jquery.fancybox-thumbs.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery-1.6.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.fancybox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.fancybox-thumbs.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/business_address.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/business_address.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/review_list.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/review_list.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/store.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/store.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/side_deal_list.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/side_deal_list.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<div class="qrcode-box">
	<div class="iconfont">&#xe669;</div>
	<div class="qrcode-info">
		<div class="qrcode-img"><img src="<?php 
$k = array (
  'name' => 'gen_scan_qrcode',
  'v' => $this->_var['store_info']['json_url'],
  's' => '3',
);
echo $k['name']($k['v'],$k['s']);
?>" alt="<?php echo $this->_var['store_info']['name']; ?>"></div>
		<p class="qrcode-bd">使用APP、微信扫一扫<br>手机购物更方便</p>
	</div>
</div>
<script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'BAIDU_MAP_APPKEY',
);
echo $k['name']($k['v']);
?>"></script>
<script type="text/javascript">
	var STORE_IMAGES = <?php echo $this->_var['store_images_json']; ?>;
	var AJAX_URL="<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>";
</script>
<div class="blank"></div>
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?> clearfix">
		<div class="store_info clearfix">
			<div class="store-info f_l">
				<p class="store-name"><?php echo $this->_var['store_info']['name']; ?></p>
				<div class="store_dp">
					<div class="store_dp_avg">
						<input class="ui-starbar" value="<?php echo $this->_var['store_info']['avg_point']; ?>" disabled="true" />
						<span class="dp_point"><?php echo $this->_var['store_info']['avg_point']; ?></span>
						<span class="dp_num">（<?php echo $this->_var['store_info']['dp_count']; ?>人评价）</span>
						<span class="av-price">人均：<?php echo $this->_var['store_info']['ref_avg_price']; ?> <small style="font-size: 12px;">积分</small></span>
					</div>
				</div>
				<ul class="store-detail">
					<li class="store-address"><i class="iconfont">&#xe615;</i>地址：<?php echo $this->_var['store_info']['address']; ?> <a href="javascript:void(0);" class="j-check-map check-map">查看地图</a></li>
					<?php if ($this->_var['store_info']['tel']): ?>
					<li><i class="iconfont">&#xe623;</i>电话：<?php echo $this->_var['store_info']['tel']; ?></li>
					<?php endif; ?>
					<?php if ($this->_var['store_info']['open_time']): ?>
					<li><i class="iconfont">&#xe607;</i>营业时间：<?php echo $this->_var['store_info']['open_time']; ?></li>
					<?php endif; ?>
					<?php if ($this->_var['store_info']['tags']): ?>
					<li><i class="iconfont">&#xe609;</i>标签：<?php echo $this->_var['store_info']['tags']; ?></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="store-img f_l">
				<div class="img-wrap">
					<img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['store_info']['preview'],
  'w' => '300',
  'h' => '300',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" />
					<!--<div class="img-num">
						<div class="img-mask"></div>
						<p class="num">查看全部 <?php echo $this->_var['store_images_count']; ?>张</p>
					</div>-->
				</div>
			</div>
		</div>
		<div class="store-adv-1">
			<?php echo $this->_var['store_info']['adv_img_1']; ?>
		</div>
		<div class="blank30"></div>
		<div class="store_detail clearfix">
			<div class="store-detail-l f_l">
			<!--详情导航-->
			<div class="show-nav" id="rel_nav">
			<!--{start: 详情导航 -->
			<ul>	
				<?php if ($this->_var['store_info']['brief']): ?>
				<li rel="n0">商户介绍</li>
				<?php endif; ?>			
				<?php if (! $this->_var['preview']): ?>
				<?php if ($this->_var['store_info']['tuan_count'] > 0): ?>
				<li rel="n2">正在团购</li>
				<?php endif; ?>
				<?php if ($this->_var['store_info']['shop_count'] > 0): ?>
				<li rel="n3">商城购物</li>
				<?php endif; ?>
				<?php if ($this->_var['store_info']['event_count'] > 0): ?>
				<li rel="n5">热门活动</li>
				<?php endif; ?>
				<li rel="n6">用户评价</li>
				<?php endif; ?>
			</ul>
			<!--}end: 详情导航 -->
			</div>
			<div style="display:none;" class="fix-nav wrap_m2">
				<!--{start: 浮动导航 -->
				<div class="show-nav">
					<!--{start: 详情导航 -->
					<ul class="f_l">
						<?php if ($this->_var['store_info']['brief']): ?>
						<li rel="n0">商户介绍</li>
						<?php endif; ?>
						<?php if (! $this->_var['preview']): ?>
						<?php if ($this->_var['store_info']['tuan_count'] > 0): ?>
						<li rel="n2">正在团购</li>
						<?php endif; ?>
						<?php if ($this->_var['store_info']['shop_count'] > 0): ?>
						<li rel="n3">商城购物</li>
						<?php endif; ?>
						<?php if ($this->_var['store_info']['event_count'] > 0): ?>
						<li rel="n5">热门活动</li>
						<?php endif; ?>
						<li rel="n6">用户评价</li>
						<?php endif; ?>
					</ul>
					
					<!--}end: 详情导航 -->
				</div>
				<!--}end: 浮动导航 -->
			</div>
			<!--end 详情导航-->
			<div class="show-content">
				<?php if ($this->_var['store_info']['brief']): ?>
				<div rel="n0" class="content_box">
					<div class="box_title nomargin">商户介绍</div>
					<div class="box_content">
						<?php echo $this->_var['store_info']['brief']; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if (! $this->_var['preview']): ?>
				
				<?php if ($this->_var['store_info']['tuan_count'] > 0): ?>
				<div rel="n2" class="content_box">
					<div class="box_title nomargin">正在团购</div>
					<div class="box_content nopadding">
						<div id="supplier_deal" store_id="<?php echo $this->_var['store_info']['id']; ?>">
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if ($this->_var['store_info']['shop_count'] > 0): ?>
				<div rel="n3" class="content_box">
					<div class="box_title nomargin">商城购物</div>
					<div class="box_content nopadding">
						<div id="supplier_shop" store_id="<?php echo $this->_var['store_info']['id']; ?>">
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if ($this->_var['store_info']['event_count'] > 0): ?>
				<div rel="n5" class="content_box">
					<div class="box_title nomargin">热门活动</div>
					<div class="box_content nopadding">
						<div id="supplier_event" store_id="<?php echo $this->_var['store_info']['id']; ?>">
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div rel="n6" class="content_box">
					<div class="box_title clearfix">
						<div class="box_title_text">用户评价</div>
						<div class="box_title_more"><a href="<?php
echo parse_url_tag("u:index|review|"."location_id=".$this->_var['store_info']['id']."".""); 
?>" target="_blank">我要评价</a></div>
					</div>
					<div class="box_content nopadding">
						<!--<div class="review-key">
							<p class="review-key-tit">大家都在说：</p>
							<ul class="review-key-list clearfix">
								<li class="active">味道不错（15）</li>
								<li>服务态度好（10）</li>
								<li>服务态度好（10）</li>
								<li>服务态度好（10）</li>
								<li>服务态度好（10）</li>
								<li>服务态度好（10）</li>
							</ul>
						</div>-->
						<div id="review_list" location_id="<?php echo $this->_var['store_info']['id']; ?>">
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="content_box"></div>
			</div>
		</div><!--end wrap_m2-->
		<div class="wrap_s2 f_r">
		<?php if ($this->_var['use_youhuis']): ?>
		<div class="store-youhui">
			<div class="side-hd clearfix">
				<p class="side-tit f_l">当前店铺可用优惠券</p>
				<a href="<?php
echo parse_url_tag("u:index|uc_youhui|"."".""); 
?>" class="get-more f_r">更多</a>
			</div>
			<ul class="store-youhui-list">
				<?php $_from = $this->_var['use_youhuis']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<li>
					<div class="youhui-hd clearfix">
						<p class="price f_l"><span>&yen;</span><?php echo $this->_var['item']['youhui_value']; ?></p>
						<div class="youhui-info f_l">
							<p class="youhui-tip">实体店铺消费使用</p>
							<p class="youhui-tip">
								<?php if ($this->_var['item']['start_use_price']): ?>
								满<?php echo $this->_var['item']['start_use_price']; ?>积分使用
								<?php else: ?>
								无金额限制
								<?php endif; ?>
							</p>
						</div>
					</div>
					<p class="youhui-time">有效期至：<?php echo $this->_var['item']['use_end_time']; ?></p>
					<!--<a href="javascript:void(0);" class="get-youhui j-get-youhui"><img src="<?php echo $this->_var['TMPL']; ?>/images/youhui/store-get-youhui.png" alt=""></a>-->
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php if ($this->_var['get_youhuis']): ?>
		<div class="store-youhui">
			<div class="side-hd clearfix">
				<p class="side-tit f_l">当前店铺有可领优惠券哦</p>
				<a href="<?php
echo parse_url_tag("u:index|youhuis|"."".""); 
?>" class="get-more f_r">更多</a>
			</div>
			<ul class="store-youhui-list">
				<?php $_from = $this->_var['get_youhuis']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
				<?php if ($this->_var['key'] < 2): ?>
				<li>
					<div class="youhui-hd clearfix">
						<p class="price f_l"><span>&yen;</span><?php echo $this->_var['item']['youhui_value']; ?></p>
						<div class="youhui-info f_l">
							<p class="youhui-tip">实体店铺消费使用</p>
							<p class="youhui-tip">
								<?php if ($this->_var['item']['start_use_price']): ?>
								满<?php echo $this->_var['item']['start_use_price']; ?>积分使用
								<?php else: ?>
								无金额限制
								<?php endif; ?>
							</p>
						</div>
					</div>
					<p class="youhui-time">有效期至：<?php echo $this->_var['item']['use_end_time']; ?></p>
					<a href="javascript:void(0);" class="get-youhui j-get-youhui" data-id="<?php echo $this->_var['item']['id']; ?>">
						<img src="<?php echo $this->_var['TMPL']; ?>/images/youhui/store-get-youhui.png" alt="">
					</a>
				</li>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
		<?php endif; ?>
		<div class="side-map j-check-map">
			<div id="container" style="width: 218px;height: 218px;"></div>
			<input type="hidden" name="xpoint" value="<?php echo $this->_var['store_info']['xpoint']; ?>">
			<input type="hidden" name="ypoint" value="<?php echo $this->_var['store_info']['ypoint']; ?>">
			<div class="map-mask"></div>
			<p class="side-map-tip">查看完整地图</p>
		</div>
		<div class="store-adv-2">
			<?php echo $this->_var['store_info']['adv_img_2']; ?>
		</div>

		<?php if ($this->_var['side_deal_list']): ?>
		<div class="side_deal_box">
			<div class="title_row">附近同类团购</div>
			<div class="content_row">
				<ul class="side_deal_list">
					<?php $_from = $this->_var['side_deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'side_deal');if (count($_from)):
    foreach ($_from AS $this->_var['side_deal']):
?>
					<li>
						<a href="<?php echo $this->_var['side_deal']['url']; ?>" class="deal_img"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['side_deal']['icon'],
  'w' => '300',
  'h' => '300',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" lazy="true" /></a>
						<a href="<?php echo $this->_var['side_deal']['url']; ?>"  class="deal_title"><?php echo $this->_var['side_deal']['sub_name']; ?></a>
						<div class="deal_info">
						<span class="deal_price f_l">
							<span class="current_price"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['side_deal']['current_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?> <small style="font-size: 12px;">积分</small></span>
							<!--<?php if ($this->_var['side_deal']['origin_price'] > 0): ?>
							<span class="origin_price">&yen;<?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['side_deal']['origin_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?></span>
							<?php endif; ?>-->
						</span>
						<span class="sale_count f_r">
							已售<span><?php echo $this->_var['side_deal']['buy_count']; ?></span>
						</span>
						</div>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					
				</ul>
			</div>
		</div>
		<div class="blank"></div>
		<?php endif; ?>
		</div>
	</div>

</div>
<div class="blank20"></div>
<div class="mask j-close-map"></div>
<div class="map-box">
	<div class="map-hd">商家位置<a href="javascript:void(0);" class="j-close-map iconfont">&#xe619;</a></div>
	<div id="business_address" supplier_id="<?php echo $this->_var['store_info']['supplier_id']; ?>">

	</div>
</div>
<?php echo $this->fetch('inc/footer.html'); ?>