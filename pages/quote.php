<?php
	require "../assets/_app_init.php";
	$result = array();
	if(@$_REQUEST['quote-submit']) $result = doQuoteSubmission();
	
	
	$pageName     = "Get A Free Quote";
	$page_record  = "free_quote";
	$page_content = fetchStaticPage($page_record);
	$page_title   = $pageName . " | " . $company_info['company_name'];
	
	require "../assets/_header.php";
	
	if(@$GLOBALS["IMAGE_BANNER"]) imageBanner_getBannerImagesForPage($page_content);
?>

		<div class="container-fluid">
			<?php echo "<h1>" . $page_content->get("title") . "</h1>"; ?>
			<div class="col-md-8 col-md-offset-2">
				<?php 
					echo $page_content->get("content"); 
					include "../assets/_quote_form.php";
				?>
			</div>


		</div>

		<?php require "../assets/_footer.php"; ?>
		
		<script>
			$(function(){
				
				$("header ul.navbar-nav li a[href='/pages/quote.php']").css("color", "#ed6d00");
			});
		</script>

	</body>
</html>