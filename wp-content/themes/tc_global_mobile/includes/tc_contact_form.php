<?php

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
  $join_title = nl2br($first_title."\n".$second_title."\n".$third_title);

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

  $movement .='<div class="mobile-contact-form" id="reachus">';
  $movement .='<div class="mobile-steps-content">';
  $movement .='<h2 class="lazyload" style="background-image: url(/wp-content/uploads/2019/08/dotts-bg-form.png); background-repeat: no-repeat">'.$join_title.'</h2>';
  $movement .='</div>';
  $movement .='<div class="mobile-contactblock lazyload" style="background-image: url(/wp-content/uploads/2019/08/footer-form-bottom.png); background-repeat: no-repeat">';
  $movement .='<div class="row">';
  $movement .='<div class="col-md-12">';
  $movement .='<div class="formbottom">';
  //$movement .='<div class="formheading">'.$form_title.'<br>'.$form_subtitle.'</div>';
  $movement .='<div class="formheading m-b-40">'.$form_title.'<br>'.$form_subtitle.'<a style="color: #d91f3d;top: 5px;position: relative;" data-toggle="popover" data-trigger="hover" data-trigger="focus" data-content="Amid the current Covid-19 crisis, we have gone fully virtual to protect our student, university and people community! We are live, and connecting, so do not panic, schedule a meeting and keep your hands clean!"><span style="font-size: 30px;" class="fa fa-info-circle" aria-hidden="true">&#9432;</span></a></div>';

  $movement .='<form action="" name="contactform" id="contactform" method="post" >
            <div class="row">
              <div class="col-sm-12">
                <div class="group">
                  <input type="text" class="w-100 input-value contact_form_field name-field" novalidate name="name" id="name" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Your name</label>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="group">
                  <input type="text" class="w-100 input-value contact_form_field" novalidate name="email" id="email" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Your e-mail</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="group enter-mobile-number">
                  <input type="text" placeholder="Your mobile number" class="input-value contact_form_field number-field contactflag" minlength="10" maxlength="10" novalidate name="mobile" id="mobile" required>                  
                </div>
              </div>
              <div class="col-sm-12">
                <div class="group">
                  
                <div class="dropdown select-theme filter-dropdown select-box pl-0">
                <button class="btn btn-secondary dropdown-toggle contact-service '.$activeService.'" type="button">'.$serviceBtn.'</button>
                <div class="dropdown-menu contact-service-show" style="display: none;">
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
                  <textarea class="w-100 input-value contact-textarea contact_form_field" placeholder="" rows="3" name="message" id="message" ></textarea>
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
                    <label for="TermsConditions" id="termconditionerror" class=""><span>Accept Tc Globals <a href="'.get_permalink(134).'">Terms&Conditions</a> and <a href="'.get_permalink(3).'">Privacy Policy</a></span></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="group m-b-20" id="contact_success"></div>
			        <div class="group m-b-20" id="contact_error"></div>
              <div class="col-sm-12">
                <div class="group mb-0">
                	<input type="hidden" value="'.ucfirst($post->post_name).'" name="currentPage" id="currentPage">
                  <input type="hidden" value="'.$sourceVal.'" name="pagesource" >
                  <input type="hidden" name="ProspectID" id="ProspectID" >
                  <button type="button" class="redbtn w-100 d-flex align-items-center justify-content-center text-uppercase text-decoration-none submitform">SEND <i class="btnLoader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
                </div>
              </div>
            </div>
          </form>';

  $movement .='</div>';
  $movement .='</div>';
  $movement .='</div>';
  $movement .='</div>';
  $movement .='</div>';

  $movement .='<div class="modal fade contact-popup" id="contact-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg m-t-50" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">

          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="'.get_template_directory_uri().'/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center w-100">
            <div class="mobile-main-heading m-t-80">Thank you<br> for your trust.</div>
          </div>

          <p class="text-center fs-14 p-t-40 font-regular mb-0">We will contact you shortly and together <br>
             we will focus on your journey.</p>

             <div class="row justify-content-center m-t-50">
              <div class="col-sm-4 p-0">
                <a class="text-white" href='.$backPageURL.'><button type="button" class="btn btn-theme w-100">BACK TO '.$current_pageName.'
                <img class="" src="/wp-content/themes/tcglobal/images/whiteforward.png"></button></a>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>';

 return $movement;
}
add_shortcode('join_movement', 'get_footer_content');

?>
