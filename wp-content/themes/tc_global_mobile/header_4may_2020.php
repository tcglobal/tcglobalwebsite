<!DOCTYPE html>
<html <?php language_attributes(); ?> style="overflow-x: hidden;">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MR4HFP5');</script>
	<!-- End Google Tag Manager -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('wpsl_google_api_key'); ?>" async ></script>


    <?php
    //wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?key='. get_option('wpsl_google_api_key').'&sensor=false');
    wp_head()

    ?>
  
	<script>
	$(document).ready(function(){
	  $('[data-toggle="popover"]').popover();   
	});
	</script>
</head>

<body <?php body_class(); ?> style="overflow-x: hidden;">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR4HFP5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- get current page url -->
<?php
  global $post;
  global $current_pageName, $current_page_url, $currentPageID;
  $current_pageName = $post->post_title;
  $currentPageID = get_queried_object_id();
  $current_page_url = get_permalink( $currentPageID );
?>


<!--HEADER-MENU-->
<header id="goto-top">
  <div class="mobile-menu"><span></span></div>
 <!-- <a href="" class="chatbox-link">
    <img src="https://tcglobal.com/wp-content/uploads/2019/09/chat.png" alt="" />
  </a>-->
  <nav id="mobile-nav">
    <ul class="top-sub-menu">
      <li><a data-toggle="modal" data-target="#checkeligible" data-keyboard="false" data-backdrop="static" class="text-decoration-none portal-form-reset allformtrigger"><img alt="" src="/wp-content/uploads/2019/08/portals.png" width="16" />Portals</a></li>
      <li><a href=<?php echo get_option('help_center'); ?> target="_blank"><img alt="" src="/wp-content/uploads/2019/08/helpcenter.png" width="16" />Help Centre</a></li>
      <li><a href=<?php echo get_option('search_tool'); ?>><img alt="" src="/wp-content/uploads/2019/08/search.png" width="16" />Course Search</a></li>
    </ul>

    <?php
    $args = array(
            'theme_location'=> 'mobile',
            'menu_id'=>'',
            'menu_class'=>'main'
            );
      wp_nav_menu($args);
    ?>
	
	<div style="padding:10px 22px;margin-top: -30px;">
		<a data-toggle="modal" data-target="#Covid-19" data-keyboard="false" data-backdrop="static" class="navbutton text-uppercase text-center text-decoration-none allformtrigger" style="width: 100%;font-size: 14px;font-weight: 800;line-height:1.86;font-family: 'Zona Pro';height: 47px;">Covid-19 Notification</a>
    </div>
	
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
      </div>
    </div>
  </div>
</header>
<!--HEADER-MENU-->


<div class="modal fade Covid-19-popup" id="Covid-19" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
		<h3 class="smallheading-modal step-form-title" >We’re still live and connecting! </h3>
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="<?php echo get_template_directory_uri();?>/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body"  style="margin:0px; margin-top: 52px;">
          <div class="list-term">
	 <p>We know Coronavirus (Covid-19) is making us all a little more cautious. In the midst of the Covid-19 crisis, we&rsquo;re still live, and ready to service our community. <br> <br>
 To protect the wellbeing of our student, university and people community, we&rsquo;ve introduced a digital infrastructure so you can connect with us, our partners and our people, online! Our learning facilities too are now virtual so everything runs seamlessly while we together navigate and get through this global health crisis.  <br> <br>
 If you want to connect or to discuss anything related to your Global Ed, Learning or Mobility journey, you can Schedule a meeting with us and all of these bookings will be done virtually now! Once you&rsquo;ve sent us your info, we will send you a link so you can log in for your slot!  <br> <br>
This crisis impacts us all in our global community, so let&rsquo;s be responsible, take the precautions and get through this together! We will get through this! <br> <br>
 Here are our guidelines to stay safe, <em><a href="https://api.tcglobal.com/img_16/Coronavirus%20%E2%80%93%20Guidelines%20on%20How%20to%20Stay%20Safe_%20Advisory.pdf">Click here</a></em></p>
</div>
          
       
          
          </div>
        </div>
      </div>
    </div>


<!-- <div class="helpchat">
	<img src="https://tcglobal.com/wp-content/uploads/chat.svg" >
</div> -->
