$(function() {
	$('.index_main .slide ul').slick({
		prevArrow: '.index_main .slide .slide_arrow.l',
		nextArrow: '.index_main .slide .slide_arrow.r',
		autoplay: true,
		autoplaySpeed: 4000,
		centerMode: true,
		variableWidth: true
	});

	$('.index_event .slide ul').slick({
		prevArrow: '.index_event .slide .slide_arrow.l',
		nextArrow: '.index_event .slide .slide_arrow.r',
		autoplay: true,
		autoplaySpeed: 3000,
		centerMode: true,
		variableWidth: true
	});

	$('.index_newshop .slide .slidewrap').slick({
		prevArrow: '.index_newshop .slide .slide_arrow.l',
		nextArrow: '.index_newshop .slide .slide_arrow.r',
		autoplay: true,
		autoplaySpeed: 3000,
		centerMode: true,
		variableWidth: true
	});
});