<?php

function get_popular_insight_fun($atts) {

	global $post, $wpdb, $wp_query;

	$title = $atts['title'];
	$subtitle = $atts['subtitle'];
	$layout = $atts['layout'];

	$ppp = '';

	if($layout == "style_one") { $ppp = 4; }
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
		$popular_insight .='<div class="popular-course event-popularcourse insights-pagepopular">';
			if($title)
			{
		        $popular_insight .='<div class="text-center">
		          <div class="boldheading">'.$title.'</div>
		          <div class="path"></div>
		        </div>';
		    }
			$popular_insight .='<div class="container eventers-section inlights-morelist p-t-20">';
		  	$popular_insight .='<div class="card-group">';
	}

	if($layout == "style_two")
	{
		$popular_insight .='<div class="insightblock m-t-20 p-t-80 p-b-80">
			<div class="text-center">
			<div class="smallheading text-uppercase ">'.$subtitle.'</div>
			<div class="boldheading">'.$title.'</div>
			<div class="path"></div>
			</div>
			<div class="container">
			<div class="insightslider">
			<div class="multiple-items">';
	}

	if($layout == "style_three")
	{
		$popular_insight .='<h4 class="m-t-30 m-b-20">'.$title.'</h4>';
	}

	if($popular_insight_query->have_posts()) :
	  while ($popular_insight_query->have_posts()) : $popular_insight_query->the_post();

	  $popular_insight_id = get_the_ID();

		$insight_img = wp_get_attachment_image_src( get_post_thumbnail_id( $popular_insight_id), 'medium' );
		$small_img = wp_get_attachment_image_src( get_post_thumbnail_id( $popular_insight_id), 'thumbnail' );
	    $post_tag = get_the_terms( $popular_insight_id, 'post_tag' );

	    if($layout == "style_one") // display the first layout style
		{

			$popular_insight .='<div class="card three_column">
		              <div class="position-relative">
		                <a href="'.get_permalink( $popular_insight_id ).'"><img src="'.$insight_img[0].'" alt="" class="img-fluid"></a>
		               </div>
		              <div class="contentslider bg-white h-100">
		                <span class="taglabel">'.$post_tag[0]->name.'</span>
		                <div class="datetime float-right">'.get_the_date('d.m.Y').'</div>
		                <div class="formheading pb-2"><a href="'.get_permalink( $popular_insight_id ).'">'.get_the_title($popular_insight_id).'</a></div>
		                <a href="'.get_permalink( $popular_insight_id ).'"><p>'.get_kc_excerpt().'</p></a>
		              </div>
		            </div>';
	    }

	    if($layout == "style_two"){

	    	$popular_insight .='<div>
			<a href="'.get_permalink( $popular_insight_id ).'" ><div class="singleslideitem">
			<div class="contentslider">
			<a href="'.get_permalink( $popular_insight_id ).'" ><div class="row align-items-center m-b-40">
			<div class="col-md-6 "><span class="taglabel">'.$post_tag[0]->name.'</span></div>
			<div class="col-md-6">
			<div class="text-right">
			<div class="datetime pt-1 ">'.get_the_date('d.m.Y').'</div>
			</div>
			</div>
			</div></a>
			<div class="text-left">
			<a href="'.get_permalink( $popular_insight_id ).'" ><div class="formheading pb-2 text-left">'.get_the_title($popular_insight_id).'</div></a>
			<a href="'.get_permalink( $popular_insight_id ).'" ><div class="sightdesc">'.get_kc_excerpt().'</div></a>
			<a href="'.get_permalink( $popular_insight_id ).'" class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">Read more<span class="pl-3"><img src="'.get_template_directory_uri().'/images/down_2.png" alt="" /></span></a>
			</div>
			</div>
			</div></a>
			</div>';
		}

	    if($layout == "style_three") // display the third layout style
		{
	    $popular_insight .='<div class="popularweek-list">
                          <div class="row">
                            <div class="col-sm-4 pr-0">
                              <a href="'.get_permalink( $popular_insight_id ).'"><img src="'.$small_img[0].'" class="img-fluid" alt="" /></a>
                            </div>
                            <div class="col-sm-6">
                              <span class="tags float-left">'.$post_tag[0]->name.'</span>
                              <a href="'.get_permalink( $popular_insight_id ).'"><h3>'.get_the_title($popular_insight_id).'</h3></a>
                              <h6>'.get_the_date('d.m.Y').'</h6>
                            </div>
                            <div class="col-sm-2">

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
		<div class="text-center m-t-60 "><a href="/insights" class="eventbtn text-uppercase text-decoration-none d-block mx-auto" id="contactformview">Go to Insights <img src="'.get_template_directory_uri().'/images/whiteforward.png" alt="" width="15" /></a></div>
		</div>
		</div>';
}

wp_reset_postdata();
return $popular_insight;

}

add_shortcode('popular_insights', 'get_popular_insight_fun');
?>
