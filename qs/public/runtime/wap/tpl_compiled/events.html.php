<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
var INDEX_URL='<?php
echo parse_url_tag("u:index|index|"."".""); 
?>';
var address='<?php echo $this->_var['address']; ?>';
var cate_id_1='<?php echo $this->_var['data']['cate_id']; ?>';

</script>
<div class="page page-current" id="events">
	<div class="m-events-tab">
	    <ul class="b-line">
			<?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');if (count($_from)):
    foreach ($_from AS $this->_var['cate']):
?>
			<li>
				<a href="javascript:void(0)" data-src="<?php echo $this->_var['cate']['url']; ?>" cate-id="<?php echo $this->_var['cate']['id']; ?>"><?php echo $this->_var['cate']['name']; ?></a>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	    </ul>
	    <div class="events-tab-line"></div>
	</div>
 	<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
  	<div class="content infinite-scroll infinite-scroll-bottom">
   		<!-- 页面主体 -->
   		<div class="m-events-list j_ajaxlist_<?php echo $this->_var['data']['cate_id']; ?>">
   		<?php if ($this->_var['data']['item']): ?>
   			<ul class="j_ajaxadd_<?php echo $this->_var['data']['cate_id']; ?>">
   				<?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'eventitem');if (count($_from)):
    foreach ($_from AS $this->_var['eventitem']):
?>
   				<li>
   					<a data-no-cache="true" href="<?php
echo parse_url_tag("u:index|event#index|"."data_id=".$this->_var['eventitem']['id']."".""); 
?>">
						<div class="main-img">
							<img alt="" src="<?php echo $this->_var['eventitem']['img']; ?>"/>
						<p class="main-tip"><?php echo $this->_var['eventitem']['name']; ?></p>
						<?php if ($this->_var['eventitem']['is_over'] == 1 && $this->_var['eventitem']['out_time'] == 1): ?>
						<div class="events-ico sale-out"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/events_sale_out.png" alt=""></div>
						<?php elseif ($this->_var['eventitem']['is_over'] == 1 || $this->_var['eventitem']['out_time'] == 1): ?>
						<div class="events-ico sale-out"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/events_sale_out.png" alt=""></div>
						<?php elseif ($this->_var['eventitem']['submit_count'] >= $this->_var['eventitem']['total_count']): ?>
						<div class="events-ico house-full"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/events_house_full.png" alt=""></div>
						<?php endif; ?>
						</div>
						<div class="events-detail flex-box">
							<div class="events-img">
								<img alt="" src="<?php echo $this->_var['eventitem']['supplier_info_preview']; ?>" />
							</div>
							<div class="events-info flex-1">
								<div class="events-tit flex-box">
									<h2 class="flex-1"><?php echo $this->_var['eventitem']['supplier_info_name']; ?></h2>
									<?php if ($this->_var['eventitem']['distance'] || $this->_var['eventitem']['district']): ?>
									<p class="address"><?php echo $this->_var['eventitem']['district']; ?> <?php echo $this->_var['eventitem']['distance']; ?></p>
									<?php endif; ?>
								</div>
								<?php if ($this->_var['eventitem']['submit_end_time_format']): ?>
								<div class="events-time">报名时间：<?php echo $this->_var['eventitem']['submit_begin_time_format']; ?> 至 <?php echo $this->_var['eventitem']['submit_end_time_format']; ?></div>
								<?php else: ?>
								<div class="events-time">报名时间：长期有效</div>
								<?php endif; ?>
							</div>
						</div>
   					</a>
   				</li>
   				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   			</ul>
   			
   		<?php else: ?>
   		<div class="tipimg no_data">暂无活动</div>
   		<?php endif; ?>
   		<div class="pages hide"><?php echo $this->_var['pages']; ?></div>
   		</div>
        
    </div>
         <div class="blank"></div>
  	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
