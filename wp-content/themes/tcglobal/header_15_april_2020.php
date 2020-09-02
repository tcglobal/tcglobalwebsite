<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="apple-touch-icon" href="wp-content/uploads/2019/08/logo-1.png">
    <meta name="theme-color" content="#ffffff">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('wpsl_google_api_key'); ?>" async ></script>
    <?php
	//wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?sensor=false&key='. get_option('wpsl_google_api_key').'');
	wp_head() ?>

	
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '1720237644879351');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=1720237644879351&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38652723-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-38652723-1');
	</script>
	
	  <script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
</head>
<body <?php body_class(); ?>>
  <?php $action = $_GET['id']; ?>

<!-- get current page url -->
<?php 
  global $post;
  global $current_pageName, $current_page_url, $currentPageID;
  $current_pageName = $post->post_title;
  $currentPageID = get_queried_object_id();
  $current_page_url = get_permalink( $currentPageID );
?>
  
<!-- desktop navigation section -->
<header id="goto-top">
      <div class="navblock">
         <div class="primarynavblock">
            <div class="container">		
               <div class="row justify-content-between">
                  <div class="col-md-1 mainmenu-togglebtn">
                    <div class="toggle-menu"><span></span></div>
                  </div>
                  <div class="col-md-2 p-t-5">
                  		<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
                   </div>
                  <div class="col-md-9 p-t-10">
                     <ul class="primarynavblock__ul  float-right">
                        <li><a data-toggle="modal" data-target="#Covid-19"  data-keyboard="false" data-backdrop="static" class="navbutton text-uppercase text-center text-decoration-none" >Covid-19 Notification</a></li>
						
						<li><a href=<?php echo get_option('search_tool'); ?> class="text-decoration-none">Course Search<span><img src="/wp-content/uploads/2019/08/search.png" alt="" width="16"></span></a></li>
                        <li><a href=<?php echo get_option('help_center'); ?> target="_blank" class="text-decoration-none">Help Center<span><img src="/wp-content/uploads/2019/08/helpcenter.png" alt="" width="16"></span></a></li>
                        <li><a data-toggle="modal" data-target="#checkeligible" data-keyboard="false" data-backdrop="static" class="text-decoration-none portal-form-reset">Portals<span><img src="/wp-content/uploads/2019/08/portals.png" alt="" width="16"></span></a></li>
                        
                        <?php if($action) { ?>
                        <li><a data-toggle="modal" data-target="#meetingForm" id="meetingtrigger" data-keyboard="false" data-backdrop="static" class="navbutton text-uppercase text-center text-decoration-none" >schedule an e-Meet</a></li>
                        <?php } 
                        else{ ?>
                        <li><a data-toggle="modal" data-target="#schedule_form" id="schedule_trigger" data-keyboard="false" data-backdrop="static" class="navbutton text-uppercase text-center text-decoration-none" >schedule an e-Meet</a></li>
                        <?php } ?>
						
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <!--<a href="" class="chatbox-link">
          <img src="https://tcglobal.wpengine.com/wp-content/uploads/2019/09/chat.png" alt="" />
         </a>-->
         <div class="secondarynavblock">

        <?php
            $args = array(
			    'theme_location'=> 'primary',
			    'container_class' => 'container',
			    'menu_id'=>'',
			    'menu_class'=>'secondarynavblock__ul',
			    'add_li_class'  => 'text-decoration-none'
		    );
			wp_nav_menu($args);
        ?>
         </div>
      </div>
</header>


<div class="modal fade Covid-19-popup" id="Covid-19" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
		<h3 class="smallheading-modal step-form-title" >We’re still live and connecting! </h3>
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="<?php echo get_template_directory_uri();?>/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body"  style="margin:-25px; margin-top: 30px;">
          <div class="list-term">
	 <p>We know Coronavirus (Covid-19) is making us all a little more cautious. In the midst of the Covid-19 crisis, we&rsquo;re still live, and ready to service our community. <br> <br>
 To protect the wellbeing of our student, university and people community, we&rsquo;ve introduced a digital infrastructure so you can connect with us, our partners and our people, online! Our learning facilities too are now virtual so everything runs seamlessly while we together navigate and get through this global health crisis.  <br> <br>
 If you want to connect or to discuss anything related to your Global Ed, Learning or Mobility journey, you can Schedule a meeting with us and all of these bookings will be done virtually now! Once you&rsquo;ve sent us your info, we will send you a link so you can log in for your slot!  <br> <br>
This crisis impacts us all in our global community, so let&rsquo;s be responsible, take the precautions and get through this together! We will get through this! <br> <br>
 Here are our <a style="color: #da1f3d;font-family: 'Zona Pro';" target="_blank" href="https://api.tcglobal.com/img_16/Coronavirus%20%E2%80%93%20Guidelines%20on%20How%20to%20Stay%20Safe_%20Advisory.pdf">guidelines</a> to stay safe.</p>
</div>
          
       
          
          </div>
        </div>
      </div>
    </div>

<!-- End of desktop navigation -->

<!-- <div class="helpchat">	
	<img src="https://tcglobal.com/wp-content/uploads/chat.svg" >
</div> -->
<!-- Start of thechoprassupport Zendesk Widget script -->

