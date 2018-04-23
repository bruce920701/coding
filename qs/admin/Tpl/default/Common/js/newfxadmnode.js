$(document).ready(function(){
	var type_box = $(".list-box").find(".type-"+type+"");
	var top = $(type_box).offset().top;	
	$("html,body").animate({scrollTop:top},"fast","swing");
	$(".list-box").find(".type-"+type+"").find("span").attr("style","color:#ff9600;");
//	$(".back-select-"+type+"").find(".item-info-content").addClass("back_select");
});