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
$email=  rawurldecode(trim($_GET['email']));//'rknirala@gmail.com';//
$email=((empty($email))?'NULL':"".$email."");
$mobile= rawurldecode(trim($_GET['phone_number']));// '+919868060720' ;'+919716675977'; //
$adset= rawurldecode(trim($_GET['adset_id']));
//$mobile=((empty($m))?'NULL':"".$m."");
$Interested_in_Pursuing=rawurldecode(trim($_GET['i_would_like_to_attend_the_australia_&_new_zealand_education_fair_in']));
$Interested_in_Pursuing =((empty($Interested_in_Pursuing))?'NULL':"".$Interested_in_Pursuing."");

$i_would_like_to_attend=rawurldecode(trim($_GET['i_would_like_to_attend']));
$i_would_like_to_attend =((empty($i_would_like_to_attend))?'NULL':"".$i_would_like_to_attend."");


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

$studid=findStudID($mobile,$phone,$email);
$pcounselor="4243";		
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
//echo "<br>";
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
//echo "<br>";
$cnt++;

//LeadsBridge --- Study Abroad

$maincategary="Facebook";
$subcategary="FB-Leadsbridge-UK-Universities-Preview-Singapore-Feb19";
$Paid = "Paid";		
$quest='FB-Leadsbridge-UK-Universities-Preview-Singapore-Feb19'.$maincategary;
$remarks = 'FB-Leadsbridge-UK-Universities-Preview-Singapore-Feb19';
 $queryInsert="INSERT INTO webquery(studid,name,phone,email,city,question,entereddate,maincategary,subcategary,remarks,type,adset_name,i_would_like_to_attend)
values($sid,$name,$phone,'$email',$cityid,'$quest',now(),'$maincategary','$subcategary','$remarks','$Paid','$adset','$i_would_like_to_attend')";	

$resultInsert=pg_query($queryInsert) ;
 callbackweb($studid,$pcounselor,$remarks);
///

if(!empty($sid))
{

$from = "donotreply@thechopras.co.in";
$fromname = "thechopras.co.in";

$to = $email;
$api_key = "91ae2159305c4465159266596b57a7b5";

$subject = "Thank you for expressing an interest in The Chopras ";
$message = "";

//$sssid = encrypt_url($sid);

//$mainurl="http://www.thechopras.com/GEIEvent/FirstStep.php?sid=".$sssid."";

//$ssid = decrypt_url($sid);

 $message="Dear ".$name." <br><br />

<strong>Student ID:-</strong> ".$sid." <br>
<p>Thank you for expressing an interest in the International Year One in Business.!</p>


<p>Congratulations on having taken your first step towards equipping yourself with the tools to excel at university. Through this fast paced, globally competitive programme you will develop the key skills needed to succeed, whilst learning in an international environment that is focused on holistic development and enhancing the core values that are essential to be competitive in a global society.</p>
<p>This 9 month course, taught in India by British academics, as well as others that have considerable international exposure, guarantees students entry to the 2nd year of a UK university in 2018.</p>
<p>Together, The Chopras Institute of Education in collaboration with Northern Consortium United Kingdom (NCUK) is able to offer Indian students this unique 9 month programme that:</p>
<p>
<ul>
<li>Is equivalent to the first year of undergraduate degree in the UK </li>
<li>Is designed in conjunction with UK universities/li>
<li>Guarantees entry to the 2nd year in one of 10 UK universities in 2018</li>
<li>Gives access to 36 different Business and Economics related UG degrees</li>
<li>Is cost effective with possible savings of up to Rs.25 lakh</li>
</ul><br />

</p>
<p><h3>** Course Starts on 23rd October 2017 - Places Still available **</h3></p>

<p>Choose from a wide range of UK universities</p>
<p>University of Bradford, University of Huddersfield, University of Leeds, Leeds Beckett University, Liverpool John Moores University, University of Manchester, Manchester Metropolitan University, University Of Sheffield, Sheffield Hallam University, University of Salford.</p>

<p>Visit the nearest branch of The Chopras. <strong><a href='http://www.thechopras.com/our-branches.html' target='blank'>Click Here</a></strong> for Branch details.<br />
<b>Call us on Centralised Student Services Number – 011-43810000</b><br />
Or E-mail us@ tcie@thechopras.com</p><br />
<strong>For regular updates -</strong><br />
<strong>Please like us on Facebook</strong>@thechoprasglobaleducation<br />
<p> <strong>Follow  us on Twitter</strong> <a href='http://www.twitter.com/thechopras'>@thechopras</a></p>			  
<p>Regards<br />
The Chopras Team <br>
www.thechopras.com/tcie/</p><br>";

$data=array();

$data['subject']= $subject;                                                                       
$data['fromname']= $fromname;                                                             
$data['api_key'] = $api_key;
$data['from'] = $from;
$data['content']= $message;
$data['recipients']= $to;
$apiresult = callApi(@$api_type,@$action,$data);
trim($apiresult);

$foremail = "webqueries@thechopras.com";
			
		//sendsms($studid,$mobile);
		//mailToCounselor($studid,$name,$email,$phone,$mobile,$city,$quest,$foremail);


}
function sendsms($studid,$mobile)
{
	
    $username = urlencode('9654127216');

    $hash = urlencode('Your API hash');


    // Message details
//echo "sdfsd";
    $numbers =urlencode($mobile);

    $sender = urlencode('THECHOPRAS_TRANS');
    
	
	$message = rawurlencode('Welcome to The Chopras . Thank you for registering with us . Your Stud ID is '.$studid.'. and will be required for your personalised study abroad counselling at The Chopras. Our counsellors will get in touch with you
shortly. Incase of urgent queries, contact us on 011- 43810000.');
	
	//$message = rawurlencode('Thank you for registering with The Chopras. Your Stud ID is '.$studid.'. Please use this ID for all future communications. You can contact us @9654003030 ');
	
    //$message = rawurlencode('Thanks for Registering with the Chopras. Your Stud ID is '.$studid.' One of
//our Representatives will get in touch with you shortly. Happy connecting
//Chopras ');
    //$username='9654127216';
    $password='gjmpw';

    // Prepare data for POST request

    $data ='feedid=349295&username='. $username .'&password='. $password .'&To='. $numbers ."&sender=". $sender ."&message=". $message;


    // Send the GET request with cURL

    $ch = curl_init('http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?'. $data);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

    $response = curl_exec($ch);

    curl_close($ch);


    // Process your response here

  //  echo $response;
		
}


function mailToCounselor($studid,$name,$email,$phone,$mobile,$city,$quest,$foremail)
{
	
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: The Chopras <"aspirations@thechopras.com">' . "\r\n";
	
	$body="<table><tr><td colspan=2>Web Query from $name</td></tr><tr><td>Student ID</td><td>$studid</td></tr><tr><td>Name</td><td>$name</td></tr><tr><td>Email</td><td>$email</td></tr><tr><td>Phone</td><td>$phone</td></tr><tr><td>Mobile</td><td>$mobile</td></tr><tr><td>City</td><td>$city</td></tr>
	<tr><td>Query </td><td>$quest</td></tr></table>";
			
		
		if(!empty($foremail))
		{
		//mail($foremail,'Thank you for your Enquiry with The Chopras',$body,$headers);
		//mail('webqueries@thechopras.com','Thank you for your Enquiry with The Chopras',$body,$headers);
		}
	
}
function mailToCounselorerror($studid,$name,$email,$phone,$mobile,$city,$quest,$foremail)
{
	
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: The Chopras <"aspirations@thechopras.com">' . "\r\n";
	
	$body="<table><tr><td colspan=2>Web Query from $name</td></tr><tr><td>Student ID</td><td>$studid</td></tr><tr><td>Name</td><td>$name</td></tr><tr><td>Email</td><td>$email</td></tr><tr><td>Phone</td><td>$phone</td></tr><tr><td>Mobile</td><td>$mobile</td></tr><tr><td>City</td><td>$city</td></tr>
	<tr><td>Query </td><td>$quest</td></tr></table>";
	

		//echo $body;
		
		//mail($foremail,'Thank you for your Enquiry with The Chopras',$body,$headers);
		//mail('webqueries@thechopras.com','Connection fail Thank you for your Enquiry with The Chopras',$body,$headers);
		
	
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
					$pcounselor=4243;
				}
				return $pcounselor;
		
//}
}

