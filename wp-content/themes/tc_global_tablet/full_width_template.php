<?php
/* Template Name: Full Width Template*/ 
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

<div class="searchpartner-banner-bg insights-details-banner">
      <div class="bg-color"></div>
      <div class="container position-relative event-head">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading"><?php echo $post->post_title?></h2>
          </div>
        </div></div>
      </div>

      <div class="event-content insights-details-page">
	  <div class="search-result p-t-80 pb-0">
      <div class="container">
	  <div class="row">
          <div class="col-sm-12">
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
</div></div>
	</div></div>
</div>
</div>
<?php get_footer();