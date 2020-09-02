<?php

function get_popular_insight_fun($atts) {

	global $post, $wpdb, $wp_query;

	$title = $atts['title'];
	$subtitle = $atts['subtitle'];
	$layout = $atts['layout'];

	$ppp = '';

	if($layout == "style_one") { $ppp = 3; }
	if($layout == "style_two") { $ppp = 6; }
	if($layout == "style_three") { $ppp = 3; }

	$popular_insight = '';

	$popular_insight_query = new WP_Query(
        array(	'post_type' => 'post',
        		'meta_key' => 'post_views_count',
 				'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'posts_per_page' => $ppp
         ) 
    );

	if($layout == "style_one") // display the first layout style
	{
		$popular_insight .='<div class="popular-course event-popularcourse tablet-upcoming-event p-t-60">';
			if($title)
			{
		        $popular_insight .='<div class="text-center">
		          <div class="main-heading">'.$title.'</div>

		        </div>';
		    }

		  $popular_insight .='<div class="container-fluid inlights-morelist">';
          $popular_insight .='<div class="row">';

	}

	if($layout == "style_two")
	{
		
		$popular_insight .='<div class="tablet-popular-insights py-0">
		<div class="tablet-popular-insights pb-0">
		<h3 class="sub-heading">'.$subtitle.'</h3>
		<h2 class="main-heading">'.$title.'</h2>
		</div>
		<section class="carousel slider tablet-popular-insights py-0">';

	}

	if($layout == "style_three")
	{
		$popular_insight .='<h4 class="m-t-40 m-b-20">'.$title.'</h4>';
	}

	if($popular_insight_query->have_posts()) :
	  while ($popular_insight_query->have_posts()) : $popular_insight_query->the_post();

	  $popular_insight_id = get_the_ID();

		$insight_img = wp_get_attachment_image_src( get_post_thumbnail_id( $popular_insight_id), 'full' );
		$small_img = wp_get_attachment_image_src( get_post_thumbnail_id( $popular_insight_id), 'thumbnail' );
	    $post_tag = get_the_terms( $popular_insight_id, 'post_tag' );

	    if($layout == "style_one") // display the first layout style
		{
			 $popular_insight .='<div class="col-sm-4">
              <div class="course-list">
                <div class="img-sec">
                  <img src="'.$insight_img[0].'" alt="course-img" class="img-fluid">
                  
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="contentslider">
                      <span class="taglabel">'.$post_tag[0]->name.'</span>
                      <div class="formheading pb-2 pt-0"><a href="'.get_permalink( $popular_insight_id ).'">'.get_the_title($popular_insight_id).'</a></div>
                      <p>'.get_kc_excerpt().'</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>';

		}

		if($layout == "style_two") 
		{
			$popular_insight .='<div>
			<div class="list">
			<div class="row align-items-center">
			<div class="col-md-6 "><a href="'.get_permalink( $popular_insight_id ).'" ><span class="taglabel">'.$post_tag[0]->name.'</span></a></div>
			<div class="col-md-6">
			<div class="text-right">
			<a href="'.get_permalink( $popular_insight_id ).'" ><div class="datetime pt-1 ">'.get_the_date('d.m.Y').'</div></a>
			</div>
			</div>
			</div>
			<a style="text-transform: none;" href="'.get_permalink( $popular_insight_id ).'" ><h2>'.get_the_title($popular_insight_id).'</h2>
			<p>'.get_kc_excerpt().'</p></a>
			<a href="'.get_permalink( $popular_insight_id ).'"><span>Read more</span> <img src="'.get_template_directory_uri().'/images/down_2.png" alt="" /></a>
			</div>
			</div>';

		}

	    if($layout == "style_three") // display the third layout style
		{


			$popular_insight .='<div class="popularweek-list">
			  <div class="row">
			    <div class="col-sm-3">
			      <img src="'.$small_img[0].'" class="img-fluid" alt="">
			    </div>
			    <div class="col-sm-8 pl-0">
			      <span class="tags float-left">'.$post_tag[0]->name.'</span>
			      <h3><a href="'.get_permalink( $popular_insight_id ).'">'.get_the_title($popular_insight_id).'</a></h3>
			      <h6>'.get_the_date('d.m.Y').'</h6>
			    </div>
			    <div class="col-sm-1 p-0">
			      
			    </div>
			  </div>
			</div>';

            }

	endwhile;
	endif;

if($layout == "style_one")
{
	$popular_insight .='</div>';
	$popular_insight .='</div>';
	$popular_insight .='</div>';
}

if($layout == "style_two") 
{
	$popular_insight .='</div></div>
</section>
<div class="tablet-popular-insights text-center pt-0"><a href="/insights" class="eventbtn d-block text-decoration-none mx-auto text-uppercase">Go To Insights <img src="'.get_template_directory_uri().'/images/whiteforward.png" alt="" width="13" /></a></div>
</div>';

}

wp_reset_postdata();
return $popular_insight;

}

add_shortcode('popular_insights', 'get_popular_insight_fun');
?>
