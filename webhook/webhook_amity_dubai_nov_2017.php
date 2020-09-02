<?php 
 //////ggfgdg
 
 define('GOOGLE_URL', 'https://www.googleapis.com/urlshortener/v1/url');
define('GOOGLE_API_KEY', 'AIzaSyDurHh-LwgF0XYXa0KAT4382r8Tg2jORE8');

function shorten($long_url) {
$ch = curl_init(GOOGLE_URL . '?key=' . GOOGLE_API_KEY);
curl_setopt_array(
$ch,
array(
CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_TIMEOUT => 5,
CURLOPT_CONNECTTIMEOUT => 0,
CURLOPT_POST => 1,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_POSTFIELDS => '{"longUrl": "' . $long_url . '"}'
)
);

$json_response = json_decode(curl_exec($ch), true);
return $json_response['id'] ? $json_response['id'] : $long_url;

} 


function callApi($api_type='', $api_activity='', $api_input='') {
$data = array();
$result = http_post_form("https://api.falconide.com/falconapi/web.send.rest", $api_input);
return $result;
}

function http_post_form($url,$data,$timeout=20) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url); 
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RANGE,"1-2000000");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
curl_setopt($ch, CURLOPT_REFERER, @$_SERVER['REQUEST_URI']);
$result = curl_exec($ch); 
$result = curl_error($ch) ? curl_error($ch) : $result;
curl_close($ch);
return $result;
}
include_once('config.php');
$class=new webconfig();
$class->DBConnect();



//die;
$name=rawurldecode(trim($_GET['first_name']));
$name=((empty($name))?'NULL':"'".$name."'");
$lname=rawurldecode(trim($_GET['last_name']));
$lname=((empty($lname))?'NULL':"'".$lname."'");
$email= rawurldecode(trim($_GET['email']));
$email=((empty($email))?'NULL':"".$email."");
$Interested_in_Pursuing=rawurldecode(trim($_GET['Interested_in_Pursuing']));
$Interested_in_Pursuing =((empty($Interested_in_Pursuing))?'NULL':"'".$Interested_in_Pursuing."'");

$mobile=   rawurldecode(trim($_GET['phone_number']));//'+919958853452' ;//'+919868060720' ;//
$mobile = str_replace(' ', '', $mobile);
//$mobile=((empty($m))?'NULL':"".$m."");
$mobile = substr($mobile,-10);
$phone= $mobile ;
 $cityid=rawurldecode(trim($_GET['city']));
//$cityid=((empty($c))?'NULL':"'".$c."'");
$city_name = $cityid;
 $getcnt = "select * from citymast where city ilike '$cityid' and done=true";
$cid=pg_query($getcnt);
$re=pg_fetch_array($cid);
echo $cit=$re['cityid'];
$cityid=(empty($cit)?1848:$cit);
$pcounselor=3763;

//find and create studid
$query="Select distinct StudMast.StudID from StudMast";

if($mobile!="" )
{
  $query1=" where studmast.mobile = '".trim($mobile)."'  ";



	$result=pg_query($query.$query1);
	$numRows=pg_num_rows($result);
	if($numRows>0)
	{
	$row=pg_fetch_array($result);
	$studid=$row['studid'];
	}
	else {	

 $query2=" where studmast.email= '".trim($email)."' ";
echo "<br>";
//echo $query.$query1;
echo "<br>";
//echo $query.$query2;

$result=pg_query($query.$query2);
$numRows=pg_num_rows($result);
if($numRows>0)
{
$row=pg_fetch_array($result);
$studid=$row['studid'];

}
//echo "MOBILE";
//echo $studid;

	}
		
}
	
	
	

//else {}


// okey till here
//echo $studid;

echo " Old SID".$sid=$studid;

//------------------------------------If Student Id is not available----------------------------------------
if($studid=="")
{
echo $query="INSERT INTO studmast(fname,lname,cityid,mobile,email,dateentered,throughweb,registered,datecame,modecame,
pcounsel) VALUES($name,$lname,$cityid,$mobile,'$email',now(),true,false,now(),17,$pcounselor)";
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
$subcategary="FB-LB-Amity-Dubai-17";
$Paid = "paid";		
$quest =  $Interested_in_Pursuing; 
$remarks = 'FB-LB-Amity-Dubai-17';
echo $queryInsert="INSERT INTO webquery(studid,name,phone,email,city,question,entereddate,maincategary,subcategary,remarks,type)
values($sid,$name,$phone,'$email',$cityid,$quest,now(),'$maincategary','$subcategary','$remarks','$Paid')";	

$resultInsert=pg_query($queryInsert) ;
 callbackweb($studid,$pcounselor,$remarks);
///

if(!empty($sid))
{

$from = "donotreply@thechopras.co.in";
$fromname = "thechopras.co.in";

$to = $email;
$api_key = "91ae2159305c4465159266596b57a7b5";

$subject = "Thank you for expressing an interest in TCIE-NCUK";
$message = "";

//$sssid = encrypt_url($sid);

//$mainurl="http://www.thechopras.com/GEIEvent/FirstStep.php?sid=".$sssid."";

//$ssid = decrypt_url($sid);

 $message="Dear ".$name." <br><br>
Student ID:- ".$sid." <br><br>
<body link='#0000ff' dir='ltr' lang='en-US'>
Thank  you for expressing an interest in the International Year One in  Business.<br>

Congratulations  on having taken your first step towards equipping yourself with the  tools to excel at university. Through this fast paced, globally  competitive programme you will develop the key skills needed to  succeed, whilst learning in an international environment that is  focused on holistic development and enhancing the core values that  are essential to be competitive in a global society.<br>
This  9 month course, taught in India by British academics, as well as  others that have considerable international exposure, guarantees  students entry to the 2nd  year of a UK university in 2017.<br>
Together, <em>The  Chopras Institute of Education</em> in collaboration with <em>Northern  Consortium United Kingdom (NCUK</em>)  is able to offer Indian students this unique 9 month programme that:<br>
<ul >
  <li>
  Is equivalent to the first year of undergraduate degree in the UK </li>
  
  <li>Is  	designed in conjunction with UK universities  </li>
  <li> Guarantees  	entry to the 2<sup>nd</sup> year in one of 11 UK universities in 2017  </li>
  
  <li>Gives  access to 36 different Business and Economics related UG degrees  </li>
 <li> Is  	cost effective with possible savings of up to Rs.25 lakh</li>
</ul>
<p> <strong>**  Course Starts on 24</strong><strong>th</strong><strong> October - Places Still available **</strong></p>
<p>

<strong>Choose  from a wide range of UK universities:</strong></p>
<br>
<em>University  of Bradford, University of Huddersfield, University of Leeds, Leeds  Beckett University, University of Liverpool, Liverpool John Moores  University, University of Manchester, Manchester Metropolitan  University, University Of Sheffield, Sheffield Hallam University,  University of Salford.</em><br>
<p> <strong>Visit&nbsp;The&nbsp;Chopras  Institute of Education,&nbsp;</strong><a href='http://www.thechopras.com/our-branches.html'><u><strong>Click  Here</strong></u></a><strong>&nbsp;for  details.</strong></p>
<p> Or  Call Us - 91-11-26414164/65 <br/>
  Or E-mail  us@&nbsp;<a href='mailto:webqueries@thechopras.com'><u>webqueries@thechopras.com</u></a></p>";

$data=array();

$data['subject']= rawurlencode($subject);                                                                       
$data['fromname']= rawurlencode($fromname);                                                             
$data['api_key'] = $api_key;
$data['from'] = $from;
$data['content']= rawurlencode($message);
$data['recipients']= $to;
//$apiresult = callApi(@$api_type,@$action,$data);
//trim($apiresult);


}
function callbackweb($studid,$pcounselor,$remarks)
{
				$query="Insert into callbackweb (studid,empid,msg,entertime,enterby,remarks,followup_no)
				values($studid,$pcounselor,$queres,now(),'1242',NULL,'1');";
				$result=pg_query($query);
}