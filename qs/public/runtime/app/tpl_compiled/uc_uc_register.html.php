<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/uc_invite.css";
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
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/fanwe_utils/jquery-1.8.1.js";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/login_panel.js";

$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_invite.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/uc/uc_invite.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/page_js/user_register.js";
?>
<?php echo $this->fetch('inc/header.html'); ?>
<script>
var MEDAL_BOX_URL = '<?php
echo parse_url_tag("u:index|uc_medal#load_medal|"."".""); 
?>';
</script>
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
		<div class="myJinDou">
			<div class="goPayHead">
				<p>注册会员 ></p>
			</div>
			<div class="blank20"></div>
			<!--<form action="<?php
echo parse_url_tag("u:index|uc_register#doregister|"."".""); 
?>" method="post" >-->
				<div class="zchy_con">
					<p class="zchy_tit">申请人信息</p>
					<p><span>昵称</span><input type="text" name="user_name" class="name" placeholder="请输入昵称"/></p>
					<p><span>手机号码</span><input type="text"  name="mobile" class="mobile" placeholder="请输入手机号"/></p>
					<p class="zchy_tit">安置位置</p>
					<p><span>昵称</span><input type="text" name="name_1" class="name1" placeholder="请输入昵称"/></p>
					<p><span>安置编号</span><input type="text" name="s_id" class="anzhi" placeholder="请输入安置编号"/></p>
					<p class="zchy_tit">设置密码</p>
					<p><span>登录密码</span><input type="password" name="user_pwd" class="pwd" placeholder="请输入登录密码"/></p>
					<p><span>确认登录密码</span><input type="password" name="user_pwd_confirm" class="pwds" placeholder="确认登录密码"/></p>
					<button class="tijiao" type="button" style="background-color: #f80;">确认</button>
				</div>
			<!--</form>-->
		</div>
	<script>
//提交

		$(".tijiao").click(function(){
			var user_name = $(".name").val();
			var mobile = $(".mobile").val();
			var name_1 = $(".name1").val();
			var s_id = $(".anzhi").val();
			var user_pwd = $(".pwd").val();
			var user_pwd_confirm = $(".pwds").val(); 
			$.ajax({
				type:"POST",
				url:"index.php?ctl=uc_register&act=doregister",
				data:{"user_name":user_name,"mobile":mobile,"name_1":name_1,"s_id":s_id,"user_pwd":user_pwd,"user_pwd_confirm":user_pwd_confirm},
				dataType:"json",
				success:function(data){
					if(data.status == false){
						alert(data.info);
						return false;
					}else{
						alert(data.info);
						window.location.reload();
					}
				},
				error:function(data){
					alert("注册失败");
				}
			})
		})
	</script>
	</div>
		
	</div>