<?php if ($this->_var['supplier_data_list']): ?>
<div class="data_list">
	<dl>
		<?php $_from = $this->_var['supplier_data_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'data');$this->_foreach['supplier_data_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['supplier_data_list']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['data']):
        $this->_foreach['supplier_data_list']['iteration']++;
?>
		<?php if (( $this->_var['is_more'] == 1 && $this->_var['key'] > $this->_var['page_size'] ) || $this->_var['is_more'] == 0): ?>
		<dd class="clearfix <?php if ($this->_var['is_more'] == 1): ?>ajax_add<?php endif; ?>">
				<span class="dl_img">
					<a href="<?php echo $this->_var['data']['url']; ?>" title="<?php echo $this->_var['data']['name']; ?>" target="_blank"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['data']['icon'],
  'w' => '100',
  'h' => '100',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" width="100" height="100"  /></a>
				</span>
				<span class="dl_name">
					<a class="shop-name" href="<?php echo $this->_var['data']['url']; ?>" title="<?php echo $this->_var['data']['name']; ?>" target="_blank"><?php echo $this->_var['data']['sub_name']; ?></a>
					<p class="shop-tip"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['data']['name'],
  'b' => '0',
  'e' => '50',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?></p>
					<p class="sale-num">已售<?php echo $this->_var['data']['buy_count']; ?></p>
				</span>
				<span class="dl_time">
					有效期：<?php echo $this->_var['data']['end_time']; ?>
				</span>
				<span class="dl_price">
					<table>
						<td>
							<i class="current"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['data']['current_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?> <small style="font-size: 12px;">积分</small></i>
							<?php if ($this->_var['data']['origin_price'] > 0): ?><i>门市价<?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['data']['origin_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?><small style="font-size: 12px;">积分</small></i><?php else: ?><?php endif; ?>
						</td>
					</table>
				</span>
			<a href="<?php echo $this->_var['data']['url']; ?>" class="tuan-btn">立即抢购</a>
		</dd>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</dl>
	<?php if ($this->_var['total'] > $this->_var['page_size']): ?>
		<a href="javascript:void(0);" class="check-more j-check-more" url='<?php
echo parse_url_tag("u:index|ajax#store_load_supplier_deal|"."".""); 
?>'>
			查看更多
			<i class="iconfont">&#xe647;</i>
		</a>
		<input type="hidden" name="store_id" value="<?php echo $this->_var['store_id']; ?>">
		<input type="hidden" name="is_more" value="<?php echo $this->_var['is_more']; ?>">
	<?php endif; ?>
</div>
<?php endif; ?>