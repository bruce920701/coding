<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index" id="uc_address_add">
<script type="text/javascript">
	var is_region_lv1_reset = '<?php echo $this->_var['is_region_lv1_reset']; ?>';
	var is_default = '<?php echo $this->_var['data']['consignee_info']['is_default']; ?>';
	var first="<?php echo $this->_var['first']; ?>";
	var ajax_url="<?php
echo parse_url_tag("u:index|uc_address|"."".""); 
?>";
	/*var baidu_map_url = "http://api.map.baidu.com/api?v=2.0&ak=<?php echo $this->_var['data']['baidu_m_key']; ?>";*/
	var baidu_map_url = 'http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $this->_var['data']['baidu_m_key']; ?>&services=&t=20170207140543';
    var script = document.createElement("script");
    script.src = baidu_map_url;
    document.body.appendChild(script);
	var is_pick='';
</script>
<!-- <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo $this->_var['data']['baidu_m_key']; ?>"></script> -->
<?php if ($this->_var['check']): ?>
<script>
	ajax_url="<?php echo $this->_var['back_uc_address_index']; ?>";
	is_pick='<?php echo $this->_var['is_pick']; ?>';
</script>
<?php endif; ?>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content">
		<!-- 页面主体 -->
		<?php if ($this->_var['first']): ?>
			<form id="address-form" action="<?php
echo parse_url_tag("u:index|uc_address#save|"."first=".$this->_var['first']."".""); 
?>"  method="post">
		<?php else: ?>
			<form id="address-form" action="<?php
echo parse_url_tag("u:index|uc_address#save|"."".""); 
?>"  method="post">
		<?php endif; ?>
		<input type="hidden" value="<?php echo $this->_var['data']['consignee_info']['id']; ?>" name="region_id"  />
		<input type="hidden" value="<?php echo $this->_var['data']['consignee_info']['is_default']; ?>" name="is_default"  />
		<div class="item-bar">联系人</div>
		<div class="list-block">
			<ul class="m-add-list">
				<!-- Text inputs -->
				<li class="b-line">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input">
								<input type="text" name="consignee" placeholder="请输入收货人姓名" value="<?php echo $this->_var['data']['consignee_info']['consignee']; ?>">
							</div>
						</div>
					</div>
				</li>
				<li class="b-line">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input">
								<input type="tel" name="mobile" placeholder="请输入收货人电话" value="<?php echo $this->_var['data']['consignee_info']['mobile']; ?>">
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="item-bar">收货地址</div>
		<div class="list-block">
			<ul class="m-add-list">
				<li class="b-line">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input flex-box">
                				<div class="p_c_r flex-1" style="display:none">
								<select name="region_lv1" class="region_select">
								    <option value="0">=请选择=</option>
									<?php $_from = $this->_var['data']['region_lv1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'lv1');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['lv1']):
?>
									<option <?php if ($this->_var['lv1']['name'] == '中国'): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv1']['id']; ?>"><?php echo $this->_var['lv1']['name']; ?></option>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							  	</select>
							  	</div>
								<div class="p_c_r flex-1" style="width:30%;">
									<select name="region_lv2" class="region_select" >
										<option value="0">选择省份</option>
										<?php $_from = $this->_var['data']['region_lv2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv2');if (count($_from)):
    foreach ($_from AS $this->_var['lv2']):
?>
										<option <?php if ($this->_var['lv2']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv2']['id']; ?>"><?php echo $this->_var['lv2']['name']; ?></option>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									  </select>
								</div>
								<div class="p_c_r flex-1" style="width:30%;">
									<select name="region_lv3" class="region_select" >
										<option value="0">选择城市</option>
										<?php $_from = $this->_var['data']['region_lv3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv3');if (count($_from)):
    foreach ($_from AS $this->_var['lv3']):
?>
										<option <?php if ($this->_var['lv3']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv3']['id']; ?>"><?php echo $this->_var['lv3']['name']; ?></option>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									 </select>
								 </div>
								<div class="p_c_r flex-1" style="width:30%;">
									<select name="region_lv4" class="region_select" >
										<?php if ($this->_var['data']['region_lv4']): ?>
										<option value="0">选择区县</option>
										<?php $_from = $this->_var['data']['region_lv4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv4');if (count($_from)):
    foreach ($_from AS $this->_var['lv4']):
?>
										<option <?php if ($this->_var['lv4']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv4']['id']; ?>"><?php echo $this->_var['lv4']['name']; ?></option>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										<?php endif; ?>
									  </select>
								  </div>
							</div>
						</div>
					</div>
				</li>
				<!--<li class="b-line">
					<div class="item-content u-area">
						<div class="item-inner">
							<input type="text" id="picker" name="picker" value="北京 杰伦 小姐" placeholder="省市区">
							<i class="icon icon-right"></i>
						</div>
					</div>
				</li>-->
				<li class="b-line">
					<div class="item-content">
						<div class="item-inner mappick">
							<input type="text" readonly="readonly" id="picker" style="font-size: .65rem;colro:#999!important;" name="street" value="<?php if ($this->_var['street']): ?><?php echo $this->_var['street']; ?><?php else: ?><?php echo $this->_var['data']['consignee_info']['street']; ?><?php endif; ?>" placeholder="选择小区/写字楼/学校">
							<i class="iconfont">&#xe607;</i>
							<input type="hidden" name="xpoint" value="<?php echo $this->_var['data']['consignee_info']['xpoint']; ?>">
							<input type="hidden" name="ypoint" value="<?php echo $this->_var['data']['consignee_info']['ypoint']; ?>">
						</div>
					</div>
				</li>
				<!-- Switch (Checkbox) -->
				<li class="u-textarea b-line">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input">
								<textarea name="address" placeholder="详细地址"><?php echo $this->_var['data']['consignee_info']['address']; ?></textarea>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input">
								<input type="text" name="doorplate" value="<?php echo $this->_var['data']['consignee_info']['doorplate']; ?>" placeholder="请输入门牌号 例：6号楼208室">
							</div>
						</div>
					</div>
				</li>
			</ul>

			<div class="list-block" style="margin-top: .5rem;">
				<div class="item-content u-edit-address-default">
					<div class="item-inner">
						<div class="item-title label">设为默认</div>
						<div class="item-after">
							<div class="item-input">
								<label class="label-switch">
									<input type="checkbox" is_default="<?php echo $this->_var['data']['consignee_info']['is_default']; ?>"  <?php if ($this->_var['data']['consignee_info']['is_default'] == 1): ?>checked="checked"<?php endif; ?> >

									<div class="checkbox confirm_set"></div>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</from>
		<!-- 百度地图定位 -->
		<div id="uc_address_map_pick" style="display: none;">
			<script type="text/javascript" src=""></script>
			<div class="search-box">
				<div id="r-result" class="map_search_key flex-box">
					<i class="search-icon iconfont">&#xe61a;</i>
					<input type="text" class="flex-1" id="suggestId" value="<?php echo $this->_var['region']; ?>" placeholder="输入小区、学校、街道" />
				</div>
			</div>
			<div id="baidu_searchResultPanel"></div>
			<div id="baidu_mapBox">
				<div id="baidu_allmap"></div>
				<span>
					<svg class="icon" aria-hidden="true">
						<use xlink:href="#icon-shouhuodizhi"></use>
					</svg>
				</span>
				<div id="baidu-m-result"></div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>