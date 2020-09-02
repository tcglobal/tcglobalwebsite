<?php
/* Template Name: Onboard thank you page  */

get_header(); 

?>

<div class="searchpartner-banner-bg Events-banner">
  <div class="bg-color"></div>
  <div class="container position-relative event-head">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="main-heading">TC Global </h2>
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
                    <span class="">Thank you!</span>
                  </h2>
<div class="text-center">
                  <p >If your profile will suit our needs, we will contact you shortly.
                    <br/>Hopefully, you’ll join our movement soon!                                     </p>
</div>
                  <!-- <div class="text-center w-100 m-t-60 loadmore">
                    <a href="/events" class="eventbtn-thanks text-uppercase text-decoration-none d-block mx-auto">go back to the events</a>
                  </div> -->
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