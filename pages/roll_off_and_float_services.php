<?php
	require "../assets/_app_init.php";
	
	
	$pageName     = "Roll Off Trucks & Float Services";
	$page_record  = "roll_off_trucks_float_services";
	$page_content = fetchStaticPage($page_record);
	$page_title   = $pageName . " | " . $company_info['company_name'];
	
	require "../assets/_header.php";
	
	if(@$GLOBALS["IMAGE_BANNER"]) imageBanner_getBannerImagesForPage($page_content);
?>

		<div class="container-fluid">
			<?php echo "<h1>" . $page_content->get("title") . "</h1>"; ?>
			<div class="col-md-6 col-md-offset-3">
				<?php echo $page_content->get("content"); ?>
			</div>


		</div>

		<?php require "../assets/_footer.php"; ?>
		
		<script>
			$(function(){
				
				$("header ul.navbar-nav li a[href='/pages/roll_off_and_float_services.php']").css("color", "#ed6d00");
				$("header ul.navbar-nav li a[href='#']").css("color", "#ed6d00");
			});
		</script>

	</body>
</html>