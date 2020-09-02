<?php

$token = 'sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345';
$username = 'optisol';
$password = '7ae632e6-a11a-4e3c-b01d-02901d5ab1c1';

$orientation_api = 'https://gei.tcglobal.com/globalapi/university_orientation.php?username='.$username.'&password='.$password.'&token='.$token.'';
//$areaOfStudy_api = 'https://gei.tcglobal.com/globalapi/area_of_study.php?token='.$token.'&username='.$username.'&password='.$password.'';

$result = '';
$get_orientation_list = FetchCurlFunction($orientation_api,'');
$result = json_decode($get_orientation_list);

/** Get university orientation api list **/
$university_orientation = '';

$university_orientation .='<option value=""></option>';
foreach($result as $value)
{ 
	$university_orientation .= '<option value="'.$value->orientation.'">'.$value->orientation.'</option>';
}

/** end **/

/** search page - Area of study list -start **/

$studylist_res = $wpdb->get_results('SELECT area_of_study FROM tc19_areaofstudy_list');

foreach ( $studylist_res as $res) {
	$areaofstudyname .= '<option value="'.$res->area_of_study.'">'.$res->area_of_study.'</option>';
}

/** Area of study list api - end **/

/** search page - course specialization list  **/

/*$course_list='';
$course_res = $wpdb->get_results('SELECT course_name FROM tc19_specialization');
foreach ( $course_res as $data) {
	$course_list .= '<option value="'.$data->course_name.'">'.$data->course_name.'</option>';
}*/

/** end **/

/** Call Api Function **/
function FetchCurlFunction($url, $data){

$header = array("content-type: multipart/form-data");
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $data,
	  CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	return $response;

}












?>