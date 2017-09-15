
            $(document).ready(function() {
				/**
				* for each menu element, on mouseenter, 
				* we enlarge the image, and show both sdt_active span and 
				* sdt_wrap span. If the element has a sub menu (sdt_box),
				* then we slide it - if the element is the last one in the menu
				* we slide it to the left, otherwise to the right
				*/
                $('#sdt_menu > li').bind('mouseenter',function(){
					var $elem = $(this);
					//$(this).css('', '#000000');
					$elem.find('img')
						 .stop()
						 .animate({
							'width':'170px',
							'height':'170px',
							'left':'0px',
							"opacity" : "show"
						 },50)
						 //.stop()
						 .andSelf()
						 .find('.sdt_wrap')
					     .stop()
						 .animate({'top':'140px', "opacity" : "show"},50)
						 //.stop()
						 .andSelf()
						 .find('.sdt_active')
					     .stop()
						 .animate({'height':'170px', "opacity" : "show"},50,function(){
						var $sub_menu = $elem.find('.sdt_box');
						if($sub_menu.length){
							var left = '170px';
							if($elem.parent().children().length == $elem.index()+1)
								left = '-170px';
							$sub_menu.show().stop().animate({'left':left, "opacity" : "show"},300);
						}	
					});
				}).bind('mouseleave',function(){
					var $elem = $(this);
					var $sub_menu = $elem.find('.sdt_box');
					if($sub_menu.length)
						$sub_menu.stop().hide().css('left','0px');
					
					$elem.find('.sdt_active')
						 .stop()
						 .animate({'height':'0px'},300)
						 //.stop()
						 .andSelf().find('img')
						 .stop()
						 .animate({
							'width':'0px',
							'height':'0px',
							'left':'85px'},400)
						 //.stop()
						 .andSelf()
						 .find('.sdt_wrap')
						 .stop()
						 .animate({'top':'25px'},500);
				});
            });