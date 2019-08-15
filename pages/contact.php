<?php
	require "../assets/_app_init.php";
	
	
	$pageName     = "Contact Us";
	$page_record  = "contact";
	$page_content = fetchStaticPage($page_record);
	$page_title   = $pageName . " | " . $company_info['company_name'];
	
	require "../assets/_header.php";
	
	if(@$GLOBALS["IMAGE_BANNER"]) imageBanner_getBannerImagesForPage($page_content);
?>

		<div class="container-fluid">
			<?php echo "<h1>" . $page_content->get("title") . "</h1>"; ?>
			<div class="col-md-6 col-md-offset-3">
				<?php echo $page_content->get("content"); ?>
				
				<div id="map" style="height:400px;"></div>
			</div>


		</div>

		<?php require "../assets/_footer.php"; ?>
		
		<script>
			$(function(){
				
				$("header ul.navbar-nav li a[href='/pages/contact.php']").css("color", "#ed6d00");
			});
			
			function initMap() {
				
				var uluru = {lat: 43.8967823, lng: -78.6777724};
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 16,
					center: uluru
				});
				var marker = new google.maps.Marker({
					position: uluru,
					map: map
				});
			}
		</script>
		
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2GLMWhcAfBFEiKc86DZsifyn5WzwDE54&callback=initMap">
		</script>

	</body>
</html>