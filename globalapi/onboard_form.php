<?php 
/*
$nearest_center="Bangalore";
$level_of_study="Summer School";
$adminssion_year="2020";
$in_take="Aug-Nov";
$area_of_study="Law & Legal Studies";
$country_preference="New Zealand;Singapore";
$current_level_of_study="Ph.d";
$objective="World Class Education Experience,Short-medium term work experience,International Exposure";
$prefered_time="Afternoon (Midday - 4PM)";
$perfered_contact="Phone";
$ipAddress="";
$lead_id="45";
 $lead_email="riteshtesting@test.com";
$ProspectID="68cf96a7-e157-43e9-be7a-41eff51762e4";
$available_from_date=date("Y-m-d H:i:s",strtotime("26-Dec-2019"));                                                                                       
$purpose="Global Ed";
$lead_type="GlobalLearning";
*/

$nearest_center=$_REQUEST['nearest_center'];
if(empty($nearest_center))
{
	
	$nearest_center="NCR Delhi";
}
$level_of_study=$_REQUEST['level_of_study'];
$adminssion_year=$_REQUEST['adminssion_year'];

if(empty($adminssion_year)) {
   $adminssion_year='null';
}
$in_take=$_REQUEST['in_take'];
$area_of_study=$_REQUEST['area_of_study'];
$country_preference1=$_REQUEST['country_preference'];

$country_preference=str_replace(",",";",$_REQUEST['country_preference']);

$current_level_of_study=$_REQUEST['current_level_of_study'];
$objective=$_REQUEST['objective'];
//$objective=implode(',',$objective1);
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
if($lead_type=="GlobalEd")
{
$services="Global Education";	
} else if($lead_type=="GlobalLearning") {
	$services="Global Learning";	
}




/* $nearest_center="Bangalore";
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
*/
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
	
	if($lead_email=="rajeevm@tcglobal.com"){
		include('onboard_formtest.php');
		die;
	}
	
	
	
	
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
			//$services	= $data[0]->mx_Service_or_Product;
		    //$mobile[1];
			//$st = $data->Status;			
			//if($st=='Su')
}

	
include_once 'config/database.php';
include_once 'objects/student.php';
include_once 'objects/arealevelmain.php';

if(strtolower(trim($nearest_center))== "ahmedabad"){
		$city	= "Ahmedabad";
		$branch = "23918"; ;
		$venue	= "The Chopras Office Ahmedabad";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Ahmedabad/@23.0411986,72.5233778,17z/data=!3m1!4b1!4m5!3m4!1s0x395e9b4ceaaaaaab:0xbfb1bfbeec5d90dc!8m2!3d23.0411986!4d72.5255665";
	}
	
	if(strtolower(trim($nearest_center))== "bangalore"){
		$city	= "Bangalore";
		$branch = "9327";
		$venue	= "The Chopras Office Bangalore";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Bangalore&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj_tavR5a_mAhWBoOkKHW5BBf0Q_AUoAXoECBAQAw";
	}
	
	if(strtolower(trim($nearest_center))=="chandigarh"){
		$city	= "Chandigarh";
		$branch = "10179";
		$venue	= "The Chopras Office Chandigarh";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Chandigarh&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj2k9bs5a_mAhUfzDgGHeU6CG4Q_AUoAXoECBcQAw";
	}
	
	if(strtolower(trim($nearest_center))== "chennai"){
		$city	= "Chennai";
		$branch = "10170";
		$venue	= "The Chopras Office Chennai";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Chennai/@13.0546247,80.2469559,17z/data=!3m1!4b1!4m5!3m4!1s0x110565cd1712fdff:0x6d4d36694932eedf!8m2!3d13.0546247!4d80.2491446";
	}
	
	if(strtolower(trim($nearest_center))== "cochin"){
		$city	= "Cochin";
		$branch = "12531";
		$venue	= "The Chopras Office Cochin";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Cochin&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiZt6aQ5q_mAhXHzjgGHUrfBtcQ_AUoAXoECBEQAw";
	}
	
	if(strtolower(trim($nearest_center))=="coimbatore"){
		$city	= "Coimbatore";
		$branch = "28298";
		$venue	= "The Chopras Office Coimbatore";
		$dt		= "2019-11-06 11:00:00";
		$dt1	= "2019-11-06";
		$cal	= "";
		$map	= "";			
		$map	= "https://www.google.com/maps/place/The+Chopras+Coimbatore/@11.008926,76.9777943,17z/data=!3m1!4b1!4m5!3m4!1s0x3ba859b1624a4797:0x3c9255ca0e7fcd3e!8m2!3d11.008926!4d76.979983";
	}

	if(strtolower(trim($nearest_center))=="dehradun"){
		$city	= "Dehradun";
		$branch = "203699";
		$venue	= "The Chopras Office Dehradun";
		//$dt		= "2019-11-06 11:00:00";
		//$dt1	= "2019-11-06";
		$cal	= "";
		$map	= "";			
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Dehradun&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiz8Oet56_mAhUKzjgGHRPbCpsQ_AUoAXoECBMQAw";	
	}			

	if(strtolower(trim($nearest_center))== "hyderabad"){
		$city	= "Hyderabad";
		$branch = "9329";
		$venue	= "The Chopras Office Hyderabad";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Hyderabad&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjYm52356LmAhUZyzgGHWv3DNoQ_AUoAXoECBQQAw";
	}
	
	if(strtolower(trim($nearest_center))=="jaipur"){
		$city	= "Jaipur";
		$branch = "50161";
		$venue	= "The Chopras Office Jaipur";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Jaipur&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj4_YbN56LmAhUOzTgGHegwBUcQ_AUoAXoECBUQAw";
	}		
		
	if(strtolower(trim($nearest_center))=="kolkata"){
		$city	= "Kolkata";
		$branch = "9328";
		$venue	= "The Chopras Office Kolkata";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Kolkata/@22.5435347,88.3495704,17z/data=!3m1!4b1!4m5!3m4!1s0x3a0277170b6626c9:0xefffd6c7142169b0!8m2!3d22.5435298!4d88.3517591";
	}
	
	if(strtolower(trim($nearest_center))=="lucknow"){
		$city	= "Lucknow";
		$branch = "38782";
		$venue	= "The Chopras Office Lucknow";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Lucknow&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiBherJ6K_mAhXvzjgGHU0yDS4Q_AUoAXoECA8QAw";
	}
	
	if(strtolower(trim($nearest_center))=="ludhiana"){
		$city	= "Ludhiana";
		$branch = "9989";
		$venue	= "The Chopras Office Ludhiana";
		//$dt	= "2019-11-09 11:00:00";
		//$dt1	= "2019-11-09";
		$cal	= "";
		$map	= "https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Ludhiana&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiF8MDp6K_mAhWFxjgGHfSzC1IQ_AUoAXoECBQQAw";
	}
	
	if(strtolower(trim($nearest_center))=="mangalore"){
		$city	= "Mangalore";
		$branch = "38798";
		$venue	= "The Chopras Office Mangalore";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		
		$map	="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Mangalore&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwigz5aC6a_mAhW-wjgGHWsJD4EQ_AUoAXoECBEQAw";
	}
	
	if(strtolower(trim($nearest_center))== "ncr delhi"){
		$city	= "NCR Delhi ";
		$branch = "947";
		$venue	= "The Chopras Office NCR Delhi ";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
			$map	= "https://www.google.com/maps/place/The+Chopras+New+Delhi/@28.549669,77.2479983,17z/data=!3m1!4b1!4m5!3m4!1s0x390d0372ba63dfa9:0x1b17ecd288ec1659!8m2!3d28.549669!4d77.250187";
	}	

	if(strtolower(trim($nearest_center))=="ncr north delhi"){
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

	if(strtolower(trim($nearest_center))=="ncr gurgaon"){
		$city	= "NCR Gurgaon";
		$branch = "17006";
		$venue	= "The Chopras Office NCR Gurgaon";
		//$dt	= "2019-11-02 11:00:00";
		//$dt1	= "2019-11-02";
		$cal="";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Gurgaon&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjjnpCD6KLmAhXgzjgGHYnaBqYQ_AUoAXoECBQQAw";
	}	

	if(strtolower(trim($nearest_center))=="mumbai andheri"){
		$city	= "Mumbai Andheri West";
		$branch = "38764";
		$venue	= "The Chopras Office Mumbai Andheri West";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-10";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Mumbai+Andheri/@19.0251709,72.6954227,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3be7c9d10da487eb:0xa286e353edfbcf92!8m2!3d19.1195122!4d72.843956";
	}

	if(strtolower(trim($nearest_center))== "mumbai churchgate"){
		$city	= "Mumbai Churchgate ";
		$branch = "5669";
		$venue	= "The Chopras Office Mumbai Churchgate ";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Churchgate+Mumbai/@19.0257146,72.6954218,11z/data=!4m8!1m2!2m1!1sthe+chopras+mumbai!3m4!1s0x3a27af00c0062751:0xda859746bb6f080d!8m2!3d18.930286!4d72.827068";
	}		
	
	if(strtolower(trim($nearest_center))=="pune"){
		$city	= "Pune";
		$branch = "22690";
		$venue	= "The Chopras Office Pune";
		//$dt	= "2019-11-10 11:00:00";
		//$dt1	= "2019-11-02";
		$cal	= "";
		$map	= "https://www.google.com/maps/place/The+Chopras+Pune/@18.5201404,73.8435366,17z/data=!3m1!4b1!4m5!3m4!1s0x3bc2bf87f9a71785:0x16017dfcca2a8a64!8m2!3d18.5201353!4d73.8457253";
	}
	
	if(strtolower(trim($nearest_center))=="trivandrum"){
		$city	= "Trivandrum";
		$branch = "23011";
		$venue	= "The Chopras Office Trivandrum";
		//$dt	= "2019-11-04 11:00:00";
		//$dt1	= "2019-11-04";
		$cal	= "";
		$map="https://www.google.com/maps?client=firefox-b-d&q=The+Chopras+Trivandrum&uact=5&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiNpI7B6a_mAhW9yjgGHdUuBA4Q_AUoAXoECBAQAw";
	}		

	if(strtolower(trim($nearest_center))=="vijayawada"){
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
$user = new User($db_ccpl);
$data = $user->GetStudentID($lead_email,$mobileNumber);

$db_ccpl1 = $database->getConnection();

$user1 = new AreaLevel($db_ccpl1);

$area = $user1->AreaofstudyByTitle($area_of_study);
$level = $user1->LevelofstudyByLevel($current_level_of_study);
$preferred_intake = $user1->admissionyearByTitle($preferredintake);


//$branchid='947';
$pcounsel=$user->branchhead($branch);
$aos=$area['id'];
$lvl=$level['levelid'];
$semester=$preferred_intake['semid'];

//unset($db_ccpl1);;
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
$pcounsel= $data[5];

if(empty($studentID))
{
$city="Others";
$cityid=1848;
}

if(!empty($studentID) && (!empty($datereg) || !empty($onboarddate)))
{
						//echo "OLd Stud"; exit;
							//$studid=$studid[0];
 $sql="update studmast SET  fname='$FirstName',lname='$LastName', nearestbranchid=$branch,cityid=$cityid, ls_prospectid='$ProspectID',onboarddate=now(),lev='$lvl',semester='$semester' where studid=$studentID"; //exit;
		$stmt = $db_ccpl->prepare($sql);
 
			 $stmt->execute();
    
	} else {
 $query="Insert into studmast(fname,lname, mobile,email,cityid,pcounsel,onboarddate,datecame,
		dateentered,modecame,nearestbranchid,ls_prospectid,lev,semester)values('$FirstName','$LastName','$mobileNumber','$lead_email',$cityid,$pcounsel,now(),now(),now(),17,$branch,'$ProspectID','$lvl','$semester') RETURNING studid"; 
		$stmt = $db_ccpl->prepare($query); 
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
 $query1="INSERT INTO webquery(studid,name,email,phone,city,entereddate,remarks,maincategary,subcategary,type,branch,fname,lname) values($studentID,'$FirstName $LastName','$lead_email',$mobileNumber,$city,'now(),'tcglobal','tcglobal','tcglobalnewsite','Website',$cityid,'$FirstName','$LastName')"; 	//webquery
$stmt1 = $db_ccpl->prepare($query1); 
			 $stmt1->execute();
			

//counselling record
$query2="Insert into CounRec (Date,StudID, InOut,EmpID,Mode,InterviewID,Remarks) values(current_date,$studentID,1,1058,17,null,'Firstname:".$FirstName.'||Lastname:'.$LastName.'||Email:'.$lead_email.'||Phone:'.$mobileNumber.'||Branch:'.$branch."|Website||tcglobalnewsite||Pref Contact:".$perfered_contact.'||Pref Contact Time:'.$prefered_time.'||Pref Country:'.$country_preference.'||Pref Objective:'.$objective.'||Available date:'.$available_from_date.'||Purpose:'.$purpose."')";
						
$stmt2 = $db_ccpl->prepare($query2); 
			 $stmt2->execute();
			 
			 
			 //callback
			 $query3 ="Insert into callback (studid,empid,msg,callbackdate,enterby,entertime,source,webquery)values($studentID,$pcounsel,'Pref Contact:".$perfered_contact.'||Pref Contact Time:'.$prefered_time.'||Pref Country:'.$country_preference.'||Pref Objective:'.$objective.'||Available date:'.$available_from_date.'||Purpose:'.$purpose."',now(),1487,now(),'Webquery',true)";
			$stmt3 = $db_ccpl->prepare($query3);
			$stmt3->execute();
	
///////////////////////interest  currentlevel and expected date////////////////////////////////////
	$spldata_current_level= "select * from interests where studid=$studentID and current_level_of_study is not null LIMIT 1";
							
          $stmt = $db_ccpl->prepare($spldata_current_level); 
			 $stmt->execute();
	
		$numRows = $stmt->rowCount();
				
		
	if($numRows <=0){
		
	$insert_current_level = "insert into interests (current_level_of_study,expected_date,studid) values('$clevel','$expectedtocomplete',$studentID)";
	  $stmt = $db_ccpl->prepare($insert_current_level); 
			 $stmt->execute();
	} else {
   $update_current_level = "update interests SET current_level_of_study='$clevel',expected_date='$expectedtocomplete' where studid=$studentID and current_level_of_study is not null";
	$stmt = $db_ccpl->prepare($update_current_level); 
			 $stmt->execute();
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////interest  level ////////////////////////////////////
	$spldata_level="select levelid from interests where studid=$studentID and levelid is not Null";						

   $stmt = $db_ccpl->prepare($spldata_level); 
			 $stmt->execute();
	
		$numRows = $stmt->rowCount();
	if($numRows <=0){
		
	$insert_level = "insert into interests (levelid,studid) values('$lvl',$studentID)";
	 $stmt = $db_ccpl->prepare($insert_level); 
			 $stmt->execute();
	} else {
   $update_level = "update interests SET levelid='$lvl' where studid=$studentID and levelid is not null";
	 $stmt = $db_ccpl->prepare($update_level); 
			 $stmt->execute();
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////

	///////////////////////interest  intake ////////////////////////////////////
	$spldata_intake="select intake from interests where studid=$studentID and intake is not Null";						

    $stmt = $db_ccpl->prepare($spldata_intake); 
			 $stmt->execute();
	$numRows = $stmt->rowCount();
	if($numRows <=0){
		
	$insert_intake = "insert into interests (intake,studid) values('$semester',$studentID)";
	
    $stmt = $db_ccpl->prepare($insert_intake); 
			 $stmt->execute();
	} else {
   $update_intake = "update interests SET intake='$semester' where studid=$studentID and intake is not null";
	 $stmt = $db_ccpl->prepare($update_intake); 
			 $stmt->execute();
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////


///////////////////////interest  area study ////////////////////////////////////
	$spldata_study_area="select study_area from interests where studid=$studentID and study_area is not Null";						

   $stmt = $db_ccpl->prepare($spldata_study_area); 
			 $stmt->execute();
	$numRows = $stmt->rowCount();
	if($numRows <=0){
		
	$insert_study_area = "insert into interests (study_area,studid) values('$aos',$studentID)";
	  $stmt = $db_ccpl->prepare($insert_study_area); 
			 $stmt->execute();
	} else {
   $update_study_area = "update interests SET study_area='$aos' where studid=$studentID and study_area is not null";
	 $stmt = $db_ccpl->prepare($update_study_area); 
			 $stmt->execute();
				//$msg='Form has been submitted successfully';
	}
///////////////////////////////////////////////////////////////////////////////////////
////////////////interest services///////////////////
	$spldata_services= "select * from interests where studid =$studentID and services is not null LIMIT 1";
	 $stmt = $db_ccpl->prepare($spldata_services); 
			 $stmt->execute();
	$numRows = $stmt->rowCount();
	if($numRows <=0){
		
	$insert_services = "insert into interests (services,studid) values('$services',$studentID)";
	 $stmt = $db_ccpl->prepare($insert_services); 
			 $stmt->execute();
	} else {
 $update_services = "update interests SET services='$services' where studid=$studentID and services is not null";
$stmt = $db_ccpl->prepare($update_services); 
			 $stmt->execute();
	}
	////////////////interest objective///////////////////
	
	$arrayobjective=explode(',',$objective);

	for($x=0;$x < count($arrayobjective);$x++)
	{
		//echo $x;
		//echo $arrayobjective[$i];
	$obectiveid[$x]=$user1->ObjectiveByName($arrayobjective[$x]);
	
	$spldata_objective= "select * from interests where studid =$studentID and objective_name is not null and objective_id='$obectiveid[$x]'";
	 $stmt = $db_ccpl->prepare($spldata_objective); 
			 $stmt->execute();
	$numRows = $stmt->rowCount();
	if($numRows <=0){
		
	$insert_objective = "insert into interests (objective_id,objective_name,studid) values('$obectiveid[$x]','$arrayobjective[$x]',$studentID)";
	 $stmt1 = $db_ccpl->prepare($insert_objective); 
			 $stmt1->execute();
	} else {
$update_objective = "update interests SET objective_name='$arrayobjective[$x]',objective_id='$obectiveid[$x]'  where studid=$studentID and objective_id='$obectiveid[$x]'";
$stmt2 = $db_ccpl->prepare($update_objective); 
			 $stmt2->execute();
	}
  }
  
  ////////////////interest country///////////////////
	
	$arraycountry=explode(';',$country_preference);

	for($y=0;$y < count($arraycountry);$y++)
	{
		//echo $x;
		//echo $arrayobjective[$i];
	$countryid[$y]=$user1->CountryIdByName($arraycountry[$y]);
	
 $spldata_country= "select * from interests where studid =$studentID and countryname is not null and country='$countryid[$y]'";
	 $stmt3 = $db_ccpl->prepare($spldata_country); 
			 $stmt3->execute();
	$numRows1 = $stmt3->rowCount();
	if($numRows1 <=0){
		
$insert_country = "insert into interests (country,countryname,studid) values('$countryid[$y]','$arraycountry[$y]',$studentID)";
	 $stmt4 = $db_ccpl->prepare($insert_country); 
			 $stmt4->execute();
	} else {
$update_country = "update interests SET countryname='$arraycountry[$y]',country='$countryid[$y]'  where studid=$studentID and country='$countryid[$y]'";
$stmt5 = $db_ccpl->prepare($update_country); 
			 $stmt5->execute();
	}
  }
  
	
$data=array('status' => 'true','message' => 'Mail sent successfully');
echo $json_encode=json_encode($data);
	
	}
					

	
		
							
} 
	

?>
