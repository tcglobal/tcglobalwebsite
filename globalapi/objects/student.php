<?php
	class User{
	 
	    // database connection and table name
	    private $conn;
	    private $table_name_studmast = "studmast";
		private $table_name_citymast = "citymast";
		private $table_name_stream_specilization = "stream_specilization";
	    private $table_appointment_head ="appointment_head";
	    public function __construct($db){
	        $this->conn = $db;
	    }
	
		function GetStudentID($email,$mobile)
		{
			if(!empty($mobile))
			{
				$query = "SELECT *  FROM " . $this->table_name_studmast . " 
				left outer join " . $this->table_name_citymast . " on " . $this->table_name_citymast . ".cityid=" . $this->table_name_studmast . ".cityid
				where mobile ilike '".$mobile."' ";
				$stmt = $this->conn->prepare($query);
				$stmt->execute();
				$num = $stmt->rowCount();
				if($num >0){
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rows as $row)
					{
						$studid=$row['studid'];
						$datereg=$row['datereg'];	 
						$onboarddate=$row['onboarddate'];
						$cityid=$row['cityid']; 
						$city=$row['city']; 
						$pcounsel=$row['pcounsel'];
					}
				} 
			}
			
			
			if(!empty($email) && $email!=NULL && $studid=="")
			{
				$query = "SELECT *  FROM " . $this->table_name_studmast . " 
				left outer join " . $this->table_name_citymast . " on " . $this->table_name_citymast . ".cityid=" . $this->table_name_studmast . ".cityid where email ilike '".$email."' ";
				$stmt = $this->conn->prepare($query);
				$stmt->execute();
				$num = $stmt->rowCount();
				if($num >0){
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rows as $row)
					{
					  $studid=$row['studid'];	
					  $datereg=$row['datereg'];	 
					  $onboarddate=$row['onboarddate'];  
					  $cityid=$row['cityid']; 
					  $city=$row['city']; 
					  $pcounsel=$row['pcounsel'];
					}
				}
			} 
			$data=array($studid,$datereg,$onboarddate,$cityid,$city,$pcounsel);
			return $data;
		}
		
	
		function LeadExist($mobile,$email)
		{
			$studid	="";
			$id		="";	
			$query="Select distinct investor_lead.id from investor_lead";
			
			if(!empty($mobile))
			{
				$where=" where investor_lead.mobile ilike '%".$mobile."%'";
				$query.=$where;							
				$stmt = $this->conn->prepare($query);
				$stmt->execute();
				$numRows = $stmt->rowCount();
				
			if($numRows>0)
				{
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rows as $row)
					{
					  $id=$row['id'];						  
					}					
				}
			
			}
		
			
			if(!empty($email) and $id=="")
			{
				$query="";
				$query="Select distinct investor_lead.id from investor_lead";
				$where=" where investor_lead.email ilike '".$email."%' ";
		   		$query.=$where;
				
				$stmt = $this->conn->prepare($query);
				$stmt->execute();
				$numRows = $stmt->rowCount();
				
				if($numRows>0)
					{
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rows as $row)
					{
					  $id=$row['id'];						  
					}
			
				}
			}
			
			return $id;
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
  return $data;
  }
  
  
  
 function branchhead($branchid) {
 $query="Select empid from ".$this->table_appointment_head."  where compid='$branchid'";
	       $stmt = $this->conn->prepare( $query );
 
			 $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
	   if($num >0){
 
        // get record details / values
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($rows as $row)
      {
 			 $data=$row['empid'];	
	  }
    
   }
			
			return  $data;
  }
		
	
	}
	
	?>

