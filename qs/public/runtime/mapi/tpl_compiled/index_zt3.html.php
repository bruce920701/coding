<!--index_zt3_p1-->
<!--index_zt3_p2-->
<!--index_zt3_p3-->
<!--index_zt3_p4-->
<!--index_zt3_p5-->
<!--index_zt3_p6-->

<body style="margin:0px;">
<style type="text/css">
/*专题位*/
.m-material-benefit{
	width: 100%;
	margin: .5rem 0;
}

.m-material-benefit .tit{
	position: relative;
	height: 1.5rem;
	line-height: 1.5rem;
	background: #fff;
	text-align: center;
}

.m-material-benefit .tit span{
	position: relative;
}

.m-material-benefit .tit span:before{
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

.m-material-benefit .tit span:after{
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

.m-material-benefit .material-benefit-list{
	width: 100%;
}

.m-material-benefit .material-benefit-list:after{
	content: " ";
	display: block;
	height: 0;
	visibility: hidden;
	clear: both;
}

.m-material-benefit .material-benefit-item{
	float: left;
	width: 50%;
}

.m-material-benefit .material-benefit-item.item-middle{
	width: 25%;
}

.m-material-benefit .material-benefit-item img{
	width: 100%;
}

.material-benefit-bottom-list{
	width: 100%;
	background: #fff;
}

.material-benefit-bottom-item{
	position: relative;
	width: 25%;
	float: left;
}
.material-benefit-bottom-item:before{
	content: ""; 
	display: block; 
	padding-top: 177%;
}

.material-benefit-bottom-item img{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
.blank{height: 0;visibility: hidden;clear: both;overflow: hidden;}
</style>
	<div class="m-material-benefit">
		<div class="tit b-line">
			<span><?php echo $this->_var['title']; ?></span>
		</div>
		<div class="material-benefit-list">
			<div class="material-benefit-item b-line">
				<a  href="<?php echo $this->_var['index_zt3_p1_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt3_p1_img']; ?>" /></a>
			</div>
			<div class="material-benefit-item b-line l-line">
				<a href="<?php echo $this->_var['index_zt3_p2_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt3_p2_img']; ?>" /></a>
			</div>
		</div>
		<div class="material-benefit-bottom-list b-line">
			<div class="material-benefit-bottom-item r-line">
				<a href="<?php echo $this->_var['index_zt3_p3_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt3_p3_img']; ?>" /></a>
			</div>
			<div class="material-benefit-bottom-item r-line">
				<a href="<?php echo $this->_var['index_zt3_p4_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt3_p4_img']; ?>" /></a>
			</div>
			<div class="material-benefit-bottom-item r-line">
				<a href="<?php echo $this->_var['index_zt3_p5_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt3_p5_img']; ?>" /></a>
			</div>
			<div class="material-benefit-bottom-item">
				<a href="<?php echo $this->_var['index_zt3_p6_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt3_p6_img']; ?>" /></a>
			</div>
			<div class="blank"></div>
		</div>
	</div>
</body>