<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	//include_once('config.php');
	//$class=new webconfig();
	//$class->DBConnect();
	
	$con_string = "host=chopra.cthuw9tptcfh.ap-south-1.rds.amazonaws.com port=9289 dbname=gei_event user=chopra password=Admin123";
	$dbcon = pg_connect($con_string); 	
	
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
	$email			= 'rajeev11111@test.com';	
	$phone			= '8888111111';	
	$level_of_study	= 'Research';	
	$area_of_study	= 'Engineering';
	$venuAddress	= 'the chopras office chandigarh';
	*/

	$city	= "";
	$venue	= "";
	if(strtolower(trim($venuAddress))== "the chopras office bangalore"){
		$city	= "Bangalore";
		$branch = "Bangalore";
		$venue	= "The Chopras Office Bangalore";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Bangalore/@12.9741638,77.6134511,17z/data=!3m1!4b1!4m5!3m4!1s0x3bae1684780add8f:0x2975a5269ddd993d!8m2!3d12.9741638!4d77.6156398";
	}

	if(strtolower(trim($venuAddress))=="the chopras office chandigarh"){
		$city	= "Chandigarh";
		$branch = "Chandigarh";
		$venue	= "The Chopras Office Chandigarh";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Chandigarh/@30.7380711,76.7822072,17z/data=!3m1!4b1!4m5!3m4!1s0x390fed0baaaaaaab:0x7c3dbaf52213ec21!8m2!3d30.7380665!4d76.7843959";
	}	

	if(strtolower(trim($venuAddress))=="the chopras office chennai"){
		$city	= "Chennai";
		$branch = "Chennai";
		$venue	= "The Chopras Office Chennai";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Chennai/@13.0546247,80.2469559,17z/data=!3m1!4b1!4m5!3m4!1s0x110565cd1712fdff:0x6d4d36694932eedf!8m2!3d13.0546247!4d80.2491446";
	}

	if(strtolower(trim($venuAddress))=="the chopras office hyderabad"){
		$city	= "Hyderabad";
		$branch = "Hyderabad";
		$venue	= "The Chopras Office Hyderabad";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Hyderabad/@17.4150321,78.4480333,17z/data=!3m1!4b1!4m5!3m4!1s0x1143d031882711c9:0xb2c315bd1e023237!8m2!3d17.415027!4d78.450222";
	}

	if(strtolower(trim($venuAddress))=="the chopras office jaipur"){
		$city	= "Jaipur";
		$branch = "Jaipur";
		$venue	= "The Chopras Office Jaipur";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1="2019-11-10";
		$cal="";
		$map="https://www.google.com/maps/place/The+Chopras+Jaipur/@26.9200362,75.7937765,17z/data=!3m1!4b1!4m5!3m4!1s0x396db3f81751ad17:0x1704a971c156c20a!8m2!3d26.9200314!4d75.7959652";
	}
	
	if(strtolower(trim($venuAddress))== "the chopras office kolkata"){
		$city	= "Kolkata";
		$branch = "Kolkata";
		$venue	= "The Chopras Office Kolkata";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Kolkata/@22.5435347,88.3495704,17z/data=!3m1!4b1!4m5!3m4!1s0x3a0277170b6626c9:0xefffd6c7142169b0!8m2!3d22.5435298!4d88.3517591";
	}

	if(strtolower(trim($venuAddress))=="the chopras office mumbai andheri west"){
		$city	= "Mumbai Andheri West";
		$branch = "Mumbai Andheri West";
		$venue	= "The Chopras Office Mumbai Andheri West";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Mumbai+Andheri/@19.0251709,72.6954227,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3be7c9d10da487eb:0xa286e353edfbcf92!8m2!3d19.1195122!4d72.843956";
	}	

	if(strtolower(trim($venuAddress))=="the chopras office mumbai churchgate"){
		$city	= "Mumbai Churchgate";
		$branch = "Mumbai Churchgate";
		$venue	= "The Chopras Office Mumbai Churchgate";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Churchgate+Mumbai/@19.0257146,72.6954218,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3a27af00c0062751:0xda859746bb6f080d!8m2!3d18.930286!4d72.827068";
	}

	if(strtolower(trim($venuAddress))=="the chopras office ncr delhi"){
		$city	= "NCR Delhi";
		$branch = "NCR Delhi";
		$venue	= "The Chopras Office NCR Delhi";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.6228319,77.1184858,12z/data=!4m8!1m2!2m1!1sthe+Chopras+delhi!3m4!1s0x390d0372ba63dfa9:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
	}

	if(strtolower(trim($venuAddress))=="the chopras office ncr gurgaon"){
		$city	= "NCR Gurgaon";
		$branch = "NCR Gurgaon";
		$venue	= "The Chopras Office NCR Gurgaon";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Gurugram/@28.4514876,77.0729876,17z/data=!3m1!4b1!4m5!3m4!1s0x390d19b23fffffbf:0xea2d7b8c84a0b78a!8m2!3d28.4514829!4d77.0751763";
	}
	
	if(strtolower(trim($venuAddress))=="the chopras office ncr north delhi"){
		$city	= "NCR North Delhi";
		$branch = "NCR North Delhi";
		$venue	= "The Chopras Office NCR North Delhi";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+North+Delhi/@28.6228319,77.1184858,12z/data=!4m8!1m2!2m1!1sthe+Chopras+delhi!3m4!1s0x390cfdede66f6649:0x8833a1646b6bb001!8m2!3d28.6957294!4d77.2044489";
	}


	if(strtolower(trim($venuAddress))=="the chopras office ncr west delhi"){
		$city	= "NCR West Delhi";
		$branch = "NCR West Delhi";
		$venue	= "The Chopras Office NCR West Delhi";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+West+Delhi/@28.6228319,77.1184858,12z/data=!4m8!1m2!2m1!1sthe+Chopras+delhi!3m4!1s0x1467f5dfd239f765:0x12faa882304bf9ef!8m2!3d28.6444665!4d77.1268667";
	}

	if(strtolower(trim($venuAddress))=="the chopras office pune"){
		$city	= "Pune";
		$branch = "Pune";
		$venue	= "The Chopras Office Pune";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Pune/@18.5201404,73.8435366,17z/data=!3m1!4b1!4m5!3m4!1s0x3bc2bf87f9a71785:0x16017dfcca2a8a64!8m2!3d18.5201353!4d73.8457253";
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
			{"Attribute": "mx_Fair_Type","Value": "AusNZFairnov2019"},
			{"Attribute": "Source","Value": "Facebook"},			
			{"Attribute": "SourceCampaign","Value": "AusNZFairnov2019"},						
			{"Attribute": "mx_choprasleadsource","Value": "AusNZFairnov2019"},
			{"Attribute":"SourceMedium", "Value": "Facebook"},
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
			$st		= $data->Status;
			$leadid	= $data->Message->Id;
			$relatedid = $data->Message->RelatedId;
			
			
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
						{"Attribute": "mx_Fair_Type","Value": "AusNZFairnov2019"},
						{"Attribute": "Source","Value": "Facebook"},			
						{"Attribute": "SourceCampaign","Value": "AusNZFairnov2019"},						
						{"Attribute": "mx_choprasleadsource","Value": "AusNZFairnov2019"},
						{"Attribute":"SourceMedium", "Value": "Facebook"},
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
					"ActivityNote": "AusNZFairnov2019",				
					"Fields": [
						{
							"SchemaName": "mx_Custom_1",
							"Value": "AusNZFairnov2019"
						},						
						{
							"SchemaName": "mx_Custom_3",
							"Value": "'.$venue.'" 
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
						if($Custom_1=='AusNZFairnov2019')
						{
							$data_string = '{
							"ProspectActivityId":"'.$prospectactivityid.'",
							"ActivityEvent":192,
							"Fields":[
								
								{
									"SchemaName": "mx_Custom_1",
									"Value": "AusNZFairnov2019"
								},								
								{
									"SchemaName": "mx_Custom_3",
									"Value": "'.$venue.'" 
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
					$data2	= json_decode($json_response);	
					$st2 	= $data2->Status;				
				}				
			}