<?php 
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
 $cityid=rawurldecode(trim($_GET['city'])); //City
//$cityid=((empty($c))?'NULL':"'".$c."'");
$city_name = $cityid;
 $getcnt = "select * from citymast where city ilike '$cityid' and done=true";
$cid=pg_query($getcnt);
$re=pg_fetch_array($cid);
echo $cit=$re['cityid'];
$cityid=(empty($cit)?3296:$cit);

$studid=findStudID($mobile,$phone,$email);
$pcounselor="3763";		
		if($pcounselor==""){			
		$pcounselor=getCounselor($cit);		
		}
//else {}


// okey till here
//echo $studid;

echo " Old SID".$sid=$studid;

//------------------------------------If Student Id is not available----------------------------------------
if($studid=="")
{
 $query="INSERT INTO studmast(fname,lname,cityid,mobile,email,dateentered,throughweb,registered,datecame,modecame,
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

//LeadsBridge --- Study Abroad

$maincategary="Facebook";

$subcategary="FB-Leads-GEI-Singapore17";
$Paid = "Paid";		
$quest='GEI-Singapore17-Registration-'.$maincategary.'_'.$Interested_in_Pursuing;
$remarks = 'FB-Leads-GEI-Singapore17';
 $queryInsert="INSERT INTO webquery(studid,name,phone,email,city,question,entereddate,maincategary,subcategary,remarks,type)
values($sid,$name,$phone,'$email',$cityid,'$quest',now(),'$maincategary','$subcategary','$remarks','$Paid')";	

$resultInsert=pg_query($queryInsert) ;
 callbackweb($studid,$pcounselor,$remarks);
///

if(!empty($sid))
{

$from = "donotreply@thechopras.co.in";
$fromname = "thechopras.co.in";

$to = $email;
$api_key = "91ae2159305c4465159266596b57a7b5";

$subject = "Thank you for expressing an interest in The Chopras Institute of Education";
$message = "";

//$sssid = encrypt_url($sid);

//$mainurl="http://www.thechopras.com/GEIEvent/FirstStep.php?sid=".$sssid."";

//$ssid = decrypt_url($sid);

 $message="Dear ".$name." <br><br><br>
Student ID:- ".$sid." <br><br><p>THANK YOU!</p>
<p>You have successfully registered yourself with <a href='http://www.thechopras.com/'><em><u><strong>The  Chopras</strong></u></em></a>  for the upcoming Global Education Interact (GEI) International scheduled to take place from 19th January to 21st January, i.e. 2 days in Dubai and 1 day in Abu Dhabi.</p> 
<p>In this upcoming GEI International, you will meet Top University Delegates for on-spot admission and counselling. You can also look forward to our exclusive Engineering Competitions, Scholarship tests and Quizzes where cash prizes, trophies and certificates of participation will be awarded.</p>
<p>Our comprehensive suite of global education services include the following:</p>
<ul>
<li>Psychometric Assessments</li>
<li>Higher Education & Career Advisory</li>
<li>Admissions, Applications, Scholarships, Visas and Post Visa Services</li>
<li>Test Preparation</li>
<li>English Language Training</li>
<li>Study Skills</li>
<li>Higher Education Pathways</li>
</ul>
<p>Were here to answer each and every question you have so feel free to send us an email at sonik<a href='mailto:webqueries@thechopras.com'>@thechopras.com</a> </p>
  
<p>Thanks and Regards<br />

The Chopras Team</p>";

$data=array();

$data['subject']= $subject;                                                                       
$data['fromname']= $fromnam;                                                             
$data['api_key'] = $api_key;
$data['from'] = $from;
$data['content']= $message;
$data['recipients']= $to;
//$apiresult = callApi(@$api_type,@$action,$data);
//trim($apiresult);s

}
function callbackweb($studid,$pcounselor,$remarks)
{
	$query="Insert into callbackweb (studid,empid,msg,entertime,enterby,remarks,followup_no)
	values($studid,$pcounselor,$queres,now(),'1242',NULL,'1');";
	$result=pg_query($query);
}
function getCounselor($city)
{
	$findcity="select * from webquerytransfer where cityid=".$city."";
		$resultfindcity=pg_query($findcity);
		$numrows=pg_num_rows($resultfindcity);
		if($numrows>0)
			{
					$rowfind=pg_fetch_array($resultfindcity);
						if(!empty($course))
							{
		
								$pcounselor=$rowfind['empid2'];
							}
							else
							{
						 		$pcounselor=$rowfind['empid1'];
							}
			}
			else 
				{
					$pcounselor=3763;
				}
				return $pcounselor;
		
//}
}

