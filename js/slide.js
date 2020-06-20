// init variables
var imagesTotal = 4;
var currentImage = 0;

	

var slideTimer = setInterval(function() {autoChangeSlides(); }, 5000);



// ===================


// AUTOMATIC CHANGE SLIDES
function autoChangeSlides() {
	
			$('img.previewImage' + currentImage).fadeOut(500);
			$('a.thumbnailsimage' + currentImage).removeClass("active");
		
			currentImage++;
		
			if (currentImage == imagesTotal + 1) {
				currentImage = 1;
			}
			$('a.thumbnailsimage' + currentImage).addClass("active");
			$('img.previewImage' + currentImage).fadeIn(500);
		
		
	
}