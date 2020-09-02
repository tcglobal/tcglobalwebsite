<?php
/* Template Name: Events Template */

get_header(); 

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

</div>
	

<?php
get_footer();
