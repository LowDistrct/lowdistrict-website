// Slider
$(function() {
	var slides = [];
	var sel = 0;
	$('.slider-container').find('.slide').each(function() {
		slides.push($(this));
	});
	setInterval(function() {
		slides[sel].removeClass('selected');
		if (sel + 1 == slides.length) {
			sel = 0;
		}
		else {
			sel++;
		}
		slides[sel].addClass('selected');
	}, 8000);
});
// Page Selector
$(function() {
	if (_GET['page'] == undefined || _GET['page'] == '1') {
		$('.pages-container:eq(0)').hide();
	}
	else {
		$('.slider-container').hide();
		$('.header').hide();
		$('.banner').hide();
		$('.nav-container').addClass('solid');
		$('<div class="nav-clear"></div>').insertAfter($('.nav-container'));
	}
});
