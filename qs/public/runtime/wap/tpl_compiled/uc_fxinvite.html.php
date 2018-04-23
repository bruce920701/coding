<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-current" id="uc_fxinvite">

  <!--<?php echo $this->fetch('style5.2/inc/module/fx_nav.html'); ?>-->

	<div class="content infinite-scroll infinite-scroll-bottom">
        <div class="buttons-tab bar-nav uc_fxinvite_head">
			<?php if ($this->_var['page_finsh']): ?>
			<a class="header-btn header-left iconfont" href="javascript:App.page_finsh();">&#xe604;</a>
			<?php else: ?>
			<a class="header-btn header-left iconfont <?php if ($this->_var['back_url']): ?>go_back<?php else: ?>back<?php endif; ?>" <?php if ($this->_var['back_url']): ?>data-no-cache="true"<?php endif; ?> href="">&#xe604;</a>
			<?php endif; ?>
            <a style="border: none;" data-no-cache="true" class=" button <?php if (ACTION_NAME == 'index'): ?>active<?php endif; ?> " href="<?php
echo parse_url_tag("u:index|uc_fxinvite|"."".""); 
?>"><span>申请报单中心</span></a>
        </div>
        <!--申请报单之前-->
        <div class="sqbd_con none zt_con">
        	<form action="">
	        	<p>申请人信息</p>
	        	<p><span>姓名</span><input type="text" placeholder="请输入您的姓名" class="apply_info"/></p>
	        	<p><span>身份证号</span><input type="text" placeholder="请输入您的身份证号" class="apply_info"/></p>
	        	<button class="apply_btn">确认</button>
        	</form>
        </div>
        <script>
        	//判断显示内容
						$(window).ready(function(){
								var xs_status = <?php echo $this->_var['bdzx_status']; ?>;
								$(".zt_con").eq(xs_status).removeClass("none").siblings("zt_con").addClass("none");
							})
        	$(document).on("click",".apply_btn",function(){
        		var apply_info = $(".apply_info");
        		for(var j = 0;j<apply_info.length;j++){
//      			var applys_info = apply_info.eq(j).val();
        			if(apply_info.eq(j).val() == ""){
        				apply_info.eq(j).parent().addClass("pRed p_input");
        				return false;
        			}else{
        				$.ajax({
									url:'index.php?ctl=uc_log&act=do_request_bdzx',
									type:"post",
									data:{"user_name":user_name,"user_id_card":user_id_card},
									dataType:"json",
									success:function(data){
//											alert(456);
										if(data.status == false){
											alert(data.info);
											return false;
										}else{
											
										}
									}
								})
        			}
        		}
        	})
        	$(document).on("focus",".sqbd_con input",function(){
        		$(".sqbd_con input").parent().removeClass("pRed p_input")
        	})
        </script>
        <!--审核中-->
        <div class="zt_con none">
        		<div class="sh_img">
        			<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/shz.png"/>
        		</div>
        		<p class="shz_tit">审核中...</p>
        </div>
        <!--申请报单之后-->
        <div class="sqbd_after none zt_con">
        	<p class="bdTit">报单业绩<i><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/dingdan.png"/></i></p>
        	<div class="bdCon">
        		<p><span>ID</span><span>新增业绩</span><span>业绩提成</span><span>状态</span></p>
        		<ul>
        			<?php $_from = $this->_var['bdzx_reward_detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'myData');if (count($_from)):
    foreach ($_from AS $this->_var['myData']):
?>
        			<li>
        				<span><?php echo $this->_var['myData']['m_id']; ?></span>
        				<span><?php echo $this->_var['myData']['m_id']; ?></span>
        				<span><?php echo $this->_var['myData']['credits']; ?></span>
        				<span><?php echo $this->_var['myData']['status']; ?></span>
        			</li>
        			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        		</ul>
        	</div>
        	<script>
        		$(window).ready(function(){
        			var textObj = $('.bdCon ul li span:last-child');
        			for(var i = 0; i<textObj.length;i++){
        				var text = textObj.eq(i).text();
        				if(text == "1"){
        					textObj.eq(i).text("已释放")
        					textObj.eq(i).css("color","#379f34");
        				}else if(text =="0"){
        					textObj.eq(i).text("冻结中")
        					textObj.eq(i).css("color","#f56e07");
        				}
        			}
        		})
        	</script>
        </div>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>