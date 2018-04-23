<?php if (!defined('THINK_PATH')) exit();?><!--index_zt3_p1-->
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
		<div class="material-benefit-list">
			<div class="material-benefit-item b-line">
				<a  href="javascript:void(0);" class="zt_moban"><img class="<?php echo ($zt_moban); ?>_p1" alt="" src="<?php echo $zt_img_data[$zt_moban.'_p1']['img'] ?>" />
				<input type="hidden" name="type" value="<?php echo $zt_img_data[$zt_moban.'_p1']['type'] ?>" />
				<input type="hidden" name="ctl_name" value="<?php echo $zt_img_data[$zt_moban.'_p1']['ctl_name'] ?>" />
				<input type="hidden" name="ctl_value" value="<?php echo $zt_img_data[$zt_moban.'_p1']['ctl_value'] ?>" />
				</a>
			</div>
			<div class="material-benefit-item b-line l-line">
				<a href="javascript:void(0);" class="zt_moban"><img class="<?php echo ($zt_moban); ?>_p2" alt="" src="<?php echo $zt_img_data[$zt_moban.'_p2']['img'] ?>" />
				<input type="hidden" name="type" value="<?php echo $zt_img_data[$zt_moban.'_p2']['type'] ?>" />
				<input type="hidden" name="ctl_name" value="<?php echo $zt_img_data[$zt_moban.'_p2']['ctl_name'] ?>" />
				<input type="hidden" name="ctl_value" value="<?php echo $zt_img_data[$zt_moban.'_p2']['ctl_value'] ?>" />
				</a>
			</div>
		</div>
		<div class="material-benefit-bottom-list b-line">
			<div class="material-benefit-bottom-item r-line">
				<a href="javascript:void(0);" class="zt_moban"><img class="<?php echo ($zt_moban); ?>_p3" alt="" src="<?php echo $zt_img_data[$zt_moban.'_p3']['img'] ?>" />
				<input type="hidden" name="type" value="<?php echo $zt_img_data[$zt_moban.'_p3']['type'] ?>" />
				<input type="hidden" name="ctl_name" value="<?php echo $zt_img_data[$zt_moban.'_p3']['ctl_name'] ?>" />
				<input type="hidden" name="ctl_value" value="<?php echo $zt_img_data[$zt_moban.'_p3']['ctl_value'] ?>" />
				</a>
			</div>
			<div class="material-benefit-bottom-item r-line">
				<a href="javascript:void(0);" class="zt_moban"><img class="<?php echo ($zt_moban); ?>_p4" alt="" src="<?php echo $zt_img_data[$zt_moban.'_p4']['img'] ?>" />
				<input type="hidden" name="type" value="<?php echo $zt_img_data[$zt_moban.'_p4']['type'] ?>" />
				<input type="hidden" name="ctl_name" value="<?php echo $zt_img_data[$zt_moban.'_p4']['ctl_name'] ?>" />
				<input type="hidden" name="ctl_value" value="<?php echo $zt_img_data[$zt_moban.'_p4']['ctl_value'] ?>" />
				</a>
			</div>
			<div class="material-benefit-bottom-item r-line">
				<a href="javascript:void(0);" class="zt_moban"><img class="<?php echo ($zt_moban); ?>_p5" alt="" src="<?php echo $zt_img_data[$zt_moban.'_p5']['img'] ?>" />
				<input type="hidden" name="type" value="<?php echo $zt_img_data[$zt_moban.'_p5']['type'] ?>" />
				<input type="hidden" name="ctl_name" value="<?php echo $zt_img_data[$zt_moban.'_p5']['ctl_name'] ?>" />
				<input type="hidden" name="ctl_value" value="<?php echo $zt_img_data[$zt_moban.'_p5']['ctl_value'] ?>" />
				</a>
			</div>
			<div class="material-benefit-bottom-item">
				<a href="javascript:void(0);" class="zt_moban"><img class="<?php echo ($zt_moban); ?>_p6" alt="" src="<?php echo $zt_img_data[$zt_moban.'_p6']['img'] ?>" />
				<input type="hidden" name="type" value="<?php echo $zt_img_data[$zt_moban.'_p6']['type'] ?>" />
				<input type="hidden" name="ctl_name" value="<?php echo $zt_img_data[$zt_moban.'_p6']['ctl_name'] ?>" />
				<input type="hidden" name="ctl_value" value="<?php echo $zt_img_data[$zt_moban.'_p6']['ctl_value'] ?>" />
				</a>
			</div>
			<div class="blank"></div>
		</div>
	</div>
</body>