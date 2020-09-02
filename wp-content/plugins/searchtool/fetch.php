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
//$min_tuition_fee = 0; 
if($postVal['page_type']=='searchresult')
{
	$data = [];
	$data['offset'] = (int)$_POST['offset'];
	$data['limit'] = (int)$_POST['limit'];
	//$data['min_tuition_fee']=(int)$min_tuition_fee;

	if(!empty($_POST['sortBy'])){
		$data['sortBy'] = trim($_POST['sortBy']);
	}
	
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
	/*if(!empty($_POST['university_name']))
	$data['university_name'] = trim($_POST['university_name']);*/

	if(!empty($_POST['university_name'])){
		
		$checkVal = '';
		$checkVal = is_array($_POST['university_name'])?'array':'string';

		if($checkVal == "string"){
			$data['university_name'] = trim($_POST['university_name']);
		}
		else{

			$adduniversity = '';
			$iterateuni = $_POST['university_name'];
			foreach ( $iterateuni as $value) {
				$adduniversity .= trim($value).'|';
			}
			$data['university_name'] = rtrim($adduniversity,'|');

		}
		
	}


	
	if(!empty($_POST['prog_campus']))
	$data['prog_campus'] = implode(",",$_POST['prog_campus']);
	
	if(!empty($_POST['mode_of_study']))
	$data['prog_mode'] = $_POST['mode_of_study'];
	
	if(!empty($_POST['universityorientation']))
	$data['er_sat'] = $_POST['universityorientation'];

	if(!empty($_POST['feesRangemin']) || !empty($_POST['feesRange'])){
		$data['min_tuition_fee'] = (int)$_POST['feesRangemin'];
		$data['max_tuition_fee'] =(int) $_POST['feesRange'];
	}

	if(!empty($_POST['month'])){
		$data['month'] = $_POST['month'];
	}

	if(!empty($_POST['intake'])){
		$data['year'] = (int)$_POST['intake'];
	}

	$prog_duration_value=array();
	$prog_duration_unit=array();
	if(!empty($_POST['durationOfCourse'])){
		$explodeVal=explode(',',$_POST['durationOfCourse']);
		foreach ($explodeVal as $key => $duration) {
			array_push($prog_duration_value,$duration);
		}
		
	}
	// if(!empty($_POST['durationOfCoursePostGraduate'])){
	// 	$explodeVal=explode(',',$_POST['durationOfCoursePostGraduate']);
	// 	foreach ($explodeVal as $key => $duration) {
	// 		$duration=explode(' ',$duration);
	// 		array_push($prog_duration_value,$duration[0]);
	// 		array_push($prog_duration_unit,$duration[1]);
	// 	}
	// }
	if(count($prog_duration_value)>0){
		$data['prog_duration_value']=implode(',',$prog_duration_value);
	}
	// if(count($prog_duration_unit)>0){
	// 	$data['prog_duration_unit']=implode(',',$prog_duration_unit);
	// }
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

	$prog_data_url = "https://tcgstagingservice.optisolbusiness.com/api/website/searchCourse";

	//$prog_data_url = "https://tcglobalportalservice.optisolbusiness.com/api/website/searchCourse";
	echo $apiresponse = curlFunction($prog_data_url,$data);

}
else if($postVal['page_type']=='coursedetail'){ // course detail page api call 
	$data=[];
	$prog_data_url = "http://13.235.4.44/client_api/program_data/v1.0/";
	$data['prog_id']=(int)$postVal['prog_id'];
	$courseDetail=curlFunction($prog_data_url,$data,$user_token);
	$courseDetailOutput = array('status'=>true,'result'=>json_decode($courseDetail));
	echo json_encode($courseDetailOutput);
}

else if($postVal['page_type']=='country_filter'){
	//$countryListUrl="https://tcglobalportalservice.optisolbusiness.com/api/website/countries";
	$countryListUrl="https://tcgstagingservice.optisolbusiness.com/api/website/countries";
	echo $countryList=curlFunctionGet($countryListUrl);
}
else if($postVal['page_type']=='first_level_filter'){ //first level filter api 
	
	//$filter_url = "https://tcglobalportalservice.optisolbusiness.com/api/website/filtervalues";
	$filter_url = "https://tcgstagingservice.optisolbusiness.com/api/website/filtervalues";
	echo $filterdata = curlFunctionGet($filter_url);
}

elseif ($postVal['page_type']=='specialization_filter') {

	if(isset($_POST['area_of_study']))
	{

	$area_of_study = $_POST['area_of_study'];
	$postdata= array('area_of_study'=>$area_of_study); // Add parameters in key value
	$posturl = "https://tcgstagingservice.optisolbusiness.com/api/website/filtervalues/specialization";
	//$posturl = "https://tcglobalportalservice.optisolbusiness.com/api/website/filtervalues/specialization";
	echo $apiresult = curlFunctionPost($posturl,$postdata);
	}
}

else if($postVal['page_type']=='university_filter'){  
	$filterVal = [];
	
	if(!empty($_POST['country_name']))
	$filterVal['country_name'] = $_POST['country_name'];

	if(!empty($_POST['prog_level']))
	$filterVal['prog_level'] = $_POST['prog_level'];
	
	if(!empty($_POST['area_of_study']))
	$filterVal['area_of_study'] = $_POST['area_of_study'];
	
	if(!empty($_POST['prog_name']))
	$filterVal['prog_name'] = $_POST['prog_name'];

	//$universe_url = "https://tcglobalportalservice.optisolbusiness.com/api/website/getUniversities";

	$universe_url = "https://tcgstagingservice.optisolbusiness.com/api/website/getUniversities";
	
	echo $universitydata = curlFunction($universe_url,$filterVal);
}

else if($postVal['page_type']==='second_level_filter'){ //second level filter api 
	getUniversityList();
}


function curlFunction($url,$data)
{	
		$header = array("Content-Type: application/json");
		
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


function curlFunctionGet($url)
{
	  $header = array("Content-Type: application/json");
	  
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
	$countryListName='';
	if(isset($_POST['country'])){
		$country=$_POST['country'];
		if($country && count($country)>0){
			foreach ($country as $key => $list) {
				$countryListName.=trim($list).',';
			}
			$countryListName=trim($countryListName, ",");
		}
	}
	
	$url="https://gei.tcglobal.com/globalapi/university.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1";
	if($countryListName){
		$url="https://gei.tcglobal.com/globalapi/university.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1&country=".$countryListName;
	}
	// print_r($url);exit;
	$list=retriveData($url);
	$cities=getCityList();
	$univer=array('status'=>true,'list'=>$list,'citylist'=>$cities);
	echo json_encode($univer); 
}
  /**To get city list  */
function getCityList(){
	$countryListName='';
	if(isset($_POST['country'])){
		$country=$_POST['country'];
		if($country && count($country)>0){
			foreach ($country as $key => $list) {
				$countryListName.=trim($list).',';
			}
			$countryListName=trim($countryListName, ",");
		}
	}
	$url="https://gei.tcglobal.com/globalapi/city.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1";
	if($countryListName){
		$url="https://gei.tcglobal.com/globalapi/city.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1&country=".$countryListName;
	}
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


function curlFunctionPost($url,$data){

	$ch = curl_init();// Initiate cURL
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, true);  // Tell cURL you want to post something
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Define what you want to post
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the output in string format
    $response = curl_exec ($ch); // Execute
    $err = curl_error($ch);
    curl_close ($ch); // Close cURL handle

    if ($err) {
		return null;
	} else {
		return $response;
	}
}

?>