<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/deal.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/side_deal_list.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/business_address.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/sort_row.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/review_list.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/relate_goods.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/qrcode_box.css";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.animateToClass.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/utils/jquery.timer.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/fanweUI.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/cart.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/cart.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/business_address.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/business_address.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/side_deal_list.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/side_deal_list.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/review_list.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/review_list.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/deal.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/deal.js";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/relate_goods.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/relate_goods.js";

if(defined("FX_LEVEL"))
{
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_fx_deal_fx.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_fx_deal_fx.js";
}

?>
<?php echo $this->fetch('inc/header.html'); ?>
<?php if(defined("FX_LEVEL")){ ?>
<script>
    var ajax_url = '<?php
echo parse_url_tag("u:index|uc_fx|"."".""); 
?>';
    
    $(document).ready(function(){
	    $("#deal_user_login").bind("click",function(){
			if(typeof(login_callback)=="function")
			{
				ajax_login(login_callback);
			}
			else
			{
				ajax_login();
			}
			return false;
		});
    });
</script>
<?php }?>
<script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'BAIDU_MAP_APPKEY',
);
echo $k['name']($k['v']);
?>"></script> 
<div class="qrcode-box deal_qrcode_box">
	<div class="iconfont">&#xe669;</div>
	<div class="qrcode-info">
			<div class="qrcode-img"><img src="<?php 
$k = array (
  'name' => 'gen_scan_qrcode',
  'v' => $this->_var['deal']['json_url'],
  's' => '3',
);
echo $k['name']($k['v'],$k['s']);
?>" alt="<?php echo $this->_var['deal']['name']; ?>"></div>
				<p class="qrcode-bd">使用APP、微信扫一扫<br>手机购物更方便</p>
	</div>
</div>
<div class="blank"></div>
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?> clearfix">
	<div class="deal_introduce clearfix border">
	    	<h1 class="title"><?php echo $this->_var['deal']['sub_name']; ?></h1>
	    	<p class="details ">
				<?php echo $this->_var['deal']['name']; ?>
				
			</p>
			<div class="kf_qq_box">
			<?php if ($this->_var['deal']['location_qqs']): ?>
				<div class="s_kf_qq">
					<ul>
						<?php $_from = $this->_var['deal']['location_qqs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
						<?php if ($this->_var['row']['location_qq']): ?>
							<li><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['row']['location_qq']; ?>&site=qq&menu=yes" title="<?php echo $this->_var['row']['name']; ?>"><i class="iconfont">&#xe64a;</i>客服QQ</a></li>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
			<div class="component clearfix">
				<div class="component_left f_l">
					<div class="big_pic">
						<div class="tags">
							<?php if (! $this->_var['is_presell']): ?>
							<?php $_from = $this->_var['deal']['deal_tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
							<h2 class="tag<?php echo $this->_var['tag']; ?>"></h2>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							<?php endif; ?>
							<?php if ($this->_var['deal']['buyin_app'] == 1): ?>
							<h2 class="tag_buyinapp"></h2>
							<?php endif; ?>
						</div>
						<img id="big_pic" src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['deal']['icon'],
  'w' => '900',
  'h' => '900',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" lazy="true" alt="<?php echo $this->_var['deal']['sub_name']; ?>" origin="<?php echo $this->_var['deal']['icon']; ?>" width="460" height="460">
					</div>
					<?php if ($this->_var['deal']['image_list']): ?>
					<div class="pic_hidden">
						<div class="small_pic word" id="small_pic">
							<?php $_from = $this->_var['deal']['image_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');if (count($_from)):
    foreach ($_from AS $this->_var['img']):
?>
							<a href="javascript:void(0);" <?php if ($this->_var['img']['current'] == 1): ?>class="active"<?php endif; ?>><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['img']['img'],
  'w' => '450',
  'h' => '450',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" big_pic="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['img']['img'],
  'w' => '900',
  'h' => '900',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" origin="<?php echo $this->_var['img']['img']; ?>" lazy="true" width="45" height="45"></a>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							<!--当前用active标示-->
					    </div>
						<?php if (count ( $this->_var['deal']['image_list'] ) > 5): ?>
					    <a href="javascript:void(0);" class="pre hide_tag"></a> 
						<a href="javascript:void(0);" class="next hide_tag"></a> 
						<?php endif; ?>
					</div>
					<?php endif; ?>
					
				</div>
				<div class="component_rigth f_r" id="main_package_choose">
					<div class="component_price clearfix">
						<div class="base_info f_l">
							<h2><?php if ($this->_var['deal']['buy_type'] != 1): ?><span>所需积分</span><?php else: ?><span>所需积分</span><?php endif; ?><strong id="deal_price"><?php if ($this->_var['deal']['buy_type'] != 1): ?><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['current_price'],
  'p' => '2',
);
echo $k['name']($k['v'],$k['p']);
?><?php else: ?><?php 
$k = array (
  'name' => 'abs',
  'v' => $this->_var['deal']['return_score'],
);
echo $k['name']($k['v']);
?><?php endif; ?></strong></h2>
							
							<div class="f_l">
							<?php if ($this->_var['deal']['origin_price'] > 0): ?>
							<!--<span class="discount"><?php echo $this->_var['deal']['discount']; ?>折</span>-->
							<!--<del class="item"> <?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['origin_price'],
  'p' => '2',
);
echo $k['name']($k['v'],$k['p']);
?></del>-->
							<?php endif; ?>
							</div>
						</div>
						<?php if (( $this->_var['deal']['begin_time'] != 0 && $this->_var['deal']['time_status'] == 3 ) || ( $this->_var['deal']['end_time'] != 0 && $this->_var['deal']['time_status'] == 1 )): ?>						
						<div 
							class="countdown f_r" 
							id="countdown" 
							nowtime="<?php echo $this->_var['NOW_TIME']; ?>000"
							<?php if (! $this->_var['is_presell']): ?>
								<?php if ($this->_var['deal']['begin_time'] != 0 && $this->_var['deal']['time_status'] == 3): ?>
								endtime="<?php echo $this->_var['deal']['begin_time']; ?>000" showtitle="距离开始："
								<?php endif; ?>
								<?php if ($this->_var['deal']['end_time'] != 0 && $this->_var['deal']['time_status'] == 1): ?>
								endtime="<?php echo $this->_var['deal']['end_time']; ?>000" showtitle="距离结束："
								<?php endif; ?>
							<?php else: ?>
								endtime="<?php echo $this->_var['deal']['end_time']; ?>000" showtitle="预售剩余："
							<?php endif; ?>
						></div><!--倒计时-->
						<?php endif; ?>
					</div>

					<div class="clearfix" style="padding:5px; margin-top: 20px;">
						<?php if (! $this->_var['is_presell']): ?>
							<?php if ($this->_var['user_login_status']): ?>
								<?php echo $this->_var['deal']['discount_name']; ?>
							<?php else: ?>
								<a href="<?php
echo parse_url_tag("u:index|user#login|"."".""); 
?>" style="color:#f80;" id="deal_user_login">登录</a>后确认是否享有会员优惠价
							<?php endif; ?>
						<?php else: ?>
						<div class="dingjin">
							<span class="dj_txt"><?php echo $this->_var['deal']['presell_deposit_type']; ?></span>&nbsp;&nbsp;&nbsp;<span class="dj_numb">&yen;&nbsp;<?php echo $this->_var['deal']['presell_deposit_money']; ?></span>&nbsp;&nbsp;&nbsp;<span class="dikou">抵扣 &yen; <?php echo $this->_var['deal']['presell_discount_money']; ?></span>
						</div>
						<div class="guizhe J-gz_detail">
							<span>预售规则</span><i class="iconfont">&#xe647;</i>
						</div>
						<?php endif; ?>
					</div>
					<div class="guize_detail" style="margin-bottom:10px;">
						<?php echo $this->fetch('/inc/presell_rule.html'); ?>
					</div>

					<?php if (! $this->_var['is_presell']): ?>
					<div class="clearfix" style="padding:5px;display: none;">

						<?php if ($this->_var['deal']['promotes_list'] && $this->_var['deal']['buy_type'] == 0): ?>
						<ul class="shop-active b-line j-activeopen" style="height: 28px;">
							<?php $_from = $this->_var['deal']['promotes_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<li class="active-item">
								<?php if ($this->_var['row']['type'] == "free"): ?>
								<img src="<?php echo $this->_var['TMPL']; ?>/images/tag/3.png" class="tag" />
								<?php endif; ?>
								<?php if ($this->_var['row']['type'] == "return"): ?>
								<img src="<?php echo $this->_var['TMPL']; ?>/images/tag/1.png" class="tag" />
								<?php endif; ?>
								<?php if ($this->_var['row']['type'] == "minus"): ?>
								<img src="<?php echo $this->_var['TMPL']; ?>/images/tag/2.png" class="tag" />
								<?php endif; ?>
								<?php echo $this->_var['row']['content']; ?>
							</li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							<?php if ($this->_var['deal']['promotes_count'] > 1): ?>
								<div class="tag_box">
									<i class="iconfont">&#xe647;</i>
									<i class="iconfont" style="display:none;">&#xe648;</i>
								</div>

								
							<?php endif; ?>
						</ul>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<div class="component_rating clearfix" >
					     <ul>
					     	<li class="first f_l">
								<span><?php if ($this->_var['is_presell']): ?>已预售<?php else: ?>已售<?php endif; ?></span>
								<strong><?php echo $this->_var['deal']['buy_count']; ?></strong>
					     	</li>
							<li class="f_l">
								<strong><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['avg_point'],
  'p' => '1',
);
echo $k['name']($k['v'],$k['p']);
?></strong>
					     		<span>分</span>
							</li>
							<li class="f_r last">
					     		<strong><?php echo $this->_var['deal']['dp_count']; ?></strong>
					     		<span>人评价</span>
					     	</li>
							</ul>
					</div>
					<div class="hangtag">
						<ul>
							<?php if ($this->_var['deal']['supplier_info']): ?>
							<li class="clearfix">
								<span class="tag f_l">商家</span>
								<div class="width f_l">
									<a href="<?php echo $this->_var['deal']['supplier_info']['url']; ?>"><?php echo $this->_var['deal']['supplier_info']['name']; ?></a>
									<?php if ($this->_var['deal']['supplier_location_count'] > 0 && $this->_var['deal']['is_shop'] == 0): ?>
									<span class="cross">|</span>
									<a href="javascript:void(0);" id="show_store"><?php echo $this->_var['deal']['supplier_location_count']; ?>店通用</a>
									<?php endif; ?>
								</div>
							</li>
							<?php endif; ?>
							<?php if ($this->_var['deal']['brand_info']): ?>
							<li class="clearfix">
								<span class="tag f_l">品牌</span>
								<div class="width f_l">
									<a href="<?php
echo parse_url_tag("u:index|cate|"."cid=".$this->_var['deal']['shop_cate_id']."&bid=".$this->_var['deal']['brand_info']['id']."".""); 
?>"><?php echo $this->_var['deal']['brand_info']['name']; ?></a>
								</div>
							</li>
							<?php endif; ?>
							<?php if (! $this->_var['is_presell']): ?>
								<?php if ($this->_var['deal']['is_coupon'] == 1): ?>
								<li class="clearfix">
									<span class="tag f_l">消费券</span>
									<div class="width f_l">
										<span>
										<?php if ($this->_var['deal']['coupon_time_type'] == 0): ?>

										<?php if ($this->_var['deal']['coupon_begin_time'] > 0 && $this->_var['NOW_TIME'] < $this->_var['deal']['coupon_begin_time'] && $this->_var['deal']['coupon_end_time'] > 0): ?>
										<?php echo $this->_var['deal']['coupon_begin_time_format']; ?>至<?php echo $this->_var['deal']['coupon_end_time_format']; ?>有效
										<?php endif; ?>
										<?php if ($this->_var['deal']['coupon_begin_time'] > 0 && $this->_var['NOW_TIME'] < $this->_var['deal']['coupon_begin_time'] && $this->_var['deal']['coupon_end_time'] == 0): ?>
										<?php echo $this->_var['deal']['coupon_begin_time_format']; ?>后有效
										<?php endif; ?>
										<?php if ($this->_var['NOW_TIME'] > $this->_var['deal']['coupon_begin_time'] && $this->_var['deal']['coupon_end_time'] > 0): ?>
										<?php echo $this->_var['deal']['coupon_end_time_format']; ?>前有效
										<?php endif; ?>
										<?php if ($this->_var['NOW_TIME'] > $this->_var['deal']['coupon_begin_time'] && $this->_var['deal']['coupon_end_time'] == 0): ?>
										永久有效
										<?php endif; ?>

										<?php else: ?>
										<?php echo $this->_var['deal']['coupon_day']; ?>天内有效
										<?php endif; ?>

										</span>
									</div>
								</li>
								<?php endif; ?>
							<?php endif; ?>
						</ul>
					</div>
					<?php if ($this->_var['deal']['deal_attr']): ?>
					<?php $_from = $this->_var['deal']['deal_attr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal_attr_type');if (count($_from)):
    foreach ($_from AS $this->_var['deal_attr_type']):
?>
					<?php if ($this->_var['deal_attr_type']['attr_list']): ?>
					<div class="package_choose clearfix " rel="<?php echo $this->_var['deal_attr_type']['id']; ?>">
						<span class="info_title f_l"><?php echo $this->_var['deal_attr_type']['name']; ?></span>
						<div class="choose f_r clearfix active_parent">
							<?php $_from = $this->_var['deal_attr_type']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr_item');if (count($_from)):
    foreach ($_from AS $this->_var['attr_item']):
?>
							<a href="javascript:void(0);" rel="<?php echo $this->_var['attr_item']['id']; ?>" price="<?php echo $this->_var['attr_item']['price']; ?>">
								<?php echo $this->_var['attr_item']['name']; ?>
								<i class="iconfont">&#xe620;</i>
							</a>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>							
						</div>
					</div>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					<?php endif; ?>
					<script type="text/javascript">
						var deal_price = <?php echo $this->_var['deal']['current_price']; ?>;  //商品的基础价格
						var deal_stock = <?php echo $this->_var['deal']['max_bought']; ?>;   //原始库存
						var deal_buy_count = <?php echo $this->_var['deal']['buy_count']; ?>;  //销量						
						var deal_user_min_bought = <?php echo $this->_var['deal']['user_min_bought']; ?>;  //会员最小购买
						var deal_user_max_bought = <?php echo $this->_var['deal']['user_max_bought']; ?>;	 //会员最大购买						
						var deal_attr_stock_json = <?php echo $this->_var['deal']['deal_attr_stock_json']; ?>;						
						var buy_type = <?php echo $this->_var['deal']['buy_type']; ?>;  //购物类型
						var deal_id = <?php echo $this->_var['deal']['id']; ?>;
					</script>
					<?php if ($this->_var['deal']['time_status'] == 1 && $this->_var['deal']['is_presell'] != 1): ?>
					<div class="num_choose clearfix">
						      <span class="info_title f_l">数量</span>
							  <div class="f_l">
							  	  <a href="javascript:void(0);" class="less">−</a>
								  <input type="text"  name="q" value="1" maxlength="9" class="change_box" id="deal_num" />
								  <a href="javascript:void(0);" class="increase">+</a>
							  </div>
							  <span class="total f_l" id="stock_span">
							  	<div>还剩<span class="inventory">0</span>份</div>
							  </span>
							  <span class="tips f_l none" id="stock_tips"></span><!--当数量超出库存时，此项显示-->
                    </div>
                    <div style="padding-top: 15px;"><input class="tongyi" type="checkbox" />购买之前请阅读<a href="javascript:;" class="xieyi">《中隆时尚网上商城消费协议书》</a></div>
					<?php endif; ?>
					<?php if (! $this->_var['preview']): ?>
					<div class="roduct_button clearfix">
						<!--<a href="javascript:;" onclick="count_buy_total();">提交</a>-->
						<?php if (! $this->_var['is_presell']): ?>
							<?php if ($this->_var['deal']['time_status'] == 3): ?>
							<button class="ui-button disabled f_l" rel="disabled" type="button">未开始</button><!--disabled-->
							<?php endif; ?>
							<?php if ($this->_var['deal']['time_status'] == 1): ?>
							<button <?php if ($this->_var['deal']['buyin_app'] == 1): ?>style="display:none;"<?php endif; ?> class="ui-button disabled f_l" rel="disabled" type="button" id="buy_btn"><?php if ($this->_var['deal']['buy_type'] == 1): ?>立即兑换<?php else: ?>立即购买<?php endif; ?></button><!--disabled-->
							<?php endif; ?>
							<?php if ($this->_var['deal']['time_status'] == 2): ?>
							<button class="ui-button disabled f_l" rel="disabled" type="button">已过期</button><!--disabled-->
							<?php endif; ?>

						<?php else: ?>
							<button <?php if ($this->_var['deal']['buyin_app'] == 1): ?>style="display:none;"<?php endif; ?> class="ui-button disabled f_l" rel="disabled" type="button" id="buy_btn">支付订金</button>
						<?php endif; ?>
						<?php if(defined("FX_LEVEL") && !$GLOBALS['tmpl']->_var['deal']['is_presell']){ ?>
						<?php if ($this->_var['deal']['is_fx'] == 2): ?>
						<button class="ui-button blue f_l" rel="blue" type="button" onclick="add_user_deal_fx(<?php echo $this->_var['deal']['id']; ?>)">我要分销</button>
						<a class="f_l collect_ico" id="add_collect" href="javascript:void(0);">
							<i class="iconfont">&#xe649;</i>
							<span>收藏</span>
						</a>
						<?php else: ?>
						<button class="ui-button blue f_l" rel="blue" type="button"  id="add_collect">收藏本单</button>
						<?php endif; ?>
						<?php }else{ ?>
						<button class="ui-button blue f_l" rel="blue" type="button"  id="add_collect">收藏本单</button>
						<?php }?>
							
						<div class="f_r share_to">
						<!-- JiaThis Button BEGIN -->
						<div class="jiathis_style">
							<span class="jiathis_txt">分享到：</span>
							<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
							<a class="jiathis_counter_style"></a>
						</div>
						<script type="text/javascript">
							 var jiathis_config = {
							 	title:"<?php echo $this->_var['deal']['name']; ?>",
							    url:"<?php echo $this->_var['deal']['share_url']; ?>"
							    
							};
							var tmpl_path="<?php echo SITE_DOMAIN.APP_ROOT.'/app/Tpl/main/fanwe/js/jia/'; ?>";
						</script>
						<script type="text/javascript" src="<?php echo SITE_DOMAIN.APP_ROOT.'/app/Tpl/main/fanwe/' ?>js/jia/jia.js" charset="utf-8"></script>
						
						<!-- JiaThis Button END -->
						
						</div>	
					</div>
					<?php endif; ?>

					<?php if ($this->_var['promote'] && ! $this->_var['is_presell']): ?>
					<div class="blank"></div>
					<div class="promote_list">
					<?php $_from = $this->_var['promote']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'promote_item');if (count($_from)):
    foreach ($_from AS $this->_var['promote_item']):
?>
					<div class="item"><?php echo $this->_var['promote_item']['description']; ?></div>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</div>
					<?php endif; ?>
					
					<?php if ($this->_var['deal']['buyin_app'] == 1): ?>
					<div class="blank"></div>
					<span class="app_tip">
					本单仅限移动APP端下单购买  &nbsp;&nbsp;
					<span class="ios"><a href="javascript:void(0);"  down_url="<?php
echo parse_url_tag("u:index|ajax#app_download|"."t=ios".""); 
?>" ><i class="iconfont">&#xe614;</i>IOS应用下载</a></span>
					&nbsp;
					<span class="android"><a href="javascript:void(0);"  down_url="<?php
echo parse_url_tag("u:index|ajax#app_download|"."t=android".""); 
?>" ><i class="iconfont">&#xe613;</i>安卓应用下载</a></span>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div><!--end deal_introduce-->
		<div class="blank"></div>
		
		<div class="clearfix">
        	
            <!--合并购买-->
			<?php if (! $this->_var['is_presell']): ?>
			<div class="none" id="relate_goods" deal_id="<?php echo $this->_var['deal']['id']; ?>" supplier_id="<?php echo $this->_var['deal']['supplier_id']; ?>" supplier_name="<?php echo $this->_var['deal']['supplier_info']['name']; ?>"></div>
            <?php endif; ?>
			<div class="wrap_m2 f_l">
            
			<?php if ($this->_var['deal']['is_shop'] == 0 && ! $this->_var['preview']): ?>
			<div id="supplier_deal" deal_id="<?php echo $this->_var['deal']['id']; ?>" supplier_id="<?php echo $this->_var['deal']['supplier_id']; ?>" supplier_name="<?php echo $this->_var['deal']['supplier_info']['name']; ?>">
			</div>
			<?php endif; ?>
			
			<!--详情导航-->
			<div class="show-nav" id="rel_nav">
			<!--{start: 详情导航 -->
			<ul>
				<?php if ($this->_var['deal']['is_shop'] == 0 && $this->_var['deal']['supplier_info'] && $this->_var['deal']['supplier_location_count'] > 0): ?>
				<li rel="n0">商家位置</li>
				<?php endif; ?>
				<?php if ($this->_var['deal']['notes']): ?>
				<li rel="n1">购买需知</li>
				<?php endif; ?>
				<?php if ($this->_var['deal']['description'] || $this->_var['deal']['pc_setmeal']): ?>
				<li rel="n2">本单详细</li>
				<?php endif; ?>
				<?php if (! $this->_var['preview']): ?>
				<li rel="n3">消费评价</li>
				<?php endif; ?>
			
			</ul>
			<!--}end: 详情导航 -->
			</div>
			<div style="display:none;" class="fix-nav wrap_m2">
				<!--{start: 浮动导航 -->
				<div class="show-nav">
					<!--{start: 详情导航 -->
					<ul class="f_l">
						<?php if ($this->_var['deal']['is_shop'] == 0 && $this->_var['deal']['supplier_info'] && $this->_var['deal']['supplier_location_count'] > 0): ?>
						<li rel="n0">商家位置</li>
						<?php endif; ?>
						<?php if ($this->_var['deal']['notes']): ?>
						<li rel="n1">购买需知</li>
						<?php endif; ?>
						<?php if ($this->_var['deal']['description'] || $this->_var['deal']['pc_setmeal']): ?>
						<li rel="n2">本单详细</li>
						<?php endif; ?>
						<?php if (! $this->_var['preview']): ?>
						<li rel="n3">消费评价</li>
						<?php endif; ?>
					</ul>
					<?php if (! $this->_var['preview']): ?>
					<button class="ui-button flow_btn" id="flow_btn" rel="white">
						<?php if (! $this->_var['is_presell']): ?>
							<?php if ($this->_var['deal']['buy_type'] == 1): ?>立即兑换<?php else: ?>立即购买<?php endif; ?>
						<?php else: ?>
							<!--<?php if ($this->_var['deal']['presell_type'] == 1): ?>支付订金
							<?php else: ?>支付订金
							<?php endif; ?>-->
						<?php endif; ?>
					</button>
					<?php endif; ?>
					<!--}end: 详情导航 -->
				</div>
				<!--}end: 浮动导航 -->
			</div>
			<!--end 详情导航-->
			<div class="show-content">
				<?php if ($this->_var['deal']['is_shop'] == 0 && $this->_var['deal']['supplier_info'] && $this->_var['deal']['supplier_location_count'] > 0): ?>
				<div rel="n0" class="content_box">
					<div class="box_title nomargin">商家位置</div>
					<div class="box_content nopadding">
 						<div id="business_address" deal_id="<?php echo $this->_var['deal']['id']; ?>" supplier_id="<?php echo $this->_var['deal']['supplier_id']; ?>">
						
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if ($this->_var['deal']['notes']): ?>
				<div rel="n1" class="content_box">
					<div class="box_title">购买需知</div>
					<div class="box_content">
						<?php echo $this->_var['deal']['notes']; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ($this->_var['deal']['description'] || $this->_var['deal']['pc_setmeal']): ?>
				<div rel="n2" class="content_box">
					<div class="box_title">本单详细</div>
					<div class="box_content">
						<?php echo $this->_var['deal']['description']; ?>
						<div class="blank"></div>
						<?php echo $this->_var['deal']['pc_setmeal']; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if (! $this->_var['preview']): ?>
				<div rel="n3" class="content_box">
					<div class="box_title">
						<div class="box_title_text">消费评价</div>
						<div class="box_title_more">我买过本单，<a href="<?php
echo parse_url_tag("u:index|review|"."deal_id=".$this->_var['deal']['id']."".""); 
?>" target="_blank">我要评价</a></div>
					</div>
					<div class="box_content">
						<div id="review_list" deal_id="<?php echo $this->_var['deal']['id']; ?>">
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="content_box"></div>
			</div>
		</div><!--end wrap_m2-->
		<div class="wrap_s2 f_r">
			<?php if ($this->_var['side_deal_list']): ?>
			<div class="side_deal_box">
			<div class="title_row">
				<span>您可能喜欢的</span>
				<a href="javascript:void(0);" class="change_favdeal" deal_id="<?php echo $this->_var['deal']['id']; ?>"><i class="iconfont">&#xe624;</i>换一批</a>
			</div>
			<div class="content_row" id="favdeal_list">
				<?php echo $this->fetch('inc/side_favdeal_list.html'); ?>
			</div>
			</div>
			<div class="blank"></div>
			<?php endif; ?>
			
			<?php if ($this->_var['history_deal_list']): ?>
			<div class="side_deal_box">
			<div class="title_row">
				<span>浏览历史</span>
				<a href="javascript:void(0);" class="clear_history" <?php if ($this->_var['deal']['is_shop'] == 0): ?>type="deal"<?php else: ?>type="shop"<?php endif; ?>>清空</a>
			</div>
			<div class="content_row">
				<ul class="side_deal_list">
					<?php $_from = $this->_var['history_deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'side_deal');if (count($_from)):
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
			<?php endif; ?>
		</div>
		</div>

</div>
<style type="text/css">
	.xy_con p{
		float: left;
		font-size: 20px;
		line-height: 50px;
		color: #000;
	}
</style>
<div class="xy none" style="width: 100%; height: 100%;position: fixed;left: 0;top: 0;background: rgba(0,0,0,.3);z-index: 99999;">
	<div class="xy_con" style="padding: 20px 20px;width: 800px;height: 100%;min-width: 800px;margin: auto;background: #fff;overflow: scroll;">
		<h3 style="font-weight: normal;text-align: center;font-size: 26px;line-height: 50px;color: #000;">《中隆时尚网上商城消费协议书》</h3>
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
		<p style="width: 100%;text-align: right;margin-top: 60px;margin-bottom: 30px;">中隆网络科技有限公司</p>
		<a class="back" href="javascript:;" style="margin-bottom: 50px;float: left;width: 150px;height: 50px;line-height: 50px;text-align: center;font-size: 20px;border-radius: 25px;background: #ddd;color: #fff;">返回</a>
		<a class="agree" href="javascript:;" style="margin-bottom: 50px;float: right;width: 150px;height: 50px;line-height: 50px;text-align: center;font-size: 20px;border-radius: 25px;background: #f80;color: #fff;">同意此条款</a>
		<script>
			$(".back").click(function(){
				$(this).parents(".xy").addClass("none");
			});
			$(".agree").click(function(){
				$(this).parents(".xy").addClass("none");
				$(".tongyi").attr("checked",true)
			});
			$('.xieyi').click(function(){
				$(".xy").removeClass("none");
			});
			$("#buy_btn").click(function(){
				if($(".tongyi").attr("checked") == false){
					alert("请阅读用户协议");
					return false;
				}
			});
		</script>
	</div>
</div>
<div class="blank20"></div>

<?php echo $this->fetch('inc/footer.html'); ?>