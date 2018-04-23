$(document).on("pageInit", "#store_imgs", function(e, pageId, $page) {
	//切换
    $(".j-list-choose").on('click', function() {

        var $me = $(this);
        var rel = parseInt($(this).attr("rel"));
        $(".j-list-choose").removeClass("active");
        $me.addClass('active');
        var _index = $me.index();
        $('.store-img').removeClass('active');
        $('.store-img').eq(_index).addClass('active');
        if ($me.hasClass("active")) {
            var ac_left = $(".j-list-choose.active span").offset().left;
            $('.list-nav-line').css("left", ac_left);
        }
    });
    var ac_left = $(".j-list-choose.active span").offset().left;
    var ac_width = $(".j-list-choose.active span").width();
    $('.list-nav-line').css({ "left": ac_left, "width": ac_width });

    
});