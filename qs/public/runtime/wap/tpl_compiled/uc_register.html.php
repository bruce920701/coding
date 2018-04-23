<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index deal-page page-current" id="rsorder_index">
	<?php echo $this->fetch('style5.2/inc/headers/dc_header.html'); ?>
	<div class="content infinite-scroll infinite-scroll-bottom">
		<div class="zcCon">
			<!--<form action="" method="post">-->
				<p>申请人信息</p>
				<p><span>昵称</span><input type="text" placeholder="请输入昵称" class="user_name"/></p>
				<p><span>手机号码</span><input type="text" placeholder="请输入手机号码" class="mobile"/></p>
				<p>安置位置</p>
				<p><span>昵称</span><input type="text" placeholder="请输入昵称" class="name_1"/></p>
				<p><span>安置编号</span><input type="text" placeholder="请输入安置编号" class="s_id"/></p>
				<p>设置密码</p>
				<p><span>登录密码</span><input type="password" placeholder="请输入登录密码" class="user_pwd"/></p>
				<p><span>确认登录密码</span><input type="password" placeholder="请确认登录密码" class="user_pwd_confirm"/></p>
				<button type="button">确认</button>
			<!--</form>-->
		</div>
		<script>
//			$(document).on("click",".zcCon button",function(){
				$(".zcCon button").click(function(){
				var user_name = $(".user_name").val();
				var mobile = $(".mobile").val();
				var name_1 = $(".name_1").val();
				var s_id = $(".s_id").val();
				var user_pwd = $(".user_pwd").val();
				var user_pwd_confirm = $(".user_pwd_confirm").val();
				if(user_name == ""){
					$(".user_name").parent().addClass("pRed pError");
					return false;
				}if(mobile == ""){
					$(".mobile").parent().addClass("pRed pError");
					return false;
				}if(name_1 == ""){
					$(".name_1").parent().addClass("pRed pError");
					return false;
				}if(s_id == ""){
					$(".s_id").parent().addClass("pRed pError");
					return false;
				}if(user_pwd == ""){
					$(".user_pwd").parent().addClass("pRed pError");
					return false;
				}if(user_pwd_confirm == ""){
					$(".user_pwd_confirm").parent().addClass("pRed pError");
					return false;
				}else{
					$.ajax({
						type:"POST",
						url:"index.php?ctl=uc_register&act=doregister",
						data:{"user_name":user_name,"mobile":mobile,"name_1":name_1,"s_id":s_id,"user_pwd":user_pwd,"user_pwd_confirm":user_pwd_confirm},
						dataType:"json",
						success:function(data){
							if(data.status == true){
								alert("注册成功");
								window.location.reload();
							}
							else{
								alert(data.info);
								return false;
							}
						}
					});
				}
			});
			$(document).on("focus","input",function(){
				$(this).parent().removeClass("pRed pError");
			})
		</script>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>