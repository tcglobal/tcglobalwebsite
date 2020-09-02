<?php 
$userdata = [];
$userdata['username'] = 'dhibakar.j@optisolbusiness.com';
$userdata['password'] = 'Optisol@123';
$userdataurl =  'http://13.235.4.44/api/v1/wfp/api-token-auth/';
$get_token = curlFunction($userdataurl,$userdata,'');
$output = json_decode($get_token);
$user_token = $output->token;

$postVal = $_POST;
//print_r($postVal);
if($postVal['page_type']=='searchresult')
{
	$data = [];
	$data['offset'] = (int)$_POST['offset'];
	$data['limit'] = (int)$_POST['limit'];
	
	if($postVal['sortBy']=="Country")
	{
		$data['sortBy'] = 'country_name';
	}
	else if($postVal['sortBy']=="Area of study")
	{
		$data['area_of_study'] = 'prog_name';
	}
	else if($postVal['sortBy']=="University")
	{
		$data['sortBy'] = 'university_name';
	}
	else
	{
		$data['sortBy'] = 'prog_name';
	}
	
	//$data['sortBy'] = $_POST['sortBy']?$_POST['sortBy']:'prog_name';
	
	// level 1 filter value
	if(!empty($_POST['area_Of_Study']))
	$data['area_of_study'] = $_POST['area_Of_Study'];
	
	if(!empty($_POST['country_name']))
	$data['country_name'] = $_POST['country_name'];
	
	if(!empty($_POST['specialization']))
	$data['prog_type'] = $_POST['specialization'];
	
	if(!empty($_POST['studyLevel']))
	$data['prog_level'] = $_POST['studyLevel'];
	
	// level 2 filter value
	//print_r($_POST['university_name']);	
	if(!empty($_POST['university_name']))
	$data['university_name'] = implode(",",$_POST['university_name']);
	
	if(!empty($_POST['prog_campus']))
	$data['prog_campus'] = $_POST['prog_campus'];
	
	if(!empty($_POST['acceptedlanguage']))
	$data['er_toefl'] = $_POST['acceptedlanguage'];
	
	if(!empty($_POST['mode_of_study']))
	$data['prog_mode'] = $_POST['mode_of_study'];
	
	if(!empty($_POST['universityorientation']))
	$data['er_sat'] = $_POST['universityorientation'];
	
	
	$prog_data_url = "http://13.235.4.44/client_api/program_data/v1.0/";
	//echo json_encode($data);
	$apiresponse = curlFunction($prog_data_url,$data,$user_token);
	//echo $prog_data = $apiresponse;
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}



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

