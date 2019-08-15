<?php
/*
Plugin Name: Subsidiaries
Description: This plugin allows multiple domains to access the page content on a sigle CMS installation.
Version: 1.00
CMS Version Required: 3.00
*/

// Don't run from command-line (cron scripts can error when certain CGI env vars aren't set)
if (inCLI()) { return; }



/**
*	CONFIGURATION SETTINGS
*/


//the main site the subsidiaryies request info from
$GLOBALS["SUBSIDIARIES"]["main_site"]  = "https://www.cardancontracting.com";



//endpoint
$GLOBALS["SUBSIDIARIES"]["endpoint_url"]  = "/subsidiary/endpoint.php";


/**
*	ENDPOINT STARTER CODE:                       /\
*	copy this code snippet into the endpoint file defined above to start
*	processing subsidiary site requests

	require_once "../assets/_app_init.php";

	if(!@$GLOBALS['SUBSIDIARIES_PLUGIN']){
		
		header("Location: http://www.cardancontracting.com");
		exit;
	}

	subsidiary_processRequest();
	echo json_encode($GLOBALS["subsidiary_response"]);
	exit;

*/


$GLOBALS["SUBSIDIARIES"]["page_html"]     = "https://www.cardancontracting.com/cmsb/plugins/subsidiaries/defaults/page.php"; //$_SERVER["DOCUMENT_ROOT"] . "/subsidiary/page.php";   //"/cmsb/plugins/subsidiaries/defaults/page.php";
$GLOBALS["SUBSIDIARIES"]["init"]          = $_SERVER["DOCUMENT_ROOT"]."/cmsb/plugins/subsidiaries/defaults/_app_init.php";
$GLOBALS["SUBSIDIARIES"]["head"]          = $_SERVER["DOCUMENT_ROOT"]."/cmsb/plugins/subsidiaries/defaults/_head.php";
$GLOBALS["SUBSIDIARIES"]["header"]        = $_SERVER["DOCUMENT_ROOT"]."/cmsb/plugins/subsidiaries/defaults/_header.php";
$GLOBALS["SUBSIDIARIES"]["navbar"]        = $_SERVER["DOCUMENT_ROOT"]."/cmsb/plugins/subsidiaries/defaults/_navbar.php";
$GLOBALS["SUBSIDIARIES"]["footer"]        = $_SERVER["DOCUMENT_ROOT"]."/cmsb/plugins/subsidiaries/defaults/_footer.php";
$GLOBALS["SUBSIDIARIES"]["footer_navbar"] = $_SERVER["DOCUMENT_ROOT"]."/cmsb/plugins/subsidiaries/defaults/_footer_navbar.php";
$GLOBALS["SUBSIDIARIES"]["image_modal"]   = $_SERVER["DOCUMENT_ROOT"]."/cmsb/plugins/subsidiaries/defaults/_image_modal.php";



//base url / site info record name
$GLOBALS["SUBSIDIARIES"]["siteMap"] = array(
	"cardanhydrovac"           => "hydrovac_info",
	"cardanwastemanagement"    => "waste_manage_info",
	"cardandemolition"         => "demo_excav_info",
	"cardanwatersupply"        => "water_supply_info",
	"durhamregionroadcleaners" => "road_cleaner_info",
	"cardanexcavation"         => "excav_info",
);





/**
*	DEBUGGING SETTINGS
*/

$GLOBALS["SUBSIDIARIES"]["DEBUG"]      = FALSE;
$GLOBALS["SUBSIDIARIES"]["DEBUG_SITE"] = "hydrovac_info";
$GLOBALS["SUBSIDIARIES"]["DEBUG_PAGE"] = "home_hv";



/**
*	OTHER SETTINGS - DO NOT MODIFY
*/

$GLOBALS['SUBSIDIARIES_PLUGIN'] = TRUE;

$GLOBALS["subsidiary_response"] = array(
	"error"     => 1,
	"errorText" => "Default Message",
	"page"      => "",
	"request"   => null
);
















/**
*	FUNCTIONS
*/


/**
*	subsidiary_processRequest
*	The main function of the subsidiary plugin. Place this function on any page
*	that will be your endpoint for processing subsidiary requests 
*/
function subsidiary_processRequest(){
	

	
	//if we are in debug mode do not validate, just retrurn the page.
	if($GLOBALS["SUBSIDIARIES"]["DEBUG"]){
		
	
		subsidiary_constructPageHTML($GLOBALS["SUBSIDIARIES"]["DEBUG_SITE"], $GLOBALS["SUBSIDIARIES"]["DEBUG_PAGE"]);
		return false;
	}
	
	//global $subsidiary_response;
	
	
	//determine the validity of the request
	$validRequest = subsidiary_validateRequest();
	
	if(!$validRequest) return false;
	
	
	//process the page request into site and page parts
	list($site, $page) = subsidiary_processPageRequest($GLOBALS["subsidiary_response"]["request"]["page"]);
	
	if(!$site) return false;
	if(!$page) $page = "home";
	
	$site_record_name = $GLOBALS["SUBSIDIARIES"]["siteMap"][$site];
	
	
	//check the API key
	$valid_key = subsidiary_checkAPIKey($site_record_name, $GLOBALS["subsidiary_response"]["request"]["key"]);
	
	if(!$valid_key) return false;
	
	
	
	
	//get the site suffix
	$site_suffix = subsidiary_getSiteSuffix($site_record_name);
	
	if(!$site_suffix) return false;
	
	//$GLOBALS["subsidiary_response"]["errorText"] = "Debug quit.";
	//return false;
	
	
	//check that there is page record
	$page_record_name = "{$page}_{$site_suffix}";
	$validPage        = subsidiary_findPageRecord($page_record_name);
	
	if(!$validPage) return false;
	
	
	//at this point we know that the key, site, and page are all valid
	//we can construct the page html
	$GLOBALS["subsidiary_response"]["site_record"] = $site_record_name;
	$GLOBALS["subsidiary_response"]["page_record"] = $page_record_name;
	
	subsidiary_constructPageHTML($site, $page_record_name);
	
}




function subsidiary_validateRequest(){
	
	//global $subsidiary_response;
	
	
	//decode the JSON into an array
	$request = file_get_contents('php://input');
	$request = urldecode(@$request);
	$request = json_decode($request, true);
	
	$GLOBALS["subsidiary_response"]["request"] = $request;
	
	
	//the request JSON was not valid
	if(!$request || !is_array($request)){
		
		$GLOBALS["subsidiary_response"]["errorText"] = "Invalid JSON received";
		return false;
	}
	
	
	//no key was passed with the JSON
	if(!@$request["key"]){
		
		$GLOBALS["subsidiary_response"]["errorText"] = "No API Key Found";
		return false;
	}
	
	
	//no page was passed with the JSON
	if(!@$request["page"]){
		
		$GLOBALS["subsidiary_response"]["errorText"] = "No Page Requested.";
		return false;
	}
	
	
	return true;
	
}





function subsidiary_processPageRequest($pageRequest){
	
	//global $subsidiary_response;
	
	
	$site = false;
	$page = false;
	
	
	//split up the page request
	//we expect something in this form: http://www.cardanhydrovac.com/home
	//which should process into
	//	site: cardanhydrovac
	//	page: home
	
	$pageParts = explode(".", $pageRequest);          //  [http://www][cardanhydrovac][com/home]
	$site      = $pageParts[1];                       //  cardanhydrovac
	$page      = @explode("/", $pageParts[2])[1];      //  [com][home]
 	
	
	if(!@$site || !@$page){ $GLOBALS["subsidiary_response"]["errorText"] = "Requested page was not found ($site -> $page)."; }
	
	
	return array($site, $page);
}





function subsidiary_checkAPIKey($site, $key){
	
	//global $subsidiary_response;
	
	$site_record = new SingleRecordType($site);
	
	$values = $site_record->values();
	
	//$GLOBALS["subsidiary_response"]["errorText"] = "Debug quitting ($site). - " . print_r($values, true);
	//return false;
	
	if(!@$values){
		
		$GLOBALS["subsidiary_response"]["errorText"] = "The requested site was not found ($site).";
		return false;
	}
	
	$recordKey = $values["api_key"];
	
	if($key != $recordKey){
		
		$GLOBALS["subsidiary_response"]["errorText"] = "The provided authorization key was not valid.";
		return false;
	};
	
	return true;
}





function subsidiary_getSiteSuffix($site){
	
	//global $subsidiary_response;
	
	$site_record = new SingleRecordType($site);
	
	$values = $site_record->values();
	
	if(!@$values){
		
		$GLOBALS["subsidiary_response"]["errorText"] = "The requested site was not found ($site).";
		return null;
	}
	
	return @$values["site_records_suffix"];
}




function subsidiary_findPageRecord($page){
	
	
	//global $subsidiary_response;
	
	$page_record = new SingleRecordType("$page");
	
	$values = $page_record->values();
	
	if(!@$values){
		
		$GLOBALS["subsidiary_response"]["errorText"] = "The requested page was not found ($page).";
		return false;
	}
	
	return true;
}






function subsidiary_constructPageHTML($site, $page_record_name){
	
	//global $subsidiary_response;
	$vars = array(
		"site" => $GLOBALS["SUBSIDIARIES"]["siteMap"][$site],
		"page" => $page_record_name
	);
	
	$vars = http_build_query($vars);
	
	$html = file_get_contents($GLOBALS["SUBSIDIARIES"]["page_html"] . "?$vars");
	
	
	$html = str_replace('href="/', 'href="' . $GLOBALS["SUBSIDIARIES"]["main_site"] . '/', $html);
	$html = str_replace("href='/", "href='{$GLOBALS["SUBSIDIARIES"]["main_site"]}/", $html);

	$html = str_replace('src="/', 'src="' . $GLOBALS["SUBSIDIARIES"]["main_site"] . '/', $html);
	$html = str_replace("src='/", "src='{$GLOBALS["SUBSIDIARIES"]["main_site"]}/", $html);
	
	$html = str_replace("services@cardancontracting.com", "services@$site.com", $html);
	
	
	
	if($html !== FALSE){
		
		$GLOBALS["subsidiary_response"]["error"]     = 0;
		$GLOBALS["subsidiary_response"]["errorText"] = "";
		$GLOBALS["subsidiary_response"]["page"]      = $html;
	}
	else{
		
		$GLOBALS["subsidiary_response"]["errorText"] = "The requested page was not found ($page_record_name).";
	}
	
	return false;
	
}




?>