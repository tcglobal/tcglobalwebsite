 <?php /* Template Name: coursedetailtemplate */ ?>
    <?php get_header();

    global $post, $wpdb;
    global $current_pageName, $current_page_url;
    $current_pageName = $post->post_title;
    $obj_id = get_queried_object_id();
    $current_page_url = get_permalink( $obj_id );

    $coursesmayList =array();
    /*$custom_action = new  Searchtool\Api\Service;
    $courseResponse = $custom_action->fetchCourseDetails($_GET);*/

    $courseResponse = fetchCourseDetails($_GET); //function call in same file
    $courseResponse = json_decode($courseResponse);
    $courseDetails=$courseResponse->result->course;
    $countryFlag=$courseDetails && $courseDetails->flag?$courseDetails->flag:null;
    $countryFlag=$courseDetails->country=='United Kingdom'?'gb.png':$countryFlag;


		$middle_east_countries = array("Afghanistan","Pakistan","Bahrain");
		$europe_countries = array("Albania","Andorra","Armenia","Austria","Azerbaijan","Belarus","Belgium","Bulgaria",
"Croatia","Cyprus","Czech Republic","Denmark","Estonia","Finland","France","Georgia","Germany","Greece","Hungary","Iceland","Italy","Kosovo","Latvia",
"Liechtenstein","Lithuania","Luxembourg","Macedonia","Malta","Moldova","Monaco","Montenegro","Netherlands","Norway","Poland","Portugal","Romania",
"Russia","San Marino","Serbia","Slovakia","Slovenia","Spain","Sweden","Switzerland","Turkey","Ukraine","Vatican City","Brazil","Mauritius");
		$bannerImg ='';
		$bannerImgUrl ='';
		if($courseDetails->country=='United Kingdom')
		{
			$bannerImg = 'style="background: url(/university/banner/United-Kingdom.jpg) no-repeat;"';
			$bannerImgUrl = 'university/banner/United-Kingdom.jpg';
		}
		else if($courseDetails->country=='Ireland')
		{
			$bannerImg = 'style="background: url(/university/banner/Ireland.jpg) no-repeat;"';
			$bannerImgUrl = 'university/banner/Ireland.jpg';
		}
		else if($courseDetails->country=='USA' || $courseDetails->country=='Canada')
		{
			$bannerImg = 'style="background: url(/university/banner/US-and-Canada.jpg) no-repeat;"';
			$bannerImgUrl = 'university/banner/US-and-Canada.jpg';
		}
		else if(in_array($courseDetails->country, $europe_countries))
		{
			$bannerImg = 'style="background: url(/university/banner/All-Europe.jpg) no-repeat;"';
			$bannerImgUrl = 'university/banner/All-Europe.jpg';
		}
		else if($courseDetails->country=='UAE' || in_array($courseDetails->country, $middle_east_countries))
		{
			$bannerImg = 'style="background: url(/university/banner/UAE-and-Middle-East.jpg) no-repeat;"';
			$bannerImgUrl = 'university/banner/UAE-and-Middle-East.jpg';
		}
		else if($courseDetails->country=='Australia' || $courseDetails->country=='New Zealand')
		{
			$bannerImg = 'style="background: url(/university/banner/Australia-and-NZ.jpg) no-repeat;"';
			$bannerImgUrl = 'university/banner/Australia-and-NZ.jpg';
		}
		else
		{
			$bannerImg = 'style="background: url(/university/banner/Singapore-and-Malaysia,-and-all-other.jpg) no-repeat;"';
			$bannerImgUrl = '/university/banner/Singapore-and-Malaysia,-and-all-other.jpg';
		}
    ?>
      <section class="mobile-mainsection">
  <div class="searchpartner-banner-bg bg-center" <?php echo $bannerImg; ?>>
    <div class="bg-color ">
      <div class="course-detail-container"></div>
    </div>
  </div>
  <div class="bg-color Partner-banner position-relative course-padding ">
    <div class="bottom-bg"></div>
    <div class="bg-color">
      <div class="container position-relative">
     <!-- data collect starts here -->
            <?php  if(empty($courseDetails)) {
            ?>
             <h4 class="text-center col-sm-12">No data found</h4>
            <?php
              }else{ ?>
            <div id="datacollect">
            <div class="partner-form-fields">
                          <div class="row">
      <div class="col-sm-12 honours_pad">
        <div class="univ_logo m-b-30">
		<?php if($courseDetails && $courseDetails->logo!=""){ ?>
        <img src="/university/logo/<?php echo $courseDetails->logo; ?>" width="125" alt="life" class="">
<?php } ?>

        <a class="float-right heart-icon" >
        <img src="<?php bloginfo('template_url')?>/images/search-fav-unfill.png" alt="fav" style="display:none">
        </a>
          </div>
        <h2 class="mobile-main-heading">
        <span class=""><?php echo $courseDetails->prog_name_bv?> </span>
        </h2>
        <div class="col-sm-12 university_fields p-0">
          <div class="row">
            <div class="col-sm-12">
              <h3 class="flag-btn-new">
                <?php if($countryFlag){
                      ?>
                    <img style="width: 20px;height: 15px;" src="<?php echo plugins_url('searchtool')."/flags/".$countryFlag ?>" alt="flag" class="float-left m-b-20">
                    <?php
                    }?>
                <div class="float-left pl-3">
                <div class="w-100 univ-head"><?php echo $courseDetails->university ?> </div>
                  <span><?php echo $courseDetails->prog_campus_bv ? $courseDetails->prog_campus_bv.',' :$courseDetails->prog_campus_bv ?> </span>
                  <span class="name"><?php echo $courseDetails->country ?> </span>
                  <div class="about-the-university w-100">about the university</div>
                </div>
              </h3>
            </div>

            <div class="col-sm-12">
              <div class="d-flex m-b-40 m-t-20 align-items-center">
              <?php if($courseDetails->qs_world_ranking && $courseDetails->qs_world_ranking != "0" && $courseDetails->qs_world_ranking != "-"){ 

                  $str_explode=explode("-",$courseDetails->qs_world_ranking);
                        
                  if ($str_explode[0] && $str_explode[1]) {
                      $qsRank = $str_explode[0].'+';
                  }
                  else{
                     $qsRank = $courseDetails->qs_world_ranking;
                  }

                ?>

                <div class="tag-count w-55">
                  <span><?php echo $qsRank; ?></span>
                </div>
                <span class="tag-count-value ml-3">Global university ranking</span>

                <?php }
                  if($courseDetails->graduate_employability_ranking && $courseDetails->graduate_employability_ranking != "0" && $courseDetails->graduate_employability_ranking != "-"){

                    $graduate_explode=explode("-",$courseDetails->graduate_employability_ranking);
                        
                        if ($graduate_explode[0] && $graduate_explode[1]) {
                            $graduateRank = $graduate_explode[0].'+';
                        }
                        else{
                           $graduateRank = $courseDetails->graduate_employability_ranking;
                        }

                  ?>
                </div>
                <div class="d-flex align-items-center m-b-20">
                  <div class="tag-count redbg w-55">
                    <span><?php echo $graduateRank; ?></span>
                  </div>
                  <span class="tag-count-value ml-3">Graduate Employability Ranking</span>
                </div>

                <?php } ?>

            </div>
            <div class="col-sm-12 clearfix p-0">
              <div class="check-eligible float-left m-t-30">
                <button type="button" class="btn btn-block btn-danger allformtrigger" data-toggle="modal" data-target="#checkeligible">Check your eligibility</button>
                <button type="button" class="btn btn-block btn-outline-danger expressbtn allformtrigger" data-toggle="modal" data-target="#expressModal" >express your interest</button>
              </div>
            </div>

          </div>
          </div>
        <div class="quick-fact col-sm-12 px-0 p-b-20 border-bottom">
          <h4 class="m-t-30 m-b-30">Quick facts</h4>
          <?php //if($courseDetails->prog_campus || $courseDetails->prog_duration_value){?>
          <div class="col-sm-12 p-0">
            <div class="row">
              <?php if($courseDetails->prog_campus_bv){?>
                <div class="col-6 mb-3 pr-0">
                    <span class="bg-check24 bg-24 float-left ml-0"></span>
                    <div class="textcontent-right-life">
                      <p>Campus </p>
                      <p>
                          <span><?php echo $courseDetails->prog_campus_bv ?> </span>
                      </p>
                    </div>
                </div>
              <?php } ?>
              <?php if($courseDetails->prog_duration_value_bv){

                  if( $courseDetails->prog_duration_value_bv != 1 && ($courseDetails->prog_duration_unit_bv == "Annually" || $courseDetails->prog_duration_unit_bv == "annually")){
                              $durationType = "Years";
                    }

                    elseif( $courseDetails->prog_duration_value_bv == 1 && ($courseDetails->prog_duration_unit_bv == "Annually" || $courseDetails->prog_duration_unit_bv == "annually")){
                      $durationType = "Year";
                    }

                    elseif( $courseDetails->prog_duration_value_bv != 1 && ($courseDetails->prog_duration_unit_bv == "Monthly" || $courseDetails->prog_duration_unit_bv == "monthly")){
                      $durationType = "Months";
                    }

                    elseif( $courseDetails->prog_duration_value_bv == 1 && ($courseDetails->prog_duration_unit_bv == "Monthly" || $courseDetails->prog_duration_unit_bv == "monthly")){
                      $durationType = "Month";
                    }
                    else{
                      $durationType = $courseDetails->prog_duration_unit_bv;
                    }


                ?>
                  <div class="col-6 mb-3 pr-0">
                        <span class="bg-check24 bg-24 float-left ml-0"></span>
                        <div class="textcontent-right-life">
                        <p>Duration</p>
                        <p>
                          <span><?php echo $courseDetails->prog_duration_value_bv .' '. $durationType ?> </span>
                        </p>
                        </div>
                  </div>
              <?php } ?>
                  <?php if($courseDetails->prog_start_date_bv){?>
                        <div class="col-6 mb-3 pr-0">
                          <span class="bg-check24 bg-24 float-left ml-0"></span>
                          <div class="textcontent-right-life">
                          <p>Start date </p>
                            <p>
                            <span><?php echo $courseDetails->prog_start_date_bv ?> </span>
                            </p>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if($courseDetails->prog_mode_bv){?>
                        <div class="col-6 mb-3 pr-0">
                            <span class="bg-check24 bg-24 float-left ml-0"></span>
                            <div class="textcontent-right-life">
                              <p>Attendance</p>
                              <p>
                                  <span><?php echo $courseDetails->prog_mode_bv ?> </span>
                              </p>
                            </div>
                          </div>
                      <?php } ?>


                      <?php if($courseDetails->prog_fees_value_usd){?>
                          <div class="col-6 mb-3 pr-0">
                            <span class="bg-check24 bg-24 float-left ml-0"></span>
                            <div class="textcontent-right-life">
                              <p>Avg Tuition/Year </p>
                              <p>
                              <span>USD <?php echo round($courseDetails->prog_fees_value_usd)?></span>
                              </p>
                            </div>
                          </div>
                      <?php }
                      elseif($courseDetails->prog_fees_value_bv && (!$courseDetails->prog_fees_value_usd )){?>
                          <div class="col-6 mb-3 pr-0">
                            <span class="bg-check24 bg-24 float-left ml-0"></span>
                            <div class="textcontent-right-life">
                              <p>Avg Tuition/Year </p>
                              <p>
                              <span><?php echo $courseDetails->prog_fees_currency_bv .' '.round($courseDetails->prog_fees_value_bv)?></span>
                              </p>
                            </div>
                          </div>
                      <?php } ?>

                      <?php if($courseDetails->appl_close_date_bv){?>
                          <div class="col-6 mb-3 pr-0">
                            <span class="bg-check24 bg-24 float-left ml-0"></span>
                            <div class="textcontent-right-life">
                              <p>Application Deadline </p>
                              <p>
                                <span><?php echo $courseDetails->appl_close_date_bv ?> </span>
                              </p>
                            </div>
                          </div>
                      <?php } ?>
                       <?php if($courseDetails->appl_process_time){?>
                <div class="col-6 mb-3 pr-0">
                    <span class="bg-check24 bg-24 float-left ml-0"></span>
                    <div class="textcontent-right-life">
                      <p>Avg.ApplicationProcessing Time
                      </p>
                      <p>
                        <span><?php echo $courseDetails->appl_process_time; ?></span>
                      </p>
                    </div>
                </div>
              <?php } ?>
              <?php if($courseDetails->internship == true || $courseDetails->internship == false){

                if($courseDetails->internship == true){
                  $internshipVal = "Yes";
                }
                elseif($courseDetails->internship == false){
                  $internshipVal = "No";
                }

                ?>
                  <div class="col-6 mb-3 pr-0">
                    <span class="bg-check24 bg-24 float-left ml-0"></span>
                    <div class="textcontent-right-life">
                    <p>Internship </p>
                      <p>
                        <span><?php echo $internshipVal; ?></span>
                      </p>
                    </div>
                  </div>
                <?php } ?>
                <?php //if($courseDetails->appl_close_date){?>
                <div class="col-6 mb-3 pr-0" style="display:none">
                  <span class="bg-check24 bg-24 float-left ml-0"></span>
                  <div class="textcontent-right-life">
                    <p>Qualification  </p>
                    <p>
                        <span></span>
                    </p>
                    </div>
                </div>
                <?php //} ?>
                <?php if($courseDetails->scholarship){?>
                  <div class="col-6 mb-3 pr-0">
                    <span class="bg-check24 bg-24 float-left ml-0"></span>
                    <div class="textcontent-right-life">
                      <p>Scholarship Available </p>
                      <p>
                          <span><?php echo $courseDetails->scholarship; ?></span>
                      </p>
                      </div>
                  </div>
                 <?php } ?>
              </div>
              </div>
              <?php //} ?>

            </div>
        <div class="col-sm-12 px-0 summary_history">
          <h4 class="m-t-30">Summary</h4>
          <p class="bold-text"><?php echo $courseDetails->prog_description_bv.$courseDetails->prog_curriculum_bv ?> </p>
            </div>
          <div class="Top-Courses m-b-30">
            <div class="bg-color"></div>
            <h4>Entry requirements</h4>
            <h3 class="m-t-30">English Language Requirements </h3>
              <ul class="course-list">
               <?php if($courseDetails->er_ielts_bv) {?>
                        <li class="row m-0">
                        <span class="bg-check24 bg-24 float-left ml-0 bg-icons top-0"></span>

                      <span class="col-10">
                        <span class="bold-text"><?php echo $courseDetails->er_ielts_bv ? 'IELTS : ':'   ' ?> </span>
                        <span><?php echo $courseDetails->er_ielts_bv ?> Overall</span>
                       </span>
                        </li>
                      <?php } ?>
                        <?php if($courseDetails->er_toefl_bv) {?>
                        <li class="row">
                        <img src="<?php echo bloginfo('template_url') ?>/images/check24.png"  alt="life" class="col-sm-2 pr-0">

                         <span class="col-10">   <span class="bold-text"><?php echo $courseDetails->er_toefl_bv ? 'TOFEL : ':'   ' ?> </span><span><?php echo $courseDetails->er_toefl_bv ?> Overall</span> </span>
                        </li>
                      <?php } ?>
                        <?php if($courseDetails->er_pte_bv) {?>
                        <li class="row">
                        <img src="<?php echo bloginfo('template_url') ?>/images/check24.png"  alt="life" class="col-sm-2 pr-0">

                          <span class="col-10"><span class="bold-text"><?php echo $courseDetails->er_pte_bv ? 'PTE : ':'   ' ?> </span><span><?php echo $courseDetails->er_pte_bv ?> Overall</span></span>
                        </li>
                      <?php } ?>

            </ul>
            </div>
          <div class="Student-life position-relative">
            <div class="col-sm-12">
            <div class="searchpartner-startjourney px-0 top-0 bottom-0">
              <h3 class="mt-0">Do you want to learn more about this course?</h3>
              <h4>Register to our Student Portal <br>and start your Global Ed journey now!</h4>
              <div class="check-eligible">
                <button type="button" data-toggle="modal" data-target="#start_journey_form" class="btn btn-danger w-100 journey_formClear allformtrigger">start your journey<span class="bg-right_whitearrow bg-icons"></span></button>
              </div>
            </div>
            <h4 class="m-b-30">Facilities</h4>
            <h5 class="m-b-30">Student will have access to</h5>
              <div class="col-sm-12">
              <div class="row">
                <div class="Student-life-blog col-sm-12">
                  <div class="row">
                    <div class="col-3">
                    <!-- <img src="<?php echo bloginfo('template_url') ?>/images/financial-lab.png"  alt="life" class=class="m-b-20"> -->
                    </div>
                    <div class="col-9">
                      <p>Our state-of-the-art Financial Markets Lab</p>
                    </div>
                    </div>
                    </div>
                <div class="Student-life-blog col-sm-12">
                  <div class="row">
                    <div class="col-3">
                    <!-- <img src="<?php echo bloginfo('template_url') ?>/images/financial-software.png"  alt="life"  class=class="m-b-20"> -->
                    </div>
                    <div class="col-9">
                      <p>Bloomberg financial software</p>
                      </div>
                      </div>
                        </div>
                  <div class="Student-life-blog col-sm-12">
                    <div class="row">
                      <div class="col-3">
                  <!-- <img src="<?php echo bloginfo('template_url') ?>/images/data-stream-financial.png"  alt="life"   class=class="m-b-20"> -->

                    </div>
                  <div class="col-9">
                    <p>Data stream financial software</p>
                      </div>
                      </div>
                        </div>
                    <div class="Student-life-blog col-sm-12">
                      <div class="row">
                        <div class="col-3">
                  <!-- <img src="<?php echo bloginfo('template_url') ?>/images/financial-data.png"  alt="life"  class=class="m-b-20"> -->

                        </div>
                        <div class="col-9">
                        <p>Real-time financial data from markets worldwide  </p>
                        </div>
                      </div>
                      </div>
                    <div class="Student-life-blog col-sm-12">
                      <div class="row">
                        <div class="col-3">
                      <!-- <img src="<?php echo bloginfo('template_url') ?>/images/training-software.png"  alt="life"   class=class="m-b-20"> -->
                      </div>
                        <div class="col-9">
                          <p>Training on financial software as part of your course or extra-curricular sessions</p>

                        </div>
                        </div>
                        </div>
                      <div class="Student-life-blog col-sm-12">
                      <div class="row">
                        <div class="col-3">
                        <!-- <img src="<?php echo bloginfo('template_url') ?>/images/account-software.png"  alt="life" class=class="m-b-20"> -->
                          </div>
                          <div class="col-9">
              <p>Sage accounting software, with training and opportunity to gain a CIMA certificate</p>
                          </div>
                          </div>
                        </div>
                        </div>
                        </div>
                        </div>
                    <div class="col-sm-12 m-b-20 pl-0 pr-0">
                      <div class="university-content-leftspace">

                      <h4 class="m-b-30">About <?php echo $courseDetails->university ?> </h4>

                        <div class="bitma-new">
            <img src="<? echo $bannerImgUrl; ?>"  alt="life" class="img-fluid">

                      </div>
                      </div>
                      <p class="m-t-30 light-font">


                      </p>
                      <div class="check-eligible m-t-30">
                        <div class="row">
                        <div class="col-sm-12">
    <button type="button" class="btn btn-block btn-danger px-0">more about the university</button>
                          </div>
                          <div class="col-sm-12">
                          <a href ="/search-tool?university=<?php echo trim($courseDetails->university);?>">
                <button type="button" class="btn btn-block btn-outline-danger">see all courses</button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                <div class="col-sm-12">
                  <a href="/search-tool" class="explorelink text-uppercase text-decoration-none pl-0" tabindex="0">Back to courses<div class="bg-down_2 bg-icons"></div>
                  </a>
                </div>
                </div>
              </div>
              </div>
              </div>
              </div>

            </div>
            <?php }?>
            <!-- data collect ends here -->
            <!--POPULAR-COURSE-->
            <div class="popular-search-course pt-0" style="display:none">
              <div class="text-center">
                <h2 class="main-heading">Courses You May Like</h2>

              </div>
              <div class="container">
                <div class="row">
                <?php
                if($coursesmayList && count($coursesmayList)>0){
                      ?>
                <?php
                }else{
                  ?>
                  <h4 class="text-center no-record-theme">No Records Found</h4>
                  <?php
                } ?>
          </div>
         </div>
        </div>
                  <!--POPULAR-COURSE-->
          </section>

   <!-- Get Shortcode content from editor -->
     <?php
      while ( have_posts() ) : the_post();
          the_content(); // get post content
          endwhile;
    ?>
  <!-- end of event section -->

 <?php
function fetchCourseDetails($postVal)
{

    $posturl = '';
    $prog_id=(int)$postVal['prog_id'];

    //$posturl = "https://tcglobalportalservice.optisolbusiness.com/api/website/courseDetail/".$prog_id;

    $posturl = "https://tcgstagingservice.optisolbusiness.com/api/website/courseDetail/".$prog_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$posturl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return $output;
}
?>

 <script src="/form/express_form.js"></script>

<script>
 $(document).ready(function() {
 var pathName = window.location.pathname;
  if (pathName === '/coursedetails/' || pathName === '/coursedetails') {
        $('html, body').animate({
            scrollTop: $(".course-detail-container").offset().top
        }, 1000);
  }
    $('.mutlidropdown').select2();

});
</script>

<?php get_footer(); ?>
