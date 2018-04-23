<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_consignee.css";
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

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_consignee.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_consignee.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<script>
var AJAX_URL	= '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
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
		
		<div class="main_box setting_user_info">
			<div class="content">
				<div class="title"><span>配送地址</span></div>
				<div class="blank20"></div>
				
				<div class="ui-button orange" style="_width:105px;"><div><a href="<?php
echo parse_url_tag("u:index|uc_consignee#add|"."".""); 
?>" title="新增地址">新增地址</a></div></div>
				<div class="blank20"></div>
				<?php if ($this->_var['consignee_list']): ?>
				<div class="info_table">
					<table>
						<tbody>
							<tr>
									<th>收货人</th>
									<th>所在地区</th>
									<th>详细地址</th>
									<th>手机</th>
									<th>操作</th>
							</tr>
							<?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
							<tr class="alt">
									<td><?php echo $this->_var['item']['consignee']; ?></td>
									<td class="region"><?php echo $this->_var['item']['region_lv2']; ?>&nbsp&nbsp&nbsp<?php echo $this->_var['item']['region_lv3']; ?>&nbsp&nbsp&nbsp<?php echo $this->_var['item']['region_lv4']; ?></td>
									<td style="text-align: left;"><?php echo $this->_var['item']['address']; ?><?php echo $this->_var['item']['street']; ?><?php echo $this->_var['item']['doorplate']; ?></td>	
									<td class="mobile" width="80"><?php echo $this->_var['item']['mobile']; ?></td>
									<td class="operate" style="width:120px;*width:150px;">
											<a href="<?php
echo parse_url_tag("u:index|uc_consignee#add|"."id=".$this->_var['item']['id']."".""); 
?>">修改</a>
											<?php if ($this->_var['item']['is_default'] == 1): ?><span>默认地址</span><?php else: ?><a href="javascript:void(0);" class="default" dfurl="<?php echo $this->_var['item']['dfurl']; ?>">设为默认</a><?php endif; ?>											
											<a href="javascript:void(0);" class="del" url="<?php echo $this->_var['item']['del_url']; ?>"><?php echo $this->_var['LANG']['DELETE']; ?></a>
									</td>	
	                         </tr>
	                         <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	                          
	
						</tbody>
					</table>
					
				</div>

			
				<div class="blank"></div>
				<div class="pages"><?php echo $this->_var['pages']; ?></div>			
				<?php else: ?>
				<div class="empty_tip">暂无地址</div>
				<?php endif; ?>

			</div>				
				
				
		</div>

		<div class="blank20"></div>
		</div>
	</div>	
</div>
<div class="blank20"></div>
<?php echo $this->fetch('inc/footer.html'); ?>