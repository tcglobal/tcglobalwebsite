<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "chopradb.`.ap-south-1.rds.amazonaws.com";
    private $db_name = "ccpl";
    private $username = "chopra";
    private $password = "Admin123";
	private $port = "9291";
  
     private $ccplhost = "49.50.66.249";
	//private $ccplhost = "10.100.0.1";
    private $ccpldb_name = "DataCCPL1";
    private $ccplusername = "postgres";
    private $ccplpassword = "postgres@123";
	private $ccplport = "5432";
	public $conn;
	public $ccplconn;
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
		   $this->conn = new PDO("pgsql:dbname=".$this->db_name."; user=".$this->username."; password=".$this->password."; host=" . $this->host . "; port=".$this->port."");
		   
		  /* if($this->conn){
 echo "Connected to the <strong>".$this->db_name."</strong> database successfully!";
 }*/
		   
		   
		   
		}
		catch(PDOException $exception){
            echo "Connection error-aws: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
		
		
		public function getConnection_CCPL(){
 
        $this->ccplconn = null;
		//$this->ccplconn = null;
 
        try{
		  		   
		   $this->ccplconn = new PDO("pgsql:dbname=".$this->ccpldb_name."; user=".$this->ccplusername."; password=".$this->ccplpassword."; host=" . $this->ccplhost . "; port=".$this->ccplport."");
		     
		   
		}
		catch(PDOException $exception){
            echo "Connection errccpl: " . $exception->getMessage();
        }
 
        return $this->ccplconn;
    }
	
	
	
}
?>