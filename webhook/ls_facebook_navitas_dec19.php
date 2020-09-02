<?php
	
	//leadbridge data	
	$first_name		= $_GET['first_name'];
	$last_name		= $_GET['last_name'];
	$email			= $_GET['email'];	
	$phone			= substr($_GET['phone_number'], -10);	
	$level_of_study	= $_GET['level_of_study'];	
	$area_of_study	= $_GET['area_of_study'];
	$venuAddress	= $_GET['i_would_like_to_attend_global_education_interact_in'];
	
	/*
	$first_name		= 'rajeev11111';
	$last_name		= 'mehta';
	$email			= 'rajeev11111@gmail.com';	
	$phone			= '4555555555';
	$level_of_study	= 'Postgraduate';	
	$area_of_study	= 'Computer Science & IT';
	$venuAddress	= 'the chopras office hyderabad';	
*/

	$city	= "";
	$venue	= "";
	
	if(strtolower(trim($venuAddress))== "the chopras office hyderabad"){
		$city	= "Hyderabad";
		$branch = "Hyderabad";
		$venue	= "The Chopras Office Hyderabad";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Hyderabad&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjYm52356LmAhUZyzgGHWv3DNoQ_AUoAXoECBQQAw";
	}
	
	if(strtolower(trim($venuAddress))=="the chopras office jaipur"){
		$city	= "Jaipur";
		$branch = "Jaipur";
		$venue	= "The Chopras Office Jaipur";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Jaipur&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj4_YbN56LmAhUOzTgGHegwBUcQ_AUoAXoECBUQAw";
	}
	
	if(strtolower(trim($venuAddress))== "the chopras office ncr delhi"){
		$city	= "NCR Delhi ";
		$branch = "NCR Delhi ";
		$venue	= "The Chopras Office NCR Delhi ";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.549669,77.2479983,17z/data=!3m1!4b1!4m5!3m4!1s0x390d0372ba63dfa9:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
	}	
	
	if(strtolower(trim($venuAddress))=="the chopras office ncr gurgaon"){
		$city	= "NCR Gurgaon";
		$branch = "NCR Gurgaon";
		$venue	= "The Chopras Office NCR Gurgaon";
		//$dt	= "2019-11-02 11:00:00";
		//$dt1	= "2019-11-02";
		$cal="";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Gurgaon&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjjnpCD6KLmAhXgzjgGHYnaBqYQ_AUoAXoECBQQAw";
	}

	if(strtolower(trim($venuAddress))=="the chopras office ncr north delhi"){
		$city	= "NCR North Delhi";
		$branch = "NCR North Delhi";
		$venue	= "The Chopras Office NCR North Delhi";
		//$dt	= "2019-11-04 11:00:00";
		//$dt1	= "2019-11-04";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+North+Delhi/@28.7064178,77.1875424,17z/data=!3m1!4b1!4m5!3m4!1s0x390cfdede66f6649:0x8833a1646b6bb001!8m2!3d28.7064178!4d77.1897311";
	}

	if(strtolower(trim($venuAddress))=="the chopras office ncr west delhi"){
		$city	= "NCR West Delhi";
		$branch = "NCR West Delhi";
		$venue	= "The Chopras Office NCR West Delhi";
		//$dt	= "2019-11-06 11:00:00";
		//$dt1	= "2019-11-06";
		$cal="";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+West+Delhi&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjR_JOu6KLmAhUMyzgGHTKnBSEQ_AUoAXoECBIQAw";
	}
		
	if(strtolower(trim($venuAddress))== "the chopras office ahmedabad"){
		$city	= "Ahmedabad";
		$branch = "Ahmedabad";
		$venue	= "The Chopras Office Ahmedabad";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Office+Ahmedabad&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj0juq66KLmAhVfxzgGHXmiCVYQ_AUoAXoECBIQAw";
	}

	if(strtolower(trim($venuAddress))== "the chopras office kochi"){
		$city	= "Kochi";
		$branch = "Kochi";
		$venue	= "The Chopras Office Kochi";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Office+Kochi&um=1&ie=UTF-8&sa=X&ved=2ahUKEwipvcTS6KLmAhWCzTgGHfEaCtIQ_AUoAXoECBYQAw";
	}	

	if(strtolower(trim($venuAddress))=="the chopras office chandigarh"){
		$city	= "Chandigarh";
		$branch = "Chandigarh";
		$venue	= "The Chopras Office Chandigarh";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Chandigarh&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj2qrvx6KLmAhVrwTgGHZiBDO8Q_AUoAXoECBUQAw";
	}

	if(strtolower(trim($venuAddress))=="the chopras office vijayawada"){
		$city	= "Vijayawada";
		$branch = "Vijayawada";
		$venue	= "The Chopras Office Vijayawada";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Vijayawada&um=1&ie=UTF-8&sa=X&ved=2ahUKEwje_be_6aLmAhWvxTgGHXQ4AEcQ_AUoAXoECA8QAw";
	}	
	
	$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
	$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';
	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;	
	$data_string = '[
			{"Attribute":"SearchBy", "Value": "EmailAddress"},
			{"Attribute":"FirstName", "Value": "'.$first_name.'"},
			{"Attribute":"LastName", "Value": "'.$last_name.'"},
			{"Attribute":"EmailAddress", "Value": "'.$email.'"},
			{"Attribute":"Phone", "Value": "'.$phone.'"},
			{"Attribute":"mx_Level_of_Study", "Value": "'.$level_of_study.'"},
			{"Attribute":"mx_Area_of_Study", "Value": "'.$area_of_study.'"},			
			{"Attribute":"mx_City", "Value": "'.$city.'"},						
			{"Attribute":"mx_Fair_Type","Value": "NAVITAS-Dec2019"},
			{"Attribute":"Source","Value": "Facebook"},			
			{"Attribute":"SourceCampaign","Value": "NAVITAS-Dec2019"},						
			{"Attribute":"mx_choprasleadsource","Value": "NAVITAS-Dec2019"},
			{"Attribute":"SourceMedium", "Value": "Facebook"},	
			{"Attribute":"mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},	
			{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},
			{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
			{"Attribute":"mx_Events_Venue_Map","Value": "'.$map.'"}			
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
			
			$data	 = json_decode($json_response);			
			//print_r($json_response);
			//print_r($data);
			//die;
			$st			= $data->Status;
			$leadid		= $data->Message->Id;
			$relatedid	= $data->Message->RelatedId;			
			
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
						{"Attribute":"FirstName", "Value": "'.$first_name.'"},
						{"Attribute":"LastName", "Value": "'.$last_name.'"},
						{"Attribute":"EmailAddress", "Value": "'.$email.'"},
						{"Attribute":"Phone", "Value": "'.$phone.'"},
						{"Attribute":"mx_Level_of_Study", "Value": "'.$level_of_study.'"},
						{"Attribute":"mx_Area_of_Study", "Value": "'.$area_of_study.'"},			
						{"Attribute":"mx_City", "Value": "'.$city.'"},						
						{"Attribute":"mx_Fair_Type","Value": "NAVITAS-Dec2019"},
						{"Attribute":"Source","Value": "Facebook"},			
						{"Attribute":"SourceCampaign","Value": "NAVITAS-Dec2019"},						
						{"Attribute":"mx_choprasleadsource","Value": "NAVITAS-Dec2019"},
						{"Attribute":"SourceMedium", "Value": "Facebook"},	
						{"Attribute":"mx_Source_GEI_id","Value": "'.$_GET['adset_id'].'"},	
						{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},
						{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
						{"Attribute":"mx_Events_Venue_Map","Value": "'.$map.'"}			
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
					
				$status_relatedid=$relatedid;
					
				//$get_leadid = "update gei_registration set email='$email' where mobile ='$phone' and eventid='$eventid'";
				//$qry_leadid = pg_query($get_leadid);
					
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
					"EmailAddress": "'.$email.'",
					"ActivityEvent": 192,
					"ActivityNote": "NAVITAS-Dec2019",				
					"Fields": [
						{
							"SchemaName": "mx_Custom_1",
							"Value": "NAVITAS-Dec2019"
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
							"SchemaName": "mx_Custom_6",
							"Value": "" 
						},	
						{
							"SchemaName": "mx_Custom_7",
							"Value": "'.$map.'" 
						}		   
					]
					}';
					echo "<pre>";
					print_r($data_string2);
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
					
					//print_r($data2);
					//die;
				} 
				
				
				if($recordcount > 0)
				{
					for($i=0;$i<$recordcount;$i++)
					{
						$prospectactivityid=$data_activity->ProspectActivities[$i]->Id;
						$Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_1;
						//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
						
						$customdata = 0;
						if($Custom_1=='NAVITAS-Dec2019')
						{
							$customdata++;							
						}
					}	
						
					if($customdata>0)
					{
						$data_string = '{
						"ProspectActivityId":"'.$prospectactivityid.'",
						"ActivityEvent":192,
						"Fields":[
							
							{
								"SchemaName": "mx_Custom_1",
								"Value": "NAVITAS-Dec2019"
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
								"SchemaName": "mx_Custom_6",
								"Value": "" 
							},	
							{
								"SchemaName": "mx_Custom_7",
								"Value": "'.$map.'" 
							}
							
							]}';
							
							
							print_r($data_string);
							
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
						print_r($data);die;
						$data2	= json_decode($json_response);	
						$st2 	= $data2->Status;
					}
					else{
						$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
						$data_string2='{
						"EmailAddress": "'.$email.'",
						"ActivityEvent": 192,
						"ActivityNote": "NAVITAS-Dec2019",				
						"Fields": [
							{
								"SchemaName": "mx_Custom_1",
								"Value": "NAVITAS-Dec2019"
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
								"SchemaName": "mx_Custom_6",
								"Value": "" 
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
					}								
									
				}				
			}