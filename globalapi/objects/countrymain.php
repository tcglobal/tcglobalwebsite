<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name_country = "country";
	private $table_name_university = "university_master";
	private $table_name_citymast = "citymast";
	private $table_name_services = "services";
	private $table_name_level_of_study = "level_of_study";
	private $table_name_stream_specilization = "stream_specilization";
	private $table_name_semmast = "semmast";
	private $table_name_orientation_master = "orientation_master";
	private $table_name_university_orientation = "university_orientation";
 
    
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

function CountryList($country){

    // query to check if email exists
     $query = "SELECT *  FROM " . $this->table_name_country . "";
	 if(!empty($country))
	 {
	 $query.=" where country ilike '".$country."'";
	 
	 }
	 
	$query.=" order by country";
	
	//$query.=$query1;
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
// print_r($num);
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('countryid' => $row['countryid'] , 'country' => $row['country'], 'flag' => $row['flag']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;
}

function UniversityList($country,$university){

if(!empty($country))
{
$c=explode(',',$country);
for($i=0; $i<sizeof($c); $i++)
{
$query="SELECT distinct univid,university," . $this->table_name_citymast . ".cityid,city," . $this->table_name_country . ".countryid,country,campus,appl_process_time||' '||appl_process_time_unit as avgapplprocesstime,case when internship=true then 'Yes' else 'No' end as internshipstatus,case when scholarship=true then 'Yes' else 'No' end as scholarshipstatus,logo  FROM " . $this->table_name_university . " 
join " . $this->table_name_citymast . " on " . $this->table_name_citymast . ".cityid=" . $this->table_name_university . ".cityid
join " . $this->table_name_country . " on " . $this->table_name_country . ".countryid=" . $this->table_name_citymast . ".countryid";
$query.=" where country ilike '".$c[$i]."'";
if(!empty($university))
{
$query.=" and university ilike '".$university."'";
}
 $query.=" order by country,university";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
    if($num >0){
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('univid' => $row['univid'] , 'university' => $row['university'], 'campus' => $row['campus'], 'cityid' => $row['cityid'], 'city' => $row['city'], 'countryid' => $row['countryid'], 'country' => $row['country'], 'avgapplprocesstime' => $row['avgapplprocesstime'], 'internshipstatus' => $row['internshipstatus'], 'scholarshipstatus' => $row['scholarshipstatus'], 'university_logo' => $row['logo']);	
	  }
   }
   
   }
   }
   else 
   {
   $query="SELECT distinct univid,university," . $this->table_name_citymast . ".cityid,city," . $this->table_name_country . ".countryid,country,campus,appl_process_time||' '||appl_process_time_unit as avgapplprocesstime,case when internship=true then 'Yes' else 'No' end as internshipstatus,case when scholarship=true then 'Yes' else 'No' end as scholarshipstatus,logo  FROM " . $this->table_name_university . " 
join " . $this->table_name_citymast . " on " . $this->table_name_citymast . ".cityid=" . $this->table_name_university . ".cityid
join " . $this->table_name_country . " on " . $this->table_name_country . ".countryid=" . $this->table_name_citymast . ".countryid order by country,university";
	
   
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
// print_r($num);
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('univid' => $row['univid'] , 'university' => $row['university'], 'campus' => $row['campus'], 'cityid' => $row['cityid'], 'city' => $row['city'], 'countryid' => $row['countryid'], 'country' => $row['country'], 'avgapplprocesstime' => $row['avgapplprocesstime'], 'internshipstatus' => $row['internshipstatus'], 'scholarshipstatus' => $row['scholarshipstatus'], 'university_logo' => $row['logo']);	
	  }
     // $data1=array($data);
	  //$json_encode=json_encode($data1);
   }
   
   }
  return $data;
}

function Citymast($country){

if(!empty($country))
{
$c=explode(',',$country);
for($i=0; $i<sizeof($c); $i++)
{
$query="select distinct cityid,city," . $this->table_name_citymast . ".countryid,country from citymast
join " . $this->table_name_country . " on " . $this->table_name_country . ".countryid=citymast.countryid where country ilike '".$c[$i]."' order by country,city";
$stmt = $this->conn->prepare( $query );
$stmt->execute();
$num = $stmt->rowCount();
if($num >0){
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row)
{
 			 $data[]=array('cityid' => $row['cityid'] , 'city' => $row['city'], 'countryid' => $row['countryid'], 'country' => $row['country']);	
}
}
}
}
else 
{
$query="select distinct cityid,city," . $this->table_name_citymast . ".countryid,country from citymast
join " . $this->table_name_country . " on " . $this->table_name_country . ".countryid=citymast.countryid order by country,city";
$stmt = $this->conn->prepare( $query);
$stmt->execute();
$num = $stmt->rowCount();
if($num >0){
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row)
{
$data[]=array('cityid' => $row['cityid'] , 'city' => $row['city'], 'countryid' => $row['countryid'], 'country' => $row['country']);		
}
}
}
return $data;
}


function Services(){
 
    // query to check if email exists
     $query = "SELECT *  FROM " . $this->table_name_services . " where active=true order by id";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
// print_r($num);
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('id' => $row['id'] , 'service' => $row['service']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;
}

function Levelofstudy(){
 
    // query to check if email exists
     $query = "SELECT *  FROM " . $this->table_name_level_of_study . " where active=true order by levelid";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
// print_r($num);
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('levelid' => $row['levelid'] , 'study_level' => $row['study_level']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;
}


  
function Areaofstudy(){
 
    // query to check if email exists
    $query = "SELECT *  FROM " . $this->table_name_stream_specilization . " where parentid=0 order by id";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
// print_r($num);
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('id' => $row['id'] , 'areaofstudy' => $row['title']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;}
  
function admissionyear(){
 
    // query to check if email exists
	
	
	
     $query = "SELECT *  FROM " . $this->table_name_semmast . " where month=0 and semester not ilike '%old%' and semid<>1 order by semid";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
// print_r($num);
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('semid' => $row['semid'] , 'semester' => $row['semester']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;}
  
  
  
  function UniversityOrientation($university){
 
    // query to check if email exists
	
	
	
     $query = "select distinct compid,university,countryid,country,orientation_id," . $this->table_name_orientation_master . ".orientation from " . $this->table_name_university_orientation . "
join " . $this->table_name_orientation_master . " on " . $this->table_name_orientation_master . ".id=" . $this->table_name_university_orientation . ".orientation_id
where active=true";

if(!empty($university))
{
 $query .= " and university ilike '".$university."'";
}
 $query.="  order by compid";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
// print_r($num);
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
      {
 			 $data[]=array('univid' => $row['compid'] , 'university' => $row['university'] , 'countryid' => $row['countryid'] , 'country' => $row['country'] , 'orientation_id' => $row['orientation_id'] , 'orientation' => $row['orientation']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;}





}
?>