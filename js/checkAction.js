// JavaScript Document// JavaScript Document

$(document).ready(function() {
    var feed = new Instafeed({
        target: 'instafeed',
        get: 'user',
        userId: 1102870375,
        accessToken: '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df',
        get: 'tagged',
    tagName: 'food',
    resolution: 'thumbnail',
    sortBy: 'most-recent',
    limit: 21,
    template: '<li class="square-insta"><a href="{{link}}"><img src="{{image}}" /></a></li>',
    
});

feed.run();
});