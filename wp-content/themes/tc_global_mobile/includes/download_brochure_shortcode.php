<?php 
/** download brochure shortcode  section **/
function download_brochure_fun($atts){
global $tc_head, $tc_subhead, $post, $wpdb;
  $download_category_id = $atts['id'];
  $title = $atts['title'];
  $download='';
  
  $download_query = new WP_Query(
          array('post_type' => 'citizenship',
            'order' => 'ASC',
              'tax_query' => array(
          array(
              'taxonomy' => 'global-cat',   // taxonomy name
              'terms' => $download_category_id,  // term id, term slug or term name
            )
          )
            )
      );

$download .='<div class="mobile-global-learningfeature global-workspace-solutions pt-0 p-b-20">';
$download .='<div class="container-fluid">';
$download .='<h2 class="mobile-main-heading m-b-60">'.$title.'</h2>';
$download .='<div class="row justify-content-center">';

if($download_query->have_posts()) :
  while ($download_query->have_posts()) : $download_query->the_post(); 

   $download_postid = get_the_ID();
	 $futureimg = wp_get_attachment_image_src( get_post_thumbnail_id($download_postid), 'full' ); 

  $download_action = '';
  $downloadlink = get_post_meta( $download_postid, 'citizenship_link', true );
    if($downloadlink == 'global-ed-form')
    {
      $download_action ='data-toggle="modal" data-target="#start_journey_form" class="journey_formClear allformtrigger" data-keyboard="false" data-backdrop="static"';
    }

   $form_action = '';
    $formlink = get_post_meta( $download_postid, 'link_two', true );

    if($formlink == 'schedule_form')
    {
      $form_action ='data-toggle="modal" data-target="#schedule_form" class="meetingFormClear allformtrigger" data-keyboard="false" data-backdrop="static"';
    }
	
    $download .='<div class="col-sm-12">';
    $download .='<div class="card-group">';
    $download .='<div class="card content-list p-0">';
    $download .='<div class="card-body">';
    $download .='<img src="'.$futureimg[0].'" class="img-fluid" />';
    $download .='<div class="card-space">';
    $download .='<h4 class="fs-20">'.get_the_title($download_postid).'</h4>';
    $download .='<p class="fs-14">'.get_post_field('post_content', $download_postid).'</p>';
    $download .='</div>';
    $download .='</div>';
    $download .='<div class="card-footer">';
    $download .='<span class="taglist">Ideal for</span>';
    $download .='<p class="fs-14 list-view"><span class="list-disc">.</span>'.get_post_meta( $download_postid, 'citizenship_title', true ).'</p>';
    $download .='<div class="row">';
    $download .='<div class="col-sm-12 mb-2">';
    $download .='<a href="'.$downloadlink.'" '.$download_action.'><button type="button" class="btn btn-fill btn-theme">'.get_post_meta($download_postid, 'citizenship_button', true ).'</button></a>';
    $download .='</div>';
    $download .='<div class="col-sm-12">';
    $download .='<a href="'.$formlink.'" '.$form_action.'><button type="button" class="btn btn-outline btn-theme">'.get_post_meta($download_postid, 'global_button_two', true ).'</button></a>';
    $download .='</div>';
    $download .='</div>';
    $download .='</div>';
    $download .='</div>';
    $download .='</div>';
    $download .='</div>';

endwhile; 
endif; 
wp_reset_postdata();
$download .='</div></div></div>';

return trim($download);
}
add_shortcode('download_brochure', 'download_brochure_fun');    