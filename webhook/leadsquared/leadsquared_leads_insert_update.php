<?php
include_once('../config.php');
$class=new webconfig();
$class->DBConnect();

$var = file_get_contents('php://input');
$dec = json_decode($var,true);
$ProspectID=rawurldecode(trim($dec['After']['ProspectID']));
$chk_lead = "select * from lead_leadsquare where prospectid='".$ProspectID."'";
$qry_chk_lead = pg_query($chk_lead);
$num_lead = pg_num_rows($qry_chk_lead);
//$flag = $_GET['flag'];





//print_r($dec['After']);

/*Array ( [ProspectID] => ec479dff-6fe8-4635-8166-5dbfa0aa58ab [ProspectAutoId] => 1075 [FirstName] => test111 [LastName] => [EmailAddress] => test@test1.com [Phone] => [Mobile] => +91-9654046667 [Source] => Referral Sites [SourceMedium] => [SourceCampaign] => [ProspectStage] => Fresh [Score] => 6 [EngagementScore] => 0 [ProspectActivityName_Max] => Page Visited on Website [ProspectActivityDate_Max] => 2019-04-16 07:31:07 [OwnerId] => fe6365d2-52b6-11e9-986b-0ac1020b43f8 [ModifiedOn] => 2019-04-22 13:00:09 [LastModifiedOn] => 2019-04-22 13:00:09 [NotableEventdate] => 2019-04-22 13:00:09 [QualityScore01] => [ConversionReferrerURL] => [SourceReferrerURL] => http://192.168.1.20/lead-api-php-master/leadform.php [SourceIPAddress] => 122.160.136.177 [LeadLastModifiedOn] => 2019-04-22 13:00:09 [OwnerIdEmailAddress] => rahulv@thechopras.com ) */





		

if($num_lead <= 0)
{
	$ProspectID=$dec['ProspectID'];
	
	if($ProspectID!='')
	{
	
	$Mobile=rawurldecode(trim($dec['Mobile']));
	$Mobile=((empty($Mobile))?'NULL':"'".substr($Mobile, -10)."'");
	$OwnerIdName= rawurldecode(trim($dec['OwnerIdName']));
	$OwnerIdName=((empty($OwnerIdName))?'NULL':"'".$OwnerIdName."'");
	$OwnerIdEmailAddress= rawurldecode(trim($dec['OwnerIdEmailAddress']));
	$OwnerIdEmailAddress=((empty($OwnerIdEmailAddress))?'NULL':"'".$OwnerIdEmailAddress."'");
	$Source= rawurldecode(trim($dec['Source']));
	$Source=((empty($Source))?'NULL':"'".$Source."'");
	$LS_CreatedOn= rawurldecode(trim($dec['CreatedOn']));
	$LS_CreatedOn=((empty($LS_CreatedOn))?'NULL':"'".$LS_CreatedOn."'");
	$LS_ModifiedOn= rawurldecode(trim($dec['ModifiedOn']));
	$LS_ModifiedOn=((empty($LS_ModifiedOn))?'NULL':"'".$LS_ModifiedOn."'");
	$CreatedBy= rawurldecode(trim($dec['CreatedBy']));
	$CreatedBy=((empty($CreatedBy))?'NULL':"'".$CreatedBy."'");
	$ModifiedBy= rawurldecode(trim($dec['ModifiedBy']));
	$ModifiedBy=((empty($ModifiedBy))?'NULL':"'".$ModifiedBy."'");
	$ProspectActivityName_Max= rawurldecode(trim($dec['ProspectActivityName_Max']));
	$ProspectActivityName_Max=((empty($ProspectActivityName_Max))?'NULL':"'".$ProspectActivityName_Max."'");
	$Phone=rawurldecode(trim($dec['Phone']));
	$Phone=((empty($Phone))?'NULL':"'".substr($Phone, -10)."'");
	
	$FirstName=rawurldecode(trim($dec['FirstName']));
	$FirstName=((empty($FirstName))?'NULL':"'".$FirstName."'");
	$LastName=rawurldecode(trim($dec['LastName']));
	$LastName=((empty($LastName))?'NULL':"'".$LastName."'");
	$EmailAddress=rawurldecode(trim($dec['EmailAddress']));
	$EmailAddress=((empty($EmailAddress))?'NULL':"'".$EmailAddress."'");
	
	
	}
	else
	{
	$ProspectID=rawurldecode(trim($dec['After']['ProspectID']));
	$Mobile=rawurldecode(trim($dec['After']['Mobile']));
	$Mobile=((empty($Mobile))?'NULL':"'".substr($Mobile, -10)."'");
	$OwnerIdName= rawurldecode(trim($dec['After']['OwnerIdName']));
	$OwnerIdName=((empty($OwnerIdName))?'NULL':"'".$OwnerIdName."'");
	$OwnerIdEmailAddress= rawurldecode(trim($dec['After']['OwnerIdEmailAddress']));
	$OwnerIdEmailAddress=((empty($OwnerIdEmailAddress))?'NULL':"'".$OwnerIdEmailAddress."'");
	$Source= rawurldecode(trim($dec['After']['Source']));
	$Source=((empty($Source))?'NULL':"'".$Source."'");
	$LS_CreatedOn= rawurldecode(trim($dec['After']['CreatedOn']));
	$LS_CreatedOn=((empty($LS_CreatedOn))?'NULL':"'".$LS_CreatedOn."'");
	$LS_ModifiedOn= rawurldecode(trim($dec['After']['ModifiedOn']));
	$LS_ModifiedOn=((empty($LS_ModifiedOn))?'NULL':"'".$LS_ModifiedOn."'");
	$CreatedBy= rawurldecode(trim($dec['After']['CreatedBy']));
	$CreatedBy=((empty($CreatedBy))?'NULL':"'".$CreatedBy."'");
	$ModifiedBy= rawurldecode(trim($dec['After']['ModifiedBy']));
	$ModifiedBy=((empty($ModifiedBy))?'NULL':"'".$ModifiedBy."'");
	$ProspectActivityName_Max= rawurldecode(trim($dec['After']['ProspectActivityName_Max']));
	$ProspectActivityName_Max=((empty($ProspectActivityName_Max))?'NULL':"'".$ProspectActivityName_Max."'");
	$Phone=rawurldecode(trim($dec['After']['Phone']));
	$Phone=((empty($Phone))?'NULL':"'".substr($Phone, -10)."'");
	
	$FirstName=rawurldecode(trim($dec['After']['FirstName']));
	$FirstName=((empty($FirstName))?'NULL':"'".$FirstName."'");
	$LastName=rawurldecode(trim($dec['After']['LastName']));
	$LastName=((empty($LastName))?'NULL':"'".$LastName."'");
	$EmailAddress=rawurldecode(trim($dec['After']['EmailAddress']));
	$EmailAddress=((empty($EmailAddress))?'NULL':"'".$EmailAddress."'");
	
	
	}
	echo  $ins_leads = "insert into lead_leadsquare(prospectid,mobile,OwnerIdName,owneridemailaddress,lead_source,ls_createdon,ls_modifiedon,createdby,modifiedby,prospectactivityname_max,phone,firstname,lastname,emailaddress) values('$ProspectID',$Mobile,$OwnerIdName,$OwnerIdEmailAddress,$Source,$LS_CreatedOn,$LS_ModifiedOn,$CreatedBy,$ModifiedBy,$ProspectActivityName_Max,$Phone,$FirstName,$LastName,$EmailAddress)";
	pg_query($ins_leads);
	
	echo "inserted Successfully";
}
else
{


	$Mobile=rawurldecode(trim($dec['After']['Mobile']));
	$Mobile=((empty($Mobile))?'NULL':"'".substr($Mobile, -10)."'");
	$OwnerIdName= rawurldecode(trim($dec['After']['OwnerIdName']));//'rknirala@gmail.com';//
	$OwnerIdName=((empty($OwnerIdName))?'NULL':"'".$OwnerIdName."'");
	$OwnerIdEmailAddress= rawurldecode(trim($dec['After']['OwnerIdEmailAddress']));
	$OwnerIdEmailAddress=((empty($OwnerIdEmailAddress))?'NULL':"'".$OwnerIdEmailAddress."'");
	$Source= rawurldecode(trim($dec['After']['Source']));
	$Source=((empty($Source))?'NULL':"'".$Source."'");
	$LS_CreatedOn= rawurldecode(trim($dec['After']['CreatedOn']));
	$LS_CreatedOn=((empty($LS_CreatedOn))?'NULL':"'".$LS_CreatedOn."'");
	$LS_ModifiedOn= rawurldecode(trim($dec['After']['ModifiedOn']));
	$LS_ModifiedOn=((empty($LS_ModifiedOn))?'NULL':"'".$LS_ModifiedOn."'");
	$CreatedBy= rawurldecode(trim($dec['After']['CreatedBy']));
	$CreatedBy=((empty($CreatedBy))?'NULL':"'".$CreatedBy."'");
	$ModifiedBy= rawurldecode(trim($dec['After']['ModifiedBy']));
	$ModifiedBy=((empty($CreatedBy))?'NULL':"'".$ModifiedBy."'");
	$ProspectActivityName_Max= rawurldecode(trim($dec['After']['ProspectActivityName_Max']));
	$ProspectActivityName_Max=((empty($ProspectActivityName_Max))?'NULL':"'".$ProspectActivityName_Max."'");
	$Phone=rawurldecode(trim($dec['After']['Phone']));
	$Phone=((empty($Phone))?'NULL':"'".substr($Phone, -10)."'");
	
    $FirstName=rawurldecode(trim($dec['After']['FirstName']));
	$FirstName=((empty($FirstName))?'NULL':"'".$FirstName."'");
	$LastName=rawurldecode(trim($dec['After']['LastName']));
	$LastName=((empty($LastName))?'NULL':"'".$LastName."'");
	$EmailAddress=rawurldecode(trim($dec['After']['EmailAddress']));
	$EmailAddress=((empty($EmailAddress))?'NULL':"'".$EmailAddress."'");
	
	
	
	echo $upd_leads = "update lead_leadsquare set mobile=$Mobile,owneridemailaddress=$OwnerIdEmailAddress,lead_source=$Source,updateddate=now(),ls_createdon=$LS_CreatedOn,ls_modifiedon=$LS_ModifiedOn,createdby=$CreatedBy,modifiedby=$ModifiedBy,prospectactivityname_max=$ProspectActivityName_Max,phone=$Phone,firstname=$FirstName,lastname=$LastName,emailaddress=$EmailAddress where prospectid='".$ProspectID."'";
	pg_query($upd_leads);
	
	echo "Updated Successfully";
	
}
		





?>

