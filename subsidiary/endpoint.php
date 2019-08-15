<?php

	header('Access-Control-Allow-Origin: https://www.twds.ca'); 

	require_once "../assets/_app_init.php";

	
	
	if(!@$GLOBALS['SUBSIDIARIES_PLUGIN']){
		
		//header("Location: https://www.cardancontracting.com");
		exit;
	}
	
	
	/**
	*	Endpoint
	*/

	
	//global $subsidiary_response;
	
	subsidiary_processRequest(); 
	
	echo json_encode($subsidiary_response);
	exit;
	
	//showme($GLOBALS["subsidiary_response"]);
	
	
	//echo $GLOBALS["subsidiary_response"]["page"];
	
?>