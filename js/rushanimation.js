var lastPosition = -100;
$(document).ready(function() {
//    $('.wrapper').height($('.smooth').height());
//
//    $(window).resize(function() {
//        $('.wrapper').height($('.smooth').height());
//    });

//    $('.flat-button').click(function() {
//        $(".smooth").clearQueue().css({
//            transform: 'translate3d(0px, -' + $('.toggle').offset().top + 'px, 0px)'
//        });
//        $(window).scrollTop($('.toggle').offset().top);
//        return false;
//    });
});

var scroll = window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    // IE Fallback, you can even fallback to onscroll
    function(callback) {
        window.setTimeout(callback, 1000 / 60)
    };

function loop() {

    // Avoid calculations if not needed
    if (lastPosition == window.pageYOffset) {
        scroll(loop);
        return false;
    } else lastPosition = window.pageYOffset;
  
    var transform = 'translate3d(0px, -' + lastPosition + 'px, 0px)';
    var smoothScoll = $(".smooth")[0];
  
    smoothScoll.style.webkitTransform = transform;
    smoothScoll.style.mozTransform = transform;
    smoothScoll.style.transform = transform;
    
  
    scroll(loop)
}

// Call the loop for the first time
loop();


// Old Code
//var scrollTimer = null;
//var scrollPosition = null;
//var busy = false;

//$( document ).ready(function() {
//  var scrollTimer = null;
//  $('.wrapper').height($('.smooth').height()-20);

//  $(window).scroll(function () {
//    scrollPosition = window.pageYOffset;
//    if (scrollTimer) {
//      clearTimeout(scrollTimer);
//    }
//    scrollTimer = setTimeout(requestAnimFram, 10)
//  });

//  $(window).resize(function () {     
//    $('.wrapper').height($('.smooth').height());
//  });
//});

//function requestAnimFram(){
//  if(busy)return;
//  busy = true;
//  window.requestAnimationFrame(scrollerize);
//}

//function scrollerize() {

//    $(".smooth").clearQueue().css({
//      transform: 'translate3d(0px, -' + scrollPosition + 'px, 0px)'
//    });
//    busy = false;

//}