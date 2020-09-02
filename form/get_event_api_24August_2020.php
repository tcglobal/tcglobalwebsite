<?php

$token = 'sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345';
$username = 'optisol';
$password = '7ae632e6-a11a-4e3c-b01d-02901d5ab1c1';

$study_list = 'https://gei.tcglobal.com/globalapi/level_of_study.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1';
$area_of_study_list = 'https://gei.tcglobal.com/globalapi/area_of_study.php?token='.$token.'&username='.$username.'&password='.$password.'';
$country_list = 'https://gei.tcglobal.com/globalapi/country.php?token='.$token.'&username='.$username.'&password='.$password.'';
$admission_year = 'https://gei.tcglobal.com/globalapi/admission_year.php?token='.$token.'&username='.$username.'&password='.$password.'';

/** get your level of study api list **/
$get_study_list = getCurlFunction($study_list,'');
$res = json_decode($get_study_list);
$level_study_list ='';
$level_study_list .= '<ul id="level-of-study">';
foreach($res as $key=>$value)
{ 
	$level_study_list .= '<li id="'.$value->levelid.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value->study_level.'</a></li>';
}
$level_study_list .= '</ul>';        

/** get your area of study api list **/ 
$get_area_of_study_list = getCurlFunction($area_of_study_list,'');
$area_res = json_decode($get_area_of_study_list);

$area_list ='';
$area_list .= '<ul id="area-of-study">';
foreach($area_res as $value)
{ 
	$area_list .= '<li id="'.$value->id.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value->areaofstudy.'</a></li>';
}
$area_list .= '</ul>';

/** get country api list **/ 
$get_country_list = getCurlFunction($country_list,'');
$country_res = json_decode($get_country_list);

$country_name ='';
$country_name .= '<ul id="list-of-country">';
foreach($country_res as $val)
{ 
	$country_name .= '<li id="'.$val->countryid.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$val->country.'</a></li>';
}
$country_name .= '</ul>';

/** get admission year api list **/ 
$get_admission_year = getCurlFunction($admission_year,'');
$admission_res = json_decode($get_admission_year);

$admission_list ='';
$admission_list .= '<ul id="admission-list">';
foreach($admission_res as $admission)
{ 
	$admission_list .= '<li id="'.$admission->semid.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$admission->semester.'</a></li>';
}
$admission_list .= '</ul>';


function getCurlFunction($url, $data){

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