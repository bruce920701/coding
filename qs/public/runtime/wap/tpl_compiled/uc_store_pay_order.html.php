<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>
		<link rel="stylesheet" href="<?php echo $this->_var['TMPL']; ?>/style5.2/css/dist/media-100.css" />
		<title>业绩明细</title>
	</head>
	<body>
		<div class="mechanism_nav">
			<p><a href="javascript:history.go(-1);" class="back"></a>业绩明细</p>
		</div>
		<div class="silver">
			<div class="mechanism_head">
				<div class="img_head">
					<a href="javascript:;">
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/head.png" class="img_t"/>
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/angel.png" class="img_b"/>
						<p>消费者</p>
					</a>
				</div>
				<div class="mechanism_name">
					<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/jg.png"/>
					<div class="mechanism_name_title">
						<p>昵称:<span>诺菲之恋</span></p>
						<p>ID:<span>7798</span></p>
					</div>
				</div>
			</div>
			<div class="silver_title">
				<p class="left">伞下业绩<i></i></p>
				<p class="center">
					<span class="silver_span none">今日</span>
				 	<span class="none">上一周</span>
				 	<!--<span class="none">近一个月</span>-->
				</p>
				<p class="right">
					<i></i>筛选
				</p>
			</div>
			<div class="mechanism_data">
				<ul>
					<li>
						<a href="javascript:;" style="opacity: 0;"></a>
						<span>昵称</span>
						<span>ID</span>
						<span style="border-right: 1px solid #eee;color: #000;">上周新增业绩</span>
						<span style="color: #000;">总业绩</span>
					</li>
					<li>
						<a href="javascript:;"></a>
						<span>诺菲之恋</span>
						<span>3215</span>
						<span>68213252</span>
						<span>1168213252</span>
						<ul class="erji none">
							<li>
								<a href="javascript:;"></a>
								<span>诺菲之恋</span>
								<span>3215</span>
								<span>68213252</span>
								<span>1168213252</span>
								<ul class="erji none">
									<li>
										<a href="javascript:;"></a>
										<span><i></i>诺菲之恋</span>
										<span>3215</span>
										<span>68213252</span>
										<span>1168213252</span>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!--<li>
						<a href="javascript:;"></a>
						<span>诺菲之恋</span>
						<span>3215</span>
						<span>68213252</span>
						<span>1168213252</span>
					</li>-->
				</ul>
				<p>暂无更多数据</p>
			</div>
		</div>
		
	</body>
	<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/jquery-3.2.1.min.js"></script>
	<script>
		$(".silver_title .right").click(function(){
			$(this).toggleClass("silver_open");
			$(".silver_title .center span").toggleClass("none")
		})
		$(".silver_title .center span").click(function(){
			$(this).addClass("silver_span").siblings().removeClass("silver_span");
		})
		$(".mechanism_nav,.mechanism_head,.left,.mechanism_data").click(function(){
			$(".silver_title .center span").addClass("none");
			$(".silver_title .right").removeClass("silver_open");
		})
		$(document).on("click",".mechanism_data ul li a",function(){
				$(this).parent('li').children(".erji").toggleClass("none");
				$(this).toggleClass("ssa");
			})
	</script>
</html>
