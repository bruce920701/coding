<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index page-current" id="uc_collect">
	<script>
		var ajax_url='<?php
echo parse_url_tag("u:index|uc_collect#del_collect|"."".""); 
?>';
		var sc_status=<?php echo $this->_var['data']['sc_status']; ?>;
		console.log(sc_status);
		var url=new Array();
		url[0] = '<?php
echo parse_url_tag("u:index|uc_collect|"."sc_status=0".""); 
?>';
		url[1] = '<?php
echo parse_url_tag("u:index|uc_collect|"."sc_status=1".""); 
?>';
		url[2] = '<?php
echo parse_url_tag("u:index|uc_collect|"."sc_status=2".""); 
?>';
		url[3] = '<?php
echo parse_url_tag("u:index|uc_collect|"."sc_status=3".""); 
?>';
	</script>
	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
	<div class="flex-box m-tab-btn-list b-line" data-isedit="0">
	

	
		<?php $_from = $this->_var['data']['collect_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'collect');if (count($_from)):
    foreach ($_from AS $this->_var['collect']):
?>
			<div class="flex-1 j-tab-btn <?php if ($this->_var['data']['sc_status'] == $this->_var['collect']['sc_status']): ?>active<?php endif; ?>" rel="<?php echo $this->_var['collect']['sc_status']; ?>" <?php if ($this->_var['data']['sc_status'] == $this->_var['collect']['sc_status']): ?>data-isload="1"<?php else: ?>data-isload="0"<?php endif; ?>><em><?php echo $this->_var['collect']['name']; ?></em></div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<div class="bottom-line"></div>
	</div>
	<div class="m-operation flex-box">
		<div class="check-box j-all-check" rel="0"><i class="iconfont"></i></div>全选
		<i class="cancel j-cancel" rel="0">取消收藏</i>
	</div>
	<div class="content uc_collect_change infinite-scroll infinite-scroll-bottom">

	<?php if ($this->_var['data']['sc_status'] == 0): ?>
		<div class="j_ajaxlist_<?php echo $this->_var['data']['sc_status']; ?> m-collect-list" rel="0" data-type="deal"  id="tb0"> 
		<ul class="j_ajaxadd_<?php echo $this->_var['data']['sc_status']; ?>" >
			<?php if ($this->_var['list']): ?>
				<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');if (count($_from)):
    foreach ($_from AS $this->_var['deal']):
?>
					<li class="flex-box collect-item <?php if ($this->_var['deal']['out_time']): ?>isOver<?php endif; ?>" data-isdel="0">
						<div class="no-href hide"></div>
						<div class="check-box j-check-box" data-id="<?php echo $this->_var['deal']['id']; ?>"><i class="iconfont"></i></div>
							<a href="<?php echo $this->_var['deal']['url']; ?>" data-no-cache="ture"><img src="<?php echo $this->_var['deal']['icon']; ?>" alt="" class="collect-img"></a>
							<div class="flex-1">
								<a href="<?php echo $this->_var['deal']['url']; ?>">
									<div class="collect-name"><?php echo $this->_var['deal']['name']; ?></div>
									<div class="collect-price"><em><?php echo $this->_var['deal']['current_price']; ?></em>积分</div>
								</a>
							</div>
						
						<?php if ($this->_var['deal']['out_time']): ?>
							<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/icon-sold-out.png" alt="" class="icon-sold-out">
							<!-- <img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/events_sale_out.png" alt="" class="icon-sold-out"> 已结束-->
							<!-- <img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/youhui-sold-out.png" alt="" class="icon-sold-out"> 已抢光-->
						<?php endif; ?>
					</li>
				
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<?php else: ?>
				<div class="tipimg no_data">
					暂无收藏
				</div>
			<?php endif; ?>
		</ul>
		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
	<?php endif; ?>
	<!-- <?php if ($this->_var['data']['sc_status'] == 1): ?>
		<div class="j_ajaxlist_<?php echo $this->_var['data']['sc_status']; ?> m-collect-list"  rel="1" data-type="youhui" id="tb1">
		<ul class=" j_ajaxadd_<?php echo $this->_var['data']['sc_status']; ?>" >
		<?php if ($this->_var['list']): ?>
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'youhui');if (count($_from)):
    foreach ($_from AS $this->_var['youhui']):
?>
				<li <?php if ($this->_var['youhui']['out_time']): ?>class="flex-box collect-item isOver" <?php else: ?>class="flex-box collect-item" <?php endif; ?>>
					<div class="no-href hide"></div>
					<div class="check-box j-check-box" data-id="<?php echo $this->_var['youhui']['id']; ?>"><i class="iconfont"></i></div>
					<a href="<?php echo $this->_var['youhui']['url']; ?>" data-no-cache="ture"><img src="<?php echo $this->_var['youhui']['icon']; ?>" alt="" class="collect-img"></a>
					<div class="flex-1">
						<a href="<?php echo $this->_var['youhui']['url']; ?>">
							<div class="collect-name"><?php echo $this->_var['youhui']['name']; ?></div>
							<?php if ($this->_var['youhui']['score_limit'] > 0 && $this->_var['youhui']['point_limit'] > 0): ?>
							<div class="collect-price"><?php echo $this->_var['youhui']['score_limit']; ?> 积分</div>
							<?php elseif ($this->_var['youhui']['point_limit'] > 0 && $this->_var['youhui']['score_limit'] <= 0): ?>
							<div class="collect-price"><?php echo $this->_var['youhui']['point_limit']; ?> 经验</div>
							<?php elseif ($this->_var['youhui']['point_limit'] <= 0 && $this->_var['youhui']['score_limit'] > 0): ?>
							<div class="collect-price"><?php echo $this->_var['youhui']['score_limit']; ?> 积分</div>
							<?php endif; ?>
						</a>
					</div>
					<?php if ($this->_var['youhui']['out_time']): ?>
						<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/youhui-end.png" alt="" class="icon-sold-out">
					<?php endif; ?>
				</li>
			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php else: ?>
			<div class="tipimg no_data">
				暂无收藏
			</div>
		<?php endif; ?>
		</ul>
		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
	<?php endif; ?> -->
	<?php if ($this->_var['data']['sc_status'] == 1): ?>
		<div class="j_ajaxlist_<?php echo $this->_var['data']['sc_status']; ?> m-collect-list"  rel="1" data-type="event"  id="tb1">
		<ul class=" j_ajaxadd_<?php echo $this->_var['data']['sc_status']; ?>" >
		<?php if ($this->_var['list']): ?>
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'event');if (count($_from)):
    foreach ($_from AS $this->_var['event']):
?>
			
			<li <?php if ($this->_var['event']['out_time']): ?>class="flex-box collect-item isOver" <?php else: ?>class="flex-box collect-item" <?php endif; ?>>
				<div class="no-href hide"></div>
				<div class="check-box j-check-box" data-id="<?php echo $this->_var['event']['id']; ?>"><i class="iconfont"></i></div>
				<a href="<?php echo $this->_var['event']['url']; ?>" data-no-cache="ture"><img src="<?php echo $this->_var['event']['icon']; ?>" alt="" class="collect-img"></a>
				<div class="flex-1">
					<a href="<?php echo $this->_var['event']['url']; ?>">
						<div class="collect-name"><?php echo $this->_var['event']['name']; ?></div>
						<?php if ($this->_var['event']['score_limit'] > 0 && $this->_var['event']['point_limit'] > 0): ?>
						<div class="collect-price"><?php echo $this->_var['event']['score_limit']; ?> 积分</div>
						<?php elseif ($this->_var['event']['point_limit'] > 0 && $this->_var['event']['score_limit'] <= 0): ?>
						<div class="collect-price"><?php echo $this->_var['event']['point_limit']; ?> 经验</div>
						<?php elseif ($this->_var['event']['point_limit'] <= 0 && $this->_var['event']['score_limit'] > 0): ?>
						<div class="collect-price"><?php echo $this->_var['event']['score_limit']; ?> 积分</div>
						<?php endif; ?>
					</a>
				</div>
				<?php if ($this->_var['event']['out_time']): ?>
				<img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/youhui-end.png" alt="" class="icon-sold-out">
				<?php endif; ?>
			</li>
			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php else: ?>
			<div class="tipimg no_data">
				暂无收藏
			</div>
		<?php endif; ?>
		</ul>
		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
	<?php endif; ?>
	<?php if ($this->_var['data']['sc_status'] == 2): ?>
		<div class="j_ajaxlist_<?php echo $this->_var['data']['sc_status']; ?> m-collect-list"  rel="2" data-type="shop"  id="tb2">
		<ul class=" j_ajaxadd_<?php echo $this->_var['data']['sc_status']; ?>" >
		<?php if ($this->_var['list']): ?>
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shop');if (count($_from)):
    foreach ($_from AS $this->_var['shop']):
?>
			<li class="flex-box collect-item b-line shop-item">
				<div class="no-href hide"></div>
				<div class="check-box j-check-box" data-id="<?php echo $this->_var['shop']['id']; ?>"><i class="iconfont"></i></div>
				<a href="<?php echo $this->_var['shop']['url']; ?>" data-no-cache="ture"><img src="<?php echo $this->_var['shop']['preview']; ?>" alt="" class="collect-img"></a>
				<div class="flex-1">
					<a href="<?php echo $this->_var['shop']['url']; ?>">
						<div class="shop-name"><?php echo $this->_var['shop']['name']; ?></div>
						<div class="flex-box">
							<div class="m-start">
								<div class="start-num" style="width: <?php echo $this->_var['shop']['format_point']; ?>%"></div>
							</div>
							<p class="shop-point"><?php echo $this->_var['shop']['avg_point']; ?></p>
						</div>
						<div class="flex-box shop-info">
							<p class="shop-address"><?php echo $this->_var['shop']['area_name']; ?></p>
							<p class="shop-cate flex-1"><?php echo $this->_var['shop']['cate_name']; ?></p>
							<p class="shop-distance"><?php echo $this->_var['shop']['distance']; ?></p>
						</div>
					</a>
				</div>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php else: ?>
			<div class="tipimg no_data">
				暂无收藏
			</div>
		<?php endif; ?>
		</ul>
		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
		</div>
	<?php endif; ?>
	</div>
</div>

<?php echo $this->fetch('style5.2/inc/footer.html'); ?>