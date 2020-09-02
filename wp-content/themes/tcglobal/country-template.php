<?php
/* Template Name: Country Template */

get_header(); 

global $post, $wpdb, $wp_query, $current_pageName;

$banner_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );

?>
<div class="search-country-banner" style="background-image: url(<?php echo $banner_image[0]; ?>) !important;">
    <div class="bg-color"></div>
</div>

<div class="custom-country-page">
    <div class="bg-color Partner-banner position-relative">
        <div class="bottom-bg"></div>
        <div class="container position-relative">
          <div class="top-bg"></div>
          <div class="partner-form-fields">

          	<div class="row">

          		<div class="col-xl-7 ">
          			<div class="smallheading text-uppercase text-reddark">study in <?php echo $current_pageName; ?></div>
	                <h2 class="main-heading text-left">
	                  <span class=""><?php echo $current_pageName; ?></span>
	                </h2>

                  <?php 
                    $universeImgID = get_post_meta( $post->ID, 'university_image', true );
                    if($universeImgID){
                      $universeImg = wp_get_attachment_image_src($universeImgID, 'full');
                    }
                    $universitycount = get_post_meta( $post->ID, 'university_count', true );

                    $courseImgID = get_post_meta( $post->ID, 'course_image', true );
                    if($courseImgID){
                      $courseImg = wp_get_attachment_image_src($courseImgID, 'full');
                    }
                    $coursecount = get_post_meta( $post->ID, 'course_count', true );
                  ?>
	                <div class="row searchcoutry-about-count">
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="row">
                          <?php if($universeImg) { ?>
                          <div class="col-sm-4">
                            <img src="<?php echo $universeImg[0]; ?>" alt="">
                          </div>
                          <?php } 
                          if($universitycount){
                          ?>
                          <div class="col-sm-8 pl-0">
                            <?php echo $universitycount; ?>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="row">
                          <?php if($courseImg) { ?>
                          <div class="col-sm-4">
                            <img src="<?php echo $courseImg[0]; ?>" alt="">
                          </div>
                          <?php } 
                          if($coursecount){
                          ?>
                          <div class="col-sm-8 pl-0">
                            <?php echo $coursecount; ?>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="search-bor-btm"></div>

                 <!-- second section -->
                <?php
                  if ( have_posts() ) :
                  while ( have_posts() ) : the_post(); 
                    the_content(); 
                  endwhile; // End of the loop.
                  endif; // End of the if.
                ?>

                <!-- third section -->
                <?php echo get_post_meta( $post->ID, 'about_content', true ); ?>
                 
                <!-- fourth section -->
                <?php $universitytext = get_post_meta( $post->ID, 'university_delegates_content', true ); 
                if($universitytext){

                  $popup_action = '';
                  $actionLink = get_post_meta( $post->ID, 'action_button_link', true ); 

                  if($actionLink == 'global-ed-form')
                  {
                      $popup_action ='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
                  }
                  
                ?>
                  <div class="searchpartner-startjourney position-relative py-4 shadow m-b-60">
                    <?php echo $universitytext; ?>

                    <div class="check-eligible">
                      <a href="<?php echo $actionLink; ?>" <?php echo $popup_action; ?>><button type="button" class="btn btn-danger"><?php echo get_post_meta( $post->ID, 'action_button_name', true ); ?><img src="/wp-content/themes/tcglobal/images/whiteforward.png" alt=""></button></a>
                    </div>

                  </div>
                <?php } ?>

                <!-- fifth section -->
                <div class="Top-Courses top-universities-block m-b-30">
                  <h4><?php echo get_post_meta( $post->ID, 'top_universities_title', true ); ?></h4>
                  <ul class="course-list">
                    <?php echo get_post_meta( $post->ID, 'top_universities_list', true ); ?>
                  </ul>
                </div>

                <div class="Niche-Courses top-universities-block m-b-30">
                  <h4><?php echo get_post_meta( $post->ID, 'top_course_title', true ); ?></h4>
                  <ul class="course-list">
                    <?php echo get_post_meta( $post->ID, 'top_courses_content', true ); ?>
                  </ul>
                </div>

                <!-- Industry and Economic  section -->
                <?php
                $economic_section = get_post_meta( $post->ID, 'economic_outlook', true );

                if($economic_section){ ?>
                  <div class="col-sm-12 searchcoutry-outlook unique_about m-t-40 px-0">
                    <?php echo $economic_section; ?>
                  </div> 
                <?php } ?>


              </div>
              <!-- right section -->
              <div class="col-xl-5 ">
                <div class="right-section-pad">

                  <?php 
                    $flagimg =  get_post_meta( $post->ID, 'country_flag', true );
                    if($flagimg)
                    {
                        $countryimg = wp_get_attachment_image_src($flagimg, 'full');
                    ?>  
                        <div class="univ_logo">
                          <img src="<?php echo $countryimg[0]; ?>" alt="life" class="m-b-30">
                        </div>
                  <?php } 

                   $countryButton =  get_post_meta( $post->ID, 'university_and_country_button', true );

                  if($countryButton){
                  ?>
                   <div class="check-eligible m-t-30"> <?php echo $countryButton; ?></div>
                  <?php  } ?>

                  <?php  
                    for($i=1; $i<=8; $i++){ 

                      $quick_facts_title = get_post_meta( $post->ID, 'quick_facts_title_'.$i, true );
                      $quick_facts_content = get_post_meta( $post->ID, 'quick_facts_content_'.$i, true );

                      if($quick_facts_title){
                        if($i == 1) {
                          ?>
                          <div class="quick-fact col-sm-12 px-0 p-b-20">
                          <h4 class="m-t-40 m-b-30">Quick facts</h4>
                            <div class="col-sm-12 p-0 m-b-30">
                              <div class="row">
                          <?php } ?>
                            <div class="col-sm-6 p-b-30">
                              <img src="/wp-content/uploads/2019/08/check.png" alt="life" width="24" class="image-left m-b-20">
                              <div class="textcontent-right-life">
                                <p><?php echo $quick_facts_title; ?></p>
                                <p><span><?php echo $quick_facts_content; ?></span></p>
                              </div>
                            </div>
                          <?php } } ?>
                        </div>
                      </div>
                      <div class="search-bor-btm"></div>
                    </div>



                  

                </div>  
              </div><!-- right section end -->


              <!-- <div class="col-sm-12">
                <div class="country-process-timeline">
                  <h3><?php echo get_post_meta( $post->ID, 'process_title', true ); ?></h3>
                  <div class="timeline-view">

                   <?php  
                   for($i=1; $i<=6; $i++){

                    $processimg =  get_post_meta( $post->ID, 'process_image_'.$i, true );
                    $processtitle =  get_post_meta( $post->ID, 'image_title_'.$i, true );
                    $processcls =  get_post_meta( $post->ID, 'image_class_'.$i, true );

                    if($processimg)
                    {
                      $imgurl = wp_get_attachment_image_src($processimg);
                    }

                    ?>

                    <div class="<?php echo $processcls; ?>">
                      <img class="media-object" src="<?php echo $imgurl[0]; ?>" />
                      <p><?php echo $processtitle; ?></p>
                    </div>

                    <?php } ?>

                   </div>
                  </div>
                </div> -->


                <div class="col-sm-12">
                  <div class="country-process-timeline">
                    <h3><?php echo get_post_meta( $post->ID, 'process_title', true ); ?></h3>
                    <?php 
                        $processimg =  get_post_meta( $post->ID, 'process_image_1', true );
                        if($processimg)
                        {
                          $imgurl = wp_get_attachment_image_src($processimg, 'full');
                        }
                    ?>

                    <div class="timeline-view">
                       <img class="media-object" src="<?php echo $imgurl[0]; ?>" />         
                                
                   </div>
                  </div>
                </div>

                <!-- Country FAQ start -->
                <?php 
                   $getfaqshortcode = get_post_meta( $post->ID, 'country_faq_shortcode', true ); 
                  echo do_shortcode("$getfaqshortcode");

                ?>
                <!-- Country FAQ end -->
                
              <?php 
                $studycontent = get_post_meta( $post->ID, 'study_section_content', true );

                if($studycontent){

                  $popup_action = '';
                  $btnLink = get_post_meta( $post->ID, 'study_button_link', true ); 

                  if($btnLink == 'global-ed-form')
                  {
                      $popup_action ='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
                  }
              ?>   
                <div class="col-sm-12">
                  <div class="searchpartner-startjourney position-relative py-4 shadow m-b-60 m-t-20">
                    <?php echo $studycontent; ?>
                    <div class="check-eligible">
                      <a href="<?php echo $btnLink; ?>" <?php echo $popup_action; ?>><button type="button" class="btn btn-danger"><?php echo get_post_meta( $post->ID, 'study_button_name', true ); ?><img src="/wp-content/themes/tcglobal/images/whiteforward.png" alt=""></button></a>
                    </div>
                  </div>
                </div>

            <?php } ?>

            <?php echo do_shortcode("[discover_country title='Discover Countries']"); ?>
                

          </div><!-- row end -->



          </div>
		    </div>
    </div>
</div>  
  
<?php
get_footer();
