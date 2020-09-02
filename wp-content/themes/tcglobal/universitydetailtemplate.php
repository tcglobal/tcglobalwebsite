
	
    <?php /* Template Name: universitydetailtemplate */ ?>
    
    
    <?php get_header();  ?>

     <?php
     global $wpdb;
     $param =$_GET;
     $universityDetail=$wpdb->get_results( "SELECT u.*,c.*,c.country_name FROM universities u Left Join 
     country c on u.country_id=c.country_id   where u. university_id=".$param['id']);
      $address=$universityDetail[0]->location.",".$universityDetail[0]->city.",".
      $universityDetail[0]->country_name;
      $address = str_replace(" ", "+", $address);
      $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=".Constants::GOOGLE_MAP_API_KEY);
      $json = json_decode($json);
      $lat=null;
      $long=null;
      if($json->status==='OK'){
          $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
          $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
      }
      $coordinates=array('lat'=>$lat,'lng'=>$long);
      $universityDetail=$universityDetail[0];
    
      ?>
    <?php
    global $wpdb;
    $param =$_GET;
    $response=$wpdb->get_results( "SELECT u.*,c.country_name,un.* FROM courses u 
    Left Join country c on u.country_id=c.country_id 
    Left Join universities un on un.university_id=u.university_id   where u.course_id=".$param['id']);
    $courseDetail =$response;
    $courseDetail=$courseDetail[0];
    ?>

   <?php            
        global $wpdb;
        $response=$wpdb->get_results("SELECT un.*,c.* from universities un
        Left Join courses c on un.university_id= c.university_id where un.popular_course=1 limit 4");
        $popularList =$response;
        
    ?>  
    <?php
        global $wpdb;
        $response=$wpdb->get_results("SELECT un.*,c.* from universities un
        Left join country c on  un.country_id=c.country_id
        order by university_id desc limit 4" );
        $universitymayList =$response;
    ?>


     <section class="desktop-mainsection">
      <div class="searchpartner-banner-bg">
        <div class="bg-color"></div>
      </div>
      <div class"">
        <div class="bg-color Partner-banner position-relative">
          <div class="bottom-bg"></div>
          <div class="container position-relative">
            <div class="top-bg"></div>
            <div class="partner-form-fields">
              <div class="row">
                <div class="col-sm-7 ">
                 <h2 class="main-heading text-left">
                  <span class=""><?php echo  $universityDetail->university_name?></span>
                  <a class="float-right heart-icon" href="">
                  <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/search-fav-unfill.png".'" alt="fav" > ';
                    ?>
                 </a>
                 </h2>
                 <div class="col-sm-12 border-bottom university_fields">
                 <div class="row">
                 <div class="col-sm-6 pl-0">
                  <h3 class="flag-btn">
                  <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/flag-img24.png".'" alt="flag" > ';
                  ?>  
               <span><?php echo  $universityDetail->city ?>,</span> 
               <span class="name"><?php echo  $universityDetail->country_name ?></span></h3>
                 </div>
                  <div class="col-sm-6">
                  <span class="tag-count">
                  <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/rank-tag.png".'" alt="tag" > ';
                   ?> 
                 <span class="value"><?php echo  $universityDetail->ranking?></span>
                  </span>
                 <span class="tag-count-value"> Global university ranking</span>
                 </div>
               </div>
               </div>
               <div class="col-sm-12 university_fields_history">
                 <div class="row">
                 <div class="col-sm-4 pl-0">
                 <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/establishment.png".'" alt="establish" > ';
                  ?> 
                  <p>Established <br>
                    in 1922</p>
                 </div>
                   <div class="col-sm-4">
                   <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/education.png".'" alt="establish" > ';
                  ?> 
                
                  <p>Public <br> University</p>
                 </div>
                 <div class="col-sm-4">
                 <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/search-tool.png".'" alt="establish" > ';
                  ?> 
                  <p>Research <br>
                     & Industry Oriented</p>
                 </div>
               </div>
             </div>
                <div class="col-sm-12 summary_history pl-0">
                  <h4>Summary</h4>
                  <p>
                  <?php echo $universityDetail->overview?>

                  </p>
                </div>
                <div class="col-sm-12 unique_about m-t-40 pl-0">
                <h4 class="m-b-40">What’s Unique About Us</h4>
                <div class="clearfix position-relative m-b-30">
                 <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/global-access.png".'"
                   alt="acess" class="image-left" > ';
                  ?> 
                 <div class="textcontent-right">
                  <h3>Worldwide Reputation</h3>
                  <p>We're the third highest-ranked modern university in London <br>
                in the <a href="#">Times and Sunday Times Good University Guide </a><br>
                for investing in the student experience like services and facilities.
                </p>
                </div>
                </div>
                <div class="clearfix position-relative m-b-30">
                 <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/award.png".'"
                   alt="acess" class="image-left" > ';
                  ?>
                  <div class="textcontent-right">
                  <h3>Teaching Excellence</h3>
                  <p>Teaching Excellence: Our high-quality teaching has been rewarded <br>
with a Silver in the first <a href="#"> Teaching Excellence Framework</a> awards.
                </p>
                </div>
                </div>
                <div class="clearfix position-relative m-b-30">
                 <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/global-partnership48.png".'"
                   alt="global" class="image-left" > ';
                  ?>
                 <div class="textcontent-right">
                  <h3>A Global Community</h3>
                  <p>We are an international community of students, <br>
academics and partners with 145 nationalities represented <br>
on our London and international campuses.
                </p>
                </div>
                </div>
                </div>
                <div class="Top-Courses m-b-30">
                  <h4>Top Courses</h4>
                  <ul class="course-list">
                    <li><span class="number-red">1</span>BA Honours in Business Management</li>
                    <li><span class="number-red">2</span>MBA</li>
                    <li><span class="number-red">3</span>BEng/MEng in Computer Systems Engineering</li>
                    <li><span class="number-red">4</span>BA Honours in Social Work</li>
                    <li><span class="number-red">5</span>BSc Honours in Sports and Exercise Science</li>

                  </ul>
                </div>
                <div class="Niche-Courses m-b-30">
                  <h4>Niche Courses</h4>
                  <ul class="course-list">
                    <li><span class="number-red">1</span>BA Honours in Fashion Design</li>
                    <li><span class="number-red">2</span>MBA</li>
                    <li><span class="number-red">3</span>BEng/MEng in Robotics</li>


                  </ul>
                </div>
                <div class="Student-life">
                  <h4 class="m-b-30">Student life</h4>
                  <h5 class="m-b-30">Teaching Excellence</h5>
                  <div class="col-sm-12 pl-0">
                    <div class="row">
                   <div class="Student-life-blog col-sm-4">
                   <?php
                  echo '<img src="'. plugins_url()."/searchtool/images/facilites.png".'"
                   alt="life" class="m-b-20" > ';
                    ?> 
                    <h5>Specialist Facilities</h5>
                    <p>Labs, studios and specialist facilities</p>
                   </div>
                    <div class="Student-life-blog col-sm-4">
                    <?php
                   echo '<img src="'. plugins_url()."/searchtool/images/library.png".'"
                   alt="life" class="m-b-20" > ';
                    ?> 
                   <h5>Library</h5>
                    <p>24/7 (with tech <br> and study hubs)</p>
                   </div>
                    <div class="Student-life-blog col-sm-4">
                    <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/global-partnership48.png".'"
                   alt="life" class="m-b-20" > ';
                    ?>    
                   <h5>Student Union</h5>
                    <p>MDX <br> House</p>
                   </div>
                    <div class="Student-life-blog col-sm-4">
                    <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/personal-support.png".'"
                    alt="life" class="m-b-20" > ';
                    ?> 
                    <h5>Personal Support</h5>
                    <p>Student Welfare<br>
and Counselling  </p>
                   </div>
                    <div class="Student-life-blog col-sm-4">
                    <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/personal-tutor.png".'"
                    alt="life" class="m-b-20" > ';
                    ?>    
                    
                    <h5>Academic Support</h5>
                    <p>Personal
 <br> Tutor</p>
                   </div>
                    <div class="Student-life-blog col-sm-4">
                    <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/sport.png".'"
                    alt="life" class="m-b-20" > ';
                    ?>  
                    <h5>Sports</h5>
                    <p>The Fitness Pod gym<br>
and sports facilities </p>
                   </div>
                 </div>
                 </div>
                 <div class="col-sm-12 pl-0" >
                 <h5 class="m-b-30">Accommodation</h5>
                 <div class="row" >
                  <div class="col-sm-6" >
                  <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/check24.png".'"
                    alt="life" class="image-left m-b-20"> ';
                    ?>  
                
                    <p class="textcontent-right-life">

                      On-Campus Accommodation:<span> 

                    </span>
                    <a href="#">see Halls of Residence</a>
                  </p>

                  </div>
                   <div class="col-sm-6" >
                   <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/check24.png".'"
                    alt="life" class="image-left m-b-20" > ';
                    ?> 
                    <p class="textcontent-right-life">

                      Off-Campus Accommodation:<span> 

                    </span>
                    <a href="#">see Private Residence</a>
                  </p>

                  </div>
                 </div>
                 </div>
                  <div class="col-sm-12 m-t-30 m-b-30 pl-0" >
                 <h5 class="m-b-30">Take a virtual tour</h5>
                 <div class="">
                    
                 
                 <video width="570"   controls controlsList="nodownload" 
                  disablePictureInPicture >
                  <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" >  
                 Your browser does not support  video.
                  </video>
       
                  
               </div>
               </div>
                </div>
                <div class="Notable-Alumni">
                  <h4>Notable Alumni and Testimonials</h4>
                  <div class="col-sm-12 m-t-30 pl-0">
                    <div class="row">
                  <div class="Notable-Alumni-blog col-sm-6">
                  <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/testimonial-1.png".'"
                    alt="life" class=" m-b-20" > ';
                    ?> 
                    <h5>Lord David Blunkett</h5>
                    <p>He was awarded a peerage
in the dissolution Honours List
in 2015, taking the title of Lord Blunkett
of Brightside and Hillsborough
in the City of Sheffield.</p>
                   </div>
                     <div class="Notable-Alumni-blog col-sm-6">
                    <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/testimonial-2.png".'"
                    alt="life" class=" m-b-20" > ';
                    ?>   
                    
                    <h5>Anne Boden</h5>
                    <p>She is a most unusual banker.
After a distinguished 30–year career
in traditional banking, including as Chief Operating Officer of Allied Irish Banks,
she set out to build her own mobile–only
bank from scratch in 2014.
</p>
                   </div>

                   </div>
                   </div>
                    <div class="col-sm-12 m-t-30 pl-0">
                    <div class="row">
                        <div class="Notable-Alumni-blog col-sm-6">
                        <?php
                       echo '<img src="'. plugins_url()."/searchtool/images/testimonial-3.png".'"
                       alt="life" class=" m-b-20" > ';
                    ?> 
                    
                    <h5>Andy Doyle </h5>
                    <p>Andy is a leading practitioner in the field of   Human Resources. He has been the Group   Human Resources Director of ITV plc and   most recently has been the Chief Human  Resources Officer of Worldpay Group plc
until January 2018.
</p>
                   </div>
                     <div class="Notable-Alumni-blog col-sm-6">
                     <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/testimonial-4.png".'"
                    alt="life" class=" m-b-20" > ';
                    ?> 
                    
                    <h5>Penny Melville-Brown</h5>
                    <p>A graduate of London University,
She became the first woman barrister
in the navy and was promoted to commander. She has run Disability Dynamics for nearly 20 years, helping other disabled people to get back to work particularly through self–employment
and was awarded an OBE.
</p>
                   </div>
                    </div>
                  </div>

                </div>
                </div>
                <div class="col-sm-5">
                   <div class="right-section-pad">
                  <div class="univ_logo">
                   <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/university-logo.png".'"
                    alt="life" class=" m-b-20" > ';
                    ?> 
                    </div>
                  <div class="check-eligible m-t-30">
                    <button type="button" class="btn btn-block btn-danger">Check your eligibility</button>
                    <button type="button" class="btn btn-block btn-outline-danger">express your interest</button>
                  </div>
                  <div class="quick-fact col-sm-12 pl-0 p-b-20 border-bottom">
                    <h4 class="m-t-30 m-b-30">Quick facts</h4>
                    <div class="col-sm-12 p-0 m-b-30">
                  <div class="row">
                  <div class="col-sm-6 pr-0">
                   <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/check24.png".'"
                    alt="life" class= "image-left m-b-20" > ';
                    ?> 
                   <div class="textcontent-right-life">

                      <p>Avg living cost/year </p>
                    <p><span><?php echo  $universityDetail->living_cost?> GBP</span></p>
                  </div>

                  </div>
                   <div class="col-sm-6 pr-0">
                   <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/check24.png".'"
                    alt="life" class= "image-left m-b-20" > ';
                    ?> 
                    <div class="textcontent-right-life">
                    <p>Avg Tuition/Year</p>
                    <p><span><?php echo  $universityDetail->tution_fees?> GBP</span></p>
                  </div>

                  </div>
                 </div>
               </div>
                <div class="col-sm-12 p-0 m-b-30">
                  <div class="row">
                  <div class="col-sm-6 pr-0">
                   <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/check24.png".'"
                    alt="life" class= "image-left m-b-20" > ';
                    ?> 
                  <div class="textcontent-right-life">

                      <p>Scholarship </p>
                    <p><span></span></p>
                  </div>

                  </div>
                   <div class="col-sm-6 pr-0">
                   <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/check24.png".'"
                    alt="life" class= "image-left m-b-20" > ';
                    ?> 
                  <div class="textcontent-right-life">

                      <p>Test Accepted</p>
                    <p><span><?php echo  $universityDetail->standardized_test?></span></p>
                  </div>

                  </div>
                 </div>
               </div>
                 <div class="col-sm-12 p-0 m-b-30">
                  <div class="row">
                  <div class="col-sm-12 pr-0">
                   <?php
                    echo '<img src="'. plugins_url()."/searchtool/images/check24.png".'"
                    alt="life" class= "image-left m-b-20" > ';
                    ?> 
                   <div class="textcontent-right-life">
                    <p>Intake </p>
                    <p><span></span></p>
                  </div>

                  </div>

                 </div>
               </div>
                  </div>
                  <div class="location">
                    <h4 class="m-t-30 m-b-30">Location</h4>
                    
                    <input type="hidden" name="lat" id="lat" value="<?php echo $coordinates['lat']?>">
                   <input type="hidden" name="lng" id="lng"   value="<?php echo $coordinates['lng']?>">
 
                     <div id="map" style="height: 400px; width: 100%;"></div>
                  </div>
                  <div class="Most-popular-courses">
                  <h4 class="m-t-30 m-b-30">Most popular courses</h4>
            
                <?php

               foreach ($popularList as $key => $value) {
               $currency=$value->prog_fees_value?$value->prog_fees_currency:'';
               $startDateText=$value->prog_start_date? "Start Date : " :$value->intake;
               $startDate=$value->prog_start_date?  date("m-d-Y", strtotime($value->prog_start_date)) :'';
               $applicationFees=$value->prog_fees_value? floatval($value->prog_fees_value) :'';
               $address= '<span>'.$value->city.',</span> <span class="name">'.$value->country_name.'</span>';
             
                ?>
                 <div class="media position-relative border-bottom m-b-30">
                    <a class="heart-link" href="">
                    <?php
                      echo '<img src="'. plugins_url()."/searchtool/images/search-fav-unfill.png".'"
                        alt="fav"> ';
                    ?>
                    </a>
                    <div class="float-left">
                      <?php
                       echo '<img src="'. plugins_url()."/searchtool/images/popular.png".'"
                       class="media-object"> ';
                       ?>
                <div class="bottom-usd"><?php echo $applicationFees?><span><?php echo $currency ?></span></div>
                      </div>
                      <div class="media-body">
                        <p class="date-font">Start Date: <span><?php echo $startDate?></span></p>
                        <p class="univ_flag"><span>
                       <?php
                       echo '<img src="'. plugins_url()."/searchtool/images/flag-img.png".'"
                       class="media-object"> ';
                          ?>
                        <span><?php echo $value->university_name?></span></p>
                        <h4><?php echo $value->course_name?></h4>

                       </div>
                       </div>
                  
                      <?php } ?>
                  
                  </div>
                  <div class="check-eligible m-t-30">
                  <a href="/search-tool?offset=0&limit=5&cpage=1&areaOfStudy=&country=&specialization=&studyLevel=&university=&city=&intake=&feesRange=0%3B20000&showlist=1&sortBy=">
                 <button type="button" class="btn btn-block btn-danger">browse courses</button>
                 </a>
     
                  </div>



                </div>

              </div>
              <div class="col-sm-12">
                  <a href=<?php echo '/coursedetails?id='.$courseDetail->course_id?> class="explorelink text-uppercase text-decoration-none" tabindex="0">
                  Back to courses
                  <span class="pl-3">
                  <?php
                       echo '<img src="'. plugins_url()."/searchtool/images/down_2.png".'"
                       alt=""> ';
                    ?>
                   </span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



<!--POPULAR-COURSE-->
<div class="popular-course pt-0">
  <div class="text-center">
    <div class="boldheading">
      Universities You May Like
    </div>
    <div class="path"></div>
  </div>
<div class="container">
  <div class="row">
  <?php

   foreach ($universitymayList as $key => $value) {

   $startDateText=$value->prog_start_date? "Start Date : " :$value->intake;
   $startDate=$value->prog_start_date?  date("m-d-Y", strtotime($value->prog_start_date)) :'';
    $address= '<span>'.$value->city.',</span> <span class="name">'.$value->country_name.'</span>';
  ?>
      
    <div class="col-sm-3">
      <div class="course-list">
        <div class="img-sec">
        <?php
           echo '<img src="'. plugins_url()."/searchtool/images/img-world-citizenship.png".'"
           alt="course-img" class="img-fluid"> ';
             ?>
           <a class="addfav" href="">
           <?php
           echo '<img src="'. plugins_url()."/searchtool/images/added-fav.png".'"
           alt="course-img" class="img-fluid"> ';
             ?>
          </a>
        </div>
        <div class="row">
          <div class="col-sm-9">
            <p class="date">Start Date: <span><?php echo $startDate?></span></p>
          </div>
          <div class="col-sm-3 pt-2 mt-1">
            <div class="tag-count">
            <?php
             echo '<img src="'. plugins_url()."/searchtool/images/rank-tag.png".'"
             alt="tag" > ';
             ?>
            <span class="value"><?php echo $value->ranking?></span>
            </div>
          </div>
        </div>
        <h3 class="mb-1">
           <?php
             echo '<img src="'. plugins_url()."/searchtool/images/flag-img.png".'"
             alt="fag" > ';
             ?>
        <span><?php echo $value->city?>,</span> <span class="name"><?php echo $value->country_name?></span></h3>
        <h3>
           <?php
             echo '<img src="'. plugins_url()."/searchtool/images/user-icon-search.png".'"
             alt="fag" > ';
             ?>
         <span><?php echo $value->city?>,</span> <span class="name">Public University</span></h3>
        <h2 class="mt-4"><?php echo $value->university_name?></h2>
      </div>
    </div>
    <?php } ?>
    </div>
   </div>
  </div>
<!--POPULAR-COURSE-->

<!--SET-COURSE-->

<div class="container p-t-80 p-b-80">
        <div class="boldheading text-center">Upcoming Events </div>
        <div class="path"></div>
        <div class="row">
        <div class="col-sm-3">
          <div class="singleslideitem">
            <div class="position-relative">
            <?php
              echo '<img src="'. plugins_url()."/searchtool/images/event.png".'"
               class="fitimg" > ';
              ?>
           <div class="add-fav">
              <?php
               echo '<img src="'. plugins_url()."/searchtool/images/added.fav.png".'"
               class="" alt="" > ';
              ?>
            </div>
              <div class="view-indicator">
               <?php
               echo '<img src="'. plugins_url()."/searchtool/images/indicator-down.png".'"
               class="view-pointer img-fluid" alt="" > ';
               ?>
             </div>
            </div>
            <div class="contentslider">
              <span class="taglabel">Webinar</span>
              <div class="formheading pb-2">The Global Education Interact</div>
              <div class="officename pb-1">The Chopras, Bangalore Office</div>
              <div class="datetime">11 : 00 AM - 12 : 30 PM</div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="singleslideitem">
            <div class="position-relative">
            <?php
              echo '<img src="'. plugins_url()."/searchtool/images/event.png".'"
               class="fitimg" > ';
              ?>
           <div class="add-fav">
              <?php
               echo '<img src="'. plugins_url()."/searchtool/images/added.fav.png".'"
               class="" alt="" > ';
              ?>
            </div>
              <div class="view-indicator">
               <?php
               echo '<img src="'. plugins_url()."/searchtool/images/indicator-down.png".'"
               class="view-pointer img-fluid" alt="" > ';
               ?>
             </div>
            </div>
            <div class="contentslider">
              <span class="taglabel">Visits</span>
              <div class="formheading pb-2">The Global Education Interact</div>
              <div class="officename pb-1">The Chopras, Bangalore Office</div>
              <div class="datetime">11 : 00 AM - 12 : 30 PM</div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="singleslideitem">
            <div class="position-relative">
            <?php
              echo '<img src="'. plugins_url()."/searchtool/images/event.png".'"
               class="fitimg" > ';
              ?>
           <div class="add-fav">
              <?php
               echo '<img src="'. plugins_url()."/searchtool/images/added.fav.png".'"
               class="" alt="" > ';
              ?>
            </div>
              <div class="view-indicator">
               <?php
               echo '<img src="'. plugins_url()."/searchtool/images/indicator-down.png".'"
               class="view-pointer img-fluid" alt="" > ';
               ?>
             </div>
            </div>
              <div class="contentslider">
              <span class="taglabel">Seminars</span>
              <div class="formheading pb-2">The Global Education Interact</div>
              <div class="officename pb-1">The Chopras, Bangalore Office</div>
              <div class="datetime">11 : 00 AM - 12 : 30 PM</div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="singleslideitem">
            <div class="position-relative">
            <?php
              echo '<img src="'. plugins_url()."/searchtool/images/event.png".'"
               class="fitimg" > ';
              ?>
           <div class="add-fav">
              <?php
               echo '<img src="'. plugins_url()."/searchtool/images/added.fav.png".'"
               class="" alt="" > ';
              ?>
            </div>
              <div class="view-indicator">
               <?php
               echo '<img src="'. plugins_url()."/searchtool/images/indicator-down.png".'"
               class="view-pointer img-fluid" alt="" > ';
               ?>
             </div>
            </div>
            <div class="contentslider">
              <span class="taglabel">Workshops</span>
              <div class="formheading pb-2">The Global Education Interact</div>
              <div class="officename pb-1">The Chopras, Bangalore Office</div>
              <div class="datetime">11 : 00 AM - 12 : 30 PM</div>
            </div>
          </div>
        </div>
      </div>


      </div>




      <!-- end form bottom section -->
    </section>
    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_YqYVTkNqQcetW04CYCrRm1QnomaXoNA">
  

</script>

<script>

function initMap() {
        var lat = $('#lat').val();
        var lng=$('#lng').val();
        console.log(lat)
        console.log(lng)
        var uluru = { lat: parseFloat(lat), lng: parseFloat(lng) };
        var map = new google.maps.Map(
            document.getElementById('map'), { zoom: 7, center: uluru, zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: false });
        var marker = new google.maps.Marker({ position: uluru, map: map });
    }

    initMap();


  </script>





  





    <?php get_footer(); ?>