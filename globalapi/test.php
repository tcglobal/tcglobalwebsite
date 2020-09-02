<?php
$con_string = "host=49.50.66.249 port=5432 dbname=DataCCPL1 user=postgres password=123456";
	$dbcon = pg_connect($con_string);

	if (!$dbcon)
 	 {  
    print("Database Connection Failed.");
	exit;
  	}
	else {
	
	echo "connected";
	}
	
	?>