<?php 
/*
$nearest_center="Chandigarh";
$level_of_study="";
$adminssion_year="";
$in_take="";
$area_of_study="";
$country_preference="";
$current_level_of_study="";
$objective="";
$prefered_time="";
$perfered_contact="";
$ipAddress="";
$lead_id="45";
$lead_email="riteshkdastest@gmail.com";
$ProspectID="68cf96a7-e157-43e9-be7a-41eff51762e4";
$available_from_date=date("Y-m-d H:i:s",strtotime("25-Dec-2019"));                                                                                       
$purpose="Career+Selection";
$lead_type="GlobalLearning";
*/
/*$nearest_center=$_REQUEST['nearest_center'];
$level_of_study=$_REQUEST['level_of_study'];
$adminssion_year=$_REQUEST['adminssion_year'];

if(empty($adminssion_year)) {
   $adminssion_year='null';
}
$in_take=$_REQUEST['in_take'];
$area_of_study=$_REQUEST['area_of_study'];
$country_preference1=$_REQUEST['country_preference'];
if(!empty($country_preference1)) {

$country_preference = implode(';', $country_preference1); 
}
$current_level_of_study=$_REQUEST['current_level_of_study'];
$objective=$_REQUEST['objective'];
$prefered_time=$_REQUEST['prefered_time'];
$perfered_contact=$_REQUEST['perfered_contact'];
$ipAddress=$_REQUEST['ipAddress'];
$lead_id=$_REQUEST['lead_id'];
$lead_email=$_REQUEST['lead_email']; 
$ProspectID=$_REQUEST['ProspectID'];
if($_REQUEST['available_from_date']!="")
{
$available_from_date1=$_REQUEST['available_from_date'];
$available_from_date=date("Y-m-d H:i:s",strtotime($available_from_date1));
}else{
	$available_from_date="";
}
$purpose=$_REQUEST['purpose'];
$lead_type=$_REQUEST['lead_type'];

*/
$nearest_center="Bangalore";
$level_of_study="Summer School";
$adminssion_year="2021";
$in_take="Aug - Nov";
$area_of_study="Teaching & Education";
$country_preference1=array("Ireland","USA");
if(!empty($country_preference1)) {

$country_preference = implode(';', $country_preference1); 
}

$current_level_of_study="Post Graduate";
$objective="Short-medium term work experience";

$prefered_time="Afternoon (Midday - 4PM)";
$perfered_contact="Phone";
$ipAddress="";
$lead_id="45";
$lead_email="riteshkdastest11@gmail.com";
$ProspectID="68cf96a7-e157-43e9-be7a-41eff51762e4";

$available_from_date="";
                                                                                     

$lead_type="GlobalEd";
$expectedtocomplete='';
/*
$nearest_center=$_REQUEST['nearest_center'];
$level_of_study=$_REQUEST['prefferd_level_study'];
$adminssion_year=$_REQUEST['prefferd_year_admission'];

if(empty($adminssion_year)) {
   $adminssion_year='null';
}
$in_take=$_REQUEST['prefferd_intake'];
$area_of_study=$_REQUEST['prefferd_area_study'];
$country_preference=$_REQUEST['prefferd_global_ed_destination'];
$current_level_of_study=$_REQUEST['current_level_study'];
$objective=$_REQUEST['global_ed_objective'];
$prefered_time=$_REQUEST['prefferd_time_contact'];
$perfered_contact=$_REQUEST['prefferd_mode_contact'];
$ipAddress=$_REQUEST['ipAddress'];
$lead_id=$_REQUEST['lead_id'];
$lead_email=$_REQUEST['lead_email']; 
$ProspectID=$_REQUEST['ProspectID'];
$available_from_date1="31-Dec-2019";
$available_from_date=date("Y-m-d H:i:s",strtotime($available_from_date1));
$purpose=$_REQUEST['purpose'];
$lead_type=$_REQUEST['lead_type'];

*/
if($nearest_center=='' || $ProspectID=='' || $lead_email=='')
{
$data=array('status' => 'false','message' =>'error');
echo $json_encode=json_encode($data);
}
else
{
	if($lead_email!="")
		{
		
		//	$id=$_GET['pid'];
		$accessKey = 'u$r9ea451df6581fe0d18b1176a1f6c791f';
		$secretKey = '013726bf5dfbc0c67f68a77d081b0f5941bc6ed4';	


	$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=' . $accessKey . '&secretKey=' . $secretKey .'&emailaddress='.$lead_email; 
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
		    //$mobile[1];
			//$st = $data->Status;			
			//if($st=='Su')
}

	
include_once 'config/database.php';
include_once 'objects/student.php';
include_once 'objects/arealevelmain.php';


$database = new Database();
$db_ccpl = $database->getConnection_CCPL();
$user = new User($db_ccpl);
$data = $user->GetStudentID($lead_email,$mobileNumber);

$db_ccpl1 = $database->getConnection();

$user1 = new AreaLevel($db_ccpl1);

$area = $user1->AreaofstudyByTitle($area_of_study);
$level = $user1->LevelofstudyByLevel($current_level_of_study);
$preferred_intake = $user1->admissionyearByTitle($preferredintake);
$branchid='947';
$pcounsel=$user->branchhead($branchid);



$aos=$area['id'];
$lvl=$level['levelid'];
 $semester=$preferred_intake['semid'];
 
unset($db_ccpl1);;
//exit;
//echo "<pre>";
/*print_r($data);  
print_r($area);
print_r($level);
print_r($preferred_intake);
exit;*/
/*$database1 = new Database1();
$db_aws = $database1->getConnection();
$user1 = new User($db_aws);
	


echo $data1 = $user1->Areaofstudy($area_of_study);exit;*/
//print_r($data);exit;
$studentID=$data[0];
$datereg=$data[1];
$onboarddate=$data[2];
$cityid=$data[3];
$city=$data[4];

if(empty($studentID))
{
$city="Other";
$cityid=2;
}

if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
{
//							echo "OLd Stud"; exit;
							//$studid=$studid[0];
 $sql="update studmast SET  fname='$FirstName',lname='$LastName', nearestbranchid=$branchid,cityid=$cityid, ls_prospectid='$ProspectID',onboarddate=now(),lev='$lvl',semester='$semester' where studid=$studentID"; //exit;
		$stmt = $$db_ccpl->prepare($sql);
 
			 $stmt->execute();
    
	} else {
 $query="Insert into studmast(fname,lname, mobile,email,cityid,pcounsel,onboarddate,datecame,
		dateentered,modecame,nearestbranchid,ls_prospectid,lev,semester)values('$FirstName','$LastName','$mobileNumber','$lead_email',$cityid,$pcounsel,now(),now(),now(),17,'947','$ProspectID','$lvl','$semester') RETURNING studid"; 
		$stmt = $$db_ccpl->prepare($query); 
			 $stmt->execute();
			 $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($rows as $row)
      {
 			echo $studentID=$row['studid'];	
	  }

		
	}
						
			///leadsqaure entereddate
			$accessKey = 'u$r9ea451df6581fe0d18b1176a1f6c791f';
			$secretKey = '013726bf5dfbc0c67f68a77d081b0f5941bc6ed4';	
		
		$url='https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey='. $accessKey . '&secretKey=' . $secretKey;
		     
			
			
		
		    // $pcounsel=branchhead($city);					
			//$_GET['source'] = 'website';
			
			$data_string = '[
			{"Attribute":"SearchBy", "Value": "EmailAddress"},
			{"Attribute":"FirstName", "Value": "'.$FirstName.'"},
			{"Attribute":"LastName", "Value": "'.$LastName.'"},
			{"Attribute":"EmailAddress", "Value": "'.$lead_email.'"},
			{"Attribute":"Phone", "Value": "'.$mobileNumber.'"},		
			{"Attribute":"mx_Level_of_Study", "Value": "'.$level_of_study.'"},	
			{"Attribute":"mx_Area_of_Study", "Value": "'.$area_of_study.'"},	
			{"Attribute":"mx_Preferred_Global_Ed_Destination", "Value": "'.$country_preference.'"},
			{"Attribute":"mx_Last_level_of_Academic_Qualification", "Value": "'.$current_level_of_study.'"},
		      {"Attribute":"mx_Service_or_Product", "Value": "'.$services.'"},	
			{"Attribute": "mx_Preferred_Intake ","Value": "'.$in_take.'"},
			{"Attribute": "mx_Intake_Year","Value": "'.$adminssion_year.'"},			
			{"Attribute":"mx_Preferred_Mode_of_Contact", "Value": "'.$perfered_contact.'"},			
			{"Attribute":"mx_Preffered_time_of_contact", "Value": "'.$prefered_time.'"},		   	
			{"Attribute":"mx_Global_Ed_Objectives", "Value": "'.$objective.'"},			
			{"Attribute":"Source", "Value": "Website"},
			{"Attribute":"mx_choprasleadsource", "Value": "tcglobalnewsite"},
			{"Attribute":"ProspectStage", "Value": "Onboarded"},
			{"Attribute":"mx_Nearest_Branch", "Value": "'.$nearest_center.'"},
			{"Attribute":"mx_English_Language_start_date", "Value": "'.$available_from_date.'"},
			{"Attribute":"mx_English_Language_Purpose", "Value": "'.$purpose.'"}		
			
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
			$data1 = json_decode($json_response);			
	//print_r($data);
			$st = $data1->Status;
	if($st=='Success')
	{
echo $query1="INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,branch,fname,lname) values($studentID,'$FirstName $LastName','$lead_email',$mobileNumber,$city,'now(),'tcglobal','tcglobal','tcglobalnewsite','Website',$cityid,'$FirstName','$LastName')"; exit;	//webquery
pg_query($db_ccpl,$query1); 	 


//counselling record
$query2="Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values(current_date,$studid,1,1058,17,null,'".$FirstName.'||'.$LastName.'||'.$lead_email.'||'.$mobileNumber.'||'.$branch."|Website||tcglobalnewsite||')";
pg_query($db_ccpl,$query2); 						

	
///////////////////////interest  currentlevel and expected date////////////////////////////////////
	$spldata_current_level= "select * from interests where studid=$studentID and current_level_of_study is not null LIMIT 1";
	$qry_current_level= pg_query($db_ccpl,$spldata_current_level);
	$spl_current_level_num =pg_num_rows($qry_current_level);
	if($spl_current_level_num <=0){
		
	$insert_current_level = "insert into interests (current_level_of_study,expected_date,studid) values('$clevel','$expectedtocomplete',$studentID)";
	$res_insert_current_level = pg_query($db_ccpl,$insert_current_level);
	} else {
   $update_current_level = "update interests SET current_level_of_study='$clevel',expected_date='$expectedtocomplete' where studid=$studentID and current_level_of_study is not null";
	$res_update_current_level = pg_query($db_ccpl,$update_current_level);
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////interest  level ////////////////////////////////////
	$spldata_level="select levelid from interests where studid=$studentID and levelid is not Null";						

    $qry_level = pg_query($db_ccpl,$spldata_level);	
	$spl_level_num =pg_num_rows($qry_level);
	if($spl_level_num <=0){
		
	$insert_level = "insert into interests (levelid,studid) values('$lvl',$studentID)";
	$res_insert_level = pg_query($db_ccpl,$insert_level);
	} else {
   $update_level = "update interests SET levelid='$lvl' where studid=$studentID and levelid is not null";
	$res_update_level = pg_query($db_ccpl,$update_level);
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////

	///////////////////////interest  intake ////////////////////////////////////
	$spldata_intake="select intake from interests where studid=$studentID and intake is not Null";						

    $qry_intake = pg_query($db_ccpl,$spldata_intake);	
	$spl_intake_num =pg_num_rows($qry_intake);
	if($spl_intake_num <=0){
		
	$insert_intake = "insert into interests (intake,studid) values('$semester',$studentID)";
	$res_insert_intake = pg_query($db_ccpl,$insert_intake);
	} else {
   $update_intake = "update interests SET intake='$semester' where studid=$studentID and intake is not null";
	$res_update_intake = pg_query($db_ccpl,$update_intake);
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////


///////////////////////interest  area study ////////////////////////////////////
	$spldata_study_area="select study_area from interests where studid=$studentID and study_area is not Null";						

    $qry_study_area = pg_query($db_ccpl,$spldata_study_area);	
	$spl_study_area_num =pg_num_rows($qry_study_area);
	if($spl_study_area_num <=0){
		
	$insert_study_area = "insert into interests (study_area,studid) values('$aos',$studentID)";
	$res_insert_study_area = pg_query($db_ccpl,$insert_study_area);
	} else {
   $update_study_area = "update interests SET study_area='$aos' where studid=$studentID and study_area is not null";
	$res_update_study_area = pg_query($db_ccpl,$update_study_area);
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////
////////////////interest services///////////////////
	$spldata_services= "select * from interests where studid =$studentID and services is not null LIMIT 1";
	$qry_services= pg_query($db_ccpl,$spldata_services);
	$spl_services_num =pg_num_rows($qry_services);
	if($spl_services_num <=0){
		
	$insert_services = "insert into interests (services,studid) values('$services',$studentID)";
	$res_insert_services = pg_query($db_ccpl,$insert_services);
	} else {
   $update_services = "update interests SET services='$services' where studid=$studentID and services is not null";
	$res_update_services = pg_query($db_ccpl,$update_services);
	}
$data=array('status' => 'true','message' => 'Mail sent successfully');
echo $json_encode=json_encode($data);
	
	}
					

	
		
							
} 
	

?>
