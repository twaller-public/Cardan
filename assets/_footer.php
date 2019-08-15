	<footer>
		<div class="container-fluid">

			<div class="row quote-bar text-center">
				<button class="btn btn-lg cardan-btn" type="button" onClick="location.href = '/pages/quote.php'">
					<img src='/img/quote-request-button.png' alt="Request Quote" height='50' width='auto' />
				</button>
			</div>
			
			<div class="row text-center contact-prompt" style="padding:15px 0 5px 0">
				<p><a href="#">Contact Us</a> To Discuss Your Next project And The Services We Provide</p>
			</div>
		</div>
		<div class="container-fluid bottom-bar">
			
			<?php if(@$GLOBALS['TWDS_SITE_CREATOR'] && $GLOBALS["BOTTOM_CONTACT_BAR"]) : ?>
				<div class="row" style="/*width:1170px; */max-width:900px; margin:auto;"> 
					<div class="col-lg-12 contact-wrap"> 
						<div class="col-sm-3">
							<a class='home-link' href='/' >
								<span class='logo-wrap'>
									<img src='<?php echo @$footer_logo; ?>' alt='Logo' height='80' width='auto' />
								</span>
							</a>
						</div>
						<div class="col-sm-9 links" style="padding:0px;">
							<?php 
								echo $footer_office; 
								echo getEmailLink($company_info['contact_email']); 
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if(@$GLOBALS["FOOTER_NAVBAR"]) require "_footer_navbar.php"; ?>
		</div>
	</footer>
	<?php echo @$foot_includes; ?>
	<script>
		$(function(){
			
			
			$(".dropdown").hover(
				function(){
					if($(document).width() < 902) return;
					$(this).find(".dropdown-menu").show();
				},
				function(){
					if($(document).width() < 902) return;
					$(this).find(".dropdown-menu").hide();
				}
			);
			
			$("table").addClass("table");
			//$("table").closest("div").addClass("table-responsive");
			
			$("body > div.container-fluid img").addClass("img-responsive");
			$("iframe").addClass("embed-responsive-item");
			$("iframe").parent().addClass("embed-responsive");
			$("iframe").parent().addClass("embed-responsive-16by9");
			//$("iframe").parent().css("min-height", "400px");
		});
	</script>
	
	<?php if(@$GLOBALS["IMAGE_MODAL"]) require "_image_modal.php"; ?>