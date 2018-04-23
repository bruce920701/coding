<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
$(document).ready(function() {
	init_list_scroll_bottom();//下拉刷新加载
});
var ajax_url='<?php
echo parse_url_tag("u:index|uc_money#del_bank|"."".""); 
?>';
var r_url="<?php
echo parse_url_tag("u:index|uc_account#phone|"."".""); 
?>";
function ac_phone(){
	var phone=$("#phonenumer").val();
	if(phone == ''){
		setTimeout(function(){
			location.href = r_url;
		},1500);
	}
}
</script>
<div class="page page-current" id="uc_banklist">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
 		<!-- 页面主体 -->
 		<div class="j-ajaxlist">
		    <?php if ($this->_var['bank_list']): ?>
		 		<ul class="bank-list j-ajaxadd">
		 	<?php $_from = $this->_var['bank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'bank_list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['bank_list']):
?>
		      <li class="flex-box b-line" data-id="<?php echo $this->_var['bank_list']['id']; ?>">
		        <div class="bank-info flex-1">
		          <p class="bank-name"><?php echo $this->_var['bank_list']['bank_name_r']; ?></p>
		          <p class="user-info"><?php echo $this->_var['bank_list']['bank_user_r']; ?></p>
		        </div>
		        <i class="iconfont del">&#xe601;</i>
		      </li>
		     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		    </ul>
		    <?php else: ?>
		    <div class="tipimg no_data">很抱歉，您暂无绑定银行卡！</div>
		    <?php endif; ?>
		    <div class="pages hide"><?php echo $this->_var['pages']; ?></div>
    	</div>
 </div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>