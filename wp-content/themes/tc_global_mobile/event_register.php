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
<div class="searchtool-banner Events-banner event-detail-sec">
      <div class="bg-color" style="height:11%;"></div>
      <div class="container position-relative">
        <div class="row">
          <div class="col">
            <h2 class="mobile-main-heading">TC Global <br/> Events</h2>
          </div>
        </div>
        <div class="search-form-fields search-result">
          <div class="row">
            <div class="col-sm-12 event-left-banner careers-jobapply">
              <div class="col-sm-12 p-0 mb-3 clearfix"><span class="tags"><?php echo $event_category[0]->name; ?></span></div>
              <h2 class="main-heading text-left">
                <span class=""><?php echo get_the_title($eventPostID); ?></span>
              </h2>
              <div class="col-sm-12 p-t-10 px-0">
                <div class="row">
                  <div class="col-sm-12">
                    <p class="event-small-head mb-2">Date and time</p>
                    <p class="event-small-head-value mb-20"><?php echo date("d.m.Y", strtotime($event_date)); ?> at <?php echo $event_stime; ?></p>
                    <p id="tcevent-date" style="display:none"><?php echo date("d.m.Y", strtotime($event_date)); ?></p>
                  </div>
                  <div class="col-sm-12">
                    <p class="event-small-head mb-2">Location</p>
                    <p class="event-small-head-value mb-2"><?php echo $event_addr; ?></p>
                  </div>
                </div>
              </div>
              <div class="theme-bor-btm"></div>
              <div class="share-event col-sm-12 px-0 pb-3 mobile-footer-section">
                <h4 class="m-t-30 mb-4">Share</h4>
                <ul class="footerul">
                  <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                  <li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                  <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
                </ul>
              </div>
              <div class="theme-bor-btm"></div>
              <div class="col-sm-12 mobile-formblock px-0 pt-0 pb-0">
                <div class="">
                  <div class="col-md-12 p-0">
                    <h4 class="event-register-head mt-0 m-b-40">Register to the event</h4>
                    <div class="event-form">
                      <form name="event_register_form"  id="event_register_form" method="post" action="">
                        <div class="col-md-12 p-0">
                          <div class="row">
                            <div class="col-md-12 m-b-15">
                              <div class="group">
                                <input type="text" name="firstname" id="firstname" class="w-100 name-field" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your first name</label>
                              </div>
                            </div>
                            <div class="col-md-12 m-b-15">
                              <div class="group">
                                <input type="text" name="lastname" id="lastname" class="w-100 name-field" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Your last name</label>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="group">
                                    <input type="text" name="email" id="email" class="w-100" >
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Your e-mail</label>
                                  </div>
                                </div>
                                <div class="col-md-12 eventdetail-typenumber m-b-15">
                                  <label>Your mobile number</label>
                                  <div class="row">
                                   <div class="col-md-12">
                                     <input type="tel" name="phone_num" id="phone" minlength="10" maxlength="10" class="form-control number-field">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 m-b-15">
                              <div class="position-relative">
                              <label>Your level of study</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle your_level_of_study" type="button">Select</button>
                                <div class="dropdown-menu your_level_of_study_show">
                                  <?php echo $level_study_list; ?>
                                </div>
                              </div>
                              <input type="hidden" name="event_level_id"  id="event_level_id" value="<?php echo $_GET['event_level_id']; ?>">
                              <input type="hidden" name="event_level_of_study" id="event_level_of_study" value="<?php echo $_GET['event_level_of_study']; ?>">
                            </div>
                            </div>
                            <div class="col-md-12 m-b-15">
                              <div class="position-relative">
                              <label>Choose area of study</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle your_area_of_study" type="button">Select</button>
                                <div class="dropdown-menu your_area_of_study_show">
                                  <?php echo $area_list; ?>
                                </div>
                              </div>
                              <input type="hidden" name="event_area_id" id="event_area_id" value="<?php echo $_GET['event_area_id']; ?>">
                              <input type="hidden" name="event_areaofstudy" id="event_areaofstudy" value="<?php echo $_GET['event_areaofstudy']; ?>">
                            </div>
                            </div>

                            <div class="col-md-12 m-b-15">
                              <div class="position-relative">
                              <label>Choose country preference</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle prefer_country" type="button">Select</button>
                                <div class="dropdown-menu prefer_country_show">
                                  <?php echo $country_name ; ?>
                                </div>
                              </div>
                              <input type="hidden" name="country_id" id="country_id" value="<?php echo $_GET['country_id']; ?>">
                              <input type="hidden" name="country_name" id="country_name" value="<?php echo $_GET['country_name']; ?>">
                            </div>
                            </div>

                            <div class="col-md-12 m-b-30">
                              <div class="position-relative">
                              <label>Choose admission year</label>
                              <div class="dropdown select-theme filter-dropdown select-box pl-0">
                                <button class="btn btn-secondary dropdown-toggle admis_year_list" type="button">Select</button>
                                <div class="dropdown-menu admis_year_list_show">
                                  <?php echo $admission_list ; ?>
                                </div>
                              </div>
                              <input type="hidden" name="semid" id="semid" value="<?php echo $_GET['semid']; ?>">
                              <input type="hidden" name="semester_year" id="semester_year" value="<?php echo $_GET['semester_year']; ?>">
                            </div>
                            </div>
                            <div class="col-md-12 m-b-15">
                              <div class="label-view">
                                <label>Choose event venue</label>
                                <p class="" name="event_venu" id="event_venu"><?php echo $event_addr; ?></p>
                              </div>
                            </div>

                            <?php if(!empty($event_stime)){ ?>
                            <div class="col-md-12">
                              <div class="label-view">
                                <label>Choose time slot</label>
                                <p class="" name="event_time" id="event_time"><?php echo $event_stime; ?></p>
                              </div>
                            </div>
                            <?php } ?>

                          </div>
                        </div>
                        <div class="termslink m-b-50 m-t-10">
                          <div class="customcheckbox">
                            <input type="checkbox" name="terms" id="html">
                            <label for="html"><span>Accept Tc Global's <a href="<?php echo get_permalink(134); ?>">Terms&amp;Conditions</a> and <a href="<?php echo get_permalink(3); ?>">Privacy Policy</a></span></label>
                          </div>
                        </div>
                        <input type='hidden' name='ProspectID' id='ProspectID' >
                        <div class="col-12 p-0">
                          <input type="submit" name="submit" id="submit" value="submit & register" class="btn btn-theme w-100">
                        </div>
                        <input type="hidden" name="event_name" id="event_name" value="<?php echo get_the_title($eventPostID); ?>">
                        <div id="event_error"></div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 m-t-50 m-b-20 px-0">
                <a href="/events" class="explorelink text-uppercase text-decoration-none pl-0" tabindex="0">Back to the events<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
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
