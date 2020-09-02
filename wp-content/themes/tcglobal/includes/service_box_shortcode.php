<?php 

/* Our solutions page service sections */
function get_service_section($atts){
  global $post, $wpdb;
  $cat_id = $atts['id'];

  $layout = $atts['layout'];

  $number_row = $atts['per_row'];
  $backgroundclass = $atts['bgclass'];
  $headingtitle = $atts['headingtitle'];
  $subheading = $atts['subheading'];
  $k =1; $service='';
  $service_title = '';
  
  $headTitle = '';
  if(!empty($headingtitle))
  {
    $headTitle = '<h2 class="desktop-main-heading">'.$headingtitle.'</h2>';
  }
  if(!empty($subheading)){
    $subTitle = '<h4 class="fs-14 text-center p-t-10"><span class="d-block">'.$subheading.'</h4>';
  }
  
  
  $per_row = 12;
  $addtionalcss  = 'container';
  $addtionalcss1  = '';
  if($number_row==4 && $subheading == "")
  {
    $per_row = 9;
    $addtionalcss  = 'container-fluid';
    $addtionalcss1  = 'justify-content-center';
  } 
  elseif($number_row==4 && $subheading != "")
  {
    $per_row = 12;
    $addtionalcss  = 'container';
  }

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

if($layout == 'style_three') {

$service .='<div class="about-signup p-t-80 p-b-80 global-investment-places">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-11">
            <h2 class="desktop-main-heading">'.$headingtitle.'</h2>
              <h4 class="fs-14 text-center p-t-10">'.$subheading.'</h4>';

  $service .='<div class="row">';

  }

elseif($layout == 'style_four'){

    $service .='<div class="fieldicon-description bg-gray p-t-60 p-b-40">
        <h2 class="desktop-main-heading">'.$headingtitle.'</h2>
        <div class="container">
          <div class="row p-t-40">';
  }

 else{

  $service .='<div class="about-signup '.$bgclass.'">';
$service .='<div class="'.$addtionalcss.'">'.$headTitle.$subTitle;
$service .='<div class="row '.$addtionalcss1.'">';
$service .='<div class="col-sm-'.$per_row.'">';

$service .='<div class="row">';

 } 

while ( $query->have_posts() ) : $query->the_post();

  $service_title = get_post_meta( $post->ID, 'service_title', true );

  $service_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );


  if($layout == 'style_three') {

    $service .='<div class="col">
                  <img src="'.$service_img[0].'" class="img-fluid m-b-30" />
                  <p>'.nl2br(get_post_field('post_content', $post->ID)).'</p>
                </div>';
      if($k%3 ==0){ $service .='</div><div class="row">';}          

  }

  elseif($layout == 'style_four'){

    $service .='<div class="col-sm-4 p-b-30">
              <img class="img-fluid d-block mx-auto mb-4" src="'.$service_img[0].'" alt="" />
              <p class="fs-14 text-center">'.nl2br(get_post_field('post_content', $post->ID)).'</p>
            </div>';
  }

  else{

      $service .='<div class="col">';
      $service .='<img src="'.$service_img[0].'" class="img-fluid" />';

      if($service_title){
        $service .='<h5>'.$service_title.'</h5>';
      }

      $service .='<p>'.nl2br(get_post_field('post_content', $post->ID)).'</p>';
      $service .='</div>';
      
      if($k%$number_row ==0){ $service .='</div><div class="row">';}
          
        
     /* $k++;
      endwhile;
      $service .='</div>';*/
  
}

  $k++;
  endwhile;

  wp_reset_postdata();


if($layout == 'style_three') {

  $service .='</div></div></div></div></div>';
}

elseif($layout == 'style_four'){

  $service .='</div></div></div>';
}

else{
    $service .='</div></div>';
    $service .='</div>';
    $service .='</div>';
    $service .='</div>';
} 


 
 return $service;
 
}
add_shortcode('service_section', 'get_service_section');