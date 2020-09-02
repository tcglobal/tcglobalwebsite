<?php //$data=array('status' => 'false','message' => 'error');
//echo $json_encode=json_encode($data);exit;



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
VALUES ('".$nearest_center."','".$level_of_study."',".$adminssion_year.",'".$in_take."','".$area_of_study."','".$country_preference."','".$current_level_of_study."','".$objective."','".$prefered_time."','".$perfered_contact."',".$lead_id.",'".$lead_email."','".$ProspectID."','".$available_from_date."','".$purpose."','".$lead_type."')";

$stmt = $db->prepare( $sql );
$stmt->execute();

if($stmt)
{

$data=array('status' => 'true','message' => 'Mail sent successfully');
echo $json_encode=json_encode($data);

}
}
