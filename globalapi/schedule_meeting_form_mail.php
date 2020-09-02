<?php

$emailaddress=$_REQUEST['email'];
$lead_id=$_REQUEST['lead_id'];

$choose_location=$_REQUEST['location'];
$location_address=$_REQUEST['address'];
$choose_date=$_REQUEST['date'];
	$choose_time=$_REQUEST['time'];
	$time=explode('-',$choose_time,2);
	$scheduletime=$time[0];	
	
	$choose_date 	=  date('Y-m-d H:i:s',strtotime($choose_date.' '.$scheduletime));
	$newdate 	= strtotime ( '-5 hour -30 minute' , strtotime ( $choose_date ) ) ;
	$branch_visit_schedule_date= date('Y-m-d H:i:s',$newdate);
	
		$callback=$_REQUEST['callback'];
		if($callback==true)
	{
	$callback="Yes";
	
	}
	else {
	$callback="No";
	}
/*
$emailaddress="ritesh@test.com";
$lead_id='24';
$choose_date="20-Dec-2019";
$choose_time="11:00-12:00 PM";
$choose_location="NCR North Delhi";
$location_address="F-14/6, 3rd floor, Model Town, ,New Delhi,New Delhi - 110009";
*/
//if(empty($ProspectID)) { $ProspectID="Null";} 
if($lead_id=='' || $choose_date=='' || $choose_time=='' || $emailaddress=='')
{
$data=array('status' => 'false','message' => 'error');
echo $json_encode=json_encode($data);

}
else
{

	if($emailaddress!="")
		{
		
		//	$id=$_GET['pid'];
		$accessKey = 'u$r9ea451df6581fe0d18b1176a1f6c791f';
		$secretKey = '013726bf5dfbc0c67f68a77d081b0f5941bc6ed4';	


	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=' . $accessKey . '&secretKey=' . $secretKey .'&emailaddress='.$emailaddress; 
			//$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=' . $accessKey . '&secretKey=' . $secretKey .'&emailaddress=utkarshpawar914@gmail.com'; 	
			try
			{
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HEADER, 0);
			//	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
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
			//echo "<pre>";
			//print_r($data);exit;
			//echo $data[0]->Phone;
			$mobile=split("-",$data[0]->Phone);
	        $FirstName=$data[0]->FirstName;
			$LastName=$data[0]->LastName;
			$mobileNumber = $mobile[1];
			$services	= $data[0]->mx_Service_or_Product;
			$name=$FirstName.' '.$LastName;
		    //$mobile[1];
			//$st = $data->Status;			
			//if($st=='Su')
}



include_once 'config/database.php';
include_once 'objects/student.php';


if(strtolower(trim($choose_location))== "ahmedabad"){
		$city	= "Ahmedabad";
		$branch = "23918"; ;
		$venue	= "The Chopras Office Ahmedabad";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Ahmedabad/@23.0411986,72.5233778,17z/data=!3m1!4b1!4m5!3m4!1s0x395e9b4ceaaaaaab:0xbfb1bfbeec5d90dc!8m2!3d23.0411986!4d72.5255665";
	}
	
	if(strtolower(trim($choose_location))== "bangalore"){
		$city	= "Bangalore";
		$branch = "9327";
		$venue	= "The Chopras Office Bangalore";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Bangalore&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj_tavR5a_mAhWBoOkKHW5BBf0Q_AUoAXoECBAQAw";
	}
	
	if(strtolower(trim($choose_location))=="chandigarh"){
		$city	= "Chandigarh";
		$branch = "10179";
		$venue	= "The Chopras Office Chandigarh";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Chandigarh&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj2k9bs5a_mAhUfzDgGHeU6CG4Q_AUoAXoECBcQAw";
	}
	
	if(strtolower(trim($choose_location))== "chennai"){
		$city	= "Chennai";
		$branch = "10170";
		$venue	= "The Chopras Office Chennai";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Chennai/@13.0546247,80.2469559,17z/data=!3m1!4b1!4m5!3m4!1s0x110565cd1712fdff:0x6d4d36694932eedf!8m2!3d13.0546247!4d80.2491446";
	}
	
	if(strtolower(trim($choose_location))== "cochin"){
		$city	= "Cochin";
		$branch = "12531";
		$venue	= "The Chopras Office Cochin";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Cochin&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiZt6aQ5q_mAhXHzjgGHUrfBtcQ_AUoAXoECBEQAw";
	}
	
	if(strtolower(trim($choose_location))=="coimbatore"){
		$city	= "Coimbatore";
		$branch = "28298";
		$venue	= "The Chopras Office Coimbatore";
		$dt		= "2019-11-06 11:00:00";
		$dt1	= "2019-11-06";
		$cal	= "";
		$map	= "";			
		$map	= "https://www.google.com/maps/place/The+Chopras+Coimbatore/@11.008926,76.9777943,17z/data=!3m1!4b1!4m5!3m4!1s0x3ba859b1624a4797:0x3c9255ca0e7fcd3e!8m2!3d11.008926!4d76.979983";
	}

	if(strtolower(trim($choose_location))=="dehradun"){
		$city	= "Dehradun";
		$branch = "203699";
		$venue	= "The Chopras Office Dehradun";
		//$dt		= "2019-11-06 11:00:00";
		//$dt1	= "2019-11-06";
		$cal	= "";
		$map	= "";			
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Dehradun&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiz8Oet56_mAhUKzjgGHRPbCpsQ_AUoAXoECBMQAw";	
	}			

	if(strtolower(trim($choose_location))== "hyderabad"){
		$city	= "Hyderabad";
		$branch = "9329";
		$venue	= "The Chopras Office Hyderabad";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Hyderabad&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjYm52356LmAhUZyzgGHWv3DNoQ_AUoAXoECBQQAw";
	}
	
	if(strtolower(trim($choose_location))=="jaipur"){
		$city	= "Jaipur";
		$branch = "50161";
		$venue	= "The Chopras Office Jaipur";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Jaipur&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj4_YbN56LmAhUOzTgGHegwBUcQ_AUoAXoECBUQAw";
	}		
		
	if(strtolower(trim($choose_location))=="kolkata"){
		$city	= "Kolkata";
		$branch = "9328";
		$venue	= "The Chopras Office Kolkata";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Kolkata/@22.5435347,88.3495704,17z/data=!3m1!4b1!4m5!3m4!1s0x3a0277170b6626c9:0xefffd6c7142169b0!8m2!3d22.5435298!4d88.3517591";
	}
	
	if(strtolower(trim($choose_location))=="lucknow"){
		$city	= "Lucknow";
		$branch = "38782";
		$venue	= "The Chopras Office Lucknow";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Lucknow&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiBherJ6K_mAhXvzjgGHU0yDS4Q_AUoAXoECA8QAw";
	}
	
	if(strtolower(trim($choose_location))=="ludhiana"){
		$city	= "Ludhiana";
		$branch = "9989";
		$venue	= "The Chopras Office Ludhiana";
		//$dt	= "2019-11-09 11:00:00";
		//$dt1	= "2019-11-09";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Ludhiana&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiF8MDp6K_mAhWFxjgGHfSzC1IQ_AUoAXoECBQQAw";
	}
	
	if(strtolower(trim($choose_location))=="mangalore"){
		$city	= "Mangalore";
		$branch = "38798";
		$venue	= "The Chopras Office Mangalore";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		
		$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Mangalore&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwigz5aC6a_mAhW-wjgGHWsJD4EQ_AUoAXoECBEQAw";
	}
	
	if(strtolower(trim($choose_location))== "ncr delhi"){
		$city	= "NCR Delhi ";
		$branch = "947";
		$venue	= "The Chopras Office NCR Delhi ";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.549669,77.2479983,17z/data=!3m1!4b1!4m5!3m4!1s0x390d0372ba63dfa9:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
	}	

	if(strtolower(trim($choose_location))=="ncr north delhi"){
		$city	= "NCR North Delhi";
		$branch = "38971";
		$venue	= "The Chopras Office NCR North Delhi";
		//$dt	= "2019-11-04 11:00:00";
		//$dt1	= "2019-11-04";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+North+Delhi/@28.7064178,77.1875424,17z/data=!3m1!4b1!4m5!3m4!1s0x390cfdede66f6649:0x8833a1646b6bb001!8m2!3d28.7064178!4d77.1897311";
	}

	if(strtolower(trim($nearest_center))=="ncr west delhi"){
		$city	= "NCR West Delhi";
		$branch = "39210";
		$venue	= "The Chopras Office NCR West Delhi";
		//$dt	= "2019-11-06 11:00:00";
		//$dt1	= "2019-11-06";
		$cal="";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+West+Delhi&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjR_JOu6KLmAhUMyzgGHTKnBSEQ_AUoAXoECBIQAw";
	}

	if(strtolower(trim($choose_location))=="ncr gurgaon"){
		$city	= "NCR Gurgaon";
		$branch = "17006";
		$venue	= "The Chopras Office NCR Gurgaon";
		//$dt	= "2019-11-02 11:00:00";
		//$dt1	= "2019-11-02";
		$cal="";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Gurgaon&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjjnpCD6KLmAhXgzjgGHYnaBqYQ_AUoAXoECBQQAw";
	}	

	if(strtolower(trim($choose_location))=="mumbai andheri"){
		$city	= "Mumbai Andheri West";
		$branch = "38764";
		$venue	= "The Chopras Office Mumbai Andheri West";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Mumbai+Andheri/@19.0251709,72.6954227,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3be7c9d10da487eb:0xa286e353edfbcf92!8m2!3d19.1195122!4d72.843956";
	}

	if(strtolower(trim($choose_location))== "mumbai churchgate"){
		$city	= "Mumbai Churchgate ";
		$branch = "5669";
		$venue	= "The Chopras Office Mumbai Churchgate ";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Churchgate+Mumbai/@19.0257146,72.6954218,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3a27af00c0062751:0xda859746bb6f080d!8m2!3d18.930286!4d72.827068";
	}		
	
	if(strtolower(trim($choose_location))=="pune"){
		$city	= "Pune";
		$branch = "22690";
		$venue	= "The Chopras Office Pune";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Pune/@18.5201404,73.8435366,17z/data=!3m1!4b1!4m5!3m4!1s0x3bc2bf87f9a71785:0x16017dfcca2a8a64!8m2!3d18.5201353!4d73.8457253";
	}
	
	if(strtolower(trim($choose_location))=="trivandrum"){
		$city	= "Trivandrum";
		$branch = "23011";
		$venue	= "The Chopras Office Trivandrum";
		//$dt	= "2019-11-04 11:00:00";
		//$dt1	= "2019-11-04";
		$cal	= "";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Trivandrum&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiNpI7B6a_mAhW9yjgGHdUuBA4Q_AUoAXoECBAQAw";
	}		

	if(strtolower(trim($choose_location))=="vijayawada"){
		$city	= "Vijayawada";
		$branch = "39283";
		$venue	= "The Chopras Office Vijayawada";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
	$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Vijayawada&um=1&ie=UTF-8&sa=X&ved=2ahUKEwje_be_6aLmAhWvxTgGHXQ4AEcQ_AUoAXoECA8QAw";
	}



		$database = new Database();
		$db_ccpl = $database->getConnection_CCPL();
		//$db_aws = $database->getConnection();
		
		$user = new User($db_ccpl);
		$data = $user->GetStudentID($emailaddress,$mobileNumber);
		//print_r($data);exit;
		$studentID=$data[0];
		$datereg=$data[1];
		$onboarddate=$data[2];
		$cityid=$data[3];
		$city=$data[4];
		if(empty($studentID))
		{
			$city="Others";
			$cityid=1848;
		}
		if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
		{		
			//"Branch Visit Scheduled =177"
			$sql="INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,fname,lname) values($studentID,'$name','$emailaddress',$mobileNumber,'$cityid',now(),'tcglobal','tcglobalnewsite','$currentPage','Website','$FirstName','$LastName')";
			$stmt = $db_ccpl->prepare($sql);			 
			$stmt->execute();
			
			//counselling record
			$sql1="Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values(current_date,$studentID
			,1,1058,17,null,'Schedule Meeting by Mail||Firstname:".$firstname."||Lastname:".$lastname."||Email:".$emailaddress."||Phone:".$mobileNumber."||City:".$city."|Website||tcglobalnewsite||Branch Visit Schedule:".$branch_visit_schedule_date."')";			
			$stmt1 = $db_ccpl->prepare($sql1);
			$stmt1->execute();
			
			////////////////interest services///////////////////
			$spldata= "select * from interests where studid=$studentID and services is not null LIMIT 1";
			$stmt1 = $db_ccpl->prepare($spldata);
			$stmt1->execute();
			$numRows = $stmt1->rowCount();
			if($numRows <=0){					
			$interests_details = "insert into interests (services,studid) values('$services',$studentID)";
			$stmt1 = $db_ccpl->prepare($interests_details);
			$stmt1->execute();
			} else {
			$interests_details = "update interests SET services='$services' where studid=$studentID and services is not null";
			$stmt1 = $db_ccpl->prepare($interests_details);
			$stmt1->execute();					
				///////////////////////////////////////////////////////////
			}			
		} else {	
		$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
			$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';
			$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;	
			$data_string = '[
					{"Attribute":"SearchBy", "Value": "EmailAddress"},
					{"Attribute":"FirstName", "Value": "'.$firstname.'"},
					{"Attribute":"LastName", "Value": "'.$lastname.'"},
					{"Attribute":"EmailAddress", "Value": "'.$emailaddress.'"},
					{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
					{"Attribute":"mx_Nearest_Branch", "Value": "'.$choose_location.'"},		
					{"Attribute":"mx_Branch_visit_schedule", "Value": "'.$choose_date.'"},						
					{"Attribute":"Source", "Value": "Website"},
					{"Attribute":"mx_choprasleadsource", "Value": "tcglobalnewsite"},								
					{"Attribute":"mx_Branch_Address_Google_Map","Value": "'.$map.'"},	
				{"Attribute":"mx_Call_Back_requested_by_the_student","Value": "'.$callback.'"}			
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
				//	die;
					$st		= $data->Status;
					$leadid		= $data->Message->Id;
					$relatedid	= $data->Message->RelatedId;			
					
					$ExceptionMessage = $data->ExceptionMessage;
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
							//	echo "<pre>";
							//	print_r($data_lead);
							//	exit;
							$relatedid = $data_lead[0]->ProspectID;					
							//$email = $data_lead[0]->EmailAddress;					
							
							$url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
							$data_string = '[					
								{"Attribute":"SearchBy", "Value": "EmailAddress"},
								{"Attribute":"FirstName", "Value": "'.$firstname.'"},
								{"Attribute":"LastName", "Value": "'.$lastname.'"},
								{"Attribute":"EmailAddress", "Value": "'.$emailaddress.'"},
								{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
								{"Attribute":"mx_Nearest_Branch", "Value": "'.$choose_location.'"},												
								{"Attribute":"mx_Branch_visit_schedule", "Value": "'.$choose_date.'"},									
								{"Attribute":"Source", "Value": "Website"},
								{"Attribute":"mx_choprasleadsource", "Value": "tcglobalnewsite"},										
								{"Attribute":"mx_Branch_Address_Google_Map","Value": "'.$map.'"},	
								{"Attribute":"mx_Call_Back_requested_by_the_student","Value": "'.$callback.'"}
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
							
					} else {
						$st = $data->Status;			
						$Status_st = $data->Status;
						$leadid=$data->Message->Id;
						$relatedid=$data->Message->RelatedId;
						$status_relatedid=$data->Message->RelatedId;
					}
						
						
					if($relatedid != '') {
						$url_activity = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
						$data_string = '{"Parameter":{"ActivityEvent":177}}';
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
							"EmailAddress": "'.$emailaddress.'",
							"ActivityEvent": 177,
							"Fields": [
								{
									"SchemaName": "mx_Custom_1",
									"Value": "'.$choose_location.'"
								},						
								{
									"SchemaName": "mx_Custom_2",
									"Value": "'.$branch_visit_schedule_date.'"
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
								$Custom_2 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_2;
								//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
								
								$customdata = 0;
								if($Custom_1==$choose_location and $branch_visit_schedule_date)
								{
									$customdata++;							
								}
							}	
								
							if($customdata>0)
							{
								$data_string = '{
								"ProspectActivityId":"'.$prospectactivityid.'",
								"ActivityEvent":177,
								"Fields":[								
									{
										"SchemaName": "mx_Custom_1",
										"Value":  "'.$choose_location.'"
									},						
									{
										"SchemaName": "mx_Custom_2",
										"Value": "'.$branch_visit_schedule_date.'" 
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
								//print_r($data);
								$data2	= json_decode($json_response);	
								$st2 	= $data2->Status;
							}
						else{
								$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
								$data_string2='{
								"EmailAddress": "'.$emailaddress.'",
								"ActivityEvent": 177,
									
								"Fields": [
									{
										"SchemaName": "mx_Custom_1",
										"Value":  "'.$choose_location.'"
									},						
									{
										"SchemaName": "mx_Custom_2",
										"Value": "'.$branch_visit_schedule_date.'" 
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
					//end of if	
	
		}
		$data=array('status' => 'true','message' => 'Mail sent successfully');
		echo $json_encode=json_encode($data);
}
?>
