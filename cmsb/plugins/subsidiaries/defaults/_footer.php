	<footer>
		<div class="container-fluid">

			<div class="row quote-bar text-center" style="padding:20px 0px;">
				<button class="btn btn-lg cardan-btn" type="button" onClick="location.href = 'https://www.cardancontracting.com/pages/quote.php'">
					<img src='https://www.cardancontracting.com/img/quote-request-button.png' alt="Request Quote" height='50' width='auto' />
				</button>
				<p class="contact-prompt">Or Call CARDAN <?php echo $site_name; ?> today<br /> at <span class="contact-link phone-link" onclick="window.location.href = &quot;tel:9056979200&quot;">905-697-9200</span> for a free estimate.</p>
			</div>
			
			<!--
			<div class="row text-center contact-prompt" style="padding:15px 0 5px 0">
				<p><a href="#">Contact Us</a> To Discuss Your Next project And The Services We Provide</p>
			</div>
			-->
		</div>
		
		
		<div class="container-fluid" style="padding:0; background-color:#FFF;">
		
			<div class="col-md-12 text-center" style="padding:0;">
				<br />
				<img class="img-responsive" src="<?php echo $site_footer_image; ?>" alt="<?php $page_info->get("page_name"); ?>" />
			</div>
		</div>
		
		<div class="container-fluid" style="background-color:#FFF;">
		
			
		
			<div class="col-md-8 col-md-offset-2 subsidiary-banners">
				<?php echo $company_group; ?>

			</div>
		</div>
		
		
		
		<div class="container-fluid bottom-bar" style="border-top:8px solid rgb(237, 109, 0);">
			

			<div class="row" style="/*width:1170px; */max-width:900px; margin:auto;"> 
				<div class="col-lg-12 contact-wrap"> 
					<div class="col-sm-3">
						<a class='home-link' href='https://www.cardancontracting.com' >
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

			
			<?php //if(@$GLOBALS["FOOTER_NAVBAR"]) require "_footer_navbar.php"; ?>
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
			
			$("div.subsidiary-banners img").addClass("img-responsive");
			$("iframe").addClass("embed-responsive-item");
			$("iframe").parent().addClass("embed-responsive");
			$("iframe").parent().addClass("embed-responsive-16by9");
			//$("iframe").parent().css("min-height", "400px");
		});
	</script>
	
	<?php require "_image_modal.php"; ?>