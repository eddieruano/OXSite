// JavaScript Document

$(document).ready(function() {
	$("#slideshow").css("overflow", "hidden");

	$("ul#slides").cycle({
		fx: 'fade',
		pause: 1,
		prev: '#prev',
		next: '#next'
	});


	$("#slideshow").hover(function() {
		$("ul#slideNav").fadeIn(); 
		},
		function() {
			$("ul#slideNav").fadeOut();
		});
});


