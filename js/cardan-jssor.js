$(function(){

	if(banners_length < 2){
		$("span.jssora22l, span.jssora22r").hide();
		$("span.jssora22l, span.jssora22r").css("background-color", "rgba(0,0,0,0)");
		
	}
	jssor_1_slider_init();
})





jssor_1_slider_init = function() {

	//var last_height = 50000;

	var jssor_1_options = {
	  $AutoPlay: true,
	  $SlideDuration: 800,
	  $SlideEasing: $Jease$.$OutQuint,
	  $FillMode: 1,
	  $ArrowNavigatorOptions: {
		$Class: $JssorArrowNavigator$
	  },
	  $BulletNavigatorOptions: {
		$Class: $JssorBulletNavigator$,
		$ChanceToShow: 2
	  }
	};

	var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

	//responsive code begin
	//you can remove responsive code if you don't want the slider scales
	//while window resizes
	function ScaleSlider() {
		var parentWidth = $('#jssor_1').parent().width();
		//console.log(parentWidth);
		if (parentWidth) {
			//for example minHeight is 200;
			var minHeight = 200;

			var newWidth = parentWidth;
			var newHeight = jssor_1_slider.$OriginalHeight() / jssor_1_slider.$OriginalWidth() * newWidth;

			if (newHeight < minHeight){
				
				//jssor_1_slider.$ScaleWidth(parentWidth);
				jssor_1_slider.$ScaleHeight(minHeight);
				
			}	
			else{
				
				jssor_1_slider.$ScaleWidth(parentWidth);
				//$('#jssor_1 div[data-u="slides"]').width(parentWidth);
			}
			
				
		}
		/*
		if (parentWidth) {
			//console.log("height: " + height);
			jssor_1_slider.$ScaleWidth(parentWidth);
		}*/
		else
			window.setTimeout(ScaleSlider, 30);
	}
	//Scale slider after document ready
	ScaleSlider();
	
	
	function scaleImage(){
		
		var width = $("body").width();
		
		if(width < 500){
			$(".jssor-img, .jssor-img-wrap, .jssor-load-wrap").width(width + (width * 0.5));
			$("#jssor_1").width(width);

		} 
		else $("#jssor_1, .jssor-img, .jssor-img-wrap, .jssor-load-wrap").width("100%");
	}

	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
	//responsive code end
	
	
	$(window).bind("load", scaleImage);
	$(window).bind("resize", scaleImage);
	$(window).bind("orientationchange", scaleImage);
};