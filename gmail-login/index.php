<?php

ob_start();
require_once('settings.php');
require_once('google-login-api.php');


if(isset($_GET['scope'])){ // check user request from gmail 

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {

		$gmail_data = [];
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);

		/*$gmail_data['firstName'] = $user_info['name'];
		$gmail_data['lastName'] = $user_info['name'];*/

		$gmail_data['firstName'] = $user_info['given_name'];
		$gmail_data['lastName'] = $user_info['family_name'];
		$gmail_data['email'] = $user_info['email'];
		$gmail_data['photoUrl'] = $user_info['picture'];
		$gmail_data['provider'] = "GOOGLE";
		$gmail_data['id'] = $user_info['id'];
		
		//$google_api = "https://tcgstagingservice.optisolbusiness.com/api/SignUpByThirdParty";

		$google_api = "https://portalapi.tcglobal.com/api/SignUpByThirdParty";
		$socialresponse = socialCurlFunction($google_api,$gmail_data);

		$responses = json_decode($socialresponse);
		$gmail_usertoken = $responses->token;

		//portal redirect url after signin using gmail
		//$portalredir = 'http://spstaging.optisolbusiness.com/authentication/'.$gmail_usertoken;

		$portalredir = 'https://student.tcglobal.com/authentication/'.$gmail_usertoken;

		gmailuserFunction($user_info['given_name'],$user_info['family_name'],$user_info['email'],'','google');

		echo '<script>window.location.href=\''.$portalredir.'\';</script>';

	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

}

function socialCurlFunction($url,$data)
{	
		$header = array("Content-Type: application/json");
		
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
			return null; 
		} else {
			return $response;
		}
}

function gmailuserFunction($reqfname,$reqlname,$reqemail,$reqmobile,$reqtype){

	$tcguserpost_api = 'https://api.tcglobal.com/portal/signup.php';

	$userpostdata = [];

	$userpostdata['apikey'] = 'sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345';
	$userpostdata['firstName'] = $reqfname;
	$userpostdata['lastName'] = $reqlname;
	$userpostdata['emailId'] = $reqemail;
	$userpostdata['mobileNumber'] = $reqmobile;
	$userpostdata['loginType'] = $reqtype;
	$userpostdata['stage'] = 'fresh';
	
	curluserPostFunction($tcguserpost_api,$userpostdata);

}

function curluserPostFunction($url,$data)
{	   

	  $header = array("content-type: multipart/form-data");
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $data,
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

ob_end_flush();

?>



