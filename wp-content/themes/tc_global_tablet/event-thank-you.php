<?php
/* Template Name: Event thank you page  */

get_header(); 

?>

<div class="searchtool-banner Events-banner">
  <div class="bg-color"></div>
  <div class="container-fluid position-relative">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="main-heading">TC Global <br/>Events</h2>
      </div>
    </div>
  </div>
</div>

<div class="bg-color Partner-banner position-relative ">
      <div class="bottom-bg"></div>
      <div class="container-fluid position-relative p-0">
        <div class="search-form-fields event-detail-fields">
          <div class="bg-color"></div>
          <div class="row">
            <div class="col-sm-12 event-thanks m-t-30">
              <h2 class="main-heading text-left">
                 <!--<span class="">Thanks for registering to the Global Education Interact event.</span>-->
					<span class="">Thanks for registering to the event.</span>
              </h2>
              <p class="text-center mt-5">We hope you’re as excited as we are to see you there!
              </p>
              <div class="text-center w-100 m-t-60 m-b-30 loadmore">
                <a href="/events" class="eventbtn-thanks text-uppercase text-decoration-none d-block mx-auto">go back to the events</a>
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