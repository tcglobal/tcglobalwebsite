<?php

require get_template_directory() . '/theme-options.php'; 
require get_template_directory() . '/includes/tc_global_shortcode.php';

// register css & js files
function custom_theme_assets() {
	// all styles
    //wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 20141119 );
    //wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.css');
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css');
    //wp_enqueue_style( 'select2', get_stylesheet_directory_uri() .'/css/select2.min.css');
    // all scripts
    //wp_enqueue_script( 'slim-min-js', 'https://code.jquery.com/jquery-3.3.1.slim.min.js' );
   	wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), NULL, true );
    //wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.js',array('jquery'), NULL, true);
    wp_enqueue_script( 'slick-min-js', get_template_directory_uri() . '/js/slick.min.js',array('jquery'), NULL, true);
   wp_enqueue_script( 'select2-js', get_template_directory_uri() .'/js/select2.min.js', array('jquery'), NULL, true );
   wp_enqueue_script( 'jquery-twbs-pagination-js', get_template_directory_uri() . '/js/jquery.twbsPagination.js', array('jquery'), NULL, true );
     
   //wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '20120206', true );

    wp_enqueue_script( 'custom_js', get_template_directory_uri().'/js/custom.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'custom_js', 'ajax_posts', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'insight-load-more.js', get_template_directory_uri().'/js/insight_load_more.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'insight-load-more.js', 'Myajax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'job-load-more.js', get_template_directory_uri().'/js/job_load_more.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'job-load-more.js', 'Jobajax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

   	wp_enqueue_script( 'location-list.js', get_template_directory_uri().'/js/location_detail.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'location-list.js', 'ajax_loc', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'address-list.js', get_template_directory_uri().'/js/onload_map.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'address-list.js', 'ajax_addr', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'meeting-location.js', get_template_directory_uri().'/js/meeting_map.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'meeting-location.js', 'meeting_ajax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'schedule.js', get_template_directory_uri().'/js/schedule_location_detail.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'schedule.js', 'schedule_map', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'course.js', get_template_directory_uri().'/js/courselist.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'course.js', 'area_posts', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

     wp_enqueue_script( 'usermeeting_location.js', get_template_directory_uri().'/js/usermeeting_location.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'usermeeting_location.js', 'Userloc', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));
    wp_enqueue_script( 'userchoice_location.js', get_template_directory_uri().'/js/userchoice_location.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'userchoice_location.js', 'UserChoice', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

}
add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );

function thisisonlyatest() {
      wp_enqueue_script('jquery-ui-datepicker');
      //wp_enqueue_style('jquery-ui-datepicker','https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/redmond/jquery-ui.min.css' );
   }
add_action("wp_enqueue_scripts","thisisonlyatest");


/**
 * Register widget area.
 */
function tcglobal_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'tcglobal' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer image', 'tcglobal' ),
			'id'            => 'footer_image',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Find us on', 'tcglobal' ),
			'id'            => 'find_us',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'tcglobal' ),
			'id'            => 'footer-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'tcglobal' ),
			'id'            => 'footer-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'tcglobal' ),
			'id'            => 'footer-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'tcglobal' ),
			'id'            => 'footer-4',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer 5', 'tcglobal' ),
			'id'            => 'footer-5',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer 6', 'tcglobal' ),
			'id'            => 'footer-6',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Terms & Conditions', 'tcglobal' ),
			'id'            => 'terms_condition',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tcglobal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tcglobal_widgets_init' );


if ( ! function_exists( 'twentynineteen_setup' ) ) :
function tcglobal_setup() {

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tcglobal' ),
			'mobile' => __( 'Mobile Menu', 'tcglobal' ),
			'footer' => __( 'Footer Menu', 'tcglobal' ),
		)
	);
}
endif;
add_action( 'after_setup_theme', 'tcglobal_setup' );

function add_additional_class_on_li($classes, $item, $args) {
    if($args->add_li_class) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);



// page section title custom post 
function heading() {
    $args = array(
            'label'                => 'Heading Section',
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'hierarchical'         => false,
            'query_var'            => true,
            'rewrite'              => array('slug' => 'heading', 'with_front'=> false),
            'capability_type'      => 'post',
            'has_archive'          => false,     
            'menu_icon'            => 'dashicons-video-alt',
            'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'trackbacks',
                    'custom-fields',
                    'comments',
                    'revisions',
                    'thumbnail',
                    'author',
                    'page-attributes',)
        );
    register_post_type( 'heading', $args );
}
add_action( 'init', 'heading' );

/* Remove span on contact form 7 */
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});

// Prevent WP from adding <p> tags on pages
function disable_wp_auto_p( $content ) {
  if ( is_singular( 'page' ) ) {
    remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_excerpt', 'wpautop' );
  }
  return $content;
}
add_filter( 'the_content', 'disable_wp_auto_p', 0 );

/*add category option to timeline post */
add_action( 'init', 'tc_add_category_to_timeline' );
function tc_add_category_to_timeline() {
	$post_name = "te_announcements";
	register_taxonomy("timeline_cat", array($post_name), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Categories", "rewrite" => array( 'slug' => 'timeline_cat', 'with_front'=> false )));
	register_taxonomy_for_object_type( 'timeline_cat', 'te_announcements' );
}

add_action( 'init', 'add_category_to_events' );
function add_category_to_events() {
	$post_name = "event_listing";
	register_taxonomy("event_categories", array($post_name), array("hierarchical" => true, "label" => "Topics", "singular_label" => "Category", "rewrite" => array( 'slug' => 'event_categories', 'with_front'=> false )));
	register_taxonomy_for_object_type( 'event_categories', 'event_listing' );
}

add_action( 'init', 'add_category_to_solution' );
function add_category_to_solution() {
	$post_type = "solutions";
	register_taxonomy("solution-cat", array($post_type), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Categories", "rewrite" => array( 'slug' => 'solution-cat', 'with_front'=> false )));
	register_taxonomy_for_object_type( 'solution-cat', 'solutions' );
}

add_action( 'init', 'add_category_to_impact' );
function add_category_to_impact() {
	$post_name = "our_imapct";
	register_taxonomy("impact-cat", array($post_name), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Categories", "rewrite" => array( 'slug' => 'impact-cat', 'with_front'=> false )));
	register_taxonomy_for_object_type( 'impact-cat', 'our_imapct' );
}

add_action( 'init', 'add_category_to_service' );
function add_category_to_service() {
	$post_name = "service-box";
	register_taxonomy("service-cat", array($post_name), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Categories", "rewrite" => array( 'slug' => 'service-cat', 'with_front'=> false )));
	register_taxonomy_for_object_type( 'service-cat', 'service-box' );
}

add_action( 'init', 'add_category_to_global_section' );
function add_category_to_global_section() {
	$post_name = "citizenship";
	register_taxonomy("global-cat", array($post_name), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Categories", "rewrite" => array( 'slug' => 'global-cat', 'with_front'=> false )));
	register_taxonomy_for_object_type( 'global-cat', 'citizenship' );
}


/** events page load more post function **/
function more_post_ajax(){

	$event_res = array();
	header('Content-Type: application/json');

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 100;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    $column =  $_POST['col'];
    $event_title = $_POST['key'];
    $event_loc = $_POST["location"];

    $eventDate = $_POST["event_date"];
    $event_date_val = date("Y-m-d", strtotime($eventDate)); // eg: 2019-09-23

    $event_topic = $_POST["topic"];
    $event_business_val = $_POST["business"];

    $postID = $_POST["excludePost"];

     $str_arr = explode (",", $postID);  

     if( empty($event_topic) && empty($event_business_val) ){

	$event_query = new WP_Query(
					array('post_type' => 'event_listing',
							'post__not_in' => $str_arr,
							'order' => 'DESC',
							'posts_per_page' => $ppp,
							'paged'    => $page,
							"s" => $event_title,
							
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key' => '_event_location',
										'value' => $event_loc,
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
							'post__not_in' => $str_arr,
							'order' => 'DESC',
							'posts_per_page' => $ppp,
							'paged'    => $page,
							"s" => $event_title,
							
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key' => '_event_location',
										'value' => $event_loc,
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
				                        'terms' => $event_topic
				                    )
				                 ) 
						) 
				);

}

else if( empty($topic_val)  && !empty($event_business_val) ){

$event_query = new WP_Query(
					array('post_type' => 'event_listing',
							'post__not_in' => $str_arr,
							'order' => 'DESC',
							'posts_per_page' => $ppp,
							'paged'    => $page,
							"s" => $event_title,
							
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key' => '_event_location',
										'value' => $event_loc,
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
							'post__not_in' => $str_arr,
							'order' => 'DESC',
							'posts_per_page' => $ppp,
							'paged'    => $page,
							"s" => $event_title,
							
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key' => '_event_location',
										'value' => $event_loc,
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
				                        'terms' => $event_topic
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


    

    $out = '';

    
	if ($event_query -> have_posts()) :  while ($event_query -> have_posts()) : $event_query -> the_post();
       

		$event_id = get_the_ID();
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($event_id), 'large' );
        $event_addr = get_post_meta( $event_id, '_event_address', true );
        $event_stime = get_post_meta( $event_id, '_event_start_time', true );
        $event_etime = get_post_meta( $event_id, '_event_end_time', true );
        $event_category = get_the_terms( $event_id, 'event_categories' );
       
        $out .='<div class="'.$column.' three_column m-b-30">';
        $out .='<div class="position-relative">';
        $out .='<img src="'.$img[0].'" alt="" class="img-fluid">';
        //$out .='<a class="addfav" href=""><img src="'.get_template_directory_uri().'/images/add-fav.png" alt="course-img" class="img-fluid"></a>';
        $out .='</div>';
        $out .='<div class="contentslider">';
        $out .='<span class="taglabel">'.$event_category[0]->name.'</span>';
        $out .='<h3 class="fs-20"><a href="'.get_permalink( $event_id ).'">'.get_the_title($event_id).'</a></h3>';
        $out .='<h4 class="fs-12">'.$event_addr.'</h4>';
        $out .='<div class="datetime mb-1">'.$event_stime.' - '.$event_etime.'</div>';
        $out .='</div>';
        $out .='</div>';

    endwhile;
    endif;

	$event_res['result'] = $out;
    $event_res['count'] = $event_query->max_num_pages;
    echo json_encode($event_res); // return value of $result

	wp_reset_postdata();
    die();

}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


/** insight load more post function **/
function load_post_ajax(){

	global $post, $wpdb;

	$insight_res = array();
	header('Content-Type: application/json');

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

	$column =  $_POST['col'];

    //$search_key = $_POST['key'];
    /** replace apostrophe (’) with single quote(') in search key **/
    $get_key = $_POST['key'];
  	$search_key = str_replace('’', "'", $get_key);
  	
    $insight_type = $_POST["type"];
	$insight_topic = $_POST["insight_topic"];
    $insight_business = $_POST["insight_business"]; 

    $postID = $_POST["excludeInsightPost"];
	$exclude_arr = explode (",", $postID);  

    $more_data = '';

    
      $relation = 'OR';

      if(!empty($insight_type) && !empty($insight_topic))
      {
        $relation = 'AND';
      }
      if(!empty($insight_topic) && !empty($insight_business))
      {
        $relation = 'AND';
      }
      if(!empty($insight_type) && !empty($insight_business) )
      {
        $relation = 'AND';
      }

      elseif(!empty($insight_type) && !empty($insight_topic) && !empty($insight_business))
      {
        $relation = 'AND';
      }

   $insight_tax_query = array('relation' => $relation);
   $insight_meta_query = array('relation' => $relation);    

  if(!empty($insight_type) && $insight_type != "All" ) 
    {
      
        $insight_tax_query[] = array(

                'taxonomy' => 'post_tag',
                'field' => 'name',
                'terms' => $insight_type,  
                'operator' => 'IN',
          );    
    }

    if(!empty($insight_topic) && $insight_topic != "All")
    {

      $insight_tax_query[] = array(
                
                    'taxonomy' => 'category',
                    'field' => 'name',
                    'terms' => $insight_topic,
                    'operator' => 'IN',
          );  
    }

    if(!empty($insight_business) && $insight_business != "All" )
    {
        $insight_meta_query[] = array(
                
                'key' => 'choose_business',
                'value' => $insight_business,
                'compare' => 'LIKE'
          );  
    }       

    $args = array(
        'post_type' => 'post',
        'post__not_in' => $exclude_arr,
        'order' => 'DESC',
        'posts_per_page' => $ppp,
		"s" => $search_key,
		'tax_query' => $insight_tax_query,
      	'meta_query' => $insight_meta_query,
      	'paged'    => $page
    );

	// Instantiate custom query
    $custom_query = new WP_Query( $args );

	if ($custom_query -> have_posts()) :  while ($custom_query -> have_posts()) : $custom_query -> the_post();
       
		$insignt_id = get_the_ID();
        $ex_insignt_id .=$insignt_id.',';
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($insignt_id), 'full' );
        $tag = get_the_tags($insignt_id);

		$more_data .='<div class="'.$column.' three_column pb-3 mb-4">
              <div class="row">
                <div class="col-5 position-relative pl-0">
                  <a href="'.get_permalink( $insignt_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid w-100"></a>
                </div>
                <div class="col-5 p-0">
                  <span class="taglabel">'.$tag[0]->name.'</span>
                  <div class="formheading pb-2 mt-2"><a href="'.get_permalink( $insignt_id ).'">'.get_the_title($insignt_id).'</a></div>
                  <div class="datetime float-left">'.get_the_date('d.m.Y').'</div>
                </div>
                <div class="col-2 pr-0">
                  
                </div>
              </div>
            </div>';
	endwhile;
    endif;
    
    $insight_res['result'] = $more_data;
    $insight_res['count'] = $custom_query->max_num_pages;
    echo json_encode($insight_res); // return value of $result

	wp_reset_postdata();
    die();

}
add_action('wp_ajax_load_post_ajax', 'load_post_ajax');
add_action('wp_ajax_nopriv_load_post_ajax', 'load_post_ajax'); 




/** add this to your function.php child theme to remove ugly shortcode on excerpt */
 
if(!function_exists('remove_vc_from_excerpt'))  {
  function remove_vc_from_excerpt( $excerpt ) {
    $patterns = "/\[[\/]?vc_[^\]]*\]/";
    $replacements = "";
    return preg_replace($patterns, $replacements, $excerpt);
  }
}
 
/** * Original elision function mod by Paolo Rudelli */
 
if(!function_exists('get_kc_excerpt')) {
 
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined below */
 
  function get_kc_excerpt($excerpt_length = 20) {
 
    global $word_count, $post;
 
    $word_count = isset($word_count) && $word_count != "" ? $word_count : $excerpt_length;
 
    $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content); $clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
 
    /** add by PR */
 
    $clean_excerpt = strip_shortcodes(remove_vc_from_excerpt($clean_excerpt));
 
    /** end PR mod */
 
    $excerpt_word_array = explode (' ',$clean_excerpt);
 
    $excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
 
    $excerpt = implode (' ', $excerpt_word_array); 
    return $excerpt;

    }
 
}
/*
 * Set post views count using post meta
 */
function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}

/*
 * Set event views count using post meta
 */
function setEventViews($postID) {
    $countKey = 'event_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}



/** Get Ajax location address **/
function fetch_userLocation(){

	global $post, $wpdb;
	header('Content-Type: application/json');

	$userlocation = array();
	$data = '';

	$outputLocationcode = '';
	//$i =0;

	$addrpostid = $_REQUEST['locationID'];

		$args = array(
		    'post_type'         => 'location',
		    'post_status'       => 'publish',
		    'tax_query'         => array(
		        array(
		            'taxonomy'  => 'loc_categories',
		            'field'     => 'id',
		            'terms'     => $addrpostid,
		        )
		    )
		);
	
	$query = new WP_Query($args);

if($query->have_posts()) : 

    while ($query->have_posts()) : $query->the_post(); 

    //$title = '<h4>'.get_the_title(get_the_ID()).'</h4>';

    $title = '<h4 onclick="google.maps.event.trigger(gmarkers[\'' . get_the_ID() . '\'],\'click\');" class="marker-link show-link" data-markerid="' . get_the_ID() . '">'.get_the_title().'</h4>';

    $addr = get_post_meta( get_the_ID(), 'wpsl_address', true );
    $city = get_post_meta( get_the_ID(), 'wpsl_city', true ); 
    $state = get_post_meta( get_the_ID(), 'wpsl_state', true );
    $zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );

    $data = $title.'<p>'.$addr.',<br> '.$city.',<br>'.$state.' '.$zip.'</p>';

    //$i++;

   /** location map code **/
	$location_name = get_the_title(get_the_ID());
	$wpsl_latitude = get_post_meta( get_the_ID(), 'wpsl_latitude', true );
	$wpsl_longitude = get_post_meta( get_the_ID(), 'wpsl_longitude', true );
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	$wpsl_address = get_post_meta( get_the_ID(), 'wpsl_address', true );
	$wpsl_state = get_post_meta(get_the_ID(), 'wpsl_state', true );
	$wpsl_city = get_post_meta( get_the_ID(), 'wpsl_city', true );
	$wpsl_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );
	$location_email_address = get_post_meta( get_the_ID(), 'location_email_address', true );
	$location_fax = get_post_meta( get_the_ID(), 'location_fax', true );
	$wpsl_phone = get_post_meta( get_the_ID(), 'wpsl_phone', true );
	$wpsl_address_two = get_post_meta( get_the_ID(), 'wpsl_address_two', true );

	$outputLocationcode .= "['".get_the_ID()."','<div class=\"map-pointer-detail\" style=\"position:unset\"><img class=\"img-fluid\" src=\"".$thumb[0]."\" width=\"198\" /><h3>".$location_name."</h3><p>".$wpsl_address.", <br>".$wpsl_state.",<br>".$wpsl_city." - ".$wpsl_zip.".</p></div>', ".$wpsl_latitude.", ".$wpsl_longitude.", '<h4 onclick=google.maps.event.trigger(gmarkers[\'". get_the_ID()."\'],\'click\');>".get_the_title()."</h4><p>".$addr.",<br>".$city.",<br>".$state." - ".$zip."','".get_the_title()."', 4],";
endwhile;
else:
	$data = '<p>Result not found.</p>';
 endif;


$outputLocation .= '<div class="locations-mapplace-center map-height">
          			<div id="google-map-display" style="width: 100%; height: 100%;"></div>
            		</div> <script type="text/javascript">';

	$outputLocation .= '
	var locations = [
		'.rtrim($outputLocationcode,",").'
		];
	';
	$outputLocation .= '

	var mapStyles = [{
    "featureType": "landscape",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 65
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "poi",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 51
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.highway",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.arterial",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 30
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "road.local",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 40
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "transit",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "administrative.province",
    "stylers": [{
      "visibility": "on"
    }]
  }, {
    "featureType": "water",
    "elementType": "labels",
    "stylers": [{
      "visibility": "on"
    }, {
      "lightness": -25
    }, {
      "saturation": -100
    }]
  }, {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [{
      "hue": "#ffff00"
    }, {
      "lightness": -25
    }, {
      "saturation": -97
    }]
  }];
	var markers = new Array();
	gmarkers = [];
	var map = new google.maps.Map(document.getElementById(\'google-map-display\'), {
      zoom: 6,
	  styles: mapStyles,
      center: new google.maps.LatLng('.$wpsl_latitude.','.$wpsl_longitude.'),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  mapTypeControl: false,
	  streetViewControl: false,
	  zoomControlOptions: {
        	position: google.maps.ControlPosition.TOP_LEFT
    	},
	  fullscreenControl: false
    });
	
	var bounds  = new google.maps.LatLngBounds();

    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
	  	// Add marker to markers array
		gmarkers[locations[i][0]] =
    createMarker(new google.maps.LatLng(locations[i][2], locations[i][3]), locations[i][1], locations[i][4], locations[i][5]);

    var loc = new google.maps.LatLng(gmarkers[locations[i][0]].position.lat(), gmarkers[locations[i][0]].position.lng());
	bounds.extend(loc);

    }

    if(locations.length>1){
    	map.fitBounds(bounds);
		map.panToBounds(bounds); 
    }

	function createMarker(latlng, html, useraddrchoice, branchaddr) {
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			zoom:9,
			icon: \''.get_template_directory_uri().'/images/map-pointer-icon-sm.png\'
		});

		google.maps.event.addListener(marker, \'click\', function() {
			infowindow.setContent(html);
			infowindow.open(map, marker);

			$("#schjourney_loc").val(branchaddr);
			$("#journey_loc").val(branchaddr);
			$("#usermeetingplace").val(branchaddr);

			$("#current_addr").html(useraddrchoice);
			$("#meeting_addr").html(useraddrchoice);
			$("#schedulemeeting_addr").html(useraddrchoice);
			$(".user-location-detail").html(useraddrchoice);

		});
		return marker;
	}

	jQuery(document).ready(function($){
	 $(".marker-link").on(\'click\', function () {
		window.scrollTo($(\'#google-map-display\'), 1000);
    });

		var sel = $(\'.sel\'),
		txt = $(\'.txt\'),
		options = $(\'.options\');

		sel.click(function (e) {
			e.stopPropagation();
			options.show();
		});

		$(\'body\').click(function (e) {
			options.hide();
		});

		options.children(\'div\').click(function (e) {
			e.stopPropagation();
			txt.html(\'<span>\'+$(this).text()+\'</span> <img src="'.get_template_directory_uri().'/images/dropdown.png" alt=""  data-filter="all" /> \');
			$(this).addClass(\'selected\').siblings(\'div\').removeClass(\'selected\');
			options.hide();
		});


		var $mediaElements = $(\'.filterDiv\');

		$(\'.filter_link\').click(function(e){
			e.preventDefault();
			// get the category from the attribute
			var filterVal = $(this).data(\'filter\');
			$(\'#emptyResult\').hide()
			if(filterVal === \'all\'){
			  $mediaElements.show();
			}else{
			   // hide all then filter the ones to show
			   $mediaElements.hide().filter(\'.\' + filterVal).show();

			   var countDivVisible = $(\'.filterDiv:visible\').size()
			   if(countDivVisible==0)
			   {
			   		$(\'#emptyResult\').show()
			   }

			}
		});

		$(".toggle").click(function() {
		$($(\'.divcontainer\')[$(this).index(".toggle")]).toggle(\'fast\');
	});


	});

</script>';
	
	$userlocation['branch'] = $location_name;
	$userlocation['result'] = $data;
	$userlocation['map'] = $outputLocation;

	echo json_encode($userlocation); // return value of $result
    wp_reset_postdata();
    die();

}

add_action('wp_ajax_nopriv_fetch_userLocation', 'fetch_userLocation'); 
add_action('wp_ajax_fetch_userLocation', 'fetch_userLocation');

/** Get current user location address **/
function userLocationAddress(){

	global $post, $wpdb;

	$userAddress = array();
	$dynamicaddr = '';

	$bool = 0;

	header('Content-Type: application/json');

	$addr = $_REQUEST['locality'];

	$locationCats = get_terms(
      array(
        'taxonomy'   => 'loc_categories',
        'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC', // or ASC
        'hierarchical'  => 1,
        'parent'        => 0, // get top level categories
      )
    );

    foreach ( $locationCats as $locationCat )
    {

      $sub_categories = get_terms(
            array(
              'taxonomy'   => 'loc_categories',
              'hide_empty' => false,
              'orderby' => 'term_id',
              'order' => 'ASC', // or ASC
              'hierarchical'  => 1,
              'parent'        => $locationCat->term_id, // get child categories
            )
          );

  foreach ( $sub_categories as $sub_category ){

		$addr_id = $sub_category->term_id;
		$args = array(
        'post_type'         => 'location',
        'post_status'       => 'publish',
        'tax_query'         => array(
            array(
                'taxonomy'  => 'loc_categories',
                'field'     => 'id',
                'terms'     => $addr_id,
            )
        )
    );

$query = new WP_Query($args);

if($query->have_posts()) : 

    while ($query->have_posts()) : $query->the_post();

     $city = get_post_meta( get_the_ID(), 'wpsl_city', true ); 

   if($addr == $city){

   	$bool = 1;

    $title = '<h4 onclick="google.maps.event.trigger(gmarkers[\'' . get_the_ID() . '\'],\'click\');" class="marker-link show-link" data-markerid="' . get_the_ID() . '">'.get_the_title().'</h4>';

    $curloc = get_post_meta( get_the_ID(), 'wpsl_address', true );
    $curcity = get_post_meta( get_the_ID(), 'wpsl_city', true ); 
    $curstate = get_post_meta( get_the_ID(), 'wpsl_state', true );
    $curzip = get_post_meta( get_the_ID(), 'wpsl_zip', true );

    $dynamicaddr .= $title.'<p>'.$curloc.',<br> '.$curcity.',<br>'.$curstate.' '.$curzip.'</p>';

   $location_name = get_the_title(get_the_ID());

  $wpsl_latitude = get_post_meta( get_the_ID(), 'wpsl_latitude', true );
  $wpsl_longitude = get_post_meta( get_the_ID(), 'wpsl_longitude', true );

  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
  $wpsl_address = get_post_meta( get_the_ID(), 'wpsl_address', true );
  $wpsl_state = get_post_meta(get_the_ID(), 'wpsl_state', true );
  $wpsl_city = get_post_meta( get_the_ID(), 'wpsl_city', true );
  $wpsl_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );
  $location_email_address = get_post_meta( get_the_ID(), 'location_email_address', true );
  $location_fax = get_post_meta( get_the_ID(), 'location_fax', true );
  $wpsl_phone = get_post_meta( get_the_ID(), 'wpsl_phone', true );
  $wpsl_address_two = get_post_meta( get_the_ID(), 'wpsl_address_two', true );

   $outputLocationcode .= "['".get_the_ID()."','<div class=\"map-pointer-detail\" style=\"position:unset\"><img class=\"img-fluid\" src=\"".$thumb[0]."\" width=\"198\" /><h3>".$location_name."</h3><p>".$wpsl_address.", <br>".$wpsl_state.",<br>".$wpsl_city." - ".$wpsl_zip.".</p></div>', ".$wpsl_latitude.", ".$wpsl_longitude.", '<h4 onclick=google.maps.event.trigger(gmarkers[\'". get_the_ID()."\'],\'click\');>".get_the_title()."</h4><p>".$curloc.",<br>".$curcity.",<br>".$curstate." - ".$curzip."', 4],";

   }

   endwhile;
	endif;

    }

  }

 $outputLocation .= '<div class="locations-mapplace-center map-height">
          			<div id="current-map-display" style="width: 100%; height: 100%;"></div>
            		</div> <script type="text/javascript">';

	$outputLocation .= '
	var locations = [
		'.rtrim($outputLocationcode,",").'
		];
	';
	$outputLocation .= '

	var mapStyles = [{
    "featureType": "landscape",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 65
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "poi",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 51
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.highway",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.arterial",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 30
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "road.local",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 40
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "transit",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "administrative.province",
    "stylers": [{
      "visibility": "on"
    }]
  }, {
    "featureType": "water",
    "elementType": "labels",
    "stylers": [{
      "visibility": "on"
    }, {
      "lightness": -25
    }, {
      "saturation": -100
    }]
  }, {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [{
      "hue": "#ffff00"
    }, {
      "lightness": -25
    }, {
      "saturation": -97
    }]
  }];
	var markers = new Array();
	gmarkers = [];
	var map = new google.maps.Map(document.getElementById(\'current-map-display\'), {
      zoom: 6,
	  styles: mapStyles,
      center: new google.maps.LatLng('.$wpsl_latitude.','.$wpsl_longitude.'),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  mapTypeControl: false,
	  streetViewControl: false,
	  zoomControlOptions: {
        	position: google.maps.ControlPosition.TOP_LEFT
    	},
	  fullscreenControl: false
    });

	var bounds  = new google.maps.LatLngBounds();

    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
	  	// Add marker to markers array
		gmarkers[locations[i][0]] =
    createMarker(new google.maps.LatLng(locations[i][2], locations[i][3]), locations[i][1], locations[i][4]);

    var loc = new google.maps.LatLng(gmarkers[locations[i][0]].position.lat(), gmarkers[locations[i][0]].position.lng());
	bounds.extend(loc);

    }

    if(locations.length>1){
    	map.fitBounds(bounds);
		map.panToBounds(bounds); 
    }

	function createMarker(latlng, html, useraddrchoice) {
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			zoom:9,
			icon: \''.get_template_directory_uri().'/images/map-pointer-icon-sm.png\'
		});

		google.maps.event.addListener(marker, \'click\', function() {
			infowindow.setContent(html);
			infowindow.open(map, marker);
			$("#current_addr").html(useraddrchoice);
		});
		return marker;
	}

	jQuery(document).ready(function($){
	 $(".marker-link").on(\'click\', function () {
		window.scrollTo($(\'#current-map-display\'), 1000);
    });

		var sel = $(\'.sel\'),
		txt = $(\'.txt\'),
		options = $(\'.options\');

		sel.click(function (e) {
			e.stopPropagation();
			options.show();
		});

		$(\'body\').click(function (e) {
			options.hide();
		});

		options.children(\'div\').click(function (e) {
			e.stopPropagation();
			txt.html(\'<span>\'+$(this).text()+\'</span> <img src="'.get_template_directory_uri().'/images/dropdown.png" alt=""  data-filter="all" /> \');
			$(this).addClass(\'selected\').siblings(\'div\').removeClass(\'selected\');
			options.hide();
		});


		var $mediaElements = $(\'.filterDiv\');

		$(\'.filter_link\').click(function(e){
			e.preventDefault();
			// get the category from the attribute
			var filterVal = $(this).data(\'filter\');
			$(\'#emptyResult\').hide()
			if(filterVal === \'all\'){
			  $mediaElements.show();
			}else{
			   // hide all then filter the ones to show
			   $mediaElements.hide().filter(\'.\' + filterVal).show();

			   var countDivVisible = $(\'.filterDiv:visible\').size()
			   if(countDivVisible==0)
			   {
			   		$(\'#emptyResult\').show()
			   }

			}
		});

		$(".toggle").click(function() {
		$($(\'.divcontainer\')[$(this).index(".toggle")]).toggle(\'fast\');
	});


	});

</script>';

	$userAddress['result'] = $dynamicaddr;

    $userAddress['map'] = $outputLocation;

	echo json_encode($userAddress); // return value of $result
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_nopriv_userLocationAddress', 'userLocationAddress'); 
add_action('wp_ajax_userLocationAddress', 'userLocationAddress');


/** Get current user schedule address **/
function scheduleLocationAddress(){

	global $post, $wpdb;

	$Address = array();

	$curaddress = '';
	$scheduleLocationcode = '';
	$scheduleoutputLocation = '';

	header('Content-Type: application/json');

	$scheduleaddr = $_REQUEST['place'];
	$meetinglocationCats = get_terms(
      array(
        'taxonomy'   => 'loc_categories',
        'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC', // or ASC
        'hierarchical'  => 1,
        'parent'        => 0, // get top level categories
      )
    );

    foreach ( $meetinglocationCats as $location )
    {

      $sub_categories = get_terms(
            array(
              'taxonomy'   => 'loc_categories',
              'hide_empty' => false,
              'orderby' => 'term_id',
              'order' => 'ASC', // or ASC
              'hierarchical'  => 1,
              'parent'        => $location->term_id, // get child categories
            )
          );

      foreach ( $sub_categories as $sub_category ){

		$scheduleID = $sub_category->term_id;
		$args = array(
        'post_type'         => 'location',
        'post_status'       => 'publish',
        'tax_query'         => array(
            array(
                'taxonomy'  => 'loc_categories',
                'field'     => 'id',
                'terms'     => $scheduleID,
            )
        )
    );

$query = new WP_Query($args);

if($query->have_posts()) : 

    while ($query->have_posts()) : $query->the_post();

    $meetingcity = get_post_meta( get_the_ID(), 'wpsl_city', true ); 

   if($scheduleaddr == $meetingcity){

	$title = '<h4 onclick="google.maps.event.trigger(gmarkers[\'' . get_the_ID() . '\'],\'click\');" class="marker-link show-link" data-markerid="' . get_the_ID() . '">'.get_the_title().'</h4>';

    $meeting_addr = get_post_meta( get_the_ID(), 'wpsl_address', true );
    $meeting_city = get_post_meta( get_the_ID(), 'wpsl_city', true ); 
    $meeting_state = get_post_meta( get_the_ID(), 'wpsl_state', true );
    $meeting_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );

    $curaddress .= $title.'<p>'.$meeting_addr.',<br> '.$meeting_city.',<br>'.$meeting_state.' '.$meeting_zip.'</p>';

   /** location map code **/
  $location_name = get_the_title(get_the_ID());

  $wpsl_latitude = get_post_meta( get_the_ID(), 'wpsl_latitude', true );
  $wpsl_longitude = get_post_meta( get_the_ID(), 'wpsl_longitude', true );

  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
  $wpsl_address = get_post_meta( get_the_ID(), 'wpsl_address', true );
  $wpsl_state = get_post_meta(get_the_ID(), 'wpsl_state', true );
  $wpsl_city = get_post_meta( get_the_ID(), 'wpsl_city', true );
  $wpsl_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );
  $location_email_address = get_post_meta( get_the_ID(), 'location_email_address', true );
  $location_fax = get_post_meta( get_the_ID(), 'location_fax', true );
  $wpsl_phone = get_post_meta( get_the_ID(), 'wpsl_phone', true );
  $wpsl_address_two = get_post_meta( get_the_ID(), 'wpsl_address_two', true );

   $scheduleLocationcode .= "['".get_the_ID()."','<div class=\"map-pointer-detail\" style=\"position:unset\"><img class=\"img-fluid\" src=\"".$thumb[0]."\" width=\"198\" /><h3>".$location_name."</h3><p>".$wpsl_address.", <br>".$wpsl_state.",<br>".$wpsl_city." - ".$wpsl_zip.".</p></div>', ".$wpsl_latitude.", ".$wpsl_longitude.", '<h4 onclick=google.maps.event.trigger(gmarkers[\'". get_the_ID()."\'],\'click\');>".get_the_title()."</h4><p>".$meeting_addr.",<br>".$meeting_city.",<br>".$meeting_state." - ".$meeting_zip."', 4],";

   }
   
endwhile;
endif;

    }

  }


 $scheduleoutputLocation .= '<div class="mapplace-center mapheight">
          			<div id="schedule-googlemap" style="width: 100%; height: 100%;"></div>
            		</div> <script type="text/javascript">';

	$scheduleoutputLocation .= '
	var locations = [
		'.rtrim($scheduleLocationcode,",").'
		];
	';
	$scheduleoutputLocation .= '

	var mapStyles = [{
    "featureType": "landscape",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 65
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "poi",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 51
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.highway",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.arterial",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 30
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "road.local",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 40
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "transit",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "administrative.province",
    "stylers": [{
      "visibility": "on"
    }]
  }, {
    "featureType": "water",
    "elementType": "labels",
    "stylers": [{
      "visibility": "on"
    }, {
      "lightness": -25
    }, {
      "saturation": -100
    }]
  }, {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [{
      "hue": "#ffff00"
    }, {
      "lightness": -25
    }, {
      "saturation": -97
    }]
  }];
	var markers = new Array();
	gmarkers = [];
	var map = new google.maps.Map(document.getElementById(\'schedule-googlemap\'), {
      zoom: 6,
	  styles: mapStyles,
      center: new google.maps.LatLng('.$wpsl_latitude.','.$wpsl_longitude.'),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  mapTypeControl: false,
	  streetViewControl: false,
	  zoomControlOptions: {
        	position: google.maps.ControlPosition.TOP_LEFT
    	},
	  fullscreenControl: false
    });
	
	var bounds  = new google.maps.LatLngBounds();

    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
	  	// Add marker to markers array
		gmarkers[locations[i][0]] =
    createMarker(new google.maps.LatLng(locations[i][2], locations[i][3]), locations[i][1], locations[i][4]);

    var loc = new google.maps.LatLng(gmarkers[locations[i][0]].position.lat(), gmarkers[locations[i][0]].position.lng());
	bounds.extend(loc);

    }

    if(locations.length>1){
    	map.fitBounds(bounds);
		map.panToBounds(bounds); 
    }

	function createMarker(latlng, html, useraddrchoice) {
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			zoom:9,
			icon: \''.get_template_directory_uri().'/images/map-pointer-icon-sm.png\'
		});

		google.maps.event.addListener(marker, \'click\', function() {
			infowindow.setContent(html);
			infowindow.open(map, marker);
			$("#meeting_addr").html(useraddrchoice);
		});
		return marker;
	}

	jQuery(document).ready(function($){
	 $(".marker-link").on(\'click\', function () {
		window.scrollTo($(\'#schedule-googlemap\'), 1000);
    });

		var sel = $(\'.sel\'),
		txt = $(\'.txt\'),
		options = $(\'.options\');

		sel.click(function (e) {
			e.stopPropagation();
			options.show();
		});

		$(\'body\').click(function (e) {
			options.hide();
		});

		options.children(\'div\').click(function (e) {
			e.stopPropagation();
			txt.html(\'<span>\'+$(this).text()+\'</span> <img src="'.get_template_directory_uri().'/images/dropdown.png" alt=""  data-filter="all" /> \');
			$(this).addClass(\'selected\').siblings(\'div\').removeClass(\'selected\');
			options.hide();
		});


		var $mediaElements = $(\'.filterDiv\');

		$(\'.filter_link\').click(function(e){
			e.preventDefault();
			// get the category from the attribute
			var filterVal = $(this).data(\'filter\');
			$(\'#emptyResult\').hide()
			if(filterVal === \'all\'){
			  $mediaElements.show();
			}else{
			   // hide all then filter the ones to show
			   $mediaElements.hide().filter(\'.\' + filterVal).show();

			   var countDivVisible = $(\'.filterDiv:visible\').size()
			   if(countDivVisible==0)
			   {
			   		$(\'#emptyResult\').show()
			   }

			}
		});

		$(".toggle").click(function() {
		$($(\'.divcontainer\')[$(this).index(".toggle")]).toggle(\'fast\');
	});


	});

</script>';

	$Address['res'] = $curaddress;
	$Address['maploc'] = $scheduleoutputLocation;

	echo json_encode($Address); // return value of $result
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_nopriv_scheduleLocationAddress', 'scheduleLocationAddress'); 
add_action('wp_ajax_scheduleLocationAddress', 'scheduleLocationAddress');


/** get course details  **/
function CourseListFilter(){

	global $post, $wpdb;

	$studyid = '';
	$course_list = '';
	
	//$course_data =array();

	$get_key = $_POST['whatever'];

	$string = explode(',', $get_key);

	foreach( $string as $areaval ){

		$query = $wpdb->get_row("SELECT study_id FROM tc19_areaofstudy_list WHERE area_of_study IN ('".$areaval."')");

		$ids .= $query->study_id.',';

	}
  	
  	$studyid = rtrim($ids, ',');

  	$detail = $wpdb->get_results("SELECT study_id, course_name FROM tc19_specialization WHERE study_id IN (".$studyid.") ORDER BY study_id ASC");

	foreach ( $detail as $value) {

		$course_list .= '<option value="'.$value->course_name.'">'.$value->course_name.'</option>';
	}

	echo $course_list;

    die();

}

add_action('wp_ajax_nopriv_CourseListFilter', 'CourseListFilter'); 
add_action('wp_ajax_CourseListFilter', 'CourseListFilter');	

/** Get user schedule address for second form  **/
function schedulePlace(){

	global $post, $wpdb;

	$Address = array();

	$curaddress = '';
	$scheduleLocationcode = '';
	$scheduleoutputLocation = '';

	header('Content-Type: application/json');

	$scheduleaddr = $_REQUEST['place'];

	$meetinglocationCats = get_terms(
      array(
        'taxonomy'   => 'loc_categories',
        'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC', // or ASC
        'hierarchical'  => 1,
        'parent'        => 0, // get top level categories
      )
    );

    foreach ( $meetinglocationCats as $location )
    {

      $sub_categories = get_terms(
            array(
              'taxonomy'   => 'loc_categories',
              'hide_empty' => false,
              'orderby' => 'term_id',
              'order' => 'ASC', // or ASC
              'hierarchical'  => 1,
              'parent'        => $location->term_id, // get child categories
            )
          );

      foreach ( $sub_categories as $sub_category ){
		$scheduleID = $sub_category->term_id;
		
		$args = array(
        'post_type'         => 'location',
        'post_status'       => 'publish',
        'tax_query'         => array(
            array(
                'taxonomy'  => 'loc_categories',
                'field'     => 'id',
                'terms'     => $scheduleID,
            )
        )
    );

$query = new WP_Query($args);

if($query->have_posts()) : 

    while ($query->have_posts()) : $query->the_post();

    $meetingcity = get_post_meta( get_the_ID(), 'wpsl_city', true ); 

   if($scheduleaddr == $meetingcity){

	$title = '<h4 onclick="google.maps.event.trigger(gmarkers[\'' . get_the_ID() . '\'],\'click\');" class="marker-link show-link" data-markerid="' . get_the_ID() . '">'.get_the_title().'</h4>';

    $meeting_addr = get_post_meta( get_the_ID(), 'wpsl_address', true );
    $meeting_city = get_post_meta( get_the_ID(), 'wpsl_city', true ); 
    $meeting_state = get_post_meta( get_the_ID(), 'wpsl_state', true );
    $meeting_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );

    $curaddress .= $title.'<p>'.$meeting_addr.',<br> '.$meeting_city.',<br>'.$meeting_state.' '.$meeting_zip.'</p>';

   /** location map code **/
  $location_name = get_the_title(get_the_ID());

  $wpsl_latitude = get_post_meta( get_the_ID(), 'wpsl_latitude', true );
  $wpsl_longitude = get_post_meta( get_the_ID(), 'wpsl_longitude', true );

  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
  $wpsl_address = get_post_meta( get_the_ID(), 'wpsl_address', true );
  $wpsl_state = get_post_meta(get_the_ID(), 'wpsl_state', true );
  $wpsl_city = get_post_meta( get_the_ID(), 'wpsl_city', true );
  $wpsl_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );
  $location_email_address = get_post_meta( get_the_ID(), 'location_email_address', true );
  $location_fax = get_post_meta( get_the_ID(), 'location_fax', true );
  $wpsl_phone = get_post_meta( get_the_ID(), 'wpsl_phone', true );
  $wpsl_address_two = get_post_meta( get_the_ID(), 'wpsl_address_two', true );

   $scheduleLocationcode .= "['".get_the_ID()."','<div class=\"map-pointer-detail\" style=\"position:unset\"><img class=\"img-fluid\" src=\"".$thumb[0]."\" width=\"198\" /><h3>".$location_name."</h3><p>".$wpsl_address.", <br>".$wpsl_state.",<br>".$wpsl_city." - ".$wpsl_zip.".</p></div>', ".$wpsl_latitude.", ".$wpsl_longitude.", '<h4 onclick=google.maps.event.trigger(gmarkers[\'". get_the_ID()."\'],\'click\');>".get_the_title()."</h4><p>".$meeting_addr.",<br>".$meeting_city.",<br>".$meeting_state." - ".$meeting_zip."', 4],";

   }
   
endwhile;
endif;

    }

  }

	$scheduleoutputLocation .= '<div class="mapplace-center mapheight">
          			<div id="meeting-googlemap" style="width: 100%; height: 100%;"></div>
            		</div> <script type="text/javascript">';

	$scheduleoutputLocation .= '
	var locations = [
		'.rtrim($scheduleLocationcode,",").'
		];
	';
	$scheduleoutputLocation .= '

	var mapStyles = [{
    "featureType": "landscape",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 65
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "poi",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 51
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.highway",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.arterial",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 30
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "road.local",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 40
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "transit",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "administrative.province",
    "stylers": [{
      "visibility": "on"
    }]
  }, {
    "featureType": "water",
    "elementType": "labels",
    "stylers": [{
      "visibility": "on"
    }, {
      "lightness": -25
    }, {
      "saturation": -100
    }]
  }, {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [{
      "hue": "#ffff00"
    }, {
      "lightness": -25
    }, {
      "saturation": -97
    }]
  }];
	var markers = new Array();
	gmarkers = [];
	var map = new google.maps.Map(document.getElementById(\'meeting-googlemap\'), {
      zoom: 6,
	  styles: mapStyles,
      center: new google.maps.LatLng('.$wpsl_latitude.','.$wpsl_longitude.'),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  mapTypeControl: false,
	  streetViewControl: false,
	  zoomControlOptions: {
        	position: google.maps.ControlPosition.TOP_LEFT
    	},
	  fullscreenControl: false
    });
	
	var bounds  = new google.maps.LatLngBounds();

    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
	  	// Add marker to markers array
		gmarkers[locations[i][0]] =
    createMarker(new google.maps.LatLng(locations[i][2], locations[i][3]), locations[i][1], locations[i][4]);

    var loc = new google.maps.LatLng(gmarkers[locations[i][0]].position.lat(), gmarkers[locations[i][0]].position.lng());
		bounds.extend(loc);

    }

    if(locations.length>1){
    	map.fitBounds(bounds);
		map.panToBounds(bounds); 
    }

	function createMarker(latlng, html, useraddrchoice) {
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			zoom:9,
			icon: \''.get_template_directory_uri().'/images/map-pointer-icon-sm.png\'
		});

		google.maps.event.addListener(marker, \'click\', function() {
			infowindow.setContent(html);
			infowindow.open(map, marker);
			$("#schedulemeeting_addr").html(useraddrchoice);
			
		});
		return marker;
	}

	jQuery(document).ready(function($){
	 $(".marker-link").on(\'click\', function () {
		window.scrollTo($(\'#meeting-googlemap\'), 1000);
    });

		var sel = $(\'.sel\'),
		txt = $(\'.txt\'),
		options = $(\'.options\');

		sel.click(function (e) {
			e.stopPropagation();
			options.show();
		});

		$(\'body\').click(function (e) {
			options.hide();
		});

		options.children(\'div\').click(function (e) {
			e.stopPropagation();
			txt.html(\'<span>\'+$(this).text()+\'</span> <img src="'.get_template_directory_uri().'/images/dropdown.png" alt=""  data-filter="all" /> \');
			$(this).addClass(\'selected\').siblings(\'div\').removeClass(\'selected\');
			options.hide();
		});


		var $mediaElements = $(\'.filterDiv\');

		$(\'.filter_link\').click(function(e){
			e.preventDefault();
			// get the category from the attribute
			var filterVal = $(this).data(\'filter\');
			$(\'#emptyResult\').hide()
			if(filterVal === \'all\'){
			  $mediaElements.show();
			}else{
			   // hide all then filter the ones to show
			   $mediaElements.hide().filter(\'.\' + filterVal).show();

			   var countDivVisible = $(\'.filterDiv:visible\').size()
			   if(countDivVisible==0)
			   {
			   		$(\'#emptyResult\').show()
			   }

			}
		});

		$(".toggle").click(function() {
		$($(\'.divcontainer\')[$(this).index(".toggle")]).toggle(\'fast\');
	});


	});

</script>';

	$Address['res'] = $curaddress;
	$Address['maploc'] = $scheduleoutputLocation;

	echo json_encode($Address); // return value of $result
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_nopriv_schedulePlace', 'schedulePlace'); 
add_action('wp_ajax_schedulePlace', 'schedulePlace');

