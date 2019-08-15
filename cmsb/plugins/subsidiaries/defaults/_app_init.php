<?php


/**
*
*	App Initialization file for subsidiary sites - default
*
*/


//showme(@$_REQUEST);



/**
*	load any program-wide information
*	- all of the functions in the block are from the TWDS plugin.
*/
	
twds_sc_libInclude();
imageBanner_updateFileIncludes();

$head_includes   = fetchDefaultHeadIncludes();
$foot_includes   = fetchDefaultFootIncludes();
$company_info    = getCompanyInfoArray();
$company_offices = getCompanyOfficeArray();
$office_links    = getOfficeLinks($company_offices);
$footer_office   = getOfficeLinks($company_offices, false);

$company_logo    = $company_info["logo"][0]["xs"];
$footer_logo     = $company_info["logo"][1]["xs"];
 



/**
*	Load the home page record - we use some of the data
*/

$home_content  = fetchStaticPage("home_page");
$company_group = $home_content->get("mid_content");



/**
*	Determine the site we are looking for and load the site record
*/
$site      = @$_REQUEST["site"];
$site_info = new SingleRecordType($site);
$menu_json = $site_info->get("menu_items");
$menu_json = trim($menu_json);

$site_name         = $site_info->get("site_name");
$site_video        = $site_info->get("video_url");
$site_footer_image = $site_info->get("footer_image");
$site_footer_image = $site_footer_image[0]["urlPath"];


$site_logo = $site_info->get("site_logo");
if($site_logo){
	
	$has_site_logo = true;
	$site_logo     = $site_logo[0]["urlPath"];
	$company_logo  = $site_logo;
}
else $has_site_logo = false;


/**
*	Determine the page we are looking for and load the page record
*/
$page      = @$_REQUEST["page"];
$page_info = new SingleRecordType($page);
$is_home   = explode("_", $page)[0] == "home";





$page_content       = $page_info->get("content");
$site_video_content = strpos($page_content, "##SITE_VIDEO##");
$video_tag          = "<div class='embed-responsive embed-responsive-16by9'><iframe src='".$site_video."' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe></div>";
$page_content       = str_replace("##SITE_VIDEO##", $video_tag, $page_content);






//seo values
$page_title    = $page_info->get("title")            ?: $site_info->get("default_title");
$page_meta     = $page_info->get("meta_description") ?: $site_info->get("default_meta_description");
$page_keywords = $site_info->get("default_meta_keywords");



/**
* The menu items array - this information comes from the site record
*/

$menuItems = json_decode($menu_json, true);
if($menuItems === NULL) echo "could not decode menu: " . json_last_error_msg();




/**
*	Load Accordion Records for this page
*/

$accSplit          = $page_info->get("accordion_split");
$accordions        = accordion_fecthAccordionsForPage($page, $accSplit);
list($acc1, $acc2) = accordion_getHTMLFromRecords($accordions, $accSplit);

//foreach($accordions as $r) showme($r);
//foreach($acc_r as $r) echo $r->get("pages") . "<br />";



/**
*	Load the gallery images for this page - ONLY IF SHOWCASE PAGE
*/

$gallery = explode("_", $page)[0] == "gallery";
$imgData = null;

if($gallery){  $imageData = simple_gallery_getImages("gallery_images", "image", "thumbUrlPath2", "thumbUrlPath"); }





//showme($menuItems);




//showme($site_info->values());
//showme($page_info->values());



?>