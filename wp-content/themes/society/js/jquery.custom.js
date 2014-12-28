$(function(){
	$('#slider .a_bigImg').soChange({
		thumbObj:'#slider .soul span',
		thumbNowClass:'on',
		thumbOverEvent:false,
		botPrev:'#slider .prevBtn',
		botNext:'#slider .nextBtn',
		changeTime:3000
	});
	
	//$('#slider').mouseover(function(){
//		$('.prev_next').fadeIn();
//	})
//	$('#slider').mouseleave(function(){
//		$('.prev_next').fadeOut();
//	})
});