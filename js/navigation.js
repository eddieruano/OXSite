// JavaScript Document
var limit = 400
;
  	$(document).ready(function(){
		$(window).scroll(function() {
		 if ($(this).scrollTop()>200)
     		{
        		$('.headercontent').fadeOut();
				switchoff();
     		}
    		else
     		{
      			$('.headercontent').fadeIn();
				switchon();
     		}
 		
		
		if ($(this).scrollTop() > limit)
     		{
        		$('.header').fadeOut();
				//switchoff();
     		}
    		else
     		{
      			$('.header').fadeIn();
				//switchon();
     		}
 		});
		
		var active = 1;
		$("#action-menu").click(function(){
			$(".headercontent").fadeToggle(500);
			if(active == 0)
			{
				switchon();
				active = 1;
			}
			else
			{
				switchoff();
				active = 0;
			}
			
		});
	});
	
	function switchon() {
	$( "#open" ).stop(true,true,true).hide();
	$( "#close" ).stop(true,true,true).fadeIn();
	
	}
	function switchoff() {
	$( "#close" ).stop(true,true,true).hide();
	$( "#open" ).stop(true,true,true).fadeIn();
	
	}
	