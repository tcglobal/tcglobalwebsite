<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('wpsl_google_api_key'); ?>" async ></script>
    <?php
    //wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?key='. get_option('wpsl_google_api_key').'&sensor=false');
    wp_head()

    ?>

</head>

<body <?php body_class(); ?>>

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
  <div class="mobile-menu"><span></span></div>
 <!-- <a href="" class="chatbox-link">
    <img src="https://tcglobal.wpengine.com/wp-content/uploads/2019/09/chat.png" alt="" />
  </a>-->
  <nav id="mobile-nav">
    <ul class="top-sub-menu">
      <li><a data-toggle="modal" data-target="#checkeligible" data-keyboard="false" data-backdrop="static" class="text-decoration-none portal-form-reset"><img alt="" src="https://tcglobal.com/wp-content/uploads/2019/08/portals.png" width="16" />Portals</a></li>
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
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
      </div>
    </div>
  </div>
</header>


