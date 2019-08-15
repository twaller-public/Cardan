<?php
	require "../assets/_app_init.php";
	
	//adoptGalleryUploadsFromDir($_SERVER["DOCUMENT_ROOT"] . "/img/Showcase Photos/", "gallery_images", "image");
	
	
	$pageName     = "Showcase Gallery";
	$page_record  = "showcase_gallery";
	$page_content = fetchStaticPage($page_record);
	$page_title   = $pageName . " | " . $company_info['company_name'];
	
	$imageData = simple_gallery_getImages("gallery_images", "image", "thumbUrlPath2", "thumbUrlPath");
	
	require "../assets/_header.php";
	
	if(@$GLOBALS["IMAGE_BANNER"]) imageBanner_getBannerImagesForPage($page_content);
?>

		<div class="container-fluid">
			<?php echo "<h1>" . $page_content->get("title") . "</h1>"; ?>
			<div class="col-md-8 col-md-offset-2 gallery">
				<?php 
					echo $page_content->get("content");
					echo simple_gallery_showGallery($imageData, 4);
				?>
			</div>


		</div>

		<?php require "../assets/_footer.php"; ?>
		
		<script>
			$(function(){
				
				$("header ul.navbar-nav li a[href='/pages/gallery.php']").css("color", "#ed6d00");
			});
		</script>

	</body>
</html>