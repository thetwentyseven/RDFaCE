

jQuery(document).ready(function(){
		  jQuery('.bxslider').bxSlider({
			auto: false,
		  	adaptiveHeight: true,
		  	infiniteLoop: true
		  });
		});
		
jQuery(function(){
	jQuery('.nav-menu').slicknav({
	});
});


function hefct() {
	var scrollPosition = jQuery(window).scrollTop();
	jQuery('.header-image').css('top', (0 - (scrollPosition * 0.2)) + 'px');
}

jQuery(document).ready(function() {
	jQuery(window).bind('scroll', function() {
		hefct();
	});		

});	

jQuery(document).ready(function() {
		jQuery("#site-navigation").css('left','-200px');
		jQuery("#nav-button").toggle(
			function() {
				jQuery("#nav-button").animate({
					left: "240"
					}, 500, "linear");
				jQuery("#site-navigation").animate({
					left: "0"
				}, 500, "linear");
			},
			function() {
				jQuery("#nav-button").animate({
					left: "40"
					}, 500, "linear");
				jQuery("#site-navigation").animate({
					left: "-200"
				}, 500, "linear");
			}
		);
	});