<?php

/* Our solutions page service sections */
function get_service_section($atts){
  global $post, $wpdb;
  $cat_id = $atts['id'];
  $number_row = $atts['mobile_row'];
  $layout = $atts['layout'];

  $backgroundclass = $atts['tab_bgclass'];
  $headingtitle = $atts['headingtitle'];
  $subheading = $atts['subheading'];

  $count = 1;
  $k =1; $service='';
  $service_title = '';

  $headTitle = '';
  if(!empty($headingtitle))
  {

    $headTitle .='<div class="mobile-main-heading boldheading">'.$headingtitle.'</div>';
  }
  if(!empty($subheading)){

    $subTitle .='<h4 class="fs-14 m-b-40">'.$subheading.'</h4>';
  }


  $per_row = 12;
  $addtionalcss  = 'container';
  $addtionalcss1  = '';
  if($number_row == 2)
  {
    $per_row = 9;
    $addtionalcss  = 'container-fluid';
    $addtionalcss1  = 'justify-content-center';
  }
  /*elseif($number_row==4 && $subheading != "")
  {
    $per_row = 12;
    $addtionalcss  = 'container';
  }*/

  $bgclass = ' p-t-20 ';
  if(!empty($backgroundclass))
  {
    $bgclass = $backgroundclass; //p-t-80 global-investment-places bg-gray
  }

$query = new WP_Query(
          array('post_type' => 'service-box','orderby' => 'term_id','order' => 'ASC',
              'tax_query' => array(
          array(
              'taxonomy' => 'service-cat',   // taxonomy name
              'terms' => $cat_id,  // term id, term slug or term name
            )
          )
            )
      );

if($layout == "style_one" || $layout == "style_two"){

  $service .='<div class="'.$addtionalcss.' p-t-30">';
  $service .='<div class="global-space global-investment-places">';
  $service .='<div class="text-center">';
  $service .= $headTitle;
  $service .='</div>';
  $service .= $subTitle;
  $service .='</div>';
  $service .='</div>';

$service .='<section class="carousel-icon global-space global-investment-places slider mb-0 p-b-30">';
}

elseif($layout == "style_three"){

  $service .='<div class="about-signup p-t-50 p-b-20 global-investment-places">
  <div class="global-space">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="mobile-main-heading">'.$headingtitle.'</h2>
          <h4 class="fs-14 p-t-10 m-b-40">'.$subheading.'</h4>';
  $service .='<div class="row">';

}

elseif($layout == 'style_four'){

  $service .='<div class="fieldicon-description bg-gray global-space p-t-30 p-b-20">
        <div class="container-fluid">
        <h2 class="mobile-main-heading">'.$headingtitle.'</h2>
          <div class="row p-t-20">';
}

else{

  if(!empty($headingtitle))
  {
    $service .='<div class="global-space p-t-50">
        <div class="container-fluid">
          <h2 class="mobile-main-heading">'.$headingtitle.'</h2>
        </div>
      </div>';
  }

   $service .='<section class="carousel-icon slider mobile-learning-iconfield mb-0 p-b-60" >';
}

if($layout != "style_three" && $layout != "style_four")
{
  $service .='<div><div class="row">';
}

while ( $query->have_posts() ) : $query->the_post();

  $service_title = get_post_meta( $post->ID, 'service_title', true );

  $service_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );

  if($layout == "style_one" || $layout == "style_two"){

    $number_row = 2;

  $service .='<div class="col pr-2 m-b-30">';
  $service .='<img src="'.$service_img[0].'" class="img-fluid m-b-20 mx-auto" />';

  if($service_title){
    $service .='<h5>'.$service_title.'</h5>';
  }

  $service .='<p class="fs-12 text-center" >'.nl2br(get_post_field('post_content', $post->ID)).'</p>';
  $service .='</div>';

  if($k%$number_row ==0){ $service .='</div>';}
  if($count%4 ==0){ $service .='</div><div>';}
  }

elseif($layout == "style_three"){

  $service .='<div class="col text-center">
              <img src="'.$service_img[0].'" class="img-fluid m-b-20" />
              <p class="fs-12 m-b-30">'.get_post_field('post_content', $post->ID).'</p>
            </div>';
  if($k%2 ==0){ $service .='</div><div class="row">';}

}

elseif($layout == 'style_four'){

  $service .='<div class="col-6 p-b-20 px-0">
              <img class="img-fluid d-block mx-auto mb-4" src="'.$service_img[0].'" alt="" />
              <p class="text-center">'.nl2br(get_post_field('post_content', $post->ID)).'</p>
            </div>';
}

else{
    $service .='<div class="col-6">';
    $service .='<img src="'.$service_img[0].'" class="img-fluid" />';
    $service .='<p>'.get_post_field('post_content', $service_id).'</p>';
    $service .='</div>';

  if($k%$number_row ==0){ $service .='</div>';}
  if($count%6 ==0){ $service .='</div><div>';}

}

if($layout != "style_three" && $layout != "style_four"){

  if($k%$number_row ==0) { $service .='<div class="row">';}
}

  $k++;
  $count++;

  endwhile;
  wp_reset_postdata();

if($layout == "style_one" || $layout == "style_two"){
  $service .='</section></div></div></div>';
}

elseif($layout == "style_three"){
  $service .='</div></div></div></div></div></div>';
}

elseif($layout == 'style_four'){
  $service .='</div></div></div>';
}

else{
  $service .='</section>';

}

 return $service;

}
add_shortcode('service_section', 'get_service_section');
