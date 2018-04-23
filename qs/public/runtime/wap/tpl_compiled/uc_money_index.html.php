<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-current" id="uc_money_index">
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="content uc_money_change">
		<!--<div class="uc-money flex-box">
			<div class="uc-money-info">
				<p class="uc-money-tip">账户余额（元）</p>
				<p class="uc-money-num"><?php echo $this->_var['data']['money']; ?></p>
			</div>
		</div>-->
		<ul class="uc-money-list">
			<li class="b-line">
				<a href="<?php
echo parse_url_tag("u:index|uc_money#money_log|"."".""); 
?>" class="flex-box" data-no-cache="true">
					<svg class="icon" aria-hidden="true">
						<use xlink:href="#icon-k"></use>
					</svg>
					<p class="list-item flex-1">资金明细</p>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
			<li class="b-line">
				<a href="<?php
echo parse_url_tag("u:index|uc_money#withdraw_bank_list|"."".""); 
?>" class="flex-box" data-no-cache="true">
					<i class="iconfont special-ico withdraw">&#xe66e;</i>
					<p class="list-item flex-1">提币</p>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
			<!--<li class="b-line">
				<a href="<?php
echo parse_url_tag("u:index|uc_charge#index|"."".""); 
?>" class="flex-box" data-no-cache="true">
					<svg class="icon" aria-hidden="true">
						<use xlink:href="#icon-yue1"></use>
					</svg>
					<p class="list-item flex-1">充值</p>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>-->
			<li>
				<a href="<?php
echo parse_url_tag("u:index|uc_money#withdraw_log|"."".""); 
?>" class="flex-box" data-no-cache="true">
					<i class="iconfont special-ico" style="color:#86cf4b">&#xe8cf;</i>
					<p class="list-item flex-1">提币明细</p>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
		</ul>
		<ul class="uc-money-list">
			<li>
				<a href="<?php
echo parse_url_tag("u:index|uc_money#banklist|"."".""); 
?>" class="flex-box" data-no-cache="true">
					<i class="iconfont special-ico bank-list">&#xe8d3;</i>
					<p class="list-item flex-1">我的银行卡</p>
					<p class="bank-list-tip"><?php if ($this->_var['data']['bank']): ?><?php echo $this->_var['data']['bank']; ?><?php else: ?>未绑定<?php endif; ?></p>
					<i class="iconfont right-arrow">&#xe607;</i>
				</a>
			</li>
		</ul>
	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>