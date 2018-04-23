<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index page-current" id="uc_msg_index">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content uc_msg_change">
		<div class="m-msg-con">
			<a href="<?php if ($this->_var['msg']['delivery']['url']): ?><?php echo $this->_var['msg']['delivery']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>" class="msg-type b-line flex-box  vshow" data-no-cache="true">
				<div class="msg-num">
					<i class="type-icon iconfont icon-1">&#xe66d;</i>
					<?php if ($this->_var['msg']['delivery']['unread'] > 0): ?><em><?php if ($this->_var['msg']['delivery']['unread'] > 9): ?>9+<?php else: ?><?php echo $this->_var['msg']['delivery']['unread']; ?><?php endif; ?></em><?php endif; ?>
				</div>
				<div class="flex-1 msg-type-con">
					<div class="lab-date">
						<em>物流消息</em>
						<em class="date"><?php echo $this->_var['msg']['delivery']['create_time']; ?></em>
					</div>
					<div class="msg-con "><?php if ($this->_var['msg']['delivery']): ?><?php if ($this->_var['msg']['delivery']['title']): ?><?php echo $this->_var['msg']['delivery']['title']; ?>! <?php endif; ?><?php echo $this->_var['msg']['delivery']['content']; ?><?php else: ?>暂无消息<?php endif; ?></div>
				</div>
			</a>
			<a href="<?php if ($this->_var['msg']['notify']['url']): ?><?php echo $this->_var['msg']['notify']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>" class="msg-type flex-box b-line  vshow" data-no-cache="true">
				<div class="msg-num">
					<i class="type-icon iconfont icon-2">&#xe68a;</i>
					<?php if ($this->_var['msg']['notify']['unread'] > 0): ?><em><?php if ($this->_var['msg']['notify']['unread'] > 9): ?>9+<?php else: ?><?php echo $this->_var['msg']['notify']['unread']; ?><?php endif; ?></em><?php endif; ?>
				</div>
				<div class="flex-1 msg-type-con">
					<div class="lab-date">
						<em>通知消息</em>
						<em class="date"><?php echo $this->_var['msg']['notify']['create_time']; ?></em>
					</div>
					<div class="msg-con "><?php if ($this->_var['msg']['notify']): ?><?php if ($this->_var['msg']['notify']['title']): ?><?php echo $this->_var['msg']['notify']['title']; ?>! <?php endif; ?><?php echo $this->_var['msg']['notify']['content']; ?><?php else: ?>暂无消息<?php endif; ?></div>
				</div>
			</a>
			<a href="<?php if ($this->_var['msg']['account']['url']): ?><?php echo $this->_var['msg']['account']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>" class="msg-type flex-box b-line vshow" data-no-cache="true">
				<div class="msg-num">
					<i class="type-icon iconfont icon-3">&#xe66e;</i>
					<?php if ($this->_var['msg']['account']['unread'] > 0): ?><em><?php if ($this->_var['msg']['account']['unread'] > 9): ?>9+<?php else: ?><?php echo $this->_var['msg']['account']['unread']; ?><?php endif; ?></em><?php endif; ?>
				</div>
				<div class="flex-1 msg-type-con">
					<div class="lab-date">
						<em>资产消息</em>
						<em class="date"><?php echo $this->_var['msg']['account']['create_time']; ?></em>
					</div>
					<div class="msg-con "><?php if ($this->_var['msg']['account']): ?><?php if ($this->_var['msg']['account']['title']): ?><?php echo $this->_var['msg']['account']['title']; ?>! <?php endif; ?><?php echo $this->_var['msg']['account']['content']; ?><?php else: ?>暂无消息<?php endif; ?></div>
				</div>
			</a>
			<a href="<?php if ($this->_var['msg']['confirm']['url']): ?><?php echo $this->_var['msg']['confirm']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>" class="msg-type flex-box b-line vshow" data-no-cache="true">
				<div class="msg-num">
					<i class="type-icon iconfont icon-4">&#xe677;</i>
					<?php if ($this->_var['msg']['confirm']['unread'] > 0): ?><em><?php if ($this->_var['msg']['confirm']['unread'] > 9): ?>9+<?php else: ?><?php echo $this->_var['msg']['confirm']['unread']; ?><?php endif; ?></em><?php endif; ?>
				</div>
				<div class="flex-1 msg-type-con">
					<div class="lab-date">
						<em>验证消息</em>
						<em class="date"><?php echo $this->_var['msg']['confirm']['create_time']; ?></em>
					</div>
					<div class="msg-con "><?php if ($this->_var['msg']['confirm']): ?><?php if ($this->_var['msg']['confirm']['title']): ?><?php echo $this->_var['msg']['confirm']['title']; ?>! <?php endif; ?><?php echo $this->_var['msg']['confirm']['content']; ?><?php else: ?>暂无消息<?php endif; ?></div>
				</div>
			</a>
		</div>
	</div>
</div>
<script type="text/javascript">
/*$(document).ready(function(){
	setTimeout(function(){
		$(".msg-type").eq(0).addClass("vshow");
	},200);
	setTimeout(function(){
		$(".msg-type").eq(1).addClass("vshow");
	},400);
	setTimeout(function(){
		$(".msg-type").eq(2).addClass("vshow");
	},600);
	setTimeout(function(){
		$(".msg-type").eq(3).addClass("vshow");
	},800);
});*/
</script>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>