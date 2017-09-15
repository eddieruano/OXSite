// JavaScript Document

$(document).ready(function() {
	$('#duesdiv').click(function() {
		$('#dues').fadeToggle([200]);
		$('.linklist1').toggleClass("dropped");
	});
	
	$('#brosdiv').click(function() {
		$('#bros').fadeToggle([200]);
		$('.linklist2').toggleClass("dropped");
	});
	
	$('#phildiv').click(function() {
		$('#phil').fadeToggle([200]);
		$('.linklist3').toggleClass("dropped");
		
	});
	
	
	
	
	
	
	
	
	
	
	
});