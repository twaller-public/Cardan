<?php

/**
*	This file is the basic application initiation file. Include this file on all pages that
*	require access to the CMS.
*
*	Author: Tom Waller 2017
*
*/

/**
* CARDAN CONTRACTING
*/




/**
* This setting determines whether or not we have installed TWDS plguin onto the CMS for this project.
*/
$GLOBALS["REQUIRE_TWDS"]    = TRUE;



/**
* OTHER GENERAL SITE SETTINGS 
*/
$GLOBALS["TOP_CONTACT_BAR"]    = TRUE;    //the contact information for the company in the header section
$GLOBALS["BOTTOM_CONTACT_BAR"] = TRUE;    //the contact information for the company in the footer section
$GLOBALS["VISITOR_COUNT"]      = FALSE;   //the (twds) visitor count add-on
$GLOBALS["FOOTER_NAVBAR"]      = FALSE;   //showing a navbar in the site footer 
$GLOBALS["IMAGE_MODAL"]        = TRUE;
$GLOBALS["IMAGE_BANNER"]       = TRUE;




/**
* Load Viewer Library - DO NOT CHANGE
*/
$libraryPath = 'cmsb/lib/viewer_functions.php';
$dirsToCheck = array('','../','../../','../../../');
foreach ($dirsToCheck as $dir) { if (@include_once("$dir$libraryPath")) { break; }}
if (!function_exists('getRecords')) { die("Couldn't load viewer library, check filepath in sourcecode."); }




/**
* Quit the program if twds plugin is supposed to be installed, but isn't
*/
if($GLOBALS["REQUIRE_TWDS"] && !$GLOBALS['TWDS_SITE_CREATOR']) die("TWDS Plugin Not installed Correctly.");




/**
* load any twds specific information
* - all of the functions in the block are from the TWDS plugin.
*/
if(@$GLOBALS['TWDS_SITE_CREATOR']){
	
	twds_sc_libInclude();
	
	$head_includes   = fetchDefaultHeadIncludes();
	$foot_includes   = fetchDefaultFootIncludes();
	$company_info    = getCompanyInfoArray();
	$company_offices = getCompanyOfficeArray();
	$office_links    = getOfficeLinks($company_offices);
	$footer_office   = getOfficeLinks($company_offices, false);

	$company_logo    = $company_info["logo"][0]["xs"];
	$footer_logo     = $company_info["logo"][1]["xs"];
 

	if(@$GLOBALS["VISITOR_COUNT"]) processVisitor();     //visitor counter - update the count if applicable
}


/**
* The menu items array
*/
$menuItems = array(
	array(
		"name" => "/index.php",
		"text" => "Home",
	),
	array(
		"name" => "/pages/about.php",
		"text" => "About",
	),
	array(
		"name" => "/pages/quote.php",
		"text" => "Free Quote",
	),
	array(
		"name" => "/pages/labourers.php",
		"text" => "Labourers",
	),
	array(
		"name" => "/pages/service_men.php",
		"text" => "Service Men",
		"subMenus" => array(
			array(
				"name" => "/pages/working_at_heights.php",
				"text" => "Working At Heights Training"
			),
		),
	),
	array(
		"name" => "#",
		"text" => "Trucks/Equipment",
		"attr" => array(
			"disabled" => true,
			"style" => "cursor:text;"
		),
		"subMenus" => array(
			array(
				"name" => "/pages/boom_crane_excavator.php",
				"text" => "Demolition & Excavation"
			),
			array(
				"name" => "/pages/water_supply.php",
				"text" => "Water Supply"
			),
			array(
				"name" => "/pages/hydrovac.php",
				"text" => "Hydrovac"
			),
			array(
				"name" => "/pages/road_cleaners.php",
				"text" => "Road Cleaning"
			),
			array(
				"name" => "/pages/rolloff_bins.php",
				"text" => "Waste Management"
			),
			array(
				"name" => "/pages/roll_off_and_float_services.php",
				"text" => "Roll Off Trucks & Float Services"
			),
		),
	),
	array(
		"name" => "/pages/gallery.php",
		"text" => "Showcase",
	),
	array(
		"name" => "/pages/contact.php",
		"text" => "Contact",
	),
);



/**
* Functions
*/



function doQuoteSubmission(){
	
	$errors = array(
		"Errors"           => false,
		"First Name"       => false,
		"Last Name"        => false,
		"Company Name"     => false,
		"Email Address"    => false,
		"Phone Number"     => false,
		"Service Required" => false,
		"Start Date"       => false,
	);
	
	foreach(@$_REQUEST as $field=>$val){
		
		$new_field = str_replace("_", " ", $field);
		$_REQUEST[$new_field] = $_REQUEST[$field];
		if($field != "quote-submit") unset($_REQUEST[$field]);

		if(array_key_exists($new_field, $errors) && !$val){
			$errors[$new_field]   = true;
			$errors["Errors"] = true;
		} 
	}
	
	if(!$errors["Errors"]){
		
		sendQuoteEmail();
		$_REQUEST = array("quote-submit" => 1);
	}
	return $errors;
}



function sendQuoteEmail(){
	
	$to       = "services@cardancontracting.com";
	$subject  = "Quote Request From Submission";
	$message  = buildQuoteEmailText();
	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <webmaster@cardancontracting.com>' . "\r\n";
	
	mail($to,$subject,$message,$headers);
	//echo $message;
}



function buildQuoteEmailText(){
	
	$text = "You Have received a request for a quote. Here are the details: <br /><br />";
	
	foreach(@$_REQUEST as $field=>$val){
		
		if($field == "quote-submit") continue;
		$text .= "$field : $val<br />";
	}
	
	return $text;
}




?>