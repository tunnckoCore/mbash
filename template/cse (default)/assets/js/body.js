$(window).load(function() {    

	var theWindow        = $(window),
	    $background      = $("#background"),
	    aspectRatio      = $background.width() / $background.height();

	function resizeBg() {

		if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
		    $background
		    	.removeClass()
		    	.addClass('bodyheight');
		}

	}

	theWindow.resize(function() {
		resizeBg();
	}).trigger("resize");

});