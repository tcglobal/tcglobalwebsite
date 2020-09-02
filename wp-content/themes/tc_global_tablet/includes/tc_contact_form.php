<?php

// display the join movement post content
function get_footer_content(){
  global $current_pageName, $current_page_url, $post, $currentPageID;
  $sourceVal = $_GET['source'];

  $backPageURL = $current_page_url;
  if($sourceVal!='')
  {
    $backPageURL = $current_page_url.'?source='.$sourceVal;
  }

  $args = array( 'post_type' => 'join_content', 'order' => 'ASC');
  $content = new WP_Query( $args );
  $first_title = get_post_meta( '110', 'first_heading', true );
  $second_title = get_post_meta( '110', 'second_heading', true );
  $third_title = get_post_meta( '110', 'third_heading', true );
  $join_title = nl2br($first_title.' '.$second_title."\n".$third_title);

  $form_title = get_post_meta( '114', 'first_heading', true );
  $form_subtitle = get_post_meta( '114', 'second_heading', true );

  $servicetype = get_post_meta( $currentPageID, 'choose_service_type', true );

  if($servicetype){
    $serviceBtn = $servicetype;
    $select_service = $servicetype;
    $service_cls = 'active';
    $activeService = 'value-selected';
  }
  else{
    $serviceBtn = 'Choose Service';
    $select_service = "";
    $service_cls ="";
    $activeService ="";
  }

  $movement='';
  $movement .='<div class="tablet-steps-content" id="reachus">';
  $movement .='<h2>'.$join_title.'</h2>';
  $movement .='<div class="row">';

  while ( $content->have_posts() ) : $content->the_post();

    $join_arrow = get_post_meta( $post->ID, 'join_icon', true );
    $join = wp_get_attachment_image_src($join_arrow);

    $movement .='<div class="col-sm-6">';
      $movement .='<div class="row">';
        $movement .='<div class="col-sm-2 pr-0">';
          $movement .='<img alt="" src="'.$join[0].'" class="img-fluid" />';
        $movement .='</div>';
        $movement .='<div class="col-sm-10">';
          $movement .='<h3><span>'.get_the_title( $post->ID ).'</span><br>'.get_post_field('post_content', $post->ID).'</h3>';
        $movement .='</div>';
      $movement .='</div>';
    $movement .='</div>';

  endwhile;
  wp_reset_postdata();
$movement .='</div></div>';

$movement .='<form action="" name="contactform" id="contactform" method="post" >';
$movement .='<div class="tablet-contactblock">';
$movement .='<div class="row">';
$movement .='<div class="col-md-12">';
$movement .='<div class="formbottom">';
$movement .='<div class="formheading">'.$form_title.'<br>'.$form_subtitle.'</div>';

$movement .='<div class="row">
              <div class="col-sm-6">
                <div class="group">
                  <input type="text" class="w-100 input-value contact_form_field name-field" novalidate name="name" id="name" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Your name</label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="group">
                  <input type="text" class="w-100 input-value contact_form_field" novalidate name="email" id="email" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Your e-mail</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="group enter-mobile-number">
                  <input type="text" placeholder="Your mobile number" class="input-value contact_form_field number-field contactflag" minlength="10" maxlength="10" novalidate name="mobile" id="mobile" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="group">
                  <!--<div class="position-absolute alignright"><img src="'.get_template_directory_uri().'/images/dropdown.png" alt="" width="10"></div>
                  <select class="w-100 input-value contact_form_field"  name="service" id="service">
                    <option></option>
                <option value="Global Education">Global Education</option>
                <option value="Global Learning">Global Learning</option>
                <option value="Global Investments">Global Investments</option>
				<option value="WorkSpace">WorkSpace</option>
                  </select>
                  <label>Choose Service</label>-->

                  <div class="dropdown select-theme filter-dropdown select-box pl-0">
                <button class="btn btn-secondary dropdown-toggle contact-service '.$activeService.'" type="button">'.$serviceBtn.'</button>
                <div class="dropdown-menu contact-service-show left-0" style="display: none;">
                  <ul id="sel-contact-service">
                    <li id="Global Education"><a class='.$service_cls.'><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Education</a></li>
                    <li id="Global Learning"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Learning</a></li>
                    <li id="Global Investments"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Investments</a></li>
                    <li id="WorkSpace"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">WorkSpace</a></li>
                  </ul>
                </div>
                <input type="hidden" name="contact-service" id="contact-service" value="'.$select_service.'">
              </div>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
               <div class="group">
               <textarea class="w-100 input-value contact-textarea contact_form_field" placeholder="" rows="4"  name="message" id="message" ></textarea>
				       <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your message</label>
               </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="termslink">
                  <div class="customcheckbox">
                    <input type="checkbox" checked id="TermsConditions" name="TermsConditions">
                    <label for="TermsConditions" id="termconditionerror"><span>Accept Tc Globals <a href="'.get_permalink(134).'">Terms&Conditions</a> and <a href="'.get_permalink(3).'">Privacy Policy</a></span></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
             <div class="group m-b-20" id="contact_success"></div>
			        <div class="group m-b-20" id="contact_error"></div>
              <div class="col-sm-9 p-0">
                <div class="group mb-0">
                		<input type="hidden" value="'.ucfirst($post->post_name).'" name="currentPage" id="currentPage">
                    <input type="hidden" value="'.$sourceVal.'" name="pagesource" >
                    <input type="hidden" name="ProspectID" id="ProspectID" >
                    <button type="button" class="redbtn w-100 d-flex align-items-center justify-content-center text-uppercase text-decoration-none submitform">SEND <i class="btnLoader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
                </div>
              </div>
            </div>';


$movement .='</div>';
$movement .='</div>';
$movement .='</div>';
$movement .='</div></form>';

$movement .='<div class="modal fade contact-popup" id="contact-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg m-t-80" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="'.get_template_directory_uri().'/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body">
        <div class="smallheading text-uppercase text-center m-t-60">that’s it!</div>
          <div class="text-center w-100 ">
            <div class="boldheading m-b-30">Thank you for your trust.</div>
            <div class="path"></div>
          </div>
          <p class="text-center fs-14 font-regular m-t-60 pb-3">Thanks for contacting us! We will reach you shortly and start our journey together.</p>
          <div class="row justify-content-center m-t-50">
              <div class="col-sm-4 p-0">
                <a class="text-white" href='.$backPageURL.'><button type="button" class="btn btn-theme w-100">BACK TO '.$current_pageName.'
                <img class="" src="/wp-content/themes/tcglobal/images/whiteforward.png"></button></a>
              </div>
          </div>
        </div>
      </div>
    </div>';

return $movement;
}
add_shortcode('join_movement', 'get_footer_content');

?>
