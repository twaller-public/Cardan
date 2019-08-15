<?php


$data    = array("auth" => "1234");
//$test    = array($data);
$test    = '{"key": "123435", "page": "https://www.cardanhydrovac.com/home"}';  //json_encode($data);
$testURL = "https://www.cardancontracting.com/subsidiary/endpoint.php";

$result = sendCurl($testURL, $test);
$result = json_decode($result, true);

//$page = $result["page"];

//print_r($result);
echo $result["page"];

//$page = str_replace('href="/', 'href="https://www.twds.ca/', $page);
//$page = str_replace("href='/", "href='https://www.twds.ca/", $page);

//$page = str_replace('src="/', 'src="https://www.twds.ca/', $page);
//$page = str_replace("src='/", "src='https://www.twds.ca/", $page);

//echo $page;



//the curl function that actually sends the data
function sendCurl($callback_url, $json){
	
	
	$curl = curl_init($callback_url);
	
	curl_setopt($curl, CURLOPT_POST,           1);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS,     urlencode($json));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,     array('Content-Type: application/json'));
	

	$curl_response = curl_exec($curl);
	
	return $curl_response;
}


?>