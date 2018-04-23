<!--index_zt4_p1-->
<!--index_zt4_p2-->
<!--index_zt4_p3-->
<!--index_zt4_p4-->
<!--index_zt4_p5-->
<!--index_zt4_p6-->
<!--index_zt4_p7-->
<!--index_zt4_p8-->

<body style="margin:0px;">
<style type="text/css">
/*专题位*/
.m-shopping{
	width: 100%;
	margin: 0; 
}

.m-shopping .tit-hasimg{
	width: 100%;
	height: 1.8rem;
	line-height: 1.8rem;
	background: #fff;
	padding: 0 .5rem;
}

.m-shopping .tit-hasimg:after{
	content: " ";
	display: block;
	height: 0;
	visibility: hidden;
	clear: both;
}

.m-shopping .tit-hasimg img{
	height: 100%;
}

.m-shopping .tit-hasimg .right{
	display: block;
	float: right;
	color: #ff2244;
	background: url(<?php echo $this->_var['TMPL']; ?>images/icon-right.png) right center no-repeat;
	background-size: 10%;
	padding-right: .8rem;
}

.m-shopping .shopping-list{
	width: 100%;
}

.m-shopping .shopping-item{
	position: relative;
	width: 50%;
	float: left;
}

.m-shopping .shopping-item:before{
	content: ""; 
	display: block; 
	padding-top: 40%;
}

.m-shopping .shopping-item img{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

.shopping-bottom-list{
	width: 100%;
	height: auto;
	background: #fff;
}

.shopping-bottom-item{
	position: relative;
	width: 25%;
	float: left;
}

.shopping-bottom-item:before{
	content: ""; 
	display: block; 
	padding-top: 177%;
}

.shopping-bottom-item img{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
.m-shopping .tit-hasimg{
	position: relative;
	height: 1.5rem;
	line-height: 1.5rem;
	background: #fff;
}

.m-shopping .tit-hasimg span{
	position: relative;
}
.blank{height: 0;visibility: hidden;clear: both;overflow: hidden;}
</style>
	<div class="m-shopping">
		<div class="tit-hasimg">
			<span><?php echo $this->_var['title']; ?></span>
			<!--<img alt="" src="<?php echo $this->_var['TMPL']; ?>images/topictit_sc.jpg"/>-->
			<a class="right" href="<?php echo $this->_var['url']; ?>"  data-no-cache="true">更多精彩</a>
		</div>
		<div class="shopping-list">
			<div class="shopping-item r-line">
				<a  href="<?php echo $this->_var['index_zt4_p1_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p1_img']; ?>" /></a>
			</div>
			<div class="shopping-item">
				<a href="<?php echo $this->_var['index_zt4_p2_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p2_img']; ?>" /></a>
			</div>
			<div class="blank"></div>
		</div>
		<div class="shopping-list">
			<div class="shopping-item r-line">
				<a href="<?php echo $this->_var['index_zt4_p3_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p3_img']; ?>" /></a>
			</div>
			<div class="shopping-item">
				<a href="<?php echo $this->_var['index_zt4_p4_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p4_img']; ?>" /></a>
			</div>
			<div class="blank"></div>
		</div>
		<div class="shopping-bottom-list b-line">
			<div class="shopping-bottom-item small r-line">
				<a href="<?php echo $this->_var['index_zt4_p5_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p5_img']; ?>" /></a>
			</div>
			<div class="shopping-bottom-item small r-line">
				<a href="<?php echo $this->_var['index_zt4_p6_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p6_img']; ?>" /></a>
			</div>
			<div class="shopping-bottom-item small r-line">
				<a href="<?php echo $this->_var['index_zt4_p7_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p7_img']; ?>" /></a>
			</div>
			<div class="shopping-bottom-item small">
				<a href="<?php echo $this->_var['index_zt4_p8_a']; ?>"  data-no-cache="true"><img alt="" src="<?php echo $this->_var['index_zt4_p8_img']; ?>" /></a>
			</div>
			<div class="blank"></div>
		</div>
	</div><!-- m-topic3 -->

</body>