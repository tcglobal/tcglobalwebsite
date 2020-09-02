<?php
/* Template Name: Apply Job  */

//get_header();

?>

<style>
#menu-item-308 a {color: #da1f3d;}
</style>

<?php

if (isset($_POST['submit'])) {

   $succ_msg = '';

    $parent_id = $_POST['job_id'];
    $fname = $_POST['user_first_name'];
    $lname = $_POST['user_last_name'];
    $email = $_POST['user_email'];
    $phone = $_POST['user_phone'];

    $user_loc = $_POST['job_apply_location'];
    $user_experience = $_POST['job_apply_experience'];
    $ug_course_name = $_POST['job_apply_course'];
    $ug_course_spec = $_POST['job_apply_course_spec'];

    $pg_course_name = $_POST['job_pg_course'];
    $pg_course_spec = $_POST['job_pg_course_spec'];
    $cur_cmp_name = $_POST['current_company'];
    $user_designation = $_POST['designation'];
    $user_CTC = $_POST['expected_ctc'];
    $currency_code = $_POST['ctc_currency_code'];

    $args = array(
            'post_type'    => 'jobpost_applicants',
            'post_content' => '',
            'post_parent'  => intval( $parent_id ),
            'post_title'   => trim( esc_html( strip_tags( get_the_title( $parent_id ) ) ) ),
            'post_status'  => 'publish',
        );

    $pid = wp_insert_post($args);

    // WP Upload Directory
    $upload_dir = wp_upload_dir();

    //print_r($_FILES);
    $uploadfile_name = $_FILES['resume']['name'];
    $filetmp = $_FILES['resume']['tmp_name'];


    /** cover letter **/
    $upload_letter_name = $_FILES['cover_letter']['name']; // cover letter name
    $letter_tmpname = $_FILES['cover_letter']['tmp_name']; // cover letter tem name



    $filetype = wp_check_filetype(basename($uploadfile_name), NULL);

    $time = (!empty($_SERVER['REQUEST_TIME'])) ? $_SERVER['REQUEST_TIME'] : (time() + (get_option('gmt_offset') * 3600)); // Fallback of now

    $post_type = 'jobpost';

    // Getting Current Date
    $date = explode(" ", date('Y m d H i s', $time));
    $timestamp = strtotime(date('Y m d H i s'));

    if ($post_type) {
        $upload_dir = array(
            'path'   => $upload_dir['basedir'] . '/' . $post_type . '/' . $date[0],
            'url'    => $upload_dir['baseurl'] . '/' . $post_type . '/' . $date[0],
            'subdir' => '',
            'error'  => FALSE,
        );
    }

      // Make Upload Directory
      if (!is_dir($upload_dir['path'])) {
          wp_mkdir_p($upload_dir['path']);
      }

      $resume_name = $pid . '_' . sanitize_file_name($uploadfile_name);
      $upload_baseurl =  $upload_dir['url'];
      $upload_basedir = $upload_dir['path'];

      $resume_url = $upload_baseurl . '/' . $resume_name;
      $resume_path = $upload_basedir . '/' . $resume_name;
      $filedest = $upload_basedir . '/' . $resume_name; // resume destination path


      $cover_letter_url = $upload_baseurl . '/' . $upload_letter_name;
      $cover_letter_path = $upload_basedir . '/' . $upload_letter_name;
      $letterdest = $upload_basedir . '/' . $upload_letter_name; // cover letter destination path

      /*if(isset($_FILES))
      {
          if (!@move_uploaded_file($filetmp, $filedest))
          {
            $succ_msg = "Error, the file '".$filetmp."' could not moved to : '".$filedest."'";
          }
          if ($upload_letter_name)
          {
            move_uploaded_file($letter_tmpname, $letterdest);
          }
      }*/

      if($uploadfile_name)
      {

        if (!@move_uploaded_file($filetmp, $filedest))
          {
            $succ_msg = "Error, the file '".$filetmp."' could not moved to : '".$filedest."'";
          }

      }

      if ($upload_letter_name)
      {
        move_uploaded_file($letter_tmpname, $letterdest);
      }

      /* Replace single backslash with double for DB Storage */
       $resume_path = str_replace("\\", "\\\\", $resume_path);

        add_post_meta( $pid, 'sjb_jobapp_status', 'new' );
        add_post_meta( $pid, 'jobapp_your_first_name', $fname );
        add_post_meta( $pid, 'jobapp_your_last_name', $lname );
        add_post_meta( $pid, 'jobapp_your_email', $email );
        add_post_meta( $pid, 'jobapp_your_mobile_number', $phone );
        add_post_meta( $pid, 'jobapp_user_location', $user_loc );
        add_post_meta( $pid, 'jobapp_user_experience', $user_experience );

        add_post_meta( $pid, 'resume', $resume_url );
        add_post_meta( $pid, 'resume_path', $resume_path);

        add_post_meta( $pid, 'jobapp_ug_course_name', $ug_course_name );
        add_post_meta( $pid, 'jobapp_ug_course_spec', $ug_course_spec );
        add_post_meta( $pid, 'jobapp_pg_course_name', $pg_course_name );
        add_post_meta( $pid, 'jobapp_pg_course_spec', $pg_course_spec );
        add_post_meta( $pid, 'jobapp_current_company', $cur_cmp_name );
        add_post_meta( $pid, 'jobapp_user_designation', $user_designation );
        add_post_meta( $pid, 'jobapp_expected_ctc', $user_CTC );
        add_post_meta( $pid, 'jobapp_currency_code', $currency_code );

        $uploadpath = $post_type . '/' . $date[0] . '/' .$resume_name; // resume path

        $uploadletter_path = $post_type . '/' . $date[0] . '/' .$upload_letter_name; // cover letter path
        //$attachments = array(WP_CONTENT_DIR . '/uploads/'.$uploadpath);
        //$attachments = array(WP_CONTENT_DIR . '/uploads/'.$uploadletter_path);

        $attachments = array();

        array_push($attachments, WP_CONTENT_DIR . '/uploads/'.$uploadpath );
        array_push($attachments, WP_CONTENT_DIR . '/uploads/'.$uploadletter_path );

        $to = ( FALSE !== get_option( 'settings_admin_email' ) ) ? get_option( 'settings_admin_email' ) : get_option( 'admin_email' );//get_option('admin_email'); //admin mail id
        //$to = 'meena.p@optisolbusiness.com';
        $headers    = 'From: '.$email . "\r\n";
        $headers   .= "MIME-Version: 1.0\r\n";
        $headers   .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject    = "Tc Global- Job Application details";

        $msg  = "<p style='margin-left:20px;'>Dear admin,</p>";
        $msg .= "<p style='margin-left:20px;'>Kindly find the applicant details below.</p>";
        $msg .= "<p style='margin-left:20px;'>Name : $fname $lname</p>";
        $msg .= "<p style='margin-left:20px;'>Email : $email</p>";
        $msg .= "<p style='margin-left:20px;'>Phone No : $phone</p>";
        $msg .= "<p style='margin-left:20px;'>Location : $user_loc</p>";
        $msg .= "<p style='margin-left:20px;'>Experience : $user_experience</p>";

        if($ug_course_name){
          $msg .= "<p style='margin-left:20px;'>UG Course Name : $ug_course_name</p>";
        }
        if($ug_course_spec){
          $msg .= "<p style='margin-left:20px;'>UG Course Specification : $ug_course_spec</p>";
        }
        if($pg_course_name){
          $msg .= "<p style='margin-left:20px;'>PG Course Name : $pg_course_name</p>";
        }
        if($pg_course_spec){
          $msg .= "<p style='margin-left:20px;'>PG Course Specification : $pg_course_spec</p>";
        }
        if($cur_cmp_name){
          $msg .= "<p style='margin-left:20px;'>Current Company : $cur_cmp_name</p>";
        }
        if($user_designation){
          $msg .= "<p style='margin-left:20px;'>Designation : $user_designation</p>";
        }
        if($user_CTC){
          $msg .= "<p style='margin-left:20px;'>Expected CTC : $user_CTC </p>";
        }
        if($currency_code){
          $msg .= "<p style='margin-left:20px;'>Currency Code : $currency_code </p>";
        }

         $redir_url =  get_site_url().'/thank-you';


        wp_mail( $to, $subject, $msg, $headers, $attachments ); /* admin mail content */
        $_POST = array(); // lets pretend nothing was posted
        wp_redirect($redir_url);

  exit;

  }

?>



<?php
get_header();

global $post, $wpdb;

$jobPostID = $_GET['id'];

$job_category = get_the_terms( $jobPostID, 'jobpost_category' );
 $job_location = get_the_terms( $jobPostID, 'jobpost_location' );
 $parent_catid = $job_location[0]->parent;
 $country = get_term_by('id', $parent_catid, 'jobpost_location');
 $experience = get_post_meta( $jobPostID, 'work_experience', true );

  $url = get_permalink($jobPostID);
  $title = get_the_title($jobPostID);
  $fb = "http://www.facebook.com/share.php?u=".$url."&title=".$title."";
  $linkedin = "http://www.linkedin.com/shareArticle?mini=true&url=".$url."&title=".$title."";
  $twitter = "http://twitter.com/home?status=".$title."+".$url."";

  $exp_year = 10;
  $jobexperience .='';

  for($i=1; $i<=$exp_year; $i++){

    $jobexperience .='<li id="'.$i.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$i.'</a></li>';
  }

?>

<div class="searchpartner-banner-bg careers-banner">
  <div class="container position-relative event-head">
    <div class="row align-items-center">
    </div></div>
</div>

<div class="event-content">
    <div class="bg-color Partner-banner position-relative">
      <div class="bottom-bg"></div>
      <div class="container position-relative">
        <div class="top-bg"></div>
        <div class="partner-form-fields events-page-detail p-b-60">
          <div class="row">
            <div class="col-sm-8 ">
              <?php if($succ_msg) { ?>
                      <span class="job_send"><?php echo trim($succ_msg); ?></span>
                  <?php } ?>
              <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $job_category[0]->name; ?></span></div>
              <h2 class="main-heading text-left">
               <?php echo get_the_title($jobPostID); ?>
                </h2>
                <div class="col-sm-10 m-t-70">
                  <div class="row">
                   <h5 class="carrer-medium-head fs-20 m-b-30">Apply to a job</h5>
                   <div class="theme-bor-btm mb-0 mt-0"></div>
                 </div>
                  <div class="row">
          <div class="event-form pt-5 w-100">
            <form name="apply_career_form"  id="apply_career_form" method="POST" action="" enctype="multipart/form-data">
                        <div class="col-md-12 p-0">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="group">
                                <input type="text" name="user_first_name" id="user_first_name" class="w-100 form-control">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your first name</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="group">
                                <input type="text" name="user_last_name" id="user_last_name" class="w-100 form-control">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your last name</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 p-0">
                          <div class="row">
                            <div class="col-md-6 p-t-20">
                              <div class="group">
                                <input type="email" name="user_email" id="user_email" class="w-100 form-control">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your e-mail</label>
                              </div>
                            </div>

                            <div class="col-md-6 eventdetail-typenumber">
                              <label>Your mobile number</label>
                              <div class="row">

                                <div class="col-md-12">
                                  <!--<span class="serial-no">+91</span>-->
                                  <input type="tel" name="user_phone" id="phone" class="form-control careers-form-border">
                                </div>
                              </div>
                            </div>


                          </div>
                        </div>
                        <div class="col-md-12 p-0 m-b-20">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Your location</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle job-loc" type="button"><span>Select</span></button>
                                <div class="dropdown-menu job-loc-show">
                                  <ul id="sel-job-loc">
                                    <li id="Delhi"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                    <li id="Chennai"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Chennai</a></li>
                                    <li id="Covai"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Covai</a></li>
                                  </ul>
                                </div>
                                <input type="hidden" name="job_apply_location" id="job_apply_location" value="" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Your experience</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle job-exp" type="button"><span>select</span></button>
                                <div class="dropdown-menu job-exp-show">
                                  <ul id="sel-job-exp">
                                    <?php echo $jobexperience; ?>
                                  </ul>
                                </div>
                                <input type="hidden" name="job_apply_experience" id="job_apply_experience" value="" />
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="theme-bor-btm m-b-40 m-t-40"></div>
                        <h5 class="carrer-medium-head fs-20 m-b-30">Tell us about your experience</h5>

                       <div class="col-12 p-0 mb-4">
                        <div class="row list-detail">
                            <div class="col-1 pr-0">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/workspace24.png" alt="">
                            </div>
                            <div class="col-4 p-0">
                              <label class="uplink">
                                upload your resume<input type="file" name="resume" id="upload_resume" />
                              </label>
                              <div id="sel_resume_name"></div>
                              <div class="link-text">
                                Supported: doc,docx,pdf,rtf<br/> Max file size: 3 MB
                              </div>
                            </div>
                              <div class="col-7 p-0">
                                <div class="customcheckbox check_blackbox termslink">
                               <input type="checkbox" id="htmlcheck">
                                <label for="htmlcheck"><span>Choose if you don’t have resume </span></label></div>
                            </div>
                           </div>
                        </div>
                      <div class="show-resume-form">
                       <div class="col-md-12 p-0 m-b-20">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Choose UG Course</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                              <button class="btn btn-secondary dropdown-toggle job-course" type="button"><span>select</span></button>
                                <div class="dropdown-menu job-course-show">
                                  <ul id="sel-job-course">
                                    <li id="B.A"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">B.A</a></li>
                                    <li id="BCA"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">BCA</a></li>
                                    <li id="B.Com"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">B.Com</a></li>
                                  </ul>
                                </div>
                                <input type="hidden" name="job_apply_course" id="job_apply_course" value="" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Choose UG Spec.</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle job-course-spec" type="button"><span>select</span></button>
                                <div class="dropdown-menu job-course-spec-show">
                                  <ul id="sel-course-spec">
                                    <li id="Communication"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Communication</a></li>
                                    <li id="Computer science"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Computer science</a></li>
                                    <li id="Accounts"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Accounts</a></li>
                                  </ul>
                                </div>
                                <input type="hidden" name="job_apply_course_spec" id="job_apply_course_spec" value="" />
                              </div>
                            </div>

                          </div>
                        </div>
                           <div class="col-md-12 p-0 m-b-20">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Choose PG Course</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle pg-course" type="button"><span>select</span></button>
                                <div class="dropdown-menu pg-course-show">
                                  <ul id="sel-pg-course">
                                    <li id="CA"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">CA</a></li>
                                    <li id="MCA"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">MCA</a></li>
                                    <li id="M.Com"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">M.Com</a></li>
                                  </ul>
                                </div>
                                <input type="hidden" name="job_pg_course" id="job_pg_course" value="" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Choose PG Spec.</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle pg-course-spec" type="button"><span>select</span></button>
                                <div class="dropdown-menu pg-course-spec-show">
                                  <ul id="sel-pg-spec">
                                    <li id="Pursuing"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Pursuing</a></li>
                                    <li id="Accounts"><a><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Accounts</a></li>
                                  </ul>
                                  <input type="hidden" name="job_pg_course_spec" id="job_pg_course_spec" value="" />
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                         <div class="col-md-12 p-0 m-b-20">
                          <div class="row">

                           <div class="col-md-6 p-t-20">
                              <div class="group">
                                <input type="text" name="current_company" id="current_company" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your current company</label>
                              </div>
                            </div>
                            <div class="col-md-6 p-t-20">
                              <div class="group">
                                <input type="text" name="designation" id="designation" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your current designation</label>
                              </div>
                            </div>

                          </div>
                        </div>
                         <div class="col-md-12 p-0 m-b-20">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="group">
                                <input type="text" name="expected_ctc" id="expected_ctc" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Type in preffered CTC</label>
                              </div>
                            </div>

                            <div class="col-md-6 eventdetail-typenumber pt-2 mt-1">
                              <div class="row">
                                <div class="col-md-6 map-form">
                                  <div class="dropdown select-theme filter-dropdown select-box pl-0 careers-form-border">
                                    <button class="btn btn-secondary dropdown-toggle currency_code" type="button" id="country_flag"><img src=""><span>select</span>
                                    </button>
                                    <div class="dropdown-menu currency_code_show">
                                      <ul id="sel_currency_code">
                                        <li id="INR"><a><img src="<?php echo get_template_directory_uri(); ?>/images/india.png"> INR</a></li>
                                        <li id="AUD"><a><img src="<?php echo get_template_directory_uri(); ?>/images/australia.png"> AUD</a></li>
                                        <li id="US dollars"><a><img src="<?php echo get_template_directory_uri(); ?>/images/usa.png">US dollars</a></li>
                                      </ul>
                                    </div>
                                     <input type="hidden" name="ctc_currency_code" id="ctc_currency_code" value="" />
                                  </div>
                                </div>

                              </div>
                            </div>

                          </div>
                        </div>


                    </div>
                    <div class="theme-bor-btm m-b-40 mt-4"></div>

                  <h5 class="carrer-medium-head fs-20 mb-3">…and why would you like to work with us? </h5>
                  <div class="col-12 p-0 mb-5">
                  <div class="row list-detail">
                      <div class="col-1 pr-0">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/learn.png" alt="">
                      </div>
                      <div class="col-8 p-0">
                        <label class="uplink">
                          upload your cover letter<input type="file" name="cover_letter" id="upload_letter" />
                        </label>
                      </div>
                      <div id="sel_letter_name"></div>
                  </div>
                  </div>
                 <div class="termslink m-b-40 m-t-40">
                    <div class="customcheckbox check_blackbox termslink">
                      <input type="checkbox" name="terms" id="html">
                      <label for="html"><span>Accept Tc Global's <a href="">Terms&amp;Conditions</a> and <a href="">Privacy Policy</a></span></label>
                    </div>
                  </div>
                  <div class="col-sm-5 p-0">
                    <input type="submit" name="submit" id="submit" value="submit & apply" class="btn btn-theme w-100">
                  </div>

                  <input type="hidden" name="job_id" value="<?php echo $jobPostID; ?>">

                </form>
              </div>
          </div>
        </div>
      </div>
            <div class="col-sm-4 ">
              <div class="right-section-pad pl-4">
                <div class="carrer-right-box">

                  <div class="row list-detail">
                    <div class="col-2 pr-0">
                      <img src="<?php echo get_template_directory_uri(); ?>/images/map.png" alt="">
                    </div>
                    <div class="col-10 pl-2">
                      <p class="fs-14"><span><?php echo $job_location[0]->name; ?>, </span><?php echo $country->name; ?></p>
                    </div>
                  </div>
                  <?php if($experience) { ?>
                   <div class="row list-detail">
                      <div class="col-2 pr-0">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/workspaceicon.png" alt="">
                      </div>
                      <div class="col-10 pl-2">
                        <p class="fs-14"><span><?php echo $experience; ?></span>  years of experience </p>
                      </div>
                    </div>
                  <?php } ?>
              <div class="theme-bor-btm m-b-30 m-t-10"></div>
                <div class="share-event col-sm-12 pl-0 p-b-20 ">
                  <h4 class="m-t-30 m-b-20">Share the job offer</h4>
                  <ul class="footerul">
                     <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                <li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
                  </ul>
                </div>
              </div>
              </div>
            </div>
            <div class="col-sm-12 m-t-30">
              <a href="<?php echo $url; ?>" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to job offers<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php echo do_shortcode('[related_jobs title="Related positions"]'); ?>

<?php get_footer(); ?>
