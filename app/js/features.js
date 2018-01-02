// Blog Container Title Shrinker
$('.blog-container').each(function() {
	var h1 = $(this).children('h1');
	do {
		var oldLine = h1.text();
		h1.text(oldLine.substr(0, oldLine.length - 4).trim() + '...');
	} while (h1.innerHeight() > 20);
});
