<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 **/

get_header(); 
global $post, $wpdb;
?> 

<?php
global $post;
global $current_pageName, $current_page_url;
 $current_pageName = $post->post_title;
$obj_id = get_queried_object_id();
 $current_page_url = get_permalink( $obj_id );
?>


<div class="page-entry-content">
	
	<?php
	if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 

		the_content() 


	 ?>

	<?php endwhile; // End of the loop.

	endif; // End of the if.
	?>
<p>&nbsp;</p>
</div> 
<?php
get_footer();
