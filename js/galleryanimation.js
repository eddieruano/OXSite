
    
    // All images need to be loaded for this plugin to work so
    // we end up waiting for the whole window to load in this example
    $(window).load(function () {
        $(document).ready(function(){
    var all_pics;
    var needed_pics;
    var garbage;
            all_pics = $('.all').clone();
            collage();
            //$('.Collage').collageCaption();
      
		 //ends button
        });
    });

    // Here we apply the actual CollagePlus plugin
    function collage() {
        $('.Collage').removeWhitespace().collagePlus(
            {
				'effect' : 'effect-2',
                //'fadeSpeed'     : 2000,
                //'targetHeight'  : 400
            }
        );
    };

    // This is just for the case that the browser window is resized
    var resizeTimer = null;
    $(window).bind('resize', function() {
        // hide all the images until we resize them
        $('.Collage .Image_Wrapper').css("opacity", 0);
        // set a timer to re-apply the plugin
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(collage, 200);
		//if variable set from button clicks above (in seperate function later) then refilter them
        //
    });

