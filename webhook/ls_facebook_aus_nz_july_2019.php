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
	$branch = "NCR Delhi";
	$venue="The Chopras Office - NCR Delhi";
	$dt="2019-08-03";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NWV1NjYwNGw4MDNvZTFlaGVtZGRldmEwY3Ugd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.549669,77.250187,15z/data=!4m5!3m4!1s0x0:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="mumbai"){
	$city="Mumbai Andheri West";
	$branch = "Mumbai Andheri West";
	$venue="The Chopras Office - Mumbai Andheri West";
	$dt="2019-07-28";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MGVoOXU0NWh1bXVkY2xqN2JudHF2MzRtdTIgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Mumbai+Andheri/@19.1195122,72.8417673,737m/data=!3m2!1e3!4b1!4m5!3m4!1s0x3be7c9d10da487eb:0xa286e353edfbcf92!8m2!3d19.1195122!4d72.843956";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="bangalore"){
	$city="Bangalore";
	$branch = "Bangalore";
	$venue="The Chopras Office - Bangalore";
	$dt="2019-07-26";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NjN0ZjBvN2V2Zm5uYmFoY2tzdDZuZ2k1Mmsgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Bangalore/@12.9741638,77.6134511,760m/data=!3m2!1e3!4b1!4m5!3m4!1s0x3bae1684780add8f:0x2975a5269ddd993d!8m2!3d12.9741638!4d77.6156398";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="hyderabad"){
	$city="Hyderabad";
	$branch = "Hyderabad";
	$venue="The Chopras Office - Hyderabad";
	$dt="2019-07-24";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NmxxMHZ2Y2plMzZjYW5iaWxlYW5ibHE4bzIgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Hyderabad/@17.415027,78.4480333,744m/data=!3m2!1e3!4b1!4m5!3m4!1s0x1143d031882711c9:0xb2c315bd1e023237!8m2!3d17.415027!4d78.450222";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="kolkata"){
	$city="Kolkata";
	$branch = "Kolkata";
	$venue="The Chopras Office - Kolkata";
	$dt="2019-07-20";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MWJpMDkxMmpqdXBuM2pjajUwdWV2c2pzaW8gd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/The+Chopras+Kolkata/@22.5435298,88.3495704,721m/data=!3m2!1e3!4b1!4m5!3m4!1s0x3a0277170b6626c9:0xefffd6c7142169b0!8m2!3d22.5435298!4d88.3517591";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="chennai"){
	$city="Chennai";
	$branch = "Chennai";
	$venue="The Chopras Office - Chennai";
	$dt="2019-07-25";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MHV0MHN1MmZpbnU4cmRzMnI2dm10ZTZzbzYgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Chennai/@13.0546247,80.2469559,760m/data=!3m2!1e3!4b1!4m5!3m4!1s0x110565cd1712fdff:0x6d4d36694932eedf!8m2!3d13.0546247!4d80.2491446";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="pune"){
	$city="Pune";
	$branch = "Pune";
	$venue="The Chopras Office - Pune";
	$dt="2019-07-27";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=NjEzcGFwNGMwaTR0dDZqc2lyaTZmNmpnY3Ugd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Pune/@18.5201353,73.8435366,740m/data=!3m2!1e3!4b1!4m5!3m4!1s0x3bc2bf87f9a71785:0x16017dfcca2a8a64!8m2!3d18.5201353!4d73.8457253";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="chandigarh"){
	$city="Chandigarh";
	$branch = "Chandigarh";
	$venue="The Chopras Office - Chandigarh";
	$dt="2019-08-04";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MmJnNjN2ajU4dnFpMTNtbWFzNjFqNnEzZ3Egd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Chandigarh/@30.7380665,76.7822072,671m/data=!3m2!1e3!4b1!4m5!3m4!1s0x390fed0baaaaaaab:0x7c3dbaf52213ec21!8m2!3d30.7380665!4d76.7843959";
}

/*if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="lucknow"){
	$city="Lucknow";
	$venue="Hyatt Regency - Lucknow";
	$dt="2019-06-20";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=Mjdua3BlY280MTNzODRxM2lsZnJpc3Q3ODUgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/Hyatt+Regency+Lucknow/@26.8660254,81.0034063,17z/data=!3m1!4b1!4m5!3m4!1s0x399be2bf1d0b173f:0xcfc7ea49649f8e23!8m2!3d26.8660254!4d81.005595";
}*/

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="jaipur"){
	$city="Jaipur";
	$branch = "Jaipur";
	$venue="The Chopras Office - Jaipur";
	$dt="2019-08-01";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=N2M1b3ZyMjc2Z2hoM29jb21sdTdiMDM3NXMgd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
				$map="https://www.google.com/maps/place/The+Chopras+Jaipur/@26.9199691,75.7938022,696m/data=!3m2!1e3!4b1!4m5!3m4!1s0x396db3f81751ad17:0x1704a971c156c20a!8m2!3d26.9199691!4d75.7959909";

}

/*
if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="kochi"){
	$city="Cochin";
	$venue="Radisson Blu Kochi - Cochin";
	$dt="2019-06-10";
	$cal="https://calendar.google.com/event?action=TEMPLATE&tmeid=MjJzdXFiM200cHMwdTcxZnBvMzgydms4b2Ugd2VicXVlcmllc0B0aGVjaG9wcmFzLmNvbQ&tmsrc=webqueries%40thechopras.com";
	$map="https://www.google.com/maps/place/Radisson+Blu+Kochi/@9.967366,76.3049841,17z/data=!3m1!4b1!4m5!3m4!1s0x3b0872d1c088f139:0x54974bd38aab09b8!8m2!3d9.967366!4d76.3071728";
}
*/
$phone=substr($_GET['phone_number'], -10);

	//$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
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

 $get_event_id = "select distinct compmast.compid,venue,to_char(startdate,'dd Mon YYYY') as d,startdate as starttime,event_master.eventid    from event_master
										join compmast  on compmast.compid=event_master.branchid where event_master.note ilike '%Aus/NZ%' and event_master.event_date between '".$dt." 00:00:00' and '".$dt." 23:59:59'";

$qry_get_event_id = pg_query($get_event_id);
$res_get_event_id = pg_fetch_array($qry_get_event_id);

$eventid = $res_get_event_id['eventid'];										
		
$query="INSERT INTO public.gei_registration(
first_name, last_name, email, mobile, level_of_study, area_of_study_id, event_venue_id, fast_track_status, source,inhousefair,eventid,note)
VALUES ('".$_GET['first_name']."', '".$_GET['last_name']."', '".$_GET['email']."', '".$phone."', '".$_GET['level_of_study']."', '".$row1['id']."', '".$row['compid']."','Self Fast Track', 'Facebook Form','true','".$eventid."','AUSNZFair') RETURNING id;";

$res=pg_query($query);
$new_id = pg_fetch_array($res);

$bid=$row['compid'].'-'.$new_id['id'];
pg_query("Update gei_registration set badge_id='".$bid."' where id='".$new_id['id']."'");


//$track_url='https://events.thechopras.com/aus-nz-global-ed-fair/fasttrack_fb.php?ref='.base64_encode($new_id['id']);
$track_url='https://events.thechopras.com/aus-nz-global-ed-fair/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($new_id['id']);

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
					{"Attribute":"SearchBy", "Value": "EmailAddress"},
					{"Attribute":"FirstName", "Value": "'.$_GET['first_name'].'"},
					{"Attribute":"LastName", "Value": "'.$_GET['last_name'].'"},
					{"Attribute":"EmailAddress", "Value": "'.$_GET['email'].'"},
					{"Attribute":"Phone", "Value": "'.$phone.'"},
					{"Attribute":"mx_City", "Value": "'.$_GET['city'].'"},
					{"Attribute":"mx_GEI_Venue", "Value": ""},
					{"Attribute":"mx_Event_Venue", "Value": "'.$city.'"},
					{"Attribute":"mx_Level_of_Study", "Value": "'.$_GET['level_of_study'].'"},
					{"Attribute":"mx_Area_of_Study", "Value": "'.$_GET['area_of_study'].'"},
					{"Attribute":"ProspectStage", "Value": "Fresh"},
					{"Attribute": "mx_GEI_Address","Value": "'.$map.'"},
					{"Attribute": "mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},
					{"Attribute": "mx_Google_Calendar_URL","Value": "'.$cal.'"},
					{"Attribute":"mx_GEI_Date", "Value": ""},
					{"Attribute":"mx_Event_Date", "Value": "'.$dt.'"},
					{"Attribute":"mx_Fast_Track_Status", "Value": "Not Completed"},
					{"Attribute":"Source", "Value": "Facebook"},
					{"Attribute":"SourceCampaign", "Value": "AUSNZFair"},
					{"Attribute": "mx_Fair_Type","Value": "AUSNZFair"},
					{"Attribute": "mx_Fair_Registration_Status","Value": "No"},
					{"Attribute": "mx_choprasleadsource","Value": "Facebook"},
					{"Attribute": "mx_URL","Value": "https://url.thechopras.com/'.$random_string.'"},
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