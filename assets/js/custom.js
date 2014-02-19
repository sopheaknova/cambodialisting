jQuery(document).ready(function($) {
  
	//Magnific Popup for Project Page
	$('#listing-gallery ul').magnificPopup({
	  	delegate: 'li a',
	  	type: 'image',
	  	image: {
	  		 titleSrc: ''
	  	},
	  	gallery: { 
	  		enabled:true
	  	},
		removalDelay: 200,
	  	mainClass: 'pxg-slide-bottom'
	});

	/*--------------------------------------------------------------------------------------*/
	/* 	Set Map auto height in Contact page 												
	/*--------------------------------------------------------------------------------------*/
	function mapHeightAuto(){
		var mapHeight = $(window).height() - $('#header').height() - $('#footer').height() - 50;
		$('#map-home-container').css("height", mapHeight);
	}
	mapHeightAuto();
  
});  