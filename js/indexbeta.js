$(document).ready(function () {
    var lastScrollTop = 0;
    var whyactive = false;
    var rushactive = false;
    var whenactive = false;
    var signupactive  = false;
    
    $(window).scroll(function (event) {
        
        var check = $(this).scrollTop();
        var st = $(this).scrollTop();
        var diff = Math.abs(lastScrollTop - st);

        //var get_current_height = $(".rowone").outerHeight() -diff;
        var getheight = 500;
        var upheight = getheight + st;
        // console.log('getcurren:' + get_current_height);
        if (st > lastScrollTop) {
            //            // downscroll code

//            $('.wraps').stop().animate({
//                transform: +upheight + "px"
//            }, 0);
//            
            $('.warps').transition({
                y: st+100,
                easing: 'ease',
                duration: 1000 }); 

        } else {
            $('.warps').transition({
                y: -st,
                easing: 'ease',
                duration: 1000 });
//            $('.wraps').stop()$.css({
//                transform: 'translate(0px,' + temp2 + 'px'
//            });
        }
        lastScrollTop = st;
    }); 
});
