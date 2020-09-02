<?php	
	$firstname		= $_REQUEST['firstname'];
	$lastname		= $_REQUEST['lastname'];
	$mobileNumber=$_REQUEST['mobile_number'];
	$email=$_REQUEST['emailaddress'];
	$service=$_REQUEST['service'];
	$interested_in=$_REQUEST['interested_in'];
	$current_page=$_REQUEST['current_page'];
	$ipAddress=$_REQUEST['ipAddress'];
	$choose_date=$_REQUEST['choose_date'];
	$choose_time=$_REQUEST['choose_time'];
	$choose_location=$_REQUEST['choose_location'];
	$location_address=$_REQUEST['location_address'];
	$onboardLink=$_REQUEST['onboardLink'];
	$ProspectID=$_REQUEST['ProspectID'];	
	
	if(empty($choose_location)){
		$choose_location = "ncr delhi";
		$location_address="The Chopras Office NCR Delhi";
	}
	
	if($service=='Global Learning' ||)
		
	
/*
	$firstname		= "RajeevJourney";;
	$lastname		= "Mehta";
	$mobileNumber	= "7428371531";
	$email			= "choprasit@gmail.com";
	$service		= "Global Education";
	//$interested_in= $_REQUEST['interested_in'];
	$current_page	= "Global Ed";
	$ipAddress		= "14.141.28.91";
	$choose_date	= "18-Dec-2019";
	$choose_time	= "12:00-13:00 PM";
	$choose_location= "Chandigarh";
	$location_address="SCO 117-118-119, Above Canara Bank Bldg, , Chandigarh,Chandigarh 160017";
	$onboardLink	= "http://tcglobal.wpengine.com/student-onboard";
	$ProspectID		= "09392576-1c2c-4abf-a3e5-377242e9f5b2";
*/

	if(empty($choose_time)){
		$eventDate	 = $choose_date.' 00:00:00';
		
		$newdate 	= strtotime ( '-5 hour -30 minute' , strtotime ( $eventDate ) ) ;
		$activityDate= date('Y-m-d H:i:s',$newdate);		
	}
	else{
		$timeArray	= explode('-',$choose_time);
		$time_slot	= $timeArray[0]; 
		
		$eventDate 	=  date('Y-m-d H:i:s',strtotime($choose_date.' '.$time_slot));
		$newdate 	= strtotime ( '-5 hour -30 minute' , strtotime ( $eventDate ) ) ;
		$activityDate= date('Y-m-d H:i:s',$newdate);
	}

	if($firstname=='' || $lastname=='' || $mobileNumber=='' || $email=='' || $service=='' || $ProspectID=='')
	{
		$data=array('status' => 'false','message' => 'error');
		echo $json_encode=json_encode($data);

	}
	else
	{

		/*
		include_once 'config/database.php';

		$database = new Database();
		$db = $database->getConnection();


		$sql = "INSERT INTO test (fname, lname, mobile,email,service,interested_in,ipaddress,page,choose_date,choose_time,location,address,url,prospect)
		VALUES ('".$firstname."','".$lastname."','".$mobileNumber."','".$email."','".$service."','".$interested_in."','".$ipAddress."','".$current_page."','".$choose_date."','".$choose_time."','".$choose_location."','".$location_address."','".$onboardLink."','".$ProspectID."')";

		$stmt = $db->prepare( $sql );
		$stmt->execute();

		if($stmt)
		{

			$data=array('status' => 'true','message' => 'Mail sent successfully');
			echo $json_encode=json_encode($data);

		}
		*/
		
		
		include_once 'config/database.php';	//database connection 
		include_once 'objects/student.php';	//student file

		$database = new Database();
		$db_ccpl = $database->getConnection_CCPL();
		//$db_aws = $database->getConnection();

		$user = new User($db_ccpl);
		$data = $user->GetStudentID($email,$mobileNumber);

		//print_r($data);exit;
		$studentID	= $data[0];
		$datereg	= $data[1];
		$onboarddate= $data[2];
		$cityid		= $data[3];
		$city		= $data[4];
		
		//$studentID	= "";
		//$datereg	= "aaaaaa";
		//$onboarddate= "bbbbbb";
	
		if(empty($studentID))
		{
			$city="Other";
		}
		
		if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
		{		
			
			$name		= $firstname." ".$lastname;			
					
			$query1 = "INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,fname,lname) values ($studentID,'$name','$email',$mobileNumber,'$cityid',now(),'tcglobal','tcglobalnewsite','$current_page','Website','$firstname','$lastname')";
			//$res1 = pg_query($db_ccpl,$query1);
			$stmt1 = $db_ccpl->prepare($query1);
			$stmt1->execute();		
			
			//counselling record		
			$query2 = "Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values (current_date,$studentID,1,1058,17,null,'".$current_page.'||'.$firstname.'||'.$lastname.'||'.$email.'||'.$mobileNumber.'||'.$city.'||'.$service.'||'.$choose_date.'||'.$choose_time.'||'.$choose_location.'||'.$location_address.'||'.$onboardLink.'||'.$ipAddress.'||'.$ProspectID."||Website||tcglobalnewsite')";	
			//$res1 = pg_query($db_ccpl,$query2);
			$stmt2 = $db_ccpl->prepare($query2);
			$stmt2->execute();				
			
		}	
		
		$city	= "";
		$venue	= "";
		
		if(strtolower(trim($choose_location))== "ahmedabad"){
			$city	= "Ahmedabad";
			$branch = "Ahmedabad";
			$venue	= "The Chopras Office Ahmedabad";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Ahmedabad/@23.0411986,72.5233778,17z/data=!3m1!4b1!4m5!3m4!1s0x395e9b4ceaaaaaab:0xbfb1bfbeec5d90dc!8m2!3d23.0411986!4d72.5255665";
		}
		
		if(strtolower(trim($choose_location))== "bangalore"){
			$city	= "Bangalore";
			$branch = "Bangalore";
			$venue	= "The Chopras Office Bangalore";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Bangalore&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj_tavR5a_mAhWBoOkKHW5BBf0Q_AUoAXoECBAQAw";
		}
		
		if(strtolower(trim($choose_location))=="chandigarh"){
			$city	= "Chandigarh";
			$branch = "Chandigarh";
			$venue	= "The Chopras Office Chandigarh";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Chandigarh&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj2k9bs5a_mAhUfzDgGHeU6CG4Q_AUoAXoECBcQAw";
		}
		
		if(strtolower(trim($choose_location))== "chennai"){
			$city	= "Chennai";
			$branch = "Chennai";
			$venue	= "The Chopras Office Chennai";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Chennai/@13.0546247,80.2469559,17z/data=!3m1!4b1!4m5!3m4!1s0x110565cd1712fdff:0x6d4d36694932eedf!8m2!3d13.0546247!4d80.2491446";
		}
		
		if(strtolower(trim($choose_location))== "cochin"){
			$city	= "Cochin";
			$branch = "Cochin";
			$venue	= "The Chopras Office Cochin";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Cochin&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiZt6aQ5q_mAhXHzjgGHUrfBtcQ_AUoAXoECBEQAw";
		}
		
		if(strtolower(trim($choose_location))=="coimbatore"){
			$city	= "Coimbatore";
			$branch = "Coimbatore";
			$venue	= "The Chopras Office Coimbatore";
			//$dt		= "2019-11-06 11:00:00";
			//$dt1	= "2019-11-06";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Coimbatore/@11.008926,76.9777943,17z/data=!3m1!4b1!4m5!3m4!1s0x3ba859b1624a4797:0x3c9255ca0e7fcd3e!8m2!3d11.008926!4d76.979983";					
		}

		if(strtolower(trim($choose_location))=="dehradun"){
			$city	= "Dehradun";
			$branch = "Dehradun";
			$venue	= "The Chopras Office Dehradun";
			//$dt		= "2019-11-06 11:00:00";
			//$dt1	= "2019-11-06";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Dehradun&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiz8Oet56_mAhUKzjgGHRPbCpsQ_AUoAXoECBMQAw";					
		}			

		if(strtolower(trim($choose_location))== "hyderabad"){
			$city	= "Hyderabad";
			$branch = "Hyderabad";
			$venue	= "The Chopras Office Hyderabad";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Hyderabad&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjYm52356LmAhUZyzgGHWv3DNoQ_AUoAXoECBQQAw";
		}
		
		if(strtolower(trim($choose_location))=="jaipur"){
			$city	= "Jaipur";
			$branch = "Jaipur";
			$venue	= "The Chopras Office Jaipur";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Jaipur&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj4_YbN56LmAhUOzTgGHegwBUcQ_AUoAXoECBUQAw";
		}		
			
		if(strtolower(trim($choose_location))=="kolkata"){
			$city	= "Kolkata";
			$branch = "Kolkata";
			$venue	= "The Chopras Office Kolkata";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Kolkata/@22.5435347,88.3495704,17z/data=!3m1!4b1!4m5!3m4!1s0x3a0277170b6626c9:0xefffd6c7142169b0!8m2!3d22.5435298!4d88.3517591";
		}
		
		if(strtolower(trim($choose_location))=="lucknow"){
			$city	= "Lucknow";
			$branch = "Lucknow";
			$venue	= "The Chopras Office Lucknow";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Lucknow&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiBherJ6K_mAhXvzjgGHU0yDS4Q_AUoAXoECA8QAw";
			
		}
		
		if(strtolower(trim($choose_location))=="ludhiana"){
			$city	= "Ludhiana";
			$branch = "Ludhiana";
			$venue	= "The Chopras Office Ludhiana";
			//$dt	= "2019-11-09 11:00:00";
			//$dt1	= "2019-11-09";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Ludhiana&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiF8MDp6K_mAhWFxjgGHfSzC1IQ_AUoAXoECBQQAw";
		}
		
		if(strtolower(trim($choose_location))=="mangalore"){
			$city	= "Mangalore";
			$branch = "Mangalore";
			$venue	= "The Chopras Office Mangalore";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Mangalore&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwigz5aC6a_mAhW-wjgGHWsJD4EQ_AUoAXoECBEQAw";		
		}
		
		if(strtolower(trim($choose_location))== "ncr delhi"){
			$city	= "NCR Delhi ";
			$branch = "NCR Delhi ";
			$venue	= "The Chopras Office NCR Delhi ";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.549669,77.2479983,17z/data=!3m1!4b1!4m5!3m4!1s0x390d0372ba63dfa9:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
		}	

		if(strtolower(trim($choose_location))=="ncr north delhi"){
			$city	= "NCR North Delhi";
			$branch = "NCR North Delhi";
			$venue	= "The Chopras Office NCR North Delhi";
			//$dt	= "2019-11-04 11:00:00";
			//$dt1	= "2019-11-04";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+North+Delhi/@28.7064178,77.1875424,17z/data=!3m1!4b1!4m5!3m4!1s0x390cfdede66f6649:0x8833a1646b6bb001!8m2!3d28.7064178!4d77.1897311";
		}

		if(strtolower(trim($choose_location))=="ncr west delhi"){
			$city	= "NCR West Delhi";
			$branch = "NCR West Delhi";
			$venue	= "The Chopras Office NCR West Delhi";
			//$dt	= "2019-11-06 11:00:00";
			//$dt1	= "2019-11-06";
			$cal="";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+West+Delhi&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjR_JOu6KLmAhUMyzgGHTKnBSEQ_AUoAXoECBIQAw";
		}

		if(strtolower(trim($choose_location))=="ncr gurgaon"){
			$city	= "NCR Gurgaon";
			$branch = "NCR Gurgaon";
			$venue	= "The Chopras Office NCR Gurgaon";
			//$dt	= "2019-11-02 11:00:00";
			//$dt1	= "2019-11-02";
			$cal="";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Gurgaon&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjjnpCD6KLmAhXgzjgGHYnaBqYQ_AUoAXoECBQQAw";
		}	

		if(strtolower(trim($choose_location))=="mumbai andheri west"){
			$city	= "Mumbai Andheri West";
			$branch = "Mumbai Andheri West";
			$venue	= "The Chopras Office Mumbai Andheri West";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Mumbai+Andheri/@19.0251709,72.6954227,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3be7c9d10da487eb:0xa286e353edfbcf92!8m2!3d19.1195122!4d72.843956";
		}

		if(strtolower(trim($choose_location))== "mumbai churchgate"){
			$city	= "Mumbai Churchgate ";
			$branch = "Mumbai Churchgate ";
			$venue	= "The Chopras Office Mumbai Churchgate ";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Churchgate+Mumbai/@19.0257146,72.6954218,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3a27af00c0062751:0xda859746bb6f080d!8m2!3d18.930286!4d72.827068";
		}		
		
		if(strtolower(trim($choose_location))=="pune"){
			$city	= "Pune";
			$branch = "Pune";
			$venue	= "The Chopras Office Pune";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Pune/@18.5201404,73.8435366,17z/data=!3m1!4b1!4m5!3m4!1s0x3bc2bf87f9a71785:0x16017dfcca2a8a64!8m2!3d18.5201353!4d73.8457253";
		}
		
		if(strtolower(trim($choose_location))=="trivandrum"){
			$city	= "Trivandrum";
			$branch = "Trivandrum";
			$venue	= "The Chopras Office Trivandrum";
			//$dt	= "2019-11-04 11:00:00";
			//$dt1	= "2019-11-04";
			$cal	= "";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Trivandrum&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiNpI7B6a_mAhW9yjgGHdUuBA4Q_AUoAXoECBAQAw";
		}		

		if(strtolower(trim($choose_location))=="vijayawada"){
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
				{"Attribute":"FirstName", "Value": "'.$firstname.'"},
				{"Attribute":"LastName", "Value": "'.$lastname.'"},
				{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
				{"Attribute":"EmailAddress", "Value": "'.$email.'"},				
				{"Attribute":"mx_Service_or_Product", "Value": "'.$service.'"},
				{"Attribute":"mx_City", "Value": "'.$choose_location.'"},					
				{"Attribute":"mx_Street1", "Value": "'.$location_address.'"},				
				{"Attribute":"Source","Value": "Website"},							
				{"Attribute":"mx_choprasleadsource","Value": "tcglobalnewsite"},
				{"Attribute":"SourceMedium", "Value": "'.$current_page.'"},
				{"Attribute":"mx_Nearest_Branch", "Value": "'.$choose_location.'"},				
				{"Attribute":"mx_Event_Date", "Value": "'.$eventDate.'"},
				{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
				{"Attribute":"mx_Events_Venue_Map","Value": "'.$map.'"}			
				]';
				echo "<pre>";
				print_r($data_string);
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
				
				$data	 			= json_decode($json_response);
				//print_r($data);
				//die;
				$relatedid			= $data->Message->RelatedId;	//data related id
				$ExceptionMessage 	= $data->ExceptionMessage;	//lead error message
							
				if($ExceptionMessage == 'A Lead with same Phone Number already exists.')
				{
					//retrive leadid by phone
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&phone='.$mobileNumber,
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
							echo "<pre>";
							print_r($data_lead);
						//	exit;
						$relatedid = $data_lead[0]->ProspectID;					
						$email = $data_lead[0]->EmailAddress;					
						
						$url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
						$data_string = '[
							{"Attribute":"SearchBy", "Value": "EmailAddress"},
							{"Attribute":"FirstName", "Value": "'.$firstname.'"},
							{"Attribute":"LastName", "Value": "'.$lastname.'"},
							{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
							{"Attribute":"EmailAddress", "Value": "'.$email.'"},				
							{"Attribute":"mx_Service_or_Product", "Value": "'.$service.'"},
							{"Attribute":"mx_City", "Value": "'.$choose_location.'"},					
							{"Attribute":"mx_Street1", "Value": "'.$location_address.'"},				
							{"Attribute":"Source","Value": "Website"},							
							{"Attribute":"mx_choprasleadsource","Value": "tcglobalnewsite"},
							{"Attribute":"SourceMedium", "Value": "'.$current_page.'"},
							{"Attribute":"mx_Nearest_Branch", "Value": "'.$choose_location.'"},				
							{"Attribute":"mx_Event_Date", "Value": "'.$eventDate.'"},
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
						
							$data_get = json_decode($json_response);
							//print_r($data_get);
							//exit;	
					}
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
						"ActivityNote": "'.$event_name.'",				
						"Fields": [
							{
								"SchemaName": "mx_Custom_1",
								"Value": ""
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
								"SchemaName": "mx_Custom_5",
								"Value": "'.$activityDate.'" 
							},							
							{
								"SchemaName": "mx_Custom_6",
								"Value": "" 
							},	
							{
								"SchemaName": "mx_Custom_7",
								"Value": "'.$map.'" 
							},
							{
								"SchemaName": "mx_Custom_10",
								"Value": "'.$event_name.'"
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
						
						print_r($data2);
						//die;
					}				
					
					if($recordcount > 0)
					{
						for($i=0;$i<$recordcount;$i++)
						{
							$prospectactivityid=$data_activity->ProspectActivities[$i]->Id;
							$Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_10;
							//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
							
							$customdata = 0;
							if($Custom_1==$event_name)
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
									"Value": ""
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
									"SchemaName": "mx_Custom_5",
									"Value": "'.$activityDate.'" 
								},
								{
									"SchemaName": "mx_Custom_6",
									"Value": "" 
								},	
								{
									"SchemaName": "mx_Custom_7",
									"Value": "'.$map.'" 
								},
								{
									"SchemaName": "mx_Custom_10",
									"Value": "'.$event_name.'"
								}								
								]}';								
								
								//print_r($data_string);
								
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
							print_r($data);
							$data2	= json_decode($json_response);	
							$st2 	= $data2->Status;
						}
						else{
							$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
							$data_string2='{
							"EmailAddress": "'.$email.'",
							"ActivityEvent": 192,
							"ActivityNote": "'.$event_name.'",				
							"Fields": [
								{
									"SchemaName": "mx_Custom_1",
									"Value": ""
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
									"SchemaName": "mx_Custom_5",
									"Value": "'.$activityDate.'" 
								},
								{
									"SchemaName": "mx_Custom_6",
									"Value": "" 
								},	
								{
									"SchemaName": "mx_Custom_7",
									"Value": "'.$map.'" 
								},
								{
									"SchemaName": "mx_Custom_10",
									"Value": "'.$event_name.'"
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
						}				
					}				
				}	
			
				$data=array('status' => 'true','message' => 'Mail sent successfully');
				echo $json_encode=json_encode($data);
		
	}
<?php
	/*
	$firstname="Rajeevevent";;
	$lastname="Mehta";
	$mobileNumber=$_REQUEST['mobile_number'];
	$email=$_REQUEST['emailaddress'];
	$service=$_REQUEST['service'];
	$interested_in=$_REQUEST['interested_in'];
	$current_page=$_REQUEST['current_page'];
	$ipAddress=$_REQUEST['ipAddress'];
	$choose_date=$_REQUEST['choose_date'];
	$choose_time=$_REQUEST['choose_time'];
	$choose_location=$_REQUEST['choose_location'];
	$location_address=$_REQUEST['location_address'];
	$onboardLink=$_REQUEST['onboardLink'];
	$ProspectID=$_REQUEST['ProspectID'];
	*/

	$firstname		= "RajeevJourney";;
	$lastname		= "Mehta";
	$mobileNumber	= "7428371531";
	$email			= "choprasit@gmail.com";
	$service		= "Global Education";
	//$interested_in= $_REQUEST['interested_in'];
	$current_page	= "Global Ed";
	$ipAddress		= "14.141.28.91";
	$choose_date	= "18-Dec-2019";
	$choose_time	= "12:00-13:00 PM";
	$choose_location= "Chandigarh";
	$location_address="SCO 117-118-119, Above Canara Bank Bldg, , Chandigarh,Chandigarh 160017";
	$onboardLink	= "http://tcglobal.wpengine.com/student-onboard";
	$ProspectID		= "09392576-1c2c-4abf-a3e5-377242e9f5b2";

	if(empty($choose_time)){
		$eventDate	 = $choose_date.' 00:00:00';
		
		$newdate 	= strtotime ( '-5 hour -30 minute' , strtotime ( $eventDate ) ) ;
		$activityDate= date('Y-m-d H:i:s',$newdate);		
	}
	else{
		$timeArray	= explode('-',$choose_time);
		$time_slot	= $timeArray[0]; 
		
		$eventDate 	=  date('Y-m-d H:i:s',strtotime($choose_date.' '.$time_slot));
		$newdate 	= strtotime ( '-5 hour -30 minute' , strtotime ( $eventDate ) ) ;
		$activityDate= date('Y-m-d H:i:s',$newdate);
	}

	if($firstname=='' || $lastname=='' || $mobileNumber=='' || $email=='' || $service=='' || $ProspectID=='')
	{
		$data=array('status' => 'false','message' => 'error');
		echo $json_encode=json_encode($data);

	}
	else
	{

		/*
		include_once 'config/database.php';

		$database = new Database();
		$db = $database->getConnection();


		$sql = "INSERT INTO test (fname, lname, mobile,email,service,interested_in,ipaddress,page,choose_date,choose_time,location,address,url,prospect)
		VALUES ('".$firstname."','".$lastname."','".$mobileNumber."','".$email."','".$service."','".$interested_in."','".$ipAddress."','".$current_page."','".$choose_date."','".$choose_time."','".$choose_location."','".$location_address."','".$onboardLink."','".$ProspectID."')";

		$stmt = $db->prepare( $sql );
		$stmt->execute();

		if($stmt)
		{

			$data=array('status' => 'true','message' => 'Mail sent successfully');
			echo $json_encode=json_encode($data);

		}
		*/
		
		
		include_once 'config/database.php';	//database connection 
		include_once 'objects/student.php';	//student file

		$database = new Database();
		$db_ccpl = $database->getConnection_CCPL();
		//$db_aws = $database->getConnection();

		$user = new User($db_ccpl);
		$data = $user->GetStudentID($email,$mobileNumber);

		//print_r($data);exit;
		$studentID	= $data[0];
		$datereg	= $data[1];
		$onboarddate= $data[2];
		$cityid		= $data[3];
		$city		= $data[4];
		
		//$studentID	= "";
		//$datereg	= "aaaaaa";
		//$onboarddate= "bbbbbb";
	
		if(empty($studentID))
		{
			$city="Other";
		}
		
		if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
		{		
			
			$name		= $firstname." ".$lastname;			
					
			$query1 = "INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,fname,lname) values ($studentID,'$name','$email',$mobileNumber,'$cityid',now(),'tcglobal','tcglobalnewsite','$current_page','Website','$firstname','$lastname')";
			//$res1 = pg_query($db_ccpl,$query1);
			$stmt1 = $db_ccpl->prepare($query1);
			$stmt1->execute();		
			
			//counselling record		
			$query2 = "Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values (current_date,$studentID,1,1058,17,null,'".$current_page.'||'.$firstname.'||'.$lastname.'||'.$email.'||'.$mobileNumber.'||'.$city.'||'.$service.'||'.$choose_date.'||'.$choose_time.'||'.$choose_location.'||'.$location_address.'||'.$onboardLink.'||'.$ipAddress.'||'.$ProspectID."||Website||tcglobalnewsite')";	
			//$res1 = pg_query($db_ccpl,$query2);
			$stmt2 = $db_ccpl->prepare($query2);
			$stmt2->execute();				
			
		}	
		
		$city	= "";
		$venue	= "";
		
		if(strtolower(trim($choose_location))== "ahmedabad"){
			$city	= "Ahmedabad";
			$branch = "Ahmedabad";
			$venue	= "The Chopras Office Ahmedabad";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Ahmedabad/@23.0411986,72.5233778,17z/data=!3m1!4b1!4m5!3m4!1s0x395e9b4ceaaaaaab:0xbfb1bfbeec5d90dc!8m2!3d23.0411986!4d72.5255665";
		}
		
		if(strtolower(trim($choose_location))== "bangalore"){
			$city	= "Bangalore";
			$branch = "Bangalore";
			$venue	= "The Chopras Office Bangalore";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Bangalore&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj_tavR5a_mAhWBoOkKHW5BBf0Q_AUoAXoECBAQAw";
		}
		
		if(strtolower(trim($choose_location))=="chandigarh"){
			$city	= "Chandigarh";
			$branch = "Chandigarh";
			$venue	= "The Chopras Office Chandigarh";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Chandigarh&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj2k9bs5a_mAhUfzDgGHeU6CG4Q_AUoAXoECBcQAw";
		}
		
		if(strtolower(trim($choose_location))== "chennai"){
			$city	= "Chennai";
			$branch = "Chennai";
			$venue	= "The Chopras Office Chennai";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Chennai/@13.0546247,80.2469559,17z/data=!3m1!4b1!4m5!3m4!1s0x110565cd1712fdff:0x6d4d36694932eedf!8m2!3d13.0546247!4d80.2491446";
		}
		
		if(strtolower(trim($choose_location))== "cochin"){
			$city	= "Cochin";
			$branch = "Cochin";
			$venue	= "The Chopras Office Cochin";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Cochin&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiZt6aQ5q_mAhXHzjgGHUrfBtcQ_AUoAXoECBEQAw";
		}
		
		if(strtolower(trim($choose_location))=="coimbatore"){
			$city	= "Coimbatore";
			$branch = "Coimbatore";
			$venue	= "The Chopras Office Coimbatore";
			//$dt		= "2019-11-06 11:00:00";
			//$dt1	= "2019-11-06";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Coimbatore/@11.008926,76.9777943,17z/data=!3m1!4b1!4m5!3m4!1s0x3ba859b1624a4797:0x3c9255ca0e7fcd3e!8m2!3d11.008926!4d76.979983";					
		}

		if(strtolower(trim($choose_location))=="dehradun"){
			$city	= "Dehradun";
			$branch = "Dehradun";
			$venue	= "The Chopras Office Dehradun";
			//$dt		= "2019-11-06 11:00:00";
			//$dt1	= "2019-11-06";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Dehradun&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiz8Oet56_mAhUKzjgGHRPbCpsQ_AUoAXoECBMQAw";					
		}			

		if(strtolower(trim($choose_location))== "hyderabad"){
			$city	= "Hyderabad";
			$branch = "Hyderabad";
			$venue	= "The Chopras Office Hyderabad";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Hyderabad&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjYm52356LmAhUZyzgGHWv3DNoQ_AUoAXoECBQQAw";
		}
		
		if(strtolower(trim($choose_location))=="jaipur"){
			$city	= "Jaipur";
			$branch = "Jaipur";
			$venue	= "The Chopras Office Jaipur";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Jaipur&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj4_YbN56LmAhUOzTgGHegwBUcQ_AUoAXoECBUQAw";
		}		
			
		if(strtolower(trim($choose_location))=="kolkata"){
			$city	= "Kolkata";
			$branch = "Kolkata";
			$venue	= "The Chopras Office Kolkata";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Kolkata/@22.5435347,88.3495704,17z/data=!3m1!4b1!4m5!3m4!1s0x3a0277170b6626c9:0xefffd6c7142169b0!8m2!3d22.5435298!4d88.3517591";
		}
		
		if(strtolower(trim($choose_location))=="lucknow"){
			$city	= "Lucknow";
			$branch = "Lucknow";
			$venue	= "The Chopras Office Lucknow";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Lucknow&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiBherJ6K_mAhXvzjgGHU0yDS4Q_AUoAXoECA8QAw";
			
		}
		
		if(strtolower(trim($choose_location))=="ludhiana"){
			$city	= "Ludhiana";
			$branch = "Ludhiana";
			$venue	= "The Chopras Office Ludhiana";
			//$dt	= "2019-11-09 11:00:00";
			//$dt1	= "2019-11-09";
			$cal	= "";
			$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Ludhiana&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiF8MDp6K_mAhWFxjgGHfSzC1IQ_AUoAXoECBQQAw";
		}
		
		if(strtolower(trim($choose_location))=="mangalore"){
			$city	= "Mangalore";
			$branch = "Mangalore";
			$venue	= "The Chopras Office Mangalore";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Mangalore&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwigz5aC6a_mAhW-wjgGHWsJD4EQ_AUoAXoECBEQAw";		
		}
		
		if(strtolower(trim($choose_location))== "ncr delhi"){
			$city	= "NCR Delhi ";
			$branch = "NCR Delhi ";
			$venue	= "The Chopras Office NCR Delhi ";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.549669,77.2479983,17z/data=!3m1!4b1!4m5!3m4!1s0x390d0372ba63dfa9:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
		}	

		if(strtolower(trim($choose_location))=="ncr north delhi"){
			$city	= "NCR North Delhi";
			$branch = "NCR North Delhi";
			$venue	= "The Chopras Office NCR North Delhi";
			//$dt	= "2019-11-04 11:00:00";
			//$dt1	= "2019-11-04";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+North+Delhi/@28.7064178,77.1875424,17z/data=!3m1!4b1!4m5!3m4!1s0x390cfdede66f6649:0x8833a1646b6bb001!8m2!3d28.7064178!4d77.1897311";
		}

		if(strtolower(trim($choose_location))=="ncr west delhi"){
			$city	= "NCR West Delhi";
			$branch = "NCR West Delhi";
			$venue	= "The Chopras Office NCR West Delhi";
			//$dt	= "2019-11-06 11:00:00";
			//$dt1	= "2019-11-06";
			$cal="";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+West+Delhi&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjR_JOu6KLmAhUMyzgGHTKnBSEQ_AUoAXoECBIQAw";
		}

		if(strtolower(trim($choose_location))=="ncr gurgaon"){
			$city	= "NCR Gurgaon";
			$branch = "NCR Gurgaon";
			$venue	= "The Chopras Office NCR Gurgaon";
			//$dt	= "2019-11-02 11:00:00";
			//$dt1	= "2019-11-02";
			$cal="";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Gurgaon&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjjnpCD6KLmAhXgzjgGHYnaBqYQ_AUoAXoECBQQAw";
		}	

		if(strtolower(trim($choose_location))=="mumbai andheri west"){
			$city	= "Mumbai Andheri West";
			$branch = "Mumbai Andheri West";
			$venue	= "The Chopras Office Mumbai Andheri West";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-10";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Mumbai+Andheri/@19.0251709,72.6954227,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3be7c9d10da487eb:0xa286e353edfbcf92!8m2!3d19.1195122!4d72.843956";
		}

		if(strtolower(trim($choose_location))== "mumbai churchgate"){
			$city	= "Mumbai Churchgate ";
			$branch = "Mumbai Churchgate ";
			$venue	= "The Chopras Office Mumbai Churchgate ";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Churchgate+Mumbai/@19.0257146,72.6954218,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3a27af00c0062751:0xda859746bb6f080d!8m2!3d18.930286!4d72.827068";
		}		
		
		if(strtolower(trim($choose_location))=="pune"){
			$city	= "Pune";
			$branch = "Pune";
			$venue	= "The Chopras Office Pune";
			//$dt	= "2019-11-10 11:00:00";
			//$dt1	= "2019-11-02";
			$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+Pune/@18.5201404,73.8435366,17z/data=!3m1!4b1!4m5!3m4!1s0x3bc2bf87f9a71785:0x16017dfcca2a8a64!8m2!3d18.5201353!4d73.8457253";
		}
		
		if(strtolower(trim($choose_location))=="trivandrum"){
			$city	= "Trivandrum";
			$branch = "Trivandrum";
			$venue	= "The Chopras Office Trivandrum";
			//$dt	= "2019-11-04 11:00:00";
			//$dt1	= "2019-11-04";
			$cal	= "";
			$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Trivandrum&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiNpI7B6a_mAhW9yjgGHdUuBA4Q_AUoAXoECBAQAw";
		}		

		if(strtolower(trim($choose_location))=="vijayawada"){
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
				{"Attribute":"FirstName", "Value": "'.$firstname.'"},
				{"Attribute":"LastName", "Value": "'.$lastname.'"},
				{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
				{"Attribute":"EmailAddress", "Value": "'.$email.'"},				
				{"Attribute":"mx_Service_or_Product", "Value": "'.$service.'"},
				{"Attribute":"mx_City", "Value": "'.$choose_location.'"},					
				{"Attribute":"mx_Street1", "Value": "'.$location_address.'"},				
				{"Attribute":"Source","Value": "Website"},							
				{"Attribute":"mx_choprasleadsource","Value": "tcglobalnewsite"},
				{"Attribute":"SourceMedium", "Value": "'.$current_page.'"},
				{"Attribute":"mx_Nearest_Branch", "Value": "'.$choose_location.'"},				
				{"Attribute":"mx_Event_Date", "Value": "'.$eventDate.'"},
				{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
				{"Attribute":"mx_Events_Venue_Map","Value": "'.$map.'"}			
				]';
				echo "<pre>";
				print_r($data_string);
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
				
				$data	 			= json_decode($json_response);
				print_r($data);
				//die;
				$relatedid			= $data->Message->RelatedId;	//data related id
				$ExceptionMessage 	= $data->ExceptionMessage;	//lead error message
							
				if($ExceptionMessage == 'A Lead with same Phone Number already exists.')
				{
					//retrive leadid by phone
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&phone='.$mobileNumber,
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
							echo "<pre>";
							print_r($data_lead);
						//	exit;
						$relatedid = $data_lead[0]->ProspectID;					
						$email = $data_lead[0]->EmailAddress;					
						
						$url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
						$data_string = '[
							{"Attribute":"SearchBy", "Value": "EmailAddress"},
							{"Attribute":"FirstName", "Value": "'.$firstname.'"},
							{"Attribute":"LastName", "Value": "'.$lastname.'"},
							{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
							{"Attribute":"EmailAddress", "Value": "'.$email.'"},				
							{"Attribute":"mx_Service_or_Product", "Value": "'.$service.'"},
							{"Attribute":"mx_City", "Value": "'.$choose_location.'"},					
							{"Attribute":"mx_Street1", "Value": "'.$location_address.'"},				
							{"Attribute":"Source","Value": "Website"},							
							{"Attribute":"mx_choprasleadsource","Value": "tcglobalnewsite"},
							{"Attribute":"SourceMedium", "Value": "'.$current_page.'"},
							{"Attribute":"mx_Nearest_Branch", "Value": "'.$choose_location.'"},				
							{"Attribute":"mx_Event_Date", "Value": "'.$eventDate.'"},
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
						
							$data_get = json_decode($json_response);
							//print_r($data_get);
							//exit;	
					}
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
						"ActivityNote": "'.$event_name.'",				
						"Fields": [
							{
								"SchemaName": "mx_Custom_1",
								"Value": ""
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
								"SchemaName": "mx_Custom_5",
								"Value": "'.$activityDate.'" 
							},							
							{
								"SchemaName": "mx_Custom_6",
								"Value": "" 
							},	
							{
								"SchemaName": "mx_Custom_7",
								"Value": "'.$map.'" 
							},
							{
								"SchemaName": "mx_Custom_10",
								"Value": "'.$event_name.'"
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
						
						print_r($data2);
						//die;
					}				
					
					if($recordcount > 0)
					{
						for($i=0;$i<$recordcount;$i++)
						{
							$prospectactivityid=$data_activity->ProspectActivities[$i]->Id;
							$Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_10;
							//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
							
							$customdata = 0;
							if($Custom_1==$event_name)
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
									"Value": ""
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
									"SchemaName": "mx_Custom_5",
									"Value": "'.$activityDate.'" 
								},
								{
									"SchemaName": "mx_Custom_6",
									"Value": "" 
								},	
								{
									"SchemaName": "mx_Custom_7",
									"Value": "'.$map.'" 
								},
								{
									"SchemaName": "mx_Custom_10",
									"Value": "'.$event_name.'"
								}								
								]}';								
								
								//print_r($data_string);
								
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
							print_r($data);
							$data2	= json_decode($json_response);	
							$st2 	= $data2->Status;
						}
						else{
							$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
							$data_string2='{
							"EmailAddress": "'.$email.'",
							"ActivityEvent": 192,
							"ActivityNote": "'.$event_name.'",				
							"Fields": [
								{
									"SchemaName": "mx_Custom_1",
									"Value": ""
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
									"SchemaName": "mx_Custom_5",
									"Value": "'.$activityDate.'" 
								},
								{
									"SchemaName": "mx_Custom_6",
									"Value": "" 
								},	
								{
									"SchemaName": "mx_Custom_7",
									"Value": "'.$map.'" 
								},
								{
									"SchemaName": "mx_Custom_10",
									"Value": "'.$event_name.'"
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
						}				
					}				
				}	
			
				$data=array('status' => 'true','message' => 'Mail sent successfully');
				echo $json_encode=json_encode($data);
		
	}
