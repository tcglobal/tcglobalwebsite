<?php 
 //////ggfgdg
include_once('config.php');
$class=new webconfig();
$class->DBConnect();



////if(isset($_POST['secret']) && ($_POST['secret']=='10209877577675165')) {
 //  $email=(isset($_POST['last_name']) ? $_POST['last_name'] : '');
  // $first_name=(isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '');
  // $phone_number=(isset($_POST['first_name']) ? $_POST['first_name'] : '');
  // rawurldecode ( string $str )

$name=rawurldecode(trim($_GET['first_name']));
//$name=((empty($n))?'NULL':"'".$n."'");
 $lname=rawurldecode(trim($_GET['last_name']));
//$lname=((empty($ln))?'NULL':"'".$ln."'");
$email= rawurldecode(trim($_GET['email']));//'rknirala@gmail.com';//
//$email=((empty($e))?'NULL':"".$e."");
$mobile= rawurldecode(trim($_GET['phone_number']));// '+919868060720' ;//'+919868060720' ;//
$mobile = substr($mobile,-10);
$phone= $mobile ;
 $cityid=rawurldecode(trim($_GET['city']));
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


 $ven = rawurldecode(trim($_GET['i_would_like_to_attend_global_education_interact_in']));
//$v=explode('-',$ven);
 //echo $branch=trim($v[1]);
 $branch = $ven;
if($branch=='new_delhi')
{
 $branchid=947;
}
else if($branch=='kolkata')
{
 $branchid=9328;
}

else if($branch=='pune')
{
 $branchid=22690;
}

else if($branch=='chennai')
{
 $branchid=10170;
}
else if($branch=='bangalore')
{
 $branchid=9327;
}
else if($branch=='Coimbatore')
{
 $branchid=28298;
}

else if($branch=='kochi')
{
 $branchid=15531;
}

else if($branch=='cochin')
{
 $branchid=12531;
}

else if($branch=='hyderabad')
{
 $branchid=9329;
}

else if($branch=='mumbai')
{
 $branchid=38764;
}

else if($branch=='chandigarh')
{
 $branchid=22690;
}

else if($branch=='lucknow')
{
 $branchid=38782;
}
else if($branch=='jaipur')
{
 $branchid=50161;
}
else {
$branchid=947;
}
   $InsertQuery = "INSERT INTO gei_leadbridge(fname,lname,email,mobile,venue,lev,country,city,branch,adset_id) VALUES ('$name','$lname','$email','$mobile','$ven','$lev','$countryid','$cityid','$branchid','$adset')";
$result1=pg_query($InsertQuery);
die;
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
