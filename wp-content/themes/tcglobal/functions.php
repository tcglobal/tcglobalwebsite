<?php

require get_template_directory() . '/theme-options.php'; 
require get_template_directory() . '/includes/tc_global_shortcode.php';


/** load this script all pages except home page - start **/
function customScripts(){
	if(!is_front_page() ){
     wp_enqueue_script( 'rangeslider-js', '/wp-content/plugins/searchtool/js/rangeSlider.min.js');
    wp_enqueue_script( 'rangeslider-custom-js', '/wp-content/plugins/searchtool/js/Script.js');
    }    
}
add_action('wp_footer', 'customScripts');

function rangeSliderCss(){
	if(!is_front_page() ){
		wp_enqueue_style( 'jquery-ui-css', plugins_url('searchtool/js/jquery-ui.css'),false,'1.1','all');
		wp_enqueue_style( 'range-slider-min-css', plugins_url('searchtool/css/rangeSlider.min.css'),false,'1.1','all');
		wp_enqueue_style( 'style-css', plugins_url('searchtool/css/style.css'),false,'1.1','all');
	}
}
add_action('wp_footer', 'rangeSliderCss');
/** load this script all pages except home page - end **/	

// register css & js files
function custom_theme_assets() {
	// all styles
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 20141119 );
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.css');
	wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css');
	wp_enqueue_style( 'select2', get_stylesheet_directory_uri() . '/css/select2.min.css');
    
    
    // all scripts

    //wp_enqueue_script( 'slim-min-js', 'https://code.jquery.com/jquery-3.3.1.slim.min.js' );
    wp_enqueue_script( 'slim-min-js', get_template_directory_uri() . '/js/jquery-3.3.1.slim.min.js' );
   	wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'select2-js', get_template_directory_uri() . '/js/select2.min.js', array('jquery'), NULL, true );
    wp_enqueue_script( 'jquery-twbs-pagination-js', get_template_directory_uri() . '/js/jquery.twbsPagination.js', array('jquery'), NULL, true );
    //wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.js',array('jquery'), NULL, true);
   	wp_enqueue_script( 'slick-min-js', get_template_directory_uri() . '/js/slick.min.js',array('jquery'), NULL, true);
  
    //wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '20120206', true );

     wp_enqueue_script( 'custom_js', get_template_directory_uri().'/js/custom.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'custom_js', 'ajax_posts', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));
    
    wp_enqueue_script( 'insight-load-more.js', get_template_directory_uri().'/js/insight_load_more.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'insight-load-more.js', 'Myajax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'location-list.js', get_template_directory_uri().'/js/location_detail.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'location-list.js', 'ajax_loc', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    /*wp_enqueue_script( 'address-list.js', get_template_directory_uri().'/js/onload_map.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'address-list.js', 'ajax_addr', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));*/

    wp_enqueue_script( 'meeting-location.js', get_template_directory_uri().'/js/meeting_map.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'meeting-location.js', 'meeting_ajax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'schedule.js', get_template_directory_uri().'/js/schedule_location_detail.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'schedule.js', 'schedule_map', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

     /*wp_enqueue_script( 'course.js', get_template_directory_uri().'/js/courselist.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'course.js', 'area_posts', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'dbcourselist.js', get_template_directory_uri().'/js/dbcourselist.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'dbcourselist.js', 'coursedata', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));*/

	/*wp_enqueue_script( 'usermeeting_location.js', get_template_directory_uri().'/js/usermeeting_location.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'usermeeting_location.js', 'Userloc', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));*/
    
    wp_enqueue_script( 'userchoice_location.js', get_template_directory_uri().'/js/userchoice_location.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'userchoice_location.js', 'UserChoice', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

    wp_enqueue_script( 'country-load.js', get_template_directory_uri().'/js/country_load.js', array( 'jquery'), '1.0.0', true );
    wp_localize_script( 'country-load.js', 'CountryData', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

}
add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );

function thisisonlyatest() {
      wp_enqueue_script('jquery-ui-datepicker');
      //wp_enqueue_style('jquery-ui-datepicker','https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/redmond/jquery-ui.min.css' );
      wp_enqueue_style('jquery-ui-datepicker', get_stylesheet_directory_uri() . '/css/jquery-ui.min.css' );
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
			'name'          => __( 'Footer 7', 'tcglobal' ),
			'id'            => 'footer-7',
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
/*add category option to timeline */
add_action( 'init', 'tc_add_category_to_timeline' );
function tc_add_category_to_timeline() {

	$post_name = "te_announcements";
	register_taxonomy("timeline_cat", array($post_name), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Categories", "rewrite" => array( 'slug' => 'timeline_cat', 'with_front'=> false )));
	register_taxonomy_for_object_type( 'timeline_cat', 'te_announcements' );
}

/*add category option to events box plugin */
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
	if(!empty($eventDate)){
    $event_date_val = date("Y-m-d", strtotime($eventDate)); // eg: 2019-09-23
	}
    $event_topic = $_POST["topic"];
    $event_business_val = $_POST["business"];
    
    
    $postID = $_POST["excludePost"];

	$str_arr = explode (",", $postID);  

    if( empty($event_topic) && empty($event_business_val) ){

	$event_query = new WP_Query(
					array('post_type' => 'event_listing',
							'post__not_in' => $str_arr,
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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
							'orderby' => '_event_start_date',
							'order' => 'ASC',
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
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($event_id), 'full' );
        $event_addr = get_post_meta( $event_id, '_event_address', true );
        $event_stime = get_post_meta( $event_id, '_event_start_time', true );
        $event_etime = get_post_meta( $event_id, '_event_end_time', true );
		$event_sdate = get_post_meta( $event_id, '_event_start_date', true );
        $event_category = get_the_terms( $event_id, 'event_categories' );
       
        $out .='<div class="'.$column.' three_column m-b-30">';
		$out .='<div class="position-relative">';
		$out .='<a href="'.get_permalink( $event_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid"></a>';
		$out .='</div>';
		$out .='<div class="contentslider">';
		$out .='<span class="taglabel">'.$event_category[0]->name.'</span>';
		$out .='<div class="formheading pb-2"><a href="'.get_permalink( $event_id ).'">'.get_the_title($event_id).'</a></div>';
		$out .='<div class="officename pb-1">'.$event_addr.'</div>';
		//$out .='<div class="datetime">'.$event_stime.' - '.$event_etime.'</div>';
		$out .='<div class="datetime">'.date('d-m-Y',strtotime($event_sdate)).'</div>';
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

/** Insight page load more post **/
function load_post_ajax(){

	global $post, $wpdb;

	$insight_res = array();
	header('Content-Type: application/json');

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

	$column =  $_POST['col'];
	//$search_key = $_POST['key'];
	$get_key = $_POST['key'];
  	$search_key = str_replace('’', "'", $get_key);
  	
    $insight_type = $_POST["type"];
	$insight_topic = $_POST["insight_topic"];
    $insight_business = $_POST["insight_business"]; 

    $postID = $_POST["excludeInsightPost"];
	$exclude_arr = explode (",", $postID);

    //header("Content-Type: text/html");

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
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($insignt_id), 'medium' );
        $tag = get_the_tags($insignt_id);

        if($column == 'col-sm-12'){  // mobile view load insight  function

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

		}

		else{ // desktop load insight function

			$more_data .='<div class="'.$column.' m-b-30">
                      <div class="position-relative">
                        <a href="'.get_permalink( $insignt_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid"></a>
                        
                      </div>
                      <div class="contentslider">
                        <span class="taglabel">'.$tag[0]->name.'</span>
                        <div class="datetime float-right">'.get_the_date('d.m.Y').'</div>
                        <div class="formheading pb-2"><a href="'.get_permalink( $insignt_id ).'">'.get_the_title($insignt_id).'</a></div>
                        <a href="'.get_permalink( $insignt_id ).'"><p>'.get_kc_excerpt().'</p></a>
                      </div>
                    </div>';

		}

	endwhile;
    endif;
    
    $insight_res['result'] = $more_data;
    $insight_res['count'] = $custom_query->max_num_pages;
    echo json_encode($insight_res); // return value of $result

	wp_reset_postdata();
    die();

}

add_action('wp_ajax_nopriv_load_post_ajax', 'load_post_ajax'); 
add_action('wp_ajax_load_post_ajax', 'load_post_ajax');


/** Remove visual composer editor shorcode excerpt on insight page  **/
/** add this to your function.php child theme to remove ugly shortcode on excerpt */
 
if(!function_exists('remove_vc_from_excerpt'))  {
  function remove_vc_from_excerpt( $excerpt ) {
    $patterns = "/\[[\/]?vc_[^\]]*\]/";
    $replacements = "";
    return preg_replace($patterns, $replacements, $excerpt);
  }
}

if(!function_exists('get_kc_excerpt')) {
 
function get_kc_excerpt($excerpt_length = 20) {
 
    global $word_count, $post;
 
    $word_count = isset($word_count) && $word_count != "" ? $word_count : $excerpt_length;
 
    $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content); $clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
 	$clean_excerpt = strip_shortcodes(remove_vc_from_excerpt($clean_excerpt));
 	$excerpt_word_array = explode (' ',$clean_excerpt);
 	$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
 	$excerpt = implode (' ', $excerpt_word_array); 
    return $excerpt;

   }
 
}

/** job load more post function **/
function load_job_post(){

	global $post, $wpdb;
	$arr = array();

	header('Content-Type: application/json');

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    $device_type = $_REQUEST['device']; // check tab or mobile

	$job_key = $_REQUEST['key'];
	$tc_country = $_REQUEST['country'];
	$tc_city = $_REQUEST['city'];
	$tc_team = $_REQUEST['team'];
	$Job_order_req = $_REQUEST['sort'];
	$subteam = $_REQUEST['career_team'];
  	$subcountry = $_REQUEST['career_country'];

    $job_ID = $_POST["excludeJobPost"];
	$ex_arr = explode (",", $job_ID);

	$jobOrdeBy = '';
 	$Job_order = 'DESC';

 if($Job_order_req == 'Most recent'){
    $Job_order = 'DESC';
  }
  if($Job_order_req == 'A-Z'){
    $Job_order = 'ASC';
    $jobOrdeBy = 'title';

  }
  if($Job_order_req == 'Z-A'){
    $Job_order = 'DESC';
    $jobOrdeBy = 'title';

  }

	$relation = 'OR';

      if(!empty($_REQUEST['country']) && !empty($_REQUEST['city']))
      {
        $relation = 'AND';
      }
      if(!empty($_REQUEST['city']) && !empty($_REQUEST['team']))
      {
        $relation = 'AND';
      }
      if(!empty($_REQUEST['country']) && !empty($_REQUEST['team']) || !empty($_REQUEST['career_team']) && !empty($_REQUEST['career_country']))
      {
        $relation = 'AND';
      }

      elseif(!empty($_REQUEST['country']) && !empty($_REQUEST['city']) && !empty($_REQUEST['team']))
      {
        $relation = 'AND';
      }

   $tax_query = array('relation' => $relation);   

  if(!empty($_REQUEST['country']) || !empty($_REQUEST['career_country'])) 
    {
    	
        $tax_query[] = array(

                'taxonomy' => 'jobpost_location',
                'field' => 'name',
                //'terms' => $tc_country,  // it's for parent taxonomy
                'terms' => array($tc_country, $subcountry),  
                'operator' => 'IN',
          );    
    }

    if(!empty($_REQUEST['city']))
    {

      $tax_query[] = array(
                
                    'taxonomy' => 'jobpost_location',
                    'field' => 'name',
                    'terms' => $tc_city,
                    'operator' => 'IN',
          );  
    }

    if(!empty($_REQUEST['team']) || !empty($_REQUEST['career_team']) )
    {
        $tax_query[] = array(
                
                    'taxonomy' => 'jobpost_category',
                    'field' => 'name',
                    //'terms' => $tc_team,
                    'terms' => array($tc_team, $subteam),
                    'operator' => 'IN',
          );  
    }        

    $args = array( 
          'post_type' => 'jobpost', 
          'post__not_in' => $ex_arr,
          'posts_per_page' => $ppp, 
          'orderby'=>$jobOrdeBy,
          'order' => $Job_order, 
          's' => $job_key,
          'tax_query' => $tax_query,
          'paged' => $page
      );

	$career_data = '';

    $job_query = new WP_Query( $args );
    
    if($job_query->have_posts()) : 

   	while ($job_query->have_posts()) : $job_query->the_post(); 

    $career_id = get_the_ID();

    $exclude_job .=$career_id.',';

	  $career_category = get_the_terms( $career_id, 'jobpost_category' );
	  $career_state = get_the_terms( $career_id, 'jobpost_location' );
	  $career_cat_id = $career_state[0]->parent;
	  $career_country = get_term_by('id', $career_cat_id, 'jobpost_location');

	  if($device_type == 'tab'){

	  $career_data .='<div class="list-detail border-left-0 border-right-0 bg-transparent border-top-0 px-0 pt-0">
            <div class="row">
              <div class="col-sm-12">
                <h3 class="fs-20">'.get_the_title($career_id).'</h3>
              </div>
              <div class="col-sm-4">
                <span class="taglabel">'.$career_category[0]->name.'</span>
              </div>';

              if($career_state){

              $career_data .='<div class="col-sm-6">
                <div class="row">
                  <div class="col-2 pr-0">
                    <img src="'.get_template_directory_uri().'/images/map.png" alt="">
                  </div>
                  <div class="col-10 pl-2">
                    <p class="fs-14 mb-2"><span>'.$career_state[0]->name.', </span>'.$career_country->name.'</p>
                  </div>
                </div>
              </div>';
             } 

            $career_data .='</div>
          </div>';

         } 

         if($device_type == 'mobile'){

         	$career_data .='<div class="col-12 m-b-20">
                    <div class="list-detail">
                      <span class="taglabel">'.$career_category[0]->name.'</span>
                      <h3 class="fs-20">'.get_the_title($career_id).'</h3>';

                    if($career_state){

                      $career_data .='<div class="row">
                        <div class="col-2 pr-0">
                          <img src="'.get_template_directory_uri().'/images/map.png" alt="">
                        </div>
                        <div class="col-10 pl-2">
                          <p class="fs-14"><span>'.$career_state[0]->name.', </span>'.$career_country->name.'</p>
                        </div>
                      </div>';
                    }

                      $career_data .='<a class="fs-14 apply-link" href="'.get_permalink( $career_id ).'">Apply now<img src="'.get_template_directory_uri().'/images/down_2.png" alt=""></a>
                    </div>
                  </div>';
		}

		 endwhile;
    endif;

    $arr['result'] = $career_data;
    $arr['count'] = $job_query->max_num_pages;
    echo json_encode($arr); // return value of $result
	wp_reset_postdata();
    die();

}

add_action('wp_ajax_nopriv_load_job_post', 'load_job_post'); 
add_action('wp_ajax_load_job_post', 'load_job_post');


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
          			<div id="google-map-display-form" style="width: 100%; height: 100%;"></div>
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
	var map = new google.maps.Map(document.getElementById(\'google-map-display-form\'), {
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
		window.scrollTo($(\'#google-map-display-form\'), 1000);
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

	$title = '<h4 onclick="google.maps.event.trigger(gmarkers[\'' . get_the_ID() . '\'],\'click\');" class="marker-link show-link" data-markerid="' . get_the_ID() . '">'.get_the_title().'</h4>';

    $curloc = get_post_meta( get_the_ID(), 'wpsl_address', true );
    $curcity = get_post_meta( get_the_ID(), 'wpsl_city', true ); 
    $curstate = get_post_meta( get_the_ID(), 'wpsl_state', true );
    $curzip = get_post_meta( get_the_ID(), 'wpsl_zip', true );

    $dynamicaddr .= $title.'<p>'.$curloc.',<br> '.$curcity.',<br>'.$curstate.' '.$curzip.'</p>';

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

/** Fetch course DB result  **/
function CourseTableData(){

	global $post, $wpdb;

	$courseres =array();

	header('Content-Type: application/json');

	$count = 0;
	$data = '';

	$areaval = $_POST['userarea'];
	$countryval = $_POST['usercountry'];
	$key = $_POST['usercoursetype'];

	if(!empty($areaval) && !empty($countryval) && empty($key)){
		$sql = "SELECT prog_id, university_name, country_name, prog_name FROM tc19_course WHERE area_of_study IN ('".str_replace(",", "','", $areaval)."') AND country_name IN ('".str_replace(",", "','", $countryval)."') AND prog_fees_value BETWEEN 0 AND 50000";
	}

	if(empty($areaval) && !empty($countryval) && !empty($key))
	{
		$sql = "SELECT prog_id, university_name, country_name, prog_name FROM tc19_course WHERE country_name IN ('".str_replace(",", "','", $countryval)."') AND prog_name LIKE '%".$key."%' AND prog_fees_value BETWEEN 0 AND 50000";
	}

	if(!empty($areaval) && empty($countryval) && !empty($key)){
	  	$sql = "SELECT prog_id, university_name, country_name, prog_name FROM tc19_course WHERE area_of_study IN ('".str_replace(",", "','", $areaval)."') AND prog_name LIKE '%".$key."%' AND prog_fees_value BETWEEN 0 AND 50000";
	}

	if(!empty($areaval) && !empty($countryval) && !empty($key)){
		$sql = "SELECT prog_id, university_name, country_name, prog_name FROM tc19_course WHERE area_of_study IN ('".str_replace(",", "','", $areaval)."') AND country_name IN ('".str_replace(",", "','", $countryval)."') AND prog_name LIKE '%".$key."%' AND prog_fees_value BETWEEN 0 AND 50000";
	}

	$result = $wpdb->get_results($sql);

	foreach ( $result as $value) {
	  $count++;

	  $data .='
		  <div class="col-sm-12" style="border-bottom: 1px solid #e2dcdc; padding-bottom: 5px;">
		  <h5>'.$value->prog_id.' - '. $value->university_name.'</h5>
		  <p>'.$value->prog_name.'</p>
		  </div>';
	}

	$courseres['query'] = $sql;
	$courseres['count'] = $count;
	$courseres['res'] = $data;

	echo json_encode($courseres); // return value of $result
    
    die();
}

add_action('wp_ajax_nopriv_CourseTableData', 'CourseTableData'); 
add_action('wp_ajax_CourseTableData', 'CourseTableData ');	

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

/** discover country load more post **/
function country_post_ajax(){

	global $post, $wpdb;
	$country_res = array();
	header('Content-Type: application/json');

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

	$column =  $_POST['col'];
	$device_type = $_REQUEST['type']; // check tab or mobile
	$postID = $_POST["excludeCountryPage"];
	$excludeData = explode (",", $postID);

    $countryListData = '';

    $args = array(
        'post_type' => 'page',
        'post_parent'    => 1640,
        'post__not_in' => $excludeData,
        'order' => 'DESC',
        'orderby'        => 'id',
        'posts_per_page' => $ppp,
		'paged'    => $page
    );

	$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : 
  while ( $parent->have_posts() ) : $parent->the_post(); 
        
    $subpageID = get_the_ID();
	$country_img = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'full' );

    $universeImgID = get_post_meta( $post->ID, 'university_image', true );
    if($universeImgID){
      $universeImg = wp_get_attachment_image_src($universeImgID, 'full');
    }
    $universitycount = get_post_meta( $post->ID, 'university_count', true );

    $courseImgID = get_post_meta( $post->ID, 'course_image', true );
    if($courseImgID){
      $courseImg = wp_get_attachment_image_src($courseImgID, 'full');
    }
    $coursecount = get_post_meta( $post->ID, 'course_count', true );

    if($device_type == 'mobile'){

    	$countryListData .= '<div class="'.$column.' px-1">
          <div class="course-list">
            <div class="img-sec">
              <img src="'.$country_img[0].'" alt="course-img" class="img-fluid w-100 thumb-img-conver">
              
            </div>
              <div class="col-sm-12 searchcoutry-about-count m-t-10">
                <div class="row align-items-center m-b-15">
                  <div class="col-sm-2 pr-0">
                    <img class="img-fluid float-left" src="'.$universeImg[0].'" alt="">
                  </div>
                  <div class="col-sm-10">
                    '.$universitycount.'
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-sm-2 pr-0">
                    <img class="img-fluid float-left" src="'.$courseImg[0].'" alt="">
                  </div>
                  <div class="col-sm-10">
                    '.$coursecount.'
                  </div>
                </div>
              </div>
            <h2 class="mt-3 mb-4 pb-3">'.get_the_title($subpageID).'</h2>
          </div>
        </div>';

    }
    else{
	    $countryListData .= '<div class="'.$column.' m-b-30">
	      <div class="course-list">
	        <div class="img-sec">
	          <img src="'.$country_img[0].'" alt="course-img" class="img-fluid thumb-img-conver">
	          </div>
	          <div class="col-sm-12 searchcoutry-about-count">
	            <div class="row align-items-center mb-2 pb-1">
	              <div class="col-sm-2">
	                <img class="img-fluid" src="'.$universeImg[0].'" alt="">
	              </div>
	              <div class="col-sm-10 pl-0 pt-1">
	                '.$universitycount.'
	              </div>
	            </div>
	            <div class="row align-items-center">
	              <div class="col-sm-2">
	                <img class="img-fluid" src="'.$courseImg[0].'" alt="">
	              </div>
	              <div class="col-sm-10 pl-0">
	                '.$coursecount.'
	              </div>
	            </div>
	          </div>
	        <h2 class="mt-3"><a href="'.get_permalink( $subpageID ).'">'.get_the_title($subpageID).'</a></h2>
	      </div>
	    </div>';
	}

     endwhile;
     endif; 
	
	$country_res['result'] = $countryListData;
    $country_res['count'] = $parent->max_num_pages;
    echo json_encode($country_res); // return value of $result

	wp_reset_postdata();
    die();
}

add_action('wp_ajax_nopriv_country_post_ajax', 'country_post_ajax'); 
add_action('wp_ajax_country_post_ajax', 'country_post_ajax');

/** To get create & update event post_type data for api call  **/
add_action( 'save_post', 'set_post_default_category', 10,3 );
function set_post_default_category( $post_id, $post, $update ) {

	/*header('Content-Type: application/json; charset=utf-8');*/
    
    if ( 'event_listing' == $post->post_type ) {

    	$eventdata = array();
        $query = new WP_Query(
			array('post_type' => 'event_listing',
				  'post_status' => 'publish',
				  'p' => $post_id
				)
		);

	if($query->have_posts()) :
  	while ($query->have_posts()) : $query->the_post();

  		$category_name = '';
  		$eventimgurl = "";
  		$items = array();

  	 	$cureventID = get_the_ID();
  	 	$title = get_the_title($cureventID);
  		$event_addr = get_post_meta( $cureventID, '_event_address', true );
        $event_stime = get_post_meta( $cureventID, '_event_start_time', true );
        $event_etime = get_post_meta( $cureventID, '_event_end_time', true );
        $event_sdate = get_post_meta( $cureventID, '_event_start_date', true );
		$event_category = get_the_terms( $cureventID, 'event_categories' );
		$featured_event = get_post_meta( $cureventID, '_featured', true );
		$location = get_post_meta( $cureventID, '_event_location', true );
		$event_content = get_post_field('post_content', $cureventID);
		$img = wp_get_attachment_image_src( get_post_thumbnail_id($cureventID), 'full' );
		
		$business = get_post_meta( $cureventID, 'choose_business', true );

		if($img){
			$eventimgurl = $img[0];
		}
		else{
			$eventimgurl = "";
		}

		for($i=1; $i<=5; $i++)
		{
			$invitename = ''; $inviterole = ''; $invite_pic = ''; $inviteimag = '';
			$invitename =  get_post_meta( $cureventID, 'invite_name_'.$i, true );
			$inviterole =  get_post_meta( $cureventID, 'role_'.$i, true );
			$inviteimag =  get_post_meta( $cureventID, 'image_'.$i, true );
			if($inviteimag){
				$invite_imgurl = wp_get_attachment_image_src($inviteimag);
				$invite_pic = $invite_imgurl[0];
			}

			$items[] = array(
				'name' => $invitename,
				'role' => $inviterole,
				'image' => $invite_pic
			);
		}			

		foreach ($event_category as $value) {
			$category_name .= $value->name.',';
		}

		$eventdata[] = array(
			'id' => $cureventID,		
		    'title' => html_entity_decode($title),
		    'location' => $location,
		    'address' => $event_addr,
		    'start_time' => $event_stime,
		    'end_time' => $event_etime,
		    'start_date' => $event_sdate,
		    'topics' => rtrim($category_name, ','),
		    'business_type' => $business,
		    'featured_event' => $featured_event,
		    'image_url' => $eventimgurl,
		    'content' =>$event_content,
		    'event_organizer' => $items
		);

	endwhile;

  	$eventarray = array(
	  "status" => true,
	  "event_result" => $eventdata
	);

  	$url = "https://portalapi.tcglobal.com/api/event/thirdpartyapi/AddEditEvents";
  	//$url = "https://tcgstagingservice.optisolbusiness.com/api/event/thirdpartyapi/AddEditEvents";
	$responseData = createPostData($url,$eventarray);
	endif;

	} // events end

	// Only set for post_type = post
    if ( 'post' == $post->post_type ) {

    	$reqData = array();
        
		$getInsight = new WP_Query(
			array('post_type' => 'post',
				  'post_status' => 'publish',
				  'p' => $post_id
				)
		);

	if($getInsight->have_posts()) :
  	while ($getInsight->have_posts()) : $getInsight->the_post();

  		$thmbImg = "";
		$catName = ''; $postPeople = array(); $topicname = '';
		$postDataID = get_the_ID();
  	 	$title = get_the_title($postDataID);
  	 	$tagName = get_the_terms( $postDataID, 'post_tag' );
  	 	$insightCat = get_the_terms( $postDataID, 'category' );
  	 	$createDate = get_the_date('d.m.Y', $postDataID);
  		$img = wp_get_attachment_image_src( get_post_thumbnail_id($postDataID), 'full' );

  		if($img){
  			$thmbImg = $img[0];
  		}

		$business = get_post_meta( $postDataID, 'choose_business', true );
		$insight_link = get_permalink( $postDataID );
		$insightcontent = get_kc_excerpt();

		for($i=1; $i<=5; $i++)
		{
			$invitename = ''; $inviterole = ''; $invite_pic = ''; $inviteimag = '';
			$invitename =  get_post_meta( $postDataID, 'invite_name_'.$i, true );
			$inviterole =  get_post_meta( $postDataID, 'role_'.$i, true );
			$inviteimag =  get_post_meta( $postDataID, 'image_'.$i, true );
			if($inviteimag){
				$invite_imgurl = wp_get_attachment_image_src($inviteimag);
				$invite_pic = $invite_imgurl[0];
			}

			$postPeople[] = array(
				'name' => $invitename,
				'role' => $inviterole,
				'image' => $invite_pic
			);
		}

		foreach ($insightCat as $value) {
			$catName .= $value->name.',';
		}

		if($tagName){
			foreach ($tagName as $value) {
			$topicname .= $value->name.',';
			}
		}
		
		$reqData[]= array(
			'id' => $postDataID,		
		    'title' => html_entity_decode($title),
		    'date' => $createDate,
		    'type' => rtrim($topicname, ','),
		    'topics' => rtrim($catName, ','),
		    'business_type' => $business,
		    'image_url' => $thmbImg,
		    'insight_page_link' => $insight_link,
		    'content' =>$insightcontent,
		    'insight_organizer' => $postPeople
		);

	endwhile;

	$postarray = array(
	  "status" => true,
	  "insight_result" => $reqData
	);
  	
  	//$posturl = "https://tcglobalportalservice.optisolbusiness.com/api/insights/thirdpartyapi/AddEditInsights";  // staging api

  	$posturl = "https://portalapi.tcglobal.com/api/insights/thirdpartyapi/AddEditInsights"; // live api
	$InsightresultData = createPostData($posturl,$postarray);
	 
	endif;
	
	}

}

function createPostData($url,$data)
{	
	header('Content-Type: application/json; charset=utf-8');
	
	$header = array("Content-Type: application/json");

	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	//CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode($data),
	CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);	
	curl_close($curl);
	if ($err) {
		return null; 
	} else {
		return $response;
	}
}
