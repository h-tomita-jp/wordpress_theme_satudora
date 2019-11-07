$(function() {
	$('.column_prev_next, .column_relation').each(function() {
		var my_ele = $(this).clone();
		my_ele.removeClass('pc');
		$('#sp_clone').append(my_ele);
	})


	$('.column_relation .slide').each(function() {
		var prev_arrow = $('.slide_arrow.l', this);
		var next_arrow = $('.slide_arrow.r', this);
		$('ul', this).slick({
			prevArrow: prev_arrow,
			nextArrow: next_arrow,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 680,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerMode: true,
					variableWidth: true
				}
			}]
		});
	})

});