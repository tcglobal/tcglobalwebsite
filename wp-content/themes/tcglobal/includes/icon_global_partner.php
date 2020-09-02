<?php

/** Global Ed Why TC Global Ed section **/
function get_global_partner_fun($atts){
global $post, $wpdb, $tc_head, $tc_subhead;
$partner = '';
$partner_id = $atts['id'];
$title = $atts['title'];
$subtitle = $atts['subtitle'];
$number_icon_row = $atts['per_row'];
$backgroundclass = $atts['bgclass'];

$per_icon_row = 4;
if($number_icon_row==4)
{
	$per_icon_row = 3;
} 
 
$bgclass = ' ';
if(!empty($backgroundclass))
{
	$bgclass = $backgroundclass; //p-t-80 global-investment-places bg-gray
}


$partner .='<div class="desktop-globaled-whysection '.$bgclass.'">';
$partner .='<h3 class="desktop-sub-heading">'.$title.'</h3>';
$partner .='<h2 class="desktop-main-heading">'.$subtitle.'</h2>';
$partner .='<div class="container">';
$partner .='<div class="row">';
	
	
	$get_global_partner = new WP_Query(
          array('post_type' => 'solutions','orderby' => 'term_id','order' => 'ASC',
              'tax_query' => array(
          array(
              'taxonomy' => 'solution-cat',   // taxonomy name
              'terms' => $partner_id,  // term id, term slug or term name
            )
          )
            )
      );
	  
	while ( $get_global_partner->have_posts() ) : $get_global_partner->the_post();
		$partner_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		$partner .='<div class="col-sm-'.$per_icon_row.'">';
		$partner .='<img src="'.$partner_img[0].'" />';
		$partner .='<h4 class="fs-20 text-left">'.get_post_meta($post->ID, 'section_title', true ).'</h4>';
		$partner .='<p class="fs-14 text-left">'.get_post_field('post_content', $post->ID).'</p>';
		$partner .='</div>';
	endwhile;

  $partner .='</div>';
  $partner .='</div>';
  $partner .='</div>';

  return $partner;
}
add_shortcode('global_partner', 'get_global_partner_fun');   