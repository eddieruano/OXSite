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

            $('.rowone').stop().animate({
                height: +upheight + "px"
            }, 0);
            
            

            //
            //
        } else {
            //            //var temp2 = st*(0.05);
            //            var newheight = getheight - st;
            //console.log('Downheight:' + clickCount);
            $('.rowone').stop().animate({
                height: +upheight + "px"
            }, 0);

            //
        }
        //        
        //        if(st === 100)
        //        {
        //            $('.headercontent').fadeOut();
        //        }
        lastScrollTop = st;
        