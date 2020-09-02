<?php


//$countryListUrl="https://tcglobalportalservice.optisolbusiness.com/api/website/countries";

$countryListUrl="https://tcgstagingservice.optisolbusiness.com/api/website/countries";

$feesAPI = "https://tcgstagingservice.optisolbusiness.com/api/website/getPreferredTutionFees";

$res = '';
$countrydata = '';
$countryListflag = '';

$countryList=getFilterFunction($countryListUrl);
$res = json_decode($countryList);
$list = $res->result->countries;

$countryFlagFetch = $list;

foreach ($list as $value) {
	
	$countrydata .= '<option value="'.$value->country.'">'.$value->country.'</option>';
}

$countryListflag = json_encode($countryFlagFetch); // to get country flag

/** tuition fee range slider data **/
	$tuitionfee = getFilterFunction($feesAPI);
	$result = json_decode($tuitionfee);
 	$feerangemin = $result->result->fees_range->min_value;
 	$feerangemax = $result->result->fees_range->max_value;

function getFilterFunction($url)
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










?>