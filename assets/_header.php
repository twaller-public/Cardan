<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
	<?php require_once "_head.php"; ?>
	<body role="document">
		<header>
			<?php if(@$GLOBALS['TWDS_SITE_CREATOR'] && $GLOBALS["TOP_CONTACT_BAR"]) : ?>
				<div class="container top-bar" style="max-width:1000px;"> 
				
					<!--<div class="col-lg-2 pull-right">&nbsp;</div>-->
					<div class="col-lg-12" style="/*max-width:1000px;*/">
						<div class="col-sm-6 logo-wrap" style="padding:0px;">
							<p class="pull-left">
								<?php 
									$name = explode(" ", $company_info['company_name']);
								
									echo "<a class='home-link' href='/' ><span class='logo-wrap'><img src='" . @$company_logo . "' height='125' alt='Logo' /></span>";
									echo "<span class='name-wrap'><span id='name_1'>{$name[0]}</span><br/><span id='name_2'>{$name[1]}</span></span></a>";
								?>
							</p>
						</div>
						
						<div class="col-sm-6 text-right office-wrap">
							<p class="office-list">
								<?php if($pageName == "Home Page") include "assets/_audio.php"; ?>
								<?php 
									echo $office_links;
									echo getEmailLink($company_info['contact_email']); 
								?>
							</p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		
			<?php require "_navbar.php"; ?>
		</header>