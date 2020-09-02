<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/intlTelInput.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/demo.css">
    <?php
    wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?sensor=false&key='. get_option('wpsl_google_api_key').'');
    wp_head()
    ?>

</head>

<body <?php body_class(); ?>>

   <?php $action = $_GET['id']; ?>

   <!-- get current page url -->
<?php 
  global $post;
  global $current_pageName, $current_page_url;
  $current_pageName = $post->post_title;
  $obj_id = get_queried_object_id();
  $current_page_url = get_permalink( $obj_id );
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
      <div class="col-sm-7 text-right">

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

      </div>
    </div>
  </div>
</header>
<!--HEADER-MENU-->
