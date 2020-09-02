<?php
namespace Searchtool\Api;
class Service
{
    /**
     * Curl get method
     */
    public function curlGetMethod($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return $output;
    }
    /**
     * Curl post method
     */
    public function curlPostMethod($url,$data){
        $ch = curl_init();
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password"); 
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return $output;
    }

     /**
     * to get results from specific table
     */
    public function getCountryList(){
        global $wpdb;
        $response=$wpdb->get_results("select * from country where country_id IN(SELECT country_id FROM courses)");
        return $response;
    }
    /**
     * to get University List 
     */
    public function getUniversityList($params){
        global $wpdb;
        $query=null;
        if($params['country']){
            $query.=$query!=''? " AND u.country_id=".$params['country']:" where u.country_id=".$params['country'];
        }
        if($params['city']){
            $query.=$query!=''? " AND city='".$params['city']."'":" where city='".$params['city']."'";
        }
        if($params['areaOfStudy']){
            $query.=$query!=''? " AND prog_aos='".$params['areaOfStudy']."'":" where prog_aos='".$params['areaOfStudy']."'";
        }
        if($params['studyLevel']){
            $query.=$query!=''? " AND prog_level='".$params['studyLevel']."'":" where prog_level='".$params['studyLevel']."'";
        }
        if($params['specialization']){
            $query.=$query!=''? " AND prog_type='".$params['specialization']."'":" where prog_type='".$params['specialization']."'";
        }
    
       $univQuery="(select  u.university_id,u.university_name,u.city FROM `universities` u 
                        Left join courses co on u.university_id=co.university_id
                       ";  
            $univQuery=$univQuery.$query.$filterquery." )";
            $courseQuery="( select  cu.university_id,cu.university_name,cu.city  from courses u Left join country c on c.country_id=u.country_id  Left join universities cu on cu.university_id=u.university_id  ";
            $courseQuery=$courseQuery.$query.$courseFilterquery." )";
            $response=$wpdb->get_results( $univQuery." UNION " .$courseQuery);
        return $response;
    }
    /**
     * to get cities 
     */
    public function getCities($table_name,$params){
        global $wpdb;
        $query=null;
        if($params['country']){
            $query.=$query!=''? " AND u.country_id=".$params['country']:" where u.country_id=".$params['country'];
        }
        if($params['city']){
            $query.=$query!=''? " AND city='".$params['city']."'":" where city='".$params['city']."'";
        }
        if($params['areaOfStudy']){
            $query.=$query!=''? " AND prog_aos='".$params['areaOfStudy']."'":" where prog_aos='".$params['areaOfStudy']."'";
        }
        if($params['studyLevel']){
            $query.=$query!=''? " AND prog_level='".$params['studyLevel']."'":" where prog_level='".$params['studyLevel']."'";
        }
        if($params['specialization']){
            $query.=$query!=''? " AND prog_type='".$params['specialization']."'":" where prog_type='".$params['specialization']."'";
        }
        
       $univQuery="select * from ((select  u.university_id,u.university_name,u.city FROM `universities` u 
                        Left join courses co on u.university_id=co.university_id
                       ";  
            $univQuery=$univQuery.$query." )";
            $courseQuery="( select  cu.university_id,cu.university_name,cu.city  from courses u Left join country c on c.country_id=u.country_id Left join universities cu on cu.university_id=u.university_id ";
            $courseQuery=$courseQuery.$query."  ))t  group by city";
            $response=$wpdb->get_results( $univQuery." UNION " .$courseQuery);
        return $response;
    }
    /**
     * to get courses list for dropdown  
     */
    public function getCourseList(){
        global $wpdb;
        $response=$wpdb->get_results( "SELECT course_id,prog_aos FROM courses group by prog_aos");
        return $response;
    }

     /**
     * to get study level list for dropdown  
     */
    public function getStudyLevel(){
        global $wpdb;
        $response=$wpdb->get_results( "SELECT course_id,prog_level FROM courses group by prog_level");
        return $response;
    }

     /**
     * to get standard test  
     */
    public function getStandardTests($params){
        global $wpdb;
        if($params['country']){
            $response=$wpdb->get_results( "SELECT standardized_test FROM country where country_id=".$params['country']);
        }else{
            $response=$wpdb->get_results( "SELECT standardized_test FROM country group by standardized_test");
        }
        return $response;
    }

     /**
     * to get standard test  
     */
    public function getSpecialization(){
        global $wpdb;
        $response=$wpdb->get_results( "SELECT course_id,prog_type FROM courses group by prog_type");
        return $response;
    }

    /**
     * to get intake year 
     */
   public function getIntakeYear($params){
    global $wpdb;
    $query=null;
    if($params['country']){
        $query.=$query!=''? " AND u.country_id=".$params['country']:" where u.country_id=".$params['country'];
    }
    if($params['city']){
        $query.=$query!=''? " AND city='".$params['city']."'":" where city='".$params['city']."'";
    }
    if($params['areaOfStudy']){
        $query.=$query!=''? " AND prog_aos='".$params['areaOfStudy']."'":" where prog_aos='".$params['areaOfStudy']."'";
    }
    if($params['studyLevel']){
        $query.=$query!=''? " AND prog_level='".$params['studyLevel']."'":" where prog_level='".$params['studyLevel']."'";
    }
    if($params['specialization']){
        $query.=$query!=''? " AND prog_type='".$params['specialization']."'":" where prog_type='".$params['specialization']."'";
    }
    
    $univQuery="select *from((select u.university_id ,u.intakes FROM `universities` u 
    Left join courses co on u.university_id=co.university_id 
    "; 
    $univQuery=$univQuery.$query." )";
    $courseQuery="( select cu.university_id,cu.intakes from courses u Left join country c on c.country_id=u.country_id Left join universities cu on cu.university_id=u.university_id ";
    $courseQuery=$courseQuery.$query." ))t group by intakes";
    $response=$wpdb->get_results( $univQuery." UNION " .$courseQuery);
    return $response;
 }

    /**
     * to get Tution Fees
     */
    public function getTutionFees($params){
        global $wpdb;
         $query=null;
        if($params['country']){
            $query.=$query!=''? " AND u.country_id=".$params['country']:" where u.country_id=".$params['country'];
        }
        if($params['city']){
            $query.=$query!=''? " AND city='".$params['city']."'":" where city='".$params['city']."'";
        }
        if($params['areaOfStudy']){
            $query.=$query!=''? " AND prog_aos='".$params['areaOfStudy']."'":" where prog_aos='".$params['areaOfStudy']."'";
        }
        if($params['studyLevel']){
            $query.=$query!=''? " AND prog_level='".$params['studyLevel']."'":" where prog_level='".$params['studyLevel']."'";
        }
        if($params['specialization']){
            $query.=$query!=''? " AND prog_type='".$params['specialization']."'":" where prog_type='".$params['specialization']."'";
        }
       
    
       $univQuery="select max(tution_fees) as tution_fees from ((select max(u.tution_fees) as tution_fees FROM `universities` u 
                        Left join courses co on u.university_id=co.university_id
                       ";  
            $univQuery=$univQuery.$query.$filterquery." )";
            $courseQuery="( select max(u.prog_fees_value) as tution_fees from courses u Left join country c on c.country_id=u.country_id Left join universities cu on cu.university_id=u.university_id  ";
            $courseQuery=$courseQuery.$query."  ))t ";
          $response=$wpdb->get_results( $univQuery." UNION " .$courseQuery);
        $fees=Constants::CONST_ZERO;
        if($response && $response[0] && $response[0]->tution_fees){
            $fees=$response[0]->tution_fees;
        }
        return $fees;
        
    }

    /**
     * Handles search result
     */
    public function getSearchResult($params){
        global $wpdb;
        $query='';
        $off=$params['off'];
        $limit=$params['limit'];
        $tableName='';
        if($params['showlist'] && ((int)$params['showlist']===Constants::CONST_ONE)){
            $tableName='courses';
            $sorting=" order by u.course_id DESC ";
        }
        if($params['showlist'] && (int)$params['showlist']===Constants::CONST_TWO){
            $tableName='universities';
            $sorting=" order by u.university_id DESC ";
        }
        if($params['sortBy'] && (int)$params['sortBy']===Constants::CONST_ONE){
            $sorting=" order by ranking ASC ";
        }
        if($params['sortBy'] && (int)$params['sortBy']===Constants::CONST_TWO){
            $sorting=" order by id DESC ";
        }
        if($params['sortBy'] && (int)$params['sortBy']===Constants::CONST_THREE){
            $sorting=" order by tution_fees ASC ";
        }
        if($params['sortBy'] && (int)$params['sortBy']===Constants::CONST_FOUR){
            $sorting=" order by tution_fees DESC ";
        }
        
        if($params['university']){
            $query.=$query!=''? " AND u.university_id=".$params['university']: " where u.university_id=".$params['university'];
        }
        if($params['city']){
            $query.=$query!=''? " AND city='".$params['city']."'":" where city='".$params['city']."'";
        }
        if($params['country']){
            $query.=$query!=''? " AND u.country_id=".$params['country']:" where u.country_id=".$params['country'];
        }
        if($params['areaOfStudy']){
            $query.=$query!=''? " AND prog_aos='".$params['areaOfStudy']."'":" where prog_aos='".$params['areaOfStudy']."'";
        }
        if($params['studyLevel']){
            $query.=$query!=''? " AND prog_level='".$params['studyLevel']."'":" where prog_level='".$params['studyLevel']."'";
        }
        if($params['specialization']){
            $query.=$query!=''? " AND prog_type='".$params['specialization']."'":" where prog_type='".$params['specialization']."'";
        }
        if($params['intake'] && $tableName==='universities'){
            $query.=$query!=''? " AND u.intakes=".$params['intake']:" where u.intakes=".$params['intake'];
        }
        if($params['feesRange'] && strpos($params['feesRange'], ';') !== false){
            $splitted=explode(';',$params['feesRange']);
            if($splitted && $splitted[1] > 0 ){
                  if($tableName==='universities'){
                    $query.=$query!=''  ? " AND (u.tution_fees<=".$splitted[1]." AND u.tution_fees>=".$splitted[0].")":" where (u.tution_fees<=".$splitted[1]." AND u.tution_fees>=".$splitted[0].")";
                  }else if($tableName==='courses'){
                    $query.=$query!='' ? " AND (u.prog_fees_value<=".$splitted[1]." AND u.prog_fees_value>=".$splitted[0].")":" where (u.prog_fees_value<=".$splitted[1]." AND u.prog_fees_value>=".$splitted[0].")";
                  }
            }
        }
        if($params['acceptedTestSelected'] && count($params['acceptedTestSelected'])>Constants::CONST_ZERO){
            foreach ($params['acceptedTestSelected'] as $key => $value) {
                $testArra.="'".$value."'".',';
            }
            $testArra=rtrim($testArra, ',');
            $query.=$query!=''? " AND c.standardized_test in(".$testArra.")":" where c.standardized_test in (".$testArra.")";
        }
        if($tableName==='universities'){
            $basicQuery="SELECT  u.created_at, u.university_id as id ,u.university_name as name ,u.ranking,u.city,u.tution_fees,
                        c.country_name,ad.intake,'' as prog_start_date, 'univeristy' as showType,'' as univName FROM ";
            $subQuery=" Left join application_deadline ad on ad.university_id=u.university_id
                        Left join country c on c.country_id=u.country_id
                        Left join courses co on u.university_id=co.university_id
                       ";
            $records=$wpdb->get_results( $basicQuery.$tableName." u  ".$subQuery.$query.$sorting." limit ".$off.",".$limit);
            $totalRecord=$wpdb->get_results( "SELECT count(*) as totalRecord FROM ".$tableName." u  ".$subQuery.$query);
        }else if($tableName==='courses'){
            $basicQuery="SELECT  u.created_at, u.course_id as id,u.course_name as name, cu.ranking as ranking,''as city,u.prog_fees_value as tution_fees,c.country_name,''as intake ,u.prog_start_date, 'course' as showType,cu.university_name as univName FROM ";
            $subQuery="Left join country c on c.country_id=u.country_id 
                        Left join universities cu on cu.university_id=u.university_id
                       ";
            $records=$wpdb->get_results( $basicQuery.$tableName." u  ".$subQuery.$query.$sorting." limit ".$off.",".$limit);
            $totalRecord=$wpdb->get_results( "SELECT count(*) as totalRecord FROM ".$tableName." u  ".$subQuery.$query);
        }
        else{
            $orderQuery=$sorting?$sorting:" order by created_at DESC ";
            $filterquery='';  $courseFilterquery='';
            if($params['intake']){
                $filterquery.=$query!='' || $filterquery!='' ? " AND u.intakes=".$params['intake']:" where u.intakes=".$params['intake'];
                $courseFilterquery.=$query!='' || $courseFilterquery!='' ? " AND u.intakes=".$params['intake']:" where u.intakes=".$params['intake'];
            }
            if($params['feesRange'] && strpos($params['feesRange'], ';') !== false){
                $splitted=explode(';',$params['feesRange']);
                if($splitted[1] > 0){
                    $filterquery.=$query!='' || $filterquery!='' ? " AND (u.tution_fees<=".$splitted[1]." AND u.tution_fees>=".$splitted[0].")":" where (u.tution_fees<=".$splitted[1]." AND u.tution_fees>=".$splitted[0].")";
                    $courseFilterquery.=$query!='' || $courseFilterquery!='' ? " AND (u.prog_fees_value<=".$splitted[1]." AND u.prog_fees_value>=".$splitted[0].")":" where (u.prog_fees_value<=".$splitted[1]." AND u.prog_fees_value>=".$splitted[0].")";
                }
            }
            $univQuery="(select  u.created_at,u.university_id as id,u.university_name as name ,u.ranking,u.city,u.tution_fees,
                        c.country_name,ad.intake,'' as prog_start_date, 'univeristy' as showType,'' as univName FROM `universities` u 
                        Left join application_deadline ad on ad.university_id=u.university_id
                        Left join courses co on u.university_id=co.university_id
                        Left join country c on c.country_id=u.country_id
                      ";  
            $univQuery=$univQuery.$query.$filterquery." )";
            $courseQuery="( select u.created_at,u.course_id as id ,u.course_name as name,
             cu.ranking as ranking,''as city,u.prog_fees_value as tution_fees,
             c.country_name,''as intake ,u.prog_start_date, 'course' as showType,
             cu.university_name as univName from courses
             u Left join country c on c.country_id=u.country_id 
              Left join universities cu on cu.university_id=u.university_id  ";
            $courseQuery=$courseQuery.$query.$courseFilterquery." )";
            $records=$wpdb->get_results( $univQuery." UNION " .$courseQuery .$orderQuery ." limit ".$off.",".$limit);
            $totalQuery="select count(*) as totalRecord  from (".$univQuery." UNION " .$courseQuery." )t " ;
            $totalRecord=$wpdb->get_results($totalQuery);
        }
        // print_r($basicQuery.$tableName." u  ".$subQuery.$query.$sorting." limit ".$off.",".$limit);
         //print_r($univQuery." UNION " .$courseQuery .$orderQuery ." limit ".$off.",".$limit);
        // print_r($query);
         //exit;
        $response=array('searchResult'=>$records,'totalRecord'=>$totalRecord[0]->totalRecord);
        return $response;
    }

    /**
     * get university  details by id 
     */
    public function getUniversityDetails($param){
        global $wpdb;
        $response=$wpdb->get_results( "SELECT u.*,c.country_name FROM universities u Left Join country c on u.country_id=c.country_id   where u. university_id=".$param['id']);
        $result=Self::get_lat_long($response);
        $detail=$response && $response[0] ? $response[0]:null;
        $univerityDetail=array('details'=>$detail,'coordinates'=>$result);
        return $univerityDetail;
        // print_r($universityDetail);exit();
    }
    /**
     * To get university coordinates from address 
     */
    public function get_lat_long($response){
        $address=$response[0]->location.",".$response[0]->city.",".$response[0]->country_name;
        $address = str_replace(" ", "+", $address);
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=".Constants::GOOGLE_MAP_API_KEY);
        $json = json_decode($json);
        $lat=null;
        $long=null;
        if($json->status==='OK'){
            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        }
        $result=array('lat'=>$lat,'lng'=>$long);
        return $result;
    }
    /**
     * To get course related details
     */
    public function getCourseDetails($param){
        global $wpdb;
        $response=$wpdb->get_results( "SELECT u.*,c.country_name,un.* FROM courses u 
        Left Join country c on u.country_id=c.country_id 
        Left Join universities un on un.university_id=u.university_id   where u.course_id=".$param['id']);
        return $response;
        
    }


    
    public function getPopularCourses(){
        global $wpdb;
        $response=$wpdb->get_results("SELECT un.*,c.* from universities un
        Left Join courses c on un.university_id= c.university_id where un.popular_course=1 limit 4" );
        return $response;
    }
    
    public function getCoursesMayLike(){
        global $wpdb;
        $response=$wpdb->get_results("SELECT un.*,c.* from universities un
        Left Join courses c on un.university_id= c.university_id where 
        un.popular_course=1 order by c.course_id desc limit 4" );
        return $response;
    }

   public function getUniversitiesMayLike(){
    global $wpdb;
    $response=$wpdb->get_results("SELECT un.*,c.* from universities un
    Left join country c on  un.country_id=c.country_id
    order by university_id desc limit 4" );
    return $response;
   }
    

   public function fetchCourseDetails($postVal){

    $prog_id=(int)$postVal['prog_id'];
    //$posturl = "https://tcglobalportalservice.optisolbusiness.com/api/website/courseDetail/".$prog_id;

    $posturl = "https://tcgstagingservice.optisolbusiness.com/api/website/courseDetail/".$prog_id;

    $courseDetailOutput = $this->courseDetailsData($posturl);
    return $courseDetailOutput;

   }
   
    public function curlFunction($url,$data,$token)
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

    /**
     * Curl get method
     */
    public function courseDetailsData($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return $output;
    }

    public function getCountryDetail($countryName){
        $countryListUrl="https://gei.tcglobal.com/globalapi/country.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1&country=".$countryName;
        $countryList=$this->retriveData($countryListUrl);
        return $countryList;
    }
	 
	public function getUniversityDetailInCourse($universityName,$countryName){
	 
        $universityDetailListUrl="https://gei.tcglobal.com/globalapi/university.php?token=sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345&username=optisol&password=7ae632e6-a11a-4e3c-b01d-02901d5ab1c1&university=".str_replace(' ', '%20',$universityName)."&country=".str_replace(' ', '%20',$countryName);
        $universityDetailList=$this->retriveData($universityDetailListUrl);
		//print_r($universityDetailList);
        return $universityDetailList;
    }

    public function retriveData($url){
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
	
	public function retriveUniversityData($url){
        $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_HTTPHEADER => array(
			"Accept: */*",
			"Accept-Encoding: gzip, deflate",
			"Cache-Control: no-cache",
			"Connection: keep-alive",
			"Content-Length: 0",
			"Host: www.tcglobal.com",
			"Postman-Token: 9d337c9a-464a-4f5b-a238-bf8e992b882d,d05d4986-2291-483c-a0d4-b7c4dd395842",
			"User-Agent: PostmanRuntime/7.20.1",
			"cache-control: no-cache"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		    $response;
		   return $response;
		}
    }
  
}

?>