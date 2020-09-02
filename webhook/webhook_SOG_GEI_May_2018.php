<?php 
 //////ggfgdg
include_once('config_sog.php');
$class=new webconfig();
$class->DBConnect();



$name=rawurldecode(trim($_GET['first_name']));
$name=((empty($name))?'NULL':"'".$name."'");
$lname=rawurldecode(trim($_GET['last_name']));
$lname=((empty($lname))?'NULL':"'".$lname."'");
$email= rawurldecode(trim($_GET['email']));//'rknirala@gmail.com';//
$email=((empty($email))?'NULL':"".$email."");
$mobile= rawurldecode(trim($_GET['phone_number']));// '+919868060720' ;//'+919868060720' ;//

//$mobile=((empty($m))?'NULL':"".$m."");
$Interested_in_Pursuing=rawurldecode(trim($_GET['area_of_study']));
$Interested_in_Pursuing =((empty($Interested_in_Pursuing))?'NULL':"".$Interested_in_Pursuing."");

$mobile=   rawurldecode(trim($_GET['phone_number']));//'+919958853452' ;//'+919868060720' ;//
$mobile = str_replace('p:+','', $mobile);
$mobile = str_replace(' ', '', $mobile);
//$mobile=((empty($m))?'NULL':"".$m."");
$mobile = substr($mobile,-10);
$phone= $mobile ;
 $cityid=rawurldecode(trim($_GET['city']));
 
 $venue=$cityid;
//$cityid=((empty($c))?'NULL':"'".$c."'");

$adset= rawurldecode(trim($_GET['adset_id']));


 $getcnt = "select * from citymast where city ilike '$cityid' and done=true";
$cid=pg_query($getcnt);
$re=pg_fetch_array($cid);
echo $cit=$re['cityid'];
$cityid=(empty($cit)?1848:$cit);
 $country = rawurldecode(trim($_GET['country_you_are_interested_for:']));
//$country=((empty($cou))?'NULL':"".$cou."");
/*
$couq="select * from country where country ilike '%$country%'";
$coures=pg_query($couq);
$courow=pg_fetch_array($coures);
 $countryid=$courow['countryid'];
 $searchCnt = 'Mauritius';
// Use Her for Array  
  1;"India"
2;"Australia"
3;"United Kingdom"
4;"Canada"
7;"USA"
10;"New Zealand"
12;"Singapore"
20;"Mauritius"
32;"Ireland"
47;"China"
56;"Switzerland"
64;"Dubai"
*/
 
$countryArray = array(1=>'India',2=>'Australia',3=>'United Kingdom',4=>'Canada',7=>'USA',10=>'New Zealand',12=>'Singapore',20=>'Mauritius',32=>'Ireland',47=>'China',56=>'Switzerland',64=>'Dubai');
 $countryid = array_search($country, $countryArray);
 
  //What degree are you interested in?
$searchLev = rawurldecode(trim($_GET['what_degree_are_you_interested_in']));
//$searchLev='Diploma/Foundationdee';
$aarayLev = array('PG'=>'Postgraduate','Res'=>'Research','DP'=>'Diploma/Foundation','Summer'=>'Summer School');
 $levSearh = array_search($searchLev, $aarayLev);
 if($levSearh){
 $lev = $levSearh;
 }
 else {
  $lev = 'UG';
 }
 echo $lev;
 
/*

if($lev=='Postgraduate')
{
$lev='PG';
}
else if($lev=='Research')
{
$lev='Res';
}

else if($lev=='Diploma/Foundation')
{
$lev='DP';
}

else if($lev=='Summer School')
{
$lev='Summer';
}
else
{
$lev='UG';
}
echo $lev;*/
//$lev= ((empty($level))?'NULL':"'".$level."'");//((empty($_GET['what_degree_are_you_interested_in']))?'NULL':"'".$_GET['what_degree_are_you_interested_in']."'");
//$ven=((empty($venue))?'NULL':"'".$venue."'");
//$ven= ((empty($_GET['select_venue']))?'NULL':"".$_GET['select_venue']."");

/* $ven = rawurldecode(trim($_GET['i_would_like_to_attend_global_education_interact_in']));
$v=explode('-',$ven);
 echo $branch=trim($v[1]);
if($branch=='Delhi')
{
 $branchid=947;
}
else if($branch=='Kolkata')
{
 $branchid=9328;
}

else if($branch=='Pune')
{
 $branchid=22690;
}
else if($branch=='Chennai')
{
 $branchid=10170;
}
else if($branch=='Bangalore')
{
 $branchid=9327;
}
else if($branch=='Coimbatore')
{
 $branchid=28298;
}

else if($branch=='Cochin')
{
 $branchid=15531;
}

else if($branch=='Hyderabad')
{
 $branchid=9329;
}

else if($branch=='Mumbai')
{
 $branchid=39798;
}

else if($branch=='Chandigarh')
{
 $branchid=22690;
}

else if($branch=='Lucknow')
{
 $branchid=38782;
}
else if($branch=='Jaipur')
{
 $branchid=50161;
}
else {
$branchid=947;
} */


$ven = rawurldecode(trim($_GET['i_would_like_to_attend_the_study_overseas_global_education_fair_2018__in']));
//$v=explode('-',$ven);
 //echo $branch=trim($v[1]);
 $branch = $ven;
if($branch=='new_delhi')
{
 $branchid=206008;
}
else if($branch=='chennai')
{
 $branchid=223221;
}
else if($branch=='cochin')
{
 $branchid=223222;
}
else if($branch=='mumbai')
{
 $branchid=223224;
}
else if($branch=='Coimbatore')
{
 $branchid=224332;
}
else if($branch=='indore')
{
 $branchid=224333;
}
else if($branch=='vizag')
{
 $branchid=224334;
}
else {
$branchid=226008;
}


function getCounselor($branch)
{

	
		
		if($branch== 'new_delhi')
		{
			$pcounselor='4377';
		}
		if($branch== 'mumbai')
		{
			$pcounselor='4381';
		}
		if($branch== 'chennai')
		{
			$pcounselor='4379';
		}
		if($branch== 'cochin')
		{
			$pcounselor='4380';
		}
				return $pcounselor;
		

}



$studid=findStudID($mobile,$phone,$email);
//$pcounselor="3763";
//echo 	$branch;	
		if($pcounselor==""){			
		//echo $branch;
		$pcounselor=getCounselor($branch);		
		}
//else {}


// okey till here
//echo $studid;

echo " ".$sid=$studid;

//------------------------------------If Student Id is not available----------------------------------------
if($studid=="")
{
 $query="INSERT INTO studmast(fname,lname,cityid,mobile,email,dateentered,throughweb,registered,datecame,modecame,
pcounsel,sog) VALUES($name,$lname,$cityid,$mobile,'$email',now(),true,false,now(),17,$pcounselor,'t')";
//webconfig::DBConnect();

$result=pg_query($query);
// okey till here
//
echo "<br>";
if($result)
{
$oid=pg_last_oid($result);
$query1="select studid from studmast where oid=".$oid.";";
$re=pg_query($query1);
while($ro=pg_fetch_array($re))
{
$studentid=$ro['studid'];
pg_query("insert into studsource(studid,web) values ($studentid,true);");
}

}
}
 
$sid=(($studid=="")?"$studentid":"$studid");
echo "<br>";
$cnt++;



$maincategary="Facebook";

$subcategary="FB-Leadsbridge-Study-overseas-Fair-May-18";
$Paid = "Paid";		
$quest='FB-Leadsbridge-Study-overseas-Fair-May-18-'.$maincategary.'_'.$Interested_in_Pursuing;
$remarks = 'FB-Leadsbridge-Study-overseas-Fair-May-18';
 $queryInsert="INSERT INTO webquery(studid,name,phone,email,city,question,entereddate,maincategary,subcategary,remarks,type)
values($sid,$name,$phone,'$email',$cityid,'$quest',now(),'$maincategary','$subcategary','$remarks','$Paid')";

$resultInsert=pg_query($queryInsert) ;

 /* $InsertQuery = "INSERT INTO gei_leadbridge(fname,lname,email,mobile,venue,lev,country,city,branch,adset_id) VALUES ('$name','$lname','$email','$mobile','$ven','$lev','$countryid','$cityid','$branchid','$adset')";
$result1=pg_query($InsertQuery);
die;*/
//}

/*
fname character varying(30),
  lname character varying(30),
  mobile character varying(30),
  email character varying(50),
  city integer,
  course character varying(100),
  lev character varying(50),
  intake integer
*/

?>
