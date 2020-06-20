 // rating script
$(function(){ 
	$('.rate-btn').hover(function(){
		$('.rate-btn').removeClass('rate-btn-hover');
		var therate = $(this).attr('id');
		for (var i = therate; i >= 0; i--) {
			$('.rate-btn-'+i).addClass('rate-btn-hover');
		};
	});
	

});