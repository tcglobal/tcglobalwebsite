<?php
/* Template Name: Event thank you page  */

get_header(); 

?>

<div class="searchpartner-banner-bg Events-banner">
  <div class="bg-color"></div>
  <div class="container position-relative event-head">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="main-heading">TC Global Events</h2>
      </div>
    </div>
</div>
</div>

<div class="event-content">
        <div class="bg-color Partner-banner position-relative">
          <div class="bottom-bg"></div>
          <div class="container position-relative">
            <div class="top-bg"></div>
            <div class="partner-form-fields">
              <div class="row">
                <div class="col-sm-12 event-thanks">
                  <h2 class="main-heading text-left">
                    <!--<span class="">Thanks for registering to the Global Education Interact event.</span>-->
					<span class="">Thanks for registering to the event.</span>
                  </h2>
                  <p class="text-center mt-5">We hope you’re as excited as we are to see you there!
                  </p>
                  <div class="text-center w-100 m-t-60 loadmore">
                    <a href="/events" class="eventbtn-thanks text-uppercase text-decoration-none d-block mx-auto">go back to the events</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


<?php 

echo do_shortcode( '[popular_events title="Events You May Like" layout="style_one"]' ); 
 get_footer(); 

?>