<?php 
$userdata = [];
$userdata['username'] = 'dhibakar.j@optisolbusiness.com';
$userdata['password'] = 'Optisol@123';
$userdataurl =  'http://13.235.4.44/api/v1/wfp/api-token-auth/';
$get_token = curlFunction($userdataurl,$userdata,'');
$output = json_decode($get_token);
$user_token = $output->token;
 
$filter_url = "http://13.235.4.44/client_api/first_level_filter/v1.0/";
//echo json_encode($data);
$apiresponse = curlFunctionGet($filter_url,$user_token);
//echo $prog_data = $apiresponse;
$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
echo json_encode($program_output);

function curlFunction($url,$data,$token)
{
	
	   
	  $header = array("Content-Type: application/json");
	  $tokenVal = '';
	  if($token){
	  	$header = array("Authorization: Token ".$token,"Content-Type: application/json");
	  }
	  //echo json_encode($data);
	///	print_r($header);
		//echo $url;
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($data),
	  CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);	
	curl_close($curl);
	if ($err) {
	  echo "cURL Error #:" . $err;  
	} else {
	   return $response;
	}
}

function curlFunctionGet($url,$token)
{
	
	   
	  $header = array("Content-Type: application/json");
	  $tokenVal = '';
	  if($token){
	  	$header = array("Authorization: Token ".$token,"Content-Type: application/json");
	  }
	  //echo json_encode($data);
	///	print_r($header);
		//echo $url;
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);	
	curl_close($curl);
	if ($err) {
	  echo "cURL Error #:" . $err;  
	} else {
	   return $response;
	}
}

