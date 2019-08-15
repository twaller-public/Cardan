<?php

	/**
	* Load Viewer Library - DO NOT CHANGE
	*/
	$libraryPath = $_SERVER["DOCUMENT_ROOT"].'/cmsb/lib/viewer_functions.php';
	include_once("$libraryPath");
	if (!function_exists('getRecords')) { die("Couldn't load viewer library, check filepath in sourcecode."); }


	require $GLOBALS["SUBSIDIARIES"]["init"];
	
	

	
	require $GLOBALS["SUBSIDIARIES"]["header"];
	
	imageBanner_getBannerImagesForSubsidiaryPage($page_info);
?>

		<div class="container-fluid">
			
			<div class="row" style="padding:0px;">
				<?php echo "<h1>" . $page_info->get("page_name") . "</h1>"; ?>
				
				
				<?php if(@$acc1) : ?>
					<!-- Accordion Section 1 -->
					<div class="col-md-8 col-md-offset-2">
						<?php echo $acc1; ?>
					</div>
				<?php endif; ?>
				
				
				<div class="<?php echo ($is_home? "col-md-12" : "col-md-8 col-md-offset-2"); ?> sub-content">
					
					<?php echo $page_content; ?>
				</div>
				
				
				<?php if($gallery) : ?>
					<div class="col-md-8 col-md-offset-2 gallery">
						<br />
						<?php echo simple_gallery_showGallery($imageData, 4); ?>
					</div>
				<?php endif; ?>
				
				
				<?php if(@$acc2) : ?>
					<!-- Accordion Section 2 -->
					<div class="col-md-8 col-md-offset-2">
						<?php echo $acc2; ?>
					</div>
				<?php endif; ?>
				
				
				<?php if($site_video_content === FALSE) : ?>
					<div class="col-md-6 col-md-offset-3">
						<br />
						<br />
						<div class="embed-responsive embed-responsive-16by9">
							<iframe src="<?php echo $site_video; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
						<br />
					</div>
				<?php endif; ?>
			</div>


		</div>

		<?php require $GLOBALS["SUBSIDIARIES"]["footer"]; ?>
		
		<script>
			$(function(){
				
				subsidiary_fixMenuLinks();
				subsidiary_accordions();
				subsidiary_setActiveMenuLink();
				
				//$("header ul.navbar-nav li a[href='/pages/about.php']").css("color", "#ed6d00");
				
				$("a.sidemenu-toggle").hover(
					function(){ $(this).siblings("ul.sidedrop-menu").show(); },
					function(){ $(this).siblings("ul.sidedrop-menu").hide(); }
				);
				
				
				
				$("ul.sidedrop-menu").hover(
					function(){ $(this).show(); },
					function(){ $(this).hide(); }
				);
			});
			
			
			
			function subsidiary_setActiveMenuLink(){
				
				var page = window.location.href;
				var path = window.location.pathname;
				
				if(path == "/") page += "home";
				
				$("header ul.navbar-nav li a[href='"+page+"']").css("color", "#ed6d00"); 
			}
			
			
			//this function replaces the incorrect href values with the
			//correct values for the subsidiary domain
			function subsidiary_fixMenuLinks(){
				
				var host = window.location.hostname;
				
				$("div.subsidiary-banners a[href*='"+host+"']").parent().remove();
				
				
				host     = host.split(".");
				
				$("div.subsidiary-banners a[href*='"+host+"']").parent().remove();
				
				$("#bs-example-navbar-collapse-1 a").each(function(){
					
					var page = "";
					var href = $(this).attr("href");
					
					if(href == "#") return true;
						
					href    = href.split(".");
					page    = href[2].split("/");
					href[1] = host[1];
					page[0] = host[2];
					href[2] = page.join("/");
					href    = href.join(".");
					
					$(this).attr("href", href);
				});
			}
			
			
			
			function subsidiary_accordions(){
					
				$("a.acc-rm").on("click", function(e){
					
					e.preventDefault();
					
					var parent = $(this).parent();
					var hidden = parent.find("div.acc-hidden");
					
					hidden.toggle();
					
					if(hidden.is(":visible")) $(this).text("Read Less...");
					else $(this).text("Read More...");
				});
			}
		</script>

	</body>
</html>