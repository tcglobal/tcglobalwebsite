<?php
/* Template Name: Country Template */

get_header(); 

global $post, $wpdb, $wp_query, $current_pageName;

$banner_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );

?>
 <div class="searchcountry-banner-bg" style="background-image: url(<?php echo $banner_image[0]; ?>) !important;">
   <div class="bg-color"></div>
 </div>

<div class="bg-color Partner-banner position-relative course-padding">
   <div class="bottom-bg"></div>
   <div class="bg-color">
     <div class="container-fluid position-relative p-0">

       <div class="partner-form-fields">
         <div class="row">

          <div class="col-sm-12 ">
            <?php 
              $flagimg =  get_post_meta( $post->ID, 'country_flag', true );
              if($flagimg)
              {
                $countryimg = wp_get_attachment_image_src($flagimg, 'medium');
            ?> 
             <div class="univ_logo p-t-30 m-b-20">
               <img src="<?php echo $countryimg[0]; ?>" alt="life" class="">
             </div>
            <?php } ?>

            <h3 class="sub-heading text-reddark text-left">study in <?php echo $current_pageName; ?></h3>
             <h2 class="tablet-main-heading">
               <span class=""><?php echo $current_pageName; ?></span>
               <!--<a class="float-right heart-icon" href=""><img src="images/search-fav-unfill.png" alt="fav"></a>-->
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

               <?php 
                $countryButton =  get_post_meta( $post->ID, 'university_and_country_button', true );
                if($countryButton){
                  ?>
                  <div class="col-sm-12 university_fields px-0">
                   <div class="row">
                      <?php echo $countryButton; ?>
                    </div>
                 </div>

                <?php  } ?>
              
              <div class="search-bor-btm"></div>    
                <?php  
                for($i=1; $i<=8; $i++){ 

                  $quick_facts_title = get_post_meta( $post->ID, 'quick_facts_title_'.$i, true );
                  $quick_facts_content = get_post_meta( $post->ID, 'quick_facts_content_'.$i, true );

                  if($quick_facts_title){
                    
                    if($i == 1) {
                      ?>
                        <div class="quick-fact col-sm-12 px-0 pb-1">
                         <h4 class="m-t-30 m-b-30">Quick facts</h4>
                         <div class="col-sm-12 p-0 m-b-20">
                           <div class="row">

                      <?php } ?>

                          <div class="col-sm-4 pr-0 m-b-20">
                           <img src="/wp-content/uploads/2019/08/check.png" alt="life" width="24" class="image-left m-b-20">
                           <div class="textcontent-right-life">
                             <p><?php echo $quick_facts_title; ?></p>
                             <p><span><?php echo $quick_facts_content; ?></span></p>
                           </div>
                         </div>

                      <?php } } ?>
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
                <div class="searchpartner-startjourney position-relative py-4 shadow m-b-60 m-t-50">
                  <?php echo $universitytext; ?>
                  <div class="check-eligible">
                    <a href="<?php echo $actionLink; ?>" <?php echo $popup_action; ?>><button type="button" class="btn btn-danger"><?php echo get_post_meta( $post->ID, 'action_button_name', true ); ?><img src="/wp-content/themes/tcglobal/images/whiteforward.png" alt=""></button></a>
                  </div>
                </div>
            <?php } ?> 

            <!-- fifth section -->
            <?php 
              $universitytitle = get_post_meta( $post->ID, 'top_universities_title', true );
              $universitylist = get_post_meta( $post->ID, 'top_universities_list', true );
            ?>

            <div class="Top-Courses m-b-30 m-t-40">
            <?php if($universitytitle) { ?>
            
              <h4><?php echo $universitytitle; ?></h4>
              <?php } if($universitylist){ ?>
              <ul class="course-list">
                <?php echo $universitylist; ?>
              </ul>
              <?php } ?>
            </div>

            <?php 
              $coursetitle = get_post_meta( $post->ID, 'top_course_title', true );
              $courselist = get_post_meta( $post->ID, 'top_courses_content', true );
            ?>

            <div class="Niche-Courses m-b-30">
              <?php if($coursetitle) { ?>
              <h4><?php echo $coursetitle; ?></h4>
              <?php } if($courselist){ ?>

              <ul class="course-list">
                <?php echo $courselist; ?>
              </ul>
              <?php } ?>
            </div>

            <!-- Industry and Economic  section -->
            <?php
            $economic_section = get_post_meta( $post->ID, 'economic_outlook', true );

            if($economic_section){ ?>
              <div class="col-sm-12 searchcoutry-outlook unique_about m-t-40 px-0">
                <?php echo $economic_section; ?>
              </div> 
            <?php } ?>

            <div class="col-sm-12 p-0">
              <div class="country-process-timeline">
                <h3><?php echo get_post_meta( $post->ID, 'process_title', true ); ?></h3>
                <?php 
                    $processimg =  get_post_meta( $post->ID, 'process_image_2', true );
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
          </div>

          <!-- Country FAQ start -->
          <?php 
             $getfaqshortcode = get_post_meta( $post->ID, 'country_faq_shortcode', true ); 
             if($getfaqshortcode){
                echo do_shortcode("$getfaqshortcode");
             }
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
              <div class="searchpartner-startjourney position-relative py-4 shadow m-b-60 m-t-30">
                  <?php echo $studycontent; ?>
                  <div class="check-eligible">
                    <a href="<?php echo $btnLink; ?>" <?php echo $popup_action; ?>><button type="button" class="btn btn-danger"><?php echo get_post_meta( $post->ID, 'study_button_name', true ); ?><img src="/wp-content/themes/tcglobal/images/whiteforward.png" alt=""></button></a>
                  </div>
              </div>
          <?php } ?>

         <?php echo do_shortcode("[discover_country title='Discover Countries']"); ?> 

          </div> <!-- end row -->
         </div>
       </div>
     </div>
   </div>


<?php
get_footer();

?>
