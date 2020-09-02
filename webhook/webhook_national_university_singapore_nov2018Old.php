<?php 
	
	include_once('config.php');
	$class=new webconfig();
	$class->DBConnect();
		
	$fname=rawurldecode(trim($_GET['first_name']));
	//$name=((empty($name))?'NULL':"'".$name."'");
	$lname=rawurldecode(trim($_GET['last_name']));
	//$lname=((empty($lname))?'NULL':"'".$lname."'");
	
	$name= "'".$fname." ".$lname"'";
	
	$email=  rawurldecode(trim($_GET['email']));//'rknirala@gmail.com';//
	$email=((empty($email))?'NULL':"".$email."");
	$mobile= rawurldecode(trim($_GET['phone_number']));// '+919868060720' ;'+919716675977'; //
	//$mobile=((empty($m))?'NULL':"".$m."");
	//$adset_name=rawurldecode(trim($_GET['adset_id']));
	$adset_name=rawurldecode(trim($_GET['adset_name']));
	$adset_name=((empty($adset_name))?'NULL':"'".$adset_name."'");	
	$mobile=   rawurldecode(trim($_GET['phone_number']));//'+919958853452' ;//'+919868060720' ;//
	$mobile = str_replace(' ', '', $mobile);
	//$mobile=((empty($m))?'NULL':"".$m."");
	$mobile = substr($mobile,-10);
	$phone= $mobile ;
	$cityid=rawurldecode(trim($_GET['city'])); //City
	//$cityid=((empty($c))?'NULL':"'".$c."'");
	$city_name = $cityid;
	
	$getcnt = "select * from citymast where city ilike '$cityid' and done=true";
	$cid=pg_query($getcnt);
	$re=pg_fetch_array($cid);
	$cit=$re['cityid'];
	$cityid=(empty($cit)?1848:$cit);

	$pcounselor=4363;		
	
	
	//LeadsBridge --- Study Abroad
	$maincategary="Facebook";
	$subcategary="FB-Leadsbbridge-NUS-Nov18";
	$Paid = "Paid";		
	$quest='FB-Leadsbbridge-NUS-Nov18'.$maincategary;
	$remarks = 'FB-Leadsbbridge-NUS-Nov18';
	$queryInsert="INSERT INTO webquery(name,phone,email,city,question,entereddate,maincategary,subcategary,remarks,type,adset_name)
	values($name,$phone,'$email',$cityid,'$quest',now(),'$maincategary','$subcategary','$remarks','$Paid','$adset_name')";
	$resultInsert=pg_query($queryInsert) ;
	
?>	

