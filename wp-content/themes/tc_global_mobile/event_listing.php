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


<div class="col-sm-12 bottom-selection">
  <div class="row">
    <div class="col-12 text-center">
      <button type="button" data-toggle="modal" data-target="#schedule_form" id="schedule_trigger" data-keyboard="false" data-backdrop="static" class="btn btn-theme btn-block allformtrigger">schedule an e-Meet</button>
	</div>
  </div>
</div>
	

<?php
get_footer();
