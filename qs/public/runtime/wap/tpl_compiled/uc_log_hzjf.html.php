<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>

<div class="page page-index page-current" id="uc_share">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content" style="margin-bottom: 1rem;">
		<div class="hzCon hzjf">
			<a href="javascript:;">转出注册积分</a>
			<div class="jf none">
				<form action="">
					<p>注册积分余额: <b><?php echo $this->_var['user_info']['register_credits']; ?></b></p>
					<p><span>转出ID:</span><input type="text" placeholder="在此输入准确ID" class="info1"/></p>
					<p><span>转出数量:</span><input type="text" placeholder="在此输入转出数量" class="info2"/></p>
					<p><span>交易密码:</span><input type="password" placeholder="在此输入交易密码" class="info3"/></p>
					<!--<p>
						<span>验证码:</span>
						<input type="text" placeholder="在此输入验证码" class="info4"/>
						<input type="button" class="huoqu" value="获取验证码" onclick="timing()"/>
					</p>-->
					<button class="jf_btn" type="button">立即转出</button>
				</form>
			</div>
		</div>
		<div class="hzCon hzjhm">
			<a href="javascript:;">转出结算码</a>
			<div class="jf none">
				<form action="">
					<p>结算码个数: <b><?php echo $this->_var['user_info']['active_code']; ?></b></p>
					<p><span>转出ID:</span><input type="text" placeholder="在此输入准确ID" class="infos1"/></p>
					<p><span>转出数量:</span><input type="text" placeholder="在此输入转出数量" class="infos2"/></p>
					<p><span>交易密码:</span><input type="password" placeholder="在此输入交易密码" class="infos3"/></p>
					<!--<p>
						<span>验证码:</span>
						<input type="text" placeholder="在此输入验证码" class="infos4"/>
						<input type="button" class="huoqu1" value="获取验证码" onclick="timing1()"/>
					</p>-->
					<button class="jhm_btn" type="button">立即转出</button>
				</form>
			</div>
		</div>
		<div class="mingxi">
			<p>
				<a href="javascript:;" class="a_active">转积分明细</a>
				<a href="javascript:;">转结算码明细</a>
			</p>
			<div class="mx_con">
				<p class="title" style="margin: 0;">
					<span>转出ID</span>
					<span>转入ID</span>
					<span>转出数量</span>
					<span>转出时间</span>
					<span>详情</span>
				</p>
				<ul class="jf">
					<?php $_from = $this->_var['translate_detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item1');if (count($_from)):
    foreach ($_from AS $this->_var['item1']):
?>
					<li>
						<span><?php echo $this->_var['item1']['id']; ?></span>
						<span><?php echo $this->_var['item1']['to_id']; ?></span>
						<span><?php echo $this->_var['item1']['num']; ?></span>
						<span><?php echo $this->_var['item1']['time']; ?></span>
						<span><?php echo $this->_var['item1']['msg']; ?></span>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<ul class="jhm none">
					<?php $_from = $this->_var['translate_detail_active']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item2');if (count($_from)):
    foreach ($_from AS $this->_var['item2']):
?>
					<li>
						<span><?php echo $this->_var['item2']['id']; ?></span>
						<span><?php echo $this->_var['item2']['to_id']; ?></span>
						<span><?php echo $this->_var['item2']['num']; ?></span>
						<span><?php echo $this->_var['item2']['time']; ?></span>
						<span><?php echo $this->_var['item2']['msg']; ?></span>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
			</div>
			
		</div>
	</div>
	<script>
		//切换转账明细
		$(document).on('click',".mingxi p a",function(){
			var index = $(this).index();
			$(this).addClass("a_active").siblings().removeClass("a_active");
			$(".mx_con ul").eq(index).removeClass("none").siblings("ul").addClass("none");
		})
		//显示转出操作
		$(document).on("click",".hzCon a",function(){
			$(this).toggleClass("con_bottom");
			$(this).next().toggleClass("none");
		});
		//转出积分
		$(document).on("click",".jf_btn",function(){
			var to_id = $(".info1").val();
			var t_active_code = $(".info2").val();
			var trade_pwd = $(".info3").val();
			var code = $(".info4").val();
			if($(".info1").val() == ""){
				$(".info1").parent().addClass("pRed input_red");
				return false;
			}else if($(".info2").val() == ""){
				$(".info2").parent().addClass("pRed input_red");
				return false;
			}else if($(".info3").val() == ""){
				$(".info3").parent().addClass("pRed input_red");
				return false;
			}else{
				$.ajax({
					url:'index.php?ctl=uc_log&act=do_translate_credits',
					type:"post",
					data:{"to_id":to_id,"t_active_code":t_active_code,"trade_pwd":trade_pwd},
					dataType:"json",
					success:function(data){
						if(data.status == false){
							alert(data.info);
							return false;
						}else{
							alert("转出成功!!!");
							window.location.reload();
						}
						
					}
				})
			}
		});
		//转出结算码
		$(document).on("click",".jhm_btn",function(){
			var t_id = $(".infos1").val();
			var t_credits = $(".infos2").val();
			var trade_pwd1 = $(".infos3").val();
//			var code1 = $(".infos4").val();
			if($(".infos1").val() == ""){
				$(".infos1").parent().addClass("pRed input_red");
				return false;
			}else if($(".infos2").val() == ""){
				$(".infos2").parent().addClass("pRed input_red");
				return false;
			}else if($(".infos3").val() == ""){
				$(".infos3").parent().addClass("pRed input_red");
				return false;
			}else{
				$.ajax({
					url:'index.php?ctl=uc_log&act=do_translate_active_code',
					type:"post",
					data:{"t_id":t_id,"t_credits":t_credits,"trade_pwd":trade_pwd1},
					dataType:"json",
					success:function(data){
//									console.log(data);
						if(data.status == false){
							alert(data.info);
							return false;
						}else{
							alert("转出成功!!!");
							window.location.reload();
						}
						
					}
				})
				
			}
		})
		$(document).on("focus","input",function(){
			$(this).parent().removeClass('pRed input_red')
		})
		//获取验证码倒计时1
		var times=60; 
		function timing() {
			if (times == 0) { 
				$(".huoqu").attr("disabled",false);
				$(".huoqu").val("重新获取"); 
				$(".huoqu") = 60; 
				return;
			} else { 
				$(".huoqu").attr("disabled", true); 
				$(".huoqu").val("重新发送" + times + "s"); 
				times--; 
				setTimeout(function() { 
					timing() 
				},1000) 
			} 
		}
		//获取验证码倒计时2
		var times1=60; 
		function timing1() {
			if (times1 == 0) { 
				$(".huoqu1").attr("disabled",false);
				$(".huoqu1").val("重新获取"); 
				$(".huoqu1") = 60; 
				return;
			} else { 
				$(".huoqu1").attr("disabled", true); 
				$(".huoqu1").val("重新发送" + times1 + "s"); 
				times1--; 
				setTimeout(function() { 
					timing1() 
				},1000) 
			} 
		} 
		//时间戳转换
		$(window).ready(function(){
			var time = $(".mx_con ul li span:nth-child(4)");
			for(var i = 0;i<time.length;i++){
				times = time.eq(i).text();
				var t = new Date(times*1000);
				var year = t.getFullYear();
				var month = t.getMonth()+1;
				var day = t.getDate();
				var hour = t.getHours();
				var min = t.getMinutes();
				var sen = t.getSeconds();
				t = year + "/"+getzf(month)+"/"+getzf(day)+"-"+getzf(hour)+":"+getzf(min)+":"+getzf(sen);				
				time.eq(i).html(t);
			}
			//补0操作
			function getzf(num){
				if(parseInt(num)<10){
					num = "0"+num
				}
				return num;
			}
		})
	</script>
</div>

<?php echo $this->fetch('style5.2/inc/footer.html'); ?>