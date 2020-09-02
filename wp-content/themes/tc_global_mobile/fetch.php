<?php
  // include_once('searchlisttemplate.php'); 
    require_once('../../../wp-config.php');
    global $wpdb;
    $limit = $_POST['limit'];
    $off=$_POST['offset'] ?$_POST['offset']:0;
    $tableName='';
    //$response=array();
    
     if($_POST['showlist'] && ((int)$_POST['showlist']===1)){
      $tableName='courses';
      $sorting=" order by u.course_id DESC ";
    }
  
    if($_POST['sortBy'] && (int)$_POST['sortBy']===1){
      $sorting=" order by ranking ASC ";
    }
    if($_POST['sortBy'] && (int)$_POST['sortBy']===2){
      $sorting=" order by prog_start_date DESC ";
    }
    if($_POST['sortBy'] && (int)$_POST['sortBy']===3){
      $sorting=" order by tution_fees DESC ";
     }

    if($_POST['areaOfStudy']){
            $query.=$query!=''? " AND prog_aos='".$_POST['areaOfStudy']."'":" where prog_aos='".$_POST['areaOfStudy']."'";
    }
    if($_POST['country']){
      $query.=$query!=''? " AND u.country_id=".$_POST['country']:" where u.country_id=".$_POST['country'];
    }
    if($_POST['specialization']){
      $query.=$query!=''? " AND prog_type='".$_POST['specialization']."'":" where prog_type='".$_POST['specialization']."'";
   }
   if($_POST['studyLevel']){
    $query.=$query!=''? " AND prog_level='".$_POST['studyLevel']."'":" where prog_level='".$_POST['studyLevel']."'";
   }
   if($_POST['university']){
   $query.=$query!=''? " AND u.university_id=".$_POST['university']: " where u.university_id=".$_POST['university'];
   }
  if($_POST['city']){
    $query.=$query!=''? " AND city='".$_POST['city']."'":" where city='".$_POST['city']."'";
   }
  if($_POST['intake'] && $tableName==='universities'){
   $query.=$query!=''? " AND u.intakes=".$_POST['intake']:" where u.intakes=".$_POST['intake'];
   }

   if($_POST['acceptedTest'] && count($_POST['acceptedTest'])>0){
    foreach ($_POST['acceptedTest'] as $key => $value) {
        $testArra.="'".$value."'".',';
    }
    $testArra=rtrim($testArra, ',');
    $query.=$query!=''? " AND c.standardized_test in(".$testArra.")":" where c.standardized_test in (".$testArra.")";
}

     if ($_POST['feesRange']){
         
            $query.=$query!=''  ? " AND (u.prog_fees_value<=".$_POST['feesRange']." AND u.prog_fees_value>=".$_POST['feesRangemin'].")":" where (u.prog_fees_value<=".$_POST['feesRange']." AND u.prog_fees_value>=".$_POST['feesRangemin'].")";
         
     }
    /*$courseQuery="select u.created_at,u.course_id as id ,u.course_name as name,
            cu.university_name as univName,c.country_name,''as city,u.prog_fees_currency ,
            u.prog_fees_value as tution_fees,'' as ranking,
           ''as intake ,u.prog_start_date, 'course' as showType from courses 
            u Left join `index` i on i.index_id=u.index_id
             Left join universities cu on i.university_id=cu.university_id
             Left join country c on c.country_id=cu.country_id
              ";*/
    $courseQuery="select u.created_at,u.course_id as id ,u.course_name as name,'' as ranking,
            ''as city,u.prog_fees_value as tution_fees,
             c.country_name,''as intake ,u.prog_start_date,  'course' as showType,
             cu.university_name as univName 
             from courses u Left join country c on c.country_id=u.country_id
               Left join universities cu on cu.university_id=u.university_id    ";

                 
    $courseQuery=$courseQuery.$query;
    $records=$wpdb->get_results($courseQuery.  $sorting." limit ".$off.",".$limit);
    $totalQuery="select count(*) as totalRecord  from (" .$courseQuery." )t " ;
    $totalRecord=$wpdb->get_results($totalQuery);
    $response=array('searchResult'=>$records,'totalRecord'=>$totalRecord[0]->totalRecord);
   //print_r($courseQuery." limit ".$off.",".$limit);exit();
    echo json_encode($response); 


?>






