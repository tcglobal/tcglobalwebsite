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
$current_level_study_list ='';
$level_study_list .= '<ul class="select-list ">';
foreach($res as $key=>$value)
{ 
	$level_study_list .= '<li id="'.$value->levelid.'"><a class="prefferd_level_studies" data-mydata="'.$value->study_level.'"><img class="badge-active" src="'.get_template_directory_uri().'/images/badge-red.png" alt="">'.$value->study_level.'</a></li>';
	$current_level_study_list .='<li><a ><img  src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value->study_level.'</a></li>';

}

/** for leadetype as GlobalEd add 3 additional values **/
if($_GET['lead_type'] == 'GlobalEd')
{
  $current_level_study_list .='<li><a ><img  src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Year 10</a></li>';
  $current_level_study_list .='<li><a ><img  src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Year 11</a></li>';
  $current_level_study_list .='<li><a ><img  src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Year 12</a></li>';
}

$level_study_list .= '</ul>';        

/** get your area of study api list **/ 
$get_area_of_study_list = getCurlFunction($area_of_study_list,'');
$area_res = json_decode($get_area_of_study_list);

$area_list ='';
$area_list .= '<ul  class="select-list three-part ">';
foreach($area_res as $value)
{ 
	$area_list .= '<li id="'.$value->id.'"><a  class="prefferd_area_studies" data-mydata="'.$value->areaofstudy.'"><img  class="badge-active" src="'.get_template_directory_uri().'/images/badge-red.png" alt="">'.$value->areaofstudy.'</a></li>';
}
$area_list .= '</ul>';

/** get country api list **/ 
$get_country_list = getCurlFunction($country_list,'');
$country_res = json_decode($get_country_list);
$country_list = array("Canada","New Zealand","Europe","UK","Ireland","Asia","Singapore","USA","Australia","United Kingdom");
$country_name ='';
$country_name .= '<ul class="select-list">';
//$country_name .= '<li id="All"><a class="prefferd_global_ed_destinations"><img  class="badge-active" src="'.get_template_directory_uri().'/images/badge-red.png" alt="">All</a></li>';
foreach($country_res as $val)
{ 
	if (in_array($val->country, $country_list)) {
	$country_name .= '<li id="'.$val->countryid.'"><a class="prefferd_global_ed_destinations" data-mydata="'.$val->country.'"><img  class="badge-active" src="'.get_template_directory_uri().'/images/badge-red.png" alt="">'.$val->country.'</a></li>';
	}
}
$country_name .= '<li id="Other"><a class="prefferd_global_ed_destinations" data-mydata="Other"><img  class="badge-active" src="'.get_template_directory_uri().'/images/badge-red.png" alt="">Other</a></li>';

$country_name .= '</ul>';

/** get admission year api list **/ 
$get_admission_year = getCurlFunction($admission_year,'');
$admission_res = json_decode($get_admission_year);

$admission_list ='';
$admission_list .= '<ul class="select-list">';
foreach($admission_res as $admission)
{ 
	$admission_list .= '<li id="'.$admission->semid.'"><a class="prefferd_year_admissions" data-mydata="'.$admission->semester.'"><img class="badge-active" src="'.get_template_directory_uri().'/images/badge-red.png" alt="">'.$admission->semester.'</a></li>';
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


/** Get all branch locations **/
$branch_list='';
$branch_list .='<ul>';

$locationCats = get_terms(
      array(
        'taxonomy'   => 'loc_categories',
        'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC', // or ASC
        'hierarchical'  => 1,
        'parent'        => 0, // get top level categories
      )
    );

    foreach ( $locationCats as $locationCat )
    {
      
      $sub_categories = get_terms(
            array(
              'taxonomy'   => 'loc_categories',
              'hide_empty' => false,
              'orderby' => 'name',
              'order' => 'ASC', // or ASC
              'hierarchical'  => 1,
              'parent'        => $locationCat->term_id, // get child categories
            )
          );
        

      foreach ( $sub_categories as $sub_category ){
        if($sub_category->term_id!='48'){
          $branch_list .='<li><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$sub_category->name.'</a></li>';
        }
      }

    }

$branch_list .='</ul>';

/** location list end **/


?>