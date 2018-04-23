$(document).ready(function(){

	var keyword = $.trim($('input[name="help_keyword"]').val());
	var noArt = $('.search-list').find('.noarticle').length;
	if (keyword != '' && noArt == 0) {
		sitem_filter(keyword);
	}

	$('input[name="help_keyword"]').bind('input propertychange', function() {
		var keyword = $.trim($(this).val());
		// $('.search-list.active .search-item').addClass('active');
		if (keyword == '') {
			// return;
		}
		sitem_filter(keyword);
	});

	function sitem_filter(keyword) {
		$('.search-item').addClass('active');
		$('.search-item').each(function(_, elm) {
			var html = $(elm).find('p').html();
			html = html.replace(/<b style="color:red;">(.*?)<\/b>/, "$1");
			if (html.indexOf(keyword) === -1) {
				$(elm).removeClass('active');
			} else {
				html = html.replace(keyword, '<b style="color:red;">'+keyword+'</b>');
			}
			$(elm).find('p').html(html);
		});
	}


	$('.search-btn').bind('click', function() {
		console.log('search');
		var href = $(this).attr('data-url');
		var keyword = $.trim($('input[name="help_keyword"]').val());
		if (keyword == '') {
			return;
		}
		href += '&keyword='+encodeURIComponent(keyword);
		location.href = href;
	});
	
});