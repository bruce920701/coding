<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>
		<link rel="stylesheet" href="<?php echo $this->_var['TMPL']; ?>/style5.2/css/dist/media-100.css" />
		<script src="<?php echo $this->_var['TMPL']; ?>/style5.2/js/dist/jquery-3.2.1.min.js"></script>
		<title>业绩明细</title>
	</head>
	<body>
		<div class="mechanism_nav">
			<p><a href="<?php echo $this->_var['url']; ?>" class="back"></a>业绩明细</p>
		</div>
		<div class="silver">
			<div class="mechanism_head">
				<div class="img_head">
					<a href="javascript:;">
						<img src="<?php echo $this->_var['user_avatar']; ?>" class="img_t" style="border-radius: 50%;"/>
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/angel.png" class="img_b"/>
						<p><?php echo $this->_var['user_info']['user_level']; ?></p>
					</a>
				</div>
				<div class="mechanism_name">
					<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/jg.png"/>
					<div class="mechanism_name_title">
						<p>昵称:<span><?php echo $this->_var['user_info']['user_name']; ?></span></p>
						<p>ID:<span><?php echo $this->_var['user_info']['id']; ?></span></p>
					</div>
				</div>
			</div>
			<div class="silver_title">
				<p class="left">伞下业绩<i></i></p>
				<!--<p class="center">
					<span class="silver_span none">今日</span>
				 	<span class="none">上一周</span>
				 	<span class="none">近一个月</span>
				</p>
				<p class="right">
					<i></i>筛选
				</p>-->
			</div>
			<div class="mechanism_data">
				<ul>
					<li>
						<a href="javascript:;" style="opacity: 0;"></a>
						<span>昵称</span>
						<span>ID</span>
						<span>上周新增业绩</span>
						<span style="color: #000;">总业绩</span>
					</li>
					
						<?php $_from = $this->_var['detail_data']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item1');if (count($_from)):
    foreach ($_from AS $this->_var['item1']):
?>
						<li id="get<?php echo $this->_var['item1']['id']; ?>">
							<a onclick="fang(event)" href="javascript:;"></a>
							<button type="button"></button>
							<span><?php echo $this->_var['item1']['name']; ?></span>
							<span><?php echo $this->_var['item1']['id']; ?></span>
							<span><?php echo $this->_var['item1']['last_7_consume']; ?></span>
							<span><?php echo $this->_var['item1']['total_consume']; ?></span>
						</li>
						<script>
								//获取孙子并展示
//								$("#get<?php echo $this->_var['item1']['id']; ?>>button").click(function(){
								$(document).on("click","#get<?php echo $this->_var['item1']['id']; ?>>button",function(){
									var id = <?php echo $this->_var['item1']['id']; ?>;
									$(this).prev().toggleClass("ssa");
									$(this).addClass('none');
									$.ajax({
										url:"index.php?ctl=uc_log&act=get_node_detail&id="+id,
										type:"post",
										data:"",
										async:true,
										dataType:"json",
										success:function(data){
											console.log(data);
											var obj = data.market_detail;
											console.log(obj);
											var $ul = $("<ul class='erji'></ul>");
											$ul.appendTo($("#get<?php echo $this->_var['item1']['id']; ?>"));
											for(var m = 0;m<obj.length;m++){
												var erjiId = "erji"+obj[m].id;
												$li = $("<li><a onclick='fang(event)' href='javascript:;'></a><button  type='button' onclick='getfull(event)'></button><span>"+obj[m].name+"</span><span>"+obj[m].id+"</span><span>"+obj[m].last_7_consume+"</span><span>"+obj[m].total_consume+"</span></li>");
												$li.attr("id",erjiId);
												$li.attr("title",obj[m].id);
												$li.appendTo($ul);
											}
										}
									})
								})
								//获取孙子所有后代展示
								function getfull(event){
									$obj = $(event.target);
									var id1 = $obj.parent().attr("title");
									$obj.addClass("none");
									$obj.prev().toggleClass("ssa");
									$.ajax({
										url:"index.php?ctl=uc_log&act=get_node_detail&id="+id1,
										type:"post",
										data:"",
										async:true,
										dataType:"json",
										success:function(data){
											var obj = data.market_detail;
											var $ul = $("<ul class='erji'></ul>");
											$ul.appendTo($obj.parent());
											for(var m = 0;m<obj.length;m++){
												var erjiId = "erji"+obj[m].id;
												$li = $("<li><a onclick='fang(event)' href='javascript:;'></a><button  type='button' onclick='getfull(event)'></button><span>"+obj[m].name+"</span><span>"+obj[m].id+"</span><span>"+obj[m].last_7_consume+"</span><span>"+obj[m].total_consume+"</span></li>");
												$li.attr("id",erjiId);
												$li.attr("title",obj[m].id);
												$li.appendTo($ul);
											}
										}
									})
								}
							</script>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						
				</ul>
				<p>暂无更多数据</p>
			</div>
		</div>
		
	</body>
	
	<script>
		function fang(event){
			$eve = $(event.target);
			$eve.parent('li').children(".erji").toggleClass("none");
			$eve.toggleClass("ssa");
		}
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
//		$(document).on("click",".mechanism_data ul li a",function(){
//			$(this).parent('li').children(".erji").toggleClass("none");
//			$(this).toggleClass("ssa");
//		})
		$(window).ready(function(){
			//升级条件
			var level = $(".img_head a p").text();
			if(level == 0){
				$(".img_head a p").text("消费者");
			}else if(level == 1){
				$(".img_head a p").text("一级代理");
			}
			else if(level == 2){
				$(".img_head a p").text("二级代理");
			}
			else if(level == 3){
				$(".img_head a p").text("三级代理");
			}
			else if(level == 4){
				$(".img_head a p").text("四级代理");
			}
			else if(level == 5){
				$(".img_head a p").text("五级代理");
			}
			else if(level == 6){
				$(".img_head a p").text("六级代理");
			}
			else if(level == 7){
				$(".img_head a p").text("董事");
			} 
		})
		
	</script>
</html>
