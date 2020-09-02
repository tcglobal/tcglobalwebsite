<?php
	
	$name		= $_REQUEST['name'];
	$email		= $_REQUEST['email'];
	$mobileNumber=$_REQUEST['mobileNumber'];
	$services	= $_REQUEST['service'];
	$message	= $_REQUEST['message'];
	$ipAddress	= $_REQUEST['ipAddress'];
	//$currentPage= $_REQUEST['currentPage'];
	$university	= $_REQUEST['university'];
	$ProspectID	= $_REQUEST['ProspectID'];	
	if(!empty($university)) {
		$page			= "exprepressïnterest";		
		$universitylist = implode(';', $university); 
	}
	
	//$universitylist ="Delhi University;Agra University";
	//$name="Rajeev Mehta ";
	
	$n	= explode(' ',$name,2);	
	$FirstName	= $n[0];
	$LastName	= $n[1];	
	
/*$name		= "Abhimanyu";
	$email		= "choprasit@gmail.com";
	//$mobileNumber="9811019534";
	$mobileNumber= "7428371531";	
	$services	= "Global Learning";
	$message	= "This is test";
	$ipAddress	= "14.141.28.91";
	$currentPage= "About-us";
	//$university	= "ARU";	
	$ProspectID	= "abc1be49-8ad6-419d-8f25-bca343c9b521";
	*/
		
	if($name=='' || $email=='' || $mobileNumber=='' || $services=='' || $message=='')
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
		$data = $user->GetStudentID($email,$mobileNumber);	//student id
		//print_r($data);exit;
		$studentID	= $data[0];
		$datereg	= $data[1];
		$onboarddate= $data[2];
		$cityid		= $data[3];
		$city		= $data[4];
		$pcounsel		= $data[5];
	
		if(empty($studentID))
		{
			$city="Others";
			$cityid=1848;
		}
		
		if($services=='Global Investments'){						
			$user	= new User($db_ccpl);
			$rowid	= $user->LeadExist($mobileNumber,$email);	//investment id						
			
			if(empty($rowid)){
				$query1	= "INSERT INTO investor_lead(fname,lname,mobile,email,leadentered,remarks,category,pcounsel) values ('$FirstName','$LastName','$mobileNumber','$email',now(),'tcglobalnewsite','tcglobalnewsite',4748) RETURNING id";
				$stmt1 = $db_ccpl->prepare($query1);
				$stmt1->execute();				
				$rows = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($rows as $row)
				{
					$rowid=$row['id'];
				}				
				
				$query2	= "INSERT INTO investor_webquery(leadid,fname,lname,email,phone,entereddate,remarks,category) values ($rowid,'$FirstName','$LastName','$email',$mobileNumber,now(),'$message','tcglobalnewsite')";				
				$stmt2 = $db_ccpl->prepare($query2);
				$stmt2->execute();					
			}
			else{
				
				$query1 = "Update investor_lead SET category='tcglobalnewsite' where id=$rowid";				
				$stmt1 = $db_ccpl->prepare($query1);
				$stmt1->execute();		
				
				$query2	= "INSERT INTO investor_webquery(leadid,fname,lname,email,phone,entereddate,remarks,category) values ($rowid,'$FirstName','$LastName','$email',$mobileNumber,now(),'$message','tcglobalnewsite')";				
				$stmt1 = $db_ccpl->prepare($query2);
				$stmt1->execute();	
			}
		}
		else if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
		{			
		$query = "INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,fname,lname) values($studentID,'$name','$email','$mobileNumber','$cityid',now(),'$message','tcglobalnewsite','','Website','$FirstName','$LastName')";	
			$stmt = $db_ccpl->prepare($query);
			$stmt->execute();							
	
			//counselling record
	$query2 = "Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values(current_date,$studentID,1,1058,17,null,'".$currentPage."||".$FirstName."||".$LastName."||".$email."||".$mobileNumber."||".$services."||".$message."||Website||tcglobalnewsite')";
			$stmt1 = $db_ccpl->prepare($query2);
			$stmt1->execute();	
			
			
			//callback
			
			$query3 ="Insert into callback (studid,empid,msg,callbackdate,enterby,entertime,source,webquery)values($studentID,$pcounsel,".((empty($message))?'Null':"'".addslashes($message)."'").",now(),1487,now(),'Webquery',true)";
			$stmt2 = $db_ccpl->prepare($query3);
			$stmt2->execute();
	
			////////////////interest services///////////////////
			$spldata	= "select * from interests where studid=$studentID and services is not null LIMIT 1";
			//$qry_spldata= pg_query($spldata);
			//$spl_num 	= pg_num_rows($qry_spldata);
			$stmt3 = $db_ccpl->prepare($spldata);
			$stmt3->execute();
			$spl_num = $stmt->rowCount();
			
			if($spl_num <=0){				
		$interests_details = "insert into interests (services,studid) values('$services',$studentID)";
				//$qry_interests_details = pg_query($interests_details);
				$stmt4 = $db_ccpl->prepare($interests_details);
				$stmt4->execute();				
			} else {
				$interests_details = "update interests SET services='$services' where studid=$studentID and services is not null";
				//$qry_interests_details = pg_query($interests_details);	
				$stmt5 = $db_ccpl->prepare($interests_details);
				$stmt5->execute();		
				///////////////////////////////////////////////////////////
			}
		}		
		
		if((empty($datereg) && empty($onboarddate)) || $services=='Global Investments')
		{	
	
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
			{"Attribute":"mx_Service_or_Product", "Value": "'.$services.'"},
			{"Attribute":"Source", "Value": "Website"},
			{"Attribute":"mx_choprasleadsource", "Value": "tcglobalnewsite"},
			{"Attribute":"SourceMedium", "Value": "'.$currentPage.'"},
			{"Attribute":"mx_University_Preference", "Value": "'.$universitylist.'"},
			{"Attribute":"Notes", "Value": "'.$message.'"},
			{"Attribute":"mx_City", "Value": "'.$city.'"}
			]';
			// 	{"Attribute":"SourceIPAddress", "Value": "'.$ipAddress.'"}, 
			//echo "<pre>";
			//print_r($data_string );exit;			
			
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
			//echo '<pre>';
			//print_r($data);
			$st = $data->Status;
			$ExceptionMessage = $data->ExceptionMessage;
			if($ExceptionMessage == 'A Lead with same Phone Number already exists.')
			{
				$data_string = '[
				{"Attribute":"SearchBy", "Value": "EmailAddress"},
				{"Attribute":"FirstName", "Value": "'.$FirstName.'"},
				{"Attribute":"LastName", "Value": "'.$LastName.'"},
				{"Attribute":"EmailAddress", "Value": "'.$email.'"},
				{"Attribute":"ProspectID","Value": "'.$ProspectID.'"},
				{"Attribute":"mx_Service_or_Product", "Value": "'.$services.'"},
				{"Attribute":"Source", "Value": "Website"},
				{"Attribute":"mx_choprasleadsource", "Value": "tcglobal"},
				{"Attribute":"SourceMedium", "Value": "'.$currentPage.'"},
				{"Attribute":"mx_University_Preference", "Value": "'.$universitylist.'"},
				{"Attribute":"Notes", "Value": "'.$message.'"},
				{"Attribute":"mx_City", "Value": "'.$city.'"}
				]';
				//{"Attribute":"SourceIPAddress", "Value": "'.$ipAddress.'"},
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
				//echo '<pre>';
				//print_r($data);	
				$st = $data->Status;
			}	
		
			if($st=='Success')
			{
				
				$status_relatedid=$data->Message->RelatedId;
					
					//$asource = $row_register['source'];
					$asource = 'Website';
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
		
					$data_source = json_decode($json_response);							
					$stfinal = $data_source->Status;
			}
		}
		
		$data=array('status' => 'true','message' => 'Mail sent successfully');
		echo $json_encode=json_encode($data);
		
	}
	?>

