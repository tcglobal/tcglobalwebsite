<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/*
include_once('config.php');
$class=new webconfig();
$class->DBConnect();

$accessKey = 'u$r9ea451df6581fe0d18b1176a1f6c791f';
	$secretKey = '013726bf5dfbc0c67f68a77d081b0f5941bc6ed4';

$city="";
$venue="";

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="delhi"){
	$city="NCR Delhi";
	$venue="The Lalit Hotel - NCR Delhi";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Mumbai"){
	$city="Mumbai";
	$venue="JW Marriott Hotel - Mumbai Andheri West";
}

if(($_GET['i_would_like_to_attend_global_education_interact_in'])=="Bangalore"){
	$city="Bangalore";
	$venue="Vivanta by Taj M.G. Road - Bangalore";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Hyderabad"){
	$city="Hyderabad";
	$venue="Taj Deccan - Hyderabad";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Kolkata"){
	$city="Kolkata";
	$venue="The Park Kolkata - Kolkata";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Chennai"){
	$city="Chennai";
	$venue="Hyatt Regency - Chennai";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Pune"){
	$city="Pune";
	$venue="Sheraton Grand(Le Meridien) - Pune";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Chandigarh"){
	$city="Chandigarh";
	$venue="JW Marriott Hotel Chandigarh - Chandigarh";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Lucknow"){
	$city="Lucknow";
	$venue="Hyatt Regency - Lucknow";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Jaipur"){
	$city="Jaipur";
	$venue="SMS Convention Center Rambagh Palace - Jaipur";
}

if(trim($_GET['i_would_like_to_attend_global_education_interact_in'])=="Kochi"){
	$city="Kochi";
	$venue="Radisson Blu Kochi - Cochin";
}

$phone=substr($_GET['phone_number'], -10);

	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
	$data_string = '[
					{"Attribute":"FirstName", "Value": "'.$_GET['first_name'].'"},
					{"Attribute":"LastName", "Value": "'.$_GET['last_name'].'"},
					{"Attribute":"EmailAddress", "Value": "'.$_GET['email'].'"},
					{"Attribute":"Phone", "Value": "'.$phone.'"},
					{"Attribute":"mx_City", "Value": "'.$_GET['city'].'"},
					{"Attribute":"mx_GEI_Venue", "Value": "'.$venue.'"},
					{"Attribute":"mx_Level_of_Study", "Value": "'.$_GET['level_of_study'].'"},
					{"Attribute":"mx_Area_of_Study", "Value": "'.$_GET['area_of_study'].'"},
					{"Attribute":"ProspectStage", "Value": "Fresh"},
					{"Attribute": "mx_choprasleadsource","Value": "Facebook"}
					]';

	$data_string;
	
	$str="";
	foreach($_GET as $key => $val){
		$str.=$key.'-'.$val.',';
	}

		pg_query("INSERT INTO public.lstest(data) VALUES ('".$str.'='.$city.$venue.'-'.$_GET['i_would_like_to_attend_global_education_interact_in'].'-'.$phone."')");			
try
{
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
												'Content-Type:application/json',
												'Content-Length:'.strlen($data_string)
												));
	$json_response = curl_exec($curl);
	curl_close($curl);
} catch (Exception $ex) { 
	curl_close($curl);
}


//print_r($json_response);
$data = json_decode($json_response);

//print_r($data);
$st = $data->Status;