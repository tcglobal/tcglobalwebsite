
    <?php /* Template Name: searchlisttemplate */ ?>
    <?php get_header();  ?>

    <?php      //(searchresult)
     function getSearchResult($params){
        global $wpdb;
        $query='';
        $off=$params['offset'] ?$params['offset']:0;
        $limit=$params['limit'] ?$params['limit']:5;
        $tableName='';
        $response=array();
        if($params['showlist'] && ((int)$params['showlist']===1)){
          $tableName='courses';
          $sorting=" order by u.course_id DESC ";
      }

      if($params['sortBy'] && (int)$params['sortBy']===1){
          $sorting=" order by ranking ASC ";
      }
      if($params['sortBy'] && (int)$params['sortBy']===2){
          $sorting=" order by prog_start_date DESC ";
      }
      if($params['sortBy'] && (int)$params['sortBy']===3){
          $sorting=" order by tution_fees DESC ";
      }

        if($params['university']&& count($params['university'])>0){
           foreach ($params['university'] as $key => $value) {
            $univtest.="'".$value."'".',';
         }
            $univtest=rtrim( $univtest, ',');
            $query.=$query!=''? " AND u.university_id in(".$univtest.")":" where u.university_id in (".$univtest.")";
        }
        if($params['city']&& count($params['city'])>0){
           foreach ($params['city'] as $key => $value) {
           $citytest.="'".$value."'".',';
           }
            $citytest=rtrim($citytest, ',');
            $query.=$query!=''? " AND city in(".$citytest.")":" where city in (".$citytest.")";
        }
        if($params['country']&& count($params['country'])>0){
          foreach ($params['country'] as $key => $value) {
            $countrytest.="'".$value."'".',';
        }
            $countrytest=rtrim($countrytest, ',');
            $query.=$query!=''? " AND u.country_id in(".$countrytest.")":" where u.country_id in (".$countrytest.")";
        }
      //  print_r($params['areaOfStudy']);exit;
        if($params['areaOfStudy']&& count($params['areaOfStudy'])>0){
          foreach ($params['areaOfStudy'] as $key => $value) {
            $areatest.="'".$value."'".',';
        }
           $areatest=rtrim( $areatest, ',');
            $query.=$query!=''? " AND prog_aos in(".$areatest.")":" where prog_aos in (".$areatest.")";
        }
        if($params['studyLevel']&& count($params['studyLevel'])>0){
          foreach ($params['studyLevel'] as $key => $value) {
            $studytest.="'".$value."'".',';
          }
           $studytest=rtrim( $studytest, ',');
            $query.=$query!=''? " AND prog_level in(". $studytest.")":" where prog_level in (". $studytest.")";
        }
        if($params['specialization']&& count($params['specialization'])>0){
          foreach ($params['specialization'] as $key => $value) {
            $sepcializtest.="'".$value."'".',';
          }
          $sepcializtest=rtrim($sepcializtest, ',');
            $query.=$query!=''? " AND prog_type in(".$sepcializtest.")":" where prog_type in (".$sepcializtest.")";
        }
        if($params['intake'] && count($params['intake'])>0 ){
          foreach ($params['intake'] as $key => $value) {
            $intaketest.="'".$value."'".',';
          }
          $intaketest=rtrim($intaketest, ',');
            $query.=$query!=''? " AND cu.intakes in(".$intaketest.")":" where cu.intakes in (".$intaketest.")";
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
        if($params['acceptedTest'] && count($params['acceptedTest'])>0){
            foreach ($params['acceptedTest'] as $key => $value) {
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
            $filterquery.=$query!='' || $filterquery!='' ? " AND cu.intakes in(".$intaketest.")":" where cu.intakes  in(".$intaketest.")";
            $courseFilterquery.=$query!='' || $courseFilterquery!='' ? " AND cu.intakes in(".$intaketest.")":" where cu.intakes in(".$intaketest.")";
        }
          if($params['feesRange'] && strpos($params['feesRange'], ';') !== false){
              $splitted=explode(';',$params['feesRange']);
              if($splitted[1] > 0){
                  $filterquery.=$query!='' || $filterquery!='' ? " AND (u.tution_fees<=".$splitted[1]." AND u.tution_fees>=".$splitted[0].")":" where (u.tution_fees<=".$splitted[1]." AND u.tution_fees>=".$splitted[0].")";
                  $courseFilterquery.=$query!='' || $courseFilterquery!='' ? " AND (u.prog_fees_value<=".$splitted[1]." AND u.prog_fees_value>=".$splitted[0].")":" where (u.prog_fees_value<=".$splitted[1]." AND u.prog_fees_value>=".$splitted[0].")";
              }
          }
           /*  $univQuery="(select  u.created_at,u.university_id as id,u.university_name as name ,
            c.country_name,ad.intake,'' as prog_start_date, 'univeristy' as showType,'' as univName FROM `universities` u
            Left join application_deadline ad on ad.university_id=u.university_id
            Left join courses co on u.university_id=co.university_id
            Left join country c on c.country_id=u.country_id
                      ";  */
           // $univQuery=$univQuery.$query.$filterquery." )";
            /*$courseQuery="(select u.created_at,u.course_id as id ,u.course_name as name,
            cu.university_name as univName,c.country_name,''as city,u.prog_fees_currency ,
            u.prog_fees_value as tution_fees,
           ''as intake ,u.prog_start_date, 'course' as showType from courses
            u Left join `index` i on i.index_id=u.index_id
             Left join universities cu on i.university_id=cu.university_id
             Left join country c on c.country_id=cu.country_id
              ";*/

            $courseQuery="( select u.created_at,u.course_id as id ,u.course_name as name,
            cu.city as city,u.prog_fees_value as tution_fees,
             c.country_name,cu.intakes as intake ,u.prog_start_date,  'course' as showType,
             cu.university_name as univName
             from courses u Left join country c on c.country_id=u.country_id
               Left join universities cu on cu.university_id=u.university_id    ";
        }
            $courseQuery=$courseQuery.$query.$courseFilterquery." )";
            $records=$wpdb->get_results(  $courseQuery .$orderQuery ." limit ".$off.",".$limit);
            $totalQuery="select count(*) as totalRecord  from (" .$courseQuery." )t " ;
            $totalRecord=$wpdb->get_results($totalQuery);

        //print_r($basicQuery.$tableName." u  ".$subQuery.$query.$sorting." limit ".$off.",".$limit);
        //print_r($courseQuery .$orderQuery ." limit ".$off.",".$limit);
       //print_r($limit);
       //exit;
        $response=array('searchResult'=>$records,'totalRecord'=>$totalRecord[0]->totalRecord);
     //echo 'test';
    // print_r($response);exit();

        return $response;
    }

?>
<?php




?>
<?php   //(Tutionfees)
 function getTutionFees($params){
        global $wpdb;
         $query=null;


         if($params['university']&& count($params['university'])>0){
          foreach ($params['university'] as $key => $value) {
           $univtest.="'".$value."'".',';
        }
           $univtest=rtrim( $univtest, ',');
           $query.=$query!=''? " AND u.university_id in(".$univtest.")":" where u.university_id in (".$univtest.")";
       }
       if($params['city']&& count($params['city'])>0){
          foreach ($params['city'] as $key => $value) {
          $citytest.="'".$value."'".',';
          }
           $citytest=rtrim($citytest, ',');
           $query.=$query!=''? " AND city in(".$citytest.")":" where city in (".$citytest.")";
       }
       if($params['country']&& count($params['country'])>0){
         foreach ($params['country'] as $key => $value) {
           $countrytest.="'".$value."'".',';
       }
           $countrytest=rtrim($countrytest, ',');
           $query.=$query!=''? " AND u.country_id in(".$countrytest.")":" where u.country_id in (".$countrytest.")";
       }
     //  print_r($params['areaOfStudy']);exit;
       if($params['areaOfStudy']&& count($params['areaOfStudy'])>0){
         foreach ($params['areaOfStudy'] as $key => $value) {
           $areatest.="'".$value."'".',';
       }
          $areatest=rtrim( $areatest, ',');
           $query.=$query!=''? " AND prog_aos in(".$areatest.")":" where prog_aos in (".$areatest.")";
       }
       if($params['studyLevel']&& count($params['studyLevel'])>0){
         foreach ($params['studyLevel'] as $key => $value) {
           $studytest.="'".$value."'".',';
         }
          $studytest=rtrim( $studytest, ',');
           $query.=$query!=''? " AND prog_level in(". $studytest.")":" where prog_level in (". $studytest.")";
       }
       if($params['specialization']&& count($params['specialization'])>0){
         foreach ($params['specialization'] as $key => $value) {
           $sepcializtest.="'".$value."'".',';
         }
         $sepcializtest=rtrim($sepcializtest, ',');
           $query.=$query!=''? " AND prog_type in(".$sepcializtest.")":" where prog_type in (".$sepcializtest.")";
       }
       if($params['intake'] && count($params['intake'])>0){
        foreach ($params['intake'] as $key => $value) {
          $intaketest.="'".$value."'".',';
        }
        $intaketest=rtrim($intaketest, ',');
          $query.=$query!=''? " AND cu.intakes in(".$intaketest.")":" where cu.intakes in (".$intaketest.")";
      }

      /* $univQuery="select max(tution_fees) as tution_fees from ((select max(u.tution_fees) as tution_fees FROM `university_details` u
         Left join courses co on u.university_id=co.university_id
                       ";*/
          // $univQuery=$univQuery.$query.$filterquery." )";
            $courseQuery="( select max(u.prog_fees_value) as tution_fees
            from courses u Left join country c on c.country_id=u.country_id
            Left join universities cu on cu.university_id=u.university_id  ";
            $courseQuery=$courseQuery.$query."  ) ";
          $response=$wpdb->get_results($courseQuery);
        $fees=0;
        if($response && $response[0] && $response[0]->tution_fees){
            $fees=$response[0]->tution_fees;
        }
       //print_r($courseQuery);exit();
        return $fees;


    }
    ?>

    <?php      //(popularcourselist)
        global $wpdb;
        $response=$wpdb->get_results("SELECT un.*,c.* from universities un
        Left Join courses c on un.university_id= c.university_id where un.popular_course=1 limit 4");
        $popularList =$response;

      ?>

      <?php  //(courselist)
        global $wpdb;

        $response=$wpdb->get_results( "SELECT course_id,prog_aos FROM courses group by prog_aos");
        $areaofstudy =$response;
    ?>
    <?php //(countrylist)

        global $wpdb;
        $response=$wpdb->get_results("select * from country ");
        $countrylist=$response;

    ?>
    <?php
        global $wpdb;
        $response=$wpdb->get_results( "SELECT course_id,prog_type FROM courses group by prog_type");
        $specialization=$response;
    ?>

    <?php
        global $wpdb;
        $response=$wpdb->get_results( "SELECT course_id,prog_level FROM courses group by prog_level");
        $studylevel=$response;
     ?>

   <?php   //(universitylist)
        global $wpdb;
        $params =$_GET;
        $query=null;
        if($params['university']&& count($params['university'])>0){
          foreach ($params['university'] as $key => $value) {
           $univtest.="'".$value."'".',';
        }
           $univtest=rtrim( $univtest, ',');
           $query.=$query!=''? " AND u.university_id in(".$univtest.")":" where u.university_id in (".$univtest.")";
       }
       if($params['city']&& count($params['city'])>0){
          foreach ($params['city'] as $key => $value) {
          $citytest.="'".$value."'".',';
          }
           $citytest=rtrim($citytest, ',');
           $query.=$query!=''? " AND city in(".$citytest.")":" where city in (".$citytest.")";
       }
       if($params['country']&& count($params['country'])>0){
         foreach ($params['country'] as $key => $value) {
           $countrytest.="'".$value."'".',';
       }
           $countrytest=rtrim($countrytest, ',');
           $query.=$query!=''? " AND u.country_id in(".$countrytest.")":" where u.country_id in (".$countrytest.")";
       }
     //  print_r($params['areaOfStudy']);exit;
       if($params['areaOfStudy']&& count($params['areaOfStudy'])>0){
         foreach ($params['areaOfStudy'] as $key => $value) {
           $areatest.="'".$value."'".',';
       }
          $areatest=rtrim( $areatest, ',');
           $query.=$query!=''? " AND prog_aos in(".$areatest.")":" where prog_aos in (".$areatest.")";
       }
       if($params['studyLevel']&& count($params['studyLevel'])>0){
         foreach ($params['studyLevel'] as $key => $value) {
           $studytest.="'".$value."'".',';
         }
          $studytest=rtrim( $studytest, ',');
           $query.=$query!=''? " AND prog_level in(". $studytest.")":" where prog_level in (". $studytest.")";
       }
       if($params['specialization']&& count($params['specialization'])>0){
         foreach ($params['specialization'] as $key => $value) {
           $sepcializtest.="'".$value."'".',';
         }
         $sepcializtest=rtrim($sepcializtest, ',');
           $query.=$query!=''? " AND prog_type in(".$sepcializtest.")":" where prog_type in (".$sepcializtest.")";
       }

       $univQuery="(select  u.university_id,u.university_name FROM `universities` u
              Left join courses co on u.university_id=co.university_id
                     ";

            $univQuery=$univQuery.$query." )";
            $courseQuery="( select  cu.university_id,cu.university_name  from courses
             u Left join country c on c.country_id=u.country_id
             Left join universities cu on cu.university_id=u.university_id ";
            $courseQuery=$courseQuery.$query."  )";
            $response=$wpdb->get_results( $univQuery." UNION " .$courseQuery);
            $universitylist =$response;
           // print_r( $univQuery." UNION " .$courseQuery);exit;
    ?>


<?php     //(citylist)
        global $wpdb;
        $params =$_GET;
        $query=null;
        if($params['university']&& count($params['university'])>0){
          foreach ($params['university'] as $key => $value) {
           $univtest.="'".$value."'".',';
        }
           $univtest=rtrim( $univtest, ',');
           $query.=$query!=''? " AND u.university_id in(".$univtest.")":" where u.university_id in (".$univtest.")";
       }
       $citytest='';
        if($params['city']&& count($params['city'])>0){
          foreach ($params['city'] as $key => $value) {
          $citytest.="'".$value."'".',';
          }
           $citytest=rtrim($citytest, ',');
           $query.=$query!=''? " AND city in(".$citytest.")":" where city in (".$citytest.")";
       }

       if($params['country']&& count($params['country'])>0){
         foreach ($params['country'] as $key => $value) {
           $countrytest.="'".$value."'".',';
       }
           $countrytest=rtrim($countrytest, ',');
           $query.=$query!=''? " AND u.country_id in(".$countrytest.")":" where u.country_id in (".$countrytest.")";
       }
     //  print_r($params['areaOfStudy']);exit;
       $areatest='';
       if($params['areaOfStudy']&& count($params['areaOfStudy'])>0){
         foreach ($params['areaOfStudy'] as $key => $value) {
           $areatest.="'".$value."'".',';
       }
          $areatest=rtrim( $areatest, ',');
           $query.=$query!=''? " AND prog_aos in(".$areatest.")":" where prog_aos in (".$areatest.")";
       }
       $studytest='';
       if($params['studyLevel']&& count($params['studyLevel'])>0){
         foreach ($params['studyLevel'] as $key => $value) {
           $studytest.="'".$value."'".',';
         }
          $studytest=rtrim( $studytest, ',');
           $query.=$query!=''? " AND prog_level in(". $studytest.")":" where prog_level in (". $studytest.")";
       }
        $sepcializtest='';
       if($params['specialization']&& count($params['specialization'])>0){
         foreach ($params['specialization'] as $key => $value) {
           $sepcializtest.="'".$value."'".',';
           //print_r($sepcializtest);exit;
         }
         $sepcializtest=rtrim($sepcializtest, ',');
           $query.=$query!=''? " AND prog_type in(".$sepcializtest.")":" where prog_type in (".$sepcializtest.")";
       }


       $univQuery="select * from ((select  u.university_id,u.university_name,u.city,u.intakes FROM `universities` u
                        Left join courses co on u.university_id=co.university_id
                       ";
            $univQuery=$univQuery.$query." )";
            $courseQuery="( select  cu.university_id,cu.university_name,cu.city,cu.intakes from courses u Left join country c on
            c.country_id=u.country_id Left join universities cu on cu.university_id=u.university_id ";
            $courseQuery=$courseQuery.$query."  ))t  group by city";
            $response=$wpdb->get_results( $univQuery." UNION " .$courseQuery);
            $citylist=$response;
            //print_r( $univQuery." UNION " .$courseQuery);exit;
         ?>

<?php      //(intakelist)
    global $wpdb;
    $params =$_GET;
    $query=null;
      if($params['university']&& count($params['university'])>0){
      foreach ($params['university'] as $key => $value) {
       $univtest.="'".$value."'".',';
    }
       $univtest=rtrim( $univtest, ',');
       $query.=$query!=''? " AND cu.university_id in(".$univtest.")":" where cu.university_id in (".$univtest.")";
   }
   $citytest='';
   if($params['city']&& count($params['city'])>0){
      foreach ($params['city'] as $key => $value) {
      $citytest.="'".$value."'".',';
      }
       $citytest=rtrim($citytest, ',');
       $query.=$query!=''? " AND city in(".$citytest.")":" where city in (".$citytest.")";
   }
   $countrytest='';
   if($params['country']&& count($params['country'])>0){
     foreach ($params['country'] as $key => $value) {
       $countrytest.="'".$value."'".',';
   }
       $countrytest=rtrim($countrytest, ',');
       $query.=$query!=''? " AND u.country_id in(".$countrytest.")":" where cu.country_id in (".$countrytest.")";
   }
 //  print_r($params['areaOfStudy']);exit;
    $areatest='';
   if($params['areaOfStudy']&& count($params['areaOfStudy'])>0){
     foreach ($params['areaOfStudy'] as $key => $value) {
       $areatest.="'".$value."'".',';
   }
      $areatest=rtrim( $areatest, ',');
       $query.=$query!=''? " AND prog_aos in(".$areatest.")":" where prog_aos in (".$areatest.")";
   }
   $studytest='';
   if($params['studyLevel']&& count($params['studyLevel'])>0){
     foreach ($params['studyLevel'] as $key => $value) {
       $studytest.="'".$value."'".',';
     }
      $studytest=rtrim( $studytest, ',');
       $query.=$query!=''? " AND prog_level in(". $studytest.")":" where prog_level in (". $studytest.")";
   }
   $sepcializtest='';
   if($params['specialization']&& count($params['specialization'])>0){
     foreach ($params['specialization'] as $key => $value) {
       $sepcializtest.="'".$value."'".',';
     }
     $sepcializtest=rtrim($sepcializtest, ',');
       $query.=$query!=''? " AND prog_type in(".$sepcializtest.")":" where prog_type in (".$sepcializtest.")";
   }
   if($params['intake'] && count($params['intake'])>0){
    foreach ($params['intake'] as $key => $value) {
      $intaketest.="'".$value."'".',';
    }
    $intaketest=rtrim($intaketest, ',');
      $query.=$query!=''? " AND cu.intakes in(".$intaketest.")":" where cu.intakes in (".$intaketest.")";
  }
  //print_r( $query);
   $univQuery="select *from((select cu.university_id ,cu.intakes FROM `universities` cu
   Left join courses co on cu.university_id=co.university_id
   ";
   $univQuery=$univQuery.$query." )";
   $courseQuery="( select cu.university_id,cu.intakes from courses u Left join country c on c.country_id=u.country_id Left join universities cu on cu.university_id=cu.university_id ";
   $courseQuery=$courseQuery.$query." ))t group by intakes";
   $response=$wpdb->get_results( $univQuery." UNION " .$courseQuery);
   $intakelist =$response;
  //print_r( $univQuery." UNION " .$courseQuery);exit;
 ?>




   <?php    //(acceptedtest)
        global $wpdb;
        $params =$_GET;

       if($params['country']&& count($params['country'])>0){
            $response=$wpdb->get_results( "SELECT standardized_test FROM country where country_id in (".$countrytest.")");
        }else{
            $response=$wpdb->get_results( "SELECT standardized_test FROM country group by standardized_test");
        }

        $acceptedtest =$response;
        //print_r( $response);exit();

   ?>




<section class="desktop-mainsection">


<form id="searchForm" action="/search-tool" method="GET" onsubmit="return callapirecords()">
       <div class="searchtool-banner">
         <div class="bg-color"></div>
         <div class="container position-relative">
           <div class="row">
             <div class="col">
               <h2 class="mobile-main-heading">Search Tool</h2>
             </div>
              </div>
<!-- modal -->
              <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

              <div class="modal-content modal-search-filter">

              <a href="" class="close-btn" data-dismiss="modal" >
              <img src="<?php bloginfo('template_url')?>/images/popup-close.png;"/>

                 </a>
           <div class="search-form-fields search-result mb-0">

           <input type="hidden" name="offset" value="0" id="offset">
           <input type="hidden" name="recordCount" value="0" id="recordCount">

              <div class="row">
               <div class="col-12 m-b-20">
               <label>What do you want to study?</label>
                  <?php $className='form-control'?>
                 <select class="form-control mutlidropdown" data-placeholder="Area of study"
                  name="areaOfStudy[]"  multiple="multiple" id="areaOfStudy"  >

                  <!-- <select class="form-control"> -->
                      <option value=''>Area of study</option>
                  <?php
                    foreach ($areaofstudy as $key => $value) {
                    if((string)$params['areaOfStudy']===(string)$value->prog_aos){
                            $option= '<option selected value="'.$value->prog_aos.'">'.$value->prog_aos.'</option>';
                        }else{
                            $option= '<option  value="'.$value->prog_aos.'">'.$value->prog_aos.'</option>';
                        }
                     ?>
                   <?php echo  $option?>
                     <?php } ?>
                  </select>
               </div>
               <div class="col-12 m-b-20">
               <label>Where?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]"
                  multiple="multiple" id="country" value="<?php echo $params['country']?>" >
                    <option value=''>Country</option>
                    <?php
                  //$params =$_GET;
                  //$selectedValues=$params['country'];
                   //echo 'test';
                 // print_r ($country_list);exit;
                  foreach ($countrylist as $key => $value) {
                  if((int)$params['country']===(int)$value->country_name){
                  $option= '<option selected  value="'.$value->country_name.'">'.$value->country_name.'</option>';
                 }else{
                 $option= '<option  value="'.$value->country_name.'">'.$value->country_name.'</option>';
                 }

                 ?>

                 <?php echo  $option?>
                  <?php } ?>

                </select>

               </div>
               <div class="col-12 m-b-20">
               <label>What specialization?</label>
               <?php $className='form-control'?>
                  <select class="form-control mutlidropdown"  data-placeholder="Course options" name="specialization[]"
                   multiple="multiple" id="specialization" value="<?php echo $params['specialization']?>" >
                    <option value=''>Course options</option>
                    <?php
                     foreach ($specialization as $key => $value) {
                        if((string)$params['specialization']===(string)$value->prog_type){
                            $option= '<option selected value="'.$value->prog_type.'">'.$value->prog_type.'</option>';
                        }else{
                            $option= '<option  value="'.$value->prog_type.'">'.$value->prog_type.'</option>';
                        }
                    ?>
                  <?php echo  $option?>
                  <?php } ?>
                  </select>
               </div>
               <div class="col-12 m-b-20">
               <label>On which study level? </label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown" data-placeholder="Study level options" name="studyLevel[]"
                  multiple="multiple" id="studyLevel" value="<?php echo $params['studyLevel']?>" >
                    <option value=''>Study level options</option>
                    <?php
                     foreach ($studylevel as $key => $value) {
                      if((string)$params['studyLevel']===(string)$value->prog_level){
                          $option= '<option selected value="'.$value->prog_level.'">'.$value->prog_level.'</option>';
                      }else{
                          $option= '<option  value="'.$value->prog_level.'">'.$value->prog_level.'</option>';
                      }

                    ?>
                    <?php echo  $option?>
                    <?php } ?>
                  </select>
               </div>
               <div class="col-12 text-center" id="filters">
                 <a  class="more-link more-show">more filters +</a>
               </div>
               <div class="col-sm-3 p-0">
                  <div class="search-filter">
               <div  id= "filter" class="search-filter col-sm-12" style="display:none">
                 <h2 id="newfilter"> More filters</h2>
               <h5 class="p-t-10">Choose university</h5>
                    <?php $className='form-control selectbox m-b-30'?>
                <select class="form-control selectbox m-b-30 mutlidropdown" name="university[]"
              data-placeholder="Choose University"  multiple="multiple" id="university"  value="<?php echo $params['university']?>" >

                      <option value=''>Choose university</option>

                      <?php
                      foreach ($universitylist as $key => $value) {
                        if((int)$params['university']===(int)$value->university_id){
                            $option= '<option selected value="'.$value->university_id.'">'.$value->university_name.'</option>';
                        }else{
                            $option= '<option  value="'.$value->university_id.'">'.$value->university_name.'</option>';
                        }
                    ?>
                   <?php echo  $option?>
                   <?php } ?>
                     </select>
                     <h5 class="p-t-20">Choose City</h5>
                     <?php $className='form-control selectbox m-b-20'?>
                     <select class="form-control selectbox m-b-20 mutlidropdown " name="city[]"
                     data-placeholder="Choose city" id="city"  multiple="multiple" value="<?php echo $params['city']?>" >
                     <option value=''>Choose City</option>
                      <?php
                      foreach ($citylist as $key => $value) {
                        if((string)$params['city']===(string)$value->city){
                            $option= '<option selected value="'.$value->city.'">'.$value->city.'</option>';
                        }else{
                            $option= '<option  value="'.$value->city.'">'.$value->city.'</option>';
                        }
                     ?>
                    <?php echo  $option?>
                    <?php } ?>
                    </select>
                    <label class="mb-0 p-t-20">Choose preffered intake</label>
                    <div class="row">
                      <div class="col">
                        <?php $className='form-control selectbox m-b-30'?>
                         <select class="form-control selectbox m-b-30 mutlidropdown" name="intake[]"
                         data-placeholder="year" id="intake" multiple="multiple" value="<?php echo $params['intake']?>" >

                          <option value=''>Choose intake year</option>
                          <?php
                          foreach ($intakelist as $key => $value) {
                         if($value->intakes){
                            if((int)$params['intake']===(int)$value->intakes){
                                $option= '<option selected value="'.$value->intakes.'">'.$value->intakes.'</option>';
                            }else{
                                $option= '<option  value="'.$value->intakes.'">'.$value->intakes.'</option>';
                            }
                          }
                          ?>
                        <?php echo  $option?>
                        <?php } ?>
                     </select>
                      </div>
                      <div class="col">
                        <?php $className='form-control selectbox m-b-20'?>
                            <select class="form-control selectbox m-b-20 mutlidropdown" name="month[]"
                            data-placeholder="months" id="month" multiple="multiple" value="<?php echo $params['intake']?>" >
                           <option value=''></option>
                             <?php
                             foreach ($intakelist as $key => $value) {
                            if($value->intakes){
                               if((int)$params['intake']===(int)$value->intakes){
                                   $option= '<option selected value="'.$value->intakes.'">'.$value->intakes.'</option>';
                               }else{
                                   $option= '<option  value="'.$value->intakes.'">'.$value->intakes.'</option>';
                               }
                             }
                             ?>
                           <?php echo  $option?>
                           <?php } ?>
                           </select>
                      </div>
                    </div>
                    <label class="mb-0 p-t-20">Duration of course</label>
                    <div class="tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Undergraduate</a>
                   </li>
                   <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Postgraduate</a>
                  </li>
                  </ul>
                  <div class="tab-content pl-1 pb-3" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col pb-2">
                     <div class="custom-control custom-checkbox">
                       <input type="checkbox" class="custom-control-input" id="customCheck6">
                       <label class="custom-control-label" for="customCheck6">3 years</label>
                     </div>
                   </div>
                   <div class="col">
                     <div class="custom-control custom-checkbox">
                       <input type="checkbox" class="custom-control-input" id="customCheck7">
                       <label class="custom-control-label" for="customCheck7">4 +years</label>
                     </div>
                   </div>
                  </div>
                   <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     <div class="col">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck8">
                        <label class="custom-control-label" for="customCheck8">5 years</label>
                      </div>
                    </div>
                    <div class="col">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck9">
                        <label class="custom-control-label" for="customCheck9">6 +years</label>
                      </div>
                    </div>
                  </div>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 p-b-20">
                        <label class="mb-0 mt-0 float-left">Language tests not required</label>
                        <div class="custom-control custom-control-inline custom-checkbox mr-0 pt-2 float-right">
                          <input type="checkbox" class="custom-control-input" id="multiselectcheck1">
                          <label class="custom-control-label right-5 m-0 p-0" for="multiselectcheck1"></label>
                        </div>
                      </div>
                    </div>
                    <h5 id="lang">Choose language tests </h5>
                    <?php $className='form-control selectbox m-b-20'?>
                    <select class="form-control selectbox m-b-20 mutlidropdown " name="acceptedTest[]" class="testdropdown"
                     data-placeholder="Choose languages tests" id="acceptedTest"  multiple="multiple" value="<?php echo $params['acceptedTest']?>" >
                     <option value=''></option>
                    <?php
                   // $params =$_GET;

                    //$selectedValues=$params['acceptedTest'];

                     foreach ($acceptedtest as $key => $value) {
                     if((string)$params['acceptedTest']===(string)$value->standardized_test){
                       $option= '<option selected value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }else{
                            $option= '<option  value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }
                    //print_r($options);exit();

                      ?>
                   <?php echo $option?>
                   <?php } ?>
                   </select>

                   <div class="row">
                      <div class="col-sm-12 p-t-30 p-b-20">
                        <label class="mb-0 mt-0 float-left">Additional exams not required</label>
                        <div class="custom-control custom-control-inline custom-checkbox mr-0 pt-2 float-right">
                          <input type="checkbox" class="custom-control-input" id="multiselectcheck2">
                          <label class="custom-control-label right-5 m-0 p-0" for="multiselectcheck2"></label>
                        </div>
                      </div>
                    </div>
                    <h5 id="exam">Choose exams </h5>
                    <?php $className='form-control selectbox m-b-20'?>
                    <select class="form-control selectbox m-b-20 mutlidropdown " name="acceptedTest1[]" class="testdropdown1"
                     data-placeholder="Choose exams" id="acceptedTest1"  multiple="multiple" value="<?php echo $params['acceptedTest']?>" >
                     <option value=''></option>
                    <?php
                     foreach ($acceptedtest as $key => $value) {
                     if((string)$params['acceptedTest1']===(string)$value->standardized_test){
                       $option= '<option selected value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }else{
                            $option= '<option  value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }
                   //print_r($options);exit();
                      ?>
                   <?php echo $option?>
                   <?php } ?>
                   </select>
                   <h5 class="p-t-20">Choose mode of study </h5>
                    <?php $className='form-control selectbox m-b-20'?>
                    <select class="form-control selectbox m-b-20 mutlidropdown " name="mode of study[]"
                     data-placeholder="Choose mode of study" id="mode of study"  multiple="multiple" value="<?php echo $params['mode of study']?>" >
                     <option value=''></option>
                    <?php
                     foreach ($acceptedtest as $key => $value) {
                     if((string)$params[' mode of study']===(string)$value->standardized_test){
                       $option= '<option selected value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }else{
                            $option= '<option  value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }
                   //print_r($options);exit();
                      ?>
                   <?php echo $option?>
                   <?php } ?>
                   </select>
                       <h5 class="p-t-20">Choose university orientation </h5>
                    <?php $className='form-control selectbox m-b-20'?>
                    <select class="form-control selectbox m-b-20 mutlidropdown " name="mode of study1[]"
                     data-placeholder="Choose university orientation " id="mode of study1"  multiple="multiple" value="<?php echo $params['mode of study']?>" >
                     <option value=''></option>
                    <?php
                     foreach ($acceptedtest as $key => $value) {
                     if((string)$params[' mode of study1']===(string)$value->standardized_test){
                       $option= '<option selected value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }else{
                            $option= '<option  value="'.$value->standardized_test.'">'.$value->standardized_test.'</option>';
                        }
                   //print_r($options);exit();
                      ?>
                   <?php echo $option?>
                   <?php } ?>
                   </select>
              <label class="mb-0 p-t-20 p-b-10">Choose prefered tuition fee</label>
              <?php
                $params =$_GET;
                $tutionFees= getTutionFees($params);
                $feesRange=$params['feesRange'];
                if($feesRange && strpos($feesRange, ';') !== false){
                  $splitted=explode(';',$feesRange);
                }
                $maxVal=($splitted && $splitted[1])?$splitted[1]:0;
                $minVal=($splitted && $splitted[0])?$splitted[0]:0;
               ?>
              <div class="col-sm-12 p-0">
                <input type="text" class="js-range-slider" name="feesRange" value=""/>
                <span style="display:none"  id="feesrangeselectedMax" name="feesrangeselectedMax"><?php echo $maxVal?></span>
                  <span style="display:none"  id="feesrangeselectedMin" name="feesrangeselectedMin"><?php echo$minVal?></span>
                  <span style="display:none" name="range-max" id="range-max-value"><?php echo $tutionFees?></span>
              </div>
                <button id="morefilter" type="button" class="btn btn-block mt-1">apply filters</button>
               </div>
               <div class="col-12">

               <a class="btn btn-theme text-white" id="topsearch">Search</a>

               </div>
              </div>
                        </div>
                        </div>
                        </div>
             </div>
          </div>
       </div>
              </div>
              </div>
              </div>


<!-- modal -->




       <!--SEARCH-RESULT-->
       <div class="search-result">
         <div class="container">
           <div class="row">
             <div class="col-sm-12">
               <h2 class="mobile-main-heading m-b-50"><span class="d-block">Your personalized</span>University search results</h2>
               <div class="row">
                 <div class="col-sm-12">


                   <div class="searchlist-topfilter">
                     <div class="row">
                       <div class="col-sm-12">



                               <!-- modal -->
                     <div id="myModal1" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                     <div class="modal-content">

                                <div class="search-sorting-section search-result">
                               <div class="search-filter border-0 position-relative">
                                 <a href="" class="close-btn" data-dismiss="modal" >
                                 <img src="<?php bloginfo('template_url')?>/images/popup-close.png"  alt="close"/>

                                   </a>
                                 <p>Show</p>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-checkbox">
                                     <?php
                                      $params =$_GET;
                                     //$showlistvalues=getSearchResult($params);
                                    $showlistvalue= $params['showlist'];
                                    if(!$showlistvalue){
                                    ?>
                                     <input type="checkbox" checked class="custom-control-input" id="All"
                                       name="showlist"  value="">
                                    <?php } else{ ?>
                                      <input type="checkbox" class="custom-control-input" id="All"
                                       name="showlist"  value="">
                                    <?php } ?>
                                       <label class="custom-control-label" for="All">All</label>
                                     </div>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-checkbox">
                                     <?php
                                     $params =$_GET;

                                     $showlistvalue= $params['showlist'];
                                     if($showlistvalue==1){
                                      ?>
                                     <input type="checkbox" checked class="custom-control-input" id="Courses"
                                       name="showlist"  value="1">
                                     <?php }else{
                                       ?>
                                        <input type="checkbox"  class="custom-control-input" id="Courses"
                                       name="showlist"  value="1">
                                    <?php
                                     } ?>
                                       <label class="custom-control-label" for="Courses">Courses</label>
                                     </div>
                                   </div>
                                 </div>



                                 <p>Sort by</p>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                     <?php
                                     $params =$_GET;
                                      $sortbyvalue= $params['sortBy'];
                                      if($sortbyvalue==1){
                                       ?>
                                      <input type="radio" id="customRadio1" name="sortBy"
                                       checked class="custom-control-input" value="1">
                                      <?php }else{
                                        ?>
                                         <input type="radio" id="customRadio1" name="sortBy"
                                          class="custom-control-input" value="1">
                                          <?php
                                           } ?>
                                      <label class="custom-control-label" for="customRadio1">Ranking</label>
                                     </div>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                     <?php
                                      $params =$_GET;
                                      $sortbyvalue= $params['sortBy'];
                                      if($sortbyvalue==2){
                                        ?>
                                      <input type="radio" id="customRadio2" name="sortBy"
                                     checked class="custom-control-input" value="2">
                                     <?php }else{
                                        ?>
                                        <input type="radio" id="customRadio2" name="sortBy"
                                     class="custom-control-input" value="2">
                                     <?php
                                           } ?>
                                       <label class="custom-control-label" for="customRadio2">Date</label>
                                     </div>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                     <?php
                                      $params =$_GET;
                                      $sortbyvalue= $params['sortBy'];
                                      if($sortbyvalue==3){
                                        ?>
                                      <input type="radio" id="customRadio3" name="sortBy"
                                      checked class="custom-control-input" value="3">
                                      <?php }else{
                                        ?>
                                        <input type="radio" id="customRadio3" name="sortBy"
                                       class="custom-control-input" value="3">
                                       <?php
                                           } ?>
                                     <label class="custom-control-label" for="customRadio3">Price</label>
                                     </div>
                                   </div>
                                 </div>
                                 <button type="button" class="btn btn-block m-t-40" id="search2">search</button>
                               </div>
                             </div>
                           </li>
                         </ul>
                                   </div>
                                   </div>
                                   </div>
                                      <!-- modal -->
                       </div>
                     </div>
                   </div>

                   <?php
                          $params =$_GET;
                          $searchlist=array();
                          $responseData = getSearchResult($params);
                         // print_r($responseData);exit();
                          $searchlist=$responseData['searchResult'];
                          $totalPages=ceil($responseData['totalRecord']/5);
                             $totalRecord=$responseData['totalRecord'];
                             $rows=count($searchlist)?count($searchlist):0;


                           ?>


                     <div id="datacollect"> </div>

               <input type="hidden" id="result_no" value="2">

               <button type="button" class="btn loadmore-btn" id="moredata">Load more
               <img src="<?php bloginfo('template_url')?>/images/load-btndown.png"  alt=""/>



                </button>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <!--SEARCH-RESULT-->
   <!--POPULAR-COURSE-->
   <div class="popular-course">
     <div class="container-fluid">
       <h2 class="mobile-main-heading m-b-50">Popular Courses</h2>
       <div class="row">
     <div class="col-sm-12">

    <?php

foreach ($popularList as $key => $value) {
$currency=$value->prog_fees_value?$value->prog_fees_currency:'';
$startDateText=$value->prog_start_date? "Start Date : " :$value->intake;
$startDate=$value->prog_start_date?  date("m-d-Y", strtotime($value->prog_start_date)) :'';
$applicationFees=$value->prog_fees_value? floatval($value->prog_fees_value) :'';
$address= '<span>'.$value->city.',</span> <span class="name">'.$value->country_name.'</span>';
$university=$value->university_name?:'';


 ?>
           <div class="course-list">
             <div class="row">
               <div class="col-5">
                 <div class="img-sec">
                 <img src="<?php bloginfo('template_url')?>/images/img-world-citizenship.png"
                 alt="course-img" class="img-fluid"/>




          <span class="amount"><span class="value"><?php echo $applicationFees?></span>
            <span class="type">USD</span></span>
                 </div>
               </div>
               <div class="col-7 pl-0">
                 <a class="addfav" href="">
                 <img src="<?php bloginfo('template_url')?>/images/course-fav.png"
                 alt="course-img" class="img-fluid"/>


                </a>
                 <div class="row">
                   <div class="col-sm-12">
                     <p class="date">Start Date: <span><?php echo $startDate?></span></p>
                   </div>
                 </div>
                 <h3>
                 <img src="<?php bloginfo('template_url')?>/images/usa.png"
                 alt="flag" />


                   <span><?php echo $university?></span></h3>
                 <h2><?php echo $value->course_name?></h2>
               </div>
             </div>
           </div>
           <?php } ?>
         </div>
       </div>
     </div>
   </div>
   <!--POPULAR-COURSE-->
   <!--SET-COURSE-->
   <div class="mobile-about-oursolutions m-b-50">
     <div class="col-md-12 p-b-50">
       <div class="content">
         <h3 class="mobile-sub-heading">get, set, global!</h3>
         <h2 class="mobile-main-heading">Set the right course</h2>
         <p>Would you like your journey of searching the right university to be even more precise and tailored right to your needs? Register
           to our Student’s Portal to get wider access to all of our tools. Let’s start this journey together!</p>
           <button type="button" class="btn btn-primary">sign in to portal<img alt="" src="images/right-arrow.png" class="img-fluid"></button>
         </div>
       </div>
       <div class="col-md-12 p-0">
       <img src="<?php bloginfo('template_url')?>/images/set-the-course-mobile.jpg"
             width="400"    alt="" class="img-fluid" />


       </div>
     </div>
     <!--SET-COURSE-->
     <!--ABOUT-SIGNUP-->
     <div class="mobile-learning-iconfield global-space m-b-40">
       <div class="container-fluid">
         <h2 class="mobile-main-heading">Why Sign Up with TC Global</h2>
         <div class="row">
           <div class="col-6">
           <img src="<?php bloginfo('template_url')?>/images/profile-editing.png"
                alt="" class="img-fluid m-b-20" />



             <p class="mb-2">Build and Manage your Profile</p>
           </div>
           <div class="col-6">
           <img src="<?php bloginfo('template_url')?>/images/dashboard.png"
                alt="" class="img-fluid m-b-20" />


             <p class="mb-2"><span class="d-block">Journey</span> Dashboard</p>
           </div>
           <div class="col-6">
           <img src="<?php bloginfo('template_url')?>/images/global-partnership.png"
                alt="" class="img-fluid m-b-20" />

            <p class="mb-2">Community and Global Partnerships</p>
           </div>
           <div class="col-6">
           <img src="<?php bloginfo('template_url')?>/images/services-ecosystem.png"
                alt="" class="img-fluid m-b-20" />



             <p class="mb-2">Rich Matching and Recommendation Engine</p>
           </div>
           <div class="col-6">

           <img src="<?php bloginfo('template_url')?>/images/events.png"
                alt="" class="img-fluid m-b-20" />



             <p class="mb-2">Recommended Insights and Events</p>
           </div>
           <div class="col-6">
           <img src="<?php bloginfo('template_url')?>/images/help-centre.png"
                alt="" class="img-fluid m-b-20" />

             <p class="mb-2">HelpCentre and Knowledge Base</p>
           </div>
         </div>
       </div>
     </div>
     <!--ABOUT-SIGNUP-->
     <div class="mobile-popular-insights py-0">
       <div class="mobile-popular-insights pb-0 mobile-spacing">
         <h3 class="sub-heading mb-0">Explore our resources</h3>
         <h2 class="main-heading">Popular Insights</h2>
       </div>
       <section class="carousel slider mobile-popular-insights py-0 ">
        <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />

              </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />


            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />

            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />
            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />

            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />

            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />


            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />


            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />


            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />


            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />


            </a>
           </div>
         </div>
         <div>
           <div class="list">
             <span class="taglabel">Future of Ed</span>
             <h2>Jobs adapting<br> to technological<br> advances</h2>
             <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
             <a href="" class=""><span>Read more</span>
             <img src="<?php bloginfo('template_url')?>/images/down_2.png"
                alt=""  />


            </a>
           </div>
         </div>
       </section>

       <div class="mobile-popular-insights text-center pt-0">
         <a href="" class="eventbtn d-block text-decoration-none mx-auto text-uppercase">Go To Insights<span><img src="images/whiteforward.png" alt="" width="13"></span></a>
       </div>
     </div>


</form>
   </section>



<script type="text/javascript">
  $('.mobile-menu, .overlay').click(function () {
  	$('.mobile-menu').toggleClass('clicked');

  	$('#mobile-nav').toggleClass('show');

  });
</script>

<script>
$('.carousel').slick({
    dots: true,
    infinite: true,
    speed: 300,
    centerPadding: '33px',
    slidesToShow: 1,
    slidesToScroll: 1,
    focusOnSelect: true,
    centerMode: true,

  });
</script>


<script type="text/javascript">
    var rangeMax = $('#range-max-value').text();
    var rangeMaxSelected = $('#feesrangeselectedMax').text();
    var rangeMinSelected = $('#feesrangeselectedMin').text();

    $(".js-range-slider").ionRangeSlider({
        skin: "round",
        type: "double",
        grid: true,
        min: 0,
        max: rangeMax,
        from: rangeMinSelected,
        to: parseFloat(rangeMaxSelected) === 0 ? rangeMax : rangeMaxSelected,
        prefix: "$"
    });
</script>

<script>
$(document).ready(function(){
  $("#finalsorting").click(function(){
$("input:checkbox").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
      var group = "input:checkbox[name='" + $box.attr("name") + "']";
      $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
  });
});
</script>

<script>
     $('#topsearch').on('click',function () {
        $('#searchForm').submit();
    });
    $('#morefilter').on('click', function () {
        $('#searchForm').submit();
    });
    $('#search2').on('click', function () {
        $('#searchForm').submit();
    });
  </script>
  <script>
$(document).ready(function(){
    $("#newfilter").hide();
  $(".more-show").click(function(){
    $("#filter").css("display", "block");
    $("#topsearch").hide();
    $("#filters").hide();
    $("#newfilter").show();

   });

});
</script>
<script>
 $(document).ready(function(){

    $('.page-template').addClass('footer-bottom-padding');
   });

</script>
<script>


$(document).ready(function(){

function GetQueryStringParams(sParam,type)
{
  var sPageURL = window.location.search.substring(1);
  var sURLVariables = sPageURL.split('&');
  var studyvalues=type===1?[]:'';
    for (var i = 0; i < sURLVariables.length; i++)
      {
          var sParameterName = sURLVariables[i].split('=');
          var sParameterNameChanged = sParameterName[0].split('%');
          //console.log('sParameterNameChanged',sParameterNameChanged)
          if (sParameterNameChanged[0] ==sParam )
          {
            if(type===1){
              var formatedName= sParameterName[1].replace(/[+\s]/g, ' ')
              studyvalues.push(formatedName)
            }else{
              studyvalues=sParameterName[1];
            }
          }
      }
    return studyvalues;
 }


  var areaofstudyvalue = GetQueryStringParams('areaOfStudy',1);
  var countryvalue = GetQueryStringParams('country',1);
  var courseoptionvalue = GetQueryStringParams('specialization',1);
  var studylevelvalue = GetQueryStringParams('studyLevel',1);
  var universityvalue = GetQueryStringParams('university',1);
  var cityvalue = GetQueryStringParams('city',1);
  var intakevalue = GetQueryStringParams('intake',1);
  var languagetestvalue = GetQueryStringParams('acceptedTest',1);
  $("#areaOfStudy").val(areaofstudyvalue).trigger('change');
  $("#country").val(countryvalue).trigger('change');
  $("#specialization").val(courseoptionvalue).trigger('change');
  $("#studyLevel").val( studylevelvalue).trigger('change');
  $("#university").val( universityvalue).trigger('change');
  $("#city").val( cityvalue).trigger('change');
  $("#intake").val( intakevalue).trigger('change');
  $("#acceptedTest").val( languagetestvalue).trigger('change');
   $(".more-show").click(function(){
    $("#filter").css("display", "block");
    $("#topsearch").hide();
    $("#filters").hide();

   });
  //console.log('cityvalue',cityvalue);


});


</script>
<script>
$(document).ready(function() {
  $('.mutlidropdown').select2();
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
 $("#moredata").click(function(){
  var offset=document.getElementById("offset").value;
 var offsetVal=parseInt(offset)+5;
  loadmore(offsetVal);
 });
 var offset=document.getElementById("offset").value;
 loadmore(offset);
});


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


  var offsetval= document.getElementById("offset").value;
 var val = document.getElementById("result_no").value;
 var areaval = document.getElementById("areaOfStudy").value;
 var countryval = document.getElementById("country").value;
 var specializval = document.getElementById("specialization").value;
 var studyval  = document.getElementById("studyLevel").value;
 var univval   = document.getElementById("university").value;
 var cityval   = document.getElementById("city").value;
 var intakeval = document.getElementById("intake").value;
 var feesRangemax =  $("#feesrangeselectedMax").text();
 var feesRangemin =  $("#feesrangeselectedMin").text();
 var acceptedtestval = []
        $("input[name='acceptedTest[]']:checked").each(function ()
        {
          acceptedtestval.push(($(this).val()));
        });

 var showlistval= $("input[name='showlist']:checked").val();
 var sortbyval =  $("input[name='sortBy']:checked").val();
 var settingsProg = {
		  "url": "http://13.235.4.44/client_api/program_data/v1.0/",
		  "method": "POST",
		  "headers": {
		    "Content-Type": "application/json",
		    "Authorization": "Token 08e128cafdeef5d79ef0bd2ae30ccebfea888564",
		  },
      //"data":"{\"username\":\"dhibakar.j@optisolbusiness.com\",\"password\":\"Optisol@123\"}"
		  //"data": '{"university_name":"GSM London","country_name": "United Kingdom",,offset":0,"limit":2}'
      "data": "{\"offset\":"+ offsetval+",\"limit\":3,\"areaOfStudy\":"+null+",\"country_name\":\"United Kingdom\",\"specialization\":"+null+", \"studyLevel\":"+null+",\"university\":"+null+",\"feesRange\":"+null+", \"feesRangemin\":"+null+",\"acceptedTest\":"+null+",\"showlist\":"+null+", \"sortBy\":"+null+"}"
   	}


 	$.ajax(settingsProg).done(function (response) {
     console.log('response',response);
    // var content =JSON.parse(response);
    var content =response;
    //paginationResult(content.count);
     var box='';

    for (var i=0; i<content.records.length; i++) {

         var res= content.records[i];
         console.log('res',res);

        var url='/coursedetail?prog_name=' +res.prog_name+'&university_name='+res.university_name+'&country_name='+
        res.country_name;
          var url= encodeURI(url);


            box+= '<div class="searchlist-box">'+

              '<div class="row">'+
                '<div class="col-sm-12 thumbnail">'+

                '<a href="'+url+'">'+

'<img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img"class="img-fluid"> '+
                  '</a>'+
                  '<span class="name type1"></span>'+
                  '<div class="searchlist-fav">'+
                   '<a href="">'+
'<img src="<?php echo bloginfo('template_url') ?>/images/searchlist-fav.png" alt="fav.png"> '+

                '</a>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 px-20">'+
                  '<div class="col-sm-12">'+
                    '<div class="row">'+
                      '<div class="col-10">'+
                      '<span class="amount"><span class="value">'+res.prog_fees_value+'</span>'+
                        '<span class="type">'+res.prog_fees_currency+'</span>'+
                      '</div>'+
                      '<div class="col-2 p-0">'+
                        '<div class="tag-count">'+
'<img src="<?php echo bloginfo('template_url') ?>/images/rank-tag.png" alt="tag"> '+

                       '<span class="value">'+res.score_1+'</span>'+
                        '</div>'+
                       '<div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div>'+
                       '<div class="popover-body"> World University Rank </div>'+
                     '</div>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                     '<p class="date">Start Date: <span>'+res.prog_start_date+'</span></p>'+
                  '</div>'+
                  '</div>'+
                  '<h3><img src="<?php echo bloginfo('template_url') ?>/images/usa.png" alt="flag"><span>'+res.university_name+'</span></h3>'+

                  '<h2>' +res.prog_name+'</h2>'+
                  '<div class="row">'+
                   '<div class="col-sm-12">'+
                    '<button type="button" class="btn btn-block btn-danger">check eligibility</button>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                   '<button type="button" class="btn btn-block btn-outline-danger">express your interest</button>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>'


  }
  $("#datacollect").empty().append(box);
  console.log(response);
	});


  function  callapirecords(){
 var offsetval= document.getElementById("offset").value;
 var val = document.getElementById("result_no").value;
 var areaval = document.getElementById("areaOfStudy").value;
 var countryval = document.getElementById("country").value;
 var specializval = document.getElementById("specialization").value;
 var studyval  = document.getElementById("studyLevel").value;
 var univval   = document.getElementById("university").value;
 var cityval   = document.getElementById("city").value;
 var intakeval = document.getElementById("intake").value;
 var feesRangemax =  $("#feesrangeselectedMax").text();
 var feesRangemin =  $("#feesrangeselectedMin").text();
 var acceptedtestval = []
        $("input[name='acceptedTest[]']:checked").each(function ()
        {
          acceptedtestval.push(($(this).val()));
        });

 var showlistval= $("input[name='showlist']:checked").val();
 var sortbyval =  $("input[name='sortBy']:checked").val();
  //$('.modal-open').hide();
  $('.modal-backdrop').hide();
  $('#myModal').hide();
  $('#myModal1').hide();
  $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");
	var settingsProg = {
		  "url": "http://13.235.4.44/client_api/program_data/v1.0/",
		  "method": "POST",
		  "headers": {
		    "Content-Type": "application/json",
		    "Authorization": "Token 08e128cafdeef5d79ef0bd2ae30ccebfea888564",
		  },
      //"data":"{\"username\":\"dhibakar.j@optisolbusiness.com\",\"password\":\"Optisol@123\"}"
		   //"data": '{"university_name":"GSM London","country_name": "United Kingdom",,offset":0,"limit":10}'
      "data": "{\"showlist\":\""+showlistval+"\", \"sortBy\":\""+sortbyval+"\",\"offset\":"+ offsetval+",\"limit\":"+val+",\"areaOfStudy\":"+null+",\"country_name\":\""+countryval+"\",\"specialization\":"+null+", \"studyLevel\":"+null+",\"university\":"+null+",\"feesRange\":"+null+", \"feesRangemin\":"+null+",\"acceptedTest\":"+null+"}"
   	}

 	$.ajax(settingsProg).done(function (response) {
     console.log('response',response);
    // var content =JSON.parse(response);
    var content =response;
         var box='';

    for (var i=0; i<content.records.length; i++) {

         var res= content.records[i];
         console.log('res',res);

         var url='/coursedetail?prog_name=' +prog_name+'&university_name='+res.university_name+'&country_name='+
        res.country_name;
            box+= '<div class="searchlist-box">'+

              '<div class="row">'+
                '<div class="col-sm-12 thumbnail">'+

                '<a href="'+url+'">'+

'<img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img"class="img-fluid"> '+
                  '</a>'+
                  '<span class="name type1"></span>'+
                  '<div class="searchlist-fav">'+
                   '<a href="">'+
'<img src="<?php echo bloginfo('template_url') ?>/images/searchlist-fav.png" alt="fav.png"> '+

                '</a>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 px-20">'+
                  '<div class="col-sm-12">'+
                    '<div class="row">'+
                      '<div class="col-10">'+
                      '<span class="amount"><span class="value">'+res.prog_fees_value+'</span>'+
                        '<span class="type">'+res.prog_fees_currency+'</span>'+
                      '</div>'+
                      '<div class="col-2 p-0">'+
                        '<div class="tag-count">'+
'<img src="<?php echo bloginfo('template_url') ?>/images/rank-tag.png" alt="tag"> '+

                       '<span class="value">'+res.score_1+'</span>'+
                        '</div>'+
                       '<div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div>'+
                       '<div class="popover-body"> World University Rank </div>'+
                     '</div>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                     '<p class="date">Start Date: <span>'+res.prog_start_date+'</span></p>'+
                  '</div>'+
                  '</div>'+
                  '<h3><img src="<?php echo bloginfo('template_url') ?>/images/usa.png" alt="flag"><span>'+res.university_name+'</span></h3>'+

                  '<h2>' +res.prog_name+'</h2>'+
                  '<div class="row">'+
                   '<div class="col-sm-12">'+
                    '<button type="button" class="btn btn-block btn-danger">check eligibility</button>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                   '<button type="button" class="btn btn-block btn-outline-danger">express your interest</button>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>'

                //  popular courses



  }
  $("#datacollect").empty().append(box);
  console.log(response);
	});


 console.log('box',box);

   return false;
  // We increase the value by 2 because we limit the results by 2
}
function loadmore(offsetVal)
{
 var val = document.getElementById("result_no").value;
 var areaval = document.getElementById("areaOfStudy").value;
 var countryval = document.getElementById("country").value;
 var specializval = document.getElementById("specialization").value;
 var studyval  = document.getElementById("studyLevel").value;
 var univval   = document.getElementById("university").value;
 var cityval   = document.getElementById("city").value;
 var intakeval = document.getElementById("intake").value;
 var feesRangemax =  $("#feesrangeselectedMax").text();
 var feesRangemin =  $("#feesrangeselectedMin").text();
 var acceptedtestval = []
        $("input[name='acceptedTest[]']:checked").each(function ()
        {
          acceptedtestval.push(($(this).val()));
        });

var showlistval= $("input[name='showlist']:checked").val();
var sortbyval =  $("input[name='sortBy']:checked").val();
 //console.log('showlistval',showlistval)
 //console.log('feesRangemax', feesRangemax)
 //console.log('feesRangemin', feesRangemin)


 //console.log('offsetVal',offsetVal)
 $('#offset').val(offsetVal);
 var recordCount=$('#recordCount').val();
 $.ajax({
 type: 'post',
 url:  "http://13.235.4.44/client_api/program_data/v1.0/",
  data: {
  limit:val,
  offset:offsetVal,
  areaOfStudy:areaval,
  country_name: countryval,
  specialization:specializval,
  studyLevel:studyval,
  university:univval,
  city:cityval,
  intake:intakeval,
  feesRange:feesRangemax,
  feesRangemin:feesRangemin,
  acceptedTest:acceptedtestval,
  showlist:showlistval,
  sortBy:sortbyval,
},
 success: function (response) {
  var content = jQuery.parseJSON(response);
  var box='';
  //console.log('offsetVal')
  //console.log('content.totalRecord',content.totalRecord)

  recordCount=parseInt(recordCount)+parseInt(content.searchResult.length);
  $('#recordCount').val(recordCount);
  if (recordCount>= content.totalRecord ){
    $("#moredata").css('display','none');
  }
  for (var i=0; i<content.records.length; i++) {

         var res= content.records[i];

         var url='/coursedetail?prog_name=' +res.prog_name+'&university_name='+res.university_name+'&country_name='+
        res.country_name;
            box+=  '<div class="searchlist-box">'+

              '<div class="row">'+
                '<div class="col-sm-12 thumbnail">'+

                '<a href="'+url+'">'+

'<img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img"class="img-fluid"> '+
                  '</a>'+
                  '<span class="name type1"></span>'+
                  '<div class="searchlist-fav">'+
                   '<a href="">'+
'<img src="<?php echo bloginfo('template_url') ?>/images/searchlist-fav.png" alt="fav.png"> '+

                '</a>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 px-20">'+
                  '<div class="col-sm-12">'+
                    '<div class="row">'+
                      '<div class="col-10">'+
                      '<span class="amount"><span class="value">'+res.prog_fees_value+'</span>'+
                        '<span class="type">'+res.prog_fees_currency+'</span>'+
                      '</div>'+
                      '<div class="col-2 p-0">'+
                        '<div class="tag-count">'+
'<img src="<?php echo bloginfo('template_url') ?>/images/rank-tag.png" alt="tag"> '+

                       '<span class="value">'+res.score_1+'</span>'+
                        '</div>'+
                       '<div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div>'+
                       '<div class="popover-body"> World University Rank </div>'+
                     '</div>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                     '<p class="date">Start Date: <span>'+res.prog_start_date+'</span></p>'+
                  '</div>'+
                  '</div>'+
                  '<h3><img src="<?php echo bloginfo('template_url') ?>/images/usa.png" alt="flag"><span>'+res.university_name+'</span></h3>'+

                  '<h2>' +res.prog_name+'</h2>'+
                  '<div class="row">'+
                   '<div class="col-sm-12">'+
                    '<button type="button" class="btn btn-block btn-danger">check eligibility</button>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                   '<button type="button" class="btn btn-block btn-outline-danger">express your interest</button>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>'


  }
   $("#datacollect").append(box);
  // We increase the value by 2 because we limit the results by 2
 }
 });
}
</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" rel="stylesheet" />
<?php get_footer(); ?>


<div class="search-filter-buttons global-space">

    <div class="row">
      <div class="col-6 text-center pt-2">
        <a href="" class="more-link" id="finalsorting" data-toggle="modal"
          data-target="#myModal1">sorting</a>
      </div>
      <div class="col-6 pl-0">
         <button type="button" id ="finalfilter" class="btn btn-theme" data-toggle="modal"
          data-target="#myModal">show filters</button>
      </div>
    </div>

  </div>
