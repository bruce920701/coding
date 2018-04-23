<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<style type="text/css">
		.jjsz{
			min-width: 1000px;
			height: auto;
			margin: 0 16px;
		}
		.jjsz .title{
			width: 100%;
			height: 50px;
			line-height: 50px;
			border-bottom: 1px solid #eaedf1;
			font-size: 14px;
			color: #333;
			font-weight: bold;
		}
		.jjsz table{
			width: 80%;
			height: 200px;
			margin: auto;
		}
		.jjsz table tr{
			display: inline-block;
			width: 100%;
			margin-top: 10px;
		}
		.jjsz table tr td{
			text-align: center;
			font-size: 14px;
		}
		.jjsz table tr td input{
			display: inline-block;
			border: none;
			height: 40px;
			padding: 0px;
			font-size: 18px;
			color: #000;
			text-align: center;
			outline: none;
		}
		.jjsz .xftj{
			width: 80%;
			height: 400px;
		}
		.jjsz tr td{
			display: inline-block;
			width: 10.5%;
			height: 50px;
			line-height: 50px;
			border: none;
			padding: 5px;
			background-color: #f9fafc;
		}
		.jjsz tr th{
			display: inline-block;
			width: 10.5%;
			height: 50px;
			line-height: 50px;
			border: none;
			padding: 5px;
			background-color: #f9fafc;
			font-weight: normal;
		}
		
		.jjsz tr td input{
			display: inline-block;
			width: 100%;
			/*margin: 5px 5px;*/
		}
		.jjsz button{
			width: 200px;
			height: 40px;
			background-color: #8ba9c0;
			color: #FFf;
			border: none;
			outline: none;
			margin-top: 50px;
			margin-bottom: 100px;
			margin-left: 200px;
		}
		.dt_set th{
			width: 20% !important;
		}
		.dt_set td{
			width: 20% !important;
		}
		.set td{
			width: 14.6% !important;
		}
		.set td:first-child{
			width: 20% !important;
		}
		.sjtj th{
			width: 8.5% !important;
		}
		.sjtj th:first-child{
			width: 10.5%;
		}
		.sjtj td{
			width: 8.5% !important;
		}
		.sjtj td:first-child{
			width: 10.5%;
		}
	</style>
	<body>
		<div class="jjsz">
			<p>静态分红比率 <input type="text" value="<?php echo ($config["static_reward_rate"]); ?>" class="static_reward_rate"/></p>
			<p>直推奖利率 <input type="text" value="<?php echo ($config["direct_rate"]); ?>" class="direct_rate"/></p>
			<p class="title">动态奖设置</p>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr class="dt_set">
					<th>等级</th>
					<th>一级</th>
					<th>二级</th>
					<th>三级</th>
				</tr>
				<tr class="dt_set set">
					<td>消费额度</td>
					<td><input type="text" value="<?php echo ($config["consume_1"]); ?>" class="amount_of_consumption_a"/></td>
					<td><input type="text" value="<?php echo ($config["consume_2"]); ?>" class="amount_of_consumption_b"/></td>
					<td><input type="text" value="<?php echo ($config["consume_3"]); ?>" class="amount_of_consumption_c"/></td>
					<td><input type="text" value="<?php echo ($config["consume_max"]); ?>" class="amount_of_consumption_d"/></td>
				</tr>
				<tr class="dt_set">
					<td>杠杆倍数</td>
					<td><input type="text" value="<?php echo ($config["level_1"]); ?>" class="gearing_a"/></td>
					<td><input type="text" value="<?php echo ($config["level_2"]); ?>" class="gearing_b"/></td>
					<td><input type="text" value="<?php echo ($config["level_3"]); ?>" class="gearing_c"/></td>
				</tr>
				<tr class="dt_set">
					<td>激活码个数</td>
					<td><input type="text" value="<?php echo ($config["active_code_1"]); ?>"/ class="activation_code_a"></td>
					<td><input type="text" value="<?php echo ($config["active_code_2"]); ?>"/ class="activation_code_b"></td>
					<td><input type="text" value="<?php echo ($config["active_code_3"]); ?>"/ class="activation_code_c"></td>
				</tr>
				<!--<tr class="dt_set">
					<td>奖励倍数</td>
					<td><input type="text" value="0"/ class="bonus_times_a"></td>
					<td><input type="text" value="0"/ class="bonus_times_b"></td>
					<td><input type="text" value="0"/ class="bonus_times_c"></td>
				</tr>-->
			</table>
			<p class="title">消费条件</p>
			<table border="0" cellspacing="0" cellpadding="0" class="xftj" >
				<tr>
					<th>等级</th>
					<th>结算利率</th>
					<!--<th>市场订单数量</th>-->
					<th>拿伞下业绩比例</th>
				</tr>
				<!--<tr>
					<td>一级分销</td>
					<td><input type="text" value="<?php echo ($config["fx_0_rate"]); ?>"/ class="minimum_direct_number_of_people_no"></td>
					<td><input type="text" value="<?php echo ($config["fx_0_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_no"></td>
				</tr>-->
				<tr>
					<td>一级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_1_rate"]); ?>"/ class="minimum_direct_number_of_people_a"></td>
					<!--<td><input type="text" value="<?php echo ($config["fx_1_orders_min"]); ?>"/ class="market_order_quantity_a"></td>-->
					<td><input type="text" value="<?php echo ($config["fx_1_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_a"></td>
				</tr>
				<tr>
					<td>二级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_2_rate"]); ?>"/ class="minimum_direct_number_of_people_b"></td>
					<!--<td><input type="text" value="<?php echo ($config["fx_2_orders_min"]); ?>"/ class="market_order_quantity_b"></td>-->
					<td><input type="text" value="<?php echo ($config["fx_2_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_b"></td>
				</tr>
				<tr>
					<td>三级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_3_rate"]); ?>"/ class="minimum_direct_number_of_people_c"></td>
					<!--<td><input type="text" value="<?php echo ($config["fx_3_orders_min"]); ?>"/ class="market_order_quantity_c"></td>-->
					<td><input type="text" value="<?php echo ($config["fx_3_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_c"></td>
				</tr>
				<tr>
					<td>四级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_4_rate"]); ?>"/ class="minimum_direct_number_of_people_d"></td>
					<!--<td><input type="text" value="<?php echo ($config["fx_4_orders_min"]); ?>"/ class="market_order_quantity_d"></td>-->
					<td><input type="text" value="<?php echo ($config["fx_4_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_d"></td>
				</tr>
				<tr>
					<td>五级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_5_rate"]); ?>"/ class="minimum_direct_number_of_people_e"></td>
					<!--<td><input type="text" value="<?php echo ($config["fx_5_orders_min"]); ?>"/ class="market_order_quantity_e"></td>-->
					<td><input type="text" value="<?php echo ($config["fx_5_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_e"></td>
				</tr>
				<tr>
					<td>六级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_6_rate"]); ?>"/ class="minimum_direct_number_of_people_f"></td>
					<!--<td><input type="text" value="<?php echo ($config["fx_6_orders_min"]); ?>"/ class="market_order_quantity_f"></td>-->
					<td><input type="text" value="<?php echo ($config["fx_6_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_f"></td>
				</tr>
				<tr>
					<td>七级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_7_rate"]); ?>"/ class="minimum_direct_number_of_people_g"></td>
					<!--<td><input type="text" value="<?php echo ($config["fx_7_rate"]); ?>"/ class="settlement_interest_rate_g"></td>-->
					<!--<td><input type="text" value="<?php echo ($config["fx_7_orders_min"]); ?>"/ class="market_order_quantity_g"></td>-->
					<td><input type="text" value="<?php echo ($config["fx_7_get_rainbow_rate"]); ?>"/ class="under_umbrella_performance_ratio_g"></td>
				</tr>
			</table>
			<p class="title">一级分销奖</p>
			<table border="0" cellspacing="0" cellpadding="0" class="xftj" >
				<tr>
					<th>直推人数</th>
					<th>所拿代数</th>
					<th>利率</th>
				</tr>
				<tr>
					<td><input type="text" value="<?php echo ($config["fx_0_members_0"]); ?>" class="fx_0_members_0"/></td>
					<td><input type="text" value="<?php echo ($config["fx_0_members_0_child"]); ?>" class="fx_0_members_0_child"/></td>
					<td><input type="text" value="<?php echo ($config["fx_0_members_0_rate"]); ?>" class="fx_0_members_0_rate"/></td>
				</tr>
				<tr>
					<td><input type="text" value="<?php echo ($config["fx_0_members_1"]); ?>"  class="fx_0_members_1"/></td>
					<td><input type="text" value="<?php echo ($config["fx_0_members_1_child"]); ?>" class="fx_0_members_1_child"/></td>
					<td><input type="text" value="<?php echo ($config["fx_0_members_1_rate"]); ?>" class="fx_0_members_1_rate"/></td>
				</tr>
				<tr>
					<td><input type="text" value="<?php echo ($config["fx_0_members_2"]); ?>"  class="fx_0_members_2"/></td>
					<td><input type="text" value="<?php echo ($config["fx_0_members_2_child"]); ?>" class="fx_0_members_2_child"/></td>
					<td><input type="text" value="<?php echo ($config["fx_0_members_2_rate"]); ?>" class="fx_0_members_2_rate"/></td>
				</tr>
				
			</table>
			<p class="title">升级条件</p>
			<table border="0" cellspacing="0" cellpadding="0" class="sjtj"  style="width: 100%;">
				<tr>
					<th>等级</th>
					<th>一级分销</th>
					<th>一级代理</th>
					<th>二级代理</th>
					<th>三级代理</th>
					<th>四级代理</th>
					<th>五级代理</th>
					<th>六级代理</th>
					<th>七级代理</th>
					
				</tr>
				<tr>
					<td>最低市场个数</td>
					<td><input type="text" value="<?php echo ($config["fx_0_markets_min"]); ?>"/ class="minimum_market_number_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_markets_min"]); ?>"/ class="minimum_market_number_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_markets_min"]); ?>"/ class="minimum_market_number_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_markets_min"]); ?>"/ class="minimum_market_number_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_markets_min"]); ?>"/ class="minimum_market_number_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_markets_min"]); ?>"/ class="minimum_market_number_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_markets_min"]); ?>"/ class="minimum_market_number_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_markets_min"]); ?>"/ class="minimum_market_number_g"></td>
				</tr>
				<tr>
					<td>累计买订单数</td>
					<td><input type="text" value="<?php echo ($config["fx_0_orders_min"]); ?>"/ class="accumulative_purchase_order_number_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_orders_min"]); ?>"/ class="accumulative_purchase_order_number_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_orders_min"]); ?>"/ class="accumulative_purchase_order_number_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_orders_min"]); ?>"/ class="accumulative_purchase_order_number_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_orders_min"]); ?>"/ class="accumulative_purchase_order_number_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_orders_min"]); ?>"/ class="accumulative_purchase_order_number_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_orders_min"]); ?>"/ class="accumulative_purchase_order_number_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_orders_min"]); ?>"/ class="accumulative_purchase_order_number_g"></td>
				</tr>
				<!--<tr>
					<td>日结息利息</td>
					<td><input type="text" value="0"/ class="diurnal_interest_rate_a"></td>
					<td><input type="text" value="0"/ class="diurnal_interest_rate_b"></td>
					<td><input type="text" value="0"/ class="diurnal_interest_rate_c"></td>
					<td><input type="text" value="0"/ class="diurnal_interest_rate_d"></td>
					<td><input type="text" value="0"/ class="diurnal_interest_rate_e"></td>
					<td><input type="text" value="0"/ class="diurnal_interest_rate_f"></td>
					<td><input type="text" value="0"/ class="diurnal_interest_rate_g"></td>
				</tr>-->
				<tr>
					<td>直推用户</td>
					<td><input type="text" value="<?php echo ($config["fx_0_members_min"]); ?>"/ class="ordinary_user_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_members_min"]); ?>"/ class="ordinary_user_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_members_min"]); ?>"/ class="ordinary_user_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_members_min"]); ?>"/ class="ordinary_user_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_members_min"]); ?>"/ class="ordinary_user_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_members_min"]); ?>"/ class="ordinary_user_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_members_min"]); ?>"/ class="ordinary_user_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_members_min"]); ?>"/ class="ordinary_user_g"></td>
				</tr>
				<tr>
					<td>伞下一级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_0_market1_min"]); ?>"/ class="first_class_members_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_market1_min"]); ?>"/ class="first_class_members_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_market1_min"]); ?>"/ class="first_class_members_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_market1_min"]); ?>"/ class="first_class_members_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_market1_min"]); ?>"/ class="first_class_members_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_market1_min"]); ?>"/ class="first_class_members_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_market1_min"]); ?>"/ class="first_class_members_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_market1_min"]); ?>"/ class="first_class_members_g"></td>
				</tr>
				<tr>
					<td>伞下二级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_0_market2_min"]); ?>"/ class="two_level_members_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_market2_min"]); ?>"/ class="two_level_members_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_market2_min"]); ?>"/ class="two_level_members_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_market2_min"]); ?>"/ class="two_level_members_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_market2_min"]); ?>"/ class="two_level_members_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_market2_min"]); ?>"/ class="two_level_members_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_market2_min"]); ?>"/ class="two_level_members_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_market2_min"]); ?>"/ class="two_level_members_g"></td>
				</tr>
				<tr>
					<td>伞下三级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_0_market3_min"]); ?>"/ class="three_level_members_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_market3_min"]); ?>"/ class="three_level_members_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_market3_min"]); ?>"/ class="three_level_members_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_market3_min"]); ?>"/ class="three_level_members_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_market3_min"]); ?>"/ class="three_level_members_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_market3_min"]); ?>"/ class="three_level_members_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_market3_min"]); ?>"/ class="three_level_members_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_market3_min"]); ?>"/ class="three_level_members_g"></td>
				</tr>
				<tr>
					<td>伞下四级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_0_market4_min"]); ?>"/ class="four_level_members_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_market4_min"]); ?>"/ class="four_level_members_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_market4_min"]); ?>"/ class="four_level_members_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_market4_min"]); ?>"/ class="four_level_members_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_market4_min"]); ?>"/ class="four_level_members_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_market4_min"]); ?>"/ class="four_level_members_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_market4_min"]); ?>"/ class="four_level_members_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_market4_min"]); ?>"/ class="four_level_members_g"></td>
				</tr>
				<tr>
					<td>伞下五级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_0_market5_min"]); ?>"/ class="five_level_members_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_market5_min"]); ?>"/ class="five_level_members_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_market5_min"]); ?>"/ class="five_level_members_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_market5_min"]); ?>"/ class="five_level_members_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_market5_min"]); ?>"/ class="five_level_members_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_market5_min"]); ?>"/ class="five_level_members_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_market5_min"]); ?>"/ class="five_level_members_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_market5_min"]); ?>"/ class="five_level_members_g"></td>
				</tr>
				<tr>
					<td>伞下六级代理</td>
					<td><input type="text" value="<?php echo ($config["fx_0_market6_min"]); ?>"/ class="six_level_members_z"></td>
					<td><input type="text" value="<?php echo ($config["fx_1_market6_min"]); ?>"/ class="six_level_members_a"></td>
					<td><input type="text" value="<?php echo ($config["fx_2_market6_min"]); ?>"/ class="six_level_members_b"></td>
					<td><input type="text" value="<?php echo ($config["fx_3_market6_min"]); ?>"/ class="six_level_members_c"></td>
					<td><input type="text" value="<?php echo ($config["fx_4_market6_min"]); ?>"/ class="six_level_members_d"></td>
					<td><input type="text" value="<?php echo ($config["fx_5_market6_min"]); ?>"/ class="six_level_members_e"></td>
					<td><input type="text" value="<?php echo ($config["fx_6_market6_min"]); ?>"/ class="six_level_members_f"></td>
					<td><input type="text" value="<?php echo ($config["fx_7_market6_min"]); ?>"/ class="six_level_members_g"></td>
				</tr>
			</table>
			<button type="button" class="update">更新</button>
		</div>
		<!--<script src="js/jquery-3.2.1.min.js"></script>--><script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script>
			$(".update").click(function(){
				//消费额度
				var amount_of_consumption_a = $(".amount_of_consumption_a").val();
				var amount_of_consumption_b = $(".amount_of_consumption_b").val();
				var amount_of_consumption_c = $(".amount_of_consumption_c").val();
				var amount_of_consumption_d = $(".amount_of_consumption_d").val();
				//杠杆倍数
				var gearing_a = $(".gearing_a").val();
				var gearing_b = $(".gearing_b").val();
				var gearing_c = $(".gearing_c").val();
				//激活码个数
				var activation_code_a = $(".activation_code_a").val();
				var activation_code_b = $(".activation_code_b").val();
				var activation_code_c = $(".activation_code_c").val();
				//奖励倍数
//				var bonus_times_a = $(".bonus_times_a").val();
//				var bonus_times_b = $(".bonus_times_b").val();
//				var bonus_times_c = $(".bonus_times_c").val();
				//直推人数
				
				//各等级最低直推数
				var minimum_direct_number_of_people_no = $(".minimum_direct_number_of_people_no").val();
				var minimum_direct_number_of_people_a = $(".minimum_direct_number_of_people_a").val();
				var minimum_direct_number_of_people_b = $(".minimum_direct_number_of_people_b").val();
				var minimum_direct_number_of_people_c = $(".minimum_direct_number_of_people_c").val();
				var minimum_direct_number_of_people_d = $(".minimum_direct_number_of_people_d").val();
				var minimum_direct_number_of_people_e = $(".minimum_direct_number_of_people_e").val();
				var minimum_direct_number_of_people_f = $(".minimum_direct_number_of_people_f").val();
				var minimum_direct_number_of_people_g = $(".minimum_direct_number_of_people_g").val();
				
				//各等级结算利率
				var settlement_interest_rate_no = $(".settlement_interest_rate_no").val();
				var settlement_interest_rate_a = $(".settlement_interest_rate_a").val();
				var settlement_interest_rate_b = $(".settlement_interest_rate_b").val();
				var settlement_interest_rate_c = $(".settlement_interest_rate_c").val();
				var settlement_interest_rate_d = $(".settlement_interest_rate_d").val();
				var settlement_interest_rate_e = $(".settlement_interest_rate_e").val();
				var settlement_interest_rate_f = $(".settlement_interest_rate_f").val();
				var settlement_interest_rate_g = $(".settlement_interest_rate_g").val();
				//各等级市场订单数
				var market_order_quantity_no = $(".market_order_quantity_no").val();
				var market_order_quantity_a = $(".market_order_quantity_a").val();
				var market_order_quantity_b = $(".market_order_quantity_b").val();
				var market_order_quantity_c = $(".market_order_quantity_c").val();
				var market_order_quantity_d = $(".market_order_quantity_d").val();
				var market_order_quantity_e = $(".market_order_quantity_e").val();
				var market_order_quantity_f = $(".market_order_quantity_f").val();
				var market_order_quantity_g = $(".market_order_quantity_g").val();
				//拿伞下业绩比
				var under_umbrella_performance_ratio_no = $(".under_umbrella_performance_ratio_no").val();
				var under_umbrella_performance_ratio_a = $(".under_umbrella_performance_ratio_a").val();
				var under_umbrella_performance_ratio_b = $(".under_umbrella_performance_ratio_b").val();
				var under_umbrella_performance_ratio_c = $(".under_umbrella_performance_ratio_c").val();
				var under_umbrella_performance_ratio_d = $(".under_umbrella_performance_ratio_d").val();
				var under_umbrella_performance_ratio_e = $(".under_umbrella_performance_ratio_e").val();
				var under_umbrella_performance_ratio_f = $(".under_umbrella_performance_ratio_f").val();
				var under_umbrella_performance_ratio_g = $(".under_umbrella_performance_ratio_g").val();
				//升级条件
				//各等级最低市场要求
				var minimum_market_number_z = $(".minimum_market_number_z").val();
				var minimum_market_number_a = $(".minimum_market_number_a").val();
				var minimum_market_number_b = $(".minimum_market_number_b").val();
				var minimum_market_number_c = $(".minimum_market_number_c").val();
				var minimum_market_number_d = $(".minimum_market_number_d").val();
				var minimum_market_number_e = $(".minimum_market_number_e").val();
				var minimum_market_number_f = $(".minimum_market_number_f").val();
				var minimum_market_number_g = $(".minimum_market_number_g").val();
				//各等级累计买订单数
				var accumulative_purchase_order_number_z = $(".accumulative_purchase_order_number_z").val();
				var accumulative_purchase_order_number_a = $(".accumulative_purchase_order_number_a").val();
				var accumulative_purchase_order_number_b = $(".accumulative_purchase_order_number_b").val();
				var accumulative_purchase_order_number_c = $(".accumulative_purchase_order_number_c").val();
				var accumulative_purchase_order_number_d = $(".accumulative_purchase_order_number_d").val();
				var accumulative_purchase_order_number_e = $(".accumulative_purchase_order_number_e").val();
				var accumulative_purchase_order_number_f = $(".accumulative_purchase_order_number_f").val();
				var accumulative_purchase_order_number_g = $(".accumulative_purchase_order_number_g").val();
				//各等级日结利息额度
				var diurnal_interest_rate_z = $(".diurnal_interest_rate_z").val();
				var diurnal_interest_rate_a = $(".diurnal_interest_rate_a").val();
				var diurnal_interest_rate_b = $(".diurnal_interest_rate_b").val();
				var diurnal_interest_rate_c = $(".diurnal_interest_rate_c").val();
				var diurnal_interest_rate_d = $(".diurnal_interest_rate_d").val();
				var diurnal_interest_rate_e = $(".diurnal_interest_rate_e").val();
				var diurnal_interest_rate_f = $(".diurnal_interest_rate_f").val();
				var diurnal_interest_rate_g = $(".diurnal_interest_rate_g").val();
				//各等级伞下普通会员
				var ordinary_user_z = $(".ordinary_user_z").val();
				var ordinary_user_a = $(".ordinary_user_a").val();
				var ordinary_user_b = $(".ordinary_user_b").val();
				var ordinary_user_c = $(".ordinary_user_c").val();
				var ordinary_user_d = $(".ordinary_user_d").val();
				var ordinary_user_e = $(".ordinary_user_e").val();
				var ordinary_user_f = $(".ordinary_user_f").val();
				var ordinary_user_g = $(".ordinary_user_g").val();
				//各等级伞下一级会员
				var first_class_members_z = $(".first_class_members_z").val();
				var first_class_members_a = $(".first_class_members_a").val();
				var first_class_members_b = $(".first_class_members_b").val();
				var first_class_members_c = $(".first_class_members_c").val();
				var first_class_members_d = $(".first_class_members_d").val();
				var first_class_members_e = $(".first_class_members_e").val();
				var first_class_members_f = $(".first_class_members_f").val();
				var first_class_members_g = $(".first_class_members_g").val();
				//各等级伞下二级会员
				var two_level_members_z = $('.two_level_members_z').val();
				var two_level_members_a = $('.two_level_members_a').val();
				var two_level_members_b = $('.two_level_members_b').val();
				var two_level_members_c = $('.two_level_members_c').val();
				var two_level_members_d = $('.two_level_members_d').val();
				var two_level_members_e = $('.two_level_members_e').val();
				var two_level_members_f = $('.two_level_members_f').val();
				var two_level_members_g = $('.two_level_members_g').val();
				//各等级伞下三级会员
				var three_level_members_z = $('.three_level_members_z').val();
				var three_level_members_a = $('.three_level_members_a').val();
				var three_level_members_b = $('.three_level_members_b').val();
				var three_level_members_c = $('.three_level_members_c').val();
				var three_level_members_d = $('.three_level_members_d').val();
				var three_level_members_e = $('.three_level_members_e').val();
				var three_level_members_f = $('.three_level_members_f').val();
				var three_level_members_g = $('.three_level_members_g').val();
				//各等级伞下四级会员
				var four_level_members_z = $('.four_level_members_z').val();
				var four_level_members_a = $('.four_level_members_a').val();
				var four_level_members_b = $('.four_level_members_b').val();
				var four_level_members_c = $('.four_level_members_c').val();
				var four_level_members_d = $('.four_level_members_d').val();
				var four_level_members_e = $('.four_level_members_e').val();
				var four_level_members_f = $('.four_level_members_f').val();
				var four_level_members_g = $('.four_level_members_g').val();
				//各等级伞下五级会员
				var five_level_members_z = $('.five_level_members_z').val();
				var five_level_members_a = $('.five_level_members_a').val();
				var five_level_members_b = $('.five_level_members_b').val();
				var five_level_members_c = $('.five_level_members_c').val();
				var five_level_members_d = $('.five_level_members_d').val();
				var five_level_members_e = $('.five_level_members_e').val();
				var five_level_members_f = $('.five_level_members_f').val();
				var five_level_members_g = $('.five_level_members_g').val();
				//各等级伞下六级会员
				var six_level_members_z = $('.six_level_members_z').val();
				var six_level_members_a = $('.six_level_members_a').val();
				var six_level_members_b = $('.six_level_members_b').val();
				var six_level_members_c = $('.six_level_members_c').val();
				var six_level_members_d = $('.six_level_members_d').val();
				var six_level_members_e = $('.six_level_members_e').val();
				var six_level_members_f = $('.six_level_members_f').val();
				var six_level_members_g = $('.six_level_members_g').val();
				
				
				
				//一级分销奖
				var fx_0_members_0 = $(".fx_0_members_0").val();
				var fx_0_members_1 = $(".fx_0_members_1").val();
				var fx_0_members_2 = $(".fx_0_members_2").val();
				var fx_0_members_0_child = $(".fx_0_members_0_child").val();
				var fx_0_members_1_child = $(".fx_0_members_1_child").val();
				var fx_0_members_2_child = $(".fx_0_members_2_child").val();
				var fx_0_members_0_rate = $(".fx_0_members_0_rate").val();
				var fx_0_members_1_rate = $(".fx_0_members_1_rate").val();
				var fx_0_members_2_rate = $(".fx_0_members_2_rate").val();
				
				//静态奖比率
				var static_reward_rate = $(".static_reward_rate").val();
				//直推奖比例
				var direct_rate = $(".direct_rate").val();
				
				$.ajax({
					url:" m.php?m=Config&a=do_update",
					type:"post",
					data:{
						"consume_1":amount_of_consumption_a,
						"consume_2":amount_of_consumption_b,
						"consume_3":amount_of_consumption_c,
						"consume_max":amount_of_consumption_d,//消费额度结束
						"level_1":gearing_a,
						"level_2":gearing_b,
						"level_3":gearing_c,//杠杆倍数结束
						"active_code_1":activation_code_a,
						'active_code_2':activation_code_b,
						"active_code_3":activation_code_c,//激活码个数结束
						
						//一级分销奖
						
						"fx_0_members_0":fx_0_members_0,
						"fx_0_members_1":fx_0_members_1,
						"fx_0_members_2":fx_0_members_2,
						"fx_0_members_0_child":fx_0_members_0_child,
						"fx_0_members_1_child":fx_0_members_1_child,
						"fx_0_members_2_child":fx_0_members_2_child,
						"fx_0_members_0_rate":fx_0_members_0_rate,
						"fx_0_members_1_rate":fx_0_members_1_rate,
						"fx_0_members_2_rate":fx_0_members_2_rate,
						
						
						//直推奖和静态奖利率
						"static_reward_rate":static_reward_rate,
						"direct_rate":direct_rate,



						"fx_0_rate":minimum_direct_number_of_people_no,
						"fx_1_rate":minimum_direct_number_of_people_a,
						"fx_2_rate":minimum_direct_number_of_people_b,
						"fx_3_rate":minimum_direct_number_of_people_c,
						"fx_4_rate":minimum_direct_number_of_people_d,
						"fx_5_rate":minimum_direct_number_of_people_e,
						"fx_6_rate":minimum_direct_number_of_people_f,
						"fx_7_rate":minimum_direct_number_of_people_g,//各等级直推结算利率结束
						
						"fx_0_get_rainbow_rate":under_umbrella_performance_ratio_no,
						"fx_1_get_rainbow_rate":under_umbrella_performance_ratio_a,
						"fx_2_get_rainbow_rate":under_umbrella_performance_ratio_b,
						"fx_3_get_rainbow_rate":under_umbrella_performance_ratio_c,
						"fx_4_get_rainbow_rate":under_umbrella_performance_ratio_d,
						"fx_5_get_rainbow_rate":under_umbrella_performance_ratio_e,
						"fx_6_get_rainbow_rate":under_umbrella_performance_ratio_f,
						"fx_7_get_rainbow_rate":under_umbrella_performance_ratio_g,//各等级拿伞下市场利率
						//各等级满足最低市场个数
						"fx_0_markets_min":minimum_market_number_z,
						"fx_1_markets_min":minimum_market_number_a,
						"fx_2_markets_min":minimum_market_number_b,
						"fx_3_markets_min":minimum_market_number_c,
						"fx_4_markets_min":minimum_market_number_d,
						"fx_5_markets_min":minimum_market_number_e,
						"fx_6_markets_min":minimum_market_number_f,
						"fx_7_markets_min":minimum_market_number_g,
						//各等级购买订单数
						"fx_0_orders_min":accumulative_purchase_order_number_z,
						"fx_1_orders_min":accumulative_purchase_order_number_a,
						"fx_2_orders_min":accumulative_purchase_order_number_b,
						"fx_3_orders_min":accumulative_purchase_order_number_c,
						"fx_4_orders_min":accumulative_purchase_order_number_d,
						"fx_5_orders_min":accumulative_purchase_order_number_e,
						"fx_6_orders_min":accumulative_purchase_order_number_f,
						"fx_7_orders_min":accumulative_purchase_order_number_g,
						//各等级直推用户
						"fx_0_members_min":ordinary_user_z,
						"fx_1_members_min":ordinary_user_a,
						"fx_2_members_min":ordinary_user_b,
						"fx_3_members_min":ordinary_user_c,
						"fx_4_members_min":ordinary_user_d,
						"fx_5_members_min":ordinary_user_e,
						"fx_6_members_min":ordinary_user_f,
						"fx_7_members_min":ordinary_user_g,
						//各等级伞下一级代理
						"fx_0_market1_min":first_class_members_z,
						"fx_1_market1_min":first_class_members_a,
						"fx_2_market1_min":first_class_members_b,
						"fx_3_market1_min":first_class_members_c,
						"fx_4_market1_min":first_class_members_d,
						"fx_5_market1_min":first_class_members_e,
						"fx_6_market1_min":first_class_members_f,
						"fx_7_market1_min":first_class_members_g,
						//各等级伞下二级代理
						"fx_0_market2_min":two_level_members_z,
						"fx_1_market2_min":two_level_members_a,
						"fx_2_market2_min":two_level_members_b,
						"fx_3_market2_min":two_level_members_c,
						"fx_4_market2_min":two_level_members_d,
						"fx_5_market2_min":two_level_members_e,
						"fx_6_market2_min":two_level_members_f,
						"fx_7_market2_min":two_level_members_g,
						//各等级伞下三级会员
						"fx_0_market3_min":three_level_members_z,
						"fx_1_market3_min":three_level_members_a,
						"fx_2_market3_min":three_level_members_b,
						"fx_3_market3_min":three_level_members_c,
						"fx_4_market3_min":three_level_members_d,
						"fx_5_market3_min":three_level_members_e,
						"fx_6_market3_min":three_level_members_f,
						"fx_7_market3_min":three_level_members_g,
						//各等级伞下四级会员
						"fx_0_market4_min":four_level_members_z,
						"fx_1_market4_min":four_level_members_a,
						"fx_2_market4_min":four_level_members_b,
						"fx_3_market4_min":four_level_members_c,
						"fx_4_market4_min":four_level_members_d,
						"fx_5_market4_min":four_level_members_e,
						"fx_6_market4_min":four_level_members_f,
						"fx_7_market4_min":four_level_members_g,
						//各等级伞下五级会员
						"fx_0_market5_min":five_level_members_z,
						"fx_1_market5_min":five_level_members_a,
						"fx_2_market5_min":five_level_members_b,
						"fx_3_market5_min":five_level_members_c,
						"fx_4_market5_min":five_level_members_d,
						"fx_5_market5_min":five_level_members_e,
						"fx_6_market5_min":five_level_members_f,
						"fx_7_market5_min":five_level_members_g,
						//各等级伞下六级会员
						"fx_0_market6_min":six_level_members_z,
						"fx_1_market6_min":six_level_members_a,
						"fx_2_market6_min":six_level_members_b,
						"fx_3_market6_min":six_level_members_c,
						"fx_4_market6_min":six_level_members_d,
						"fx_5_market6_min":six_level_members_e,
						"fx_6_market6_min":six_level_members_f,
						"fx_7_market6_min":six_level_members_g,
					},
					dataType:"json",
					success:function(data){
						alert("更新成功");
					}
				})
			})
		</script>
	</body>
</html>