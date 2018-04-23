
<div class="content">
	<div class="title"><span>配送地址</span></div>
	<div class="blank20"></div>
	<form name="my_address" method="post" action="<?php
echo parse_url_tag("u:index|uc_consignee#save|"."".""); 
?>">
	<div class="form_panel">
		<dl>
			<dt><?php
echo lang("CONSIGNEE"); 
?></dt>
			<dd>
				<input class="ui-textbox" value="<?php echo $this->_var['consignee_info']['consignee']; ?>" name="consignee" holder="请输入收货人姓名" />
				<span class="form_tip"></span>
			</dd>
		</dl>
		<dl>
			<dt>联系电话</dt>
			<dd>
				<input  name="mobile" value="<?php echo $this->_var['consignee_info']['mobile']; ?>" class="ui-textbox" holder="请输入11位手机号码" />
				<span class="form_tip"></span>
			</dd>
		</dl>
		<dl>
			<dt><?php
echo lang("REGION_INFO"); 
?></dt>
			<dd>
				<select name="region_lv1" class="ui-select region_select country" height="300">
				    <option value="0">选择国家</option>
					<?php $_from = $this->_var['region_lv1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv1');if (count($_from)):
    foreach ($_from AS $this->_var['lv1']):
?>
					<option <?php if ($this->_var['lv1']['name'] == '中国'): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv1']['id']; ?>"><?php echo $this->_var['lv1']['name']; ?></option>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			  	</select>
								
				<select name="region_lv2" class="ui-select region_select" height="300">
					<option value="0">选择省份</option>
					<?php $_from = $this->_var['region_lv2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv2');if (count($_from)):
    foreach ($_from AS $this->_var['lv2']):
?>
					<option <?php if ($this->_var['lv2']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv2']['id']; ?>"><?php echo $this->_var['lv2']['name']; ?></option>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				  </select>
									
				<select name="region_lv3" class="ui-select region_select" height="300">
					<option value="0">选择城市</option>		
					<?php $_from = $this->_var['region_lv3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv3');if (count($_from)):
    foreach ($_from AS $this->_var['lv3']):
?>
					<option <?php if ($this->_var['lv3']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv3']['id']; ?>"><?php echo $this->_var['lv3']['name']; ?></option>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				 </select>
									
				<select name="region_lv4" class="ui-select region_select" height="300">
					<option value="0">选择县区</option>
					<?php $_from = $this->_var['region_lv4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'lv4');if (count($_from)):
    foreach ($_from AS $this->_var['lv4']):
?>
					<option <?php if ($this->_var['lv4']['selected'] == 1): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_var['lv4']['id']; ?>"><?php echo $this->_var['lv4']['name']; ?></option>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				  </select>
			</dd>
		</dl>
		<dl style="height: 125px;">
			<dt><?php
echo lang("ADDRESS"); 
?></dt>
			<dd>
				<?php if ($this->_var['consignee_info']['street']): ?>
				<input id="consignee_addr" class="ui-textbox" holder="搜索学校/小区/写字楼" value="<?php echo $this->_var['consignee_info']['street']; ?>" onfocus="checkcity();" style="display: none;" />
				<input  name="street" value="<?php echo $this->_var['consignee_info']['street']; ?>" readonly style=" border: 0; width: 240px;" class="streeth" /><a href="javascript:void(0);" class="strModify streeth" style="float: none; color: red;">修改</a>
				<span class="form_tip"></span>
				<?php else: ?>
				<input id="consignee_addr" class="ui-textbox" holder="搜索学校/小区/写字楼" onfocus="checkcity();" />
				<input  name="street" value="<?php echo $this->_var['consignee_info']['street']; ?>" readonly style="display: none; border: 0;" class="streeth" /><a href="javascript:void(0);" class="strModify streeth" style="float: none; display: none;">修改</a>
				<span class="form_tip"></span>
				<?php endif; ?>
				
				<br>
				<textarea name="address" class="ui-textbox" holder="详细地址" style="margin-top: 10px;"><?php echo $this->_var['consignee_info']['address']; ?></textarea>
				<input type="hidden" name="xpoint" value="<?php echo $this->_var['consignee_info']['xpoint']; ?>">
				<input type="hidden" name="ypoint" value="<?php echo $this->_var['consignee_info']['ypoint']; ?>">
			</dd>
		</dl>
		<dl>
			<dt>楼号-门牌号</dt>
			<dd>
				<input  name="doorplate" value="<?php echo $this->_var['consignee_info']['doorplate']; ?>" class="ui-textbox" holder="例: 6号楼208室" />
				<span class="form_tip"></span>
			</dd>
		</dl>
		<dl>
			<dt><?php
echo lang("ZIP"); 
?></dt>
			<dd>
				<input  name="zip" value="<?php echo $this->_var['consignee_info']['zip']; ?>" class="ui-textbox" holder="请输入邮编" />
				<span class="form_tip"></span>
			</dd>
		</dl>

		<input type="hidden" name="consignee_id" value="<?php echo $this->_var['consignee_info']['id']; ?>" />
		<input type="hidden" name="deal_id" value="<?php echo $this->_var['deal_id']; ?>" />

		</div>
		<dl class="submit_dl">
			<dt></dt>
			<dd>
			<button type="button" value="确定"  rel="orange" name="commit"  id="sub_address" class="ui-button noform"  >确定</button>
			</dd>
		</dl>
	</form>
</div>

<script type="text/javascript">
	
	// 百度地图API功能

	function checkcity() {
		if ($('dl[name="region_lv3"] dt').attr('value') == 0) {
			$.showErr("请先选择省市信息");
		}

	}
	var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
		{"input" : "consignee_addr"
	});

	var myValue;
	ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
		var _value = e.item.value;
		myValue =  _value.street +  _value.business;
		setPlace();
	});

	function setPlace(){
		var city = $('dl[name="region_lv3"] span').html();
		function myFun(){
			var obj = local.getResults().getPoi(0);    //获取第一个智能搜索的结果
			if (!obj) {
				$.showErr('没有搜索到地区，换个关键字试试');
				$('#consignee_addr').val('');
			}
			var sprov = $('dl[name="region_lv2"] span').html();

			var rprov = obj.province;

			if (rprov.indexOf(sprov) < 0) {
				$.showErr('没有搜索到地区，换个关键字试试');
				$('#consignee_addr').val('');
			}
			$('input[name=street]').val(obj.title);
			$('#consignee_addr').hide();
			$('.streeth').show();

			var t = false;

			// 对公交站地址的过滤
			if (obj.tags) {
				var tags = obj.tags;
				var length = tags.length;
				
				for (var i = 0; i < length; i++) {
					if (/公交/.test(tags[i])) {
						t = true;
						break;
					}
				}
			}
			
			if (!t) {
				var addr = obj.address;
				var patt = /^([^(]*?省|)([^(]*?市|)([^(]*?(区|县)|)(.*)/;
		        var mat = addr.match(patt);
		        var addr1 = mat.pop();
		        $('textarea[name="address"]').val(addr1);
			}
			
			$('input[name=xpoint]').val(obj.point.lng);
			$('input[name=ypoint]').val(obj.point.lat);
			$('input[name=zip]').val(obj.postcode);
		}
		var local = new BMap.LocalSearch(city, { //智能搜索
		  onSearchComplete: myFun
		});
		local.search(myValue);
	}

	$('.strModify').bind('click', function() {
		$('#consignee_addr').show();
		$('.streeth').hide();
	});

	$('#consignee_addr').bind('focusout', function() {
		if ($.trim($('.streeth').val()) != '') {
			$('#consignee_addr').hide();
			$('.streeth').show();
		}
	})
</script>

