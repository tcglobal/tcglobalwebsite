<?php
/* Template Name: Apply Job  */

get_header();

?>

<?php
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

?>

<div class="searchtool-banner careers-banner">
</div>
<div class="bg-color Partner-banner position-relative ">
      <div class="bottom-bg"></div>
      <div class="container-fluid position-relative p-0">
        <div class="search-form-fields event-detail-fields  insights-details-page">
          <div class="bg-color"></div>
          <div class="row">
            <div class="col-sm-12 event-left-banner">
              <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $job_category[0]->name; ?></span></div>
                <h2 class="main-heading text-left">
                   <?php echo get_the_title($jobPostID); ?>
                    </h2>
                  <div class="col-sm-12 carrer-right-box ">
                      <div class="row">
                        <div class="col-sm-12 pl-0 pt-2 pb-4">
                          <span class="event-small-head mb-2">Date added:</span>
                          <span class="event-small-head-value"><?php echo get_the_date('d.m.Y', $jobPostID); ?></span>
                        </div>

                         <div class="col-sm-4 ">
                          <div class="row list-detail">
                            <div class="col-2 pl-0 pr-0">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/map.png" alt="">
                            </div>
                            <div class="col-10 pl-0">
                              <p class="fs-14"><span><?php echo $job_location[0]->name; ?>, </span><?php echo $country->name; ?> </p>
                            </div>
                          </div>
                        </div>
                        <?php if($experience) { ?>
                        <div class="col-sm-8 ">
                           <div class="row list-detail">
                            <div class="col-1 pl-0 pr-2">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/workspaceicon.png" alt="">
                            </div>
                            <div class="col-10 pl-0">
                              <p class="fs-14"><span><?php echo $experience; ?></span>  years of experience </p>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                     <div class="col-sm-12 tablet-formblock tablet-contactblock m-t-30">
                      <div class="">
                       <h5 class="carrer-medium-head fs-20 m-b-30">Apply to a job</h5>
                       <div class="theme-bor-btm mb-0 mt-0"></div>
                     </div>
                      <div class="">

                        <div class="event-form pt-5 w-100">

                      <form>
                        <div class="col-md-12 p-0">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="group">
                                <input type="text" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your first name</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="group">
                                <input type="text" class="w-100">
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
                                <input type="text" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your e-mail</label>
                              </div>
                            </div>
                            <div class="col-md-6 eventdetail-typenumber">
                              <label class="m-b-5">Your mobile number</label>
                              <div class="row">
                                <div class="col-md-4 map-form">
                                  <div class="dropdown select-theme filter-dropdown careers-form-border select-box pl-0">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"><img src="<?php echo get_template_directory_uri(); ?>/images/india.png"> IN
                                    </button>
                                    <div class="dropdown-menu d-none">
                                      <ul>
                                        <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/india.png"> IN</a></li>
                                        <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/australia.png"> AUS</a></li>
                                        <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/usa.png"> USA</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <span class="serial-no">+91</span>
                                  <input type="text" class="form-control careers-form-border">
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
                                <button class="btn btn-secondary dropdown-toggle" type="button">Delhi</button>
                                <div class="dropdown-menu d-none">
                                  <ul>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                    <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Your experience</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle" type="button">5</button>
                                <div class="dropdown-menu d-none">
                                  <ul>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">5</a></li>
                                    <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">3</a></li>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">2</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="theme-bor-btm m-b-30 m-t-40"></div>
                        <h5 class="carrer-medium-head fs-20 m-b-30">Tell us about your experience</h5>

                       <div class="col-12 p-0 mb-4">
                        <div class="row list-detail">
                          <div class="col-1 pr-0">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/workspace24.png" alt="">
                          </div>
                          <div class="col-4 p-0">
                            <label class="uplink">upload your resume
                            <input type="file" name="resume" accept=".doc,.docx,.pdf" /></label>
                            <div class="link-text">
                              Supported: doc,docx,pdf,rtf<br/>Max file size: 3 MB
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
                                <button class="btn btn-secondary dropdown-toggle" type="button">B.A.</button>
                                <div class="dropdown-menu d-none">
                                  <ul>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                    <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Choose UG Spec.</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle" type="button">Communication</button>
                                <div class="dropdown-menu d-none">
                                  <ul>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">5</a></li>
                                    <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">3</a></li>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">2</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                           <div class="col-md-12 p-0 m-b-20">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Choose PG Course</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle" type="button">CA</button>
                                <div class="dropdown-menu d-none">
                                  <ul>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                    <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">Delhi</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Choose PG Spec.</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle" type="button">Pursuing</button>
                                <div class="dropdown-menu d-none">
                                  <ul>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">5</a></li>
                                    <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">3</a></li>
                                    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/drop-tick.jpg" alt="">2</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                         <div class="col-md-12 p-0">
                          <div class="row">

                           <div class="col-md-6 p-t-20">
                              <div class="group mb-0">
                                <input type="text" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your current company</label>
                              </div>
                            </div>
                            <div class="col-md-6 p-t-20">
                              <div class="group">
                                <input type="text" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your current designation</label>
                              </div>
                            </div>

                          </div>
                        </div>
                         <div class="col-md-12 p-0 m-b-20">
                          <div class="row">
                            <div class="col-md-6 p-t-20">
                              <div class="group">
                                <input type="text" class="w-100">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Type in preffered CTC</label>
                              </div>
                            </div>

                            <div class="col-md-6 eventdetail-typenumber">
                              <label></label>
                              <div class="row">
                                <div class="col-md-6 map-form p-t-5">
                                  <div class="dropdown select-theme careers-form-border filter-dropdown select-box pl-0">
                                    <button class="btn btn-secondary dropdown-toggle pt-0" type="button"><img src="<?php echo get_template_directory_uri(); ?>/images/india.png"> US dollars
                                    </button>
                                    <div class="dropdown-menu d-none">
                                      <ul>
                                        <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/india.png"> IN</a></li>
                                        <li><a href="" class="active"><img src="<?php echo get_template_directory_uri(); ?>/images/australia.png"> AUS</a></li>
                                        <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/usa.png"> USA</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      <div class="theme-bor-btm m-b-40 mt-4"></div>
                     </div>

                      <h5 class="carrer-medium-head fs-20 mb-3">…and why would you like to work with us? </h5>

                       <div class="col-12 p-0 mb-4 mt-4">
                        <div class="row list-detail">
                          <div class="col-1 pr-0">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/learn.png" alt="">
                          </div>
                          <div class="col-8 p-0">
                            <label class="uplink">upload your cover letter
                            <input type="file" name="letter" accept=".doc,.docx,.pdf" /></label>
                          </div>
                        </div>
                      </div>

                        <div class="termslink m-b-40 m-t-40">
                          <div class="customcheckbox">
                            <input type="checkbox" id="html">
                            <label for="html"><span>Accept Tc Global's <a href="">Terms&amp;Conditions</a> and <a href="">Privacy Policy</a></span></label>
                          </div>
                        </div>
                        <div class="group col-sm-5 p-0 ">
                          <a href="" class="redbtn w-100 pt-0 d-flex align-items-center justify-content-center text-uppercase text-decoration-none">submit &amp; apply</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <div class="col-sm-12 p-0 m-t-60 ">
              <a href="<?php echo $url; ?>" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to job offers <span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<?php echo do_shortcode('[related_jobs title="Related positions"]'); ?>

<?php get_footer(); ?>
