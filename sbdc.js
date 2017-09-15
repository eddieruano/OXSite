// JavaScript Document


/*Array of images which you want to show: Use path you want.
var images=new Array('Images/frontpage/sbdc/alpha.jpg','Images/frontpage/sbdc/crowd.jpg','Images/frontpage/sbdc/gphi.jpg');
var nextimage=0;

function doSlideshow(){
    if(nextimage>=images.length){nextimage=0;}
    $('#body')
    	.css('background-image','url("'+images[nextimage++]+'")').fadeOut(500)
		.fadeIn(2000, function(){
        	setTimeout(doSlideshow, 3000);
    });
}
*/



$(function(){
	setTimeout(function(){
		$('body').addClass('loaded');
		$('h1').css('color','#222222');
	}, 3000);
	$('#body')
		.hide()
		.fadeIn(4000);
	$('#lowbody').hide().delay(10000).fadeIn(1000);
	//$('#national')
	//	.hide()
	//	.fadeIn(1000);
	$("html, body")
		.delay(5000)
		.animate({ scrollTop: $('#body').offset().top }, 1500);
	$('#body')
		.hide()
		.fadeIn(500).delay(3000);
		//.css("background-size", "cover")
		//.css("background-repeat", "no-repeat")
		//.css("border-radius", "0px")
		//.css("width", "100%")
		//.css("background-image", "url(Images/frontpage/sbdc/alpha.jpg)")
		//.css("height", "700px")	
	rotatePics(1);
	
//doSlideshow();
});
/*

function rotatePics(currentPhoto) {
  var numberOfPhotos = $('#slideshow div').length;
  currentPhoto = currentPhoto % numberOfPhotos;
	
  $('#slideshow div').eq(currentPhoto).fadeOut(function() {
    // re-order the z-index
    $('#slideshow div').each(function(i) {
      $(this).css(
        'zIndex', ((numberOfPhotos - i) + currentPhoto) % numberOfPhotos
      );
    });
    $(this).show();
    setTimeout(function() {rotatePics(++currentPhoto);}, 1000);
  });
}

/*$(document).ready(function() {
  rotateRightPics(1);
});*/

function rotatePics(currentPhoto) {
  var numberOfPhotos = $('#slideshow div').length;
  currentPhoto = currentPhoto % numberOfPhotos;
	
  $('#slideshow div').eq(currentPhoto).fadeOut(function() {
    // re-order the z-index
    $('#slideshow div').each(function(i) {
      $(this).css(
        'zIndex', ((numberOfPhotos - i) + currentPhoto) % numberOfPhotos
      );
    });
    $(this).show();
    setTimeout(function() {rotatePics(++currentPhoto);}, 3000);
  });
}


/*$(window).load(function() {
	changePics();
  // Handler for .load() called.
});




function changePics() {
	$("#body")
		.fadeOut(500)
		.css("background-image", "url(Images/frontpage/sbdc/crowd.jpg)")
		.fadeIn(500)

}*/
	
