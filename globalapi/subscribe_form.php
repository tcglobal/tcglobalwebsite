<?php
$name			= $_REQUEST['name'];
$email			= $_REQUEST['email'];
$mobileNumber	= $_REQUEST['mobileNumber'];
$ipAddress		= $_REQUEST['ipAddress'];
$choose_topic	= $_REQUEST['choos_topic'];
//$choose_topic=$_REQUEST['choos_topic'];
$ProspectID		= $_REQUEST['ProspectID'];
$currentPage	= 'insights';

/*
rajeevcontact@test.com
3232333333
$name="RiteshSubscribe";
$email="RiteshSubscribe@test.com";
$mobileNumber="2134243443";
$ipAddress="14.141.28.91";
$choose_topic="Leadership";
//$choose_topic=$_REQUEST['choos_topic'];
$ProspectID="3389c35f-01d8-4e98-8da9-e6ea07607a87";
$currentPage='insights';
*/

//$name="Riteshcntact Kumar ";
$n=explode(' ',$name,2);
$FirstName=$n[0];
$LastName=$n[1];

if($name=='' || $email=='' || $mobileNumber=='' || $ProspectID=='')
{
	$data=array('status' => 'false','message' => 'error');
	echo $json_encode=json_encode($data);
}
else
{

	include_once 'config/database.php';
	include_once 'objects/student.php';

	$database = new Database();
	$db_ccpl = $database->getConnection_CCPL();
	//$db_aws = $database->getConnection();

	$user = new User($db_ccpl);
	$data = $user->GetStudentID($email,$mobileNumber);
	//print_r($data);exit;
	$studentID=$data[0];
	$datereg=$data[1];
	$onboarddate=$data[2];
	$cityid=$data[3];
	$city=$data[4];
	$pcounsel= $data[5];

	if(empty($studentID))
	{
		$city="Others";
		$cityid=1848;

	}

	if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
	{	
		$sql="INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,fname,lname) values($studentID,'$name','$email','$mobileNumber','$cityid',now(),'tcglobal','tcglobalnewsite','$currentPage','Website','$FirstName','$LastName')";

		$stmt = $db_ccpl->prepare($sql);
		$stmt->execute();
		//counselling record
		$sql1="Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values(current_date,$studentID,1,1058,17,null,'Subscribe ||Firstname:".$FirstName."||Lastname:".$LastName."||Email:".$email."||Phone:".$mobileNumber."||city:".$city."||Choose topic:".$choose_topic."|Website||tcglobalnewsite')";

		$stmt1 = $db_ccpl->prepare($sql1);
		$stmt1->execute();
		
		
		//callback
		
		$query3 ="Insert into callback (studid,empid,msg,callbackdate,enterby,entertime,source,webquery)values($studentID,$pcounsel,'".$choose_topic."',now(),1487,now(),'Webquery',true)";
			$stmt3 = $db_ccpl->prepare($query3);
			$stmt3->execute();
		
		
	}
	else{	
			
		//echo "no studidd";exit;
		//echo $studid[0];exit;
		$accessKey = 'u$r9ea451df6581fe0d18b1176a1f6c791f';
		$secretKey = '013726bf5dfbc0c67f68a77d081b0f5941bc6ed4';	
	
		$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
		$data_string = '[
		{"Attribute":"SearchBy", "Value": "EmailAddress"},
		{"Attribute":"FirstName", "Value": "'.$FirstName.'"},
		{"Attribute":"LastName", "Value": "'.$LastName.'"},
		{"Attribute":"EmailAddress", "Value": "'.$email.'"},
		{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},		
		{"Attribute":"ProspectID","Value": "'.$ProspectID.'"},
		{"Attribute":"Source", "Value": "Website"},
		{"Attribute":"mx_choprasleadsource", "Value": "tcglobalnewsite"},
		{"Attribute":"SourceMedium", "Value": "'.$currentPage.'"},		
		{"Attribute":"mx_Insights_Topic_Subscribed", "Value": "'.$choose_topic.'"},
		{"Attribute":"mx_City", "Value": "'.$city.'"}
		]';
		//{"Attribute":"SourceIPAddress", "Value": "'.$ipAddress.'"}, print_r($data_string );exit;
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
		$data = json_decode($json_response);		
		//print_r($data);
		$st = $data->Status;
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
				$leademail = $data_lead[0]->EmailAddress;					
				
				$url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
				$data_string = '[
					{"Attribute":"SearchBy", "Value": "EmailAddress"},
					{"Attribute":"FirstName", "Value": "'.$FirstName.'"},
					{"Attribute":"LastName", "Value": "'.$LastName.'"},
					{"Attribute":"EmailAddress", "Value": "'.$email.'"},
					{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},		
					{"Attribute":"ProspectID","Value": "'.$ProspectID.'"},
					{"Attribute":"Source", "Value": "Website"},
					{"Attribute":"mx_choprasleadsource", "Value": "tcglobalnewsite"},
					{"Attribute":"SourceMedium", "Value": "'.$currentPage.'"},		
					{"Attribute":"mx_Insights_Topic_Subscribed", "Value": "'.$choose_topic.'"},
					{"Attribute":"mx_City", "Value": "'.$city.'"}
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
				//echo '<pre>';
				//print_r($data_get);
				//exit;	
			}
		}
	
	}		
			
	$data=array('status' => 'true','message' => 'Mail sent successfully');
	echo $json_encode=json_encode($data);
}
