<!--index_zt5_p1-->
<!--index_zt5_p2-->
<!--index_zt5_p3-->
<!--index_zt5_p4-->

<body style="margin:0px;">
<style type="text/css">
/*专题位*/
.m-high-quality-tuan{
	width: 100%;
	margin: .5rem 0;
}

.m-high-quality-tuan .tit-hasimg{
	width: 100%;
	height: 1.8rem;
	line-height: 1.8rem;
	background: #fff;
	padding: 0 .5rem;
}

.m-high-quality-tuan .tit-hasimg:after{
	content: " ";
	display: block;
	height: 0;
	visibility: hidden;
	clear: both;
}

.m-high-quality-tuan .tit-hasimg img{
	height: 100%;
}

.m-high-quality-tuan .tit-hasimg .right{
	display: block;
	float: right;
	color: #ff2244;
	background: url(<?php echo $this->_var['TMPL']; ?>images/icon-right.png) right center no-repeat;
	background-size: 7%;
	padding-right: .8rem;
}

.m-high-quality-tuan .high-quality-tuan-list{
	width: 100%;
}

.m-high-quality-tuan .high-quality-tuan-item{
	position: relative;
	width: 50%;
	float: left;
}

.m-high-quality-tuan .high-quality-tuan-item:before{
	content: ""; 
	display: block; 
	padding-top: 40%;
}

.m-high-quality-tuan .high-quality-tuan-item img{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%
}
.m-high-quality-tuan .tit-hasimg{
	position: relative;
	height: 1.5rem;
	line-height: 1.5rem;
	background: #fff;
}

.m-high-quality-tuan .tit-hasimg span{
	position: relative;
}
.blank{height: 0;visibility: hidden;clear: both;overflow: hidden;}
</style>
	<div class="m-high-quality-tuan">
		<?php if ($this->_var['zt_page'] == 1): ?>
		<div class="tit-hasimg  b-line">
			<span><?php echo $this->_var['title']; ?></span>
			<!--<img alt="" src="<?php echo $this->_var['TMPL']; ?>/images/topictit_tg.jpg"/>-->
			<a class="right" href="<?php echo $this->_var['url']; ?>"  data-no-cache="true">抢购更多优惠 </a>
		</div>
		<?php endif; ?>
		<?php if ($this->_var['zt_page'] == 3): ?>
		<div class="tit b-line">
			<span><?php echo $this->_var['title']; ?></span>
		</div>
		<?php endif; ?>
		<div class="high-quality-tuan-list b-line">
			<div class="high-quality-tuan-item r-line">
				<a  href="<?php echo $this->_var['index_zt5_p1_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt5_p1_img']; ?>" /></a>
			</div>
			<div class="high-quality-tuan-item">
				<a href="<?php echo $this->_var['index_zt5_p2_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt5_p2_img']; ?>" /></a>
			</div>
			<div class="blank"></div>
		</div>
		<div class="high-quality-tuan-list b-line">
			<div class="high-quality-tuan-item r-line">
				<a href="<?php echo $this->_var['index_zt5_p3_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt5_p3_img']; ?>" /></a>
			</div>
			<div class="high-quality-tuan-item">
				<a href="<?php echo $this->_var['index_zt5_p4_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt5_p4_img']; ?>" /></a>
			</div>
			<div class="blank"></div>
		</div>
	</div><!-- m-topic3 -->

</body>