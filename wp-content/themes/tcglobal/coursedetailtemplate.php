
  <?php /* Template Name: coursedetailtemplate */ ?>
    <?php get_header();
    ?>

  <style>
  .search-tool-menu {color: #da1f3d !important;}
  </style>

    <?php
    global $post, $wpdb;
    global $current_pageName, $current_page_url;
    $current_pageName = $post->post_title;
    $obj_id = get_queried_object_id();
    $current_page_url = get_permalink( $obj_id );

    $coursesmayList=array();

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
      $bannerImgUrl = '/university/banner/United-Kingdom.jpg';
    }
    else if($courseDetails->country=='Ireland')
    {
      $bannerImg = 'style="background: url(/university/banner/Ireland.jpg) no-repeat;"';
      $bannerImgUrl = '/university/banner/Ireland.jpg';
    }
    else if($courseDetails->country=='USA' || $courseDetails->country=='Canada')
    {
      $bannerImg = 'style="background: url(/university/banner/US-and-Canada.jpg) no-repeat;"';
      $bannerImgUrl = '/university/banner/US-and-Canada.jpg';
    }
    else if(in_array($courseDetails->country, $europe_countries))
    {
      $bannerImg = 'style="background: url(/university/banner/All-Europe.jpg) no-repeat;"';
      $bannerImgUrl = '/university/banner/All-Europe.jpg';
    }
    else if($courseDetails->country=='UAE' || in_array($courseDetails->country, $middle_east_countries))
    {
      $bannerImg = 'style="background: url(/university/banner/UAE-and-Middle-East.jpg) no-repeat;"';
      $bannerImgUrl = '/university/banner/UAE-and-Middle-East.jpg';
    }
    else if($courseDetails->country=='Australia' || $courseDetails->country=='New Zealand')
    {
      $bannerImg = 'style="background: url(/university/banner/Australia-and-NZ.jpg) no-repeat;"';
      $bannerImgUrl = '/university/banner/Australia-and-NZ.jpg';
    }
    else
    {
      $bannerImg = 'style="background: url(/university/banner/Singapore-and-Malaysia,-and-all-other.jpg) no-repeat;"';
      $bannerImgUrl = '/university/banner/Singapore-and-Malaysia,-and-all-other.jpg';
    }
    ?>
    <section class="desktop-mainsection course-detail-container" >

      <div class="searchpartner-banner-bg bg-cover" <? echo $bannerImg; ?>>

        <div class="bg-color"></div>

      </div>

      <div class="bg-color Partner-banner position-relative ">
        <div class="bottom-bg" ></div>
        <div class="container position-relative">

          <div class="top-bg"></div>
          <?php  if(empty($courseDetails)) {
            ?>
             <h4 class="text-center col-sm-12">No data found</h4>
            <?php
          }else{ ?>

          <div id="datacollect">
                  <div class="partner-form-fields ">
                  <div class="row">
                  <div class="col-sm-7">
                  <h2 class="main-heading">
                  <span class=""><?php echo  $courseDetails->prog_name_bv ?></span>
                    <a class="float-right heart-icon" style="display:none">
                    <img src="<?php echo bloginfo('template_url') ?>/images/search-fav-unfill.png">
                    </a>

                    </h2>
                    <div class="col-sm-12 border-bottom university_fields px-0 pt-4 p-b-40">
                    <div class="row">
                    <div class="col-sm-6 pr-0">
                    <h3 class="flag-btn-new">
                    <?php if($countryFlag){
                      ?>
                    <img style="width: 20px;height: 15px;" src="<?php echo plugins_url('searchtool')."/flags/".$countryFlag ?>" alt="flag" class="float-left m-b-20">
                    <?php
                    }?>
                    <div class="float-left pl-3">
                      <div class="w-100 univ-head"><?php echo  $courseDetails->university?> </div>
                    <span> <?php echo $courseDetails->prog_campus_bv ? $courseDetails->prog_campus_bv .',':$courseDetails->prog_campus_bv?></span>
                        <span class="name"><?php echo $courseDetails->country ?> </span>
                        <div>
                        <a class="about-the-university w-100"  >About the university</a>
                  </div>
                    </div>
                    </h3>
                    </div>

                    <div class="col-sm-6 pr-0" style="display:block">
                    <?php if($courseDetails->qs_world_ranking && $courseDetails->qs_world_ranking != "0" && $courseDetails->qs_world_ranking != "-"){

                        $str_explode=explode("-",$courseDetails->qs_world_ranking);

                        if ($str_explode[0] && $str_explode[1]) {
                            $qsRank = $str_explode[0].'+';
                        }
                        else{
                           $qsRank = $courseDetails->qs_world_ranking;
                        }

                      ?>
                        <div class="d-flex align-items-center">
                        <span class="tag-count mt-0 w-50">
                        <!-- <img src="<?php echo bloginfo('template_url') ?>/images/rank-tag.png" alt="tag"> -->
                        <span class="value"><?php echo $qsRank; ?></span>
                        </span>
                        <span class="tag-count-value ml-3">Global university ranking</span>
                      </div>
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
                        <div class="redstar mt-4 pt-2 d-flex align-items-center">
                          <span class="tag-count redbg mt-0 w-60">
                          <!-- <img src="<?php echo bloginfo('template_url') ?>/images/rank-tagred.png" alt="tag"> -->
                          <span class="value"><?php echo $graduateRank;?></span>
                          </span>
                          <span class="tag-count-value ml-3">Graduate Employability Ranking</span>
                        </div>
                      <?php } ?>

                  </div>

                  </div>
                  </div>
                  <div class="col-sm-12 summary_history pl-0">
                    <h4 class="m-t-30">Summary</h4>
                  <p class="bold-text"><?php echo $courseDetails->prog_description_bv.$courseDetails->prog_curriculum_bv ?></p>
                    </div>
                      <div class="Top-Courses m-b-30">
                      <h4>Entry requirements</h4>
                      <h3 class="m-t-30">English Language Requirements </h3>
                      <ul class="course-list">
                      <?php if($courseDetails->er_ielts_bv) {?>
                        <li>
                        <img src="<?php echo bloginfo('template_url') ?>/images/check24.png"  alt="life" class="pr-2">

                        <span class="bold-text"><?php echo $courseDetails->er_ielts_bv ? 'IELTS : ':'   ' ?> </span><span><?php echo $courseDetails->er_ielts_bv ?> Overall</span>
                        </li>
                      <?php } ?>
                        <?php if($courseDetails->er_toefl_bv) {?>
                        <li>
                        <img src="<?php echo bloginfo('template_url') ?>/images/check24.png"  alt="life" class="pr-2">

                        <span class="bold-text"><?php echo $courseDetails->er_toefl_bv ? 'TOFEL : ':'   ' ?> </span><span><?php echo $courseDetails->er_toefl_bv ?> Overall</span>
                        </li>
                      <?php } ?>
                        <?php if($courseDetails->er_pte_bv) {?>
                        <li>
                        <img src="<?php echo bloginfo('template_url') ?>/images/check24.png"  alt="life" class="pr-2">

                        <span class="bold-text"><?php echo $courseDetails->er_pte_bv ? 'PTE : ':'   ' ?> </span><span><?php echo $courseDetails->er_pte_bv ?> Overall</span>
                        </li>
                      <?php } ?>


                  </ul>
                  </div>
                  <div class="Student-life position-relative">
                    <div class="position-relative">
                      <div class="searchpartner-startjourney top-0 bottom-0">
                        <h3>Do you want to learn more about this course?</h3>
                        <h4>Register to our Student Portal <br>and start your Global Ed journey now!</h4>
                        <div class="check-eligible">
                          <button type="button" data-toggle="modal" data-target="#start_journey_form" class="btn btn-danger journey_formClear" data-keyboard="false" data-backdrop="static" >start your journey<div class="bg-icons bg-right_whitearrow"></div></button>
                        </div>
                      </div>
                    <h4 class="m-b-30">Facilities</h4>
                    <h5 class="m-b-30">Student will have access to</h5>
                    <div class="col-sm-12 pl-0">
                    <div class="row">
                    <div class="Student-life-blog col-sm-4">
                    <img src="<?php echo bloginfo('template_url') ?>/images/financial-lab.png"  alt="life" />
                    <p>Our state-of-the-art Financial Markets Lab</p>
                      </div>
                      <div class="Student-life-blog col-sm-4">
                      <img src="<?php echo bloginfo('template_url') ?>/images/financial-software.png"  alt="life" />
                    <p>Bloombergfinancial software</p>
                      </div>
                      <div class="Student-life-blog col-sm-4">
                      <img src="<?php echo bloginfo('template_url') ?>/images/data-stream-financial.png"  alt="life" />
                    <p>Data streamfinancial software</p>
                      </div>
                      <div class="Student-life-blog col-sm-4">
                      <img src="<?php echo bloginfo('template_url') ?>/images/financial-data.png"  alt="life" />
                      <p>Real-time financial data from markets worldwide  </p>
                      </div>
                      <div class="Student-life-blog col-sm-4">
                      <img src="<?php echo bloginfo('template_url') ?>/images/training-software.png"  alt="life" />

                      <p>Training on financial software as part of your course orextra-curricular sessions</p>
                      </div>
                      <div class="Student-life-blog col-sm-4">
                      <img src="<?php echo bloginfo('template_url') ?>/images/account-software.png"  alt="life" />'
                    <p>Sage accounting software, with training and opportunity to gain a CIMA certificate</p>
                      </div>
                    </div>
                    </div>
                    </div>

                    <div class="col-sm-12 m-t-30 m-b-30 p-0">
                    <h4 class="m-b-30">About <?php echo $courseDetails->university ?> </h4>
                    <div class="bitma-new">
                    <img src="<?php echo $bannerImgUrl; ?>" width="540"  alt="life">
                    </div>
                    <p class="m-t-30 light-font">
                    </p>
                    <div class="check-eligible m-t-30">
                      <div class="row">
                      <div class="col-sm-6">
                      <a >
                    <button type="button" class="btn btn-block btn-danger">more about the university</button>
                    </a>
                      </div>
                      <div class="col-sm-6">
                      <a href ="/search-tool?university=<?php echo trim($courseDetails->university);?>">
                <button type="button" class="btn btn-block btn-outline-danger">see all courses</button>
                    </a>
                    </div>
                    </div>
                    </div>
                      </div>
                      </div>
                        </div>
                    <div class="col-sm-5">
                      <div class="right-section-pad">
            <?php if($courseDetails && $courseDetails->logo!=""){                      ?>
                      <div class="univ_logo">
                      <img src="/university/logo/<?php echo $courseDetails->logo; ?>" width="250"  alt="life" class="m-b-20">
                      </div>
          <?php } ?>
                    <div class="check-eligible m-t-30">
                      <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#checkeligible">Check your eligibility</button>
                      <button type="button" class="btn btn-block btn-outline-danger expressbtn" data-toggle="modal" data-target="#expressModal">express your interest</button>
                    </div>
                      <div class="quick-fact col-sm-12 px-0 p-b-20 border-bottom">
                      <h4 class="m-t-30 m-b-30">Quick facts</h4>
                      <?php // if($courseDetails->prog_campus || $courseDetails->prog_duration_value) { ?>
                      <div class="col-sm-12 p-0 m-b-30">
                      <div class="row">
                        <?php if($courseDetails->prog_campus_bv) { ?>
                          <div class="col-sm-6 pr-0 pb-3">
                            <div class="bg-24 bg-check24 mr-3 float-left"></div>
                            <div class="textcontent-right-life">
                              <p>Campus </p>
                              <p>
                                <span><?php echo $courseDetails->prog_campus_bv ?> </span>
                              </p>
                            </div>
                          </div>
                        <?php } ?>
                        <?php if($courseDetails->prog_duration_value_bv) {

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
                        <div class="col-sm-6 pr-0 pb-3">
                        <div class="bg-24 bg-check24 mr-3 float-left"></div>
                        <div class="textcontent-right-life">
                          <p>Duration</p>
                          <p>
                            <span><?php echo $courseDetails->prog_duration_value_bv .' '. $durationType ?></span>
                          </p>
                          </div>
                        </div>
                        <?php } ?>
                         <?php if($courseDetails->prog_start_date_bv) { ?>
                      <div class="col-sm-6 pr-0 pb-3">
                        <div class="bg-24 bg-check24 mr-3 float-left"></div>
                        <div class="textcontent-right-life">
                          <p>Start date </p>
                          <p>
                          <span><?php echo $courseDetails->prog_start_date_bv ?> </span>
                          </p>
                        </div>
                      </div>
                      <?php  } ?>
                       <?php if($courseDetails->prog_mode_bv) { ?>
                      <div class="col-sm-6 pr-0 pb-3">
                        <div class="bg-24 bg-check24 mr-3 float-left"></div>
                        <div class="textcontent-right-life">
                          <p>Attendance</p>
                          <p>
                          <span><?php echo $courseDetails->prog_mode_bv ?> </span>
                          </p>
                        </div>
                      </div>
                      <?php }  ?>

                      <?php if($courseDetails->prog_fees_value_usd) { ?>
                          <div class="col-sm-6 pr-0 pb-3">
                            <div class="bg-24 bg-check24 mr-3 float-left"></div>
                            <div class="textcontent-right-life">
                                <p>Avg Tuition/Year </p>
                                <p>
                                  <span> USD <?php echo round($courseDetails->prog_fees_value_usd) ?> </span>
                                </p>
                            </div>
                        </div>
                      <?php }

                      elseif($courseDetails->prog_fees_value_bv && (!$courseDetails->prog_fees_value_usd)) { ?>
                          <div class="col-sm-6 pr-0 pb-3">
                            <div class="bg-24 bg-check24 mr-3 float-left"></div>
                            <div class="textcontent-right-life">
                                <p>Avg Tuition/Year </p>
                                <p>
                                  <span><?php echo $courseDetails->prog_fees_currency .' '.round($courseDetails->prog_fees_value) ?> </span>
                                </p>
                            </div>
                        </div>
                      <?php }  ?>



                         <?php if($courseDetails->appl_close_date_bv){ ?>
                        <div class="col-sm-6 pr-0 pb-3">
                          <div class="bg-24 bg-check24 mr-3 float-left"></div>
                          <div class="textcontent-right-life">
                            <p>Application Deadline </p>
                            <p>
                              <span><?php echo $courseDetails->appl_close_date_bv ?></span>
                             </p>
                          </div>
                        </div>
                      <?php } ?>
                        <?php if($courseDetails->appl_process_time){ ?>
                         <div class="col-sm-6 pr-0 pb-3">
                          <div class="bg-24 bg-check24 mr-3 float-left"></div>
                          <div class="textcontent-right-life">
                            <p>Avg. Application Processing Time </p>
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
                            <div class="col-sm-6 pr-0">
                              <div class="bg-24 bg-check24 mr-3 float-left"></div>
                              <div class="textcontent-right-life">
                                  <p>Internship </p>
                                  <p>
                                   <span><?php echo $internshipVal; ?></span>
                                  </p>
                               </div>
                            </div>
                        <?php } ?>
                         <?php // if($courseDetails){ ?>
                          <div class="col-sm-6 pr-0" style="display:none">
                            <div class="bg-24 bg-check24 mr-3 float-left"></div>
                            <div class="textcontent-right-life">
                              <p>Qualification  </p>
                              <p>
                              <span></span>
                              </p>
                            </div>
                          </div>
                          <?php // } ?>
                          <?php if($courseDetails->scholarship){ ?>
                            <div class="col-sm-6 pr-0" >
                              <div class="bg-24 bg-check24 mr-3 float-left"></div>
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

                        <!-- Most popular courses -->
                          <div class="Most-popular-courses" style="display:none">
                    <h4 class="m-t-30 m-b-30">Most popular courses</h4>
                          <h6 class="text-center no-record-theme">No Records Found</h6>

                          </div>
                        <div class="check-eligible m-t-30">
                      <a href="/search-tool">
                      <button type="button" class="btn btn-block btn-danger">browse courses</button>
                    </a>
                    </div>
                      </div>
                      </div>
                    <div class="col-sm-12">
                    <a href="/search-tool" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to courses
                    <div class="bg-icons bg-down_2"></div>
                  </a>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>

                </div>
                </div>
      </div>
          <?php }?>

      <!--POPULAR-COURSE-->
        <div class="popular-course pt-0" style="display:none">
        <div class="text-center">
          <div class="boldheading">
            Courses You May Like
          </div>
          <div class="path"></div>
        </div>

      <div class="container">
        <div class="col-sm-12 p-0">

        <?php
          if($coursesmayList && count($coursesmayList)>0){
           ?>
          <?php
          } else{
            ?>
            <h4 class="no-record-theme">No Records Found </h4>
            <?php
          }?>
          </div>
         </div>

        </div>
      <!--POPULAR-COURSE-->
      <?php
      /**  Get Shortcode content from editor  **/

        while ( have_posts() ) : the_post();
        the_content(); // get post content
        endwhile;
    ?>
      <!-- end form bottom section -->
    </section>

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
  //console.log('pathName',pathName)
  if (pathName === '/coursedetails/' || pathName === '/coursedetails') {
        $('html, body').animate({
            scrollTop: $(".course-detail-container").offset().top
        }, 1000);
  }
  $('.mutlidropdown').select2();

});
</script>















<?php get_footer(); ?>
