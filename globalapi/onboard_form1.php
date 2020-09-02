<?php //$data=array('status' => 'false','message' => 'error');
//echo $json_encode=json_encode($data);exit;
/*
"nearest_center":"New Delhi",
"level_of_study":"Postgrad",
"adminssion_year":"2019",
"in_take":"Dec-Mar",
"area_of_study":"Arts & Social Sciences",
"country_preference":"Australia, India",
"current_level_of_study":"12th Grade",
"objective":"Migration, Other",
"prefered_time":"Afternoon (Midday-4PM)",
"perfered_contact":"Phone",
"ipAddress":"190.135.254.251",
"lead_id":"45",
"lead_email":"dhibakar@yopmail.com",
"available_from_date":"",
"purpose":"",
"ProspectID":"68cf96a7-e157-43e9-be7a-41eff51762e4",
"lead_type":"GlobalE"*/
/*$nearest_center="New Delhi";
$level_of_study="Postgrad";
$adminssion_year="2019";
$in_take="Dec-Mar";
$area_of_study="Arts & Social Sciences";
$country_preference="Australia, India";
$current_level_of_study="12th Grade";
$objective="Migration, Other";
$prefered_time="Afternoon (Midday-4PM)";
$perfered_contact="Phone";
$ipAddress="190.135.254.251";
$lead_id="45";
$lead_email="dhibakar@yopmail.com";
$ProspectID="68cf96a7-e157-43e9-be7a-41eff51762e4";
$available_from_date="";
$purpose="";
$lead_type="GlobalEd";
*/



$nearest_center=$_REQUEST['nearest_center'];
$level_of_study=$_REQUEST['level_of_study'];
$adminssion_year=$_REQUEST['adminssion_year'];
$in_take=$_REQUEST['in_take'];
$area_of_study=$_REQUEST['area_of_study'];
$country_preference=$_REQUEST['country_preference'];
$current_level_of_study=$_REQUEST['current_level_of_study'];
$objective=$_REQUEST['objective'];
$prefered_time=$_REQUEST['prefered_time'];
$perfered_contact=$_REQUEST['perfered_contact'];
$ipAddress=$_REQUEST['ipAddress'];
$lead_id=$_REQUEST['lead_id'];
$lead_email=$_REQUEST['lead_email'];
$ProspectID=$_REQUEST['ProspectID'];
$available_from_date=$_REQUEST['available_from_date'];
$purpose=$_REQUEST['purpose'];
$lead_type=$_REQUEST['lead_type'];

if($nearest_center=='' || $ProspectID=='')
{
$data=array('status' => 'false','message' => 'error');
echo $json_encode=json_encode($data);

}
else
{


include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();


$sql = "INSERT INTO test (nearest_center, level_of_study, adminssion_year,intake,area_of_study,country_preference,current_level_of_study,objective,prefered_time,perfered_contact,lead_id,ipaddress,email,prospect,available_from_date,purpose,lead_type)
VALUES ('".$nearest_center."','".$level_of_study."',".$adminssion_year.",'".$in_take."','".$area_of_study."','".$country_preference."','".$current_level_of_study."','".$objective."','".$prefered_time."','".$perfered_contact."',".$lead_id.",'".$ipAddress."','".$lead_email."','".$ProspectID."','".$available_from_date."','".$purpose."','".$lead_type."')";

$stmt = $db->prepare( $sql );
$stmt->execute();

if($stmt)
{

$data=array('status' => 'true','message' => 'Mail sent successfully');
echo $json_encode=json_encode($data);

}
}
