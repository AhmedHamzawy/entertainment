// init variables
var imagesTotal = 4;
var currentImage = 0;
var thumbsTotalWidth = 0;
var slideTimer = 0;

$('a.galleryBullet' + currentImage).addClass("active");


	/* debug */ $('.slideTimer').html('slideTimer = '+window.slideTimer);

// PREVIOUS ARROW CODE
$('a.previousSlideArrow').click(function() {
	$('img.previewImage' + currentImage).fadeOut(500);
	$('h2.title' + currentImage).fadeOut(500);
	$('a.galleryBullet' + currentImage).removeClass("active");
	
	currentImage--;

	if (currentImage == 0) {
		currentImage = imagesTotal;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	$('img.previewImage' + currentImage).fadeIn(2000);
	$('h2.title' + currentImage).fadeIn(2000);

	return false;
});
// ===================


// NEXT ARROW CODE
$('a.nextSlideArrow').click(function() {
	$('img.previewImage' + currentImage).fadeOut(500);
	$('h2.title' + currentImage).fadeOut(500);
	$('a.galleryBullet' + currentImage).removeClass("active");

	currentImage++;

	if (currentImage == imagesTotal + 1) {
		currentImage = 1;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	$('img.previewImage' + currentImage).fadeIn(2000);
	$('h2.title' + currentImage).fadeIn(2000);

	return false;
});
// ===================


// BULLETS CODE
function changeimage(imageNumber) {
	$('img.previewImage' + currentImage).fadeOut(500);
	$('h2.title' + currentImage).fadeOut(500);
	currentImage = imageNumber;
	$('img.previewImage' + currentImage).fadeIn(2000);
	$('h2.title' + currentImage).fadeIn(2000);	
	$('.galleryNavigationBullets a').removeClass("active");
	$('a.galleryBullet' + imageNumber).addClass("active");
}
// ===================


// AUTOMATIC CHANGE SLIDES
function autoChangeSlides() {
	$('img.previewImage' + currentImage).fadeOut(500);
	$('h2.title' + currentImage).fadeOut(500);	
	$('a.galleryBullet' + currentImage).removeClass("active");

	currentImage++;

	if (currentImage == imagesTotal + 1) {
		currentImage = 0;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	$('img.previewImage' + currentImage).fadeIn(2000);
	$('h2.title' + currentImage).fadeIn(2000);	
}

var slideTimer = setInterval(function() {autoChangeSlides(); }, 10000);

	/* debug */ $('.slideTimer').html('slideTimer = '+window.slideTimer);
