<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
	<?php require_once $GLOBALS["SUBSIDIARIES"]["head"]; ?>
	<body role="document">
		<header>

			<div class="container top-bar" style="max-width:1000px;"> 
			
				<!--<div class="col-lg-2 pull-right">&nbsp;</div>-->
				<div class="col-lg-12" style="/*max-width:1000px;*/">
					<div class="col-sm-6 logo-wrap" style="padding:0px;">
						<p class="pull-left">
							<?php 
								$name = explode(" ", $company_info['company_name']);
							
								echo "<a class='home-link' href='/' ><span class='logo-wrap'><img class='logo-img' src='" . @$company_logo . "' style='height:125px;width:auto;' alt='Logo' /></span>";
								if(!@$has_site_logo) echo "<span class='name-wrap'><span id='name_1'>{$name[0]}</span><br/><span id='name_2'>{$name[1]}</span></span></a>";
								else echo "</a>";
							?>
						</p>
					</div>
					
					<div class="col-sm-6 text-right office-wrap">
						<p class="office-list">
							<?php 
								echo $office_links;
								echo getEmailLink($company_info['contact_email']); 
							?>
						</p>
					</div>
				</div>
			</div>

		
			<?php require $GLOBALS["SUBSIDIARIES"]["navbar"]; ?>
		</header>