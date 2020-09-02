<?php 
/* Template Name: Home page */ 

get_header();

global $post, $wpdb;
global $current_pageName, $current_page_url;
$current_pageName = $post->post_title;
$obj_id = get_queried_object_id();
$current_page_url = get_permalink( $obj_id );

?>

<?php
	if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 

		get_template_part( 'template-parts/page/banner', 'content' );
		
	    the_content() 


	 ?>

	<?php endwhile; // End of the loop.

	endif; // End of the if.
	?>

<div class="col-sm-12 bottom-selection">
  <div class="row">
    <div class="col-12 text-center">
      <button type="button" data-toggle="modal" data-target="#schedule_form" id="schedule_trigger" data-keyboard="false" data-backdrop="static" class="btn btn-theme btn-block allformtrigger">Request an e-Meet</button>
	</div>
  </div>
</div>

<?php
get_footer();