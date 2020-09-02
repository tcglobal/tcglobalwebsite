<?php 
/* Template Name: Home page */ 

get_header();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
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


<?php
get_footer();