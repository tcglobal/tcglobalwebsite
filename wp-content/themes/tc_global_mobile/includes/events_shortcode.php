<?php

function get_event_fun($atts) {

	global $tc_head, $tc_subhead, $post, $wpdb;

	$title = $atts['title'];

	$cur_pageid = $post->ID;
	$banner_image = wp_get_attachment_image_src( get_post_thumbnail_id($cur_pageid), 'large' );
	$banner_title = get_post_meta( $cur_pageid, 'banner_title', true );

  /** get event locations - start **/
  $actCls = '';
  $posts = get_posts(
        array(
            'post_type' => 'event_listing',
            'meta_key' => '_event_location',
            'posts_per_page' => -1,
        )
    );

    $fieldsArray = array();
    foreach( $posts as $post ) {
      
      $meta_values = get_post_meta( $post->ID, '_event_location', true );
    $fieldsArray[] = $meta_values;
    }

    $fieldsArray = array_unique($fieldsArray);
    $eventPlace = '<ul>';

    foreach ($fieldsArray as $value) {

      if($_REQUEST['event_country'] == $value ){$actCls = 'active'; }
      else {$actCls = ''; }

      $eventPlace .='<li><a class="'.$actCls.'" ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value.'</a></li>';
    }
  $eventPlace .= '</ul>';

/** get event locations - end **/


	$events = '';

	$k =1;

  $business_list = ["Global Ed", "Global Learning", "Global Investments", "Global Workspace"];

    $event_business = '<ul id="selc_event_business">';
    $event_business .='<li id=""><a class=""><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';
    foreach ( $business_list as $value) {

      if($_REQUEST['event_business'] == $value ){$act_cls = 'active'; }
      else {$act_cls = ''; }

      $event_business .='<li id="'.$value.'"><a class="'.$act_cls.'"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value.'</a></li>';
    }
  $event_business .='</ul>';

$event_categoryname = '';

// Get the taxonomy's terms
$terms = get_terms(
    array(
        'taxonomy'   => 'event_categories',
        //'hide_empty' => false,
    'orderby' => 'term_id',
              'order' => 'ASC', // or ASC
    )
);

$event_categoryname .='<ul id="event_topic">';
$event_categoryname .='<li id=""><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';

  foreach ( $terms as $term ) {

    if($term->slug == $_REQUEST['topics'] ){$active_cls = 'active'; }
    else {$active_cls = ''; }

    $event_categoryname .='<li id="'.$term->name.'"><a class="'.$active_cls.'"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$term->name.'</a></li>';
    $k++;
  }

$event_categoryname .='</ul>';

$event_title_val = $_REQUEST['event_title'];
$event_country_val = $_REQUEST['event_country'];
$eventDate = $_REQUEST['event_date'];

if(!empty($eventDate)){
  $event_date_val = date("Y-m-d", strtotime($eventDate)); // eg: 2019-09-23
}
$topic_val = $_REQUEST['topics'];

$sourceurl = $_REQUEST['page'];

 $event_business_val = "";
 if($sourceurl == "ed")
 {
  $event_business_val = "Global Ed";
 }
 elseif($sourceurl == "learning")
 {
  $event_business_val = "Global Learning";
 }
 elseif($sourceurl == "investments")
 {
  $event_business_val = "Global Investments";
 }
 elseif($sourceurl == "workspace")
 {
  $event_business_val = "Global Workspace";
 }
 elseif(!empty($_REQUEST['event_business']))
 {
  $event_business_val = $_REQUEST['event_business'];
 }

/** event query filter **/

if( empty($topic_val)  && empty($event_business_val) ){

  $event_query = new WP_Query(
          array('post_type' => 'event_listing',
              'order' => 'DESC',
              'posts_per_page' => 3,
              "s" => $event_title_val,

                'meta_query' => array(
                  'relation' => 'AND',
                  array(
                    'key' => '_event_location',
                    'value' => $event_country_val,
                    'compare' => 'LIKE'
                  ),
                  array(
                    'key'       => '_event_start_date',
                    'value'     => $event_date_val,
                    'compare'   => 'LIKE',
                  )
                )

             )
        );
  }

else if( !empty($topic_val)  && empty($event_business_val) ){

$event_query = new WP_Query(
          array('post_type' => 'event_listing',
              'order' => 'DESC',
              'posts_per_page' => 3,
              "s" => $event_title_val,

                'meta_query' => array(
                  'relation' => 'AND',
                  array(
                    'key' => '_event_location',
                    'value' => $event_country_val,
                    'compare' => 'LIKE'
                  ),
                  array(
                    'key'       => '_event_start_date',
                    'value'     => $event_date_val,
                    'compare'   => 'LIKE',
                  )

                ),

                'tax_query' => array(
                  'relation' => 'AND',
                            array(
                                'taxonomy' => 'event_categories',
                                'field' => 'name',
                                'terms' => $topic_val
                            )
                         )
                    )
              );

}
else if( empty($topic_val)  && !empty($event_business_val) ){

$event_query = new WP_Query(
          array('post_type' => 'event_listing',
              'order' => 'DESC',
              'posts_per_page' => 3,
              "s" => $event_title_val,

                'meta_query' => array(
                  'relation' => 'AND',
                  array(
                    'key' => '_event_location',
                    'value' => $event_country_val,
                    'compare' => 'LIKE'
                  ),
                  array(
                    'key'       => '_event_start_date',
                    'value'     => $event_date_val,
                    'compare'   => 'LIKE',
                  )

                ),

                'meta_query' => array(
                  'relation' => 'AND',
                  array(
                    'key' => 'choose_business',
                    'value' => $event_business_val,
                    'compare' => 'LIKE'
                  )

                )

           )
        );

}
  else{

    $event_query = new WP_Query(
          array('post_type' => 'event_listing',
              'order' => 'DESC',
              'posts_per_page' => 3,
              "s" => $event_title_val,

                'meta_query' => array(
                  'relation' => 'AND',
                  array(
                    'key' => '_event_location',
                    'value' => $event_country_val,
                    'compare' => 'LIKE'
                  ),
                  array(
                    'key'       => '_event_start_date',
                    'value'     => $event_date_val,
                    'compare'   => 'LIKE',
                  )

                ),

                'tax_query' => array(
                  'relation' => 'AND',
                            array(
                                'taxonomy' => 'event_categories',
                                'field' => 'name',
                                'terms' => $topic_val
                            )
                         ),

                'meta_query' => array(
                  'relation' => 'AND',
                  array(
                    'key' => 'choose_business',
                    'value' => $event_business_val,
                    'compare' => 'LIKE'
                  )

                )
            )
        );
  }

$event_content = '';

$exclude_id = '';

if($event_query->have_posts()) :
  while ($event_query->have_posts()) : $event_query->the_post();

        $event_id = get_the_ID();
        $exclude_id .=$event_id.',';

        $img = wp_get_attachment_image_src( get_post_thumbnail_id($event_id), 'medium' );
        $event_addr = get_post_meta( $event_id, '_event_address', true );
        $event_stime = get_post_meta( $event_id, '_event_start_time', true );
        $event_etime = get_post_meta( $event_id, '_event_end_time', true );
        $event_category = get_the_terms( $event_id, 'event_categories' );

        $event_content .='<div class="col-sm-12 three_column m-b-30">';
        $event_content .='<div class="position-relative">';
        $event_content .='<a href="'.get_permalink( $event_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid"></a>';
        //$event_content .='<a class="addfav" href=""><img src="'.get_template_directory_uri().'/images/add-fav.png" alt="course-img" class="img-fluid"></a>';
        $event_content .='</div>';
        $event_content .='<div class="contentslider">';
        $event_content .='<span class="taglabel">'.$event_category[0]->name.'</span>';
        $event_content .='<h3 class="fs-20"><a href="'.get_permalink( $event_id ).'">'.get_the_title($event_id).'</a></h3>';
        $event_content .='<h4 class="fs-12">'.$event_addr.'</h4>';
        $event_content .='<div class="datetime mb-1">'.$event_stime.' - '.$event_etime.'</div>';
        $event_content .='</div>';
        $event_content .='</div>';

endwhile;
else:
$event_content ='<div>Record not found</div>';
endif;

/** get selected value **/
if(!empty($_REQUEST['topics'])) {
  $sel_topic_val = $_REQUEST['topics'];
}
else{
  $sel_topic_val = "Choose topic";
}

if(!empty($event_business_val)) {
  $sel_business_val = $event_business_val;
}
else{
  $sel_business_val = "Choose business";
}

$events .='<form name="event_search_form" class="event_mob_sec" method="get" id="event_search_form" action="" role="search">';

$events .='<div class="Events-banner" style="background: url('.$banner_image[0].') !important;background-repeat: no-repeat !important;background-position: top center !important;">
      <div class="bg-color"></div>
      <div class="container position-relative">
        <div class="row">
          <div class="col">
            <h2 class="mobile-main-heading">'.$banner_title.'</h2>
          </div>
        </div>
        <div class="search-form-fields search-result">
          <div class="row">
            <div class="col-12 m-b-20">
              <label class="d-block">What event are you looking for?</label>
              <input type="text" name="event_title" class="form-control customised-inputs" value="'.$event_title_val.'">
            </div>
            <div class="col-12 m-b-20">
              <label class="d-block">Where?</label>

              <div class="dropdown select-theme filter-dropdown pl-0 careers-form-border float-none">
                    <button id="title-btn" class="btn btn-secondary dropdown-toggle eventplace" type="button">'.$event_country_val.'</button>
                    <div class="dropdown-menu eventplace-show">
                      '.$eventPlace.'
                    </div>
                    <input type="hidden" name="event_country" value="'.$event_country_val.'" class="form-control customised-inputs">
              </div>
            </div>


            <div class="col-12 m-b-20">
              <label class="d-block">On what date?</label>
              <input type="text" name="event_date" class="event_date customised-inputs form-control datepcker-textbox-downarrow" id="datepicker" value="'.$_GET['event_date'].'">

              </div>
            <div class="col-12">

            <a class="btn btn-theme" href="javascript:void(0);" onclick="document.getElementById(\'event_search_form\').submit();">Search</a>
            </div>
          </div>
        </div>
      </div>
    </div>';


    $events .='<div class="search-result p-b-30" id="event-result">
      <div class="container position-relative">
        <div class="row">
          <div class="col">
            <h2 class="mobile-main-heading">Catalysing the Global Citizens of tomorrow, today</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12 m-t-20">
            <button type="button" class="btn btn-theme filter-btn">filter events<img alt="" src="'.get_template_directory_uri().'/images/down-white.png" class="w-auto h-auto img-fluid" />
            </button>
          </div>
        </div>';

        $events .='<div class="search-form-fields search-result filter-events-form top-0 m-b-30">
          <div class="row">
            <div class="col-12 event-search">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="What are you looking for?">
                  <div class="input-group-append">
                    <span class="input-group-text pr-2" id="basic-addon2">
                      <img src="'.get_template_directory_uri().'/images/search-icon_mb.png" class="img-fluid">
                    </span>
                  </div>
                </div>
            </div>
            <div class="col-12 event-topfilter m-b-30">
              <ul class="filter-dropdown events-dropdown clearfix">
                <li class="float-none"><div class="dropdown pl-0">
                  <button class="btn btn-secondary black-txt dropdown-toggle topic-btn" type="button"><span>'.$sel_topic_val.'</span></button>
                  <div class="dropdown-menu topic-show">'.$event_categoryname.'
                  </div>
                  </div></li>
              </ul>
              <input type="hidden" name="topics" value="'.$_GET['topics'].'">
            </div>

            <div class="col-12 event-topfilter m-b-30">
              <ul class="filter-dropdown events-dropdown clearfix">
                <li class="float-none"><div class="dropdown pl-0">
                  <button class="btn btn-secondary black-txt dropdown-toggle business-btn" type="button"><span>'.$sel_business_val.'</span></button>
                  <div class="dropdown-menu business-show">
                    '.$event_business.'
                  </div>
                  </div></li>
              </ul>
              <input type="hidden" name="event_business" value="'.$event_business_val.'">
            </div>';

            /*$events .='<div class="col-12 event-topfilter-value d-block">
              <div class="row">
                <div class="col-sm-12">
                  <span class="subheadingitem fs-12">Selected:</span>
                </div>
                <div class="col-sm-12">
                  <span class="selected_items">
                    <span class="red-tag tags mr-3">Preparation <a href=""><img class="ml-1" src="'.get_template_directory_uri().'/images/close_red.png"></a></span>
                    <span class="red-tag tags mr-3">Global Ed <a href=""><img class="ml-1" src="'.get_template_directory_uri().'/images/close_red.png"></a></span>
                  </span>
                </div>
                <div class="col-sm-12">
                  <a href="#" class="clear-btn"><span>CLEAR ALL</span></a>
                </div>
              </div>
            </div>';*/

            $events .='<div class="col-12">
            <a class="btn btn-theme" href="javascript:void(0);" onclick="document.getElementById(\'event_search_form\').submit();">apply filters</a>

            </div>
          </div>
        </div>';


         $events .='<div class="">
          <div class="col-sm-12 eventers-section mobile-upcoming-event tablet-upcoming-event p-0">
            <div class="row" id="ajax-posts">
            '.$event_content.'
            </div>
          </div>
        </div>';

        $exclude_post = rtrim($exclude_id, ',');
        $events .='<input type="hidden" name="exclude_post" value="'.$exclude_post.'">';

        $max_pagenum = $event_query->max_num_pages;
        if ( $max_pagenum > 1 ){
        $events .='<div class="col-12 Load-more-btn p-0">
                <button id="more_posts" class="btn btn-theme">Load more events
                  <img alt="" src="'.get_template_directory_uri().'/images/tab-downarrow-btn.png" class="img-fluid">
                </button>
              </div>';
          }   

  $events .='</div></div>';

$events .='</form>';

wp_reset_postdata();

return $events;

}
add_shortcode('events', 'get_event_fun');

/** Get Feature Events **/
function get_featured_events_fun($atts){

	global $post, $wpdb;

	$title = $atts['title'];

	$display_feature_event = '';

  $j =1;

    $args = array(
      'post_type' => 'event_listing',
      'order' => 'DESC',
      'posts_per_page' => 3,
      'meta_query' => array(
         array(
           'key' => '_featured',
           'value' => 1,
           'compare' => '='
         )
       )
    );

$feature_query = new WP_Query($args);

$display_feature_event .='<div class="mobile-about-oursolutions popular-events mobile-upcoming-event eventers-section m-b-50">';
$display_feature_event .='<div class="col-md-12 p-b-20">';
$display_feature_event .='<div class="content white-head">';
$display_feature_event .='<h2 class="mobile-main-heading">'.$title.'</h2>';

if($feature_query->have_posts()) :
  while ($feature_query->have_posts()) : $feature_query->the_post();

	 $feature_id = get_the_ID();
	 $feature_val = get_post_meta( $feature_id, '_featured', true );

	$feature_img = wp_get_attachment_image_src( get_post_thumbnail_id($feature_id), 'large' );
  $fevent_addr = get_post_meta( $feature_id, '_event_address', true );
  $fevent_stime = get_post_meta( $feature_id, '_event_start_time', true );
  $fevent_etime = get_post_meta( $feature_id, '_event_end_time', true );
  $post_categories = get_the_terms( $feature_id, 'event_categories' );

  if($j == 1) {$pt30 = 'p-t-30'; }

  else{$pt30 = ''; }

  $display_feature_event .='<div class="col-sm-12 three_column m-b-30 px-0 '.$pt30.'">';
  $display_feature_event .='<div class="position-relative">';
  $display_feature_event .='<img src="'.$feature_img[0].'" alt="" class="img-fluid">';
  //$display_feature_event .='<a class="addfav" href=""><img src="'.get_template_directory_uri().'/images/add-fav.png" alt="course-img" class="img-fluid"></a>';
  $display_feature_event .='</div>';
  $display_feature_event .='<div class="contentslider">';
  $display_feature_event .='<span class="taglabel">'.$post_categories[0]->name.'</span>';
  $display_feature_event .='<h3 class="fs-20"><a href="'.get_permalink( $feature_id ).'">'.get_the_title($feature_id).'</a></h3>';
  $display_feature_event .='<h4 class="fs-12">'.$fevent_addr.'</h4>';
  $display_feature_event .='<div class="datetime mb-1">'.$fevent_stime.' - '.$fevent_etime.'</div>';
  $display_feature_event .='</div>';
  $display_feature_event .='</div>';

  $j++;

endwhile;
endif;

$display_feature_event .='</div>';
$display_feature_event .='</div>';
$display_feature_event .='</div>';

wp_reset_postdata();
return $display_feature_event;
}
add_shortcode('featured_events', 'get_featured_events_fun');


/** Fetch the Popular Topics Name **/

function get_popular_topics($atts){

	$displayTopicsName = '';

	$title = $atts['title'];


$terms = get_terms(
    array(
        'taxonomy'   => 'event_categories',
        'hide_empty' => false,
		    'orderby' => 'term_id',
        'order' => 'ASC', // or ASC
    )
);

$displayTopicsName .='<div class="col-md-12">';
$displayTopicsName .='<div class="about-signup global-space pt-5 p-b-30">';
$displayTopicsName .='<div class="text-center">';
$displayTopicsName .='<div class="main-heading">'.$title.'</div>';
$displayTopicsName .='</div>';
$displayTopicsName .='<div class="row justify-content-center">';
$displayTopicsName .='<div class="col-sm-12 p-t-10 tag-section event-popular-topic">';

// Check if any term exists
if ( ! empty( $terms ) && is_array( $terms ) ) {
    // Run a loop and print them all term_id slug

    foreach ( $terms as $term ) {

      $topic_cls = get_term_meta( $term->term_id, 'topics_class_name', true );
		  $displayTopicsName .='<a href="#" id="'.$term->name.'"><span class="'.$topic_cls.' tags">'.$term->name.'</span></a>';

    }
}

$displayTopicsName .='</div>';
$displayTopicsName .='</div>';
$displayTopicsName .='</div>';
$displayTopicsName .='</div>';

return $displayTopicsName;
}
add_shortcode('popular_topics', 'get_popular_topics');

?>
