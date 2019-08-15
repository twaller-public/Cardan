<?php
	require "../assets/_app_init.php";
	
	
	$pageName     = "Labourers";
	$page_record  = "labourers";
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
				
				$("header ul.navbar-nav li a[href='/pages/labourers.php']").css("color", "#ed6d00");
			});
		</script>

	</body>
</html>