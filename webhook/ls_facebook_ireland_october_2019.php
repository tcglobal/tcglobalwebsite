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

//$accessKey = 'u$r9ea451df6581fe0d18b1176a1f6c791f';
//$secretKey = '013726bf5dfbc0c67f68a77d081b0f5941bc6ed4';


$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';	
	
				

$city="";
$venue="";

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="new delhi"){
	$city="NCR Delhi";
	$branch = "NCR Delhi";
	$venue="The Chopras Office Delhi";
	$dt="2019-10-09";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MGVkbzh0bTNyNWpsZWNuZDJnbGp0NTRmNG4gd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.549669,77.250187,15z/data=!4m5!3m4!1s0x0:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="mumbai"){
	$city="Mumbai Andheri West";
	$branch = "Mumbai Andheri West";
	$venue="The Chopras Office Mumbai Andheri West";
	$dt="2019-10-21";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MnE0YTI0bmc0MHVoZWttZ2pkanU0MG1odWogd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Mumbai+Andheri/@19.1195122,72.8417673,737m/data=!3m2!1e3!4b1!4m5!3m4!1s0x3be7c9d10da487eb:0xa286e353edfbcf92!8m2!3d19.1195122!4d72.843956";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="bangalore"){
	$city="Bangalore";
	$branch = "Bangalore";
	$venue="The Chopras Office Bangalore";
	$dt="2019-10-11";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=Njh0dWlyZzlhN2lldHY4cW1wbTduMzk1Zm8gd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Bangalore/@12.9741638,77.6134511,760m/data=!3m2!1e3!4b1!4m5!3m4!1s0x3bae1684780add8f:0x2975a5269ddd993d!8m2!3d12.9741638!4d77.6156398";
}


if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="chennai"){
	$city="Chennai";
	$branch = "Chennai";
	$venue="The Chopras Office Chennai";
	$dt="2019-10-15";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NnZwamx1YzhnZTIwYzFnNm82M3ZhZnE3aWcgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Chennai/@13.0546247,80.2469559,760m/data=!3m2!1e3!4b1!4m5!3m4!1s0x110565cd1712fdff:0x6d4d36694932eedf!8m2!3d13.0546247!4d80.2491446";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="pune"){
	$city="Pune";
	$branch = "Pune";
	$venue="The Chopras Office Pune";
	$dt="2019-10-18";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=N2wwYmQzZ2JpZWRvajZiYXJuamkwa2JnZzEgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Pune/@18.5201353,73.8435366,740m/data=!3m2!1e3!4b1!4m5!3m4!1s0x3bc2bf87f9a71785:0x16017dfcca2a8a64!8m2!3d18.5201353!4d73.8457253";
}


if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="coimbatore"){
	$city="Coimbatore";
	$branch = "Coimbatore";
	$venue="The Chopras Office Coimbatore";
	$dt="2019-10-14";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=N2M1b3ZyMjc2Z2hoM29jb21sdTdiMDM3NXMgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Coimbatore/@11.008926,76.9777943,17z/data=!4m12!1m6!3m5!1s0x3ba859b1624a4797:0x3c9255ca0e7fcd3e!2sThe+Chopras+Coimbatore!8m2!3d11.008926!4d76.979983!3m4!1s0x3ba859b1624a4797:0x3c9255ca0e7fcd3e!8m2!3d11.008926!4d76.979983";

}

 //$map = stripslashes($map);


$phone=substr($_GET['phone_number'], -10);

	//$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
	//$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
	
	$str="";
	foreach($_GET as $key => $val){
		$str.=$key.'-'.$val.',';
	}

pg_query("INSERT INTO public.lstest(data) VALUES ('".$str.'='.$city.$venue.'-'.$_GET['i_would_like_to_attend_global_education_interact_in'].'-'.$phone."')");


$query_register="select * from gei_registration where email ilike '".trim($_GET['email'])."'  and inhousefair=true "; 

$result_register = pg_query($query_register);
$numRows_register=pg_num_rows($result_register);

if($numRows_register==0){

 $q1="SELECT * FROM public.stream_specilization_new where parentid='0' and title ilike '%".$_GET['area_of_study']."%'";
$result1=pg_query($q1);
$row1=pg_fetch_array($result1);

 $q="select * from compmast where name ilike 'n&n Chopra Consultants-".$city."'";
$result=pg_query($q);
$row=pg_fetch_array($result);

$fd="'".$dt." 00:00:00'";
$td="'".$dt." 23:59:59'";

$get_event_id = "select distinct compmast.compid,venue,to_char(startdate,'dd Mon YYYY') as d,startdate as starttime,event_master.eventid    from event_master
										join compmast  on compmast.compid=event_master.branchid where event_master.note ilike '%Ireland%' and event_master.event_date between $fd and $td";

$qry_get_event_id = pg_query($get_event_id);
$res_get_event_id = pg_fetch_array($qry_get_event_id);

$eventid = $res_get_event_id['eventid'];										
		
  $query="INSERT INTO public.gei_registration(
first_name, last_name, email, mobile, level_of_study, area_of_study_id, event_venue_id, fast_track_status, source,inhousefair,eventid,note)
VALUES ('".$_GET['first_name']."', '".$_GET['last_name']."', '".$_GET['email']."', '".$phone."', '".$_GET['level_of_study']."', '".$row1['id']."', '".$row['compid']."','Self Fast Track', 'Facebook',true,'".$eventid."','IrelandInhouseFairOct2019') RETURNING id;";

$res=pg_query($query);
$new_id = pg_fetch_array($res);

$bid=$row['compid'].'-'.$new_id['id'];
pg_query("Update gei_registration set badge_id='".$bid."' where id='".$new_id['id']."'");


//$track_url='https://events.thechopras.com/aus-nz-global-ed-fair/fasttrack_fb.php?ref='.base64_encode($new_id['id']);
$track_url='https://events.tcglobal.com/ireland/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($new_id['id']);

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

if($numRows_register>0){



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

$res_data = pg_fetch_array($result_register);
$stdid = $res_data['id'];
$track_url='https://events.tcglobal.com/ireland/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($stdid);
$random_string=check_random();

$query_url="INSERT INTO public.url_shortner(uid, destination, gid) VALUES ('".$random_string."', '".$track_url."','".$stdid."');";
pg_query($query_url);

}
	
	$data_string = '[
					{"Attribute":"SearchBy", "Value": "EmailAddress"},
					{"Attribute":"FirstName", "Value": "'.$_GET['first_name'].'"},
					{"Attribute":"LastName", "Value": "'.$_GET['last_name'].'"},
					{"Attribute":"EmailAddress", "Value": "'.$_GET['email'].'"},
					{"Attribute":"Phone", "Value": "'.$phone.'"},
					{"Attribute":"mx_City", "Value": "'.$_GET['city'].'"},
					{"Attribute":"mx_GEI_Venue", "Value": ""},
					{"Attribute":"mx_Event_Venue", "Value": "'.$venue.'"},
					{"Attribute":"mx_Level_of_Study", "Value": "'.$_GET['level_of_study'].'"},
					{"Attribute":"mx_Area_of_Study", "Value": "'.$_GET['area_of_study'].'"},
					{"Attribute": "mx_GEI_Address","Value": "'.$map.'"},
					{"Attribute": "mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},
					{"Attribute": "mx_Google_Calendar_URL","Value": ""},
					{"Attribute":"mx_GEI_Date", "Value": ""},
					{"Attribute":"mx_Event_Date", "Value": "'.$dt.'"},
					{"Attribute":"mx_Fast_Track_Status", "Value": "Not Completed"},
					{"Attribute":"Source", "Value": "Facebook"},
					{"Attribute":"SourceCampaign", "Value": "IrelandInhouseFairOct2019"},
					{"Attribute": "mx_Fair_Type","Value": "IrelandInhouseFairOct2019"},
					{"Attribute": "mx_Fair_Registration_Status","Value": "No"},
					{"Attribute": "mx_choprasleadsource","Value": "IrelandInhouseFairOct2019"},
					{"Attribute": "mx_URL","Value": "https://url.tcglobal.com/'.$random_string.'"},
					{"Attribute": "mx_Type_of_GEI_Appointment_Auto","Value": "Self Fast Track"},
					{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"}
					]';
//print_r($data_string);
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
//die;
$st = $data->Status;
$ExceptionMessage = $data->ExceptionMessage;
if($ExceptionMessage == 'A Lead with same Phone Number already exists.')
{
	$data_string = '[
					{"Attribute":"SearchBy", "Value": "EmailAddress"},
					{"Attribute":"FirstName", "Value": "'.$_GET['first_name'].'"},
					{"Attribute":"LastName", "Value": "'.$_GET['last_name'].'"},
					{"Attribute":"EmailAddress", "Value": "'.$_GET['email'].'"},
					
					{"Attribute":"mx_City", "Value": "'.$_GET['city'].'"},
					{"Attribute":"mx_GEI_Venue", "Value": ""},
					{"Attribute":"mx_Event_Venue", "Value": "'.$venue.'"},
					{"Attribute":"mx_Level_of_Study", "Value": "'.$_GET['level_of_study'].'"},
					{"Attribute":"mx_Area_of_Study", "Value": "'.$_GET['area_of_study'].'"},
					{"Attribute": "mx_GEI_Address","Value": "'.$map.'"},
					{"Attribute": "mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},
					{"Attribute": "mx_Google_Calendar_URL","Value": ""},
					{"Attribute":"mx_GEI_Date", "Value": ""},
					{"Attribute":"mx_Event_Date", "Value": "'.$dt.'"},
					{"Attribute":"mx_Fast_Track_Status", "Value": "Not Completed"},
					{"Attribute":"Source", "Value": "Facebook"},
					{"Attribute":"SourceCampaign", "Value": "IrelandInhouseFairOct2019"},
					{"Attribute": "mx_Fair_Type","Value": "IrelandInhouseFairOct2019"},
					{"Attribute": "mx_Fair_Registration_Status","Value": "No"},
					{"Attribute": "mx_choprasleadsource","Value": "IrelandInhouseFairOct2019"},
					{"Attribute": "mx_URL","Value": "https://url.tcglobal.com/'.$random_string.'"},
					{"Attribute": "mx_Type_of_GEI_Appointment_Auto","Value": "Self Fast Track"},
					{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"}
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

}
//echo  $st = $data->Status;
$email = $_GET['email'];

$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
			$data_string2='{
				"EmailAddress": "'.$email.'",
				"ActivityEvent": 192,
				"ActivityNote": "IrelandInhouseFairOct2019",				
				"Fields": [
					{
						"SchemaName": "mx_Custom_1",
						"Value": "IrelandInhouseFairOct2019"
						
					},
					{
						"SchemaName": "mx_Custom_2",
						"Value": ""  
					}
								   
				]
			}';

			try
			{
				$curl2 = curl_init($url2);
				curl_setopt($curl2, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl2, CURLOPT_HEADER, 0);
				curl_setopt($curl2, CURLOPT_POSTFIELDS, $data_string2);
				curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl2, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/json',
				'Content-Length:'.strlen($data_string2)
				));
				$json_response2 = curl_exec($curl2);
				curl_close($curl2);
			} catch (Exception $ex2) { 
				curl_close($curl2);
			}
			$data2 = json_decode($json_response2);	
			//print_r($data2);die;
			$st2 = $data2->Status;