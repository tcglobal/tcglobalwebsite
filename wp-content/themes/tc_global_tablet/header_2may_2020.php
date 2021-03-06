<!DOCTYPE html>
<html <?php language_attributes(); ?> style="overflow-x: hidden;">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/intlTelInput.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/demo.css">
  
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MR4HFP5');</script>
	<!-- End Google Tag Manager -->

    <?php
    wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?sensor=false&key='. get_option('wpsl_google_api_key').'');
    wp_head()
    ?>

</head>
<body <?php body_class(); ?> style="overflow-x: hidden;">

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR4HFP5"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

   <?php $action = $_GET['id']; ?>

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
  <div class="tablet-menu"><span></span></div>
 <!-- <a href="" class="chatbox-link">
    <img src="https://tcglobal.wpengine.com/wp-content/uploads/2019/09/chat.png" alt="" />
  </a>-->
  <nav id="tablet-nav">
  	<?php
            $args = array(
  			    'theme_location'=> 'primary',
  			    'menu_id'=>'',
  			    'menu_class'=>'main'
  			    );
			wp_nav_menu($args);
        ?>

  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 offset-sm-2 pl-1">
        <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
      </div>
     

	 <!--<div class="col-sm-7 text-right">

        <?php if($action) { ?>
            <button type="button" data-toggle="modal" data-target="#meetingForm" id="meetingtrigger" data-keyboard="false" data-backdrop="static" class="btn btn-primary btn-theme">schedule a meeting</button>
        <?php }
        else{ ?>
        <button type="button" data-toggle="modal" data-target="#schedule_form" id="schedule_trigger" data-keyboard="false" data-backdrop="static" class="btn btn-primary btn-theme">schedule a meeting</button>
        <?php } ?>
      <div class="toggle-navheader">
          <button type="button" class="btn btn-link"><i class="fa fa-ellipsis-v"></i></button>
          <ul class="primarynavblock__ul dropdown-menu">
             <li><a href=<?php echo get_option('search_tool'); ?> class="text-decoration-none"><span><img src="/wp-content/uploads/2019/08/search.png" alt="" width="16"></span>Course Search</a></li>
             <li><a href=<?php echo get_option('help_center'); ?> target="_blank" class="text-decoration-none"><span><img src="/wp-content/uploads/2019/08/helpcenter.png" alt="" width="16"></span>Help Center</a></li>
             <li><a data-toggle="modal" data-target="#checkeligible" data-keyboard="false" data-backdrop="static" class="text-decoration-none portal-form-reset"><span><img src="/wp-content/uploads/2019/08/portals.png" alt="" width="16"></span>Portals</a></li>
          </ul>
        </div>

      </div>-->
	  
	  
	   <div class="col-sm-7 text-right">
        <?php if($action) { ?>
            <button style="margin-right:35px" type="button" data-toggle="modal" data-target="#meetingForm" id="meetingtrigger" data-keyboard="false" data-backdrop="static" class="btn btn-primary btn-theme allformtrigger">schedule a meeting</button>
        <?php } 
        else{ ?>
        <button style="margin-right:35px" type="button" data-toggle="modal" data-target="#schedule_form" id="schedule_trigger" data-keyboard="false" data-backdrop="static" class="btn btn-primary btn-theme allformtrigger">schedule a meeting</button>
        <?php } ?>
		<button type="button" data-toggle="modal" data-target="#Covid-19" data-keyboard="false" data-backdrop="static" class="btn btn-primary btn-theme allformtrigger">Covid-19 Notification</button>
		
      <div style="position: absolute; right:0;top: 0;" class="toggle-navheader">		  
		  
		  <button type="button" class="btn btn-link"><i class="fa fa-ellipsis-v"></i></button>
          <ul class="primarynavblock__ul dropdown-menu">
             <li><a href=<?php echo get_option('search_tool'); ?> class="text-decoration-none"><span><img src="/wp-content/uploads/2019/08/search.png" alt="" width="16"></span>Course Search</a></li>
             <li><a href=<?php echo get_option('help_center'); ?> target="_blank" class="text-decoration-none"><span><img src="/wp-content/uploads/2019/08/helpcenter.png" alt="" width="16"></span>Help Center</a></li>
             <li><a data-toggle="modal" data-target="#checkeligible" data-keyboard="false" data-backdrop="static" class="text-decoration-none portal-form-reset allformtrigger"><span><img src="/wp-content/uploads/2019/08/portals.png" alt="" width="16"></span>Portals</a></li>
          </ul>		  
		  
        </div>
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




<div class="helpchat">
	<img src="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_120,h_34/https://tcglobal.com/wp-content/uploads/chat.svg" >
</div>
<!-- Start of thechoprassupport Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=dc7656d1-f86f-4a8f-940f-698fe6b1a867"> </script>
<script>
	zE('webWidget', 'hide');

	$('.helpchat').click(function(){
		javascript:void($zopim.livechat.window.show());
		zE(function()
		{zE.hide();
		 zE.activate({hideOnClose: true});
		});
	});
</script>
<style>
	.helpchat img{ width:100%;}
	.helpchat {
		bottom:0;
		cursor: pointer;
		position: fixed;
		right: 20px;
	   z-index:999999;
	}
</style>
