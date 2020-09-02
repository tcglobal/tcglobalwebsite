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

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="the chopras office cochin"){
	$city="Cochin";
	$branch = "Cochin";
	$venue="The Chopras Office Cochin";
	$dt="2019-11-02 11:00:00";
	$dt1="2019-11-02";
	$cal="";
	$map="https://www.google.com/maps/place/The+Chopras+Kochi/@9.9619491,76.2878347,17z/data=!3m1!4b1!4m5!3m4!1s0x3b0872b9dda91c57:0x6379c329ec27ffac!8m2!3d9.9619491!4d76.2900234";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="the chopras office trivandrum"){
	$city="Trivandrum";
	$branch = "Trivandrum";
	$venue="The Chopras Office Trivandrum";
	$dt="2019-11-04 11:00:00";
	$dt1="2019-11-04";
	$cal="";
				$map="https://www.google.com/maps/place/The+Chopras+Thiruvananthapuram/@8.4919888,76.9500015,17z/data=!3m1!4b1!4m5!3m4!1s0x3b05bbde05555555:0x60eaf7001082a2b2!8m2!3d8.4919835!4d76.9521902";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="the grand regent coimbatore"){
	$city="Coimbatore";
	$branch = "Coimbatore";
	$venue="The Grand Regent Coimbatore";
	$dt="2019-11-06 11:00:00";
	$dt1="2019-11-06";
	$cal="";
				$map="https://www.google.com/maps/place/The+Grand+Regent/@11.0090713,76.9792992,17z/data=!3m1!4b1!4m8!3m7!1s0x3ba858315b353a45:0x55c20c70f65fe53c!5m2!4m1!1i2!8m2!3d11.0090713!4d76.9814879";
}


if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="the chopras office ludhiana"){
	$city="Ludhiana";
	$branch = "Ludhiana";
	$venue="The Chopras Office Ludhiana";
	$dt="2019-11-09 11:00:00";
	$dt1="2019-11-09";
	$cal="";
				$map="https://www.google.com/maps/place/The+Chopras+Ludhiana/@30.8935867,75.821879,17z/data=!3m1!4b1!4m5!3m4!1s0x391a83c1638d34f1:0x393dfc5b4922344c!8m2!3d30.8935821!4d75.8240677";
}

if(strtolower(trim($_GET['i_would_like_to_attend_global_education_interact_in']))=="the chopras office jaipur"){
	$city="Jaipur";
	$branch = "Jaipur";
	$venue="The Chopras Office Jaipur";
	$dt="2019-11-10 11:00:00";
	$dt1="2019-11-10";
	$cal="";
				$map="https://www.google.com/maps/place/The+Chopras+Jaipur/@26.9200362,75.7937765,17z/data=!3m1!4b1!4m5!3m4!1s0x396db3f81751ad17:0x1704a971c156c20a!8m2!3d26.9200314!4d75.7959652";
}


$strtime = strtotime($dt) - ( 330 * 60);
$gei_date_ls = date("Y-m-d H:i:s", $strtime);
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

$fd="'".$dt1." 00:00:00'";
$td="'".$dt1." 23:59:59'";

$get_event_id = "select distinct compmast.compid,venue,to_char(startdate,'dd Mon YYYY') as d,startdate as starttime,event_master.eventid    from event_master
										join compmast  on compmast.compid=event_master.branchid where event_master.note ilike '%Global InHouse Fair%' and event_master.event_date between $fd and $td";

$qry_get_event_id = pg_query($get_event_id);
$res_get_event_id = pg_fetch_array($qry_get_event_id);

$eventid = $res_get_event_id['eventid'];										
		
  $query="INSERT INTO public.gei_registration(
first_name, last_name, email, mobile, level_of_study, area_of_study_id, event_venue_id, fast_track_status, source,inhousefair,eventid,note)
VALUES ('".$_GET['first_name']."', '".$_GET['last_name']."', '".$_GET['email']."', '".$phone."', '".$_GET['level_of_study']."', '".$row1['id']."', '".$row['compid']."','Self Fast Track', 'Facebook',true,'".$eventid."','GlobalInhouseFairNov2019') RETURNING id;";

$res=pg_query($query);
$new_id = pg_fetch_array($res);

$bid=$row['compid'].'-'.$new_id['id'];
pg_query("Update gei_registration set badge_id='".$bid."' where id='".$new_id['id']."'");


//$track_url='https://events.thechopras.com/aus-nz-global-ed-fair/fasttrack_fb.php?ref='.base64_encode($new_id['id']);
$track_url='https://events.tcglobal.com/globalinhouse/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($new_id['id']);

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
$track_url='https://events.tcglobal.com/globalinhouse/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($stdid);
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
			{"Attribute":"mx_Level_of_Study", "Value": "'.$_GET['level_of_study'].'"},
			{"Attribute":"mx_Area_of_Study", "Value": "'.$_GET['area_of_study'].'"},
			{"Attribute": "mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},
			{"Attribute":"mx_City", "Value": "'.$city.'"},
			{"Attribute":"mx_Attend_Open_Session", "Value": "'.$attend.'"},	
			{"Attribute": "mx_Fair_Opted","Value": "Opted"},
			{"Attribute": "mx_Fair_Type","Value": "GlobalInhouseFairNov2019"},
			{"Attribute": "Source","Value": "Facebook"},			
			{"Attribute": "SourceCampaign","Value": "GlobalInhouseFairNov2019"},			
			{"Attribute": "mx_Fair_Registration_Status","Value": "No"},
			{"Attribute": "mx_choprasleadsource","Value": "GlobalInhouseFairNov2019"},
			{"Attribute":"SourceMedium", "Value": "Facebook"},
			{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},
			{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},
			{"Attribute":"mx_Event_Fast_Track_URL_New","Value": "https://url.tcglobal.com/'.$random_string.'"},
			{"Attribute":"mx_Events_Venue_Map","Value": "'.$map.'"},
			{"Attribute":"mx_Event_Date","Value": "'.$gei_date_ls.'"}
			
			]';
			//echo "<pre>";
			//print_r($data_string);
			//die;
	
						
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
			 $leadid=$data->Message->Id;
			 $relatedid=$data->Message->RelatedId;
			
			if($relatedid != '')
			{
				 $url_activity = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
				$data_string = '{"Parameter":{"ActivityEvent":192}}';
				try
				{
				$curl = curl_init($url_activity);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HEADER, 0);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array(
						"Content-Type:application/json",
						"Content-Length:".strlen($data_string)
						));
				$json_response = curl_exec($curl);
				//echo $json_response;
					curl_close($curl);
				} catch (Exception $ex) { 
					curl_close($curl);
				}
				
				$data_activity = json_decode($json_response);
				//echo "<pre>";
				//print_r($data_activity);
				
				 $recordcount = $data_activity->RecordCount;
				if($recordcount == 0 || $recordcount == '')
				{
						$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
			$data_string2='{
				"EmailAddress": "'.$_GET['email'].'",
				"ActivityEvent": 192,
				"ActivityNote": "GlobalInhouseFairNov2019",				
				"Fields": [
					{
						"SchemaName": "mx_Custom_1",
						"Value": "GlobalInhouseFairNov2019"
					},
					{
						"SchemaName": "mx_Custom_2",
						"Value": "" 
					},
					{
						"SchemaName": "mx_Custom_3",
						"Value": "'.$venue.'" 
					},
					{
						"SchemaName": "mx_Custom_4",
						"Value": "https://url.tcglobal.com/'.$random_string.'" 
					},
					{
						"SchemaName": "mx_Custom_5",
						"Value": "'.$gei_date_ls.'" 
					},
					{
						"SchemaName": "mx_Custom_6",
						"Value": "Self Fast Track" 
					},
					{
						"SchemaName": "mx_Custom_7",
						"Value": "'.$map.'" 
					}
					
								   
				]
			}';
		//echo "<pre>";
			//print_r($data_string2);
			//die;
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
				//print_r($json_response2);
				curl_close($curl2);
			} catch (Exception $ex2) { 
				curl_close($curl2);
			}
			$data2 = json_decode($json_response2);	
			$st2 = $data2->Status;
			
		//	print_r($data2);
		//	die;
			
			} 
				if($recordcount > 0)
				{
				for($i=0;$i<$recordcount;$i++)
				{
					 $prospectactivityid=$data_activity->ProspectActivities[$i]->Id;
					 $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_1;
					//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
					if($Custom_1=='GlobalInhouseFairNov2019')
					{
						$data_string = '{
						"ProspectActivityId":"'.$prospectactivityid.'",
						"ActivityEvent":192,
						"Fields":[
							
							
							{
								"SchemaName": "mx_Custom_1",
								"Value": "GlobalInhouseFairNov2019"
							},
							{
								"SchemaName": "mx_Custom_2",
								"Value": "" 
							},
							{
								"SchemaName": "mx_Custom_3",
								"Value": "'.$venue.'" 
							},
							{
								"SchemaName": "mx_Custom_4",
								"Value": "https://url.tcglobal.com/'.$random_string.'" 
							},
							{
								"SchemaName": "mx_Custom_5",
								"Value": "'.$gei_date_ls.'" 
							},
							{
								"SchemaName": "mx_Custom_6",
								"Value": "Self Fast Track" 
							},
							{
								"SchemaName": "mx_Custom_7",
								"Value": "'.$map.'" 
							}
							
							]}';
						try
						{
						$curl = curl_init('https://api-in21.leadsquared.com/v2/ProspectActivity.svc/CustomActivity/Update?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b');
						curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_HEADER, 0);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($curl, CURLOPT_HTTPHEADER, array(
								"Content-Type:application/json",
								"Content-Length:".strlen($data_string)
								));
						$json_response = curl_exec($curl);
						//echo $json_response;
							curl_close($curl);
						} catch (Exception $ex) { 
							curl_close($curl);
						}
						
						$data2 = json_decode($json_response);			
						//print_r($data);
					}
				}
				
					$data2 = json_decode($json_response);	
					$st2 = $data2->Status;
				
				}
				//die;
			}