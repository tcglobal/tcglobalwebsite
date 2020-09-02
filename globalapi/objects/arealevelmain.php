<?php
// 'user' object
class AreaLevel{
 
    // database connection and table name
    private $conn;
   
	private $table_name_level_of_study = "level_of_study";
	private $table_name_stream_specilization = "stream_specilization";
	private $table_name_semmast = "semmast";	
	private $table_interests_objectives = "interests_objectives";
	private $table_name_country = "country";
	
	

 
    
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }


function LevelofstudyByLevel($lvl){
 
    // query to check if email exists
   $query = "SELECT *  FROM " . $this->table_name_level_of_study . " where study_level ilike '%$lvl%' and active=true order by levelid";

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
 			 $data=array('levelid' => $row['levelid'] , 'study_level' => $row['study_level']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;
}


  
function AreaofstudyByTitle($aos){
 
    // query to check if email exists
$query = "SELECT *  FROM " . $this->table_name_stream_specilization . " where title ilike '%$aos%' and parentid=0 order by id";

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
 			 $data=array('id' => $row['id'] , 'areaofstudy' => $row['title']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;}
  
function admissionyearByTitle($intake){
 
    // query to check if email exists
	
	
	
  $query = "SELECT *  FROM " . $this->table_name_semmast . " where trimesteryear ilike '%$intake%' and month!=0 and semester not ilike '%old%' and semid<>1 order by semid";

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
 			 $data=array('semid' => $row['semid'] , 'semester' => $row['semester']);	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;}
  
  function ObjectiveByName($objective){
 
    // query to check if email exists
	
 $query = "SELECT *  FROM " . $this->table_interests_objectives . " where objective_name ilike '%$objective%' ";
 

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
 			 $data=$row['objective_id'];	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;}
  
  function CountryIdByName($country){

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
 			 $data=$row['countryid'];	
	  }
     // $data1=array('CountryDetails' =>$data);
	  //$json_encode=json_encode($data1);
   }
  return $data;
}

}
?>