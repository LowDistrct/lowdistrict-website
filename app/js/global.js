// GET variables
var _GET = []
var string = window.location.search.substr(1);
var props = string.split('&');
for (var i in props) {
	var prop = props[i];
	var key = prop.split('=')[0].toLowerCase();
	var value = prop.split('=')[1];
	if (value == undefined) {
		value = '';
	}
	_GET[key] = value;
}

// Background Image Shortcut
$('*[bg]').each(function() {
	$(this).css('background-image', 'url("' + $(this).attr('bg')  + '")')
	$(this).removeAttr('bg')
});

// Resize Event
$(window).on('scroll', function() {
	// Navigation Collapse
	$(function() {
		if ($(window).scrollTop() > 10) {
			$('.nav-container').addClass('collapse');
		}
		else {
			$('.nav-container').removeClass('collapse');
		}
	});
});

// Navigation ClearFix
$(window).on('class-change', function() {
	if ($('.nav-container').hasClass('solid')) {
		$('.nav-clear').show();
	}
	else {
		$('.nav-clear').hide();
	}
});

// Event Triggers
$(window).trigger('scroll');
$(window).trigger('class-change');
