<?php
die('rajeev');
	echo $data = json_encode(array("FIRST_NAME" => "Rajeev","EMAIL"=>"rajeevm@tcglobal.com","MOBILE"=>"9811019534","AGE":'34', "CITY":"Delhi"));die;
	$ch = curl_init('https://api.netcoresmartech.com/apiv2?type=contact&activity=add&listid=4&apikey=12a9b944c95e18933612fe1d508a724b');		
	$ch = curl_init('https://api.netcoresmartech.com/apiv2?type=contact&activity=addsync&listid=4&apikey=12a9b944c95e18933612fe1d508a724b');		
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	$result = curl_exec($ch);
	print_r($result);	
	curl_close($ch);	
	die('sdfd');

?>



<script type='text/javascript' src='https://tcglobal.wpengine.com/wp-content/themes/tcglobal/js/jquery.min.js?ver=20120206'></script>
<script>
 
  $(document).ready(function() {
  	

  	var settings = {
		  "url": "http://13.235.4.44/api/v1/wfp/api-token-auth/",
		  "method": "POST",
		  "headers": {
		    "Content-Type": "application/json",
		  },
		  //"data":"{\"username\":\"dhibakar.j@optisolbusiness.com\",\"password\":\"Optisol@123\"}"
		  "data":'{"username":"dhibakar.j@optisolbusiness.com","password":"Optisol@123"}'
	}

	$.ajax(settings).done(function (response) {
	  console.log(response);
	});

	var settingsProg = {
		  "url": "http://13.235.4.44/client_api/program_data/v1.0/",
		  "method": "POST",
		  "headers": {
		    "Content-Type": "application/json",
		    "Authorization": "Token 08e128cafdeef5d79ef0bd2ae30ccebfea888564",
		  },
		  //"data":"{\"username\":\"dhibakar.j@optisolbusiness.com\",\"password\":\"Optisol@123\"}"
		  "data": '{"university_name":"GSM London","offset":0,"limit":10}'
	}

	$.ajax(settingsProg).done(function (response) {
	  console.log(response);
	});
	
	var settingsFilter = {
		  "url": "http://13.235.4.44/client_api/first_level_filter/v1.0/",
		  "method": "GET",
		  "headers": {
		    "Content-Type": "application/json",
		    "Authorization": "Token 08e128cafdeef5d79ef0bd2ae30ccebfea888564",
		  },
		  //"data":"{\"username\":\"dhibakar.j@optisolbusiness.com\",\"password\":\"Optisol@123\"}"
		  //"data": '{"university_name":"GSM London","offset":0,"limit":10}'
	}

	$.ajax(settingsFilter).done(function (response) {
	  console.log(response);
	});


	// var settingsProg = {
	//   "url": "http://13.235.4.44/api/v1/wfp/api-token-auth/",
	//   "method": "POST",
	//   "headers": {
	//     "Content-Type": "application/json",
	//   },
	//   "data": "{\r\n\"username\": \"dhibakar.j@optisolbusiness.com\",\r\n\"password\": \"Optisol@123\"\r\n}"
	// }

	// $.ajax(settingsProg).done(function (response) {
	//   console.log(response);
	// });
  

  	 
});
 </script>
 
 <?php 
 $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "http://13.235.4.44/api/v1/wfp/api-token-auth/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n\"username\": \"dhibakar.j@optisolbusiness.com\",\r\n\"password\": \"Optisol@123\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: 43d55639-d3e4-4b60-b293-fc90219113c6",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "<div align='center'>cURL Error #:" . $err."</div>";
  
  
} else {
  echo $response;
  $output = json_decode($response);
  $token = $output->token;
 }
 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://13.235.4.44/client_api/first_level_filter/v1.0/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Accept-Encoding: gzip, deflate",
    "Authorization: Token 08e128cafdeef5d79ef0bd2ae30ccebfea888564",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Type: application/json",
    "Cookie: csrftoken=ADLmCNMyxIppxs3LIoKeNQrOHhUJIRr4YqwOdhJzk0sYhH2P6aODM2GKNQrl5YSI",
    "Host: 13.235.4.44",
    "Postman-Token: 3455cccc-fca1-4799-af27-fc6276aa5968,548d8128-0117-42fe-a7dc-db9f93d14904",
    "User-Agent: PostmanRuntime/7.18.0",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}