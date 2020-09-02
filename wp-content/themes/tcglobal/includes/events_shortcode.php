<?php

function get_event_fun($atts) {

	global $tc_head, $tc_subhead, $post, $wpdb;

	$cur_pageid = $post->ID;
	$banner_image = wp_get_attachment_image_src( get_post_thumbnail_id($cur_pageid), 'single-post-thumbnail' );
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

	$i = 1;
	$k = 1;

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
		//$k++;
	}

$event_categoryname .='</ul>';


$event_title_val = $_REQUEST['event_title'];
$event_country_val = $_REQUEST['event_country'];

$eventDate = $_REQUEST['event_date'];
if(!empty($eventDate)){
	$event_date_val = date("Y-m-d", strtotime($eventDate)); // eg: 2019-09-23
}
/*else
{
	$event_date_val = date("Y-m-d");
	$tomorrow = date("Y-m-d", strtotime("+1 day"));
}*/
$ismatch = false;
if($event_date_val == date("Y-m-d"))
{
	$ismatch = true;
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

if( empty($topic_val)  && empty($event_business_val) ){

	$event_query = new WP_Query(
					array('post_type' => 'event_listing',
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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

		$img = '';
		$event_id = get_the_ID();
        $exclude_id .=$event_id.',';

        if ($i == 1) { 
        	$cls = 'col-sm-6';
        	$img = wp_get_attachment_image_src( get_post_thumbnail_id($event_id), 'full' ); 
        }
		else { 
			$cls = 'col-sm-3 three_column m-b-30';
			$img = wp_get_attachment_image_src( get_post_thumbnail_id($event_id), 'medium' );  
		}

        //$img = wp_get_attachment_image_src( get_post_thumbnail_id($event_id), 'medium' );
        
        $event_addr = get_post_meta( $event_id, '_event_address', true );
        $event_stime = get_post_meta( $event_id, '_event_start_time', true );
        $event_etime = get_post_meta( $event_id, '_event_end_time', true );
        $event_sdate = get_post_meta( $event_id, '_event_start_date', true );
		$event_category = get_the_terms( $event_id, 'event_categories' );
		

        $event_content .='<div class="'.$cls.'">';
		$event_content .='<div class="position-relative">';
		$event_content .='<a href="'.get_permalink( $event_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid"></a>';
		$event_content .='</div>';
		$event_content .='<div class="contentslider">';
		$event_content .='<span class="taglabel">'.$event_category[0]->name.'</span>';
		$event_content .='<a href="'.get_permalink( $event_id ).'"><div class="formheading pb-2">'.get_the_title($event_id).'</div></a>';
		$event_content .='<div class="officename pb-1">'.$event_addr.'</div>';
		//$event_content .='<div class="datetime">'.$event_stime.' - '.$event_etime.'</div>';
		$event_content .='<div class="datetime">'.date('d-m-Y',strtotime($event_sdate)).'</div>';
		$event_content .='</div>';
		$event_content .='</div>';


	$i++;
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

$events .='<form name="event_search_form" method="get" id="event_search_form" action="" role="search">';
$events .='<div class="searchtool-banner Events-banner" style="background-image: url('.$banner_image[0].') !important;">';
      $events .='<div class="bg-color"></div>';
      $events .='<div class="container position-relative">';
        $events .='<div class="row align-items-center">';
          $events .='<div class="col">';
            $events .='<h2 class="main-heading">'.$banner_title.'</h2>';
          $events .='</div>';
        $events .='</div>';

		$events .='<div class="search-form-fields">';
          $events .='<div class="row">';
            $events .='<div class="col-sm-11">';
              $events .='<div class="row">';
                $events .='<div class="col">';
                  $events .='<label class="d-block">What event are you looking for?</label>';
                  $events .='<input type="text" name="event_title" value="'.$event_title_val.'" class="form-control customised-inputs">';
                $events .='</div>';

                $events .='<div class="col">';
                  $events .='<label class="d-block">Where?</label>';
                  $events .='<div class="dropdown select-theme filter-dropdown pl-0 careers-form-border float-none">
                    <button id="title-btn" class="btn btn-secondary dropdown-toggle eventplace" type="button">'.$event_country_val.'</button>
                    <div class="dropdown-menu eventplace-show">
                      '.$eventPlace.'
                    </div>
                    <input type="hidden" name="event_country" value="'.$event_country_val.'" class="form-control customised-inputs">
                    
                  </div>';

					//$events .='<input type="text" name="event_country" value="'.$event_country_val.'" class="form-control customised-inputs">';
                $events .='</div>';

				$events .='<div class="col">';
                  $events .='<label class="d-block">On what date?</label>';
                  $events .='<input type="text" name="event_date" class="event_date customised-inputs form-control datepcker-textbox-downarrow" id="datepicker" value="'.$_GET['event_date'].'" >';

                $events .='</div>';
              $events .='</div>';
            $events .='</div>';
            $events .='<div class="col-sm-1 text-right pt-4">';

              $events .='<a href="javascript:void(0);" onclick="document.getElementById(\'event_search_form\').submit();"><img src="'.get_template_directory_uri().'/images/searchbar-icon.png" alt="Search" /></a>';
            $events .='</div>';
          $events .='</div>';
        $events .='</div>';


  $events .='</div>';
$events .='</div>';


$events .='<div class="search-result" id="event-result">';
$events .='<div class="container">';
$events .='<div class="row">';
$events .='<div class="col-sm-12">';

$events .='<h2 class="main-heading"><span class="d-block">Catalysing the Global </span>Citizens of tomorrow, today</h2>';
/*if($ismatch){
$events .='<h2 class="main-heading"><span class="d-block">Catalysing the Global </span>Citizens of tomorrow, today</h2>';
}
else
{
	$events .='<h2 class="main-heading"><span class="d-block">Catalysing the Global </span>Citizens of '.date("d.m.Y", strtotime($event_date_val)).'</h2>';
}*/
$events .='<div class="row">';
$events .='<div class="col-sm-12">';

/** second Filter start **/
$events .='<div class="event-topfilter">';
$events .='<div class="row">';
$events .='<div class="col-sm-8">';
$events .='</div>';
$events .='<div class="col-sm-4">';
$events .='<div class="row">';

/*$events .='<div class="col-sm-4">';
if($ismatch){
$events .='<span class="tags tagslarge ml-3 fs-14">Today<img class="ml-1 blackcross" src="'.get_template_directory_uri().'/images/blackcross.png"></span>';
}
$events .='</div>';*/

$events .='<div class="col-6">
<ul class="filter-dropdown clearfix">
    <li><div class="dropdown pl-0">
      <button class="btn btn-secondary black-txt dropdown-toggle topic-btn" type="button">'.$sel_topic_val.'</button>
      <div class="dropdown-menu topic-show">'.$event_categoryname.'
      </div>
    </div></li>
  </ul>';
  $events .='<input type="hidden" name="topics" value="'.$_GET['topics'].'">';
$events .='</div>';

$events .='<div class="col-6">';
$events .='<ul class="filter-dropdown clearfix">
            <li><div class="dropdown pl-0">
              <button class="btn btn-secondary black-txt dropdown-toggle business-btn" type="button">'.$sel_business_val.'</button>
              <div class="dropdown-menu business-show">
                '.$event_business.'
              </div>
            </div></li>
          </ul>';
$events .='<input type="hidden" name="event_business" value="'.$event_business_val.'">';
$events .='</div>';


$events .='</div>';
$events .='</div>';
$events .='</div>';

/*$events .='<div class="event-topfilter-value">';
$events .='<div class="row">';
$events .='<div class="col-sm-12">';
$events .='<span class="subheadingitem fs-12">Selected:</span>';
$events .='<span class="selected_items"><span class="red-tag tags ml-3">Preparation <img class="ml-1" src="images/close_red.png"></span><span class="red-tag tags ml-3">Global Ed<img class="ml-1" src="images/close_red.png"></span></span>';
$events .='<a href="#" class="clear-btn ml-3"><span >CLEAR ALL</span></a>';
$events .='</div>';
$events .='</div>';
$events .='</div>';*/

$events .='</div>';


/** Filter end **/

/** event content start **/
$events .='<div class="col-sm-12 eventers-section p-0">';
$events .='<div class="row" id="ajax-posts">';
$events .= $event_content;
$events .='</div>';
$events .='</div>';
/** event content end **/

$exclude_post = rtrim($exclude_id, ',');
$events .='<input type="hidden" name="exclude_post" value="'.$exclude_post.'">';

$max_pagenum = $event_query->max_num_pages;

if ( $max_pagenum > 1 ) {

$events .='<div class="text-center w-100 m-t-30 loadmore">';
$events .='<a id="more_posts" class="eventbtn text-uppercase text-decoration-none d-block mx-auto">Load more events<span><img src="'.get_template_directory_uri().'/images/down-white.png" alt="" ></span></a>';
$events .='</div>';

}

$events .='</div>';
$events .='</div>';
$events .='</div>';
$events .='</div>';
$events .='</div>';
$events .='</div>';
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

$display_feature_event .='<div class="aboutblock position-relative event-feature">';
$display_feature_event .='<div class=" position-absolute"></div>';
$display_feature_event .='<div class="container ">';
$display_feature_event .='<div class="row ">';
$display_feature_event .='<div class="col-md-3">';
$display_feature_event .='<div class="aboutblock__container">';
$display_feature_event .='<div class="boldheading">';
$display_feature_event .= $title.'</div>';
$display_feature_event .='<div class="whitepath"></div>';
$display_feature_event .='</div>';
$display_feature_event .='</div>';

if($feature_query->have_posts()) :
  while ($feature_query->have_posts()) : $feature_query->the_post();

	 $feature_id = get_the_ID();
	 $feature_val = get_post_meta( $feature_id, '_featured', true );



			$feature_img = wp_get_attachment_image_src( get_post_thumbnail_id($feature_id), 'medium' );
	        $fevent_addr = get_post_meta( $feature_id, '_event_address', true );
	        $fevent_stime = get_post_meta( $feature_id, '_event_start_time', true );
	        $fevent_etime = get_post_meta( $feature_id, '_event_end_time', true );
			$fevent_sdate = get_post_meta( $feature_id, '_event_start_date', true );
	        $post_categories = get_the_terms( $feature_id, 'event_categories' );

			$display_feature_event .='<div class="col-sm-3">';
			$display_feature_event .='<div class="course-list">';
			$display_feature_event .='<div class="img-sec">';
			$display_feature_event .='<a href="'.get_permalink( $feature_id ).'"><img src="'.$feature_img[0].'" alt="course-img" class="img-fluid"></a>';
			//$display_feature_event .='<a class="addfav" href="#"><img src="'.get_template_directory_uri().'/images/add-fav.png" alt="course-img" class="img-fluid"></a>';
			$display_feature_event .='</div>';
			$display_feature_event .='<div class="row">';
			$display_feature_event .='<div class="col-sm-12">';
			$display_feature_event .='<div class="contentslider">';
			$display_feature_event .='<span class="taglabel">'.$post_categories[0]->name.'</span>';
			$display_feature_event .='<div class="formheading pb-2"><a href="'.get_permalink( $feature_id ).'">'.get_the_title($feature_id).'</a></div>';
			$display_feature_event .='<div class="officename pb-1">'.$fevent_addr.'</div>';
			//$display_feature_event .='<div class="datetime">'.$fevent_stime.' - '.$fevent_etime.'</div>';
			$display_feature_event .='<div class="datetime">'.date('d-m-Y',strtotime($fevent_sdate)).'</div>';
			$display_feature_event .='</div>';
			$display_feature_event .='</div>';
			$display_feature_event .='</div>';
			$display_feature_event .='</div>';
			$display_feature_event .='</div>';

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

$displayTopicsName .='<div class="about-signup pb-3">';
$displayTopicsName .='<div class="text-center">';
$displayTopicsName .='<div class="boldheading">'.$title.'</div>';
$displayTopicsName .='<div class="path"></div>';
$displayTopicsName .='</div>';
$displayTopicsName .='<div class="container">';
$displayTopicsName .='<div class="row justify-content-center">';
$displayTopicsName .='<div class="col-sm-12">';
$displayTopicsName .='<div class="row">';
$displayTopicsName .='<div class="text-center tag-section event-popular-topic">';

// Check if any term exists
if ( ! empty( $terms ) && is_array( $terms ) ) {
    // Run a loop and print them all term_id slug
	$j = 1;
    foreach ( $terms as $term ) {

    	 $topic_cls = get_term_meta( $term->term_id, 'topics_class_name', true );
		 $displayTopicsName .='<a href="#" id="'.$term->name.'"><span class="'.$topic_cls.' tags">'.$term->name.'</span></a>';

		$j++;
    }
}

$displayTopicsName .='</div>';
$displayTopicsName .='</div>';
$displayTopicsName .='</div>';
$displayTopicsName .='</div>';
$displayTopicsName .='</div>';
$displayTopicsName .='</div>';

return $displayTopicsName;
}
add_shortcode('popular_topics', 'get_popular_topics');

?>
