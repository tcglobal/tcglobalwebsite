<?php


$var = file_get_contents('php://input');
$dec = json_decode($var,true);

$data = $dec[0]['After'];
$des_data = json_decode($data);

//print_r($des_data);
$userid = $des_data->UserId;


include_once('../config.php');
$class=new webconfig();
$class->DBConnect();

 $chk_user = "select * from user_leadsquare where userid='".$userid."'";
$qry_chk_user = pg_query($chk_user);
 $num_chk_user = pg_num_rows($qry_chk_user);




	

if($num_chk_user <= 0)
{
	$userid=$dec['UserId'];
	$FirstName=rawurldecode(trim($dec['FirstName']));
	$FirstName=((empty($FirstName))?'NULL':"'".$FirstName."'");
	
	$LastName=rawurldecode(trim($dec['LastName']));
	$LastName=((empty($LastName))?'NULL':"'".$LastName."'");
	
	$EmailAddress=rawurldecode(trim($dec['EmailAddress']));
	$EmailAddress=((empty($EmailAddress))?'NULL':"'".$EmailAddress."'");
	
	$Role=rawurldecode(trim($dec['Role']));
	$Role=((empty($Role))?'NULL':"'".$Role."'");
	
	
	$MemberOfGroups=rawurldecode(trim($dec['Groups']));
	
	$imp_MemberOfGroups = implode(',',$arr_MemberOfGroups); 
	
	$MemberOfGroups = $imp_MemberOfGroups;
	
	$MemberOfGroups=((empty($MemberOfGroups))?'NULL':"'".$MemberOfGroups."'");
	
	echo $ins_user = "insert into user_leadsquare (userid,firstname,lastname,emailaddress,role,memberofgroups) values ($userid,$FirstName,$LastName,$EmailAddress,$Role,$MemberOfGroups) ";
		
		pg_query($ins_user);
		
		echo "User data Inserted Successfully";
}
else
{
	
	$FirstName=rawurldecode(trim($des_data->FirstName));
	$FirstName=((empty($FirstName))?'NULL':"'".$FirstName."'");
	
	$LastName=rawurldecode(trim($des_data->LastName));
	$LastName=((empty($LastName))?'NULL':"'".$LastName."'");
	
	$EmailAddress=rawurldecode(trim($des_data->EmailAddress));
	$EmailAddress=((empty($EmailAddress))?'NULL':"'".$EmailAddress."'");
	
	$Role=rawurldecode(trim($des_data->Role));
	$Role=((empty($Role))?'NULL':"'".$Role."'");
	
	
	$MemberOfGroups=rawurldecode(trim($des_data->Groups));
	
	$imp_MemberOfGroups = implode(',',$arr_MemberOfGroups); 
	
	$MemberOfGroups = $imp_MemberOfGroups;
	
	$MemberOfGroups=((empty($MemberOfGroups))?'NULL':"'".$MemberOfGroups."'");


	echo $upd_data = "update user_leadsquare set firstname=$FirstName,lastname=$LastName,emailaddress=$EmailAddress,role=$Role,memberofgroups=$MemberOfGroups where userid='$userid'";
	pg_query($upd_data);
	
	echo "User date Updated Successfully";
}




?>

