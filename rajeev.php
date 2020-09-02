<?php


//query string		
	//echo $data =json_encode(array("activityid" => "102","identity"=>"rajeevm@tcglobal.com","cts"=>"300320201920","activity_params['status']"=>"YES"));die;
	
	echo $data =json_encode(array("activityid" => "102","identity"=>"rajeevm@tcglobal.com","cts"=>"300320201920","activity_params"=>array("status"=>"YES")));die;
	
	
	$ch = curl_init('https://api.netcoresmartech.com/v1/activity/singleactivity/ADGMOT35CHFLVDHBJNIG50K968K4JQ74CUBVRBGCPDMEBDG6KT80');		
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
	$result = curl_exec($ch);
	print_r($result);	
	curl_close($ch);	
	die('sdfd');







//die('rajeev');
	
	
	$url="https://api.netcoresmartech.com/apiv2?type=contact&activity=add";

$data=array("apikey"=>"12a9b944c95e18933612fe1d508a724b","data"=>'{"EMAIL": "rajeevm@tcglobal.com", "MOBILE":9811019534, "FIRST_NAME": "Rajeev"}');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return into a variable
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //check for https 

        $result = curl_exec($ch); // run the whole process

        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        echo "result($result) status_code($http_status)"; die();

        $info = curl_getinfo($ch);

print_r($info);die('rajeev');
	
	
	
	
	
	
	/*
	$data = json_encode(array("FIRST_NAME" => "Rajeev","EMAIL"=>"rajeevm@tcglobal.com","MOBILE"=>"9811019534","AGE"=>"34", "CITY"=>"Delhi"));
	//$ch = curl_init('https://api.netcoresmartech.com/apiv2?type=contact&activity=add&listid=4&apikey=12a9b944c95e18933612fe1d508a724b');		
	$ch = curl_init('https://api.netcoresmartech.com/apiv2?type=contact&activity=addsync&listid=4&apikey=12a9b944c95e18933612fe1d508a724b');		
	//curl_setopt($ch, CURLOPT_POST, 1);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	$result = curl_exec($ch);
	print_r($result);	
	curl_close($ch);	
	die('sdfd');
*/






/*
require 'webconfig.php'; 
webconfig::DBConnect();

$query = "select count(distinct studmastccpl_view.studid) as count,empmastccpl_view.compid from studmastccpl_view inner join studmastsupl on studmastccpl_view.studid=studmastsupl.studid inner join empmastccpl_view on empmastccpl_view.empid=studmastccpl_view.pcounsel inner join ststatmast on ststatmast.stid=studmastsupl.stid where studmastsupl.applied=false and inactive=false and datereg is not null and (status not ilike '%enrolled%' or status not ilike '%kaplan%') and studmastccpl_view.semester in (245,246,247,248,249) and ststatmast.stid in (193,205,194,195,196,197,198,199,200,201,202,203,204,244,209) group by compid";

$result = pg_query($query);
$rows	= pg_fetch_array($result);
print_r($rows);
*/
?>

<!doctype html>
<html ng-app="ui.bootstrap.demo">
  <head>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-sanitize.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
    <script src="test.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

<div ng-controller="CarouselDemoCtrl" ng-init="postBirth('previous')">
  <div style="height: 305px">
    <div uib-carousel active="active" interval="myInterval" no-wrap="noWrapSlides">
      <div uib-slide ng-repeat="slide in slides track by slide.id" index="slide.id">
        <img ng-src="{{slide.image}}" style="margin:auto;">

          <h4>Slide {{slide.id}}</h4>
          <p>{{slide.text}}</p>

      </div>
    </div>
  </div>
</div>