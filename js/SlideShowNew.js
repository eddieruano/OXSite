


$(document).ready(function() {
  rotateRightPics(1);
  rotateLeftPics(1);
});

function rotateRightPics(currentPhoto) {
  var numberOfPhotos = $('#rightslide div').length;
  currentPhoto = currentPhoto % numberOfPhotos;
	
  $('#rightslide div').eq(currentPhoto).fadeOut(function() {
    // re-order the z-index
    $('#rightslide div').each(function(i) {
      $(this).css(
        'zIndex', ((numberOfPhotos - i) + currentPhoto) % numberOfPhotos
      );
    });
    $(this).show();
    setTimeout(function() {rotateRightPics(++currentPhoto);}, 1000);
  });
}

function rotateLeftPics(currentPhoto2) {
  var numberOfPhotos2 = $('#leftslide div').length;
  currentPhoto2 = currentPhoto2 % numberOfPhotos2;
	
  $('#leftslide div').eq(currentPhoto2).fadeOut(function() {
    // re-order the z-index
    $('#leftslide div').each(function(i) {
      $(this).css(
        'zIndex', ((numberOfPhotos2 - i) + currentPhoto2) % numberOfPhotos2
      );
    });
    $(this).show();
    setTimeout(function() {rotateLeftPics(++currentPhoto2);}, 6000);
  });
}
