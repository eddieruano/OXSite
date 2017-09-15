/*
var fadeinBox = $("#box2");
var fadeoutBox = $("#box1");

function fade() {
    fadeinBox.stop(true, true).fadeIn(2000);
    fadeoutBox.stop(true, true).fadeOut(2000, function() {
        var temp = fadeinBox;
        fadeinBox = fadeoutBox;
        fadeoutBox = temp;
        setTimeout(fade, 1000);
    });
}

fade()*/





$(function(){
	$('.rightslide img:gt(0)').hide();
	setInterval(function(){
		$('.rightslide :first-child')
		.fadeOut(1000)
		.next()
		.fadeIn(1000)
		.end()
		.appendTo('.rightslide');}, 
		4000);
});

$(function(){
	$('.slide img:gt(0)').hide();
	setInterval(function(){
		$('.slide :first-child')
		.fadeOut(1000)
		.next()
		.fadeIn(1000)
		.end()
		.appendTo('.slide');}, 
		4000);
});

$(".leftslide > div:gt(0)").hide();

setInterval(function() { 
  $('.leftslide > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('.leftslide');
},  3000);


