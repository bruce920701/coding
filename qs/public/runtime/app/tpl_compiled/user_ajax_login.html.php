<?php
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
?>
<script>
	var VERIFICATION_CODE_URL='<?php
echo parse_url_tag("u:index|ajax#verification_code|"."".""); 
?>';
	$(document).ready(function(){
		$(".batch").click(function(){
			//选择验证码图标
			get_verification_code();
			
		});
	});
</script>
<?php echo $this->fetch('inc/login_box.html'); ?>