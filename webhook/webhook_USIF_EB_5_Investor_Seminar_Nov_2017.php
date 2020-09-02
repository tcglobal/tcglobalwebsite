<?php 

 define('GOOGLE_URL', 'https://www.googleapis.com/urlshortener/v1/url');
define('GOOGLE_API_KEY', 'AIzaSyDurHh-LwgF0XYXa0KAT4382r8Tg2jORE8');

function shorten($long_url) {
$ch = curl_init(GOOGLE_URL . '?key=' . GOOGLE_API_KEY);
curl_setopt_array(
$ch,
array(
CURLOPT_HTTPHEADER =>	 array('Content-Type: application/json'),
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
//$mobile=((empty($m))?'NULL':"".$m."");
$interested_in_be5=rawurldecode(trim($_GET['my_interest_in_the_eb-5_us_green_card_program_relates_to']));
$interested_in_be5 =((empty($interested_in_be5))?'NULL':"".$interested_in_be5."");

$which_event_intrested_in=rawurldecode(trim($_GET['i_would_like_to_attend_the_eb-5_investor_visa_seminar_in']));
$which_event_intrested_in =((empty($which_event_intrested_in))?'NULL':"".$which_event_intrested_in."");

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
$pcounselor=4210;		
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
$subcategary="FB-Leadsbbridge-USIF-EB-5-Investor-Seminar-Nov-2017";
$Paid = "Paid";		
$quest='FB-Leadsbbridge-USIF-EB-5-Investor-Seminar-Nov-2017'.$maincategary;
$remarks = 'FB-Leadsbbridge-USIF-EB-5-sept-2017';
 $queryInsert="INSERT INTO webquery_usif(studid,name,phone,email,city,question,entereddate,maincategary,subcategary,remarks,type,interested_in_be5,which_event_intrested_in)
values($sid,$name,$phone,'$email',$cityid,'$quest',now(),'$maincategary','$subcategary','$remarks','$Paid','$interested_in_be5','$which_event_intrested_in')";	

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
  $message.="<!doctype html>
<html>
  <head>
    <meta name=viewport content=width=device-width />
    <meta http-equiv=Content-Type content=text/html; charset=UTF-8 />
    <title>The Chopras Mail</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0; 
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #fff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .footer {
        clear: both;
        padding-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #555555;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; } 
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body class=>
    <table border=0 cellpadding=0 cellspacing=0 class=body style= width: 100%;>
      <tr>
        <td>&nbsp;</td>
        <td class=container>
          <div align=center class=content>
<img src=http://www.thechopras.com/img_16/joint-logo-usif-thechopras.png>	
            <!-- START CENTERED WHITE CONTAINER -->
            <span class=preheader></span>
            <table class=main>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class=wrapper>
                  <table border=0 cellpadding=0 cellspacing=0>
                    <tr>
                      <td>
                      
                      <img src=http://www.thechopras.com/img_16/automated-emailer-banner-usif.jpg> <br><br>
                        <p style=font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;>Hi $name,<br>
                      </p>
                        
                        <p style=text-align:justify; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;>
Thank you for your interest in The Chopras and U.S. Immigration Fund. We're pleased to be bringing this opportunity to India and look forward to having you with us at our exclusive EB-5 investment focused events. </p>

                        <p style=text-align:justify; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;>U.S. Immigration Fund has a long and successful history with over $3.1 Billion in EB-5 through 18,000 investors and family members in 24 projects and $15 billion in real estate development. Our partners are considered the leading real estate developers in New York, California and Florida.</p>
                        
                        <p style=text-align:justify; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;   >Confirming the details of the event below: </p>
                        </td></tr>
                        
                        <tr> 
                    <!-- Row container for Intro/ Description -->
                    <td><table style=border:solid 1px #f2f2f2; border=0 cellpadding=0 cellspacing=0 align=center width=100%>
  <tbody><tr>
    <td colspan=4 style=padding: 10px; font-size:16px; background-color:#000000; color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; align=center><strong>Event Details1</strong></td>
    </tr>
    
    
  <tr style=background-color:#17293F;text-align:center; color:#ffffff; font-family:Arial, Helvetica, sans-serif;>
    
    <td style=padding:5px; width=15%><strong>Date</strong></td>
    <td style=padding:5px; width=15%><strong>Time</strong></td>
     <td style=padding:5px; width=15%><strong>Place</strong></td>
    <td style=padding:5px; width=25%><strong>Venue</strong></td>
  </tr>
  
  <tr style=text-align:center; background-color:#dfdede; color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
    
    <td style=padding:5px;>7th Nov 2017</td>
    <td style=padding:5px;>3pm - 5pm</td>
    <td style=padding:5px;>Delhi</td>
    <td style=padding:5px;>The Shangri-La</td>
  </tr>
  
  <tr style=text-align:center;color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
   
    <td style=padding:5px;>9th Nov 2017</td>
    <td style=padding:5px;>11am - 5pm</td>
    <td style=padding:5px;>Bangalore</td>
    <td style=padding:5px;>Vivanta by Taj - MG Road</td>
  </tr>
  
  <tr style=text-align:center; background-color:#dfdede; color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
    
    <td style=padding:5px;>11th Nov 2017</td>
    <td style=padding:5px;>11am - 5pm</td>
    <td style=padding:5px;>Mumbai</td>
    <td style=padding:5px;>Taj Lands End</td>
  </tr>
  
  <tr style=text-align:center; color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
    
    <td style=padding:5px;>13th Nov 2017</td>
    <td style=padding:5px;>11am - 5pm</td>
    <td style=padding:5px;>Jaipur</td>
    <td style=padding:5px;>SMS Rambagh</td>
  </tr>
  
  <tr style=text-align:center; background-color:#dfdede; color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
    
    <td style=padding:5px;>15th Nov 2017</td>
    <td style=padding:5px;>11am - 5pm</td>
    <td style=padding:5px;>Delhi</td>
    <td style=padding:5px;>The Shangri-La</td>
  </tr>
  
  <tr style=text-align:center; color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
    
    <td style=padding:5px;>17th Nov 2017</td>
    <td style=padding:5px;>11am - 5pm</td>
    <td style=padding:5px;>Lucknow</td>
    <td style=padding:5px;>Vivanta by Taj</td>
  </tr>
  
  <tr style=text-align:center; background-color:#dfdede; color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
    
    <td style=padding:5px;>19th Nov 2017</td>
    <td style=padding:5px;>11am - 5pm</td>
    <td style=padding:5px;>Kolkata</td>
    <td style=padding:5px;>The Oberoi Grand</td>
  </tr>
  
  <tr style=text-align:center; color: #333333; font-family:Arial, Helvetica, sans-serif; font-size:16px;>
    
    <td style=padding:5px;>21st Nov 2017</td>
    <td style=padding:5px;>11am - 5pm</td>
    <td style=padding:5px;>Pune</td>
    <td style=padding:5px;>Sheraton Grand</td>
  </tr>
  
  
  
  

  
  
  
</tbody></table></td>
                  </tr>
                        
                        
                     <tr>
                      <td>
                          <br>
                        <p style=text-align:justify; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; >Due to the high volume of applications for these events and limited availability, our relationships team will touch base with you shortly to outline the process from hereon and execute confirmations. </p>

<p style=text-align:justify; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;  >We wish you well and hope our engagement will lead to a valuable relationship with positive future outcomes for you and your family. </p>


 
 
 <p style=font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;>Best Wishes <br>The Chopras Team<br>
 
&#9742; 011-49740000 / +91 9654109902</p>
 
 <p style=font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;>
 
 </p>
 
 <p style=font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;>

<a href=https://www.facebook.com/thechoprasglobaleducation target=_blank><img src=http://www.thechopras.com/img_16/fb-icon-new.png></a>
<a href=https://twitter.com/Thechopras target=_blank><img src=http://www.thechopras.com/img_16/tweet-icon-new.png></a>
        </p>
                        
                        <!--<table border=0 cellpadding=0 cellspacing=0 class=btn btn-primary>
                          <tbody>
                            <tr>
                              <td align=left>
                                <table border=0 cellpadding=0 cellspacing=0>
                                  <tbody>
                                    <tr>
                                      <td> <a href=http://htmlemail.io target=_blank>Call To Action</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>-->
                     
                        
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <!-- END MAIN CONTENT AREA -->
              </table>



            <!-- START FOOTER -->
            <div class=footer>
              <table border=0 cellpadding=0 cellspacing=0>
                <tr>
                  <td class=content-block>
                    <span class=apple-link style=font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-size:14px;></span>
                    
                  </td>
                </tr>
               
              </table>
            </div>

            <!-- END FOOTER -->
            
<!-- END CENTERED WHITE CONTAINER --></div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";

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
					$pcounselor=4210;
				}
				return $pcounselor;
		
//}
}

