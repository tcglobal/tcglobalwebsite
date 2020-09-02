<?php 
$contact_form =  'https://gei.tcglobal.com/globalapi/contact_form.php';
$subscribe_form =  'https://gei.tcglobal.com/globalapi/subscribe_form.php';
$lead_form =  'https://gei.tcglobal.com/globalapi/lead_form.php';
$service_list =  'https://gei.tcglobal.com/globalapi/services.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1';
$event_form = 'https://gei.tcglobal.com/globalapi/event_form.php';
$journey_api = 'https://gei.tcglobal.com/globalapi/start_your_journey_form.php';
$schedule_api = 'https://gei.tcglobal.com/globalapi/schedule_meeting_form.php';
$onBoard_api='https://gei.tcglobal.com/globalapi/onboard_form.php';
$meeting_api = 'https://gei.tcglobal.com/globalapi/schedule_meeting_form_mail.php';

$signup_api = 'https://portalapi.tcglobal.com/api/SignUp';
$login_api 	= 'https://portalapi.tcglobal.com/api/Login';
$forgot_api = 'https://portalapi.tcglobal.com/api/SendForgotPasswordMail';

$otp_api = 'https://portalapi.tcglobal.com/api/GenerateOtp';
$mobileLogin_api = 'https://portalapi.tcglobal.com/api/MobileLogin';
$resendActive_api = 'https://portalapi.tcglobal.com/api/sendActivationMail';

$get_service_list = curlFunction($service_list,'');
$services = json_decode($get_service_list);
//print_r($services);
$postVal = $_POST;
if($postVal['type']=='contact')
{
	$data = [];
	$data['name'] = $postVal['name'];
	$data['email'] = $postVal['email'];
	$data['mobileNumber'] = $postVal['mobileNumber'];
	$data['service'] = $postVal['service'];
	$data['message'] = $postVal['message'];
	$data['source'] 	= $postVal['source'];
	$data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	$data['ProspectID'] 	= $postVal['ProspectID'];
	$data['currentPage'] = $postVal['currentPage']; 
	
	//echo json_encode($data);
	//print_r($data);
	$apiresponse = curlFunction($contact_form,$data);
	//$prog_data = $apiresponse;
	$program_output = json_decode($apiresponse);
	
	//$program_output = array('status'=>true,'message'=>"Mail sent successfully");
	echo json_encode($program_output);
}

if($postVal['type']=='campaignContact')
{
	$data = [];
	$data['name'] = $postVal['name'];
	$data['email'] = $postVal['email'];
	$data['mobileNumber'] = $postVal['mobileNumber'];
	$data['service'] = $postVal['service'];
	$data['message'] = $postVal['message'];
	$data['source'] 	= $postVal['source'];
	$data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	$data['ProspectID'] 	= $postVal['ProspectID'];
	$data['currentPage'] = $postVal['currentPage']; 
	
	$apiresponse = curlFunction($contact_form,$data);
	$program_output = json_decode($apiresponse);
	echo json_encode($program_output);
}

if($postVal['type']=='subscripe')
{
	$data = [];
	$data['name'] = $postVal['name'];
	$data['email'] = $postVal['email'];
	$data['mobileNumber'] = $postVal['mobileNumber'];
	//$data['service'] = $postVal['topic'];
	$data['choos_topic'] = $postVal['choos_topic'];
	$data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	$data['ProspectID'] 	= $postVal['ProspectID'];
	// echo json_encode($data);
	$apiresponse = curlFunction($subscribe_form,$data);
	//echo $prog_data = $apiresponse;
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}


if($postVal['type']=='lead')
{
	$data = [];
	$data['name'] = $postVal['name'];
	$data['email'] = $postVal['email'];
	$data['mobileNumber'] = $postVal['mobileNumber'];
	$data['service'] = $postVal['service'];
	$data['message'] = $postVal['message'];
	$data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	$data['currentPage'] = $postVal['currentPage'];
	$data['ProspectID'] 	= $postVal['ProspectID'];  
	$data['onboardLink'] = $postVal['onboardLink']; 
	//echo json_encode($data);
	$apiresponse = curlFunction($lead_form,$data);
	//echo $prog_data = $apiresponse;
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}

if($postVal['type']=='expressform')
{
	$data = [];
	$data['name'] = $postVal['name'];
	$data['email'] = $postVal['email'];
	$data['mobileNumber'] = $postVal['mobileNumber'];
	$data['service'] = $postVal['service'];
	$data['message'] = $postVal['message'];
	$data['university'] = $postVal['university'];
	$data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	$data['currentPage'] = $postVal['currentPage']; 
	$data['university'] = $postVal['university'];
	$data['ProspectID'] 	= $postVal['ProspectID'];

	//echo json_encode($data);
	
	$apiresponse = curlFunction($contact_form,$data);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}

if($postVal['type']=='event')
{
	$data = [];
	$data['firstname'] 		= $postVal['firstname'];
	$data['lastname'] 		= $postVal['lastname'];
	$data['emailaddress'] 	= $postVal['emailaddress'];
	$data['mobileNumber'] 	= $postVal['mobileNumber'];
	$data['level_id'] 		= $postVal['level_id'];
	$data['level_of_study'] = $postVal['level_of_study'];
	$data['aos_id'] 		= $postVal['aos_id'];
	$data['area_of_study'] 	= $postVal['area_of_study'];
	$data['country_id'] 	= $postVal['country_id'];
	$data['country_preference'] = $postVal['country_preference'];
	$data['intake_id'] 		= $postVal['intake_id'];
	$data['adminssion_year'] = $postVal['adminssion_year'];
	$data['event_venue'] 	= $postVal['event_venue'];
	$data['time_slot'] 		= $postVal['time_slot'];

	$data['event_date'] 		= $postVal['event_date'];
	
	$data['ipAddress'] 		= $_SERVER['REMOTE_ADDR'];
	$data['event_name'] 	= $postVal['event_name'];
	$data['ProspectID'] 	= $postVal['ProspectID'];

	//echo json_encode($data);
	$apiresponse = curlFunction($event_form,$data);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}

if($postVal['type']=='startJourney')
{
	$data = [];
	$data['firstname'] 		= $postVal['firstname'];
	$data['lastname'] 		= $postVal['lastname'];
	$data['emailaddress'] 	= $postVal['email'];
	$data['mobile_number'] 	= $postVal['mobile'];
	$data['choose_date'] 		= $postVal['date'];
	$data['choose_time'] = $postVal['time'];
	$data['callback']=$postVal['scheduleCheck']?true:false;
	if(!$postVal['scheduleCheck']){
		$data['choose_location'] 		= $postVal['location'];
		$data['location_address'] 	= $postVal['address'];
	}

	$data['primary_category'] 	= trim($postVal['primary_category']);
	$data['service'] 	=  $postVal['service'];
	$data['interested_in'] = trim($postVal['interested_in']);
	$data['ipAddress'] 		= $_SERVER['REMOTE_ADDR'];
	$data['ProspectID'] 	= $postVal['ProspectID'];
	$data['current_page'] 	= $postVal['pagename'];
	$data['source'] 	= $postVal['source'];
	$data['onboardLink'] = $postVal['onboardLink'];
	
	//$data['service_sub_level']= trim($postVal['service']);
	// echo json_encode($data);
	$apiresponse = curlFunction($journey_api,$data);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}

if($postVal['type']=='scheduleMeeting')
{
	$data = [];
	
	$data['firstname'] 		= $postVal['firstname'];
	$data['lastname'] 		= $postVal['lastname'];
	$data['emailaddress'] 	= $postVal['email'];
	$data['mobile_number'] 	= $postVal['mobile'];
	
	$data['you_are'] = $postVal['role'];
	$data['choose_date'] 		= $postVal['date'];
	$data['choose_time'] = $postVal['time'];
	$data['callback']=$postVal['scheduleCheck']?true:false;

	//if($postVal['scheduleCheck'] == 0){
	if(!$postVal['scheduleCheck']){
		$data['choose_location'] = $postVal['location'];
		$data['location_address'] = $postVal['address'];
	}
	
	$data['primary_category'] 	= trim($postVal['primary_category']);
	$data['service'] 	= trim($postVal['service']);
	$data['test_preparation'] = $postVal['preparation'];
	//$data['interested_in'] = trim($postVal['interest']);
	$data['ipAddress'] 		= $_SERVER['REMOTE_ADDR'];
	$data['ProspectID'] 	= $postVal['ProspectID'];
	$data['current_page'] 	= $postVal['pagename'];

	$apiresponse = curlFunction($schedule_api,$data);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}

/** meeting schedule from email user **/
if($postVal['type'] =='MeetingConfirmation')
{
	$data = [];

	$data['lead_id'] = $postVal['lead_id'];
	$data['email'] 	= $postVal['email'];
	$data['source'] = $postVal['source'];
	$data['date'] 	= $postVal['date'];
	$data['time'] = $postVal['time'];

	if($postVal['scheduleCheck'] == 0){
		$data['location'] = $postVal['location'];
		$data['address'] = $postVal['address'];
	}
	
	$apiresponse = curlFunction($meeting_api,$data);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}


if($postVal['type']=='onboard')
{
	$data = [];
	$data['nearest_center'] = $postVal['nearest_center'];
	$data['level_study'] = $postVal['prefferd_level_study'];
	$data['adminssion_year'] = $postVal['prefferd_year_admission'];
	$data['in_take'] = $postVal['prefferd_intake'];
	$data['area_of_study'] = $postVal['prefferd_area_study'];
	$data['country_preference'] = $postVal['prefferd_global_ed_destination'];
	$data['current_level_of_study'] = $postVal['current_level_study'];
	$data['objective'] = $postVal['global_ed_objective'];
	$data['prefered_time'] = $postVal['prefferd_time_contact'];
	$data['perfered_contact'] = $postVal['prefferd_mode_contact'];
	$data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	$data['lead_id'] = $postVal['lead_id']; 
	$data['lead_email'] = $postVal['lead_email']; 
	$data['ProspectID'] 	= $postVal['ProspectID'];
	$data['lead_type'] 	= $postVal['lead_type'];
	$data['available_from_date'] 	= $postVal['available_from_date'];
	$data['purpose'] 	= $postVal['purpose'];
	$data['date_of_birth'] 	= $postVal['date_of_birth'];
	
	$apiresponse = curlFunction($onBoard_api,$data);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}

if($postVal['type'] =='login')
{
	$data = [];
	$data['EmailId'] = $postVal['email'];
	$data['Password'] 	= $postVal['password'];
	$data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	echo $apiresponse = curlFunction($login_api,$data);

	$apiresult = json_decode($apiresponse);

	if(!empty($apiresult->errorMsg)){
		exit;
	}
	else{
		$ufname = ''; $ulname=''; $usemail=''; $usermobile='';
		$ufname = $apiresult->result->FirstName;
		$ulname = $apiresult->result->LastName;
		$usemail = $apiresult->result->EmailId;
		$usermobile = $apiresult->result->MobileNumber;
		userPostFunction($ufname,$ulname,$usemail,$usermobile,'normal');
	}
}

if($postVal['type'] =='signup')
{
	$data = [];
	$data['FirstName'] 		= $postVal['firstname'];
	$data['LastName'] 		= $postVal['lastname'];
	$data['EmailId'] 		= $postVal['email'];
	$data['CountryCode'] 	= $postVal['code'];
	$data['MobileNumber'] 	= $postVal['mobile'];
	$data['Password'] 		= $postVal['password'];
	echo $apiresponse = curlFunction($signup_api,$data);

	userPostFunction($postVal['firstname'],$postVal['lastname'],$postVal['email'],$postVal['mobile'],'signupform');
}

if($postVal['type'] =='forgotpass')
{
	$data = [];
	$data['EmailId'] 	= $postVal['email'];
	echo $apiresponse = curlFunction($forgot_api,$data);
}

if($postVal['type'] =='mobileOTP')
{
	$data = [];
	$data['mobileNumber'] 	= $postVal['phone'];
	echo $apiresponse = curlFunction($otp_api,$data);
}

if($postVal['type'] =='OtpLogin')
{
	$data = [];
	$data['mobileNumber'] 	= $postVal['mobileNumber'];
	$data['OTP'] 	= $postVal['OTP'];
	echo $apiresponse = curlFunction($mobileLogin_api,$data);
}

if($postVal['type'] =='resendEmail')
{
	$data = [];
	$data['EmailId'] = $postVal['email'];
	echo $apiresponse = curlFunction($resendActive_api,$data);
}


function userPostFunction($reqfname,$reqlname,$reqemail,$reqmobile,$reqtype){

	$tcguserpost_api = 'https://api.tcglobal.com/portal/signup.php';

	$userpostdata = [];

	$userpostdata['apikey'] = 'sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345';
	$userpostdata['firstName'] = $reqfname;
	$userpostdata['lastName'] = $reqlname;
	$userpostdata['emailId'] = $reqemail;
	$userpostdata['mobileNumber'] = $reqmobile;
	$userpostdata['loginType'] = $reqtype;
	$userpostdata['stage'] = 'fresh';
	
	curlFunction($tcguserpost_api,$userpostdata);
}

function curlFunction($url,$data)
{	   

	  //$header = array("Content-Type: application/json");
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

