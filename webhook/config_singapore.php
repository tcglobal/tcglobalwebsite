<?php
//error_reporting(E_ERROR);
//ini_set('display_errors','On');
class webconfig
{
  public static $DbServer="42.61.69.131";
 // public static $DbServer="10.100.0.1";
 // public static $DbName="DataCCPL1";
 public static $DbName="CCPLSINGAPORE";
  public static $DbUser="postgres";  
  public static $DbPass="123postgres";  
 
  public static function DBConnect()
  {
	$con_string = "host=".webconfig::$DbServer." port=5432 dbname=".webconfig::$DbName." user=".webconfig::$DbUser." password=".webconfig::$DbPass;

	 $dbcon = pg_connect($con_string);

		if (!$dbcon)
	  {  
		print("Database Connection Failed.");
		exit;
	  }
  }
  
  
   public static function clientIP() 
	{
		if (getenv('HTTP_CLIENT_IP')) 
		{
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) 
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) 
		{
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) 
		{
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) 
		{
		     $ip = getenv('HTTP_FORWARDED');
		}
		else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}


/* !!! query for venue details !!! */

public static function queryvenfunc()
{
return $queryvenc="select case when compmast.name ='LE MERIDEAN' then 'Le Meridean' 
when compmast.name='TAJ RAMBAGH PALACE' then 'Taj Rambagh Palace'
else compmast.name end as name,
compmast.street,compmast.suburb,citymast.city,citymast.cityid,compmast.phone,compmast.fax,id,to_char(vcstaffnews.starttime,'dd Mon YYYY') as startdate,to_char(vcstaffnews.starttime,'hh') as stime,to_char(vcstaffnews.endtime,'hh PM') as etime,substr(branch.name,24) as branch,branch.compid  from vcstaffnews inner join compmast on compmast.compid=vcstaffnews.hotelid inner join citymast on citymast.cityid=compmast.cityid inner join compmast as branch on branch.compid=vcstaffnews.branch where eventname ilike '%GEI-XIX%' and status ilike '%confirmed%' order by id";
}


public static function queryunivrfunc($configCountryIndex)
{
return $GetCompidquery="select compid,company as name,case when offer=true then 'YES' when offer=False then 'No' end as offer from geiuniversities where countryid in(".$configCountryIndex.") and gei=21 and company not ilike 'n&n Chopra Consultants%' order by name";
}

public static function queryfashionunivrfunc($configCountryIndex)
{
return $GetfCompidquery="select compid,company as name,case when offer=true then 'YES' when offer=False then 'No' end as offer from geifashionuniversities where countryid in(".$configCountryIndex.") and gei=1 and company not ilike 'n&n Chopra Consultants%' and compid not in (select compid from geiuniversities where gei=21) order by name";
}


 }
  
  /* !!! query for dynamic gei participating countries !!! */
  
  $config['country'] = array(

							  0 => array('2','Australia')
							 ,1 => array('4','Canada') 
							 ,2 => array('10','New Zealand') 
							 ,3 => array('12','Singapore')
							 ,4 => array('56','Switzerland')			
							 ,5 => array('64','UAE')				  							  
							 ,6 => array('3','United Kingdom')							 
							 ,7 => array('7','USA')							 							 							 
				  );
				  
				  
function encrypt_url($string) {
$key = "MAL_979805"; //key to encrypt and decrypts.
$result = '';
$test = "";
for($i=0; $i<strlen($string); $i++) {
$char = substr($string, $i, 1);
$keychar = substr($key, ($i % strlen($key))-1, 1);
$char = chr(ord($char)+ord($keychar));

$test[$char]= ord($char)+ord($keychar);
$result.=$char;
}

return urlencode(base64_encode($result));
}

function decrypt_url($string) {
$key = "MAL_979805"; //key to encrypt and decrypts.
$result = '';
$string = base64_decode(urldecode($string));
for($i=0; $i<strlen($string); $i++) {
$char = substr($string, $i, 1);
$keychar = substr($key, ($i % strlen($key))-1, 1);
$char = chr(ord($char)-ord($keychar));
$result.=$char;
}
return $result;
}

function findStudID($mobile,$phone,$email)
	{
		
		$studid="";			
		$query="Select distinct StudMast.StudID from StudMast";
		
		if(!empty($mobile) && $phone!=NULL)
		{
			$where=" where studmast.mobile ilike ".$mobile." or studmast.ph_r ilike ".$phone."";
		 	$query.=$where;
		
			$result=pg_query($query);
			$numRows=pg_num_rows($result);
		if($numRows>0)
			{
				$row=pg_fetch_array($result);
				$studid=$row['studid'];
			}
		
		}
		
		if($email!='NULL' && $studid=="")
		{
			$query="";
			$query="Select distinct StudMast.StudID from StudMast";
			$where=" where studmast.email ilike '".$email."%' ";
	   		$query.=$where;
			$result=pg_query($query);
			$numRows=pg_num_rows($result);
		if($numRows>0)
			{
				$row=pg_fetch_array($result);
				$studid=$row['studid'];
		
			}
		}
		
		return $studid;
	}

?>
				  
