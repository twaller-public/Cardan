<!-- The Image Modal -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="arrow arrow-right" style="display:none;"><span class="glyphicon glyphicon-chevron-right"></span></div>
				<div class="arrow arrow-left" style="display:none;"><span class="glyphicon glyphicon-chevron-left"></span></div>
				<img id="modal-img" src="" alt="" />
			</div>
		</div>
	</div>
</div>


<?php /*THIS SCRIPT CAUSES IMAGES CLICKED TO DISPLAY THE LARGE IMAGE MODAL.*/ ?>
<script>
$(function(){
	
	var valid_images = "body > div.container-fluid img";             //the selector for valid images
	var image_modal  = $("#imgModal");    //the modal
	var modal_image  = $("#modal-img");   //the img tag that hold the active modal image
	var arr_right    = $("div.arrow-right");
	var arr_left     = $("div.arrow-left");
	var cardan       = "https://www.cardancontracting.com";
	
	$(valid_images).on('click', function(){
		
		var full = $(this).attr("data-full");
		
		modal_image.attr("src", $(this).attr("src"));
		modal_image.attr("alt", $(this).attr("alt"));
		
		if(full){
			
			modal_image.attr("src", cardan + full);
			$("div.arrow").toggle(true);
		} 
		
		modal_image.addClass("img-responsive");
		modal_image.css("display", "inline-block");
		modal_image.css("margin", "auto");
		image_modal.modal("toggle");
	});
	
	arr_right.on("click", function(){
		
		var source   = $(this).siblings("img").attr("src");
		source = source.replace(cardan, "");
		var thumb    = $("img.img-thumbnail[data-full='" + source + "']");
		var next_img = thumb.parent().next();
		
		if(!next_img.length) next_img = thumb.parent().parent().next().children().first();    //end of the row
		if(!next_img.length) next_img = $("div.gallery div.row").first().children().first();  //end - we go back to the top
		
		
		next_img = next_img.find("img").attr("data-full");
		
		//alert(thumb.parent().next().attr("style"));
		
		modal_image.attr("src", cardan + next_img);
		
	});
	
	
	arr_left.on("click", function(){
		
		
		var source   = $(this).siblings("img").attr("src");
		source = source.replace(cardan, "");
		var thumb    = $("img.img-thumbnail[data-full='" + source + "']");
		var prev_img = thumb.parent().prev();
		
		
		
		if(!prev_img.length) prev_img = thumb.parent().parent().prev().children().last();    //start of the row
		if(!prev_img.length) prev_img = $("div.gallery div.row").last().children().last();   //start - we go to the bottom
		
		
		prev_img = prev_img.find("img").attr("data-full");
		//alert(prev_img);
		//alert(thumb.parent().next().attr("style"));
		
		modal_image.attr("src", cardan + prev_img);
	});
	
	
	
});
</script>