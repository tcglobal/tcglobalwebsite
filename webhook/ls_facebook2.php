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

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="new delhi"){
	$city="NCR Delhi";
	$venue="The Lalit Hotel - NCR Delhi";
	$dt="2019-06-15";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MmllaXE3bW1vOTVwdGRpMHZxNXJxN3RybGIgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/The+LaLiT+New+Delhi/@28.6312448,77.2252163,17z/data=!3m1!4b1!4m5!3m4!1s0x390cfd32312dee27:0xc40680170b85d192!8m2!3d28.6312448!4d77.227405";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="mumbai"){
	$city="Mumbai";
	$venue="JW Marriott Hotel - Mumbai Andheri West";
	$dt="2019-06-02";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NjcxOWpzbWhla2UydThvZjBpN25udHIwNmQgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
		$map="https://www.google.com/maps/place/JW+Marriott+Mumbai+Juhu/@19.1019146,72.8241366,17z/data=!3m1!4b1!4m5!3m4!1s0x3be7c9bf6271e62d:0x12861889e9de122a!8m2!3d19.1019146!4d72.8263253";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="bangalore"){
	$city="Bangalore";
	$venue="Vivanta by Taj M.G. Road - Bangalore";
	$dt="2019-06-08";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=N2ZhMnFkczE2ajFlNTVmOHVubjIxdHF1OGggd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/Taj+MG+Road,+Bengaluru/@12.9733649,77.6173734,17z/data=!3m1!4b1!4m5!3m4!1s0x3bae1686b281d2a3:0xfe17a276bcf050c5!8m2!3d12.9733649!4d77.6195621";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="hyderabad"){
	$city="Hyderabad";
	$venue="Taj Deccan - Hyderabad";
	$dt="2019-06-06";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MWw2aTYzc3MwM2RuOTVoOGhtNTljdDJiODkgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/Taj+Deccan/@17.4179195,78.4485758,17z/data=!4m12!1m6!3m5!1s0x3bcb9736ec4570d1:0xf379a101b3fe1032!2sTaj+Deccan!8m2!3d17.4179195!4d78.4507645!3m4!1s0x3bcb9736ec4570d1:0xf379a101b3fe1032!8m2!3d17.4179195!4d78.4507645";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="kolkata"){
	$city="Kolkata";
	$venue="The Park Kolkata - Kolkata";
	$dt="2019-06-12";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=Mzdic2lxZXNoMDI1NmJnYnNmOGE0dHUwamUgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/The+Park+Hotel/@22.5540324,88.3494898,17z/data=!3m1!4b1!4m5!3m4!1s0x3a027705fba4f341:0xf382683d7139cd1a!8m2!3d22.5540324!4d88.3516785";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="chennai"){
	$city="Chennai";
	$venue="Hyatt Regency - Chennai";
	$dt="2019-06-04";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MDFqNmFkcHZmY3Vkdmk1Y28yMjM4bnBtdTggd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/Hyatt+Regency+Chennai/@13.0430452,80.2464967,17z/data=!3m1!4b1!4m5!3m4!1s0x3a5266466c3b5a81:0xfe35b8153aea85fd!8m2!3d13.0430452!4d80.2486854";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="pune"){
	$city="Pune";
	$venue="Sheraton Grand(Le Meridien) - Pune";
	$dt="2019-06-01";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MDFqNmFkcHZmY3Vkdmk1Y28yMjM4bnBtdTggd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
		$map="https://www.google.com/maps/place/Sheraton+Grand+Pune+Bund+Garden+Hotel/@18.5300014,73.8713841,15z/data=!4m5!3m4!1s0x0:0x15888f834fad6cf7!8m2!3d18.5300014!4d73.8713841";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="chandigarh"){
	$city="Chandigarh";
	$venue="JW Marriott Hotel Chandigarh - Chandigarh";
	$dt="2019-06-16";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NDE5MW40cjRtazZycTFlOG1icHZhNzY5MWogd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/JW+Marriott+Hotel+Chandigarh/@30.7266978,76.764638,17z/data=!3m1!4b1!4m5!3m4!1s0x390fedb04b1c07c3:0x7e245c01f37d931f!8m2!3d30.7266978!4d76.7668267";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="lucknow"){
	$city="Lucknow";
	$venue="Hyatt Regency - Lucknow";
	$dt="2019-06-20";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=Mjdua3BlY280MTNzODRxM2lsZnJpc3Q3ODUgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/Hyatt+Regency+Lucknow/@26.8660254,81.0034063,17z/data=!3m1!4b1!4m5!3m4!1s0x399be2bf1d0b173f:0xcfc7ea49649f8e23!8m2!3d26.8660254!4d81.005595";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="jaipur"){
	$city="Jaipur";
	$venue="SMS Convention Center Rambagh Palace - Jaipur";
	$dt="2019-06-18";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NWtkNnBndmpqZmJjb2loYThmMzA5NWExaWwgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/SMS+Hotel,+Jaipur/@26.8972551,75.8077522,17z/data=!3m1!4b1!4m5!3m4!1s0x396db402241bbfa7:0x97c35c336f69fc1e!8m2!3d26.8972551!4d75.8099409";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="kochi"){
	$city="Cochin";
	$venue="Radisson Blu Kochi - Cochin";
	$dt="2019-06-10";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MjJzdXFiM200cHMwdTcxZnBvMzgydms4b2Ugd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/Radisson+Blu+Kochi/@9.967366,76.3049841,17z/data=!3m1!4b1!4m5!3m4!1s0x3b0872d1c088f139:0x54974bd38aab09b8!8m2!3d9.967366!4d76.3071728";
}

$phone=substr($_GET['phone_number'], -10);

	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=' . $accessKey . '&secretKey=' . $secretKey;


	
	$str="";
	foreach($_GET as $key => $val){
		$str.=$key.'-'.$val.',';
	}

pg_query("INSERT INTO public.lstest(data) VALUES ('".$str.'='.$city.$venue.'-'.$_GET['i_would_like_to_attend_global_education_interact_in'].'-'.$phone."')");


$query_register="select * from gei_registration where email ilike '".trim($_GET['email'])."'"; 

$result_register = pg_query($query_register);
$numRows_register=pg_num_rows($result_register);

if($numRows_register==0){

$q1="SELECT * FROM public.stream_specilization_new where parentid='0' and title ilike '".$_GET['area_of_study']."'";
$result1=pg_query($q1);
$row1=pg_fetch_array($result1);

$q="select * from compmast where name ilike 'n&n Chopra Consultants-".$city."'";
$result=pg_query($q);
$row=pg_fetch_array($result);
		
$query="INSERT INTO public.gei_registration(
first_name, last_name, email, mobile, level_of_study, area_of_study_id, event_venue_id, fast_track_status, source)
VALUES ('".$_GET['first_name']."', '".$_GET['last_name']."', '".$_GET['email']."', '".$phone."', '".$_GET['level_of_study']."', '".$row1['id']."', '".$row['compid']."','Self Fast Track', 'Facebook Form') RETURNING id;";

$res=pg_query($query);
$new_id = pg_fetch_array($res);

$bid=$row['compid'].'-'.$new_id['id'];
pg_query("Update gei_registration set badge_id='".$bid."' where id='".$new_id['id']."'");


$track_url='https://gei.thechopras.com/fasttrack_fb.php?ref='.base64_encode($new_id['id']);


function check_random(){
	$ran=generateRandomString(10);
	$query_gei_reg="select * from url_shortner where uid='".$ran."'";
	$resulrt_gei_reg=pg_query($query_gei_reg);
	$numrows_gei_reg=pg_num_rows($resulrt_gei_reg);
	if($numrows_gei_reg == 0)
	{
		return $ran;
	}
	else{
		check_random();
	}
}

$random_string=check_random();

$query_url="INSERT INTO public.url_shortner(uid, destination, gid) VALUES ('".$random_string."', '".$track_url."','".$new_id['id']."');";
pg_query($query_url);

}


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
					{"Attribute": "mx_GEI_Address","Value": "'.$map.'"},
					{"Attribute": "mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},
					{"Attribute": "mx_Google_Calendar_URL","Value": "'.$cal.'"},
					{"Attribute":"mx_GEI_Date", "Value": "'.$dt.'"},
					{"Attribute":"mx_Fast_Track_Status", "Value": "Not Completed"},
					{"Attribute":"Source", "Value": "Facebook"},
					{"Attribute": "mx_GEI_registration_status","Value": "Yes"},
					{"Attribute": "mx_choprasleadsource","Value": "Facebook"},
					{"Attribute": "mx_URL","Value": "https://url.thechopras.com/'.$random_string.'"},
					{"Attribute": "mx_Type_of_GEI_Appointment_Auto","Value": "Self Fast Track"}
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