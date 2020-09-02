<?php


  /** search api starts here  */
$userdata = [];
$userdata['username'] = 'dhibakar.j@optisolbusiness.com';
$userdata['password'] = 'Optisol@123';
$userdataurl =  'http://13.235.4.44/api/v1/wfp/api-token-auth/';
$get_token = curlFunction($userdataurl,$userdata,'');
$output = json_decode($get_token);
$user_token=null;
if($output){
	$user_token = $output->token;
}
// print_r($user_token);exit;
$postVal = $_POST;
$min_tuition_fee = 0; 
if($postVal['page_type']=='searchresult')
{
	$data = [];
	$data['offset'] = (int)$_POST['offset'];
	$data['limit'] = (int)$_POST['limit'];
	$data['min_tuition_fee']=(int)$min_tuition_fee;
	if($postVal['sortBy']=="Country")
	{
		$data['sortBy'] = 'country_name';
	}
	else if($postVal['sortBy']=="Area of study")
	{
		$data['area_of_study'] = 'prog_name';
	}
	else if($postVal['sortBy']=="University")
	{
		$data['sortBy'] = 'university_name';
	}
	else
	{
		$data['sortBy'] = 'prog_name';
	}
	
	//$data['sortBy'] = $_POST['sortBy']?$_POST['sortBy']:'prog_name';
	
	// level 1 filter value
	if(!empty($_POST['area_Of_Study']))
	$data['area_of_study'] = $_POST['area_Of_Study'];
	
	if(!empty($_POST['country_name']))
	$data['country_name'] = $_POST['country_name'];
	$progName=array();
	if(!empty($_POST['specialization'])){
		$specialVal=explode(',',$_POST['specialization']);
		foreach ($specialVal as $key => $special) {
			array_push($progName,trim($special));
		}
	}
	if(count($progName)>0){
		$data['prog_name'] = implode(',',$progName);
	}
	
	if(!empty($_POST['studyLevel']))
	$data['prog_level'] = $_POST['studyLevel'];
	
	// level 2 filter value
	if(!empty($_POST['university_name']))
	$data['university_name'] = implode(",",$_POST['university_name']);
	
	if(!empty($_POST['prog_campus']))
	$data['prog_campus'] = implode(",",$_POST['prog_campus']);
	
	if(!empty($_POST['mode_of_study']))
	$data['prog_mode'] = $_POST['mode_of_study'];
	
	if(!empty($_POST['universityorientation']))
	$data['er_sat'] = $_POST['universityorientation'];

	if(!empty($_POST['feesRangemin']) || !empty($_POST['feesRange']))
	$data['prog_fees_value'] = $_POST['feesRangemin'].'-'.$_POST['feesRange'];

	$proStartDate=array();
	if(!empty($_POST['month'])){
		$monthSelected = explode(",",$_POST['month']);
		foreach ($monthSelected as $key => $value) {
			if($_POST['intake']){
				$startDate=$value.'-'.$_POST['intake'];
			}else{
				$startDate=$value;
			}
			array_push($proStartDate,$startDate);
		}
	}
	if(count($proStartDate)>0){
		$data['Prog_start_date']=implode(',',$proStartDate);
	}

	$prog_duration_value=array();
	$prog_duration_unit=array();
	if(!empty($_POST['durationOfCourse'])){
		$explodeVal=explode(',',$_POST['durationOfCourse']);
		foreach ($explodeVal as $key => $duration) {
			$duration=explode(' ',$duration);
			array_push($prog_duration_value,$duration[0]);
			array_push($prog_duration_unit,$duration[1]);
		}
		
	}
	if(!empty($_POST['durationOfCoursePostGraduate'])){
		$explodeVal=explode(',',$_POST['durationOfCoursePostGraduate']);
		foreach ($explodeVal as $key => $duration) {
			$duration=explode(' ',$duration);
			array_push($prog_duration_value,$duration[0]);
			array_push($prog_duration_unit,$duration[1]);
		}
	}
	if(count($prog_duration_value)>0){
		$data['prog_duration_value']=implode(',',$prog_duration_value);
	}
	if(count($prog_duration_unit)>0){
		$data['prog_duration_unit']=implode(',',$prog_duration_unit);
	}
	if(!empty($_POST['acceptedexams'])){
		$acceptedTest = explode(",",$_POST['acceptedexams']);
		foreach($acceptedTest as $test){
			if($test=='SAT')
			{
				$data['er_sat'] = $test;
			}
			if($test=='GRE')
			{
				$data['er_gre'] = $test;
			}
			if($test=='GMAT')
			{
				$data['er_gmat'] = $test;
			}
		}
	}
	if(!empty($_POST['acceptedlanguage'])){
		$acceptedTestLanguage = explode(",",$_POST['acceptedlanguage']);
		foreach($acceptedTestLanguage as $language){
			if($language=='IELTS')
			{
				$data['er_ielts'] = $language;
			}
			if($language=='PTE')
			{
				$data['er_pte'] = $language;
			}
			if($language=='TOEFL')
			{
				$data['er_toefl'] = $language;
			}
		}

	}
	$prog_data_url = "http://13.235.4.44/client_api/program_data/v1.0/";
	$apiresponse = curlFunction($prog_data_url,$data,$user_token);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse));
	echo json_encode($program_output);
}
else if($postVal['page_type']=='coursedetail'){ // course detail page api call 
	$data=[];
	$prog_data_url = "http://13.235.4.44/client_api/program_data/v1.0/";
	$data['prog_id']=(int)$postVal['prog_id'];
	$courseDetail=curlFunction($prog_data_url,$data,$user_token);
	$courseDetailOutput = array('status'=>true,'result'=>json_decode($courseDetail));
	echo json_encode($courseDetailOutput);
}else if($postVal['page_type']=='first_level_filter'){ //first level filter api 
	$filter_url = "http://13.235.4.44/client_api/first_level_filter/v1.0/";
	$countryListUrl="https://www.tcglobal.com/globalapi/country.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1";
	$apiresponse = curlFunctionGet($filter_url,$user_token);
	$countryList=retriveData($countryListUrl);
	$program_output = array('status'=>true,'result'=>json_decode($apiresponse),'countryList'=>$countryList);
	echo json_encode($program_output);
}else if($postVal['page_type']==='second_level_filter'){ //second level filter api 
	getUniversityList();
}


function curlFunction($url,$data,$token)
{	
		$header = array("Content-Type: application/json");
		$tokenVal = '';
		if($token){
			$header = array("Authorization: Token ".$token,"Content-Type: application/json");
		}
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => $header,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);	
		curl_close($curl);
		if ($err) {
			return null; 
		} else {
			return $response;
		}
}


function curlFunctionGet($url,$token)
{
	  $header = array("Content-Type: application/json");
	  $tokenVal = '';
	  if($token){
	  	$header = array("Authorization: Token ".$token,"Content-Type: application/json");
	  }
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => $header,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);	
		curl_close($curl);
		if ($err) {
			return null;
		} else {
		return $response;
		}
}
/** To get university list  */
function getUniversityList(){
	$country=$_POST['country'];
	$url="https://www.tcglobal.com/globalapi/university.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1&country=".$country;
	$list=retriveData($url);
	$cities=getCityList();
	$univer=array('status'=>true,'list'=>$list,'citylist'=>$cities);
	echo json_encode($univer); 
}
  /**To get city list  */
function getCityList(){
	$country=$_POST['country'];
	$url="https://www.tcglobal.com/globalapi/city.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1&country=".$country;
	$clityList=retriveData($url);
	return $clityList;
}

function retriveData($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$curl_errno = curl_errno($ch);
	$curl_error = curl_error($ch);
	if($curl_errno > 0) {
		$list = array();
	} else { 
		$list = json_decode($result);
	} 
	curl_close($ch);
	return $list;
}
?>

