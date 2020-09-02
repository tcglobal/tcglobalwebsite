<?php
/* Template Name: Event Register  */

get_header();

include($_SERVER['DOCUMENT_ROOT'].'/form/get_event_api.php');

?>

<style>
#menu-item-113 a {color: #da1f3d;}
</style>

<?php
global $post, $wpdb;

$eventPostID = $_GET['eventid'];

$img = wp_get_attachment_image_src( get_post_thumbnail_id($eventPostID), 'full' );
$event_addr = get_post_meta( $eventPostID, '_event_address', true );
$event_category = get_the_terms( $eventPostID, 'event_categories' );
$event_date = get_post_meta( $eventPostID, '_event_start_date', true );
$event_stime = get_post_meta( $eventPostID, '_event_start_time', true );

 	$url = get_permalink($eventPostID);
 	$title = get_the_title($eventPostID);
	$fb = "http://www.facebook.com/share.php?u=".$url."&title=".$title."";
	$linkedin = "http://www.linkedin.com/shareArticle?mini=true&url=".$url."&title=".$title."";
	$twitter = "http://twitter.com/home?status=".$title."+".$url."";

?>

<div class="searchpartner-banner-bg Events-banner">
      <div class="bg-color"></div>
      <div class="container position-relative event-head">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading">TC Global Events</h2>
          </div>
        </div></div>
  </div>


<div class="event-content">
        <div class="bg-color Partner-banner position-relative">
          <div class="bottom-bg"></div>
          <div class="container position-relative">
            <div class="top-bg"></div>
            <div class="partner-form-fields events-page-detail">
              <div class="row">
                <div class="col-sm-7 careers-jobapply">
                  <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $event_category[0]->name; ?></span></div>
                  <h2 class="main-heading text-left">
                    <span class=""><?php echo get_the_title($eventPostID); ?></span>
                    </h2>
                    <div class="col-sm-12 ">
                      <div class="row">
                        <div class="col-sm-6 pl-0 py-4">
                          <h6 class="event-small-head mb-2">Date</h6>
                          <h6 class="event-small-head-value" id="tcevent-date"><?php echo date("d.m.Y", strtotime($event_date)); ?></h6>
                        </div>
                        <div class="col-sm-6 py-4">
                          <h6 class="event-small-head mb-2">Location</h6>
                          <h6 class="event-small-head-value"><?php echo $event_addr; ?></h6>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-md-12 p-0">
                          <h4 class="event-register-head">Register to the event</h4>
                          <div class="m-t-20 event-form border-top pt-5">
                            <form name="event_register_form"  id="event_register_form" method="post" action="">
                              <div class="col-md-12 p-0">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="group">
                                      <input type="text" name="firstname" id="firstname" class="w-100 name-field" >
                                      <span class="highlight"></span>
                                      <span class="bar"></span>
                                      <label>Your first name</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="group">
                                      <input type="text" name="lastname" id="lastname" class="w-100 name-field" >
                                      <span class="highlight"></span>
                                      <span class="bar"></span>
                                      <label>Your last name</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12 p-0 mb-3">
                                <div class="row">
                                  <div class="col-md-6 p-t-20">
                                    <div class="group">
                                      <input type="text" name="email" id="email" class="w-100" >
                                      <span class="highlight"></span>
                                      <span class="bar"></span>
                                      <label>Your e-mail</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6 eventdetail-typenumber">
                                    <label>Your mobile number</label>
                                    <div class="group row">
                                      <div class="col-md-12 map-form-in">
                                        <input type="tel" name="phone_num" id="phone" minlength="10" maxlength="10" class="w-100 number-field">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12 p-0 mb-3">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="group">
                                      <div class="dropdown select-theme filter-dropdown select-box pl-0 dropdown-theme">
                                      <button class="btn btn-secondary black-txt dropdown-toggle your_level_of_study" type="button">Your level of study</button>
                                      <div class="dropdown-menu ml-0 your_level_of_study_show">
                                        <?php echo $level_study_list; ?>
                                      </div>
                                    </div>
                                  <input type="hidden" name="event_level_id"  id="event_level_id" value="<?php echo $_GET['event_level_id']; ?>">
                                  <input type="hidden" name="event_level_of_study" id="event_level_of_study" value="<?php echo $_GET['event_level_of_study']; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="group">
                                      <div class="dropdown select-theme filter-dropdown select-box dropdown-theme pl-0">
                                      <button class="btn btn-secondary black-txt dropdown-toggle your_area_of_study" type="button">Choose area of study</button>
                                      <div class="dropdown-menu ml-0 your_area_of_study_show">
                                        <?php echo $area_list; ?>
                                      </div>
                                    </div>
                                  <input type="hidden" name="event_area_id" id="event_area_id" value="<?php echo $_GET['event_area_id']; ?>">
                                  <input type="hidden" name="event_areaofstudy" id="event_areaofstudy" value="<?php echo $_GET['event_areaofstudy']; ?>">
                                  </div>
                                </div>
                                </div>
                              </div>
                              <div class="col-md-12 p-0 mb-3">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="group">
                                      <div class="dropdown select-theme filter-dropdown select-box pl-0  dropdown-theme">
                                      <button class="btn btn-secondary black-txt dropdown-toggle prefer_country" type="button">Choose country preference</button>
                                      <div class="dropdown-menu ml-0 prefer_country_show">
                                        <?php echo $country_name ; ?>
                                      </div>
                                    </div>
                                  <input type="hidden" name="country_id" id="country_id" value="<?php echo $_GET['country_id']; ?>">
                                  <input type="hidden" name="country_name" id="country_name" value="<?php echo $_GET['country_name']; ?>">
                                  </div>
                                </div>
                                  <div class="col-md-6">
                                    <div class="group">
                                      <div class="dropdown select-theme filter-dropdown select-box dropdown-theme pl-0">
                                      <button class="btn btn-secondary black-txt dropdown-toggle admis_year_list" type="button">Choose admission year</button>
                                      <div class="dropdown-menu ml-0 admis_year_list_show">
                                        <?php echo $admission_list ; ?>
                                      </div>
                                    </div>
                                  <input type="hidden" name="semid" id="semid" value="<?php echo $_GET['semid']; ?>">
                                  <input type="hidden" name="semester_year" id="semester_year" value="<?php echo $_GET['semester_year']; ?>">
                                  </div>
                                </div>
                                </div>
                              </div>
                              <div class="col-md-12 p-0 mb-3">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="label-view">
                                      <label>Choose event venue</label>
                                      <p name="event_venu" id="event_venu"><?php echo $event_addr; ?></p>
                                    </div>
                                  </div>

                                  <?php if(!empty($event_stime)){ ?>
                                  <div class="col-md-6">
                                    <div class="label-view">
                                      <label>Choose time slot</label>
                                      <p name="event_time" id="event_time"><?php echo $event_stime; ?></p>
                                    </div>
                                  </div>
                                  <?php } ?>
                                  
                                </div>
                              </div>
                              <div class=" termslink m-b-50">
                                <div class="customcheckbox">
                                  <input type="checkbox" name="terms" id="html">
                                  <label for="html"><span>Accept Tc Global's <a href='<?php echo get_permalink(134); ?>'>Terms&amp;Conditions</a> and <a href="<?php echo get_permalink(3); ?>">Privacy Policy</a></span></label>
                                </div>
                              </div>
                              <input type='hidden' name='ProspectID' id='ProspectID' >
                              <div class="col-sm-5 p-0 mb-0">
                                <!--<input type="submit" name="submit" id="submit" value="submit & register" class="btn btn-theme w-100 text-white">-->
                                <button type='submit' id='submit' class='btn btn-theme w-100 text-white'>submit & register<i class='btnLoader fa fa-spinner fa-spin ml-3' style='display:none'></i></button>
                              </div>
                              <input type="hidden" name="event_name" id="event_name" value="<?php echo get_the_title($eventPostID); ?>">
                              <div id="event_error"></div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="right-section-pad">
                      <div class="univ_logo">
                        <img src="<?php echo $img[0]; ?>" alt="life" class="m-b-20 img-fluid">
                      </div>
                      <div class="share-event col-sm-12 pl-0 p-b-20 ">
                        <h4 class="m-t-30 m-b-20">Share the Event</h4>
                        <ul class="footerul">
                          <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                          <li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                          <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 m-t-60">
                    <a href="<?php echo $url; ?>" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to Events<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php

echo do_shortcode( '[popular_events title="Events You May Like" layout="style_one"]' );
echo do_shortcode( '[content_block id=21 slug=common-section]' );

get_footer();

 ?>
