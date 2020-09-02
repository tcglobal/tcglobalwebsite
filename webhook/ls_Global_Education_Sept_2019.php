<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/*include_once('config.php');
$class=new webconfig();
$class->DBConnect();*/

$con_string = "host=chopra.cthuw9tptcfh.ap-south-1.rds.amazonaws.com port=9289 dbname=gei_event user=chopra password=Admin123";
$dbcon = pg_connect($con_string); 


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$accessKey = 'u$r9ea451df6581fe0d18b1176a1f6c791f';
$secretKey = '013726bf5dfbc0c67f68a77d081b0f5941bc6ed4';

$city="";
$venue="";
$dt="";
$cal="";
$map="";


$phone=substr($_GET['phone_number'], -10);

	//$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;

	


	$data_string = '[
					{"Attribute":"SearchBy", "Value": "EmailAddress"},
					{"Attribute":"FirstName", "Value": "'.$_GET['first_name'].'"},
					{"Attribute":"LastName", "Value": "'.$_GET['last_name'].'"},
					{"Attribute":"EmailAddress", "Value": "'.$_GET['email'].'"},
					{"Attribute":"Phone", "Value": "'.$phone.'"},
					{"Attribute":"mx_City", "Value": "'.$_GET['city'].'"},
					{"Attribute":"mx_GEI_Venue", "Value": "'.$venue.'"},
					{"Attribute":"mx_Level_of_Study", "Value": "'.$_GET['level_of_study'].'"},
					{"Attribute":"mx_Area_of_Study", "Value": "'.$_GET['area_of_study'].'"},
					{"Attribute": "mx_GEI_Address","Value": "'.$map.'"},
					{"Attribute": "mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},
					{"Attribute": "mx_Google_Calendar_URL","Value": "'.$cal.'"},
					{"Attribute":"mx_GEI_Date", "Value": "'.$dt.'"},
					{"Attribute":"mx_Fast_Track_Status", "Value": ""},
					{"Attribute":"Source", "Value": "Facebook"},
					{"Attribute": "mx_GEI_registration_status","Value": ""},
					{"Attribute": "mx_choprasleadsource","Value": "Global Education Month - Sept 2019"},
					{"Attribute": "mx_Nearest_Branch","Value": "'.$_GET['i_would_like_to_attend_global_education_interact_in'].'"},
					{"Attribute": "mx_URL","Value": ""},
					{"Attribute": "mx_Type_of_GEI_Appointment_Auto","Value": ""},
					{"Attribute":"mx_Service_or_Product", "Value": "Global Education"}
					]';

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
$ExceptionMessage = $data->ExceptionMessage;
if($ExceptionMessage == 'A Lead with same Phone Number already exists.')
{
	$data_string = '[
					{"Attribute":"SearchBy", "Value": "Phone"},
					{"Attribute":"FirstName", "Value": "'.$_GET['first_name'].'"},
					{"Attribute":"LastName", "Value": "'.$_GET['last_name'].'"},
					{"Attribute":"EmailAddress", "Value": "'.$_GET['email'].'"},
					{"Attribute":"Phone", "Value": "'.$phone.'"},
					{"Attribute":"mx_City", "Value": "'.$_GET['city'].'"},
					{"Attribute":"mx_GEI_Venue", "Value": "'.$venue.'"},
					{"Attribute":"mx_Level_of_Study", "Value": "'.$_GET['level_of_study'].'"},
					{"Attribute":"mx_Area_of_Study", "Value": "'.$_GET['area_of_study'].'"},
					{"Attribute": "mx_GEI_Address","Value": "'.$map.'"},
					{"Attribute": "mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},
					{"Attribute": "mx_Google_Calendar_URL","Value": "'.$cal.'"},
					{"Attribute":"mx_GEI_Date", "Value": "'.$dt.'"},
					{"Attribute":"mx_Fast_Track_Status", "Value": ""},
					{"Attribute":"Source", "Value": "Facebook"},
					{"Attribute": "mx_GEI_registration_status","Value": ""},
					{"Attribute": "mx_choprasleadsource","Value": "Global Education Month - Sept 2019"},
					{"Attribute": "mx_Nearest_Branch","Value": "'.$_GET['i_would_like_to_attend_global_education_interact_in'].'"},
					{"Attribute": "mx_URL","Value": ""},
					{"Attribute": "mx_Type_of_GEI_Appointment_Auto","Value": ""},
					{"Attribute":"mx_Service_or_Product", "Value": "Global Education"}
					]';

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
}
