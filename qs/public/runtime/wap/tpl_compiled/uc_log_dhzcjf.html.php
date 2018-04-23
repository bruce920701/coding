<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<style>
	.mx_con {
		float: left;
		width: 100%;
	}
	.mx_con p{
		float: left;
		width: 100%;
		height: 2.2rem;
		background-color: #f24;
		color: #fff;
	}
	.mx_con p span{
		float: left;
		width: 25%;
		height: 2.2rem;
		line-height: 2.2rem;
		text-align: center;
	}
	.mx_con p span:nth-child(3){
		width: 17%;
	}
	.mx_con p span:nth-child(4){
		width: 33%;
	}
	.mx_con .jf{
		float: left;
		width: 100%;
		height: 20rem;
		overflow: auto;
		background-color: #fff;
	}
	.mx_con .jf li{
		float: left;
		width: 100%;
		height: 2.2rem;
		border-bottom: 1px solid #eee;
	}
	.mx_con .jf li span{
		float: left;
		width: 25%;
		height: 2.2rem;
		line-height: 2.2rem;
		text-align: center;
		font-size: .5rem;
	}
	.mx_con .jf li span:last-child{
		line-height: 1rem;
		width: 33%;
		padding-left: 2%;
	}
	.mx_con .jf li span:nth-child(3){
		line-height: 1rem;
		width: 17%;
	}
</style>
<div class="page page-index page-current" id="uc_share">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content" style="margin-bottom: 1rem;">
		<div class="hzCon hzjf">
			<a href="javascript:;">分享积分转注册积分</a>
			<div class="jf none">
				<form action="">
					<p class="fx">分享积分余额: <b><?php echo $this->_var['user_info']['avalible_share_credits']; ?></b></p>
					<p><span>转出数量:</span><input type="text" placeholder="在此输入转出数量" class="info2"/></p>
					<button class="jf_btn">确认转出</button>
				</form>
			</div>
		</div>
		<div class="hzCon hzjhm">
			<a href="javascript:;">受益积分转注册积分</a>
			<div class="jf none">
				<form action="">
					<p class="sy">受益积分余额: <b><?php echo $this->_var['user_info']['avalible_benefit_credits']; ?></b></p>
					<p><span>转出数量:</span><input type="text" placeholder="在此输入转出数量" class="infos2"/></p>
					<button class="jhm_btn">确认转出</button>
				</form>
			</div>
		</div>
		<div class="mx_con" style="float: left;">
			<p style="margin: 0;">
				<span>类型</span>
				<span>转出数量</span>
				<span>转出时间</span>
				<span>详情</span>
			</p>
			<ul class="jf">
				<?php $_from = $this->_var['translate_detail_self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item1');if (count($_from)):
    foreach ($_from AS $this->_var['item1']):
?>
				<li>
					
					<span><?php echo $this->_var['item1']['type']; ?></span>
					<span><?php echo $this->_var['item1']['num']; ?></span>
					<span><?php echo $this->_var['item1']['time']; ?></span>
					<span><?php echo $this->_var['item1']['msg']; ?></span>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
	<script>
		
		//显示转出操作
		$(document).on("click",".hzCon a",function(){
			$(this).toggleClass("con_bottom");
			$(this).next().toggleClass("none");
		});
		//转出积分
		$(document).on("click",".jf_btn",function(){
			var fx = $(".fx b").text();
			if($(".info2").val() == ""){
				$(".info2").parent().addClass("pRed input_red");
				return false;
			}else if($(".info2").val() > fx){
				$(".info2").parent().addClass("pRed input_red");
				$(".info2").val("");
				$(".info2").attr("placeholder","分享积分余额小于转出数量")
				return false;
			}else{
				var fx_b = $('.info2').val();
				$.ajax({
					url:"index.php?ctl=uc_log&act=to_register_credits&type=share",
					type:"post",
					data:{"num":fx_b},
					dataType:"json",
					success:function(data){
						if(data.status == 0){
							alert(data.info);
							return false;
						}else{
							alert(data.info);
							window.location.reload();
						}
					}
				})
			}
		});
		//转出激活码
		$(document).on("click",".jhm_btn",function(){
			var sy = parseFloat($(".sy b").text());
			if($(".infos2").val() == ""){
				$(".infos2").parent().addClass("pRed input_red");
				return false;
			}else if($(".infos2").val() > sy){
				$(".infos2").parent().addClass("pRed input_red");
				$(".info2").val("");
				$(".infos2").attr("placeholder","受益积分余额小于转出数量");
				return false;
			}else{
				var sy_b = parseFloat($(".infos2").val());
				$.ajax({
					url:"index.php?ctl=uc_log&act=to_register_credits&type=benefit",
					type:"post",
					data:{"num":sy_b},
					dataType:"json",
					success:function(data){
						if(data.status == 0){
							alert(data.info);
							return false;
						}else{
							alert(data.info);
							window.location.reload();
						}
					}
				})
			}
		})
		//时间戳转换
		$(window).ready(function(){
			var time = $(".mx_con ul li span:nth-child(3)");
			var type = $(".mx_con ul li span:nth-child(1)");
			for(var i = 0;i<time.length;i++){
				times = time.eq(i).text();
				types = type.eq(i).text();
				var t = new Date(times*1000);
				var year = t.getFullYear();
				var month = t.getMonth()+1;
				var day = t.getDate();
				var hour = t.getHours();
				var min = t.getMinutes();
				var sen = t.getSeconds();
				t = year + "/"+getzf(month)+"/"+getzf(day)+"-"+getzf(hour)+":"+getzf(min)+":"+getzf(sen);				
				time.eq(i).html(t);
				if(types == "self_t_share"){
					type.eq(i).text("分享积分");
				}else{
					type.eq(i).text("受益积分");
				}
			}
			//补0操作
			function getzf(num){
				if(parseInt(num)<10){
					num = "0"+num
				}
				return num;
			}
		})
		$(document).on("focus","input",function(){
			$(this).parent().removeClass('pRed input_red');
			$(".infos2").attr("placeholder","请输入转出数量")
		})
		
	</script>
</div>

<?php echo $this->fetch('style5.2/inc/footer.html'); ?>