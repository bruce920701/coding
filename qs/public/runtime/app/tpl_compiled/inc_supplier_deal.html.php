<?php if ($this->_var['supplier_tuan_list']): ?>
<div class="other_tuan">
		<div class="three_title">
			<h3 class="f_l">该商家的其他团购</h3>
            <div class="subtitle f_r">
            	<span>团购价</span>
				<span>门店价</span>
				<span>已售</span>
            </div>
		</div>
		<ul class="other_list clearfix">
			<?php $_from = $this->_var['supplier_tuan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');$this->_foreach['supplier_tuan_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['supplier_tuan_list']['total'] > 0):
    foreach ($_from AS $this->_var['deal']):
        $this->_foreach['supplier_tuan_list']['iteration']++;
?>
			<li <?php if (($this->_foreach['supplier_tuan_list']['iteration'] <= 1)): ?>class="first"<?php endif; ?>>
				<a href="<?php echo $this->_var['deal']['url']; ?>">
					<span class="content f_l"><?php if ($this->_var['supplier_name']): ?>【<?php echo $this->_var['supplier_name']; ?>】<?php endif; ?><?php echo $this->_var['deal']['name']; ?></span>
					<span class="sale f_r"><?php echo $this->_var['deal']['buy_count']; ?></span>
					<span class="value f_r"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['origin_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?> <small style="font-size: 12px;">积分</small></span>
					<span class="pirce f_r"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['current_price'],
  'l' => '2',
);
echo $k['name']($k['v'],$k['l']);
?><small style="font-size: 12px;">积分</small></span>
				</a>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			
		</ul>
</div>
<?php if ($this->_var['total'] > $this->_var['page_size']): ?>
<div class="blank"></div>
<div class="pages"><?php echo $this->_var['pages']; ?></div>
<?php endif; ?>
<div class="blank"></div>
<?php endif; ?>