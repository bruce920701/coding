<!--index_zt6_p1-->
<!--index_zt6_p2-->
<!--index_zt6_p3-->
<!--index_zt6_p4-->
<!--index_zt6_p5-->


<body style="margin:0px;">
<style type="text/css">
/*专题位*/
.m-quality{
	width: 100%;
	margin: .5rem 0;
}

.m-quality .tit{
	position: relative;
	height: 1.5rem;
	line-height: 1.5rem;
	background: #fff;
	text-align: center;
}

.m-quality .tit span{
	position: relative;
}

.m-quality .tit span:before{
	content: " ";
	display: block;
	position: absolute;
	top: 50%;
	left: -1.5rem;
	width: 1rem;
	height: 2px;
	background: #e3e5e9;
	-webkit-transform: scaleY(0.5);
			transform: scaleY(0.5);
	-webkit-transform-origin: 0 100%;
			transform-origin: 0 100%;
}

.m-quality .tit span:after{
	content: " ";
	display: block;
	position: absolute;
	top: 50%;
	right: -1.5rem;
	width: 1rem;
	height: 2px;
	background: #e3e5e9;
	-webkit-transform: scaleY(0.5);
			transform: scaleY(0.5);
	-webkit-transform-origin: 0 100%;
			transform-origin: 0 100%;
}

.m-quality .quality-list{
	width: 100%;
}

.m-quality .quality-list:after{
	content: " ";
	display: block;
	height: 0;
	visibility: hidden;
	clear: both;
}

.m-quality .quality-item{
	float: left;
	width: 50%;
}

.m-quality .quality-item img{
	width: 100%;
}

.quality-list-bottom{
	display:-webkit-box;
	display:-webkit-flex;
	display: flex;
	-webkit-box-align: center;
	-webkit-align-items:center;
	align-items:center;
}

.quality-bottom-item{
	-webkit-flex:1;
	-webkit-box-flex:1;
	flex:1;
}

.quality-bottom-item img {
	width: 100%;
}
</style>

	<div class="m-quality">
		<div class="tit b-line">
			<span><?php echo $this->_var['title']; ?></span>
		</div>
		<div class="quality-list">	
			<div class="quality-item b-line">
				<a  href="<?php echo $this->_var['index_zt6_p1_a']; ?>" data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt6_p1_img']; ?>" /></a>
			</div>
			<div class="quality-item b-line l-line">
				<a href="<?php echo $this->_var['index_zt6_p2_a']; ?>" data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt6_p2_img']; ?>" /></a>
			</div>
			<div class="quality-item b-line l-line">
				<a href="<?php echo $this->_var['index_zt6_p3_a']; ?>" data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt6_p3_img']; ?>" /></a>
			</div>
		</div>
		<div class="quality-list-bottom">
			<div class="quality-bottom-item b-line">
				<a href="<?php echo $this->_var['index_zt6_p4_a']; ?>" data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt6_p4_img']; ?>" /></a>
			</div>
			<div class="quality-bottom-item b-line l-line">
				<a href="<?php echo $this->_var['index_zt6_p5_a']; ?>" data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt6_p5_img']; ?>" /></a>
			</div>
		</div>
	</div><!-- m-topic2 -->
</body>