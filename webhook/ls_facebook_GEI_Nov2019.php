<?php
	$con_string = "host=chopra.cthuw9tptcfh.ap-south-1.rds.amazonaws.com port=9289 dbname=gei_event user=chopra password=Admin123";
	$dbcon = pg_connect($con_string); 	
	
	$FirstName		= $_GET['first_name'];
	$LastName		= $_GET['last_name'];
	$email			= $_GET['email'];	
	$phone			= substr($_GET['phone_number'], -10);	
	$level_st	= $_GET['level_of_study'];
	$level	= str_replace('%20',' ',$level_st);
	$area_st	= $_GET['area_of_study'];
	$area	= str_replace('%20',' ',$area_st);
	$venuAddress	= $_GET['i_would_like_to_attend_global_education_interact_in'];
	$city			= $_GET['city'];
	$adset= rawurldecode(trim($_GET['adset_id']));
	$asource='Facebook';
	/*
	$first_name		= 'rajeev11111';
	$last_name		= 'mehta	';
	$email			= 'rajeev11111@test.com';	
	$phone			= '8888888888';	
	$level_of_study	= 'Research';	
	$area_of_study	= 'Engineering';
	$venuAddress	= 'the chopras office chandigarh';
	*/

	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$venuAddress_st = str_replace('%20', ' ',$venuAddress);

echo strtolower(trim($venuAddress_st));
	if(strtolower(trim($venuAddress_st))== "le meridien - new delhi"){
		//$city	= "Bangalore";
		$cty = "NCR Delhi";
		$branch = "NCR Delhi";
		$venue	= "Le Meridien - New Delhi";
		$dt	= "2019-11-26 11:00:00";
		$dt1="2019-11-26";
		$eventid = "GEI111904";
		//$cal	= "";
		$map	= "https://www.google.com/maps/place/Le+M%C3%A9ridien+New+Delhi/@28.5495331,77.0928493,12z/data=!4m11!1m2!2m1!1sLe+Meridian+delhi!3m7!1s0x390ce2ca0c23a6c7:0x393bb2179c15093a!5m2!4m1!1i2!8m2!3d28.6187901!4d77.2180082";
	}

	if(strtolower(trim($venuAddress_st))=="taj vivanta - bangalore"){
		//$city	= "Bangalore";
		$cty = "Bangalore";
		$branch = "Bangalore";
		$venue	= "TajVivanta - Bangalore";
		$dt	= "2019-11-24 11:00:00";
		$dt1="2019-11-24";
		$eventid = "GEI111903";
		//$cal	= "";
		$map	= "https://www.google.com/maps/place/Taj+MG+Road,+Bengaluru/@12.97326,77.6174783,17z/data=!3m1!4b1!4m8!3m7!1s0x3bae1686b281d2a3:0xfe17a276bcf050c5!5m2!4m1!1i2!8m2!3d12.97326!4d77.619667";
	}	

	if(strtolower(trim($venuAddress_st))=="taj bengal - kolkata"){
		//$city	= "Chennai";
		$cty = "Kolkata";
		$branch = "Kolkata";
		$venue	= "Taj Bengal - Kolkata";
		$dt	= "2019-11-17 11:00:00";
		$dt1="2019-11-17";
		$eventid = "GEI111901";
		//$cal	= "";
		$map	= "https://www.google.com/maps/place/Taj+Bengal+Kolkata/@22.5376899,88.3322639,17z/data=!3m1!4b1!4m8!3m7!1s0x3a027742c5766669:0xabaefc78ba555397!5m2!4m1!1i2!8m2!3d22.5376899!4d88.3344526";
	}

	if(strtolower(trim($venuAddress_st))=="hyatt regency - chennai"){
		//$city	= "Hyderabad";
		$cty = "Chennai";
		$branch = "Chennai";
		$venue	= "Hyatt Regency - Chennai";
		$dt	= "2019-11-20 11:00:00";
		$dt1="2019-11-20";
		$eventid = "GEI111902";
		//$cal	= "";
		$map	= "https://www.google.com/maps/place/Hyatt+Regency+Chennai/@13.0430452,80.2464967,17z/data=!3m1!4b1!4m8!3m7!1s0x3a5266466c3b5a81:0xfe35b8153aea85fd!5m2!4m1!1i2!8m2!3d13.0430452!4d80.2486854";
	}

	if(strtolower(trim($venuAddress_st))=="jw marriott - chandigarh"){
		//$city	= "Jaipur";
		$cty = "Chandigarh";
		$branch = "Chandigarh";
		$venue	= "JW Marriott - Chandigarh";
		$dt	= "2019-11-30 12:00:00";
		$dt1="2019-11-30";
		$eventid = "GEI111906";
	//	$cal="";
		$map="https://www.google.com/maps?client=firefox-b-d&q=jw+marriott+chandigarh&um=1&ie=UTF-8&sa=X&ved=0ahUKEwiQkpukyq_lAhVKuY8KHVoWAZMQ_AUIESgB";
	}
	
	if(strtolower(trim($venuAddress_st))== "the o hotel - pune"){
		//$city	= "Kolkata";
		$cty = "Pune";
		$branch = "Pune";
		$venue	= "The O Hotel - Pune";
		$dt	= "2019-11-29 11:00:00";
		$dt1="2019-11-29";
		$eventid = "GEI111905";
		//$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&sxsrf=ACYBGNSO3lvwvEoUnQO50LK3_9MF-Hdk1g:1571737371694&q=o+hotel+pune&uact=5&um=1&ie=UTF-8&sa=X&ved=0ahUKEwibie__ya_lAhVOOisKHY8FC0AQ_AUIESgB";
	}

	$strtime = strtotime($dt) - ( 330 * 60);
	$gei_date_ls = date("Y-m-d H:i:s", $strtime);
	
	pg_query("INSERT INTO public.lstest(data) VALUES ('".$str.'='.$city.$venue.'-'.$_GET['i_would_like_to_attend_global_education_interact_in'].'-'.$phone."')");


$query_register="select * from gei_registration where email ilike '".trim($_GET['email'])."'  and inhousefair=false and eventid='".$eventid."'"; 

$result_register = pg_query($query_register);
$numRows_register=pg_num_rows($result_register);

if($numRows_register==0){

 $as = $_GET['area_of_study'];
$res_as = str_replace('%20',' ',$as);
 $area_std = trim($res_as);

 $q1="SELECT * FROM public.stream_specilization_new where parentid='0' and title ilike '%".$area_std."%'";
$result1=pg_query($q1);
$row1=pg_fetch_array($result1);

  $q="select * from compmast where name ilike 'n&n Chopra Consultants-".$cty."'";
$result=pg_query($q);
$row=pg_fetch_array($result);

$fd="'".$dt1." 00:00:00'";
$td="'".$dt1." 23:59:59'";

$get_event_id = "select distinct compmast.compid,venue,to_char(startdate,'dd Mon YYYY') as d,startdate as starttime,event_master.eventid    from event_master
										join compmast  on compmast.compid=event_master.branchid where 
										event_master.event_date between $fd and $td";

$qry_get_event_id = pg_query($get_event_id);
$res_get_event_id = pg_fetch_array($qry_get_event_id);

$eventid = $res_get_event_id['eventid'];										
		
  echo $query="INSERT INTO public.gei_registration(
first_name, last_name, email, mobile, level_of_study, area_of_study_id, event_venue_id, fast_track_status, source,eventid,note)
VALUES ('".$_GET['first_name']."', '".$_GET['last_name']."', '".$_GET['email']."', '".$phone."', '".$_GET['level_of_study']."', '".$row1['id']."', '".$row['compid']."','Self Fast Track', 'Facebook','".$eventid."','GlobalEducationInteractNov2019') RETURNING id;";

$res=pg_query($query);
$new_id = pg_fetch_array($res);

$bid=$row['compid'].'-'.$new_id['id'];
pg_query("Update gei_registration set badge_id='".$bid."' where id='".$new_id['id']."'");


//$track_url='https://events.thechopras.com/aus-nz-global-ed-fair/fasttrack_fb.php?ref='.base64_encode($new_id['id']);
$track_url='https://gei.tcglobal.com/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($new_id['id']);

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
$track_url='https://gei.tcglobal.com/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($stdid);
$random_string=check_random();

$query_url="INSERT INTO public.url_shortner(uid, destination, gid) VALUES ('".$random_string."', '".$track_url."','".$stdid."');";
pg_query($query_url);

}
	
	
	$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
	$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';
	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;	
	
	$data_string = '[
				{"Attribute":"SearchBy", "Value": "EmailAddress"},
				{"Attribute":"FirstName", "Value": "'.$FirstName.'"},
				{"Attribute":"LastName", "Value": "'.$LastName.'"},
				{"Attribute":"EmailAddress", "Value": "'.$email.'"},
				{"Attribute":"Phone", "Value": "'.$phone.'"},
				{"Attribute":"mx_Level_of_Study", "Value": "'.$level.'"},
				{"Attribute":"mx_Area_of_Study", "Value": "'.$area.'"},
				
				{"Attribute":"mx_Fair_Type","Value": "GlobalEducationInteractNov2019"},
				{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},
				{"Attribute":"mx_GEI_Opted","Value": "Opted"},
				{"Attribute":"Source","Value": "'.$asource.'"},			
				{"Attribute":"SourceCampaign","Value": "GlobalEducationInteractNov2019"},
				{"Attribute":"mx_choprasleadsource","Value": "GlobalEducationInteractNov2019"},
				{"Attribute":"SourceMedium", "Value": "'.$asource.'"},
				{"Attribute":"mx_GEI_registration_status","Value": "No"},
				{"Attribute":"mx_GEI_Venue","Value": "'.$venue.'"},
				{"Attribute":"mx_GEI_Fast_Track_URL_New","Value": "https://url.tcglobal.com/'.$random_string.'"},
				{"Attribute":"mx_GEIs_Venue_Map","Value": "'.$map.'"},
				{"Attribute":"mx_GEI_Date","Value": "'.$gei_date_ls.'"},
				{"Attribute":"mx_Fast_Track_Status","Value": "Not Completed"},
				{"Attribute": "mx_Source_GEI_id","Value": "'.$adset.'"}
				
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
	
			//	print_r($json_response);
				$data = json_decode($json_response);
				//print_r($data);die;
				//exit();
				//-------------------Activity Updates Activity	
				$st = $data->Status;
				
				
				$ExceptionMessage = $data->ExceptionMessage;
				
				if($ExceptionMessage == 'A Lead with same Phone Number already exists.')
				{
					//retrive leadid by phone
					$curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&phone='.$phone,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            
			} else {
                    //echo $response;
					
					$data_lead = json_decode($response);
				//	echo "<pre>";
				//	print_r($data_lead);
				//	exit;
					$relatedid = $data_lead[0]->ProspectID;
					
					$email = $data_lead[0]->EmailAddress;
					
					
					$url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
					$data_string = '[
				
				{"Attribute":"FirstName", "Value": "'.$FirstName.'"},
				{"Attribute":"LastName", "Value": "'.$LastName.'"},
				
				{"Attribute":"Phone", "Value": "'.$phone.'"},
				{"Attribute":"mx_Level_of_Study", "Value": "'.$level.'"},
				{"Attribute":"mx_Area_of_Study", "Value": "'.$area.'"},
				
				{"Attribute":"mx_Fair_Type","Value": "GlobalEducationInteractNov2019"},
				{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},
				{"Attribute":"mx_GEI_Opted","Value": "Opted"},
				{"Attribute":"Source","Value": "'.$asource.'"},			
				{"Attribute":"SourceCampaign","Value": "GlobalEducationInteractNov2019"},
				{"Attribute":"mx_choprasleadsource","Value": "GlobalEducationInteractNov2019"},
				{"Attribute":"SourceMedium", "Value": "'.$asource.'"},
				{"Attribute":"mx_GEI_registration_status","Value": "No"},
				{"Attribute":"mx_GEI_Venue","Value": "'.$venue.'"},
				{"Attribute":"mx_GEI_Fast_Track_URL_New","Value": "https://url.tcglobal.com/'.$random_string.'"},
				{"Attribute":"mx_GEIs_Venue_Map","Value": "'.$map.'"},
				{"Attribute":"mx_GEI_Date","Value": "'.$gei_date_ls.'"},
				{"Attribute":"mx_Fast_Track_Status","Value": "Not Completed"},
				{"Attribute": "mx_Source_GEI_id","Value": "'.$adset.'"}
				
				
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
				//work tommarow
				
				$data_get = json_decode($json_response);
				//print_r($data_get);
				//exit;	
            }
					
					 $relatedid;
			 		 $status_relatedid=$relatedid;
					
				$get_leadid = "update gei_registration set email='$email' where mobile ='$phone' and eventid='$eventid'";
				$qry_leadid = pg_query($get_leadid);
					
				}
				else
				{
					$st = $data->Status;
				
				 	$Status_st = $data->Status;
			  		$leadid=$data->Message->Id;
			  		$relatedid=$data->Message->RelatedId;
				    $status_relatedid=$data->Message->RelatedId;
				}
				//end of if 
				
				//$data = json_decode($json_response);
			
				 $relatedid;
				
				$status_relatedid;
				
				
			 			
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
				//die;
				 $recordcount = $data_activity->RecordCount;
				if($recordcount == 0)
				{
						$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
			$data_string2='{
				"EmailAddress": "'.$email.'",
				"ActivityEvent": 192,
				"ActivityNote": "GlobalEducationInteractNov2019",				
				"Fields": [
					{
						"SchemaName": "mx_Custom_1",
						"Value": "GlobalEducationInteractNov2019"
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
						"SchemaName": "mx_Custom_7",
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
				print_r($json_response2);
				curl_close($curl2);
			} catch (Exception $ex2) { 
				curl_close($curl2);
			}
			echo $data2 = json_decode($json_response2);	
			echo $st2 = $data2->Status;
			//die;
			} 
				if($recordcount > 0)
				{
				//echo $recordcount;
				
				$count_Custom_1 = 0; 
				for($i=0;$i<$recordcount;$i++)
				{
					 $prospectactivityid=$data_activity->ProspectActivities[$i]->Id;
					 $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_1;
					//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
					if($Custom_1=='GlobalEducationInteractNov2019')
					{
						$count_Custom_1 = $count_Custom_1+1; 
						$data_string = '{
						"ProspectActivityId":"'.$prospectactivityid.'",
						"ActivityEvent":192,
						"Fields":[
							
							
							{
								"SchemaName": "mx_Custom_1",
								"Value": "GlobalEducationInteractNov2019"
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
								"SchemaName": "mx_Custom_7",
								"Value": "" 
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
						//print_r($data2);

						//die;
					}
				}
				
					$data2 = json_decode($json_response);	
					$st2 = $data2->Status;
					//echo $count_Custom_1;
					
					//exit;
					if($count_Custom_1 == 0)
					{
						
							$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
				$data_string2='{
					"EmailAddress": "'.$email.'",
					"ActivityEvent": 192,
					"ActivityNote": "GlobalEducationInteractNov2019",				
					"Fields": [
						{
							"SchemaName": "mx_Custom_1",
							"Value": "GlobalEducationInteractNov2019"
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
							"SchemaName": "mx_Custom_7",
							"Value": "" 
						}
						
									   
					]
				}';
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
				
						
					}
				}
				//die;
			}
				
				//-------------------End of Update Facebook Activity
				//echo $Status_st;
				//exit;
				if($Status_st == 'Success')
				{
					
					//$asource = $row_register['source'];
					$asource = 'Facebook';
					$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
					$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';	
	
					//$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
					$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=' . $accessKey . '&secretKey=' . $secretKey .'&leadId='.$status_relatedid;
					
					$data_string = '[
									{"Attribute":"Source","Value": "'.$asource.'"}	
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
						
								//	print_r($json_response);
									$data_source = json_decode($json_response);
								//	print_r($data);die;
									//exit();
									//-------------------Activity Updates Activity	
									 	$st = $data_source->Status;
					
				//exit;
				}