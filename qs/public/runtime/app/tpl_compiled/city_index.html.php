<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/city.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/weebox.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/utils/fanweUI.css";
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
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/user.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/city.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/city.js";
?>
<?php echo $this->fetch('inc/header.html'); ?> 
<script type="text/javascript">
	var city_json=<?php echo $this->_var['city_json']; ?>
</script>
<div class="search_list">
	<ul>
		<?php $_from = $this->_var['city_lists_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city_item');if (count($_from)):
    foreach ($_from AS $this->_var['city_item']):
?>
		<li url='<?php echo $this->_var['city_item']['url']; ?>' suname="<?php echo $this->_var['city_item']['uname']; ?>" sname="<?php echo $this->_var['city_item']['name']; ?>"><span class="item_name"><?php echo $this->_var['city_item']['name']; ?></span><span class="item_py"><?php echo $this->_var['city_item']['uname']; ?></span></li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
</div>
<div class="<?php 
$k = array (
  'name' => 'load_wrap',
  't' => $this->_var['wrap_type'],
);
echo $k['name']($k['t']);
?>">
	<div class="blank"></div>	
	<div class="city_box">
		<div class="login-panel form_panel">
			<form name="search_city_form">
			<dl>
				<dt>直接搜索：</dt>
				<dd>
						<input type="text" holder="请输入城市中文或拼音" class="ui-textbox"  autocomplete="off" name="search_city" />
						<input type="submit" style="display:none;" />
				</dd>
			</dl>			
			</form>
			<form name="city_province">
			<dl>
				<dt>按省份选择：</dt>
				<dd class="by_province">
					<select name="province" class="province_select">
						<option value="0">=省份=</option>
						<?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
						<option value="<?php echo $this->_var['item']['id']; ?>"><?php echo $this->_var['item']['name']; ?></option>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</select>
					<select name="city" class="city_select">
						<option value="0">=城市=</option>

					</select>
					<button type="submit"  class="ui-button sure_city" rel="white" >确定</button>
				</dd>
			</dl>
			</form>	
		</div>
			
		<?php if ($this->_var['hot_city']): ?>
		<div  class="city_lists">
			<h2>热门城市</h2>
			<div class="blank"></div>
			<ul>
				<li class="city_names">
					<p>
						<span>
							<?php $_from = $this->_var['hot_city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city_item');if (count($_from)):
    foreach ($_from AS $this->_var['city_item']):
?>
							<a  href="<?php echo $this->_var['city_item']['url']; ?>"  title="<?php echo $this->_var['city_item']['name']; ?>"><?php echo $this->_var['city_item']['name']; ?></a>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</span>
					</p>
				</li>
			</ul>
		</div>
		<?php endif; ?>
		
		<div  class="city_lists">
			<h2>按拼音首字母选择</h2>
			<div class="blank"></div>
			<ul>
				 <?php $_from = $this->_var['city_lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'city_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['city_group']):
?>
				<li class="city_names">
					<p>
						<span class="label"><strong><?php echo $this->_var['key']; ?></strong></span>
						<span>
							<?php $_from = $this->_var['city_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city_item');if (count($_from)):
    foreach ($_from AS $this->_var['city_item']):
?>
							<a  href="<?php echo $this->_var['city_item']['url']; ?>"  title="<?php echo $this->_var['city_item']['name']; ?>"><?php echo $this->_var['city_item']['name']; ?></a>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</span>
					</p>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
		
	</div>
	<div class="blank"></div>
</div>
<?php echo $this->fetch('inc/footer.html'); ?>