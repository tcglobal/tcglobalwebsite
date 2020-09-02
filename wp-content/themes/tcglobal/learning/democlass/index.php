<?php	

die('rajeev');	
	include('configuration.php');		
	
	//if url have student registration id
	$id 		= $_GET['id'];			//student registration id
	$source 	= $_GET['source'];		//source	
				
	if($id != '')
	{
		$stud_reg_data 		= "select * from gei_registration where id=".$id;
		$qry_stud_reg_data 	= pg_query(fnconnect_aws(),$stud_reg_data);
		$num_stud_reg_data 	= pg_num_rows($qry_stud_reg_data);
		
		if($num_stud_reg_data > 0)
		{			
			$readonly 	= 'readonly';
			$readonly1 	= 'class=readonly';
			$readonly2 	= 'disabled=true';	
			
			$res_stud_reg_data 	= pg_fetch_array($qry_stud_reg_data);
			
			$fname 				= $res_stud_reg_data['first_name'];
			$lname 				= $res_stud_reg_data['last_name'];
			$email 				= $res_stud_reg_data['email'];
			$mobile				= $res_stud_reg_data['mobile'];
			$level_of_study 	= $res_stud_reg_data['level_of_study'];
			$area_of_study_id 	= $res_stud_reg_data['area_of_study_id'];
			$time_slot 			= $res_stud_reg_data['time_slot'];				
			$peventid		 	= $res_stud_reg_data['eventid'];
			$event_venue_id 	= $res_stud_reg_data['event_venue_id'];
			$reg_source		 	= $res_stud_reg_data['attend_open_session'];
			$ccpl_student_id 	= $res_stud_reg_data['ccpl_student_id'];
			$country_preference	= $res_stud_reg_data['country_preference'];
			$exp_country_preference = explode(";",$country_preference);	
						
			$area_of_study_name 	= "select * from stream_specilization_new where parentid=0 and id='".$area_of_study_id."'";
			$qry_area_of_study_name = pg_query(fnconnect_aws(),$area_of_study_name);
			$res_area_of_study_name = pg_fetch_array($qry_area_of_study_name);			
			$area_name 				= $res_area_of_study_name['title'];					 
			
/*			
			$get_ven = "select distinct compmast.compid,venue,to_char(startdate,'dd Mon YYYY') as d,startdate as starttime,eventid 
			from event_master join compmast on compmast.compid=event_master.branchid where event_master.eventid = '".$peventid."' and event_master.branchid='".$event_venue_id."'";	
			$qry_get_ven = pg_query(fnconnect_aws(),$get_ven);
			$res_get_ven = pg_fetch_array($qry_get_ven);
	
			$ven = $res_get_ven['venue'];
*/			
		}
	}		
	
	//action for form submission
	if($_POST['btn_register']=='Register'){		
		//print_r($_POST);die;
		
		$firstname		= $_REQUEST['txt_fname'];
		$lastname		= $_REQUEST['txt_lname'];
		$mobileNumber	= $_REQUEST['txt_mobile'];
		$email			= $_REQUEST['txt_email'];		
		$level_of_study	= $_REQUEST['txt_level'];		
		$area_of_study	= $_REQUEST['txt_area'];		
		$country_arr	= $_POST['txt_country'];
		$country 		= implode(';',$country_arr);
		$admission_year	= $_REQUEST['txt_year'];		
		$ProspectID		= $_REQUEST['ProspectID'];
		$event	 		= $_POST['sel_event'];
		$time_slot		= $_REQUEST['txt_timeslot'];	
		
		//$attend_arr 	= $_POST['attend'];		
		//$attend 		= implode(';',$attend_arr);
		$attend_arr 	= '';
		$attend 		= '';		
		
		$optradio = $_POST['optradio'];		
		if($optradio == "Self Fast Track")
		{
			$rt = "Fast Track";
			$fl	= "Not Completed";
			$s1	= "";
			$optradio_mx = 'Self Fast Track';	
			
		}	
		else
		{
			$rt = $_POST['optradio'];
			$fl	= "Not Required";
			$s1	= "Not Required";
			$optradio_mx = 'Meet RM';
		}

		if($_GET['source'] == '')
		{
			$source 		= 'Website';
			$sourcemedium 	= 'Website';
		}
		else
		{
			$source 		= $_GET['source'];
			$sourcemedium 	= $_GET['source'];
		}
			
		
		$cc	 		= $_POST['txt_city'];
		$c			= explode('*',$cc);
				
		$city		= $c[0];
		$branch		= $c[0];				
		$abhicompid	= $c[1];
		$branchid	= $c[1];
		$branchname	= $c[2];		
		
		/*** Start event details ********/
		if($event=='SUB052002')
		{
			$eventid		= 'SUB052002';
			$event_name		= 'VirtualITMay2020';
			$venue			= 'Online';
			$event_venue	= 'Online';
			$event_fair		= 'Virtual Ed Interaction: Computing & IT'; //it is also used in netcore activity
			$eventDate		= '19-05-2020';	
			$gei_date		= '2020-05-19 16:00:00';
			$strtime 		= strtotime($gei_date) - ( 330 * 60);
			$gei_date_ls 	= date("Y-m-d H:i:s", $strtime);
			// additional netcore activity variables
			$netcore_event_date='19th May 2020, Tuesday';
			$netcore_event_code='CIF2020_ST';
			$netcore_event_type='Virtual';
			$ccpl_fair_type		= 'VirtualComputerScienceandITMay2020';

		}

		if($event=='SUB052003')
		{
			$eventid		= 'SUB052003';
			$event_name		= 'VirtualManagementMay2020';
			$venue			= 'Online';
			$event_venue	= 'Online';
			$event_fair		= 'Virtual Ed Interaction: Management and Business Studies'; //it is also used in netcore activity
			$eventDate		= '26-05-2020';	
			$gei_date		= '2020-05-26 16:00:00';
			$strtime 		= strtotime($gei_date) - ( 330 * 60);
			$gei_date_ls 	= date("Y-m-d H:i:s", $strtime);
			// additional netcore activity variables
			$netcore_event_date='26th May 2020, Tuesday';
			$netcore_event_code='MBF2020_ST';
			$netcore_event_type='Virtual';
			$ccpl_fair_type		= 'VirtualManagementandBusinessStudiesMay2020';
		}	

		if($event=='SUB052004')
		{
			$eventid		= 'SUB052004';
			$event_name		= 'VirtualSciencesJune2020';
			$venue			= 'Online';
			$event_venue	= 'Online';
			$event_fair		= 'Virtual Ed Interaction: Sciences'; //it is also used in netcore activity
			$eventDate		= '02-06-2020';	
			$gei_date		= '2020-06-02 16:00:00';
			$strtime 		= strtotime($gei_date) - ( 330 * 60);
			$gei_date_ls 	= date("Y-m-d H:i:s", $strtime);
			//  additional netcore activity variables TODO
			$netcore_event_date='2nd June 2020, Tuesday';
			$netcore_event_code='HUS2020_ST';
			$netcore_event_type='Virtual';
			$ccpl_fair_type		= 'VirtualScienceJune2020';
		}		
		

		if($event=='SUB062001')
		{
			$eventid		= 'SUB062001';
			$event_name		= 'VirtualHumanitiesJune2020';
			$venue			= 'Online';
			$event_venue	= 'Online';
			$event_fair		= 'Virtual Ed Interaction: Humanities And Social Sciences'; //it is also used in netcore activity
			$eventDate		= '12-06-2020';	
			$gei_date		= '2020-06-12 16:00:00';
			$strtime 		= strtotime($gei_date) - ( 330 * 60);
			$gei_date_ls 	= date("Y-m-d H:i:s", $strtime);
			//  additional netcore activity variables TODO
			$netcore_event_date='12th June 2020, Friday';
			$netcore_event_code='HSF2020_ST';
			$netcore_event_type='Virtual';
			$ccpl_fair_type		= 'HumanitiesandSocialSciencesVirualEdInteraction-June-2020';
		}
		$todatetime = date('Y-m-d H:i:s');	
		
		//if student is shortlisted by RM
		$query_register		= "select * from gei_registration where email ilike '".trim($email)."' and  eventid='$eventid' ";
		$result_register 	= pg_query(fnconnect_aws(),$query_register);
		$numRows_register	= pg_num_rows($result_register);
		$row_register 		= pg_fetch_array($result_register);			
		
		$id					= $row_register['id'];						
		$reg_source		 	= $row_register['attend_open_session'];
		$ccpl_student_id 	= $row_register['ccpl_student_id'];
		$asource 			= $row_register['source'];
		$stdlevel			= $row_register['level_of_study'];
		
		if($reg_source=='RM Shortlisted'){
			if(!empty($ccpl_student_id)){		
				$ccplstudid = encrypt_url($ccpl_student_id);				//encrypt student id
				@header("location:EmailFastTrack.php?sid=".$ccplstudid."&eventid=".$eventid."&type=".$ccpl_fair_type);	//redirect the page for student action
				exit;	
			}
		}		
		
		//find the student details in CCPL
		$data = GetStudentID($email,$mobileNumber);		
		//print_r($data);exit;
		$studentID	= $data[0];
		$datereg	= $data[1];
		$onboarddate= $data[2];
		$cityid		= $data[3];
		$city_ccpl	= $data[4];
		$pcounsel	= $data[5];
		
		if(empty($studentID))
		{
			$city_ccpl="Other";
		}
		
	
		if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
		{			
			$name		= $firstname." ".$lastname;
			$currentPage= $event_name.'-Registration';			
					
			$query1 = "INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,fname,lname) values ($studentID,'$name','$email',$mobileNumber,'$cityid',now(),'".$event_name."','".$event_name."','".$currentPage."','Website','$firstname','$lastname')";
			$res1 = pg_query(fnconnect_ccpl(),$query1);
			
			//counselling record		
			$query2 = "Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values (current_date,$studentID,1,1058,17,null,'".$currentPage.'||'.$firstname.'||'.$lastname.'||'.$email.'||'.$mobileNumber.'||'.$city_ccpl.'||'.$level_of_study.'||'.$area_of_study.'||'.$country_preference.'||'.$admission_year.'||'.$time_slot.'||'.$event_name."||Website||".$currentPage."')";	
			$res2 = pg_query(fnconnect_ccpl(),$query2);
			
			//callback		
			$query3 ="Insert into callback (studid,empid,msg,callbackdate,enterby,entertime,source,webquery)values($studentID,$pcounsel,'".$currentPage.'||'.$level_of_study.'||'.$area_of_study.'||'.$country.'||'.$admission_year."',now(),1487,now(),'Webquery',true)";
			$res3 = pg_query(fnconnect_ccpl(),$query3);
						
			$q1	= "SELECT * FROM public.stream_specilization_new where parentid='0' and title ilike '".$area_of_study."'";
			$result1= pg_query(fnconnect_aws(),$q1);
			$row1	= pg_fetch_array($result1);	
			
			//if student is not registered
			if($numRows_register == 0){
				
				$query="INSERT INTO public.gei_registration(
				first_name, last_name, email, mobile, level_of_study, area_of_study_id, country_preference, admission_year, event_venue_id, time_slot, attend_open_session, registration_type,fast_track_status,source,eventid,note,registration_status,ccpl_student_id,inhousefair)
				VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$mobileNumber."', '".$level_of_study."', ".$row1['id'].", '".$country."', ".$admission_year.", ".$abhicompid.", '".$_POST['txt_timeslot']."', '".$attend."', '".$rt."', 'Self Fast Track','".$source."','".$eventid."','".$event_name."','Yes',$studentID,'true') RETURNING id;";
				$res	= pg_query(fnconnect_aws(),$query);
				$new_id = pg_fetch_array($res);
				$id			= $new_id['id'];
				$stdlevel	= $new_id['level_of_study'];		
			}	
			
			
			//check fasttrack completed or not		
			$query_test		= "select * from fast_track_university where student_id='".$id."'"; 
			$result_test 	= pg_query(fnconnect_aws(),$query_test);
			$numRows_test	= pg_num_rows($result_test);
			//echo $row_register['fast_track_status'];
			
			if($numRows_test>0){
				@header("location:fast-track/fasttrackthanks/fasttrack_thanks.php");
			}
			else{			
				//random number
				$random_string = check_random();	
				
				$track_url='https://events.tcglobal.com/'.$foldername.'/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($id);
				
				$query_url="INSERT INTO public.url_shortner(uid, destination, gid) VALUES ('".$random_string."', '".$track_url."','".$id."');";
				pg_query(fnconnect_aws(),$query_url);
				
				include("registeredemail.php");
				
				//netcore activity
				include("event_automation_self_start.php");				
				
				$_SESSION['gei_registration_id']	= $id;
				$_SESSION['los']					= $stdlevel;
				@header("location:fasttrackthankyou.php");
			}			
		}
		else{			
			
			if($branchname=='Ahmedabad')
			{
				//$city	= "Ahmedabad";
				$branch = "Ahmedabad";
				
			}
			
			if($branchname=='Bangalore')
			{	
				//$city	= "Bangalore";
				$branch = "Bangalore";
				
			}
			
			if($branchname=='Chandigarh')
			{	
				//$city	= "Chandigarh";
				$branch = "Chandigarh";
				
			}
			
			if($branchname=='Chennai')
			{
				//$city	= "Chennai";
				$branch = "Chennai";
				
			}
			
			if($branchname=='Cochin')
			{						
				//$city	= "Cochin";
				$branch = "Cochin";
				
			}
			
			if($branchname=='Coimbatore')
			{
				//$city	= "Coimbatore";
				$branch = "Coimbatore";
				
			}
			
			if($branchname=='Dehradun')
			{
				$city	= "Dehradun";
				$branch = "Dehradun";
				
			}
			
			if($branchname=='Hyderabad')
			{						
				//$city	= "Hyderabad";
				$branch = "Hyderabad";
				
			}					
			
			if($branchname=='Jaipur')
			{						
				//$city	= "Jaipur";
				$branch = "Jaipur";
				
			}
			
			if($branchname=='Kolkata')
			{	
				//$city	= "Kolkata";
				$branch = "Kolkata";
				
			}
			
			
			if($branchname=='Lucknow')
			{	
				//$city	= "Lucknow";
				$branch = "Lucknow";
				
			}

			
			if($branchname=='Ludhiana')
			{
				//$city	= "Ludhiana";
				$branch = "Ludhiana";
				
			}	
			
			
			if($branchname=='Mangalore')
			{
				//$city	= "Mangalore";
				$branch = "Mangalore";
				
			}
			
			if($branchname=='Mumbai' || $branchname=='Mumbai Andheri West' || $branchname=='Mumbai Andheri')
			{								
				//$city	= "Mumbai Andheri West";
				$branch = "Mumbai Andheri";
				
			}
			
			if($branchname=='Mumbai Churchgate')
			{								
				//$city	= "Mumbai Churchgate";
				$branch = "Mumbai Churchgate";
				
			}
			
			if($branchname=='Delhi' || $branchname=='New Delhi' || $branchname=='NCR Delhi')
			{
				//$city	= "NCR Delhi";
				$branch = "NCR Delhi";
				
			}
			
			if($branchname=='NCR Gurgaon')
			{
				//$city	= "NCR Gurgaon";
				$branch = "NCR Gurgaon";
				
			}
			
			if($branchname=='NCR North Delhi')
			{
				//$city	= "NCR North Delhi";
				$branch = "NCR North Delhi";
				
			}
			
			if($branchname=='NCR West Delhi')
			{
				//$city	= "NCR West Delhi";
				$branch = "NCR West Delhi";
				
			}
			
			if($branchname=='Pune')
			{					
				//$city	= "Pune";
				$branch = "Pune";
				
			}				
			
			if($branchname=='Vijayawada')
			{
				//$city	= "Vijayawada";
				$branch = "Vijayawada";
				
			}
			
			
			if($branchname=='Trivandrum')
			{
				//$city	= "Trivandrum";
				$branch = "Trivandrum";
				
			}		
			
			
			if($numRows_register>0){			
				
				if($asource == "Facebook" || $asource !=""){					
					/*				
					$q1		= "SELECT * FROM public.stream_specilization_new where parentid='0' and title ilike '".$area_of_study."'";
					$result1= pg_query(fnconnect_aws(),$q1);
					$row1	= pg_fetch_array($result1);
					*/
					
					$query	="update public.gei_registration set country_preference='".$country."', admission_year='".$admission_year."', time_slot='".$_POST['txt_timeslot']."', attend_open_session='".$attend."' where id='".$id."'";				
					$res	=pg_query(fnconnect_aws(),$query);					
									
					$track_url='https://events.tcglobal.com/'.$foldername.'/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($id);
					$random_string = check_random();
					
					$query_url="INSERT INTO public.url_shortner(uid, destination, gid) VALUES ('".$random_string."', '".$track_url."','".$id."');";
					pg_query(fnconnect_aws(),$query_url);					
					
					/******** start leadsquared code *********/
					$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
					$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';	
		
					$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;					
					$data_string = '[
						{"Attribute":"SearchBy", "Value": "EmailAddress"},
						{"Attribute":"FirstName", "Value": "'.$firstname.'"},
						{"Attribute":"LastName", "Value": "'.$lastname.'"},
						{"Attribute":"EmailAddress", "Value": "'.$email.'"},
						{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
						{"Attribute":"mx_Level_of_Study", "Value": "'.$level_of_study.'"},
						{"Attribute":"mx_Area_of_Study", "Value": "'.$area_of_study.'"},
						{"Attribute":"mx_Country_Preference", "Value": "'.$country.'"},
						{"Attribute":"mx_Intake_Year", "Value": "'.$admission_year.'"},
						{"Attribute":"mx_City", "Value": "'.$city.'"},			
						{"Attribute": "ProspectID","Value": "'.$ProspectID.'"},			
						{"Attribute": "mx_Fair_Type","Value": "'.$event_fair.'"},
						{"Attribute": "Source","Value": "'.$source.'"},			
						{"Attribute": "SourceCampaign","Value": "'.$event_name.'"},
						{"Attribute": "mx_choprasleadsource","Value": "'.$event_name.'"},
						{"Attribute":"SourceMedium", "Value": "'.$sourcemedium.'"},
						{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},			
						{"Attribute":"mx_Event_Date","Value": "'.$gei_date_ls.'"},
						{"Attribute":"mx_Event_Fast_Track_URL_New","Value": "https://url.tcglobal.com/'.$random_string.'"},			
						{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
						{"Attribute":"mx_Events_Venue_Map","Value": ""},
						{"Attribute":"mx_Event_Registration_Status","Value": "'.$event_name.'"},										
						{"Attribute":"mx_Event_Fast_Track_Status","Value": "'.$s1.'"}								
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
								{"Attribute":"FirstName", "Value": "'.$firstname.'"},
								{"Attribute":"LastName", "Value": "'.$lastname.'"},							
								{"Attribute":"mx_Level_of_Study", "Value": "'.$level_of_study.'"},
								{"Attribute":"mx_Area_of_Study", "Value": "'.$area_of_study.'"},
								{"Attribute":"mx_Country_Preference", "Value": "'.$country.'"},
								{"Attribute":"mx_Intake_Year", "Value": "'.$admission_year.'"},
								{"Attribute":"mx_City", "Value": "'.$city.'"},			
								{"Attribute":"ProspectID","Value": "'.$ProspectID.'"},			
								{"Attribute":"mx_Fair_Type","Value": "'.$event_fair.'"},
								{"Attribute":"Source","Value": "'.$source.'"},			
								{"Attribute":"SourceCampaign","Value": "'.$event_name.'"},
								{"Attribute":"mx_choprasleadsource","Value": "'.$event_name.'"},
								{"Attribute":"SourceMedium", "Value": "'.$sourcemedium.'"},
								{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},			
								{"Attribute":"mx_Event_Date","Value": "'.$gei_date_ls.'"},
								{"Attribute":"mx_Event_Fast_Track_URL_New","Value": "https://url.tcglobal.com/'.$random_string.'"},			
								{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
								{"Attribute":"mx_Events_Venue_Map","Value": ""},
								{"Attribute":"mx_Event_Registration_Status","Value": "'.$event_name.'"},										
								{"Attribute":"mx_Event_Fast_Track_Status","Value": "'.$s1.'"}	
						
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
							
							
						$status_relatedid=$relatedid;
							
						$get_leadid = "update gei_registration set email='$email' where mobile ='$phone' and eventid='$eventid'";
						$qry_leadid = pg_query(fnconnect_aws(),$get_leadid);
							
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
							
					if($relatedid != '')					{
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
							"ActivityNote": "'.$event_name.'",				
							"Fields": [
								{
									"SchemaName": "mx_Custom_1",
									"Value": "'.$event_name.'"
								},
								{
									"SchemaName": "mx_Custom_2",
									"Value": "'.$s1.'" 
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
									"Value": "'.$optradio_mx.'" 
								},
								{
									"SchemaName": "mx_Custom_7",
									"Value": "" 
								},
								{
									"SchemaName": "mx_Custom_8",
									"Value": "'.$attend.'" 
								},
								{
									"SchemaName": "mx_Custom_9",
									"Value": "'.$time_slot.'" 
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
							//print_r($json_response2);
							curl_close($curl2);
						} catch (Exception $ex2) { 
							curl_close($curl2);
						}
						$data2 = json_decode($json_response2);	
						$st2 = $data2->Status;
					} 
						
						
					if($recordcount > 0)
					{
						$count_Custom_1 = 0; 
						for($i=0;$i<$recordcount;$i++)
						{
							$prospectactivityid=$data_activity->ProspectActivities[$i]->Id;
							$Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_1;
							//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
							
							if($Custom_1==$event_name)
							{
								$count_Custom_1 = $count_Custom_1+1; 
								$data_string = '{
								"ProspectActivityId":"'.$prospectactivityid.'",
								"ActivityEvent":192,
								"Fields":[
									{
										"SchemaName": "mx_Custom_1",
										"Value": "'.$event_name.'"
									},
									{
										"SchemaName": "mx_Custom_2",
										"Value": "'.$s1.'" 
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
										"Value": "'.$optradio_mx.'" 
									},
									{
										"SchemaName": "mx_Custom_7",
										"Value": "" 
									},
									{
										"SchemaName": "mx_Custom_8",
										"Value": "'.$attend.'" 
									},
									{
										"SchemaName": "mx_Custom_9",
										"Value": "'.$time_slot.'" 
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
			
								//die;
							}
						}
						
						$data2 = json_decode($json_response);	
						$st2 = $data2->Status;
						
						if($count_Custom_1 == 0)
						{
								
							$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
							$data_string2='{
							"EmailAddress": "'.$email.'",
							"ActivityEvent": 192,
							"ActivityNote": "'.$event_name.'",				
							"Fields": [
								{
									"SchemaName": "mx_Custom_1",
									"Value": "'.$event_name.'"
								},
								{
									"SchemaName": "mx_Custom_2",
									"Value": "'.$s1.'" 
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
									"Value": "'.$optradio_mx.'" 
								},
								{
									"SchemaName": "mx_Custom_7",
									"Value": "" 
								},
								{
									"SchemaName": "mx_Custom_8",
									"Value": "'.$attend.'" 
								},
								{
									"SchemaName": "mx_Custom_9",
									"Value": "'.$time_slot.'" 
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
						$asource = $row_register['source'];
		
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
						$st = $data_source->Status;
						//	print_r($data);die;
						//exit();
						//exit;
					}	
					
					
					/******** end leadsquared code *********/	
					
					$query_test		= "select * from fast_track_university where student_id='".$id."'"; 
					$result_test 	= pg_query(fnconnect_aws(),$query_test);
					$numRows_test	= pg_num_rows($result_test);
					//echo $row_register['fast_track_status'];
					
					if($numRows_test>0){
						@header("location:fast-track/fasttrackthanks/fasttrack_thanks.php");
					}
					else{
						$_SESSION['gei_registration_id']=$row_register['id'];
						$_SESSION['los']=$row_register['level_of_study'];
						@header("location:fasttrackthankyou.php");
					}					
				}				
			}
			else
			{
				/*
				$q		= "select * from compmast where name ilike 'n&n Chopra Consultants-".$city."'";
				$result	= pg_query(fnconnect_aws(),$q);
				$numRows= pg_num_rows($result);
				$row	= pg_fetch_array($result);
				//print_r($row);die;
			*/
				$q1	= "SELECT * FROM public.stream_specilization_new where parentid='0' and title ilike '".$area_of_study."'";
				$result1= pg_query(fnconnect_aws(),$q1);
				$row1	= pg_fetch_array($result1);					
				
				$query="INSERT INTO public.gei_registration(
				first_name, last_name, email, mobile, level_of_study, area_of_study_id, country_preference, admission_year, event_venue_id, time_slot, attend_open_session, registration_type, fast_track_status, source, eventid, note, registration_status,inhousefair)
				VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$mobileNumber."', '".$level_of_study."', '".$row1['id']."', '".$country."', '".$admission_year."', '".$branchid."', '".$_POST['txt_timeslot']."', '".$attend."', '".$rt."', '".$_POST['optradio']."','".$source."','".$eventid."','".$event_name."','Yes','true') RETURNING id;";
				$res	= pg_query(fnconnect_aws(),$query);
				$new_id = pg_fetch_array($res);
				
				$_SESSION['gei_registration_id']=$new_id['id'];
				$_SESSION['los']=$level_of_study;				
				
				$track_url='https://events.tcglobal.com/'.$foldername.'/fast-track/fasttrackthanks/fasttrack_step1.php?ref='.base64_encode($new_id['id']);
								
				$random_string = check_random();				
				
				$query_url="INSERT INTO public.url_shortner(uid, destination, gid) VALUES ('".$random_string."', '".$track_url."','".$new_id['id']."')";
				pg_query(fnconnect_aws(),$query_url); 				
								
				
				$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
				$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';
				
				$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
			
				$data_string = '[
				{"Attribute":"SearchBy", "Value": "EmailAddress"},
				{"Attribute":"FirstName", "Value": "'.$firstname.'"},
				{"Attribute":"LastName", "Value": "'.$lastname.'"},
				{"Attribute":"EmailAddress", "Value": "'.$email.'"},
				{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},
				{"Attribute":"mx_Level_of_Study", "Value": "'.$level_of_study.'"},
				{"Attribute":"mx_Area_of_Study", "Value": "'.$area_of_study.'"},
				{"Attribute":"mx_Country_Preference", "Value": "'.$country.'"},
				{"Attribute":"mx_Intake_Year", "Value": "'.$admission_year.'"},
				{"Attribute":"mx_City", "Value": "'.$city.'"},			
				{"Attribute": "ProspectID","Value": "'.$ProspectID.'"},			
				{"Attribute": "mx_Fair_Type","Value": "'.$event_fair.'"},
				{"Attribute": "Source","Value": "'.$source.'"},			
				{"Attribute": "SourceCampaign","Value": "'.$event_name.'"},
				{"Attribute": "mx_choprasleadsource","Value": "'.$event_name.'"},
				{"Attribute":"SourceMedium", "Value": "'.$sourcemedium.'"},
				{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},			
				{"Attribute":"mx_Event_Date","Value": "'.$gei_date_ls.'"},
				{"Attribute":"mx_Event_Fast_Track_URL_New","Value": "https://url.tcglobal.com/'.$random_string.'"},			
				{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
				{"Attribute":"mx_Events_Venue_Map","Value": ""},
				{"Attribute":"mx_Event_Registration_Status","Value": "'.$event_name.'"},										
				{"Attribute":"mx_Event_Fast_Track_Status","Value": "'.$s1.'"}					
				]';
				//echo "<pre>";
				//print_r($data_string);die;
				
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
				//print_r($json_response);	
				//print_r($data);
				//die;
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
					}
					else {					   
						$data_lead = json_decode($response);
						//echo "<pre>";
						//print_r($data_lead);
						//exit;
						$relatedid = $data_lead[0]->ProspectID;				
						$email = $data_lead[0]->EmailAddress;
						
						
						$url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&leadId='.$relatedid;
						$data_string = '[				
							{"Attribute":"FirstName", "Value": "'.$firstname.'"},
							{"Attribute":"LastName", "Value": "'.$lastname.'"},							
							{"Attribute":"mx_Level_of_Study", "Value": "'.$level_of_study.'"},
							{"Attribute":"mx_Area_of_Study", "Value": "'.$area_of_study.'"},
							{"Attribute":"mx_Country_Preference", "Value": "'.$country.'"},
							{"Attribute":"mx_Intake_Year", "Value": "'.$admission_year.'"},
							{"Attribute":"mx_City", "Value": "'.$city.'"},			
							{"Attribute": "ProspectID","Value": "'.$ProspectID.'"},			
							{"Attribute": "mx_Fair_Type","Value": "'.$event_fair.'"},
							{"Attribute": "Source","Value": "'.$source.'"},			
							{"Attribute": "SourceCampaign","Value": "'.$event_name.'"},
							{"Attribute": "mx_choprasleadsource","Value": "'.$event_name.'"},
							{"Attribute":"SourceMedium", "Value": "'.$sourcemedium.'"},
							{"Attribute":"mx_Nearest_Branch", "Value": "'.$branch.'"},			
							{"Attribute":"mx_Event_Date","Value": "'.$gei_date_ls.'"},
							{"Attribute":"mx_Event_Fast_Track_URL_New","Value": "https://url.tcglobal.com/'.$random_string.'"},			
							{"Attribute":"mx_Event_Venue","Value": "'.$venue.'"},			
							{"Attribute":"mx_Events_Venue_Map","Value": ""},
							{"Attribute":"mx_Event_Registration_Status","Value": "'.$event_name.'"},										
							{"Attribute":"mx_Event_Fast_Track_Status","Value": "'.$s1.'"}			
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
					$status_relatedid=$relatedid;
					
					$get_leadid = "update gei_registration set email='$email' where mobile ='$phone' and eventid='$eventid'";
					$qry_leadid = pg_query(fnconnect_aws(),$get_leadid);
					
				}
				else
				{
					$st = $data->Status;			
					$Status_st = $data->Status;
					$leadid=$data->Message->Id;
					$relatedid=$data->Message->RelatedId;
					$status_relatedid=$data->Message->RelatedId;
				}
				
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
								"Value": "'.$event_name.'"
							},
							{
								"SchemaName": "mx_Custom_2",
								"Value": "'.$s1.'" 
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
								"Value": "'.$optradio_mx.'" 
							},
							{
								"SchemaName": "mx_Custom_7",
								"Value": "" 
							},
							{
								"SchemaName": "mx_Custom_8",
								"Value": "'.$attend.'" 
							},
							{
								"SchemaName": "mx_Custom_9",
								"Value": "'.$time_slot.'" 
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
							//print_r($json_response2);
							curl_close($curl2);
						} catch (Exception $ex2) { 
							curl_close($curl2);
						}
						$data2 = json_decode($json_response2);	
						$st2 = $data2->Status;			
						//print_r($data2);
						//die('1');
					} 
					
					
					if($recordcount > 0)
					{
						$count_Custom_1 = 0; 
						for($i=0;$i<$recordcount;$i++)
						{
							  $prospectactivityid=$data_activity->ProspectActivities[$i]->Id;
							  $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_1;
							//echo $Custom_1 = $data_activity->ProspectActivities[$i]->ActivityFields->mx_Custom_3;
							if($Custom_1==$event_name)
							{
								$count_Custom_1 = $count_Custom_1+1; 
								$data_string = '{
								"ProspectActivityId":"'.$prospectactivityid.'",
								"ActivityEvent":192,
								"Fields":[
									{
										"SchemaName": "mx_Custom_1",
										"Value": "'.$event_name.'"
									},
									{
										"SchemaName": "mx_Custom_2",
										"Value": "'.$s1.'" 
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
										"Value": "'.$optradio_mx.'"
									},
									{
										"SchemaName": "mx_Custom_7",
										"Value": "" 
									},
									{
										"SchemaName": "mx_Custom_8",
										"Value": "'.$attend.'" 
									},
									{
										"SchemaName": "mx_Custom_9",
										"Value": "'.$time_slot.'" 
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
							}
						}
					
						$data2 = json_decode($json_response);	
						$st2 = $data2->Status;
						//echo $count_Custom_1;
						
						//die('123');
						if($count_Custom_1 == 0)
						{
							
							$url2='https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Create?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b';
							$data_string2='{
							"EmailAddress": "'.$email.'",
							"ActivityEvent": 192,
							"ActivityNote": "'.$event_name.'",				
							"Fields": [
								{
									"SchemaName": "mx_Custom_1",
									"Value": "'.$event_name.'"
								},
								{
									"SchemaName": "mx_Custom_2",
									"Value": "'.$s1.'" 
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
									"Value": "'.$optradio_mx.'"
								},
								{
									"SchemaName": "mx_Custom_7",
									"Value": "" 
								},
								{
									"SchemaName": "mx_Custom_8",
									"Value": "'.$attend.'" 
								},
								{
									"SchemaName": "mx_Custom_9",
									"Value": "'.$time_slot.'" 
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
					
				//Check if source is Direct Traffic
				if($relatedid != '')
				{
					 $url_activity = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$r2bb087639c2ca1a14c90351d0dcb8892&secretKey=7258e3b5ccc601ed00dce5a5dfa866c00620022b&id='.$relatedid;
					
					$curl = curl_init();
				   curl_setopt_array($curl, array(
					   CURLOPT_URL => $url_activity,
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
						
						$data_activity = json_decode($response);
					//echo "<pre>";
					//print_r($data_activity);
					 $data_activity['Source'];
					if($data_activity['Source'] == 'Direct Traffic')
					{
						$get_source_aws = "select * from gei_registration where id='".$new_id['id']."'";
						
						$qry_get_source_aws = pg_query(fnconnect_aws(),$get_source_aws);
						$res_get_source_aws = pg_fetch_array($qry_get_source_aws);
						$aws_source = $res_get_source_aws['source'];
						
						if($aws_source != '')
						{
							$asource = $aws_source;
		
							$accessKey = 'u$r2bb087639c2ca1a14c90351d0dcb8892';
							$secretKey = '7258e3b5ccc601ed00dce5a5dfa866c00620022b';	
			
							//$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;
							$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=' . $accessKey . '&secretKey=' . $secretKey .'&leadId='.$relatedid;
							
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
						}						
					}
					//die;
				   }
					
				}			
		
				if($st2=='Success')
				{
					//echo '<div>Form has been submitted successfully</div>';
					if($optradio == 'Meet RM at the Venue') {
						echo "<script>document.location.href ='thankyou.php'</script>";
					}
					
					if($optradio=='Self Fast Track') {
						echo "<script>document.location.href ='fasttrackthankyou.php'</script>";
					}
				}
				else
				{
					echo '<div class="failedsms">Failed! Record already exist</div>';
				}
					
			}
			
			
			
		}	
	}	
	?>
	
	
	
<!doctype html>
<html>
	<head>		
		<title>Transnational Education (TNE) Virtual Interaction June 2020 | India's Leading International Education Virtual Fair by TC Global</title>
		<meta name="description" content="Virtual Fair May 2020"/>
		<meta name="keywords" content="Virtual Fair "/>
		<meta name="author" content="TCGlobal"/>
		<meta name="robots" content="index, follow"/>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrap/css/googlefonts.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="bootstrap/css/component-chosen.css" rel="stylesheet" type="text/css">
		<link href="bootstrap/css/custom-theme.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="scroll/jquery.mCustomScrollbar.css" type="text/css">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139883228-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());			
			gtag('config', 'UA-139883228-1');
		</script>		
	</head>
	<body>
		<section class="container ">
			<nav class="float-left" >
				<a class="navbar-brand" href="#"><img  src="bootstrap/images/logo.jpg"  alt=""/></a>
			</nav>
		</section>
		<header>
			<img src="bootstrap/images/banner-2.jpg"  alt=""/>			
		</header>
		<section class="container  pad100">
			<div class="row spacer">
				<div class="col-md-4 title-color">
					<h1 class="title-color">What are the TC Global Learning Workshops?
					</h1>
				</div>
				<div class="col-md-8 dis-color">
					The world of education has been disrupted by the complete shut down of classrooms and campuses around the world. We are resilient and our thirst for knowledge has propelled us to a very quick transition into remote learning via various online platforms!  Since the changes on delivery for both domestic and international learning are here to stay as social distancing measures are necessary to contain the spread of the virus, we at TC Global, wanted to give you the opportunity to join this new online learning environment prepared! <br>
				
					
Our TC Global learning workshops have been designed with you are the center of it! All or product workshops have been designed to show you that the remote learning experience can be a rich one! Online learning gives you flexibility in your learning hours all from the comfort from your own home! Our new digital infrastructure ensures you don’t miss out on vital opportunities to have a meaningful conversation and move along on your Global Ed journey but also stay safe.			
					<div class="clearfix"></div>
					<p></p>
					<a href="#section2" class="btn btn-custom">Register Now !</a>
				</div>
			</div>
		</section>
		<section class="greybg pad100 bullet-change">
			<section class="container gei-exp postion-tp"><img src="bootstrap/images/TCLearning-exp.jpg"  alt="Experience the Changing face of Global Education"/></section>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-md-4">
								<section class="bor-bottom-dot">
									<h5 > Exposure</h5>
									<article>to a remote first learning environment to support you with your SAT, GRE, GMAT, IELTS, TOEFL and PTE requirements</article>
								</section>
								<section class="bor-bottom-dot">
									<h5 > Interact</h5>
									<article>virtually and directly with our Test Prep and English Language Faculty</article>
								</section>
								<section class="bor-bottom-dot">
									<h5 > Network  </h5>
									<article>With learners like yourself are open to learning digitally</article>
									
								</section>
							</div>
							<div class="col-md-4">
								<section class="bor-bottom-dot">
									<h5 > Attend</h5>
									<article>tutorials that are smaller in size, so you get individual attention from our faculty!
									</article>
								</section>
								<section class="bor-bottom-dot">
									<h5 > Access </h5>
									<article>support services including all study materials online!
									</article>
								</section>
								<section class="bor-bottom-dot ">
									<h5 > Our Learning platform </h5>
									<article>has additional content like recordings of previous sessions, sectional tests and quizzes and so much more!
									</article>
								</section>
								
							</div>
							<div class="col-md-4">
								<section class="bor-bottom-dot ">
									<h5 > Discover</h5>
									<article>Personalized performance reviews and evaluation
									</article>
								</section>
								<section class="bor-bottom-dot ">
									<h5 > Join </h5>
									<article>our demo classes to get a feel of online learning
									</article>
								</section>
								<section class="bor-bottom-dot ">
									<h5 > Onboard</h5>
									<article>with TC Global to lead you through your journey 
									</article>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</section>
		<section class="bgsc-red pad100">
			
			<!--attend university data-->
			<?php	
				//$q = pg_query(fnconnect_aws(),"select * from compmast where compid in (43971)");
				$query 	= "select * from event_master where eventid in ('SUB052004','SUB062001')";
				$result = pg_query(fnconnect_aws(),$query);
				
				while($r=pg_fetch_array($result))
				{				
					
					$eventid= $r['eventid'];
					$compid	= 43971;		

				?>
			<div id="location-<?php echo $eventid ;?>" class="location-content ">
				<div class="container position-relative">
					<h3 class="text-left redtitle colorwh border-bottom">Universities in attendance :- <?php //echo $abhi ;?><a class="close-sh"><span class="close thick"></span> </a></h3>
					<div  class="scroll-custom data-att-list content">
						<div class="row">
							<div class="col-md-4">
								<ul>
									<?php 										
										$pune=pg_query(fnconnect_aws(),"select distinct participate_university.compid,name,web_name from participate_university
										join compmast on compmast.compid=participate_university.compid where branchid=$compid  and participate_university.eventid='".$eventid."' 
										and participate_university.compid not in (43971) 
										and university not ilike '%INTO%' and  university not ilike '%CEG%' and university not ilike '%Navitas%' 
										and university not ilike '%NCUK%' and university not ilike '%kaplan%'  order by name");										
										while($punerow=pg_fetch_array($pune)) {
										if($punerow['web_name']=='')
										{	
										?>
										<li><?php echo $punerow['name'];?></li>
									<?php } else { ?>
										<li><?php echo $punerow['web_name'];?></li>
									<?php } } ?>
								</ul>
							</div>
							<?php
								$pune=pg_query(fnconnect_aws(),"select distinct participate_university.compid,name,web_name from participate_university
								join compmast on compmast.compid=participate_university.compid where branchid=$compid  and participate_university.eventid='".$eventid."' 
								and participate_university.compid not in (43971) 
								and name ilike '%INTO%'  order by name");
								$num1=pg_num_rows($pune);
								if($num1 > 0) {
								?>
							<div class="col-md-4">
								<ul>
									<li>
										<h6>INTO</h6>
										<ul>
											<?php 
												while($punerow=pg_fetch_array($pune)) {
												if($punerow['web_name']=='')
												{	
												?>
											<li><?php echo $punerow['name'];?></li>
											<?php } else { ?>
											<li><?php echo $punerow['web_name'];?></li>
											<?php }} ?>
											</li>
										</ul>
								</ul>
							</div>
							<?php } 
								$pune=pg_query(fnconnect_aws(),"select distinct participate_university.compid,name,web_name from participate_university
								join compmast on compmast.compid=participate_university.compid where branchid=$compid  and participate_university.eventid='".$eventid."' 
								and participate_university.compid not in (43971) 
								and name ilike  '%Navitas%'  order by name");
								$num2=pg_num_rows($pune);
								if($num2 > 0) {					
								
								?>
							<div class="col-md-4">
								<ul>
									<li>
										<h6>Navitas</h6>
										<ul>
											<?php 
												while($punerow=pg_fetch_array($pune)) {
												if($punerow['web_name']=='')
												{	
												?>
											<li><?php echo $punerow['name'];?></li>
											<?php } else { ?>
											<li><?php echo $punerow['web_name'];?></li>
											<?php }} ?>
										</ul>
									</li>
								</ul>
							</div>
							<!--</div>-->
							<!--<div class="row">-->
							<?php } 
								$pune=pg_query(fnconnect_aws(),"select distinct participate_university.compid,name,web_name from participate_university
								join compmast on compmast.compid=participate_university.compid where branchid=$compid  and participate_university.eventid='".$eventid."' 
								and participate_university.compid not in (43971) 
								and name ilike 'CEG%' order by name");
								$num3=pg_num_rows($pune);
								if($num3 > 0) {		
								?>
							<div class="col-md-4">
								<ul>
									<li>
										<h6>CEG </h6>
										<ul>
											<?php 
												while($punerow=pg_fetch_array($pune)) {
												if($punerow['web_name']=='')
												{	
												?>
											<li><?php echo $punerow['name'];?></li>
											<?php } else { ?>
											<li><?php echo $punerow['web_name'];?></li>
											<?php }} ?>
										</ul>
									</li>
								</ul>
							</div>
							<?php } 
								$pune=pg_query(fnconnect_aws(),"select distinct participate_university.compid,name,web_name from participate_university
								join compmast on compmast.compid=participate_university.compid where branchid=$compid  and participate_university.eventid='".$eventid."' 
								and participate_university.compid not in (43971) 
								and (name ilike '%Kaplan%' or name ilike '%KIC%') order by name");
								$num4=pg_num_rows($pune);
								if($num4 > 0) {	
								?>
							<div class="col-md-4"	>
								<ul>
									<li>
										<h6>Kaplan</h6>
										<ul>
											<?php
												while($punerow=pg_fetch_array($pune)) {
												if($punerow['web_name']=='')
												{	
												?>
											<li><?php echo $punerow['name'];?></li>
											<?php } else { ?>
											<li><?php echo $punerow['web_name'];?></li>
											<?php }} ?>
										</ul>
									</li>
								</ul>
							</div>
							<?php }  
								$pune=pg_query(fnconnect_aws(),"select distinct participate_university.compid,name,web_name from participate_university
								join compmast on compmast.compid=participate_university.compid where branchid=$compid  and participate_university.eventid='".$eventid."' 
								and participate_university.compid not in (43971) 
								and name ilike '%NCUK%'  order by name");
								$num4=pg_num_rows($pune);
								if($num4 > 0) {	
								?>
							<div class="col-md-4"	>
								<ul>
									<li>
										<h6>NCUK</h6>
										<ul>
											<?php
												while($punerow=pg_fetch_array($pune)) {
												if($punerow['web_name']=='')
												{	
												?>
											<li><?php echo $punerow['name'];?></li>
											<?php } else { ?>
											<li><?php echo $punerow['web_name'];?></li>
											<?php }} ?>
										</ul>
									</li>
								</ul>
							</div>
							<?php }
								?>
						</div>
					</div>
				</div>
			</div>
			</div>
			<?php }?>
			<!--attend university data-close-->
			<div class="container">
				<h3 class="text-center redtitle colorwh">Schedule</h3>
				<!--<ul class="img-grid Schedule-gr">
					
					<li >
						<a  class="overlay-container" data-location="location-SUB062001" >
							<img class="overlay-img" src="bootstrap/images/schedule-img.jpg">
							<article>
								
								<p>27th June 2020 | Saturday
									<span>2pm to 5pm IST</span>
									<span><strong>PLATFORM:</strong> ZOOM - Please connect through your Laptop, PC, Tablet or Phone<br>
									Completely <strong>ONLINE</strong> so join us from the safety of your homes!</span>
								</p>
							</article>
						</a>
					</li>
					
				</ul>-->
				<p class="text-center colorwh">
				<table style="border-color: black;" border="2px" width="757" cellspacing="2" cellpadding="2">
<tbody>
<tr style="height: 35px;">
<td style="height: 35px;" width="115">&nbsp;</td>
<td style="height: 35px;" colspan="5" width="320">
<p style="text-align: center;"><strong>TEST PREP</strong></p>
</td>
<td style="height: 35px;" colspan="5" width="320">
<p style="text-align: center;"><strong>ENGLISH LANGUAGE</strong></p>
</td>
<td style="height: 35px;" width="2">
<p>&nbsp;</p>
</td>
</tr>
<tr style="height: 35px;">
<td style="height: 35px;" width="115">
<p style="text-align: center;"><strong>Timing</strong></p>
</td>
<td style="height: 35px;" width="76">
<p style="text-align: center;"><strong>MON</strong></p>
</td>
<td style="height: 35px;" width="57">
<p style="text-align: center;"><strong>TUE</strong></p>
</td>
<td style="height: 35px;" width="70">
<p style="text-align: center;"><strong>WED</strong></p>
</td>
<td style="height: 35px;" width="55">
<p style="text-align: center;"><strong>SAT</strong></p>
</td>
<td style="height: 35px;" width="62">
<p style="text-align: center;"><strong>SUN</strong></p>
</td>
<td style="height: 35px;" width="76">
<p style="text-align: center;"><strong>MON</strong></p>
</td>
<td style="height: 35px;" width="57">
<p style="text-align: center;"><strong>TUE</strong></p>
</td>
<td style="height: 35px;" width="70">
<p style="text-align: center;"><strong>WED</strong></p>
</td>
<td style="height: 35px;" width="55">
<p style="text-align: center;"><strong>SAT</strong></p>
</td>
<td style="height: 35px;" width="62">
<p style="text-align: center;"><strong>SUN</strong></p>
</td>
<td style="height: 35px;" width="2">
<p>&nbsp;</p>
</td>
</tr>
<tr style="height: 35px;">
<td style="height: 48px;" rowspan="2" width="115">
<p style="text-align: center;">10:00am - 11:00am</p>
</td>
<td style="height: 48px;" colspan="3" rowspan="2" width="203">
<p style="text-align: center;">GRE</p>
</td>
<td style="height: 48px;" colspan="2" rowspan="2" width="117">
<p style="text-align: center;">GMAT</p>
</td>
<td style="height: 48px;" colspan="5" rowspan="2" width="320">
<p style="text-align: center;">IELTS</p>
</td>
<td style="height: 35px;" width="2">
<p>&nbsp;</p>
</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 20px;">
<td style="height: 40px;" rowspan="2" width="115">
<p style="text-align: center;">11:30am - 12:30pm</p>
</td>
<td style="height: 40px;" colspan="3" rowspan="2" width="203">
<p style="text-align: center;">PG - Foundation</p>
</td>
<td style="height: 40px;" colspan="2" rowspan="2" width="117">
<p style="text-align: center;">UG - Foundation</p>
</td>
<td style="height: 40px;" colspan="5" rowspan="2" width="320">
<p style="text-align: center;">EL Foundation</p>
</td>
<td style="height: 20px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 20px;">
<td style="height: 20px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 20px;">
<td style="height: 40px;" rowspan="2" width="115">
<p style="text-align: center;">1:00pm - 2:00pm</p>
</td>
<td style="height: 40px;" colspan="3" rowspan="2" width="203">
<p style="text-align: center;">GMAT</p>
</td>
<td style="height: 40px;" colspan="2" rowspan="2" width="117">
<p style="text-align: center;">GRE</p>
</td>
<td style="height: 40px;" colspan="5" rowspan="2" width="320">
<p style="text-align: center;">TOEFL</p>
</td>
<td style="height: 20px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 20px;">
<td style="height: 20px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 20px;">
<td style="height: 40px;" rowspan="2" width="115">
<p style="text-align: center;">2:30pm - 3:30pm</p>
</td>
<td style="height: 40px;" colspan="3" rowspan="2" width="203">
<p style="text-align: center;">SAT</p>
</td>
<td style="height: 40px;" colspan="2" rowspan="2" width="117">
<p style="text-align: center;">SAT</p>
</td>
<td style="height: 40px;" colspan="5" rowspan="2" width="320">
<p style="text-align: center;">PTE</p>
</td>
<td style="height: 20px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 20px;">
<td style="height: 20px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 48px;">
<td style="height: 48px;" width="115">
<p style="text-align: center;">4:00pm - 5:00pm</p>
</td>
<td style="height: 48px;" colspan="3" width="203">&nbsp;</td>
<td style="height: 48px;" colspan="2" width="117">&nbsp;</td>
<td style="height: 48px;" colspan="5" width="320">
<p style="text-align: center;">IELTS</p>
</td>
<td style="height: 48px;" width="2">&nbsp;</td>
</tr>
<tr style="height: 48px;">
<td style="height: 48px;" width="115">
<p style="text-align: center;">6:30pm - 7:30pm</p>
</td>
<td style="height: 48px;" colspan="3" width="203">
<p style="text-align: center;">UG - Foundation</p>
</td>
<td style="height: 48px;" colspan="2" width="117">
<p style="text-align: center;">PG - Foundation</p>
</td>
<td style="height: 48px;" colspan="5" width="320">&nbsp;</td>
<td style="height: 48px;" width="2">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></p>
			</div>
		</section>
		<!--<section class="bgtexture pad100">
			<div class="container">
				<h3 class="text-center redtitle black-cr">How do I go about it?</h3>
				<div class="row ">
					<div class="col bg">
						<h2>Fast Track</h2>
						<p>Fast track your way directly to university desks you choose, you are eligible for and you are interested in</p>
					</div>
					<div class="col bg">
						<h2>Book Your Slot</h2>
						<p>A slot to connect with our Relationships Team at the Transnational Education (TNE) Virtual Interaction to discuss your best options</p>
					</div>
				</div>
				<p class="text-center fontheding-center"></p>
				<div class="text-center">
					<a href="#section2" class="btn btn-custom">Register Now</a>
				</div>
			</div>
		</section>-->
		<!--<section class="bgf9 pad100 moblieevent">
			<h3 class="text-center redtitle">People at the Event</h3>		
			<div class="container">
			<div style="text-align:center;color:red"> 
			
				<div class="row">				
					
								
					
								
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Deepika-Deakin-Univ.jpg">
							<article>
								<div class="uniname">Deakin University</div>
								<div class="name" >Deepika Narula</div>
								<div class="deg" >Manager - International Marketing & Recruitments</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/AllanWatson-Loughborough.jpg">
							<article>
								<div class="uniname">Loughborough University</div>
								<div class="name" >Dr Allan Watson</div>
								<div class="deg" >Senior Lecturer in Human Geography</div>
							</article>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Michael-Skey-Loughborough.jpg">
							<article>
								<div class="uniname">Loughborough University</div>
								<div class="name" >Dr Michael Skey</div>
								<div class="deg" >Senior Lecturer in Communication and Media Studies</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Alexandre-Christoyannopoulos-Loughborough.jpg">
							<article>
								<div class="uniname">Loughborough University</div>
								<div class="name" >Dr Alex Christoyannopoulos</div>
								<div class="deg" >Senior Lecturer in Politics and International Relations</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Asha-Balaji-monash-university.jpg">
							<article>
								<div class="uniname">Monash University</div>
								<div class="name" >Asha Balaji</div>
								<div class="deg" >Country Coordinator, Student Recruitment (International)</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Nilanjana-Shihn-TCD.jpg">
							<article>
								<div class="uniname">Trinity College Dublin</div>
								<div class="name" >Nilanjana Shihn</div>
								<div class="deg" >Senior Recruitment Adviser</div>
							</article>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Richard-Collins-Uni-College-Dublin.jpg">
							<article>
								<div class="uniname">University College of Dublin</div>
								<div class="name" >Richard Collins</div>
								<div class="deg" >Associate Professor College of Social Science and Law, VP Internationalisation Social Science</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Binny-Tangri-UCD.jpg">
							<article>
								<div class="uniname">University College of Dublin</div>
								<div class="name" >Binny Tangri</div>
								<div class="deg" >Global Admissions and Recruitment Coordinator</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Priyanka-Karia-Uni-of-Cincinnati.jpg">
							<article>
								<div class="uniname">University of Cincinnati</div>
								<div class="name" >Priyanka Karia</div>
								<div class="deg" >Country Coordinator - India</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Vatsal-Uni-of-Essex.jpg">
							<article>
								<div class="uniname">University of Essex</div>
								<div class="name" >Vatsal Chandra</div>
								<div class="deg" >Regional Officer</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Uni-of-Queensland-Lute.jpg">
							<article>
								<div class="uniname">University of Queensland</div>
								<div class="name" >Lute Coremans</div>
								<div class="deg" >Senior International Relations Officer</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Scott-Morrice-University-of-Stirling.jpg">
							<article>
								<div class="uniname">University of Stirling</div>
								<div class="name" >Scott Morris</div>
								<div class="deg" >International Recruitment Manager-South Asia</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="people-block">
							<img src="bootstrap/images/people/Dolan-Mitra-Kings-College-London.jpg">
							<article>
								<div class="uniname">King’s College London</div>
								<div class="name" >Dolan Mitra</div>
								<div class="deg" >Country Adviser</div>
							</article>
						</div>
					</div>
					
					
					
				</div>
			</div>
		</section>-->
		<!--<section class="container pad100">
			<h3 class="text-center redtitle">Participating Universities</h3>
			<div >
				<ul class="img-grid">
				<li ><a  class="overlay-container" ><img class="overlay-img" src="bootstrap/images/universities/3737.png"  alt="Anglia Ruskin University"/></a></li>
				<li ><a  class="overlay-container" ><img class="overlay-img" src="bootstrap/images/universities/3722.png"  alt="Birmingham City University"/></a></li>
				<li ><a  class="overlay-container" ><img class="overlay-img" src="bootstrap/images/universities/3712.jpg"  alt="Bournemouth University"/></a></li>
				<li ><a  class="overlay-container" ><img class="overlay-img" src="bootstrap/images/universities/Centennial College(1).png"  alt="Centennial College"/></a></li>
				<li ><a  class="overlay-container" ><img class="overlay-img" src="bootstrap/images/universities/8751.png"  alt="Cranfield University"/></a></li>
												
				</ul
				
				Coming Soon
				
			</div>
			<br>	<br>	<br>
		</section>-->
		<section class="bgtexture footprint pad100">
			<div class="container">
				<h4 class="text-center redtitle"> Our Footprint</h4>
				<div class="row">
					<div class="col-lg-6">
						<div class="row" >
							<div class="col-lg-12">
								<div class="redbg divspace">
									<p>1500+</p>
									<span>Universities</span>
								</div>
							</div>
						</div>
						<div class="row" >
							<div class="col-lg-5">
								<div class="ylbg divspace">
									<p>40+</p>
									<span>Countries</span>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="redlg divspace">
									<p>700+</p>
									<span>Global Partners</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 ">
						<div class="row hg" >
							<div class="col-lg-12">
								<div class="bgimgred divspace">
									<p>2.5<br>
										million+
									</p>
									<span>Futures</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<Div class=" discrip">
					<div  class="row">
						<div class="col-md-8">
							<article>
								<h3>Since inception, TC Global has been committed to shaping the lives and careers of every person we interact with.  
								</h3>
								<p>Our mission and purpose is to build a global mobility and learning community of students, people, industry and partnerships, to help shape the global citizens of tomorrow, today. Today, we are creating a next gen platform ecosystem built for a generation that has grown up in the age of the internet, enabling you to step forward on this journey, more informed and confident. 	
								</p>
								<h3>With the same commitment with which we started our journey 25 years ago, we look forward to pioneering a new wave in Global Ed.  <span class="red">We are the Movement.</span>
								</h3>
							</article>
						</div>
					</div>
				</Div>
			</Div>
		</section>
		<section id="section2" class="registration  pad100 ">
			<Div class="container">
				<h6 class="text-center redtitle">Register for the Event</h6>
				<form name="frm_registration" id="frm_registration" action="" method="post">
					<input  name="ProspectID" id="ProspectID"  type="hidden">
					<div class="row ">
						<div class="col-md-6">
							<input type="text" name="txt_fname" id="txt_fname" value="<?php echo $fname;?>" pattern=".{2,}" required   alt='First Name' placeholder='First Name' class="text-capitalize" <?php echo $readonly;?>>
							<label alt='First Name' placeholder='First Name' <?php echo $readonly1;?>></label>
						</div>
						<div class="col-md-6">
							<input type="text" name="txt_lname" id="txt_lname" required value="<?php echo $lname;?>" placeholder='Last Name' class="text-capitalize" <?php echo $readonly;?>>
							<label alt='Last Name' placeholder='Last Name' <?php echo $readonly1;?>></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<input  name="txt_email" id="txt_email" required placeholder="Email"  type="email" value="<?php echo $email;?>" pattern="[^ @]*@[^ @]*" <?php echo $readonly;?>>
							<label alt='Email' placeholder='Email'  <?php echo $readonly1;?>></label>
						</div>
						<div class="col-md-6">
							<input type="tel" name="txt_mobile" id="txt_mobile" required pattern="^\d{10}$"  placeholder="Mobile" value="<?php echo $mobile;?>" maxlength="10" <?php echo $readonly;?>>
							<label alt='Mobile' placeholder='Mobile'  <?php echo $readonly1;?>></label>
						</div>
					</div>
					<div class="row ">
						<?php 
							
							if($level_of_study == 'Under Graduate')
							{
								 $selected1='selected';
								 $readonly_new1 = '';
								 
								 $selected2='';
								 $readonly_new2 = 'disabled';
								 
								 $selected3='';
								 $readonly_new3 = 'disabled';
							}
							
							if($level_of_study == 'Post Graduate')
							{
								 $selected1='';
								 $readonly_new1 = 'disabled';
								 
								 $selected2='selected';
								 $readonly_new2 = '';
								 
								 $selected3='';
								 $readonly_new3 = 'disabled';
							}
							
							if($level_of_study == 'Res')
							{
								 $selected1='';
								 $readonly_new1 = 'disabled';
								 
								 $selected2='';
								 $readonly_new2 = 'disabled';
								 
								 $selected3='selected';
								 $readonly_new3 = '';
							}							
						?>
						<div class="col-md-6">
							<label class="custom-dropdown">
								<select required name="txt_level" id="txt_level" >
									<option value="">Level of Study</option>
									<option value="Under Graduate" <?php echo $selected1; echo ' '.$readonly_new1;?>>Under Graduate</option>
									<option value="Post Graduate" <?php echo $selected2; echo ' '.$readonly_new2;?>>Post Graduate</option>
									<option value="Res" <?php echo $selected3; echo ' '.$readonly_new3;?>>Research</option>
								</select>
							</label>
						</div>
						<div class="col-md-6">
							<label  class="custom-dropdown" >
								<select required name="txt_area" id="txt_area" >
									<option value="">Area of Study</option>
									<?php $area_study = "select * from stream_specilization_new where parentid=0 order by title ";
										$qry_area_study = pg_query(fnconnect_aws(),$area_study);
										while($res_area_study = pg_fetch_array($qry_area_study)){
										
										if($area_name != ''){
											if($res_area_study['title'] == $area_name)											
											{
												 $selected='selected';
												 $readonly_new = '';
												
											}
											else
											{
												$selected = '';
												$readonly_new = 'disabled';
											}
										}	
										
										
										//if($res_area_study['title'] == 'Engineering')	
										//{
										?>
											<option value="<?php echo $res_area_study['title'];?>" <?php echo $selected; echo ' '.$readonly_new; ?>><?php echo $res_area_study['title'];?></option>
									<?php 
										//}
									}?>
								</select>
							</label>
						</div>
					</div>
					<div class="row ">
						<div class="col-md-6">
							<label class="view-mob">Country Preference</label>
							<?php 								
								if($exp_country_preference[0] != '' || $exp_country_preference[0] != NULL)
								{									
							?>
							<style>
								.chosen-with-drop .chosen-drop{ display:none!important;}
								.search-choice-close,.chosen-search-input{display: none!important;}
							</style>
							<?php
								}
								else
								{
									$rd = '';
								}
								?>
							<select id="optgroup_clickable" class="form-control form-control-chosen-optgroup" title="clickable_optgroup" 
								name="txt_country[]"  data-placeholder="Country Preference" multiple>
								<option  class="cursor-co" >Country Preference </option>
								<?php $area_study = "select * from country where market_group is not null order by country ";
									$qry_area_study 		= pg_query(fnconnect_aws(),$area_study);
									while($res_area_study 	= pg_fetch_array($qry_area_study)){
									?>
								<option value="<?php echo $res_area_study['country'];?>" <?php 
									if(in_array($res_area_study['country'], $exp_country_preference)){ echo 'selected';}
									?>><?php echo $res_area_study['country'];?></option>
								<?php }?>
							</select>
						</div>						
						<div class="col-md-6">
							<label  class="custom-dropdown">
							<select required name="txt_year" id="txt_year">
                              <option value="">Admission Year </option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                            </select>
							</label>
						</div>
					</div>
					
					
					<div class="row ">
						<div class="col-md-6">
							<label class="custom-dropdown"  >
								<?php 
							
									if($peventid == 'SUB052002')
									{
										 $cselected1='selected';
										 $creadonly_new1 = '';
										 
										 $cselected2='';
										 $creadonly_new2 = 'disabled';
										 
										 $cselected3='';
										 $creadonly_new3 = 'disabled';
									}
									
									if($peventid == 'SUB052003')
									{
										 $cselected1='';
										 $creadonly_new1 = 'disabled';
										 
										 $cselected2='selected';
										 $creadonly_new2 = '';
										 
										 $cselected3='';
										 $creadonly_new3 = 'disabled';
									}
									
									if($peventid == 'SUB052004')
									{
										 $cselected1='';
										 $creadonly_new1 = 'disabled';
										 
										 $cselected2='';
										 $creadonly_new2 = 'disabled';
										 
										 $cselected3='selected';
										 $creadonly_new3 = '';
									}	


									if($peventid == 'SUB062001')
									{
										 $cselected1='';
										 $creadonly_new1 = 'disabled';
										 
										 $cselected2='';
										 $creadonly_new2 = 'disabled';
										 
										 $cselected3='';
										 $creadonly_new3 = 'disabled';
										 
										 $cselected4='selected';
										 $creadonly_new4 = '';
									}		
								?>					
							
								<select required name="sel_event" id="sel_event" >									
									<option value="">Event</option>
									<!--<option value="SUB052002" <?php echo $cselected1; echo ' '.$creadonly_new1;?>>Computing and IT</option>-->
									<!--<option value="SUB052003" <?php echo $cselected1; echo ' '.$creadonly_new1;?>>Management and Business Studies</option>-->
									<!--<option value="SUB052004" <?php echo $cselected3; echo ' '.$creadonly_new3;?>>Sciences</option>	-->
									<option value="SUB062001" <?php echo $cselected4; echo ' '.$creadonly_new4;?>>Humanity and Sciences</option>								
								</select>								
							</label>
						</div>
						<div class="col-md-6">
							<label  class="custom-dropdown">
								<?php 
									if($time_slot == '04:00 PM - 07:00 PM')
									{
										 $selected_ts1='selected';
										 $readonly_new_ts1 = '';										 
									}
									
									?>
								<select required name="txt_timeslot" id="txt_timeslot">
									<option value="">Time Slot</option>
									<option value="04:00 PM - 07:00 PM" <?php echo $selected_ts1; echo ' '.$readonly_new_ts1;?>>04:00 PM - 07:00 PM</option>									
								</select>
							</label>
						</div>
					</div>				
					
					<div class="row ">
						<div class="col-md-6">
							<label class="custom-dropdown"  >
								<select required name="txt_city" id="txt_city" >
									<option value="">Your Nearest Branch</option>
									<?php
										
										/*$area_study = "select distinct compmast.compid,compmast.name||' - '||substr(b.name,24) as venue,starttime from vcstaffnews
										join compmast on compmast.compid=vcstaffnews.hotelid
										join compmast as b on b.compid=vcstaffnews.branch
										 where eventname ilike '%GEI-XXXV%' order by starttime";*/
										$area_study = "select distinct compmast.compid,citymast.city, substr(compmast.name,24) as branchname from compmast 
										join citymast on citymast.cityid=compmast.cityid
										where  compmast.compid in (23918,9327,10179,10170,12531,28298,947,17006,9329,50161,9328,38782,38798,38764,56619,38971,22690,23011,39283,39210,203699,9989) order by branchname";
										$qry_area_study = pg_query(fnconnect_aws(),$area_study);
										while($res_area_study = pg_fetch_array($qry_area_study)){
										
										if($event_venue_id != ''){
											if($res_area_study['compid'] == $event_venue_id)
											{
												 $selected='selected';
												 $readonly_new = '';
											}
											else
											{
												$selected = '';
												//$readonly_new = 'disabled';
												$readonly_new = '';
											}
										}												
											
										?>
										<option value="<?php echo $res_area_study['city']."*".$res_area_study['compid']."*".$res_area_study['branchname'];?>" <?php echo $readonly_new;  echo ' '.$selected; ?>><?php echo $res_area_study['branchname'];?></option>
									<?php  }?>
								</select>
							</label>
						</div>
						<div class="col-md-6">
							
						</div>
					</div>
					
					<div id="openid" style="width:100%"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="bordesign-row row padding0">
								<div class="badge">I would like to</div>
								<div class="form-check-inline col">
									<label class="form-check-label">
									<input type="radio" class="form-check-input" value="Self Fast Track" name="optradio" required >Fast Track
									<a class="tooltip fade info-i" data-title="Fast track your way directly to university desks you choose, you are eligible for and you are interested in" >i</a>
									</label>
								</div>
							<!--	<div class="form-check-inline col">
									<label class="form-check-label">
									<input type="radio" class="form-check-input" value="Meet RM at the Venue" name="optradio" required>Connect with Relationships Team 
									</label>
								</div> -->
							</div>
						</div>
					</div>
					<p></p>
					<div class=" text-center">
						<p></p>
						<p></p>
						<p></p>
						<button type="submit" class="btn btn-custom btn-shadow " name="btn_register" id="btn_register" value="Register" onClick="return check();">Submit</button>						
					</div>					
				</form>
			</Div>
		</section>
		<footer>
			<div class="container ">
				<div class="row">
					<div class="col-md-6">
						©2019 The Chopras Global Holdings PTE Ltd
					</div>
					<div class="col-md-6">
						<div class="icons_social float-right">
							<a href="https://twitter.com/tcglobalite" target="_blank" >
								<div class="twitter"></div>
							</a>
							<a href="https://www.instagram.com/tcglobalofficial/" target="_blank" >
								<div class="youtube"></div>
							</a>
							</a>
							<a href="https://www.facebook.com/tcglobalofficial/" target="_blank">
								<div class="fb"></div>
							</a>
							
						</div>
						<div class="float-right ">Connect with us</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="myModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content bmd-modalContent">
						<div class="modal-body">
							<div class="close-button">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" frameborder="0"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- Return to Top -->
		<a href="javascript:" id="return-to-top"></a>
		<!--<view-webonly>-->
		<div class="helpchat">	
		</div>
		<button class="phonechat"></button>
		<div id="div1" >7428601500</div>
		<!--<view-moblietab-only>-->
		<div class="moblie-chat-icon">
			<ul>				
				<li class="entypo-helpchat"></li>
			</ul>
		</div>
	</body>
	<script src="bootstrap/js/jquery.min.js"></script>
	<script src="scroll/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/chosen.jquery.min.js"></script>
	<script src="bootstrap/js/custom-script.js"></script>
	<!-- Start of thechoprassupport Zendesk Widget script -->
	<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=dc7656d1-f86f-4a8f-940f-698fe6b1a867"> </script>
	<!-- End of thechoprassupport Zendesk Widget script -->	
	<script>
		zE('webWidget', 'hide');
		
		$('.helpchat,.entypo-helpchat').click(function(){
			javascript:void($zopim.livechat.window.show());
			zE(function() 
			{
				zE.hide();
				zE.activate({hideOnClose: true});
			});
		});
		
		$(document).ready(function(){
			$('[data-toggle="popover"]').popover(); 
		});
		
		
		function check(){		
			if(($('#txt_fname').val()!=='')&&($('#txt_lname').val()!=='')&&($('#txt_email').val()!=='')&&($('#txt_mobile').val()!=='')&&($('#txt_level').val()!=='')&&($('#txt_area').val()!=='')){
				if($('#optgroup_clickable').val()==null){
				 alert('Please select at least one country.');
				 return false;
				}
				else{
				 return true;
				}
			}
		}	
	</script>
	<script>
		function SetProspectID(){
		    if (typeof(MXCProspectId) !== "undefined")
			//alert("ok")
		    jQuery('input[name="ProspectID"]').attr('value',
			MXCProspectId); 
		}
		
		window.onload = function() {
		    setTimeout (SetProspectID ,
			2000);   
		
		};		
	</script>
	<!--LeadSquared Tracking Code Start-->
	<script type="text/javascript" src="https://web-in21.mxradon.com/t/Tracker.js"></script>
	<script type="text/javascript">
		pidTracker('38230');
	</script>
	<!--LeadSquared Tracking Code End-->
</html>

