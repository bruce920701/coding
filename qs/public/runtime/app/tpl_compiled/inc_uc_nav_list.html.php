<div class="user_info_box clearfix">
	<div class="f_l avatar_box" style="margin-left: 43.5px;"><?php 
$k = array (
  'name' => 'show_avatar',
  'id' => $this->_var['user_info']['id'],
  'type' => 'small',
  'is_card' => '0',
);
echo $k['name']($k['id'],$k['type'],$k['is_card']);
?></div>
	<div class="f_r u_name" style="width: 100%;">
		<p>用户名: <span style="color: #f80;"><?php echo $this->_var['user_info']['user_name']; ?></span></p>
		<p>用户ID: <span style="color: #f80;"><?php echo $this->_var['user_info']['id']; ?></span></p>
		<div class="blank5"></div>
		<?php if ($this->_var['user_info']['is_merchant'] == 1): ?><span class="is_merchant" title="认证商家"></span><?php endif; ?><?php if ($this->_var['user_info']['is_daren'] == 1): ?><span class="is_daren" title="<?php echo $this->_var['user_info']['daren_title']; ?>"></span><?php endif; ?>
	</div>
</div>
<div class="nav_account_info clearfix">
		<a class="account_item item_l" href="javascript:;"><span>结算码数 :</span><?php echo $this->_var['user_info']['active_code']; ?></a>
		<a class="account_item item_r" href="javascript:;"><span>注册积分 :</span><?php echo $this->_var['user_info']['register_credits']; ?></a>
		<a class="account_item item_l" href="javascript:;"><span>受益积分 :</span><?php echo $this->_var['user_info']['avalible_benefit_credits']; ?></a>
		<a class="account_item item_r" href="javascript:;"><span>分享积分 :</span><?php echo $this->_var['user_info']['avalible_share_credits']; ?></a>
		<a class="account_item item_r" href="javascript:;"><span>消费积分 :</span><?php echo $this->_var['user_info']['avalible_consume_credits']; ?></a>
	</div>
<div class="side_nav">
<?php if ($this->_var['uc_nav_list']): ?>
<?php $_from = $this->_var['uc_nav_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('nav_key', 'nav_item');if (count($_from)):
    foreach ($_from AS $this->_var['nav_key'] => $this->_var['nav_item']):
?>
    <?php if ($this->_var['nav_key'] == "my_fx"): ?>
    <dl class="nav_item none">
		<a href="<?php echo $this->_var['nav_item']['url']; ?>" class="nav_item_title"><i class=""></i><?php echo $this->_var['nav_item']['name']; ?></a>
	</dl>
    <?php else: ?>
	<dl class="nav_item">
		<dt class="nav_item_title"><i class=""></i><?php echo $this->_var['nav_item']['name']; ?></dt>
		<?php $_from = $this->_var['nav_item']['node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('s_nav_key', 's_nav_item');if (count($_from)):
    foreach ($_from AS $this->_var['s_nav_key'] => $this->_var['s_nav_item']):
?>
			<dd><div class="s_item clearfix <?php if ($this->_var['s_nav_item']['current'] == 1): ?>current<?php endif; ?>"><i class="dot"></i>&nbsp;&nbsp;<a href="<?php echo $this->_var['s_nav_item']['url']; ?>"><?php echo $this->_var['s_nav_item']['name']; ?></a><i class="triangle"></i></div></dd>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</dl>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
<script>
	$(window).ready(function(){
		var status = <?php echo $this->_var['user_info']['active']; ?>;
		var nav_obj = $(".side_nav .nav_item dd");
		if(status == 0){
			for(var i = 0; i<nav_obj.length;i++){
				var text = nav_obj.eq(i).find("a").text();
				if(text == "注册会员"){
					nav_obj.eq(i).css("display","none");
				}
			}
		}
	})
</script>
<div class="blank20"></div>
</div>