$(function () {
	$('.faq_contents h1').on('click', function(){
		var ele = $(this).next();
		$(this).toggleClass('open');
		if($(this).hasClass('open')) {
			ele.css('height', $('>*', ele).outerHeight());
		} else {
			ele.css('height', 0);
		}
		return false;
	});
});
