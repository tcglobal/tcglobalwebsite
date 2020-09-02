<?php
include("service_box_shortcode.php");
include("icon_global_partner.php");
include("download_brochure_shortcode.php");
include("location_shortcode.php");
include("events_shortcode.php");
include("popular_event.php");
include("popular_insight.php");
include("tc_contact_form.php");

/**
 * Set 'with_front' to false for the 'ufaq' post type.
 */
add_filter( 'register_post_type_args', function( $args, $post_type )
{
    if( 'ufaq' === $post_type && is_array( $args ) )
            $args['rewrite']['with_front'] = false;

    return $args;
}, 99, 2 );

// shortcode hook - To diplay social share links
function social_share_details() {
  $share_btn = '';
  $share_btn = '<ul class="footerul">';
  $share_btn .= '<li><a target="_blank" href="'.get_option('facebook_url').'"><img src="/wp-content/uploads/2019/08/facebook.png" alt=""></a></li>';
  //$share_btn .= '<li><a target="_blank" href="'.get_option('linkedin').'"><img src="/wp-content/uploads/2019/08/linkedin.png" alt=""></a></li>';
  $share_btn .= '<li><a target="_blank" href="'.get_option('twitter_url').'"><img src="/wp-content/uploads/2019/08/twitter.png" alt=""></a></li>';
  //$share_btn .= '<li><a target="_blank" href="'.get_option('youtube').'"><img src="/wp-content/uploads/2019/08/youtube.png" alt=""></a></li>';
  $share_btn .= '<li><a target="_blank" href="https://www.instagram.com/tcglobalofficial/"><img src="/wp-content/uploads/2019/08/Instagram.png" alt=""></a></li>';
  $share_btn .= '</ul>';
  return $share_btn;
}
add_shortcode('social_share', 'social_share_details');

// hook - To get current year
function get_year() {

  $year = '&copy;'.date("Y");
  return $year;
}
add_shortcode('current_year', 'get_year');

// hook - To get terms and conditions
function get_terms_condition() {
$terms = '';
$terms .='<div class="pt-3 pb-3">';
$terms .='<div class="container">';
$terms .='<div class="row">';
$terms .='<div class="col-md-6 pl-0">';
$terms .='<div class="copyright">&copy;'.date("Y")." ".get_option('copy').'</div>';
$terms .='</div>';
$terms .='<div class="col-md-6 ">';
$terms .='<ul class="secondaryfooterul d-flex float-right">';
$terms .='<li><a data-toggle="modal" data-target="#TermsConditionsCustom"   data-keyboard="false" data-backdrop="static">'.get_option('terms').'</a></li>';
$terms .='<li><a data-toggle="modal" data-target="#PrivacyCustom"   data-keyboard="false" data-backdrop="static">'.get_option('privacy').'</a></li>';
$terms .='</ul>';
$terms .='</div>';
$terms .='</div>';
$terms .='</div>';
$terms .='</div>';

  return $terms;
}
add_shortcode('terms_condition', 'get_terms_condition');

/* Get page section heading & sub heading */
function heading_func( $atts ) {
  global $tc_head, $tc_subhead;
  $tc_head = $atts['title'];
  $tc_subhead = $atts['subtitle'];
}
add_shortcode( 'heading', 'heading_func' );

/* Get page section inner heading & inner sub heading */
function inner_heading_func( $atts ) {
  global $tc_innerhead, $tc_inner_subhead;
  $tc_innerhead = $atts['inner_title'];
  $tc_inner_subhead = $atts['inner_subtitle'];
  //return $tc_head . ' ' . $tc_subhead;
}
add_shortcode( 'inner_heading', 'inner_heading_func' );

/* Get page section heading & sub heading */
function paragraph_func( $atts ) {
  global $para_content1, $para_content2, $para_content3;
  $para_content1 = $atts['content1'];
  $para_content2 = $atts['content2'];
  $para_content3 = $atts['content3'];

}
add_shortcode( 'paragraph', 'paragraph_func' );
/* Get page section heading & sub heading */
function text_block_fun( $atts ) {
  global $text_content;
  $text_content = $atts['content'];
}
add_shortcode( 'text_block', 'text_block_fun' );

// Schedule custom post type
function tcschedule_fun() {
    $args = array(
            'label'                => 'Tc Schedule',
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'hierarchical'         => false,
            'query_var'            => true,
            'rewrite'              => array('slug' => 'tc-schedule', 'with_front'=> false),
            'capability_type'      => 'post',
            'has_archive'          => false,
            'menu_icon'            => 'dashicons-clock',
            'supports' => array(
                    'title',
                    'editor',
                    'custom-fields',
                    'thumbnail',
                   'page-attributes',
                   )
        );
    register_post_type( 'tc-schedule', $args );
}
add_action( 'init', 'tcschedule_fun' );



// Service Box custom post type
function service_box_fun() {
    $args = array(
            'label'                => 'Service Box',
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'hierarchical'         => false,
            'query_var'            => true,
            'rewrite'              => array('slug' => 'service-box', 'with_front'=> false),
            'capability_type'      => 'post',
            'has_archive'          => false,
            'menu_icon'            => 'dashicons-palmtree',
            //'taxonomies'          => array( 'category' ),
            'supports' => array(
                    'title',
                    'editor',
                    'custom-fields',
                    'thumbnail',
                   'page-attributes',
                   )
        );
    register_post_type( 'service-box', $args );
}
add_action( 'init', 'service_box_fun' );

// our impact custom post type
function our_impact() {
    $args = array(
            'label'                => 'Our Impact',
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'hierarchical'         => false,
            'query_var'            => true,
            'rewrite'              => array('slug' => 'our_imapct', 'with_front'=> false),
            'capability_type'      => 'post',
            'has_archive'          => false,
            'menu_icon'            => 'dashicons-video-alt',
            //'taxonomies'          => array( 'category' ),
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
    register_post_type( 'our_imapct', $args );
}
add_action( 'init', 'our_impact' );

// shortcode to display impact custom post type data
function get_our_impact($atts) {
global $post, $wpdb, $tc_head, $tc_subhead;
$impact_id = $atts['id'];
$layout = $atts['layout'];

$cls =''; $cls_new=''; $sub_cls='';
$active = ''; $link = ''; $icon = '';
$impact = '';

$sj=1;

$track_record_query = new WP_Query(
        array('post_type' => 'our_imapct',
                'order' => 'ASC',
                'tax_query' => array(
        array(
            'taxonomy' => 'impact-cat',   // taxonomy name
            'terms' => $impact_id,                  // term id, term slug or term name
          )
        )
      )
    );

if(empty($layout)){

    $impact .='<div class="ourimpactblock m-t-40 m-b-80">';
    $impact .='<div class="container">';
    $impact .='<div class="row">';
    $impact .='<div class="col-md-4 pr-0">';
    $impact .='<div class="smallheading text-uppercase ">';
    $impact .=$tc_head;
    $impact .='</div>';
    $impact .='<div class="boldheading">';
    $impact .=$tc_subhead;
    $impact .='</div>';
    $impact .='<div class="redpath"></div>';
    $impact .='</div>';
    $impact .='<div class="col-md-8">';
    $impact .='<div class="countsection">';
    $impact .='<div class="d-flex flex-fill">';
}

else{

  $impact .='<div class="global-investments-trackrecord m-t-20">';
  $impact .='<div class="container">';
  $impact .='<h3 class="desktop-sub-heading">'.$tc_head.'</h3>';
  $impact .='<h2 class="desktop-main-heading">'.$tc_subhead.'</h2>';
  $impact .='<div class="row p-t-30">';

}

while ($track_record_query->have_posts()) : $track_record_query->the_post();

    $track_id = get_the_ID();

   $number = get_post_meta( $track_id, 'number', true );
   $symbol = get_post_meta( $track_id, 'symbol', true );
   $first_content = get_post_meta( $track_id, 'first_content', true );
   $second_content = get_post_meta( $track_id, 'second_content', true );
   $img_id = get_post_meta( $track_id, 'icon', true );
   $impact_arrow = wp_get_attachment_image_src($img_id);

   $button = get_post_meta( $track_id, 'education_button', true );
   $button_link = get_post_meta( $track_id, 'education_link', true );
   $icon_id = get_post_meta( $track_id, 'education_button_icon', true );
   $button_icon = wp_get_attachment_image_src($icon_id);

   if(!empty($button)){ $active = $button; }
   if(!empty($button_link)) { $link = $button_link; }
   if(!empty($button_icon)) { $icon = $button_icon; }

   $popup_action = '';

   if($link == 'global-ed-form')
    {
      $popup_action='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
    }



        if(empty($layout)){

            if($sj <=3){ $add_cls = "rightborder";}
            elseif($sj == 4){ $add_cls="pl-3"; }
            if($sj == 1){ $sub_cls = "pr-3 pt-2"; }
            elseif ($sj >=2) { $sub_cls = "pr-3 pt-2"; }
            if($sj == 1 || $sj == 4){
              $cls_new ="";
            }
            elseif($sj == 2 || $sj == 3){
              $cls_new = "pl-0";
            }

            $impact .='<div class="'.$add_cls.' '.$cls_new.'">';
            $impact .='<div class="d-flex ">';
            $impact .='<div class="'.$sub_cls.'">';
            $impact .='<img src="'.$impact_arrow[0].'" alt="">';
            $impact .='</div>';
            $impact .='<div>';
            $impact .='<div class="countname">'.$number.'<span class="pl-1">'.$symbol.'</span></div>';
            $impact .='<div class="countdesc">'.$first_content.'</div>';
            $impact .='<div class="countdesc">'.$second_content.'</div>';
            $impact .='</div>';
            $impact .='</div>';
            $impact .='</div>';

          $sj++;

        }

        else{

            $impact .='<div class="col-sm-3 bor-rht">';
            $impact .='<div class="container">';
            $impact .='<div class="row">';
            $impact .='<div class="col-sm-2 pr-0">';
            $impact .='<img src="'.$impact_arrow[0].'" class="img-fluid" alt="" />';
            $impact .='</div>';
            $impact .='<div class="col-sm-10">';
            $impact .='<h4>'.$number.'<span>'.$symbol.'</span></h4>';
            $impact .='<p class="fs-14">'.get_post_field('post_content', $track_id).'</p>';
            $impact .='</div>';
            $impact .='</div>';
            $impact .='</div>';
            $impact .='</div>';
        }

  endwhile;

if(empty($layout)) {
    $impact .='</div>';
    $impact .='</div>';
    $impact .='</div>';
    $impact .='</div>';
    $impact .='</div>';
    $impact .='</div>';
}
else{

  $impact .='</div>';

$impact .='<div class="row">';
$impact .='<div class="col-sm-12 text-center m-t-60">';
$impact .='<a href="'.$link.'" '.$popup_action.'><button type="button" class="btn btn-theme">'.$active.'<img src="'.$icon[0].'"></button></a>';
$impact .='</div>';
$impact .='</div>';

$impact .='</div>';
$impact .='</div>';

}
wp_reset_postdata();
return $impact;
}
add_shortcode('our_impact_section', 'get_our_impact');

// citizenship custom post
function citizenship() {
    $args = array(
            'label'                => 'Global Sections',
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'hierarchical'         => false,
            'query_var'            => true,
            'rewrite'              => array('slug' => 'citizenship', 'with_front'=> false),
            'capability_type'      => 'post',
            'has_archive'          => false,
            'menu_icon'            => 'dashicons-video-alt',
            //'taxonomies'          => array( 'category' ),
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
    register_post_type( 'citizenship', $args );
}
add_action( 'init', 'citizenship' );


// shortcode to display citizenship custom post type data
function get_citizenship_content($atts) {

global $post, $wpdb, $tc_head, $tc_subhead;
  $citizenship = '';
  $cur_page_id = $post->ID; // get current page id
  $citizenship_id = $atts['id'];


  $qry = "SELECT ID FROM `tc19_posts` WHERE `post_type` = 'citizenship' AND `post_status` = 'publish'";
  $res_data = $wpdb->get_results($qry);

foreach ($res_data as $key => $value) {
  $cur_postid = $value->ID;
  $cur_section = get_post_meta( $cur_postid, 'display_section', true );

  $citizenship_title = get_post_meta( $cur_postid, 'citizenship_title', true );
  $citizenship_maintitle = get_post_meta( $cur_postid, 'citizenship_main_title', true );
  $citizenship_subtitle = get_post_meta( $cur_postid, 'citizenship_sub_title', true );
  $heading = nl2br($citizenship_maintitle ."\n".$citizenship_subtitle);
  $citizenship_button = get_post_meta( $cur_postid, 'citizenship_button', true );
  $citizenship_link = get_post_meta( $cur_postid, 'citizenship_link', true );
  $button_arrow = get_post_meta( $cur_postid, 'button_arrow', true );
  $arrow_img = wp_get_attachment_image_src($button_arrow);
  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($cur_postid), 'full' );

if($citizenship_id == $cur_postid){

    $citizenship .='<div class="aboutblock position-relative">';
    $citizenship .='<div class="rightbg position-absolute" style="background: url('.$thumb[0].') no-repeat;"></div>';
    $citizenship .='<div class="container ">';
    $citizenship .='<div class="row ">';
    $citizenship .='<div class="col-md-6">';
    $citizenship .='<div class="aboutblock__container">';
    $citizenship .='<div class="smallheading text-uppercase ">';
    $citizenship .=$citizenship_title;
    $citizenship .='</div>';
    $citizenship .='<div class="boldheading">';
    $citizenship .= $heading;
    $citizenship .='</div>';
    $citizenship .='<div class="brownpath"></div>';
    $citizenship .='<div class="content m-t-30">';
    $citizenship .=get_post_field('post_content', $cur_postid);
    $citizenship .='</div>';
    $citizenship .='<div class="morebtn m-t-40">';
    $citizenship .='<a href="'.$citizenship_link.'" class="text-uppercase text-decoration-none">'.$citizenship_button.'<span><img src="'.$arrow_img[0].'" alt=""></span></a>';
    $citizenship .='</div>';
    $citizenship .='</div>';
    $citizenship .='</div>';
    $citizenship .='<div class="col-md-6 ">';
    $citizenship .='</div>';
    $citizenship .='</div>';
    $citizenship .='</div>';
    $citizenship .='</div>';
  }

}

return $citizenship;
}
add_shortcode('citizenship_details', 'get_citizenship_content');

// solutions custom post type
function solutions() {
    $args = array(
            'label'                => 'Solutions',
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'hierarchical'         => false,
            'query_var'            => true,
            'rewrite'              => array('slug' => 'solutions', 'with_front'=> false),
            'capability_type'      => 'post',
            'has_archive'          => false,
            'menu_icon'            => 'dashicons-video-alt',
            //'taxonomies'          => array( 'category' ),
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
    register_post_type( 'solutions', $args );
}
add_action( 'init', 'solutions' );


// shortcode to display solutions custom post type data
function get_solutions() {

global $post, $wpdb;
$query = "SELECT ID FROM `tc19_posts` WHERE `post_type` = 'solutions' AND `post_status` = 'publish'";
$res = $wpdb->get_results($query);

$items = array();
foreach ($res as $key => $value) {
  $items[] = $value->ID;
}

$cur_page_id = $post->ID; // get current page id
$sql = "SELECT post_id FROM `tc19_postmeta` WHERE `meta_key` = 'solution_choose_page' AND `meta_value` = '$cur_page_id'";
$response = $wpdb->get_results($sql);
$items_one = array();
foreach ($response as $key1 => $value1) {
  $items_one[] = $value1->post_id;
}
$result = array_intersect($items, $items_one);

$args = array( 'post_type' => 'solutions', 'post__in' => $result, 'order' => 'ASC');
$query = new WP_Query( $args );
$count = 0;
$solutions = '';
$solutions .='<div class="solutionblock m-t-80">';
$solutions .='<div class="container">';
$solutions .='<div class="text-center">';
$solutions .='<div class="smallheading text-uppercase ">';
$solutions .= get_post_field('post_content', '78');
$solutions .='</div>';
$solutions .='<div class="boldheading">';
$solutions .= get_the_title('78');
$solutions .='</div>';
$solutions .='<div class="path"></div>';
$solutions .='</div>';

$solutions .='<div class="row row-eq-height">';
while ( $query->have_posts() ) : $query->the_post();

$count++;
if ($count == 1){ $class="redborder"; $class1="redtext";}
else if ($count == 2){ $class="orangeborder"; $class1="orangetext";}
else if ($count == 3){ $class="blueborder"; $class1="bluetext";}
else if ($count == 4){ $class="torquoiseborder"; $class1="torquoisetext";}
$solution_arrow = get_post_meta( $post->ID, 'arrow_image', true );
$arrow = wp_get_attachment_image_src($solution_arrow);
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );

$solutions .='<div class="col-md-3">';
  $solutions .='<div class="rectangle '.$class.'" onclick="window.location = \''.get_permalink($post->ID).'\'" >';
     $solutions .='<div class="position-relative">';
        $solutions .='<img src="'.$img[0].'" alt="" class="img-fluid imgfront">';
        $solutions .='<div class="whiteiconbox position-absolute d-flex align-items-center justify-content-center">';
           $solutions .='<img alt="" src="'.$arrow[0].'" class="img-fluid">';
        $solutions .='</div>';
     $solutions .='</div>';
     $solutions .='<div class="solutionsubcontent">';
        $solutions .='<div class="solutionname '.$class1.'">'.get_the_title( $post->ID ).'</div>';
        $solutions .='<div class="solutioncontent">'.get_post_field('post_content', $post->ID).'</div>';
     $solutions .='</div>';
  $solutions .='</div>';
$solutions .='</div>';


endwhile;
wp_reset_postdata();
$solutions .='</div>';
$solutions .='</div>';
$solutions .='</div>';
return $solutions;
}
add_shortcode('solutions', 'get_solutions');

// join movement custom post type
function join_content() {
    $args = array(
            'label'                => 'Join movement',
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'hierarchical'         => false,
            'query_var'            => true,
            'rewrite'              => array('slug' => 'join_content', 'with_front'=> false),
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
    register_post_type( 'join_content', $args );
}
add_action( 'init', 'join_content' );


// hook - To get about us detail page
function display_aboutus_detail() {

  ?>
<style>
#menu-item-60 a {color: #da1f3d;}
</style>

<?php

  global $post, $text_content;

  $leader_link1 = get_post_meta( $post->ID, 'button_one_link', true );
  $leader_link2 = get_post_meta( $post->ID, 'button_two_link', true );
  $leader_btn1 = get_post_meta( $post->ID, 'button_one', true );
  $leader_btn2 = get_post_meta( $post->ID, 'button_two', true );

$feature_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
$about_detail = '<div class="about-member-view">';
$about_detail .='<div class="container">';
$about_detail .='<div class="row">';
$about_detail .='<div class="col-sm-6">';
$about_detail .='<h3>'.get_post_meta( $post->ID, 'title_one', true ).'</h3>';
$about_detail .='<h4>'.get_post_meta( $post->ID, 'title_two', true ).'</h4>';
$about_detail .= $text_content;
$about_detail .='<div class="row">';

if($leader_btn1)
{
  $about_detail .='<div class="col-sm-5">';
  $about_detail .='<a href="'.$leader_link1.'"><button type="button" class="btn btn-block btn-red">'.$leader_btn1.'<img src="/wp-content/uploads/2019/08/whiteforward.png" alt="" /></button></a>';
  $about_detail .='</div>';
}

if($leader_btn2){
  $about_detail .='<div class="col-sm-7">';
  $about_detail .='<a href="'.$leader_link2.'"><button type="button" class="btn btn-block">'.$leader_btn2.'<img src="/wp-content/uploads/2019/08/down_2.png" alt="" /></button></a>';
  $about_detail .='</div>';
}

$about_detail .='</div>';
$about_detail .='</div>';
$about_detail .='<div class="col-sm-6">';

if($feature_img){
  $about_detail .='<img src="'.$feature_img[0].'" class="img-fluid" />';
}
else{
  $about_detail .='<img src="/wp-content/uploads/2019/12/no-photo-available.jpg" class="img-fluid" />';
}

$about_detail .='</div>';
$about_detail .='</div>';
$about_detail .='</div>';
$about_detail .='</div>';

return $about_detail;
}
add_shortcode('aboutus_detail', 'display_aboutus_detail');
// hook - To get about us read page
function display_aboutus_read() {

?>
<style>
#menu-item-60 a {color: #da1f3d;}
</style>

<?php

  global $post, $text_content;

$feature_img1 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
$btn_one = get_post_meta( $post->ID, 'button_one', true );
$detail_read = '<div class="about-member-view">';
$detail_read .='<div class="container">';
$detail_read .='<div class="row">';
$detail_read .='<div class="col-sm-6">';
$detail_read .='<h3>'.get_post_meta( $post->ID, 'title_one', true ).'</h3>';
$detail_read .=$text_content;
$detail_read .='<div class="row">';
$detail_read .='<div class="col-sm-12">';
if($btn_one){
  $detail_read .='<a href="'.get_post_meta( $post->ID, 'button_one_link', true ).'"><button type="button" class="btn btn-block text-left px-0 mt-0">'.$btn_one.'<img src="/wp-content/uploads/2019/08/down_2.png" alt="" /></button></a>';
}
$detail_read .='</div>';
$detail_read .='</div>';
$detail_read .='</div>';
$detail_read .='<div class="col-sm-6">';
$detail_read .='<img src="'.$feature_img1[0].'" class="img-fluid" />';
$detail_read .='</div>';
$detail_read .='</div>';
$detail_read .='</div>';
$detail_read .='</div>';

return $detail_read;
}
add_shortcode('aboutus_detail_read', 'display_aboutus_read');


// hook - To get about us banner detail
function get_aboutus_page($atts) {
global $post;
$cur_pageid = $post->ID;
$layout = $atts['layout'];

$image = wp_get_attachment_image_src( get_post_thumbnail_id($cur_pageid), 'single-post-thumbnail' );
$banner_title = get_post_meta( $cur_pageid, 'banner_title', true );
$additional_class= get_post_meta( $cur_pageid, 'additional_class', true );

$banner_content = get_post_meta( get_the_ID(), 'banner_content', true );
$button = get_post_meta( get_the_ID(), 'button_text', true );
$link = get_post_meta( get_the_ID(), 'button_link', true );

$about_page ='';

if($layout == 'style_one'){

   $about_page .='<div class="'.$additional_class.' bannerblock">
      <div class="bannerformsection position-absolute h-auto m-t-40">
        <div class="boldheading">
          '.$banner_title.'
        </div>
        <div class="redpath"></div>
        <div class="bannerdesc m-t-25 m-b-30">
          '.$banner_content.'
        </div>
        <a href='.$link.' class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">'.$button.'<span class="pl-3"><img src="/wp-content/uploads/2019/08/down_2.png" alt=""></span></a>
      </div>
      <div class="templatetwo-banner">
        <div class="bg-color"></div>
        <img src="'.$image[0].'" alt="" class="img-fluid">
      </div>
    </div>';

}
else{

$about_page ='<div id="banner_image_full_width" class="'.$additional_class.' hide" style="background: url('.$image[0].') no-repeat;">';
  $about_page .='<div class="bg-color"></div>';
    $about_page .='<div class="container position-relative">';
      $about_page .='<div class="row align-items-center">';
        $about_page .='<div class="col">';
          $about_page .='<h2 class="main-heading">'.$banner_title.'</h2>';
          $about_page .='</div>';
      $about_page .='</div>';
    $about_page .='</div>';
$about_page .='</div>';

}

  return trim($about_page);
}
add_shortcode('banner', 'get_aboutus_page');

// To get about us Discover TC Global Solutions section
function get_discover_detail($atts) {

global $tc_head, $tc_subhead, $post, $wpdb;
$discover_detail_id = $atts['id'];

  //$cur_page_id = $post->ID; // get current page id
  $aboutblock = '';
  $query_data = "SELECT ID FROM `tc19_posts` WHERE `post_type` = 'citizenship' AND `post_status` = 'publish'";
  $discover_res = $wpdb->get_results($query_data);

  foreach ($discover_res as $key => $value) {

    $cur_postid = $value->ID;
    $cur_section = get_post_meta( $cur_postid, 'display_section', true );
    $button = get_post_meta( $cur_postid, 'citizenship_button', true );
    $link = get_post_meta( $cur_postid, 'citizenship_link', true );
    $arrow = get_post_meta( $cur_postid, 'button_arrow', true );
    $arrow_img = wp_get_attachment_image_src($arrow);
    $attach_img = wp_get_attachment_image_src( get_post_thumbnail_id($cur_postid), 'full' );

  if($discover_detail_id == $cur_postid){
    $aboutblock  ='<div class="aboutblock">';
    $aboutblock .= '<div class="container ">';
    $aboutblock .='<div class="row ">';
    $aboutblock .='<div class="col-md-6">';
    $aboutblock .='<div class="aboutblock__container">';
    $aboutblock .='<div class="smallheading text-uppercase ">';
    $aboutblock .=$tc_head;
    $aboutblock .='</div>';
    $aboutblock .='<div class="boldheading">';
    $aboutblock .=$tc_subhead;
    $aboutblock .='</div>';
    $aboutblock .='<div class="brownpath"></div>';
    $aboutblock .='<div class="content m-t-30">'.get_post_field('post_content', $cur_postid).'</div>';
    $aboutblock .='<div class="morebtn m-t-40">';
    $aboutblock .='<a href="'.$link.'" class="text-uppercase text-decoration-none">'.$button.'<span><img src="'.$arrow_img[0].'" alt="" width="13"></span></a>';
    $aboutblock .='</div>';
    $aboutblock .='</div>';
    $aboutblock .='</div>';
    $aboutblock .='<div class="col-md-6 text-center"><img src="'.$attach_img[0].'" alt="" class="img-fluid mt-4" /></div>';
    $aboutblock .='</div>';
    $aboutblock .='</div>';
    $aboutblock .='</div>';
    }
}
wp_reset_postdata();
  return trim($aboutblock);

}
add_shortcode('discover_detail', 'get_discover_detail');

/* display about us we are tc global section */
add_shortcode('we_are_tcglobal', 'get_we_are_tcglobal');
function get_we_are_tcglobal($atts ) {
  global $tc_head, $tc_subhead, $post, $wpdb;
  $we_are_tcglobal_id = $atts['id'];
  $layout = $atts['layout'];
  $about_section = '';

  $title = get_post_meta( $we_are_tcglobal_id, 'citizenship_title', true );
  $tc_img = wp_get_attachment_image_src( get_post_thumbnail_id($we_are_tcglobal_id), 'full' );
  $additional_class_name = get_post_meta( $we_are_tcglobal_id, 'class_name_for_web', true );
  $button = get_post_meta( $we_are_tcglobal_id, 'citizenship_button', true );
  $url = get_post_meta( $we_are_tcglobal_id, 'citizenship_link', true );

  if($layout == 'style_one')
   {

    $about_section .= '<div class="about-explain-section '.$additional_class_name.' ">';
    $about_section .='<div class="container-fluid">';
    $about_section .='<div class="text-center">';
    $about_section .='<div class="smallheading text-uppercase ">'.$tc_head.'</div>';
    $about_section .='<div class="boldheading">'.$tc_subhead.'</div>';
    $about_section .='<div class="path"></div>';
    $about_section .='</div>';
    $about_section .='<div class="row justify-content-center">';
    $about_section .='<div class="col-sm-10 mt-3">';
    $about_section .='<div class="row">';
    $about_section .='<div class="col-sm-6 text-right">';
    $about_section .='<img src="'.$tc_img[0].'" class="img-fluid" alt="" />';
    $about_section .='</div>';
    $about_section .='<div class="col-sm-6">';
    $about_section .='<h3>'.$title.'</h3>';
    $about_section .='<p>'.get_post_field('post_content', $we_are_tcglobal_id).'</p>';
    $about_section .='</div>';
    $about_section .='</div>';
    $about_section .='</div>';
    $about_section .='</div>';
    $about_section .='</div>';
    $about_section .='</div>';
 }

  elseif($layout == 'style_two'){

    $about_section .='<div class="about-explain-section p-t-80'.$additional_class_name.'">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-sm-10 mt-3">
              <div class="row">
                <div class="col-sm-6 text-right">
                  <img src="'.$tc_img[0].'" class="img-fluid" alt="" />
                </div>
                <div class="col-sm-6 pr-5">
                  <h3 class="pt-0">'.$title.'</h3>
                  <p>'.get_post_field('post_content', $we_are_tcglobal_id).'</p>
                  <h3 class="pt-3"><a href="'.$url.'"><button type="button" class="btn btn-theme w-auto px-4">'.$button.'</button></a></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
  }

  return $about_section;
}

/* About us our values section */
function display_our_values($atts) {
  global $tc_head, $tc_subhead, $post, $wpdb;

$ourvalue_category_id = $atts['category_id'];

 $loop = new WP_Query(
        array('post_type' => 'solutions',
                'order' => 'ASC',
          'tax_query' => array(
        array(
            'taxonomy' => 'solution-cat',   // taxonomy name
            'terms' => $ourvalue_category_id,                  // term id, term slug or term name
          )
        )
          )
    );

$our_value ='';
$our_value .='<div class="about-ourvalues m-t-40">';
$our_value .='<div class="container">';
$our_value .='<div class="text-center">';
$our_value .='<div class="smallheading text-uppercase">';
$our_value .= $tc_head;
$our_value .='</div>';
$our_value .='<div class="boldheading">';
$our_value .= $tc_subhead;
$our_value .='</div>';
$our_value .='<div class="path"></div>';
$our_value .='</div>';
$our_value .='<div class="row">';

while ( $loop->have_posts() ) : $loop->the_post();

    $our_value_arrow = get_post_meta( $post->ID, 'arrow_image', true );
    $our_value_img = wp_get_attachment_image_src($our_value_arrow);

        $our_value .='<div class="col-sm-6">';
        $our_value .='<div class="row">';
          $our_value .='<div class="col-sm-2">';
            $our_value .='<img src="'.$our_value_img[0].'" alt="" class="img-fluid" >';
          $our_value .='</div>';
          $our_value .='<div class="col-sm-10">';
            $our_value .='<h3>'.get_the_title( $post->ID ).'</h3>';
            $our_value .='<p>'.get_post_field('post_content', $post->ID).'</p>';

          $our_value .='</div>';
        $our_value .='</div>';
      $our_value .='</div>';


  endwhile;
  wp_reset_postdata();


          $our_value .='</div>';
        $our_value .='</div>';
      $our_value .='</div>';
return $our_value;

}

add_shortcode('our_values', 'display_our_values');

/* About us university details */

function get_university_details($atts) {

  global $tc_head, $tc_subhead, $post, $wpdb, $para_content1, $para_content2, $para_content3;
  $university = '';
  $university_details_id = $atts['id'];

  $qry3 = "SELECT ID FROM `tc19_posts` WHERE `post_type` = 'citizenship' AND `post_status` = 'publish'";
  $res_data2 = $wpdb->get_results($qry3);

  foreach ($res_data2 as $key => $value) {
    $cur_postid = $value->ID;
    $cur_section = get_post_meta( $cur_postid, 'display_section', true );

    $universe_title = get_post_meta( $cur_postid, 'citizenship_title', true );
    $universe_img = wp_get_attachment_image_src( get_post_thumbnail_id($cur_postid), 'full' );
    $universe_arrow = get_post_meta( $cur_postid, 'button_arrow', true );
    $universe_arrow_img = wp_get_attachment_image_src($universe_arrow);

  if($university_details_id == $cur_postid){

    $university .='<div class="about-university position-relative">';
  $university .='<div class="banner-bg position-absolute" style="background: url('.$universe_img[0].') no-repeat;"></div>';
  $university .='<div class="container">';
    $university .='<div class="row">';

        $university .='<div class="col-md-6">';
        $university .='<div class="col-sm-12 p-0">';
          $university .='<div class="smallheading text-uppercase ">'.$tc_head.'</div>';
          $university .='<div class="boldheading">';
          $university .= $tc_subhead;
            $university .='</div>';
          $university .='<div class="brownpath"></div>';
          $university .='<h4>'.$universe_title.'</h4>';
             $university .='<div class="row">';
               $university .='<div class="col-sm-12 pr-0">';
                 $university .='<div class="list-arrow"><img src="'.$universe_arrow_img[0].'" class="img-fluid" alt="" /></div>';
                 $university .='<p>'.$para_content1.'</p>';
               $university .='</div>';
             $university .='</div>';
             $university .='<div class="row">';
               $university .='<div class="col-sm-12 pr-0">';
                 $university .='<div class="list-arrow"><img src="'.$universe_arrow_img[0].'" class="img-fluid" alt="" /></div>';
                 $university .='<p>'.$para_content2.'</p>';
                $university .='</div>';
               $university .='</div>';
               $university .='<div class="row">';
                 $university .='<div class="col-sm-12 pr-0">';
                   $university .='<div class="list-arrow"><img src="'.$universe_arrow_img[0].'" class="img-fluid" alt="" /></div>';
                   $university .='<p>'.$para_content3.'</p>';
                   $university .='</div>';
                 $university .='</div>';
               $university .='</div>';
             $university .='</div>';
             $university .='<div class="col-md-6 ">';
             $university .='</div>';


        $university .='</div>';
         $university .='</div>';
       $university .='</div>';


  }

}
  return $university;
}
add_shortcode('university_details', 'get_university_details');

/*About us timeline section */
function timeline_details($atts){
  global $tc_head, $tc_subhead, $post, $wpdb;
  $timeline = '';
  $timeline_count = 0;
  $timeline_category_id = $atts['category_id'];

  $timeline_query = new WP_Query(
        array('post_type' => 'te_announcements',
                'order' => 'DESC',
          'tax_query' => array(
        array(
            'taxonomy' => 'timeline_cat',   // taxonomy name
            'terms' => $timeline_category_id,                  // term id, term slug or term name
          )
        )
          )
    );

  $timeline .='<div class="story-timeline m-t-40">';
  $timeline .='<div class="container">';
  $timeline .='<div class="text-center">';
  $timeline .='<div class="smallheading text-uppercase">';
  $timeline .= $tc_head;
  $timeline .='</div>';
  $timeline .='<div class="boldheading">';
  $timeline .= $tc_subhead;
  $timeline .='</div>';
  $timeline .='<div class="path"></div>';
  $timeline .='</div>';
  $timeline .='<div class="row justify-content-center">';
  $timeline .='<div class="col-sm-11 mt-3">';
  $timeline .='<ul class="timeline">';

  if($timeline_query->have_posts()) :
  while ($timeline_query->have_posts()) :
        $timeline_query->the_post();
        $timeline_id = get_the_ID();

    $timeline_arrow = get_post_meta( $timeline_id, 'timeline_arrow', true );
    $timeline_arrow_img = wp_get_attachment_image_src($timeline_arrow);

    if($timeline_count == 0){

      $timeline .='<li>';
      $timeline .='<div class="timeline-panel">';
      $timeline .='<h4>'.get_post_meta( $timeline_id, 'timeline_title', true ).'</h4>';
      $timeline .='<p>'.get_post_field('post_content', $timeline_id).'</p>';
      $timeline .='</div>';
      $timeline .='<div class="timeline-inverted">';
      $timeline .='<div class="timeline-badge warning">';
      $timeline .='<img src="'.$timeline_arrow_img[0].'" class="img-fluid" alt="" />';
      $timeline .='</div>';
      $timeline .='<div class="timeline-panel float-right">';
      $timeline .='<img src="'.get_post_meta( $timeline_id, 'announcement_image', true ).'" class="img-fluid" alt="" />';
      $timeline .='</div>';
      $timeline .='</div>';
      $timeline .='</li>';

    }
    elseif($timeline_count == 1){

      $timeline .='<li>';
      $timeline .='<div class="timeline-badge">';
      $timeline .='<img src="'.$timeline_arrow_img[0].'" class="img-fluid" alt="" /></div>';
      $timeline .='<div class="timeline-inverted">';
      $timeline .='<div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>';
      $timeline .='<div class="timeline-panel">';
      $timeline .='<img src="'.get_post_meta( $timeline_id, 'announcement_image', true ).'" class="img-fluid" alt="" />';
      $timeline .='</div>';
      $timeline .='</div>';
      $timeline .='<div class="timeline-panel float-right">';
      $timeline .='<h4>'.get_post_meta( $timeline_id, 'timeline_title', true ).'</h4>';
      $timeline .='<p>'.get_post_field('post_content', $timeline_id).'</p>';
      $timeline .='</div>';
      $timeline .='</li>';

    }
    elseif($timeline_count == 2){

      $timeline .='<li>';
      $timeline .='<div class="timeline-badge">';
      $timeline .='<img src="'.$timeline_arrow_img[0].'" class="img-fluid" alt="" /></div>';
      $timeline .='<div class="timeline-panel">';
      $timeline .='<h4>'.get_post_meta( $timeline_id, 'timeline_title', true ).'</h4>';
      $timeline .='<p>'.get_post_field('post_content', $timeline_id).'</p>';
      $timeline .='</div>';
      $timeline .='<div class="timeline-inverted">';
      $timeline .='<div class="timeline-panel float-right">';
      $timeline .='<img src="'.get_post_meta( $timeline_id, 'announcement_image', true ).'" class="img-fluid" alt="" />';
      $timeline .='</div>';
      $timeline .='</div>';
      $timeline .='</li>';

    }
    $timeline_count++;

   endwhile;
endif;
 wp_reset_postdata();

$timeline .='</ul>';
$timeline .='</div>';
$timeline .='</div>';
$timeline .='</div>';
$timeline .='</div>';

return $timeline;

}
add_shortcode('timeline', 'timeline_details');

/* To get team member details */
function get_member_details($atts){
  global $tc_head, $tc_subhead, $post, $wpdb, $tc_innerhead, $tc_inner_subhead;

  $member ='';

  $category_one = $atts['category_one'];
  $category_two = $atts['category_two'];
  $category_three = $atts['category_three'];

  // Get all subcategories related to the provided $category ($term)
    $subcategories = get_terms(
        array(
            'taxonomy'   => 'tsas-category',
            'orderby'    => 'term_id',
            'hide_empty' => true
        )
    );

  $member .='<div class="about-leadership p-t-80 p-b-80" id="leaderboard">';
  $member .='<div class="container">';
  $member .='<div class="text-center">';
  $member .='<div class="boldheading">'.$tc_head.'</div>';
  $member .='<div class="path"></div>';
  $member .='</div>';

  $member .='<div class="row justify-content-center">';
  $member .='<div class="col-sm-10">';
  $member .='<div class="smallheading text-uppercase">'.$tc_subhead.'</div>';
  $member .='<div class="row">';

  foreach ( $subcategories as $subcategory ) {

    $team_mem_query = new WP_Query(
        array('post_type' => 'team_showcase_post',
                'order' => 'ASC',
                'posts_per_page'=>-1,
          'tax_query' => array(
            array(
                'taxonomy' => 'tsas-category',   // taxonomy name
                'terms' => $subcategory->term_id,                  // term id, term slug or term name
              )
            )
          )
      );

  $i =1; $board_count = 5;

  $j =1; $coreleader_count = 4;

  if($team_mem_query->have_posts()) :
    while ($team_mem_query->have_posts()) : $team_mem_query->the_post();

      $team_mem_id = get_the_ID();
      $team_img = wp_get_attachment_image_src( get_post_thumbnail_id($team_mem_id), 'medium' );
      $team_arrow = get_post_meta( $team_mem_id, 'team_arrow_image', true );
      $team_arrow_img = wp_get_attachment_image_src($team_arrow);
      $pageUrl =   get_post_meta( $team_mem_id, 'team_page_link', true );

      if(empty($pageUrl))
      {
        $pageUrl = '#';
      }

      if($team_img){
        $photo = $team_img[0];
      }
      else{
        $photo = "/wp-content/uploads/2019/08/no-img.png";
      }

  /** our board categrory - start **/
    if($subcategory->term_id == $category_one){

        $member .='<div class="col member-list">';
        $member .='<a href="'.$pageUrl.'" title="'.get_the_title( $team_mem_id ).'"><img src="'.$photo.'" alt="" class="img-fluid profile" /></a>';
        $member .='<h3><img src="'.$team_arrow_img[0].'" alt="" class="img-fluid" >'.get_the_title( $team_mem_id ).'</h3>';
        $member .='<p>'.get_post_meta($team_mem_id, '_member_designation', true ).'</p>';
        $member .='</div>';

        if($i%$board_count == 0 ){
          $member .='</div></div></div>';

        }
    }

  /** our board categrory - end **/
  /** core leadership section - start **/
    elseif($subcategory->term_id == $category_three){

        if($j == 1){
          $member .='<div id="inter_member_show">';
          $member .='<div class="row justify-content-center mt-2">';
          $member .='<div class="col-sm-8">';
          $member .='<div class="smallheading text-uppercase">'.$tc_inner_subhead.'</div>';
          $member .='<div class="row">';

          $member .='<div class="col-sm-3 member-list">';
          $member .='<a href="'.$pageUrl.'" title="'.get_the_title( $international_id ).'"><img src="'.$photo.'" alt="" class="img-fluid profile" /></a>';
          $member .='<h3><img src="'.$team_arrow_img[0].'" alt="" class="img-fluid" ><span>'.get_the_title( $international_id ).'</span></h3>';
          $member .='<p>'.get_post_meta($team_mem_id, '_member_designation', true ).'</p>';
          $member .='</div>';
        }
      else{
        $member .='<div class="col-sm-3 member-list">';
        $member .='<a href="'.$pageUrl.'" title="'.get_the_title( $international_id ).'"><img src="'.$photo.'" alt="" class="img-fluid profile" /></a>';
        $member .='<h3><img src="'.$team_arrow_img[0].'" alt="" class="img-fluid" ><span>'.get_the_title( $international_id ).'</span></h3>';
        $member .='<p>'.get_post_meta($team_mem_id, '_member_designation', true ).'</p>';
        $member .='</div>';
      }


    }
  /** core leadership section - end **/

  $i++;
  $j++;

    endwhile;
  endif;

}

$member .='</div>';
$member .='</div>';
$member .='</div></div>';

$member .='<div class="row" id="see_mem_btn">';
$member .='<div class="col-sm-12">';
$member .='<a class="eventbtn d-block text-decoration-none mx-auto text-uppercase show_team_mem">Our Leadership Team<span><img src="/wp-content/uploads/2019/08/leader-downarrow.png" alt="" width="13"></span></a>';
$member .='</div>';
$member .='</div>';

$member .='<div class="row" id="hide-board">';
$member .='<div class="col-sm-12">';
$member .='<a href="#leaderboard" class="eventbtn d-block text-decoration-none mx-auto text-uppercase">hide board view<span><img src="/wp-content/uploads/2019/08/whiteforward.png" alt="" width="13"></span></a>';
$member .='</div>';
$member .='</div>';

$member .='</div>';
$member .='</div>';

 return $member;

}
add_shortcode('team_member', 'get_member_details');

include('faq_shortcode.php');

/** To get our solutions global education **/
function get_global_education($atts){
  global $tc_head, $tc_subhead, $post, $wpdb;
  $education_catid = $atts['id'];
  $education='';
  $active_element = ''; $active_element_tab='';

  $globaled_id = "SELECT object_id FROM `tc19_term_relationships` WHERE `term_taxonomy_id` = '$education_catid' ORDER BY `object_id` ASC";
  $get_globaled_id = $wpdb->get_results($globaled_id);

  $education .='<div class="desktop-icon-verticaltab p-t-80 p-b-80">';
  $education .='<div class="container">';
  $education .='<div class="row">';
  $i=1; $j=1;

    $education .='<div class="col-2 p-0">';
    $education .='<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">';
    foreach ($get_globaled_id as $key => $value) {

      $default_id = get_post_meta( $value->object_id, 'icon', true );
      $default_img = wp_get_attachment_image_src($default_id);
      $active_id = get_post_meta( $value->object_id, 'active_icon', true );
      $active_img = wp_get_attachment_image_src($active_id);


        if($i == 1){
          $active_element = 'v-pills-home';
          $education .='<a class="nav-link active" id="'.$active_element.'-tab" data-toggle="pill" href="#'.$active_element.'" role="tab" aria-controls="'.$active_element.'" aria-selected="true">
                <img class="default" src="'.$default_img[0].'" alt="" /><img class="current" src="'.$active_img[0].'" alt="" /><span>'.get_the_title($value->object_id).'</span></a>';
          }
        else{
          if($i == 2){$active_element = 'v-pills-profile';}
          elseif($i == 3){$active_element = 'v-pills-messages';}
          elseif($i == 4){$active_element = 'v-pills-settings';}
          $education .='<a class="nav-link" id="'.$active_element.'-tab" data-toggle="pill" href="#'.$active_element.'" role="tab" aria-controls="'.$active_element.'" aria-selected="false">
                <img class="default" src="'.$default_img[0].'" alt="" /><img class="current" src="'.$active_img[0].'" alt="" /><span>'.get_the_title($value->object_id).'</span></a>';
        }
          $i++;
    }
    $education .='</div>';
    $education .='</div>';

    $education .='<div class="col-10">';
    $education .='<div class="tab-content" id="v-pills-tabContent">';

    foreach ($get_globaled_id as $key => $value) {

      $edu_img = wp_get_attachment_image_src( get_post_thumbnail_id($value->object_id), 'full' );
      $arrow_id = get_post_meta( $value->object_id, 'education_button_icon', true );
      $eduarrow_img = wp_get_attachment_image_src($arrow_id);

      if($j == 1){
          $active_element_tab = 'v-pills-home';
          $education .='<div class="tab-pane fade show active" id="'.$active_element_tab.'" role="tabpanel" aria-labelledby="'.$active_element_tab.'-tab">';
          $education .='<div class="row">';
          $education .='<div class="col-sm-6 offset-sm-1">';
          $education .='<h2><span class="d-block">'.get_post_field('post_content', $value->object_id).'</h2>';
          //$education .='<p><span class="d-block">'. get_post_meta($value->object_id, 'title', true ).'</p>';
          $education .='<a href="'.get_post_meta($value->object_id, 'education_link', true ).'"><button type="button" class="btn btn-theme tab1-btn">'.get_post_meta($value->object_id, 'education_button', true ).'<img src="'.$eduarrow_img[0].'" /> </button></a>';
          $education .='</div>';
          $education .='<div class="col-sm-5 text-right">';
          $education .='<img src="'.$edu_img[0].'" alt="" />';
          $education .='</div>';
          $education .='</div>';
          $education .='</div>';
        }
      else{

          if($j == 2){$active_element_tab = 'v-pills-profile';}
          elseif($j == 3){$active_element_tab = 'v-pills-messages';}
          elseif($j == 4){$active_element_tab = 'v-pills-settings';}

          $education .='<div class="tab-pane fade" id="'.$active_element_tab.'" role="tabpanel" aria-labelledby="'.$active_element_tab.'-tab">';
          $education .='<div class="row">';
          $education .='<div class="col-sm-6 offset-sm-1">';
          $education .='<h2><span class="d-block">'.get_post_field('post_content', $value->object_id).'</h2>';
          //$education .='<p><span class="d-block">'.get_post_meta($value->object_id, 'title', true ).'</p>';
          $education .='<a href="'.get_post_meta($value->object_id, 'education_link', true ).'"><button type="button" class="btn btn-theme">'.get_post_meta($value->object_id, 'education_button', true ).'<img src="'.$eduarrow_img[0].'" /> </button></a>';
          $education .='</div>';
          $education .='<div class="col-sm-5 text-right">';
          $education .='<img src="'.$edu_img[0].'" alt="" />';
          $education .='</div>';
          $education .='</div>';
          $education .='</div>';

        }

        $j++;
    }
    $education .='</div>';
    $education .='</div>';
$education .='</div>';
$education .='</div>';
$education .='</div>';

return $education;
}
add_shortcode('global_education', 'get_global_education');


/** Testimonial Section **/

function get_testimonial_fun($atts){
  global $post, $wpdb, $tc_head, $tc_subhead;
  $testimonial_id = $atts['id'];
  $layout = $atts['layout'];

  $community_id = "SELECT object_id FROM `tc19_term_relationships` WHERE `term_taxonomy_id` = '$testimonial_id' ORDER BY `object_id` ASC";
  $get_community_id = $wpdb->get_results($community_id);

  $community='';

  if($layout == "style_two"){

    $community .='<div class="careers-community-insights p-t-20 p-b-30">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-11">
              <h6 class="desktop-sub-heading">'.$tc_head.'</h6>
              <h2 class="desktop-main-heading">'.$tc_subhead.'</h2>';

              $community .='<div class="row p-t-40 justify-content-between">';

  }
  else{

  $community .='<div id="CommunityInsights"  class="desktop-oursolution-comminsight p-t-80 p-b-80">';
  $community .='<div class="container">';
  $community .='<h3 class="desktop-sub-heading">'.$tc_head.'</h3>';
  $community .='<h2 class="desktop-main-heading">'.$tc_subhead.'</h2>';
  $community .='<section class="carousel slider p-t-40 tablet-upcoming-event my-0">';

}

  foreach ($get_community_id as $key => $value) {

    $community_img = wp_get_attachment_image_src( get_post_thumbnail_id($value->object_id), 'medium' );

    if($layout == "style_two"){

      $community .='<div class="col-sm-5">
                  <img class="img-fluid" src="'.$community_img[0].'" alt="" />
                  <h4>'.get_the_title($value->object_id).'</h4>
                  <h5>'.get_post_meta($value->object_id, '_member_designation', true ).'</h5>
                  <h3>'.get_post_field('post_content', $value->object_id).'</h3>
                </div>';

    }
    else{

    $community .='<div>';
    $community .='<div class="slide-item">';
    $community .='<img src="'.$community_img[0].'" class="img-fluid" />';
    $community .='<h3 class="fs-14 text-center">'.get_the_title($value->object_id).'</h3>';
    $community .='<h4 class="fs-14 text-center">'.get_post_meta($value->object_id, '_member_designation', true ).'</h4>';
    $community .='<p class="fs-14 text-center">'.get_post_field('post_content', $value->object_id).'</p>';
    $community .='</div>';
    $community .='</div>';

  }

}

if($layout == "style_two"){
  $community .='</div>';
  $community .='</div></div></div></div>';
}

else{
$community .='</section>';
$community .='</div>';
$community .='</div>';

}

  return $community;
}

add_shortcode('testimonial', 'get_testimonial_fun');


/** our solution page video section **/
function display_video_fun(){
  global $tc_head, $tc_subhead;

$video ='';
$video .='<div class="desktop-oursolution-watchstory">';
$video .='<div class="videotext"><h3 class="desktop-sub-heading">'.$tc_head.'</h3>';
$video .='<h2 class="desktop-main-heading">'.$tc_subhead.'</h2>
<img class="video-thumbnail" src="/wp-content/uploads/2019/08/video-thumbnail-lg.jpg"></div>';

$video .='<video width="100%" height="100%" loop id="myVideo">
  <source src="/wp-content/uploads/2019/11/tc_global_may-31st.mp4" type="video/mp4">
  </video>

  <a id="myBtn" onclick="videoFunction()"><img src="/wp-content/uploads/2019/08/video-play.png"></a>
</div>';

$video .='</div>';
return $video;

}
add_shortcode('video', 'display_video_fun');

/** Global education page second section **/
function become_global_fun($atts){
global $post, $wpdb, $tc_head, $tc_subhead;
$category_id = $atts['id'];
$bg_cls = $atts['bg_class'];
//$isPopup = $atts['popup'];
$become_global = '';
$i=1;
$background_cls = '';

$become_global_query = new WP_Query(
        array('post_type' => 'citizenship',
                'order' => 'ASC',
          'tax_query' => array(
        array(
            'taxonomy' => 'global-cat',   // taxonomy name
            'terms' => $category_id,                  // term id, term slug or term name
          )
        )
          )
    );



if($bg_cls){ $background_cls = $bg_cls; }

$become_global .='<div class="desktop-globaled-startjourney '.$background_cls.' p-t-80 p-b-80">';
$become_global .='<div class="container">';
$become_global .='<h3 class="desktop-sub-heading">'.$tc_head.'</h3>';
$become_global .='<h2 class="desktop-main-heading">'.$tc_subhead.'</h2>';

if($become_global_query->have_posts()) :
while ($become_global_query->have_posts()) : $become_global_query->the_post();

  $become_global_id = get_the_ID();

  $global_img = wp_get_attachment_image_src( get_post_thumbnail_id($become_global_id), 'full' );
  $link = get_post_meta( $become_global_id, 'citizenship_link', true );
  $additional_cls = get_post_meta( $become_global_id, 'class_name_for_web', true );
      $cls_val = '';
      $popup_action = '';
      if($additional_cls){ $cls_val = $additional_cls; }

   if($link == 'global-ed-form')
    {
      $popup_action='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
    }
    elseif($link == 'invest-portal-popup'){
      $popup_action='data-toggle="modal" data-target="#checkeligible" data-keyboard="false" data-backdrop="static" class="text-decoration-none portal-form-reset invest-portal-service"';
    }

  if($i%2==0){

        $become_global .='<div class="row">';
            $become_global .='<div class="col-sm-6">';
              $become_global .='<img src="'.$global_img[0].'" class="img-fluid" />';
            $become_global .='</div>';
            $become_global .='<div class="col-sm-6">';
              $become_global .='<h4 class="fs-20 pl-5 ml-3">'.get_the_title($become_global_id).'</h4>';
                 $become_global .='<p class="fs-14 pl-5 ml-3">'.get_post_field('post_content', $become_global_id).'</p>';
         if($link){
                    $become_global .='<div class="pl-5 ml-3"><a href="'.$link.'" '.$popup_action.'><button type="button" class="btn btn-outline '.$cls_val.'">'.get_post_meta( $become_global_id, 'citizenship_button', true ).'</button></a></div>';
            }
            $become_global .='</div>';
          $become_global .='</div>';
      }
    else
    {
        $become_global .='<div class="row p-t-60 p-b-80 justify-content-between">';
            $become_global .='<div class="col-sm-5">';
              $become_global .='<h4 class="fs-20">'.get_the_title($become_global_id).'</h4>';
              $become_global .='<p class="fs-14">'.get_post_field('post_content', $become_global_id).'</p>';
        if($link){
              $become_global .='<a href="'.$link.'" '.$popup_action.'><button type="button" class="btn btn-fill '.$cls_val.'">'.get_post_meta( $become_global_id, 'citizenship_button', true ).'</button></a>';
        }
            $become_global .='</div>';
            $become_global .='<div class="col-sm-6">';
              $become_global .='<img src="'.$global_img[0].'" class="img-fluid" />';
            $become_global .='</div>';
          $become_global .='</div>';
    }
    $i++;

endwhile;
wp_reset_postdata();
endif;

$become_global .='</div>';
$become_global .='</div>';
return $become_global;
}
add_shortcode('become_global', 'become_global_fun');

/** Global Education start journey section **/
function start_journey_fun($atts){
  global $post, $wpdb, $tc_head, $tc_subhead;
  $cur_post_id = $atts['id'];
  $isPopup = $atts['popup'];
  $popup_action = '';
  $start_journey = '';



  $url = get_post_meta( $cur_post_id, 'citizenship_link', true );
  $bgimg = wp_get_attachment_image_src( get_post_thumbnail_id($cur_post_id), 'full' );
  $btn_arrow = get_post_meta( $cur_post_id, 'button_arrow', true );
  $start_arrow = wp_get_attachment_image_src($btn_arrow);
  $additional_class = get_post_meta( $cur_post_id, 'additional_class_name', true );

  if($url == 'global-ed-form')
    {
      $popup_action='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
    }

    $start_journey .='<div class="'.$additional_class.'">';
    $start_journey .='<div class="bg-img" style="background: url('.$bgimg[0].') no-repeat;">';
    $start_journey .='<h2>'.get_post_field('post_content', $cur_post_id).'</h2>';
    $start_journey .='<div class="container text-center">';
    $start_journey .='<a href="'.$url.'" '.$popup_action.'><button class="btn" type="button">'.get_post_meta( $cur_post_id, 'citizenship_button', true ).'<img src="'.$start_arrow[0].'" /></button></a>';
    $start_journey .='</div>';
    $start_journey .='</div>';
    $start_journey .='</div>';

    return $start_journey;
}
add_shortcode('start_journey', 'start_journey_fun');


/** Global Ed timeline section **/
function global_ed_timeline_fun($atts){
  global $tc_head, $tc_subhead, $post, $wpdb;
  $global_timeline = '';
  $line = 1;

  $timeline_id = $atts['id'];

  $timelineed_query = new WP_Query(
          array('post_type' => 'te_announcements',
                  'order' => 'ASC',
            'tax_query' => array(
          array(
              'taxonomy' => 'timeline_cat',   // taxonomy name
              'terms' => $timeline_id,    // term id, term slug or term name
            )
          )
        )
      );

      $global_timeline .='<div class="story-timeline globaled-timeline m-t-40">';
      $global_timeline .='<div class="container">';
      $global_timeline .='<div class="text-center">';
      $global_timeline .='<div class="smallheading text-uppercase">'.$tc_head.'</div>';
      $global_timeline .='<div class="boldheading">'.$tc_subhead.'</div>';
      $global_timeline .='<div class="path"></div>';
      $global_timeline .='</div>';
      $global_timeline .='<div class="row justify-content-center">';
      $global_timeline .='<div class="col-sm-11 mt-3">';
      $global_timeline .='<ul class="timeline">';

  if($timelineed_query->have_posts()) :
  while ($timelineed_query->have_posts()) : $timelineed_query->the_post();

    $timeid = get_the_ID();

          if($line == 1){
                $global_timeline .='<li>';
                $global_timeline .='<div class="timeline-panel">';
                $global_timeline .='<h4 class="mt-4 pt-1">'.get_the_title($timeid).'</h4>';
                $global_timeline .='<p class="mb-3 pb-1">'.get_post_meta( $timeid, 'timeline_title', true ).'</p>';
                $global_timeline .='<ul class="timeline-listitem">';
                $global_timeline .=get_post_field('post_content', $timeid);
                $global_timeline .='</ul>';
                $global_timeline .='</div>';
                $global_timeline .='<div class="timeline-inverted">';
                $global_timeline .='<div class="timeline-badge count">';
                $global_timeline .=$line;
                $global_timeline .='</div>';
                $global_timeline .='<div class="timeline-panel float-right">';
                $global_timeline .='<img src="'.get_post_meta( $timeid, 'announcement_image', true ).'" class="img-fluid" alt="" />';
                $global_timeline .='</div>';
                $global_timeline .='</div>';
                $global_timeline .='</li>';
            }
          elseif($line == 2){
                $global_timeline .='<li>';
                $global_timeline .='<div class="timeline-badge count">'.$line.'</div>';
                $global_timeline .='<div class="timeline-inverted">';
                $global_timeline .='<div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>';
                $global_timeline .='<div class="timeline-panel">';
                $global_timeline .='<img src="'.get_post_meta( $timeid, 'announcement_image', true ).'" class="img-fluid mt-4 pt-2" alt="" />';
                $global_timeline .='</div>';
                $global_timeline .='</div>';
                $global_timeline .='<div class="timeline-panel float-right">';
                $global_timeline .='<h4>'.get_the_title($timeid).'</h4>';
                $global_timeline .='<p class="mb-3 pb-1">'.get_post_meta( $timeid, 'timeline_title', true ).'</p>';
                $global_timeline .='<ul class="timeline-listitem">';
                $global_timeline .=get_post_field('post_content', $timeid);
                $global_timeline .='</ul>';
                $global_timeline .='</div>';
                $global_timeline .='</li>';
              }
           elseif($line == 3){
                $global_timeline .='<li>';
                $global_timeline .='<div class="timeline-badge count">'.$line.'</div>';
                $global_timeline .='<div class="timeline-panel">';
                $global_timeline .='<h4>'.get_the_title($timeid).'</h4>';
                $global_timeline .='<p class="mb-3">'.get_post_meta( $timeid, 'timeline_title', true ).'</p>';
                $global_timeline .='<ul class="timeline-listitem">';
                $global_timeline .=get_post_field('post_content', $timeid);
                $global_timeline .='</ul>';
                $global_timeline .='</div>';
                $global_timeline .='<div class="timeline-inverted">';
                $global_timeline .='<div class="timeline-panel float-right">';
                $global_timeline .='<img src="'.get_post_meta( $timeid, 'announcement_image', true ).'" class="img-fluid mt-4 pt-2" alt="" />';
                $global_timeline .='</div>';
                $global_timeline .='</div>';
                $global_timeline .='</li>';
              }
           elseif($line == 4){
                $global_timeline .='<li>';
                $global_timeline .='<div class="timeline-badge count">'.$line.'</div>';
                $global_timeline .='<div class="timeline-inverted">';
                $global_timeline .='<div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>';
                $global_timeline .='<div class="timeline-panel">';
                $global_timeline .='<img src="'.get_post_meta( $timeid, 'announcement_image', true ).'" class="img-fluid" alt="" />';
                $global_timeline .='</div>';
                $global_timeline .='</div>';
                $global_timeline .='<div class="timeline-panel float-right">';
                $global_timeline .='<h4 class="mt-4 pt-1">'.get_the_title($timeid).'</h4>';
                $global_timeline .='<p class="mb-3 pb-1">'.get_post_field('post_content', $timeid).'</p>';
                $global_timeline .='</div>';
                $global_timeline .='</li>';

           }
          elseif($line == 5){
                $global_timeline .='<li>';
                $global_timeline .='<div class="timeline-badge count">'.$line.'</div>';
                $global_timeline .='<div class="timeline-panel">';
                $global_timeline .='<h4 class="mt-4 pt-1">'.get_the_title($timeid).'</h4>';
                $global_timeline .='<ul class="timeline-listitem">';
                $global_timeline .= get_post_field('post_content', $timeid);
                $global_timeline .='</ul>';
                $global_timeline .='</div>';
                $global_timeline .='<div class="timeline-inverted">';
                $global_timeline .='<div class="timeline-panel float-right">';
                $global_timeline .='<img src="'.get_post_meta( $timeid, 'announcement_image', true ).'" class="img-fluid" alt="" />';
                $global_timeline .='</div>';
                $global_timeline .='</div>';
                $global_timeline .='</li>';
          }
          elseif($line == 6){
                $global_timeline .='<li>';
                $global_timeline .='<div class="timeline-badge count">'.$line.'</div>';
                $global_timeline .='<div class="timeline-inverted">';
                $global_timeline .='<div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>';
                $global_timeline .='<div class="timeline-panel">';
                $global_timeline .='<img src="'.get_post_meta( $timeid, 'announcement_image', true ).'" class="img-fluid" alt="" />';
                $global_timeline .='</div>';
                $global_timeline .='</div>';
                $global_timeline .='<div class="timeline-panel float-right">';
                $global_timeline .='<h4 class="mt-3">'.get_the_title($timeid).'</h4>';
                $global_timeline .='<ul class="timeline-listitem">';
                $global_timeline .= get_post_field('post_content', $timeid);
                $global_timeline .='</ul>';
                $global_timeline .='</div>';
                $global_timeline .='</li>';

          }
          elseif($line == 7){

              $global_timeline .='<li>';
              $global_timeline .='<div class="timeline-badge count">'.$line.'</div>';
              $global_timeline .='<div class="timeline-panel">';
              $global_timeline .='<h4 class="mt-3">'.get_the_title($timeid).'</h4>';
              $global_timeline .= get_post_field('post_content', $timeid);
              $global_timeline .='</div>';
              $global_timeline .='<div class="timeline-inverted">';
              $global_timeline .='<div class="timeline-panel float-right">';
              $global_timeline .='<img src="'.get_post_meta( $timeid, 'announcement_image', true ).'" class="img-fluid" alt="" />';
              $global_timeline .='</div>';
              $global_timeline .='</div>';
              $global_timeline .='</li>';
            }
      $line++;
  endwhile;
      wp_reset_postdata();
endif;

$global_timeline .='</ul>';
$global_timeline .='</div>';
$global_timeline .='</div>';
$global_timeline .='</div>';
$global_timeline .='</div>';

return $global_timeline;

}
add_shortcode('global_ed_timeline', 'global_ed_timeline_fun');

/** Global ed Event and Insights section **/
function event_and_insights_fun($atts)
{
  global $tc_head, $tc_subhead, $post, $wpdb;
  $events_category_id = $atts['category_id'];
  $event_insight='';

  $url =  $_SERVER['REQUEST_URI'];
  $querystr = '';

if($url == "/global-ed")
 {
  $querystr = "ed";
 }
 elseif($url == "/global-learning")
 {
  $querystr = "learning";
 }
 elseif($url == "/global-investments")
 {
  $querystr = "investments";
 }
 elseif($url == "/global-workspace")
 {
  $querystr = "workspace";
 }

  $events_query = new WP_Query(
          array('post_type' => 'citizenship',
              'tax_query' => array(
          array(
              'taxonomy' => 'global-cat',   // taxonomy name
              'terms' => $events_category_id,  // term id, term slug or term name
            )
          )
            )
      );
  $event_insight .='<div class="aboutblock">';
  $event_insight .='<div class="container ">';
  $event_insight .='<div class="row ">';

if($events_query->have_posts()) :
  while ($events_query->have_posts()) : $events_query->the_post();

      $events_postid = get_the_ID();
      $imgevents = wp_get_attachment_image_src( get_post_thumbnail_id($events_postid), 'full' );
      $btn_arrowid = get_post_meta( $events_postid, 'button_arrow', true );
      $btn_arrow = wp_get_attachment_image_src($btn_arrowid);

      $link = get_post_meta( $events_postid, 'citizenship_link', true );
      if(!empty($querystr)){
        $eventlink = $link.'?page='.$querystr;
      }
      else{
        $eventlink = $link;
      }

      $event_insight .='<div class="col-md-6">';
      $event_insight .='<div class="aboutblock__container">';
      $event_insight .='<div class="smallheading text-uppercase ">'.$tc_head.'</div>';
      $event_insight .='<div class="boldheading">';
      $event_insight .=$tc_subhead;
      $event_insight .='</div>';
      $event_insight .='<div class="brownpath"></div>';
      $event_insight .='<div class="content m-t-30">'.get_post_field('post_content', $events_postid);
      $event_insight .='</div>';
      $event_insight .='<div class="globaled-btn-section m-t-40">';
      $event_insight .='<a href="'.$eventlink.'"><button type="button" class="btn btn-fill">'.get_post_meta( $events_postid, 'citizenship_button', true ).'<img src="'.$btn_arrow[0].'" alt="" width="13"></button></a>';
      $event_insight .='<a href="'.get_post_meta( $events_postid, 'link_two', true ).'"><button type="button" class="btn btn-outline">'.get_post_meta( $events_postid, 'global_button_two', true ).'</button></a>';
      $event_insight .='</div>';
      $event_insight .='</div>';
      $event_insight .='</div>';
      $event_insight .='<div class="col-md-6 text-right"><img src="'.$imgevents[0].'" alt="" class="img-fluid m-t-60 m-b-60 pt-2" /></div>';

endwhile;
endif;
wp_reset_postdata();
  $event_insight .='</div>';
  $event_insight .='</div>';
  $event_insight .='</div>';

return $event_insight;
}
add_shortcode('event_and_insights', 'event_and_insights_fun');

/** Global learning page future section **/
function global_learning_future_fun($atts){
global $tc_head, $tc_subhead, $post, $wpdb;
  $future_category_id = $atts['id'];
  $future='';
  $i =0;

  $future_query = new WP_Query(
          array('post_type' => 'citizenship',
            'order' => 'ASC',
              'tax_query' => array(
          array(
              'taxonomy' => 'global-cat',   // taxonomy name
              'terms' => $future_category_id,  // term id, term slug or term name
            )
          )
            )
      );

$future .='<div class="desktop-global-learningfeature p-t-80 p-b-40">';
$future .='<h2 class="desktop-main-heading">'.$tc_head.'</h2>';
$future .='<p class="p-b-40">'.$tc_subhead.'</p>';
$future .='<div class="container">';

if($future_query->have_posts()) :
  while ($future_query->have_posts()) : $future_query->the_post();
    $future_postid = get_the_ID();
    $futureimg = wp_get_attachment_image_src( get_post_thumbnail_id($future_postid), 'full' );

    $download_action = '';
    $downloadlink = get_post_meta( $future_postid, 'citizenship_link', true );
    if($downloadlink == 'global-ed-form')
    {
      $download_action ='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
    }

    $form_action = '';
    $formlink = get_post_meta( $future_postid, 'link_two', true );
    if($formlink == 'schedule_form')
    {
      $form_action ='data-toggle="modal" data-target="#schedule_form" class="meetingFormClear" data-keyboard="false" data-backdrop="static"';
    }

  if($i <= 2){
    if($i == 0){ $future .='<div class="card-group">'; }

      $future .='<div class="card content-list">';
      $future .='<div class="card-body">';
      $future .='<img src="'.$futureimg[0].'" />';
      $future .='<h4 class="fs-20">'.get_the_title($future_postid).'</h4>';
      $future .='<h5 class="fs-14">'.get_post_meta( $future_postid, 'citizenship_title', true ).'</h5>';
      $future .='<p class="fs-14">'.get_post_field('post_content', $future_postid).'</p>';
      $future .='</div>';
      $future .='<div class="card-footer">';
      $future .='<a href="'.$downloadlink.'" '.$download_action.'><button type="button" class="btn btn-fill btn-theme">'.get_post_meta($future_postid, 'citizenship_button', true ).'</button></a>';
      $future .='<a href="'.$formlink.'" '.$form_action.'><button type="button" class="btn btn-outline btn-theme">'.get_post_meta($future_postid, 'global_button_two', true ).'</button></a>';
      $future .='</div>';
      $future .='</div>';

    if($i == 2){ $future .='</div>'; }
  }
  elseif($i >= 3){
    if($i == 3){ $future .='<div class="card-group">'; }

      $future .='<div class="card content-list">';
      $future .='<div class="card-body">';
      $future .='<img src="'.$futureimg[0].'" />';
      $future .='<h4 class="fs-20">'.get_the_title($future_postid).'</h4>';
      $future .='<h5 class="fs-14">'.get_post_meta( $future_postid, 'citizenship_title', true ).'</h5>';
      $future .='<p class="fs-14">'.get_post_field('post_content', $future_postid).'</p>';
      $future .='</div>';
      $future .='<div class="card-footer">';
      $future .='<a href="'.$downloadlink.'" '.$download_action.'><button type="button" class="btn btn-fill btn-theme">'.get_post_meta($future_postid, 'citizenship_button', true ).'</button></a>';
      $future .='<a href="'.$formlink.'" '.$form_action.' ><button type="button" class="btn btn-outline btn-theme">'.get_post_meta($future_postid, 'global_button_two', true ).'</button></a>';
      $future .='</div>';
      $future .='</div>';

    if($i == 5){ $future .='</div>'; }
  }

$i++;
endwhile;
endif;
wp_reset_postdata();

$future .='</div>';
$future .='</div>';
return $future;
}
add_shortcode('global_learning_future', 'global_learning_future_fun');

/** Global investments page timeline section **/
function global_investments_timeline_fun($atts){

global $tc_head, $tc_subhead, $post, $wpdb;
  $investment = '';
  $inv_category_id = $atts['id'];
  $headingtitle = $atts['headingtitle'];
  $jk =1;

  $investment_query = new WP_Query(
        array('post_type' => 'te_announcements',
                'order' => 'ASC',
                'posts_per_page'=>-1,
          'tax_query' => array(
        array(
            'taxonomy' => 'timeline_cat',   // taxonomy name
            'terms' => $inv_category_id,                  // term id, term slug or term name
          )
        )
      )
    );

$investment .='<div class="story-timeline global-investments-timeline m-t-20">';
$investment .='<div class="container">';
$investment .='<div class="text-center p-b-60">';
$investment .='<div class="boldheading">'.$headingtitle.'</div>';
$investment .='<div class="path"></div>';
$investment .='</div>';
$investment .='<div class="row justify-content-center">';
$investment .='<div class="col-sm-11 mt-3">';
$investment .='<ul class="timeline">';

if($investment_query->have_posts()) :
while ($investment_query->have_posts()) : $investment_query->the_post();

  $fieldhead = ''; $invest_fieldhead = '';

  $investment_id = get_the_ID();

  $fieldhead = get_post_meta( $investment_id, 'timeline_title', true );

  if(!empty($fieldhead)){
        $invest_fieldhead .='<div class="timeline-field-head">'.$fieldhead.'</div>';
      }

  if($jk%2 == 0){  // get even row entry content

      $investment .='<li>';
      $investment .='<div class="timeline-badge count">'.$jk.'</div>';
      $investment .= $invest_fieldhead;
      $investment .='<div class="timeline-inverted">';
      $investment .='<div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>';
      $investment .='<div class="timeline-panel">';
      $investment .='<img src="'.get_post_meta( $investment_id, 'announcement_image', true ).'" class="img-fluid m-t-20" alt="" />';
      $investment .='</div>';
      $investment .='</div>';
      $investment .='<div class="timeline-panel float-right">';
      $investment .='<h4 class="m-t-30">'.get_the_title($investment_id).'</h4>';
      $investment .='<p class="mb-3">'.get_post_field('post_content', $investment_id).'</p>';
      $investment .='</div>';
      $investment .='</li>';
  }

  else{          // get odd row entry content

      if($jk == 1){

        $investment .='<li class="p-t-20">';
        $investment .='<div class="timeline-panel">';
        $investment .='<h4 class="m-t-30">'.get_the_title($investment_id).'</h4>';
        $investment .='<p class="mb-3 pb-1 mt-2">'.get_post_field('post_content', $investment_id).'</p>';
        $investment .='</div>';
        $investment .= $invest_fieldhead;
        $investment .='<div class="timeline-inverted">';
        $investment .='<div class="timeline-badge count">'.$jk.'</div>';
        $investment .='<div class="timeline-panel float-right">';
        $investment .='<img src="'.get_post_meta( $investment_id, 'announcement_image', true ).'" class="img-fluid" alt="" />';
        $investment .='</div>';
        $investment .='</div>';
        $investment .='</li>';

      }

      else{

          $investment .='<li>';
          $investment .='<div class="timeline-badge count">'.$jk.'</div>';
          $investment .='<div class="timeline-panel">';
          $investment .='<h4 class="m-t-30">'.get_the_title($investment_id).'</h4>';
          $investment .='<p>'.get_post_field('post_content', $investment_id).'</p>';
          $investment .='</div>';
          $investment .='<div class="timeline-inverted">';
          $investment .='<div class="timeline-panel float-right">';
          $investment .='<img src="'.get_post_meta( $investment_id, 'announcement_image', true ).'" class="img-fluid m-b-65" alt="" />';
          $investment .='</div>';
          $investment .='</div>';
          $investment .='</li>';

        }
    }

$jk++;

endwhile;
wp_reset_postdata();
endif;

$investment .='</ul>';
$investment .='</div>';
$investment .='</div>';
$investment .='</div>';
$investment .='</div>';

return $investment;
}
add_shortcode('global_investments_timeline', 'global_investments_timeline_fun');

function global_section_fun($atts){

  global $post;
  $id = $atts['id'];
  $layout = $atts['layout'];
  $title = $atts['title'];
  $sub_title = $atts['sub_title'];
  $isPopup = $atts['popup'];

  $queried_post = get_post($id);
  $content = $queried_post->post_content;
  $citizenship_button = get_post_meta( $id, 'citizenship_button', true );
  $citizenship_link = get_post_meta( $id, 'citizenship_link', true );
  $button_arrow = get_post_meta( $id, 'button_arrow', true );
  $arrow_img = wp_get_attachment_image_src($button_arrow);

  $button_two = get_post_meta( $id, 'global_button_two', true );
  $link_two = get_post_meta( $id, 'link_two', true );

  $attach_img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );

  $global_content = '';
  $popup_action = '';



  if($layout == "style_one")
  {

    if($isPopup == 'enabled'){
      $popup_action='data-toggle="modal" data-target="#subscribeModal"';
    }

    $global_content .='<div class="aboutblock position-relative inlights-subscribe-block">
          <div class="rightbanner position-absolute" style="background: url('.$attach_img[0].') no-repeat; background-size:cover"></div>
          <div class="container ">
            <div class="row justify-content-end">
              <div class="col-md-5">
                <div class="aboutblock__container p-t-50">
                  <h3>'.$title.'</h3>
                  <h4>'.$sub_title.'</h4>
                  <p>'.$content.'</p>
                  <div class="">
                    <a href="'.$citizenship_link.'" class="btn btn-more" '.$popup_action.'>'.$citizenship_button.'</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
              </div>
            </div>
          </div>
        </div>';
  }

  elseif($layout == "style_two"){
    $global_content .='<div class="aboutblock position-relative carrers-aboutblock">
        <div class="rightbanner position-absolute" style="background: url('.$attach_img[0].') no-repeat; background-size:cover"></div>
        <div class="container">
          <div class="row ">
            <div class="col-md-6">
              <div class="aboutblock__container m-t-50">
                <h2>'.$title.'</h2>
                <h3>'.$sub_title.'</h3>
                <p>'.$content.'</p>
                <div class="globaled-btn-section m-t-40">
                  <div class="col-sm-10 pl-0">
                  <div class="row">
                    <div class="col-sm-5">
                      <a href="'.$citizenship_link.'" ><button type="button" class="btn btn-fill w-100">'.$citizenship_button.'</button></a>
                    </div>
                    <div class="col-sm-7">
                      <a href="'.$link_two.'" ><button type="button" class="btn btn-outline w-100 ml-0">'.$button_two.'</button></a>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            </div>
          </div>
        </div>
      </div>';
  }

  elseif($layout == "style_three"){

    if($isPopup == 'enabled'){
      $popup_action='data-toggle="modal" data-target="#checkeligible"';
    }

  $global_content .='<div class="aboutblock position-relative">
   <div class="rightbanner position-absolute" style="background: url('.$attach_img[0].') no-repeat; background-size:cover"></div>
   <div class="container ">
      <div class="row ">
         <div class="col-md-6">
            <div class="aboutblock__container">
               <div class="smallheading text-uppercase ">
                '.$title.'
               </div>
               <div class="boldheading">
                 '.$sub_title.'
               </div>
               <div class="brownpath"></div>
               <div class="content m-t-30">
                 '.nl2br($content).'
               </div>
               <div class="morebtn m-t-40">
                  <a href="'.$citizenship_link.'" '.$popup_action.' class="text-uppercase text-decoration-none">'.$citizenship_button.'<span><img src="'.$arrow_img[0].'" alt="" width="13"></span></a>
               </div>
            </div>
         </div>
         <div class="col-md-6 ">
         </div>
      </div>
   </div>
</div>';

}


  return $global_content;

}

add_shortcode('global_section', 'global_section_fun');


function career_slider($atts){

  global $post;
  $id = $atts['id'];
  $career_slider_content = '';

  $query_post = get_post($id);
  $content = $query_post->post_content;
  $img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );

  $career_slider_content .='<div class="careers-workspace-thumbnailslider p-t-50 p-b-80">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 pr-5">
        <div class="boldheading">'.get_the_title($id).'</div>
        <div class="redpath"></div>
        <p class="p-t-40">'.$content.'</p>
      </div>
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-12 p-b-30">
            <img src="'.$img[0].'" class="img-fluid" alt="thumbnail-images" />
          </div>
          <!--<div class="col-sm-6">
            <img src="'.get_template_directory_uri().'/images/careers-thumbnailslider2.jpg" class="img-fluid" alt="thumbnail-images" />
          </div>
          <div class="col-sm-6">
            <img src="'.get_template_directory_uri().'/images/careers-thumbnailslider3.jpg" class="img-fluid" alt="thumbnail-images" />
          </div>-->
        </div>
      </div>
    </div>
  </div>
</div>';

return $career_slider_content;
}
add_shortcode('global_career_slider', 'career_slider');

function job_position($atts){

  $title = $atts['title'];

  $job_position = '';
  $job_content = '';

$args = array(
        'post_type' => 'jobpost',
        'order' => 'ASC',
        'posts_per_page' => 4
    );

$job_query = new WP_Query( $args );

  if($job_query->have_posts()) :
  while ($job_query->have_posts()) : $job_query->the_post();

  $job_id = get_the_ID();
  $job_category = get_the_terms( $job_id, 'jobpost_category' );
  $job_state = get_the_terms( $job_id, 'jobpost_location' );
  $parent_cat_id = $job_state[0]->parent;
  $job_country = get_term_by('id', $parent_cat_id, 'jobpost_location');

  $locName = $job_state[0]->name;

  $job_content .='<div class="col-sm-3">
            <div class="list-detail">
              <span class="taglabel">'.$job_category[0]->name.'</span>
              <h3 class="fs-20">'.get_the_title($job_id).'</h3>';

            if($locName) {
              $job_content .='<div class="row">
                <div class="col-2 pr-0">
                  <img src="'.get_template_directory_uri().'/images/map.png" alt="">
                </div>
                <div class="col-10 pl-2">
                  <p class="fs-14"><span>'.$job_state[0]->name.', </span>'.$job_country->name.'</p>
                </div>
              </div>';
            }

          $job_content .='<a class="fs-14 apply-link" href="'.get_permalink( $job_id ).'">Apply now<img src="'.get_template_directory_uri().'/images/down_2.png" alt=""></a>
            </div>
          </div>';
  endwhile;
  endif;

   wp_reset_postdata();

$job_position .='<div class="popular-course pt-0 careers-current-position">
      <div class="text-center">
        <div class="boldheading">'.$title.'</div>
        <div class="path"></div>
      </div>
      <div class="container ">
        <div class="row">'.$job_content.'</div>
      </div>
    </div>';

  return $job_position;
}
add_shortcode('related_jobs', 'job_position');

/** Student portal code **/
function get_student_portal(){

   global $current_pageName, $post;

$portal = '';
$portal .="<div class='modal fade' id='checkeligible' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog insights-modal contactform-modal modal-lg' role='document'>
              <div class='modal-content' id='formsubmit'>
                <div class='modal-header'>
                  <div class='text-center w-100 m-t-50'>
                    <div class='boldheading'>
                      Our Student Portal <br> is launching soon!
                    </div>
                    <div class='path'></div>
                  </div>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <img src='".get_template_directory_uri()."/images/map-close.png' />
                  </button>
                </div>
<form action='' name='portalform' id='portalform' method='post' class='wpcf7-form wpcf7-acceptance-as-validation theme_1 noErrorMsg'>

                <div class='modal-body'>
                  <div class='row justify-content-center'>
                    <div class='col-sm-9 p-0 m-b-40'>
                      <p class='text-center fs-14'>Our platform ecosystem for students is on it's way. Meanwhile, talk to us, and let us help you find you suitable solutions. Fill in the form so we can help and keep you updated! Join the movement, #TCGlobalCommunity</p>
                    <input type='hidden' value='".$current_pageName."' name='student_currentPage' id='student_currentPage'>
                    <input type='hidden' name='ProspectID' id='ProspectID' >
                      </div>

                    <div class='col-sm-8'>
                      <div class='row'>
                        <div class='col-sm-6 m-b-30'>
                          <div class='group'>
                            <input type='text' class='w-100 input-value name-field'  novalidate name='student_name' id='student_name' />
                            <span class='highlight'></span>
                            <span class='bar'></span>
                            <label>Your name</label>
                          </div>
                        </div>
                        <div class='col-sm-6 m-b-30'>
                          <div class='group'>
                            <input type='text' class='w-100 input-value' novalidate name='student_email' id='student_email' />
                            <span class='highlight'></span>
                            <span class='bar'></span>
                            <label>Your e-mail</label>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <div class='group enter-mobile-number'>
                            <input type='text' placeholder='Your mobile number' class='w-100 input-value number-field portalflag' minlength='10' maxlength='10' novalidate name='student_mobile' id='student_mobile' size='15' />
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                        <button class='btn btn-secondary dropdown-toggle pt-0' id='student_service_text' type='button'
                        data-toggle='dropdown' aria-haspopup='true'
                              aria-expanded='false'>Choose service</button>
                          <input type='hidden'  name='student_service' id='student_service'>
                            <div class='dropdown-menu' aria-labelledby='student_service_text'>
                              <ul>
                                <li class='student_service' data-mydata='Global Education'><a class='tickimage'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'  alt=''>Global Education</a></li>
                                <li  class='student_service' data-mydata='Global Learning'><a class='tickimage'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'  alt=''>Global Learning</a></li>
                                <li  class='student_service' data-mydata='Global Investments'><a class='tickimage'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'  alt=''>Global Investments</a></li>
                                <li  class='student_service' data-mydata='WorkSpace'><a class='tickimage'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'  alt=''>WorkSpace</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-12 m-t-10'>
                          <div class='group'>
                            <textarea class='w-100 input-value' name='student_message' id='student_message' rows='4'></textarea>
                            <span class='highlight'></span>
                            <span class='bar'></span>
                            <label>Your message</label>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-12'>
                          <div class='termslink m-b-30 m-t-10'>
                            <div class='customcheckbox'>
                              <input type='checkbox' id='student_TermsConditions' class='inputcheckbox' name='student_TermsConditions'>
                              <label for='student_TermsConditions' id='student_termconditionerror'><span>Accept Tc Global's <a href='".get_permalink(134)."' target='_blank'>Terms & Conditions</a> and <a href='".get_permalink(3)."' target='_blank'>Privacy Policy</a></span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class='group m-b-20' id='student_success'></div>
                        <div class='group m-b-20' id='student_error'></div>
                      <div class='row justify-content-center'>
                        <div class='col-sm-8 m-b-30'>
                          <button type='button' class='btn btn-theme w-100 portalform'>Send <i class='btnLoader fa fa-spinner fa-spin ml-3' style='display:none'></i></button>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
                   </form>
              </div>

              <div class='modal-content' id='formresult' style='display:none'>
                  <div class='modal-header'>
                    <div class='text-center w-100 m-t-50'>
                      <div class='boldheading'>
                       Thank you
                      </div>
                      <div class='path'></div>
                    </div>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <img src='".get_template_directory_uri()."/images/map-close.png' />
                    </button>
                  </div>
                  <div class='modal-body'>
                    <div class='row justify-content-center'>
                      <div class='col-sm-9 m-b-40'  id='formsuccess'>
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                        <div class='col-sm-3 m-b-30'>
                          <button type='button' class='btn btn-theme w-100 formclose' data-dismiss='modal' aria-label='Close'>Close</button>
                        </div>
                      </div>
                  </div>
              </div>
            </div>

          </div> ";

return $portal;
}
add_shortcode('student_portal', 'get_student_portal');

/** subscribe form code goes here **/
function get_subscribe_data(){

  $subscribe_from = "";
$topic_detail = ["Preparation", "Leadership", "Behavioural", "People Engagement", "Featured Insights", "GMAT GRE SAT IELTS PTE" ];
$topic_list ='';
foreach ($topic_detail as $detail)
    {
  $topic_list .="<li class='subscribe_topic' data-mydata='".$detail."'><a class='tickimage'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'alt=''>".$detail."</a></li>";
  }
    $subscribe_from .="<div class='modal fade' id='subscribeModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog insights-modal' role='document'>
            <div class='modal-content' id='subscribesubmit'>
              <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Choose Insight topics that interest you to subscribe</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <img src='".get_template_directory_uri()."/images/map-close.png' />
                </button>
              </div>
               <form name='subscribe' action='' id='subscribe' class='subscribeformcontent' method='post'>
                <div class='modal-body'>
                <div class='row'>
                  <div class='col-sm-12 m-b-10'>
                    <div class='group'>
                      <input type='text' class='w-100 input-value name-field'  novalidate name='subscribe_name' id='subscribe_name' />
                      <span class='highlight'></span>
                      <span class='bar'></span>
                      <label>Your name</label>
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-sm-12 m-b-10'>
                    <div class='group'>
                      <input type='text' class='w-100 input-value'  novalidate name='subscribe_email' id='subscribe_email' />
                      <span class='highlight'></span>
                      <span class='bar'></span>
                      <label>Your e-mail</label>
                    </div>
                  </div>
                </div>
                  <div class='row'>
                  <div class='col-sm-12 m-b-10'>
                    <div class='group enter-mobile-number contact-number'>
                      <input type='text' class='w-100 input-value number-field subscribeflag' placeholder='Your mobile number' minlength='10' maxlength='10' novalidate name='subscribe_mobile' id='subscribe_mobile' size='15' />
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-sm-12 m-t-10'>
                    <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                      <button class='btn btn-secondary dropdown-toggle pt-0'  id='subscribe_topic_text' type='button'  data-toggle='dropdown' aria-haspopup='true'
                              aria-expanded='false'>Choose topic</button>
                                 <input type='hidden'  name='subscribe_topic' id='subscribe_topic'>
                      <div class='dropdown-menu' aria-labelledby='subscribe_topic_text'>
                        <ul>
              ".$topic_list."
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-sm-12'>
                    <div class='termslink mb-0 m-t-40'>
                      <div class='customcheckbox'>
                        <input type='checkbox' id='subscribe_TermsConditions' class='inputcheckbox' name='subscribe_TermsConditions'>
                        <label for='subscribe_TermsConditions' id='subscribe_termconditionerror'><span>Accept Tc Global's <a  href='".get_permalink(134)."' target='_blank'>Terms & Conditions</a> and <a  href='".get_permalink(3)."' target='_blank'>Privacy Policy</a></span></label>
                      </div>
                    </div>
                  </div>
                </div>
                <input type='hidden' name='ProspectID' id='ProspectID' >
                <div class='row'>
                  <div class='group m-b-20' id='subscribe_success'></div>
                        <div class='group m-b-20' id='subscribe_error'></div>
                  <div class='col-sm-12'>
                    <button type='button' class='btn btn-theme w-100 subscribeform'>Subscribe <i class='subbtnLoader fa fa-spinner fa-spin ml-3' style='display:none'></i>
                    </button>
                  </div>
                </div>
              </div>
               </form>
            </div>


          <div class='modal-content' id='subscriberesult' style='display:none'>
                    <div class='modal-header'>
                      <div class='text-center w-100 m-t-50'>
                        <div class='boldheading'>
                        Thank you
                        </div>
                        <div class='path'></div>
                      </div>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <img src='".get_template_directory_uri()."/images/map-close.png' />
                      </button>
                    </div>
                    <div class='modal-body'>
                      <div class='row justify-content-center'>
                        <div class='col-sm-9 m-b-40'  id='subscribeformsuccess'>
                          </div>
                          </div>
                          <div class='row justify-content-center'>
                          <div class='col-sm-3 m-b-30'>
                            <button type='button' class='btn btn-theme w-100 formclose' data-dismiss='modal' aria-label='Close'>Close</button>
                          </div>
                      </div>
                    </div>
              </div>
            </div>
        </div>";

return $subscribe_from;
}
add_shortcode('subscribe_form', 'get_subscribe_data');

/** Express your interest form code goes here **/
function get_express_formdata(){

  global $current_pageName, $post;

  $express_interest_from = "";

    $express_interest_from .="<div class='modal fade' id='expressModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog insights-modal contactform-modal modal-lg' role='document'>
              <div class='modal-content' id='expresssubmit'>
                <div class='modal-header'>
                  <div class='text-center w-100 m-t-50'>
                    <div class='boldheading'>
                      Express your interest <BR> Please fill the form details
                    </div>
                    <div class='path mb-0'></div>
                  </div>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <img src='".get_template_directory_uri()."/images/map-close.png' />
                  </button>
                </div>
                <form action='' name='express_form' id='express_form' method='post' class='wpcf7-form wpcf7-acceptance-as-validation theme_1 noErrorMsg'>

                <div class='modal-body'>
                  <div class='row justify-content-center'>
                    <div class='col-sm-9 p-0 m-b-40'>
                      <input type='hidden' value='".$current_pageName."' name='student_currentPage' id='student_currentPage'>
                    </div>

                    <div class='col-sm-8'>
                      <div class='row'>
                        <div class='col-sm-6 m-b-30'>
                          <div class='group'>
                            <input type='text' class='w-100 input-value name-field'  novalidate name='express_name' id='express_name' />
                            <span class='highlight'></span>
                            <span class='bar'></span>
                            <label>Your name</label>
                          </div>
                        </div>
                        <div class='col-sm-6 m-b-30'>
                          <div class='group'>
                            <input type='text' class='w-100 input-value' novalidate name='express_email' id='express_email' />
                            <span class='highlight'></span>
                            <span class='bar'></span>
                            <label>Your e-mail</label>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <div class='group enter-mobile-number'>
                            <input type='text' class='w-100 input-value number-field expressflag' placeholder='Your mobile number' novalidate name='express_mobile' id='express_mobile' minlength='10' maxlength='10' size='15' />
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                        <button class='btn btn-secondary dropdown-toggle pt-0' id='express_service_text' type='button'
                        data-toggle='dropdown' aria-haspopup='true'
                              aria-expanded='false'>Choose service</button>
                          <input type='hidden'  name='express_service' id='express_service'>
                            <div class='dropdown-menu' aria-labelledby='express_service_text'>
                              <ul>
                                <li class='express_service' data-mydata='Global Education'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>Global Education</a></li>
                                <li  class='express_service' data-mydata='Global Learning'><a ><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>Global Learning</a></li>
                                <li  class='express_service' data-mydata='Global Investments'><a ><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>Global Investments</a></li>
                                <li  class='express_service' data-mydata='WorkSpace'><a ><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>WorkSpace</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-12 m-t-10'>
                          <div class='group'>
                            <textarea class='w-100 input-value' name='express_message' id='express_message' rows='4'></textarea>
                            <span class='highlight'></span>
                            <span class='bar'></span>
                            <label>Your message</label>
                          </div>
                        </div>
                      </div>

                      <div class='row'>
                      <div class='col-sm-12 m-t-20 m-b-40 modal-select2'>
                        <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                          <select class='form-control selectbox  input-value mutlidropdown' name='university[]'
              data-placeholder='Choose University'  multiple='multiple' id='express_university'  value='' >
            <option value=''>Choose university</option>
             </select>
                           <span class='highlight'></span>
                            <span class='bar'></span>
                        </div>
                      </div>
                    </div>

                    <div class='row'>
                        <div class='col-sm-12'>
                          <div class='termslink m-b-30 m-t-10'>
                            <div class='customcheckbox'>
                              <input type='checkbox' id='express_TermsConditions' name='express_TermsConditions'>
                              <label for='express_TermsConditions' id='express_TermsConditions_error'><span>Accept Tc Global's <a href='".get_permalink(134)."' target='_blank'>Terms & Conditions</a> and <a href='".get_permalink(3)."' target='_blank'>Privacy Policy</a></span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                        <input type='hidden' name='ProspectID' id='ProspectID' >
                        <div class='group m-b-20' id='express_success'></div>
                        <div class='group m-b-20' id='express_error'></div>
                      <div class='row justify-content-center'>
                        <div class='col-sm-8 m-b-30'>
                          <button type='button' class='btn btn-theme w-100 portalform expressform'>Send <i class='expressbtnLoader fa fa-spinner fa-spin ml-3' style='display:none'></i></button>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
                   </form>
              </div>

              <div class='modal-content' id='expressformresult' style='display:none'>
                  <div class='modal-header'>
                    <div class='text-center w-100 m-t-50'>
                      <div class='boldheading'>
                       Thank you
                      </div>
                      <div class='path'></div>
                    </div>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <img src='".get_template_directory_uri()."/images/map-close.png' />
                    </button>
                  </div>
                  <div class='modal-body'>
                    <div class='row justify-content-center'>
                      <div class='col-sm-9 m-b-40'  id='expressformsuccess'>
                        </div>
                          </div>
                         <div class='row justify-content-center'>
                        <div class='col-sm-3 m-b-30'>
                          <button type='button' class='btn btn-theme w-100 formclose' data-dismiss='modal' aria-label='Close'>Close</button>
                        </div>
                      </div>
                  </div>
              </div>
            </div>

          </div> ";

return $express_interest_from;
}
add_shortcode('express_interest_form', 'get_express_formdata');

/** Start your journey form **/

function getStartJourneyForm(){

global $current_pageName, $current_page_url, $post;

$activePage ='';
$service_section = '';
$UserInterestList = '';

$pagesource = $_GET['source'];
$backPageURL = $current_page_url;
if($pagesource!='')
{
  $backPageURL = $current_page_url.'?source='.$pagesource;
}

$activePage = 'global-ed';
$calendar_img = get_template_directory_uri().'/images/calendar-icon.png';
$time_img = get_template_directory_uri().'/images/time.png';

$location_list ='';
$location_list .='<ul>';

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
              'orderby' => 'name',
              'order' => 'ASC', // or ASC
              'hierarchical'  => 1,
              'parent'        => $locationCat->term_id, // get child categories
            )
          );


      foreach ( $sub_categories as $sub_category ){
        if($sub_category->term_id!='48'){
          $location_list .='<li id='.$sub_category->term_id.' ><a>'.$sub_category->name.'</a></li>';
        }
      }

    }

$location_list .='</ul>';

if($current_pageName == 'Global Learning'){
  $activePage = 'global-learning';
  $calendar_img = get_template_directory_uri().'/images/events-ylw.png';
  $time_img = get_template_directory_uri().'/images/time-ylw.png';

  $service_section .= "<div class='col-sm-4'>
                      <div class='choosen-box start-service start-career' id='Global_Learning' data-mydata='Careers Guidance for Students'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon1.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-ylw-icon1.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-yellow.png' />
                        <h6>Careers Guidance for <br>Students</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service start-lan-service' id='Global_Learning' data-mydata='English Language Preparation'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon2.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-ylw-icon2.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-yellow.png' />
                        <h6>English Language <br>Preparation</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service start-test-service' id='Global_Learning' data-mydata='Test Preparation'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon3.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-ylw-icon3.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-yellow.png' />
                        <h6>Test Preparation</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service start-other-service' id='Global_Learning' data-mydata='TC Global-NCUK Pathways'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon4.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-ylw-icon4.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-yellow.png' />
                        <h6>TC Global-NCUK Pathways</h6>
                      </div>
                    </div>

                    <div class='col-sm-4'>
                      <div class='choosen-box start-service start-other-service' id='Global_Learning' data-mydata='Other'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-ylw6.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-yellow.png' />
                        <h6>Other</h6>
                      </div>
                    </div>";

          $UserInterestList .="<div class='row'>
                  <div class='col-md-6'>
                    <label class='control-label'>I'm interested in </label>
                    <div class='row'>
                      <div class='col-md-12'>
                        <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                          <button class='btn btn-secondary dropdown-toggle sel_interest' type='button'>Select</button>

                          <div class='dropdown-menu sel_interest_show'>

                            <ul class='global-sub-service'>
                              <li><a data-mydata='Economy'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>Economy</a></li>
                              <li><a data-mydata='Real Esate'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>Real Esate</a></li>
                              <li><a data-mydata='Business'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>Business</a></li>
                            </ul>

                            <ul class='start_career-preparation' style='display:none'>
                              <li><a data-mydata='Psychometrics'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>Psychometrics</a></li>
                            </ul>

                            <ul class='start_lang-preparation' style='display:none'>
                              <li><a data-mydata='IELTS'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>IELTS</a></li>
                              <li><a data-mydata='PTE'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>PTE</a></li>
                              <li><a data-mydata='TOEFL'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>TOEFL</a></li>
                            </ul>

                            <ul class='start_test-preparation' style='display:none'>
                              <li><a data-mydata='GRE'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>GRE</a></li>
                              <li><a data-mydata='GMAT'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>GMAT</a></li>
                              <li><a data-mydata='SAT'><img src='".get_template_directory_uri()."/images/drop-tick.jpg'>SAT</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>";

  }

elseif($current_pageName == 'Global Investments')
{
  $activePage = 'global-investment';
  $calendar_img = get_template_directory_uri().'/images/events-blu.png';
  $time_img = get_template_directory_uri().'/images/time-blu.png';

  $service_section .= "<div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Investment' data-mydata='EB-5 Investment Program'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-invest-icon1.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-invest-blu-icon1.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-blue.png' />
                        <h6>EB-5 Investment Program</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Investment' data-mydata='Preferred Equity'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-invest-icon2.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-invest-blu-icon2.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-blue.png' />
                        <h6>Preferred Equity</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Investment' data-mydata='Real Estate'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-invest-icon3.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-invest-blu-icon3.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-blue.png' />
                        <h6>Real Estate</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Investment' data-mydata='Other Investment Program'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/choosen-box-img2.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/choosen-box-img2-blu.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-blue.png' />
                        <h6>Other Investment Program</h6>
                      </div>
                    </div>

                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Investment' data-mydata='Other'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-blu6.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-blue.png' />
                        <h6>Other</h6>
                      </div>
                    </div>";

        }

elseif($current_pageName == 'Global Workspace')
{
  $activePage = 'global-workspace';
  $calendar_img = get_template_directory_uri().'/images/events-wrk.png';
  $time_img = get_template_directory_uri().'/images/time-wrk.png';

  $service_section .= "<div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Workspace' data-mydata='TC Global Managed Desk'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon1.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-wrk-icon1.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-work.png' />
                        <h6>TC Global Managed Desk</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Workspace' data-mydata='On Demand Shared Space'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon2.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-wrk-icon2.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-work.png' />
                        <h6>On Demand Shared Space</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Workspace' data-mydata='Private Space'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon3.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-wrk-icon3.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-work.png' />
                        <h6>Private Space</h6>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Workspace' data-mydata='Services Ecosystem'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon4.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-wrk-icon4.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-work.png' />
                        <h6>Services Ecosystem</h6>
                      </div>
                    </div>

                    <div class='col-sm-4'>
                      <div class='choosen-box start-service' id='Global_Workspace' data-mydata='Other'>
                        <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                        <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-wrk6.png' />
                        <img class='active-badge' src='".get_template_directory_uri()."/images/badge-work.png' />
                        <h6>Other</h6>
                      </div>
                    </div>";

        }

else{

  if($current_pageName == 'Course Detail')
  {
    $current_pageName = 'Global Ed';
  }

  $activePage = 'global-ed';
  $calendar_img = get_template_directory_uri().'/images/calendar-icon.png';
  $time_img = get_template_directory_uri().'/images/time.png';

  $service_section .= "<div class='col-sm-4'>
                <div class='choosen-box start-service' id='Global_Ed' data-mydata='Global Ed Placement'>
                  <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon1.png' />
                  <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red1.png' />
                  <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                  <h6>Global Ed Placement</h6>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class='choosen-box start-service' id='Global_Ed' data-mydata='Country, Course, Univeristy search and selection'>
                  <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon2.png' />
                  <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red2.png' />
                  <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                  <h6>Country, Course, Univeristy search and selection</h6>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class='choosen-box start-service' id='Global_Ed' data-mydata='Application management'>
                  <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon3.png' />
                  <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red3.png' />
                  <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                  <h6>Application management</h6>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class='choosen-box start-service' id='Global_Ed' data-mydata='Visa management'>
                  <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon4.png' />
                  <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red4.png' />
                  <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                  <h6>Visa management</h6>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class='choosen-box start-service' id='Global_Ed' data-mydata='Essay / Personal Statement recommendations'>
                  <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon5.png' />
                  <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red5.png' />
                  <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                  <h6>Essay / Personal Statement recommendations</h6>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class='choosen-box start-service' id='Global_Ed' data-mydata='Other'>
                  <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                  <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red6.png' />
                  <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                  <h6>Other</h6>
                </div>
              </div>";
    }


$journey_form ="";

$journey_form .="<div class='modal fade' id='start_journey_form' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog insights-modal contactform-modal modal-lg' role='document'>
      <div class='modal-content start-journeymodal ".$activePage." book-appointment'>
        <div class='modal-header'>
          <h3 class='smallheading-modal step-form-title'>First things first</h3>
          <h3 class='smallheading-modal cnf-title' style='display:none;'>Confirmation</h3>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <img src='".get_template_directory_uri()."/images/map-close.png' />
          </button>
        </div>
		
		<div class='modal-body already-acc d-none' >
		<div class='text-center w-100'>
                      </div>
		   <p class='text-center fs-14'>Hey it looks like you've already got an account with us.<br> Sign into your Portal to e-meet with us! </p>
		   
		   <div class='row justify-content-center m-t-50'>
              <div class='col-sm-4 p-0'>
                <a class='text-white btn btn-theme w-100 text-uppercase' href='https://student.tcglobal.com/'>Sign in</a>
              </div>
            </div>		
		</div>
		
        <div class='modal-body' id='step-progress'>
          <div class='row'>
            <div class='col-sm-12 process-step'>
              <span class='baricon active'>1</span><span id='bar1' class='progress_bar'></span><span class='baricon' id='baricon2'>2</span><span id='bar2' class='progress_bar'></span><span class='baricon' id='baricon3'>3</span>
            </div>
          </div>
          <form method='post' action='' name='journey_form' id='journey_form'>
          <div id='account_details'>
          <div class='smallheading text-uppercase text-center'>Step 1/3</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-70'>Let’s cut out the Mr. and Mrs!</div>
          </div>
          <div class='row justify-content-center'>
            <div class='col-sm-8'>
              <div class='row'>
                <div class='col-sm-6 mb-4'>
                  <div class='group'>
                    <input type='text' name='fname' id='fname' class='w-100 input-value name-field' >
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Your first name</label>
                  </div>
                </div>
                <div class='col-sm-6 mb-4'>
                  <div class='group'>
                    <input type='text' name='lname' id='lname' class='w-100 input-value name-field' />
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Your last name</label>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-6 mb-3'>
                  <div class='group'>
                    <input type='text' name='useremail' id='useremail' class='w-100 input-value' />
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Your email</label>
                  </div>
                </div>
                <div class='col-sm-6 mb-3'>
                  <div class='group enter-mobile-number'>
                    <input type='text' placeholder='Your mobile number' name='userphone' id='userphone' minlength='10' maxlength='10' class='form-control number-field input-value countryflag'>
                  </div>
                </div>
               </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='termslink m-b-50'>
                    <div class='customcheckbox'>
                      <input type='checkbox' name='term' id='isterm'>
                      <label for='isterm'><span>Accept Tc Global's <a href='".get_permalink(134)."' target='_blank'>Terms&amp;Conditions</a> and <a href='".get_permalink(3)."' target='_blank'>Privacy Policy</a></span></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row justify-content-center'>
                <div class='col-sm-4'>
                  <button type='button' onClick=show_next('account_details','user_details','bar1','baricon2','$activePage','web'); class='btn btn-theme w-100' >next <img class='btn-whitearrow' src='".get_template_directory_uri()."/images/whiteforward.png'></button>
                </div>
              </div>
            </div>
          </div>
          </div>

          <div id='user_details'>
          <div class='smallheading text-uppercase text-center'>Step 2/3</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-70'>When can we connect online?</div>
          </div>
          <div class='row justify-content-center'>
            <div class='col-sm-8'>
              <div class='row'>
                <div class='col-sm-6'>
                  <label class='control-label mb-0'>Choose date</label>
                  <div class='form-group input-group'>
                   <input type='text' name='journey_date' id='calendarform' class='form-control clsDatePicker value-selected' value='' readonly />
                    <img class='icon' src=".$calendar_img." />
                  </div>
                </div>
                <div class='col-sm-6'>
                  <label class='control-label mb-0'>Choose- time</label>
                  <div class='form-group select-theme filter-dropdown border-bottom-0'>
                    <input type='text' name='pick_time' id='pick_time' value='' class='pick_time form-control value-selected' readonly />
                    <img class='icon' src=".$time_img." />
                    <div class='dropdown-menu pick_time_show'>
                      <ul>
                        <li><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>All day</a></li>
                        <li id='ss_10'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>10:00-11:00 AM</a></li>
                        <li id='ss_11'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>11:00-12:00 PM</a></li>
                        <li id='ss_12'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>12:00-13:00 PM</a></li>
                        <li id='ss_13'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>13:00-14:00 PM</a></li>
                        <li id='ss_14'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>14:00-15:00 PM</a></li>
                        <li id='ss_15'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>15:00-16:00 PM</a></li>
                        <li id='ss_16'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>16:00-17:00 PM</a></li>
                        <li id='ss_17'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>17:00-18:00 PM</a></li>
                      </ul>

                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='termslink m-b-30 m-t-10'>
                    <div class='customcheckbox'>
                      <input type='checkbox' name='schedule' id='schedule_check'>
                      <label for='schedule_check'><span>Don’t have time to connect online? Let’s schedule a call.</span></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class='hide-location'>
               <div class='row'>
                <div class='col-md-6'>
                  <div class=''>
                    <label class='control-label'>Choose location</label>
                    <div class='row'>
                      <div class='col-md-12'>
                        <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                          <button class='btn btn-secondary dropdown-toggle select_loc value-selected' type='button'>Select</button>
                        </div>
                        <div class='dropdown-list select_loc_show'>
                          <!--<h3><img src='".get_template_directory_uri()."/images/location-cursor.png' alt=''  />Find Experience Centre near you</h3>-->
                          ".$location_list."
                        </div>
                        <input type='hidden' name='journey_loc' id='journey_loc' value=''>
                        <input type='hidden' name='journeyloc_field' id='journeyloc_field' value=''>
                      </div>
                    </div>
                  </div>
                  <div class='address'>
                    <label class='control-label m-t-20'>Address</label>
                    <div id='current_addr'></div>
                      <div class='custom-tooltip'>
                        <h6>It’s the closest venue based on your location. <br>Feel free to change it! </h6>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-6' id='map-location'>
                    <div id='current_loc_map'></div>

                  </div>
                </div>
               </div>
                <div class='row justify-content-center m-t-60'>
                  <div class='col-sm-4 text-center'>
                    <button type='button' onclick=show_prev('account_details','bar1'); class='btn btn-link'>GO BACK</button>
                  </div>
                  <div class='col-sm-4'>
                    <button type='button' onClick= show_next('user_details','qualification','bar2','baricon3','$activePage','web'); class='btn btn-theme w-100'>next <img class='btn-whitearrow' src='".get_template_directory_uri()."/images/whiteforward.png'></button>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div id='qualification'>
        <div class='smallheading text-uppercase text-center'>Step 3/3</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-40'>How can we help you?</div>
          </div>
          <div class='row justify-content-center tabview'>
            <div class='col-sm-8'>
              <h4>Choose any one service</h4>
                  <div class='row'>".$service_section."</div>
                  <input type='hidden' name='service_value' id='service_value' value=''>
                  <span class='sel_service' style='display:none;'>Choose any one service </span>
                  <input type='hidden' name='current_page' value='".$current_pageName."'>

                  ".$UserInterestList."

                  <input type='hidden' name='user_interest' id='user_interest' value=''>
                  <input type='hidden' name='ProspectID' id='ProspectID' >
                  <input type='hidden' name='primary_cat' value='' >
                  <input type='hidden' name='journeySource' value=".$pagesource.">
            </div>
          </div>
          <div class='row justify-content-center m-t-40'>
            <div class='col-sm-4 text-center'>
              <button type='button' onclick=show_prev('user_details','bar2'); class='btn btn-link'>GO BACK</button>
            </div>
            <div class='col-sm-4'>
              <button type='button' onclick=onSubmit('web'); class='btn btn-theme w-100 journey-btn'>Submit & Onboard!<img class='btn-whitearrow' src='".get_template_directory_uri()."/images/whiteforward.png' /> <i class='btnLoader fa fa-spinner fa-spin ml-3' style='display:none'></i> </button>
            </div>
          </div>
          <div class='group m-b-20' id='journey_success'></div>
          <div class='group m-b-20' id='journey_error'></div>
        </div>
       </form>
       <div class='thank-you-popup' id='Confirmation' style='display:none'>
       <div class='smallheading text-uppercase text-center'>that’s it!</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-50'>Thanks for contacting us!</div>
          </div>
          <p class='text-center fs-14'>We're now directing you to our scheduling service to pick an e-meet slot. We look forward to starting our journey together!</p>
            <div class='row justify-content-center m-t-50'>
              <div class='col-sm-4 p-0'>
                <!--<button type='button' class='btn btn-theme w-100'><a class='text-white' href=".$backPageURL.">BACK TO ".$current_pageName."<img class='' src=".get_template_directory_uri()."/images/whiteforward.png /></a></button>-->              
				<button type='button' class='btn btn-theme w-100'><a class='text-white' href='https://calendly.com/tcglobal'>Book Your Slot<img class='' src=".get_template_directory_uri()."/images/whiteforward.png /></a></button>
			  </div>
            </div>

       </div>

        </div>
      </div>
    </div>
  </div>";


return $journey_form;

}
add_shortcode('start_your_journey', 'getStartJourneyForm');

/** Schedule meeting form goes here **/

function scheduleMeeting(){

global $current_pageName, $current_page_url, $post;

$activePage ='';
$service_section = '';

$location_list ='';

$location_list .='<ul>';

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
              'orderby' => 'name',
              'order' => 'ASC', // or ASC
              'hierarchical'  => 1,
              'parent'        => $locationCat->term_id, // get child categories
            )
          );

      foreach ( $sub_categories as $sub_category ){

        if($sub_category->term_id!='48'){
          $location_list .='<li id='.$sub_category->term_id.'><a>'.$sub_category->name.'</a></li>';
       }

      }

    }

$location_list .='</ul>';


$activePage = 'global-ed';
$calendar_img = get_template_directory_uri().'/images/calendar-icon.png';
$time_img = get_template_directory_uri().'/images/time.png';

if($current_pageName == 'Global Learning'){
  $activePage = 'global-learning';
  $calendar_img = get_template_directory_uri().'/images/events-ylw.png';
  $time_img = get_template_directory_uri().'/images/time-ylw.png';

}

if($current_pageName == 'Global Investments')
{
  $activePage = 'global-investment';
  $calendar_img = get_template_directory_uri().'/images/events-blu.png';
  $time_img = get_template_directory_uri().'/images/time-blu.png';
}

if($current_pageName == 'Global Workspace')
{
  $activePage = 'global-workspace';
  $calendar_img = get_template_directory_uri().'/images/events-wrk.png';
  $time_img = get_template_directory_uri().'/images/time-wrk.png';

}

$schedule_meeting_form ="";

$schedule_meeting_form .="<div class='modal fade' id='schedule_form' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog insights-modal contactform-modal modal-lg' role='document'>
      <div class='modal-content start-journeymodal ".$activePage." book-appointment'>
        <div class='modal-header'>
          <h3 class='smallheading-modal step-form-title'>First things first</h3>
		  
          <h3 class='smallheading-modal cnf-title' style='display:none;'>Confirmation</h3>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <img src='".get_template_directory_uri()."/images/map-close.png' />
          </button>
        </div>
		
		<div class='modal-body already-acc d-none' >
		<div class='text-center w-100'>
                      </div>
		   <p class='text-center fs-14'>Hey it looks like you've already got an account with us.<br> Sign into your Portal to e-meet with us! </p>
		   
		   <div class='row justify-content-center m-t-50'>
              <div class='col-sm-4 p-0'>
                <a class='text-white btn btn-theme w-100 text-uppercase' href='https://student.tcglobal.com/'>Sign in</a>
              </div>
            </div>
		
		</div>
		
        <div class='modal-body' id='step-progress'>
          <div class='row'>
            <div class='col-sm-12 process-step'>
              <span class='baricon active'>1</span><span id='schedulebar1' class='progress_bar'></span><span class='baricon' id='schedulebaricon2'>2</span><span id='schedulebar2' class='progress_bar'></span><span class='baricon' id='schedulebaricon3'>3</span>
            </div>
          </div>
          <form method='post' action='' name='schedule_meeting' id='schedule_meeting'>
          <div id='first_detail_section'>
          <div class='smallheading text-uppercase text-center'>Step 1/3</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-70'>Let’s cut out the Mr. and Mrs!</div>
          </div>
          <div class='row justify-content-center'>
            <div class='col-sm-8'>
              <div class='row'>
                <div class='col-sm-6 mb-4'>
                  <div class='group'>
                    <input type='text' name='user_fname' id='user_fname' class='w-100 input-value name-field' >
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Your first name</label>
                  </div>
                </div>
                <div class='col-sm-6 mb-4'>
                  <div class='group'>
                    <input type='text' name='user_lname' id='user_lname' class='w-100 input-value name-field' />
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Your last name</label>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-6 mb-3'>
                  <div class='group'>
                    <input type='text' name='user_email' id='user_email' class='w-100 input-value' />
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Your email</label>
                  </div>
                </div>

                <div class='col-sm-6 mb-3'>
                  <div class='group enter-mobile-number'>
                    <input type='text' placeholder='Your mobile number' name='user_mobile' id='user_mobile' minlength='10' maxlength='10' class='form-control number-field input-value scheduleflag' >
                  </div>
                </div>
               </div>

              <div class='row'>
                <div class='col-sm-12'>
                  <div class='termslink m-b-50'>
                    <div class='customcheckbox'>
                      <input type='checkbox' name='schedule' id='schedule'>
                      <label for='schedule'><span>Accept Tc Global's <a href='".get_permalink(134)."' target='_blank'>Terms&amp;Conditions</a> and <a href='".get_permalink(3)."' target='_blank'>Privacy Policy</a></span></label>
                    </div>
                  </div>
                </div>
              </div>

              <h4 class='select_role'>You are…</h4>
              <div class='row'>
                <div class='col-sm-4'>
                  <div class='choosen-box usertype' data-mydata='a Student'>
                    <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/choosen-box-img1.png' />
                    <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red2.png' />
                    <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                    <h6>a Student</h6>
                  </div>
                </div>
                <div class='col-sm-4'>
                  <div class='choosen-box usertype' data-mydata='an Investor'>
                    <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/choosen-box-img2.png' />
                    <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/choosen-box-img2-red.jpg' />
                    <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                    <h6>an Investor</h6>
                  </div>
                </div>
                <div class='col-sm-4'>
                  <div class='choosen-box usertype' data-mydata='a Partner'>
                    <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/choosen-box-img3.png' />
                    <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/choosen-box-img3-red.jpg' />
                    <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                    <h6>a Partner</h6>
                  </div>
                </div>
                <input type='hidden' name='your_role' id='your_role' value=''>
              </div>

              <div class='row justify-content-center'>
                <div class='col-sm-4'>
                  <button type='button' onClick=next_section('first_detail_section','second_detail_section','schedulebar1','schedulebaricon2','$activePage','web'); class='btn btn-theme w-100' >next <img class='btn-whitearrow' src='".get_template_directory_uri()."/images/whiteforward.png'></button>
                </div>
              </div>
            </div>
          </div>
          </div>

          <div id='second_detail_section'>
          <h3 class='graybg-head first_userdetail'></h3>
          <div class='smallheading text-uppercase text-center'>Step 2/3</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-70'>When can we connect online?</div>
          </div>
          <div class='row justify-content-center'>
            <div class='col-sm-8'>
              <div class='row'>
                <div class='col-sm-6'>
                  <label class='control-label mb-0'>Choose date</label>
                  <div class='form-group input-group'>
                   <input type='text' name='schedule_date' id='meeting_date' class='form-control clsDatePicker value-selected' value='' readonly />
                    <img class='icon' src=".$calendar_img." />
                  </div>
                </div>
                <div class='col-sm-6'>
                  <label class='control-label mb-0'>Choose- time</label>
                  <div class='form-group select-theme filter-dropdown border-bottom-0'>
                    <input type='text' name='schedule_time' id='schedule_time' value='' class='schedule_time form-control value-selected' readonly />
                    <img class='icon' src=".$time_img." />
                    <div class='dropdown-menu schedule_time_show'>
                      <ul>
                        <li><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>All day</a></li>
                        <li id='dd_10'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>10:00-11:00 AM</a></li>
                        <li id='dd_11'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>11:00-12:00 PM</a></li>
                        <li id='dd_12'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>12:00-13:00 PM</a></li>
                        <li id='dd_13'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>13:00-14:00 PM</a></li>
                        <li id='dd_14'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>14:00-15:00 PM</a></li>
                        <li id='dd_15'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>15:00-16:00 PM</a></li>
                        <li id='dd_16'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>16:00-17:00 PM</a></li>
                        <li id='dd_17'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>17:00-18:00 PM</a></li>
                      </ul>

                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='termslink m-b-30 m-t-10'>
                    <div class='customcheckbox'>
                      <input type='checkbox' name='schedule_loc' id='schedule_loc'>
                      <label for='schedule_loc'><span>Don’t have time to connect online? Let’s schedule a call.</span></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class='enbale-location'>
               <div class='row'>
                <div class='col-md-6'>
                  <div class=''>
                    <label class='control-label'>Choose location</label>
                    <div class='row'>
                      <div class='col-md-12'>
                        <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                          <button class='btn btn-secondary dropdown-toggle schuser_loc value-selected' type='button'>Select</button>
                        </div>
                        <div class='dropdown-list schuser_loc_show' style='display:none'>
                          <!--<h3><img src='".get_template_directory_uri()."/images/location-cursor.png' alt=''  />Find Experience Centre near you</h3>-->
                          ".$location_list."
                        </div>
                        <input type='hidden' name='schjourney_loc' id='schjourney_loc' value=''>
                        <input type='hidden' name='selectloc_field' id='selectloc_field' value=''>
                      </div>
                    </div>
                  </div>
                  <div class='address'>
                    <label class='control-label m-t-20'>Address</label>
                    <div id='meeting_addr'></div>

                      <div class='custom-tooltip'>
                        <h6>It’s the closest venue based on your location. <br>Feel free to change it! </h6>
                      </div>
                    </div>
                  </div>

                  <div class='col-md-6'>
                    <div id='current_meeting_map'></div>
                  </div>

                 </div>
                </div>
                <div class='row justify-content-center m-t-60'>
                  <div class='col-sm-4 text-center'>
                    <button type='button' onclick=prev_section('first_detail_section','schedulebar1'); class='btn btn-link'>GO BACK</button>
                  </div>
                  <div class='col-sm-4'>
                    <button type='button' onClick= next_section('second_detail_section','third_detail_section','schedulebar2','schedulebaricon3','$activePage','web'); class='btn btn-theme w-100'>next <img class='btn-whitearrow' src='".get_template_directory_uri()."/images/whiteforward.png'></button>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div id='third_detail_section'>
        <div class='user_interest_section '>
        <div class='smallheading text-uppercase text-center'>Step 3/3</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-40'>How can we help you?</div>
          </div>
          <div class='row justify-content-center tabview'>
            <div class='col-sm-8'>

                <nav class='navtab'>
                  <div class='nav nav-tabs' id='nav-tab' role='tablist'>
                    <a class='nav-item nav-link active' id='nav-Ed-tab' data-toggle='tab' href='#nav-Ed' role='tab' aria-controls='nav-Ed' aria-selected='true'>Global Ed</a>
                    <a class='nav-item nav-link' id='nav-Partnerships-tab' data-toggle='tab' href='#nav-Partnerships' role='tab' aria-controls='nav-Partnerships' aria-selected='false'>Global Partnerships</a>
                    <a class='nav-item nav-link' id='nav-Learning-tab' data-toggle='tab' href='#nav-Learning' role='tab' aria-controls='nav-Learning' aria-selected='false'>Global Learning</a>
                    <a class='nav-item nav-link' id='nav-Investment-tab' data-toggle='tab' href='#nav-Investment' role='tab' aria-controls='nav-Investment' aria-selected='false'>Global Investment</a>
                    <a class='nav-item nav-link' id='nav-Workspace-tab' data-toggle='tab' href='#nav-Workspace' role='tab' aria-controls='nav-Workspace' aria-selected='false'>Global Workspace</a>
                  </div>
                </nav>
              <div class='tab-content' id='nav-tabContent'>
                  <div class='tab-pane fade show active' id='nav-Ed' role='tabpanel' aria-labelledby='nav-Ed-tab'>
                    <div class='row'>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Ed' data-mydata='Global Ed Placement'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon1.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red1.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Global Ed Placement</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Ed' data-mydata='Country, Course, Univeristy search and selection'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon2.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red2.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Country, Course, Univeristy search and selection</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Ed' data-mydata='Application management'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon3.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red3.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Application management</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Ed' data-mydata='Visa management'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon4.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red4.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Visa management</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Ed' data-mydata='Essay / Personal Statement recommendations'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon5.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red5.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Essay / Personal Statement recommendations</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Ed' data-mydata='Other'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red6.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Other</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class='tab-pane fade' id='nav-Partnerships' role='tabpanel' aria-labelledby='nav-Partnerships-tab'>
                    <div class='row'>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Partnerships' data-mydata='Leadership Engagement'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/lidership-default.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/lidership-active.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Leadership Engagement</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Partnerships' data-mydata='Staff Training'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/staff-default.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/staff-active.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Staff Training</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Partnerships' data-mydata='Student Engagement'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/studentEngagement-default.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/studentEngagement-active.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Student Engagement</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Partnerships' data-mydata='Other'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red6.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Other</h6>
                        </div>
                      </div>
                    </div>
                </div>

                <div class='tab-pane fade' id='nav-Learning' role='tabpanel' aria-labelledby='nav-Learning-tab'>
                    <div class='row'>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service career-preparation' id='Global Learning' data-mydata='Careers Guidance for Students'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon1.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-red-icon1.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Careers Guidance for <br>Students</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service english-language-preparation' id='Global Learning' data-mydata='English Language Preparation'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon2.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-red-icon2.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>English Language <br>Preparation</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service test-preparation' id='Global Learning' data-mydata='Test Preparation'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon3.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-red-icon3.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Test Preparation</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service learn-other' id='Global Learning' data-mydata='TC Global-NCUK Pathways'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-learn-icon4.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-learn-red-icon4.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>TC Global-NCUK Pathways</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service learn-other' id='Global Learning' data-mydata='Other'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red6.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Other</h6>
                        </div>
                      </div>
                    </div>


                    <div class='row service-select career-sub-tab' style='display:none'>
                      <div class='col-sm-12'>
                        <a class='test-link text-dark' style='cursor: default !important;' >Careers Guidance for Students</a>
                      </div>
                     <div class='row col-sm-12'>
                      <div class='col-sm-4'>
                        <div class='choosen-box select-preparation' data-mydata='Psychometrics'>
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Psychometrics</h6>
                        </div>
                      </div>
                      </div>
                    </div>

                    <div class='row service-select english-language-sub-tab' style='display:none'>
                      <div class='col-sm-12'>
                        <a class='test-link text-dark' style='cursor: default !important;' >English Language Preparation</a>
                      </div>
                     <div class='row col-sm-12'>
                      <div class='col-sm-4'>
                        <div class='choosen-box select-preparation' data-mydata='IELTS'>
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>IELTS</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box select-preparation' data-mydata='PTE'>
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>PTE</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box select-preparation' data-mydata='TOEFL'>
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>TOEFL</h6>
                        </div>
                      </div>

                     </div>
                    </div>



                    <div class='row service-select learn-sub-tab' style='display:none'>
                      <div class='col-sm-12'>
                        <a class='test-link text-dark' style='cursor: default !important;' >Test Preparation</a>
                      </div>
                     <div class='row col-sm-12'>
                      <div class='col-sm-4'>
                        <div class='choosen-box select-preparation' data-mydata='GRE'>
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>GRE</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box select-preparation' data-mydata='GMAT'>
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>GMAT</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box select-preparation' data-mydata='SAT'>
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>SAT</h6>
                        </div>
                      </div>
                      </div>
                    </div>

                </div>
                <div class='tab-pane fade' id='nav-Investment' role='tabpanel' aria-labelledby='nav-Investment-tab'>
                    <div class='row'>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Investment' data-mydata='EB-5 Investment Program'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-invest-icon1.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-invest-red-icon1.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>EB-5 Investment Program</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Investment' data-mydata='Preferred Equity'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-invest-icon2.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-invest-red-icon2.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Preferred Equity</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Investment' data-mydata='Real Estate'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-invest-icon3.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-invest-red-icon3.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Real Estate</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Investment' data-mydata='Other Investment Program'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-invest-icon4.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/choosen-box-img2-red.jpg' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Other Investment Program</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Investment' data-mydata='Other'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red6.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Other</h6>
                        </div>
                      </div>
                    </div>



                  </div>
                  <div class='tab-pane fade' id='nav-Workspace' role='tabpanel' aria-labelledby='nav-Workspace-tab'>
                    <div class='row'>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Workspace' data-mydata='TC Global Managed Desk'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon1.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-red-icon1.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>TC Global Managed Desk</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Workspace' data-mydata='On Demand Shared Space'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon2.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-red-icon2.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>On Demand Shared Space</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Workspace' data-mydata='Private Space'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon3.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-red-icon3.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Private Space</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Workspace' data-mydata='Services Ecosystem'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/global-work-icon4.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/global-work-red-icon4.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Services Ecosystem</h6>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='choosen-box choose-service' id='Global Workspace' data-mydata='Other'>
                          <img class='mt-3 mx-auto mb-2 img-fluid default-img' src='".get_template_directory_uri()."/images/globaled-icon6.png' />
                          <img class='mt-3 mx-auto mb-2 img-fluid active-img' src='".get_template_directory_uri()."/images/globaled-icon-red6.png' />
                          <img class='active-badge' src='".get_template_directory_uri()."/images/badge-red.png' />
                          <h6>Other</h6>
                        </div>
                      </div>
                    </div>
                  </div>

              </div>

                  <input type='hidden' name='test_preparation_val' id='test_preparation_val' value=''>
                  <input type='hidden' name='schedule_service' id='schedule_service' value=''>
                  <input type='hidden' name='parent_cat' id='parent_cat' value=''>
                  <span class='user_choice' style='display:none;'>Choose any one service </span>
                  <input type='hidden' name='current_page' id='curPage' value='".$current_pageName."'>
                  <input type='hidden' name='ProspectID' id='ProspectID' >

                  <input type='hidden' name='user_interest' id='user_interest' value=''>
            </div>
          </div>

          <div class='row justify-content-center m-t-40'>
            <div class='col-sm-4 text-center'>
              <button type='button' onclick=prev_section('second_detail_section','schedulebar2'); class='btn btn-link'>GO BACK</button>
            </div>
            <div class='col-sm-4'>
              <button type='button' onclick=show_summary('web'); class='btn btn-theme w-100'>see summary<img class='btn-whitearrow' src='".get_template_directory_uri()."/images/whiteforward.png' /> </button>
            </div>
          </div>
          </div>

          <div class='summary_section' style='display:none'>

             <div class='smallheading text-uppercase text-center'>almost there</div>
              <div class='text-center w-100'>
                <div class='boldheading m-b-70'>Double check the details</div>
              </div>
              <div class='row justify-content-center tabview'>
              <div class='col-sm-8'>
                <div class='row location-details'>
                  <div class='col-sm-4'>
                    <img src='".get_template_directory_uri()."/images/location-icon1.png' />
                    <h5>Personal Details</h5>
                    <div class='user-detail'></div>
                    <a onclick=prev_section('first_detail_section','schedulebar1'); >change</a>
                  </div>
                  <div class='col-sm-4'>
                    <img src='".get_template_directory_uri()."/images/location-icon2.png' />
                    <h5>Venue</h5>
                    <div class='user-location-detail'></div>
                    <a onclick=prev_section('second_detail_section','schedulebar2'); >change</a>
                    </div>
                    <div class='col-sm-4'>
                      <img src='".get_template_directory_uri()."/images/time.png' />
                      <h5>Date & Time</h5>
                      <div class='user-day'></div>
                      <a onclick=prev_section('second_detail_section','schedulebar2'); >change</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class='row justify-content-center m-t-60'>
                <div class='col-sm-2 text-center'>
                  <button type='button' onclick=show_section(); class='btn btn-link'>GO BACK</button>
                </div>
                <div class='col-sm-4'>
                <button type='button' onclick=onSchedule('web'); class='btn btn-theme w-100 schedule-btn'>schedule your meeting<img class='' src='".get_template_directory_uri()."/images/whiteforward.png' /> <i class='btnLoader fa fa-spinner fa-spin ml-3' style='display:none'></i> </button>

                </div>
              </div>

          </div>
          <div class='group m-b-20' id='meeting_success'></div>
          <div class='group m-b-20' id='meeting_error'></div>

        </div>
       </form>
       <div class='thank-you-popup' id='schedule_cnf' style='display:none'>
       <div class='smallheading text-uppercase text-center'>that’s it!</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-50'>Thanks for contacting us!</div>
          </div>
          <p class='text-center fs-14'>We're now directing you to our scheduling service to pick an e-meet slot. We look forward to starting our journey together! </p>
            <div class='row justify-content-center m-t-50'>
              <div class='col-sm-4 p-0'>
                <!--<button type='button' class='btn btn-theme w-100'><a class='text-white' href=".$current_page_url.">BACK TO ".$current_pageName."<img class='' src=".get_template_directory_uri()."/images/whiteforward.png /></a></button>-->
				<button type='button' class='btn btn-theme w-100'><a class='text-white' href='https://calendly.com/tcglobal'>Book Your Slot<img class='' src=".get_template_directory_uri()."/images/whiteforward.png /></a></button>              
			  
			  </div>
            </div>

       </div>

        </div>
      </div>
    </div>
  </div>";


return $schedule_meeting_form;

}
add_shortcode('schedule_meeting_form', 'scheduleMeeting');


/** Schedule meeting second form goes here **/

function getMeetingDetails(){

global $current_pageName, $current_page_url, $post;

 $leadID = $_GET['id'];
 $email = $_GET['email'];
 $source = $_GET['source'];

$activePage ='';
$service_section = '';

$location_list ='';

$location_list .='<ul>';

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
              'orderby' => 'name',
              'order' => 'ASC', // or ASC
              'hierarchical'  => 1,
              'parent'        => $locationCat->term_id, // get child categories
            )
          );

      foreach ( $sub_categories as $sub_category ){

        if($sub_category->term_id!='48'){
          $location_list .='<li id='.$sub_category->term_id.'><a>'.$sub_category->name.'</a></li>';
       }

      }

    }

$location_list .='</ul>';

$activePage = 'global-ed';
$calendar_img = get_template_directory_uri().'/images/calendar-icon.png';
$time_img = get_template_directory_uri().'/images/time.png';

$schedule_meeting_form ="";

$schedule_meeting_form .="<div class='modal fade' id='meetingForm' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog insights-modal contactform-modal modal-lg' role='document'>
      <div class='modal-content start-journeymodal ".$activePage." book-appointment'>
        <div class='modal-header'>
          <h3 class='smallheading-modal step-form-title'>First things first</h3>
          <h3 class='smallheading-modal cnf-title' style='display:none;'>Confirmation</h3>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <img src='".get_template_directory_uri()."/images/map-close.png' />
          </button>
        </div>
        <div class='modal-body' id='step-progress'>
          <div class='row'>

          </div>
          <form method='post' action='' name='schedule_form' id='schedule_form'>

          <input type='hidden' name='scheduleEmail' id='scheduleEmail' value=".$email." class='w-100 input-value' />

          <input type='hidden' name='leadid' id='userleadid' value=".$leadID.">
          <input type='hidden' name='current_page' value='".$current_pageName."'>
          <input type='hidden' name='ProspectID'>
          <input type='hidden' name='meetingSource' value=".$source.">

          <div id='meeting_first_section'>
          <h3 class='graybg-head first_userdetail'></h3>

          <div class='text-center w-100'>
            <div class='boldheading m-b-70'>When can we connect online?</div>
          </div>
          <div class='row justify-content-center'>
            <div class='col-sm-8'>
              <div class='row'>
                <div class='col-sm-6'>
                  <label class='control-label mb-0'>Choose date</label>
                  <div class='form-group input-group'>
                   <input type='text' name='usermeeting_date' id='usermeeting_date' class='form-control clsDatePicker' value='' readonly />
                    <img class='icon' src=".$calendar_img." />
                  </div>
                </div>
                <div class='col-sm-6'>
                  <label class='control-label mb-0'>Choose- time</label>
                  <div class='form-group select-theme filter-dropdown border-bottom-0'>
                    <input type='text' name='userschedule_time' id='userschedule_time' value='' class='schedule_time form-control value-selected' readonly />
                    <img class='icon' src=".$time_img." />
                    <div class='dropdown-menu schedule_time_show'>
                      <ul>
                        <li><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>All day</a></li>
                        <li id='mm_10'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>10:00-11:00 AM</a></li>
                        <li id='mm_11'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>11:00-12:00 PM</a></li>
                        <li id='mm_12'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>12:00-13:00 PM</a></li>
                        <li id='mm_13'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>13:00-14:00 PM</a></li>
                        <li id='mm_14'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>14:00-15:00 PM</a></li>
                        <li id='mm_15'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>15:00-16:00 PM</a></li>
                        <li id='mm_16'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>16:00-17:00 PM</a></li>
                        <li id='mm_17'><a><img src='".get_template_directory_uri()."/images/drop-tick.jpg' alt=''>17:00-18:00 PM</a></li>
                      </ul>

                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='termslink m-b-30 m-t-10'>
                    <div class='customcheckbox'>
                      <input type='checkbox' name='checkbox_verify' id='checkbox_verify'>
                      <label for='checkbox_verify'><span>Don’t have time to connect online? Let’s schedule a call.</span></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class='enbale-location'>
               <div class='row'>
                <div class='col-md-6'>
                  <div class=''>
                    <label class='control-label'>Choose location</label>
                    <div class='row'>
                      <div class='col-md-12'>
                        <div class='dropdown select-theme filter-dropdown select-box pl-0'>
                          <button class='btn btn-secondary dropdown-toggle meetuser_loc value-selected' type='button'>Select</button>
                        </div>
                        <div class='dropdown-list meetuser_loc_list' style='display:none'>

                          ".$location_list."
                        </div>
                        <input type='hidden' name='usermeetingplace' id='usermeetingplace' value=''>
                        <input type='hidden' name='meetingplace_field' id='meetingplace_field' value=''>

                      </div>
                    </div>
                  </div>
                  <div class='address'>
                    <label class='control-label m-t-20'>Address</label>
                    <div id='schedulemeeting_addr'></div>

                      <div class='custom-tooltip'>
                        <h6>It’s the closest venue based on your location. <br>Feel free to change it! </h6>
                      </div>
                    </div>
                  </div>

                  <div class='col-md-6'>
                    <div id='schedulemeeting_map'></div>
                  </div>

                 </div>
                </div>
                <div class='row justify-content-center m-t-60'>
                  <div class='col-sm-6 text-center'>
                  <button type='button' onclick=UserMeetingSchedule('web'); class='btn btn-theme w-100 schedule-btn'>schedule your meeting<img class='' src='".get_template_directory_uri()."/images/whiteforward.png' /><i class='btnLoader fa fa-spinner fa-spin ml-3' style='display:none'></i></button>

                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class='group m-b-20' id='scheduleSuccess'></div>
        <div class='group m-b-20' id='scheduleError'></div>
       </form>
       <div class='thank-you-popup' id='meeting_cnf' style='display:none'>
       <div class='smallheading text-uppercase text-center'>that’s it!</div>
          <div class='text-center w-100'>
            <div class='boldheading m-b-50'>Thank you for your trust.</div>
          </div>
          <p class='text-center fs-14'>We will contact you shortly and together <br>
             we will focus on your journey.</p>
            <div class='row justify-content-center m-t-50'>
              <div class='col-sm-4 p-0'>
                <button type='button' class='btn btn-theme w-100'><a class='text-white' href=".$current_page_url.">BACK TO ".$current_pageName."<img class='' src=".get_template_directory_uri()."/images/whiteforward.png /></a></button>
              </div>
            </div>

       </div>

        </div>
      </div>
    </div>
  </div>";


return $schedule_meeting_form;

}
add_shortcode('meetingSchedule', 'getMeetingDetails');

function campaignForm(){

  global $current_pageName, $current_page_url, $post;

  $sourceVal = $_GET['source'];

  $form_title = get_post_meta( '114', 'first_heading', true );
  $form_subtitle = get_post_meta( '114', 'second_heading', true );

  $backPageURL = $current_page_url;
  if($sourceVal!='')
  {
    $backPageURL = $current_page_url.'?source='.$sourceVal;
  }

$campaign_form = '';
$campaign_form .='<div class="formbottom">
                <div class="formheading m-b-40">'.$form_title.'<br>'.$form_subtitle.'</div>

            <form action="" name="campcontactform" id="campcontactform" method="post" class="wpcf7-form wpcf7-acceptance-as-validation theme_1 noErrorMsg">
            <div class="group">
               <input type="text"  class="w-100 input-value contact_form_field name-field" novalidate name="campaign_name" id="campaign_name" required>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your name</label>
            </div>
            <div class="group">
               <input type="text"  class="w-100 input-value contact_form_field" novalidate name="campaign_email" id="campaign_email" required>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your e-mail</label>
            </div>
            <div class="group enter-mobile-number contact-number">
               <input type="text" placeholder="Your mobile number" class="w-100 input-value contact_form_field number-field campcontactflag" minlength="10" maxlength="10" novalidate name="campaign_mobile" id="campaign_mobile" size="15" required>
            </div>
            <div class="group">


               <div class="dropdown select-theme filter-dropdown select-box pl-0">
                <button class="btn btn-secondary dropdown-toggle campcontact-service value-selected" type="button">Global Education</button>
                <div class="dropdown-menu campcontact-service-show" style="display: none;">
                  <ul id="campaign-service">
                    <li id="Global Education"><a class="active"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Education</a></li>
                    <li id="Global Learning"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Learning</a></li>
                    <li id="Global Investments"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Investments</a></li>
                    <li id="WorkSpace"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">WorkSpace</a></li>
                  </ul>
                </div>
                <input type="hidden" name="campcontact-service" id="campcontact-service" value="Global Education">
              </div>

            </div>
            <div class="group m-b-20">
               <textarea class="w-100 contact-textarea input-value contact_form_field" placeholder="" name="campmessage" id="campmessage" rows="4"></textarea>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your message</label>
            </div>
            <div class=" termslink m-b-30">
               <div class="customcheckbox">
                  <input type="checkbox" id="campaignTerms" name="campaignTerms">
                  <label for="campaignTerms" id="campaignTermserror" class="" ><span >Accept Tc Globals <a href="'.get_permalink(134).'">Terms & Conditions</a> and <a href="'.get_permalink(3).'">Privacy Policy</a></span></label>
               </div>
            </div>
      <div class="group m-b-20" id="camp_contact_success"></div>
      <div class="group m-b-20" id="camp_contact_error"></div>
            <div class="group ">
      <input type="hidden" value="'.$current_pageName.'" name="currentPage" >
      <input type="hidden" value="'.$sourceVal.'" name="pagesource" >
      <input type="hidden" name="ProspectID" id="ProspectID" >
               <button type="button" class="redbtn w-100 d-flex align-items-center justify-content-center text-uppercase text-decoration-none campaignform">SEND <i class="spinLoader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
            </div>
         </form>

      </div>';


  $campaign_form .='<div class="modal fade contact-popup" id="contact-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog insights-modal contactform-modal modal-lg" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="'.get_template_directory_uri().'/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body">
          <div class="smallheading text-uppercase text-center m-t-60">that’s it!</div>
          <div class="text-center w-100">
            <div class="boldheading m-b-30">Thank you for your trust.</div>
            <div class="path"></div>
          </div>
          <p class="text-center fs-14 font-regular m-t-60 pb-3">Thanks for contacting us! We will reach you shortly and start our journey together.</p>
          <div class="row justify-content-center m-t-50">
              <div class="col-sm-4 p-0">
                <a class="text-white" href='.$backPageURL.'><button type="button" class="btn btn-theme w-100">BACK TO '.$current_pageName.'
                <img class="" src="/wp-content/themes/tcglobal/images/whiteforward.png"></button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';

return $campaign_form;

}

add_shortcode('campaignContactForm', 'campaignForm');

function campaign_timeline_details($atts){

  global $post;
  $campaign_detail = '';
  $title = '';

  $title = $atts['title'];
  $timeline_category_id = $atts['id'];

  $campaign_query = new WP_Query(
        array('post_type' => 'te_announcements',
                'order' => 'ASC',
          'tax_query' => array(
        array(
            'taxonomy' => 'timeline_cat',   // taxonomy name
            'terms' => $timeline_category_id,                  // term id, term slug or term name
          )
        )
      )
    );

  $campaign_detail .='<div class="desktop-globaled-learning-leadership p-t-80 ">
      <div class="container">
        <div class="row">

        <div class="col-sm-5 p-0 templateone-timeline">
            <h2 class="desktop-main-heading text-left">'.$title.'</h2>
            <ul class="timeline theme-process">';

              if($campaign_query->have_posts()) :
              while ($campaign_query->have_posts()) : $campaign_query->the_post();

                  $timelineID = get_the_ID();
                  $arrow = get_post_meta( $timelineID, 'timeline_arrow', true );
                  $timeline_arrow_img = wp_get_attachment_image_src($arrow);

                  $actionbtn = get_post_meta( $timelineID, 'action_button_name', true );
                  $actionurl = get_post_meta( $timelineID, 'action_button_link', true );

                  if($actionurl == 'global-ed-form')
                  {
                    $popup_action='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
                  }

                $banner_img = '<img src="'.get_post_meta( $timelineID, 'announcement_image', true ).'" alt="" />';

             $campaign_detail .='<li class="">
                <div class="row align-items-center">
                  <div class="col-sm-2 pr-0 icon">
                    <img src="'.$timeline_arrow_img[0].'" alt="" class="img-fluid" />
                  </div>
                  <div class="col-sm-10">
                    <p>'.get_post_field('post_content', $timelineID).'</p>
                  </div>
                </div>
              </li>';


              endwhile;
              endif;

        $campaign_detail .='</ul>
            <div class="text-center pr-4">
              <a class="text-white" href='.$actionurl.' '.$popup_action.'><button type="button" class="btn btn-red btn-theme">'.$actionbtn.'<img src="'.get_template_directory_uri().'/images/whiteforward.png" /></button></a>
            </div>
          </div>';

          $campaign_detail .='<div class="col-sm-7">
          <div class="contactblock p-0 mx-auto col-sm-10 floating-contact">';

          $campaign_detail .= do_shortcode( "[campaignContactForm]" );

          $campaign_detail .='</div><div class="img-timeline">
              '.$banner_img.'
            </div>
          </div>';

      $campaign_detail .='</div>
    </div>
  </div>';

   wp_reset_postdata();
return $campaign_detail;

}
add_shortcode('campaign_timeline', 'campaign_timeline_details');

function sectionDetail($atts){
  global $post;
  $pID = $atts['id'];
  $title = $atts['title'];
  $popup_action = '';

  $post = get_post($pID);

  $image = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'full' );

  $button = get_post_meta( $pID, 'citizenship_button', true );
  $link = get_post_meta( $pID, 'citizenship_link', true );

  if($link == 'global-ed-form')
    {
      $popup_action='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear" data-keyboard="false" data-backdrop="static"';
    }

  $campaign_section .='<div class="locations-experience-centres p-t-80 p-b-60">
      <div class="container">
        <h2 class="desktop-main-heading">'.$title.'</h2>
        <div class="row justify-content-between p-t-40">
          <div class="col-sm-5">
            <h3 class="fs-20 mt-3 m-b-15">'.$post->post_title.'</h3>
            <p class="fs-14 mb-4 pb-2">'.$post->post_content.'</p>
              <a href="'.$link.'" '.$popup_action.'><button type="button" class="btn btn-theme">'.$button.'</button></a>
            </div>
            <div class="col-sm-6">
              <img class="img-fluid" src="'.$image[0].'" alt=""  />
            </div>
          </div>
        </div>
      </div>';

      return $campaign_section;


}
add_shortcode('global', 'sectionDetail');

function getCountryFAQ($atts){

  $categoryID = $atts['id'];
  $faqtitle = $atts['title'];

  $i = 1;
  $countryfaq ='';

  $faqQuery = new WP_Query(array(
            'post_type' => 'ufaq',
            'order' => 'ASC',
      'tax_query' => array(
            array(
            'taxonomy' => 'ufaq-category',   // taxonomy name
            'terms' => $categoryID,                  // term id, term slug or term name
            )
        )
    ));

  $helpcenterlink = get_term_meta( $categoryID, 'faq_help_centre_link', true );

  $countryfaq .= '<div class="col-sm-12">
    <div class="desktop-faq-verticaltab country-detail-accordion">
      <h4>'.$faqtitle.'</h4>
      <div class="accordion m-t-20" id="accordionExample">';

  if($faqQuery->have_posts()) :
    while ($faqQuery->have_posts()) : $faqQuery->the_post();

    $faqID = get_the_ID();


    $countryfaq .= '<div class="card">
      <div class="card-header" id="heading'.$i.'">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapse'.$i.'">
         '.get_the_title($faqID).'<img src="/wp-content/themes/tcglobal/images/accordion-arrow.png" />
        </button>
      </div>
      <div id="collapse'.$i.'" class="collapse" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
        <div class="card-body">
          '.get_post_field('post_content', $faqID).'
        </div>
      </div>
    </div>';

    $i++;
   endwhile;
endif;

$countryfaq .= '</div></div></div>';

$countryfaq .= '<div class="col-sm-12">
<div class="row m-b-30">
<div class="col-sm-4 desktop-faq-verticaltab"><h4><span class="d-block">Didn\'t find the answer?</span>Explore our Help Center</h4></div>
<div class="col-sm-3">
<a class="text-white" href="'.$helpcenterlink.'" target="_blank"><button type="button" class="btn btn-theme w-100">help center<img src="'.get_template_directory_uri().'/images/whiteforward.png" /></button></a>
</div></div></div>';

wp_reset_postdata();
return $countryfaq;

}
add_shortcode('countryFAQ', 'getCountryFAQ');


function getDiscoverCountryList($atts){

  global $post;
  $title = $atts['title'];
  $countryList ='';
  $universeImgID = ''; $universeImg=''; $universitycount='';

  $exclude_id ='';
  $countryBtn ='';

  $countryContent = '';

  $courseImgID=''; $courseImg=''; $coursecount='';

  $args = array(
      'post_type'      => 'page',
      'posts_per_page' => 3,
      'post_parent'    => 1640,
      'order'          => 'DESC',
      'orderby'        => 'id'
   );

$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : 
  while ( $parent->have_posts() ) : $parent->the_post(); 
        
         $subpageID = get_the_ID();

         $exclude_id .=$subpageID.',';

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

        $countryContent .= '<div class="col-sm-4 m-b-30">
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

     endwhile;
     endif; 

    $max_pagenum = $parent->max_num_pages;
    
    if ( $max_pagenum > 1 )
    {
      $countryBtn .= '<div class="col-sm-12 text-center">
      <a id="loadCountryPage" class="explorelink text-uppercase text-decoration-none" tabindex="0">All countries<span class="pl-3"><img src="/wp-content/themes/tcglobal/images/down_2.png" alt=""></span></a>
    </div>';
    }

    $exclude_page = rtrim($exclude_id, ',');

    $countryList .= '<div class="col-sm-12">
    <div class="popular-course search-country-courselist col-sm-12 px-0 bg-white pt-3">
    <div class="text-center">
      <div class="boldheading">'.$title.'</div>
      <div class="path"></div>
    </div>
    <div class="row" id="country_post">';

    $countryList .= $countryContent;

    $countryList .= '</div></div></div>';
    $countryList .='<input type="hidden" name="exclude_page" value="'.$exclude_page.'">';
    $countryList .= $countryBtn;

    wp_reset_postdata();
    return $countryList;

}
add_shortcode('discover_country', 'getDiscoverCountryList');

function get_speaker_list($atts){

  $id = $atts['id'];
  $title = $atts['title'];
  $speakerlist= '';

$memQuery = new WP_Query(
        array('post_type' => 'team_showcase_post',
                'order' => 'ASC',
                'posts_per_page'=>-1,
          'tax_query' => array(
            array(
                'taxonomy' => 'tsas-category',   // taxonomy name
                'terms' => $id,                  // term id, term slug or term name
              )
            )
          )
      );

  $speakerlist .='<div class="about-leadership p-t-80 p-b-40">
      <div class="container">
        <h2 class="desktop-main-heading m-b-80">'.$title.'</h2>
        <div class="row p-b-20">';

  if($memQuery->have_posts()) :
    while ($memQuery->have_posts()) : $memQuery->the_post();

      $memberID = get_the_ID();
      $teamimg = wp_get_attachment_image_src( get_post_thumbnail_id($memberID), 'medium' );

      if($teamimg){
        $userphoto = $teamimg[0];
      }
      else{
        $userphoto = "/wp-content/uploads/2019/08/no-img.png";
      }

      $speakerlist .='<div class="col-sm-2 member-list">
            <img src="'.$userphoto.'" alt="" class="img-fluid profile" />
            <h3><img src="/wp-content/uploads/2019/08/memberlist-arrow.png" alt="" class="img-fluid" >'.get_the_title($memberID).'</h3>
            <p>'.get_post_meta($memberID, '_member_designation', true ).'</p>
          </div>';

      endwhile;
   endif;

   $speakerlist .='</div></div></div>';

  wp_reset_postdata();

   return $speakerlist;
}
add_shortcode('speakers', 'get_speaker_list');


function university_logo($atts){

  $university_cat_id = $atts['id'];
  $logotitle = $atts['title'];
  $university_logo = '';

  $logoQuery = new WP_Query(
        array('post_type' => 'service-box',
                'order' => 'DESC',
                'posts_per_page'=>-1,
          'tax_query' => array(
            array(
                'taxonomy' => 'service-cat',   // taxonomy name
                'terms' => $university_cat_id,                  // term id, term slug or term name
              )
            )
          )
      );

  $university_logo .='<div class="p-t-40 p-b-80">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 p-b-20">
            <h2 class="desktop-main-heading m-b-80">'.$logotitle.'</h2>
          </div>
        </div>
        <section class="companyname-carousel slider tablet-upcoming-event my-0 p-b-20">';

        if($logoQuery->have_posts()) :
        while ($logoQuery->have_posts()) : $logoQuery->the_post();

          $logoimg = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );

          $university_logo .='<div>
            <img src="'.$logoimg[0].'" alt="company logo" class="img-fluid" />
          </div>';

        endwhile;
        endif;
        $university_logo .='</section>
      </div>
    </div>';

  wp_reset_postdata();
  return $university_logo;

}
add_shortcode('university_carousel', 'university_logo');


function schedule_section($atts){

global $post;

  $scheduletitle = $atts['title'];

  $scheduleQuery = new WP_Query(
          array('post_type' => 'tc-schedule',
                'order' => 'DESC',
                'posts_per_page' => -1,
              )
          );

  $scheduleContent ='';

  $scheduleContent .='<div class="schedule-section bg-gray p-t-80 p-b-60">
      <h2 class="desktop-main-heading">'.$scheduletitle.'</h2>
      <div class="container p-t-40">
        <div class="row">';

    if($scheduleQuery->have_posts()) :
        while ($scheduleQuery->have_posts()) : $scheduleQuery->the_post();

        $scdate = '';
        $scmonth = '';

          $scheduleplaceid = get_the_ID();
          $tcdate = get_post_meta($scheduleplaceid, 'schedule_date', true );

          $dateInput = date('d F', strtotime($tcdate));
          $splitdate = explode(" ",$dateInput);

          $schedule_start_time = get_post_meta($scheduleplaceid, 'schedule_start_time', true );
          $schedule_end_time = get_post_meta($scheduleplaceid, 'schedule_end_time', true );

          $scheduleContent .='<div class="col-sm-3">
            <div class="list">
              <h2>'.$splitdate[0].'</h2>
              <h3>'.$splitdate[1].'</h3>
              <h4>'.get_the_title($scheduleplaceid).'</h4>
              <div class="row">
                <div class="col-2 pr-0">
                  <img src="'.get_template_directory_uri().'/images/map.png" />
                </div>
                <div class="col-10 pl-2">
                  <p>'.get_the_content($scheduleplaceid).'</p>
                </div>
              </div>
              <div class="row">
                <div class="col-2 pr-0">
                  <img src="'.get_template_directory_uri().'/images/time.png" />
                </div>
                <div class="col-10 pl-2">
                  <p>'.$schedule_start_time.'-'.$schedule_end_time.'</p>
                </div>
              </div>
            </div>
          </div>';

        endwhile;
        endif;
      $scheduleContent .='</div></div></div>';

      wp_reset_postdata();

      return $scheduleContent;

}

add_shortcode('schedule', 'schedule_section');


function explore_section($atts){

  $explore_cat_id = $atts['id'];
  $explore_title = $atts['title'];
  $explore_button = $atts['button_name'];

  $exploreContent ='';

  $exploreQuery = new WP_Query(
          array('post_type' => 'solutions',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'tax_query' => array(
          array(
              'taxonomy' => 'solution-cat',   // taxonomy name
              'terms' => $explore_cat_id,  // term id, term slug or term name
            )
          )
        )
      );

  $exploreContent .= '<div class="list-content-section p-t-40 p-b-80">
      <div class="container">
        <h2 class="desktop-main-heading">'.$explore_title.'</h2>
        <div class="row p-t-40">';

   if($exploreQuery->have_posts()) :
      while ($exploreQuery->have_posts()) : $exploreQuery->the_post();

      $exploreid = get_the_ID();

      $exploreimg = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
      $explorelink = get_post_meta( $exploreid, 'section_link', true );

    $exploreContent .= '<div class="col-sm-4 p-b-60">
            <div class="row">
              <div class="col-sm-2 pr-0 pt-1">
                <img src="'.$exploreimg[0].'" alt=""  />
              </div>
              <div class="col-sm-10">
                <h4 class="fs-20">'.get_the_title($exploreid).'</h4>
                <p class="fs-14 mb-0">'.get_the_content($exploreid).'</p>
              </div>
            </div>
          </div>';

      endwhile;
    endif;

    $exploreContent .='</div>
        <div class="row">
          <div class="col-sm-12 text-center">
            <a href="'.$explorelink.'"><button type="button" class="btn btn-theme w-auto px-5">'.$explore_button.'</button></a>
          </div>
        </div>
      </div>
    </div>';

      wp_reset_postdata();

      return $exploreContent;

}
add_shortcode('explore', 'explore_section');
