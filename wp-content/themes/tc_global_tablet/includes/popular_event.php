<?php

function get_popular_event_fun($atts) {

  $title = $atts['title'];
  $layout = $atts['layout'];
  $sub_title = $atts['sub_title'];

  if($layout == "style_one"){ $ppp = 3; }
  if($layout == "style_two") { $ppp = 6; }
  if($layout == "style_three") { $ppp = 6; }

  global $post, $wpdb, $wp_query;

  $popular_event = '';

 if($layout == "style_one") {  /** get popular events **/

      $args = array(
      'post_type' => 'event_listing',
      'meta_key' => 'event_views_count',
      'orderby' => 'meta_value_num',
          'order' => 'DESC',
          'posts_per_page' => $ppp
       );
  }

  else{

  $args = array( 'post_type' => 'event_listing',
        'order' => 'DESC',
       'posts_per_page' => $ppp

     );

  }

  if($layout == "style_two" || $layout == "style_three") {

    $args['meta_query'] = array(
            array(
                'key' => '_featured',
                'value' => 1,
                'compare' => '='
              )
          );
  }

  $popular_query = new WP_Query( $args );

if($layout == "style_one") {

    $popular_event .='<div class="popular-course event-popularcourse tablet-upcoming-event pt-0">';

    if($title){
      $popular_event .='<div class="text-center">';
      $popular_event .='<div class="main-heading">'.$title.'</div>';
      $popular_event .='</div>';
    }

    $popular_event .='<div class="container-fluid">';
    $popular_event .='<div class="row">';

}

if($layout == "style_two")
{
  $popular_event .='<div class="tablet-upcoming-event mb-0">
      <h3 class="sub-heading">'.$title.'</h3>
      <h2 class="main-heading">'.$sub_title.'</h2>
  </div>
  <section class="carousel slider tablet-upcoming-event my-0">';

}
if($layout == "style_three")
{
  $popular_event .='<div class="tablet-upcoming-event mb-0">
      <h2 class="main-heading">'.$title.'</h2>
      </div>
  <section class="carousel slider tablet-upcoming-event my-0">';

}

if($popular_query->have_posts()) :
  while ($popular_query->have_posts()) : $popular_query->the_post();

  $popular_eve_id = get_the_ID();

  $popular_img = wp_get_attachment_image_src( get_post_thumbnail_id( $popular_eve_id), 'full' );
    $pevent_addr = get_post_meta(  $popular_eve_id, '_event_address', true );
    $pevent_stime = get_post_meta(  $popular_eve_id, '_event_start_time', true );
    $pevent_etime = get_post_meta(  $popular_eve_id, '_event_end_time', true );

     $post_categories = get_the_terms( $popular_eve_id, 'event_categories' );

     if($layout == "style_one")
      {

          $popular_event .='<div class="col-sm-4">';
            $popular_event .='<div class="course-list">';
              $popular_event .='<div class="img-sec">';
                $popular_event .='<a href="'.get_permalink( $popular_eve_id ).'"><img src="'.$popular_img[0].'" alt="course-img" class="img-fluid"></a>';
                //$popular_event .='<a class="addfav" href=""><img src="'.get_template_directory_uri().'/images/added-fav.png" alt="course-img" class="img-fluid"></a>';
              $popular_event .='</div>';
              $popular_event .='<div class="row">';
                $popular_event .='<div class="col-sm-12">';
                  $popular_event .='<div class="contentslider">';
                    $popular_event .='<span class="taglabel">'.$post_categories[0]->name.'</span>';
                    $popular_event .='<div class="formheading pb-2 pt-0"><a href="'.get_permalink( $popular_eve_id ).'">'.get_the_title($popular_eve_id).'</a></div>';
                    $popular_event .='<div class="officename pb-1">'.$pevent_addr.'</div>';
                    $popular_event .='<div class="datetime mb-1">'.$pevent_stime.' - '.$pevent_etime.'</div>';
                  $popular_event .='</div>';
                $popular_event .='</div>';
              $popular_event .='</div>';
            $popular_event .='</div>';
          $popular_event .='</div>';
      }

  if($layout == "style_two" || $layout == "style_three")
  {

      $popular_event .='<div>
        <div class="singleslideitem">
          <div class="position-relative">
            <a href="'.get_permalink( $popular_eve_id ).'"><img src="'.$popular_img[0].'" alt=""></a>
            <div class="view-indicator">
              <img src="'.get_template_directory_uri().'/images/indicator-down.png" alt="" class="view-pointer img-fluid">
            </div>
          </div>
          <div class="contentslider">
            <span class="taglabel">'.$post_categories[0]->name.'</span>
            <h2><a href="'.get_permalink( $popular_eve_id ).'">'.get_the_title($popular_eve_id).'</a></h2>
            <div class="officename pb-1">'.$pevent_addr.'</div>
            <div class="datetime">'.$pevent_stime.' - '.$pevent_etime.'</div>
          </div>
        </div>
      </div>';
  }

endwhile;
endif;

if($layout == "style_one")
  {
    $popular_event .='</div>';
    $popular_event .='</div>';
    $popular_event .='</div>';
  }

if($layout == "style_two")
{
   $popular_event .='</section>
  <div class="tablet-upcoming-event mt-0 text-center">
    <a href="/events"  class="eventbtn d-block text-decoration-none mx-auto text-uppercase">Go To Events <span><img src="/wp-content/uploads/2019/08/whiteforward.png" alt="" width="13"></span></a>
  </div>';
}
if($layout == "style_three")
{
  $popular_event .='</section>';
}

wp_reset_postdata();
return $popular_event;

}

add_shortcode('popular_events', 'get_popular_event_fun');
?>
