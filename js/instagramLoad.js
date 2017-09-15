// JavaScript Document

$(document).ready(function() {
    var feed = new Instafeed({
        target: 'instafeed',
        get: 'user',
        userId: 1102870375,
        accessToken: '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df',
        link: 'true',
        resolution: 'thumbnail',
        limit: '20',
        sortBy: 'most-recent',
		after: 
		
		function () {
    var images = $("#instafeed").find('a');
    $.each(images, function(index, image) {
      var delay = (index * 75) + 'ms';
      $(image).css('-webkit-animation-delay', delay);
      $(image).css('-moz-animation-delay', delay);
      $(image).css('-ms-animation-delay', delay);
      $(image).css('-o-animation-delay', delay);
      $(image).css('animation-delay', delay);
      $(image).addClass('animated flipInX');
    });
  },
  template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="likes">&hearts; {{likes}}</div></a>'
  
		
    });
	$('#mybutton').on('click', function() {
	feed.next();
});
    feed.run();
});